<?php

use App\Http\Controllers\Auth\SignInController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/sign-in', SignInController::class)
    ->name('auth.sign-in');

Route::post('/sign-in', [SignInController::class, 'handle'])
    ->name('auth.sign-in.handle');

Route::get('/logout', [SignInController::class, 'logout'])
    ->name('auth.logout');
