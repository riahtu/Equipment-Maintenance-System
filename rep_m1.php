<?php
session_start();
 require('db_ems.php');
  echo "<div style='margin-top:20px;font-size:12px;color:#007CB9;font-weight:bold;text-align:left;margin-left:0px;margin-top:10px;'>Report : Spareparts</div>";
echo "<table style='width:100%;margin-top:10px;'>";
echo "<tr>";
echo "<td style='width:10px;border-bottom:1px solid #C5C5C5' ></td>";
echo "<td class='rep_m1_menu rep_m1_menu_pick' program='rep_m1_1.php'>Sparepart Lisitng</td>";
//echo "<td class='rep_m1_menu ' program='rep_m1_2.php'>Listing by Location Bin</td>";
//echo "<td class='rep_m1_menu ' program='rep_m1_3.php'>Listing without Location Bin</td>";
echo "<td class='rep_m1_menu ' program='rep_m1_4.php'>Print Label</td>";
//echo "<td class='general_menu' program='m1_analysis_3.php'>Analysis 3</td>";
echo "<td style='width:400px;border-bottom:1px solid #C5C5C5' ></td>";

echo "</tr>";
echo "</table>";
echo "<input type='hidden'  id='sparepartid' value='$_GET[sparepartid]'/>";
echo "<div id='right_content_sub' >";


echo "</div>";
?>
<script>

	var program = 'rep_m1_1.php';
	$.get(program, function(data) {
	
    $('#right_content_sub').html(data);
	});
</script>

	
