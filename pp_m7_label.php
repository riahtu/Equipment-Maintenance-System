<?php
session_start();
require('db_ems.php');
echo "<div style='text-align:left;width:500px;font-size:20px;text-align:left;font-weight:bold;color:#404000;'>&nbsp;Print Spare Parts Stock Label";
echo "<a href='print_sp_label_a7_all.php' target='_blank'><img src='images/preview.png' border='0' title='Print All Label' /></a>";
echo "<a href='print_sp_bylocation1.php' target='_blank'><img src='images/preview.png' border='0' title='Print Summary' /></a>";
echo "</div>";
echo "<div id='right_content_sub' >";
echo "</div>";
echo "<table border=0 style='width:900px;margin-left:5px;margin-top:10px;text-align:left;border:1px solid #525252;'>";

$no = 1;
$result1= mysql_query("SELECT distinct locationcode from m_sparepart_loc order by locationcode"); //where sparepartid = '$_GET[sparepartid]'  
while($row1 = mysql_fetch_array($result1))
{
	$locationcode = $row1['locationcode'];
	echo "<tr>";
	echo "<td colspan='3' style='text-align:left;font-size:14px;font-weight:bold;'>&nbsp;LOCATION #$no</td>";
	echo "<td colspan='1' style='text-align:left;font-size:14px;font-weight:bold;'>&nbsp;BIN CODE : </td>";
	echo "<td colspan='2' style='text-align:left;font-size:14px;font-weight:bold;'>&nbsp;$locationcode</td>";
	echo "</tr>";
	echo "<tr class='hlist'>";
	echo "<th style='width:3px;text-align:center;'>NO</th>";
	echo "<th style='width:60px;text-align:center;'>SPART ID</th>";
	echo "<th style='width:350px;padding-left:3px;'>PART NO / PART NAME</th>";
	echo "<th style='width:100px;padding-left:3px;'>MAKER</th>";
	echo "<th style='width:100px;padding-left:3px;'>QUANTITY</th>";
	echo "<th style='width:20px;padding-left:3px;'>PRINT</th>";
	echo "</tr>";
	$noa = 1;
	$resulte = mysql_query("SELECT * FROM m_sparepart_loc where locationcode = '$locationcode' order by sparepartid");
	while ($row2 = mysql_fetch_array($resulte))
	{
		$sparepartid = $row2['sparepartid'];
		$resultd = mysql_query("SELECT * FROM m_sparepart where sparepartid = '$sparepartid' ");
		if (!mysql_num_rows($resultd) == 0 ) { 
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
		
		echo "<tr class='rollover'>";
		echo "<td style='text-align:center;'>$noa</td>";
		echo "<td style='text-align:center;'>$sparepartid</td>";
		echo "<td>&nbsp;$keycode<br />&nbsp;$description</td>";
		echo "<td style='text-align:center;'>$maker</td>";
		echo "<td style='text-align:center;'>$balqty </td>";
		echo "<td style='text-align:center;'>
				<a href='print_sp_label_a7.php?sparepartid=$row2[sparepartid]' target='_blank'>
					<img src='images/preview.png' border='0' title='Print $sp_id Label' /></a>
				</td>  ";
		echo "</tr>";
		$noa++;
	} 
	$no++;
}
echo "</table>";


?>




