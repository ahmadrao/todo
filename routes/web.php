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



Auth::routes();

// Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'TodoController@home');

// Route::resource('/todo', 'TodoController')->except('show');
// Route::get('/todo/{slug}', 'TodoController@show')->name('todo.show');

Route::resource('/todo', 'TodoController');
