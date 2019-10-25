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

Route::get('adminDashboard', 'MenuController@adminDashboard');

Route::get('/', 'LoginController@index')->name('login');

Route::get('createUserPage', 'MenuController@createUserPage');

Route::get('allShift', 'MenuController@allShifts');

Route::get('Notifications', 'MenuController@NotificationPage');

Route::get('view_receipt', 'MenuController@Receipts');

Route::get('addHotelDetails', 'MenuController@addHotelDetails');

Route::get('salesActivityReport', 'MenuController@salesActivityReport');

Route::get('assign_shift','MenuController@Assign_Shift');

Route::get('editShift','MenuController@editShift');

Route::get('addShift', 'MenuController@addShift');

Route::get('loyalty_page', 'MenuController@loyalty_page');

Route::get('listOfDebtors', 'MenuController@listOfDebtors');

Route::get('customer_list', 'MenuController@customerListPage');

Route::get('view_customer_detail', 'MenuController@view_customer_detail');

Route::get('bestPerformingDepts', 'MenuController@BestPerformingDepts');

Route::get('customer_activities', 'MenuController@customer_activities');

Route::get('top100Customers', 'MenuController@top100Customers');

Route::get('Top100Rooms', 'MenuController@Top100Rooms');

Route::get('room_list', 'MenuController@allRoomList');

Route::get('allUsers', 'MenuController@allUsers');

Route::get('user_profile', 'MenuController@UserProfile');

Route::get('editUser', 'MenuController@editUser');

Route::get('addToStore', 'MenuController@addToStore');

Route::get('allStock', 'MenuController@allStock');

Route::get('editStore', 'MenuController@editStorePage');

Route::get('addRoomType', 'MenuController@addRoomType');

Route::get('allRoomType', 'MenuController@allRoomType');

Route::get('editRoom_ty', 'MenuController@editRoomType');

Route::get('addFoodType', 'MenuController@addFoodType');

Route::get('allFoodType', 'MenuController@allFoodType');

Route::get('editFoodType', 'MenuController@editFoodType');

Route::get('makeSalesRestaurant', 'MenuController@makeSalesRestaurant');

Route::get('allSalesRestuarant','MenuController@allSalesRestuarant');

Route::get('editSalesRestuarant','MenuController@editSalesRestuarant');

Route::get('collectFromStore','MenuController@collectFromStore');

Route::get('allStoreCollections','MenuController@allStoreCollections');

Route::get('editStoreCollections','MenuController@editStoreCollections');

Route::get('SellRooms','MenuController@SellRooms');

Route::get('allSoldRooms','MenuController@allSoldRooms');

Route::get('editSoldRoom','MenuController@editSoldRoom');

Route::get('addPoolSales','MenuController@addPoolSales');

Route::get('addDrinkType','MenuController@addDrinkType');

Route::get('allPoolSales','MenuController@allPoolSales');

Route::get('editPoolSales','MenuController@editPoolSales');

Route::get('allDrinkTypes','MenuController@allDrinkTypes');

Route::get('editDrinkType','MenuController@editDrinkType');

Route::get('addDrinkType','MenuController@addDrinkType');

Route::get('makeSalesDrink','MenuController@makeSalesDrinks');

Route::get('allSalesDrink','MenuController@allSalesDrink');

Route::get('editSalesDrink','MenuController@editSalesDrink');

Route::get('profit_view','MenuController@profit_view');

Route::get('allSoldFood','MenuController@allSoldFood');

Route::get('ShoppingCartPage','MenuController@ShoppingCartPage');

Route::get('room-detail','MenuController@RoomDetails');

Route::get('editSoldFood','MenuController@editSoldFood');

Route::get('Dashboard','MenuController@Dashboard');

Route::get('PasswordChange','forgotPassController@PasswordChange');

Route::get('forgot_password','forgotPassController@index');

Route::get('logout','LoginController@logout');

Route::get('AddRoomCondition','MenuController@AddRoomCondition');

//Route::get('search_food','FoodTypeController@search_food');


//Route::get('editCollectFromStore','MenuController@editCollectFromStore');



