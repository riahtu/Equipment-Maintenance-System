<?php

session_start();
 require('db_ems.php');

$status = '';
		$result2 = mysql_query("SELECT * from m_sparepart where sparepartid = '$_POST[sparepartid]' ");
		if (!mysql_num_rows($result2) == 0 )
		{
			 $sp_name = mysql_result($result2, 0, 'description');
			 $sp_barcode = mysql_result($result2, 0, 'barcode');
			 $sp_maker = mysql_result($result2, 0, 'maker');
			 $status = 'F';
		}
		else
		{
		$status = 'NF';
		
		}
	
		
	
$data = array('sp_name'=>$sp_name,'sp_barcode'=> $sp_barcode,'sp_maker'=> $sp_maker,'sp_status'=>$status);
echo json_encode($data);
    
?>