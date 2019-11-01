CREATE VIEW GetSnacks AS
	#get all products but filter products that are snacks and are avaialbe
    SELECT ProdID,ProdName,Price,pub_product.Qty
    FROM pub_product
    WHERE IsAvailable = 1
    AND IsSnack = 1;