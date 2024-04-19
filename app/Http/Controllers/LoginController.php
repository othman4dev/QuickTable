<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\EmailController;
use App\Models\Events;


class LoginController extends Controller
{
    public static function index($message) {
        return view('login');
    }
    public static function login(Request $request){
        $username = $request->input('email');
        $password = $request->input('password');
        $user = DB::table('users')->where('email', $username)->first();
        if ($user && password_verify($password , $user->password) && $user->email_verified_at != null) {
            session(['user' => $user]);
            if ($user->role == 'Owner') {
                $business = DB::table('business')->where('owner_id', $user->id)->first();
                $slides = DB::table('slides')->where('business_id', $business->id)->where('slider_index' , 1)->get();
                $images = [];
                foreach ($slides as $slide) {
                    if ($slide->image != null) {
                        array_push($images, $slide->image);
                    } else {
                        array_push($images, '../assets/noimage.png');
                    }
                }
                $slides2 = DB::table('slides')->where('business_id', $business->id)->where('slider_index' , 2)->get();
                $images2 = [];
                foreach ($slides2 as $slide) {
                    if ($slide->image != null) {
                        array_push($images2, $slide->image);
                    } else {
                        array_push($images2, '../assets/noimage.png');
                    }
                }
                $menu = DB::table('menu')->where('business_id', $business->id)->get();
                session(['slider1_title' => $slides[0]->title]);
                session(['slider2_title' => $slides2[0]->title]);
                session(['slider1' => $images]);
                session(['slider2' => $images2]);
                session(['menu' => $menu]);
                if ($business) {
                    session(['business' => $business]);
                }
            }
            return redirect('/');
        } else if ( $user && $user->email_verified_at == null) {
            $token = rand(1000, 9999);
            session()->forget('token');
            session(['token' => $token]);
            session(['email' => $username]);
            EmailController::sendMail($username,session('token'));
            return redirect('/verify');
        } else {
            return redirect('/login?login')->with('message', 'Invalid username or password',)->with('failed_email', $username);
        }
    }
    public static function register(Request $request) {
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $name = $firstname . ' ' . $lastname;
        $email = $request->input('email');
        $pass1 = $request->input('pass1');
        $pass2 = $request->input('pass2');
        if ($pass1 != $pass2) {
            return redirect('/login?register')->with('message2', 'Passwords do not match');
        }
        if (strlen($pass1) < 8) {
            return redirect('/login?register')->with('message2', 'Password must be at least 8 characters');
        }
        $password = password_hash($request->input('pass1'), PASSWORD_DEFAULT);
        $user = DB::table('users')->where('email', $email)->first();
        if ($user) {
            return redirect('/login?register')->with('message2', 'Email already exists , please login or use another email address');
        } else {
            $token = rand(1000, 9999);
            session()->forget('token');
            session(['token' => $token]);
            session(['email' => $email]);
            DB::table('users')->insert(['firstname' => $firstname , 'lastname' => $lastname ,'email' => $email, 'password' => $password]);
            EmailController::sendMail($email, session('token'));
            return redirect('/verify');
        }
    }
    public static function logout() {
        session()->flush();
        return redirect('/login');
    }
    public static function verifyCode(Request $request) {
        if ($request->input('code') == session('token')) {
            session()->forget('token');
            $user = DB::table('users')->where('email', session('email'))->first();
            if ($user) {
                DB::table('users')->where('email', session('email'))->update(['email_verified_at' => date('Y-m-d H:i:s')]);
                session(['user' => $user]);
                return redirect('/');
            }
        } else {
            return redirect('/verify')->with('message', 'Invalid verification code');
        }
    }

    public static function sendForgot(Request $request) {
        $email = $request->input('email');
        $user = DB::table('users')->where('email', $email)->first();
        if ($user) {
            $token = rand(1000, 9999);
            session()->forget('token');
            session(['token' => $token]);
            session(['email' => $email]);
            $name = $user->firstname . ' ' . $user->lastname;
            session(['username' => $name]);
            EmailController::sendForgot($email);
            return redirect('/forgot?register');
        } else {
            return redirect('/forgot')->with('message', 'Email does not exist');
        }
    }
    public static function verifyForgot(Request $request) {
        if ($request->input('code') == session('token')) {
            session()->forget('token');
            return redirect('/newPassword');
        } else {
            return redirect('/forgot?register')->with('message', 'Invalid verification code');
        }
    }
    public static function changePassword(Request $request) {
        $pass1 = $request->input('pass1');
        $pass2 = $request->input('pass2');
        if ($pass1 != $pass2) {
            return redirect('/newPassword')->with('message', 'Passwords do not match');
        }
        if (strlen($pass1) < 8) {
            return redirect('/newPassword')->with('message', 'Password must be at least 8 characters');
        }
        $password = password_hash($request->input('pass1'), PASSWORD_DEFAULT);
        DB::table('users')->where('email', session('email'))->update(['password' => $password]);
        return redirect('/login');
    }
    public static function checkEmail($email) {
        $user = DB::table('users')->where('email', $email)->first();
        if ($user) {
            echo 'exists';
        } else {
            echo 'valid';
        }
    }
}
