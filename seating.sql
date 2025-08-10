-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
-- Host: localhost:3307
-- Database: `seating`
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
 /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
 /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 /*!40101 SET NAMES utf8mb4 */;

-- Create database
CREATE DATABASE IF NOT EXISTS `seating`;
USE `seating`;

-- ------------------------
-- Table structure for `admin`
-- ------------------------
CREATE TABLE `admin` (
  `adminid` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `admin` (`adminid`, `name`, `email`, `password`) VALUES
(1, 'SARAH ANGELINE', 'admin1@gmail.com', 'root12');
-- ------------------------
-- Table structure for `class`
-- ------------------------
CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `year` varchar(20) NOT NULL,
  `semester` varchar(10) NOT NULL DEFAULT '2nd',
  `dept` varchar(30) NOT NULL,
  `division` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- ------------------------
-- Table structure for `room`
-- ------------------------
CREATE TABLE `room` (
  `rid` int(11) NOT NULL,
  `room_no` varchar(10) NOT NULL,
  `block_name` varchar(10) NOT NULL,
  `capacity` int(11) NOT NULL,
  `vacancy` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- ------------------------
-- Table structure for `batch`
-- ------------------------
CREATE TABLE `batch` (
  `batch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `startno` bigint NOT NULL,
  `endno` bigint NOT NULL,
  `total` int(11) GENERATED ALWAYS AS (`endno` - `startno` + 1) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO `class` (`class_id`, `year`, `dept`, `division`) VALUES
(14, 'III', 'CSE', 'A'),
(7, 'III', 'CSE', 'B'),
(8, 'III', 'CSE', 'C'),
(32, 'III', 'IT', 'A');

INSERT INTO `room` (`rid`, `room_no`, `block_name`, `capacity`, `vacancy`) VALUES
(1, '105', 'A', 22, 0),
(2, '103', 'B', 10, 0),
(3, '204', 'C', 30, 0),
(4, '103', 'D', 50, 0),
(5, '103', 'E', 30, 0);


INSERT INTO `batch` (`batch_id`, `class_id`, `room_id`, `startno`, `endno`) VALUES
(40, 14, 18, 10, 15),
(41, 8, 18, 1, 3);
-- Step 1: Fix invalid room_id
UPDATE batch SET room_id = 1 WHERE room_id = 18;

-- ------------------------
-- Table structure for `students`
-- ------------------------
CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `class` int(11) NOT NULL,
  `rollno` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `students` (`student_id`, `password`, `name`, `class`, `rollno`) VALUES
(7, 'john44', 'John', 8, 11),
(8, 'h@rry', 'Harry', 8, 8),
(9, 'Jam#s', 'James', 8, 2),
(10, 'Paul45', 'Paul', 8, 3),
(11, 'p@uli', 'Pauly', 8, 4),
(13, 'lisa12', 'Lisa', 8, 7),
(15, 'anthony', 'Anthony', 8, 6),
(16, 'mary', 'Mary', 8, 9),
(17, 'laura12', 'Laura', 8, 10),
(18, 'michelle', 'Michelle', 7, 1),
(19, 'robert', 'Robert', 7, 2),
(20, 'ronald', 'Ronald', 7, 3),
(21, 'patrica', 'Patrica', 7, 4),
(22, 'nancy', 'Nancy', 7, 5),
(23, 'christopher', 'Christopher', 7, 6),
(32, 'clark', 'Clark', 8, 1),
(41, 'thomas', 'Thomas', 7, 7),
(45, '160622733126', 'ABIA AZEEM', 8, 160622733126),
(46, '160622733127', 'ADURI VANDANA', 8, 160622733127),
(47, '160622733128', 'ALJAPOOR SRI VAISHNAVI', 8, 160622733128),
(48, '160622733129', 'ANAGAYA SAMEEKSHA', 8, 160622733129),
(49, '160622733130', 'APPADI GEETHIKA', 8, 160622733130),
(50, '160622733131', 'ASHAMOLLA HARSHIKA', 8, 160622733131),
(51, '160622733132', 'AVANGAPURAM SRESHTA', 8, 160622733132),
(52, '160622733133', 'AYESHA FATIMA', 8, 160622733133),
(53, '160622733134', 'B PRERANA', 8, 160622733134),
(54, '160622733135', 'BANOTH SHIRISHA', 8, 160622733135),
(55, '160622733136', 'BETTELA DIVYA', 8, 160622733136),
(56, '160622733137', 'BIJJI SATHVIKA', 8, 160622733137),
(57, '160622733138', 'BONTHA AKSHAYA', 8, 160622733138),
(58, '160622733139', 'BURGUPALLY REETHU REDDY', 8, 160622733139),
(59, '160622733140', 'C SAAVYA', 8, 160622733140),
(60, '160622733141', 'CHERUKU CHANDANA', 8, 160622733141),
(61, '160622733142', 'CHODA JAYA NANDINI', 8, 160622733142),
(62, '160622733143', 'DANDU RISHITHA', 8, 160622733143),
(63, '160622733144', 'DIKSHITHA MODI ', 8, 160622733144),
(64, '160622733145', 'ESLAVATH SHIVANI', 8, 160622733145),
(65, '160622733146', 'FIZZA AHMED KHAN', 8, 160622733146),
(66, '160622733147', 'GANJA SRIVIDYA', 8, 160622733147),
(67, '160622733148', 'GOVULA SOWMYA', 8, 160622733148),
(69, '160622733149', 'GURRAM BHUVANA', 8, 160622733149),
(70, '160622733150', 'HANIA AKBER', 8, 160622733150),
(79, '160622733152', 'JAMMULA GREESHMA REDDY', 8, 160622733152),
(80, '160622733153', 'K JAYANTHI', 8, 160622733153),
(81, '160622733154', 'KADIYALA DEEPIKA', 8, 160622733154),
(82, '160622733154', 'KAMBLE ANUDEEPTHI', 8, 160622733155),
(83, '160622733156', 'KARPURAPU SRI VYSHNAVI', 8, 160622733156),
(85, '160622733158', 'KOCHARLAKOTA LALITHA RANI', 8, 160622733158),
(86, '160622733157', 'KEERTHI YADAV MADASU', 8, 160622733157),
(87, '160622733159', 'KOTAGIRI SRI SAI LAXMI SNIGDHA', 8, 160622733159),
(88, '160622733160', 'KURAPATI TEJASHWINI', 8, 160622733160),
(89, '160622733161', 'MADDI VAISHNAVI', 8, 160622733161),
(90, '160622733162', 'MAMILLA GEETHA SRI', 8, 160622733162),
(91, '160622733163', 'MEDISHETTY SATVIKA', 8, 160622733163),
(92, '160622733164', 'MERUGU SANJANA', 8, 160622733164),
(94, '160622733165', 'N. SHREYA', 8, 160622733165),
(96, '160622733166', 'NAKKA RITISHA', 8, 160622733166),
(97, '160622733167', 'NAUSHEEN TARANNUM', 8, 160622733167),
(98, '160622733168', 'P SHAILAJA ', 8, 160622733168),
(99, '160622733169', 'PAGILLA JOSHNA', 8, 160622733169),
(100, '160622733170', 'PANDIRI YAMINI', 8, 160622733170),
(101, '160622733171', 'PAYYAVULA AKHILA', 8, 160622733171),
(102, '160622733172', 'PUTTA RAMYA', 8, 160622733172),
(103, '160622733173', 'RAJAM AKSHAYA SRI', 0, 160622733173),
(106, '160622733175', 'SABA ANJUM', 8, 160622733175),
(107, '160622733176', 'SAI JYOTHIKA ALAHARI', 8, 160622733176),
(108, '160622733177', 'SANVISREE KOTHAVENKATA', 8, 160622733177),
(109, '160622733178', 'SHAMSHABAD POOJITHA', 8, 160622733178),
(110, '160622733179', 'SOHA JABEEN', 8, 160622733179),
(111, '160622733180', 'SURABHI SOUMIKA', 8, 160622733180),
(112, '160622733181', 'SYEDA KULSOOM HUSSAINI', 8, 160622733181),
(113, '160622733182', 'TABASUM SYED TAJAMUL', 8, 160622733182),
(114, '160622733183', 'THOUTAM KHUSHI', 8, 160622733183),
(115, '160622733184', 'U. CHARMIKKA', 8, 160622733184),
(116, '160622733185', 'VAKITI SMANAVI', 8, 160622733185),
(118, '160622733186', 'VISHWANATH NIKITHA', 8, 160622733186),
(119, '160622733187', 'ZOYA ANJUM', 8, 160622733187),
(120, '160622733188', 'RAMAGIRI MEGHANA', 8, 160622733188),
(121, '160622733189', 'PANDIRLA NISHITHA', 8, 160622733189),
(122, '160622733315', 'POLAWAR SNIGDHA', 8, 160622733315),
(123, '160622733316', 'TANZEELA RIFATH', 8, 160622733316),
(124, '160622733317', 'VARMA POLKONDA MEENAKSHI', 8, 160622733317),
(125, '160622733318', 'V SHASHI', 0, 160622733318),
(126, '160622733319', 'VANAM SHIVANI', 8, 160622733319),
(127, '160622733320', 'VARIKUPPALA SUSANNA', 8, 160622733320),
(128, '160622733321', 'VIPPARI NEHA', 8, 160622733321),
(129, '160622733173', 'RAJAM AKSHAYA SRI', 8, 160622733173),
(130, '160622733174', 'RAVULA SOUMYA', 8, 160622733174);

-- ------------------------
-- Indexes
-- ------------------------

ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`),
  ADD UNIQUE KEY `admin_email` (`email`);

ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`),
  ADD UNIQUE KEY `uniqueclass` (`year`, `dept`, `division`);

ALTER TABLE `room`
  ADD PRIMARY KEY (`rid`);

ALTER TABLE `batch`
  ADD PRIMARY KEY (`batch_id`),
  ADD KEY `batch_ibfk_1` (`room_id`),
  ADD KEY `batch_ibfk_2` (`class_id`);

ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `students_ibfk_1` (`class`);

UPDATE students
SET class = 8
WHERE class NOT IN (SELECT class_id FROM class);



-- ------------------------
-- Auto-increment values
-- ------------------------

ALTER TABLE `admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

ALTER TABLE `room`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

ALTER TABLE `batch`
  MODIFY `batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;


-- ------------------------
-- Foreign Key Constraints
-- ------------------------
ALTER TABLE `batch`
  ADD CONSTRAINT `batch_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `batch_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`class`) REFERENCES `class` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
 /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
 /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
DELETE FROM students
WHERE class NOT IN (SELECT class_id FROM class);
-- ALTER TABLE class ADD COLUMN semester VARCHAR(10) NOT NULL AFTER year;


-- Step 2: Add foreign key constraint
-- ALTER TABLE `batch`
  -- ADD CONSTRAINT `batch_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE;

