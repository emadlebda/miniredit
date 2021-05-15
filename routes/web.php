<?php

use App\Http\Controllers\CommunitiesController;
use App\Http\Controllers\CommunityPostController;
use App\Http\Controllers\PostCommentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Auth::routes(['verify' => true]);


Route::group(['middleware' => ['auth', 'verified']], function () {
//Route::group(['middleware' => ['auth']], function () {

    Route::resource('communities', CommunitiesController::class);
    Route::resource('communities.posts', CommunityPostController::class);
    Route::resource('posts.comments', PostCommentController::class);
    Route::get('posts/{post_id}/vote/{vote}', [CommunityPostController::class, 'vote'])->name('post.vote');
    Route::post('posts/{post_id}/report', [CommunityPostController::class, 'report'])->name('post.report');

});
