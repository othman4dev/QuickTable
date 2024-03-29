<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public static function users() {
        $users = DB::table('users')->get();
        return view('admin.users', ['users' => $users]);
    }
    public static function categories() {
        $categories = DB::table('categories')->get();
        return view('admin.categories', ['categories' => $categories]);
    }
    public static function addCategory(Request $request) {
        $request->validate([
            'categories' => 'required'
        ]);
        DB::table('categories')->insert(['category' => $request->input('category')]);
        return redirect('/categories');
    }
    public static function deleteCategory($id) {
        DB::table('categories')->where('id', $id)->delete();
        return redirect('/categories');
    }
    public static function editCategory(Request $request) {
        $request->validate([
            'category' => 'required'
        ]);
        DB::table('categories')->where('id', $request->input('id'))->update(['category' => $request->input('category')]);
        return redirect('/categories');
    }
    public static function deleteCat($id) {
        DB::table('categories')->where('id', $id)->delete();
        return redirect('/categories');
    }
    public static function addCat(Request $request) {
        $request->validate([
            'category' => 'required'
        ]);
        DB::table('categories')->insert(['category' => $request->input('category')]);
        return redirect('/categories');
    }
    public static function editCat(Request $request) {
        $request->validate([
            'id' => 'required',
            'category' => 'required'
        ]);
        DB::table('categories')->where('id', $request->input('id'))->update(['category' => $request->input('category')]);
        return redirect('/categories');
    }
    public static function upgrade($id) {
        DB::table('users')->where('id', $id)->update(['role' => 'Organizator']);
        return redirect('/users');
    }
    public static function downgrade($id) {
        DB::table('users')->where('id', $id)->update(['role' => 'User']);
        return redirect('/users');
    }
    public static function stats() {
        $organizators = DB::table('users')->where('role', 'Organizator')->count();
        $users = DB::table('users')->where('role', 'User')->count();
        $reservations = DB::table('reservation')->count();
        $posts = DB::table('posts')->count();
        $admins = DB::table('users')->where('role', 'Admin')->count();
        return view('admin.stats', ['users' => $users, 'reservations' => $reservations, 'posts' => $posts , 'organizators' => $organizators , 'admins' => $admins]);
    }
    public static function posts() {
        $posts = DB::table('posts')
            ->select('posts.*', 'users.*', 'categories.*', 'posts.id as event_id')
            ->leftJoin('users', 'users.id', '=', 'posts.user_id')
            ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
            ->where('deleted', 0)
            ->get();
        return view('admin.posts', ['posts' => $posts]);
    }
}
