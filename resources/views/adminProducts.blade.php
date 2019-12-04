
@extends('layout.app')
@section('header')
    <main>
        <div style="height: 100px"></div>
        <section>
            <form>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>ItemName</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div><button class="btn btn-primary" type="submit">Sumbit products</button></form>
        </section>
        <section class="clean-block clean-form dark"></section>
    </main>
    @section('footer')
