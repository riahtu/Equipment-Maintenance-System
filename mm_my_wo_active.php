<?php
session_start();
require("db_ems.php");
echo "<table>";
echo "<tr><td style='width:1000px;text-align:left;'>List of active Requisitions</td><td><div id='icon_new_workorder' title='Create New Requisition'></div> </td></tr>";
echo "</table>";


echo "<div id='wo_show_list'>";
$result1= mysql_query("SELECT * from t_workorder where userid = '$_SESSION[userid]' and closed != 'X' order by createtime desc");
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
		
		$giss = '';
		$list_class = '';
		$result = mysql_query("SELECT * from mop_issue_header where workorderid = '$row1[workorderid]'");
		if (!mysql_num_rows($result) == 0 )
		{
			$giss = 'YES';
			$list_class = 'mlist_ip';
		}
		$result = mysql_query("SELECT * from m_wo_type where wo_type = '$row1[wo_type]'");
		if (!mysql_num_rows($result) == 0 )
		{
			 $wotypedesc = mysql_result($result, 0, 'desc');
			 
		}
		require('db_ems.php');
		$no++;
		$closedtime = convertdatetime($row1[closedtime]);
		$createtime = convertdatetime($row1[createtime]);
		echo "<div class='wo_change' workorderid='$row1[workorderid]' style='margin-top:10px;'>";
			echo "<table style='text-align:left;border-collapse: collapse;'>";
			echo "<tr><td style='width:100px;border-bottom:1px solid #ACACAC;padding-left:3px;vertical-align:top;font-size:16px;color:#FF8000;font-weight:bold;text-align:center;height:30px;' colspan=2>$row1[workorderid]</td></tr>";
			echo "<tr><td style='width:100px;'>Production Line</td><td style='border-bottom:1px solid #ACACAC;;padding-left:3px;vertical-align:top;' >$linecode</td></tr>";
			echo "<tr><td>Machine</td><td style='border-bottom:1px solid #ACACAC;padding-left:3px;vertical-align:top;' title='$row1[equipmentid]'>$equipmentdesc</td></tr>";
			echo "<tr><td>Create Time</td><td style='border-bottom:1px solid #ACACAC;padding-left:3px;vertical-align:top;'>$createtime</td></tr>";
			
			echo "<tr><td>Work Order Type</td><td style='border-bottom:1px solid #ACACAC;padding-left:3px;vertical-align:top;'>$wotypedesc</td></tr>";
			echo "<tr><td>Parts Issued</td><td style='border-bottom:1px solid #ACACAC;text-align:left;vertical-align:top;'>$giss</td></tr>";
			echo "<tr><td colspan=2 style='height:20px;text-align:left;vertical-align:bottom;'>Problem</td></tr>";
			echo "<tr><td colspan=2 style='text-align:left;width:300px;padding-left:3px;vertical-align:top;'><textarea readonly style='width:290px;height:60px;font-family:arial;font-size:10px;'>$row1[problem]</textarea></td></tr>";
			echo "<tr><td colspan=2 style='text-align:left;vertical-align:bottom;height:20px;'>Instructions</td></tr>";
			echo "<tr><td colspan=2 style='text-align:left;width:300px;padding-left:3px;vertical-align:top;'><textarea readonly style='width:290px;height:60px;font-family:arial;font-size:10px;'>$row1[instructions]</textarea></td></tr>";
			echo "<tr><td colspan=2 style='text-align:left;vertical-align:bottom;height:20px;'>Remarks</td></tr>";
			echo "<tr><td colspan=2 style='text-align:left;width:300px;padding-left:3px;vertical-align:top;'><textarea readonly style='width:290px;height:60px;font-family:arial;font-size:10px;'>$row1[remarks]</textarea></td></tr>";
			
			echo "<tr><td style='height:5px;'></td></tr>";
			echo "</table>";
		 echo "</div>";
	}	

}
else
{
		echo "<table>";
		echo "<tr >";
		echo "<td  style='text-align:center;border:0px;width:1150px;font-size:14px;color:#FF0000;height:30px;' colspan=6>No Record found</td>";
		echo "</tr>";
		echo "</table>";
        echo "</div>";
}
	

	
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