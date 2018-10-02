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
//
Route::get('/', 'HomeController@checkAccess')->name('root');


Route::get('/logout', function () {
  Auth::logout();

  return redirect('/');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Admin')->group(function () {
  Route::get('/admin', 'AdminController@index')->name('admin');

  Route::get('/admin/players', 'AdminController@showPlayers')->name('players');

  Route::post('admin/players/add', 'PlayerController@addPlayer')->name('addUser');

  Route::get('admin/players/get/{id}', 'PlayerController@getPlayer')->name('getUser');

  Route::post('admin/players/update', 'PlayerController@updatePlayer')->name('updateUser');

  Route::post('admin/players/delete', 'PlayerController@deletePlayer')->name('deleteUser');

  Route::get('/admin/practice', 'AdminController@showPractice')->name('practice');

  Route::post('admin/practice/add', 'PracticeController@addPractice')->name('addPractice');

  Route::get('admin/practice/get/{id}', 'PracticeController@getPractice')->name('getPractice');

  Route::post('admin/practice/update', 'PracticeController@updatePractice')->name('updatePractice');

  Route::post('admin/practice/delete', 'PracticeController@deletePractice')->name('deletePractice');
});
