<?php

use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
use Illuminate\Support\Facades\Route;

Route::get('/sign-in', SignInController::class)
    ->name('auth.sign-in');

Route::post('/sign-in', [SignInController::class, 'handle'])
    ->name('auth.sign-in.handle');

Route::get('/sign-up', SignUpController::class)
    ->name('auth.sign-up');

Route::post('/sign-up', [SignUpController::class, 'handle'])
    ->name('auth.sign-up.handle');

Route::get('/logout', [SignInController::class, 'logout'])
    ->name('auth.logout');
