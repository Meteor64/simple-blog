<?php

use App\Http\Controllers\LandingCommentController;
use App\Http\Controllers\landingController;
use App\Http\Controllers\LikePostController;
use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\CommentController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\EditorUploadController;
use App\Http\Controllers\Panel\PostController;
use App\Http\Controllers\Panel\ProfileController;
use App\Http\Controllers\Panel\UserController;
use App\Http\Controllers\SearchPostController;
use App\Http\Controllers\ShowPostCategoryController;
use App\Http\Controllers\ShowPostController;
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

Route::get('/', [landingController::class, 'index'])->name('landing');
//Home Posts
Route::get('post/{post:slug}', [ShowPostController::class, 'show'])->name('post.show');

//Show Posts by Category
Route::get('category/{category:slug}', [ShowPostCategoryController::class, 'show'])->name('categoryPost.show');

//Search Post
Route::get('/search', [SearchPostController::class, 'show'])->name('search.show');

//Landing Comment
Route::middleware(['auth'])->post('/comment', [LandingCommentController::class, 'store'])->name('comment.store');
//LikePost
Route::middleware(['auth', 'throttle:like'])->post('/like/{post:slug}', [LikePostController::class, 'store'])->name('like.store');

Route::middleware(['auth'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::middleware(['auth'])->put('/profile', [ProfileController::class, 'update'])->name('profile.update');


Route::middleware(['auth', 'isAdmin'])->prefix('/panel')->group(function () {
//    User
    Route::resource('/users', UserController::class)->except(['show']);
//    Category
    Route::resource('/categories', CategoryController::class)->except(['show', 'create']);
//    Post
    Route::resource('/posts', PostController::class);
//    Comment
    Route::resource('/comments', CommentController::class)->except(['edit', 'create']);
});

Route::middleware(['auth', 'isAuthor'])->prefix('/panel')->group(function () {
//    Post
    Route::resource('/posts', PostController::class);
//    Editor
    Route::post('/editor/upload', [EditorUploadController::class, 'upload'])->name('editor.upload');

});


require __DIR__ . '/auth.php';
