<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\ComputeController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\GainController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\SiteMapController;
use App\Http\Controllers\SwiperController;
use App\Http\Controllers\SearchController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/contact_us', [ContactUsController::class, 'index'])->name('contact_us');

Route::post('/compute', [ComputeController::class, 'index'])->name('compute'); // ->middleware('throttle:1,120')

// Route::post('/compute_result', [ComputeController::class, 'compute_result'])->name('compute_result');
Route::get('/compute_result/{uuid}', [ComputeController::class, 'compute_result'])->name('compute_result');


Route::group(['prefix' => 'gain'], function () {
    Route::get('/{type?}', [GainController::class, 'index'])->name('gain');
    Route::get('{id}/{type}', [GainController::class, 'detail'])->name('gain.detail');
    Route::get('/download/{id}/{title}/{name}', [GainController::class, 'downLoad'])->name('gain.download');
});

Route::get('/link', [LinkController::class, 'index'])->name('link');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/sitemap', [SiteMapController::class, 'index'])->name('sitemap');

Route::group(['prefix' => 'award'], function () {
    Route::get('/', [AwardController::class, 'index'])->name('award');
    Route::get('/{id}', [AwardController::class, 'detail']);
});

Route::get('/swiper', [SwiperController::class, 'swiper_name'])->name('swiper');

Route::get('/search/{keywords}', [SearchController::class, 'index']);

Route::get('/gainType', [GainController::class, 'gainTypeList'])->name('gainType');

Route::fallback(function(){
    return Inertia::render('Error/Index', [
        'title' => '錯誤',
     ])->toResponse(request())->setStatusCode(404);
});