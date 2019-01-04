
 <TITLE>EMS-Report - Equipment Listing</title>
<?php
session_start();
 date_default_timezone_set('Asia/Kuala_lumpur');
 $now = date("d-m-Y H:i:s");
require("db_ems.php");
$s_equipmentid = "%".$_GET[equipmentid]."%";
$s_linecode = "%".$_GET[linecode]."%";
$s_company= "%".$_GET[company]."%";
$s_description = "%".$_GET[description]."%";
$result1= mysql_query("SELECT * from m_company where company = '$_SESSION[company]'  ");
if (!mysql_num_rows($result1) == 0 )
{
	$companydesc = mysql_result($result1, 0, 'description');
}
echo "<table border=0 style='font-family:arial;font-size:12px;'>";
echo "<tr><td style='font-weight:bold;'>$companydesc</td></tr>";
echo "<tr><td style='font-weight:bold;'>Equipment Maintenance System</td></tr>";
echo "<tr><td style='font-weight:bold;'>Report :Preventive Maintenance History Listing</td></tr>";
echo "<tr><td style=''>Date : $now</td></tr>";
echo "</table>";

echo "<table style='margin-top:20px;font-size:10px;font-family:arial;margin-bottom:30px;text-align:left;border-collapse:collapse;' >";
$result1 = mysql_query("SELECT * from m_equipment where description like '$s_description'
														 
                                                         and linecode like '$s_linecode'
								
														 order by linecode
														 ");

if (!mysql_num_rows($result1) == 0 )
{
	echo "<tr class='' sparepartid='$row1[sparepartid]' equipmentid='$_GET[equipmentid]' barcode='$row1[barcode]' style='cursor:pointer;'>";
	echo "<td style='width:154px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Linecode</td>";
	echo "<td style='width:80px;height:24px;border-bottom:1px solid #373737;text-align:center;font-weight:bold;'>No</td>";
	
	//echo "<td style='width:200px;height:24px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;'>Equipmentid</td>";
	echo "<td style='width:103px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;'>Machine Name</td>";
	echo "<td style='border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' ></td>";
	echo "</tr>";

	while($row1 = mysql_fetch_array($result1))
    {

    	if($save_linecode != $row1[linecode]){
    		echo "<tr><<td style='height:10px'></td></tr>";
    		echo "<tr><td colspan=4 style='width:154px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[linecode]</td></tr>";
			$save_linecode = $row1[linecode];
			$no = 0;
		}
		$no++;
		echo "<tr class='' sparepartid='$row1[sparepartid]' equipmentid='$_GET[equipmentid]' barcode='$row1[barcode]' style='cursor:pointer;'>";

		echo "<td></td><td style='width:50px;height:24px;border-bottom:1px solid #E9E9E9;text-align:center;vertical-align:top;padding-top:3px;'>$no</td>";
		
		
		echo "<td style='width:103px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[description]</td>";

		echo "<td style='border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >";
		$result2 = mysql_query("SELECT * from t_workorder where equipmentid like '$row1[equipmentid]'
																
																and wo_type = 'PV'
																");
		
		if (!mysql_num_rows($result2) == 0 )
		{	
			echo "<table style='font-size:10px;font-family:arial;border-collapse:collapse;'>";
			echo "<tr><td style='width:200px;border-bottom:1px solid black;padding-left:3px;font-weight:bold;vertical-align:top;padding-top:3px;'>Sparepart Name</td>";

			echo "<td style='width:103px;font-weight:bold;text-align:center;border-bottom:1px solid black;padding-left:3px;vertical-align:top;padding-top:3px;'>Order Quantity</td>";

			echo "<td style='width:103px;font-weight:bold;text-align:center;border-bottom:1px solid black;padding-left:3px;vertical-align:top;padding-top:3px;'>Issued Quantity</td></tr>";
				
			while($row2 = mysql_fetch_array($result2))
			{
				$sparepart_name = "";
				$result3 = mysql_query("SELECT * from t_workorder_parts where workorderid like '$row2[workorderid]'
																				 
																						");
				if (!mysql_num_rows($result3) == 0 )
				{	
					while($row3 = mysql_fetch_array($result3))
					{
						echo "<tr><td style='width:200px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;'>$row3[sparepartname]</td>";

						echo "<td style='width:103px;text-align:center;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;'>$row3[orderqty]</td>";

						$result4 = mysql_query("SELECT * from mop_issue where workorderid like '$row2[workorderid]'");
						if (!mysql_num_rows($result4) == 0 )
						{
							while($row4 = mysql_fetch_array($result4))
							{
								echo "<td style='width:103px;text-align:center;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;'>$row4[quantity]</td></tr>";
							}
						}
						else
						{
							echo "<td style='width:103px;text-align:center;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;'>0</td></tr>";

						}
					
				
					}
				}
				
				
			
			}
			echo "</table>";
		}
		echo "</td>";
		//echo "<td style='width:200px;height:24px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;'>$row1[equipmentid]</td>";
		//echo "<td style='width:103px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[description]</td>";
		
		echo "</tr>";
		
		
	}	
	
}
else
{

   echo "<p style=text-align:center;width:896px;font-size:10px;color:#FF0000;'>No record found</p>";

}

echo "</table>";

?>