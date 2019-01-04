
<TITLE>EMS-Report - Sparepart Listing</title>
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
$s_partname = "%".$_GET[sparepartname]."%";
$s_maker = "%".$_GET[maker]."%";
$s_sparepartid = "%".$_GET[sparepartid]."%";
$s_barcode = "%".$_GET[barcode]."%";
$s_spgroup = "%".$_GET[spgroup]."%";
//$s_username = "%".$_GET[username]."%";

$result1= mysql_query("SELECT * from m_company where company = '$_SESSION[company]'  ");
if (!mysql_num_rows($result1) == 0 )
{
	$companydesc = mysql_result($result1, 0, 'description');
}
echo "<div id='rep_balance' >";
echo "<table style='font-family:arial;font-size:12px;'>";
echo "<tr><td style='font-weight:bold;'>$companydesc</td></tr>";
echo "<tr><td style='font-weight:bold;'>Equipment Maintenance System</td></tr>";
echo "<tr><td style='font-weight:bold;'>Report : Sparepart Listing</td></tr>";
echo "<tr><td style=''>Date : $now</td></tr>";
echo "</table>";

echo "<div id='rep_balanceDetail' >";
echo "<p style='font-size:12px;width:200px;'>*Choose to view details</p>";
echo "<table align='center'  style='border:1px solid black;margin-top:20px;font-size:10px;font-family:arial;margin-bottom:30px;text-align:left;border-collapse:collapse;' >";
$result1 = mysql_query("SELECT * from m_sparepart where description like '$s_partname'
														 and sparepartid like '$s_sparepartid'
                                                         and maker like '$s_maker'
														 and barcode like '$s_barcode'
														 and spgroup like '$s_spgroup'
														 order by sparepartid
														 ");
if (!mysql_num_rows($result1) == 0 )
{
	echo "<tr class='' sparepartid='$row1[sparepartid]' equipmentid='$_GET[equipmentid]' barcode='$row1[barcode]' style='cursor:pointer;'>";
	echo "<td style='width:80px;height:24px;border-bottom:1px solid #373737;text-align:center;font-weight:bold;'>No</td>";
	echo "<td style='width:60px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Barcode</td>";
	echo "<td style='width:200px;height:24px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;'>Description</td>";
	//echo "<td style='width:103px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Sparepart Id</td>";
	echo "<td style='width:200px;height:24px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;'>Machine Name</td>";
	echo "</tr>";
	while($row1 = mysql_fetch_array($result1))
    {
    	$result2 = mysql_query("SELECT * from m_equipment_sparepart where sparepartid = '$row1[sparepartid]'");
    	if (!mysql_num_rows($result2) == 0 )
		{
			while($row2 = mysql_fetch_array($result2))
   		    {
   		    	$result3 = mysql_query("SELECT * from m_equipment where equipmentid = '$row2[equipmentid]'");
   		    	if (!mysql_num_rows($result2) == 0 )
				{
					$equipmentid = $row2[equipmentid];
					$equipmentdesc = mysql_result($result3, 0, 'description');
				}
   		    }
			
		}

		$no++;
		echo "<tr id='repSpBalance' class='report' title='Click To View Details' sparepartid='$row1[sparepartid]' equipmentdesc='$equipmentdesc' barcode='$row1[barcode]'>";
		echo "<td style='width:50px;height:24px;border-bottom:1px solid #E9E9E9;text-align:center;vertical-align:top;padding-top:3px;'>$no</td>";
		echo "<td style='width:80px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[barcode]</td>";
		echo "<td style='width:200px;height:24px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;'>$row1[description]</td>";
		//echo "<td style='width:103px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[sparepartid]</td>";
		echo "<td style='width:200px;height:24px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;'>$equipmentdesc</td>";
		echo "</tr>";
		
		
	}	
	echo "<tr id='repSpBalance' class='report' title='Click To View Details' sparepartid='$row1[sparepartid]' equipmentdesc='$equipmentdesc' barcode='$row1[barcode]'>";
		echo "<td style='width:50px;height:24px;text-align:center;vertical-align:top;padding-top:3px;'></td>";
		echo "<td style='width:80px;padding-left:3px;vertical-align:top;padding-top:3px;' ></td>";
		echo "<td style='width:200px;height:24px;padding-left:3px;vertical-align:top;padding-top:3px;'></td>";
		//echo "<td style='width:103px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[sparepartid]</td>";
		echo "<td style='width:200px;height:24px;padding-left:3px;vertical-align:top;padding-top:3px;'></td>";
		echo "</tr>";
		
	
}
else
{

   echo "<p style=text-align:center;width:896px;font-size:10px;color:#FF0000;'>No record found</p>";

}

echo "</table>";
echo "</div>";
echo "</div>";

?>