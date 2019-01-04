<?php
session_start();

 require('db_ems.php');
 date_default_timezone_set('Asia/Kuala_lumpur');
   $now = date("YmdHis");
   $today = date("Y-m-d");

    $lineDescription =  mysql_real_escape_string($_GET[lineDescription]);
	$lineCode =  mysql_real_escape_string($_GET[lineCode]);

	$sql = "INSERT INTO m_prodline(linecode,description,updatetime,createtime)
			VALUES ('$lineCode','$lineDescription','$now','$now')";

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