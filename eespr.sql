-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2023 at 12:56 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eespr`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `time`) VALUES
(7, 'Abstract Reasoning', 20),
(8, 'General Information', 20),
(10, 'Science', 20),
(11, 'Verbal Reasoning', 20),
(12, 'Numerical Reasoning', 20);

-- --------------------------------------------------------

--
-- Table structure for table `choice`
--

CREATE TABLE `choice` (
  `id` int(11) NOT NULL,
  `questionid` int(11) NOT NULL,
  `choice` varchar(50) NOT NULL,
  `answer` varchar(50) NOT NULL,
  `file` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `choice`
--

INSERT INTO `choice` (`id`, `questionid`, `choice`, `answer`, `file`) VALUES
(37, 10, 'B', 'C', ''),
(38, 10, 'A', 'A', ''),
(39, 10, 'C', 'B', ''),
(40, 10, 'D', 'D', ''),
(41, 11, 'yes', 'C', ''),
(42, 11, 'no', 'A', ''),
(43, 11, 'no', 'B', ''),
(44, 11, 'no', 'D', ''),
(45, 12, 'yes', 'B', ''),
(46, 12, 'no', 'A', ''),
(47, 12, 'no', 'C', ''),
(48, 12, 'no', 'D', ''),
(49, 13, 'C', 'C', ''),
(50, 13, 'A', 'A', ''),
(51, 13, 'B', 'B', NULL),
(52, 13, 'D', 'D', ''),
(53, 14, 'yes', 'A', ''),
(54, 14, 'no', 'B', ''),
(55, 14, 'no', 'C', ''),
(56, 14, 'no', 'D', ''),
(57, 15, 'yes', 'D', ''),
(58, 15, 'no', 'A', ''),
(59, 15, 'no', 'B', ''),
(60, 15, 'no', 'C', ''),
(61, 16, 'yes', 'D', ''),
(62, 16, 'no', 'A', ''),
(63, 16, 'no', 'B', ''),
(64, 16, 'no', 'C', ''),
(65, 17, 'yes', 'B', ''),
(66, 17, 'no', 'A', ''),
(67, 17, 'no', 'C', ''),
(68, 17, 'no', 'D', ''),
(69, 18, 'yes', 'C', ''),
(70, 18, 'no', 'A', ''),
(71, 18, 'no', 'B', ''),
(72, 18, 'no', 'D', ''),
(73, 19, 'yes', 'B', ''),
(74, 19, 'no', 'A', ''),
(75, 19, 'no', 'C', ''),
(76, 19, 'no', 'D', ''),
(77, 20, 'yes', 'Ottawa', ''),
(78, 20, 'no', 'Toronto', ''),
(79, 20, 'no', 'Montreal', ''),
(80, 20, 'no', 'Vancouver', ''),
(81, 21, 'yes', 'Leonardo da Vinci', ''),
(82, 21, 'no', 'Pablo Picasso', ''),
(83, 21, 'no', 'Vincent van Gogh', ''),
(84, 21, 'no', 'Claude Monet', ''),
(85, 22, 'yes', 'Mercury', ''),
(86, 22, 'no', 'Mars', ''),
(87, 22, 'no', 'Venus', ''),
(88, 22, 'no', 'Earth', ''),
(89, 23, 'Harper Lee', 'Harper Lee', ''),
(90, 23, 'Ernest Hemingway', 'Ernest Hemingway', ''),
(91, 23, 'F. Scott Fitzgerald', 'F. Scott Fitzgerald', ''),
(92, 23, 'John Steinbeck', 'John Steinbeck', ''),
(93, 24, 'yes', 'Yen', ''),
(94, 24, 'no', 'Dollar', ''),
(95, 24, 'no', 'Euro', ''),
(96, 24, 'no', 'Pound', ''),
(97, 25, 'yes', 'Mount Everest', ''),
(98, 25, 'no', 'Mount Kilimanjaro', ''),
(99, 25, 'no', 'Mount Denali', ''),
(100, 25, 'no', 'Mount Fuji', ''),
(101, 26, 'George Washington', 'George Washington', ''),
(102, 26, 'Thomas Jefferson', 'Thomas Jefferson', ''),
(103, 26, 'Abraham Lincoln', 'Abraham Lincoln', ''),
(104, 26, 'Theodore Roosevelt', 'Theodore Roosevelt', ''),
(105, 27, 'yes', 'Australia', ''),
(106, 27, 'no', 'Brazil', ''),
(107, 27, 'no', 'Canada', ''),
(108, 27, 'no', 'Italy', ''),
(109, 28, 'Yellow', 'Yellow', ''),
(110, 28, 'Red', 'Red', ''),
(111, 28, 'Blue', 'Blue', ''),
(112, 28, 'Green', 'Green', ''),
(113, 29, 'yes', 'Asia', ''),
(114, 29, 'no', 'Europe', ''),
(115, 29, 'no', 'South America', ''),
(116, 29, 'no', 'Africa', ''),
(117, 30, 'yes', '8', ''),
(118, 30, 'no', '6', ''),
(119, 30, 'no', '10', ''),
(120, 30, 'no', '12', ''),
(121, 31, 'yes', '60 mph', ''),
(122, 31, 'no', '40 mph', ''),
(123, 31, 'no', '80 mph', ''),
(124, 31, 'no', '120 mph', ''),
(125, 32, 'yes', '$0.33/sq in', ''),
(126, 32, 'no', '$0.25/sq in', ''),
(127, 32, 'no', '$0.50/sq in', ''),
(128, 32, 'no', '$1.00/sq in', ''),
(129, 33, 'yes', '50', ''),
(130, 33, 'no', '25', ''),
(131, 33, 'no', '75', ''),
(132, 33, 'no', '100', ''),
(133, 34, 'yes', '5 days', ''),
(134, 34, 'no', '2 days', ''),
(135, 34, 'no', '10 days', ''),
(136, 34, 'no', '20 days', ''),
(137, 35, '30%', '30%', ''),
(138, 35, '20%', '20%', ''),
(139, 35, '40%', '40%', ''),
(140, 35, '50%', 'v', ''),
(141, 36, 'yes', '1/3 cup', ''),
(142, 36, 'no', '1/4 cup', ''),
(143, 36, 'no', '1/2 cup', ''),
(144, 36, 'no', '1 cup', ''),
(145, 37, 'yes', '4 cm', ''),
(146, 37, 'no', '2 cm', ''),
(147, 37, 'no', '6 cm', ''),
(148, 37, 'no', '8 cm', ''),
(149, 38, 'yes', '40 cm^2', ''),
(150, 38, 'no', '13 cm^2', ''),
(151, 38, 'no', '30 cm^2', ''),
(152, 38, 'no', '64 cm^2', ''),
(153, 39, '$100,000', '$100,000', ''),
(154, 39, '$200,000', '$200,000', ''),
(155, 39, '$300,000', '$300,000', ''),
(156, 39, '$400,000', '$400,000', ''),
(157, 40, 'yes', 'Cell', ''),
(158, 40, 'no', 'Organ', ''),
(159, 40, 'no', 'Molecule', ''),
(160, 40, 'no', 'Atom', ''),
(161, 41, 'yes', 'Photosynthesis', ''),
(162, 41, 'no', 'Respiration', ''),
(163, 41, 'no', 'Digestion', ''),
(164, 41, 'no', 'Fermentation', ''),
(165, 42, 'yes', 'To transport oxygen and nutrients to the body\\\'s c', ''),
(166, 42, 'no', 'To produce hormones that regulate body functions', ''),
(167, 42, 'no', 'To eliminate waste products from the body', ''),
(168, 42, 'no', 'To break down food and absorb nutrients', ''),
(169, 43, 'yes', 'Kinetic energy', ''),
(170, 43, 'no', 'Thermal energy', ''),
(171, 43, 'no', 'Potential energy', ''),
(172, 43, 'no', 'Electrical energy', ''),
(173, 44, 'yes', 'Radioactivity', ''),
(174, 44, 'no', 'Fission', ''),
(175, 44, 'no', 'Fusion', ''),
(176, 44, 'no', 'Electrolysis', ''),
(177, 45, 'yes', 'Green', ''),
(178, 45, 'no', 'Red', ''),
(179, 45, 'no', 'Yellow', ''),
(180, 45, 'no', 'Magenta', ''),
(181, 46, 'yes', 'Medulla oblongata', ''),
(182, 46, 'no', 'Hippocampus', ''),
(183, 46, 'no', 'Cerebellum', ''),
(184, 46, 'no', 'Cerebrum', ''),
(185, 47, 'yes', 'Mass', ''),
(186, 47, 'no', 'Weight', ''),
(187, 47, 'no', 'Volume', ''),
(188, 47, 'no', 'Density', ''),
(189, 48, 'yes', 'Screwdriver', ''),
(190, 48, 'no', 'Car engine', ''),
(191, 48, 'no', 'Computer keyboard', ''),
(192, 48, 'no', 'Television remote control', ''),
(193, 49, 'yes', 'Nitrogen', ''),
(194, 49, 'no', 'Oxygen', ''),
(195, 49, 'no', 'Carbon dioxide', ''),
(196, 49, 'no', 'Argon', ''),
(197, 50, 'yes', 'Scarce', ''),
(198, 50, 'no', 'Plenty', ''),
(199, 50, 'no', 'Ample', ''),
(200, 50, 'no', 'Sufficient', ''),
(201, 51, 'yes', 'Gracious', ''),
(202, 51, 'no', 'Malevolent', ''),
(203, 51, 'no', 'Hostile', ''),
(204, 51, 'no', 'Spiteful', ''),
(205, 52, 'yes', 'But', ''),
(206, 52, 'no', 'I', ''),
(207, 52, 'no', 'Wanted', ''),
(208, 52, 'no', 'Closed', ''),
(209, 53, 'yes', 'Bear', ''),
(210, 53, 'no', 'Bar', ''),
(211, 53, 'no', 'Bier', ''),
(212, 53, 'no', 'Byre', ''),
(213, 54, 'yes', 'Strange', ''),
(214, 54, 'no', 'Familiar', ''),
(215, 54, 'no', 'Ordinary', ''),
(216, 54, 'no', 'Modern', ''),
(217, 55, 'yes', 'On', ''),
(218, 55, 'no', 'Cat', ''),
(219, 55, 'no', 'Sat', ''),
(220, 55, 'no', 'Mat', ''),
(221, 56, 'yes', 'Brave', ''),
(222, 56, 'no', 'Fearful', ''),
(223, 56, 'no', 'Timid', ''),
(224, 56, 'no', 'Cowardly', ''),
(225, 57, 'yes', 'Clear', ''),
(226, 57, 'no', 'Dark', ''),
(227, 57, 'no', 'Foggy', ''),
(228, 57, 'no', 'Hazy', ''),
(229, 58, 'yes', 'Assignments', ''),
(230, 58, 'no', 'The', ''),
(231, 58, 'no', 'Handed', ''),
(232, 58, 'no', 'Out', ''),
(233, 59, 'yes', 'Misfortune', ''),
(234, 59, 'no', 'Happiness', ''),
(235, 59, 'no', 'Success', ''),
(236, 59, 'no', 'Prosperity', '');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `coursecode` varchar(100) NOT NULL,
  `coursename` varchar(255) NOT NULL,
  `passing_score` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `coursecode`, `coursename`, `passing_score`) VALUES
(1, 'Information Technology', 'Information Technology', '30'),
(3, 'Mechanical Engineering', 'Mechanical Engineering', '34'),
(4, 'Architecture', 'Architecture', '30'),
(5, 'Electrical Engineering', 'Electrical Engineering', '30'),
(6, 'Civil Engineering', 'Civil Engineering', '30');

-- --------------------------------------------------------

--
-- Table structure for table `exam_sched`
--

CREATE TABLE `exam_sched` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` varchar(15) NOT NULL,
  `end_time` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `file` text DEFAULT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `content`, `file`, `category_id`) VALUES
(10, '<p>Which figure is the odd one out?</p>\r\n', '4.25.jpg', 7),
(11, '<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>Which figure is the odd one out?</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', '2.jpg', 7),
(12, '<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>Which figure completes the grid?</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', '3.jpg', 7),
(13, '<p>Which figure completes the grid?</p>\r\n', '4.jpg', 7),
(14, '<p>Which figure is next in the series?</p>\r\n', '5.jpg', 7),
(15, '<p>Which figure is next in the series?</p>\r\n', '6.jpg', 7),
(16, '<p>Which figure belongs in neither group?</p>\r\n', '7.jpg', 7),
(17, '<p>Which figure belongs in neither group?</p>\r\n', '8.jpg', 7),
(18, '<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>Which figure completes the series?</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', '9.jpg', 7),
(19, '<p>Which figure completes the series?</p>\r\n', '10.jpg', 7),
(20, '<p>&nbsp;</p>\r\n\r\n<p>What is the capital of Canada?</p>\r\n', '', 8),
(21, '<p>Who painted the Mona Lisa?</p>\r\n', '', 8),
(22, '<p>Which planet is closest to the sun?</p>\r\n', '', 8),
(23, '<p>Who wrote &quot;To Kill a Mockingbird&quot;?</p>\r\n', '', 8),
(24, '<p>What is the currency of Japan?</p>\r\n', '', 8),
(25, '<p>What is the highest mountain in the world?</p>\r\n', '', 8),
(26, '<p>Who was the first president of the United States?</p>\r\n', '', 8),
(27, '<p>Which country is home to the Great Barrier Reef?</p>\r\n', '', 8),
(28, '<p>Which of the following is not a primary color?</p>\r\n', '', 8),
(29, '<p>What is the largest continent in the world?</p>\r\n', '', 8),
(30, '<p>What is the square root of 64?</p>\r\n', '', 12),
(31, '<p>If a car travels 120 miles in 2 hours, what is its speed in miles per hour?</p>\r\n', '', 12),
(32, '<p>If a pizza with a diameter of 12 inches costs $12, what is the cost per square inch?</p>\r\n', '', 12),
(33, '<p>What is 25% of 200?</p>\r\n', '', 12),
(34, '<p>If 5 workers can complete a project in 10 days, how many days would it take 10 workers to complete the same project?</p>\r\n', '', 12),
(35, '<p>If a store sells a shirt for $25 that originally cost $40, what is the percent discount?</p>\r\n', '', 12),
(36, '<p>If a recipe calls for 2/3 cup of flour and you only have 1/4 cup, how much more flour do you need to get the required amount?</p>\r\n', '', 12),
(37, '<p>If a square has a perimeter of 16 cm, what is the length of one side?</p>\r\n', '', 12),
(38, '<p>A rectangle has a length of 8 cm and a width of 5 cm. What is its area?</p>\r\n', '', 12),
(39, '<p>If a company&#39;s revenue is $500,000 and its expenses are $400,000, what is its net income?</p>\r\n', '', 12),
(40, '<p>Which of the following is the smallest unit of life?</p>\r\n', '', 10),
(41, '<p>Which process is responsible for converting light energy into chemical energy in plants?</p>\r\n', '', 10),
(42, '<p>What is the main function of the circulatory system?</p>\r\n', '', 10),
(43, '<p>Which type of energy is associated with the motion of objects?</p>\r\n', '', 10),
(44, '<p>What is the process by which an unstable nucleus emits radiation and becomes a more stable element?</p>\r\n', '', 10),
(45, '<p>Which of the following is a primary color of light?</p>\r\n', '', 10),
(46, '<p>Which part of the brain is responsible for regulating basic bodily functions such as breathing and heart rate?</p>\r\n', '', 10),
(47, '<p>What is the term for the amount of matter in an object?</p>\r\n', '', 10),
(48, '<p>Which of the following is an example of a simple machine?</p>\r\n', '', 10),
(49, '<p>Which gas is most abundant in Earth&#39;s atmosphere?</p>\r\n', '', 10),
(50, '<p>Which of the following is an antonym of the word &quot;abundant&quot;?</p>\r\n', '', 11),
(51, '<p>Which of the following is a synonym for the word &quot;benevolent&quot;?</p>\r\n', '', 11),
(52, '<p>Which word in the following sentence is a conjunction? &quot;I wanted to go to the store, but it was closed.&quot;</p>\r\n', '', 11),
(53, '<p>Which of the following is a homophone for the word &quot;bare&quot;?</p>\r\n', '', 11),
(54, '<p>Which of the following is a synonym for the word &quot;quaint&quot;?</p>\r\n', '', 11),
(55, '<p>Which of the following words is a preposition in the following sentence? &quot;The cat sat on the mat.&quot;</p>\r\n', '', 11),
(56, '<p>Which of the following is a synonym for the word &quot;intrepid&quot;?</p>\r\n', '', 11),
(57, '<p>Which of the following is an antonym of the word &quot;opaque&quot;?</p>\r\n', '', 11),
(58, '<p>Which of the following words is a noun in the following sentence? &quot;The teacher handed out the assignments.&quot;</p>\r\n', '', 11),
(59, '<p>Which of the following is a synonym for the word &quot;adversity&quot;?</p>\r\n', '', 11);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `stud_id` varchar(50) NOT NULL,
  `score` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`id`, `category_id`, `stud_id`, `score`, `total`, `date`) VALUES
(1, 7, '190700dw3', 1, 10, '2023-03-19 00:37:21'),
(2, 8, '190700dw3', 7, 10, '2023-03-19 00:47:36'),
(3, 10, '190700dw3', 9, 10, '2023-03-19 00:51:49'),
(4, 11, '190700dw3', 9, 10, '2023-03-19 00:52:58'),
(5, 12, '190700dw3', 8, 10, '2023-03-19 00:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `stud_id` varchar(50) NOT NULL,
  `question_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `choice_id` int(11) NOT NULL,
  `has_quiz` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `stud_id`, `question_id`, `category_id`, `choice_id`, `has_quiz`) VALUES
(1, '190700dw3', 19, 7, 73, 1),
(2, '190700dw3', 18, 7, 71, 1),
(3, '190700dw3', 17, 7, 66, 1),
(4, '190700dw3', 16, 7, 62, 1),
(5, '190700dw3', 15, 7, 60, 1),
(6, '190700dw3', 14, 7, 56, 1),
(7, '190700dw3', 13, 7, 51, 1),
(8, '190700dw3', 12, 7, 48, 1),
(9, '190700dw3', 11, 7, 44, 1),
(10, '190700dw3', 10, 7, 37, 1),
(11, '190700dw3', 29, 8, 113, 1),
(12, '190700dw3', 28, 8, 109, 1),
(13, '190700dw3', 27, 8, 105, 1),
(14, '190700dw3', 26, 8, 101, 1),
(15, '190700dw3', 25, 8, 97, 1),
(16, '190700dw3', 24, 8, 93, 1),
(17, '190700dw3', 23, 8, 89, 1),
(18, '190700dw3', 22, 8, 85, 1),
(19, '190700dw3', 21, 8, 81, 1),
(20, '190700dw3', 20, 8, 77, 1),
(21, '190700dw3', 49, 10, 193, 1),
(22, '190700dw3', 48, 10, 189, 1),
(23, '190700dw3', 47, 10, 185, 1),
(24, '190700dw3', 46, 10, 181, 1),
(25, '190700dw3', 45, 10, 177, 1),
(26, '190700dw3', 44, 10, 173, 1),
(27, '190700dw3', 43, 10, 169, 1),
(28, '190700dw3', 42, 10, 165, 1),
(29, '190700dw3', 41, 10, 161, 1),
(30, '190700dw3', 40, 10, 160, 1),
(31, '190700dw3', 59, 11, 234, 1),
(32, '190700dw3', 58, 11, 229, 1),
(33, '190700dw3', 57, 11, 225, 1),
(34, '190700dw3', 56, 11, 221, 1),
(35, '190700dw3', 55, 11, 217, 1),
(36, '190700dw3', 54, 11, 213, 1),
(37, '190700dw3', 53, 11, 209, 1),
(38, '190700dw3', 52, 11, 205, 1),
(39, '190700dw3', 51, 11, 201, 1),
(40, '190700dw3', 50, 11, 197, 1),
(41, '190700dw3', 39, 12, 155, 1),
(42, '190700dw3', 38, 12, 149, 1),
(43, '190700dw3', 37, 12, 145, 1),
(44, '190700dw3', 36, 12, 141, 1),
(45, '190700dw3', 35, 12, 137, 1),
(46, '190700dw3', 34, 12, 133, 1),
(47, '190700dw3', 33, 12, 129, 1),
(48, '190700dw3', 32, 12, 125, 1),
(49, '190700dw3', 31, 12, 121, 1),
(50, '190700dw3', 30, 12, 117, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `studid` varchar(50) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `mobileno` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `address` varchar(45) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `graduated` date DEFAULT NULL,
  `last_school` varchar(100) DEFAULT NULL,
  `pref_course` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `studid`, `fname`, `lname`, `gender`, `mobileno`, `email`, `address`, `birthdate`, `graduated`, `last_school`, `pref_course`, `user_id`) VALUES
(1, '190700dw3', 'Ariel', 'Yap', 'Male', '09454262035', 'johnarielyap1a43@gmail.com', 'inayawan\\\\ncebu', '2023-03-18', '2023-03-18', '2023', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `str_password` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(45) NOT NULL,
  `mobileno` varchar(45) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`id`, `username`, `password`, `str_password`, `fname`, `lname`, `email`, `mobileno`, `level`) VALUES
(1, 'eespr', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'Ariel', 'Yap', 'master@arieldev.tech', '09123456789', 'Admin'),
(2, 'arieltest', 'bd8de5e86f3e5bd6fa57880b2c15cee9ac5d3fd2', 'arieltest', 'Ariel', 'Yap', 'johnarielyap1a43@gmail.com', '09454262035', 'Student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `choice`
--
ALTER TABLE `choice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_choices_1` (`questionid`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_sched`
--
ALTER TABLE `exam_sched`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_question_1` (`category_id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_result_1` (`stud_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_student_1` (`pref_course`),
  ADD KEY `FK_student_2` (`user_id`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `choice`
--
ALTER TABLE `choice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `exam_sched`
--
ALTER TABLE `exam_sched`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `choice`
--
ALTER TABLE `choice`
  ADD CONSTRAINT `FK_choices_1` FOREIGN KEY (`questionid`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_question_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `FK_student_1` FOREIGN KEY (`pref_course`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_student_2` FOREIGN KEY (`user_id`) REFERENCES `userdata` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
