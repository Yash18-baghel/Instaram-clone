<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Models\User;
use App\Models\Likes;
use App\Models\Post_cmnt;
use App\Models\post;
use App\Models\Profile;


Route::get('/',[RegisterController::class,'index'])->name('register');
Route::post('/',[RegisterController::class,'store']); 

Route::get('/home',[HomeController::class,'index'])->name('home');

Route::get('/profile',[ProfileController::class,'index'])->name('profile');
Route::post('/profile_change',[ProfileController::class,'change'])->name('profile_change');
Route::get('/profile_search',[ProfileController::class,'search'])->name('profile_search');
Route::get('/user_profile/{username}',[ProfileController::class,'user_profile'])->name('user_profile');
// Route::get('/profile_follow',[ProfileController::class,'follow'])->name('profile_follow');
Route::get('/profile_follow/{id}',[ProfileController::class,'follow'])->name('profile_follow');

Route::get('/logout',[LogoutController::class,'store'])->name('logout');

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);

Route::post('/post',[PostController::class,'store'])->name('post');
Route::get('/post',[PostController::class,'index'])->name('post');
// Route::get('/ShowPost/{username}/{post_id}',[PostController::class,'show'])->name('ShowPost');

Route::get('/post_like/{user_id}/{post_id}',[PostController::class,'like'])->name('post_like');
Route::Post('/post_cmnt/{post_id}',[PostController::class,'comment'])->name('post_cmnt');
Route::Post('/cmnt_reply/{id}/{post_id}',[PostController::class,'reply'])->name('cmnt_reply');

Route::get('test',  function(){
    $posts = post::with('user','user.profile')->find(8);
    $x = post::find(1) ; 
    // $user = User::find($posts->user_id);
    // $profile = Profile::where('user_id', $posts->user_id)->first();
    dd($x->Likes);
    return $posts;
});

