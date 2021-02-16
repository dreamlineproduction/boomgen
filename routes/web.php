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

// Route::get('/', function () {
//     return view('home');
// });
Auth::routes();
Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/userlist', 'UsersController@index')->name('userlist');
    Route::get('/redeemeduserlist', 'UserlistController@index')->name('redeemeduserlist');
    Route::get('/createuser', 'UsersController@createuserpage')->name('createuser');
    Route::post('/createuser', 'UsersController@createuser')->name('createuser');
    Route::post('/updateuser', 'UsersController@updateuser')->name('updateuser');
    Route::get('/createcoupon', 'CouponController@couponpage')->name('coupon');
    Route::get('/coupon', 'CouponController@couponlist')->name('coupon');
    Route::get('/adslist', 'AdsController@adslist')->name('adslist');
    Route::get('/createads', 'AdsController@createadspage')->name('createads');
    Route::post('/createads', 'AdsController@createads')->name('createads');
    Route::post('/createcoupon', 'CouponController@createcoupon')->name('createcoupon');
    Route::get('/changepassword', 'UsersController@changepasswordpage')->name('changepassword');
    Route::post('/changePassword','UsersController@changePassword')->name('changePassword');
    Route::post('/blockuser', 'UsersController@blockuser')->name('blockuser');
    Route::post('/deleteuser', 'UsersController@deleteuser')->name('deleteuser');
    // Route::get('/login', 'UsersController@loginpage')->name('login');
    // Route::post('/login', 'UsersController@loginWeb')->name('login');
    
    Route::get('/edituserlist/{id}', 'UserlistController@edituserlist')->name('edituserlist');
    Route::get('/edituser/{id}', 'UsersController@edituser')->name('edituser');
    Route::get('/viewcoupon/{id}', 'CouponController@viewcoupon')->name('viewcoupon');
    Route::get('/viewuser/{id}', 'UserlistController@viewuser')->name('viewuser');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout'); 
    Route::get('email', function(){
        return View('email'); // Your Blade template name
    });
});