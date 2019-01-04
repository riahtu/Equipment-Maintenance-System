<?php
session_start();
require('db_ems.php');
echo "<div style='text-align:left;width:500px;font-size:20px;text-align:left;font-weight:bold;color:#404000;'>&nbsp;Print Spare Parts Stock Label";
echo "<a href='print_sp_label_a7_all.php' target='_blank'><img src='images/preview.png' border='0' title='Print All Label' /></a>";
echo "</div>";
echo "<div id='right_content_sub' >";
echo "</div>";
echo "<table border=0 style='width:900px;margin-left:5px;margin-top:10px;text-align:left;border:1px solid #525252;'>";
echo "<tr class='hlist'>";
echo "<th style='width:3px;text-align:center;'>NO</th>";
echo "<th style='width:60px;text-align:center;'>SPART ID</th>";
echo "<th style='width:350px;padding-left:3px;'>PART NO / PART NAME</th>";
//echo "<th style='width:300px;padding-left:3px;'>PART NAME</th>";
echo "<th style='width:100px;padding-left:3px;'>MAKER</th>";
echo "<th style='width:100px;padding-left:3px;'>BARCODE</th>";
echo "<th style='width:100px;padding-left:3px;'>GROUP</th>";
echo "<th style='width:50px;padding-left:3px;'>BIN</th>";
echo "<th style='width:50px;padding-left:3px;'>BAL</th>";
echo "<th style='width:20px;padding-left:3px;'>PRINT</th>";
echo "</tr>";
$no = 1;
$result1= mysql_query("SELECT * from m_sparepart_bal where bal_qty > '0' order by sparepartid"); //where sparepartid = '$_GET[sparepartid]'  
while($row1 = mysql_fetch_array($result1))
{
	$sparepartid = $row1['sparepartid'];
	$balqty = $row1['bal_qty'];
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
	
	$resultc = mysql_query("SELECT * FROM m_sparepart_loc where sparepartid = '$sparepartid' ");
	if (!mysql_num_rows($resultc) == 0 ){ $lcode = mysql_result($resultc, 0, 'locationcode');	}
	
	echo "<tr class='rollover'>";
	echo "<td style='text-align:center;'>$no</td>";
	echo "<td style='text-align:center;'>$sparepartid</td>";
	echo "<td>&nbsp;$keycode<br />&nbsp;$description</td>";
	//echo "<td>&nbsp;$description</td>";
	echo "<td style='text-align:center;'>$maker</td>";
	echo "<td style='text-align:center;'>$barcode </td>";
	echo "<td style='text-align:center;'>$spgroup </td>";
	echo "<td style='text-align:center;'>$lcode </td>";
	echo "<td style='text-align:center;'>$balqty </td>";
	echo "<td style='text-align:center;'>
			<a href='print_sp_label_a7.php?sparepartid=$row1[sparepartid]' target='_blank'>
				<img src='images/preview.png' border='0' title='Print $sp_id Label' /></a>
			</td>  ";
	echo "</tr>";
	$no++;
}
echo "</table>";


?>




