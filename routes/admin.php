<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/


/* Admin Routes */
Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

/* Profile Routes */
Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('update/password', [ProfileController::class, 'updatePassword'])->name('password.update');

/* Slider Routes */
Route::resource('slider', SliderController::class);
