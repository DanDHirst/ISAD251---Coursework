CREATE VIEW ItemNeedRestocking AS
	# get all items from product table then filter ones that have need restock = 1
    SELECT pub_product.ProdID, pub_product.ProdName, pub_product.Qty
    FROM pub_product
    WHERE pub_product.RestockNeeded = 1
    ORDER BY pub_product.Qty;