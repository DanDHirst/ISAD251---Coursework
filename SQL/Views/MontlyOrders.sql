CREATE VIEW MonthlyOrders AS
    SELECT count(OrderID) as Number_Of_Orders, 
    YEAR(OrderDate) as Year,
    MONTH(OrderDate) as Month
    FROM pub_order
    Group By YEAR(OrderDate), MONTH(OrderDate);