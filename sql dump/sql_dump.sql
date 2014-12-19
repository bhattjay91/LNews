-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Host: db557259234.db.1and1.com
-- Generation Time: Dec 18, 2014 at 08:53 PM
-- Server version: 5.1.73-log
-- PHP Version: 5.4.35-0+deb7u2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db557259234`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'Breaking News'),
(2, 'Technology'),
(3, 'Sports'),
(4, 'Health'),
(5, 'Entertainment'),
(6, 'Travel');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `fullname` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `description` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `image_path` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `datetime` datetime NOT NULL,
  `action_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=33 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `subject`, `fullname`, `description`, `image_path`, `datetime`, `action_id`, `category_id`) VALUES
(12, 'Goodbye, Stephen Colbert', 'John Smith', 'Goodbye, Stephen Colbert. We hardly knew you.', '../uploads/cat_JohnSmith.jpeg', '2014-12-18 21:00:59', 1, 1),
(13, 'Ellen surprises Conan audience', 'Anne Heli', 'Conan usually does not give free gifts to his audience, but Ellen DeGeneres changes that.', '../uploads/msnbc-logo_AnneHeli.jpg', '2014-12-18 21:01:43', 1, 5),
(14, 'Conviction tossed for executed boy', 'Joe Reese', 'A judge has vacated the conviction of a 14-year-old boy who was executed for allegedly killing two girls some 70 years ago in South Carolina', '../uploads/cnn_JoeReese.jpg', '2014-12-18 21:02:31', 1, 1),
(15, 'Car rams crowd, killing 3', 'Marry Hynes', 'One person died and up to a dozen others were injured after a car plowed into a crowd of people in Southern California.', '../uploads/msnbc-logo_MarryHynes.jpg', '2014-12-18 21:03:27', 1, 1),
(16, 'Army blimps to help protect D.C.', 'Rita Sanik', 'The U.S. Army plans to launch two stationary "blimps" at 10,000-feet in the air next week to better protect the Washington D.C. ', '../uploads/msnbc-logo_RitaSanik.jpg', '2014-12-18 21:04:24', 1, 1),
(17, '15-foot python found at restaurant', 'Veennesa Allena', 'A 15-foot python was found outside a restaurant in Florida.', '../uploads/dog_VeennesaAllena.jpg', '2014-12-18 21:05:17', 1, 6),
(18, 'Remains found in ''house of horrors''', 'John Smith', 'A woman has been indicted on two murder charges after the skeletal remains of three babies were found in her home.', '../uploads/msnbc-logo_JohnSmith.jpg', '2014-12-18 21:05:53', 1, 1),
(19, 'This city was rebuilt 40 times', 'Veennesa Allena', 'In the heart of Belgrade, the vibrant and resilient capital of Serbia, a slow and colorful transformation is taking place.', '../uploads/health_VeennesaAllena.jpeg', '2014-12-18 21:07:57', 1, 1),
(20, '5 ways to fat-proof your home', 'Anne Dannie', 'Here simple ways to keep your home food-temptation free. This works for even the most weak-willed among us.', '../uploads/health_AnneDannie.jpeg', '2014-12-18 21:08:30', 1, 4),
(21, 'How he became an Ironman', 'Harey Berry', 'Joe Van Veldhuizen was 19 miles into his first Ironman. With two hours left to complete the race and only three miles to go in the 26.2 mile', '../uploads/cnn_HareyBerry.jpg', '2014-12-18 21:09:44', 1, 4),
(22, 'Music helps your brain', 'Kelly Reaso', 'Dr. Sanjay Gupta tells us why music therapy is good for the brain and how it can help us live to 100.', '../uploads/health_KellyReaso.jpeg', '2014-12-18 21:11:20', 1, 4),
(23, 'Visit to Sanjay Gupta''s past', 'Peter Ally', 'Dr. Sanjay Gupta traveled from Pakistan to Michigan to discover his family''s roots. Here''s what he learned along the way.', '../uploads/fox_PeterAlly.jpg', '2014-12-18 21:12:25', 1, 4),
(24, 'The best way to brush', 'Jasmine Waston', 'CNN''s Martha Shade reports on what''s the best way to brush your teeth.', '../uploads/cnn_JasmineWaston.jpg', '2014-12-18 21:13:09', 1, 4),
(25, '3D printed plastic dress flows like fabric', 'Jasmine Waston', 'Combining origami techniques with novel approaches to 3-D printing, a design has created a process that allows a 3D-printed dress.', '../uploads/tech_JasmineWaston.jpg', '2014-12-18 21:13:58', 1, 2),
(26, 'What you really Googled in 2014', 'Rita Sanik', 'In 2013, people just wanted to know how to twerk. It was a more innocent time. This year, people wanted to know if they had Ebola.', '../uploads/tech_RitaSanik.jpg', '2014-12-18 21:14:37', 1, 2),
(27, 'The next wave of tech cities...in the desert', 'Veennesa Allena', 'The number of "Smart cities" is to quadruple over the next decade, and reach surprising places.', '../uploads/dog_VeennesaAllena.jpg', '2014-12-18 21:15:26', 1, 2),
(28, 'Stars criticize Sony''s decision', 'Veennesa Allena', 'Celebrities expressed their outrage at Sony Picture''s decision to cancel plans to release "The Interview" on Christmas Day on Twitter.', '../uploads/cat_VeennesaAllena.jpeg', '2014-12-18 21:16:32', 1, 5),
(29, '''Clifford'' creator dies at 86', 'Dannie Gary', 'Norman Bridwell, the creator of "Clifford the Big Red Dog," has died, according to his publisher, Scholastic.', '../uploads/cnn_DannieGary.jpg', '2014-12-18 21:17:21', 1, 5),
(30, 'Historic thaw in U.S., Cuba standoff', 'Kelly Reaso', 'Secret talks and freed American pave way for historic announcement from Obama, Castro', '../uploads/usa_KellyReaso.png', '2014-12-18 21:17:59', 1, 1),
(31, 'The future of Bitcoin: live Twitter chat today', 'Anne Heli', 'Today, Thursday December 18, we''ll be hosting a Twitter live chat @CNNTech debating the future of Bitcoin with a panel of experts.', '../uploads/microsoft_AnneHeli.jpg', '2014-12-18 21:19:30', 1, 2),
(32, 'They tried to break the internet in 2014', 'Anne Dannie', 'No one thing actually "broke" the Internet in 2014, but here are 10 of the memes and hashtags that tried.', '../uploads/apple_AnneDannie.png', '2014-12-18 21:19:58', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE IF NOT EXISTS `vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NOT NULL,
  `up` int(11) NOT NULL,
  `down` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`id`, `news_id`, `up`, `down`) VALUES
(1, 9, 54, 44),
(2, 8, 19, 16),
(3, 7, 8, 4),
(4, 5, 2, 2),
(5, 4, 2, 6),
(6, 6, 1, 0),
(7, 3, 2, 1),
(8, 10, 12, 10),
(9, 30, 5, 0),
(10, 29, 3, 0),
(11, 28, 0, 4),
(12, 26, 0, 5),
(13, 25, 4, 0),
(14, 22, 5, 0),
(15, 17, 10, 0),
(16, 13, 0, 2),
(17, 32, 19, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
