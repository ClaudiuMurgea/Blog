<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostsCategoriesController;
use App\Http\Controllers\CommentsController;

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    #Posts Routes
Route::get('/',                              [PostsController::class, 'index'])          ->name('public.posts');    # public
Route::get('/admin/posts',                   [PostsController::class, 'AdminIndex'])     ->name('admin.posts');
Route::get('/admin/post/create',             [PostsController::class, 'create'])         ->name('post.create');
Route::post('/admin/post',                   [PostsController::class, 'store'])          ->name('post.store');
Route::get('/{slug}',                        [PostsController::class, 'show'])           ->name('post.show');       # public
Route::get('/admin/edit/{slug}',             [PostsController::class, 'edit'])           ->name('post.edit');
Route::patch('/admin/{post}',                [PostsController::class, 'update'])         ->name('post.update');   
Route::delete('/admin/{post}',               [PostsController::class, 'destroy'])        ->name('post.destroy');

    #Categories Routes
Route::get('/admin/categories',              [CategoriesController::class, 'index'])     ->name('admin.categories');
Route::get('/admin/category/create',         [CategoriesController::class, 'create'])    ->name('category.create');
Route::post('/admin/category',               [CategoriesController::class, 'store'])     ->name('category.store');
Route::get('/category/{slug}',               [CategoriesController::class, 'show'])      ->name('category.show');    # public
Route::get('/admin/category/{slug}',         [CategoriesController::class, 'edit'])      ->name('category.edit');
Route::patch('/admin/category/{category}',   [CategoriesController::class, 'update'])    ->name('category.update');
Route::delete('/admin/category/{category}',  [CategoriesController::class, 'destroy'])   ->name('category.destroy');

    #Comments Routes
Route::get('admin/comments',                 [CommentsController::class, 'index'])       ->name('admin.comments'); 
Route::post('/comment/{comment}',            [CommentsController::class, 'store'])       ->name('comment.store');     # public     
Route::get('/comment/{post}/create',         [CommentsController::class, 'edit'])        ->name('comment.edit');      # public
Route::patch('admin/comment/{comment}',      [CommentsController::class, 'update'])      ->name('comment.update');
Route::delete('admin/comment/{comment}',     [CommentsController::class, 'destroy'])     ->name('comment.destroy');













