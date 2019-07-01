<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::namespace('API')->group(function() {
  Route::resource('vehicle-make', 'VehicleMakeController')
       ->only(['index'])
       ->names(['index' => 'vehicle-make.list']);
  Route::resource('vehicle-model', 'VehicleModelController')
       ->only(['index'])
       ->names(['index' => 'vehicle-model.list']);
  Route::delete('service-requests/{id}', 'ServiceRequestsController@destroy')->name('service-request.delete');
});
