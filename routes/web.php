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

Route::prefix('requests')->group(function() {
  Route::get('{id}/edit', 'ServiceRequestsController@edit')->name('edit');
  Route::get('create', 'ServiceRequestsController@create')->name('create');
  Route::post('store', 'ServiceRequestsController@create')->name('store');
});
Route::get('/', 'ServiceRequestsController@index')->name('home');
