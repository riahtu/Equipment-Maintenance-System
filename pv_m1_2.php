<?php

session_start();
 date_default_timezone_set('Asia/Kuala_lumpur');
   $now = date("YmdHis");
   $today = date("Y-m-d");
    $cyear = date("Y");
	$calyear = date('Y')  ;
	$calmth =  date('m')  ;
	$curmthdesc =  date('F')  ;
 require('db_ems.php');
echo "<table style='font-size:14px;margin-top:20px;text-align:left;color:#00DD6F;font-weight:bold;'>";
	echo "<tr>";
	echo "<td>Machine Schedule $_SESSION[company]</td>";
	echo "<td style='width:750px; color:red;font-size:10px;'></td>";
	echo "<td class='pv_yswitch' id='pv_previous' ><</td>";
	echo "<td id='pv_newyyyy' style='width:80px;font-size:14px;color:#0D91F2;font-weight:bold;text-align:center;'>$calyear</td>";
	echo "<td class='pv_yswitch' id='pv_next' >></td>";
	echo "</tr>";
	echo "<tr><td style='width:750px; color:red;font-size:10px;'>*Set the date of preventive maintenance for each Machine</td></tr>";
echo "</table>";

//echo "<input type='hidden' id='curmth' value='$calmth'/>";
echo "<input type='hidden' id='curyear' value='$calyear'/>";
//
echo "<div id='pv_equipment_schedule'>";
echo "</div>";

?>
<script>
         $("#pv_equipment_schedule").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
	
		var curyear = $("#curyear").val();
		$.get('pv_equipment_schedule.php?curmth='+curmth+'&curyear='+curyear, function(data) {
	
			$("#pv_equipment_schedule").html(data);
			
		
	});

</script>
		


