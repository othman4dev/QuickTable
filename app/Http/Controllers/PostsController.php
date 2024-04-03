<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Posts;

class PostsController extends Controller
{
    public static function allPosts() {
        if (session('user') == null) {
            $posts = DB::table('posts')
                ->select('posts.*', 'users.*', 'reservation.*', 'posts.id as post_id', 'reservation.id as reserved')
                ->leftJoin('users', 'users.id', '=', 'posts.business_id')
                ->leftJoin('bussiness', 'bussiness.id', '=', 'posts.business_id')
                ->leftJoin('reservation', function ($join) {
                    $join->on('reservation.business_id', '=', 'posts.id')
                        ->where('reservation.user_id', '=', 0);
                })
                ->where('deleted', 0)
                ->simplePaginate(5);
        } else {
            $posts = DB::table('posts')
            ->select('posts.*', 'users.*', 'reservation.*' ,'business.*', 'posts.id as post_id', 'reservation.id as reserved')
            ->leftJoin('users', 'users.id', '=', 'posts.business_id')
            ->leftJoin('business', 'business.id', '=', 'posts.business_id')
            ->leftJoin('reservation', function ($join) {
                $join->on('reservation.business_id', '=', 'posts.id')
                    ->where('reservation.user_id', '=', session('user')->id);
            })
            ->where('deleted', 0)
            ->simplePaginate(5);
        }
        return $posts;
    }

    public static function categories() {
        $categories = DB::table('categories')->get();
        return $categories;
    }
    public static function reserve($id) {
        if (session('user') == null) {
            echo 'login';
            redirect('/login');
        } else {
            $post = DB::table('reservation')->where('post_id', $id)->where('user_id', session('user')->id)->first();
            if ($post) {
                echo 'You have already reserved this post';
            } else {
            $places = DB::table('posts')->where('id', $id)->value('spots');
            if ($places == 0) {
                echo "No places left";
            } else {
                $token = rand(10000000, 99999999);
                DB::table('reservation')->insert([
                    'post_id' => $id,
                    'user_id' => session('user')->id,
                    'token' => $token,
                    'created_at' => now()
                ]);
                DB::table('posts')->where('id', $id)->update([
                    'spots' => $places - 1
                ]);
                echo "Reserved";
            }
            }
        }
    }
    public static function cancel($id) {
        $post = DB::table('reservation')->where('post_id', $id)->where('user_id', session('user')->id)->first();
        if ($post) {
            DB::table('reservation')->where('post_id', $id)->where('user_id', session('user')->id)->delete();
            $places = DB::table('posts')->where('id', $id)->value('spots');
            DB::table('posts')->where('id', $id)->update([
                'spots' => $places + 1
            ]);
            echo "Canceled";
        } else {
            echo 'You have not reserved this post';
        }
    }
    public static function delete($id) {
        DB::table('posts')->where('id', $id)->delete();
        return redirect('/allposts');
    }
    public static function approve($id) {
        DB::table('posts')->where('id', $id)->update([
            'approved' => 1
        ]);
        return redirect('/allposts');
    }
    public static function reject($id) {
        DB::table('posts')->where('id', $id)->update([
            'approved' => 0
        ]);
        return redirect('/allposts');
    }
    public static function getpost($id) {
        $post = DB::table('posts')
            ->select('posts.*', 'users.*', 'categories.*', 'reservation.*', 'posts.id as post_id', 'reservation.id as reserved')
            ->leftJoin('users', 'users.id', '=', 'posts.business_id')
            ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
            ->leftJoin('reservation', function ($join) {
                $join->on('reservation.post_id', '=', 'posts.id')
                    ->where('reservation.user_id', '=', 0);
            })
            ->where('posts.id', $id)
            ->where('deleted', 0)
            ->first();
        return redirect('/post')->with(compact('post'));
    }
    public static function post() {
        $post = session('post');
        return view('user.post', ['post' => $post]);
    }
    
    public static function search($search) {
        $posts = DB::table('posts')
            ->select('posts.*', 'users.*', 'categories.*', 'reservation.*', 'posts.id as post_id', 'reservation.id as reserved')
            ->leftJoin('users', 'users.id', '=', 'posts.business_id')
            ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
            ->leftJoin('reservation', function ($join) {
                $join->on('reservation.post_id', '=', 'posts.id')
                    ->where('reservation.user_id', '=', 0);
            })
            ->where(function ($query) use ($search) {
                $query->where('title', 'like', '%'.$search.'%')
                      ->orWhere('description', 'like', '%'.$search.'%');
            })
            ->where('approved', 1)
            ->where('deleted', 0)
            ->get();
        $result = "";
        if ($posts->isEmpty()) {
            $result = "<div class='result'>
                <div class='no-result'>
                <i class='bi bi-emoji-frown-fill'></i> No results found
                </div>
            </div>";
        } else {
        foreach ($posts as $post) {
            $result = $result ."
            <div class='result'>
                <div class='col-1-res'>
                    <div class='result-image'>
                        <div class='img-result' style='background-image: url()'></div>
                    </div>
                    <div class='result-texts'>
                        <h3 class='result-title'>".$post->title."</h3>
                        <p class='result-description'>".substr(strip_tags($post->description), 0, 20)."</p>
                    </div>
                </div>
                <div class='link-to-post' onclick=\"window.location.href = '/getpost/".$post->post_id."'\">
                    <i class='bi bi-arrow-right-circle-fill'></i>
                </div>
            </div>
            ";
        }
    }
        echo $result;
    }
}