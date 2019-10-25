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

Route::get('AddRoomCondition','MenuController@AddRoomCondition');

Route::post('SendReceiptToCustomer','MenuController@SendReceiptToCustomer');

Route::post('AddShift','ShiftController@addShift');

Route::post('addHotelDetails', 'HotelDetailsController@addHotelDetails');

Route::post('retrieveCustomerData','MenuController@retrieveCustomerData');

Route::post('deleteShift','ShiftController@deleteShift');

Route::post('editShift','ShiftController@editShift');

Route::post('suspendUser/{id}','UserController@suspendUser');

Route::get('update_loyalty_page', 'LoyaltyController@update_loyalty_data');

Route::post('edit_customer','CustomerController@editCustomer')->middleware('auth:api');

Route::get('AddRoomCondition_batch','MenuController@AddRoomCondition_batch');

Route::post('LoginUser', 'LoginController@authenticate');

Route::post('forgotPass', 'forgotPassController@SendPasswordLink');

Route::post('changePassword', 'forgotPassController@changePassword');

Route::post('addUser', 'UserController@addUser')->middleware('auth:api');

Route::get('getCity', 'MenuController@getCity');

Route::get('getStates', 'MenuController@getStates');

Route::get('addQty', 'MenuController@addQty');

Route::post('deleteUser/{id}', 'UserController@deleteUser')->middleware('auth:api');

Route::post('editUser', 'UserController@editUser')->middleware('auth:api');

Route::post('add-ToStore', 'StoreController@addToStore')->middleware('auth:api');

Route::post('editStock', 'StoreController@editStore')->middleware('auth:api');

Route::post('deleteStock/{id}', 'StoreController@deleteStore')->middleware('auth:api');

Route::post('deleteRoomType/{ItemName}', 'RoomTypeController@deleteRoomType')->middleware('auth:api');

Route::post('deleteRestuarantSales/{id}', 'FoodTypeController@deleteSales')->middleware('auth:api');

Route::post('addRoomType', 'RoomTypeController@addRoomType')->middleware('auth:api');

Route::post('editRoomType', 'RoomTypeController@editRoomType')->middleware('auth:api');

Route::post('addfoodType', 'FoodTypeController@addfoodType')->middleware('auth:api');

Route::post('editfoodType', 'FoodTypeController@editfoodType')->middleware('auth:api');

Route::post('deleteFoodType/{id}', 'FoodTypeController@deletefoodType')->middleware('auth:api');

Route::post('make-sales-restuarant', 'FoodTypeController@MakeSales')->middleware('auth:api');

Route::post('editFoodSales', 'FoodTypeController@editFoodSales')->middleware('auth:api');

Route::post('collectFromStore', 'StoreController@collectFromStore')->middleware('auth:api');

Route::post('deleteStoreCollections/{id}', 'StoreController@deleteStoreCollections')->middleware('auth:api');

Route::post('editCollectFromStore', 'StoreController@editStoreCollections')->middleware('auth:api');

Route::post('room-unit-price', 'RoomTypeController@getUnitPrice')->middleware('auth:api');

Route::post('sell-room', 'RoomTypeController@SellRoom')->middleware('auth:api');

Route::post('deleteSoldRooms/{id}', 'RoomTypeController@deleteSoldRooms')->middleware('auth:api');

Route::post('editSold-room', 'RoomTypeController@editSoldRoom')->middleware('auth:api');

Route::post('addPoolSales', 'PoolController@addPoolSales')->middleware('auth:api');

Route::post('editPoolSales', 'PoolController@editPoolSales')->middleware('auth:api');

Route::post('deletePoolSales/{id}', 'PoolController@deletePoolSales')->middleware('auth:api');

Route::post('addDrinkType', 'DrinkController@addDrinkType')->middleware('auth:api');

Route::post('deleteDrinkType/{id}','DrinkController@deleteDrinkType')->middleware('auth:api');

Route::post('editDrinkType', 'DrinkController@editDrinkType')->middleware('auth:api');

Route::post('make-sales-drinks', 'DrinkController@makeSalesDrink')->middleware('auth:api');

Route::post('edit-sales-drinks', 'DrinkController@editSalesDrink')->middleware('auth:api');

Route::post('deleteSalesDrink/{id}','DrinkController@deleteSalesDrink')->middleware('auth:api');

Route::post('LoginAdmin','LoginController@AuthenticateAdmin')->middleware('auth:api');

Route::get('add-to-cart','MenuController@addToCart')->middleware('auth:api');

Route::get('remove-from-cart','MenuController@removeFromCart')->middleware('auth:api');

Route::get('checkOut','MenuController@checkOut')->middleware('auth:api');

Route::get('clearCart','MenuController@clearCart')->middleware('auth:api');

Route::get('getAvailabeRooms','RoomTypeController@getAvailabeRooms')->middleware('auth:api');

Route::get('sellRoom','RoomTypeController@sellRoom')->middleware('auth:api');

Route::get('checkIn','RoomTypeController@checkIn')->middleware('auth:api');

Route::get('temp_checkin','RoomTypeController@checkInTemp')->middleware('auth:api');

//Route::get('editSoldRoom','RoomTypeController@editSoldRoom')->middleware('auth:api');

Route::get('getProfit','RoomTypeController@getProfit');







