-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 10, 2024 at 04:40 PM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u745007485_nexpoint`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(10, 'Milktea', 'Drinks'),
(11, 'Fruitea ', 'Fruitea'),
(12, 'Coffee', ''),
(13, 'Iced Coffee', ''),
(23, 'Ads On', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `ref_no` varchar(50) NOT NULL,
  `total_amount` float NOT NULL,
  `amount_tendered` float NOT NULL,
  `order_number` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `ref_no`, `total_amount`, `amount_tendered`, `order_number`, `date_created`, `user_id`) VALUES
(118, '478124336271', 97, 100, 1, '2024-11-27 00:59:34', NULL),
(119, '718932297756', 234, 234, 2, '2024-11-27 03:35:05', NULL),
(120, '190887466749', 175, 175, 3, '2024-12-06 13:54:30', NULL),
(121, '966885422390', 136, 189, 4, '2024-12-07 06:39:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(30) NOT NULL,
  `order_id` int(30) NOT NULL,
  `user_id` int(30) DEFAULT NULL,
  `product_id` int(30) NOT NULL,
  `qty` int(30) NOT NULL,
  `price` float NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `user_id`, `product_id`, `qty`, `price`, `amount`) VALUES
(232, 74, NULL, 18, 2, 29, 58),
(233, 75, NULL, 16, 2, 29, 58),
(234, 75, NULL, 22, 4, 29, 116),
(235, 75, NULL, 23, 1, 39, 39),
(236, 75, NULL, 29, 2, 39, 78),
(237, 75, NULL, 28, 2, 29, 58),
(238, 75, NULL, 27, 5, 39, 195),
(239, 75, NULL, 19, 1, 39, 39),
(240, 75, NULL, 21, 2, 39, 78),
(241, 75, NULL, 20, 1, 29, 29),
(242, 75, NULL, 26, 1, 29, 29),
(243, 75, NULL, 25, 1, 39, 39),
(244, 76, NULL, 19, 19, 39, 741),
(245, 77, NULL, 17, 1, 39, 39),
(246, 77, NULL, 16, 1, 29, 29),
(247, 77, NULL, 22, 1, 29, 29),
(248, 77, NULL, 23, 1, 39, 39),
(249, 77, NULL, 19, 1, 39, 39),
(250, 77, NULL, 25, 1, 39, 39),
(251, 77, NULL, 18, 1, 29, 29),
(252, 77, NULL, 24, 1, 29, 29),
(253, 77, NULL, 21, 1, 39, 39),
(254, 77, NULL, 27, 3, 39, 117),
(255, 77, NULL, 26, 1, 29, 29),
(256, 77, NULL, 20, 1, 29, 29),
(257, 78, NULL, 17, 1, 39, 39),
(258, 78, NULL, 16, 1, 29, 29),
(259, 78, NULL, 22, 1, 29, 29),
(260, 78, NULL, 23, 1, 39, 39),
(261, 78, NULL, 25, 1, 39, 39),
(262, 79, NULL, 17, 2, 39, 78),
(263, 79, NULL, 16, 1, 29, 29),
(264, 79, NULL, 22, 3, 29, 87),
(265, 79, NULL, 23, 1, 39, 39),
(266, 79, NULL, 25, 1, 39, 39),
(267, 80, NULL, 17, 1, 39, 39),
(268, 80, NULL, 16, 1, 29, 29),
(269, 80, NULL, 22, 1, 29, 29),
(270, 80, NULL, 23, 1, 39, 39),
(271, 80, NULL, 25, 1, 39, 39),
(272, 80, NULL, 19, 1, 39, 39),
(273, 80, NULL, 18, 1, 29, 29),
(274, 80, NULL, 24, 1, 29, 29),
(275, 81, NULL, 19, 1, 39, 39),
(276, 81, NULL, 16, 1, 29, 29),
(277, 82, NULL, 17, 2, 39, 78),
(278, 82, NULL, 22, 3, 29, 87),
(279, 82, NULL, 24, 2, 29, 58),
(280, 82, NULL, 26, 2, 29, 58),
(281, 82, NULL, 20, 1, 29, 29),
(282, 83, NULL, 16, 1, 29, 29),
(283, 83, NULL, 17, 1, 39, 39),
(284, 83, NULL, 23, 1, 39, 39),
(285, 83, NULL, 22, 2, 29, 58),
(286, 83, NULL, 28, 2, 29, 58),
(287, 83, NULL, 25, 1, 39, 39),
(288, 83, NULL, 24, 1, 29, 29),
(289, 84, NULL, 17, 2, 39, 78),
(290, 84, NULL, 16, 2, 29, 58),
(291, 84, NULL, 22, 1, 29, 29),
(292, 84, NULL, 28, 1, 29, 29),
(293, 85, NULL, 17, 2, 39, 78),
(294, 85, NULL, 16, 2, 29, 58),
(295, 85, NULL, 22, 1, 29, 29),
(296, 85, NULL, 28, 1, 29, 29),
(297, 86, NULL, 17, 3, 39, 117),
(298, 87, NULL, 20, 1, 29, 29),
(299, 87, NULL, 21, 1, 39, 39),
(300, 87, NULL, 27, 2, 39, 78),
(301, 87, NULL, 24, 1, 29, 29),
(302, 87, NULL, 25, 1, 39, 39),
(303, 88, NULL, 16, 2, 29, 58),
(304, 89, NULL, 16, 1, 39, 39),
(305, 90, NULL, 17, 6, 39, 234),
(306, 91, NULL, 17, 1, 39, 39),
(307, 91, NULL, 16, 3, 39, 117),
(308, 91, NULL, 22, 5, 29, 145),
(309, 91, NULL, 23, 2, 39, 78),
(310, 91, NULL, 29, 3, 39, 117),
(311, 91, NULL, 28, 2, 29, 58),
(312, 91, NULL, 25, 4, 39, 156),
(313, 91, NULL, 24, 4, 29, 116),
(314, 91, NULL, 27, 2, 39, 78),
(315, 91, NULL, 26, 1, 29, 29),
(316, 91, NULL, 18, 2, 29, 58),
(317, 91, NULL, 21, 1, 39, 39),
(318, 91, NULL, 19, 1, 39, 39),
(319, 92, NULL, 16, 1, 39, 39),
(320, 93, NULL, 16, 1, 39, 39),
(321, 93, NULL, 17, 1, 39, 39),
(322, 93, NULL, 23, 2, 39, 78),
(323, 93, NULL, 22, 1, 29, 29),
(324, 93, NULL, 25, 1, 39, 39),
(325, 93, NULL, 24, 2, 29, 58),
(326, 93, NULL, 28, 1, 29, 29),
(327, 93, NULL, 29, 1, 39, 39),
(328, 94, NULL, 19, 2, 39, 78),
(329, 94, NULL, 16, 1, 39, 39),
(330, 94, NULL, 22, 1, 29, 29),
(331, 94, NULL, 25, 1, 39, 39),
(332, 94, NULL, 18, 1, 29, 29),
(333, 94, NULL, 24, 1, 29, 29),
(334, 95, NULL, 17, 1, 39, 39),
(335, 95, NULL, 19, 1, 39, 39),
(336, 95, NULL, 16, 2, 39, 78),
(337, 95, NULL, 22, 1, 29, 29),
(338, 96, NULL, 17, 2, 39, 78),
(339, 96, NULL, 22, 1, 29, 29),
(340, 97, NULL, 19, 1, 39, 39),
(341, 97, NULL, 16, 1, 39, 39),
(342, 98, NULL, 17, 1, 39, 39),
(343, 98, NULL, 16, 1, 39, 39),
(344, 98, NULL, 22, 1, 29, 29),
(345, 98, NULL, 23, 1, 39, 39),
(346, 98, NULL, 28, 1, 29, 29),
(347, 98, NULL, 29, 1, 39, 39),
(348, 99, NULL, 16, 1, 39, 39),
(349, 100, NULL, 25, 1, 39, 39),
(350, 100, NULL, 28, 2, 29, 58),
(351, 103, NULL, 19, 1, 39, 39),
(352, 104, NULL, 18, 1, 29, 29),
(353, 104, NULL, 19, 1, 39, 39),
(356, 106, NULL, 25, 1, 39, 39),
(357, 106, NULL, 22, 1, 29, 29),
(358, 106, NULL, 28, 2, 29, 58),
(363, 108, NULL, 16, 1, 39, 39),
(364, 108, NULL, 22, 1, 29, 29),
(365, 108, NULL, 24, 1, 29, 29),
(366, 109, NULL, 25, 1, 39, 39),
(367, 109, NULL, 24, 1, 29, 29),
(368, 109, NULL, 27, 1, 39, 39),
(369, 109, NULL, 21, 1, 39, 39),
(370, 109, NULL, 19, 3, 39, 117),
(371, 109, NULL, 16, 1, 39, 39),
(372, 109, NULL, 17, 1, 39, 39),
(373, 109, NULL, 22, 1, 29, 29),
(374, 109, NULL, 29, 1, 39, 39),
(375, 109, NULL, 28, 1, 29, 29),
(376, 110, NULL, 20, 1, 29, 29),
(377, 110, NULL, 21, 1, 39, 39),
(378, 110, NULL, 18, 2, 29, 58),
(379, 110, NULL, 24, 1, 29, 29),
(380, 111, NULL, 20, 1, 29, 29),
(381, 111, NULL, 28, 1, 29, 29),
(382, 112, NULL, 16, 1, 39, 39),
(383, 112, NULL, 17, 1, 39, 39),
(384, 112, NULL, 23, 2, 39, 78),
(385, 112, NULL, 22, 2, 29, 58),
(386, 112, NULL, 28, 1, 29, 29),
(387, 113, NULL, 17, 1, 39, 39),
(388, 113, NULL, 16, 1, 39, 39),
(389, 114, NULL, 17, 1, 39, 39),
(390, 114, NULL, 23, 1, 39, 39),
(391, 114, NULL, 22, 1, 29, 29),
(392, 114, NULL, 16, 1, 39, 39),
(393, 114, NULL, 19, 1, 39, 39),
(394, 114, NULL, 25, 1, 39, 39),
(395, 115, NULL, 19, 1, 39, 39),
(396, 116, NULL, 17, 1, 39, 39),
(397, 116, NULL, 16, 1, 39, 39),
(398, 116, NULL, 22, 2, 29, 58),
(399, 116, NULL, 23, 1, 39, 39),
(400, 117, NULL, 19, 1, 39, 39),
(401, 117, NULL, 18, 1, 29, 29),
(402, 117, NULL, 21, 1, 39, 39),
(403, 118, NULL, 18, 1, 29, 29),
(404, 118, NULL, 21, 1, 39, 39),
(405, 118, NULL, 20, 1, 29, 29),
(406, 119, NULL, 17, 3, 39, 117),
(407, 119, NULL, 16, 3, 39, 117),
(408, 120, NULL, 19, 1, 39, 39),
(409, 120, NULL, 18, 1, 29, 29),
(410, 120, NULL, 16, 1, 39, 39),
(411, 120, NULL, 22, 1, 29, 29),
(412, 120, NULL, 27, 1, 39, 39),
(413, 121, NULL, 23, 1, 39, 39),
(414, 121, NULL, 25, 1, 39, 39),
(415, 121, NULL, 24, 2, 29, 58);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=Unavailable,1=Available',
  `quantity` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `status`, `quantity`, `image`) VALUES
(16, 10, 'Chocolate Medium', 'Chocolate', 39, 1, 10, 'chocolate.jpg'),
(17, 10, 'Chocolate Large', 'Chocolate', 39, 1, 10, 'chocolate.jpg'),
(18, 10, 'Classic Medium', 'Classic', 29, 1, 10, 'classic.png'),
(19, 10, 'Classic Large', 'Classic', 39, 1, 10, 'classic.png'),
(20, 10, 'Cookies And Cream Medium', 'Cookies And Cream', 29, 1, 10, 'cookiesAndCream.png'),
(21, 10, 'Cookies And Cream Large', 'Cookies And Cream', 39, 1, 10, 'cookiesAndCream.png'),
(22, 10, 'Red Velvet Medium', 'Red Velvet', 29, 1, 10, 'red velvet.png'),
(23, 10, 'Red Velvet Large', 'Red Velvet Large', 39, 1, 10, 'red velvet.png'),
(24, 10, 'Strawberry Medium', 'Strawberry', 29, 1, 10, 'strawberry.png'),
(25, 10, 'Strawberry Large', 'Strawberry', 39, 1, 10, 'strawberry.png'),
(26, 10, 'Taro Medium', 'Taro', 29, 1, 10, 'taro.png'),
(27, 10, 'Taro Large', 'Taro', 39, 1, 10, 'taro.png'),
(28, 10, 'Wintermelon Medium', 'Wintermelon', 29, 1, 10, 'Wintermelon.png'),
(29, 10, 'Wintermelon Large', 'Wintermelon', 39, 1, 10, 'Wintermelon.png');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `cover_img`, `about_content`) VALUES
(1, 'teastreet.ph', 'teastreet.ph@gmail.com', '9000000000', '', '&lt;p&gt;teastreet.ph teastreet.ph teastreet.ph teastreet.ph&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `customer_name` varchar(150) DEFAULT NULL,
  `customer_contact` varchar(20) DEFAULT NULL,
  `customer_email` varchar(150) DEFAULT NULL,
  `customer_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Apple manggo', 39.00, 2, 39.00, '2024-11-03 03:49:48', 'On Delivery', NULL, NULL, NULL, NULL),
(2, 'Coffeelatte', 49.00, 1, 49.00, '2024-11-02 03:52:43', 'On Delivery', 'Lookie look', '09856756435', 'fexekihor@mailinator.com', 'Incidunt ipsum ad d'),
(3, 'Chocolate', 29.00, 1, 29.00, '2024-11-01 04:07:17', 'Cancelled', 'jonas bernes', '09856756435', 'tydujy@mailinator.com', 'Minima iure ducimus');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(15) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 3 COMMENT '0=SuperAdmin,1=Admin,2=Staff,3=Customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `number`, `password`, `type`) VALUES
(21, 'admin', 'admin', '', '', '3f38541b37c7e092db69c65ed953c30c', 1),
(22, 'superadmin', 'superadmin', '', '', '3f38541b37c7e092db69c65ed953c30c', 0),
(26, 'staff', 'staff', '', '', 'de9bf5643eabf80f4a56fda3bbb84483', 2),
(27, 'Juan Carlo', 'juanstaff', '', '', 'de9bf5643eabf80f4a56fda3bbb84483', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_items_user` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=416;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_order_items_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
