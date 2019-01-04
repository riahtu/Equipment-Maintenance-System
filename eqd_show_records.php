<?php

session_start();
require("db_ems.php");
date_default_timezone_set('Asia/Kuala_lumpur');
$current_year = date("Y");
if($_GET[tab_id] == 'eqd_show_wo')
{
		$result1= mysql_query("SELECT * from t_workorder where equipmentid = '$_GET[equipmentid]' and YEAR(createtime) = '$_GET[year_select]' order by createtime desc");
		if (!mysql_num_rows($result1) == 0 )
		{
			echo "<table style='margin-top:20px;'>";
			echo "<tr>";
			echo "<td style='width:120px;font-weight:bold;'>Requisition</td>";
			echo "<td style='width:120px;font-weight:bold;'>Created Time</td>";
			echo "<td style='width:80px;font-weight:bold;'>Created By</td>";
			echo "<td style='width:150px;font-weight:bold;'>Reason Code</td>";
			echo "<td style='width:300px;font-weight:bold;text-align:left;padding-left:3px;'>Remarks</td>";
			echo "<td style='width:70px;font-weight:bold;'>Closed </td>";
			echo "<td style='width:120px;font-weight:bold;'>Closed Time</td>";
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
				echo "</tr>";
				
			}
			echo "</table>";
		}

		else echo "<p style='color:#FF0000;'>No work order record found </p>";
		echo "<div id='eqd_wo_details_show' style='margin-left:10px;'></div>";
}


if($_GET[tab_id] == 'eqd_show_giss')
{
		$result1= mysql_query("SELECT * from mop_issue_header where equipmentid = '$_GET[equipmentid]' and YEAR(createtime) = '$_GET[year_select]' order by createtime desc");
		if (!mysql_num_rows($result1) == 0 )
		{
			echo "<table style='margin-top:20px;'>";
			echo "<tr>";
			echo "<td style='width:120px;font-weight:bold;'>Goods Issue Doc No</td>";
			echo "<td style='width:120px;font-weight:bold;'>Requisition ID</td>";
			echo "<td style='width:120px;font-weight:bold;'>Created Time</td>";
			echo "<td style='width:80px;font-weight:bold;'>Created By</td>";
			echo "<td style='width:150px;font-weight:bold;'>Reason Code</td>";
			echo "<td style='width:300px;font-weight:bold;text-align:left;padding-left:3px;'>Remarks</td>";

			echo "</tr>";
			
			while($row1 = mysql_fetch_array($result1))
			{
				$nn++;
				$createtime = convertdatetime($row1[createtime]);
				$closedtime = convertdatetime($row1[closedtime]);
				echo "<tr class='eqd_giss_details' stisdocno='$row1[docno]'>";
				echo "<td class='eqd_giss_details' style='' > $row1[docno] </td> ";
				echo "<td class='eqd_giss_details' style='' > $row1[workorderid] </td> ";
				echo "<td class='eqd_giss_details' style='' > $createtime </td> ";
				echo "<td class='eqd_giss_details' style='' > $row1[userid] </td> ";
				echo "<td class='eqd_giss_details' style='' > $row1[reasoncode] </td> ";
				echo "<td class='eqd_giss_details' style='text-align:left;padding-left:3px;' > $row1[remarks] </td> ";
				echo "</tr>";
				
			}
			echo "</table>";
		}

		else echo "<p style='color:#FF0000;'>No goods issue record found</p>";
		echo "<div id='eqd_giss_details_show' style='margin-left:10px;'></div>";
}

if($_GET[tab_id] == 'eqd_show_gret')
{
		$result1= mysql_query("SELECT * from mop_return_header where equipmentid = '$_GET[equipmentid]' and YEAR(createtime) = '$_GET[year_select]' order by createtime desc");
		if (!mysql_num_rows($result1) == 0 )
		{
			echo "<table style='margin-top:20px;'>";
			echo "<tr>";
			echo "<td style='width:120px;font-weight:bold;'>Goods Return Doc No</td>";
			echo "<td style='width:120px;font-weight:bold;'>Requisition ID</td>";
			echo "<td style='width:120px;font-weight:bold;'>Created Time</td>";
			echo "<td style='width:80px;font-weight:bold;'>Created By</td>";
			echo "<td style='width:150px;font-weight:bold;'>Reason Code</td>";
			echo "<td style='width:300px;font-weight:bold;text-align:left;padding-left:3px;'>Remarks</td>";

			echo "</tr>";
			
			while($row1 = mysql_fetch_array($result1))
			{
				$nn++;
				$createtime = convertdatetime($row1[createtime]);
				$closedtime = convertdatetime($row1[closedtime]);
				echo "<tr class='eqd_gret_details' retdocno='$row1[docno]'>";
				echo "<td  class='eqd_gret_details' style='' > $row1[docno] </td> ";
				echo "<td  class='eqd_gret_details' style='' > $row1[workorderid] </td> ";
				echo "<td  class='eqd_gret_details' style='' >  $row1[transdate]</td> ";
				echo "<td  class='eqd_gret_details' style='' > $row1[userid] </td> ";
				echo "<td  class='eqd_gret_details' style='' > $row1[reason] </td> ";
				echo "<td  class='eqd_gret_details' style='text-align:left;padding-left:3px;' > $row1[remarks] </td> ";
				echo "</tr>";
				
			}
			echo "</table>";
		}

		else echo "<p style='color:#FF0000;'>No goods return record found</p>";
		echo "<div id='eqd_gret_details_show' style='margin-left:10px;'></div>";
}

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