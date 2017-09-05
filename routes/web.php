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

/*** PROJECTS ***/
Route::get('/projects', 'ProjectsController@index')->name('projects.index')->middleware('auth');
Route::get('/projects/{project}', 'ProjectsController@show')->name('projects.show')->middleware('auth');

/*** USERS ***/
Route::get('/users', 'UsersController@index')->name('users.index')->middleware('auth');
Route::get('/users/{user}', 'UsersController@show')->name('users.show')->middleware('auth');

/*** STUDENTS ***/
Route::get('/students', 'StudentsController@index')->name('students.index')->middleware('auth');
Route::get('/students/{student}', 'StudentsController@show')->name('students.show')->middleware('auth');
