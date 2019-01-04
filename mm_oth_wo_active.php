<?php
session_start();
require("db_ems.php");
echo "<table>";
echo "<tr><td style='width:1000px;text-align:left;'>Others : List of active Requisition </td><td></div> </td></tr>";
echo "</table>";
echo "<table style='font-size:10px;font-family:arial;' cellpadding='0' cellspacing='0'>";
echo "<tr style='background-color:#3796AA;color:#FFFFFF;'>";
echo "<td style='width:30px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;text-align:center;'>No</td>";
echo "<td style='width:100px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Requisition No</td>";
echo "<td style='width:200px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Prod. Line</td>";
echo "<td style='width:200px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Machine</td>";
echo "<td style='width:110px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Creation Time</td>";
echo "<td style='width:110px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Creator</td>";
echo "<td style='width:100px;height:30px;font-weight:bold;border:1px solid #ACACAC;padding-left:3px;'>Reason Code</td>";
echo "<td style='text-align:left;width:300px;height:30px;font-weight:bold;border:1px solid #ACACAC;padding-left:3px;'>Remarks</td>";
//echo "<td style='width:50px;height:30px;font-weight:bold;border:1px solid #ACACAC;padding-left:3px;'>Closed</td>";
echo "<td style='width:60px;height:30px;font-weight:bold;border:1px solid #ACACAC;padding-left:3px;'>Action</td>";
echo "</tr>";
echo "</table>";

echo "<table style='font-size:10px;font-family:arial;margin-top:2px;' cellpadding='0' cellspacing='0'>";
echo "<tr style='background-color:0xFFFFEA;color:#FF5555;'>";
echo "<td  style='width:30px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;text-align:center;'></td>";
echo "<td  style='width:100px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'><input type='text' placeholder='' id='wo_workorderid' style='width:96%;height:100%;background-color:#FFFFE8;border:0px;' /> </td>";
echo "<td  style='width:200px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'><input type='text' placeholder='' id='wo_linecode' style='width:96%;height:100%;background-color:#FFFFE8;border:0px;' /></td>";
echo "<td  style='width:200px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'><input type='text' placeholder='' id='wo_equipment' style='width:96%;height:100%;background-color:#FFFFE8;border:0px;' /></td>";
echo "<td  style='width:110px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'></td>";
echo "<td  style='width:110px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'></td>";
echo "<td  style='width:100px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'><input type='text' placeholder='' id='wo_reasoncode' style='width:96%;height:100%;background-color:#FFFFE8;border:0px;' /></td>";
echo "<td  style='text-align:left;width:300px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'></td>";
//echo "<td  style='width:50px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'><input type='text' placeholder='' id='wo_closed' style='width:96%;height:100%;background-color:#FFFFE8;border:0px;' /></td>";
echo "<td  style='width:60px;height:30px;font-weight:bold;border:1px solid #ACACAC;padding-left:3px;'></td>";
echo "</tr>";
echo "</table>";

echo "<div id='wo_show_list'>";
echo "<table  style='font-size:10px;font-family:arial;margin-top:2px;border:1px solid #ACACAC;margin-bottom:30px;' cellpadding='0' cellspacing='0'>";
$result1= mysql_query("SELECT * from t_workorder where userid != '$_SESSION[userid]' and closed != 'X' order by createtime desc");
if (!mysql_num_rows($result1) == 0 )
{
	
	while($row1 = mysql_fetch_array($result1))
    {
	     $result = mysql_query("SELECT * from m_equipment where equipmentid = '$row1[equipmentid]'");
		if (!mysql_num_rows($result) == 0 )
		{
			 $equipmentdesc = mysql_result($result, 0, 'description');
			  $linecode = mysql_result($result, 0, 'linecode');
		}
		require('db_ems.php');
		$resultp = mysql_query("SELECT * from m_user where userid = '$row1[userid]'");
		if (!mysql_num_rows($resultp) == 0 )
		{
			 $username = mysql_result($resultp, 0, 'username');
		}
		require('db_ems.php');
		$in_progress = '';
		$list_class = 'mlist';
		$result = mysql_query("SELECT * from mop_issue_header where workorderid = '$row1[workorderid]'");
		if (!mysql_num_rows($result) == 0 )
		{
			$in_progress = 'Y';
			$list_class = 'mlist_ip';
		}
		require('db_ems.php');
		$no++;
		$closedtime = convertdatetime($row1[closedtime]);
		$createtime = convertdatetime($row1[createtime]);
		echo "<tr class='$list_class' >";
		echo "<td  style='width:30px;height:22px;border:1px solid #ACACAC;border-right:0px;border-left:0px;border-top:0px;text-align:center;'>$no</td>";
		echo "<td style='width:100px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$row1[workorderid]</td>";
		echo "<td style='width:200px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;' >$linecode</td>";
		echo "<td style='width:200px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;' title='$row1[equipmentid]'>$equipmentdesc</td>";
		echo "<td style='width:110px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$createtime</td>";
		echo "<td style='width:110px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$username</td>";
		echo "<td style='width:100px;border:1px solid #ACACAC;border-top:0px;border-right:0px;padding-left:3px;'>$row1[reasoncode]</td>";
		echo "<td style='text-align:left;width:300px;border:1px solid #ACACAC;border-top:0px;border-right:0px;padding-left:3px;'>$row1[remarks]</td>";
//		echo "<td style='width:50px;border:1px solid #ACACAC;border-top:0px;border-right:0px;padding-left:3px;'>$row1[closed]</td>";
		echo "<td style='width:60px;border:1px solid #ACACAC;border-top:0px;border-right:0px;padding-left:3px;'>";
		//echo "<div class='icon_part_change' title='Change' sparepartid='$row1[sparepartid]' data-popup-target='#example-popup'></div>";
		echo "<div class='oth_wo_change' title='Change' workorderid='$row1[workorderid]' data-popup-target='#example-popup'></div>";
		echo "</td>";
		
		echo "</tr>";
		
	}	

}
else
{
		echo "<tr >";
		echo "<td  style='text-align:center;border:0px;width:1150px;font-size:14px;color:#FF0000;height:30px;' colspan=6>No Record found</td>";
		echo "</tr>";

}
	echo "</table>";
	echo  "</div>"; //wo_show_list
	
echo "</div> "; 


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