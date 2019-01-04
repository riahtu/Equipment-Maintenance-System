
<script type="text/javascript">
	//Selecting Current Year as deafault...
	$(document).ready(()=>{
		var years = [];
		$(".eqd_year_select_pick").each(function(i){
			years[i] =	$(this).html();
	
		});

		var max = Math.max(...years);
		$(".eqd_year_select_pick").each(function(i){
			currYear = $(this).html();
			if(currYear!=max){
				$(this).removeClass("eqd_year_select_pick");
				$(this).addClass("eqd_year_select");
			}
		});
	});
</script>

<?php
session_start();
require("db_ems.php");
date_default_timezone_set('Asia/Kuala_lumpur');
 $current_year = date("Y");
 $result = mysql_query("SELECT * from m_equipment where equipmentid = '$_GET[equipmentid]'");
		if (!mysql_num_rows($result) == 0 )
		{
			 $equipmentdesc = mysql_result($result, 0, 'description');
			  $linecode = mysql_result($result, 0, 'linecode');
		}

echo "<table border=0 style='text-align:left;font-size:12px;font-weight:bold;height:20px;border-bottom:1px solid #616161;'>";
echo "<tr>";
echo "<td style='width:200px;height:30px;'>Machine</td><td style='width:470px;'>$equipmentdesc($_GET[equipmentid])</td>";
echo "<td style='width:300px;padding-bottom:5px;border-radius:5px;' rowspan=2 > "; 

$resulty= mysql_query("SELECT *,YEAR(createtime) as wo_year from t_workorder where equipmentid = '$_GET[equipmentid]' group by YEAR(createtime) order by createtime");
if (!mysql_num_rows($resulty) == 0 )
{
	echo "<table border=0 style='text-align:right;float:right;'>";
	echo "<tr>";
	$i = 0;
	while($rowy = mysql_fetch_array($resulty))
    {
		$yc++;
		$wo_year[i] = $rowy[wo_year];
		$i++;
		if ($yc > 6 ) { $yc = 1 ; echo "</tr></tr>"; }
		if ($yc > 1 ) echo "<td style='width:10px;'></td>";
		$max = max($wo_year);
		if ($wo_year[i] == $max)
			 $class = 'eqd_year_select_pick'; 
		else
			$class = ''; 
		echo "<td class='eqd_year_select $class' equipmentid='$_GET[equipmentid]' style=''>$wo_year[i]</td>";
	}
	echo "</tr>";
	echo "</table>";
}

echo "</td>";
echo "<tr><td style='width:200px;height:30px;'>Production Line</td><td>$linecode</td></tr>";
echo "</table>";

echo "<table cellpadding=0 cellspacing=0 >";
echo "<tr>";
echo "<td class='eqd_tabmenu eqd_tabmenu_selected' id='eqd_show_wo' equipmentid='$_GET[equipmentid]' >Requisitions</td>"; //eqd_show_wo'
echo "<td class='eqd_tabmenu' id='eqd_show_giss' equipmentid='$_GET[equipmentid]' >Goods Issue </td>";
echo "<td class='eqd_tabmenu' id='eqd_show_gret' equipmentid='$_GET[equipmentid]'>Goods Return</td>";
echo "</tr>";
echo "</table>";

echo "<div id='eqd_show' >";

$result1= mysql_query("SELECT * from t_workorder where equipmentid = '$_GET[equipmentid]' and YEAR(createtime) = '$wo_year[i]' order by createtime desc");
if (!mysql_num_rows($result1) == 0 )
{
	echo "<table style='margin-top:20px;'>";
    echo "<tr>";
	echo "<td style='width:120px;font-weight:bold;'>Requisitions</td>";
	echo "<td style='width:120px;font-weight:bold;'>Created Time</td>";
	echo "<td style='width:80px;font-weight:bold;'>Created By</td>";
	echo "<td style='width:150px;font-weight:bold;'>Reason Code</td>";
	echo "<td style='width:300px;font-weight:bold;text-align:left;padding-left:3px;'>Remarks</td>";
	echo "<td style='width:70px;font-weight:bold;'>Closed </td>";
	echo "<td style='width:120px;font-weight:bold;'>Closed Time</td>";
	//echo "<td style='width:60px;font-weight:bold;'>View</td>";
	echo "</tr>";
	
	while($row1 = mysql_fetch_array($result1))
    {
		$nn++;
		$createtime = convertdatetime($row1[createtime]);
		$closedtime = convertdatetime($row1[closedtime]);
		echo "<tr class='eqd_wo_details' workorderid='$row1[workorderid]'>";
		echo "<td class='eqd_wo_details' style='' > $row1[workorderid] </td> ";
		echo "<td class='eqd_wo_details' style='' > $createtime </td> ";
		echo "<td class='eqd_wo_details' style='' > $row1[userid] </td> ";
		echo "<td class='eqd_wo_details' style='' > $row1[wo_type] </td> ";
		echo "<td class='eqd_wo_details' style='text-align:left;padding-left:3px;' > $row1[remarks] </td> ";
		echo "<td class='eqd_wo_details' style='' >  $row1[closed] </td> ";
		echo "<td class='eqd_wo_details' style='' > $closedtime </td> ";
		//echo "<td style=''>";
		//echo "<div class='eqd_wo_details' title='Change' workorderid='$row1[workorderid]' data-popup-target='#example-popup'></div>";
		//echo "</td>";
		echo "</tr>";
		//echo "<div class='oth_wo_change' title='Change' workorderid='$row1[workorderid]' data-popup-target='#example-popup'></div>";
	}
	echo "</table>";
}

else echo "<p>No record found</p>";

echo "<div id='eqd_wo_details_show' style='margin-left:10px;'></div>";
//echo "<div id='pop_bg' style='z-index:100;display:none;position:fixed;top:0px;left:0px;width:100%;height:100%;opacity:0.7;' >test</div>";
//echo "<div id='pop_content' style='z-index:200;display:none;position:fixed;top:20px;left:100px;width:500px;background-color:green;height:400px;' >aku</div>";

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