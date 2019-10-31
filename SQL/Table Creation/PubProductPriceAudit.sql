CREATE TABLE Pub_Product_Price_Audit(
    ProdAuditID INT AUTO_INCREMENT NOT NULL,
    ProdID INT NOT NULL,
    DateChanged DATETIME NOT NULL,
    NewPrice FLOAT NOT NULL,
    OldPrice FLOAT NOT NULL,
    Quantity int not null,
    PRIMARY KEY (ProdAuditID),
    CONSTRAINT FK_ProdID FOREIGN KEY (ProdID)
    REFERENCES pub_product(ProdID)
)