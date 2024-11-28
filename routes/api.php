<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Requests\RegisterUserRequest;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('login', [AuthController::class, 'login']);
Route::post('logout',[AuthController::class,'logout']);
Route::post('register', [AuthController::class, 'register']);
Route::get('posts', [PostController::class, 'index']);       
Route::post('posts', [PostController::class, 'store']);  
Route::get('posts/{id}', [PostController::class, 'show']); 
Route::put('posts/{id}', [PostController::class, 'update']); 
Route::delete('posts/{id}', [PostController::class, 'destroy']);   