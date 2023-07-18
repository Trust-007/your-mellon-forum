<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Users routes

Route::post('/register', [UserController::class, 'store']);
Route::post('/logout', [UserController::class, 'logout']);
// Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'authenticate']);

// Posts routes

Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts/store', [PostController::class, 'store'])->middleware('auth');
Route::put('/posts/{post}', [PostController::class, 'update']);
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->middleware('auth');
Route::get('/posts/{post}', [PostController::class, 'show']);

// Comments routes