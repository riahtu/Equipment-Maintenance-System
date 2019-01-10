<?php
session_start();
require("db_ems.php");
echo "<table>";
echo "<tr><td style='width:1000px;text-align:left;'>List of Physical Count Schedule </td><td></div> </td></tr>";
echo "</table>";
echo "<table style='font-size:10px;font-family:arial;' cellpadding='0' cellspacing='0'>";
echo "<tr style='background-color:#3796AA;color:#FFFFFF;'>";
echo "<td style='width:30px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;text-align:center;'>No</td>";
echo "<td style='width:100px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Physical Count No</td>";
echo "<td style='width:100px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Count Date</td>";
echo "<td style='width:110px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Store ID</td>";
echo "<td style='width:110px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Creation Time</td>";
echo "<td style='width:210px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Creator</td>";
echo "<td style='width:300px;height:30px;font-weight:bold;border:1px solid #ACACAC;padding-left:3px;text-align:left;'>Remarks</td>";
echo "<td style='width:60px;height:30px;font-weight:bold;border:1px solid #ACACAC;padding-left:3px;'>Action</td>";
echo "</tr>";
echo "</table>";

echo "<div id='wo_show_list'>";
echo "<table  style='font-size:10px;font-family:arial;margin-top:2px;border:1px solid #ACACAC;margin-bottom:30px;' cellpadding='0' cellspacing='0'>";

$result1= mysql_query("SELECT * from physical_count_header order by createtime desc");
if (!mysql_num_rows($result1) == 0 )
{
	
	while($row1 = mysql_fetch_array($result1))
    {
		require('db_ems.php');
		$resultp = mysql_query("SELECT * from m_user where userid = '$row1[userid]'");
		if (!mysql_num_rows($resultp) == 0 )
		{
			 $username = mysql_result($resultp, 0, 'username');
		}
		require('db_ems.php');
		$no++;
		$createtime = convertdatetime($row1[createtime]);
		echo "<tr class='$list_class' >";
		echo "<td  style='width:30px;height:22px;border:1px solid #ACACAC;border-right:0px;border-left:0px;border-top:0px;text-align:center;'>$no</td>";
		echo "<td style='width:100px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$row1[pc_docno]</td>";
		echo "<td style='width:100px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$row1[countdate]</td>";
		echo "<td style='width:110px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$row1[storeid]</td>";
		echo "<td style='width:110px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$createtime</td>";
		echo "<td style='width:210px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$username</td>";
		echo "<td style='text-align:left;width:300px;border:1px solid #ACACAC;border-top:0px;border-right:0px;padding-left:3px;'>$row1[remarks]</td>";
		echo "<td style='width:60px;border:1px solid #ACACAC;border-top:0px;border-right:0px;padding-left:3px;'>";
		echo "<div class='pc_m2_view' title='View' pcdocno='$row1[pc_docno]' countdate='$row1[countdate]' storeid='$row1[storeid]' username='$username' data-popup-target='#example-popup'></div>";
		if($_SESSION[role] == 'ADMIN') 
			echo "<div id='delete_pc' class='icon_part_delete' title='Delete Schedule' pcdocno='$row1[pc_docno]'></div>";
		echo "</td>";
		echo "</tr>";
		
	}	

}
else
{
	echo "<tr>";
	echo "<td  style='text-align:center;border:0px;width:1150px;font-size:14px;color:#FF0000;height:30px;' colspan=6>No Record found</td>";
	echo "</tr>";

}
echo "</table>";
echo  "</div>"; 
	
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