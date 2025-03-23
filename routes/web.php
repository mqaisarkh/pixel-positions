<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', [JobController::class, 'index'])->name('home');

Route::get('/jobs/create', [JobController::class, 'create'])->middleware('auth');
Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');
Route::get('/jobs/{job}', [JobController::class, 'show'])->middleware('auth')->name('jobs.show');
Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->middleware('auth')->name('jobs.edit');
Route::patch('/jobs/{job}', [JobController::class, 'update'])->middleware('auth')->name('jobs.update');
Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->middleware('auth')->name('jobs.destroy');



Route::get('/search', SearchController::class);
Route::get('/tags/{tag:name}', TagController::class);

Route::middleware('guest')->group(function() {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create']);
    Route::post('/login', [SessionController::class, 'store']);
});

Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');

