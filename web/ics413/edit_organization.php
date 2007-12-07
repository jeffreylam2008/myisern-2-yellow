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
<title>Edit Oganization</title>
</head>
<body>
<?
		$getOrgSQLStr = "SELECT org.* FROM organizations AS org WHERE o_id='".$_GET['o_id']."';";
		$res = mysql_query($getOrgSQLStr);
		
		if(mysql_num_rows($res) > 0)
		{
			$row = mysql_fetch_array($res);
?>
<form name="form1" method="post" action="process.php" enctype="multipart/form-data">
<table>
	<tr>
		<td bgcolor="#FF3300" align="center"><h5>Edit Organization</h5></td>
	</tr>
	<tr>
		<td>
			<table width="250" border="0" align="center" bordercolor="#FFFFFF">
			<tr>
				<td>
					<table width="100%" border="0" align="center" bordercolor="#FFFFFF">
					<tr>
						<td bgcolor="#FF6600">Organization Name:</td>
						<td>
							<input type="hidden" value="<?=$row['o_id']?>" name="org_id" />
							<?=$row['o_name']?>
						</td>					
					</tr>
					<tr>
						<td bgcolor="#CCCC33">Organizations:</td>
						<td><input type="text" value="<?=$row['o_type']?>" name="org_type" /></td>
					</tr>
					<tr>
						<td bgcolor="#FF6600">Types:</td>
						<td><input type="text" value="<?=$row['o_contact']?>" name="org_contact" /></td>
					</tr>
					<tr>
						<td bgcolor="#CCCC33">Years:</td>
						<td><input type="text" value="<?=$row['o_aff_researchers']?>" name="org_aff_researchers" /></td>
					</tr>
					<tr>
						<td bgcolor="#FF6600">Outcome-Types:</td>
						<td><input type="text" value="<?=$row['o_country']?>" name="org_country" /></td>
					</tr>
					<tr>
						<td bgcolor="#CCCC33">Outcome-Types:</td>
						<td><input type="text" value="<?=$row['o_res_keywords']?>" name="org_res_keywords" /></td>
					</tr>
					<tr>
						<td bgcolor="#FF6600">Outcome-Types:</td>
						<td><input type="text" value="<?=$row['o_home_page']?>" name="org_home_page" /></td>
					</tr>
					</table>
				</td>
				<td>
					<table width="50%" border="0" align="center" bordercolor="#FFFFFF">
					<tr>
						<td bgcolor="#CCCC33">Description:</td>
					</tr>
					<tr>
						<td><textarea cols="20" rows="5" name="org_res_description"><?=$row['o_res_description']?></textarea></td>
					</tr>
					</table>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center"><input type="submit" value="EDIT" name="edit_org" />&nbsp;&nbsp;<input type="reset" value="RESET" name="reset" /></td>
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