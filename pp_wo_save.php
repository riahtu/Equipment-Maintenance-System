<?php
session_start();

 require('db_ems.php');
 date_default_timezone_set('Asia/Kuala_lumpur');
   $now = date("YmdHis");
   $today = date("Y-m-d");


	$remarks =  mysql_real_escape_string($_POST[remarks]);
	$instructions =  mysql_real_escape_string($_POST[instructions]);
	$addsql = '';
	if ($_POST[wo_status2] == 'X' ) $addsql = ',closedtime = '.$now ; 
	starttrans();
			$sql = "update t_workorder set remarks = '$remarks' ,
										instructions = '$instructions',
										closed = '$_POST[wo_status2]'
										$addsql
										where
													workorderid = '$_POST[workorderid]'";
			if (!mysql_query($sql)) 
			{ 
				die('Error: ' . mysql_error());
				$data2_html = "Error while update".mysql_error(); 
			}
			
			
			
	
	
			committrans();	
		
$data = array('item1'=>$data1_html,'item2'=>$data2_html);
echo json_encode($data);
function starttrans()
{
mysql_query("START TRANSACTION");
}

function committrans()
{
mysql_query("COMMIT");
}

?>