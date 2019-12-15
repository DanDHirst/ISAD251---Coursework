<?php

namespace App\Http\Controllers;

use App\getProducts;
use Illuminate\Http\Request;

class GetProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $products = \App\GetMenu::all();
        return $products;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $prodName = $request->input("ProdName");
        $quantity = $request->input("Quantity");
        $price = $request->input("Price");
        $isSnack = $request->input("isSnack");
        DB::select('CALL addProduct(?,?,?,?,?)', array($prodName, $quantity, $price, 1, $isSnack));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\getProducts  $getProducts
     * @return \Illuminate\Http\Response
     */
    public function show(getProducts $getProducts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\getProducts  $getProducts
     * @return \Illuminate\Http\Response
     */
    public function edit(getProducts $getProducts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\getProducts  $getProducts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, getProducts $getProducts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\getProducts  $getProducts
     * @return \Illuminate\Http\Response
     */
    public function destroy(getProducts $getProducts)
    {
        //
    }
}
