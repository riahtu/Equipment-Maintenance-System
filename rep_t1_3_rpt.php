
 <TITLE>EMS-Report - Workorder Listing</title>
<link rel="stylesheet" type="text/css" href="mystyle.css" />
<script type="text/javascript" src="jqery.min.js"></script>
<link type="text/css" href="jquery/css/ui-lightness/jquery-ui-1.8.17.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="jquery/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="jquery/js/jquery-ui-1.8.17.custom.min.js"></script>
<link rel="stylesheet" href="jquery-ui-1.11.2.custom/jquery-ui.css">
<script src="jquery-ui-1.11.2.custom/external/jquery/jquery.js"></script>
<script src="jquery-ui-1.11.2.custom/jquery-ui.js"></script>
<script type="text/javascript" src="admin.js"></script>
<?php
session_start();
 date_default_timezone_set('Asia/Kuala_lumpur');
 $now = date("d-m-Y H:i:s");
require("db_ems.php");
$s_partname = "%".$_GET[partname]."%";
$s_maker = "%".$_GET[maker]."%";
$s_sparepartid = "%".$_GET[sparepartid]."%";
$s_barcode = "%".$_GET[barcode]."%";
$s_spgroup = "%".$_GET[spgroup]."%";
//$s_username = "%".$_GET[username]."%";
$result1= mysql_query("SELECT * from m_company where company = '$_SESSION[company]'");
if (!mysql_num_rows($result1) == 0 )
{
	$companydesc = mysql_result($result1, 0, 'description');
}
echo "<table style='font-family:arial;font-size:12px;'>";
echo "<tr><td style='font-weight:bold;'>$companydesc</td></tr>";
echo "<tr><td style='font-weight:bold;'>Equipment Maintenance System</td></tr>";
echo "<tr><td style='font-weight:bold;'>Report : Requisition by equipment</td></tr>";
echo "<tr><td style=''>Date : $now</td></tr>";
echo "</table>";

echo "<table align='center' style='margin-top:20px;font-size:10px;font-family:arial;margin-bottom:30px;text-align:left;border-collapse:collapse;border:1px solid black;' >";
$result1 = mysql_query("SELECT * from t_workorder order by equipmentid, workorderid ");
if (!mysql_num_rows($result1) == 0 )
{
	

	//header row
	echo "<tr class='' sparepartid='$row1[sparepartid]' equipmentid='$_GET[equipmentid]' barcode='$row1[barcode]' style='cursor:pointer;'>";
	echo "<td style='width:80px;height:24px;border-bottom:1px solid #373737;text-align:center;font-weight:bold;'>No</td>";
	echo "<td style='width:100px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Machine</td>";
	echo "<td style='width:100px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Type</td>";
	echo "<td style='width:100px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Requisition ID</td>";
	echo "<td style='width:150px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Problem</td>";	
	echo "<td style='width:150px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Instruction</td>";
	echo "<td style='width:150px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Remarks</td>";	
	echo "<td style='width:100px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >PV Schedule</td>";	
	echo "</tr>";
	
	while($row1 = mysql_fetch_array($result1))
    {
		$result3 = mysql_query("SELECT * from t_pv_schedules where recno = $row1[pv_schedule_recno]");
    	if (!mysql_num_rows($result3) == 0 )
		{
			 $pv_date = mysql_result($result3, 0, 'pv_date');
			 $pv_date = substr($pv_date,8,2 ).'-'.substr($pv_date, 5,2).'-'.substr($pv_date, 0,4);
		}

		$result2 = mysql_query("SELECT * FROM m_equipment where equipmentid like '$row1[equipmentid]'");
		

		
		echo "<tr class='report' sparepartid='$row1[sparepartid]' equipmentid='$_GET[equipmentid]' barcode='$row1[barcode]' style='cursor:pointer;'>";
		//echo "<td style='width:50px;height:24px;border-bottom:1px solid #E9E9E9;text-align:center;vertical-align:top;padding-top:3px;'>$no</td>";

		if (!mysql_num_rows($result2) == 0 )
		{
			while($row2 = mysql_fetch_array($result2))
			{
				
				if ($save_equipment != $row2[description])
				{
					$no++;
					echo "<td style='width:50px;height:24px;border-bottom:1px solid #E9E9E9;text-align:center;vertical-align:top;padding-top:3px;'>$no</td>";
					echo "<td style='width:154px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;'>$row2[description]</td>";
					$save_equipment = $row2[description];
					//$no = 0;
					
				}
				else{
					echo "<td></td>";
					echo "<td></td>";
					
				}

			}
		
		}
		//echo "<td></td>";
		if ($row1[wo_type] == 'REPAIR')$pv_date = '';
		echo "<td style='width:100px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[wo_type]</td>";
		echo "<td style='width:154px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[workorderid]</td>";
		echo "<td style='width:103px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[problem]</td>";		
		echo "<td style='width:173px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[instruction]</td>";
		echo "<td style='width:100px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[remarks]</td>";	
		echo "<td style='width:100px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$pv_date</td>";
		echo "</tr>";
		
		
	}	
	echo "<td style='width:100px;padding-left:3px;vertical-align:top;padding-top:3px;' ></td>";
		echo "<td style='width:154px;padding-left:3px;vertical-align:top;padding-top:3px;' ></td>";
		echo "<td style='width:103px;padding-left:3px;vertical-align:top;padding-top:3px;' ></td>";		
		echo "<td style='width:173px;padding-left:3px;vertical-align:top;padding-top:3px;' ></td>";
		echo "<td style='width:100px;padding-left:3px;vertical-align:top;padding-top:3px;' ></td>";	
		echo "<td style='width:100px;padding-left:3px;vertical-align:top;padding-top:3px;' ></td>";
		echo "</tr>";
	
	
}
else
{

   echo "<p style=text-align:center;width:896px;font-size:10px;color:#FF0000;'>No record found</p>";

}

echo "</table>";

?>