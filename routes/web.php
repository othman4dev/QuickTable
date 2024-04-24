<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\StripeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//ADMIN ROLE
Route::middleware(['role:Admin'])->group(function() {
    Route::get('/stats', [AdminController::class, 'stats']);
    Route::get('/users' ,[AdminController::class, 'users']);
    Route::get('/allposts' , [AdminController::class, 'posts']);
    Route::get('/business' ,[AdminController::class , 'business']);
    Route::get('/posts/delete/{id}', [PostsController::class, 'delete'])->name('delete');
    Route::get('/posts/approve/{id}', [PostsController::class, 'approve'])->name('approve');
    Route::get('/posts/reject/{id}', [PostsController::class, 'reject'])->name('reject');
    Route::get('/deleteCat/{id}', [AdminController::class, 'deleteCat'])->name('deleteCat');
    Route::post('/addCat', [AdminController::class, 'addCat']);
    Route::post('/editCat', [AdminController::class, 'editCat']);
    Route::get('/upgrade/{id}', [AdminController::class, 'upgrade'])->name('upgrade');
    Route::get('/downgrade/{id}', [AdminController::class, 'downgrade'])->name('downgrade');
    Route::get('/reports', [AdminController::class, 'reports']);
    Route::get('/dismissReport/{id}', [AdminController::class, 'dismissReport'])->name('dismissReport');
    Route::get('/userBan/{id}', [AdminController::class, 'userBan'])->name('userBan');
    Route::get('/userUnban/{id}', [AdminController::class, 'userUnban'])->name('userUnban');
});
//Owner ROLE
Route::middleware(['role:Owner'])->group(function () {
    Route::get('/myposts', [OwnerController::class, 'getMyposts']);
    Route::get('/add', [OwnerController::class, 'addPage']);
    Route::get('/money' , [OwnerController::class, 'money']);
    Route::post('/addPost', [OwnerController::class, 'addPost']);
    Route::get('/profile' , [OwnerController::class, 'profile']);
    Route::get('/edit/{id}', [OwnerController::class, 'edit'])->name('edit');
    Route::post('/editPost' , [OwnerController::class, 'editPost']);
    Route::get('/deletePost/{id}', [OwnerController::class, 'deletePost'])->name('deletePost');
    Route::get('/reservations' , [OwnerController::class, 'reservations']);
    Route::get('/approveReservation/{id}', [OwnerController::class, 'approveReservation'])->name('approveReservation');
    Route::get('/rejectReservation/{id}', [OwnerController::class, 'rejectReservation'])->name('rejectReservation');
    Route::post('/saveBanner', [OwnerController::class, 'saveBanner']);
    Route::post('/editInfo', [OwnerController::class, 'editInfo']);
    Route::get('/deleteSlide/{xy}', [OwnerController::class, 'deleteSlide'])->name('deleteSlide');
    Route::post('/saveSliders', [OwnerController::class, 'saveSliders']);
    Route::get('/deleteMenuItem/{id}', [OwnerController::class, 'deleteMenuItem'])->name('deleteMenuItem');
    Route::post('/editMenuItem', [OwnerController::class, 'editMenuItem']);
    Route::post('/addMenuItem', [OwnerController::class, 'addMenuItem']);
    Route::get('/redeemTicket/{id}', [OwnerController::class, 'redeemTicket'])->name('redeemTicket');
});
//USER ROLE
Route::middleware(['role:User'])->group(function () {
    Route::get('/myReservations', [UserController::class, 'myreservations']);
    Route::get('/ticket/{id}', [UserController::class, 'sendTicket'])->name('sendTicket');
    Route::get('/reserve/{id}', [PostsController::class, 'reserve'])->name('reserve');
    Route::get('/cancel/{id}', [PostsController::class, 'cancel'])->name('cancel');
    Route::get('/posts' , [UserController::class, 'dashboard']);
    Route::get('/reportBusiness/{id}', [PostsController::class, 'reportBusiness'])->name('reportBusiness');
    Route::get('/restaurants', [PostsController::class, 'restaurants']);
    Route::get('/coffeeshops', [PostsController::class, 'coffeeshops']);
    Route::get('/likePost/{id}', [PostsController::class, 'likePost'])->name('likePost');
    Route::post('/checkout', [StripeController::class, 'checkout']);
    Route::get('/checkout/success', [StripeController::class, 'success'])->name('checkout.success');
});
//GUEST ROLE
Route::middleware(['norole'])->group(function () {
    Route::get('/login', function () {
        return view('login');
    });
    Route::post('/log', [LoginController::class, 'login']); 
    Route::post('/register', [LoginController::class, 'register']);
    Route::get('/verify', function () {
        return view('verify');
    });
    Route::get('/forgot', function () {
        return view('forgot');
    });
    Route::post('/sendVerification', [LoginController::class, 'verifyCode']);
    Route::post('/sendForgot', [LoginController::class, 'sendForgot']);
    Route::post('/verifyCode', [LoginController::class, 'verifyCode']);
    Route::post('/verifyForgot', [LoginController::class, 'verifyForgot']);
    Route::post('/changePassword', [LoginController::class, 'changePassword']);
    Route::get('/newPassword', function () {
        return view('newPassword');
    });
    Route::get('/checkEmail/{email}', [LoginController::class, 'checkEmail'])->name('checkEmail');
});
// All Roles
Route::middleware(['user'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('/getBusiness/{id}', [PostsController::class, 'getBusiness'])->name('business');
    Route::get('/post' , [PostsController::class , 'post']);
    Route::get('/search/{search}', [PostsController::class, 'search'])->name('search');
    Route::get('/getPost/{id}', [PostsController::class, 'getPost'])->name('getPost');
    Route::post('/sendMail', [EmailController::class, 'sendMail']);
    Route::get('/contact', function () {
        if (session('user')->role == 'Owner') {
            return view('owner.contact');
        } else if(session('user')->role == 'User') {
            return view('user.contact');
        }
    });
    Route::post('/sendMessage', [UserController::class, 'contact']);
    Route::get('/inbox', [AdminController::class, 'inbox']);
});
Route::get('/', function () {
    if (session('user') == null) {
        return view('login');
    } else if ( session('user')->role == 'Admin') {
        return redirect('/stats');
    } else if ( session('user')->role == 'Owner') {
        return redirect('/profile');
    } else if ( session('user')->role == 'User') {
        $posts = PostsController::allPosts();
        $businesses = PostsController::businesses();
        return view('user.index', ['posts' => $posts , 'businesses' => $businesses]);
    }
});





