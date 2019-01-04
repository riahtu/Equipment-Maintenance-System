<?php

session_start();
 date_default_timezone_set('Asia/Kuala_lumpur');
   $now = date("YmdHis");
   $today = date("Y-m-d");$today2 = date("d-m-Y");
   $cyear = date("Y");
 require('db_ems.php');
echo "<div style='margin-top:20px;text-align:left;color:#007CB9;font-weight:bold;'>Stock Card</div>";

echo "<div id='parts_master_show' style='margin-top:10px;'>";
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
//	echo "<table border=0 style='border-radius:5px;width:98%;border:1px solid #D3D3D3;padding:5px;margin-top:5px;margin-left:10px;text-align:left;font-family:Arial;font-size:11px;height:60px;'>";
		echo "<div style='margin-top:10px;text-align:left;width:80%;font-size:14px;text-align:left;font-weight:bold;color:#404000;'>Search Parts</div>";
		
		echo "<table>";
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Start Date</td>";
		echo "<td><input  type='text' class='get_date' id='sc_s_date_from' value='$startdate'style='width:100px;height:24px;'></td</tr>";
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>To Date</td>";
		echo "<td><input  type='text' class='get_date' id='sc_s_date_to' value='$today2'style='width:100px;height:24px;'></td></tr>";
		echo"</tr><tr></tr>";
		echo "</table>";
		echo "<div style='margin-top:5px;text-align:left;color:red;font-weight:bold;'>*choose parts to view stock card</div>";
		echo "<table style='margin-left:5px;margin-top:10px;text-align:left;border:1px solid #525252;'>";
		echo "<tr><td style='width:300px;padding-left:3px;'>Part Name</td>";
		echo "<td style='width:100px;text-align:center;'>Sparepart id</td>";
		echo "<td style='width:200px;padding-left:3px;'>Maker</td>";
		echo "<td style='width:100px;padding-left:3px;'>Barcode</td>";
		echo "<td style='width:100px;padding-left:3px;'>Group</td>";
		echo "</tr>";
		echo "<tr><td style='width:100px;'><input id='sc_s_m_partname' type='text' style='padding-left:3px;width:300px;height:20px;'/> </td>";
		echo "<td style='width:100px;'><input id='sc_s_m_sparepartid' type='text' style='text-align:center;width:100px;height:20px;'/> </td>";
		echo "<td style='width:100px;'><input id='sc_s_m_maker' type='text' style='padding-left:3px;width:200px;height:20px;'/> </td>";
		echo "<td style='width:100px;'><input id='sc_s_m_barcode' type='text' style='padding-left:3px;width:100px;height:20px;'/> </td>";
		echo "<td style='width:100px;'><input id='sc_s_m_spgroup' type='text' style='padding-left:3px;width:100px;height:20px;'/> </td>";
		echo "</tr>";
		echo "</table>";

echo "<div id='sc_search_result_master' style='margin-left:5px;'>Enter your selection in fields above.</div>";

echo "</div>";
		
		
/*		echo "</table>";
	    echo "<table style='margin-top:30px;margin-left:100px;'>";
		echo "<tr>";
		echo "<td style='width:100px;'></td>";
		echo "<td><button id='rep_m3_1_execute' program='rep_m3_2_rpt.php' sparepartid='$_GET[sparepartid]' style='width:100px;height:30px;'>Execute</button></tr>";
		echo "</table>";
*/		
		
		


?>