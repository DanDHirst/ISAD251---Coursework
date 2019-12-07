@extends('layout.app')
@section('header')
    <main class="page">
        <div style="height: 100px"></div>
        <section class="clean-block clean-pricing dark">
            <div class="row">
                <div class="col-md-4">
                    <ul>
                        @foreach($results as $item)
                            <li style="list-style-type: none;">

                                {{$item->ProdName}} Price: £{{$item->Price}}
                                <div>
                                <button class="btn btn-success" onclick="addItem({{$item}})">+</button>
                                <button class="btn btn-danger" onclick="removeItem({{$item}})">-</button>
                                Quantity <button class="btn btn-primary" disabled id= {{$item->ProdID}}  >0</button>
                                </div>

                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-4">
                    <form>
                        <ul id="items"></ul>
                    </form>
                </div>
                <div class="col-md-4">
                    <form method="post" action="/order" >
                        @csrf
                        Enter your Email(e.g. pub@pub.com)
                        <input id="email" type="text" class="form-control" name="email" placeholder="Email">
                        Enter Table Number(0-99)
                        <input id="tableNumber" type="text" class="form-control" name="tableNumber" placeholder="Table Number">
                        Enter any comments you have about the order
                        <input id="comments" type="text" class="form-control" name="comments" placeholder="Comments">
{{--                        <small class="form-text text-muted">Enter Table Number(0-99)</small>--}}
{{--                        <input class="form-control" type="text"><small class="form-text text-muted">--}}
{{--                            Enter your Email(e.g. pub@pub.com)</small><input class="form-control" type="text"><small class="form-text text-muted">--}}
{{--                            Enter any comments you have about the order</small>--}}
{{--                        <input--}}
{{--                            class="form-control" type="sumbit">--}}

                        <button id="submitOrder" class="btn btn-primary" style="display: none;" type="submit">Sumbit order</button>
                        <input id="sumbmitItemLists" type="hidden" name="itemList">

                    </form>
                    <button class="btn btn-primary" onclick="checkFields()">Submit order</button>
                </div>
            </div>
        </section>
    </main>
    <script>
    var itemList = [];
        function addItem(id) {
               // The function returns the product of p1 and p2
                if(checkIfInList(id.ProdID) == false) {
                    var tempItem = {ProdID: id.ProdID, ProdName: id.ProdName, Price: id.Price, Quantity: 1}
                    itemList.push(tempItem);
                }
                else{
                    addQuantityToItem(id.ProdID);
                }
                var arrayLength = itemList.length;
                emptyList();
                for (var i = 0; i < arrayLength; i++) {
                    outputToList(i);
                }
                updateQuantity();


        }
        function removeItem(id){
            if(checkIfInList(id.ProdID) == true){
                var arrayLength = itemList.length;
                for (var i = 0; i < arrayLength; i++) {
                    if(itemList[i].ProdID == id.ProdID){
                        if(itemList[i].Quantity > 1){
                            itemList[i].Quantity -= 1;
                        }
                        else{
                            itemList[i].Quantity -= 1;
                            updateQuantity();
                            deleteItem(i);
                        }
                    }
                }
            }
            emptyList();
            var arrayLength = itemList.length;
            for (var i = 0; i < arrayLength; i++) {
                outputToList(i);
            }
            updateQuantity();

        }
        function deleteItem(id){
            itemList.splice(id,1);
        }
        function checkIfInList(id){
            var arrayLength = itemList.length;
            for (var i = 0; i < arrayLength; i++) {
                if(itemList[i].ProdID == id){
                    return true;
                }
            }
            return  false;
        }
        function addQuantityToItem(id){
            var arrayLength = itemList.length;
            for (var i = 0; i < arrayLength; i++) {
                if(itemList[i].ProdID == id){
                    itemList[i].Quantity += 1 ;
                }
            }
        }
        function emptyList(){
            $(items).empty()
        }
        function outputToList(id){
            var node=document.createElement("li");
            var total = itemList[id].Quantity * itemList[id].Price;
            total = total.toFixed(2);
            var textnode=document.createTextNode(itemList[id].ProdName + " £" + total
                );
            node.appendChild(textnode);
            document.getElementById("items").appendChild(node);
        }
        function updateQuantity(){
            var arrayLength = itemList.length;
            for (var i = 0; i < arrayLength; i++) {
                document.getElementById(itemList[i].ProdID).innerHTML = itemList[i].Quantity;
            }
            createJSONObject();
        }
        function checkFields() {
            var email = document.getElementById("email").value;
            var table = document.getElementById("tableNumber").value;
            if(validateEmail(email) == true){
                if(validateTableNumber(table) == true){
                    document.getElementById("submitOrder").click();
                }
                else{
                    alert("table number incorrect format")
                }
            }
            else {
                alert("email incorrect format")
            }
        }
        function validateEmail(email)
        {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }
        function validateTableNumber(table){
            var re = /^\d{2}$/;
            return re.test(String(table));
        }

        function createJSONObject(){
            var items = {};
            items.data = itemList;
            $('#sumbmitItemLists').val(JSON.stringify(items));
        }
        window.onload = function() {
        };
    </script>
    @section('footer')
