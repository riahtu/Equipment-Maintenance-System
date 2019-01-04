<?php
require("db_ems.php");

$resultrec = mysql_query("SELECT * FROM m_equipment_sparepart where equipmentid = '$_GET[equipmentid]'   ");
if (!mysql_num_rows($resultrec) == 0 )
{	
	echo "<table id='wo_eq_part_list' style='width:100%;text-align:left;'>";
	echo "<td colspan='7' style='height:5px;border-bottom:1px solid #51A2A2;width:98%;text-align:center;'>&nbsp;</td></tr>";
	echo "<tr>";
	echo "<td style='height:20px;width:30px;text-align:center;'>No</td>";
	echo "<td style='width:50px;text-align:center;'>Spare Id</td>";
	echo "<td style='width:350px;padding-left:3px;'>Spare Description</td>";
	echo "<td style='width:100px;text-align:center;'>Barcode</td>";
	echo "<td style='width:100px;text-align:center;'>Maker</td>";
	echo "<td style='width:100px;text-align:center;'>Default Qty</td>";
	echo "<td style='width:100px;text-align:center;'>Order Qty</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td colspan='7' style='height:5px;border-top:1px solid #51A2A2;width:98%;text-align:center;'>&nbsp;</td></tr>";
	while($rowrec = mysql_fetch_array($resultrec))
	{
		$result = mysql_query("SELECT * from m_sparepart where sparepartid = '$rowrec[sparepartid]'");
		if (!mysql_num_rows($result) == 0 )
		{
			$sparepartdesc = mysql_result($result, 0, 'description');
			$barcode = mysql_result($result, 0, 'barcode');
			$maker = mysql_result($result, 0, 'maker');
		}
		$orderqty = '';
		$resultx = mysql_query("SELECT * from t_workorder_parts where workorderid = '$_GET[workorderid]' and sparepartid = '$rowrec[sparepartid]'");
		if (!mysql_num_rows($resultx) == 0 )
		{
			$orderqty = mysql_result($resultx, 0, 'orderqty');
		}
		$no++;
		echo "<tr class='wo_part_choose' style='cursor:pointer;'>";
		echo "<td style='text-align:center;'>$no</td>";
		echo "<td style='text-align:center;'>$rowrec[sparepartid]</td>";
		echo "<td style='text-align:left;'>$sparepartdesc</td>";
		echo "<td style='text-align:center;'>$barcode</td>";
		echo "<td style='text-align:center;'>$maker </td>";
		echo "<td style='text-align:center;'>$rowrec[def_qty]</td>";
		echo "<td style='text-align:center;'>$orderqty</td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "<div id='wo_new_assign' style='text-align:left;margin-top:30px;font-size:9px;color:#FF8000;cursor:pointer;'> + New Part Assignment</div>";

}
	
?>