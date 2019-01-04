<?php
session_start();
 require('db_ems.php');

$result1= mysql_query("SELECT * from m_equipment where equipmentid = '$_GET[equipmentid]'  ");
if (!mysql_num_rows($result1) == 0 )
{
	$description = mysql_result($result1, 0, 'description');
	$linecode = mysql_result($result1, 0, 'linecode');
	$serialno = mysql_result($result1, 0, 'serialno');
	$vendor = mysql_result($result1, 0, 'vendor');
	$manufacturer = mysql_result($result1, 0, 'manufacturer');
	$acquiredDate = mysql_result($result1, 0, 'acquired_date');
	$installedDate = mysql_result($result1, 0, 'installed_date');
	$assetNo = mysql_result($result1, 0, 'asset_no');
	$remarks = mysql_result($result1, 0, 'remarks');
	$process = mysql_result($result1, 0, 'process');

	$acquiredDate = substr($acquiredDate, 8,2).'-'.substr($acquiredDate, 5,2).'-'.substr($acquiredDate, 0,4);
	$installedDate = substr($installedDate, 8,2).'-'.substr($installedDate, 5,2).'-'.substr($installedDate, 0,4);

}
	
		echo "<span style='display:inline-block;'>";
		echo "<table border=0 style='border-radius:5px;width:98%;border:1px solid #D3D3D3;padding:5px;margin-top:5px;margin-left:10px;text-align:left;font-family:Arial;font-size:11px;height:60px;'>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Machine Name</td>";
		echo "<td><input id='machineName' value='$description'  style='width:500px;height:24px;'></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Production Line</td>";
		echo "<td style='width:200px;color:#383838;'><select id='prodLine' style='font-size:11px;color:#202000;height:30px;width:305px;'>";

			$resultrec = mysql_query("SELECT * FROM m_prodline  order by recid");
			while($row11 = mysql_fetch_array($resultrec))
			{
				echo "<option value='$row11[linecode]'>$row11[description] </option>    ";
			
			}
		echo "</td></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Serial No</td>";
		echo "<td><input id='serialno' value='$serialno' style='width:300px;height:24px;'></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Asset No</td>";
		echo "<td><input id='assetNo' value='$assetNo' style='width:300px;height:24px;'></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Vendor</td>";
		echo "<td><input id='vendor' value='$vendor' style='width:300px;height:24px;'></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Manufacturer</td>";
		echo "<td style='width:200px;color:#383838;'><select id='maker' style='font-size:11px;color:#202000;height:30px;width:305px;'>";

			$resultrec = mysql_query("SELECT * FROM m_maker order by maker");
			while($row11 = mysql_fetch_array($resultrec))
			{
				if($manufacturer == $row11[maker])
					echo "<option value='$row11[maker]' selected>$row11[maker]</option> ";
				else
					echo "<option value='$row11[maker]'>$row11[maker]</option> ";
			}
		echo "</td></tr>";


		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Remarks</td>";
		echo "<td><textarea id='remarks'  style='font-family:Arial;font-size:12px;'  rows='5' cols='80'>$remarks</textarea></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Process</td>";
		echo "<td><textarea id='process' ' style='font-family:Arial;font-size:12px;' rows='5' cols='80'>$process</textarea></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Acquired date</td>";
		echo "<td><input  type='text' class='get_date' id='acquiredDate' value='$acquiredDate' style='width:100px;height:24px;'></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Installed Date</td>";
		echo "<td><input  type='text' class='get_date' id='installedDate' value='$installedDate' style='width:100px;height:24px;'></tr>";
		echo "</table>";
		echo "</span>";

	    echo "<table style='margin-top:30px;margin-left:100px;'>";
		echo "<tr>";
		echo "<td style='padding-left:10px;'><button id='machine_change_save' equipmentid='$_GET[equipmentid]' style='width:100px;height:30px;'>Save</button>";
		
		if($_SESSION[role] == 'ADMIN' || $_SESSION[userid] == '8888')
			echo "<td style='padding-left:10px;'><button id='machine_change_delete' equipmentid='$_GET[equipmentid]'   style='width:110px;height:30px;'>Delete Machine</button></tr>";
		echo "</table>";
	
?>