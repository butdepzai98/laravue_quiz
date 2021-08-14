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
Route::prefix('backend')->group(function(){
    Route::get('user', function () {
        return 'Backend user';
    })->middleware('test.middleware');

    Route::get('product', 'ProductController@index');

    Route::get('product/create', 'ProductController@create');

    Route::get('product/{id}', 'ProductController@product');
});
