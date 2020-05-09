<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'orders'], function () {
    Route::get('/getOrders', 'OrdersController@getOrders');
    Route::get('/getUsers', 'OrdersController@getUsers');
    Route::get('/getCities', 'OrdersController@getCities');
    Route::get('/getProducts', 'OrdersController@getProducts');
    Route::post('/saveProducts', 'OrdersController@saveProducts');
    Route::post('/saveOrder', 'OrdersController@saveOrder');
});