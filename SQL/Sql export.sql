-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: proj-mysql.uopnet.plymouth.ac.uk
-- Generation Time: Dec 29, 2019 at 01:58 AM
-- Server version: 8.0.16
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `isad251_dhirst`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`ISAD251_DHirst`@`%` PROCEDURE `addOrder` (IN `ordercomments` VARCHAR(255), IN `ordertablenumber` INT, IN `orderemail` VARCHAR(50))  NO SQL
BEGIN
	DECLARE EXIT HANDLER FOR SQLEXCEPTION ROLLBACK;
	DECLARE EXIT HANDLER FOR SQLWARNING ROLLBACK;
	
   START TRANSACTION;
  INSERT INTO pub_order(OrderDate,Completed,Comments,TableNumber,Email)
  VALUES (NOW(), 0, ordercomments, ordertablenumber, orderemail);
  COMMIT;

END$$

CREATE DEFINER=`ISAD251_DHirst`@`%` PROCEDURE `addOrderDetails` (IN `newOrderID` INT, IN `newProdID` INT, IN `newQty` INT, IN `newPrice` FLOAT)  NO SQL
BEGIN
	DECLARE EXIT HANDLER FOR SQLEXCEPTION ROLLBACK;
	DECLARE EXIT HANDLER FOR SQLWARNING ROLLBACK;
	
   START TRANSACTION;
  INSERT INTO pub_order_detail(OrderID,ProdID,Qty,Price)
  VALUES (newOrderID,newProdID,newQty,newPrice);
  COMMIT;
END$$

CREATE DEFINER=`ISAD251_DHirst`@`%` PROCEDURE `addProduct` (IN `newProdName` VARCHAR(30), IN `newQty` INT, IN `newPrice` FLOAT, IN `newIsAvailable` TINYINT, IN `newIsSnack` TINYINT)  NO SQL
BEGIN
	DECLARE EXIT HANDLER FOR SQLEXCEPTION ROLLBACK;
	DECLARE EXIT HANDLER FOR SQLWARNING ROLLBACK;
	
   START TRANSACTION;
  INSERT INTO pub_product(ProdName,Qty,Price,IsAvailable,IsSnack, RestockNeeded)
  VALUES (newProdName, newQty, newPrice, newIsAvailable,newIsSnack,0);
  COMMIT;

END$$

CREATE DEFINER=`ISAD251_DHirst`@`%` PROCEDURE `deleteOrder` (IN `newOrderID` INT)  NO SQL
DELETE FROM pub_order WHERE OrderID = newOrderID$$

CREATE DEFINER=`ISAD251_DHirst`@`%` PROCEDURE `deleteOrderDetails` (IN `newOrderDetailID` INT)  NO SQL
DELETE FROM pub_order_detail WHERE OrderDetailsID = newOrderDetailID$$

CREATE DEFINER=`ISAD251_DHirst`@`%` PROCEDURE `getOrder` (IN `newOrderID` INT, IN `newEmail` VARCHAR(50))  NO SQL
SELECT OrderID, OrderDate, Completed, Comments, TableNumber, Email
    FROM pub_order
    WHERE newOrderID = OrderID
    OR Email = newEmail$$

CREATE DEFINER=`ISAD251_DHirst`@`%` PROCEDURE `getOrderDetails` (IN `newOrderID` INT)  NO SQL
SELECT OrderID, OrderDetailsID, ProdID, Qty, Price
FROM pub_order_detail
WHERE newOrderID = OrderID$$

CREATE DEFINER=`ISAD251_DHirst`@`%` PROCEDURE `getOrderID` (IN `newEmail` VARCHAR(30))  NO SQL
SELECT OrderID 
FROM pub_order 
WHERE Email = newEmail
ORDER BY OrderID DESC LIMIT 1$$

CREATE DEFINER=`ISAD251_DHirst`@`%` PROCEDURE `getProduct` (IN `newProdID` INT)  NO SQL
SELECT ProdID, ProdName, Qty, Price
FROM pub_product
WHERE newProdID = ProdID$$

CREATE DEFINER=`ISAD251_DHirst`@`%` PROCEDURE `Invoice` (IN `OrderNumber` INT)  SELECT pub_order.OrderDate, pub_order_detail.ProdID, pub_order_detail.Qty, 
    pub_product.ProdName, pub_order_detail.Price, (pub_order_detail.Qty * pub_order_detail.Price) as SubTotal
    FROM pub_order, pub_order_detail, pub_product
    WHERE pub_order.OrderID = OrderNumber
    AND pub_order_detail.OrderID = pub_order.OrderID
    AND pub_order_detail.ProdID = pub_product.ProdID$$

CREATE DEFINER=`ISAD251_DHirst`@`%` PROCEDURE `TotalSpend` (IN `CusEmail` VARCHAR(50))  SELECT pub_order.Email, sum(pub_order_detail.Qty * pub_order_detail.Price) as SubTotal
    FROM pub_order, pub_order_detail
    WHERE pub_order.OrderID = pub_order_detail.OrderID
    AND pub_order.Email = CusEmail
    GROUP BY pub_order.Email$$

CREATE DEFINER=`ISAD251_DHirst`@`%` PROCEDURE `UpdateOrder` (IN `newComments` VARCHAR(255), IN `newOrderTableNumber` INT, IN `newOrderEmail` VARCHAR(50), IN `newOrderID` INT)  NO SQL
UPDATE pub_order 
  SET
  pub_order.Comments = newComments,
  pub_order.TableNumber = newOrderTableNumber,
  pub_order.Email = newOrderEmail
  WHERE pub_order.OrderID = newOrderID$$

CREATE DEFINER=`ISAD251_DHirst`@`%` PROCEDURE `updateOrderDetails` (IN `newOrderID` INT, IN `newProdID` INT, IN `newQty` INT, IN `newPrice` FLOAT, IN `newOrderDetailsID` INT)  NO SQL
UPDATE pub_order_detail 
  SET
  pub_order_detail.OrderID = newOrderID,
  pub_order_detail.ProdID = newProdID,
  pub_order_detail.Qty = newQty,
  pub_order_detail.Price = newPrice
  WHERE pub_order_detail.OrderDetailsID = newOrderDetailsID$$

CREATE DEFINER=`ISAD251_DHirst`@`%` PROCEDURE `UpdateProduct` (IN `newProdName` VARCHAR(30), IN `newQty` INT, IN `newPrice` FLOAT, IN `newProdID` INT)  NO SQL
UPDATE pub_product 
  SET
  pub_product.ProdName = newProdName,
  pub_product.Qty = newQty,
  pub_product.Price = newPrice
  WHERE pub_product.ProdID = newProdID$$

CREATE DEFINER=`ISAD251_DHirst`@`%` PROCEDURE `withdrawProduct` (IN `newProdID` INT)  NO SQL
UPDATE pub_product
  SET IsAvailable = 0
  WHERE ProdId = newProdID$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `amountproductssold`
-- (See below for the actual view)
--
CREATE TABLE `amountproductssold` (
`ProdID` int(11)
,`totalSold` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `getdrinks`
-- (See below for the actual view)
--
CREATE TABLE `getdrinks` (
`Price` float
,`ProdID` int(11)
,`ProdName` varchar(30)
,`Qty` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `getmenu`
-- (See below for the actual view)
--
CREATE TABLE `getmenu` (
`IsAvailable` tinyint(1)
,`IsSnack` tinyint(1)
,`Price` float
,`ProdID` int(11)
,`ProdName` varchar(30)
,`Qty` int(11)
,`RestockNeeded` tinyint(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `getsnacks`
-- (See below for the actual view)
--
CREATE TABLE `getsnacks` (
`Price` float
,`ProdID` int(11)
,`ProdName` varchar(30)
,`Qty` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `itemneedrestocking`
-- (See below for the actual view)
--
CREATE TABLE `itemneedrestocking` (
`ProdID` int(11)
,`ProdName` varchar(30)
,`Qty` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `monthlyorders`
-- (See below for the actual view)
--
CREATE TABLE `monthlyorders` (
`MONTH` int(2)
,`Number_Of_Orders` bigint(21)
,`YEAR` int(4) unsigned
);

-- --------------------------------------------------------

--
-- Table structure for table `pub_order`
--

CREATE TABLE `pub_order` (
  `OrderID` int(11) NOT NULL,
  `OrderDate` datetime NOT NULL,
  `Completed` tinyint(1) NOT NULL,
  `Comments` varchar(255) DEFAULT NULL,
  `TableNumber` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pub_order`
--

INSERT INTO `pub_order` (`OrderID`, `OrderDate`, `Completed`, `Comments`, `TableNumber`, `Email`) VALUES
(1, '2019-00-12 15:34:35', 0, NULL, 4, 'kwhellans0@stumbleupon.com'),
(2, '2019-07-13 13:39:39', 1, 'want extra sauce', 14, 'bambrosch1@last.fm'),
(4, '2019-04-16 11:36:34', 1, NULL, 94, 'chollingby3@bluehost.com'),
(5, '2019-09-18 17:38:38', 1, NULL, 72, 'kwhellans0@stumbleupon.com'),
(6, '2019-07-15 16:37:32', 1, NULL, 90, 'gcoye5@canalblog.com'),
(7, '2019-02-16 14:36:30', 1, NULL, 99, 'kkubera6@reverbnation.com'),
(8, '2019-08-16 19:35:31', 1, NULL, 45, 'bstranahan7@blogtalkradio.com'),
(9, '2019-01-12 13:39:30', 1, NULL, 52, 'lcunniff8@flavors.me'),
(10, '2019-02-12 12:36:34', 1, NULL, 14, 'lvellender9@twitpic.com'),
(11, '2019-09-10 16:30:30', 1, NULL, 79, 'ayitzhakova@cargocollective.com'),
(12, '2019-04-18 13:32:34', 1, NULL, 91, 'cmaxwellb@lulu.com'),
(13, '2019-04-16 19:33:30', 1, NULL, 2, 'kcootc@dailymotion.com'),
(14, '2019-05-19 11:36:38', 1, NULL, 67, 'blorandd@jiathis.com'),
(15, '2019-09-13 18:37:39', 1, NULL, 63, 'jcallistere@nba.com'),
(16, '2019-08-18 16:36:39', 1, NULL, 93, 'bdutchf@wikimedia.org'),
(17, '2019-05-10 14:31:38', 1, NULL, 63, 'twealdg@nymag.com'),
(18, '2019-02-11 14:38:30', 1, NULL, 5, 'sdaintryh@is.gd'),
(19, '2019-03-17 10:31:38', 1, NULL, 69, 'rflannigani@jiathis.com'),
(20, '2019-06-15 19:38:33', 1, NULL, 82, 'dloughrenj@google.de'),
(21, '2019-05-17 11:30:38', 1, NULL, 45, 'emcgiveenk@youku.com'),
(22, '2019-01-19 13:32:35', 1, NULL, 24, 'rbigginl@wordpress.com'),
(23, '2019-02-16 17:38:39', 1, NULL, 41, 'mcurnowm@networksolutions.com'),
(24, '2019-00-13 15:36:36', 1, NULL, 91, 'pkirrensn@europa.eu'),
(25, '2019-09-16 13:32:39', 1, NULL, 20, 'rmccombo@blogs.com'),
(26, '2019-02-16 17:36:35', 1, NULL, 26, 'lcyphusp@google.ru'),
(27, '2019-06-16 18:35:34', 1, NULL, 61, 'cpaskinq@rakuten.co.jp'),
(28, '2019-06-12 13:38:35', 1, NULL, 27, 'pheffernonr@google.it'),
(29, '2019-06-12 16:31:37', 1, NULL, 95, 'bdealtrys@technorati.com'),
(30, '2019-03-11 12:31:32', 1, NULL, 78, 'swallettt@aol.com'),
(31, '2019-11-12 11:57:26', 0, '', 12, 'example@example.com'),
(32, '2019-11-12 11:59:07', 0, 'food needs to be hot', 12, 'email@email.com'),
(44, '2019-11-12 12:30:00', 0, 'aaaaaa', 20, 'TEST_EMAIL'),
(45, '2019-11-12 12:34:09', 0, 'food hot please', 42, 'Joe@mail.com'),
(56, '2019-12-07 16:17:48', 0, NULL, 54, 'hello'),
(59, '2019-12-07 16:26:30', 0, 'within 10 mins', 42, 'danhirst123@gmail.com'),
(60, '2019-12-07 16:29:18', 0, NULL, 33, 'danhirst123@gmail.com'),
(61, '2019-12-07 16:30:01', 0, NULL, 33, 'danhirst123@gmail.com'),
(62, '2019-12-07 16:32:05', 0, NULL, 76, 'daniel.hirst@students.plymouth.ac.uk'),
(63, '2019-12-07 16:33:50', 0, NULL, 23, 'raptorhouse33@gmail.com'),
(64, '2019-12-07 16:42:10', 0, NULL, 231, 'danhirst123@gmail.com'),
(65, '2019-12-07 16:46:59', 0, NULL, 94, 'danhirst123@gmail.com'),
(66, '2019-12-07 16:55:25', 0, NULL, 94, 'danhirst123@gmail.com'),
(67, '2019-12-07 16:56:12', 0, NULL, 94, 'danhirst123@gmail.com'),
(68, '2019-12-07 16:56:52', 0, NULL, 61, 'danhirst123@gmail.com'),
(69, '2019-12-07 16:57:16', 0, NULL, 61, 'danhirst123@gmail.com'),
(70, '2019-12-07 16:57:51', 0, NULL, 61, 'danhirst123@gmail.com'),
(71, '2019-12-07 16:59:30', 0, NULL, 61, 'danhirst123@gmail.com'),
(72, '2019-12-07 16:59:55', 0, NULL, 61, 'danhirst123@gmail.com'),
(73, '2019-12-08 16:14:32', 0, NULL, 54, 'danhirst123@gmail.com'),
(74, '2019-12-09 13:31:50', 0, NULL, 54, 'danhirst123@gmail.com'),
(75, '2019-12-09 13:48:12', 0, NULL, 56, 'danhirst123@gmail.com'),
(76, '2019-12-10 15:00:43', 0, NULL, 92, 'danhirst123@gmail.com'),
(77, '2019-12-10 15:24:29', 0, NULL, 76, 'danhirst123@gmail.com'),
(78, '2019-12-17 13:12:04', 0, NULL, 1, 'danskillman@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pub_order_detail`
--

CREATE TABLE `pub_order_detail` (
  `OrderDetailsID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `ProdID` int(11) NOT NULL,
  `Qty` int(11) NOT NULL,
  `Price` float NOT NULL
) ;

--
-- Dumping data for table `pub_order_detail`
--

INSERT INTO `pub_order_detail` (`OrderDetailsID`, `OrderID`, `ProdID`, `Qty`, `Price`) VALUES
(1, 25, 9, 3, 2.53),
(2, 2, 15, 3, 0.83),
(3, 24, 4, 3, 0.95),
(5, 15, 16, 2, 2.22),
(8, 6, 9, 1, 2.81),
(9, 20, 19, 2, 2.96),
(10, 25, 10, 4, 1.69),
(11, 14, 3, 4, 0.74),
(12, 25, 10, 2, 2.62),
(13, 14, 7, 3, 0.52),
(14, 16, 17, 4, 2.87),
(15, 17, 5, 2, 1.32),
(16, 11, 13, 1, 1.75),
(17, 11, 6, 3, 1.21),
(18, 17, 6, 1, 1.68),
(19, 8, 6, 4, 0.91),
(20, 8, 5, 1, 2.5),
(22, 18, 15, 2, 1.37),
(23, 22, 3, 2, 0.66),
(24, 1, 9, 2, 1.93),
(25, 8, 18, 3, 2.05),
(26, 23, 13, 3, 2.57),
(27, 11, 11, 4, 1.35),
(28, 14, 17, 3, 2.89),
(29, 6, 17, 2, 0.96),
(30, 8, 19, 3, 1.55),
(31, 14, 17, 3, 2.97),
(32, 5, 5, 1, 2.66),
(33, 11, 8, 1, 1.42),
(34, 2, 7, 3, 1.93),
(35, 11, 8, 4, 1.61),
(36, 10, 6, 1, 1.97),
(37, 14, 6, 1, 2.5),
(38, 13, 7, 3, 2.03),
(39, 16, 9, 1, 0.7),
(40, 7, 17, 2, 0.57),
(41, 10, 7, 1, 2.31),
(42, 19, 9, 4, 2.87),
(43, 10, 27, 1, 2.31),
(44, 2, 19, 1, 0.99),
(45, 25, 8, 1, 1.74),
(46, 11, 15, 1, 1.62),
(47, 18, 18, 4, 2.27),
(48, 5, 14, 1, 0.85),
(49, 7, 12, 2, 2.36),
(50, 20, 11, 2, 0.87),
(51, 20, 13, 2, 1.61),
(52, 10, 14, 2, 2.68),
(53, 23, 13, 3, 2.32),
(54, 5, 18, 2, 2.36),
(55, 18, 6, 1, 1.67),
(56, 5, 27, 1, 2.48),
(58, 7, 6, 3, 1.72),
(60, 14, 10, 2, 1.56),
(61, 24, 4, 2, 1.6),
(62, 10, 11, 3, 0.99),
(63, 19, 9, 2, 0.79),
(64, 30, 17, 2, 2.85),
(65, 10, 5, 3, 1),
(66, 2, 5, 3, 1),
(70, 4, 4, 2, 1),
(71, 59, 3, 1, 0.72),
(72, 59, 4, 1, 0.62),
(73, 60, 3, 1, 0.72),
(74, 60, 5, 1, 1),
(75, 60, 6, 1, 2.08),
(76, 61, 3, 1, 0.72),
(77, 61, 5, 1, 1),
(78, 61, 6, 1, 2.08),
(79, 63, 5, 1, 1),
(80, 63, 6, 1, 2.08),
(81, 64, 3, 1, 0.72),
(82, 64, 4, 1, 0.62),
(83, 65, 4, 1, 0.62),
(84, 65, 5, 1, 1),
(85, 66, 4, 1, 0.62),
(86, 66, 5, 1, 1),
(87, 67, 4, 1, 0.62),
(88, 67, 5, 1, 1),
(89, 68, 3, 1, 0.72),
(90, 68, 4, 1, 0.62),
(91, 68, 5, 1, 1),
(92, 68, 6, 1, 2.08),
(93, 68, 7, 1, 1.35),
(94, 68, 8, 1, 1.26),
(95, 68, 12, 3, 0.88),
(96, 68, 11, 3, 2.21),
(97, 69, 3, 1, 0.72),
(98, 69, 4, 1, 0.62),
(99, 69, 5, 1, 1),
(100, 69, 6, 1, 2.08),
(101, 69, 7, 1, 1.35),
(102, 69, 8, 1, 1.26),
(103, 69, 12, 3, 0.88),
(104, 69, 11, 3, 2.21),
(105, 70, 3, 1, 0.72),
(106, 70, 4, 1, 0.62),
(107, 70, 5, 1, 1),
(108, 70, 6, 1, 2.08),
(109, 70, 7, 1, 1.35),
(110, 70, 8, 1, 1.26),
(111, 70, 12, 3, 0.88),
(112, 70, 11, 3, 2.21),
(113, 71, 3, 1, 0.72),
(114, 71, 4, 1, 0.62),
(115, 71, 5, 1, 1),
(116, 71, 6, 1, 2.08),
(117, 71, 7, 1, 1.35),
(118, 71, 8, 1, 1.26),
(119, 71, 12, 3, 0.88),
(120, 71, 11, 3, 2.21),
(121, 72, 3, 1, 0.72),
(122, 72, 4, 1, 0.62),
(123, 72, 5, 1, 1),
(124, 72, 6, 1, 2.08),
(125, 72, 7, 1, 1.35),
(126, 72, 8, 1, 1.26),
(127, 72, 12, 3, 0.88),
(128, 72, 11, 3, 2.21),
(129, 73, 3, 1, 0.72),
(130, 73, 4, 1, 0.62),
(131, 73, 5, 1, 1),
(132, 74, 4, 1, 0.62),
(133, 74, 3, 1, 0.72),
(134, 74, 9, 1, 2.92),
(135, 75, 3, 1, 0.72),
(136, 75, 4, 1, 0.62),
(137, 75, 5, 1, 1),
(138, 76, 3, 1, 0.72),
(139, 76, 4, 1, 0.62),
(140, 76, 5, 1, 1),
(141, 77, 3, 1, 0.72),
(142, 77, 4, 1, 0.62),
(143, 77, 5, 1, 1),
(144, 73, 3, 2, 3),
(145, 74, 3, 3, 2),
(150, 78, 4, 1, 0.62),
(151, 78, 5, 1, 1),
(152, 78, 6, 1, 2.08),
(153, 78, 7, 1, 1.35),
(154, 78, 8, 1, 1.26),
(155, 78, 9, 1, 2.92),
(156, 78, 10, 1, 1.66),
(157, 78, 11, 1, 2.21),
(158, 78, 12, 1, 0.88),
(159, 78, 13, 1, 0.85),
(160, 78, 14, 1, 2.4),
(161, 78, 15, 1, 2.56),
(162, 78, 16, 1, 2.22),
(163, 78, 17, 1, 2.85),
(164, 78, 18, 1, 2.51),
(165, 78, 19, 1, 1.8),
(166, 78, 27, 1, 1.67),
(167, 78, 61, 1, 0.5),
(168, 78, 3, 1, 1);

--
-- Triggers `pub_order_detail`
--
DELIMITER $$
CREATE TRIGGER `InsertReduceStockWhenOrder` AFTER INSERT ON `pub_order_detail` FOR EACH ROW UPDATE pub_product
SET pub_product.Qty = pub_product.Qty - NEW.Qty
WHERE pub_product.ProdID = NEW.ProdID
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UpdateReduceStockWhenOrder` AFTER UPDATE ON `pub_order_detail` FOR EACH ROW UPDATE pub_product
SET pub_product.Qty = pub_product.Qty - NEW.Qty
WHERE pub_product.ProdID = NEW.ProdID
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pub_product`
--

CREATE TABLE `pub_product` (
  `ProdID` int(11) NOT NULL,
  `ProdName` varchar(30) NOT NULL,
  `Qty` int(11) NOT NULL,
  `Price` float NOT NULL,
  `IsAvailable` tinyint(1) NOT NULL,
  `IsSnack` tinyint(1) NOT NULL,
  `RestockNeeded` tinyint(1) NOT NULL
) ;

--
-- Dumping data for table `pub_product`
--

INSERT INTO `pub_product` (`ProdID`, `ProdName`, `Qty`, `Price`, `IsAvailable`, `IsSnack`, `RestockNeeded`) VALUES
(3, 'Walkers Crisps', 98, 0.72, 1, 1, 0),
(4, 'HP Peanuts', 99, 0.62, 1, 1, 0),
(5, 'Popcorn', 99, 1, 1, 1, 0),
(6, 'Pretzels', 50, 2.08, 1, 1, 0),
(7, 'Nachos', 57, 1.35, 1, 1, 0),
(8, 'Potato skins', 41, 1.26, 1, 1, 0),
(9, 'Beef Jerky', 31, 2.92, 1, 1, 0),
(10, 'Tea', 50, 1.66, 1, 0, 0),
(11, 'Coffee', 73, 2.21, 1, 0, 0),
(12, 'Pepsi Max', 72, 0.88, 1, 0, 0),
(13, 'Coca-Cola', 38, 0.85, 1, 0, 0),
(14, 'Gordons Gin', 98, 2.4, 1, 0, 0),
(15, 'Gin Fizz', 38, 2.56, 1, 0, 0),
(16, 'White Rum', 98, 2.22, 1, 0, 0),
(17, 'Merlot', 28, 2.85, 1, 0, 1),
(18, 'Malbec', 36, 2.51, 1, 0, 0),
(19, 'Pinot Grigio', 38, 1.8, 1, 0, 0),
(27, 'Tea', 51, 1.67, 1, 0, 0),
(60, 'jelly beans', 49, 1, 0, 1, 0),
(61, 'jelly beans green', 59, 0.5, 1, 0, 0);

--
-- Triggers `pub_product`
--
DELIMITER $$
CREATE TRIGGER `StockLevel` BEFORE UPDATE ON `pub_product` FOR EACH ROW BEGIN
IF NEW.Qty < 30 THEN
SET NEW.RestockNeeded = 1;
ELSE 
SET NEW.RestockNeeded = 0;
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `saveOldPrice` AFTER UPDATE ON `pub_product` FOR EACH ROW INSERT INTO pub_product_price_audit(ProdID, DateChanged, NewPrice, OldPrice, Quantity) 
    SELECT pub_product.ProdID,NOW(),NEW.Price,OLD.Price,pub_product.Qty
    FROM pub_product
    WHERE NEW.Price <> OLD.Price
    AND pub_product.ProdID = NEW.ProdID
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pub_product_price_audit`
--

CREATE TABLE `pub_product_price_audit` (
  `ProdAuditID` int(11) NOT NULL,
  `ProdID` int(11) NOT NULL,
  `DateChanged` datetime NOT NULL,
  `NewPrice` float NOT NULL,
  `OldPrice` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pub_product_price_audit`
--

INSERT INTO `pub_product_price_audit` (`ProdAuditID`, `ProdID`, `DateChanged`, `NewPrice`, `OldPrice`, `Quantity`) VALUES
(63, 3, '2019-11-07 11:57:48', 0.74, 0.72, 49),
(64, 4, '2019-11-07 11:58:21', 0.62, 0.63, 97),
(65, 10, '2019-11-15 19:01:35', 1.66, 1.67, 51),
(66, 3, '2019-11-26 11:41:34', 0.72, 0.74, 49);

-- --------------------------------------------------------

--
-- Stand-in structure for view `sales`
-- (See below for the actual view)
--
CREATE TABLE `sales` (
`Email` varchar(50)
,`OrderID` int(11)
,`TotalCost` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `viewincompleteorders`
-- (See below for the actual view)
--
CREATE TABLE `viewincompleteorders` (
`Completed` tinyint(1)
,`Email` varchar(50)
,`OrderDate` datetime
,`OrderID` int(11)
,`TableNumber` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `amountproductssold`
--
DROP TABLE IF EXISTS `amountproductssold`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ISAD251_DHirst`@`%` SQL SECURITY DEFINER VIEW `amountproductssold`  AS  select `pub_product`.`ProdID` AS `ProdID`,sum(`pub_order_detail`.`Qty`) AS `totalSold` from (`pub_order_detail` join `pub_product`) where (`pub_product`.`ProdID` = `pub_order_detail`.`ProdID`) group by `pub_product`.`ProdID` order by `totalSold` desc ;

-- --------------------------------------------------------

--
-- Structure for view `getdrinks`
--
DROP TABLE IF EXISTS `getdrinks`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ISAD251_DHirst`@`%` SQL SECURITY DEFINER VIEW `getdrinks`  AS  select `pub_product`.`ProdID` AS `ProdID`,`pub_product`.`ProdName` AS `ProdName`,`pub_product`.`Price` AS `Price`,`pub_product`.`Qty` AS `Qty` from `pub_product` where ((`pub_product`.`IsAvailable` = 1) and (`pub_product`.`IsSnack` = 0)) ;

-- --------------------------------------------------------

--
-- Structure for view `getmenu`
--
DROP TABLE IF EXISTS `getmenu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ISAD251_DHirst`@`%` SQL SECURITY DEFINER VIEW `getmenu`  AS  select `pub_product`.`ProdID` AS `ProdID`,`pub_product`.`ProdName` AS `ProdName`,`pub_product`.`Qty` AS `Qty`,`pub_product`.`Price` AS `Price`,`pub_product`.`IsAvailable` AS `IsAvailable`,`pub_product`.`IsSnack` AS `IsSnack`,`pub_product`.`RestockNeeded` AS `RestockNeeded` from `pub_product` where (`pub_product`.`IsAvailable` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `getsnacks`
--
DROP TABLE IF EXISTS `getsnacks`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ISAD251_DHirst`@`%` SQL SECURITY DEFINER VIEW `getsnacks`  AS  select `pub_product`.`ProdID` AS `ProdID`,`pub_product`.`ProdName` AS `ProdName`,`pub_product`.`Price` AS `Price`,`pub_product`.`Qty` AS `Qty` from `pub_product` where ((`pub_product`.`IsAvailable` = 1) and (`pub_product`.`IsSnack` = 1)) ;

-- --------------------------------------------------------

--
-- Structure for view `itemneedrestocking`
--
DROP TABLE IF EXISTS `itemneedrestocking`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ISAD251_DHirst`@`%` SQL SECURITY DEFINER VIEW `itemneedrestocking`  AS  select `pub_product`.`ProdID` AS `ProdID`,`pub_product`.`ProdName` AS `ProdName`,`pub_product`.`Qty` AS `Qty` from `pub_product` where (`pub_product`.`RestockNeeded` = 1) order by `pub_product`.`Qty` ;

-- --------------------------------------------------------

--
-- Structure for view `monthlyorders`
--
DROP TABLE IF EXISTS `monthlyorders`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ISAD251_DHirst`@`%` SQL SECURITY DEFINER VIEW `monthlyorders`  AS  select count(`pub_order`.`OrderID`) AS `Number_Of_Orders`,year(`pub_order`.`OrderDate`) AS `YEAR`,month(`pub_order`.`OrderDate`) AS `MONTH` from `pub_order` group by year(`pub_order`.`OrderDate`),month(`pub_order`.`OrderDate`) order by year(`pub_order`.`OrderDate`),month(`pub_order`.`OrderDate`) ;

-- --------------------------------------------------------

--
-- Structure for view `sales`
--
DROP TABLE IF EXISTS `sales`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ISAD251_DHirst`@`%` SQL SECURITY DEFINER VIEW `sales`  AS  select `pub_order`.`OrderID` AS `OrderID`,`pub_order`.`Email` AS `Email`,sum((`pub_order_detail`.`Qty` * `pub_order_detail`.`Price`)) AS `TotalCost` from (`pub_order` join `pub_order_detail`) where (`pub_order`.`OrderID` = `pub_order_detail`.`OrderID`) group by `pub_order`.`OrderID`,`pub_order`.`Email` order by `pub_order`.`OrderID` ;

-- --------------------------------------------------------

--
-- Structure for view `viewincompleteorders`
--
DROP TABLE IF EXISTS `viewincompleteorders`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ISAD251_DHirst`@`%` SQL SECURITY DEFINER VIEW `viewincompleteorders`  AS  select `pub_order`.`OrderID` AS `OrderID`,`pub_order`.`TableNumber` AS `TableNumber`,`pub_order`.`Email` AS `Email`,`pub_order`.`OrderDate` AS `OrderDate`,`pub_order`.`Completed` AS `Completed` from `pub_order` where (`pub_order`.`Completed` = 0) order by `pub_order`.`OrderDate` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pub_order`
--
ALTER TABLE `pub_order`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `pub_order_detail`
--
ALTER TABLE `pub_order_detail`
  ADD PRIMARY KEY (`OrderDetailsID`),
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `ProdID` (`ProdID`);

--
-- Indexes for table `pub_product`
--
ALTER TABLE `pub_product`
  ADD PRIMARY KEY (`ProdID`);

--
-- Indexes for table `pub_product_price_audit`
--
ALTER TABLE `pub_product_price_audit`
  ADD PRIMARY KEY (`ProdAuditID`),
  ADD KEY `FK_ProdID` (`ProdID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pub_order`
--
ALTER TABLE `pub_order`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `pub_order_detail`
--
ALTER TABLE `pub_order_detail`
  MODIFY `OrderDetailsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pub_product`
--
ALTER TABLE `pub_product`
  MODIFY `ProdID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pub_product_price_audit`
--
ALTER TABLE `pub_product_price_audit`
  MODIFY `ProdAuditID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pub_order_detail`
--
ALTER TABLE `pub_order_detail`
  ADD CONSTRAINT `pub_order_detail_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `pub_order` (`OrderID`),
  ADD CONSTRAINT `pub_order_detail_ibfk_2` FOREIGN KEY (`ProdID`) REFERENCES `pub_product` (`ProdID`);

--
-- Constraints for table `pub_product_price_audit`
--
ALTER TABLE `pub_product_price_audit`
  ADD CONSTRAINT `FK_ProdID` FOREIGN KEY (`ProdID`) REFERENCES `pub_product` (`ProdID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
