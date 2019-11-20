SELECT OrderID, OrderDetailsID, ProdID, Qty, Price
FROM pub_order_detail
WHERE newOrderID = OrderID