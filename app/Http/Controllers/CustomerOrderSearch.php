<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CustomerOrderSearch extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // passing in blank arrays so the view doesnt fail
        $orders = [];
        $orderDetails = [];
        // gets all the menu items
        $results = \App\GetMenu::all();

        // send in these variables as null so the program doesnt crash when trying to find the variables
        return view('viewOrder', compact('results','orderDetails','orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        echo "show";

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // check to see if should add a new order Details
        if(
            $request->has('ProductID')
        ){
            //sanitise the outputs for any html code
            $filteredOrderID = filter_var($request->OrderID, FILTER_SANITIZE_STRING);
            $filteredProdID = filter_var($request->ProductID, FILTER_SANITIZE_STRING);
            $filteredQty = filter_var($request->Quantity, FILTER_SANITIZE_STRING);
            $filteredPrice = filter_var($request->Price, FILTER_SANITIZE_STRING);

            //echo $orderID. $prodID. $qty. $price;

            DB::select('CALL addOrderDetails(?,?,?,?)', array($filteredOrderID, $filteredProdID, $filteredQty, $filteredPrice));



        }
        // returns a list of orders using the order id Gathered amd email gathered
        $orders = DB::select('CALL getOrder(?,?)', array($request->orderID,$request->email));
        $orderID = $request->orderID;
        // if the order ID is null get the orderID using the email
        if ($orderID == null){
            $orderID = DB::select('CALL getOrderID(?)', array($request->email));
        }
        // returns a list of order details using the order ID
        $orderDetails = DB::select('CALL getOrderDetails(?)', array($request->orderID));
        $results = \App\GetMenu::all();
        return view('viewOrder', compact('results','orderDetails','orders'));


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
        DB::select('CALL deleteOrderDetails(?)', array($id));
        return redirect("viewOrder");
        $orders = [];
        $orderDetails = [];
        $results = \App\GetMenu::all();

        // send in these variables as null so the program doesnt crash when trying to find the variables
        return view('viewOrder', compact('results','orderDetails','orders'));


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
        echo "edit";
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
        echo"update";
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

        return view('viewOrder', compact('results','orderDetails','orders'));
    }
}
