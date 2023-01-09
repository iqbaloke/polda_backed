<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ForumKomenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthenticationController::class, 'login']);

Route::prefix('forum')->group(function () {
    Route::get('/', [ForumController::class, 'index']);
    Route::get('/{forum}', [ForumController::class, 'show']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [ForumController::class, 'store']);
        Route::patch('/{forum}', [ForumController::class, 'update']);
        Route::delete('/{forum}', [ForumController::class, 'destroy']);
    });
});
Route::prefix('forum_komen')->group(function () {
    Route::get('/{forum}', [ForumKomenController::class, 'index']);
    Route::get('/{forum}/{forumKomen}', [ForumKomenController::class, 'show']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/{forum}', [ForumKomenController::class, 'store']);
        Route::patch('/{forum}/{forumKomen}', [
            ForumKomenController::class,
            'update',
        ]);
        Route::delete('/{forumKomen}', [
            ForumKomenController::class,
            'destroy',
        ]);
    });
});
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthenticationController::class, 'logout']);
});