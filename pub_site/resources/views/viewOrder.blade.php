
@extends('layout.app')
@section('header')

    <main class="page">
        <section class="clean-block about-us">
            <div class="container">
                <div class="block-heading"><small class="form-text text-muted">Enter email address&nbsp;</small>
                    <form><input class="form-control" type="email"><small class="form-text text-muted">OR</small><small class="form-text text-muted">Enter Order ID</small><input class="form-control" type="text"><button class="btn btn-primary" type="button">Find order(s)</button></form>
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
                            <tbody></tbody>
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
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @section('footer')
