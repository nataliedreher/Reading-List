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
    return view('main');
});

Route::get('/reading-list', function () {
    $readingList = ['Dune', 'Frankenstein', '1984'];

    return view('list', ['readingList' => $readingList]);
});

Route::get('/add', function () {
    return view('add');
});
