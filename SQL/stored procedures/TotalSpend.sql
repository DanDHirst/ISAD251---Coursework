CREATE PROCEDURE TotalSpend AS
SELECT pub_order.Email, sum(pub_order_detail.Qty * pub_order_detail.Price) as SubTotal
    FROM pub_order, pub_order_detail
    WHERE pub_order.OrderID = pub_order_detail.OrderID
    AND pub_order.Email = CusEmail
    GROUP BY pub_order.Email