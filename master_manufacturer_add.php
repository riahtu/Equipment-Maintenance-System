<?php
session_start();

 require('db_ems.php');
 date_default_timezone_set('Asia/Kuala_lumpur');
   $now = date("YmdHis");
   $today = date("Y-m-d");

    $manName =  mysql_real_escape_string($_GET[manName]);
	$manDesc =  mysql_real_escape_string($_GET[manDesc]);

	$sql = "INSERT INTO m_maker(maker,description,updatetime,createtime)
			VALUES ('$manName','$manDesc','$now','$now')";

			if (!mysql_query($sql)) { die('Error: ' . mysql_error());}
			
			committrans();	
		

function starttrans()
{
mysql_query("START TRANSACTION");
}

function committrans()
{
mysql_query("COMMIT");
}

?>