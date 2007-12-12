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
	window.open(address, title, 'width=460,height=280')
}

function export_window(address, title) {
	window.open(address, title, 'width=290,height=250')
}
</script>
<form name="form1" method="post" action="process.php" enctype="multipart/form-data">
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#99CCFF">
	<tr>
		<td bgcolor="#FFFF00" align="center">
		<select onchange="location = this.options[this.selectedIndex].value;">
		<option value="">Researcher
		<option value="view_collaboration.php">Collaboration
		<option value="view_organization.php">Organization
		</select>
		&nbsp;&nbsp;<input type="submit" name="res_xml_export" value="XML Export" />
		&nbsp;&nbsp;<input type="button" value="SQL Export" onclick="javascript:export_window('sql_res_export.php','ResearcherSQLFile');" />
		</td>
	</tr>
	<tr>
		<td>
			<table width="55%" border="0" align="center" bordercolor="#FFFFFF">
			<tr>
				<td>
					<table width="118%" border="0" align="center" bordercolor="#FFFFFF">
					<tr>
						<td bgcolor="#FFFF99">Name:</td>
						<td><input type="text" name="res_name" /></td>					
					</tr>
					<tr>
						<td bgcolor="#FF6633">Organization:</td>
						<td><input type="text" name="res_organization" /></td>
					</tr>
					<tr>
						<td bgcolor="#FFFF99">Email:</td>
						<td><input type="text" name="res_email" /></td>
					</tr>
					<tr>
						<td bgcolor="#FF6633">Picture-Link:</td>
						<td><input type="text" name="res_pic" /></td>
					</tr>
				  </table>
				</td>
				<td>
					<table width="50%" border="0" align="center" bordercolor="#FFFFFF">
					<tr>
						<td bgcolor="#FFFF99">Bio-Statement:</td>
					</tr>
					<tr>
						<td><textarea cols="20" rows="5" name="res_bio_statement"><?=$row['r_bio_statement']?></textarea></td>
					</tr>
					</table>
				</td>
			</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td align="center"><input type="submit" value="ADD" name="add_res" /></td>
	</tr>
	<tr>
		<td>
			<table width="98%" border="0" align="center" bordercolor="#FFFFFF">
				<tr>
					<td width="6%" align="center" bgcolor="#663333">
						<font color="#FFFFFF">Select All</font>
						<!--call select all / cancel checkbox Script language-->
						<input type="checkbox" name="all" onClick="select_all('form1','r_id[]',this.name,'del');">
					</td>
					<td width="11%" align="left" bgcolor="#663333">
						<font color="#FFFFFF">Name</font>
					</td>
					<td width="8%" align="left" bgcolor="#663333">
						<font color="#FFFFFF">Organization</font>
					</td>
					<td width="8%" align="left" bgcolor="#663333">
						<font color="#FFFFFF">E-mail</font>
					</td>
					<td width="12%" align="left" bgcolor="#663333">
						<font color="#FFFFFF">Picture-Link</font>
					</td>
					<td width="12%" align="left" bgcolor="#663333">
						<font color="#FFFFFF">Picture</font>
					</td>
					<td width="12%" align="left" bgcolor="#663333">
						<font color="#FFFFFF">Bio-Statement</font>
					</td>
				</tr>
<?	
$getAllResSQLStr = "SELECT * FROM researchers";
$res = mysql_query($getAllResSQLStr);

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
		echo "<td align='center' width='80'><input type='checkbox' name='r_id[]' value='$row[r_id]' onclick=\"javascript:disable_button('form1','r_id[]','$elementId','del');\"></td>";
		echo "<td align='left' width=''><a href=\"javascript:new_window('edit_researcher.php?r_id=".$row['r_id']."','ResearcherEdit');\">".$row['r_name']."</a></td>";
		echo "<td align='left'>".$row['r_organization']."</td>";
		echo "<td align='left'>".$row['r_email']."</td>";
		echo "<td align='left'>".$row['r_pic']."</td>";
		echo "<td align='center'><a href=\"".$row['r_pic']."\"><img src=\"".$row['r_pic']."\" width=\"50\" hieght=\"50\" /></a></td>";
		echo "<td align='left'>";
		DesStringDelimitStream($row['r_bio_statement']);
		echo "</td>";
		echo "</tr>";
		$elementId++;
	}
}
?>
				<tr>
					<td colspan="9" align="center">
						<input type="submit" name="del_res" id="del" value="Delete Item" disabled>&nbsp;&nbsp;<INPUT TYPE="button" onClick="history.go(0)" VALUE="Refresh">
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
