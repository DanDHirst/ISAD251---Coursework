CREATE VIEW AmountProductsSold AS
    SELECT pub_product.ProdID,
	SUM(pub_order_detail.Qty) as totalSold
	FROM pub_order_detail,pub_product
	WHERE pub_product.ProdID = pub_order_detail.ProdID
	GROUP BY pub_product.ProdID
	ORDER BY totalSold DESC;