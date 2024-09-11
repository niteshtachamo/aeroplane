-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2024 at 05:01 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminPassword` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminEmail`, `adminPassword`) VALUES
(1, 'Nitesh', 'tachamonitesh@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandId` int(11) NOT NULL,
  `brandName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandId`, `brandName`) VALUES
(1, 'Boeing'),
(2, 'Air Craftmen'),
(3, 'Airbus'),
(4, 'Jetliner'),
(5, 'Bombardier'),
(6, 'Dassault Aviation');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartId` int(11) NOT NULL,
  `cmrId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catId` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(1, 'Aeroplane'),
(2, 'Helicopter');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zip` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `verification_code` int(11) NOT NULL,
  `email_verified` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `address`, `city`, `country`, `zip`, `phone`, `email`, `pass`, `user_image`, `verification_code`, `email_verified`) VALUES
(1, 'Nishan Tachamo', 'golmadhi', '', '', '', '9865477377', 'tachamonitesh@gmail.com', '123', 'pp.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `cmrId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `admin_status` varchar(255) NOT NULL DEFAULT 'pending',
  `order_status` varchar(255) NOT NULL DEFAULT 'pending',
  `invoice_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `cmrId`, `productId`, `productName`, `quantity`, `price`, `date`, `admin_status`, `order_status`, `invoice_number`) VALUES
(1, 1, 2, 'Aircraft Jet Landing', 1, 12.00, '2024-09-11 01:39:04', 'complete', 'complete', '859186301'),
(2, 1, 1, 'Augusta Air Westland', 1, 10.00, '2024-09-11 07:42:39', 'pending', 'complete', '593945851'),
(3, 1, 1, 'Augusta Air Westland', 1, 10.00, '2024-09-11 08:20:22', 'pending', 'pending', '272058233');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_status`
--

CREATE TABLE `tbl_order_status` (
  `order_id` int(11) NOT NULL,
  `cmrId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order_status`
--

INSERT INTO `tbl_order_status` (`order_id`, `cmrId`, `productId`, `invoice_number`, `quantity`, `order_status`) VALUES
(1, 1, 2, '859186301', 1, 'pending'),
(2, 1, 1, '593945851', 1, 'pending'),
(3, 1, 1, '272058233', 1, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `catId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `body` text NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `product_in_store` int(11) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `brandId`, `body`, `price`, `image`, `product_in_store`, `date`) VALUES
(1, 'Augusta Air Westland', 2, 1, 'This is the Augusta aeroplane developed by Boeing Company of China.', 10.00, 'uploads/Agusta-AW139.jpg', 2, 2147483647),
(2, 'Aircraft Jet Landing', 1, 4, 'This is the aircraft developed by jet landing company in Nepal.', 12.00, 'uploads/aircraft-jet-landing-cloud-46148.jpeg', 0, 2147483647),
(3, 'Jet Plane India', 0, 5, 'This is the jet plane developed by Jet Nepal to donate for India.', 15.00, 'uploads/cute-yellow-jet-plane-vector-47790793.jpg', 3, 2147483647),
(4, 'Jet fighter Plane', 1, 6, 'This is the aeroplane develop by the India to go in space.', 5.00, 'uploads/aeroplane-illustration-print-digital-use-65182743.webp', 19, 2147483647),
(5, 'Emergency medical Helicopter', 2, 3, 'This is the plane developed by the airbus company of Nepal. it is especially developed for the emergency situation.', 50.00, 'uploads/27Z2ETZ3TZCQLD7E4BYUODM6PA.jpg', 2, 2147483647),
(6, 'Nepal hawaijhaj Udan', 1, 1, 'This is the special plane developed by Boing company.', 49.00, 'uploads/360_F_1472821_kMjcU0El8NkcU0k7zNtlVTU0Fl8W2l.jpg', 3, 2147483647),
(7, 'USA Navy helicopter', 2, 4, 'This is the helicopter developed by jet liner company of USA.', 40.00, 'uploads/helicopter-art-design-template-vector-260nw-2348598537.webp', 5, 2147483647),
(8, 'Heli Heli Copter', 0, 5, 'It is the helicopter called as Heli Heli Copter.', 20.00, 'uploads/Jordanian_Air_Force_UH-60_Black_Hawk_helicopter_(cropped).jpg', 4, 2147483647),
(9, 'Nepal Ko Chopper', 2, 3, 'This is the choper developed by Nepal to destroy India and China.', 99.00, 'uploads/RNLAF_AH-64_Apache_at_the_Oirschotse_Heide_Low_Flying_Area_(36570605232).jpg', 1, 2147483647),
(10, 'Airbus to India', 1, 3, 'This is the plane develop to donate for India.', 85.00, 'uploads/photo-1529074963764-98f45c47344b.jpeg', 7, 2147483647),
(11, 'L A P D', 0, 6, 'This is the helicopter developed to give gift to Narendra Modi.', 6.00, 'uploads/LAPD_Bell_206_Jetranger.jpg', 9, 2147483647),
(12, 'I Stock Plane', 1, 5, 'This is the plane donate to the Bill Gates by Nitesh Tachamo of Golmadhi, Bhaktapur.', 100.00, 'uploads/istockphoto-155150766-612x612.jpg', 11, 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_payments`
--

CREATE TABLE `tbl_user_payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_payments`
--

INSERT INTO `tbl_user_payments` (`payment_id`, `order_id`, `invoice_number`, `amount`, `payment_mode`, `date`) VALUES
(1, 1, 859186301, 12, 'Cash on delivery', '2024-09-10 19:54:22'),
(2, 2, 593945851, 10, 'Stripe', '2024-09-11 02:00:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order_status`
--
ALTER TABLE `tbl_order_status`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `tbl_user_payments`
--
ALTER TABLE `tbl_user_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_order_status`
--
ALTER TABLE `tbl_order_status`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_user_payments`
--
ALTER TABLE `tbl_user_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
