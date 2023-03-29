<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/user', [UserController::class, 'showUsers']);
Route::post('/user', [UserController::class, 'createUser']);
Route::get('/subscribe', [SubscribeController::class, 'showSubscribes']);
Route::post('/subscribe', [SubscribeController::class, 'createSubscribe']);
Route::get('/website', [WebsiteController::class, 'showWebsite']);
Route::post('/website', [WebsiteController::class, 'createWebsite']);
Route::get('/post', [PostController::class, 'showPosts']);
Route::post('/post', [PostController::class, 'createPost']);

