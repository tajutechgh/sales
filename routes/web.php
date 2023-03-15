<?php

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');  

// User Routes
Route::group(['namespace'=>'User'],function(){

    // product route
    Route::resource('user/product','ProductController'); 

    // sale route
    Route::resource('user/sale','SaleController');

    // expense route
    Route::resource('user/expense','ExpenseController');

    // permission route
    Route::resource('user/permission','PermissionController'); 

    // role route
    Route::resource('user/role','RoleController');

    // user route
    Route::resource('user/user','UserController');
    
    // invoice route
    Route::get('user/invoice','CartController@invoice')->name('invoice'); 
    
    // cart items route
    Route::get('/pos','CartController@pos')->name('pos');
    
    // cart search items route
    Route::get('/searchitem','CartController@searchItem')->name('searchitem');

    // cart routes
    Route::post('/cart-add','CartController@addToCart')->name('addtocart');

    Route::get('/pos-show','CartController@cartShow')->name('showcart');

    Route::get('/delete-cart-product/{rowId}','CartController@removeCartProduct')->name('delete');

    Route::post('/update-cart','CartController@updateCart')->name('update');

    // sales report routes
    Route::get('user/salesreport','ViewController@salesReport')->name('salesreport');

    Route::post('user/searchsalesreport','ViewController@searchsalesReport')->name('searchsalesreport');

    Route::get('user/salesreport/{salesdetails}','ViewController@saleDetails')->name('salesdetails');

    // error route
    Route::get('/pagenotfound','ErrorController@pagenotFound')->name('notfound');

});