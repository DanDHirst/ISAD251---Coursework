CREATE TRIGGER `saveOldPrice` AFTER UPDATE ON `pub_product`
 FOR EACH ROW 
 INSERT INTO pub_product_price_audit(ProdID, DateChanged, NewPrice, OldPrice, Quantity) 
    SELECT pub_product.ProdID,NOW(),NEW.Price,OLD.Price,pub_product.Qty
    FROM pub_product
    WHERE NEW.Price <> OLD.Price
    AND pub_product.ProdID = NEW.ProdID
