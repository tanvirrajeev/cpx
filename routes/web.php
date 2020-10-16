<?php

use Illuminate\Support\Facades\Route;

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
//     // Alert::success('Hello');
//     return view('welcome');
// });

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

//App Route
// Route::get('/home', 'HomeController@index')->name('home');
Route::get('userlist', 'HomeController@userlist')->name('userlist');

// Route::resource('home', 'OrderController');
// Route::resource('order', 'OrderController');

Route::group([ 'as'=>'admin.', 'prefix' => 'admin', 'namespace'=>'Admin', 'middleware'=>['auth','admin']],
    function (){
        // Route::get('home','HomeController@index')->name('home');
        Route::get('cpx','CpxController@index')->name('cpx');
        Route::resource('order', 'OrderController');
        Route::get('dashboard', 'OrderController@dashboard')->name('dashboard');
        Route::get('orderlist', 'OrderController@orderlist')->name('order.orderlist');
        Route::get('dashboardlist', 'OrderController@dashboardlist')->name('order.dashboardlist');
});

Route::group([ 'as'=>'branch.', 'prefix' => 'branch', 'namespace'=>'Branch', 'middleware'=>['auth','branch']],
    function (){
        // Route::get('home','HomeController@index')->name('home');
        Route::get('cpx','CpxController@index')->name('cpx');
        // Route::resource('order', 'OrderController');
        // Route::get('orderlist', 'OrderController@orderlist')->name('order.orderlist');
});

Route::group([ 'as'=>'customer.', 'prefix' => 'customer', 'namespace'=>'Customer', 'middleware'=>['auth','customer']],
    function (){
        // Route::get('home','HomeController@index')->name('home');
        Route::get('cpx','CpxController@index')->name('cpx');
        Route::resource('order', 'OrderController');
        Route::get('orderlist', 'OrderController@orderlist')->name('order.orderlist');
});
