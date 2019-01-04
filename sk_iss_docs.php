<?php

session_start();
 require('db_ems.php');
echo "<div style='text-align:left;width:80%;font-size:20px;text-align:left;font-weight:bold;color:#404000;'>Issue Parts Documents</div>";
echo "<p id='changeList' class='changeList' program='sk_iss_docs2.php'>Change List Style</p>";


echo "<div id='show_iss_docs' style='width:1000px;min-height:100px;margin-top:10px;'>";
echo "<table style='font-size:10px;font-family:arial;' cellpadding='0' cellspacing='0'>";
echo "<tr style='background-color:#CE6700;color:#FFFFFF;'>";
echo "<td style='width:30px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;text-align:center;'>No</td>";
echo "<td style='width:150px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Issue No</td>";
echo "<td style='width:100px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>MSPR No</td>";
echo "<td style='width:200px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Machine</td>";
echo "<td style='width:110px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Creation Time</td>";
echo "<td style='width:100px;height:30px;font-weight:bold;border:1px solid #ACACAC;padding-left:3px;'>Request Type</td>";
echo "<td style='width:200px;height:30px;font-weight:bold;border:1px solid #ACACAC;padding-left:3px;'>Received By</td>";
echo "<td style='width:80px;height:30px;font-weight:bold;border:1px solid #ACACAC;padding-left:3px;'>Action</td>";
echo "</tr>";
echo "</table>";

echo "<div id='wo_show_list'>";
echo "<table id='cl_wo_table'  style='font-size:10px;font-family:arial;margin-top:2px;border:1px solid #ACACAC;margin-bottom:30px;' cellpadding='0' cellspacing='0'>";
$result1= mysql_query("SELECT * from mop_issue_header order by createtime desc");
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
		$resultp = mysql_query("SELECT * from m_user where userid = '$row1[receipient]'");
		if (!mysql_num_rows($resultp) == 0 )
		{
			 $username = mysql_result($resultp, 0, 'username');
		}
		require('db_ems.php');
		$no++;
		$createtime = convertdatetime($row1[createtime]);

		echo "<tr class='mlist' id='mlists'>";
		echo "<td id='cl_no' style='width:30px;height:22px;border:1px solid #ACACAC;border-right:0px;border-left:0px;border-top:0px;text-align:center;'>$no</td>";

		echo "<td  id='cl_workorderid' style='width:150px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$row1[docno]</td>";

		echo "<td  style='width:100px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;' >$row1[workorderid]</td>";

		echo "<td  style='width:200px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;' title='$row1[equipmentid]'>$equipmentdesc</td>";

		echo "<td style='width:110px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$createtime</td>";

		echo "<td  style='width:100px;border:1px solid #ACACAC;border-top:0px;border-right:0px;padding-left:3px;'>$row1[reasoncode]</td>";

		echo "<td  style='width:200px;border:1px solid #ACACAC;border-top:0px;border-right:0px;padding-left:3px;'>$username</td>";

		echo "<td style='width:80px;border:1px solid #ACACAC;border-top:0px;border-right:0px;padding-left:3px;'>";

		echo "<div id='pick_iss_docs' class='icon_part_change' title='View' docno='$row1[docno]'></div>";
		echo "<div id='' class='icon_part_delete' title='Delete' workorderid='$row1[workorderid]'></div>";
		echo "</td>";
		echo "</tr>";
		
	}	

}
	echo "</table>";
	echo  "</div>";
	echo  "</div>";

 echo "<div id='show_iss_docs_details' style='margin-top:10px;width:1000px;min-height:300px;text-align:left;'>";
 
 
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