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
	window.open(address, title, 'width=460,height=330')
}

function export_window(address, title) {
	window.open(address, title, 'width=290,height=250')
}
</script>
<form name="form1" method="post" action="process.php" enctype="multipart/form-data">
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#99CCFF">
	<tr>
		<td bgcolor="#99CC00" align="center">
		<select onchange="location = this.options[this.selectedIndex].value;">
		<option value="">Collaboration
		<option value="view_organization.php">Organization
		<option value="view_researcher.php">Reseacher
		</select>
		&nbsp;&nbsp;<input type="submit" name="coll_xml_export" value="XML Export" />
		&nbsp;&nbsp;<input type="button" value="SQL Export" onclick="javascript:export_window('sql_coll_export.php','CollaborationSQLFile');" />
		</td>
	</tr>
	<tr>
		<td>
			<table width="50%" border="0" align="center" bordercolor="#FFFFFF">
			<tr>
				<td>
					<table width="100%" border="0" align="center" bordercolor="#FFFFFF">
					<tr>
						<td bgcolor="#999966">Name:</td>
						<td><input type="text" name="coll_name" /></td>					
					</tr>
					<tr>
						<td bgcolor="#9999FF">Organizations:</td>
						<td><input type="text" name="coll_organizations" /></td>
					</tr>
					<tr>
						<td bgcolor="#999966">Types:</td>
						<td><input type="text" name="coll_types" /></td>
					</tr>
					<tr>
						<td bgcolor="#9999FF">Years:</td>
						<td><input type="text" name="coll_years" /></td>
					</tr>
					<tr>
						<td bgcolor="#999966">Outcome-Types:</td>
						<td><input type="text" name="coll_outcome_types" /></td>
					</tr>
					</table>
				</td>
				<td>
					<table width="50%" border="0" align="center" bordercolor="#FFFFFF">
					<tr>
						<td bgcolor="#9999FF">Description:</td>
					</tr>
					<tr>
						<td><textarea cols="20" rows="5" name="coll_description"></textarea></td>
					</tr>
					</table>
				</td>
			</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td align="center"><input type="submit" value="ADD" name="add_coll" /></td>
	</tr>
	<tr>
		<td>
			<table width="98%" border="0" align="center" bordercolor="#FFFFFF">
				<tr>
					<td width="7%" align="center" bgcolor="#99CCFF">
						<font color="#0000FF">Select All</font>
						<!--call select all / cancel checkbox Script language-->
						<input type="checkbox" name="all" onClick="select_all('form1','c_id[]',this.name,'del');">
					</td>
					<td width="15%" align="left" bgcolor="#99CCFF">
						<font color="#0000FF">Name</font>
					</td>
					<td width="15%" align="left" bgcolor="#99CCFF">
						<font color="#0000FF">Organization</font>
					</td>
					<td width="11%" align="left" bgcolor="#99CCFF">
						<font color="#0000FF">Type</font>
					</td>
					<td width="7%" align="left" bgcolor="#99CCFF">
						<font color="#0000FF">Years</font>
					</td>
					<td width="10%" align="left" bgcolor="#99CCFF">
						<font color="#0000FF">Outcome-Types</font>
					</td>
					<td width="26%" align="left" bgcolor="#99CCFF">
						<font color="#0000FF">Description</font>
					</td>
				</tr>
<?	
$getAllCollSQLStr = "SELECT * FROM collaborations";
$res = mysql_query($getAllCollSQLStr);

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
		echo "<td align='center' width='80'><input type='checkbox' name='c_id[]' value='$row[c_id]' onclick=\"javascript:disable_button('form1','c_id[]','$elementId','del');\"></td>";
		echo "<td align='left' width=''><a href=\"javascript:new_window('edit_collaboration.php?c_id=".$row['c_id']."','CollaborationEdit');\">".$row['c_name']."</a></td>\n";
		echo "<td align='left'>";
		StringDelimitStream($row['c_organizations']);
		echo "</td>";
		echo "<td align='left'>";
		StringDelimitStream($row['c_types']);
		echo "</td>";
		echo "<td align='left'>";
		StringDelimitStream($row['c_years']);
		echo "</td>";
		echo "<td align='left'>";
		StringDelimitStream($row['c_outcome_types']);
		echo "</td>";
		echo "<td align='left'>";
		DesStringDelimitStream($row['c_description']);
		echo "</td>";
		echo "</tr>";
		$elementId++;
	}
}
?>
				<tr>
					<td colspan="9" align="center">
						<input type="submit" name="del_coll" id="del" value="Delete Item" disabled>&nbsp;&nbsp;<INPUT TYPE="button" onClick="history.go(0)" VALUE="Refresh">
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
