<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\EmailController;

class UserController extends Controller
{
    public static function profile() {
        if (session('user') == null) {
            redirect('/login');
        }
        $user = DB::table('users')->where('id', session('user')->id )->first();
        return view('profile', ['user' => $user]);
    }
    public static function myreservations() {
        if (session('user') == null) {
            redirect('/login');
        }
        $reservations = DB::table('reservation')
            ->select('posts.*', 'reservation.*', 'users.*', 'reservation.id as reservation_id' ,'posts.id as post_id')
            ->leftJoin('posts', 'posts.id', '=', 'reservation.business_id')
            ->leftJoin('users', 'users.id', '=', 'posts.business_id')
            ->where('reservation.user_id', session('user')->id)
            ->get();
        return view('user.myreservations', ['reservations' => $reservations]);
    }
    public static function sendTicket($id) {
        $reservation = DB::table('reservation')->where('id', $id)->first();
        $event_id = $reservation->event_id;
        $event = DB::table('posts')->where('id', $event_id)->first();
        $title = $event->title;
        $date = $event->date;
        $time = $event->time;
        $location = $event->location;
        $token = $reservation->token;
        $price = $event->price;
        session(['event_name' => $title]);
        session(['event_date' => $date]);
        session(['event_time' => $time]);
        session(['event_location' => $location]);
        session(['event_token' => $token]);
        session(['event_price' => $price]);
        $receiver = session('user')->email;
        EmailController::sendTicket($receiver);
        return redirect('/myReservations');
    }
    public static function dashboard() {
        $posts = PostsController::allPosts();
        return view('user.posts', ['posts' => $posts]);
    }
}
