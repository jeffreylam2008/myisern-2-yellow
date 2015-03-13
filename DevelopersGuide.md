[Setup XAMPP & Symfony](http://code.google.com/p/myisern-2-yellow/wiki/InstallationGuide)


## Create Database ##
**Generate three tables**

Create three tables called collaborations, organizations, researchers.
```
CREATE TABLE `collaborations` (
  `c_id` int(100) NOT NULL auto_increment,
  `c_name` varchar(20) collate latin1_general_ci NOT NULL,
  `c_organizations` varchar(100) collate latin1_general_ci default NULL,
  `c_types` varchar(100) collate latin1_general_ci default NULL,
  `c_years` varchar(100) collate latin1_general_ci NOT NULL,
  `c_outcome_types` varchar(100) collate latin1_general_ci default NULL,
  `c_description` varchar(200) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`c_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=45 ;
```
```
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
```
```
CREATE TABLE `researchers` (
  `r_id` int(100) NOT NULL auto_increment,
  `r_name` varchar(20) collate latin1_general_ci NOT NULL,
  `r_organization` varchar(50) collate latin1_general_ci default NULL,
  `r_email` varchar(50) collate latin1_general_ci default NULL,
  `r_pic` varchar(60) collate latin1_general_ci default NULL,
  `r_bio_statement` varchar(250) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`r_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;
```

## Javascript ##

  * We add some javascript for "Select All" and create a new window for edit page.

## SQL statement ##

  * we use SQL statement to populate data for each type. Also use SQL statement for add, edit, and delete.

## process.php page ##

  * This page carry each single action from add, edit and delete page.

## db\_conn.php page ##

```
$DB_HOST	= "localhost";
$DB_LOGIN	= "username";  // type in MySQL username
$DB_PASSWORD	= "password";  // type in MySQL password
$DB_NAME	= "myisern";   // type in Database name here
	
$conn = mysql_connect($DB_HOST, $DB_LOGIN, $DB_PASSWORD);
mysql_select_db($DB_NAME);
```

  * The developer can configure this page for connection between MySQL database to Myisern system.