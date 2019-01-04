<?php

session_start();
 date_default_timezone_set('Asia/Kuala_lumpur');
   $now = date("YmdHis");
   $today = date("Y-m-d");$today2 = date("d-m-Y");
   $cyear = date("Y");
 require('db_ems.php');
echo "<div style='margin-top:20px;text-align:left;color:#007CB9;font-weight:bold;'>Parts Life Monitoring </div>";
/*$result1= mysql_query("SELECT * from m_sparepart where sparepartid = '$_GET[sparepartid]'  ");
if (!mysql_num_rows($result1) == 0 )
{
	$keycode = mysql_result($result1, 0, 'keycode');
	$description = mysql_result($result1, 0, 'description');
	$barcode = mysql_result($result1, 0, 'barcode');
	$maker = mysql_result($result1, 0, 'maker');
	$remarks = mysql_result($result1, 0, 'remarks');
	$spgroup = mysql_result($result1, 0, 'spgroup');
	$sptype = mysql_result($result1, 0, 'sptype');
	$fs = mysql_result($result1, 0, 'fs');
}*/
 $startdate = date("d-m-Y", strtotime($today));
  if ($startdate == $today2 )
  {
    $startdate =  date("d-m-Y", strtotime("first day of previous month"));
  }
	echo "<table border=0 style='border-radius:5px;width:50%;border:1px solid #D3D3D3;padding:5px;margin-top:5px;margin-left:10px;text-align:left;font-family:Arial;font-size:11px;height:60px;'>";
		
		
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Start Date</td>";
		echo "<td><input  type='text' class='get_date' id='rep_s_date_from' value='$startdate'  style='width:100px;height:24px;'></tr>";
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>To Date</td>";
		echo "<td><input  type='text' class='get_date' id='rep_s_date_to' value='$today2'   style='width:100px;height:24px;'></tr>";
		//echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Linecode</td>";
		//echo "<td><input id='rep_s_linecode' value='' style='width:300px;height:24px;'>
		echo"</tr>";
		
		
		echo "</table>";
		
	    echo "<table style='margin-top:30px;margin-left:100px;'>";
		echo "<tr>";
		echo "<td style='width:100px;'></td>";
		echo "<td><button id='rep_m3_1_execute' program='rep_m3_2_rpt.php' sparepartid='$_GET[sparepartid]' style='width:100px;height:30px;'>Execute</button></tr>";
		echo "</table>";
		
		
		


?>