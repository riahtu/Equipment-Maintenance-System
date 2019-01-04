<?php

session_start();
 $today = date(Ymd);
if ((!$_POST[userid])|| (!$_POST[currPassword]) || (!$_POST[newPassword]))
{
$_SESSION[alert] = 'Invalid User id no or Password entered, please try again!';
}

$currPassword = $_POST[currPassword];
$newPassword = $_POST[newPassword];

include ('db_ems.php');

$sql = "select * from m_user where userid = '$_POST[userid]' and password = password('$_POST[currPassword]')"; 
$result = mysql_query($sql,$con) or die(mysql_error());

if (mysql_num_rows($result) == 1)
{	
	$sql = "update m_user set password = password('$newPassword') where userid = '$_POST[userid]'";
	if (!mysql_query($sql))
		die('Error: ' . mysql_error());                      
	else{
		$_SESSION[msg] = 'Password changed!,  '. $today . '  '.$_POST[userid].$_SESSION[username];
		header("Location: login.php");
	}
}
else
{
	$_SESSION[alert] = 'Invalid User ID or Password entered, please try again!';
	header("Location: change_password.php");
	exit;
}
?>