<?php
require("db_ems.php");
$s_workorderid = "%".$_GET[workorderid]."%";
$s_equipment = "%".$_GET[equipment]."%";
$s_linecode = "%".$_GET[linecode]."%";
$s_reasoncode = "%".$_GET[reasoncode]."%";
$s_username = "%".$_GET[username]."%";

echo "<table id='cl_wo_table' style='font-size:10px;font-family:arial;margin-top:2px;border:1px solid #ACACAC;margin-bottom:30px;' cellpadding='0' cellspacing='0'>";
$result1 = mysql_query("SELECT *, t_workorder.equipmentid as eqid  from t_workorder,m_equipment where t_workorder.workorderid like '$s_workorderid' and t_workorder.reasoncode like '$s_reasoncode' and
                                                                    t_workorder.equipmentid = m_equipment.equipmentid and
																	m_equipment.description like '$s_equipment' and
																	m_equipment.linecode like '$s_linecode'
																	where t_workorder.closed != 'X'");
if (!mysql_num_rows($result1) == 0 )
{
	
	while($row1 = mysql_fetch_array($result1))
    {
	 $nn++;
	require("db_ems.php");
	$eqid = $row1[eqid];
	
	    $resultxxx = mysql_query("SELECT * from m_equipment where equipmentid = '$eqid'");
		if (!mysql_num_rows($resultxxx) == 0 )
		{
			 $equipmentdesc = mysql_result($resultxxx, 0, 'description');
			
			  $linecode = mysql_result($resultxxx, 0, 'linecode');
		}
		else
		{
		 echo "<p>Not found row1[eqid] *$row1[eqid]* equipmentdesc $equipmentdesc</p>";
		}
		require('db_hra.php');
		$resultp = mysql_query("SELECT * from em_personaldata where employeeno = '$row1[user]'");
		if (!mysql_num_rows($resultp) == 0 )
		{
			 $username = mysql_result($resultp, 0, 'name');
		}
		$no++;
		echo "<tr class='mlist'>";
		echo "<td  style='width:30px;height:22px;border:1px solid #ACACAC;border-right:0px;border-left:0px;border-top:0px;text-align:center;'>$no</td>";
		echo "<td id='cl_workorderid' style='width:100px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$row1[workorderid]</td>";
		echo "<td style='width:200px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;' >$linecode</td>";
		echo "<td style='width:200px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;' title='$row1[eqid] '>$equipmentdesc</td>";
		echo "<td style='width:110px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$row1[createtime]</td>";
		
		echo "<td style='width:100px;border:1px solid #ACACAC;border-top:0px;border-right:0px;padding-left:3px;'>$row1[reasoncode]</td>";
		echo "<td style='width:200px;border:1px solid #ACACAC;border-top:0px;border-right:0px;padding-left:3px;'>$username</td>";
		//echo "<td style='width:50px;border:1px solid #ACACAC;border-top:0px;border-right:0px;padding-left:3px;'>$row1[closed]</td>";
		echo "<td style='width:60px;border:1px solid #ACACAC;border-top:0px;border-right:0px;padding-left:3px;'>";
		echo "<div class='icon_part_change' title='Change' sparepartid='$row1[sparepartid]' data-popup-target='#example-popup'></div>";
		echo "</td>";
		
		echo "</tr>";
		
		
	}	
	
}
else
{

   echo "<p style=text-align:center;width:896px;font-size:10px;color:#FF0000;'>No record found</p>";

}

echo "</table>";
?>