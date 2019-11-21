DELIMITER $$
CREATE DEFINER=`ISAD251_DHirst`@`%` PROCEDURE `withdrawProduct`(IN `newProdID` INT)
    NO SQL
UPDATE pub_product
  SET IsAvailable = 0
  WHERE ProdId = newProdID$$
DELIMITER ;