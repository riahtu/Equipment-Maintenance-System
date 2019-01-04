<?php
require("db_ems.php");
$sql = "INSERT INTO m_equipment_sparepart(equipmentid,sparepartid,def_qty)
			VALUES ('$_GET[equipmentid]','$_GET[sparepartid]','$_GET[def_qty]')";
			if (!mysql_query($sql)) { die('Error: ' . mysql_error()); }
			
$result = mysql_query("SELECT * from m_sparepart where sparepartid = '$_GET[sparepartid]'");
if (!mysql_num_rows($result) == 0 )
{
		$sparepartdesc = mysql_result($result, 0, 'description');
		$barcode = mysql_result($result, 0, 'barcode');
		$maker = mysql_result($result, 0, 'maker');
		$partnumber = mysql_result($result, 0, 'part_number');
}
	echo "<tr class='wo_part_choose' style='cursor:pointer;'>";
	echo "<td style='text-align:center;'>NEW</td>";
	echo "<td style='text-align:center;'>$_GET[sparepartid]</td>";
	echo "<td  style='padding-left:3px;'>$sparepartdesc</td>";
	echo "<td  style='padding-left:3px;'>$partnumber</td>";
	echo "<td >$barcode</td>";
	echo "<td id='t_maker'>$maker</td>";
	echo "<td id='t_defqty'class='wo_def_qty' style='text-align:center;'>$_GET[def_qty]</td>";
	echo "<td class='wo_selected' style='text-align:center;'></td>";
	echo "<td style='text-align:center;'><input type='text' class='wo_orderqty' style='width:40px;height:20px;text-align:center;' </td>";
	echo "</tr>";



?>