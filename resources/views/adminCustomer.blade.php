
@extends('layout.app')
@section('header')
    <main class="page">
        <section class="clean-block about-us">
            <div class="container">
                <div class="block-heading"><small class="form-text text-muted">Enter email address&nbsp;</small>
                    <form method="post" action="adminCustomer">
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
                            <tbody>
                            @foreach($orderDetails as $orderDetail)
                                <tbody>
                                <tr>
                                    <td>{{$orderDetail->OrderDetailsID}}</td>
                                    <td>{{$orderDetail->OrderID}}</td>
                                    <td>{{$orderDetail->ProdID}}</td>
                                    <td>{{$orderDetail->Qty}}</td>
                                    <td>{{$orderDetail->Price}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @section('footer')
