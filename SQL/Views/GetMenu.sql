CREATE VIEW getMenu AS
	SELECT * FROM pub_product
    WHERE IsAvailable = 1;