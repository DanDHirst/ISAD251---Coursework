
@extends('layout.app')
@section('header')
    <main>
        <div style="height: 100px"></div>
        <section>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>ItemName</th>
                                <th>Quantity</th>
                                <th>Price(£)</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td> {{$product->ProdID}}</td>
                                <td> <input id="{{$product->ProdID.$product->ProdName}}" value="{{$product->ProdName}}"></td>
                                <td> <input id="{{$product->ProdID.$product->Qty}}" value="{{$product->Qty}}"> </td>
                                <td> <input id="{{$product->ProdID.$product->Price}}" value="{{$product->Price}}"> </td>
                                <td> <button class="btn-info" onclick="saveItem({{$product}})">save</button>
                                    <button class="btn-danger" onclick=deleteItem({{$product->ProdID}}) }>X
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><button class="btn btn-primary" type="submit">Sumbit products</button>
        </section>
        <section class="clean-block clean-form dark"></section>
    </main>
    <form method="post" action="adminProducts" > <!-- save product -->
        @csrf
        <table>
            <thead>
            <tr>
                <th>Product name</th>
                <th>Quantity</th>
                <th>Price(£)</th>
                <th>Is a food item</th>
            </tr>
            </thead>
            <tbody>
            <tr>

                <input id="prodID" name="ProdID" value="" hidden>
                <td><input id="prodName" name="ProdName" value=""></td>
                <td><input type="number" id="quantity" name="Quantity" value=""></td>
                <td><input type="text" id="price" name="Price" value="" onkeypress="return isNumberKey(event)"></td>
                <td><input class="checkbox" type="checkbox" name="isSnack" value=""></td>
                <input id="action" name="action" value="add" hidden>

            </tr>
            </tbody>
        </table>
        <button class="btn btn-primary" id="btnProduct" type="submit">Add item</button>
    </form>
    <script>
        function saveItem(product){
            document.getElementById("prodID").value = product.ProdID;
            var newProdName = document.getElementById(product.ProdID + product.ProdName).value;
            var newQuantity = document.getElementById(String(product.ProdID) + String(product.Qty)).value;
            var newPrice = document.getElementById(String(product.ProdID) + String(product.Price)).value;
            document.getElementById("prodName").value =newProdName;
            document.getElementById("quantity").value =newQuantity;
            document.getElementById("price").value = newPrice;
            document.getElementById("action").value = "save";
            document.getElementById("btnProduct").click();

        }
        function deleteItem(id){
            document.getElementById("prodID").value = id;
            document.getElementById("action").value = "delete";
            document.getElementById("btnProduct").click();
        }
        function isNumberKey(evt)
        {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode != 46 && charCode > 31
                && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }
    </script>
    @section('footer')
