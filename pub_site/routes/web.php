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
Route::get('/', 'HomePage@showHomePageMenu');

Route::get('admin', function (){
//    a default test insert
//    DB::insert("insert into customers( CusName) VALUES (?)", ["andrew"]);
//    a test for updating the customer table
//   DB::update('update customers set cusName = "Daniel" where cusName=  ?', ["dan"]);
    // test to delete a customer
//    DB::delete('delete from customers where cusName = ?', ["john"]);
    return view('admin');
});

Route::get('order', function (){
    return view('order');
});
Route::get('admin/products', function (){
    return view('products');
});
Route::get('admin/orders', function (){
    return view('adminOrders');
});
Route::get('order/customerOrder', function (){
    return view('customerOrders');
});

//test views
Route::get('/viewProducts', function (){
    $products = \App\Pub_Product::all();

    foreach ($products as $product){
        return $product->ProdName;
    }
});



