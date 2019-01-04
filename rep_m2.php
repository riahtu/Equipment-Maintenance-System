<?php
session_start();
 require('db_ems.php');
  echo "<div style='margin-top:20px;font-size:12px;color:#007CB9;font-weight:bold;text-align:left;margin-left:0px;margin-top:10px;'>Report : Equipments</div>";
echo "<table style='width:100%;margin-top:10px;'>";
echo "<tr>";
echo "<td style='width:10px;border-bottom:1px solid #C5C5C5' ></td>";
echo "<td class='rep_m2_menu rep_m2_menu_pick' program='rep_m2_1.php'>Machine Listing</td>";
echo "<td class='rep_m2_menu ' program='rep_m2_2.php'>Machine Maintenance History</td>";
echo "<td class='rep_m2_menu ' program='rep_m2_3.php'>Machine Preventive Maintenance History</td>";
echo "</tr>";
echo "</table>";
echo "<input type='hidden'  id='sparepartid' value='$_GET[sparepartid]'/>";
echo "<div id='right_content_sub' >";


echo "</div>";
?>
<script>

	var program = 'rep_m2_1.php';
	$.get(program, function(data) {
	
    $('#right_content_sub').html(data);
	});
</script>

	
