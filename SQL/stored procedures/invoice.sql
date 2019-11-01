CREATE PROCEDURE Invoice (OrderNumber INT)
    SELECT pub_order.OrderDate, pub_order_detail.ProdID, pub_order_detail.Qty, 
    pub_product.ProdName, pub_order_detail.Price, (pub_order_detail.Qty * pub_order_detail.Price) as SubTotal
    FROM pub_order, pub_order_detail, pub_product
    WHERE pub_order.OrderID = OrderNumber
    AND pub_order_detail.OrderID = pub_order.OrderID
    AND pub_order_detail.ProdID = pub_product.ProdID;
