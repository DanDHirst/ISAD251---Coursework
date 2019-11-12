DELIMITER $$
CREATE DEFINER=`ISAD251_DHirst`@`%` PROCEDURE `addOrder`(IN `ordercomments` VARCHAR(255), IN `ordertablenumber` INT, IN `orderemail` VARCHAR(50))
    NO SQL
BEGIN
	DECLARE EXIT HANDLER FOR SQLEXCEPTION ROLLBACK;
	DECLARE EXIT HANDLER FOR SQLWARNING ROLLBACK;
	
   START TRANSACTION;
  INSERT INTO pub_order(OrderDate,Completed,Comments,TableNumber,Email)
  VALUES (NOW(), 0, ordercomments, ordertablenumber, orderemail);
  COMMIT;
END$$
DELIMITER ;