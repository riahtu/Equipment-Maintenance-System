<?php
session_start();
 require('db_ems.php');
//echo "<div style='margin-top:10px;text-align:left;width:80%;font-size:14px;text-align:left;font-weight:bold;color:#404000;'>Print Sparepart Label</div>";
echo "<table border=0 style='width:900px;margin-left:5px;margin-top:10px;text-align:left;border:1px solid #525252;'>";
echo "<tr class='hlist'>";
echo "<th style='width:60px;text-align:center;'>SPART ID</th>";
echo "<th style='width:350px;padding-left:3px;'>PART NO / PART NAME</th>";
//echo "<th style='width:300px;padding-left:3px;'>PART NAME</th>";
echo "<th style='width:100px;padding-left:3px;'>MAKER</th>";
echo "<th style='width:100px;padding-left:3px;'>BARCODE</th>";
echo "<th style='width:100px;padding-left:3px;'>GROUP</th>";
echo "<th style='width:50px;padding-left:3px;'>BIN</th>";
echo "<th style='width:50px;padding-left:3px;'>BAL-QTY</th>";
echo "<th style='width:20px;padding-left:3px;'>PRINT</th>";
echo "</tr>";
/*
echo "<tr><td style='width:100px;'><input id='pm_s_m_partname' type='text' style='padding-left:3px;width:300px;height:20px;'/> </td>";
echo "<td style='width:100px;'><input id='pm_s_m_sparepartid' type='text' style='text-align:center;width:100px;height:20px;'/> </td>";
echo "<td style='width:100px;'><input id='pm_s_m_maker' type='text' style='padding-left:3px;width:200px;height:20px;'/> </td>";
echo "<td style='width:100px;'><input id='pm_s_m_barcode' type='text' style='padding-left:3px;width:100px;height:20px;'/> </td>";
echo "<td style='width:100px;'><input id='pm_s_m_spgroup' type='text' style='padding-left:3px;width:100px;height:20px;'/> </td>";
echo "</tr>";
*/
$result1= mysql_query("SELECT * from m_sparepart order by sparepartid"); //where sparepartid = '$_GET[sparepartid]'  
while($row1 = mysql_fetch_array($result1))
{
	$sparepartid = $row1['sparepartid'];
	$keycode = $row1['keycode'];
	$description = $row1['description'];
	$maker = $row1['maker'];
	$remarks = $row1['remarks'];
	$spgroup = $row1['spgroup'];
	$sptype = $row1['sptype'];
	$barcode = $row1['barcode'];
	//$sp_id = 'SP-'.sprintf('%04d', $sparepartid);
	
	$resultc = mysql_query("SELECT * FROM m_sparepart_loc where sparepartid = '$sparepartid' ");
	if (!mysql_num_rows($resultc) == 0 ){ $lcode = mysql_result($resultc, 0, 'locationcode');	}
	
	$resultd = mysql_query("SELECT * FROM m_sparepart_bal where sparepartid = '$sparepartid' ");
	if (!mysql_num_rows($resultd) == 0 ){ $balqty = mysql_result($resultd, 0, 'bal_qty');	}
	
	echo "<tr class='rollover'>";
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
}
echo "</table>";

//echo "<div id='pm_search_result_masterall' style='margin-left:5px;tex-align:center;margin-top:20px;'>Enter your selection in fields above.</div>";

echo "</div>";
?>