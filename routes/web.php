<?php

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

// Frontend routing handled via HomeController with auth middleware
Route::get('/reading-list', 'HomeController@list')->middleware('auth');
Route::get('/add', 'HomeController@add')->middleware('auth');
Route::post('/create/book', 'HomeController@store');

Auth::routes();
