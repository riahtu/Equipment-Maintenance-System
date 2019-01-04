<?php
session_start();
require("db_ems.php");
echo "<div style='width:100%;text-align:left;font-family:arial;font-size:20px;margin-top:10px;padding-left:10px;color:#0A92F5;border-bottom:1px solid #C0C0C0;height:40px;'>";
echo "<table border=0 style='font-weight:bold;'>";
echo "<tr>";// left menu
echo "<td style='width:400px;'>Equipment Maintenance History</td>";
echo "<td style='width:650px;'></td>";
echo "<td id='home'>Back to Home</td>";
echo "</tr>";
echo "</table></div>";

echo "<table border=0 style=''>";
echo "<tr>";// left menu
echo "<td style='width:200px;vertical-align:top;'>";


$result1= mysql_query("SELECT linecode from m_equipment where company = '$_SESSION[company]' and status = 'A' group by linecode");
if (!mysql_num_rows($result1) == 0 )
{
	echo "<table border=0 style='width:100%;vertical-align:top;'>";
	echo "<tr><td  style='font-size:12px;color:#552B00;font-weight:bold;height:30px;'>Production Line</td></tr>";
	while($row1 = mysql_fetch_array($result1))
    {
		$nn++;
		$pick = '';
        if ($nn == 1)
		{
			$pick = 'eqh_pick';
			echo "<input type='hidden' id='linecode_pick' value='$row1[linecode]'/>";
		}
		echo "<tr><td  linecode='$row1[linecode]' class='eqh_menu $pick' style=''>$row1[linecode] </td></tr>";
		
	}
	echo "</table>";
}

echo "</td><td style='vertical-align:top;'>";
echo "<div id='eqh_right_content' style='margin-left:10px;'>";
?>
<script>
         $("#eqh_right_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
	
	    var linecode = $("#linecode_pick").val();
		$.get('eqh_main.php?linecode='+linecode, function(data) {
	
			$("#eqh_right_content").html(data);
		
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