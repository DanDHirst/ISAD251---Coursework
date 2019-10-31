CREATE TABLE Pub_Order (
    OrderID INT AUTO_INCREMENT NOT NULL,
    OrderDate DATETIME NOT NULL,
    Completed BOOLEAN NOT NULL,
    Comments VARCHAR(255),
    TableNumber INT NOT NULL,
    Email VARCHAR(50),
    PRIMARY KEY(OrderID)
);
