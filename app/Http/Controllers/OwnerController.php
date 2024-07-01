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
            ->where('posts.deleted', 0)
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
        ]);
        if ($request->image !== null) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageName = uniqid().'.'.$request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            Posts::create(
                [
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'image' => '../uploads/'.$imageName,
                    'business_id' => session('business')->id,
                    'created_at' => now()
                ]
            );
        } else {
            Posts::create(
                [
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'image' => null,
                    'business_id' => session('business')->id,
                    'created_at' => now()
                ]
            );
        }
        return redirect('/profile');
    }
    public static function profile() {
        $myposts = self::myposts();
        $reservationCount = DB::table('reservation')->where('business_id', session('business')->id)->count();
        $postCount = DB::table('posts')->where('business_id', session('business')->id)->count();
        return view('owner.profile', ['myposts' => $myposts , 'postCount' => $postCount]);
    }
    public static function editPost(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $updateData = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'business_id' => session('business')->id,
            'created_at' => now()
        ];
    
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $updateData['image'] = '../uploads/'.$imageName;
        }
    
        posts::where('id', $request->input('id'))->update($updateData);
    
        return redirect('/profile');
    }

    public static function editPage($id) {
        $post = DB::table('posts')
            ->select('posts.*', 'posts.id as post_id')
            ->where('posts.id', $id)
            ->first();
        if ($post->business_id != session('business')->id) {
            return redirect('/profile');
        }
        return view('owner.edit', ['post' => $post]);
    }
    public static function deletePost($id) {
        DB::table('posts')->where('id', $id)->update(['deleted' => 1]);
        return redirect('/profile');
    }
    public static function reservations() {
        $reservations = DB::table('reservation')
            ->select('posts.*', 'reservation.*', 'menu.*', 'users.*', 'reservation.id as reservation_id' ,'posts.id as event_id')
            ->leftJoin('posts', 'posts.id', '=', 'reservation.business_id')
            ->leftJoin('users', 'users.id', '=', 'reservation.user_id')
            ->leftJoin('menu', 'menu.id', '=', 'reservation.item_id')
            ->where('posts.business_id', session('business')->id)
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
        $weekstats = [];
        for ($i = 0; $i < 7; $i++) {
            $date = now()->subDays($i);
            $count = DB::table('reservation')
                        ->where('business_id', session('business')->id)
                        ->where('status', 1)
                        ->whereDate('created_at', $date)
                        ->count();
            $weekstats[$date->format('Y-m-d')] = $count;
        }
        $items = DB::table('menu')
        ->select('menu.*', DB::raw('sum(reservation.quantity) as total_quantity'), DB::raw('count(reservation.id) as reservation_count'), 'menu.name as item_name')
        ->leftJoin('reservation', 'reservation.item_id', '=', 'menu.id')
        ->where('menu.business_id', session('business')->id)
        ->groupBy('menu.id')
        ->get();
        return view('owner.money', ['weekstats' => $weekstats, 'items' => $items]);
    }
    public static function saveBanner(Request $request) {
        $imageName = time().'.'.$request->image->extension();
        $imageURL = '../uploads/'.$imageName;
        DB::table('business')->where('id', session('business')->id)->update(['background_image' => $imageURL]);
        session('business')->background_image = $imageURL;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $validExtensions = array("jpeg", "jpg", "png");
            if (!in_array($extension, $validExtensions)) {
                echo "Extension not allowed, please choose a JPEG or PNG file.";
            }
            $size = $file->getSize();
            if ($size > 2097152) {
                echo "File size must size less then 2 MB";
            }
            $file->move(public_path('uploads'), $imageName);
    
            echo "Banner was uploaded successfully, reolad the page to see the changes";
        } else {
            echo "No file was uploaded";
        }
    }
    public static function editInfo(Request $request) {
        $message = '';
        DB::table('users')->where('id' , session('user')->id)->update(['firstname' => $request->firstname , 'lastname' => $request->lastname]);
        session('user')->firstname = $request->firstname;
        session('user')->lastname = $request->lastname;
        DB::table('business')->where('id' , session('business')->id)->update(['name' => $request->name , 'description' => $request->description , 'business_type' => $request->business_type]);
        session('business')->name = $request->name;
        session('business')->description = $request->description;
        session('business')->business_type = $request->business_type;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $imageURL = '../uploads/'.$imageName;
            DB::table('users')->where('id' , session('user')->id)->update(['pp' => $imageURL]);
            session('user')->pp = $imageURL;
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $validExtensions = array("jpeg", "jpg", "png");
            if (!in_array($extension, $validExtensions)) {
                $message .= " Extension not allowed, please choose a JPEG or PNG file. ";
            }
            $size = $file->getSize();
            if ($size > 2097152) {
                $message .= "File size must size less then 2 MB ";
            }
            $file->move(public_path('uploads'), $imageName);
    
            $message .= "Profile Picture was uploaded successfully, reload the page to see all changes ";
        } else {
            $message .= "Account Info was changed Without a new Profile Picture, reload the page to see all changes ";
        }
        echo $message;
    }
    public static function deleteSlide($xy) {
        $x  = explode(',', $xy)[0];
        $y  = explode(',', $xy)[1];
        DB::table('slides')->where('slider_index' , $x)->where('slide_index' , $y)->where('business_id' , session('business')->id)->update(['image' => '../assets/noimage.png']);
        echo 'Image Deleted';
    }
    public static function saveSliders( Request $request ) {
        if ($request->swiper1_slide1) {
            $old = DB::table('slides')->where('business_id', session('business')->id)->where('slider_index' , 1)->where('slide_index' , 1)->first();
            if ($old) {
                DB::table('slides')->where('business_id', session('business')->id)->where('slider_index' , 1)->where('slide_index' , 1)->delete();
            }
            $imageName = uniqid().'.'.$request->swiper1_slide1->extension();
            $file = $request->file('swiper1_slide1');
            $file->move(public_path('uploads'), $imageName);
            DB::table('slides')->insert(
                [
                    'title' => $request->swipper_title1,
                    'business_id' => session('business')->id,
                    'slider_index' => 1,
                    'slide_index' => 1,
                    'image' => '../uploads/'.$imageName,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        } else {
            DB::table('slides')->where('business_id', session('business')->id)->where('slider_index' , 1)->where('slide_index' , 1)->update(['title' => $request->swipper_title1]);
        }
        if ($request->swiper1_slide2) {
            $old = DB::table('slides')->where('business_id', session('business')->id)->where('slider_index' , 1)->where('slide_index' , 2)->first();
            if ($old) {
                DB::table('slides')->where('business_id', session('business')->id)->where('slider_index' , 1)->where('slide_index' , 2)->delete();
            }
            $imageName = uniqid().'.'.$request->swiper1_slide2->extension();
            $file = $request->file('swiper1_slide2');
            $file->move(public_path('uploads'), $imageName);
            DB::table('slides')->insert(
                [
                    'title' => $request->swipper_title1,
                    'business_id' => session('business')->id,
                    'slider_index' => 1,
                    'slide_index' => 2,
                    'image' => '../uploads/'.$imageName,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        } else {
            DB::table('slides')->where('business_id', session('business')->id)->where('slider_index' , 1)->where('slide_index' , 2)->update(['title' => $request->swipper_title1]);
        }
        if ($request->swiper1_slide3) {
            $old = DB::table('slides')->where('business_id', session('business')->id)->where('slider_index' , 1)->where('slide_index' , 3)->first();
            if ($old) {
                DB::table('slides')->where('business_id', session('business')->id)->where('slider_index' , 1)->where('slide_index' , 3)->delete();
            }
            $imageName = uniqid().'.'.$request->swiper1_slide3->extension();
            $file = $request->file('swiper1_slide3');
            $file->move(public_path('uploads'), $imageName);
            DB::table('slides')->insert(
                [
                    'title' => $request->swipper_title1,
                    'business_id' => session('business')->id,
                    'slider_index' => 1,
                    'slide_index' => 3,
                    'image' => '../uploads/'.$imageName,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        } else {
            DB::table('slides')->where('business_id', session('business')->id)->where('slider_index' , 1)->where('slide_index' , 3)->update(['title' => $request->swipper_title1]);
        }
        if ($request->swiper2_slide1) {
            $old = DB::table('slides')->where('business_id', session('business')->id)->where('slider_index' , 2)->where('slide_index' , 1)->first();
            if ($old) {
                DB::table('slides')->where('business_id', session('business')->id)->where('slider_index' , 2)->where('slide_index' , 1)->delete();
            }
            $imageName = uniqid().'.'.$request->swiper2_slide1->extension();
            $file = $request->file('swiper2_slide1');
            $file->move(public_path('uploads'), $imageName);
            DB::table('slides')->insert(
                [
                    'title' => $request->swipper_title2,
                    'business_id' => session('business')->id,
                    'slider_index' => 2,
                    'slide_index' => 1,
                    'image' => '../uploads/'.$imageName,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        } else {
            DB::table('slides')->where('business_id', session('business')->id)->where('slider_index' , 2)->where('slide_index' , 1)->update(['title' => $request->swipper_title2]);
        }
        if ($request->swiper2_slide2) {
            $old = DB::table('slides')->where('business_id', session('business')->id)->where('slider_index' , 2)->where('slide_index' , 2)->first();
            if ($old) {
                DB::table('slides')->where('business_id', session('business')->id)->where('slider_index' , 2)->where('slide_index' , 2)->delete();
            }
            $imageName = uniqid().'.'.$request->swiper2_slide2->extension();
            $file = $request->file('swiper2_slide2');
            $file->move(public_path('uploads'), $imageName);
            DB::table('slides')->insert(
                [
                    'title' => $request->swipper_title2,
                    'business_id' => session('business')->id,
                    'slider_index' => 2,
                    'slide_index' => 2,
                    'image' => '../uploads/'.$imageName,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        } else {
            DB::table('slides')->where('business_id', session('business')->id)->where('slider_index' , 2)->where('slide_index' , 2)->update(['title' => $request->swipper_title2]);
        }
        if ($request->swiper2_slide3) {
            $old = DB::table('slides')->where('business_id', session('business')->id)->where('slider_index' , 2)->where('slide_index' , 3)->first();
            if ($old) {
                DB::table('slides')->where('business_id', session('business')->id)->where('slider_index' , 2)->where('slide_index' , 3)->delete();
            }
            $imageName = uniqid().'.'.$request->swiper2_slide3->extension();
            $file = $request->file('swiper2_slide3');
            $file->move(public_path('uploads'), $imageName);
            DB::table('slides')->insert(
                [
                    'title' => $request->swipper_title2,
                    'business_id' => session('business')->id,
                    'slider_index' => 2,
                    'slide_index' => 3,
                    'image' => '../uploads/'.$imageName,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        } else {
            DB::table('slides')->where('business_id', session('business')->id)->where('slider_index' , 2)->where('slide_index' , 3)->update(['title' => $request->swipper_title2]);
        }
        $slides = DB::table('slides')->where('business_id', session('business')->id)->where('slider_index' , 1)->get();
        $images = [];
        foreach ($slides as $slide) {
            if ($slide->image != null) {
                array_push($images, $slide->image);
            } else {
                array_push($images, '../assets/noimage.png');
            }
        }
        $slides2 = DB::table('slides')->where('business_id', session('business')->id)->where('slider_index' , 2)->get();
        $images2 = [];
        foreach ($slides2 as $slide) {
            if ($slide->image != null) {
                array_push($images2, $slide->image);
            } else {
                array_push($images2, '../assets/noimage.png');
            }
        }
        session(['slider1_title' => $request->swipper_title1]);
        session(['slider2_title' => $request->swipper_title2]);
        session(['slider1' => $images]);
        session(['slider2' => $images2]);
        return redirect('/profile');
    }
    public static function deleteMenuItem($id) {
        DB::table('menu')->where('id', $id)->where('business_id', session('business')->id)->delete();
        $menu = DB::table('menu')->where('business_id', session('business')->id)->get();
        session(['menu' => $menu]);
        echo 'Item Deleted';
    }
    public static function editMenuItem( Request $request ) {
        DB::table('menu')->where('id', $request->id)->where('business_id', session('business')->id)->update(
            [
                'name' => $request->name,
                'description' => $request->desc,
                'price' => $request->price,
                'updated_at' => now()
            ]
        );
        $menu = DB::table('menu')->where('business_id', session('business')->id)->get();
        session(['menu' => $menu]);
        return redirect('/profile');
    }
    public static function addMenuItem(Request $request) {
        $itemsCount = DB::table('menu')->where('business_id', session('business')->id)->count();
        if ($itemsCount >= 20) {
            return redirect('/profile')->with('message', 'You have reached the maximum number of items (20)');
        } else {
            DB::table('menu')->insert(
                [
                    'name' => $request->name,
                    'description' => $request->desc,
                    'price' => $request->price,
                    'business_id' => session('business')->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
            $menu = DB::table('menu')->where('business_id', session('business')->id)->get();
            session(['menu' => $menu]);
            return redirect('/profile');
        }
    }
    public static function redeemTicket($id) {
        $ticket = DB::table('reservation')->where('id', $id)->first();
        if ( $ticket->status == 0 ) {
            echo 'Ticket already redeemed';
            return;
        } else {
            DB::table('reservation')->where('id', $id)->update(['status' => 0]);
            echo 'Redeemed';
        }
    }
}
