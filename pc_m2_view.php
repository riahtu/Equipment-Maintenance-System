<?php
session_start();
require("db_ems.php");
echo "<table>";
	echo "<p style='width:100px;font-size:12px;' >Search for parts</p>";
	//echo "<div style='margin-bottom:10px;'>";
	echo "<table style='margin-left:30px;margin-top:10px;margin-bottom:10px;text-align:left;border:1px solid #525252;'>";
		echo "<tr><td style='width:300px;padding-left:3px;'>Sparepart Name</td>";
		echo "<td style='width:100px;padding-left:3px;'>Barcode</td>";
		echo "<td style='width:100px;text-align:center;'>Sparepart id</td>";
		echo "<td style='width:100px;padding-left:3px;'>Part Number</td>";
		//echo "<td style='width:200px;padding-left:3px;'>Machine</td>";
		echo "</tr>";
		echo "<tr><td style='width:100px;'><input id='pc_partname' type='text' style='padding-left:3px;width:300px;height:20px;'/> </td>";
		echo "<td style='width:100px;'><input id='pc_barcode' type='text' style='padding-left:3px;width:100px;height:20px;'/> </td>";
		echo "<td style='width:100px;'><input id='pc_sparepartid' type='text' style='text-align:center;width:100px;height:20px;'/> </td>";
		echo "<td style='width:100px;'><input id='pc_partnumber' type='text' style='padding-left:3px;width:150px;height:20px;'/> </td>";
	    //echo "<td style='width:100px;'><input id='pc_machine' type='text' style='padding-left:3px;width:200px;height:20px;'/> </td>";
		echo "<td style='display:none;width:100px;'><input id='pc_docno' value='$_GET[pcdocno]' type='text' style='padding-left:3px;width:200px;height:20px;'/> </td>";

		echo "</tr>";
	echo "</table>";
	//echo "</div>";
echo "<table>";
echo "<tr><td style='width:1000px;text-align:left;font-size:12px;'>Physical Count Document : $_GET[pcdocno] Count Date : $_GET[countdate] Store : $_GET[storeid]</td>";
echo "<tr><td style='width:1000px;text-align:left;font-size:13px;color:red;'>*Update quantity</td></div></tr>";
echo "</table>";
echo "<table style='font-size:10px;font-family:arial;' cellpadding='0' cellspacing='0'>";
echo "<tr style='background-color:#3796AA;color:#FFFFFF;cursor:pointer;'title='click to sort'>";
echo "<td style='width:30px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;text-align:center;'>No</td>";
echo "<td style='width:100px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Barcode</td>";
echo "<td style='width:100px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Sparepart ID</td>";
echo "<td id='pc_sortPartName' style='width:210px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Sparepart Description</td>";
echo "<td style='width:150px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Part Number</td>";
echo "<td style='width:210px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Machine</td>";
echo "<td style='width:80px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Critical</td>";
echo "<td style='width:80px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Stock Take Quantity</td>";

echo "<td style='width:60px;display:none;height:30px;font-weight:bold;border:1px solid #ACACAC;padding-left:3px;'>Action</td>";
echo "</tr>";
echo "</table>";

echo "<div style='height:600px;overflow-y:auto;border-bottom:1px solid #ACACAC;' id='wo_show_list'>";
echo "<table  style='font-size:10px;font-family:arial;margin-top:2px;border:1px solid #ACACAC;margin-bottom:30px;overflow:auto;' cellpadding='0' cellspacing='0'>";
$result1= mysql_query("SELECT * from physical_count_detail where pc_docno = '$_GET[pcdocno]' order by sparepartid");
if (!mysql_num_rows($result1) == 0 )
{
	$pcdocno = $_GET[pcdocno];
	while($row1 = mysql_fetch_array($result1))
    {
		require('db_ems.php');
		$resultp = mysql_query("SELECT * from m_user where userid = '$row1[userid]'");
		if (!mysql_num_rows($resultp) == 0 )
		{
			 $username = mysql_result($resultp, 0, 'username');
		}		
		require('db_ems.php');
		$resultsp = mysql_query("SELECT * from m_sparepart where sparepartid = '$row1[sparepartid]'");
		if (!mysql_num_rows($resultsp) == 0 )
		{
			 $description = mysql_result($resultsp, 0, 'description');
			 $barcode = mysql_result($resultsp, 0, 'barcode');
			 $partnumber = mysql_result($resultsp, 0, 'part_number');
			 $remarks = mysql_result($resultsp, 0, 'remarks');
			 $critical = mysql_result($resultsp, 0, 'critical');
			 if($critical == '')
			 	$critical = 'No';
			 else
			 	$critical = 'Yes';
		}
		$resultsp = mysql_query("SELECT * from m_equipment_sparepart where sparepartid = '$row1[sparepartid]'");
		if (!mysql_num_rows($resultsp) == 0 )
		{
			 $equipmentid = mysql_result($resultsp, 0, 'equipmentid');
		}
		$resultsp = mysql_query("SELECT * from m_equipment where equipmentid = '$equipmentid'");
		if (!mysql_num_rows($resultsp) == 0 )
		{
			 $equipmentdesc = mysql_result($resultsp, 0, 'description');
		}
		$no++;
		$createtime = convertdatetime($row1[createtime]);
		echo "<tr class='$list_class' >";
		echo "<td  style='width:30px;height:22px;border:1px solid #ACACAC;border-right:0px;border-left:0px;border-top:0px;text-align:center;'>$no</td>";
		echo "<td style='width:100px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$barcode</td>";
		//echo "<td id='pc_docno' style='display:none;'>$pcdocno</td>";
		echo "<td id='pc_sparepartid'style='width:100px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$row1[sparepartid]</td>";
		echo "<td style='width:210px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$description</td>";
		echo "<td style='width:150px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$partnumber</td>";
		echo "<td style='width:210px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$equipmentdesc</td>";
		echo "<td style='width:80px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$critical</td>";
		echo "<td style='width:75px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>";

		if($row1[stocktake_qty]==0)
			echo "<input type='text' id='pc_stocktake_qty' sparepartid='$row1[sparepartid]'pc_docno='$row1[pc_docno]'placeholder='$row1[stocktake_qty]' style='width:75px;border:1px solid #ACACAC;border-right:0px;border:0px;padding-left:3px;color:red;'/></td>";
		else
			echo "<input type='text' id='pc_stocktake_qty' sparepartid='$row1[sparepartid]'pc_docno='$row1[pc_docno]'placeholder='$row1[stocktake_qty]' style='width:75px;border:1px solid #ACACAC;border-right:0px;border:0px;padding-left:3px;'/></td>";

		echo "<td style='display:none;width:60px;border:1px solid #ACACAC;border-top:0px;border-right:0px;padding-left:3px;'>";
		echo "<div class='pc_m2_change' title='Change' pcdocno='$row1[pc_docno]' data-popup-target='#example-popup'></div>"; //oth_wo_change
		echo "</td>";
		echo "</tr>";
		
	}	

}
else
{
	echo "<tr>";
	echo "<td  style='text-align:center;border:0px;width:940px;font-size:14px;color:#FF0000;height:30px;' colspan=6>No Record found</td>";
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