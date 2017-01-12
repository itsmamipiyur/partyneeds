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

/*
Route::get('/', function () {
    return view('welcome');
});*/

Route::post('/', 'LoginController@checkAccount');
Route::get('/', 'LoginController@index');
Route::get('/logout', 'LoginController@logoutAccount');

Route::post('/customer/customer_update', 'CustomerController@customer_update');
Route::post('/customer/customer_restore', 'CustomerController@customer_restore');

Route::post('/equipmentType/equipmentType_update', 'EquipmentTypeController@equipmentType_update');
Route::post('/equipmentType/equipmentType_restore', 'EquipmentTypeController@equipmentType_restore');

Route::post('/equipment/equipment_update', 'EquipmentController@equipment_update');
Route::post('/equipment/equipment_restore', 'EquipmentController@equipment_restore');


Route::group(['middleware' => ['web']], function(){
    Route::resource('customer', 'CustomerController');
    Route::resource('food', 'FoodController');
    Route::resource('equipment', 'EquipmentController');
    Route::resource('equipmentType', 'EquipmentTypeController');
    Route::resource('staff', 'StaffController');
    Route::resource('package', 'PackageController');
});
