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
Route::get('/', ['middleware' => 'guest', function(){
    return view('welcome');
}])->name('inicio');

Route::get('events', 'EventController@get_events');
Route::get('otrosEventos', 'EventController@otrosIndex');
Route::get('otrosEvents', 'EventController@get_other_events');
Route::post('calendar/updEvento', 'EventController@update_events');

Route::resource('eventos', 'EventController')->except(['update']);
Route::post('eventos/delete/{id}', 'EventController@destroy');
Route::post('calendar/update', 'EventController@update');

// Authentication Routes
Auth::routes();

Route::get('home', 'HomeController@index')->name('home');
