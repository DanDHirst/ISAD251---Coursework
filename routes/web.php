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

//Route::get('/', function () {
//    return view('home');
//});
Route::get('menu', 'HomePage@showPageMenu');

//Route::get('order', 'CustomerOrderManagment@showProducts');
Route::resource('order', 'CustomerOrderManagment');
Route::resource('viewOrder', 'CustomerOrderSearch');
Route::resource('adminCustomer', 'AdminOrderManagment');
Route::resource('adminProducts', 'ProductManagement');
Route::get('admin', function (){
//    a default test insert
//    DB::insert("insert into customers( CusName) VALUES (?)", ["andrew"]);
//    a test for updating the customer table
//   DB::update('update customers set cusName = "Daniel" where cusName=  ?', ["dan"]);
    // test to delete a customer
//    DB::delete('delete from customers where cusName = ?', ["john"]);
   // DB::select("CALL withdrawProduct(3)");
    // use to use transactions
    return view('admin');
});

//Route::get('order', function (){
//    return view('order');
//});
//Route::get('adminProducts', function (){
//    return view('adminProducts');
//});
//Route::get('adminCustomer', function (){
//    return view('adminCustomer');
//});
//Route::get('viewOrder', function (){
//    return view('viewOrder');
//});
Route::get('home', function (){
    return view('home');
});
Route::get('/', function (){
    return view('home');
});

//test views
Route::get('/viewProducts', function (){
    $products = \App\Pub_Product::all();

    foreach ($products as $product){
        return $product->ProdName;
    }
});
//Route::get("api","GetProductsController@index");
//Route::post("api/insert","GetProductsController@store");



