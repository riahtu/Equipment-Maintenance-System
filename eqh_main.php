<?php
session_start();
require("db_ems.php");
echo "<table style='margin:0px auto;width:100%;'>";
echo "<tr><td style='width:1000px;text-align:center;font-size:20px;color:#3E1F00;'>Maintenance History for Production Line $_GET[linecode] </td><td> </td></tr>";
echo "</table>";

$result1= mysql_query("SELECT * from m_equipment where linecode = '$_GET[linecode]' and status = 'A' ");
if(!mysql_num_rows($result1) == 0)
{   
echo "<div style='margin-top:10px;margin-left:10px;width:1000px; padding:10px;background-color:#6F6F35;'>";
	echo "<table style='width:1000px;'>";
	echo "<tr class='' >";
	while($row1 = mysql_fetch_array($result1))
    {
		$no++; $nn++;
		$closedtime = convertdatetime($row1[closedtime]);
		$createtime = convertdatetime($row1[createtime]);
		
		if ($nn > 5 ) {echo "</tr><tr><td style='height:10px;'></td></tr><tr class='' >"; $nn = 1;}
		echo "<td class='box_eqh' equipmentid='$row1[equipmentid]' style=''>$row1[description] <br/>($row1[equipmentid])</td>";
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
	
echo "<div id='eqh_content' style='margin-left:10px;margin-top:10px;padding:10px;border:1px solid #8F8F8F;border-radius:5px;'>";

echo "<div style='text-align:left;font-size:9px;color:#FF8000;' colspan=4>Note : Please click on the equipment box to view it's maintenance history</div>";

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