DELIMITER $$
CREATE DEFINER=`ISAD251_DHirst`@`%` PROCEDURE `getOrderDetails`(IN `newOrderID` INT)
    NO SQL
SELECT OrderID, OrderDetailsID, ProdID, Qty, Price
FROM pub_order_detail
WHERE newOrderID = OrderID$$
DELIMITER ;