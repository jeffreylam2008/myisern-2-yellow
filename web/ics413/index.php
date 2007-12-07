<?php
// Connects to your Database
//include("db_conn.php");
//include("db_func.php");

session_start();

//Checks if there is a login cookie
if( isset($_COOKIE['ID_my_site']) )
//if there is, it logs you in and directes you to the members page
{
	$username = $_COOKIE['ID_my_site'];
	$pass = $_COOKIE['Key_my_site'];
	if ($username == "demo" && $pass == "demo")
	{
		header("Location: view_collaboration.php");
	}
}

//if the login form is submitted
if (isset($_POST['submit']))
{ 
	//Gives error if user dosen't exist
	if (!$_POST['username'] | !$_POST['pass'])
	{
		$checkErrorMes = "No Login ID or Password Enter!";
?>
<table width="349" border="1" align="center" cellpadding="0" cellspacing="0">
	<tr bgcolor="#0099CC">
		<td colspan="2" align="center">
			<font color="#FFFFFFF"><h1>Login Failure!</h1></font>
		</td>
	</tr>
	<tr>
		<td align="center"> 
<?=$checkErrorMes?>
		</td>
	</tr>
	<tr>
		<td align="center">
			<a href=index.php>Login again</a>
		</td>
	</tr>
</table>
<?
	}
	//gives error if the password is wrong
	else if ($_POST['pass'] != "demo")
	{
		$wrongPassMes = "Incorrect password, please try again.";
?>
<table width="349" border="1" align="center" cellpadding="0" cellspacing="0">
	<tr bgcolor="#0099CC">
		<td colspan="2" align="center">
			<font color="#FFFFFFF"><h1>Login Failure!</h1></font>
		</td>
	</tr>
	<tr>
		<td align="center"> 
<?=$wrongPassMes?>
		</td>
	</tr>
	<tr>
		<td align="center">
			<meta http-equiv='refresh' content='3;url=index.php'>
		</td>
	</tr>
</table>
<?
	}
	//gives error if the ID is wrong
	else if ($_POST['username'] != "demo") 
	{
		$wrongPassMes = "Incorrect username, please try again.";
?>
<table width="349" border="1" align="center" cellpadding="0" cellspacing="0">
	<tr bgcolor="#0099CC">
		<td colspan="2" align="center">
			<font color="#FFFFFFF"><h1>Login Failure!</h1></font>
		</td>
	</tr>
	<tr>
		<td align="center"> 
<?=$wrongPassMes?>
		</td>
	</tr>
	<tr>
		<td align="center">
			<meta http-equiv='refresh' content='3;url=index.php'>
		</td>
	</tr>
</table>
<?	
	}
	else
	{
		// if login is ok then we add a cookie
		$hour = time() + 3600;
		setcookie(ID_my_site, $_POST['username'], $hour);
		setcookie(Key_my_site, $_POST['pass'], $hour); 
		
		
		//search for user and register as session
		session_register("username");
		
		//then redirect them to the members area
		$link = "view_collaboration.php";
		header("Location: $link");
	}
}
else
{
// if they are not logged in
?>
<form action="<? echo $_SERVER['PHP_SELF']?>" method="post">
	<table width="349" border="1" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
		<tr bgcolor="#0099CC">
			<td colspan="2" align="center"><font color="#FFFFFFF"><h1>MyIsern 2.0</h1></font></td>
		</tr>
		<tr bgcolor="#E3F0F4">
			<td align="center" width="160" nowrap>Username:</td>
			<td align="left"><input type="text" name="username" maxlength="50"></td>
		</tr>
		<tr bgcolor="#FFFFFF">
			<td align="center" width="160" nowrap>Password:</td>
			<td align="left"><input type="password" name="pass" maxlength="50"></td>
		</tr>
		<tr bgcolor="#E3F0F4">
			<td align="center" colspan="2" height="29">
				<input type="submit" name="submit" value="Login">&nbsp;&nbsp;&nbsp;
				<input type="reset" name="reset" value="Reset">
			</td>
		</tr>
	</table>
</form>
<?
}
?>