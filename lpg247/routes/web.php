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

Route::get('userDashboard', 'UserController@userDashboard');

Route::get('createMarketer', 'MarketersController@createMajorMarketerPage');

Route::get('signup', 'UserController@userSignUp');

Route::get('user_profile', 'UserController@userProfile');

Route::get('marketer_profile', 'MarketersController@marketerProfile');

Route::get('login', 'LoginController@loginPage');

Route::get('admin_login', 'AdminController@adminLoginPage');

Route::get('PasswordChange','ResetPasswordController@passwordChangePage');

Route::get('e_wallet','EWalletController@ewalletPage');

Route::get('add_admin', 'AdminController@addAdminPage');

Route::get('all_admins', 'AdminController@allAdminPage');

Route::get('allMarketers', 'MarketersController@index');

Route::get('/', 'IndexController@index');

Route::get('createSubAccount', 'UserController@createSubAccountPage');

Route::get('allSubAccount', 'SubAccountController@allSubAccount');

Route::get('sub_home', 'SubAccountController@home');

Route::get('addRemission', 'RemissionController@addRemissionPage');

Route::get('logout','LoginController@logout');

Route::get('allSalesRep','SalesRepController@allSalesRepPage');

Route::get('addSalesRepPage','SalesRepController@addSalesRepPage');

Route::get('all_users','UserController@all_usersPage');

Route::get('add_product','ProductController@addProductPage');

Route::get('all_products','ProductController@allProductPage');

Route::get('allMarketersOrdersPage','MarketersController@allMarketersOrdersPage');





