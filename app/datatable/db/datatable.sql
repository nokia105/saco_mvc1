-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2018 at 11:26 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datatable`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`id`, `name`) VALUES
(1, 'Printer'),
(2, 'Servers'),
(3, 'Desktop'),
(4, 'VMs'),
(5, 'Web-site'),
(6, 'Accounts');

-- --------------------------------------------------------

--
-- Table structure for table `audiobooks`
--

CREATE TABLE `audiobooks` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `author` varchar(250) NOT NULL,
  `duration` int(11) NOT NULL,
  `readingOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audiobooks`
--

INSERT INTO `audiobooks` (`id`, `title`, `author`, `duration`, `readingOrder`) VALUES
(1, 'The Final Empire: Mistborn', 'Brandon Sanderson', 1479, 1),
(2, 'The Name of the Wind', 'Patrick Rothfuss', 983, 2),
(3, 'The Blade Itself: The First Law', 'Joe Abercrombie', 1340, 3),
(4, 'The Heroes', 'Joe Abercrombie', 1390, 4),
(5, 'Assassin''s Apprentice: The Farseer Trilogy', 'Robin Hobb', 1043, 5),
(6, 'The Eye of the World: Wheel of Time', 'Robert Jordan', 1802, 6),
(7, 'The Wise Man''s Fear', 'Patrick Rothfuss', 1211, 7),
(8, 'The Way of Kings: The Stormlight Archive', 'Brandon Sanderson', 2734, 8),
(9, 'The Lean Startup', 'Eric Ries', 523, 9),
(10, 'House of Suns', 'Alastair Reynolds', 1096, 10),
(11, 'The Lies of Locke Lamora', 'Scott Lynch', 1323, 11),
(12, 'Best Served Cold', 'Joe Abercrombie', 1592, 12),
(13, 'Thinking, Fast and Slow', 'Daniel Kahneman', 1206, 13),
(14, 'The Dark Tower I: The Gunslinger', 'Stephen King', 439, 14),
(15, 'Theft of Swords: Riyria Revelations', 'Michael J. Sullivan', 1357, 15),
(16, 'The Emperor''s Blades: Chronicle of the Unhewn Throne', 'Brian Staveley', 1126, 16),
(17, 'The Magic of Recluce: Saga of Recluce', 'L. E. Modesitt Jr.', 1153, 17),
(18, 'Red Country', 'Joe Abercrombie', 1196, 18),
(19, 'Warbreaker', 'Brandon Sanderson', 1496, 19),
(20, 'Magician', 'Raymond E. Feist', 2173, 20),
(21, 'Blood Song', 'Anthony Ryan', 1385, 21),
(22, 'Half a King', 'Joe Abercrombie', 565, 22),
(23, 'Prince of Thorns: Broken Empire', 'Mark Lawrence', 537, 23),
(24, 'The Immortal Prince: Tide Lords', 'Jennifer Fallon', 1164, 24),
(25, 'Medalon: Demon Child', 'Jennifer Fallon', 1039, 25),
(26, 'The Black Company: Chronicles of The Black Company', 'Glen Cook', 654, 26);

-- --------------------------------------------------------

--
-- Table structure for table `datatables_demo`
--

CREATE TABLE `datatables_demo` (
  `id` int(10) NOT NULL,
  `first_name` varchar(250) NOT NULL DEFAULT '',
  `last_name` varchar(250) NOT NULL DEFAULT '',
  `position` varchar(250) NOT NULL DEFAULT '',
  `email` varchar(250) NOT NULL DEFAULT '',
  `office` varchar(250) NOT NULL DEFAULT '',
  `start_date` datetime DEFAULT NULL,
  `age` int(8) DEFAULT NULL,
  `salary` int(8) DEFAULT NULL,
  `seq` int(8) DEFAULT NULL,
  `extn` varchar(8) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `datatables_demo`
--

INSERT INTO `datatables_demo` (`id`, `first_name`, `last_name`, `position`, `email`, `office`, `start_date`, `age`, `salary`, `seq`, `extn`) VALUES
(1, 'Tigeryyy', 'Nixon', 'System Architect', 't.nixon@datatables.net', 'Edinburgh', '2011-04-25 00:00:00', 61, 320800, 2, '5421'),
(2, 'Garrett', 'Winters', 'Accountant', 'g.winters@datatables.net', 'Tokyo', '2011-07-25 00:00:00', 63, 170750, 22, '8422'),
(3, 'Ashton', 'Cox', 'Junior Technical Author', 'a.cox@datatables.net', 'San Francisco', '2009-01-12 00:00:00', 66, 86000, 6, '1562'),
(4, 'Cedric', 'Kelly', 'Senior Javascript Developer', 'c.kelly@datatables.net', 'Edinburgh', '2012-03-29 00:00:00', 22, 433060, 41, '6224'),
(5, 'Airi', 'Satou', 'Accountant', 'a.satou@datatables.net', 'Tokyo', '2008-11-28 00:00:00', 33, 162700, 55, '5407'),
(6, 'Brielle', 'Williamson', 'Integration Specialist', 'b.williamson@datatables.net', 'New York', '2012-12-02 00:00:00', 61, 9, 21, '4804'),
(7, 'Herrod', 'Chandler', 'Sales Assistant', 'h.chandler@datatables.net', 'San Francisco', '2012-08-06 00:00:00', 59, 137500, 46, '9608'),
(8, 'Rhona', 'Davidson', 'Integration Specialist', 'r.davidson@datatables.net', 'Tokyo', '2010-10-14 00:00:00', 55, 327900, 50, '6200'),
(9, 'Colleen', 'Hurst', 'Javascript Developer', 'c.hurst@datatables.net', 'San Francisco', '2009-09-15 00:00:00', 39, 205500, 26, '2360'),
(10, 'Sonya', 'Frost', 'Software Engineer', 's.frost@datatables.net', 'Edinburgh', '2008-12-13 00:00:00', 23, 103600, 18, '1667'),
(11, 'Jena', 'Gaines', 'Office Manager', 'j.gaines@datatables.net', 'London', '2008-12-19 00:00:00', 30, 90560, 13, '3814'),
(12, 'Quinn', 'Flynn', 'Support Lead', 'q.flynn@datatables.net', 'Edinburgh', '2013-03-03 00:00:00', 22, 342000, 23, '9497'),
(13, 'Charde', 'Marshall', 'Regional Director', 'c.marshall@datatables.net', 'San Francisco', '2008-10-16 00:00:00', 36, 470600, 14, '6741'),
(14, 'Haley', 'Kennedy', 'Senior Marketing Designer', 'h.kennedy@datatables.net', 'London', '2012-12-18 00:00:00', 43, 313500, 12, '3597'),
(15, 'Tatyana', 'Fitzpatrick', 'Regional Director', 't.fitzpatrick@datatables.net', 'London', '2010-03-17 00:00:00', 19, 385750, 54, '1965'),
(16, 'Michael', 'Silva', 'Marketing Designer', 'm.silva@datatables.net', 'London', '2012-11-27 00:00:00', 66, 198500, 37, '1581'),
(17, 'Paul', 'Byrd', 'Chief Financial Officer (CFO)', 'p.byrd@datatables.net', 'New York', '2010-06-09 00:00:00', 64, 725000, 32, '3059'),
(18, 'Gloria', 'Little', 'Systems Administrator', 'g.little@datatables.net', 'New York', '2009-04-10 00:00:00', 59, 237500, 35, '1721'),
(19, 'Bradley', 'Greer', 'Software Engineer', 'b.greer@datatables.net', 'London', '2012-10-13 00:00:00', 41, 132000, 48, '2558'),
(20, 'Dai', 'Rios', 'Personnel Lead', 'd.rios@datatables.net', 'Edinburgh', '2012-09-26 00:00:00', 35, 217500, 45, '2290'),
(21, 'Jenette', 'Caldwell', 'Development Lead', 'j.caldwell@datatables.net', 'New York', '2011-09-03 00:00:00', 30, 345000, 17, '1937'),
(22, 'Yuri', 'Berry', 'Chief Marketing Officer (CMO)', 'y.berry@datatables.net', 'New York', '2009-06-25 00:00:00', 40, 675000, 57, '6154'),
(23, 'Caesar', 'Vance', 'Pre-Sales Support', 'c.vance@datatables.net', 'New York', '2011-12-12 00:00:00', 21, 106450, 29, '8330'),
(24, 'Doris', 'Wilder', 'Sales Assistant', 'd.wilder@datatables.net', 'Sidney', '2010-09-20 00:00:00', 23, 85600, 56, '3023'),
(25, 'Angelica', 'Ramos', 'Chief Executive Officer (CEO)', 'a.ramos@datatables.net', 'Londo', '2009-10-09 00:00:00', 47, 1200000, 36, '200'),
(26, 'Gavin', 'Joyce', 'Developer', 'g.joyce@datatables.net', 'Edinburgh', '2010-12-22 00:00:00', 42, 92575, 5, '8822'),
(27, 'Jennifer', 'Chang', 'Regional Director', 'j.chang@datatables.net', 'Singapore', '2010-11-14 00:00:00', 28, 357650, 51, '9239'),
(28, 'Brenden', 'Wagner', 'Software Engineer', 'b.wagner@datatables.net', 'San Francisco', '2011-06-07 00:00:00', 28, 206850, 20, '1314'),
(29, 'Fiona', 'Green', 'Chief Operating Officer (COO)', 'f.green@datatables.net', 'San Francisco', '2010-03-11 00:00:00', 48, 850000, 7, '2947'),
(30, 'Shou', 'Itou', 'Regional Marketing', 's.itou@datatables.net', 'Tokyo', '2011-08-14 00:00:00', 20, 163000, 1, '8899'),
(31, 'Michelle', 'House', 'Integration Specialist', 'm.house@datatables.net', 'Sidney', '2011-06-02 00:00:00', 37, 95400, 39, '2769'),
(32, 'Suki', 'Burks', 'Developer', 's.burks@datatables.net', 'London', '2009-10-22 00:00:00', 53, 114500, 40, '6832'),
(33, 'Prescott', 'Bartlett', 'Technical Author', 'p.bartlett@datatables.net', 'London', '2011-05-07 00:00:00', 27, 145000, 47, '3606'),
(34, 'Gavin', 'Cortez', 'Team Leader', 'g.cortez@datatables.net', 'San Francisco', '2008-10-26 00:00:00', 22, 235500, 52, '2860'),
(35, 'Martena', 'Mccray', 'Post-Sales support', 'm.mccray@datatables.net', 'Edinburgh', '2011-03-09 00:00:00', 46, 324050, 8, '8240'),
(37, 'Howard', 'Hatfield', 'Office Manager', 'h.hatfield@datatables.net', 'San Francisco', '2008-12-16 00:00:00', 51, 164500, 38, '7031'),
(38, 'Hope', 'Fuentes', 'Secretary', 'h.fuentes@datatables.net', 'San Francisco', '2010-02-12 00:00:00', 41, 109850, 53, '6318'),
(39, 'Vivian', 'Harrell', 'Financial Controller', 'v.harrell@datatables.net', 'San Francisco', '2009-02-14 00:00:00', 62, 452500, 30, '9422'),
(40, 'Timothy', 'Mooney', 'Office Manager', 't.mooney@datatables.net', 'London', '2008-12-11 00:00:00', 37, 136200, 28, '7580'),
(41, 'Jackson', 'Bradshaw', 'Director', 'j.bradshaw@datatables.net', 'New York', '2008-09-26 00:00:00', 65, 645750, 34, '1042'),
(42, 'Olivia', 'Liang', 'Support Engineer', 'o.liang@datatables.net', 'Singapore', '2011-02-03 00:00:00', 64, 234500, 4, '2120'),
(43, 'Bruno', 'Nash', 'Software Engineer', 'b.nash@datatables.net', 'London', '2011-05-03 00:00:00', 38, 163500, 3, '6222'),
(44, 'Sakura', 'Yamamoto', 'Support Engineer', 's.yamamoto@datatables.net', 'Tokyo', '2009-08-19 00:00:00', 37, 139575, 31, '9383'),
(45, 'Thor', 'Walton', 'Developer', 't.walton@datatables.net', 'New York', '2013-08-11 00:00:00', 61, 98, 11, '8327'),
(46, 'Finn', 'Camacho', 'Support Engineer', 'f.camacho@datatables.net', 'San Francisco', '2009-07-07 00:00:00', 47, 87500, 10, '2927'),
(47, 'Serge', 'Baldwin', 'Data Coordinator', 's.baldwin@datatables.net', 'Singapore', '2012-04-09 00:00:00', 64, 138575, 44, '8352'),
(48, 'Zenaida', 'Frank', 'Software Engineer', 'z.frank@datatables.net', 'New York', '2010-01-04 00:00:00', 63, 125250, 42, '7439'),
(49, 'Zorita', 'Serrano', 'Software Engineer', 'z.serrano@datatables.net', 'San Francisco', '2012-06-01 00:00:00', 56, 115000, 27, '4389'),
(50, 'Jennifer', 'Acosta', 'Junior Javascript Developer', 'j.acosta@datatables.net', 'Edinburgh', '2013-02-01 00:00:00', 43, 75650, 49, '3431'),
(51, 'Cara', 'Stevens', 'Sales Assistant', 'c.stevens@datatables.net', 'New York', '2011-12-06 00:00:00', 46, 145600, 15, '3990'),
(52, 'Hermione', 'Butler', 'Regional Director', 'h.butler@datatables.net', 'London', '2011-03-21 00:00:00', 47, 356250, 9, '1016'),
(53, 'Lael', 'Greer', 'Systems Administrator', 'l.greer@datatables.net', 'London', '2009-02-27 00:00:00', 21, 103500, 25, '6733'),
(54, 'Jonas', 'Alexander', 'Developer', 'j.alexander@datatables.net', 'San Francisco', '2010-07-14 00:00:00', 30, 86500, 33, '8196'),
(55, 'Shad', 'Decker', 'Regional Director', 's.decker@datatables.net', 'Edinburgh', '2008-11-13 00:00:00', 51, 183000, 43, '6373'),
(56, 'Michael', 'Bruce', 'Javascript Developer', 'm.bruce@datatables.net', 'Singapore', '2011-06-27 00:00:00', 29, 183000, 16, '5384'),
(57, 'Donna', 'Snider', 'Customer Support', 'd.snider@datatables.net', 'New York', '2011-01-25 00:00:00', 27, 112000, 19, '4226');

-- --------------------------------------------------------

--
-- Table structure for table `datatable_demo`
--

CREATE TABLE `datatable_demo` (
  `ID` int(20) NOT NULL,
  `First_Name` varchar(20) DEFAULT NULL,
  `Last_Name` varchar(20) DEFAULT NULL,
  `Age` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `datatable_demo`
--

INSERT INTO `datatable_demo` (`ID`, `First_Name`, `Last_Name`, `Age`) VALUES
(1, 'well', 'nomber12', NULL),
(2, 'tza', 'bongo', 43);

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

CREATE TABLE `dept` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dept`
--

INSERT INTO `dept` (`id`, `name`) VALUES
(1, 'IT'),
(2, 'Sales'),
(3, 'Pre-Sales'),
(4, 'Marketing'),
(5, 'Senior Management'),
(6, 'Accounts'),
(7, 'Support');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `filename` varchar(250) NOT NULL,
  `filesize` int(11) NOT NULL,
  `web_path` varchar(250) NOT NULL,
  `system_path` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `name`) VALUES
(1, 'Edinburgh'),
(2, 'London'),
(3, 'Paris'),
(4, 'New York'),
(5, 'Singapore'),
(6, 'Los Angeles');

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

CREATE TABLE `todo` (
  `id` int(10) NOT NULL,
  `item` varchar(255) NOT NULL DEFAULT '',
  `done` tinyint(1) NOT NULL DEFAULT '0',
  `priority` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`id`, `item`, `done`, `priority`) VALUES
(1, 'Send business plan to clients', 1, 1),
(2, 'Web-site copy revisions', 0, 2),
(3, 'Review client tracking', 0, 2),
(4, 'E-mail catchup', 0, 3),
(5, 'Complete worksheet', 0, 4),
(6, 'Prep sales presentation', 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `registered_date` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `manager` int(11) DEFAULT NULL,
  `site` int(11) DEFAULT NULL,
  `image` int(11) DEFAULT NULL,
  `shift_start` time DEFAULT NULL,
  `shift_end` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `title`, `first_name`, `last_name`, `phone`, `city`, `zip`, `updated_date`, `registered_date`, `active`, `manager`, `site`, `image`, `shift_start`, `shift_end`) VALUES
(1, 'Miss', 'Quynn', 'Contreras', '1-971-977-4681', 'Slidell', '81080', '2018-02-15 12:23:33', '2012-04-06 18:53:00', 0, 1, 1, NULL, '08:00:00', '16:00:00'),
(2, 'Mr', 'Kaitlin', 'Smith', '1-436-523-6103', 'Orlando', 'U5G 7J3', '2018-02-15 12:23:33', '2012-11-20 05:58:25', 1, 1, 2, NULL, '09:00:00', '17:00:00'),
(3, 'Mrs', 'Cruz', 'Reynolds', '1-776-102-6352', 'Lynn', 'EJ89 9DQ', '2018-02-15 12:23:33', '2011-12-31 23:34:03', 0, 2, 3, NULL, '09:00:00', '17:00:00'),
(4, 'Dr', 'Sophia', 'Morris', '1-463-224-1405', 'Belleville', 'T1F 2X1', '2018-02-15 12:23:33', '2012-08-04 02:55:53', 0, 3, 4, NULL, '08:00:00', '15:30:00'),
(5, 'Miss', 'Kamal', 'Roberson', '1-134-408-5227', 'Rehoboth Beach', 'V7I 6T5', '2018-02-15 12:23:33', '2012-12-23 00:17:03', 1, 1, 5, NULL, '09:00:00', '17:00:00'),
(6, 'Dr', 'Dustin', 'Rosa', '1-875-919-3188', 'Jersey City', 'E4 8ZE', '2018-02-15 12:23:33', '2012-10-05 22:18:59', 0, 1, 6, NULL, '09:00:00', '17:00:00'),
(7, 'Dr', 'Xantha', 'George', '1-106-884-4754', 'Billings', 'Y2I 6J7', '2018-02-15 12:23:33', '2012-11-25 12:50:16', 0, 6, 1, NULL, '07:00:00', '15:00:00'),
(8, 'Mrs', 'Bryar', 'Long', '1-918-114-8083', 'San Bernardino', '82983', '2018-02-15 12:23:33', '2012-05-14 23:32:25', 0, 1, 2, NULL, '09:00:00', '17:00:00'),
(9, 'Mrs', 'Kuame', 'Wynn', '1-101-692-4039', 'Truth or Consequences', '21290', '2018-02-15 12:23:33', '2011-06-21 16:27:07', 1, 2, 3, NULL, '06:00:00', '14:00:00'),
(10, 'Ms', 'Indigo', 'Brennan', '1-756-756-8161', 'Moline', 'NO8 3UY', '2018-02-15 12:23:33', '2011-02-19 12:51:08', 1, 5, 4, NULL, '12:00:00', '00:00:00'),
(11, 'Mrs', 'Avram', 'Allison', '1-751-507-2640', 'Rancho Palos Verdes', 'I7Q 8H4', '2018-02-15 12:23:33', '2012-12-30 17:02:10', 0, 1, 5, NULL, '09:00:00', '17:00:00'),
(12, 'Mr', 'Martha', 'Burgess', '1-971-722-1203', 'Toledo', 'Q5R 9HI', '2018-02-15 12:23:33', '2011-02-04 17:25:55', 1, 1, 6, NULL, '12:00:00', '00:00:00'),
(13, 'Miss', 'Lael', 'Kim', '1-626-697-2194', 'Lake Charles', '34209', '2018-02-15 12:23:33', '2012-07-24 06:44:22', 1, 7, 1, NULL, '09:00:00', '17:00:00'),
(14, 'Dr', 'Lyle', 'Lewis', '1-231-793-3520', 'Simi Valley', 'H9B 2H4', '2018-02-15 12:23:33', '2012-08-30 03:28:54', 0, 1, 2, NULL, '00:00:00', '12:00:00'),
(15, 'Miss', 'Veronica', 'Marks', '1-750-981-6759', 'Glens Falls', 'E3C 5D1', '2018-02-15 12:23:33', '2012-08-14 12:09:24', 1, 2, 3, NULL, '09:00:00', '17:00:00'),
(16, 'Mrs', 'Wynne', 'Ruiz', '1-983-744-5362', 'Branson', 'L9E 6E2', '2018-02-15 12:23:33', '2012-11-06 01:04:07', 0, 1, 4, NULL, '12:00:00', '00:00:00'),
(17, 'Ms', 'Jessica', 'Bryan', '1-949-932-6772', 'Boulder City', 'F5P 6NU', '2018-02-15 12:23:33', '2013-02-01 20:22:33', 0, 5, 5, NULL, '09:00:00', '17:00:00'),
(18, 'Ms', 'Quinlan', 'Hyde', '1-625-664-6072', 'Sheridan', 'Y8A 1LQ', '2018-02-15 12:23:33', '2011-10-25 16:53:45', 1, 1, 6, NULL, '08:00:00', '15:00:00'),
(19, 'Miss', 'Mona', 'Terry', '1-443-179-7343', 'Juneau', 'G62 1OF', '2018-02-15 12:23:33', '2012-01-15 09:26:59', 0, 1, 1, NULL, '08:30:00', '16:30:00'),
(20, 'Mrs', 'Medge', 'Patterson', '1-636-979-0497', 'Texarkana', 'I5U 6E0', '2018-02-15 12:23:33', '2012-10-20 16:26:18', 1, 1, 2, NULL, '09:00:00', '17:00:00'),
(21, 'Mrs', 'Perry', 'Gamble', '1-440-976-9560', 'Arcadia', '98923', '2018-02-15 12:23:33', '2012-06-06 02:03:49', 1, 2, 3, NULL, '00:00:00', '12:00:00'),
(22, 'Mrs', 'Pandora', 'Armstrong', '1-197-431-4390', 'Glendora', '34124', '2018-02-15 12:23:33', '2011-08-29 01:45:06', 0, 7, 4, NULL, '21:00:00', '03:00:00'),
(23, 'Mr', 'Pandora', 'Briggs', '1-278-288-9221', 'Oneida', 'T9M 4H9', '2018-02-15 12:23:33', '2012-07-16 08:44:41', 1, 4, 5, NULL, '09:00:00', '17:00:00'),
(24, 'Mrs', 'Maris', 'Leblanc', '1-936-114-2921', 'Cohoes', 'V1H 6Z7', '2018-02-15 12:23:33', '2011-05-04 13:07:04', 1, 1, 6, NULL, '00:00:00', '12:00:00'),
(25, 'Mrs', 'Ishmael', 'Crosby', '1-307-243-2684', 'Midwest City', 'T6 8PS', '2018-02-15 12:23:33', '2011-07-02 23:11:11', 0, 3, 1, NULL, '09:00:00', '17:00:00'),
(26, 'Miss', 'Quintessa', 'Pickett', '1-801-122-7471', 'North Tonawanda', '09166', '2018-02-15 12:23:33', '2013-02-05 10:33:22', 1, 1, 2, NULL, '12:00:00', '00:00:00'),
(27, 'Miss', 'Ifeoma', 'Mays', '1-103-883-0962', 'Parkersburg', '87377', '2018-02-15 12:23:33', '2011-08-22 12:19:09', 0, 1, 3, NULL, '09:00:00', '17:00:00'),
(28, 'Mrs', 'Basia', 'Harrell', '1-528-238-4178', 'Cody', 'LJ54 1IU', '2018-02-15 12:23:33', '2012-05-07 14:42:55', 1, 1, 4, NULL, '09:00:00', '17:00:00'),
(29, 'Mrs', 'Hamilton', 'Blackburn', '1-676-857-1423', 'Delta Junction', 'X5 9HE', '2018-02-15 12:23:33', '2011-05-19 07:39:48', 0, 6, 5, NULL, '10:00:00', '18:00:00'),
(30, 'Ms', 'Dexter', 'Burton', '1-275-332-8186', 'Gainesville', '65914', '2018-02-15 12:23:33', '2013-02-01 16:21:20', 1, 5, 6, NULL, '21:00:00', '03:00:00'),
(31, 'Mrs', 'Quinn', 'Mccall', '1-808-916-4497', 'Fallon', 'X4 8UB', '2018-02-15 12:23:33', '2012-03-24 19:31:51', 0, 1, 1, NULL, '09:00:00', '17:00:00'),
(32, 'Mr', 'Alexa', 'Wilder', '1-727-307-1997', 'Johnson City', '16765', '2018-02-15 12:23:33', '2011-10-14 08:21:14', 0, 3, 2, NULL, '09:00:00', '17:00:00'),
(33, 'Ms', 'Rhonda', 'Harrell', '1-934-906-6474', 'Minnetonka', 'I2R 1H2', '2018-02-15 12:23:33', '2011-11-15 00:08:02', 1, 1, 3, NULL, '12:00:00', '00:00:00'),
(34, 'Mrs', 'Jocelyn', 'England', '1-826-860-7773', 'Chico', '71102', '2018-02-15 12:23:33', '2012-05-31 18:01:43', 1, 1, 4, NULL, '09:00:00', '17:00:00'),
(35, 'Dr', 'Vincent', 'Banks', '1-225-418-0941', 'Palo Alto', '03281', '2018-02-15 12:23:33', '2011-08-07 07:22:43', 0, 1, 5, NULL, '18:00:00', '02:00:00'),
(36, 'Mrs', 'Stewart', 'Chan', '1-781-793-2340', 'Grand Forks', 'L1U 3ED', '2018-02-15 12:23:33', '2012-11-01 23:14:44', 1, 6, 6, NULL, '08:00:00', '16:00:00');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `users_insert` BEFORE INSERT ON `users` FOR EACH ROW SET NEW.updated_date = IFNULL(NEW.updated_date, NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `users_update` BEFORE UPDATE ON `users` FOR EACH ROW SET NEW.updated_date = IFNULL(NEW.updated_date, NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users_files`
--

CREATE TABLE `users_files` (
  `user_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_access`
--

CREATE TABLE `user_access` (
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `access_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access`
--

INSERT INTO `user_access` (`user_id`, `access_id`) VALUES
(1, 1),
(1, 3),
(1, 4),
(2, 1),
(2, 4),
(4, 3),
(4, 4),
(4, 5),
(4, 6),
(5, 2),
(6, 6),
(7, 2),
(8, 1),
(9, 2),
(10, 1),
(10, 2),
(10, 3),
(11, 4),
(11, 6),
(12, 1),
(12, 2),
(12, 5),
(13, 1),
(13, 2),
(13, 3),
(13, 6),
(18, 1),
(18, 2),
(18, 3),
(20, 1),
(20, 2),
(20, 3),
(21, 2),
(21, 4),
(22, 2),
(22, 3),
(22, 6),
(30, 1),
(30, 3),
(30, 5),
(31, 3),
(32, 4),
(33, 6),
(34, 1),
(34, 2),
(34, 3),
(35, 2),
(36, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_dept`
--

CREATE TABLE `user_dept` (
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `dept_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_dept`
--

INSERT INTO `user_dept` (`user_id`, `dept_id`) VALUES
(1, 1),
(2, 4),
(3, 7),
(4, 3),
(5, 2),
(6, 6),
(7, 2),
(8, 1),
(9, 2),
(10, 3),
(11, 4),
(12, 5),
(13, 6),
(14, 4),
(15, 3),
(16, 6),
(17, 3),
(18, 7),
(19, 7),
(20, 1),
(21, 2),
(22, 6),
(23, 3),
(24, 4),
(25, 5),
(26, 6),
(27, 7),
(28, 2),
(29, 3),
(30, 1),
(31, 3),
(32, 4),
(33, 6),
(34, 7),
(35, 2),
(36, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audiobooks`
--
ALTER TABLE `audiobooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `datatables_demo`
--
ALTER TABLE `datatables_demo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seq` (`seq`);

--
-- Indexes for table `datatable_demo`
--
ALTER TABLE `datatable_demo`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `dept`
--
ALTER TABLE `dept`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`user_id`,`access_id`),
  ADD KEY `access_id` (`access_id`);

--
-- Indexes for table `user_dept`
--
ALTER TABLE `user_dept`
  ADD PRIMARY KEY (`user_id`,`dept_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access`
--
ALTER TABLE `access`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `audiobooks`
--
ALTER TABLE `audiobooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `datatables_demo`
--
ALTER TABLE `datatables_demo`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `datatable_demo`
--
ALTER TABLE `datatable_demo`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `dept`
--
ALTER TABLE `dept`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `todo`
--
ALTER TABLE `todo`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_access`
--
ALTER TABLE `user_access`
  ADD CONSTRAINT `user_access_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_access_ibfk_2` FOREIGN KEY (`access_id`) REFERENCES `access` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_dept`
--
ALTER TABLE `user_dept`
  ADD CONSTRAINT `user_dept_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_dept_ibfk_2` FOREIGN KEY (`dept_id`) REFERENCES `dept` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
