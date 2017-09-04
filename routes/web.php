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
    return view('content/home');
});
Route::get('/dashboard', 'DashboardController@main');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*** EVENTS ***/
Route::get('/events', 'EventsController@index')->name('events.index')->middleware('auth');
Route::get('/events/{event}', 'EventsController@show')->name('events.show')->middleware('auth');
