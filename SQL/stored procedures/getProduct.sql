DELIMITER $$
CREATE DEFINER=`ISAD251_DHirst`@`%` PROCEDURE `getProduct`(IN `newProdID` INT)
    NO SQL
SELECT ProdID, ProdName, Qty, Price
FROM pub_product
WHERE newProdID = ProdID$$
DELIMITER ;