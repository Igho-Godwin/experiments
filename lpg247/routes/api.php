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


Route::post('pay/logPayment','PaymentController@logPayment');

Route::post('add_product','ProductController@addProduct')->middleware('auth:admin');

Route::put('editProduct','ProductController@editProduct')->middleware('auth:admin');

Route::post('review/create','ReviewController@create');

Route::delete('deleteProduct/{id}','ProductController@deleteProduct');

Route::post('MajorMarketer/create','MarketersController@createMajorMarketer');

Route::post('user/addSubAccount','SubAccountController@create');

Route::get('relatedMarketers','MarketersController@relatedMarketers');

Route::get('getOrders','OrderController@getAllOrders');

Route::get('getSalesReps','SalesRepController@getSalesReps');

Route::post('addUser','UserController@addUser');

Route::post('editUser','UserController@editUser');

Route::post('loginUser','LoginController@authenticate');

Route::post('resetPassword','ResetPasswordController@resetPassword');

Route::put('changePassword','ResetPasswordController@changePassword');

Route::post('admin/create','AdminController@createAdmin');

Route::post('admin/edit','AdminController@editAdmin');

Route::post('admin/login','AdminController@authenticate');

Route::post('admin/addRemission','RemissionController@addRemission');

Route::post('admin/suspend','AdminController@suspendAdmin');

Route::post('admin/unsuspend','AdminController@unsuspendAdmin');

Route::post('subAccount/edit','SubAccountController@edit');

Route::get('getMarketers','MarketersController@getMarketers');

Route::get('getUserData','MarketersController@getUserData');

Route::get('getDistance','MarketersController@getDistance');

Route::post('order/create','OrderController@create');

Route::post('salesRep/create','SalesRepController@create');

Route::put('SalesRep/Verify/{id}','SalesRepController@verifySalesRep');

Route::put('SalesRep/Suspend','SalesRepController@suspendSalesRep');

Route::get('getAllSalesRep','SalesRepController@getAllSalesRep');

Route::get('getAllProducts','ProductController@getAllProducts')->middleware('auth:admin');







