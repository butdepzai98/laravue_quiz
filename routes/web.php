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

// Regular Expression in Route
Route::get('{cate}/{id}', function($cate, $id){
    return "Cate: ".$cate." Id: ".$id;
})->where('cate', '[0-9]');


// POST
Route::get('form', function () {
    return view('form');
});

Route::post('user/{id}', function($id){
    return 'Method POST: '.$id;
});

// PUT
Route::put('user/{id}', function($id){
    return 'Method PUT: '.$id;
});

// DELETE
Route::delete('delete/{id}', function($id){
    return 'Method Delete: '.$id;
});

// Options
Route::options('options', function(){
    return "Method Options";
});


// ------------------------- match --------------------------------
Route::match(['get', 'post'], 'profile', function () {
    return "Profile Infomation";
});

// ------------------------- Route->name --------------------------------
Route::get('name/{name}}/cate/{cate}', function($name, $cate){
    return "Name :". $name ." Cate: ". $cate;
})->name('show.name');


// Backend
Route::prefix('backend')->group(function(){
    Route::get('user', function () {
        return 'Backend user';
    })->middleware('test.middleware');

    Route::get('product', function () {
        return 'Backend product';
    });
});