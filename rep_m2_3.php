<?php

session_start();
 date_default_timezone_set('Asia/Kuala_lumpur');
   $now = date("YmdHis");
   $today = date("Y-m-d");
    $cyear = date("Y");
 require('db_ems.php');
echo "<div style='margin-top:20px;text-align:left;color:#007CB9;font-weight:bold;'>Selections : Machine Preventive Maintenance Listing </div>";

		
	echo "<table border=0 style='border-radius:5px;width:98%;border:1px solid #D3D3D3;padding:5px;margin-top:5px;margin-left:10px;text-align:left;font-family:Arial;font-size:11px;height:60px;'>";
		
		//echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Company</td>";
		//echo "<td><input id='rep_s_company' value='' style='width:300px;height:24px;'></tr>";
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Machine Name</td>";
		echo "<td><input id='rep_s_description' value='' style='width:300px;height:24px;'></tr>";
		//echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Machine Id</td>";
		//echo "<td><input id='rep_s_equipmentid' value='' style='width:300px;height:24px;'></tr>";
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Linecode</td>";
		echo "<td><input id='rep_s_linecode' value='' style='width:300px;height:24px;'></tr>";
		//echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Barcode</td>";
		//echo "<td><input id='rep_s_barcode' value='' style='width:300px;height:24px;'></tr>";
		//echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Maker</td>";
		//echo "<td><input id='rep_s_maker' value='' style='width:300px;height:24px;'></tr>";
					
		echo "</td></tr>";
		
		echo "</table>";
		
	    echo "<table style='margin-top:30px;margin-left:100px;'>";
		echo "<tr>";
		echo "<td style='width:100px;'></td>";
		echo "<td><button id='rep_m2_3_execute' program='rep_m2_3_rpt.php' sparepartid='$_GET[sparepartid]' style='width:100px;height:30px;'>Execute</button></tr>";
		echo "</table>";
		
		
		


?>