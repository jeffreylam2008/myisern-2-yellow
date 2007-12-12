<?
session_start();
// Connects to your Database
include("db_conn.php");

if(isset($_POST['close']))
{
	header("Location: " . $_SERVER['PHP_SELF']); 
}
//checks cookies to make sure they are logged in
if(isset($_COOKIE['ID_my_site']))
{
	$username = $_COOKIE['ID_my_site'];
	$pass = $_COOKIE['Key_my_site'];
	//if the cookie has the wrong password, they are taken to the login page
	if ($username != "demo" && $pass != "demo")
	{ 
		header("Location: index.php");
	}
	//otherwise they are shown the admin area
	else if(!isset($_SESSION['username']))
	{
		header("Location: index.php");
	}
	else
	{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MyISERN</title>
</head>
<body>
<form name="form1" method="post" action="process.php" enctype="multipart/form-data">
<table width="40%" border="0" align="left">
<tr>
	<td>Import file<hr /></td>
</tr>
<tr>
	<td>Select file :<input type="file" name="file_location" /></td>
</tr>
<tr>
	<td><input type="submit" name="sql_import" value="Import" /></td>
</tr>
<tr>
	<td><br />Export to collaborations.sql</td>
</tr>
<tr>
	<td><input type="submit" name="coll_sql_export" value="Export" />
	&nbsp;&nbsp;<input type="submit" name="all_sql_export" value="Export ALL" /></td>
</tr>
<tr>
	<td><br /><input type='button' value='CLOSE' name='close' onclick='javascript:window.close()'></td>
</tr>
</table>
</form>
</body>
</html>
<?
	}	
}

else
// if the cookie does not exist, they are taken to the login screen
{
	header("Location: index.php");
}
?>