-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Nov 27, 2007 at 08:39 PM
-- Server version: 5.0.41
-- PHP Version: 5.2.2

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
  `c_organizations` int(100) default NULL,
  `c_types` int(100) default NULL,
  `c_years` int(100) NOT NULL,
  `c_outcome_types` int(100) default NULL,
  `c_description` varchar(200) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`c_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `collaborations`
-- 

INSERT INTO `collaborations` VALUES (1, '', 0, 0, 132, 0, '');

-- --------------------------------------------------------

-- 
-- Table structure for table `collaboration_organizations`
-- 

CREATE TABLE `collaboration_organizations` (
  `c_organizations` int(100) NOT NULL auto_increment,
  `organization` varchar(20) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`c_organizations`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `collaboration_organizations`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `collaboration_outcome_types`
-- 

CREATE TABLE `collaboration_outcome_types` (
  `c_outcome_types` int(100) NOT NULL auto_increment,
  `outcome_type` varchar(20) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`c_outcome_types`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `collaboration_outcome_types`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `collaboration_types`
-- 

CREATE TABLE `collaboration_types` (
  `c_types` int(100) NOT NULL auto_increment,
  `type` varchar(20) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`c_types`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `collaboration_types`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `collaboration_years`
-- 

CREATE TABLE `collaboration_years` (
  `c_years` int(100) NOT NULL,
  `year` year(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `collaboration_years`
-- 

INSERT INTO `collaboration_years` VALUES (132, 1990);
INSERT INTO `collaboration_years` VALUES (132, 2001);
INSERT INTO `collaboration_years` VALUES (132, 2003);

-- --------------------------------------------------------

-- 
-- Table structure for table `organizations`
-- 

CREATE TABLE `organizations` (
  `o_id` int(100) NOT NULL,
  `o_name` varchar(20) collate latin1_general_ci NOT NULL,
  `o_type` varchar(20) collate latin1_general_ci NOT NULL,
  `o_contact` varchar(20) collate latin1_general_ci NOT NULL,
  `o_aff_researchers` varchar(20) collate latin1_general_ci NOT NULL,
  `o_country` varchar(20) collate latin1_general_ci NOT NULL,
  `o_res_keywords` varchar(20) collate latin1_general_ci NOT NULL,
  `o_res_description` varchar(200) collate latin1_general_ci NOT NULL,
  `o_home_page` varchar(20) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`o_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `organizations`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `researchers`
-- 

CREATE TABLE `researchers` (
  `r_id` int(100) NOT NULL,
  `r_name` varchar(20) collate latin1_general_ci NOT NULL,
  `r_organization` varchar(20) collate latin1_general_ci default NULL,
  `r_email` varchar(30) collate latin1_general_ci default NULL,
  `r_pic` varchar(30) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`r_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `researchers`
-- 

