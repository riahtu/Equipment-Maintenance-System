<?php
session_start();

require('db_ems.php');
date_default_timezone_set('Asia/Kuala_lumpur');
$now = date("YmdHis");
$today = date("Y-m-d");

$keycode =  mysql_real_escape_string($_GET[keycode]);
$description =  mysql_real_escape_string($_GET[description]);
$partnumber =  mysql_real_escape_string($_GET[partnumber]);
$refDrawing =  mysql_real_escape_string($_GET[refDrawing]);
$maker =  mysql_real_escape_string($_GET[maker]);
$remarks =  mysql_real_escape_string($_GET[remarks]);
$spgroup =  mysql_real_escape_string($_GET[spgroup]);
$sptype =  mysql_real_escape_string($_GET[sptype]);
$fs =  mysql_real_escape_string($_GET[fs]);
$safetyqty =  mysql_real_escape_string($_GET[safetyqty]);
$usageqty =  mysql_real_escape_string($_GET[usageqty]);
$critical =  mysql_real_escape_string($_GET[critical]);

starttrans();
		$sql = "update m_sparepart set keycode = '$keycode' ,
									description = '$description',
									part_number = '$partnumber',
									reference_drawing = '$refDrawing',
									maker = '$maker',
									remarks = '$remarks',
		                            barcode = '$_GET[barcode]',
									spgroup = '$spgroup',
									sptype = '$sptype',
									fs =  '$fs',
									updatetime = '$now',
									user = '$_SESSION[user]',
									safety_qty = '$safetyqty',
									usage_qty = '$usageqty',
									critical = '$critical'
									where
									sparepartid = '$_GET[sparepartid]'";
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