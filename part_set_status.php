<?php
session_start();

require('db_ems.php');
date_default_timezone_set('Asia/Kuala_lumpur');
$now = date("YmdHis");
$today = date("Y-m-d");
starttrans();

$sql = "update m_sparepart set status = 'A'";

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