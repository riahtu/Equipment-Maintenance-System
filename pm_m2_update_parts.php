<?php
session_start();
 require('db_ems.php');


$result1= mysql_query("SELECT * from m_sparepart where sparepartid = '$_GET[sparepartid]'  ");
if (!mysql_num_rows($result1) == 0 )
{
	$keycode = mysql_result($result1, 0, 'keycode');
	$description = mysql_result($result1, 0, 'description');
	$maker = mysql_result($result1, 0, 'maker');
	$remarks = mysql_result($result1, 0, 'remarks');
	$spgroup = mysql_result($result1, 0, 'spgroup');
	$sptype = mysql_result($result1, 0, 'sptype');
	$barcode = mysql_result($result1, 0, 'barcode');
	$fs = mysql_result($result1, 0, 'fs');
	$partNumber = mysql_result($result1, 0, 'part_number');
	$refDrawing = mysql_result($result1, 0, 'reference_drawing');
	$safetyqty = mysql_result($result1, 0, 'safety_qty');
	$usageqty = mysql_result($result1, 0, 'usage_qty');
	$critical = mysql_result($result1, 0, 'critical');
}
		echo "<span style='display:inline-block;'>";
		echo "<table border=0 style='border-radius:5px;width:98%;border:1px solid #D3D3D3;padding:5px;margin-top:5px;margin-left:10px;text-align:left;font-family:Arial;font-size:11px;height:60px;'>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Keycode</td>";
		echo "<td><input id='keycode' value='$keycode' style='width:500px;height:24px;'></tr>";
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Description</td>";
		echo "<td><input id='description' value='$description' style='width:500px;height:24px;'></tr>";
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Part Number</td>";
		echo "<td><input id='partNumber' value='$partNumber' style='width:300px;height:24px;'></tr>";
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Reference Drawing</td>";
		echo "<td><input id='refDrawing' value='$refDrawing' style='width:300px;height:24px;'></tr>";
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Manufacturer</td>";
		echo "<td style='width:100px;color:#383838;'><select id='maker' style='font-size:11px;color:#202000;height:30px;width:80px;'>";

		$resultrec = mysql_query("SELECT * FROM m_maker  order by maker");
			while($row11 = mysql_fetch_array($resultrec))
			{
				if ( $maker == $row11[maker] ) {
				echo  "<option value='$row11[maker]' selected >$row11[maker]</option>    ";
				} else {
				echo "<option value='$row11[maker]'>$row11[maker] </option>    ";
				}  
			}
		echo "</td></tr>";
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Remarks</td>";
		echo "<td><input id='remarks' value='$remarks' style='width:300px;height:24px;'></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Group</td>";
		echo "<td><input id='spgroup' value='$spgroup' style='width:300px;height:24px;'></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Barcode</td>";
		echo "<td><input id='barcode' value='$barcode' style='width:300px;height:24px;' disabled></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Type</td>";
		echo "<td style='width:100px;color:#383838;'><select id='sptype' style='font-size:11px;color:#202000;height:30px;width:80px;'>";
			$resultrec = mysql_query("SELECT * FROM m_sparepart_type  order by seqno");
			while($row11 = mysql_fetch_array($resultrec))
			{
				if ( $sptype == $row11[sptype] ) {
				echo  "<option value='$row11[sptype]' selected >$row11[description]</option>    ";
				} else {
				echo "<option value='$row11[sptype]'>$row11[description] </option>    ";
				}  
			}
		echo "</td></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Fast/Slow</td>";
		echo "<td style='width:100px;color:#383838;'><select id='fs' style='font-size:11px;color:#202000;height:30px;width:80px;'>";
			$resultrec = mysql_query("SELECT * FROM m_sparepart_fs  order by seqno");
			while($row11 = mysql_fetch_array($resultrec))
			{
				if ( $fs == $row11[fs] ) {
				echo  "<option value='$row11[fs]' selected >$row11[description]</option>    ";
				} else {
				echo "<option value='$row11[fs]'>$row11[description] </option>    ";
				}  
			}
		echo "</td></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Safety Quantity</td>";
		echo "<td><input id='safetyqty' value='$safetyqty' style='width:75px;height:24px;' ></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Usage Quantity</td>";
		echo "<td><input id='usageqty' value='$usageqty' style='width:75px;height:24px;' ></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Critical</td>";
		echo "<td style='width:100px;color:#383838;'><select id='critical' name='critical' style='font-size:11px;color:#202000;height:30px;width:80px;'>";
			if($critical == 'X'){
				echo  "<option value='critical' selected>Critical</option>";
				echo  "<option value='Non Critical' >Non Critical</option>";
			}	
			else{
				echo  "<option value='Non Critical' selected >Non Critical</option>";
				echo  "<option value='critical' >Critical</option>";
			}
		echo "</td></tr>";
		echo "</table>";
		echo "</span>";


	    echo "<table style='margin-top:30px;margin-left:100px;'>";
		echo "<tr>";
		echo "<td><button id='part_change_save' sparepartid='$_GET[sparepartid]' style='padding-left:10px;width:100px;height:30px;'>Save</button>";
		
		if($_SESSION[role] == 'ADMIN' || $_SESSION[userid] == '8888')
			echo "<td><button id='part_change_delete' sparepartid='$_GET[sparepartid]' style='padding-left:10px;width:100px;height:30px;'>Delete Part</button></tr>";
		echo "</table>";

		
	
?>