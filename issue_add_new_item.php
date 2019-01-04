<?php
session_start();

 require('db_ems.php');
 date_default_timezone_set('Asia/Kuala_lumpur');
   $now = date("YmdHis");
   $today = date("Y-m-d");

	 $result = mysql_query("SELECT * from m_sparepart where barcode = '$_GET[barcode]'");
	if (!mysql_num_rows($result) == 0 )
	{
		 $description = mysql_result($result, 0, 'description');
		 $sparepartid = mysql_result($result, 0, 'sparepartid');
	}
	
	 $result2 = mysql_query("SELECT * from t_workorder where workorderid = '$_GET[workorderid]'");
	if (!mysql_num_rows($result2) == 0 )
	{
		 $company = mysql_result($result2, 0, 'company');
		 $workorder_recno = mysql_result($result2, 0, 'recno');
		 $equipmentid = mysql_result($result2, 0, 'equipmentid');
	}
		
		$sql = "INSERT INTO t_workorder_parts(company,workorder_recno,equipmentid,workorderid,sparepartid,sparepartname,barcode,orderqty,d_pickqty,createtime,createuser)
			VALUES ('$company','$workorder_recno','$equipmentid','$_GET[workorderid]','$sparepartid ','$description','$_GET[barcode]','$_GET[pickqty]','$_GET[pickqty]','$now','$_SESSION[userid]')";
			if (!mysql_query($sql)) { die('Error: ' . mysql_error()); }
			
		echo "Data added to workorder	";
function starttrans()
{
mysql_query("START TRANSACTION");
}

function committrans()
{
mysql_query("COMMIT");
}

?>