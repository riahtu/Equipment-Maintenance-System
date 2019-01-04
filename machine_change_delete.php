<?php
session_start();

require('db_ems.php');
date_default_timezone_set('Asia/Kuala_lumpur');
$now = date("YmdHis");
$today = date("Y-m-d");
starttrans();

$sql = "INSERT INTO m_equipment_deleted(equipmentid,description,linecode,serialno,asset_no,company,status,vendor,manufacturer,
									acquired_date,installed_date,remarks,process)
		SELECT  *
		FROM m_equipment where equipmentid = '$_GET[equipmentid]'";

if (!mysql_query($sql)) { die('Error: 1' . mysql_error()); }

$sql = "DELETE FROM m_equipment where equipmentid = '$_GET[equipmentid]'";

if (!mysql_query($sql)) { die('Error: 2' . mysql_error()); }

$sql = "DELETE FROM m_equipment_file where equipmentid = '$_GET[equipmentid]'";

if (!mysql_query($sql)) { die('Error: 3' . mysql_error()); }

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