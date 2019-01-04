<?php
session_start();
 require('db_ems.php');
  echo "<div style='margin-top:20px;font-size:12px;color:#007CB9;font-weight:bold;text-align:left;margin-left:0px;margin-top:10px;'>Purchase Return Order</div>";
echo "<table style='width:100%;margin-top:10px;'>";
echo "<tr>";
echo "<td style='width:10px;border-bottom:1px solid #C5C5C5' ></td>";
echo "<td class='pp_m2_menu pp_m2_menu_pick' program='pp_m2_1.php'>Generate New Document</td>";
echo "<td class='pp_m2_menu' program='pp_m2_2x.php'>Purchase Order Return Document</td>";
echo "<td class='pp_m2_menu' program='pp_m2_4x.php'>Deleted Documents</td>";
echo "<td style='width:400px;border-bottom:1px solid #C5C5C5' ></td>";

echo "</tr>";
echo "</table>";
echo "<input type='hidden'  id='sparepartid' value='$_GET[sparepartid]'/>";
echo "<div id='right_content_sub' >";


echo "</div>";
?>
<script>

	var program = 'pp_m2_1.php';
	$.get(program, function(data) {
	
    $('#right_content_sub').html(data);
	});
</script>

	
