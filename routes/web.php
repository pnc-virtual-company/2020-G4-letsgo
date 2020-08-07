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
Route::delete('removeCategory/{id}', 'CategoryController@removeCategory')->name('remove');
Route::resource('events','EventController');
Route::put('updateEvent/{id}','EventController@updateEvent')->name('updateEvent');
Route::delete('deleteEvent/{id}','EventController@deleteEvent')->name('deleteEvent');
Route::get('explore','EventController@showExploreEventView')->name('showExploreEventView');
Route::get('yourEventsView','EventController@showYourEventView')->name('yourEventsView');
Route::resource('users','UserController');
Route::get('delete{id}', 'UserController@deleteProfile')->name('deleteProfile');
Route::put('editCategory/{id}', 'CategoryController@editCategory');
Route::get('existCategory','CategoryController@existCategory')->name('existCategory');
Route::put('changePassword', 'UserController@changePassword')->name('changePassword');
Route::put('joinEvent/{id}', 'EventController@joinEvent')->name('joinEvent');
Route::get('quitEvent/{id}', 'EventController@quitEvent')->name('quitEvent');
Route::get('calendarView','EventController@calendarView')->name('calendarView');


