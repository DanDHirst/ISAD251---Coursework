CREATE VIEW ViewIncompleteOrders AS 
    SELECT pub_order.OrderID,pub_order.TableNumber,pub_order.Email, pub_order.OrderDate, 	pub_order.Completed
    FROM pub_order
    WHERE pub_order.Completed = 0
        ORDER BY pub_order.OrderDate