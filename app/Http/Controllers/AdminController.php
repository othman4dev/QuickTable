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
        return view('admin.businesses', ['businesses' => $businesses]);
    }
    public static function upgrade($id) {
        DB::table('users')->where('id', $id)->update(['role' => 'Owner']);
        if (DB::table('business')->where('owner_id', $id)->count() > 0) {
            return redirect('/users')->with('message', 'User already has a business');
        }
        DB::table('business')->insert([
            'name' => 'New Business',
            'address' => 'New Adress',
            'phone' => 'New Phone',
            'email' => 'New Email',
            'description' => 'New Description',
            'background_image' => '../uploads/defaultbusiness.jpg',
            'business_type' => 'Restaurant',
            'status' => 1,
            'base_price' => 1,
            'owner_id' => $id
        ]);
        $business = DB::table('business')->where('owner_id', $id)->first();
        for ($i = 1; $i < 4; $i++) {
            DB::table('slides')->insert([
                'title' => 'Slider Title',
                'image' => '../assets/noimage.jpg',
                'slider_index' => '1',
                'slide_index' => $i,
                'business_id' => $business->id
            ]);
        }
        for ($i = 1; $i < 4; $i++) {
            DB::table('slides')->insert([
                'title' => 'Slider Title',
                'image' => '../assets/noimage.jpg',
                'slider_index' => '2',
                'slide_index' => $i,
                'business_id' => $business->id
            ]);
        }
        return redirect('/users');
    }
    public static function downgrade($id) {
        DB::table('users')->where('id', $id)->update(['role' => 'User']);
        DB::table('business')->where('owner_id', $id)->update(['status' => 0]);
        return redirect('/users');
    }
    public static function stats() {
        $owners = DB::table('users')->where('role', 'Owner')->count();
        $users = DB::table('users')->where('role', 'User')->count();
        $reservations = DB::table('reservation')->count();
        $posts = DB::table('posts')->count();
        $admins = DB::table('users')->where('role', 'Admin')->count();
        $reports = DB::table('reports')->count();
        $topReservators = DB::table('users')
            ->select('users.*', DB::raw('count(reservation.id) as reservation_count'))
            ->join('reservation', 'reservation.user_id', '=', 'users.id')
            ->groupBy('users.id')
            ->orderBy('reservation_count', 'desc')
            ->limit(5)
            ->get();
        $topBusinesses = DB::table('business')
            ->select('business.*', 'users.*' ,DB::raw('count(reservation.id) as reservation_count'))
            ->leftJoin('users', 'users.id', '=', 'business.owner_id')
            ->join('reservation', 'reservation.business_id', '=', 'business.id')
            ->groupBy('business.id')
            ->orderBy('reservation_count', 'desc')
            ->limit(5)
            ->get();
        return view('admin.stats', ['users' => $users, 'reservations' => $reservations, 'posts' => $posts , 'owners' => $owners , 'admins' => $admins , 'reports' => $reports , 'topReservators' => $topReservators , 'topBusinesses' => $topBusinesses]);
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
    public static function reports() {
        $reports = DB::table('reports')
            ->select('reports.*', 'us1.*', 'us2.*' , 'business.*', 'us1.firstname as owner_firstname' , 'us1.lastname as owner_lastname' , 'us2.email as user_email' , 'us1.email as owner_email', 'us2.firstname as user_firstname' , 'us2.lastname as user_lastname' , 'business.name as business_name' ,'reports.id as report_id')
            ->leftJoin('users as us2', 'us2.id', '=', 'reports.user_id')
            ->leftJoin('business', 'business.id', '=', 'reports.business_id')
            ->leftJoin('users as us1', 'us1.id', '=', 'business.owner_id')
            ->get();
        return view('admin.reports', ['reports' => $reports]);
    }
    public static function inbox() {
        $inbox = DB::table('inbox')
            ->select('inbox.*', 'users.*')
            ->join('users', 'users.id', '=', 'inbox.user_id')
            ->orderBy('inbox.created_at', 'desc')
            ->get();
        return view('admin.inbox', ['messages' => $inbox]);
    }
    public static function dismissReport($id) {
        DB::table('reports')->where('id',$id)->delete();
        return redirect('/reports');
    }
    public static function userBan($id) {
        DB::table('users')->where('id', $id)->update([
            'status' => 0
        ]);
        return redirect('/users');
    }
    public static function userUnban($id) {
        DB::table('users')->where('id',$id)->update([
            'status' => 1
        ]);
        return redirect('/users');
    }
}
