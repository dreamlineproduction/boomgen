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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['middleware' => 'cors'], function()
// {
//   Route::middleware('cors')->post('login', 'UsersController@login');
  
// });

// Route::post('login', 'UsersController@login')->middleware('cors');

Route::post('login', 'UsersController@login');
Route::post('forgotpassword', 'UsersController@forgotpassword');
Route::post('verifyotp', 'UsersController@verifyotp');
Route::post('changepasswordafterverified', 'UsersController@changepasswordafterverified');
Route::post('updateprofile', 'UsersController@updateprofile');
Route::post('getcoupons', 'CouponController@getcoupons');
Route::post('getads', 'AdsController@getads');
Route::post('getredeemedcoupons', 'CouponController@getredeemedcoupons');
Route::post('getredeemedcoupondetails', 'CouponController@getredeemedcoupondetails');
Route::post('getcoupondetails', 'CouponController@getcoupondetails');
Route::post('redeemcoupon', 'UserlistController@redeemcoupon');
