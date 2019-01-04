<?php  	
date_default_timezone_set('Asia/Kuala_lumpur');
session_start();
$now = date("YmdHis");
$today = date("Ymd");

require('db_ems.php');
$result7 = mysql_query("SELECT distinct bingroup FROM m_location order by recno"); 
while($row7 = mysql_fetch_array($result7))
{
	$sql = "INSERT INTO m_bingroup(bingroup,description,updatetime,userid)
	VALUES ('$row7[bingroup]','$row7[bingroup]','$now','8712')" ;
	if (!mysql_query($sql, $con)) { die('Error: ' . mysql_error());  }
}
?>