<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);


Route::group(['middleware' => ['auth', 'verified']], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('communities', App\Http\Controllers\CommunityController::class);
    Route::resource('communities.posts', App\Http\Controllers\CommunityPostController::class);
    Route::resource('posts.comments', App\Http\Controllers\PostCommentController::class);
    Route::get('posts/{post_id}/vote/{id}', [\App\Http\Controllers\CommunityPostController::class, 'vote'])->name('post.vote');
});


