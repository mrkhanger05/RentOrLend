-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2021 at 05:15 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eylor`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_detail`
--

CREATE TABLE `account_detail` (
  `id` int(11) NOT NULL,
  `Bank_User_ID` int(11) NOT NULL,
  `Bank_User_Name` text NOT NULL,
  `Bank_User_Account_No` varchar(100) NOT NULL,
  `Bank_IFSC` varchar(100) NOT NULL,
  `Bank_Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `days` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `p_id`, `u_id`, `days`) VALUES
(74, 47, 135, 0);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_name`) VALUES
('Delhi'),
('Faridabad'),
('Palwal');

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `FB_ID` int(11) NOT NULL,
  `FB_U_Name` text NOT NULL,
  `FB_U_Email` varchar(100) NOT NULL,
  `FB_U_Mobile` bigint(20) NOT NULL,
  `FB_Message` varchar(200) NOT NULL,
  `FB_Status` text NOT NULL,
  `MsgInfo` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`FB_ID`, `FB_U_Name`, `FB_U_Email`, `FB_U_Mobile`, `FB_Message`, `FB_Status`, `MsgInfo`) VALUES
(2, ' Nitish Goswami', 'ni30.info@gmail.com', 9205816348, '1234', 'Pending', '2021-08-17 15:56:45'),
(3, ' Nitish Goswami', 'ni30.info@gmail.com', 9205816348, 'Hello buudy', 'Pending', '2021-08-17 15:56:45'),
(4, ' Nitish Goswami', 'ni30.info@gmail.com', 0, 'Hello Guys', 'Pending', '2021-08-17 15:59:48');

-- --------------------------------------------------------

--
-- Table structure for table `itemrequest`
--

CREATE TABLE `itemrequest` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `no_of_days` int(11) NOT NULL,
  `Item_Description` varchar(100) NOT NULL,
  `status` text NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itemrequest`
--

INSERT INTO `itemrequest` (`id`, `u_id`, `item_name`, `no_of_days`, `Item_Description`, `status`) VALUES
(10, 140, '1 hp laptop', 20, '8gb ram with ssd', 'FULLFILLED'),
(12, 135, 'Think And Grow Rich', 30, 'I love this book and i am no table to find the copy of this book', 'FULLFILLED');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `rent_days` int(11) NOT NULL,
  `order_status` int(11) NOT NULL,
  `order_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Auto_Order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_id`, `p_id`, `u_id`, `address`, `rent_days`, `order_status`, `order_timestamp`, `Auto_Order_id`) VALUES
(2, 44, 143, '', 4, 0, '2021-06-21 17:36:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `product_age` varchar(100) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_description` varchar(100) NOT NULL,
  `item_city` varchar(255) NOT NULL,
  `product_pic_1` varchar(100) NOT NULL,
  `product_pic_2` varchar(100) NOT NULL,
  `product_pic_3` varchar(100) NOT NULL,
  `product_bill` varchar(100) NOT NULL,
  `product_status` text NOT NULL,
  `req_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_cat_id`, `user_id`, `product_name`, `product_age`, `product_price`, `product_description`, `item_city`, `product_pic_1`, `product_pic_2`, `product_pic_3`, `product_bill`, `product_status`, `req_id`) VALUES
(47, 2, 135, 'Think and gorw rich', '10', 20, 'This book is used to explore a new personality inside you.Its hightime you need this book for you', 'Faridabad', 'Upload/525779468043408502book.jpeg', 'Upload/409029506124301294book 3.jpeg', 'Upload/404862582862321020book 2.jpeg', '', 'Available', 10),
(48, 3, 135, 'Nike 1500', '2', 30, 'Very comfortable shoes and its not too much used', 'Palwal', 'Upload/980746955472771790shoes.jpeg', 'Upload/277056955472771790shoes.jpeg', 'Upload/481826197671552498shoes 3.jpeg', '', 'Available', 10),
(49, 2, 135, 'Rich Dad Poor Dad', '12', 20, 'Best book to explre financial things', 'Palwal', 'Upload/61901197959271952IMG_20210620_083737.jpg', 'Upload/583939184291290276IMG_20210620_083805.jpg', 'Upload/879615749338278810IMG_20210620_083743.jpg', '', 'Available', 10);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `cat_desc` varchar(100) NOT NULL,
  `cat_icon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`cat_id`, `cat_name`, `cat_desc`, `cat_icon`) VALUES
(1, 'Medical Instruments', 'Used to explore information by reading', 'fas fa-briefcase-medical fa-3x'),
(2, 'Books', 'Latest Trending Books', 'fas fa-book fa-3x'),
(3, 'Shoes', 'Trending Shoes\r\n', 'fas fa-shoe-prints fa-3x'),
(4, 'Clothes', 'Trending Clothes', 'fas fa-tshirt fa-3x'),
(5, 'Furniture', 'Latest Furniture', 'fas fa-chair fa-3x'),
(6, 'Electronics', 'Include All Category of Electronics', 'fas fa-mobile fa-3x'),
(7, 'Sports Accessories', '', 'fas fa-table-tennis fa-3x'),
(8, 'Rooms/Flats', '', 'fas fa-hospital-alt fa-3x'),
(9, 'Others', '', 'fa fa-address-book fa-3x');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `msg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `name`, `email`, `pic`, `msg`) VALUES
(3, 'Vikas', 'vikas82393@gmail.com', 'Upload/412348images.jpg', 'it is an awesome website'),
(4, 'Sumit bhardwaj', 'mrkhanger05@gmail.con', 'Upload/806544Screenshot_2021-06-03-00-30-42-533_com.instagram.android.jpg', 'This is the only website where I was successfully able to lend my items without any hassle. '),
(5, 'Nitish', 'ni30.info@gmail.com', 'Upload/369058Nitish.jpg', 'Hello I thing u guys r doing best day by day');

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE `subscriber` (
  `id` int(11) NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriber`
--

INSERT INTO `subscriber` (`id`, `email`, `timestamp`) VALUES
(1, 'Subscribe', '2021-07-07 15:56:55'),
(2, 'Subscribe', '2021-07-07 15:59:44'),
(3, 'Subscribe', '2021-07-07 16:06:19'),
(4, 'ni30.info@gmail.com', '2021-07-07 16:33:36'),
(5, 'ni30.info@gmail.com', '2021-07-07 16:33:46'),
(6, 'ni30.info@gmail.com', '2021-07-07 16:35:36'),
(7, 'khatana2000sandeep@gmail.com', '2021-07-14 05:10:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `google_uid` text NOT NULL,
  `user_fullname` text NOT NULL,
  `user_gender` text NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_phone` text NOT NULL,
  `user_hno` varchar(40) NOT NULL,
  `user_area` varchar(100) NOT NULL,
  `user_pincode` int(10) NOT NULL,
  `user_city` text NOT NULL,
  `user_state` text NOT NULL,
  `user_profile_pic` varchar(200) NOT NULL,
  `user_proof_type` text NOT NULL,
  `user_proof_number` text NOT NULL,
  `user_proof_pic` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `hashcode` varchar(100) NOT NULL,
  `ustatus` int(11) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `google_uid`, `user_fullname`, `user_gender`, `user_email`, `user_phone`, `user_hno`, `user_area`, `user_pincode`, `user_city`, `user_state`, `user_profile_pic`, `user_proof_type`, `user_proof_number`, `user_proof_pic`, `user_password`, `hashcode`, `ustatus`, `timestamp`) VALUES
(135, '', 'Nitish Goswami', '', 'ni30.info@gmail.com', '9205816348', '', '', 0, 'Faridabad', '', 'https://lh3.googleusercontent.com/ogw/ADea4I614rmYimg_owXD1vGivy4HSxRIYjIGTcY3BbJLQw=s192-c-mo', '', '', '731065143324', '1234', '', 1, '2021-08-17 06:46:21'),
(140, '106814142941261675272', 'Hemant Khatana', '', 'hkhatana007@gmail.com', '', '', '', 0, '', '', 'Upload/1605885520408_125865426_150334026774513_2760954036341954378_n.jpg', '', '', '', '', '', 0, '2021-06-24 09:03:30'),
(143, '106118170057934070621', 'Pardeep Khatana', '', 'khatana0018@gmail.com', '', '', '', 0, '', '', 'https://lh3.googleusercontent.com/a/AATXAJwzZvoYwCkUqqrxWvN3_cYafaSZwZZZeVpMRg8x=s96-c', '', '', '', '', '', 0, '2021-06-24 09:03:30'),
(144, '115586430237011811248', 'Harish Khangar', '', 'harishkhangar273@gmail.com', '', '', '', 0, '', '', 'https://lh3.googleusercontent.com/a-/AOh14Gh3-sJ8C9kuGw3iln0-2tBqDn8T3iWsEqntlw9TOq0=s96-c', '', '', '', '', '', 0, '2021-06-24 09:03:30'),
(148, '', 'Balram Saini', '', 'nitish25597@gmail.com', '', '', '', 0, 'Delhi', '', '', '', '', '', '9876Pass@', '', 0, '2021-06-24 09:23:18'),
(153, '', 'Nitish', '', 'Nitishgoswami9876@gmail.com', '', '', '', 0, '', '', '', '', '', '', '9876Pass@', '41018', 0, '2021-08-17 06:59:11'),
(154, '', 'Sapna Kashyap', '', 'sapnakashyap806@gmail.com', '', '', '', 0, '', '', '', '', '', '', '9876Pass@', '92828', 0, '2021-08-17 17:15:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_detail`
--
ALTER TABLE `account_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Bank_User_ID` (`Bank_User_ID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_name`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`FB_ID`);

--
-- Indexes for table `itemrequest`
--
ALTER TABLE `itemrequest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_cat_id` (`product_cat_id`),
  ADD KEY `req_id` (`req_id`),
  ADD KEY `item_city` (`item_city`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriber`
--
ALTER TABLE `subscriber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_detail`
--
ALTER TABLE `account_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `FB_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `itemrequest`
--
ALTER TABLE `itemrequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_detail`
--
ALTER TABLE `account_detail`
  ADD CONSTRAINT `account_detail_ibfk_1` FOREIGN KEY (`Bank_User_ID`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `itemrequest`
--
ALTER TABLE `itemrequest`
  ADD CONSTRAINT `itemrequest_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`product_cat_id`) REFERENCES `product_categories` (`cat_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`req_id`) REFERENCES `itemrequest` (`id`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`item_city`) REFERENCES `city` (`city_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
