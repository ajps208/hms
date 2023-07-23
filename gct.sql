-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2023 at 05:15 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gct`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(300) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `reg_date`, `updation_date`) VALUES
(1, 'admin', 'admin@mail.com', 'D00F5D5217896FB7FD601412CB890830', '2020-09-08 20:31:45', '2023-02-12');

-- --------------------------------------------------------

--
-- Table structure for table `adminlog`
--

CREATE TABLE `adminlog` (
  `id` int(11) NOT NULL,
  `adminid` int(11) NOT NULL,
  `ip` varbinary(16) NOT NULL,
  `logintime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

CREATE TABLE `attendence` (
  `id` int(10) NOT NULL,
  `admno` varchar(50) NOT NULL,
  `attendence` varchar(50) NOT NULL,
  `remark` varchar(50) DEFAULT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendence`
--

INSERT INTO `attendence` (`id`, `admno`, `attendence`, `remark`, `date`) VALUES
(347, '444', 'absent', '', '2023-03-14'),
(348, '111', 'present', '', '2023-03-14'),
(350, '444', 'absent', '', '2023-03-30'),
(351, '111', 'present', '', '2023-03-30');

-- --------------------------------------------------------

--
-- Table structure for table `book_hostel`
--

CREATE TABLE `book_hostel` (
  `id` int(11) NOT NULL,
  `admno` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `age` varchar(25) NOT NULL,
  `caste` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `food` varchar(50) NOT NULL,
  `local_gname` varchar(50) NOT NULL,
  `local_grelation` varchar(50) NOT NULL,
  `local_phone` varchar(50) NOT NULL,
  `address` varchar(80) NOT NULL,
  `pincode` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `distance` varchar(50) NOT NULL,
  `photo` varchar(500) NOT NULL,
  `idcard` varchar(500) NOT NULL,
  `c_certificate` varchar(500) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_hostel`
--

INSERT INTO `book_hostel` (`id`, `admno`, `dob`, `age`, `caste`, `gender`, `food`, `local_gname`, `local_grelation`, `local_phone`, `address`, `pincode`, `district`, `distance`, `photo`, `idcard`, `c_certificate`, `status`) VALUES
(2, '444', '2023-03-15', '20', 'OBC', 'Male', 'Veg', '5555G', 'KHFG', '2435566', 'gdgdg', 'dgdg', 'sssssssssss', '22', '../photo/2023-03-01.png', '../idcard/admin.pdf', '../caste/admin.pdf', 'Approved'),
(3, '111', '2023-03-13', '20', 'GENERAL', 'Female', 'Veg', 'JHK', 'pip', '2435566', 'GGGG', '4564', 'ggggg', '56', '../photo/2023-03-01 (3).png', '../idcard/Basic OOPs Interview_Interviewbit.pdf', '../caste/admin.pdf', 'Approved'),
(15, '66', '2023-03-14', '8', 'GENERAL', 'Male', 'Veg', 'aaaa', 'aaaa', '2435566', 'GGGG', '680312', 'ggggg', '56', '../photo/2023-03-01.png', '../idcard/ATMAS Report.pdf', '../caste/ATMAS Report.pdf', 'Advance Pending'),
(17, '42', '2023-03-14', '20', 'OEC', 'Male', 'Non Veg', 'aaaa', 'KHFG', '2435566', 'GGGG', '4564', 'ggggg', '56', '../photo/2023-03-01.png', '../idcard/ATMAS Report.pdf', '../caste/ATMAS Report.pdf', 'Advance Pending'),
(18, '75', '2023-03-08', '20', 'OEC', 'Female', 'Non Veg', 'lopui', 'trfwtw', '6543676', 'ss', '4564', 'gssssss', '56', '../photo/ER Diagram.pdf', '../idcard/Hostel Management System.pdf', '../caste/ER Diagram.pdf', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `id` int(22) NOT NULL,
  `admno` int(33) NOT NULL,
  `com` varchar(500) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`id`, `admno`, `com`, `date`) VALUES
(1, 444, 'pani', '2023-03-18'),
(4, 444, 'kk', '2023-03-19');

-- --------------------------------------------------------

--
-- Table structure for table `leave_application`
--

CREATE TABLE `leave_application` (
  `id` int(10) NOT NULL,
  `admno` varchar(20) NOT NULL,
  `l_type` varchar(500) NOT NULL,
  `reason` varchar(50) NOT NULL,
  `apply_date` date NOT NULL DEFAULT current_timestamp(),
  `start` varchar(50) NOT NULL,
  `end` varchar(50) NOT NULL,
  `remark` varchar(50) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_application`
--

INSERT INTO `leave_application` (`id`, `admno`, `l_type`, `reason`, `apply_date`, `start`, `end`, `remark`, `status`) VALUES
(1, '444', 'Day Leave', 'kk', '2023-03-16', '113', '454', 'leave granted', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `meal`
--

CREATE TABLE `meal` (
  `id` int(10) NOT NULL,
  `meal` varchar(500) NOT NULL,
  `week` varchar(50) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meal`
--

INSERT INTO `meal` (`id`, `meal`, `week`) VALUES
(25, '../meal/Screenshot (2).png', '2023-03-10 22:46:55'),
(26, '../meal/Screenshot (16).png', '2023-03-10 22:47:09'),
(27, '../meal/Screenshot (16).png', '2023-03-10 22:52:02'),
(28, '../meal/Screenshot (16).png', '2023-03-10 22:52:18'),
(29, '../meal/Screenshot (16).png', '2023-03-10 22:52:33'),
(30, '../meal/Screenshot (16).png', '2023-03-10 22:52:51'),
(31, '../meal/Screenshot (41).png', '2023-03-10 22:54:59');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(10) NOT NULL,
  `admno` int(50) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'pending',
  `posted` date NOT NULL DEFAULT current_timestamp(),
  `date` varchar(200) NOT NULL,
  `recipt` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `admno`, `amount`, `status`, `posted`, `date`, `recipt`) VALUES
(7, 444, '1000', 'Approved', '2023-03-16', '2023-03-14', '../payment/C++ Interview Questions_Interviewbit.pdf'),
(8, 111, '1000', 'pending', '2023-03-16', '2023-03-14', ''),
(9, 444, '2000', 'pending', '2023-03-18', '2023-06-14', ''),
(10, 111, '23345', 'pending', '2023-03-18', '2023-06-14', ''),
(13, 444, '2000', 'pending', '2023-03-18', '2023-04-03', ' '),
(14, 111, '1000', 'pending', '2023-03-18', '2023-04-03', '');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `admno` varchar(50) NOT NULL,
  `bedno` varchar(11) NOT NULL,
  `roomno` varchar(11) NOT NULL,
  `stayfrom` varchar(50) NOT NULL,
  `roomtype` varchar(50) NOT NULL,
  `atp` varchar(50) NOT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `adv_recipt` varchar(500) DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `updationDate` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `admno`, `bedno`, `roomno`, `stayfrom`, `roomtype`, `atp`, `postingDate`, `adv_recipt`, `status`, `updationDate`) VALUES
(4, '444', '4', '        2  ', '2023-03-10', '        Doble    ', '55', '2023-03-15 13:25:23', NULL, 'Approved', ''),
(6, '111', '3', '        2  ', '2023-03-16', '        Double    ', '55', '2023-03-15 16:43:30', '../advance/project report .pdf', 'Approved', ''),
(10, '42', '2', '        1  ', '2023-03-06', '        Doble    ', '55', '2023-03-20 15:36:08', NULL, 'Advance Pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_no` int(11) NOT NULL,
  `bed_no` int(11) NOT NULL,
  `room_type` varchar(50) NOT NULL,
  `posting_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_no`, `bed_no`, `room_type`, `posting_date`) VALUES
(12, 1, 1, 'Single', '2023-02-12 09:23:53'),
(13, 1, 2, 'Doble', '2023-02-12 09:27:39'),
(14, 2, 3, 'Double', '2023-02-12 09:27:39'),
(15, 2, 4, 'Doble', '2023-02-12 09:29:27'),
(16, 3, 5, 'Double', '2023-02-12 09:29:27'),
(17, 3, 6, 'Double', '2023-02-12 09:29:27'),
(18, 4, 7, 'Double', '2023-02-12 09:29:27'),
(19, 4, 8, 'Double', '2023-02-12 09:29:27'),
(22, 5, 9, 'Dormitory', '2023-02-18 11:47:35');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userIp` varbinary(16) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `loginTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `userId`, `userEmail`, `userIp`, `city`, `country`, `loginTime`) VALUES
(1, 1, 'strangedr653@gmail.com', 0x3a3a31, '', '', '2023-03-15 07:54:15'),
(2, 2, 'max@gmail.com', 0x3a3a31, '', '', '2023-03-15 07:58:06'),
(3, 2, 'max@gmail.com', 0x3a3a31, '', '', '2023-03-15 08:00:28'),
(4, 1, 'strangedr653@gmail.com', 0x3a3a31, '', '', '2023-03-15 08:36:38'),
(5, 1, 'strangedr653@gmail.com', 0x3a3a31, '', '', '2023-03-15 12:46:52'),
(6, 2, 'max@gmail.com', 0x3a3a31, '', '', '2023-03-15 12:55:31'),
(7, 2, 'max@gmail.com', 0x3a3a31, '', '', '2023-03-15 13:11:25'),
(8, 5, 'kk@gmail.com', 0x3a3a31, '', '', '2023-03-15 16:08:13'),
(9, 5, 'kk@gmail.com', 0x3a3a31, '', '', '2023-03-15 16:34:08'),
(10, 3, 'lal@gmai.com', 0x3a3a31, '', '', '2023-03-15 16:35:57'),
(11, 3, 'lal@gmai.com', 0x3a3a31, '', '', '2023-03-15 16:38:22'),
(12, 3, 'lal@gmai.com', 0x3a3a31, '', '', '2023-03-15 16:38:22'),
(13, 5, 'kk@gmail.com', 0x3a3a31, '', '', '2023-03-15 16:39:18'),
(14, 5, 'kk@gmail.com', 0x3a3a31, '', '', '2023-03-16 04:52:49'),
(15, 5, 'kk@gmail.com', 0x3a3a31, '', '', '2023-03-16 04:59:13'),
(16, 1, 'strangedr653@gmail.com', 0x3a3a31, '', '', '2023-03-16 04:59:34'),
(17, 2, 'max@gmail.com', 0x3a3a31, '', '', '2023-03-16 04:59:52'),
(18, 1, 'strangedr653@gmail.com', 0x3a3a31, '', '', '2023-03-16 05:02:25'),
(19, 2, 'max@gmail.com', 0x3a3a31, '', '', '2023-03-16 05:03:25'),
(20, 3, 'lal@gmai.com', 0x3a3a31, '', '', '2023-03-16 05:05:32'),
(21, 3, 'lal@gmai.com', 0x3a3a31, '', '', '2023-03-16 05:09:21'),
(22, 2, 'max@gmail.com', 0x3a3a31, '', '', '2023-03-16 05:10:14'),
(23, 2147483647, '444', 0x3a3a31, '', '', '2023-03-16 05:12:30'),
(24, 2, '797', 0x3a3a31, '', '', '2023-03-16 05:12:45'),
(25, 2, 'max@gmail.com', 0x3a3a31, '', '', '2023-03-16 05:13:53'),
(26, 2, 'max@gmail.com', 0x3a3a31, '', '', '2023-03-16 05:14:34'),
(27, 1, 'strangedr653@gmail.com', 0x3a3a31, '', '', '2023-03-16 05:14:55'),
(28, 1, 'strangedr653@gmail.com', 0x3a3a31, '', '', '2023-03-16 05:21:06'),
(29, 2, 'max@gmail.com', 0x3a3a31, '', '', '2023-03-16 05:21:21'),
(30, 5, 'kk@gmail.com', 0x3a3a31, '', '', '2023-03-16 05:23:34'),
(31, 1, 'strangedr653@gmail.com', 0x3a3a31, '', '', '2023-03-16 05:44:43'),
(32, 3, 'lal@gmai.com', 0x3a3a31, '', '', '2023-03-16 06:06:12'),
(33, 1, 'strangedr653@gmail.com', 0x3a3a31, '', '', '2023-03-16 06:08:47'),
(34, 2, 'max@gmail.com', 0x3a3a31, '', '', '2023-03-16 06:09:05'),
(35, 1, 'strangedr653@gmail.com', 0x3a3a31, '', '', '2023-03-16 06:34:50'),
(36, 1, 'strangedr653@gmail.com', 0x3a3a31, '', '', '2023-03-16 06:57:51'),
(37, 3, 'lal@gmai.com', 0x3a3a31, '', '', '2023-03-16 06:59:11'),
(38, 3, 'lal@gmai.com', 0x3a3a31, '', '', '2023-03-16 06:59:32'),
(39, 5, 'kk@gmail.com', 0x3a3a31, '', '', '2023-03-16 06:59:56'),
(40, 2, 'max@gmail.com', 0x3a3a31, '', '', '2023-03-16 07:09:23'),
(41, 1, 'strangedr653@gmail.com', 0x3a3a31, '', '', '2023-03-16 07:10:10'),
(42, 5, 'kk@gmail.com', 0x3a3a31, '', '', '2023-03-16 07:32:22'),
(43, 2, 'max@gmail.com', 0x3a3a31, '', '', '2023-03-16 08:25:31'),
(44, 3, 'lal@gmai.com', 0x3a3a31, '', '', '2023-03-17 14:19:06'),
(45, 3, 'lal@gmai.com', 0x3a3a31, '', '', '2023-03-17 15:01:45'),
(46, 5, 'kk@gmail.com', 0x3a3a31, '', '', '2023-03-17 15:25:16'),
(47, 2, 'max@gmail.com', 0x3a3a31, '', '', '2023-03-17 15:33:18'),
(48, 1, 'strangedr653@gmail.com', 0x3a3a31, '', '', '2023-03-17 16:07:01'),
(49, 5, 'kk@gmail.com', 0x3a3a31, '', '', '2023-03-17 16:07:17'),
(50, 2, 'max@gmail.com', 0x3a3a31, '', '', '2023-03-17 16:07:42'),
(51, 5, 'kk@gmail.com', 0x3a3a31, '', '', '2023-03-17 16:08:35'),
(52, 6, 'zz@gmail.com', 0x3a3a31, '', '', '2023-03-17 16:17:22'),
(53, 6, 'zz@gmail.com', 0x3a3a31, '', '', '2023-03-17 16:18:46'),
(54, 7, 'max@gmail.com', 0x3a3a31, '', '', '2023-03-17 16:21:42'),
(55, 7, 'max@gmail.com', 0x3a3a31, '', '', '2023-03-17 16:23:18'),
(56, 7, 'max@gmail.com', 0x3a3a31, '', '', '2023-03-17 16:23:54'),
(57, 7, 'max@gmail.com', 0x3a3a31, '', '', '2023-03-17 16:26:30'),
(58, 7, 'max@gmail.com', 0x3a3a31, '', '', '2023-03-17 16:56:02'),
(59, 3, 'lal@gmai.com', 0x3a3a31, '', '', '2023-03-17 16:57:33'),
(60, 7, 'max@gmail.com', 0x3a3a31, '', '', '2023-03-17 17:18:47'),
(61, 7, 'max@gmail.com', 0x3a3a31, '', '', '2023-03-18 05:40:11'),
(62, 1, 'strangedr653@gmail.com', 0x3a3a31, '', '', '2023-03-18 05:52:15'),
(63, 1, 'strangedr653@gmail.com', 0x3a3a31, '', '', '2023-03-18 06:11:37'),
(64, 5, 'kk@gmail.com', 0x3a3a31, '', '', '2023-03-18 06:12:55'),
(65, 1, 'strangedr653@gmail.com', 0x3a3a31, '', '', '2023-03-18 06:20:07'),
(66, 1, 'strangedr653@gmail.com', 0x3a3a31, '', '', '2023-03-18 06:29:33'),
(67, 1, 'strangedr653@gmail.com', 0x3a3a31, '', '', '2023-03-18 06:59:50'),
(68, 1, 'strangedr653@gmail.com', 0x3a3a31, '', '', '2023-03-18 09:14:50'),
(69, 1, 'strangedr653@gmail.com', 0x3a3a31, '', '', '2023-03-19 08:37:21'),
(70, 9, 'll@gmail.com', 0x3a3a31, '', '', '2023-03-19 08:52:53'),
(71, 5, 'kk@gmail.com', 0x3a3a31, '', '', '2023-03-19 09:08:19'),
(72, 5, 'kk@gmail.com', 0x3a3a31, '', '', '2023-03-19 14:50:47'),
(73, 1, 'strangedr653@gmail.com', 0x3a3a31, '', '', '2023-03-19 14:52:06'),
(74, 1, 'strangedr653@gmail.com', 0x3a3a31, '', '', '2023-03-19 14:52:13'),
(75, 5, 'kk@gmail.com', 0x3a3a31, '', '', '2023-03-19 14:53:09'),
(76, 5, 'kk@gmail.com', 0x3a3a31, '', '', '2023-03-19 14:53:15'),
(77, 3, 'lal@gmai.com', 0x3a3a31, '', '', '2023-03-19 15:01:15'),
(78, 1, 'strangedr653@gmail.com', 0x3a3a31, '', '', '2023-03-19 15:21:49'),
(79, 3, 'lal@gmai.com', 0x3a3a31, '', '', '2023-03-19 15:22:18'),
(80, 3, 'lal@gmai.com', 0x3a3a31, '', '', '2023-03-22 11:52:18'),
(81, 1, 'strangedr653@gmail.com', 0x3a3a31, '', '', '2023-03-22 11:57:24');

-- --------------------------------------------------------

--
-- Table structure for table `userregistration`
--

CREATE TABLE `userregistration` (
  `id` int(11) NOT NULL,
  `admno` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `course` varchar(50) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `contactNo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(45) NOT NULL,
  `passUdateDate` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userregistration`
--

INSERT INTO `userregistration` (`id`, `admno`, `name`, `course`, `semester`, `contactNo`, `email`, `password`, `regDate`, `updationDate`, `passUdateDate`) VALUES
(1, '444', 'ajith', 'Bsc Computer Science', '1', '0123456', 'strangedr653@gmail.com', 'ajith', '2023-03-15 07:53:23', '', ''),
(3, '75', 'strange007', 'Bsc Maths', '2', '0123456', 'lal@gmai.com', 'lal', '2023-03-15 14:16:20', '', ''),
(5, '111', 'kay', 'Bsc cs', '3', '1236', 'kk@gmail.com', 'kk', '2023-03-15 16:08:03', '16-03-2023 03:21:10', ''),
(7, '66', 'max parker', 'Bsc Statistics', '1', '0123456', 'max@gmail.com', 'max', '2023-03-17 16:20:43', '', ''),
(9, '42', 'zxcv', 'Bsc Maths', '2', '1236', 'll@gmail.com', 'll', '2023-03-19 08:52:46', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `warden`
--

CREATE TABLE `warden` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL DEFAULT 'warden',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `Contact_no` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_date` date NOT NULL,
  `updation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `warden`
--

INSERT INTO `warden` (`id`, `username`, `name`, `email`, `Contact_no`, `password`, `reg_date`, `updation_date`) VALUES
(3, 'warden', 'max parker', 'warden@gmail.com', '0123456', '170e46bf5e0cafab00cac3a650910837', '0000-00-00', '2023-03-18 07:55:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendence`
--
ALTER TABLE `attendence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_hostel`
--
ALTER TABLE `book_hostel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_application`
--
ALTER TABLE `leave_application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meal`
--
ALTER TABLE `meal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userregistration`
--
ALTER TABLE `userregistration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warden`
--
ALTER TABLE `warden`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendence`
--
ALTER TABLE `attendence`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=352;

--
-- AUTO_INCREMENT for table `book_hostel`
--
ALTER TABLE `book_hostel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `leave_application`
--
ALTER TABLE `leave_application`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `meal`
--
ALTER TABLE `meal`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `userregistration`
--
ALTER TABLE `userregistration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `warden`
--
ALTER TABLE `warden`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
