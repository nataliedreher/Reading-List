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

// There's only one home route so using a controller doesn't make sense.
Route::get('/', function () {

    return view('welcome');

})->middleware('auth');

// Frontend routing handled via HomeController with Auth middleware

// Books GET view routes that READ from the DB then display via various sorting methods
Route::get('/books', 'BooksController@index')->middleware('auth');

// Books GET view routes using the SHOW method in a non-standard way to displayed SORTED books
Route::get('/books/show/{sortMethod}', 'BooksController@show')->middleware('auth');

// Books PATCH routes to UPDATE the read_order of the books in the DB
Route::patch('/books/update/{id}', 'BooksController@update')->middleware('auth');

// Books DELETE route to DELETE books from the DB
Route::delete('/books/delete/{id}', 'BooksController@destroy')->middleware('auth');

// Search page GET view route, I chose search for the URI
Route::get('/books/search', 'BooksController@search')->middleware('auth');

// Search page POST route to CREATE a new book in the DB
Route::post('/books', 'BooksController@store')->middleware('auth');

// Laravel generated Authorization routes
Auth::routes();
