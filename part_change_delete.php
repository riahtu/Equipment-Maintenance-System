<?php
session_start();

require('db_ems.php');
date_default_timezone_set('Asia/Kuala_lumpur');
$now = date("YmdHis");
$today = date("Y-m-d");
starttrans();

$sql = "INSERT INTO m_sparepart_deleted(sparepartid,barcode,description,part_number,reference_drawing,
						keycode,maker,cost,fs,sptype,critical,life,remarks,safety_qty,usage_qty,spgroup,updatetime,status,user)
		SELECT  *
		FROM m_sparepart where sparepartid = '$_GET[sparepartid]'";

if (!mysql_query($sql)) { die('Error: 1' . mysql_error()); }

$sql = "DELETE FROM m_sparepart where sparepartid = '$_GET[sparepartid]'";

if (!mysql_query($sql)) { die('Error: 2' . mysql_error()); }

$sql = "DELETE FROM m_sparepart_file where sparepartid = '$_GET[sparepartid]'";

if (!mysql_query($sql)) { die('Error: 3' . mysql_error()); }


$sql = "update m_sparepart_deleted set updatetime = '$now' where sparepartid = '$_GET[sparepartid]'";

if (!mysql_query($sql)) {die('Error: 2' . mysql_error());}

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