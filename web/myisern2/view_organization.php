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
<script language="javascript">
function select_all(formName, elementName, selectAllName, elementDisable) {
	if(!document.forms[formName].elements[elementName])
		return;
	if(document.forms[formName].elements[selectAllName].checked)
	{
		if(document.forms[formName].elements[elementName].length == '')
			document.forms[formName].elements[elementName][i].checked = true;
			for(var i = 0; i < document.forms[formName].elements[elementName].length; i++)
				document.forms[formName].elements[elementName][i].checked = true;
		document.forms[formName].elements[elementDisable].disabled = false;
	}
	else{
		for(var i = 0; i < document.forms[formName].elements[elementName].length; i++){
			document.forms[formName].elements[elementName][i].checked = false;
		}
		document.forms[formName].elements[elementDisable].disabled = true;
	}
}

function disable_button(formName, elementName, elementId, elementDisable) {
	var counter_a = 0;
	if(document.forms[formName].elements[elementName][elementId].checked)
		document.forms[formName].elements[elementDisable].disabled = false;
	for(var i = 0; i < document.forms[formName].elements[elementName].length; i++) {			
		if(!document.forms[formName].elements[elementName][i].checked){				
			document.forms[formName].elements[elementDisable].disabled = false;
			counter_a++;
		}
		if(document.forms[formName].elements[elementName].length == counter_a) {
			document.forms[formName].elements[elementDisable].disabled = true;
		}
	}
}

function new_window(address, title) {
	window.open(address, title, 'width=460,height=410')
}

function export_window(address, title) {
	window.open(address, title, 'width=290,height=250')
}
</script>
<form name="form1" method="post" action="process.php" enctype="multipart/form-data">
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#99CCFF">
	<tr>
		<td bgcolor="#FF3300" align="center">
		<select onchange="location = this.options[this.selectedIndex].value;">
		<option value="">Organization
		<option value="view_collaboration.php">Collaboration
		<option value="view_researcher.php">Reseacher
		</select>
		&nbsp;&nbsp;<input type="submit" name="org_xml_export" value="XML Export" />
		&nbsp;&nbsp;<input type="button" value="SQL Export" onclick="javascript:export_window('sql_org_export.php','OrganizationSQLFile');" />
		</td>
	</tr>
	<tr>
		<td>
			<table width="59%" border="0" align="center" bordercolor="#FFFFFF">
			<tr>
				<td>
					<table width="118%" border="0" align="center" bordercolor="#FFFFFF">
					<tr>
						<td bgcolor="#CCCC33">Name:</td>
						<td><input type="text" name="org_name" /></td>					
					</tr>
					<tr>
						<td bgcolor="#FF6600">Type:</td>
						<td><input type="text" name="org_type" /></td>
					</tr>
					<tr>
						<td bgcolor="#CCCC33">Contact:</td>
						<td><input type="text" name="org_contact" /></td>
					</tr>
					<tr>
						<td bgcolor="#FF6600">Affiliated-Researchers:</td>
						<td><input type="text" name="org_aff_researchers" /></td>
					</tr>
					<tr>
						<td bgcolor="#CCCC33">Country:</td>
						<td><input type="text" name="org_country" /></td>
					</tr>
					<tr>
						<td bgcolor="#FF6600">Research-Keywords:</td>
						<td><input type="text" name="org_res_keywords" /></td>
					</tr>
					<tr>
						<td bgcolor="#CCCC33">Home-Page:</td>
						<td><input type="text" name="org_home_page" /></td>
					</tr>
				  </table>
				</td>
				<td>
					<table width="75%" border="0" align="center" bordercolor="#FFFFFF">
					<tr>
						<td bgcolor="#FF6600">Description:</td>
					</tr>
					<tr>
						<td><textarea cols="20" rows="5" name="org_res_description"></textarea></td>
					</tr>
				  </table>
				</td>
			</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td align="center"><input type="submit" value="ADD" name="add_org" /></td>
	</tr>
	<tr>
		<td>
			<table width="98%" border="0" align="center" bordercolor="#FFFFFF">
				<tr>
					<td width="8%" align="center" bgcolor="#CC3300">
						<font color="#FFFFFF">Select All</font>
						<!--call select all / cancel checkbox Script language-->
						<input type="checkbox" name="all" onClick="select_all('form1','o_id[]',this.name,'del');">
					</td>
					<td width="9%" align="left" bgcolor="#CC3300">
						<font color="#FFFFFF">Name</font>
					</td>
					<td width="8%" align="left" bgcolor="#CC3300">
						<font color="#FFFFFF">Type</font>
					</td>
					<td width="8%" align="left" bgcolor="#CC3300">
						<font color="#FFFFFF">contact</font>
					</td>
					<td width="12%" align="left" bgcolor="#CC3300">
						<font color="#FFFFFF">Affiliated-Researchers</font>
					</td>
					<td width="6%" align="left" bgcolor="#CC3300">
						<font color="#FFFFFF">Country</font>
					</td>
					<td width="12%" align="left" bgcolor="#CC3300">
						<font color="#FFFFFF">Research-Keywords</font>
					</td>
					<td width="11%" align="left" bgcolor="#CC3300">
						<font color="#FFFFFF">Research-Description</font>
					</td>
					<td width="26%" align="left" bgcolor="#CC3300">
						<font color="#FFFFFF">Home-Page</font>
					</td>
				</tr>
<?	
$getAllOrgSQLStr = "SELECT * FROM organizations";
$res = mysql_query($getAllOrgSQLStr);

if(mysql_num_rows($res) > 0)
{
	$elementId = 0;
	for($i = 0; $i < 50; $i++)
	{
		$row = mysql_fetch_array($res);
		if(!$row)
			break;
		if($i%2 == 0)
			echo "<tr bgcolor='#DDDDDD'>";
		else
			echo "<tr>";
		echo "<td align='center' width='80'><input type='checkbox' name='o_id[]' value='$row[o_id]' onclick=\"javascript:disable_button('form1','o_id[]','$elementId','del');\"></td>";
		echo "<td align='left' width=''><a href=\"javascript:new_window('edit_organization.php?o_id=".$row['o_id']."','OrganizationEdit');\">".$row['o_name']."</a></td>\n";
		echo "<td align='left'>".$row['o_type']."</td>\n";
		echo "<td align='left'>".$row['o_contact']."</td>\n";
		echo "<td align='left'>";
		StringDelimitStream($row['o_aff_researchers']);
		echo "</td>";
		echo "<td align='left'>".$row['o_country']."</td>\n";
		echo "<td align='left'>";
		StringDelimitStream($row['o_res_keywords']);
		echo "</td>";
		echo "<td align='left'>";
		DesStringDelimitStream($row['o_res_description']);
		echo "</td>";
		echo "<td align='left'>".$row['o_home_page']."</td>";
		echo "</tr>";
		$elementId++;
	}
}
?>
				<tr>
					<td colspan="9" align="center">
						<input type="submit" name="del_org" id="del" value="Delete Item" disabled>&nbsp;&nbsp;<INPUT TYPE="button" onClick="history.go(0)" VALUE="Refresh">
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>
</body>
</html>
<?
		echo "<a href='logout.php'><h4>LOGOUT</h4></a>";
	}	
}

else
// if the cookie does not exist, they are taken to the login screen
{
	header("Location: index.php");
}
// function :: StringDelimitStream
function StringDelimitStream($string)
{
	$array = split(",",$string);
	echo "<table>";
	for($i = 0; $i<sizeof($array); $i++)
	{	
		echo "<tr><td align='left'>$array[$i]</td></tr>";
	}
	echo "</table>";
}

// function :: DesStringDelimitStream
function DesStringDelimitStream($string)
{
	$array = split("\n",$string);
	echo "<table>";
	for($i = 0; $i<sizeof($array); $i++)
	{	
		echo "<tr><td align='left'>$array[$i]</td></tr>";
	}
	echo "</table>";
}
?>
