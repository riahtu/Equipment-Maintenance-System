<?php
require("db_ems.php");
$resultrec = mysql_query("SELECT * FROM m_equipment_sparepart where equipmentid = '$_GET[equipmentid]'   ");
	if (!mysql_num_rows($resultrec) == 0 )
	{	
		echo "<div style='height:300px;overflow:auto;border:1px solid #51A2A2; '>";
		echo "<table id='wo_eq_part_list' style='margin-top:10px;text-align:left;'>";
		 echo "<tr>";
		  echo "<td style='height:20px;border-bottom:1px solid #51A2A2;width:30px;text-align:center;'>No</td>";
		  echo "<td style='border-bottom:1px solid #51A2A2;width:50px;text-align:center;'>Parts Id</td>";
		  echo "<td style='border-bottom:1px solid #51A2A2;width:200px;padding-left:3px;'>Parts Description</td>";
		  echo "<td style='border-bottom:1px solid #51A2A2;width:150px;'>Part Number</td>";
		  echo "<td style='border-bottom:1px solid #51A2A2;width:100px;'>Barcode</td>";
		  echo "<td style='border-bottom:1px solid #51A2A2;width:100px;'>Maker</td>";
		  echo "<td style='border-bottom:1px solid #51A2A2;width:50px;text-align:center;'>Default Qty</td>";
		  echo "<td style='border-bottom:1px solid #51A2A2;width:50px;text-align:center;'>Choose</td>";
		  echo "<td style='border-bottom:1px solid #51A2A2;width:80px;text-align:center;'>Order Qty</td>";
		  echo "</tr>";
		while($rowrec = mysql_fetch_array($resultrec))
		{
			$result = mysql_query("SELECT * from m_sparepart where sparepartid = '$rowrec[sparepartid]'");
			if (!mysql_num_rows($result) == 0 )
			{
				 $sparepartdesc = mysql_result($result, 0, 'description');
				  $barcode = mysql_result($result, 0, 'barcode');
				  $maker = mysql_result($result, 0, 'maker');
				  $partnumber = mysql_result($result, 0, 'part_number');
				
			}
			$no++;
		  
		  echo "<tr class='wo_part_choose' style='cursor:pointer;'>";
		  echo "<td style='text-align:center;'>$no</td>";
		  echo "<td class='wo_sparepartid' style='text-align:center;'>$rowrec[sparepartid]</td>";
		  echo "<td class='wo_partDesc' style='padding-left:3px;'>$sparepartdesc</td>";
		  echo "<td class='wo_partnumber'>$partnumber</td>";
		  echo "<td class='wo_barcode'>$barcode</td>";
		  echo "<td id='t_maker'>$maker</td>";
		  echo "<td class='wo_def_qty' style='text-align:center;'>$rowrec[def_qty]</td>";
		  echo "<td class='wo_selected' style='text-align:center;'></td>";
		  echo "<td style='text-align:center;'><input type='text' class='wo_orderqty' style='width:40px;height:20px;text-align:center;'/> </td>";
		  echo "</tr>";
		
		}
		echo "</table>";
		 echo "</div>";

	echo "<div id='wo_save_show' style='margin-top:40px;'>";
	echo "<table>";
	echo "<tr>";
	echo "<td style='width:150px;'></td>";
	echo "<td><button style='width:200px;height:30px;'>Cancel</button></td>";
	echo "<td style='width:30px;'></td>";
	echo "<td><button id='wo_save' style='width:200px;height:30px;'>Create and Save</button></td>";
	echo "</tr>";
	echo "</table>";
	echo "</div>";

	echo "<div id='wo_new_assign' style='text-align:left;margin-top:30px;font-size:9px;color:#FF8000;cursor:pointer;'> + New Part Assignment</div>";
	
	}
	else {
	echo "<div style='font-size:25px;color:#FF0000;margin-top:20px;'>Please define Assignment Parts to Machine</div>";
	echo "<div id='wo_new_assign' style='text-align:left;margin-top:30px;font-size:9px;color:#FF8000;cursor:pointer;'> + New Part Assignment</div>";
	}
	echo "<div id='wo_bg'></div>";
	echo "<div id='equipment_sparepart_assignment' style='display:none;z-index:2000;position:fixed;background-color:#FFFFFF;border-radius:10px;top:120px;left:300px;width:800px;min-height:300px;border:1px solid #408080;'></div>";
?>