<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
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

Route::get('/forgot-password', ForgotPasswordController::class)
    ->name('auth.forgot-password');

Route::get('/forgot-password/sent', [ForgotPasswordController::class, 'sent'])
    ->name('passwords.sent');

Route::post('/forgot-password', [ForgotPasswordController::class, 'handle'])
    ->name('auth.forgot-password.handle');

Route::get('/reset-password/{token}', ResetPasswordController::class)
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'handle'])
    ->name('password.reset.handle');
