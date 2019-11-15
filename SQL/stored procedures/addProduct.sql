DELIMITER $$
CREATE DEFINER=`ISAD251_DHirst`@`%` PROCEDURE `addProduct`(IN `newProdName` VARCHAR(30), IN `newQty` INT, IN `newPrice` FLOAT, IN `newLastModifiedBy` VARCHAR(30), IN `newIsAvailable` TINYINT, IN `newIsSnack` TINYINT)
    NO SQL
BEGIN
	DECLARE EXIT HANDLER FOR SQLEXCEPTION ROLLBACK;
	DECLARE EXIT HANDLER FOR SQLWARNING ROLLBACK;
	
   START TRANSACTION;
  INSERT INTO pub_product(ProdName,Qty,Price,LastModifiedBy,IsAvailable,IsSnack, RestockNeeded)
  VALUES (newProdName, newQty, newPrice, newLastModifiedBy, newIsAvailable,newIsSnack,0);
  COMMIT;

END$$
DELIMITER ;