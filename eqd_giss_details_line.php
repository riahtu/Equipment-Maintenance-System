<?php
require("db_ems.php");

$resultrec = mysql_query("SELECT * from mop_issue where docno = '$_GET[stisdocno]' ");
if (!mysql_num_rows($resultrec) == 0 )
{	
	echo "<table id='wo_eq_part_list' style='width:100%;text-align:left;'>";
	echo "<td colspan='7' style='height:5px;border-bottom:1px solid #51A2A2;width:98%;text-align:center;'>&nbsp;</td></tr>";
	echo "<tr>";
	echo "<td style='height:20px;width:50px;text-align:center;'>Line No</td>";
	echo "<td style='width:150px;padding-left:3px;'>Spare Part Id</td>";
	echo "<td style='width:150px;text-align:center;'>Barcode</td>";
	echo "<td style='width:200px;text-align:center;'>Description</td>";
	echo "<td style='width:100px;text-align:center;'>Workorder Id</td>";
	echo "<td style='width:100px;text-align:center;'>Issued Qty</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td colspan='7' style='height:5px;border-top:1px solid #51A2A2;width:98%;text-align:center;'>&nbsp;</td></tr>";
	while($rowrec = mysql_fetch_array($resultrec))
	{
		$no++;
		echo "<tr class='wo_part_choose' style='cursor:pointer;'>";
		echo "<td style='text-align:center;'>$no</td>";
		echo "<td style='text-align:center;'>$row1[sparepartid]</td>";
		echo "<td style='text-align:center;'>$row1[barcode]</td>";
		echo "<td style='text-align:center;'>$row1[sp_description] </td>";
		echo "<td style='text-align:center;'>$row1[workorderid]</td>";
		echo "<td style='text-align:center;'>$row1[quantity]</td>";
		echo "</tr>";
	}
	echo "</table>";
	//echo "<div id='wo_new_assign' style='text-align:left;margin-top:30px;font-size:9px;color:#FF8000;cursor:pointer;'> + New Part Assignment</div>";

}
	
?>