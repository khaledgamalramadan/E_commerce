<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Auth;


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']

    ],
    function () {
        Route::group([
            'middleware' => [ 'is_admin'],
            'prefix' =>'/admin'
        ], function () {
            Route::get('/dashboard',[AdminController::class,'index'])->name('dashboard');
            Route::resource('categories',CategoryController::class);
            Route::resource('products',ProductController::class);
        });

        Route::get('/', function () {
            return view('welcome');
        });

        // Route::resource('categories', CategoryController::class);


});






