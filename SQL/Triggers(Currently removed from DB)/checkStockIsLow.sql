CREATE TRIGGER `CheckLowStock` AFTER INSERT ON `pub_product`
 FOR EACH ROW UPDATE pub_product
    SET RestockNeeded = 1
    WHERE Qty < 30