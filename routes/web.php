<?php

use App\Http\Controllers\JenisSyaratController;
use App\Http\Controllers\Web\CekUmurWebController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\Web\GaleriController;
use App\Http\Controllers\Web\MediaWebController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GaleriController::class, 'index'])->name('galeri.index');
Route::prefix('galeri')->group(function () {
    Route::get('/{galeri}', [GaleriController::class, 'show'])->name(
        'galeri.show'
    );
    Route::get('/edit/{galeri}', [GaleriController::class, 'edit'])->name(
        'galeri.edit'
    );
    Route::post('/', [GaleriController::class, 'store'])->name('galeri.store');
    Route::patch('/{galeri}', [GaleriController::class, 'update'])->name(
        'galeri.update'
    );
    Route::delete('/{galeri}', [GaleriController::class, 'destroy'])->name(
        'galeri.destroy'
    );
});

Route::prefix('media')->group(function () {
    Route::get('/', [MediaWebController::class, 'index'])->name('media.index');
    Route::get('/{media}', [MediaWebController::class, 'show'])->name(
        'media.show'
    );
    Route::post('/', [MediaWebController::class, 'store'])->name('media.store');
    Route::patch('/{media}', [MediaWebController::class, 'update'])->name(
        'media.update'
    );
    Route::delete('/{media}', [MediaWebController::class, 'destroy'])->name(
        'media.destroy'
    );
});

Route::prefix('cek_umur')->group(function () {
    Route::get('/', [CekUmurWebController::class, 'index'])->name(
        'cekumur.index'
    );
    Route::get('/{cekumur}', [CekUmurWebController::class, 'show'])->name(
        'cekumur.show'
    );
    Route::post('/', [CekUmurWebController::class, 'store'])->name(
        'cekumur.store'
    );
    Route::patch('/{cekumur}', [CekUmurWebController::class, 'update'])->name(
        'cekumur.update'
    );
    Route::delete('/{cekumur}', [CekUmurWebController::class, 'destroy'])->name(
        'cekumur.destroy'
    );
});

Route::prefix('jenis_syarat')->group(function () {
    Route::get('/', [JenisSyaratController::class, 'index'])->name(
        'jenissyarat.index'
    );
    Route::get('/{jenissyarat}', [JenisSyaratController::class, 'show'])->name(
        'jenissyarat.show'
    );
    Route::post('/', [JenisSyaratController::class, 'store'])->name(
        'jenissyarat.store'
    );
    Route::patch('/{jenissyarat}', [
        JenisSyaratController::class,
        'update',
    ])->name('jenissyarat.update');
    Route::delete('/{jenissyarat}', [
        JenisSyaratController::class,
        'destroy',
    ])->name('jenissyarat.destroy');
});