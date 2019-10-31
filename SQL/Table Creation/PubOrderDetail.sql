CREATE TABLE Pub_Order_Detail(
    OrderDetailsID INT AUTO_INCREMENT NOT NULL,
    OrderID INT NOT NULL,
    ProdID INT NOT NULL,
    Qty INT NOT NULL,
    Price INT NOT NULL,
    PRIMARY KEY (OrderDetailsID),
    FOREIGN KEY (OrderID) REFERENCES pub_order(OrderID),
    FOREIGN KEY (ProdID) REFERENCES pub_product(ProdID),
    CONSTRAINT CHK_ItemDetail CHECK (Qty>=0 AND Price >=0)  
)