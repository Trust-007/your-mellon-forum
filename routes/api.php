<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

// Users routes

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected route with Sanctum authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/posts/store', [PostController::class, 'store'])->middleware('verified');
    Route::put('/posts/{post}', [PostController::class, 'update']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
    
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/posts/{post}/comments/store', [CommentController::class, 'store'])->middleware('verified');
    Route::put('/posts/{post}/comments/{comment}', [CommentController::class, 'update']);
    Route::delete('/posts/{post}/comments/{comment}', [CommentController::class, 'destroy']);
});

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    
    return redirect('/posts')->with('verified', true);
})->middleware(['signed', 'auth'])->name('verification.verify');

// Posts routes

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post}', [PostController::class, 'show']);

// Comments routes
Route::get('/posts/{post}/comments', [CommentController::class, 'index']);
Route::get('/posts/{post}/comments/{comment}', [CommentController::class, 'show']);