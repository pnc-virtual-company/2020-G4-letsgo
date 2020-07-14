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
Route::resource('categories','CategoryController');
Route::resource('events','EventController');
Route::get('explore','EventController@showExploreEventView')->name('showExploreEventView');
Route::get('yourEventsView','EventController@showYourEventView')->name('yourEventsView');
Route::resource('users','UserController');
Route::get('delete{id}', 'UserController@deleteProfile')->name('deleteProfile');
