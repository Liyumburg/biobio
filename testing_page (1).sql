-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2026 at 05:57 AM
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
-- Database: `testing_page`
--

-- --------------------------------------------------------

--
-- Table structure for table `educational_background`
--

CREATE TABLE `educational_background` (
  `education_id` int(255) NOT NULL,
  `personal_id` int(11) NOT NULL,
  `level` varchar(255) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year_passing` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `educational_background`
--

INSERT INTO `educational_background` (`education_id`, `personal_id`, `level`, `school_name`, `course`, `year_passing`) VALUES
(11, 18, 'Elementary', 'Neust', 'BSIT', '2027');

-- --------------------------------------------------------

--
-- Table structure for table `employment_history`
--

CREATE TABLE `employment_history` (
  `employment_id` int(11) NOT NULL,
  `personal_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employment_history`
--

INSERT INTO `employment_history` (`employment_id`, `personal_id`, `company_name`, `position`, `start_date`, `end_date`) VALUES
(3, 18, 'none', 'senior developer', '2001-02-09', '2001-02-02');

-- --------------------------------------------------------

--
-- Table structure for table `id`
--

CREATE TABLE `id` (
  `id` int(255) NOT NULL,
  `First_name` varchar(255) NOT NULL,
  `Middle_name` varchar(255) NOT NULL,
  `Last_name` varchar(255) NOT NULL,
  `Suffix` varchar(255) NOT NULL,
  `Languages` varchar(255) NOT NULL,
  `Email_address` varchar(255) NOT NULL,
  `Hobbies` varchar(255) NOT NULL,
  `Mobile_number` varchar(255) NOT NULL,
  `Religion` varchar(255) NOT NULL,
  `Province` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Barangay` varchar(255) NOT NULL,
  `Street` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Marital_status` varchar(255) NOT NULL,
  `DOB` date DEFAULT NULL,
  `per_img` varchar(255) NOT NULL,
  `uploads` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `id`
--

INSERT INTO `id` (`id`, `First_name`, `Middle_name`, `Last_name`, `Suffix`, `Languages`, `Email_address`, `Hobbies`, `Mobile_number`, `Religion`, `Province`, `City`, `Barangay`, `Street`, `Gender`, `Marital_status`, `DOB`, `per_img`, `uploads`) VALUES
(18, 'liam', 'eudar', 'bautista', 'none', 'english', 'liam@gmail.com', 'billiard', '09162441095', 'catholic', 'Nueva Ecija', 'Jaen', 'Niyugan', 'Putol', 'male', 'single', '2001-10-05', '', ''),
(19, 'sdfs', 'dsfws', 'bautista', 'dsfwefw', 'wrwer', 'liam@gmail.com', 'wfwerw', '1931293019', 'dfwfwe', 'dfwe', 'werwe', 'sdfsf', 'sdfs', 'sdkfmsk', 'wrwer', '2001-10-20', '', '69b8c5fba0187-1773716987images (1).png'),
(20, 'son', 'sod', 'goku', 'saof', 'qweqwefa', 'liam@gmail.com', 'asffasda', '1203130230', 'asfasf', 'qweqeq', 'fdsfs', 'adad', 'sadad', 'male', 'sdjfhsj', '2001-10-20', '', '69b8196b530b7-1773672811how-to-draw-goku-featured-image-1200.png'),
(21, 'asdad', 'asdad', 'jooj', 'asda', 'english', 'liam@gmail.com', 'sddljsff', '012014104', 'sddfsdf', 'fdjsfhsj', 'dhsfjhfsj', 'sjfhsj', 'asdjahd', 'male', 'single', '2001-10-04', '', '69b819ac80b09-1773672876how-to-draw-goku-featured-image-1200.png'),
(22, 'liam', 'adasd', 'jooj', 'sdfjsflj', 'dadada', 'liam@gmail.com', 'billiard', '1231313131231', 'catholic', 'Nueva Ecija', 'Jaen', 'Niyugan', 'Putol', 'male', 'ksjdfksj', '2001-10-23', '', '69b8c4bbd6f2f-1773716667how-to-draw-goku-featured-image-1200.png'),
(23, 'sdfs', 'dsfws', 'cabiad', 'sdfjsflj', 'dadada', 'liamcabiad@gmail.com', 'sddljsff', '92183193281', 'catholic', 'wmower', 'mriwenrwik', 'wioweir', 'werwlmeol', 'male', 'single', '2001-10-06', '', '69dc96ad9ab23-1776064173Screenshot 2026-03-16 122158.png'),
(24, 'qweqwcxcas', 'weqeqad', 'qweqwe', 'asd', 'english', 'liamcabiad@gmail.com', 'sddljsff', '12123234234', 'sddfsdf', 'djfsojfds', 'werwe', 'dfjisfo', 'idjfisjif', 'male', 'ksjdfksj', '2001-10-05', '', '69dc9bae70968-1776065454Screenshot 2026-02-17 020542.png'),
(25, 'jasldka', 'klasdkl', 'asdjkadj', 'asldk', 'dadada', 'liamcabiad@gmail.com', 'billiard', '9696786', 'sddfsdf', 'djfsojfds', 'Jaen', 'Niyugan', 'Putol', 'male', 'single', '2001-10-06', '', '69dca3183cf73-1776067352Screenshot 2026-02-17 020542.png'),
(26, 'liam', 'adasd', 'jooj', 'sdfjsflj', 'dadada', 'liam@gmail.com', 'billiard', '1231313131231', 'catholic', 'Nueva Ecija', 'Jaen', 'Niyugan', 'Putol', 'male', 'ksjdfksj', '2001-10-23', '', '69b8c4bbd6f2f-1773716667how-to-draw-goku-featured-image-1200.png'),
(27, 'liam', 'eudar', 'bautista', 'none', 'english', 'liam@gmail.com', 'billiard', '09162441095', 'catholic', 'Nueva Ecija', 'Jaen', 'Niyugan', 'Putol', 'male', 'single', '2001-10-05', '', ''),
(28, 'angelika', 'liwag', 'soledad', 'none', 'kwnkoqwn', 'davidcabiad@gmail.com', 'wnrwklerw', '0910390193', 'wnrklwn', 'wkrnwknr', 'wnriwenrk', 'nwnrwk', 'njwnfj', 'female', 'klnwrknq', '2003-12-13', '', '69dd1748df8e3-1776097096Screenshot 2026-02-11 001635.png'),
(29, 'lsdfklksd', 'ksldfm', 'asflakf', 'msdfmowemr ', 'mwrmw', 'davidcabiad@gmail.com', 'mrwoermw', '10311030', 'mfwoemr', 'sdfmwme', 'msfosmf', 'ofowmeorm', 'okorwor', 'male', 'momw', '2001-10-06', '', '69ddb0ee4eefb-1776136430Screenshot 2026-02-17 020542.png'),
(30, 'liam', 'liam', 'liam', 'liam', 'liam', 'liamcabiad@gmail.com', 'liam', '09162441095', 'liam', 'liam', 'liam', 'liam', 'liam', 'male', 'liam', '2001-10-06', '', '69ddb2fc366ba-1776136956Screenshot 2026-02-11 001635.png');

-- --------------------------------------------------------

--
-- Table structure for table `temp_person`
--

CREATE TABLE `temp_person` (
  `id` int(255) NOT NULL,
  `First_name` varchar(255) NOT NULL,
  `Middle_name` varchar(255) NOT NULL,
  `Last_name` varchar(255) NOT NULL,
  `Suffix` varchar(255) NOT NULL,
  `Languages` varchar(255) NOT NULL,
  `Email_address` varchar(255) NOT NULL,
  `Hobbies` varchar(255) NOT NULL,
  `Mobile_number` varchar(255) NOT NULL,
  `Religion` varchar(255) NOT NULL,
  `Province` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Barangay` varchar(255) NOT NULL,
  `Street` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Marital_status` varchar(255) NOT NULL,
  `DOB` date DEFAULT NULL,
  `per_img` varchar(255) NOT NULL,
  `uploads` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `educational_background`
--
ALTER TABLE `educational_background`
  ADD PRIMARY KEY (`education_id`),
  ADD KEY `personal_id` (`personal_id`);

--
-- Indexes for table `employment_history`
--
ALTER TABLE `employment_history`
  ADD PRIMARY KEY (`employment_id`),
  ADD KEY `personal_id` (`personal_id`);

--
-- Indexes for table `id`
--
ALTER TABLE `id`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_person`
--
ALTER TABLE `temp_person`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `educational_background`
--
ALTER TABLE `educational_background`
  MODIFY `education_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `employment_history`
--
ALTER TABLE `employment_history`
  MODIFY `employment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `id`
--
ALTER TABLE `id`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `temp_person`
--
ALTER TABLE `temp_person`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `educational_background`
--
ALTER TABLE `educational_background`
  ADD CONSTRAINT `educational_background_ibfk_1` FOREIGN KEY (`personal_id`) REFERENCES `id` (`id`);

--
-- Constraints for table `employment_history`
--
ALTER TABLE `employment_history`
  ADD CONSTRAINT `employment_history_ibfk_1` FOREIGN KEY (`personal_id`) REFERENCES `id` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
