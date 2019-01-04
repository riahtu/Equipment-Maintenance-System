<?php

session_start();
 date_default_timezone_set('Asia/Kuala_lumpur');
   $now = date("YmdHis");
   $today = date("Y-m-d");$today2 = date("d-m-Y");
   $cyear = date("Y");
 require('db_ems.php');
echo "<div style='margin-top:20px;text-align:left;color:#007CB9;font-weight:bold;'>Parts Balance </div>";
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
	echo "<table border=0 style='border-radius:5px;width:50%;border:0px solid #D3D3D3;padding:5px;margin-top:5px;margin-left:10px;text-align:left;font-family:Arial;font-size:11px;height:60px;'>";
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Start Date</td>";
		echo "<td><input  type='text' class='get_date' id='rep_s_date_from' value='$startdate' style='width:100px;height:24px;'></tr>";
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>To Date</td>";
		echo "<td><input  type='text' class='get_date' id='rep_s_date_to' value='$today2' style='width:100px;height:24px;'><td><button id='rep_m3_1_execute' program='rep_m3_1_rpt.php' sparepartid='$_GET[sparepartid]' style='width:100px;height:30px;'>List All</button></td></tr>";
		echo"</tr>";
	echo "</table>";

	echo "<p style='font-size:12px;' >Enter your selection in the field below</p>";

	echo "<table style='margin-left:5px;margin-top:10px;text-align:left;border:1px solid #525252;'>";
		echo "<tr><td style='width:300px;padding-left:3px;'>Part Name</td>";
		echo "<td style='width:100px;text-align:center;'>Sparepart id</td>";
		echo "<td style='width:200px;padding-left:3px;'>Maker</td>";
		echo "<td style='width:100px;padding-left:3px;'>Barcode</td>";
		echo "<td style='width:100px;padding-left:3px;'>Group</td>";
		echo "</tr>";
		echo "<tr><td style='width:100px;'><input id='pb_partname' type='text' style='padding-left:3px;width:300px;height:20px;'/> </td>";
		echo "<td style='width:100px;'><input id='pb_sparepartid' type='text' style='text-align:center;width:100px;height:20px;'/> </td>";
		echo "<td style='width:100px;'><input id='pb_maker' type='text' style='padding-left:3px;width:200px;height:20px;'/> </td>";
		echo "<td style='width:100px;'><input id='pb_barcode' type='text' style='padding-left:3px;width:100px;height:20px;'/> </td>";
		echo "<td style='width:100px;'><input id='pb_spgroup' type='text' style='padding-left:3px;width:100px;height:20px;'/> </td>";
		echo "</tr>";
	echo "</table>";

		echo "<div id='search_result_master' style='margin-left:5px;'>";

		echo "</div>";
?>