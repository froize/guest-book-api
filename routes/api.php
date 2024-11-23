<?php

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Middleware\IsAdmin;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Support\Facades\Route;

Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register')->name('register');
    Route::post('login', 'login')->name('login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('reviews')->controller(ReviewController::class)->group(function () {
        Route::post('add', 'add')->name('api_reviews_add');
        Route::patch('{id}/answer', 'answer')->name('api_reviews_answer')->middleware(IsAdmin::class);
    });
    Route::get('index', function () {
        return ReviewResource::collection(Review::paginate(10));
    })->name('api_reviews_index');
});
