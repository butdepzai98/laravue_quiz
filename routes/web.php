<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::namespace('App\Http\Controllers\Frontend')->prefix('exam')->group(function () {
    Route::get('/', 'ExamController@index');
    Route::get('/{id}', 'ExamController@show')->name('exam.show');
    Route::post('/submit/{exam_id}', 'ExamController@submit')->name('exam.submit');
});

Route::namespace('App\Http\Controllers\Frontend')->group(function(){
    Route::get('profile', 'UserController@profile')->name('user.profile');
    Route::get('report/{exam_id}', 'UserController@report')->name('user.report');
});
    