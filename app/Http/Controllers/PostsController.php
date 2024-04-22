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
                ->select('posts.*', 'users.*','business.*', 'posts.id as post_id', 'business.id as businessId' , 'posts.description as post_description' , 'users.pp as owner_pp')
                ->leftJoin('business', 'business.id', '=', 'posts.business_id')
                ->leftJoin('users', 'users.id', '=', 'business.owner_id')
                ->where('deleted', 0)
                ->simplePaginate(5);
        } else {
            $posts = DB::table('posts')
            ->select('posts.*', 'users.*','business.*', 'likes.post_id as liked' , 'business.id as businessId' , 'posts.id as post_id', 'posts.description as post_description', 'users.pp as owner_pp')
            ->leftJoin('business', 'business.id', '=', 'posts.business_id')
            ->leftJoin('users', 'users.id', '=', 'business.owner_id')
            ->leftJoin('likes', 'likes.post_id', '=', 'posts.id')
            ->where('deleted', 0)
            ->simplePaginate(5);
        }
        return $posts;
    }

    public static function categories() {
        $categories = DB::table('categories')->get();
        return $categories;
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
    public static function getBusiness($id) {
        $business = DB::table('business')
        ->select('business.*', 'users.*','business.id as businessId')
        ->leftJoin('users', 'users.id', '=', 'business.owner_id')
        ->where('business.id', $id)
        ->first();
        $slider1_title = DB::table('slides')->where('business_id', $business->businessId)->where('slider_index' , 1)->first()->title;
        $slider2_title = DB::table('slides')->where('business_id', $business->businessId)->where('slider_index' , 2)->first()->title;
        $slides2 = DB::table('slides')->where('business_id', $business->businessId)->where('slider_index' , 2)->get();
        $myposts = DB::table('posts')
        ->select('posts.*', 'likes.post_id as liked', 'posts.id as post_id')
        ->leftJoin('likes', 'likes.post_id', '=', 'posts.id')
        ->where('business_id', $business->businessId)->get();
        $menu = DB::table('menu')->where('business_id', $business->businessId)->get();
        $postCount = DB::table('posts')->where('business_id', $business->businessId)->count();
        $slides = DB::table('slides')->where('business_id', $business->businessId)->where('slider_index' , 1)->get();
        $images = [];
        foreach ($slides as $slide) {
            if ($slide->image != null) {
                array_push($images, $slide->image);
            } else {
                array_push($images, '../assets/noimage.png');
            }
        }
        $slides2 = DB::table('slides')->where('business_id', $business->businessId)->where('slider_index' , 2)->get();
        $images2 = [];
        foreach ($slides2 as $slide) {
            if ($slide->image != null) {
                array_push($images2, $slide->image);
            } else {
                array_push($images2, '../assets/noimage.png');
            }
        }
        if (session('user')->role == 'Admin') {
            return view('admin.business', ['business' => $business, 'slider1_title' => $slider1_title, 'slider2_title' => $slider2_title, 'slider1' => $images, 'slider2' => $images2, 'myposts' => $myposts, 'menu' => $menu , 'postCount' => $postCount]);
        } else  {
            return view('user.business', ['business' => $business, 'slider1_title' => $slider1_title, 'slider2_title' => $slider2_title, 'slider1' => $images, 'slider2' => $images2, 'myposts' => $myposts, 'menu' => $menu , 'postCount' => $postCount]);
        }
    }
    public static function post() {
        $post = session('post');
        return view('user.post', ['post' => $post]);
    }
    
    public static function search($search) {
        $posts = DB::table('posts')
            ->select('posts.*', 'users.*','business.*', 'business.id as businessId' , 'posts.id as post_id', 'posts.description as post_description', 'users.pp as owner_pp')
            ->leftJoin('business', 'business.id', '=', 'posts.business_id')
            ->leftJoin('users', 'users.id', '=', 'business.owner_id')
            ->where(function ($query) use ($search) {
                $query->where('posts.title', 'like', '%'.$search.'%')
                      ->orWhere('posts.description', 'like', '%'.$search.'%');
            })
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
                <div class='col-1-res' onclick='window.location.href =\"/getPost/".$post->post_id."\"' style='cursor:pointer;'>
                    <div class='result-image'>
                        <div class='img-result' style='background-image: url(". $post->owner_pp .");background-position:center;background-size:cover'></div>
                    </div>
                    <div class='result-texts'>
                        <h3 class='result-title'>".$post->title."</h3>
                        <p class='result-description'>".substr(strip_tags($post->description), 0, 20)."</p>
                    </div>
                </div>
                <div class='link-to-post' onclick=\"window.location.href = '/getBusiness/".$post->businessId."'\">
                    <i class='bi bi-arrow-right-circle-fill'></i>
                </div>
            </div>
            ";
        }
    }
        echo $result;
    }
    public static function getPost($id) {
        $post = DB::table('posts')
        ->select('posts.*', 'users.*','business.*', 'business.id as businessId' , 'posts.id as post_id', 'posts.description as post_description', 'users.pp as owner_pp')
        ->leftJoin('business', 'business.id', '=', 'posts.business_id')
        ->leftJoin('users', 'users.id', '=', 'business.owner_id')
        ->where('posts.id', $id)
        ->first();
        $postCount = DB::table('posts')->where('business_id', $post->businessId)->count();
        if ( session('user')->role == 'Admin') {
            return view('admin.post', ['post' => $post, 'postCount' => $postCount]);
        } else {
            return view('user.post', ['post' => $post, 'postCount' => $postCount]);
        }
    }
    public static function businesses() {
        $businesses = DB::table('business')
        ->select('business.*', 'users.*', 'business.id as businessId')
        ->leftJoin('users', 'users.id', '=', 'business.owner_id')
        ->get();
        return $businesses;
    }
    public static function reportBusiness($id) {
        $existe = DB::table('reports')->where('user_id', session('user')->id)->where('business_id', $id)->first();
        if ($existe) {
            echo 'Already reported';
        } else {
            DB::table('reports')->insert([
                'user_id' => session('user')->id,
                'business_id' => $id,
                'reason' => 'Inappropriate content',
                'created_at' => now()
            ]);
            echo 'Reported';
        }
    }
    public static function restaurants() {
        $restaurants = DB::table('business')
        ->select('business.*', 'users.*', 'business.id as businessId')
        ->leftJoin('users', 'users.id', '=', 'business.owner_id')
        ->where('business.business_type', 'Restaurant')
        ->get();
        return view('user.restaurants', ['businesses' => $restaurants]);
    }
    public static function coffeeshops() {
        $coffeeshops = DB::table('business')
        ->select('business.*', 'users.*', 'business.id as businessId')
        ->leftJoin('users', 'users.id', '=', 'business.owner_id')
        ->where('business.business_type', 'Coffee Shop')
        ->get();
        return view('user.coffeeshops', ['businesses' => $coffeeshops]);
    }
    public static function likePost($id) {
        $like = DB::table('likes')->where('user_id', session('user')->id)->where('post_id', $id)->first();
        if ($like) {
            DB::table('likes')->where('user_id', session('user')->id)->where('post_id', $id)->delete();
            $likes = DB::table('likes')->where('post_id', $id)->count();
            DB::table('posts')->where('id', $id)->update([
                'likes' => $likes
            ]);
            echo '<span>'. $likes . '</span>';
        } else {
            DB::table('likes')->insert([
                'user_id' => session('user')->id,
                'post_id' => $id,
                'created_at' => now()
            ]);
            $likes = DB::table('likes')->where('post_id', $id)->count();
            DB::table('posts')->where('id', $id)->update([
                'likes' => $likes
            ]);
            echo '<span  class="-liked">'. $likes . '</span>';
        }
    }
}