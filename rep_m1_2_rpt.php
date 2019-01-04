
 <TITLE>EMS-Report - Sparepart Listing</title>
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
$result1= mysql_query("SELECT * from m_company where company = '$_SESSION[company]'  ");
if (!mysql_num_rows($result1) == 0 )
{
	$companydesc = mysql_result($result1, 0, 'description');
}
echo "<table style='font-family:arial;font-size:12px;'>";
echo "<tr><td style='font-weight:bold;'>$companydesc</td></tr>";
echo "<tr><td style='font-weight:bold;'>Equipment Maintenance System</td></tr>";
echo "<tr><td style='font-weight:bold;'>Report : Sparepart with Location Bin</td></tr>";
echo "<tr><td style=''>Date : $now</td></tr>";
echo "</table>";
echo "<table  style='margin-top:20px;font-size:10px;font-family:arial;margin-bottom:30px;text-align:left;' >";
$result1 = mysql_query("SELECT * from m_sparepart,m_sparepart_location where m_sparepart.description like '$s_partname'
														and m_sparepart.sparepartid like '$s_sparepartid'
                                                         and m_sparepart.maker like '$s_maker'
														 and m_sparepart.barcode like '$s_barcode'
														 and m_sparepart.spgroup like '$s_spgroup'
														 and m_sparepart.sparepartid = m_sparepart_location.sparepartid
														 order by m_sparepart_location.locationcode,m_sparepart.maker,m_sparepart.description
														 ");
if (!mysql_num_rows($result1) == 0 )
{
	echo "<tr class='' sparepartid='$row1[sparepartid]' equipmentid='$_GET[equipmentid]' barcode='$row1[barcode]' style='cursor:pointer;'>";
	echo "<td style='width:80px;height:24px;border-bottom:1px solid #373737;text-align:center;font-weight:bold;'>No</td>";
	echo "<td style='width:100px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Bin Locations</td>";	
	echo "<td style='width:154px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Maker</td>";
	echo "<td style='width:200px;height:24px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;'>Sparepart Name</td>";
	echo "<td style='width:103px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Sparepart Id</td>";
	
	echo "<td style='width:173px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Barcode</td>";
	echo "<td style='width:100px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Group</td>";	

	echo "</tr>";
	while($row1 = mysql_fetch_array($result1))
    {

		$no++;
		echo "<tr class='' sparepartid='$row1[sparepartid]' equipmentid='$_GET[equipmentid]' barcode='$row1[barcode]' style='cursor:pointer;'>";
		echo "<td style='width:50px;height:24px;border-bottom:1px solid #E9E9E9;text-align:center;vertical-align:top;padding-top:3px;'>$no</td>";
		echo "<td style='width:154px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[locationcode]</td>";
		echo "<td style='width:154px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[maker]</td>";
		echo "<td style='width:200px;height:24px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;'>$row1[description]</td>";
		echo "<td style='width:103px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[sparepartid]</td>";
		
		echo "<td style='width:173px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[barcode]</td>";
		echo "<td style='width:100px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[spgroup]</td>";	
		
		echo "</tr>";
		
		
	}	
	
}
else
{

   echo "<p style=text-align:center;width:896px;font-size:10px;color:#FF0000;'>No record found</p>";

}

echo "</table>";

?>