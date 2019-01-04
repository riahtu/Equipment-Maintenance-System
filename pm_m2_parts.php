<?php
session_start();
 require('db_ems.php');
echo "<div style='margin-top:10px;text-align:left;width:80%;font-size:14px;text-align:left;font-weight:bold;color:#404000;'>Register New Sparepart</div>";
session_start();
 require('db_ems.php');

 		$resultmax = mysql_query("SELECT sparepartid FROM m_sparepart where sparepartid=(SELECT MAX(sparepartid) FROM m_sparepart) ");
 		list($max) = mysql_fetch_row($resultmax);
		
		echo"<form id='formPart' method='POST' action='master_part_addx.php' enctype = 'multipart/form-data' > ";
		echo "<table border=0 style='border-radius:5px;width:98%;border:1px solid #D3D3D3;padding:5px;margin-top:5px;margin-left:10px;text-align:left;font-family:Arial;font-size:11px;height:60px;'>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Keycode</td>";
		echo "<td><input id='keycode' name='keycode' value='$keycode' style='width:500px;height:24px;'></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Part Name / Description</td>";
		echo "<td><input id='description' name='description' value='$description' style='width:500px;height:24px;'></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Part Number</td>";
		echo "<td><input id='partnumber' name='partnumber' value='$partnumber' style='width:300px;height:24px;'></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Reference Drawing</td>";
		echo "<td><input id='refDrawing' name='refDrawing' value='$refDrawing' style='width:300px;height:24px;'></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Manufacturer</td>";
		echo "<td style='width:200px;color:#383838;'><select id='maker' name='maker' style='font-size:11px;color:#202000;height:30px;width:305px;'>";
				echo "<option selected disabled hidden value=''>Choose Manufacturer</option>";
			$resultrec = mysql_query("SELECT * FROM m_maker order by maker");
			while($row11 = mysql_fetch_array($resultrec))
			{
				echo "<option value='$row11[maker]'>$row11[maker]</option>    ";
			
			}
		echo "</td></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Remarks</td>";
		echo "<td><input id='remarks' name='remarks' value='$remarks' style='width:300px;height:24px;'></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Group</td>";
		echo "<td><input id='spgroup' name='spgroup' value='$spgroup' style='width:300px;height:24px;'></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Machine</td>";
		echo "<td style='width:200px;color:#383838;'><select id='equipment' name='equipment' style='font-size:11px;color:#202000;height:30px;width:305px;'>";
				echo "<option selected disabled hidden value=''>Choose Machine</option>";
			$resultrec = mysql_query("SELECT * FROM m_equipment  order by equipmentid");
			while($row11 = mysql_fetch_array($resultrec))
			{
				echo "<option value='$row11[equipmentid]'>$row11[description] | Line: $row11[linecode]</option>    ";
			
			}
		echo "</td></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Safety Quantity</td>";
		echo "<td><input id='safetyqty' name='safetyqty' value='0' style='width:75px;height:24px;'>";
		echo "<span style='width:100px;padding-left:50px;color:#383838;'>Choose an Image To Upload</span></td></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Usage Quantity</td>";
		echo "<td><input id='usageqty' name='usageqty' value='0' style='width:75px;height:24px;'>";

		//Image Upload
		echo "<span style='padding-left:50px';><input type='file' id='checkImage' name='imageUpload' value='' style='width:300px;height:24px;'></span></td></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Life (hours)</td>";
		echo "<td><input id='life' name='life' value='0' style='width:75px;height:24px;' ></tr>";
		
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Type</td>";
		echo "<td style='width:100px;color:#383838;'><select id='sptype' name='sptype' style='font-size:11px;color:#202000;height:30px;width:80px;'>";

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
		echo "<td style='width:100px;color:#383838;'><select id='fs' name='fs' style='font-size:11px;color:#202000;height:30px;width:80px;'>";
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

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Critical</td>";
		echo "<td style='width:100px;color:#383838;'><select id='critical' name='critical' style='font-size:11px;color:#202000;height:30px;width:80px;'>";
			echo  "<option value='critical' selected >Critical</option>";
			echo  "<option value='non-critical' selected >Non Critical</option>";
		echo "</td></tr>";
		
		echo "</table>";
		echo "</form>";
	    echo "<table style='margin-top:30px;margin-left:100px;'>";
		echo "<tr>";
		echo "<td style='width:100px;'></td>";
		echo "<td><button id='master_part_save' max='$max' style='width:100px;height:30px;'>Save</button></tr>";
		echo "</table>";

?>