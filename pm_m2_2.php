<?php

session_start();
 require('db_ems.php');
echo "<div style='margin-top:20px;text-align:left;color:#007CB9;font-weight:bold;'>Bin Location for sp#$_GET[sparepartid]</div>";
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

echo "<div style='height:20px;font-size:10px;color:#FF8000;font-weight:bold;text-align:left;'>Description : $description</div>";
echo "<table id='pm_location' border=0 style='margin-top:10px;border-radius:5px;border:1px solid #D3D3D3;padding:5px;margin-left:100px;text-align:left;font-family:Arial;font-size:11px;height:60px;'>";

			
$result2 = mysql_query("SELECT * from m_sparepart_location where sparepartid =  '$_GET[sparepartid]' 
														 ");
if (!mysql_num_rows($result2) == 0 )
{
$cn = 0;
	while($row2 = mysql_fetch_array($result2))
    {
		$cn++;
		echo "<tr><td><input class='locationcode' value='$row2[locationcode]' style='width:100px;height:24px;text-align:center;text-transform: uppercase;border:1px solid #408080;'></tr>";
	
	}
	
	
}
for ($i = $cn; $i <= 5; $i += 1)
	{
	
	echo "<tr><td><input class='locationcode' value='' style='width:100px;height:24px;text-align:center;text-transform: uppercase;border:1px solid #408080;'></tr>";
	
	}
echo "</table>";	
	    echo "<table style='margin-top:30px;margin-left:10px;'>";
		echo "<tr>";
		echo "<td><button id='part_change_location_cancel'  style='width:100px;height:30px;'>Cancel</button>";
		echo "<td style='width:90px;'></td>";
		echo "<td><button id='part_change_location_save' sparepartid='$_GET[sparepartid]' style='width:100px;height:30px;'>Save</button></tr>";
		echo "</table>";
	
?>