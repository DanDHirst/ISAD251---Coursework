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
        //
        $results = \App\GetMenu::all();
//        $menu = [];
//        foreach($results as $item){
//            array_push($menu,$item->ProdName . "  £". $item->Price );
//        }
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
        $itemList = json_decode($request->itemList);
//        foreach ($itemList->data as $item){
//            echo $item->ProdID . $item->ProdName . $item->Quantity . $item->Price ;
//        }
        DB::select('CALL addOrder (?, ?, ?)', array($request->comments,$request->tableNumber, $request->email));
        $orderID = DB::raw('CALL getOrderID(?)', array($request->email));
        foreach ($orderID as $id){
            echo $id->OrderID;
        }
        $results = \App\GetMenu::all();
        foreach ($results as $ids){
            echo $ids->ProdID;
        }
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
        return "this is show method";
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
