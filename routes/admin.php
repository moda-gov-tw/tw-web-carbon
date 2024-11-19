<?php

use App\Http\Controllers\Admin\ResetPasswordController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::middleware('auth', 'verified')->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/resetpassword', [ResetPasswordController::class, 'index'])->name('admin.resetpassword');
    });
});

Route::middleware('auth', 'verified')->group(function () {
});

require __DIR__ . '/auth.php';
