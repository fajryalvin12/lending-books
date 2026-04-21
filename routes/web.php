<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

// Auth
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// After-login
Route::middleware(['auth'])->group(function () {

    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', fn() => view('admin.dashboard'));
        Route::resource('/books', BookController::class);
    });

    Route::prefix('member')->middleware('role:member')->group(function () {
        Route::get('/dashboard', fn() => view('member.dashboard'));
    });

});