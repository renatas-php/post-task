<?php

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
Route::get('/sanctum/csrf-cookie', function () {
    return response()->json(['message' => 'CSRF cookie set']);
});

//Post
Route::get('/front/post-helper', [\App\Http\Controllers\Api\Front\Post\PostHelperController::class, 'postLists']);
Route::get('/front/posts', [\App\Http\Controllers\Api\Front\Post\PostController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function () {
    //Projects
    Route::get('/front/user-posts', [\App\Http\Controllers\Api\Front\Post\UserPostController::class, 'index']);
    Route::get('/front/user-posts/{id}', [\App\Http\Controllers\Api\Front\Post\UserPostController::class, 'edit']);
    Route::post('/front/add-post', [\App\Http\Controllers\Api\Front\Post\UserPostController::class, 'store']);
    Route::put('/front/update-post/{id}', [\App\Http\Controllers\Api\Front\Post\UserPostController::class, 'update']);
    Route::delete('/front/user-posts-delete/{id}', [\App\Http\Controllers\Api\Front\Post\UserPostController::class, 'destroy']);
    //Profile
    Route::get('/front/me', [\App\Http\Controllers\Api\Front\User\UserController::class, 'index']);
    
});

Route::post('/logout', [\App\Http\Controllers\Api\Front\Auth\LoginController::class, 'destroy']);
Route::post('/register', [\App\Http\Controllers\Api\Front\Auth\RegisterController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\Front\Auth\LoginController::class, 'login']);
Route::post('/forget-password', [\App\Http\Controllers\Api\Front\Auth\ForgotPasswordController::class, 'store'])->name('password.reset');
Route::post('/reset-password/{token}', [\App\Http\Controllers\Api\Front\Auth\ForgotPasswordController::class, 'update']);


