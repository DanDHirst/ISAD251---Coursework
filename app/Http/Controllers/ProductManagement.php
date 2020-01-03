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
            $filteredProdID = filter_var($request->ProdID, FILTER_SANITIZE_STRING);
            $filteredProdName = filter_var($request->ProdName, FILTER_SANITIZE_STRING);
            $filteredQuantity = filter_var($request->Quantity, FILTER_SANITIZE_STRING);
            $filteredPrice = filter_var($request->Price, FILTER_SANITIZE_STRING);
            // this statement updates the products
            DB::select('CALL UpdateProduct(?,?,?,?)', array($filteredProdName, $filteredQuantity, $filteredPrice, $filteredProdID));
        }
        elseif ($request->action == "delete"){
            $prodID = $request->ProdID;
            // this remove a products from availibility
            DB::select('CALL withdrawProduct(?)', array($prodID));
        }
        if($request->action == "add"){
            $filteredProdName = filter_var($request->ProdName, FILTER_SANITIZE_STRING);
            $filteredQuantity = filter_var($request->Quantity, FILTER_SANITIZE_STRING);
            $filteredPrice = filter_var($request->Price, FILTER_SANITIZE_STRING);
            if($request->isSnack){
                $isSnack = 1;
            }
            else{
                $isSnack = 0;
            }
            //this adds a product into the database
            DB::select('CALL addProduct(?,?,?,?,?)', array($filteredProdName, $filteredQuantity, $filteredPrice, 1, $isSnack));
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
