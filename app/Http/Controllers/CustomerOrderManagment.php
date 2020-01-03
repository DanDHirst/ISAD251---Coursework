<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CustomerOrderManagment extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //on load show all the menu items
        $results = \App\GetMenu::all();
        return view('order', compact('results'));
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

        // decodes json data from order web page
        $itemList = json_decode($request->itemList);
//        foreach ($itemList->data as $item){
//            echo $item->ProdID . $item->ProdName . $item->Quantity . $item->Price ;
//        }
        // calls the addOrder with a prepared statement
        //sanitise the outputs for any html code
        $filteredComments = filter_var($request->comments, FILTER_SANITIZE_STRING);
        $filteredTableNumber = filter_var($request->tableNumber, FILTER_SANITIZE_STRING);
        $filteredEmail = filter_var( $request->email, FILTER_SANITIZE_STRING);

        DB::select('CALL addOrder (?, ?, ?)', array($filteredComments,$filteredTableNumber,$filteredEmail));
        $orderID = DB::select('CALL getOrderID(?)', array($request->email));

        foreach ($orderID as $id){
             $orderID = $id->OrderID;
        }
        // calls the add order details for all the items using a prepared statement
        foreach ($itemList->data as $item) {
            DB::select('CALL addOrderDetails(?,?,?,?)', array($orderID,$item->ProdID,$item->Quantity, $item->Price));
        }
        // outputs the order details to a webpage
        echo "<h1> Order Sucessfully placed </h1><br>";
        echo "Your OrderID is ". $orderID;
        echo "<br> Your Items: ";
        echo "<ul>";
        //print out all items
        $total= 0;
        foreach ($itemList->data as $item) {
            echo "<li> Product name: " . $item->ProdName . " Quantity: " . $item->Quantity . " Item price: ". $item->Price . "</li> <br>";
            $total = $total + ($item->Quantity* $item->Price);
        }
        echo "</ul>";
        echo "<li>" . "Total Price: £". $total ."</li><br>";
        echo "<h1><a href=\"home\">Click here once finsihed to head back to the home page</a></h1>" ;
//        echo "datais " . $itemList->data[0]-> ProdID;
//        return $request->all();
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
    public function showProducts()
    {
        $results = \App\GetMenu::all();
//        $menu = [];
//        foreach($results as $item){
//            array_push($menu,$item->ProdName . "  £". $item->Price );
//        }
        return view('order', compact('results'));
    }
}
