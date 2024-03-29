<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Posts;
use App\Http\Controllers\PostsController;

class OrganizatorController extends Controller
{
    public static function myposts()
    {
        $myposts = DB::table('posts')
            ->select('posts.*', 'categories.*', 'posts.id as post_id')
            ->join('categories', 'categories.id', '=', 'posts.category_id')
            ->where('posts.user_id', session('user')->id)
            ->where('deleted', 0)
            ->get();
        return $myposts;
    }
    public static function getMyposts() {
        $myposts = self::myposts();
        $categories = PostsController::categories();
        return view('organizator.myposts', ['myposts' => $myposts , 'categories' => $categories]);
    }
    public static function addEvent(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'spots' => 'required',
            'date' => 'required',
            'time' => 'required',
            'price' => 'required',
            'category' => 'required'
        ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('uploads'), $imageName);
        Posts::create(
            [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'location' => $request->input('location'),
                'image' => '../uploads/'.$imageName,
                'places' => $request->input('spots'),
                'spots' => $request->input('spots'),
                'date' => $request->input('date'),
                'time' => $request->input('time'),
                'price' => $request->input('price'),
                'category_id' => $request->input('category'),
                'user_id' => session('user')->id,
                'approved' => 0,
                'created_at' => now()
            ]
        );
        return redirect('/profile');
    }
    public static function profile() {
        $categories = PostsController::categories();
        $myposts = self::myposts();
        return view('organizator.profile', ['myposts' => $myposts, 'categories' => $categories]);
    }
    public static function editEvent(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'spots' => 'required',
            'date' => 'required',
            'time' => 'required',
            'price' => 'required',
            'category' => 'required'
        ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('uploads'), $imageName);
        posts::where('id', $request->input('id'))->update(
            [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'location' => $request->input('location'),
                'image' => '../uploads/'.$imageName,
                'places' => $request->input('spots'),
                'spots' => $request->input('spots'),
                'date' => $request->input('date'),
                'time' => $request->input('time'),
                'price' => $request->input('price'),
                'category_id' => $request->input('category'),
                'user_id' => session('user')->id,
                'approved' => 0,
                'updated_at' => now()
            ]
        );
        return redirect('/profile');
    }

    public static function edit($id) {
        $event = DB::table('posts')
            ->select('posts.*', 'users.*', 'categories.*', 'posts.id as event_id')
            ->leftJoin('users', 'users.id', '=', 'posts.business_id')
            ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
            ->where('posts.id', $id)
            ->first();
        if ($event->user_id != session('user')->id) {
            return redirect('/profile');
        }
        $categories = DB::table('categories')->get();
        return view('organizator.edit', ['event' => $event , 'categories' => $categories]);
    }
    public static function deleteEvent($id) {
        DB::table('posts')->where('id', $id)->update(['deleted' => 1]);
        return redirect('/profile');
    }
    public static function reservations() {
        $reservations = DB::table('reservation')
            ->select('posts.*', 'reservation.*', 'users.*', 'categories.*', 'reservation.id as reservation_id' ,'posts.id as event_id')
            ->leftJoin('posts', 'posts.id', '=', 'reservation.event_id')
            ->leftJoin('users', 'users.id', '=', 'reservation.user_id')
            ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
            ->where('posts.user_id', session('user')->id)
            ->get();
        return view('organizator.reservations', ['reservations' => $reservations]);
    }
    public static function approveReservation($id) {
        DB::table('reservation')->where('id', $id)->update(['status' => 1]);

        return redirect('/reservations');
    }
    public static function rejectReservation($id) {
        DB::table('reservation')->where('id', $id)->update(['status' => 0]);
        return redirect('/reservations');
    }
    public static function addPage() {
        $categories = PostsController::categories();
        return view('organizator.add', ['categories' => $categories]);
    }
    public static function money() {
        $myposts = self::myposts();
        return view('organizator.money', ['myposts' => $myposts]);
    }
    public static function organizatorProfile() {
        $categories = PostsController::categories();
        $myposts = self::myposts();
        return view('organizator.profile', ['myposts' => $myposts, 'categories' => $categories]);
    }
}
