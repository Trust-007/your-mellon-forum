<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/register', [UserController::class, 'create']);

//Store User
Route::post('/users', [UserController::class, 'store']);

// Logout User
Route::post('/logout', [UserController::class, 'logout']);

// Login User
Route::get('/login', [UserController::class, 'login']);

Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Posts routes

// Comments routes
