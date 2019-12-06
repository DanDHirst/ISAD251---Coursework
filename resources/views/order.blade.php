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
                    <form><small class="form-text text-muted">Enter Table Number</small><input class="form-control" type="text"><small class="form-text text-muted">Enter your Email</small><input class="form-control" type="text"><small class="form-text text-muted">Enter any comments you have about the order</small>
                        <input
                            class="form-control" type="text"><button class="btn btn-primary" type="submit">Sumbit order</button></form>
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
            var textnode=document.createTextNode(itemList[id].ProdName + " £" +
                itemList[id].Quantity * itemList[id].Price);
            node.appendChild(textnode);
            document.getElementById("items").appendChild(node);
        }
        function updateQuantity(){
            var arrayLength = itemList.length;
            for (var i = 0; i < arrayLength; i++) {
                document.getElementById(itemList[i].ProdID).innerHTML = itemList[i].Quantity;
            }
        }
        function validateEmail(email)
        {
            var re = /^(?:[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/;
            return re.test(email);
        }
    </script>
    @section('footer')
