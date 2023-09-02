-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 02, 2023 at 10:01 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Obidient_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `All_user`
--

CREATE TABLE `All_user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(254) NOT NULL,
  `MiddleName` varchar(254) NOT NULL,
  `lastname` varchar(254) NOT NULL,
  `phonenumber` varchar(254) NOT NULL,
  `email` varchar(245) NOT NULL,
  `password` varchar(254) NOT NULL,
  `Registration_Date` datetime NOT NULL,
  `Last_Login` datetime DEFAULT NULL,
  `status` enum('active','in active') NOT NULL DEFAULT 'in active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `All_user`
--

INSERT INTO `All_user` (`id`, `firstname`, `MiddleName`, `lastname`, `phonenumber`, `email`, `password`, `Registration_Date`, `Last_Login`, `status`) VALUES
(4, 'Sammy', 'egwu', 'okpani', '+2348039484187', 'dallintine@gmail.com', 'e706d2299da55350979cd5a3a706c1e423a2c3d9e5f84bac653368ed3c321872', '2023-03-15 15:36:31', '2023-05-09 19:02:19', 'active'),
(5, 'Sammykoko', 'egwuef', 'okpaniwe', '+2348039484188', 'dallintine123@gmail.com', 'e706d2299da55350979cd5a3a706c1e423a2c3d9e5f84bac653368ed3c321872', '2023-03-15 15:37:53', '2023-05-05 10:34:55', 'active'),
(6, 'member', 'olukwu', 'medinised', '+2348039485487', 'dallintine342@gmail.com', 'e706d2299da55350979cd5a3a706c1e423a2c3d9e5f84bac653368ed3c321872', '2023-03-15 15:42:19', '2023-03-16 13:02:14', 'active'),
(7, 'Sammy', 'egwuuben', 'okpani', '+2348139484187', 'dallintine8897@gmail.com', 'e706d2299da55350979cd5a3a706c1e423a2c3d9e5f84bac653368ed3c321872', '2023-03-15 15:50:57', '2023-05-05 12:42:07', 'active'),
(8, 'Sammymm', 'egwu', 'Dallintine', '08239484187', 'dallintine111@gmail.com', 'e706d2299da55350979cd5a3a706c1e423a2c3d9e5f84bac653368ed3c321872', '2023-03-15 15:54:52', NULL, 'in active'),
(9, 'Sammy', 'egwuef', 'okpani', '+2348339484187', 'dallintine77@gmail.com', 'e706d2299da55350979cd5a3a706c1e423a2c3d9e5f84bac653368ed3c321872', '2023-03-15 15:56:52', NULL, 'in active'),
(10, 'Sammy', 'olukwu', 'okpani', '+2348039481187', 'dallintine121@gmail.com', 'e706d2299da55350979cd5a3a706c1e423a2c3d9e5f84bac653368ed3c321872', '2023-03-17 20:21:38', '2023-03-17 20:22:17', 'active'),
(11, 'Sammy', 'egwueht', 'okpani', '+2348037484187', 'dallintine3489@gmail.com', 'e706d2299da55350979cd5a3a706c1e423a2c3d9e5f84bac653368ed3c321872', '2023-03-20 16:24:14', NULL, 'in active');

-- --------------------------------------------------------

--
-- Table structure for table `Arcticle_news`
--

CREATE TABLE `Arcticle_news` (
  `id` int(11) NOT NULL,
  `fileimage` varchar(254) NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic` varchar(254) NOT NULL,
  `date_publish` datetime NOT NULL,
  `News_Area` text NOT NULL,
  `status` enum('Approved','not approved') NOT NULL DEFAULT 'not approved',
  `News_type` enum('Breaking_news','latest_news') NOT NULL DEFAULT 'Breaking_news'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Arcticle_news`
--

INSERT INTO `Arcticle_news` (`id`, `fileimage`, `user_id`, `topic`, `date_publish`, `News_Area`, `status`, `News_type`) VALUES
(1, '1669209836303.JPEG', 4, 'People shot dead in isolo', '2023-03-20 13:18:50', 'hdgdhdgdgdghdgdhdhddggdbcbvcgdhcbcbnnnndjdjdjdjdhhdyeyetgdgdhhd', 'not approved', 'Breaking_news'),
(2, '1669209836303.JPEG', 4, 'People shot dead in isolo', '2023-03-20 13:20:00', 'hdgdhdgdgdghdgdhdhddggdbcbvcgdhcbcbnnnndjdjdjdjdhhdyeyetgdgdhhd', 'not approved', 'Breaking_news'),
(3, '1669209836303.JPEG', 4, 'People shot dead in isolo', '2023-03-20 13:24:11', 'hdgdhdgdgdghdgdhdhddggdbcbvcgdhcbcbnnnndjdjdjdjdhhdyeyetgdgdhhd', 'not approved', 'Breaking_news'),
(4, '1669209836303.JPEG', 4, 'People shot dead in isolo', '2023-03-20 15:05:27', 'hdgdhdgdgdghdgdhdhddggdbcbvcgdhcbcbnnnndjdjdjdjdhhdyeyetgdgdhhd', 'not approved', 'Breaking_news'),
(5, '1669209836303.JPEG', 4, 'animation', '2023-03-20 15:17:19', 'hyjuhdndbgfhhtjjkiolkdnnmmjfhhgtyuioolldjjndbbfhgrttrgffdfehehdjkkfjkllfllmmvnnbghghytutiidjjfhhgjgjututuiiruuruyfhhvnbbdggdhhrggt', 'not approved', 'Breaking_news'),
(6, '1669209836303.JPEG', 4, 'animations', '2023-03-20 15:38:29', 'hhjjjhjhhghfgfgghjnbbnmbklkjkljkjliououiuysersesrr', 'not approved', 'Breaking_news'),
(7, '1669209836303.JPEG', 4, 'animation ood', '2023-03-20 15:54:36', 'kkdjsjdjhdkjhjhdhhfhfhsfgsgfsghhfggfhsdjgsjgfsjhgfsjhgsfkfhkhdkhjgfsdgfgsfjgsjfgsjfgsdjhfgsdjhfgsjhdfgsjhfgsjhgsjhgsdhfsgjgsj', 'not approved', 'Breaking_news'),
(8, '1669209836303.JPEG', 4, 'People shot dead in isolo', '2023-03-20 16:18:22', 'ggfgjghkkhhudrdfhjgjhkkjhjkhjlhjljkljljiiuufffhgfjhgjhgjhgjhgjhgjhgjhgjhhjhggjghjggjggjggjhgjhgjhghjhjk', 'not approved', 'Breaking_news'),
(9, 'Upload_20220217-053202.jpg', 4, 'People shot dead in isolo', '2023-03-23 16:58:51', 'ghgghgfgfhgjhjkjlkkjklvvnbvniiuuiyiiyutytttrtewwzcxzczxcvciuytyyu655767uiuouighffghjhgjhgj\r\ntyyttjhjhkhjrerddfdfghfhgkjlkhjkfgfgxxv', 'not approved', 'Breaking_news');

-- --------------------------------------------------------

--
-- Table structure for table `Audio_news`
--

CREATE TABLE `Audio_news` (
  `Audio_id` int(11) NOT NULL,
  `Audio_name` varchar(254) NOT NULL,
  `date_publish` datetime NOT NULL,
  `Audio_file` varchar(254) NOT NULL,
  `status` enum('Approved','not approved') NOT NULL DEFAULT 'not approved',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Gallary_news`
--

CREATE TABLE `Gallary_news` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` varchar(254) NOT NULL,
  `topic` varchar(254) NOT NULL,
  `image_name` varchar(254) NOT NULL,
  `status` enum('Approved','not approved') NOT NULL DEFAULT 'not approved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `video_news`
--

CREATE TABLE `video_news` (
  `video_id` int(11) NOT NULL,
  `video_name` varchar(254) NOT NULL,
  `date_publish` datetime NOT NULL,
  `video_file` varchar(254) NOT NULL,
  `status` enum('Approved','not approved') NOT NULL DEFAULT 'not approved',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `All_user`
--
ALTER TABLE `All_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Arcticle_news`
--
ALTER TABLE `Arcticle_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Gallary_news`
--
ALTER TABLE `Gallary_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_news`
--
ALTER TABLE `video_news`
  ADD PRIMARY KEY (`video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `All_user`
--
ALTER TABLE `All_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `Arcticle_news`
--
ALTER TABLE `Arcticle_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Gallary_news`
--
ALTER TABLE `Gallary_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video_news`
--
ALTER TABLE `video_news`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
