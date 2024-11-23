<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReviewController;
use App\Models\Review;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::controller(RegisterController::class)->group(function () {
    Route::get('register', 'register');
    Route::get('login', 'login');
    Route::get('logout', 'logout');
});
Route::prefix('reviews')->controller(ReviewController::class)->group(function () {
    Route::get('index', 'index');
    Route::get('add', 'add');
    Route::get('{review}/answer', 'answer');
});
