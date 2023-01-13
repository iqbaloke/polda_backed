<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ForumKomenController;
use App\Http\Controllers\GaleriController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthenticationController::class, 'login']);
Route::post('register', [AuthenticationController::class, 'register']);

Route::prefix('forum')->group(function () {
    Route::get('/', [ForumController::class, 'index']);
    Route::get('/{forum}', [ForumController::class, 'show']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [ForumController::class, 'store']);
        Route::patch('/{forum}', [ForumController::class, 'update']);
        Route::delete('/{forum}', [ForumController::class, 'destroy']);
    });
});

Route::prefix('galeri')->group(function () {
    Route::get('/', [GaleriController::class, 'index']);
    Route::get('/{galeri}', [GaleriController::class, 'show']);
    Route::post('/', [GaleriController::class, 'store']);
    Route::patch('/{galeri}', [GaleriController::class, 'update']);
    Route::delete('/{galeri}', [GaleriController::class, 'destroy']);
});

Route::prefix('berita')->group(function () {
    Route::get('/', [BeritaController::class, 'index']);
    Route::get('/{berita}', [BeritaController::class, 'show']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [BeritaController::class, 'store']);
        Route::patch('/{berita}', [BeritaController::class, 'update']);
        Route::delete('/{berita}', [BeritaController::class, 'destroy']);
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
