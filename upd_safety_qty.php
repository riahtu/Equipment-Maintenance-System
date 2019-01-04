<?php

session_start();
 require('db_ems.php');
    $sql = "update m_sparepart set safety_qty = '$_GET[safety_qty]'
	                      where sparepartid = '$_GET[sparepartid]' ";
	if (!mysql_query($sql)) { die('Error: ' . mysql_error()); }

    
 
?>