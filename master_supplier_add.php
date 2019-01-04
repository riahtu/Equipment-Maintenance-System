<?php
session_start();

 require('db_ems.php');
 date_default_timezone_set('Asia/Kuala_lumpur');
   $now = date("YmdHis");
   $today = date("Y-m-d");

    $supplierName =  mysql_real_escape_string($_GET[supplierName]);
	$supplierCountry =  mysql_real_escape_string($_GET[supplierCountry]);

	$sql = "INSERT INTO m_supplier(description,country,createtime)
			VALUES ('$supplierName','$supplierCountry','$now')";

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