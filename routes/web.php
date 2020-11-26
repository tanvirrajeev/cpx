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
        Route::get('statuslist', 'OrderController@statuslist')->name('order.statuslist');
        Route::get('tracking', 'OrderController@tracking')->name('order.tracking');
        Route::get('getstatusmodal', 'OrderController@getstatusmodal')->name('order.getstatusmodal');
        Route::post('chgstatusmodal', 'OrderController@chgstatusmodal')->name('order.chgstatusmodal');
        Route::get('getorder', 'OrderController@getorder')->name('order.getorder');
        Route::get('gethistory', 'OrderController@gethistory')->name('order.gethistory');
        Route::resource('billing', 'BillingController');
        Route::get('billinglist', 'BillingController@billinglist')->name('billing.billinglist');
        Route::get('spchargelist', 'BillingController@shippingchargelist')->name('billing.shippingchargelist');
        // Route::get('entry', 'BillingController@billentry')->name('billentry');
        Route::get('billing/{id}/entry', 'BillingController@billentry')->name('billentry');
        Route::resource('search', 'SearchController');
        Route::get('awb', 'SearchController@getawb')->name('search.awb');
        Route::post('statusupdate', 'SearchController@statusupdate')->name('search.statusupdate');
        Route::get('searchorderview', 'SearchController@orderview')->name('search.orderview');
        Route::get('searchorder', 'SearchController@searchorder')->name('search.searchorder');
        // Route::post('searchorderr', 'SearchController@order')->name('search.postorder');
        // Route::get('datatable', 'SearchController@datatable')->name('search.datatable');
        // Route::get('searchorderview', 'SearchController@searchorderview')->name('search.searchorderview');
        Route::get('searchorderdate', 'SearchController@searchorderdate')->name('search.searchorderdate');
        Route::get('searchbillingdate', 'SearchController@searchbillingdate')->name('search.searchbillingdate');
        Route::get('searchbillingexport', 'SearchController@searchbillingexport')->name('search.searchbillingexport');
        // Route::get('searchbilling', 'SearchController@searchbilling')->name('search.searchbilling');
        // Route::get('shippingcharge', 'ShippingchargeController@index')->name('shippingcharge.index');
        // Route::post('shippingcharge', 'ShippingchargeController@index')->name('shippingcharge.store');
        Route::resource('shippingcharge', 'ShippingchargeController');
        Route::get('shippingchargelist', 'ShippingchargeController@shippingchargelist')->name('shipping.shippingchargelist');
        // Route::resource('orderexport', 'OrderexportController');
        Route::get('orderexport', 'OrderexportController@index')->name('orderexport.index');
        Route::get('orderexport_view', 'OrderexportController@orderexport_view')->name('orderexport.orderexport_view');

        Route::resource('employee', 'EmployeeController');
        Route::get('userlist', 'EmployeeController@userlist')->name('employee.userlist');


});

Route::group([ 'as'=>'branch.', 'prefix' => 'branch', 'namespace'=>'Branch', 'middleware'=>['auth','branch']],
    function (){
        // Route::get('home','HomeController@index')->name('home');
        Route::get('dashboard', 'OrderController@dashboard')->name('dashboard');
        // Route::get('/', 'OrderController@dashboard')->name('home');
        Route::get('cpx','CpxController@index')->name('cpx');
        Route::resource('order', 'OrderController');
        Route::get('orderlist', 'OrderController@orderlist')->name('order.orderlist');
        Route::get('dashboardlist', 'OrderController@dashboardlist')->name('order.dashboardlist');
        Route::get('statuslist', 'OrderController@statuslist')->name('order.statuslist');
        Route::get('tracking', 'OrderController@tracking')->name('order.tracking');
        Route::get('getstatusmodal', 'OrderController@getstatusmodal')->name('order.getstatusmodal');
        Route::post('chgstatusmodal', 'OrderController@chgstatusmodal')->name('order.chgstatusmodal');
        Route::get('getorder', 'OrderController@getorder')->name('order.getorder');
        Route::get('gethistory', 'OrderController@gethistory')->name('order.gethistory');

        Route::resource('billing', 'BillingController');
        Route::get('billinglist', 'BillingController@billinglist')->name('billing.billinglist');
        Route::get('spchargelist', 'BillingController@shippingchargelist')->name('billing.shippingchargelist');
        // Route::get('entry', 'BillingController@billentry')->name('billentry');
        Route::get('billing/{id}/entry', 'BillingController@billentry')->name('billentry');
        Route::resource('search', 'SearchController');
        Route::get('awb', 'SearchController@getawb')->name('search.awb');
        Route::post('statusupdate', 'SearchController@statusupdate')->name('search.statusupdate');
        Route::get('searchorderview', 'SearchController@orderview')->name('search.orderview');
        Route::get('searchorder', 'SearchController@searchorder')->name('search.searchorder');
        // Route::post('searchorderr', 'SearchController@order')->name('search.postorder');
        // Route::get('datatable', 'SearchController@datatable')->name('search.datatable');
        // Route::get('searchorderview', 'SearchController@searchorderview')->name('search.searchorderview');
        Route::get('searchorderdate', 'SearchController@searchorderdate')->name('search.searchorderdate');
        Route::get('searchbillingdate', 'SearchController@searchbillingdate')->name('search.searchbillingdate');
        Route::get('searchbillingexport', 'SearchController@searchbillingexport')->name('search.searchbillingexport');
        // Route::get('searchbilling', 'SearchController@searchbilling')->name('search.searchbilling');
        // Route::get('shippingcharge', 'ShippingchargeController@index')->name('shippingcharge.index');
        // Route::post('shippingcharge', 'ShippingchargeController@index')->name('shippingcharge.store');
        Route::resource('shippingcharge', 'ShippingchargeController');
        Route::get('shippingchargelist', 'ShippingchargeController@shippingchargelist')->name('shipping.shippingchargelist');
        // Route::resource('orderexport', 'OrderexportController');
        Route::get('orderexport', 'OrderexportController@index')->name('orderexport.index');
        Route::get('orderexport_view', 'OrderexportController@orderexport_view')->name('orderexport.orderexport_view');

        Route::resource('employee', 'EmployeeController');
        Route::get('userlist', 'EmployeeController@userlist')->name('employee.userlist');


});

Route::group([ 'as'=>'customer.', 'prefix' => 'customer', 'namespace'=>'Customer', 'middleware'=>['auth','customer']],
    function (){
        // Route::get('home','HomeController@index')->name('home');
        Route::get('cpx','CpxController@index')->name('cpx');
        Route::resource('order', 'OrderController');
        Route::get('orderlist', 'OrderController@orderlist')->name('order.orderlist');
        Route::get('tracking', 'OrderController@tracking')->name('order.tracking');

});


