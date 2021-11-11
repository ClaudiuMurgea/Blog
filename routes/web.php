<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostsCategoriesController;
use App\Http\Controllers\CommentsController;



Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    #Posts Routes
Route::get('/',                              [PostsController::class, 'index']);         #Can be accessed by public
Route::get('/admin/post/create',             [PostsController::class, 'create']);
Route::post('/admin/post',                   [PostsController::class, 'store']);
Route::get('/{slug}',                        [PostsController::class, 'show']);          #Can be accessed by public
Route::get('/admin/edit/{slug}',             [PostsController::class, 'edit']);
Route::patch('/admin/{post}',                [PostsController::class, 'update']);
Route::delete('/admin/{post}',               [PostsController::class, 'destroy']);
Route::get('/admin/posts',                   [PostsController::class, 'AdminIndex']);


    #Categories Routes
Route::get('/admin/categories',              [CategoriesController::class, 'index']);
Route::get('/admin/category/create',         [CategoriesController::class, 'create']);
Route::post('/admin/category',               [CategoriesController::class, 'store']);
Route::get('/category/{slug}',               [CategoriesController::class, 'show']);     #Can be accessed by public
Route::get('/admin/category/{slug}',         [CategoriesController::class, 'edit']);
Route::patch('/admin/category/{category}',   [CategoriesController::class, 'update']);
Route::delete('/admin/category/{category}',  [CategoriesController::class, 'destroy']);

    #Comments Routes
Route::get('admin/comments',                 [CommentsController::class, 'index']); 
Route::post('/comment/{comment}',            [CommentsController::class, 'store']);      #Can be accessed by public     
Route::get('/comment/{post}/create',         [CommentsController::class, 'edit']);       #Can be accessed by public
Route::patch('admin/comment/{comment}',      [CommentsController::class, 'update']);
Route::delete('admin/comment/{comment}',     [CommentsController::class, 'destroy']);

    #PostsCategories Routes
Route::get('/admin/postscategories',         [PostsCategoriesController::class, 'index']);
Route::get('/admin/postcategory/{post}',     [PostsCategoriesController::class, 'show']);











