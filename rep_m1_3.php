<?php

session_start();
 date_default_timezone_set('Asia/Kuala_lumpur');
   $now = date("YmdHis");
   $today = date("Y-m-d");
    $cyear = date("Y");
 require('db_ems.php');
echo "<div style='margin-top:20px;text-align:left;color:#007CB9;font-weight:bold;'>Selections : Sparepart without Location Bin </div>";
$result1= mysql_query("SELECT * from m_sparepart where sparepartid = '$_GET[sparepartid]'  ");
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
}
		
	echo "<table border=0 style='border-radius:5px;width:98%;border:1px solid #D3D3D3;padding:5px;margin-top:5px;margin-left:10px;text-align:left;font-family:Arial;font-size:11px;height:60px;'>";
		
		//echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Company</td>";
		//echo "<td><input id='rep_s_company' value='' style='width:300px;height:24px;'></tr>";
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Sparepart Name</td>";
		echo "<td><input id='rep_s_sparepartname' value='' style='width:300px;height:24px;'></tr>";
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Barcode</td>";
		echo "<td><input id='rep_s_barcode' value='' style='width:300px;height:24px;'></tr>";
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Maker</td>";
		echo "<td><input id='rep_s_maker' value='' style='width:300px;height:24px;'></tr>";
		
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Supplier</td>";
		echo "<td style='width:100px;color:#383838;'><select id='rep_s_supplierid' style='font-size:11px;color:#202000;height:30px;width:400px;'>";
			$resultrec = mysql_query("SELECT * FROM m_supplier where status = ''  order by description");
			if (!mysql_num_rows($resultrec) == 0 )
			{
				echo "<option value=''> </option>    ";
				while($row11 = mysql_fetch_array($resultrec))
				{
					echo "<option value='$row11[supplierid]'>$row11[description] </option>    ";
					
				}
			}
		echo "</td></tr>";
		
		echo "</table>";
		
	    echo "<table style='margin-top:30px;margin-left:100px;'>";
		echo "<tr>";
		echo "<td style='width:100px;'></td>";
		echo "<td><button id='rep_m1_1_execute' program='rep_m1_3_rpt.php' sparepartid='$_GET[sparepartid]' style='width:100px;height:30px;'>Execute</button></tr>";
		echo "</table>";
		
		
		


?>