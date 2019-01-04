<?php
session_start();
 require('db_ems.php');
  echo "<div style='margin-top:20px;font-size:12px;color:#007CB9;font-weight:bold;text-align:left;margin-left:0px;margin-top:10px;'>Change Machine Information ID#$_GET[equipmentid]</div>";
echo "<table style='width:100%;margin-top:10px;'>";
echo "<tr>";
echo "<td style='width:10px;border-bottom:1px solid #C5C5C5' ></td>";
echo "<td class='pm_m2_menu2 pm_m2_menu2_pick' program='pm_m2_update_machine.php'>Main Information</td>";
echo "<td class='pm_m2_menu2 ' program='pm_upd_machine_image.php'>Image</td>";
//echo "<td class='general_menu' program='m1_analysis_3.php'>Analysis 3</td>";
echo "<td style='width:600px;border-bottom:1px solid #C5C5C5' ></td>";

echo "</tr>";
echo "</table>";
echo "<input type='hidden'  id='equipmentid' value='$_GET[equipmentid]'/>";
echo "<div id='right_content_sub' >";


echo "</div>";
?>
<script>
    var equipmentid = $("#equipmentid").val();

	var program = 'pm_m2_update_machine.php?equipmentid='+equipmentid;
	$.get(program, function(data) {
	
    $('#right_content_sub').html(data);
	});
</script>

	
