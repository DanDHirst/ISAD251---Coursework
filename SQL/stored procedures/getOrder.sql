DELIMITER $$
CREATE DEFINER=`ISAD251_DHirst`@`%` PROCEDURE `getOrder`(IN `newOrderID` INT, IN `newEmail` VARCHAR(50))
    NO SQL
SELECT OrderID, OrderDate, Completed, Comments, TableNumber, Email
    FROM pub_order
    WHERE newOrderID = OrderID
    OR Email = newEmail$$
DELIMITER ;