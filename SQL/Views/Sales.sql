CREATE VIEW Sales AS
SELECT sum(pub_order_detail.Qty * pub_order_detail.Price) AS TotalCost,
 pub_order.OrderID, pub_order.Email
 FROM pub_order,pub_order_detail
 WHERE pub_order.OrderID = pub_order_detail.OrderID
 GROUP BY pub_order.OrderID, pub_order.Email;