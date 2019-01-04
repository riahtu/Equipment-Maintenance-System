<?php

session_start();
 require('db_ems.php');
    $sql = "update physical_count_detail set stocktake_qty = '$_GET[stocktake_qty]'
	                      where pc_docno = '$_GET[pcdocno]' and sparepartid = '$_GET[sparepartid]' ";
	if (!mysql_query($sql)) { die('Error: ' . mysql_error()); }

    
 
?>