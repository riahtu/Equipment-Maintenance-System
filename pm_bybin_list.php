<?php
session_start();
require("db_ems.php");
date_default_timezone_set('Asia/Kuala_lumpur');
$current_year = date("Y");

echo "<table border=0 style='text-align:left;font-size:12px;font-weight:bold;height:20px;border-bottom:1px solid #616161;'>";
echo "<tr>";
echo "<td style='height:30px;'>SELECT BIN NO</td></tr>";
echo "</table>";

echo "<div id='eqd_show' >";

$result1= mysql_query("SELECT * from m_location where bingroup = '$_GET[bingroup]' order by recno ");
if (!mysql_num_rows($result1) == 0 )
{   
echo "<div style='margin-top:10px;margin-left:10px;width:1000px; padding:10px;background-color:#6F6F35;'>";
	echo "<table style='width:1000px;'>";
	echo "<tr class='' >";
	while($row1 = mysql_fetch_array($result1))
    {
		$no++; $nn++;
		$closedtime = convertdatetime($row1[closedtime]);
		$createtime = convertdatetime($row1[createtime]);
		
		if ($nn > 10 ) {  echo "</tr><tr><td style='height:10px;'></td></tr><tr class='' >"; $nn = 0;}
		echo "<td class='box_bin' locationcode='$row1[locationcode]' style=''>$row1[locationcode] </td>";
		echo "<td  style='width:10px'></td>";
	}	
	echo "</tr>";
	
echo "</table>";
echo "</div>";
}
else
{
		echo "<table><tr >";
		echo "<td  style='text-align:center;border:0px;width:1150px;font-size:14px;color:#FF0000;height:30px;' colspan=6>No Record found</td>";
		echo "</tr></table>";

}

echo "<div id='eqd_wo_details_show' style='margin-left:10px;'></div>";
echo "</div>";


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