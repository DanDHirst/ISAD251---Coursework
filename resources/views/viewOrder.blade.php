
@extends('layout.app')
@section('header')


    <main class="page">
        <section class="clean-block about-us">
            <div class="container">
                <div class="block-heading"><small class="form-text text-muted">Enter email address&nbsp;</small>
                    <form method="post" action="viewOrder">
                        @csrf
                        <input class="form-control" type="email" name="email">
                        <small class="form-text text-muted">OR</small>
                        <small class="form-text text-muted">Enter Order ID</small>
                        <input class="form-control" type="text" name="orderID">
                        <button id="submitOrder" class="btn btn-primary" type="submit">Find order(s)</button>
                    </form>
                </div>
                <div>
                    <div class="table-responsive">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>OrderID</th>
                                    <th>OrderDate</th>
                                    <th>Completed</th>
                                    <th>Email</th>
                                    <th>Comments</th>
                                    <th>TableNumber</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($orders as $order)
                            <tr>
                                <td>{{$order->OrderID}}</td>
                                <td>{{$order->OrderDate}}</td>
                                <td>{{$order->Completed}}</td>
                                <td>{{$order->Email}}</td>
                                <td>{{$order->Comments}}</td>
                                <td>{{$order->TableNumber}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>OrderDetailID</th>
                                    <th>OrderID</th>
                                    <th>Product ID</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            @foreach($orderDetails as $orderDetail)
                            <tbody>
                            <tr>
                                <td>{{$orderDetail->OrderDetailsID}}</td>
                                <td>{{$orderDetail->OrderID}}</td>
                                <td>{{$orderDetail->ProdID}}</td>
                                <td>{{$orderDetail->Qty}}</td>
                                <td>{{$orderDetail->Price}}</td>
                                <td>
                                    <button class="btn-danger" onclick=removeProd({{$orderDetail->OrderDetailsID}}) }>X
                                    </button>
                                </td>
                            </tr>
                            @endforeach

                            <tr>


                            </tbody>

                        </table>

                        <form method="post" action="viewOrder">
                            @csrf
                        <table class="table">
                        <thead>
                        <tr>
                            <th>OrderID</th>
                            <th>Product ID</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                            <tbody>
                            <tr>

                                <td> <input type="text" name="OrderID" value="" required></td>
                                <td><input type="text" name= "ProductID" value="" required></td>
                                <td><input type="text" name="Quantity" value="" required></td>
                                <td><input type="text" name="Price" value="" required></td>
                                <td><button id="submitOrder" class="btn btn-primary" type="submit">add Item to order</button></td>



                            </tr>
                            </tbody>
                        </table>
                        </form>
                        <ul>
                            @foreach($results as $item)
                                <li style="list-style-type: none;">

                                    ProductID: {{$item->ProdID}} | Name:{{$item->ProdName}} | Price: £{{$item->Price}}


                                </li>
                            @endforeach
                        </ul>




                    </div>
                </div>
            </div>
        </section>
        <form id="formDelete" action="viewOrder">
            <button id="delete" type="submit"></button>

        </form>
    </main>
    <script>
        function removeProd(id){
            document.getElementById("formDelete").action = "viewOrder/" + id;
            document.getElementById("delete").click();
        }
    </script>
    @section('footer')

