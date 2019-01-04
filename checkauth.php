<?php

session_start();
 $today = date(Ymd);
// echo "<p>_POST[employeeno] $_POST[employeeno] _POST[password] $_POST[password]</p>";
if ((!$_POST[userid])|| (!$_POST[password]))
{
$_SESSION[msg] = 'Invalid User id no or Password entered, please try again!';
}

include ('db_ems.php');

$sql = "select * from m_user where userid = '$_POST[userid]' and password = password('$_POST[password]') and status = '' "; 
$result = mysql_query($sql,$con) or die(mysql_error());

if (mysql_num_rows($result) == 1)
{
	$_SESSION[userid] = $_POST[userid];
	$_SESSION[username] = mysql_result($result, 0, 'username');
	$_SESSION[company] = mysql_result($result, 0, 'company');
	$_SESSION[storeid] = mysql_result($result, 0, 'storeid');
	$_SESSION[role] = mysql_result($result, 0, 'role');
	$_SESSION[msg] = 'Valid User ID entered,  '. $today . '  '.$_POST[userid].'  '.$_SESSION[username] ;
	header("Location: index.php");
}
else {
	
$_SESSION[msg] = 'Invalid User ID entered, please try again! '. $today . '  '.$_POST[userid];
header("Location: login.php");
exit;
}
echo "<p>test $_SESSION[msg]</p>";
?>
