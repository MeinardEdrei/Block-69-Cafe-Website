-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2024 at 03:14 PM
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
-- Table structure for table `aboutcontent`
--

CREATE TABLE `aboutcontent` (
  `id` int(11) NOT NULL,
  `title_header` varchar(255) NOT NULL,
  `title_caption` varchar(255) NOT NULL,
  `content_caption` varchar(1255) NOT NULL,
  `image_about` varchar(255) NOT NULL,
  `title_mission` varchar(255) NOT NULL,
  `content_mission` varchar(1000) NOT NULL,
  `title_vision` varchar(255) NOT NULL,
  `content_vision` varchar(1000) NOT NULL,
  `image2_about` varchar(255) NOT NULL,
  `title_competitive` varchar(255) NOT NULL,
  `caption_competitive` varchar(1000) NOT NULL,
  `caption2nd_competitive` varchar(1000) NOT NULL,
  `title_landscape` varchar(255) NOT NULL,
  `content_landscape` varchar(1000) NOT NULL,
  `image3_about` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aboutcontent`
--

INSERT INTO `aboutcontent` (`id`, `title_header`, `title_caption`, `content_caption`, `image_about`, `title_mission`, `content_mission`, `title_vision`, `content_vision`, `image2_about`, `title_competitive`, `caption_competitive`, `caption2nd_competitive`, `title_landscape`, `content_landscape`, `image3_about`) VALUES
(1, '<p>Our Company</p>', '<p>Learn More About Us</p>', '<p>Our menu features a wide selection of hot and cold drinks, including various coffee and tea options and refreshing fruit juices. We also offer a variety of sweet and savory snacks, breakfast items, sandwiches, and pastries, all-day- breakfast meals all made with fresh and locally sourced ingredients whenever possible.<br><br>At Block 72 Café, we prioritize customer satisfaction, and our friendly and knowledgeable staff are always happy to assist with recommendations or dietary restrictions. We also offer free Wi-Fi and ample seating, offering fun activities for the customers and making our cafe the perfect spot for a quick bite or a relaxing time.<br><br>Whether you\'re in the mood for a latte and a croissant or a hearty sandwich and a cold brew, we\'ve got you covered at Block 69 Café. Come by and experience our cozy and inviting atmosphere for yourself!</p>', './Images/about-us.jpg', '<p>Missionx</p>', '<p>Our mission is to provide quality yet affordable coffee to the neighborhood</p>', '<p>Vision</p>', '<p>Our objective is to extend our presence beyond the immediate vicinity to cover not only the neighborhood but also the entire Metro Manila region in 2024. By 2025, we aim to establish a presence outside the Metro, including within malls. Our ambitious plan for 2030 involves the establishment of over five hundred kiosks and cafes throughout the Philippines.</p>', './Images/img2.JPG', '<p>COMPETITIVE ADVANTAGES</p>', '<p>Our competitive advantage lies in the following factors:</p><p>Personalized Service: We prioritize customer satisfaction by providing personalized service to each of our customers. Our baristas and staff take the time to get to know each customer and their preferences, creating a warm and welcoming atmosphere.&nbsp;</p><ul><li>Fresh and Local Ingredients: We source our ingredients locally and use only the freshest ingredients in our baked goods, plates of pasta, rice meals, and coffee. This allows us to offer high-quality products that our customers appreciates.</li></ul>', '<p>Our competitive advantage lies in the following factors:</p><p>Personalized Service: We prioritize customer satisfaction by providing personalized service to each of our customers. Our baristas and staff take the time to get to know each customer and their preferences, creating a warm and welcoming atmosphere.&nbsp;</p><ul><li>Fresh and Local Ingredients: We source our ingredients locally and use only the freshest ingredients in our baked goods, plates of pasta, rice meals, and coffee. This allows us to offer high-quality products that our customers appreciate.</li></ul>', '<p>COMPETITIVE LANDSCAPE</p>', '<p>In the area, there are several other cafes that offer similar products and services. However, we differentiate ourselves by focusing on providing a warm and friendly environment for our customers, with personalized service and attention to detail. We impart great experiences through our different services. The cafe has also been awarded a Recommendation badge by Restaurant Guru, one of the world\'s most popular foodie websites with over 30 million monthly users.</p>', './Images/img3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `barservicescontent`
--

CREATE TABLE `barservicescontent` (
  `id` int(11) NOT NULL,
  `image_barservices` varchar(255) NOT NULL,
  `title_barservices` varchar(255) NOT NULL,
  `content_barservices` varchar(1000) NOT NULL,
  `title_booking` varchar(255) NOT NULL,
  `content_booking` varchar(100) NOT NULL,
  `list_inclusion` varchar(1000) NOT NULL,
  `list_additional` varchar(1000) NOT NULL,
  `content_request` varchar(1000) NOT NULL,
  `content_forevents` varchar(1000) NOT NULL,
  `content_addons` varchar(1000) NOT NULL,
  `title_flavors` varchar(255) NOT NULL,
  `title_premium` varchar(255) NOT NULL,
  `title_basic` varchar(255) NOT NULL,
  `premium_coffee` varchar(1000) NOT NULL,
  `premium_noncoffee` varchar(1000) NOT NULL,
  `basic_coffee` varchar(1000) NOT NULL,
  `basic_noncoffee` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barservicescontent`
--

INSERT INTO `barservicescontent` (`id`, `image_barservices`, `title_barservices`, `content_barservices`, `title_booking`, `content_booking`, `list_inclusion`, `list_additional`, `content_request`, `content_forevents`, `content_addons`, `title_flavors`, `title_premium`, `title_basic`, `premium_coffee`, `premium_noncoffee`, `basic_coffee`, `basic_noncoffee`) VALUES
(1, './Images/banner-barservices.png', '<p>BAR SERVICES</p>', '<p>Merol Sipum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut</p>', '<p>COFFEE BAR</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt</p>', '<ul><li>Full setup</li><li>Experienced Baristas&nbsp;</li><li>Benguet Arabic Beans</li><li>Hot or Ice Drinks&nbsp;</li><li>Mobile Coffee Bar setup&nbsp;</li><li>Gemilai Dual Boiler Espresso Machine</li><li>Bestselling Espresso Drinks</li><li>Bestselling Non-Coffee Drinks&nbsp;</li><li>3-4 Hours Free transpo fee within Metro Manila&nbsp;</li><li>Mobile Coffee Bar setup&nbsp;</li><li>Selfie Mirror&nbsp;</li><li>Coffee Branch</li></ul>', '<ul><li>Transportation fee (outside Metro Manila)</li><li>&nbsp;Coffee Stickers or Coffee Sleeves&nbsp;</li><li>Acrylic Sign&nbsp;</li><li>Sintra Boards&nbsp;</li><li>Excess Cups&nbsp;</li><li>Cups Excess</li><li>Swimming Pool</li></ul>', 'message our Facebook/IG : @block69cafe email block69cafe@gmail.com', 'weddings, birthdays, baby showers, corporate events, intimate gatherings and the like!', 'Drip Coffee & Syrup giveaways (customizable), additional templated stickers on cups', '<p>Our Flavor</p>', '<p>PREMIUM</p>', '<p>BASIC</p>', '<ul><li>Spanish Latte&nbsp;</li><li>Salted Caramel Latte&nbsp;</li><li>Caramel-Vanilla Machiatto&nbsp;</li><li>White Chocolate Latte</li><li>Chocolate Beans</li><li>Chip Silog</li><li>Dog Silog</li></ul>', '<ul><li>Matcha Latte</li><li>Ichigo Matcha</li><li>Tropical Cloud (mangoes &amp; cream)</li><li>Pink Paradise (strawberry &amp; cream)</li><li>Triple Chocolate</li><li>&nbsp;</li></ul>', '<ul><li>Cafe Latte Americano&nbsp;</li><li>Brewed Coffee</li><li>&nbsp;</li></ul>', '<p>Matcha Latte</p><ul><li>Ichigo Matcha</li><li>Tropical Cloud (mangoes &amp; cream)</li><li>Pink Paradise (strawberry &amp; cream)</li><li>Triple Chocolate</li><li>Bread</li></ul>');

-- --------------------------------------------------------

--
-- Table structure for table `blogcontents`
--

CREATE TABLE `blogcontents` (
  `blogIDNum` int(5) NOT NULL,
  `blogTitle` text NOT NULL,
  `blogDate` text NOT NULL,
  `blogText` text NOT NULL,
  `blogImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogcontents`
--

INSERT INTO `blogcontents` (`blogIDNum`, `blogTitle`, `blogDate`, `blogText`, `blogImage`) VALUES
(1, 'BLOCK 69: CHECK', '2024-06-01', 'hehehehe', 'blog_db_images/1x1 (1).png');

-- --------------------------------------------------------

--
-- Table structure for table `blogslider`
--

CREATE TABLE `blogslider` (
  `blogIDNum` int(5) NOT NULL,
  `blogSliderImage` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogslider`
--

INSERT INTO `blogslider` (`blogIDNum`, `blogSliderImage`) VALUES
(1, 'blog_db_sliderImages/f46e032d-b870-44e6-b083-b8d222ce66cb.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cafebarkadapackage`
--

CREATE TABLE `cafebarkadapackage` (
  `id` int(11) NOT NULL,
  `pax` varchar(5000) NOT NULL,
  `rate` varchar(5000) NOT NULL,
  `inclusion` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cafebarkadapackage`
--

INSERT INTO `cafebarkadapackage` (`id`, `pax`, `rate`, `inclusion`) VALUES
(1, '10', 'PHP 10,524.42', '1 setCalamari Platter, Fries Platter, Chicken Balls Platter, and Nachos Overload'),
(2, '15', 'PHP 12,086.14', '1 setCalamari Platter, Fries Platter, Chicken Balls Platter, and Nachos Overload; Additional 1 choice of platter'),
(3, '20', 'PHP 13,020.67', '2 setCalamari Platter, Fries Platter, Chicken Balls Platter, and Nachos Overload'),
(4, '25', 'PHP 14,582.40', '2 setCalamari Platter, Fries Platter, Chicken Balls Platter, and Nachos Overload; Additional 2 choices of platter'),
(5, '30', 'PHP 15,516.93 ', '3 setCalamari Platter, Fries Platter, Chicken Balls Platter, and Nachos Overload');

-- --------------------------------------------------------

--
-- Table structure for table `cafepackagescontents`
--

CREATE TABLE `cafepackagescontents` (
  `id` int(11) NOT NULL,
  `title` varchar(5000) NOT NULL,
  `description` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cafepackagescontents`
--

INSERT INTO `cafepackagescontents` (`id`, `title`, `description`) VALUES
(1, 'CAFE PACKAGE B:', 'Choose from the following options (mix and match available): Chicken Poppers, Chicken teriyaki, Pork Teriyaki, Chicken Katsudon, Pork Katsudon. Includes the following: Chocolate muffin, 16 oz iced/hot coffee or non-coffee beverage, 3-hour cafe booking, unlimited use of board games, free dedication cake, use of WiFi and electricity, balloon with easel and name, French mirror for selfies.'),
(2, 'CAFE PACKAGE C:', 'Choose from the following options (mix and match available): Chicksilog, Tapsilog, Luncheonsilog, Bacsilog. Includes the following: Chocolate muffin, 16 oz iced/hot coffee or non-coffee beverage, 3-hour cafe booking, unlimited use of board games, free dedication cake, use of WiFi and electricity, balloon with easel and name, French mirror for selfies.'),
(3, 'CAFE PACKAGE D:', 'Choose from the following options (mix and match available): Chicken Pesto, Gourmet Tuyo, Aglio Olio. Includes the following: Garlic Bread, Tiramisu, 16 oz iced/hot coffee or non-coffee beverage, 3-hour cafe booking, unlimited use of board games, free dedication cake, use of WiFi and electricity, balloon with easel and name, French mirror for selfies.'),
(4, 'CAFE PACKAGE E:', 'Choose from the following options (mix and match available): Chicken Pesto (with Garlic Bread), Gourmet Tuyo (with Garlic Bread), Aglio Olio (with Garlic Bread). Includes the following: Tiramisu/Muffin, 16 oz iced/hot coffee or non-coffee beverage, 3-hour cafe booking, unlimited use of board games, free dedication cake, use of WiFi and electricity, balloon with easel and name, French mirror for selfies.');

-- --------------------------------------------------------

--
-- Table structure for table `cafepackageshomecontent`
--

CREATE TABLE `cafepackageshomecontent` (
  `id` int(11) NOT NULL,
  `title` varchar(1500) NOT NULL,
  `description` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cafepackageshomecontent`
--

INSERT INTO `cafepackageshomecontent` (`id`, `title`, `description`) VALUES
(1, 'Cafe Packages', 'Please note that there is a corkage fee of PHP 500 for each item brought into the venue. VAT inclusive.'),
(2, 'CAFE BARKADA PACKAGE', 'Choose from the following options (mix and match available): Chicksilog, Tapsilog, Luncheonsilog, Bacsilog. Includes the following: Chocolate muffin, 16 oz iced/hot coffee or non-coffee beverage, 3-hour cafe booking, unlimited use of board games, free dedication cake, use of WiFi and electricity, balloon with easel and name, French mirror for selfies.');

-- --------------------------------------------------------

--
-- Table structure for table `cafepackagespaxandprices`
--

CREATE TABLE `cafepackagespaxandprices` (
  `id` int(11) NOT NULL,
  `pax` varchar(1500) NOT NULL,
  `rate` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cafepackagespaxandprices`
--

INSERT INTO `cafepackagespaxandprices` (`id`, `pax`, `rate`) VALUES
(1, '10', 'PHP 17,248.00'),
(2, '15', 'PHP 19,096.00'),
(3, '20', 'PHP 20,944.00'),
(4, '25', 'PHP 22,792.00'),
(5, '30', 'PHP 24,640.00'),
(6, '10', 'PHP 18,726.40'),
(7, '15', 'PHP 21,313.60'),
(8, '20', 'PHP 23,900.80'),
(9, '25', 'PHP 26,488.00'),
(10, '30', 'PHP 29,075.20'),
(11, '10', 'PHP 19,712.00'),
(12, '15', 'PHP 22,792.00'),
(13, '20', 'PHP 25,872.00'),
(14, '25', 'PHP 28,952.00'),
(15, '30', 'PHP 32,032.00'),
(16, '10', 'PHP 19,096.00'),
(17, '15', 'PHP 21,868.00'),
(18, '20', 'PHP 24,640.00'),
(19, '25', 'PHP 27,412.00'),
(20, '30', 'PHP 30,184.00');

-- --------------------------------------------------------

--
-- Table structure for table `cartcontent`
--

CREATE TABLE `cartcontent` (
  `username` varchar(255) NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `item_category` varchar(255) NOT NULL,
  `item_image` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_customization` varchar(255) NOT NULL,
  `item_price` int(255) NOT NULL DEFAULT 0,
  `item_quantity` int(255) NOT NULL DEFAULT 0,
  `item_totalprice` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cateringservicescontent`
--

CREATE TABLE `cateringservicescontent` (
  `id` int(11) NOT NULL,
  `title` varchar(1500) NOT NULL,
  `description` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cateringservicescontent`
--

INSERT INTO `cateringservicescontent` (`id`, `title`, `description`) VALUES
(1, 'Catering Services', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');

-- --------------------------------------------------------

--
-- Table structure for table `cateringservicestable`
--

CREATE TABLE `cateringservicestable` (
  `id` int(11) NOT NULL,
  `pax` varchar(1500) NOT NULL,
  `cps` varchar(1500) NOT NULL,
  `ct` varchar(1500) NOT NULL,
  `ck` varchar(1500) NOT NULL,
  `pt` varchar(1500) NOT NULL,
  `pk` varchar(1500) NOT NULL,
  `silog` varchar(1500) NOT NULL,
  `pasta` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cateringservicestable`
--

INSERT INTO `cateringservicestable` (`id`, `pax`, `cps`, `ct`, `ck`, `pt`, `pk`, `silog`, `pasta`) VALUES
(1, '10', 'PHP 1,201.20', 'PHP 1,394.14', 'PHP 1,561.44', 'PHP 1,748.81', 'PHP 1,978.67', 'PHP 2,193.71', 'PHP 2,456.96'),
(2, '15', 'PHP  1,801.80', 'PHP  2,091.22', 'PHP  2,342.16', 'PHP  2,623.22', 'PHP  2,938.01', 'PHP  3,290.57', 'PHP  3,685.44'),
(3, '20', 'PHP  2,402.40', 'PHP  2,788.29', 'PHP  3,122.88', 'PHP  3,497.63', 'PHP  3,917.34', 'PHP  4,387.43', 'PHP  4,913.92'),
(4, '25', 'PHP  3,003.00', 'PHP  3,485.36', 'PHP  3,903.60', 'PHP  4,372.04', 'PHP  4,896.68', 'PHP  5,484.28', 'PHP  6,142.40'),
(5, '30', 'PHP  3,603.60', 'PHP 4,182.43', 'PHP  4,684.32', 'PHP  5,246.44', 'PHP  5,876.02', 'PHP  6,581.14', 'PHP  7,370.87'),
(6, '35', 'PHP  4,204.20', 'PHP  4,879.50', 'PHP  5,465.04', 'PHP  6,120.85', 'PHP  6,855.35', 'PHP  7,677.99', 'PHP  8,599.35'),
(7, '40', 'PHP  5,376.00', 'PHP  5,645.12', 'PHP  6,322.53', 'PHP  7,081.24', 'PHP  7,930.99', 'PHP  8,882.71', 'PHP  9,948.63');

-- --------------------------------------------------------

--
-- Table structure for table `checkoutcontent`
--

CREATE TABLE `checkoutcontent` (
  `username` varchar(255) NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `item_category` varchar(255) NOT NULL,
  `item_image` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_customization` varchar(255) NOT NULL,
  `item_price` int(255) NOT NULL,
  `item_quantity` int(255) NOT NULL,
  `item_totalprice` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleryimage`
--

CREATE TABLE `galleryimage` (
  `img_ID` int(11) NOT NULL,
  `img` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galleryimage`
--

INSERT INTO `galleryimage` (`img_ID`, `img`) VALUES
(1, './galleryImages/galleryHome.png'),
(2, './galleryImages/section2Image1.png'),
(3, './galleryImages/section2Image2.png'),
(4, './galleryImages/section2Image3.jpeg'),
(5, './galleryImages/section2Image4.jpeg'),
(6, './galleryImages/section3Image1.jpeg'),
(7, './galleryImages/section3Image2.jpeg'),
(8, './galleryImages/section3Image3.jpeg'),
(9, './galleryImages/section3Image4.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `gallerysection`
--

CREATE TABLE `gallerysection` (
  `sectionID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallerysection`
--

INSERT INTO `gallerysection` (`sectionID`, `title`, `description`) VALUES
(1, 'GALLERY', 'Welcome to BLK 69 Cafe gallery! Step into a world of rich aromas, handcrafted beverages, and delectable treats. Browse our photos and get a feel for our warm ambience, friendly faces, and the perfect cup of coffee waiting for you.'),
(2, 'Calling all inspiring artists who love tote bags!', 'For singles, this is your chance to experience a one-of-a-kind self-care, indulge in brunch, and paint a tote bag. For those in a relationship, spice things up with this exciting new date idea!'),
(3, 'BLK 69 REELS', 'Follow our Reels/Tiktok for a peek at our delicious coffee creations, stunning latte art, and the cozy vibes you need for your next caffeine fix.');

-- --------------------------------------------------------

--
-- Table structure for table `galleryvideo`
--

CREATE TABLE `galleryvideo` (
  `vidID` int(11) NOT NULL,
  `video` varchar(1500) NOT NULL,
  `sectionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galleryvideo`
--

INSERT INTO `galleryvideo` (`vidID`, `video`, `sectionID`) VALUES
(1, './galleryImages/BLKvideo.mp4', 2),
(2, './galleryImages/video1.mp4', 3),
(3, './galleryImages/video2.mp4', 3),
(4, './galleryImages/video3.mp4', 3),
(5, './galleryImages/video4.mp4', 3),
(6, './galleryImages/video5.mp4', 3),
(7, './galleryImages/video6.mp4', 3);

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
-- Table structure for table `menucategory`
--

CREATE TABLE `menucategory` (
  `product_id` int(255) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_subname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menucategory`
--

INSERT INTO `menucategory` (`product_id`, `product_category`, `product_image`, `product_name`, `product_subname`) VALUES
(1, 'Drinks', 'BLK/VANILLA CAFE LATTE.png', 'Espresso', 'Iced/Hot'),
(2, 'Drinks', 'BLK/COLD BREW.png', 'Brew', 'Iced/Hot'),
(3, 'Drinks', 'BLK/PINK PARADISE.png', 'Non Coffee And Tea', ''),
(4, 'Drinks', 'BLK/MATCHA MANGO.png', 'Matcha', ''),
(5, 'Drinks', './BLK/REGULAR COCA-COLA.png', 'Beverages', ''),
(6, 'Foods', 'BLK/FRENCH TOAST.png', 'All Day Breakfast', ''),
(7, 'Foods', 'BLK/LUNCHEONSILOG.png', 'Silog', ''),
(8, 'Foods', 'BLK/AGLIO OLIO.png', 'Pasta', ''),
(9, 'Foods', 'BLK/CHICKEN KATSUDON.png', 'Bargain Bites', ''),
(10, 'Foods', 'BLK/CHICKEN BALLS MIX.png', 'Sides And Nibbles', ''),
(11, 'Foods', './BLK/CLUBHOUSE SANDWICH.png', 'Carbs And Caffeine', ''),
(35, '', './BLK/lor.jpg', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `menuitems`
--

CREATE TABLE `menuitems` (
  `item_id` int(255) NOT NULL,
  `item_category` varchar(255) NOT NULL,
  `item_image` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_subname` varchar(255) DEFAULT NULL,
  `item_priceoption1` int(255) NOT NULL,
  `item_priceoption2` int(255) NOT NULL,
  `item_quantity` int(255) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menuitems`
--

INSERT INTO `menuitems` (`item_id`, `item_category`, `item_image`, `item_name`, `item_subname`, `item_priceoption1`, `item_priceoption2`, `item_quantity`) VALUES
(1, 'Espresso', 'BLK/SPANISH LATTE.png', 'Spanish Latte', NULL, 99, 149, 1),
(2, 'Espresso', 'BLK/WHITE CHOCO LATTE.png', 'White Choco Latte', NULL, 99, 149, 1),
(3, 'Espresso', 'BLK/MOCHA LATTE.png', 'Mocha Latte', NULL, 99, 149, 1),
(4, 'Espresso ', 'BLK/CINNAMON BROWN LATTE.png', 'Cinnamon Brown Latte', NULL, 89, 139, 1),
(5, 'Espresso', 'BLK/CARAMEL VANILLA MACCHIATO.png', 'Caramel Vanilla Macchiato', NULL, 89, 139, 1),
(6, 'Espresso', 'BLK/CAFE LATTE.png', 'Cafe Latte', NULL, 99, 149, 1),
(7, 'Espresso', 'BLK/VANILLA CAFE LATTE.png', 'Vanilla Cafe Latte', NULL, 69, 119, 1),
(8, 'Espresso', 'BLK/HAZELNUT CAFE LATTE.png', 'Hazelnut Cafe Latte', NULL, 69, 119, 1),
(9, 'Espresso ', 'BLK/SALTED CARAMEL LATTE.png', 'Salted Caramel Latte', NULL, 89, 139, 1),
(10, 'Espresso ', 'BLK/AMERICANO.png', 'Americano', NULL, 69, 139, 1),
(11, 'Espresso', 'BLK/MIDNIGHT CHERRY.png', 'Midnight Cherry', NULL, 79, 119, 1),
(12, 'Espresso ', 'BLK/ESPRESSO CLOUD.png', 'Espresso Cloud', NULL, 69, 129, 1),
(13, 'Brew', 'BLK/HOT BREWED COFFEE.png', 'Hot Brewed Coffee', NULL, 69, 109, 1),
(14, 'Brew', 'BLK/COLD BREW.png', 'Cold Brew', NULL, 69, 109, 1),
(15, 'Brew', 'BLK/ICED COFFEE.png', 'Iced Coffee ', NULL, 69, 119, 1),
(16, 'Brew', 'BLK/VANILLA.png', 'Vanilla', NULL, 79, 129, 1),
(17, 'Brew', 'BLK/HAZELNUT.png', 'Hazelnut', NULL, 79, 129, 1),
(18, 'Brew', 'BLK/CARAMEL.png', 'Caramel', NULL, 79, 129, 1),
(19, 'Non Coffee And Tea', 'BLK/HOT CHOCOLATE.png', 'Hot Chocolate', NULL, 79, 129, 1),
(20, 'Non Coffee And Tea', 'BLK/TRIPLE CHOCOLATE.png', 'Triple Chocolate', NULL, 89, 139, 1),
(21, 'Non Coffee And Tea', 'BLK/PINK PARADISE.png', 'Pink Paradise', NULL, 79, 129, 1),
(22, 'Non Coffee And Tea', 'BLK/TROPICAL CLOUD.png', 'Tropical Cloud', NULL, 79, 129, 1),
(23, 'Non Coffee And Tea', 'BLK/CARAMEL CANDY.png', 'Caramel Candy', NULL, 79, 129, 1),
(24, 'Non Coffee And Tea', 'BLK/DARK BERRY.png', 'Dark Berry', NULL, 99, 149, 1),
(25, 'Non Coffee And Tea', 'BLK/VANILLA MCDREAMY.png', 'Vanilla McDreamy', NULL, 79, 129, 1),
(26, 'Non Coffee And Tea', 'BLK/CHAMOMILE TEA.png', 'Chamomile Tea', NULL, 69, 119, 1),
(27, 'Non Coffee And Tea', 'BLK/PURPLE BLOOM.png', 'Purple Bloom', NULL, 69, 119, 1),
(28, 'Non Coffee And Tea', 'BLK/LAVENDER TEA.png', 'Lavender Tea', NULL, 69, 119, 1),
(29, 'Non Coffee And Tea', 'BLK/PURE GREEN TEA.png', 'Pure Green Tea', NULL, 69, 119, 1),
(30, 'Non Coffee And Tea', 'BLK/ENGLISH BREAKFAST TEA.png', 'English Breakfast Tea', NULL, 69, 119, 1),
(31, 'Non Coffee And Tea', 'BLK/WILD BERRY.png', 'Wild Berry', NULL, 69, 119, 1),
(32, 'Non Coffee And Tea', 'BLK/HIBISCUS TEA.png', 'Hibiscus Tea', NULL, 79, 129, 1),
(33, 'Non Coffee And Tea', 'BLK/STRAWBERRY AND MANGO.png', 'Strawberry And Mango', NULL, 99, 149, 1),
(34, 'Matcha', 'BLK/MATCHA MANGO.png', 'Matcha Mango', NULL, 99, 149, 1),
(35, 'Matcha', 'BLK/NUTTY GREEN TEA.png', 'Nutty Green Tea', NULL, 99, 149, 1),
(36, 'Matcha', 'BLK/VANILLA KISSED MATCHA.png', 'Vanilla Kissed Matcha', NULL, 99, 149, 1),
(37, 'Matcha', 'BLK/SPICY MATCHA.png', 'Spicy Matcha', NULL, 99, 149, 1),
(38, 'Matcha', 'BLK/TITA MAGGIES MATCHA.png', 'Tita Maggie\'s Matcha', NULL, 99, 149, 1),
(39, 'Matcha', 'BLK/WHITEOUT MATCHA.png', 'Whiteout Matcha', NULL, 99, 149, 1),
(40, 'Matcha', 'BLK/MATCHA LATTE.png', 'Matcha Latte', NULL, 99, 149, 1),
(41, 'Matcha', 'BLK/DIRTY MATCHA.png', 'Dirty Matcha', NULL, 109, 159, 1),
(42, 'Matcha', 'BLK/GREEN AND SWEET.png', 'Green And Sweet', NULL, 109, 159, 1),
(43, 'Matcha', 'BLK/ICHIGO MATCHA.png', 'Ichigo Matcha', NULL, 109, 159, 1),
(44, 'Beverages', 'BLK/MANGO JUICE.png', 'Mango Juice', NULL, 69, 99, 1),
(45, 'Beverages', 'BLK/CUCUMBER JUICE.png', 'Cucumber Juice', NULL, 69, 99, 1),
(46, 'Beverages', 'BLK/ICED TEA.png', 'Iced Tea', NULL, 69, 99, 1),
(47, 'Beverages', 'BLK/COCA-COLA ZERO.png', 'Coca-Cola Zero', NULL, 0, 69, 1),
(48, 'Beverages', 'BLK/REGULAR COCA-COLA.png', 'Regular Coca-Cola', NULL, 0, 69, 1),
(49, 'Beverages', 'BLK/PEPSI.png', 'Pepsi', NULL, 0, 69, 1),
(50, 'All Day Breakfast', 'BLK/POFFERTJES.png', 'Poffertjes', NULL, 120, 0, 1),
(51, 'All Day Breakfast', 'BLK/FLUFFY PANCAKES.png', 'Fluffy Pancakes', NULL, 139, 169, 1),
(52, 'All Day Breakfast', 'BLK/FRENCH TOAST.png', 'French Toast', NULL, 139, 0, 1),
(53, 'All Day Breakfast', 'BLK/CLASSIC WAFFLES.png', 'Classic Waffles', NULL, 129, 0, 1),
(54, 'All Day Breakfast', 'BLK/MARGAS FAVE.png', 'Marga\'s Fave', NULL, 250, 0, 1),
(55, 'All Day Breakfast', 'BLK/BREAKFAST PLATTER.png', 'Breakfast Platter', NULL, 250, 0, 1),
(56, 'Silog', 'BLK/CHICKSILOG.png', 'Chicksilog', NULL, 180, 340, 1),
(57, 'Silog', 'BLK/TAPSILOG.png', 'Tapsilog', NULL, 180, 340, 1),
(58, 'Silog', 'BLK/LUNCHEONSILOG.png', 'Luncheonsilog', NULL, 180, 340, 1),
(59, 'Silog', 'BLK/BACSILOG.png', 'Bacsilog', NULL, 180, 340, 1),
(60, 'Silog', 'BLK/CARROT RICE.png', 'Carrot Rice', NULL, 35, 0, 1),
(61, 'Silog', 'BLK/PLAIN RICE.png', 'Plain Rice', NULL, 25, 0, 1),
(62, 'Pasta', 'BLK/CHICKEN PESTO.png', 'Chicken Pesto', NULL, 260, 380, 1),
(63, 'Pasta', 'BLK/GOURMENT TUYO.png', 'Gourment Tuyo', NULL, 245, 360, 1),
(64, 'Pasta', 'BLK/AGLIO OLIO.png', 'Aglio Olio', NULL, 245, 360, 1),
(65, 'Pasta', 'BLK/GARLIC BREAD.png', 'Garlic Bread', NULL, 35, 0, 1),
(66, 'Bargain Bites', 'BLK/CHICKEN POPPERS.png', 'Chicken Poppers', NULL, 95, 250, 1),
(67, 'Bargain Bites', 'BLK/CHICKEN TERIYAKI.png', 'Chicken Teriyaki', NULL, 100, 250, 1),
(68, 'Bargain Bites', 'BLK/PORK TERIYAKI.png', 'Pork Teriyaki', NULL, 160, 250, 1),
(69, 'Bargain Bites', 'BLK/CHICKEN KATSUDON.png', 'Chicken Katsudon', NULL, 110, 250, 1),
(70, 'Bargain Bites', 'BLK/PORK KATSUDON.png', 'Pork Katsudon', NULL, 170, 320, 1),
(71, 'Sides And Nibbles', 'BLK/FRIES.png', 'Fries', NULL, 99, 250, 1),
(72, 'Sides And Nibbles', 'BLK/FRIES BEFORE GUYS.png', 'Fries Before Guys', NULL, 0, 250, 1),
(73, 'Sides And Nibbles', 'BLK/MOZZARELLA BALLS.png', 'Mozzarella Balls', NULL, 0, 115, 1),
(74, 'Sibes And Nibbles', 'BLK/CHICKEN BALLS.png', 'Chicken Balls', NULL, 190, 350, 1),
(75, 'Sides And Nibbbles', 'BLK/CHICKEN BALLS MIX.png', 'Chicken Balls Mix', NULL, 0, 250, 1),
(76, 'Sides And Nibbles', 'BLK/CALAMARI.png', 'Calamari', NULL, 0, 250, 1),
(77, 'Sides And Nibbles', 'BLK/CALAMARI MIX.png', 'Calamari Mix', NULL, 0, 250, 1),
(78, 'Sides And Nibbles', 'BLK/HASHBROWN.png', 'Hashbrown', NULL, 65, 0, 1),
(79, 'Carbs And Caffeine', 'BLK/CLUBHOUSE SANDWICH.png', 'Clubhouse Sandwich', NULL, 120, 200, 1),
(80, 'Carbs And Caffeine', 'BLK/PAIN AU CHOCOLAT.png', 'Pain Au Chocolat', NULL, 90, 150, 1),
(81, 'Carbs And Caffeine', 'BLK/BUTTER CROISSANT.png', 'Butter Croissant', NULL, 90, 150, 1),
(82, 'Carbs And Nibbles', 'BLK/CROISSANWICH.png', 'Croissanwich', NULL, 120, 190, 1),
(83, 'Carbs And Caffeine', 'BLK/PLAIN.png', 'Plain', NULL, 100, 140, 1),
(84, 'Carbs And Caffeine', 'BLK/STRAWBERRY FIELD.png', 'Strawberry Field', NULL, 120, 150, 1),
(86, 'Carbs And Caffeine', 'BLK/MANGO TANGO.png', 'Mango Tango', NULL, 120, 150, 1),
(87, 'Carbs And Caffeine', 'BLK/CHOCO TRUFFLE.png', 'Choco Truffle', NULL, 120, 150, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `username` varchar(255) NOT NULL,
  `shipping_fee` int(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `total_payment` int(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `receipt` varchar(255) DEFAULT NULL,
  `gcash_number` int(255) DEFAULT NULL,
  `reference_number` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `username` varchar(255) NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `item_category` varchar(255) NOT NULL,
  `item_image` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_customization` varchar(255) NOT NULL,
  `item_price` int(255) NOT NULL,
  `item_quantity` int(255) NOT NULL,
  `item_totalprice` int(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packagecontactcontent`
--

CREATE TABLE `packagecontactcontent` (
  `id` int(11) NOT NULL,
  `img` varchar(1500) NOT NULL,
  `title` varchar(1500) NOT NULL,
  `description` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packagecontactcontent`
--

INSERT INTO `packagecontactcontent` (`id`, `img`, `title`, `description`) VALUES
(1, './packagesImages/maps-and-flags.png', 'Address', '69 Macopa, Taguig, 1217 Metro Manila'),
(2, './packagesImages/mail.png', 'Email:', 'block69cafe@gmail.com'),
(3, './packagesImages/phone-call.png', 'Phone Number', '63+ 123456789'),
(4, '', 'Contact us!', '');

-- --------------------------------------------------------

--
-- Table structure for table `packagesection`
--

CREATE TABLE `packagesection` (
  `packageid` int(11) NOT NULL,
  `packagetitle` varchar(1500) NOT NULL,
  `packagedescription` varchar(1500) NOT NULL,
  `packageimage` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packagesection`
--

INSERT INTO `packagesection` (`packageid`, `packagetitle`, `packagedescription`, `packageimage`) VALUES
(1, 'PACKAGES', 'Welcome to our premium cafe packages and catering services, where exceptional taste meets convenience. Whether you\'re planning an intimate gathering or a large corporate event, our expertly crafted menus and customizable options ensure a delightful experience for every occasion. Let us handle the details, so you can savor the moment.', './packagesImages/packageHome.png'),
(2, 'Cafe Packages', 'Experience the charm of our cafe packages, designed to bring the cozy ambiance and delectable flavors of our cafe to your special occasions. Whether for a casual brunch or a sophisticated tea party, our packages offer a variety of handcrafted beverages and artisanal treats, making your event truly memorable.', './packagesimages/coffee-icon.png'),
(3, 'CATERING SERVICES', 'Our catering services bring gourmet dining to your doorstep, perfect for any event from weddings to corporate meetings. With a diverse menu curated by our top chefs, we ensure that every dish is a culinary masterpiece, tailored to meet your specific needs and preferences.', './packagesImages/chef-icon.png');

-- --------------------------------------------------------

--
-- Table structure for table `servicescontent`
--

CREATE TABLE `servicescontent` (
  `content_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `content_title` varchar(255) NOT NULL,
  `content_caption` varchar(255) NOT NULL,
  `content_images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `servicescontent`
--

INSERT INTO `servicescontent` (`content_id`, `event_name`, `content_title`, `content_caption`, `content_images`) VALUES
(23, '<p>birthdays</p>', '<p>Eli\'s 9th Birthday at Pateros, Metro Manila</p>', '<p>140 cups served</p>', './Events Images/0-1-1716565340.jpg,./Events Images/1-1716565340.jpg,./Events Images/2-1716565340.jpg,./Events Images/3-1716565340.jpg,./Events Images/4-1716565340.jpg'),
(24, '<p>corporate events</p>', '<p>JAAM Foodcorp Christmas Party at Episode Bar + Kitchen</p>', '<p>150 cups served</p>', './Events Images/9-1716565543.png,./Events Images/10-1716565543.png,./Events Images/11-1716565543.png,./Events Images/13-1716565543.png,./Events Images/14-1716565543.png'),
(25, '<p>community activity</p>', '<p>The Generics Pharmacy Medical Mission</p>', '<p>150 cups served</p>', './Events Images/15-1716565984.png,./Events Images/17-1716565984.png,./Events Images/18-1716565984.png,./Events Images/19-1716565984.png,./Events Images/20-1716565984.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `email` varchar(50) NOT NULL,
  `status` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`email`, `status`, `username`, `password`, `token`) VALUES
('meinardsantoss@gmail.com', 'admin', 'admin', 'admin123', ''),
('elor.k12150411@umak.edu.ph', 'staff', 'eric', 'lor123', ''),
('louigiecads@gmail.com', 'customer', 'louie', 'louie123', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutcontent`
--
ALTER TABLE `aboutcontent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barservicescontent`
--
ALTER TABLE `barservicescontent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogcontents`
--
ALTER TABLE `blogcontents`
  ADD PRIMARY KEY (`blogIDNum`);

--
-- Indexes for table `blogslider`
--
ALTER TABLE `blogslider`
  ADD PRIMARY KEY (`blogIDNum`);

--
-- Indexes for table `cafebarkadapackage`
--
ALTER TABLE `cafebarkadapackage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cafepackagescontents`
--
ALTER TABLE `cafepackagescontents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cafepackageshomecontent`
--
ALTER TABLE `cafepackageshomecontent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cafepackagespaxandprices`
--
ALTER TABLE `cafepackagespaxandprices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cartcontent`
--
ALTER TABLE `cartcontent`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `cateringservicescontent`
--
ALTER TABLE `cateringservicescontent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cateringservicestable`
--
ALTER TABLE `cateringservicestable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleryimage`
--
ALTER TABLE `galleryimage`
  ADD PRIMARY KEY (`img_ID`);

--
-- Indexes for table `gallerysection`
--
ALTER TABLE `gallerysection`
  ADD PRIMARY KEY (`sectionID`);

--
-- Indexes for table `galleryvideo`
--
ALTER TABLE `galleryvideo`
  ADD PRIMARY KEY (`vidID`),
  ADD KEY `videos_section` (`sectionID`);

--
-- Indexes for table `homecontent`
--
ALTER TABLE `homecontent`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `menucategory`
--
ALTER TABLE `menucategory`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `menuitems`
--
ALTER TABLE `menuitems`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `packagecontactcontent`
--
ALTER TABLE `packagecontactcontent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packagesection`
--
ALTER TABLE `packagesection`
  ADD PRIMARY KEY (`packageid`);

--
-- Indexes for table `servicescontent`
--
ALTER TABLE `servicescontent`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `useraccounts`
--
ALTER TABLE `useraccounts`
  ADD PRIMARY KEY (`username`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutcontent`
--
ALTER TABLE `aboutcontent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `barservicescontent`
--
ALTER TABLE `barservicescontent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogcontents`
--
ALTER TABLE `blogcontents`
  MODIFY `blogIDNum` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogslider`
--
ALTER TABLE `blogslider`
  MODIFY `blogIDNum` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cafebarkadapackage`
--
ALTER TABLE `cafebarkadapackage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cafepackagescontents`
--
ALTER TABLE `cafepackagescontents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cafepackageshomecontent`
--
ALTER TABLE `cafepackageshomecontent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cafepackagespaxandprices`
--
ALTER TABLE `cafepackagespaxandprices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `cateringservicescontent`
--
ALTER TABLE `cateringservicescontent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cateringservicestable`
--
ALTER TABLE `cateringservicestable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `galleryimage`
--
ALTER TABLE `galleryimage`
  MODIFY `img_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gallerysection`
--
ALTER TABLE `gallerysection`
  MODIFY `sectionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `galleryvideo`
--
ALTER TABLE `galleryvideo`
  MODIFY `vidID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `menucategory`
--
ALTER TABLE `menucategory`
  MODIFY `product_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `menuitems`
--
ALTER TABLE `menuitems`
  MODIFY `item_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `packagecontactcontent`
--
ALTER TABLE `packagecontactcontent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `packagesection`
--
ALTER TABLE `packagesection`
  MODIFY `packageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `servicescontent`
--
ALTER TABLE `servicescontent`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `galleryvideo`
--
ALTER TABLE `galleryvideo`
  ADD CONSTRAINT `videos_section` FOREIGN KEY (`sectionID`) REFERENCES `gallerysection` (`sectionID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
