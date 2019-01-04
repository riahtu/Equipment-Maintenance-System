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
	echo "<td>Monthly Schedules</td>";
	echo "<td style='width:750px;'></td>";
	echo "<td class='pv_mswitch' id='pv_previous' ><</td>";
	echo "<td id='pv_newmmyyyy' style='width:120px;font-size:14px;color:#0D91F2;font-weight:bold;text-align:center;'>$curmthdesc $calyear</td>";
	echo "<td class='pv_mswitch' id='pv_next' >></td>";
	echo "</tr>";
echo "</table>";

echo "<input type='hidden' id='curmth' value='$calmth'/>";
echo "<input type='hidden' id='curyear' value='$calyear'/>";
//
echo "<div id='pv_monthly_schedule'>";
echo "</div>";

?>
<script>
         $("#pv_monthly_schedule").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
	
	    var curmth = $("#curmth").val();
		var curyear = $("#curyear").val();
		$.get('pv_month_schedule.php?curmth='+curmth+'&curyear='+curyear, function(data) {
	
			$("#pv_monthly_schedule").html(data);
			
		
	});

</script>
		


