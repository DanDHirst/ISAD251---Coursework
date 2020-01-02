<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProductManagement extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //returns all the products from the database
        $products = \App\GetMenu::all();
        return view('adminProducts', compact('products'));
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
        // different types of actions depending on what the user wants
        //
        if($request->action == "save"){
            $prodID = $request->ProdID;
            $prodName = $request->ProdName;
            $quantity = $request->Quantity;
            $price = $request->Price;
            // this statement updates the products
            DB::select('CALL UpdateProduct(?,?,?,?)', array($prodName, $quantity, $price, $prodID));
        }
        elseif ($request->action == "delete"){
            $prodID = $request->ProdID;
            // this remove a products from availibility
            DB::select('CALL withdrawProduct(?)', array($prodID));
        }
        if($request->action == "add"){
            $prodName = $request->ProdName;
            $quantity = $request->Quantity;
            $price = $request->Price;
            if($request->isSnack){
                $isSnack = 1;
            }
            else{
                $isSnack = 0;
            }
            //this adds a product into the database
            DB::select('CALL addProduct(?,?,?,?,?)', array($prodName, $quantity, $price, 1, $isSnack));
        }

        return redirect('adminProducts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
