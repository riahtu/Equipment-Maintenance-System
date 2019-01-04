<?php

session_start();
$head = $_GET[head];
 require('db_ems.php');

if($head == 'PRV'){
	 $sql = "update mprv_reverse_header set status = 'D'
	                      where docno = '$_GET[docno]'";
	if (!mysql_query($sql)) { die('Error: ' . mysql_error()); }
}

if($head == 'PPR'){
	$sql = "update mppr_return_header set status = 'D'
	                      where docno = '$_GET[docno]'";
	if (!mysql_query($sql)) { die('Error: ' . mysql_error()); }
}
?>