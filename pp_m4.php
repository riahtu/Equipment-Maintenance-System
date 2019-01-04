<?php
session_start();
 require('db_ems.php');
  echo "<div style='margin-top:20px;font-size:12px;color:#007CB9;font-weight:bold;text-align:left;margin-left:0px;margin-top:10px;'>Purchase History</div>";
echo "<table style='width:100%;margin-top:10px;'>";
echo "<tr>";
echo "<td style='width:10px;border-bottom:1px solid #C5C5C5' ></td>";
echo "<td class='pp_m1_menu pp_m1_menu_pick' program='pp_m4_1.php'>History by Sparepart</td>";
echo "<td class='pp_m1_menu' program='pp_m4_2.php'>History by Supplier</td>";

//echo "<td class='general_menu' program='m1_analysis_3.php'>Analysis 3</td>";
echo "<td style='width:600px;border-bottom:1px solid #C5C5C5' ></td>";

echo "</tr>";
echo "</table>";
echo "<input type='hidden'  id='sparepartid' value='$_GET[sparepartid]'/>";
echo "<div id='right_content_sub' >";


echo "</div>";
?>
<script>

	var program = 'pp_m4_1.php';
	$.get(program, function(data) {
	
    $('#right_content_sub').html(data);
	});
</script>

	
