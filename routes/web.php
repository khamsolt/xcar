<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ModelController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::resource('/brand', BrandController::class);
        Route::resource('/model', ModelController::class);
        Route::resource('/car', CarController::class);
    });
