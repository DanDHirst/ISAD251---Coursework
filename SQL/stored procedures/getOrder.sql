SELECT OrderID, OrderDate, Completed, Comments, TableNumber, Email
    FROM pub_order
    WHERE newOrderID = OrderID
    OR Email = newEmail