<?php

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

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::resource('issues','IssuesController')->middleware('auth');
Route::get('/index','IssuesController@index');
Route::get('/issues','IssuesController@getAdd');
Route::post('/index','IssuesController@store');
Route::post('/issues','IssuesController@update');

