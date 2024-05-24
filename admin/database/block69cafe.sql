-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 06:50 AM
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
-- Database: `block69cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `homecontent`
--

CREATE TABLE `homecontent` (
  `content_id` int(100) NOT NULL,
  `content_title` varchar(255) NOT NULL,
  `content_caption` varchar(255) NOT NULL,
  `content_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homecontent`
--

INSERT INTO `homecontent` (`content_id`, `content_title`, `content_caption`, `content_image`) VALUES
(1, '<p>Clubhouse Sandwich Savor, served with crispy fries and a refreshing 12 oz iced tea.&nbsp;</p>', '<p>Upgrade your iced tea to 16 oz or any Block 69 beverage for just an additional 20! Don\'t forget, our Clubhouse Sandwich is also available solo without fries and drink!&nbsp;</p>', './Images/Clubhouse bundle design1.png'),
(2, '<p>A perfect blend of art, flavors, and fun! Which workshop would you like to join next?</p>', '<p>Embarked on a successful tote bag painting extravaganza today, fueled by the delightful combination of coffee and non-coffee, scrumptious food, and an abundance of creative joy.</p>', './Images/Workshop.jpg'),
(5, '<p>Keep an eye out on Block 69\'s latte.&nbsp;</p>', '<p>Embark on a through the heart of these vibrant cafes, where every cup holds a tale and each corner whispers cozy conversations.</p>', './Images/latte.jpg'),
(7, '<p>Indulge in the ultimate non-coffee delights that have won over crowds everywhere!</p>', '<p>Have you treated yourself to the refreshing allure of our Pink Paradise or the tantalizing blend of flavors in our Dark Berry? Sip, savor, and discover your new favorites today!</p>', './Images/dark berry design2.png'),
(8, '<p>Warning: Proceed with caution.</p>', '<p>These pastries have been known to cause uncrontrollable smiles and sudden cravings. Eat at your own risk!</p>', './Images/pastries (1).png');

-- --------------------------------------------------------

--
-- Table structure for table `menucontent`
--

CREATE TABLE `menucontent` (
  `product_id` int(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_subname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menucontent`
--

INSERT INTO `menucontent` (`product_id`, `product_image`, `product_name`, `product_subname`) VALUES
(1, 'BLK/VANILLA CAFE LATTE.png', 'Espresso', 'Iced/Hot'),
(2, 'BLK/COLD BREW.png', 'Brew', 'Iced/Hot'),
(3, 'BLK/PINK PARADISE.png', 'Non Coffee And Tea', ''),
(4, 'BLK/MATCHA MANGO.png', 'Matcha', ''),
(5, 'BLK/NONE.png', 'Beverages', ''),
(6, 'BLK/FRENCH TOAST.png', 'All Day Breakfast', ''),
(7, 'BLK/NONE.png', 'Silog', ''),
(8, 'BLK/AGLIO OLIO.png', 'Pasta', ''),
(9, 'BLK/CHICKEN KATSUDON.png', 'Block 69 Bargain Bites', ''),
(10, 'BLK/NONE.png', 'Sides And Nibbles', ''),
(11, 'BLK/CLUBHOUSE SANDWICH.png', 'Carbs And Caffeine', '');

-- --------------------------------------------------------

--
-- Table structure for table `menuitems`
--

CREATE TABLE `menuitems` (
  `item_id` int(255) NOT NULL,
  `item_image` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_subname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menuitems`
--

INSERT INTO `menuitems` (`item_id`, `item_image`, `item_name`, `item_subname`) VALUES
(1, 'BLK/SPANISH LATTE.png', 'Spanish Latte', ''),
(2, 'BLK/WHITE CHOCO LATTE.png', 'White Choco Latte', ''),
(3, 'BLK/MOCHA LATTE.png', 'Mocha Latte', ''),
(4, 'BLK/CINNAMON BROWN LATTE.png', 'Cinnamon Brown Latte', ''),
(5, 'BLK/CARAMEL VANILLA MACCHIATO.png', 'Caramel Vanilla Macchiato', ''),
(6, 'BLK/CAFE LATTE.png', 'Cafe Latte', ''),
(7, 'BLK/VANILLA CAFE LATTE.png', 'Vanilla Cafe Latte', ''),
(8, 'BLK/HAZELNUT CAFE LATTE.png', 'Hazelnut Cafe Latte', ''),
(9, 'BLK/SALTED CARAMEL LATTE.png', 'Salted Caramel Latte', ''),
(10, 'BLK/AMERICANO.png', 'Americano', ''),
(11, 'BLK/MIDNIGHT CHERRY.png', 'Midnight Cherry', ''),
(12, 'BLK/ESPRESSO CLOUD.png', 'Espresso Cloud', ''),
(13, 'BLK/HOT BREWED COFFEE.png', 'Hot Brewed Coffee', ''),
(14, 'BLK/COLD BREW.png', 'Cold Brew', ''),
(15, 'BLK/ICED COFFEE.png', 'Iced Coffee ', ''),
(16, 'BLK/VANILLA.png', 'Vanilla', ''),
(17, 'BLK/HAZELNUT.png', 'Hazelnut', ''),
(18, 'BLK/CARAMEL.png', 'CARAMEL', ''),
(19, 'BLK/HOT CHOCOLATE.png', 'Hot Chocolate', ''),
(20, 'BLK/TRIPLE CHOCOLATE.png', 'Triple Chocolate', ''),
(21, 'BLK/PINK PARADISE.png', 'Pink Paradise', ''),
(22, 'BLK/TROPICAL CLOUD.png', 'Tropical Cloud', ''),
(23, 'BLK/CARAMEL CANDY.png', 'Caramel Candy', ''),
(24, 'BLK/DARK BERRY.png', 'Dark Berry', ''),
(25, 'BLK/VANILLA MCDREAMY.png', 'Vanilla McDreamy', ''),
(26, 'BLK/CHAMOMILE TEA.png', 'Chamomile Tea', ''),
(27, 'BLK/PURPLE BLOOM.png', 'Purple Bloom', ''),
(28, 'BLK/LAVENDER TEA.png', 'Lavender Tea', ''),
(29, 'BLK/PURE GREEN TEA.png', 'Pure Green Tea', ''),
(30, 'BLK/ENGLISH BREAKFAST TEA.png', 'English Breakfast Tea', ''),
(31, 'BLK/WILD BERRY.png', 'Wild Berry', ''),
(32, 'BLK/HIBISCUS TEA.png', 'Hibiscus Tea', ''),
(33, 'BLK/STRAWBERRY AND MANGO.png', 'Strawberry And Mango', ''),
(34, 'BLK/MATCHA MANGO.png', 'Matcha Mango', ''),
(35, 'BLK/NUTTY GREEN TEA.png', 'Nutty Green Tea', ''),
(36, 'BLK/VANILLA KISSED MATCHA.png', 'Vanilla Kissed Matcha', ''),
(37, 'BLK/SPICY MATCHA.png', 'Spicy Matcha', ''),
(38, 'BLK/TITA MAGGIE\'S MATCHA.png', 'Tita Maggie\'s Matcha', ''),
(39, 'BLK/WHITEOUT MATCHA.png', 'Whiteout Matcha\r\n', ''),
(40, 'BLK/MATCHA LATTE.png', 'Matcha Latte', ''),
(41, 'BLK/DIRTY MATCHA.png', 'Dirty Matcha', ''),
(42, 'BLK/GREEN AND SWEET.png', 'Green And Sweet', ''),
(43, 'ICHIGO MATCHA', 'Ichigo Matcha', ''),
(44, 'BLK/MANGO JUICE.png', 'Mango Juice', ''),
(45, 'BLK/CUCUMBER JUICE.png', 'Cucumber Juice', ''),
(46, 'BLK/ICED TEA.png', 'Iced Tea', ''),
(47, 'BLK/COCA-COLA ZERO.png', 'Coca-Cola Zero', ''),
(48, 'BLK/REGULAR COCA-COLA.png', 'Regular Coca-Cola', ''),
(49, 'BLK/PEPSI.png', 'Pepsi', ''),
(50, 'BLK/POFFERTJES.png', 'Poffertjes', ''),
(51, 'BLK/FLUFFY PANCAKES.png', 'Fluffy Pancakes', ''),
(52, 'BLK/FRENCH TOAST.png', 'French Toast', ''),
(53, 'BLK/CLASSIC WAFFLES.png', 'Classic Waffles', ''),
(54, 'BLK/MARGA\'S FAVE.png', 'Marga\'s Fave', ''),
(55, 'BLK/BREAKFAST PLATTER.png', 'Breakfast Platter', ''),
(56, 'BLK/CHICKSILOG.png', 'Chicksilog', ''),
(57, 'BLK/TAPSILOG.png', 'Tapsilog', ''),
(58, 'BLK/LUNCHEONSILOG.png', 'Luncheonsilog', ''),
(59, 'BLK/BACSILOG.png', 'Bacsilog', ''),
(60, 'BLK/CARROT RICE.png', 'Carrot Rice', ''),
(61, 'BLK/PLAIN RICE.png', 'Plain Rice', ''),
(62, 'BLK/CHICKEN PESTO.png', 'Chicken Pesto', ''),
(63, 'BLK/GOURMET TUYO.png', 'Gourmet Tuyo', ''),
(64, 'BLK/AGLIO OLIO.png', 'Aglio Olio', ''),
(65, 'BLK/GARLIC BREAD.png', 'Garlic Bread', ''),
(66, 'BLK/CHICKEN POPPERS.png', 'Chicken Poppers', ''),
(67, 'BLK/CHICKEN TERIYAKI.png', 'Chicken Teriyaki', ''),
(68, 'BLK/PORK TERIYAKI.png', 'Pork Teriyaki', ''),
(69, 'BLK/CHICKEN KATSUDON.png', 'Chicken Katsudon', ''),
(70, 'BLK/PORK KATSUDON.png', 'Pork Katsudon', ''),
(71, 'BLK/FRIES.png', 'Fries', ''),
(72, 'BLK/FRIES BEFORE GUYS.png', 'Fries Before Guys', ''),
(73, 'BLK/MOZZARELLA BALLS.png', 'Mozzarella Balls', ''),
(74, 'BLK/NACHOS OVERLOAD.png', 'Nachos Overload', ''),
(75, 'BLK/CHICKEN BALLS.png', 'Chicken Balls', ''),
(76, 'BLK/CHICKEN BALLS MIX.png', 'Chicken Balls Mix', ''),
(77, 'BLK/CALAMARI.png', 'Calamari', ''),
(78, 'BLK/CALAMARI MIX.png', 'Calamari Mix', ''),
(79, 'BLK/HASHBROWN.png', 'Hashbrown', ''),
(80, 'BLK/CLUBHOUSE SANDWICH.png', 'Clubhouse Sandwich', ''),
(81, 'BLK/PAIN AU CHOCOLAT.png', 'Pain Au Chocolat', ''),
(82, 'BLK/BUTTER CROISSANT.png', 'Butter Croissant', ''),
(83, 'BLK/CROISSANWICH.png', 'Croissanwich', ''),
(84, 'BLK/PLAIN.png', 'Plain', ''),
(85, 'BLK/STRAWBERRY FIELD.png', 'Strawberry Field', ''),
(86, 'BLK/MANGO TANGO.png', 'Mango Tango', ''),
(87, 'BLK/CHOCO TRUFFLE.png', 'Choco Truffle', '');

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `email` varchar(50) NOT NULL,
  `status` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`email`, `status`, `username`, `password`, `token`) VALUES
('meinardsantoss@gmail.com', 'admin', 'admin', 'admin123', '8db91abafce16bb01ade0bedb9fbe692'),
('eric123@gmail.com', 'customer', 'eric', 'hehehe', NULL),
('louigiecads143@gmail.com', 'customer', 'louie', 'louie123', '7ee3c0a3286f4a80e257b9740230d7c4'),
('msantos.k12147976@umak.edu.ph', 'customer', 'meinard', 'umak', '09438bc6dfd88b40ebfae5159ea11cc1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `homecontent`
--
ALTER TABLE `homecontent`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `menucontent`
--
ALTER TABLE `menucontent`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `menuitems`
--
ALTER TABLE `menuitems`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `useraccounts`
--
ALTER TABLE `useraccounts`
  ADD PRIMARY KEY (`username`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `homecontent`
--
ALTER TABLE `homecontent`
  MODIFY `content_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `menucontent`
--
ALTER TABLE `menucontent`
  MODIFY `product_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `menuitems`
--
ALTER TABLE `menuitems`
  MODIFY `item_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
