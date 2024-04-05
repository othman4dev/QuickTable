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
    public static function business() {
        $businesses = DB::table('business')->get();
        return view('admin.business', ['businesses' => $businesses]);
    }
    public static function upgrade($id) {
        DB::table('users')->where('id', $id)->update(['role' => 'owner']);
        return redirect('/users');
    }
    public static function downgrade($id) {
        DB::table('users')->where('id', $id)->update(['role' => 'User']);
        return redirect('/users');
    }
    public static function stats() {
        $owners = DB::table('users')->where('role', 'Owner')->count();
        $users = DB::table('users')->where('role', 'User')->count();
        $reservations = DB::table('reservation')->count();
        $posts = DB::table('posts')->count();
        $admins = DB::table('users')->where('role', 'Admin')->count();
        return view('admin.stats', ['users' => $users, 'reservations' => $reservations, 'posts' => $posts , 'owners' => $owners , 'admins' => $admins]);
    }
    public static function posts() {
        $posts = DB::table('posts')
            ->select('posts.*', 'users.*', 'business.*' , 'posts.id as post_id')
            ->leftJoin('users', 'users.id', '=', 'posts.business_id')
            ->leftJoin('business', 'business.id', '=', 'posts.business_id')
            ->where('deleted', 0)
            ->get();
        return view('admin.posts', ['posts' => $posts]);
    }
}
