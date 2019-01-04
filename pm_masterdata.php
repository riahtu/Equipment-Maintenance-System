<?php
session_start();
 require('db_ems.php');
 echo "<div style='text-align:left;width:80%;font-size:20px;text-align:left;font-weight:bold;color:#404000;'>Data Management</div>";
  echo "<div style='margin-top:20px;font-size:12px;color:#007CB9;font-weight:bold;text-align:left;margin-left:0px;margin-top:10px;'>Register New Info</div>";
echo "<table style='width:100%;margin-top:10px;'>";
echo "<tr>";
echo "<td style='width:10px;border-bottom:1px solid #C5C5C5' ></td>";
echo "<td class='pm_m3_menu pm_m3_menu_pick' program='pm_m2_parts.php'>Sparepart</td>";
echo "<td class='pm_m3_menu ' program='pm_m2_machine.php'>Machine</td>";
echo "<td class='pm_m3_menu ' program='pm_m2_others.php'>Others</td>";
//echo "<td class='pm_m3_menu ' program='pm_m2_test.php'>Others</td>";
//echo "<td class='general_menu' program='m1_analysis_3.php'>Analysis 3</td>";
echo "<td style='width:600px;border-bottom:1px solid #C5C5C5' ></td>";

echo "</tr>";
echo "</table>";
echo "<input type='hidden'  id='sparepartid' value='$_GET[sparepartid]'/>";
echo "<div id='right_content_sub' >";


echo "</div>";
?>
<script>
    var sparepartid = $("#sparepartid").val();

	var program = 'pm_m2_parts.php?sparepartid='+sparepartid;
	$.get(program, function(data) {
	
    $('#right_content_sub').html(data);
	});
</script>

	
