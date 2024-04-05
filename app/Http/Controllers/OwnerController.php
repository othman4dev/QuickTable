<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Posts;
use App\Http\Controllers\PostsController;

class OwnerController extends Controller
{
    public static function myposts()
    {
        $myposts = DB::table('posts')
            ->select('posts.*', 'posts.id as post_id')
            ->leftJoin('business', 'business.id' , '=', 'posts.business_id')
            ->where('posts.business_id', session('business')->id)
            ->get();
        
        return $myposts;
    }
    public static function menu() {
        $menu = DB::table('menu')
            ->select('menu.*', 'menu.id as item_id')
            ->leftJoin('business', 'business.id' , '=', 'menu.business_id')
            ->where('menu.business_id', session('business')->id)
            ->get();
        return $menu;
    }
    public static function getMyposts() {
        $myposts = self::myposts();
        return view('owner.myposts', ['myposts' => $myposts ]);
    }
    public static function addPost(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'spots' => 'required',
            'date' => 'required',
            'time' => 'required',
            'price' => 'required',
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
                'business_id' => session('user')->id,
                'approved' => 0,
                'created_at' => now()
            ]
        );
        return redirect('/profile');
    }
    public static function profile() {
        $myposts = self::myposts();
        $menu = self::menu();
        return view('owner.profile', ['myposts' => $myposts , 'menu' => $menu]);
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
                'business_id' => session('user')->id,
                'approved' => 0,
                'updated_at' => now()
            ]
        );
        return redirect('/profile');
    }

    public static function edit($id) {
        $event = DB::table('posts')
            ->select('posts.*', 'users.*', 'posts.id as event_id')
            ->leftJoin('users', 'users.id', '=', 'posts.business_id')
            ->where('posts.id', $id)
            ->first();
        if ($event->business_id != session('user')->id) {
            return redirect('/profile');
        }
        return view('owner.edit', ['event' => $event]);
    }
    public static function deleteEvent($id) {
        DB::table('posts')->where('id', $id)->update(['deleted' => 1]);
        return redirect('/profile');
    }
    public static function reservations() {
        $reservations = DB::table('reservation')
            ->select('posts.*', 'reservation.*', 'users.*', 'reservation.id as reservation_id' ,'posts.id as event_id')
            ->leftJoin('posts', 'posts.id', '=', 'reservation.event_id')
            ->leftJoin('users', 'users.id', '=', 'reservation.business_id')
            ->where('posts.business_id', session('user')->id)
            ->get();
        return view('owner.reservations', ['reservations' => $reservations]);
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
        return view('owner.add');
    }
    public static function money() {
        $myposts = self::myposts();
        return view('owner.money', ['myposts' => $myposts]);
    }
}
