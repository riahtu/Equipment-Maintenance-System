<?php
require("db_ems.php");
session_start();
date_default_timezone_set('Asia/Kuala_lumpur');
$now = date("YmdHis");
$year = date("Y");
$result1= mysql_query("SELECT * from mop_return_header where docno = '$_GET[retdocno]'");
if (!mysql_num_rows($result1) == 0 )
{
	
	while($row1 = mysql_fetch_array($result1))
    {
		$wo_type = $row1[reason];
		$wo_recno = $row1[recno];
		$equipmentid = $row1[equipmentid];
		$wo_remarks = $row1[wo_remarks];
		$workorderid = $row1[workorderid];
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
echo "<tr><td style='width:900px;text-align:left;font-weight:bold;font-size:12px;top:20px;'>Goods Return Details : #$_GET[retdocno]</td><td> </td></tr>";
echo "</table>";

echo "<input type='hidden' id='stisdocno' value='$_GET[retdocno]'/>";
echo "<input type='hidden' id='wo_recno' value='$wo_recno'/>";

echo "<table style='text-align:left;margin-top:10px;'>";
echo "<tr><td style='width:150px;'>Requisition Type</td><td>$wo_type</td></tr>";
echo "<tr><td style='width:150px;'>Requisition No</td><td>$workorderid</td></tr>";
echo "<tr><td style='width:150px;'>Requisition Remarks</td><td>$wo_remarks</td></tr>";
echo "<tr><td style='width:150px;'>Equipment</td><td>$equipmentid</td></tr>";
echo "<tr><td style='width:150px;'>Problem</td><td>$problem</td></tr>";
echo "<tr><td style='width:150px;'>Remarks</td><td>$remarks</td></tr>";
echo "</table>";

$resultrec = mysql_query("SELECT * from mop_return where docno = '$_GET[retdocno]' ");
if (!mysql_num_rows($resultrec) == 0 )
{	
	echo "<table id='wo_eq_part_list' style='width:100%;text-align:left;'>";
	echo "<td colspan='6' style='height:5px;border-bottom:1px solid #51A2A2;width:98%;text-align:center;'>&nbsp;</td></tr>";
	echo "<tr>";
	echo "<td style='height:20px;width:50px;text-align:center;'>Line No</td>";
	echo "<td style='width:50px;padding-left:3px;'>Spare Part Id</td>";
	echo "<td style='width:50;text-align:center;'>Barcode</td>";
	echo "<td style='width:200px;text-align:center;'>Description</td>";
	echo "<td style='width:100px;text-align:center;'>Workorder Id</td>";
	echo "<td style='width:100px;text-align:center;'>Return Qty</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td colspan='6' style='height:5px;border-top:1px solid #51A2A2;width:98%;text-align:center;'>&nbsp;</td></tr>";
	while($row2 = mysql_fetch_array($resultrec))
	{
		$no++;
		echo "<tr class='wo_part_choose' '>";
		echo "<td style='text-align:center;'>$no</td>";
		echo "<td style=''>$row2[sparepartid]</td>";
		echo "<td style='text-align:center;'>$row2[barcode]</td>";
		echo "<td style='text-align:center;'>$row2[sp_description] </td>";
		echo "<td style='text-align:center;'>$row2[workorderid]</td>";
		echo "<td style='text-align:center;'>$row2[return_quantity]</td>";
		echo "</tr>";
	}
	echo "</table>";
	//echo "<div id='wo_new_assign' style='text-align:left;margin-top:30px;font-size:9px;color:#FF8000;cursor:pointer;'> + New Part Assignment</div>";

}

/*
echo "<div id='giss_select_parts' style='100%;'>";//border-top:1px solid #51A2A2;
?>
<script>
	var equipmentid = $('#wo_select_equipmentid').val();
	var stisdocno = $('#stisdocno').val();
	$.get('eqd_giss_details_line.php?equipmentid='+equipmentid+'&stisdocno='+stisdocno, function(data) {
		$("#giss_select_parts").html(data);
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