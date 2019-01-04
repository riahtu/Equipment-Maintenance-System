<?php
require("db_ems.php");
session_start();
date_default_timezone_set('Asia/Kuala_lumpur');
$now = date("YmdHis");
$year = date("Y");
$result1= mysql_query("SELECT * from t_workorder where workorderid = '$_GET[workorderid]'");
if (!mysql_num_rows($result1) == 0 )
{
	
	while($row1 = mysql_fetch_array($result1))
    {
		$wo_type = $row1[wo_type];
		$wo_recno = $row1[recno];
		$equipmentid = $row1[equipmentid];
		$problem = $row1[problem];
		$instructions = $row1[instructions];
		$remarks = $row1[remarks];
		$pv_schedule_recno = $row1[pv_schedule_recno];
		$result11= mysql_query("SELECT * from m_equipment where equipmentid = '$row1[equipmentid]'");
		if (!mysql_num_rows($result11) == 0 )
		{
			while($row11 = mysql_fetch_array($result11))
			{
			  $linecode = $row11[linecode];
			}
		}
	
	}
}
//echo "<div id='test1' style='position:relative;top:100px;left:300px;width:300px;height:300px;z-index:1000;border:1px solid #004000;'></div>";
echo "<div id='workorder_new' style='position:relative;top:0px;left:0px;width:1000px;min-height:300px;'>";
echo "<table style='margin-top:20px;'>";
echo "<tr><td style='width:900px;text-align:left;font-weight:bold;font-size:12px;top:20px;'>Requisition Details : #$_GET[workorderid]</td><td> </td></tr>";
echo "</table>";

echo "<input type='hidden' id='workorderid' value='$_GET[workorderid]'/>";
echo "<input type='hidden' id='wo_recno' value='$wo_recno'/>";

echo "<table style='text-align:left;margin-top:10px;'>";
echo "<tr><td style='width:150px;'>Requisition Type</td><td>$wo_type</td></tr>";
echo "<tr><td style='width:150px;'>Production Line</td><td>$equipmentid</td></tr>";
echo "<tr><td style='width:150px;'>Equipment</td><td>$equipmentid</td></tr>";
echo "<tr><td style='width:150px;'>Problem</td><td>$problem</td></tr>";
echo "<tr><td style='width:150px;'>Instructions</td><td>$instructions</td></tr>";
echo "<tr><td style='width:150px;'>Remarks</td><td>$remarks</td></tr>";
echo "</table>";

$resultrec = mysql_query("SELECT * from t_workorder_parts where workorderid = '$_GET[workorderid]' ");
if (!mysql_num_rows($resultrec) == 0 )
{	
	echo "<table style='width:100%;text-align:left;'>";
	echo "<td colspan='6' style='height:5px;border-bottom:1px solid #51A2A2;width:98%;text-align:center;'>&nbsp;</td></tr>";
	echo "<tr>";
	echo "<td style='height:20px;width:50px;text-align:center;'>Line No</td>";
	echo "<td style='width:50px;padding-left:3px;'>Spare Part Id</td>";
	echo "<td style='width:150px;text-align:center;'>Barcode</td>";
	echo "<td style='width:200px;text-align:center;'>Description</td>";
	echo "<td style='width:100px;text-align:center;'>Equipment Id</td>";
	echo "<td style='width:100px;text-align:center;'>Order Qty</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td colspan='6' style='height:5px;border-top:1px solid #51A2A2;width:98%;text-align:center;'>&nbsp;</td></tr>";
	while($row2 = mysql_fetch_array($resultrec))
	{
		$no++;
		echo "<tr>";
		echo "<td style='text-align:center;'>$no</td>";
		echo "<td style='text-align:center;'>$row2[sparepartid]</td>";
		echo "<td style='text-align:center;'>$row2[barcode]</td>";
		echo "<td style='text-align:center;'>$row2[sparepartname] </td>";
		echo "<td style='text-align:center;'>$row2[equipmentid]</td>";
		echo "<td style='text-align:center;'>$row2[orderqty]</td>";
		echo "</tr>";
	}
	echo "</table>";
	//echo "<div id='wo_new_assign' style='text-align:left;margin-top:30px;font-size:9px;color:#FF8000;cursor:pointer;'> + New Part Assignment</div>";

}

/*
echo "<div id='wo_select_parts' style='100%;'>";//border-top:1px solid #51A2A2;
?>
<script>
	var equipmentid = $('#wo_select_equipmentid').val();
	var workorderid = $('#workorderid').val();
	$.get('eqd_wo_details_line.php?equipmentid='+equipmentid+'&workorderid='+workorderid, function(data) {
		$("#wo_select_parts").html(data);
	});

</script>
<?php
echo "</div>";
*/

echo "</div> ";


function convertdate($indate)
{
 $dd = substr( $indate,8,2);

  $mm = substr( $indate,5,2);

  $yyyy = substr( $indate,0,4);
$outdate = $dd ."-". $mm . "-" . $yyyy;
 return $outdate;

}
?>