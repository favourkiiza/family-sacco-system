-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 18, 2017 at 10:17 AM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.18-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `familysacco`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_name` varchar(20) NOT NULL,
  `admin_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_name`, `admin_password`) VALUES
('saidat', 'nanjuki');

-- --------------------------------------------------------

--
-- Stand-in structure for view `benefit`
--
CREATE TABLE `benefit` (
`name` varchar(20)
,`amount` decimal(35,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `benefits`
--

CREATE TABLE `benefits` (
  `id` int(3) NOT NULL,
  `name` varchar(30) NOT NULL,
  `amount` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contributions`
--

CREATE TABLE `contributions` (
  `id` int(3) NOT NULL,
  `name` varchar(30) NOT NULL,
  `amount` int(8) NOT NULL,
  `date` date NOT NULL,
  `receiptno` int(5) NOT NULL,
  `status` varchar(10) NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contributions`
--

INSERT INTO `contributions` (`id`, `name`, `amount`, `date`, `receiptno`, `status`, `member_id`) VALUES
(1, 'zahara', 100000, '2019-11-09', 278, 'accepted', 1),
(2, 'favour', 20000, '2012-09-08', 234, 'accepted', 1),
(3, 'zahara', 100000, '2019-11-09', 278, 'accepted', 1),
(4, 'favour', 20000, '2012-09-08', 234, 'accepted', 1),
(5, 'zahara', 100000, '2019-11-09', 278, 'accepted', 1),
(6, 'favour', 20000, '2012-09-08', 234, 'accepted', 1),
(7, 'zahara', 100000, '2019-11-09', 278, 'denied', 1),
(8, 'favour', 20000, '2012-09-08', 234, 'denied', 1),
(9, 'saidat', 200000, '2018-02-09', 234, 'accepted', 1),
(10, 'saidat', 200000, '2018-02-09', 234, 'accepted', 1),
(11, 'saidat', 200000, '2018-02-09', 234, 'accepted', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `creditors`
--
CREATE TABLE `creditors` (
`name` varchar(20)
,`loan` int(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `ideas`
--

CREATE TABLE `ideas` (
  `id` int(3) NOT NULL,
  `name` varchar(20) NOT NULL,
  `ideaname` varchar(30) NOT NULL,
  `capital` int(30) NOT NULL,
  `description` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL,
  `member_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ideas`
--

INSERT INTO `ideas` (`id`, `name`, `ideaname`, `capital`, `description`, `status`, `member_id`) VALUES
(1, 'ereth', 'hairsaloon', 3000000, 'money', 'accepted', 1),
(2, 'ereth', 'hairsaloon', 3000000, 'money', 'accepted', 1),
(3, 'ereth', 'hairsaloon', 3000000, 'money', 'accepted', 1),
(4, 'ereth', 'hairsaloon', 3000000, 'money', 'denied', 1);

-- --------------------------------------------------------

--
-- Table structure for table `investments`
--

CREATE TABLE `investments` (
  `id` int(3) NOT NULL,
  `idea` varchar(20) NOT NULL,
  `investdate` date NOT NULL,
  `investmentprice` int(13) NOT NULL,
  `profit` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `investments`
--

INSERT INTO `investments` (`id`, `idea`, `investdate`, `investmentprice`, `profit`) VALUES
(1, 'saloon', '2010-03-09', 100000, 10000),
(2, 'fishing', '2011-02-19', 50000, -10000);

-- --------------------------------------------------------

--
-- Stand-in structure for view `loan`
--
CREATE TABLE `loan` (
`name` varchar(30)
,`payback` decimal(22,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `loan_request`
--

CREATE TABLE `loan_request` (
  `id` int(3) NOT NULL,
  `client_name` varchar(30) NOT NULL,
  `amount` int(20) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `member_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_request`
--

INSERT INTO `loan_request` (`id`, `client_name`, `amount`, `date`, `status`, `member_id`) VALUES
(1, 'saidat', 2000, '2019-04-06', 'accepted', 1),
(2, 'bad', 70, '2017-12-08', 'accepted', 2),
(3, 'saidat', 2000, '2019-04-06', 'accepted', 1),
(4, 'bad', 70, '2017-12-08', 'accepted', 2),
(5, 'saidat', 2000, '2019-04-06', 'accepted', 1),
(6, 'bad', 70, '2017-12-08', 'accepted', 2),
(7, 'saidat', 2000, '2019-04-06', 'denied', 1),
(8, 'bad', 70, '2017-12-08', 'denied', 2),
(9, 'saidat', 100000, '2017-06-09', 'accepted', 1),
(10, 'saidat', 100000, '2017-06-09', 'accepted', 1);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(3) NOT NULL,
  `name` varchar(20) NOT NULL,
  `intialcontribution` double NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `intialcontribution`, `username`, `password`) VALUES
(1, 'Nanjuki saidat', 10000, 'saidat', 'nanjuki'),
(2, 'kiiza favour', 20000, 'favour', '4546'),
(3, 'nabuufu ereth', 100000, 'ereth', '2398');

-- --------------------------------------------------------

--
-- Stand-in structure for view `total`
--
CREATE TABLE `total` (
`amount` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `total_contribution`
--
CREATE TABLE `total_contribution` (
`SUM(contributions.amount)` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Structure for view `benefit`
--
DROP TABLE IF EXISTS `benefit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `benefit`  AS  select `members`.`name` AS `name`,(`total`.`amount` * 0.65) AS `amount` from ((`members` join `total`) join `contributions`) where (`members`.`name` = `contributions`.`name`) ;

-- --------------------------------------------------------

--
-- Structure for view `creditors`
--
DROP TABLE IF EXISTS `creditors`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `creditors`  AS  select `members`.`name` AS `name`,`loan_request`.`amount` AS `loan` from (`members` join `loan_request`) where ((`members`.`name` = `loan_request`.`client_name`) and (`loan_request`.`status` = 'accepted')) ;

-- --------------------------------------------------------

--
-- Structure for view `loan`
--
DROP TABLE IF EXISTS `loan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `loan`  AS  select `loan_request`.`client_name` AS `name`,(`loan_request`.`amount` * 0.25) AS `payback` from (`members` join `loan_request`) where (`members`.`name` = `loan_request`.`client_name`) ;

-- --------------------------------------------------------

--
-- Structure for view `total`
--
DROP TABLE IF EXISTS `total`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `total`  AS  select sum(`investments`.`profit`) AS `amount` from `investments` ;

-- --------------------------------------------------------

--
-- Structure for view `total_contribution`
--
DROP TABLE IF EXISTS `total_contribution`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `total_contribution`  AS  select sum(`contributions`.`amount`) AS `SUM(contributions.amount)` from `contributions` where (`contributions`.`status` = 'accepted') ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_password`);

--
-- Indexes for table `benefits`
--
ALTER TABLE `benefits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contributions`
--
ALTER TABLE `contributions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `ideas`
--
ALTER TABLE `ideas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `investments`
--
ALTER TABLE `investments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_request`
--
ALTER TABLE `loan_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `benefits`
--
ALTER TABLE `benefits`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contributions`
--
ALTER TABLE `contributions`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ideas`
--
ALTER TABLE `ideas`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `investments`
--
ALTER TABLE `investments`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `loan_request`
--
ALTER TABLE `loan_request`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
