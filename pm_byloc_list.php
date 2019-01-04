<?php
session_start();
require("db_ems.php");
date_default_timezone_set('Asia/Kuala_lumpur');
$current_year = date("Y");
$result = mysql_query("SELECT * from m_location where locationcode = '$_GET[locationcode]'");
if (!mysql_num_rows($result) == 0 )
{
	$equipmentdesc = mysql_result($result, 0, 'description');
	$safety_level = mysql_result($result, 0, 'safety_level');
}

echo "<table border=0 style='text-align:left;font-size:12px;font-weight:bold;height:20px;border-bottom:1px solid #616161;'>";
echo "<tr>";
echo "<td style='width:200px;height:30px;'>Location Bin</td><td style='width:470px;'>$equipmentdesc($_GET[locationcode])</td>";

echo "<td style='width:200px;height:30px;'>Safety Level</td><td>$safety_level</td></tr>";
echo "</table>";

echo "<div id='eqd_show' >";


$result1= mysql_query("SELECT * from m_sparepart_loc where locationcode = '$_GET[locationcode]' order by sparepartid");
if (!mysql_num_rows($result1) == 0 )
{
	echo "<table style='margin-top:20px;'>";
    echo "<tr>";
	echo "<td style='width:70px;font-weight:bold;'>Sparepart ID</td>";
	echo "<td style='width:250;font-weight:bold;'>Part No</td>";
	echo "<td style='width:250px;font-weight:bold;'>Part Name</td>";
	echo "<td style='width:100px;font-weight:bold;'>Maker</td>";
	echo "<td style='width:50px;font-weight:bold;text-align:left;padding-left:3px;'>Qty</td>";
	echo "<td style='width:120px;font-weight:bold;'>Closed Time</td>";
	echo "</tr>";
	
	while($row1 = mysql_fetch_array($result1))
    {
		$nn++;
		$sparepartid = $row1['sparepartid'];
		$resultd = mysql_query("SELECT * FROM m_sparepart where sparepartid = '$sparepartid' ");
		if (!mysql_num_rows($resultd) == 0) { 
			$keycode = mysql_result($resultd, 0, 'keycode');	
			$description = mysql_result($resultd, 0, 'description');	
			$maker = mysql_result($resultd, 0, 'maker');	
			$remarks = mysql_result($resultd, 0, 'remarks');	
			$spgroup = mysql_result($resultd, 0, 'spgroup');	
			$sptype = mysql_result($resultd, 0, 'sptype');	
			$barcode = mysql_result($resultd, 0, 'barcode');	
		} else {
			$keycode = '';	$description = '';	$maker = ''; $remarks = ''; $spgroup = ''; $sptype = ''; $barcode = '';
		}
		
		$resultc = mysql_query("SELECT * FROM m_sparepart_bal where sparepartid = '$sparepartid' ");
		if (!mysql_num_rows($resultc) == 0 ) { $balqty = mysql_result($resultc, 0, 'bal_qty');	}
		echo "<tr class='eqd_wo_details' sparepartid='$row1[sparepartid]'>";
		echo "<td class='eqd_wo_details' style='' > $row1[sparepartid] </td> ";
		echo "<td class='eqd_wo_details' style='text-align:left;padding-left:3px;' > $keycode </td> ";
		echo "<td class='eqd_wo_details' style='text-align:left;padding-left:3px;' > $description </td> ";
		echo "<td class='eqd_wo_details' style='' > $maker </td> ";
		echo "<td class='eqd_wo_details' style='' > $row1[bal_qty] </td> ";
		echo "<td class='eqd_wo_details' style='' > $row1[updatetime] </td> ";
		echo "</tr>";
	}
	echo "</table>";
}

else echo "<p>No record found</p>";

//echo "<div id='eqd_wo_details_show' style='margin-left:10px;'></div>";
echo "</div>";


function convertdatetime($indate)
{
	$dd = substr( $indate,8,2);
	$mm = substr( $indate,5,2);
	$yyyy = substr( $indate, 0, 4);
	$hms = substr( $indate,10,10);
	$outdatetime = $dd ."-". $mm . "-" . $yyyy. ' '.$hms;
	return $outdatetime;
}
?>