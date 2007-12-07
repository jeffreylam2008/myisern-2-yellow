-- phpMyAdmin SQL Dump
-- version 2.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 07, 2007 at 01:33 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `myisern`
--

-- --------------------------------------------------------

--
-- Table structure for table `collaborations`
--

CREATE TABLE `collaborations` (
  `c_id` int(100) NOT NULL auto_increment,
  `c_name` varchar(20) collate latin1_general_ci NOT NULL,
  `c_organizations` varchar(100) collate latin1_general_ci default NULL,
  `c_types` varchar(100) collate latin1_general_ci default NULL,
  `c_years` varchar(100) collate latin1_general_ci NOT NULL,
  `c_outcome_types` varchar(100) collate latin1_general_ci default NULL,
  `c_description` varchar(200) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`c_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=44 ;

--
-- Dumping data for table `collaborations`
--

INSERT INTO `collaborations` (`c_id`, `c_name`, `c_organizations`, `c_types`, `c_years`, `c_outcome_types`, `c_description`) VALUES
(42, 'UMBC-NCS', 'University of Maryland Baltimore County,North Carolina State', 'Pair Programming', '2006', 'ICSE07 Paper', 'Study of pedagogical benefits of pair programming among millenial students.'),
(41, 'UMBC-USP', 'University of Maryland Baltimore County,University of Sao Paulo', 'Student Intern', '2007,2008', 'Paper,Dissertation Proposal', 'Student Viviane malheiros spends 1 year in UMBC to collaborate on several ongoing projects.'),
(40, 'BTH-UPV', 'Blekinge Institute of Technology,Universidad Politecnica de Valencia', 'Guest Lecture', '2007', 'Guest Lecture', 'Guest lecture.'),
(39, 'BTH-UO', 'Blekinge Institute of Technology,University of Oulu', 'Guest Lecture', '2008', 'Guest Lecture', 'Guest lecture.'),
(38, 'BTH-LU', 'Blekinge Institute of Technology,Lund University', 'Joint', '2000,2001,2002,2003,2004,2005,2006,2007', 'Joint Papers,Joint Research Application', 'Join papers and research application.'),
(37, 'BTH-UNSW', 'Blekinge Institute of Technology,University of New South Wales', 'Visiting Researcher', '2000,2001,2002,2003,2004,2005,2006,2007', 'Joint Paper,Jointly Edited Books', 'Join paper and edited books.'),
(36, 'BTH-UH', 'Blekinge Institute of Technology,University of Hawaii', 'Visiting Researcher', '2006', 'Joint Papers', 'Joint papers with visiting researcher.'),
(34, 'TUV-FIESE', 'Vienna University of Technology,Fraunhofer IESE', 'Data Analysis', '2000,2001', 'Paper', 'Data analysis of inspection experiments.'),
(35, 'TUV-TKK', 'Vienna University of Technology,Helsinki University of Technology', 'Tech Report', '2007,2008', 'Tech Report', 'Value-based software process improvement and workshops with industry partners.'),
(32, 'USG-VTT', 'University of Strathclyde,VTT Electronics', 'Data Collection', '2007', 'Data for Marc''s Tool Project', 'Experimental use of CRI tool in VTT''s Global Agile Software Development Laboratory.'),
(33, 'FIESE-TUV', 'Fraunhofer IESE,Vienna University of Technology', 'Tech Report', '2007,2008', 'Tech Report', 'Tech report on balancing QA techniques.'),
(31, 'UH-VTT', 'University of Hawaii,VTT Electronics', 'Fun', '2007', 'Publication,Explorative Empirical Data,Many Visits to Hawaii', 'Experimental use of Hackystat in VTT''s Global Agile Software Development Laboratory.'),
(29, 'UM-UH-HPCS', 'University of Hawaii,University of Maryland', 'Student Intern', '2006,2005', 'Technical Report', 'A graduate student at the University of Hawaii spent the summer working in the University of Maryland research group.'),
(30, 'JAMSS-UH-FIESE-SR-NI', 'Japan Manned Space Systems Corporation,University of Hawaii,Fraunhofer IESE,Simula Research,Nara Ins', 'Space Application', '2007', 'Space Application', 'Space Application');

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `o_id` int(100) NOT NULL auto_increment,
  `o_name` varchar(20) collate latin1_general_ci NOT NULL,
  `o_type` varchar(20) collate latin1_general_ci NOT NULL,
  `o_contact` varchar(20) collate latin1_general_ci NOT NULL,
  `o_aff_researchers` varchar(50) collate latin1_general_ci NOT NULL,
  `o_country` varchar(20) collate latin1_general_ci NOT NULL,
  `o_res_keywords` varchar(20) collate latin1_general_ci NOT NULL,
  `o_res_description` varchar(100) collate latin1_general_ci NOT NULL,
  `o_home_page` varchar(30) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`o_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`o_id`, `o_name`, `o_type`, `o_contact`, `o_aff_researchers`, `o_country`, `o_res_keywords`, `o_res_description`, `o_home_page`) VALUES
(14, 'COPPE', 'Technology', 'Guilherme Horta Trav', 'none', 'Brazil', 'Brazil,Engineering', 'A Computer Science Program in Brazil', 'http://www.cos.ufrj.br/'),
(12, 'Avaya Labs Research-', 'Research', 'Audris Mockus', '', 'USA', 'usa,avaya,research', 'Provides services like Product &amp; IP Support, System Integration', 'http://www.research.avayalabs.'),
(10, 'University of Hawaii', 'Academic', 'Philip Johnson', '', 'USA', 'Software Engineering', 'The Collaborative Software Development Laboratory does research on software measurement.', 'http://csdl.ics.hawaii.edu'),
(13, 'BTH', 'Technology', 'Claes Wohlin', 'none', 'Sweden', 'Institute,Technology', 'Institute of Technology', 'none'),
(11, 'University of Maryla', 'Academic', 'Victor Basili', 'Marvin Zelkowitz', 'USA', 'Software Engineering', 'The University of Maryland software engineering group does great stuff.', 'http://cs.umd.edu/');

-- --------------------------------------------------------

--
-- Table structure for table `researchers`
--

CREATE TABLE `researchers` (
  `r_id` int(100) NOT NULL auto_increment,
  `r_name` varchar(20) collate latin1_general_ci NOT NULL,
  `r_organization` varchar(50) collate latin1_general_ci default NULL,
  `r_email` varchar(50) collate latin1_general_ci default NULL,
  `r_pic` varchar(60) collate latin1_general_ci default NULL,
  `r_bio_statement` varchar(250) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`r_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `researchers`
--

INSERT INTO `researchers` (`r_id`, `r_name`, `r_organization`, `r_email`, `r_pic`, `r_bio_statement`) VALUES
(3, 'philip johnson', 'University of Hawaii', 'johnson@hawaii.edu', 'http://www.ics.hawaii.edu/images/Philip_Johnson.jpg', 'test'),
(6, 'Bernard Wong', 'University of Techno', 'bwong@uts.edu', 'http://www-staff.it.uts.edu.au/~bernard', ''),
(5, 'Marvin Zelkowitz', 'Fraunhofer Center Ma', 'mvz@cs.umd.edu', 'http://alarcos.inf-cr.uclm.es', ''),
(8, 'Marcela Genero Bocco', 'University of Castil', 'mgb@uclm.es', 'http://alarcos.inf-cr.uclm.es', ''),
(7, 'David Zubrow', 'Carnegie Mellon Univ', 'dz@sei.cmu.edu', 'http://www.sei.cmu.edu', ''),
(9, 'Oscar Pastor', 'OO-Method Research G', 'opastor@upv.es', 'http://www.dsic.upv.es/~opasto', ''),
(4, 'Victor Basili', 'University of Maryla', 'basili@cs.umd.edu', 'http://cs.umd.edu/~basili/basili.jpg', '');
