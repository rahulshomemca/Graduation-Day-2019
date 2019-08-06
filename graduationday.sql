-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2019 at 09:15 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `graduationday`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `mobile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `hash`, `mobile`) VALUES
(1, 'admin', '9da18956ea0ffce75e415baab7fae6ee', 'kjngnb', '9775418944');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `stud_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `usn` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `attending` varchar(255) NOT NULL,
  `people` varchar(255) NOT NULL,
  `a1` varchar(255) NOT NULL,
  `a2` varchar(255) NOT NULL,
  `a3` varchar(255) NOT NULL,
  `a4` varchar(255) NOT NULL,
  `a5` varchar(255) NOT NULL,
  `a6` varchar(255) DEFAULT NULL,
  `a7` varchar(255) DEFAULT NULL,
  `a8` varchar(255) DEFAULT NULL,
  `a9` varchar(255) DEFAULT NULL,
  `a10` varchar(255) DEFAULT NULL,
  `a11` varchar(255) DEFAULT NULL,
  `a12` varchar(255) DEFAULT NULL,
  `feedback` text,
  `pvt_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `graduates`
--

CREATE TABLE `graduates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `usn` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `pvt_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text,
  `opt1` varchar(255) NOT NULL,
  `opt2` varchar(255) NOT NULL,
  `opt3` varchar(255) NOT NULL,
  `opt4` varchar(255) NOT NULL,
  `opt5` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `opt1`, `opt2`, `opt3`, `opt4`, `opt5`) VALUES
(1, 'Did you join this program with a clear goal?', 'Strongly agree', 'Agree', 'Partially agree', 'Mutual', 'Disagree'),
(2, 'The curriculum satisfied your expectations with respect to applying the knowledge to assess societal, health, safety, legal and cultural issues and the consequent responsibilities relevant to the professional engineering practice.', 'Strongly agree', 'Agree', 'Partially agree', 'Mutual', 'Disagree'),
(3, 'Curriculum design was holistic with an optimum combination of basic sciences, mechanical engineering, industrial engineering, quantitative models, humanities & management, information system design, lab components and projects.', 'Strongly agree', 'Agree', 'Partially agree', 'Mutual', 'Disagree'),
(4, 'Coverage of the laboratory component in each of the courses in the curriculum demonstrates the knowledge and need for sustainable development.', 'Strongly agree', 'Agree', 'Partially agree', 'Mutual', 'Disagree'),
(5, 'Electives offered helped us effectively specialize enough in the area of interest and provided optimum choice among the electives.', 'Strongly agree', 'Agree', 'Partially agree', 'Mutual', 'Disagree'),
(6, 'Curriculum encourages industry-institute interaction, Industry visits, Internship, expert lectures and projects.', 'Strongly agree', 'Agree', 'Partially agree', 'Mutual', 'Disagree'),
(7, 'Curriculum allows you to participate in extracurricular activities (Technical events, Seminars, conferences etc.,).', 'Strongly agree', 'Agree', 'Partially agree', 'Mutual', 'Disagree'),
(8, 'The knowledge acquired during the program is sufficient-enough to design, conduct experiments, analyze & interpret the results.', 'Strongly agree', 'Agree', 'Partially agree', 'Mutual', 'Disagree'),
(9, 'Program encourages committing to quality, timeliness and continuous improvement by creating, selecting, applying appropriate techniques, resources, modern engineering, IT tools including prediction and modelling to complex engineering activities within the framework.', 'Strongly agree', 'Agree', 'Partially agree', 'Mutual', 'Disagree'),
(10, 'Curriculum provides the adequate exposure to diversity, social, global issues and innovation to function effectively as an individual and as a member or leader in diverse teams.', 'Strongly agree', 'Agree', 'Partially agree', 'Mutual', 'Disagree'),
(11, 'The program provides knowledge and understanding of the engineering and management principles and apply these to one\'s own work, as a member and leader in a team, to manage projects.', 'Strongly agree', 'Agree', 'Partially agree', 'Mutual', 'Disagree'),
(12, 'Program has provided me enough confidence to take up professional challenges to Communicate effectively on complex engineering activities with the engineering community to be able to comprehend and write effective reports and design documentation, make effective presentations, and give and receive clear instructions.', 'Strongly agree', 'Agree', 'Partially agree', 'Mutual', 'Disagree');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `graduates`
--
ALTER TABLE `graduates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
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
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `graduates`
--
ALTER TABLE `graduates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
