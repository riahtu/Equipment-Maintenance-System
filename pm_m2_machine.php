<?php
session_start();
 require('db_ems.php');
echo "<div style='margin-top:10px;text-align:left;width:80%;font-size:14px;text-align:left;font-weight:bold;color:#404000;'>Add New Machine</div>";
session_start();
 require('db_ems.php');

		$today = date('d-m-Y');	
		echo"<form id='formMachine' method='POST' action='master_machine_addx.php' enctype = 'multipart/form-data' > ";
		echo "<table border=0 style='border-radius:5px;width:98%;border:1px solid #D3D3D3;padding:5px;margin-top:5px;margin-left:10px;text-align:left;font-family:Arial;font-size:11px;height:60px;'>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Machine Name</td>";
		echo "<td><input id='machine_name' name='machineName' value='$machine_name' style='width:500px;height:24px;'></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Production Line</td>";
		echo "<td style='width:200px;color:#383838;'><select id='prodline' name='prodLine' style='font-size:11px;color:#202000;height:30px;width:305px;'>";
				echo "<option selected disabled hidden value=''>Choose Production Line</option>";
			$resultrec = mysql_query("SELECT * FROM m_prodline  order by recid");
			while($row11 = mysql_fetch_array($resultrec))
			{
				echo "<option value='$row11[linecode]'>$row11[description] </option>    ";
			
			}
		echo "</td></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Serial No</td>";
		echo "<td><input id='serialno' name='serialno' value='$serialno' style='width:300px;height:24px;'></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Asset No</td>";
		echo "<td><input id='assetNo' name='assetNo' value='$assetNo' style='width:300px;height:24px;'></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Vendor</td>";
		echo "<td><input id='vendor' name='vendor' value='$vendor' style='width:300px;height:24px;'></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Manufacturer</td>";
		echo "<td style='width:200px;color:#383838;'><select id='maker' name='maker' style='font-size:11px;color:#202000;height:30px;width:305px;'>";
			echo "<option selected disabled hidden value=''>Choose Manufacturer</option>";
			$resultrec = mysql_query("SELECT * FROM m_maker order by maker");
			while($row11 = mysql_fetch_array($resultrec))
			{
				echo "<option value='$row11[maker]'>$row11[maker]</option>";
			
			}
		echo "</td></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Remarks</td>";
		echo "<td><textarea id='remarks' name='remarks' style='font-family:Arial;font-size:12px;'  rows='5' cols='80'></textarea></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Process</td>";
		echo "<td><textarea id='process' name='mProcess' style='font-family:Arial;font-size:12px;' rows='5' cols='80'></textarea></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Acquired date</td>";
		echo "<td><input  type='text' class='get_date' id='acquired_date' name=acquiredDate value='$today' style='width:100px;height:24px;'>";
		echo "<span style='width:100px;padding-left:50px;color:#383838;'>Choose an Image To Upload</span></td></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Installed Date</td>";
		echo "<td><input  type='text' class='get_date' id='installed_date' name='installedDate' value='$today' style='width:100px;height:24px;'>";

		//Image upload
		echo "<span style='padding-left:50px';><input type='file' id='checkImage' name='imageUpload' value='' style='width:300px;height:24px;'></span></td></tr>";
		
		echo "</table>";
		echo "</form>";
		
	    echo "<table style='margin-top:30px;margin-left:100px;'>";
		echo "<tr>";
		echo "<td style='width:100px;'></td>";
		echo "<td><button id='master_machine_save' style='width:100px;height:30px;'>Save</button></tr>";
		echo "</table>";
?>