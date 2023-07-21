<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

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

// Users routes

Route::get('/register', [UserController::class, 'create'])->middleware('guest');
Route::post('/users', [UserController::class, 'store']);
Route::post('/logout', [UserController::class, 'logout']);
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Posts routes

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/create', [PostController::class, 'create'])->middleware(['auth', 'verified']);
Route::post('/posts/store', [PostController::class, 'store'])->middleware(['auth', 'verified']);
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->middleware('auth');
Route::put('/posts/{post}', [PostController::class, 'update'])->middleware('auth');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->middleware('auth');
Route::get('/posts/{post}', [PostController::class, 'show']);

// Comments routes

Route::get('/posts/{post}/comments/create', [CommentController::class, 'create'])->middleware('auth');
Route::post('/posts/{post}/comments/store', [CommentController::class, 'store'])->middleware('auth');
Route::get('/posts/{post}/comments/{comment}/edit', [CommentController::class, 'edit'])->middleware('auth');
Route::put('/posts/{post}/comments/{comment}', [CommentController::class, 'update'])->middleware('auth');
Route::delete('/posts/{post}/comments/{comment}', [CommentController::class, 'destroy'])->middleware('auth');
Route::get('/posts/{post}/comments/{comment}', [CommentController::class, 'show']);


// email verification

Route::get('/email/verify', function () {
    return view('emails.verify-email');
})->middleware(['auth'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    
    return redirect('/posts')->with('verified', true);
})->middleware(['signed', 'auth'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
