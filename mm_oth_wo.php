<?php
session_start();
require("db_ems.php");
echo "<div style='width:100%;text-align:left;font-family:arial;font-size:20px;margin-top:10px;padding-left:10px;color:#0A92F5;border-bottom:1px solid #C0C0C0;height:40px;'>";
echo "<table border=0 style='font-weight:bold;'>";
echo "<tr>";// left menu
echo "<td style='width:300px;'>Others Requisition</td>";
echo "<td style='width:750px;'></td>";
echo "<td id='home'>Back to Home</td>";
echo "</tr>";
echo "</table></div>";

echo "<table border=0 style=''>";
echo "<tr>";// left menu
echo "<td style='width:200px;vertical-align:top;'>";

echo "<table border=0 style='width:100%;vertical-align:top;'>";
echo "<tr><td id='mm_oth_wo_active' class='mm_pick mm_left_menu' style=''>Active Requisition</td></tr>";
echo "<tr><td id='mm_oth_wo_closed' class='mm_left_menu' style=''>Closed Requisition</td></tr>";
echo "<tr><td id='mm_oth_wo_deleted' class='mm_left_menu' style=''>Deleted Requisition</td></tr>";
echo "</table>";
echo "</td><td>";
echo "<div id='mm_right_content' style='margin-left:10px;'>";
?>
<script>
		$("#mm_right_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
	
	    
		$.get('mm_oth_wo_active.php', function(data) {
	
			$("#mm_right_content").html(data);
		
	});

</script>
<?php
echo "</div> "; // right_content
echo "</td></tr>"; //right content
echo "</table>";


function convertdatetime($indate)
{
 $dd = substr( $indate,8,2);

  $mm = substr( $indate,5,2);

  $yyyy = substr( $indate, 0, 4);
   $hms = substr( $indate,10,10);
$outdatetime = $dd ."-". $mm . "-" . $yyyy. ' '.$hms;
 return $outdatetime;

}
?>