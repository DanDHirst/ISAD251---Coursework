CREATE VIEW getDrinks AS
	#get all products but filter products that are drinks and are avaialbe
    SELECT ProdID,ProdName,Price,pub_product.Qty
    FROM pub_product
    WHERE IsAvailable = 1
    AND IsSnack = 0;