<?php
session_start();
require("db_ems.php");
echo "<div style='width:100%;text-align:left;font-family:arial;font-size:20px;margin-top:10px;padding-left:10px;color:#0A92F5;border-bottom:1px solid #C0C0C0;height:40px;'>";
echo "<table border=0 style='font-weight:bold;'>";
echo "<tr>";// left menu
echo "<td style='width:300px;'>Parts Management</td>";
echo "<td style='width:750px;'></td>";
echo "<td id='home'>Back to Home</td>";
echo "</tr>";
echo "</table></div>";

echo "<table border=0 style=''>";
echo "<tr>";// left menu
echo "<td style='width:200px;vertical-align:top;'>";

echo "<table border=0 style='width:100%;vertical-align:top;'>";
echo "<tr><td id='pm_parts_enquiry' class='mm_left_menu mm_pick' style=''>Parts Balance Enquiry</td></tr>";
echo "<tr><td id='pm_parts_master' class='mm_left_menu' style=''>Update Information</td></tr>";
echo "<tr><td id='pm_parts_master_all' class='mm_left_menu' style=''>Add New</td></tr>";
//echo "<tr><td id='pp_m5' class='pp_left_menu' program='pp_m5.php' style=''>Sparepart By Maker</td></tr>";
//echo "<tr><td id='pp_m7' class='pp_left_menu' program='pp_m7.php' style=''>Sparepart By Location</td></tr>";
//echo "<tr><td id='pp_m6' class='pp_left_menu' program='pp_m6.php' style=''>Print Sparepart Label</td></tr>";
//echo "<tr><td id='pp_m8' class='pp_left_menu' program='pp_m8.php' style=''>Print Sparepart Label</td></tr>";
echo "</table>";
echo "</td><td style='vertical-align:top;'>";
echo "<div id='mm_right_content' style='margin-left:10px;'>";
?>
<script>
         $("#mm_right_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
	
	    
		$.get('pm_parts_enquiry.php', function(data) {
	
			$("#mm_right_content").html(data);
			$("#pm_s_barcode").focus();
		
	});

</script>
<?php
echo "</div> "; // right_content
echo "</td></tr>"; //right content
echo "</table>";

echo "<div id='wo_popup_bg' style='display:none;z-index:1000;position:fixed;top:0px;left:0px;background-color:#FFFFFF;width:100%;height:100%;opacity:0.2;'></div>";
echo "<div class='popup_shadow' id='wo_popup_content' style='display:none;z-index:1010;position:fixed;top:20px;left:100px;background-color:#FFFFFF;width:1200px;height:570px;;border:1px solid #282828;border-radius:5px;'></div>";
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