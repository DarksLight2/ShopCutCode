<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ThumbnailController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)
    ->name('home');

Route::get('/tt', HomeController::class)
    ->name('product.single');

Route::get('/storage/images/{dir}/{method}/{size}/{file}', ThumbnailController::class)
    ->where('method', 'resize|crop|fit')
    ->where('file', '.+\.(png|jpg|gif|bmp|jpeg)$')
    ->where('size', '\d+x\d+')
    ->name('thumbnail');

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
