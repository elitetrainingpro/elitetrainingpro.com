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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('athletes', 'PagesController@getAthletes');
Route::get('coachcalendar', 'PagesController@getCoachCalendar');
Route::get('notifications', 'PagesController@getNotifications');
Route::get('athletecalendar', 'PagesController@getAthleteCalendar');
Route::get('goals', 'PagesController@getGoals');
Route::get('schedule', 'PagesController@getSchedules');
Route::resource('findtrainer', 'FindTrainerController');
Route::resource('bios', 'BioController');