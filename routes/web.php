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
	if(Auth::check()){return Redirect::to('home');}
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('athletes-home', 'HomeController@index')->name('home');
Route::get('athletecalendar', 'CalendarController@index');
Route::post('search_code', 'FindTrainerController@search_code');
Route::resource('goals', 'GoalController');
Route::resource('findtrainer', 'FindTrainerController');
Route::resource('athletecalendar', 'CalendarController');
Route::resource('bios', 'BioController');
Route::resource('coachcalendar', 'CoachCalendarController');
Route::resource('coachgoal', 'CoachGoalController');