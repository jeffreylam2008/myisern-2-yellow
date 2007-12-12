<?
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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>Edit Collaboration</title>
</head>
<body>
<?
		$getCollSQLStr = "SELECT coll.* FROM collaborations AS coll WHERE c_id='".$_GET['c_id']."';";
		$res = mysql_query($getCollSQLStr);
		
		if(mysql_num_rows($res) > 0)
		{
			$row = mysql_fetch_array($res);
?>
<form name="form1" method="post" action="process.php" enctype="multipart/form-data">
<table>
	<tr>
		<td bgcolor="#99CC00" align="center"><h5>Edit Collaboration</h5></td>
	</tr>
	<tr>
		<td>
			<table width="250" border="0" align="center" bordercolor="#FFFFFF">
			<tr>
				<td>
					<table width="100%" border="0" align="center" bordercolor="#FFFFFF">
					<tr>
						<td bgcolor="#999966">Collaboration Name:</td>
						<td>
							<input type="hidden" value="<?=$row['c_id']?>" name="coll_id" />
							<?=$row['c_name']?>
						</td>					
					</tr>
					<tr>
						<td bgcolor="#9999FF">Organizations:</td>
						<td><input type="text" value="<?=$row['c_organizations']?>" name="coll_organizations" /></td>
					</tr>
					<tr>
						<td bgcolor="#999966">Types:</td>
						<td><input type="text" value="<?=$row['c_types']?>" name="coll_types" /></td>
					</tr>
					<tr>
						<td bgcolor="#9999FF">Years:</td>
						<td><input type="text" value="<?=$row['c_years']?>" name="coll_years" /></td>
					</tr>
					<tr>
						<td bgcolor="#999966">Outcome-Types:</td>
						<td><input type="text" value="<?=$row['c_outcome_types']?>" name="coll_outcome_types" /></td>
					</tr>
					</table>
				</td>
				<td>
					<table width="50%" border="0" align="center" bordercolor="#FFFFFF">
					<tr>
						<td bgcolor="#9999FF">Description:</td>
					</tr>
					<tr>
						<td><textarea cols="20" rows="5" name="coll_description"><?=$row['c_description']?></textarea></td>
					</tr>
					</table>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center"><input type="submit" value="EDIT" name="edit_coll" />&nbsp;&nbsp;<input type="reset" value="RESET" name="reset" /></td>
	</tr>
<?
		echo "<tr>";
		echo "<td><a href='javascript:window.close()'><h4>Close</h4></a></td>";
		echo "</tr>";
?>
</table>
</form>
</body>
</html>
<?	
		}
	}
}
else
//if the cookie does not exist, they are taken to the login screen
{
	echo"Session Login expired!";
}
?>