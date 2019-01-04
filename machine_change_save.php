<?php
session_start();

 require('db_ems.php');
 date_default_timezone_set('Asia/Kuala_lumpur');
   $now = date("YmdHis");
   $today = date("Y-m-d");

	$machineName =  mysql_real_escape_string($_GET[machineName]);
	$prodLine =  mysql_real_escape_string($_GET[prodLine]);
	$serialno =  mysql_real_escape_string($_GET[serialno]);
	$assetNo =  mysql_real_escape_string($_GET[assetNo]);
	$vendor =  mysql_real_escape_string($_GET[vendor]);
	$maker =  mysql_real_escape_string($_GET[maker]);
	$remarks =  mysql_real_escape_string($_GET[remarks]);
	$process =  mysql_real_escape_string($_GET[mProcess]);
	$acquiredDate =  mysql_real_escape_string($_GET[acquiredDate]);
	$installedDate =  mysql_real_escape_string($_GET[installedDate]);
	starttrans();

			$sql = "update m_equipment set
										description = '$machineName',
										linecode = '$prodLine',
										serialno = '$serialno',
										asset_no = '$assetNo',
			                            vendor = '$vendor',
										manufacturer = '$maker',
										remarks = '$remarks',
										process = '$process',
										acquired_date = '$acquiredDate',
										installed_date =  '$installedDate'
										where equipmentid = '$_GET[equipmentid]'";

			if (!mysql_query($sql)) { die('Error: ' . mysql_error()); }
			
			
			
	
	
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