<?php

session_start();
 require('db_ems.php');
    $sql = "update t_workorder_parts set d_pickqty = '$_GET[d_pickqty]'
	                      where workorderid = '$_GET[workorderid]' and barcode = '$_GET[barcode]' ";
	if (!mysql_query($sql)) { die('Error: ' . mysql_error()); }

    
 
?>