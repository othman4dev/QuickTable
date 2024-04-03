<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrganizatorController;


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
    Route::get('/categories' ,[AdminController::class , 'categories']);
    Route::get('/posts/delete/{id}', [PostsController::class, 'delete'])->name('delete');
    Route::get('/posts/approve/{id}', [PostsController::class, 'approve'])->name('approve');
    Route::get('/posts/reject/{id}', [PostsController::class, 'reject'])->name('reject');
    Route::get('/deleteCat/{id}', [AdminController::class, 'deleteCat'])->name('deleteCat');
    Route::post('/addCat', [AdminController::class, 'addCat']);
    Route::post('/editCat', [AdminController::class, 'editCat']);
    Route::get('/upgrade/{id}', [AdminController::class, 'upgrade'])->name('upgrade');
    Route::get('/downgrade/{id}', [AdminController::class, 'downgrade'])->name('downgrade');
});
//ORGANIZATOR ROLE
Route::middleware(['role:Organizator'])->group(function () {
    Route::get('/myposts', [OrganizatorController::class, 'getMyposts']);
    Route::get('/add', [OrganizatorController::class, 'addPage']);
    Route::get('/money' , [OrganizatorController::class, 'money']);
    Route::post('/addPost', [OrganizatorController::class, 'addPost']);
    Route::get('/profile' , [OrganizatorController::class, 'profile']);
    Route::get('/edit/{id}', [OrganizatorController::class, 'edit'])->name('edit');
    Route::post('/editPost' , [OrganizatorController::class, 'editPost']);
    Route::get('/deletePost/{id}', [OrganizatorController::class, 'deletePost'])->name('deletePost');
    Route::get('/reservations' , [OrganizatorController::class, 'reservations']);
    Route::get('/approveReservation/{id}', [OrganizatorController::class, 'approveReservation'])->name('approveReservation');
    Route::get('/rejectReservation/{id}', [OrganizatorController::class, 'rejectReservation'])->name('rejectReservation');
});
//USER ROLE
Route::middleware(['role:User'])->group(function () {
    Route::get('/myReservations', [UserController::class, 'myreservations']);
    Route::get('/ticket/{id}', [UserController::class, 'sendTicket'])->name('sendTicket');
    Route::get('/reserve/{id}', [PostsController::class, 'reserve'])->name('reserve');
    Route::get('/cancel/{id}', [PostsController::class, 'cancel'])->name('cancel');
    Route::get('/posts' , [UserController::class, 'dashboard']);
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
    Route::get('/getPost/{id}', [PostsController::class, 'getPost'])->name('post');
    Route::get('/post' , [PostsController::class , 'post']);
    Route::get('/search/{search}', [PostsController::class, 'search'])->name('search');
    
    Route::post('/sendMail', [EmailController::class, 'sendMail']);
});
Route::get('/', function () {
    if (session('user') == null) {
        return view('login');
    } else if ( session('user')->role == 'Admin') {
        return redirect('/stats');
    } else if ( session('user')->role == 'Organizator') {
        return redirect('/profile');
    } else if ( session('user')->role == 'User') {
        $posts = PostsController::allPosts();
        return view('user.index', ['posts' => $posts]);
    }
});





