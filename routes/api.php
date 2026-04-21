<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::prefix('books')->group(function () {
    Route::get('/', [BookController::class, 'index']);
    Route::get('{bookcode}', [BookController::class, 'show']);
    Route::post('/', [BookController::class, 'store']);
    Route::put('{bookcode}', [BookController::class, 'update']);
    Route::delete('{bookcode}', [BookController::class, 'destroy']);
});

Route::get('/test', function () {
    return response()->json(['message' => 'API working']);
});