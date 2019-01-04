<?php
session_start();
 $error_found = '';
 require('db_ems.php');
 starttrans();
 date_default_timezone_set('Asia/Kuala_lumpur');
   $now = date("YmdHis");
   $today = date("Y-m-d");
   $remarks =  mysql_real_escape_string($_POST[remarks]);
   $pv_date = $_POST[yy].'-'.$_POST[mm].'-'.$_POST[dd];
   
  
		$sqldel = "delete from t_pv_schedules where equipmentid = '$_POST[equipmentid]' 
																				 and MONTH(pv_date)  = '$_POST[mm]'
																				 and YEAR(pv_date) = '$_POST[yy]' ";
		if (!mysql_query($sqldel)) { die('Error: ' . mysql_error());$error_found = 'X'; }
   
   if ($_POST[dd] != '')
   {
		$resultpv = mysql_query("SELECT * FROM t_pv_schedules where equipmentid = '$_POST[equipmentid]' 
																				 and pv_date = '$pv_date'  ");
		if (mysql_num_rows($resultpv) == 0 )
		{   
			$sql = "INSERT INTO t_pv_schedules(equipmentid,pv_date,updatetime,userid)
				VALUES ('$_POST[equipmentid]','$pv_date','$now','$_SESSION[userid]')";
				if (!mysql_query($sql))
				{
					die('Error: t_pv_schedules ' . mysql_error()); 
					$error_found = 'X';
				}
		}
   }
   
   
 committrans();  
		
$data = array('docno'=>$new_docno,'item2'=>$data2_html,'error_found'=>$error_found);
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