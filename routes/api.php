<?php

use Illuminate\Support\Facades\Route;

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

// CUSTOMER
Route::prefix('customer')->group(function () {
    Route::post('register', 'Customers\API\APIUserController@register');
    Route::post('login', 'Customers\API\APIUserController@login');
    Route::post('updateUser', 'Customers\API\APIUserController@updateUser');
    Route::delete('logout', 'Customers\API\APIUserController@logout');
   
    // Update Profile 'user/update'
    // Route::post('/update', 'userController@update');
});

Route::prefix('ebook')->group(function () {
    Route::get('listebook/{limit}/{offset}', 'Customers\API\APIEbookController@index');
    Route::get('detailebook/{id}', 'Customers\API\APIEbookController@show');    
    Route::post('searchebook/{limit}/{offset}', 'Customers\API\APIEbookController@find');
});

Route::prefix('video')->group(function () {
    Route::get('listvideo/{limit}/{offset}', 'Customers\API\APIVideoController@index');
    Route::get('detailvideo/{id}', 'Customers\API\APIVideoController@show');    
    Route::post('searchvideo/{limit}/{offset}', 'Customers\API\APIVideoController@find');
});
