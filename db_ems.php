<?php
$serverhost = "localhost";
$serveruser = "root";
$serverpwd  = "";
$dbname2     = "ems_sai";
$con = mysql_connect($serverhost,$serveruser,$serverpwd);
mysql_select_db($dbname2,$con);
$n = 0;
global $a_type2;
?>
