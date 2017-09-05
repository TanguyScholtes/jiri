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
Route::resource( 'events', 'EventsController' )->middleware('auth');
Route::get( 'events/{event}/delete', 'EventsController@delete' ) -> name( 'events.delete' )->middleware('auth');

/*** PROJECTS ***/
Route::resource( 'projects', 'ProjectsController' )->middleware('auth');
Route::get( 'projects/{project}/delete', 'ProjectsController@delete' ) -> name( 'projects.delete' )->middleware('auth');

/*** USERS ***/
Route::resource( 'users', 'UsersController' )->middleware('auth');
Route::get( 'users/{user}/delete', 'UsersController@delete' ) -> name( 'users.delete' )->middleware('auth');

/*** STUDENTS ***/
Route::resource( 'students', 'StudentsController' )->middleware('auth');
Route::get( 'students/{student}/delete', 'StudentsController@delete' ) -> name( 'students.delete' )->middleware('auth');

/*** SCORES ***/
Route::resource( 'scores', 'ScoresController' )->middleware('auth');
Route::get( 'scores/{score}/delete', 'ScoresController@delete' ) -> name( 'scores.delete' )->middleware('auth');
