-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2022 at 08:53 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mycompany`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Parent` int(11) NOT NULL,
  `Ordering` int(11) DEFAULT NULL,
  `Visibility` tinyint(4) NOT NULL DEFAULT 0,
  `Allow_Comment` tinyint(4) NOT NULL DEFAULT 0,
  `Allow_Ads` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Name`, `Description`, `Parent`, `Ordering`, `Visibility`, `Allow_Comment`, `Allow_Ads`) VALUES
(30, 'سرداب مواد اسمنتية', 'سرداب مواد اسمنتية', 0, 1, 0, 0, 0),
(31, 'اسطح رش وحمامات', 'اسطح رش وحمامات', 0, 1, 0, 0, 0),
(32, 'حمامات سباحة', 'حمامات سباحة', 0, 4, 0, 0, 0),
(33, 'كيربي', 'رش كيربي', 0, 5, 0, 0, 0),
(34, ' دكتات تكييف', 'رش دكتات تكييف', 0, 6, 0, 0, 0),
(35, 'اسطح طربال وحمامات', 'اسطح طربال وحمامات', 0, 3, 0, 0, 0),
(36, 'سرداب طربال', 'سرداب طربال', 0, 1, 0, 0, 0),
(38, 'منوعات', 'منوعات اعمال عازل', 0, 8, 0, 0, 0),
(40, 'ايزوفوم', 'اسطح ايزوفوم', 0, 9, 0, 0, 0),
(41, 'سرداب واسطح وحمامات', 'سرداب واسطح وحمامات', 0, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `c_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `comment_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`c_id`, `comment`, `status`, `comment_date`, `item_id`, `user_id`) VALUES
(40, '20 سيكا - 15 سى دابليو 100 - 5 مادة رابطة', 1, '2022-01-04', 68, 1),
(41, '120 كيس اسمنت     ', 1, '2022-01-04', 71, 1);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `kind` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `notes` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `type`, `size`, `kind`, `date`, `notes`, `file`) VALUES
(1, 'البروشور.pdf', 'application/pdf', 37865811, 'مستندات', '2022-01-05', 'لا يوجد', '440249-البروشور.pdf'),
(5, 'tec.mp4', 'video/mp4', 5353577, 'فيديوهات', '2022-01-06', 'الفيديو الترويجي', '938827-tec.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `Item_ID` int(11) NOT NULL,
  `Number` int(11) DEFAULT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Add_Date` date NOT NULL,
  `Country_Made` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Measure` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Rating` smallint(6) NOT NULL,
  `Approve` tinyint(4) NOT NULL DEFAULT 0,
  `Cat_ID` int(11) NOT NULL,
  `Member_ID` int(11) NOT NULL,
  `Tags` varchar(255) NOT NULL,
  `pay1` int(11) NOT NULL,
  `pay2` int(11) NOT NULL,
  `pay3` int(11) NOT NULL,
  `start` date NOT NULL,
  `pstage1` date NOT NULL,
  `pstage2` date NOT NULL,
  `pstage3` date NOT NULL,
  `pstage4` date NOT NULL,
  `pstage5` date NOT NULL,
  `plot1` date NOT NULL,
  `plot2` date NOT NULL,
  `plot3` date NOT NULL,
  `plot4` date NOT NULL,
  `plot5` date NOT NULL,
  `plot6` date NOT NULL,
  `plot7` date NOT NULL,
  `plot8` date NOT NULL,
  `plot9` date NOT NULL,
  `plot10` date NOT NULL,
  `plot11` date NOT NULL,
  `plot12` date NOT NULL,
  `plot13` date NOT NULL,
  `plot14` date NOT NULL,
  `plot15` date NOT NULL,
  `notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Item_ID`, `Number`, `Name`, `Description`, `Price`, `Add_Date`, `Country_Made`, `Image`, `Measure`, `Status`, `Rating`, `Approve`, `Cat_ID`, `Member_ID`, `Tags`, `pay1`, `pay2`, `pay3`, `start`, `pstage1`, `pstage2`, `pstage3`, `pstage4`, `pstage5`, `plot1`, `plot2`, `plot3`, `plot4`, `plot5`, `plot6`, `plot7`, `plot8`, `plot9`, `plot10`, `plot11`, `plot12`, `plot13`, `plot14`, `plot15`, `notes`) VALUES
(68, 4001, '      كامل عويد عجيل الظفيري', '      51099069', '      900', '2022-01-03', '      المطلاع N11- ق 3 - م 532', '387576-عقد سرداب كامل الظفيري.docx', '   لوجو.png', '1', 0, 1, 30, 1, '      سرداب ,  اسمنتية', 900, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '  '),
(69, 4002, '     عبد العزيز محمد على الوزان', '     98848806', '     3800', '2022-01-03', '     مشرف - ق 5 - ش 6 م 669', '532179-عبد العزيز الوزان - خاص عمرو - اسطح وملاحق ايزوفوم.docx', '  لوجو.png', '1', 0, 1, 40, 1, ' حمامات   , اسطح , طربال , ايزوفوم ', 1900, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', ' '),
(70, 4003, '     فهد متعب زهيان مسفر الشلاحي', '     99705559', '     180', '2022-01-03', '     غرب عبد الله المبارك - ق 5 - م 415', 'Screenshot (2).png', '   لوجو.png', '1', 0, 1, 34, 1, '     رش,دكتات', 180, 0, 0, '2022-01-01', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2022-01-07', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '    '),
(71, 4004, '    راكان غازي سعد الشريعان', '    96660996', '    1700', '2022-01-03', '    العدان - ق 2 - ش 52 - م 6', '405331-راكان الشريعان.docx', '    559892-العدان ق 2 ش 52 م 6.xlsx', '1', 0, 1, 31, 54, '  حمامات,  رش ,اسطح', 1700, 0, 0, '2022-01-04', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2022-01-11', '2022-01-11', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '   صب دور فوم اسمنتي الاسمنت من العميل'),
(78, 4005, '  شركة اساس هوم للمقاولات', '  55818822 هشام بو عباس', '  3250', '2022-01-05', '  المسايل - ق 5 - ش 305 - م 347', '272316-اساس هوم عقد اسطح  طربال وحمامات - .docx', '  48627-المسايل ق 3 ش 305 م 347.xlsx', '1', 0, 1, 35, 54, 'حمامات ,  اسطح,  طربال', 1625, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', ' '),
(79, 4006, '         صالح ابراهيم سليمان البريدي', '         99801154', '         2100', '2022-01-06', '         الخيران - ق 4 - م 3044', '225419-صالح ابراهيم الخراز.docx', '     588076-صباح الاحمد البحرية ق 4 م 3044.xlsx', '1', 0, 1, 31, 54, '        حمامات, رش ,اسطح', 1100, 0, 0, '2022-01-08', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `phones`
--

CREATE TABLE `phones` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phones`
--

INSERT INTO `phones` (`id`, `name`, `phone`, `section`, `notes`) VALUES
(2, 'بسام شركة اسمنت الهلال', '97256997', 'مورد اسمنت', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT 0,
  `TrustStatus` int(11) NOT NULL DEFAULT 0,
  `RegStatus` int(11) NOT NULL DEFAULT 0,
  `Date` date NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `Position` varchar(255) NOT NULL,
  `Salary` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `FullName`, `GroupID`, `TrustStatus`, `RegStatus`, `Date`, `avatar`, `Position`, `Salary`, `Phone`, `Notes`) VALUES
(1, 'mohamedkhair', 'e370da75da7c2a60ae103d6c45100cf407fce13e', 'mrmkhair9@gmail.com', 'mohamed ramadan mohamed khair', 1, 0, 1, '2014-11-29', 'mrm.jpg', 'مسئول اداري', '350', '65001267', 'الموظف الوحيد الذى تم تخفيض راتبه فى الشركة'),
(46, 'ابوعبدالله', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'superadmin@gmail.com', 'خالد عبد اللطيف على', 1, 0, 1, '2009-04-01', '714934-01.jpg', 'المدير العام', '2000', '66676336', 'صاحب الشركة'),
(47, 'رأفت ', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'superadmin@gmail.com', 'رأفت غالى حنا جاد الرب', 1, 0, 1, '2010-05-05', '422289-001.png', 'مدير مالى', '750', '69901365', 'لا يوجد'),
(48, 'عبد الرزاق', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'superadmin@gmail.com', 'عبد الرزاق خالد عبد اللطيف على', 1, 0, 1, '2018-06-04', '46488-001.png', 'مدير انتاج', '500', '65001282', 'لا يوجد'),
(49, 'ناصر', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'superadmin@gmail.com', 'ناصر عبد الرحيم عبد الستار عبد الرحيم', 0, 0, 1, '2010-05-05', '44872-001.png', 'مراقب انتاج', '375', '65001266', 'لا يوجد'),
(50, 'ياسر', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'superadmin@gmail.com', 'ياسر عنتر عبد الله محمد', 0, 0, 1, '2014-04-01', '765979-001.png', 'مراقب انتاج', '325', '65001272', 'لا يوجد'),
(51, 'ليلي', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'superadmin@gmail.com', 'ليلي عبد العزيز محمد المحاس', 0, 0, 1, '2019-11-04', '722165-001.png', 'سكرتيرة', '175', '65001274', 'نصف دوام'),
(52, 'سوهال', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'superadmin@gmail.com', 'سوهال اينوس على', 0, 0, 1, '2020-08-04', '436323-001.png', 'عامل بوفيه', '170', '51299875', 'لا يوجد'),
(53, 'علاء', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'superadmin@gmail.com', 'علاء محمد اسماعيل', 0, 0, 1, '2021-05-04', '549531-001.png', 'مراقب انتاج', '375', '65001275', 'سيارته الخاصة'),
(54, 'وفقى', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'superadmin@gmail.com', 'وفقى احمد ابراهيم هوي', 0, 0, 1, '2021-08-04', '363425-001.png', 'مراقب انتاج', '400', '69901360', 'سيارته الخاصة'),
(55, 'محمد', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'superadmin@gmail.com', 'محمد السيد محمد كمال الدين', 0, 0, 1, '2021-10-20', '848503-001.png', 'مراقب انتاج', '350', '98032204', 'سيارته الخاصة'),
(57, 'عبود', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'superadmin@gmail.com', 'عبد الله سمير الرفاعي', 0, 0, 1, '2021-11-01', '692528-51.jpg', 'مراقب انتاج', '300', '96969508', 'سيارته الخاصة');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `item_comments` (`item_id`),
  ADD KEY `user_comments` (`user_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`Item_ID`),
  ADD UNIQUE KEY `Number` (`Number`),
  ADD KEY `member_1` (`Member_ID`),
  ADD KEY `cat_1` (`Cat_ID`);

--
-- Indexes for table `phones`
--
ALTER TABLE `phones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `phones`
--
ALTER TABLE `phones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `item_comments` FOREIGN KEY (`item_id`) REFERENCES `items` (`Item_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_comments` FOREIGN KEY (`user_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat_1` FOREIGN KEY (`Cat_ID`) REFERENCES `categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_1` FOREIGN KEY (`Member_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
