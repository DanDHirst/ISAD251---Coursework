DELIMITER $$
CREATE DEFINER=`ISAD251_DHirst`@`%` PROCEDURE `deleteOrderDetails`(IN `newOrderID` INT)
    NO SQL
DELETE FROM pub_order_detail WHERE OrderID = newOrderID$$
DELIMITER ;