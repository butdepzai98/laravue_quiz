<?php

use GuzzleHttp\Middleware;
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

// Backend
Route::namespace('Backend')->prefix('backend')->group(function(){
    Route::get('user', function () {
        return 'Backend user';
    })->middleware('test.middleware', 'verify.middleware');

    Route::get('product', 'ProductController@index')->name('backend.product');

    Route::get('product/create', 'ProductController@create')->name('backend.product.create');

    Route::get('product/{id}', 'ProductController@product');

    Route::get('/', 'DaskboardController@index');
});
