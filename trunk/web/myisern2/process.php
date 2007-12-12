<?
/**
 * Sample File 2, phpDocumentor Quickstart
 * 
 * This file demonstrates the rich information that can be included in
 * in-code documentation through DocBlocks and tags.
 * @author Jeffrey lam
 * @version 1.0
 * @package sample
 */

// Start Session
session_start();
// Connects to your Database
include("db_conn.php");

//checks cookies to make sure they are logged in
if(isset($_COOKIE['ID_my_site']))
{
	$username = $_COOKIE['ID_my_site'];
	$pass = $_COOKIE['Key_my_site'];
	//if the cookie has the wrong password, they are taken to the login page
	if ($username != "demo" && $pass != "demo")
	{ 
		echo"Wrong Login Name or Password!";
	}
	//otherwise they are shown the admin area
	else if(!isset($_SESSION['username']))
	{
		echo"Session Login expired!";
	}
	else
	{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Process</title>
</head>
<body>

<form action="process.php" enctype="multipart/form-data" method="post">
<table width="250" border="1" cellpadding="0" cellspacing="0" align="center" bordercolor="#0000FF">
	<tr>
		<td bgcolor="#99CCFF"><center><h4><font color="#0000FF">Result</font></h4></center></td>
	</tr>
	
<?
$getAllCollSQLStr = "SELECT * FROM collaborations";
$getAllOrgSQLStr = "SELECT * FROM organizations";
$getAllResSQLStr = "SELECT * FROM researchers";

$checkCollSQLStr = "SELECT coll.* FROM collaborations AS coll WHERE c_name='".$_POST['coll_name']."' OR c_id='".$_POST['coll_id']."';";
$checkOrgSQLStr = "SELECT org.* FROM organizations AS org WHERE o_name='".$_POST['org_name']."' OR o_id='".$_POST['org_id']."';";
$checkResSQLStr = "SELECT res.* FROM researchers AS res WHERE r_name='".$_POST['res_name']."' OR r_id='".$_POST['res_id']."';";

$addCollSQLStr = "INSERT INTO collaborations (c_id,c_name,c_organizations,c_types,c_years,c_outcome_types,c_description)";
$addCollSQLStr .= " VALUES('','".$_POST['coll_name']."','".$_POST['coll_organizations']."','".$_POST['coll_types']."','".$_POST['coll_years']."','".$_POST['coll_outcome_types']."','".$_POST['coll_description']."');";
$addOrgSQLStr = "INSERT INTO organizations (o_id,o_name,o_type,o_contact,o_aff_researchers,o_country,o_res_keywords,o_res_description,o_home_page)";
$addOrgSQLStr .= " VALUES('','".$_POST['org_name']."','".$_POST['org_type']."','".$_POST['org_contact']."','".$_POST['org_aff_researchers']."','".$_POST['org_country']."','".$_POST['org_res_keywords']."','".$_POST['org_res_description']."','".$_POST['org_home_page']."');";
$addResSQLStr = "INSERT INTO researchers (r_id,r_name,r_organization,r_email,r_pic,r_bio_statement)";
$addResSQLStr .= " VALUES('','".$_POST['res_name']."','".$_POST['res_organization']."','".$_POST['res_email']."','".$_POST['res_pic']."','".$_POST['res_bio_statement']."');";

$editCollSQLStr = "UPDATE collaborations SET c_organizations='".$_POST['coll_organizations']."',c_types='".$_POST['coll_types']."',";
$editCollSQLStr .= "c_years='".$_POST['coll_years']."',c_outcome_types='".$_POST['coll_outcome_types']."',c_description='".$_POST['coll_description']."' WHERE c_id='".$_POST['coll_id']."';";
$editOrgSQLStr = "UPDATE organizations SET o_type='".$_POST['org_type']."',o_contact='".$_POST['org_contact']."',o_aff_researchers='".$_POST['org_aff_researchers']."',o_country='".$_POST['org_country']."',";
$editOrgSQLStr .= "o_res_keywords='".$_POST['org_res_keywords']."',o_res_description='".$_POST['org_res_description']."',o_home_page='".$_POST['org_home_page']."' WHERE o_id='".$_POST['org_id']."';";
$editResSQLStr = "UPDATE researchers SET r_organization='".$_POST['res_organization']."',r_email='".$_POST['res_email']."',r_pic='".$_POST['res_pic']."',r_bio_statement='".$_POST['res_bio_statement']."' WHERE r_id='".$_POST['res_id']."';";

//print($addResSQLStr);
if(isset($_POST['add_res']))
{
	if($_POST['res_name'] == "")
	{
		$message = "<tr><td bordercolor='#000099' bgcolor='#FF0000' align='center'><h4><font color='#FFFFFF'>No Researcher Added!</font></h4><br>";
		$message .= "<a href=\"view_researcher.php\">BACK</a></td></tr>";
	}
	else
	{
		$res = mysql_query($checkResSQLStr);
		if(mysql_num_rows($res)>0)
		{
			$message = "<tr><td bordercolor='#000099' bgcolor='#FF0000' align='center'><h4><font color='#FFFFFF'>Researcher Name Existed!</font></h4><br>";
			$message .= "<a href=\"view_researcher.php\">BACK</a></td></tr>";
		}
		else
		{
			mysql_query($addResSQLStr);
			$message = "<tr><td bordercolor='#000099' bgcolor='#0066FF' align='center'><h4><font color='#FFFFFF'>Researcher Name : <font color='#FF0000'>".$_POST['res_name']."</font> Added!</font></h4><br>";
			$message .= "<a href=\"view_researcher.php\">BACK</a></td></tr>";
		}
	}
}

if(isset($_POST['edit_res']))
{
	mysql_query($editResSQLStr);
	$res = mysql_query($checkResSQLStr);
	$row = mysql_fetch_array($res);
	$message = "<tr><td bordercolor='#000099' bgcolor='#0066FF' align='center'><h4><font color='#FFFFFF'>Researcher Name : <font color='#FF0000'>".$row['r_name']."</font><br> record has been modified!</font></h4><br>";
	$message .= "<a href=\"edit_researcher.php?r_id=".$_POST['res_id']."\">BACK</a><br><input type='button' value='CLOSE' name='close' onclick='javascript:window.close()'></td></tr>";
}

if(isset($_POST['del_res']))
{
	$getAllDelId = $_POST['r_id'];
	$message = "<tr><td bgcolor='#FF0000'><center><h4><font color=\"#FFFFFF\">Are you sure delete ?</font></h4></center></td></tr>";
	for($i=0;$i<count($getAllDelId);$i++)
	{	
		$getDelResSQLStr = "SELECT r_name FROM researchers WHERE r_id='$getAllDelId[$i]';";
		$res = mysql_query($getDelResSQLStr);
		$row = mysql_fetch_array($res);
		$message .= "<input type='hidden' name='r_id[]' value='$getAllDelId[$i]'>";
		$message .= "<tr><td bgcolor='#FF0000'><center><font color='#FFFFFF'>Record : ".$row['r_name']."</font></center></td></tr>";
	}
	$message .= "<tr><td bgcolor='#FF0000' align='center'><input type=\"submit\" name=\"del_res_yes\" value=\"yes\">&nbsp;&nbsp;<input type=\"submit\" name=\"del_res_no\" value=\" no \"></td></tr>";
}

if(isset($_POST['del_res_yes']))
{
	$getAllDelId = $_POST['r_id'];
	$message = "<tr><td bgcolor='#FF0000'><center><h4><font color=\"#FFFFFF\">Record Deleted!</font></h4></center></td></tr>";
	for($i=0;$i<count($getAllDelId);$i++)
	{	
		$delResSQLStr = "DELETE FROM researchers WHERE r_id='$getAllDelId[$i]';";
		mysql_query($delResSQLStr);
		$message .= "<input type='hidden' name='r_id[]' value='$getAllDelId[$i]'>";
	}
	$message .= "<tr><td bgcolor='#FF0000' align='center'><a href=\"view_researcher.php\">BACK</a></td></tr>";
}

if(isset($_POST['del_res_no']))
{
	echo "<meta http-equiv='refresh' content='0;url=view_researcher.php'>";
}

if(isset($_POST['add_org']))
{
	if($_POST['org_name'] == "")
	{
		$message = "<tr><td bordercolor='#000099' bgcolor='#FF0000' align='center'><h4><font color='#FFFFFF'>No Organization Added!</font></h4><br>";
		$message .= "<a href=\"view_organization.php\">BACK</a></td></tr>";
	}
	else
	{
		$res = mysql_query($checkOrgSQLStr);
		if(mysql_num_rows($res)>0)
		{
			$message = "<tr><td bordercolor='#000099' bgcolor='#FF0000' align='center'><h4><font color='#FFFFFF'>Organization Name Existed!</font></h4><br>";
			$message .= "<a href=\"view_organization.php\">BACK</a></td></tr>";
		}
		else
		{
			mysql_query($addOrgSQLStr);
			$message = "<tr><td bordercolor='#000099' bgcolor='#0066FF' align='center'><h4><font color='#FFFFFF'>Organization Name : <font color='#FF0000'>".$_POST['org_name']."</font> Added!</font></h4><br>";
			$message .= "<a href=\"view_organization.php\">BACK</a></td></tr>";
		}
	}
}

if(isset($_POST['edit_org']))
{
	mysql_query($editOrgSQLStr);
	$res = mysql_query($checkOrgSQLStr);
	$row = mysql_fetch_array($res);
	$message = "<tr><td bordercolor='#000099' bgcolor='#0066FF' align='center'><h4><font color='#FFFFFF'>Organization Name : <font color='#FF0000'>".$row['o_name']."</font><br> record has been modified!</font></h4><br>";
	$message .= "<a href=\"edit_organization.php?o_id=".$_POST['org_id']."\">BACK</a><br><input type='button' value='CLOSE' name='close' onclick='javascript:window.close()'></td></tr>";

}

if(isset($_POST['del_org']))
{
	$getAllDelId = $_POST['o_id'];
	$message = "<tr><td bgcolor='#FF0000'><center><h4><font color=\"#FFFFFF\">Are you sure delete ?</font></h4></center></td></tr>";
	for($i=0;$i<count($getAllDelId);$i++)
	{	
		$getDelOrgSQLStr = "SELECT o_name FROM organizations WHERE o_id='$getAllDelId[$i]';";
		$res = mysql_query($getDelOrgSQLStr);
		$row = mysql_fetch_array($res);
		$message .= "<input type='hidden' name='o_id[]' value='$getAllDelId[$i]'>";
		$message .= "<tr><td bgcolor='#FF0000'><center><font color='#FFFFFF'>Record : ".$row['o_name']."</font></center></td></tr>";
	}
	$message .= "<tr><td bgcolor='#FF0000' align='center'><input type=\"submit\" name=\"del_org_yes\" value=\"yes\">&nbsp;&nbsp;<input type=\"submit\" name=\"del_org_no\" value=\" no \"></td></tr>";
}

if(isset($_POST['del_org_yes']))
{
	$getAllDelId = $_POST['o_id'];
	$message = "<tr><td bgcolor='#FF0000'><center><h4><font color=\"#FFFFFF\">Record Deleted!</font></h4></center></td></tr>";
	for($i=0;$i<count($getAllDelId);$i++)
	{	
		$delOrgSQLStr = "DELETE FROM organizations WHERE o_id='$getAllDelId[$i]';";
		mysql_query($delOrgSQLStr);
		$message .= "<input type='hidden' name='o_id[]' value='$getAllDelId[$i]'>";
	}
	$message .= "<tr><td bgcolor='#FF0000' align='center'><a href=\"view_organization.php\">BACK</a></td></tr>";
}

if(isset($_POST['del_org_no']))
{
	echo "<meta http-equiv='refresh' content='0;url=view_organization.php'>";
}

if(isset($_POST['add_coll']))
{
	if($_POST['coll_name'] == "")
	{
		$message = "<tr><td bordercolor='#000099' bgcolor='#FF0000' align='center'><h4><font color='#FFFFFF'>No Collaboration Added!</font></h4><br>";
		$message .= "<a href=\"view_collaboration.php\">BACK</a></td></tr>";
	}
	else if(checkCollYears($_POST['coll_years']))
	{
		$res = mysql_query($checkCollSQLStr);
		if(mysql_num_rows($res)>0)
		{
			$message = "<tr><td bordercolor='#000099' bgcolor='#FF0000' align='center'><h4><font color='#FFFFFF'>Collaboration Name Existed!</font></h4><br>";
			$message .= "<a href=\"view_collaboration.php\">BACK</a></td></tr>";
		}
		else
		{
			mysql_query($addCollSQLStr);
			$message = "<tr><td bordercolor='#000099' bgcolor='#0066FF' align='center'><h4><font color='#FFFFFF'>Collaboration Name : <font color='#FF0000'>".$_POST['coll_name']."</font> Added!</font></h4><br>";
			$message .= "<a href=\"view_collaboration.php\">BACK</a></td></tr>";
		}
	}
	else
	{
		$message = "<tr><td bordercolor='#000099' bgcolor='#FF0000' align='center'><h4><font color='#FFFFFF'>Collaboration years not in range from 1990 to 2010.</font></h4><br>";
		$message .= "<a href=\"view_collaboration.php\">BACK</a></td></tr>";
	}
}

if(isset($_POST['edit_coll']))
{
	if(checkCollYears($_POST['coll_years']))
	{
		mysql_query($editCollSQLStr);
		$res = mysql_query($checkCollSQLStr);
		$row = mysql_fetch_array($res);
		$message = "<tr><td bordercolor='#000099' bgcolor='#0066FF' align='center'><h4><font color='#FFFFFF'>Collaboration Name : <font color='#FF0000'>".$row['c_name']."</font><br> record has been modified!</font></h4><br>";
		$message .= "<a href=\"edit_collaboration.php?c_id=".$_POST['coll_id']."\">BACK</a><br><input type='button' value='CLOSE' name='close' onclick='javascript:window.close()'></td></tr>";
	}
	else
	{
		$message = "<tr><td bordercolor='#000099' bgcolor='#FF0000' align='center'><h4><font color='#FFFFFF'>Collaboration years not in range from 1990 to 2010.</font></h4><br>";
		$message .= "<a href=\"edit_collaboration.php?c_id=".$_POST['coll_id']."\">BACK</a><br><input type='button' value='CLOSE' name='close' onclick='javascript:window.close()'></td></tr>";
	}
}

if(isset($_POST['del_coll']))
{
	$getAllDelId = $_POST['c_id'];
	$message = "<tr><td bgcolor='#FF0000'><center><h4><font color=\"#FFFFFF\">Are you sure delete ?</font></h4></center></td></tr>";
	for($i=0;$i<count($getAllDelId);$i++)
	{	
		$getDelCollSQLStr = "SELECT c_name FROM collaborations WHERE c_id='$getAllDelId[$i]';";
		$res = mysql_query($getDelCollSQLStr);
		$row = mysql_fetch_array($res);
		$message .= "<input type='hidden' name='c_id[]' value='$getAllDelId[$i]'>";
		$message .= "<tr><td bgcolor='#FF0000'><center><font color='#FFFFFF'>Record : ".$row['c_name']."</font></center></td></tr>";
	}
	$message .= "<tr><td bgcolor='#FF0000' align='center'><input type=\"submit\" name=\"del_coll_yes\" value=\"yes\">&nbsp;&nbsp;<input type=\"submit\" name=\"del_coll_no\" value=\" no \"></td></tr>";
}

if(isset($_POST['del_coll_yes']))
{
	$getAllDelId = $_POST['c_id'];
	$message = "<tr><td bgcolor='#FF0000'><center><h4><font color=\"#FFFFFF\">Record Deleted!</font></h4></center></td></tr>";
	for($i=0;$i<count($getAllDelId);$i++)
	{	
		$delCollSQLStr = "DELETE FROM collaborations WHERE c_id='$getAllDelId[$i]';";
		mysql_query($delCollSQLStr);
		$message .= "<input type='hidden' name='c_id[]' value='$getAllDelId[$i]'>";
	}
	$message .= "<tr><td bgcolor='#FF0000' align='center'><a href=\"view_collaboration.php\">BACK</a></td></tr>";
}

if(isset($_POST['del_coll_no']))
{
	echo "<meta http-equiv='refresh' content='0;url=view_collaboration.php'>";
}

if(isset($_POST['coll_xml_export']))
{
	$res = mysql_query($getAllCollSQLStr);
	$file = fopen("xml/collaborations.xml","w");
	fprintf($file, "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>\n");
	fprintf($file, "<myisern>");
	
	$numOfRows = mysql_num_rows($res); 
	for($i = 0; $i < $numOfRows; $i++)
	{
		$row = mysql_fetch_array($res);
		fprintf($file, "\n\t<collaborations>\n\t\t");
		fprintf($file, "<c_id>%s</c_id>\n\t\t",$row['c_id']);
		fprintf($file, "<c_name>%s</c_name>\n\t\t",$row['c_name']);
		fprintf($file, "<c_organizations>%s</c_organizations>\n\t\t",$row['c_organizations']);
		fprintf($file, "<c_types>%s</c_types>\n\t\t",$row['c_types']);
		fprintf($file, "<c_years>%s</c_years>\n\t\t",$row['c_years']);
		fprintf($file, "<c_outcome_types>%s</c_outcome_types>\n\t\t",$row['c_outcome_types']);
		fprintf($file, "<c_description>%s</c_description>\n\t",$row['c_description']);
		fprintf($file, "</collaborations>");
	}
	fprintf($file, "\n</myisern>");
	fclose($file);
	$message = "<tr><td bordercolor='#000099' bgcolor='#0066FF' align='center'><h4><font color='#FFFFFF'>collaborations.xml file generated!</font></h4><br>";
	$message .= "<a href=\"view_collaboration.php\">BACK</a><br><input type='button' value='CLOSE' name='close' onclick='javascript:window.close()'></td></tr>";
}

if(isset($_POST['org_xml_export']))
{
	$res = mysql_query($getAllOrgSQLStr);
	$file = fopen("xml/organizations.xml","w");
	fprintf($file, "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>\n");
	fprintf($file, "<myisern>");
	
	$numOfRows = mysql_num_rows($res); 
	for($i = 0; $i < $numOfRows; $i++)
	{
		$row = mysql_fetch_array($res);
		fprintf($file, "\n\t<organizations>\n\t\t");
		fprintf($file, "<o_id>%s</o_id>\n\t\t",$row['o_id']);
		fprintf($file, "<o_name>%s</o_name>\n\t\t",$row['o_name']);
		fprintf($file, "<o_type>%s</o_type>\n\t\t",$row['o_type']);
		fprintf($file, "<o_contact>%s</o_contact>\n\t\t",$row['o_contact']);
		fprintf($file, "<o_aff_researchers>%s</o_aff_researchers>\n\t\t",$row['o_aff_researchers']);
		fprintf($file, "<o_country>%s</o_country>\n\t\t",$row['o_country']);
		fprintf($file, "<o_res_keywords>%s</o_res_keywords>\n\t\t",$row['o_res_keywords']);
		fprintf($file, "<o_res_description>%s</o_res_description>\n\t\t",$row['o_res_description']);
		fprintf($file, "<o_home_page>%s</o_home_page>\n\t",$row['o_home_page']);
		fprintf($file, "</organizations>");
	}
	fprintf($file, "\n</myisern>");
	fclose($file);
	$message = "<tr><td bordercolor='#000099' bgcolor='#0066FF' align='center'><h4><font color='#FFFFFF'>organizations.xml file generated!</font></h4><br>";
	$message .= "<a href=\"view_organization.php\">BACK</a><br><input type='button' value='CLOSE' name='close' onclick='javascript:window.close()'></td></tr>";
}

if(isset($_POST['res_xml_export']))
{
	$res = mysql_query($getAllResSQLStr);
	$file = fopen("xml/researchers.xml","w");
	fprintf($file, "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>\n");
	fprintf($file, "<myisern>");
	
	$numOfRows = mysql_num_rows($res); 
	for($i = 0; $i < $numOfRows; $i++)
	{
		$row = mysql_fetch_array($res);
		fprintf($file, "\n\t<researchers>\n\t\t");
		fprintf($file, "<r_id>%s</r_id>\n\t\t",$row['r_id']);
		fprintf($file, "<r_name>%s</r_name>\n\t\t",$row['r_name']);
		fprintf($file, "<r_organization>%s</r_organization>\n\t\t",$row['r_organization']);
		fprintf($file, "<r_email>%s</r_email>\n\t\t",$row['r_email']);
		fprintf($file, "<r_pic>%s</r_pic>\n\t\t",$row['r_pic']);
		fprintf($file, "<r_bio_statement>%s</r_bio_statement>\n\t",$row['r_bio_statement']);
		fprintf($file, "</researchers>");
	}
	fprintf($file, "\n</myisern>");
	fclose($file);
	$message = "<tr><td bordercolor='#000099' bgcolor='#0066FF' align='center'><h4><font color='#FFFFFF'>researcher.xml file generated!</font></h4><br>";
	$message .= "<a href=\"view_researcher.php\">BACK</a><br><input type='button' value='CLOSE' name='close' onclick='javascript:window.close()'></td></tr>";
}

if(isset($_POST['coll_sql_export']))
{
	$res = mysql_query($getAllCollSQLStr);
	$file = fopen("sql/collaborations.sql","w");
	fprintf($file, "INSERT INTO `collaborations` (`c_id`, `c_name`, `c_organizations`, `c_types`, `c_years`, `c_outcome_types`, `c_description`) VALUES\n");	
	$numOfRows = mysql_num_rows($res);

	for($i = 0; $i < $numOfRows; $i++)
	{
		$row = mysql_fetch_array($res);
		
		fprintf($file, "(%d, '%s', '%s', '%s', '%s', '%s', '%s')",
		$row['c_id'],$row['c_name'],$row['c_organizations'],$row['c_types'],$row['c_years'],replaceSpecialChar($row['c_outcome_types'],"'"),replaceSpecialChar($row['c_description'],"'"));
		if($i == ($numOfRows-1))
			fprintf($file, ";");
		else
			fprintf($file, ",\n");
	}
	fclose($file);
	$message = "<tr><td bordercolor='#000099' bgcolor='#0066FF' align='center'><h4><font color='#FFFFFF'>collaboration.sql file generated!</font></h4><br>";
	$message .= "<input type='button' value='CLOSE' name='close' onclick='javascript:window.close()'></td></tr>";
}

if(isset($_POST['org_sql_export']))
{
	$res = mysql_query($getAllOrgSQLStr);
	$file = fopen("sql/organizations.sql","w");
	fprintf($file, "INSERT INTO `organizations` (`o_id`, `o_name`, `o_type`, `o_contact`, `o_aff_researchers`, `o_country`, `o_res_keywords`, `o_res_description`, `o_home_page`) VALUES\n");	
	$numOfRows = mysql_num_rows($res); 
	
	for($i = 0; $i < $numOfRows; $i++)
	{
		$row = mysql_fetch_array($res);
		fprintf($file, "(%d, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
		$row['o_id'],$row['o_name'],$row['o_type'],$row['o_contact'],$row['o_aff_researchers'],$row['o_country'],$row['o_res_keywords'],$row['o_res_description'],$row['o_home_page']);
		if($i == ($numOfRows-1))
			fprintf($file, ";");
		else
			fprintf($file, ",\n");
	}
	fclose($file);
	$message = "<tr><td bordercolor='#000099' bgcolor='#0066FF' align='center'><h4><font color='#FFFFFF'>organizations.sql file generated!</font></h4><br>";
	$message = "<input type='button' value='CLOSE' name='close' onclick='javascript:window.close()'></td></tr>";
}

if(isset($_POST['res_sql_export']))
{
	$res = mysql_query($getAllResSQLStr);
	$file = fopen("sql/researchers.sql","w");
	fprintf($file, "INSERT INTO `researchers` (`r_id`, `r_name`, `r_organization`, `r_email`, `r_pic`,`r_bio_statement`) VALUES\n");	
	$numOfRows = mysql_num_rows($res); 
	for($i = 0; $i < $numOfRows; $i++)
	{
		$row = mysql_fetch_array($res);
		fprintf($file, "(%d, '%s', '%s', '%s', '%s', '%s')",$row['r_id'],$row['r_name'],$row['r_organization'],$row['r_email'],$row['r_pic'],$row['r_bio_statement']);
		if($i == ($numOfRows-1))
			fprintf($file, ";");
		else
			fprintf($file, ",\n");
	}
	fclose($file);
	$message = "<tr><td bordercolor='#000099' bgcolor='#0066FF' align='center'><h4><font color='#FFFFFF'>researcher.sql file generated!</font></h4><br>";
	$message .= "<input type='button' value='CLOSE' name='close' onclick='javascript:window.close()'></td></tr>";
}

if(isset($_POST['all_sql_export']))
{
	$res = mysql_query($getAllResSQLStr);
	$file = fopen("sql/researchers.sql","w");
	fprintf($file, "INSERT INTO `researchers` (`r_id`, `r_name`, `r_organization`, `r_email`, `r_pic`,`r_bio_statement`) VALUES\n");	
	$numOfRows = mysql_num_rows($res); 
	for($i = 0; $i < $numOfRows; $i++)
	{
		$row = mysql_fetch_array($res);
		fprintf($file, "(%d, '%s', '%s', '%s', '%s', '%s')",$row['r_id'],$row['r_name'],$row['r_organization'],$row['r_email'],$row['r_pic'],replaceSpecialChar($row['r_bio_statement'],"'"));
		if($i == ($numOfRows-1))
			fprintf($file, ";");
		else
			fprintf($file, ",\n");
	}
	fclose($file);
	$message = "<tr><td bordercolor='#000099' bgcolor='#0066FF' align='center'><font color='#FFFFFF'>researcher.sql file generated!</font><br>";
	
	$res = mysql_query($getAllOrgSQLStr);
	$file = fopen("sql/organizations.sql","w");
	fprintf($file, "INSERT INTO `organizations` (`o_id`, `o_name`, `o_type`, `o_contact`, `o_aff_researchers`, `o_country`, `o_res_keywords`, `o_res_description`, `o_home_page`) VALUES\n");	
	$numOfRows = mysql_num_rows($res); 
	
	for($i = 0; $i < $numOfRows; $i++)
	{
		$row = mysql_fetch_array($res);
		fprintf($file, "(%d, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
		$row['o_id'],$row['o_name'],$row['o_type'],$row['o_contact'],$row['o_aff_researchers'],$row['o_country'],replaceSpecialChar($row['o_res_keywords'],"'"),replaceSpecialChar($row['o_res_description'],"'"),$row['o_home_page']);
		if($i == ($numOfRows-1))
			fprintf($file, ";");
		else
			fprintf($file, ",\n");
	}
	fclose($file);
	$message .= "<font color='#FFFFFF'>organizations.sql file generated!</font><br>";

	$res = mysql_query($getAllCollSQLStr);
	$file = fopen("sql/collaborations.sql","w");
	fprintf($file, "INSERT INTO `collaborations` (`c_id`, `c_name`, `c_organizations`, `c_types`, `c_years`, `c_outcome_types`, `c_description`) VALUES\n");	
	$numOfRows = mysql_num_rows($res); 
	for($i = 0; $i < $numOfRows; $i++)
	{
		$row = mysql_fetch_array($res);
		fprintf($file, "(%d, '%s', '%s', '%s', '%s', '%s', '%s')",
		$row['c_id'],$row['c_name'],$row['c_organizations'],$row['c_types'],$row['c_years'],replaceSpecialChar($row['c_outcome_types'],"'"),replaceSpecialChar($row['c_description'],"'"));
		if($i == ($numOfRows-1))
			fprintf($file, ";");
		else
			fprintf($file, ",\n");
	}
	fclose($file);
	$message .= "<font color='#FFFFFF'>collaboration.sql file generated!</font><br>";
	$message .= "<input type='button' value='CLOSE' name='close' onclick='javascript:window.close()'></td></tr>";
}

if(isset($_POST['sql_import']))
{
	$file_name = "sql/".$_FILES['file_location']['name'];
	if(!is_file($file_name))
	{
		$message = "<tr><td bordercolor='#000099' bgcolor='#FF0000' align='center'><h4><font color='#FFFFFF'>ERROR!</font></h4><br>";
		$message .= "<a href=\"sql_res_export.php\">BACK</a><br><input type='button' value='CLOSE' name='close' onclick='javascript:window.close()'></td></tr>";
	}
	else
	{
		$file = fopen($file_name, "r");
		$contents = fread($file, filesize($file_name));
		mysql_query($contents);
		fclose($file);
		$message = "<tr><td bordercolor='#000099' bgcolor='#0066FF' align='center'><h4><font color='#FFFFFF'>SQL file imported!</font></h4><br>";
		$message .= "<input type='button' value='CLOSE' name='close' onclick='javascript:window.close()'></td></tr>";
	}
}
?>		
	</tr>
	<tr>
<?
echo "$message";
?>		
	</tr>
</table>
</form>
</body>
</html>
<?
	}	
}
else
//if the cookie does not exist, they are taken to the login screen
{
	echo"Session Login expired!";
}
function replaceSpecialChar($string, $sChar)
{
	$str = str_replace($sChar, "''", "$string");
	return $str;
}

// function :: checkCollYears
function checkCollYears($years)
{
	$array = split(",",$years);
	$MIN_YEARS = 1990;
	$MAX_YEARS = 2010;
	$i = 0;
	foreach ($array as &$eachYear) {
    	if($eachYear < $MIN_YEARS || $eachYear > $MAX_YEARS)
		{
			$i--;
		}
		else
		{
			$i++;
		}
	}
	if($i != sizeof($array))
	{
		return false;
	}
	else
	{
		return true;
	}
}
?>