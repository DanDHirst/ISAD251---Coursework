CREATE TRIGGER `saveOldPrice`
AFTER
UPDATE
  ON `pub_product` FOR EACH ROW
INSERT INTO
  pub_product_price_audit(
    ProdID,
    DateChanged,
    NewPrice,
    OldPrice,
    Quantity
  )
SELECT
  pub_product.ProdID,
  GETDATE(),
  new.Price,
  old.Price,
  pub_product.Qty
FROM
  pub_product
  JOIN inserted AS new ON new.ProdID = pub_product.ProdID
  JOIN deleted AS old ON old.ProdID = pub_product.ProdID
WHERE
  new.Price <> old.Price
