
<script >
	$(document).ready (function(){
		$("#img_part").hide();
		$("#btn_hide_image").hide();
	});
	$(document).on('click','#btn_show_image',showImage);
	function showImage(){
		$("#img_part").show();
		$("#btn_hide_image").show();
		$("#btn_show_image").hide();	
	}
	$(document).on('click','#btn_hide_image',hideImage);
	function hideImage(){
		$("#img_part").hide();
		$("#btn_hide_image").hide();
		$("#btn_show_image").show();
	}
</script>

<?php
session_start();
require('db_ems.php');
$result1= mysql_query("SELECT * from m_sparepart where sparepartid = '$_GET[sparepartid]'  ");
if (!mysql_num_rows($result1) == 0 )
{
	$keycode = mysql_result($result1, 0, 'keycode');
	$description = mysql_result($result1, 0, 'description');
	$maker = mysql_result($result1, 0, 'maker');
	$remarks = mysql_result($result1, 0, 'remarks');
	$spgroup = mysql_result($result1, 0, 'spgroup');
	$sptype = mysql_result($result1, 0, 'sptype');
	$barcode = mysql_result($result1, 0, 'barcode');
	$fs = mysql_result($result1, 0, 'fs');
	$life = mysql_result($result1, 0, 'life');
	$partNumber = mysql_result($result1, 0, 'part_number');
	$refDrawing = mysql_result($result1, 0, 'reference_drawing');
	$safetyqty = mysql_result($result1, 0, 'safety_qty');
	$usageqty = mysql_result($result1, 0, 'usage_qty');
	$critical = mysql_result($result1, 0, 'critical');
}
	

		if($critical == 'X')
			$critical = 'Yes';
		else
			$critical = 'No';
		echo "<span style='display:inline-block;'>";

		echo "<p style='text-decoration:underline;'>$description</p>";
		echo "<p id='btn_spBalanceBack' style='font-size:11px;width:20px;'>Back</p>";
		echo "<table  style='width:550px;border:2px solid black;border-collapse:collapse;text-align:center;font-family:Arial;font-size:12px;height:300px;'>";

		echo "<tr><td style='border-bottom:1px solid black;width:100px;padding-left:5px;'>Part Number</td>";
		echo "<td style='border-bottom:1px solid black;border-left:1px solid black;width:100px;color:#383838;'>$partNumber</td></tr>";

		echo "<tr><td style='border-bottom:1px solid black;width:100px;padding-left:5px;'>Machine</td>";
		echo "<td style='border-bottom:1px solid black;border-left:1px solid black;width:100px;color:#383838;'>$_GET[equipmentdesc]</td></tr>";

		echo "<tr><td style='border-bottom:1px solid black;width:100px;padding-left:5px;'>Reference Drawing</td>";
		echo "<td style='border-bottom:1px solid black;border-left:1px solid black;width:100px;color:#383838;'>$refDrawing</td></tr>";

		echo "<tr><td style='border-bottom:1px solid black;width:100px;padding-left:5px;'>Manufacturer</td>";
		echo "<td style='border-bottom:1px solid black;border-left:1px solid black;width:100px;color:#383838;'>$maker</td>";

		echo "<tr><td style='border-bottom:1px solid black;width:100px;padding-left:5px;'>Remarks</td>";
		echo "<td style='border-bottom:1px solid black;border-left:1px solid black;width:100px;color:#383838;'>$remarks</td></tr>";

		echo "<tr><td style='border-bottom:1px solid black;width:100px;padding-left:5px;'>Group</td>";
		echo "<td style='border-bottom:1px solid black;border-left:1px solid black;width:100px;color:#383838;'>$spgroup</td></tr>";

		echo "<tr><td style='border-bottom:1px solid black;width:100px;padding-left:5px;'>Barcode</td>";
		echo "<td style='border-bottom:1px solid black;border-left:1px solid black;width:100px;color:#383838;'>$barcode</td></tr>";

		echo "<tr><td style='border-bottom:1px solid black;width:100px;padding-left:5px;'>Type</td>";
		echo "<td style='border-bottom:1px solid black;border-left:1px solid black;width:100px;color:#383838;''>$sptype</td>";

		echo "<tr><td style='border-bottom:1px solid black;width:100px;padding-left:5px;'>Fast/Slow</td>";
		echo "<td style='border-bottom:1px solid black;border-left:1px solid black;width:100px;color:#383838;'>$fs</td>";

		echo "<tr><td style='border-bottom:1px solid black;width:100px;padding-left:5px;'>Safety Quantity</td>";
		echo "<td style='border-bottom:1px solid black;border-left:1px solid black;width:100px;color:#383838;'>$safetyqty</td></tr>";

		echo "<tr><td style='border-bottom:1px solid black;width:100px;padding-left:5px;'>Usage Quantity</td>";
		echo "<td style='border-bottom:1px solid black;border-left:1px solid black;width:100px;color:#383838;'>$usageqty</td></tr>";

		echo "<tr><td style='border-bottom:1px solid black;width:100px;padding-left:5px;'>Life</td>";
		echo "<td style='border-bottom:1px solid black;border-left:1px solid black;width:100px;color:#383838;'>$life</td></tr>";

		echo "<tr><td style='border-bottom:1px solid black;width:100px;padding-left:5px;'>Critical</td>";
		echo "<td style='border-bottom:1px solid black;border-left:1px solid black;width:100px;'>$critical</td>";
		echo "</table>";

		echo " <div id='btn_show_image' style='font-size:12px;margin-top:5px;'>Show Image</div>";
		echo " <div id='btn_hide_image' style='font-size:12px;margin-top:5px;'>Hide Image</div>";

		echo "</span>";


		$resultimg = mysql_query("SELECT filepath from m_sparepart_file where sparepartid = '$_GET[sparepartid]'");
		if (!mysql_num_rows($result1) == 0 )
		{	
			$row = mysql_fetch_array($resultimg);
			$image = $row[filepath];			
		}
			echo "<div id='img_part' style='margin:0px auto;height:20px;text-align:left;margin-top:20px;width:700px;height:400px;overflow:scroll; overflow-x: hidden;border:0px solid #BCBCBC;' border=0>";
			echo "<img src='$image' style='width:500px;margin:auto;display:block;'> ";
			echo "</div>";

?>