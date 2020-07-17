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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/yourEvent', 'EventController@viewYourEvent')->name('yourEvent');
Route::resource('categories','CategoryController');
Route::get('/search','CategoryController@searchBar')->name('searchBar');
Route::resource('events','EventController');
Route::get('explore','EventController@showExploreEventView')->name('showExploreEventView');