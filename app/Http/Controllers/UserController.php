<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\EmailController;
use Laravel\Cashier\Billable;
class UserController extends Controller
{
    use Billable;
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
            ->select('reservation.*', 'menu.*', 'business.name as business_name', 'menu.name as item_name', 'reservation.created_at as reservation_date', 'business.background_image as business_image')
            ->join('menu', 'menu.id', '=', 'reservation.item_id')
            ->join('business', 'business.id', '=', 'reservation.business_id')
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
        $businesses = PostsController::businesses();
        return view('user.posts', ['posts' => $posts, 'businesses' => $businesses]);
    }
    public static function contact(Request $request) {
        DB::table('inbox')->insert([
            'user_id' => session('user')->id,
            'message' => $request->message,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return redirect('/contact')->with('message', 'Message sent successfully');
    }
}
