
 <TITLE>EMS-Report - Safety Monitoring</title>
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
$now = date("Y-m-d");
require("db_ems.php");
$_GET[storeid] = 'SAI1';
$s_partname = "%".$_GET[description]."%";
$s_company = "%".$_GET[company]."%";
$s_sparepartid = "%".$_GET[sparepartid]."%";
$s_barcode = "%".$_GET[barcode]."%";
$s_spgroup = "%".$_GET[spgroup]."%";
//$s_username = "%".$_GET[username]."%";
 $startdate = substr($_GET[startdate], 6, 4).'-'. substr($_GET[startdate], 3, 2).'-'. substr($_GET[startdate], 0, 2);
 $enddate = substr($_GET[todate], 6, 4).'-'. substr($_GET[todate], 3, 2).'-'. substr($_GET[todate], 0, 2);


$result1= mysql_query("SELECT * from m_company where company = '$_SESSION[company]'  ");
if (!mysql_num_rows($result1) == 0 )
{
	$companydesc = mysql_result($result1, 0, 'description');
}

echo "<table style='font-family:arial;font-size:12px;'>";
echo "<tr><td style='font-weight:bold;'>$companydesc</td></tr>";
echo "<tr><td style='font-weight:bold;'>Equipment Maintenance System</td></tr>";
echo "<tr><td style='font-weight:bold;'>Report : Safety Monitoring</td></tr>";
echo "<tr><td style=''>Date : $startdate to $enddate</td></tr>";
echo "</table>";

echo "<table align='center' style='margin-top:20px;font-size:10px;font-family:arial;margin-bottom:30px;text-align:left;border-collapse:collapse;border:1px solid black;' >";
$result1 = mysql_query("SELECT * from m_sparepart order by safety_qty desc");
ini_set('max_execution_time', 300);														 
if (!mysql_num_rows($result1) == 0 )
{
	echo "<tr class='' sparepartid='$row1[sparepartid]' equipmentid='$_GET[equipmentid]' barcode='$row1[barcode]' style='cursor:pointer;'>";
	echo "<td style='width:80px;height:24px;border-bottom:1px solid #373737;text-align:center;font-weight:bold;'>No</td>";
	echo "<td style='width:200px;height:24px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;'>Sparepart Name</td>";
	echo "<td style='width:200px;height:24px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;'>Equipment</td>";
	echo "<td style='width:103px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Sparepart Id</td>";
	echo "<td style='width:173px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Barcode</td>";
	echo "<td style='width:100px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Safety Quantity</td>";		
	echo "<td style='width:100px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Balance</td>";	
	echo "</tr>";

	while($row1 = mysql_fetch_array($result1))
    {
   // $open_startdate = $startdate;
 // Getting opening value
   	   $safety_qty = $row1[safety_qty];
       $count++; $opening = 0;
		require('db_ems.php');
		$balance = 0;
	
		// GET opening stock
		unset($a_sort);unset($a_no);unset($a_date);unset($a_description);unset($a_sort);unset($a_trans_qty);unset($a_trans_type);
		unset($a_reason);
		$a_sort = (array) null;
		$a_no = (array) null;
		$open_startdate = $startdate;
		$resultcount = mysql_query("SELECT * FROM physical_count_detail where
		                           sparepartid = '$row1[sparepartid]' and stocktake_date < '$startdate'  order by stocktake_date desc,createtime limit 1");

		if (!mysql_num_rows($resultcount) == 0 )
		{
			while ($rowcount = mysql_fetch_array($resultcount))
			{
			$no++;

			   $balance = $rowcount[stocktake_qty] ;
			    $open_startdate = $rowcount[stocktake_date];
			}
		}

		$resultcount = mysql_query("SELECT * FROM physical_count_detail where storeid = '$_GET[storeid]' and
		                           sparepartid = '$row1[sparepartid]' and stocktake_date >= '$open_startdate' and stocktake_date <= '$enddate' order by stocktake_date desc,createtime ");
		if (!mysql_num_rows($resultcount) == 0 )
		{
			while ($rowcount = mysql_fetch_array($resultcount))
			{
			$no++;
			   $balance += $rowcount[stocktake_qty] ;
			   
			 
			}
		}
		
		
		$resultcount = mysql_query("SELECT * FROM mpr_receipt,mpr_receipt_header where
		                           mpr_receipt.sparepartid = '$row1[sparepartid]' and mpr_receipt_header.docdate >= '$open_startdate' and mpr_receipt_header.docdate <= '$enddate' 
								   and mpr_receipt.docno = mpr_receipt_header.docno
								   order by mpr_receipt_header.docdate,mpr_receipt.createtime ");
		if (!mysql_num_rows($resultcount) == 0 )
		{
			while ($rowcount = mysql_fetch_array($resultcount))
			{
				$no++;
			   $balance += $rowcount[quantity] ;
			}
		}
		
		$resultcount1 = mysql_query("SELECT * FROM mop_issue where  storeid = '$_GET[storeid]' and
		                           sparepartid = '$row1[sparepartid]' and quantity != 0 and
								transdate >= '$open_startdate' and transdate < '$enddate' 
								order by transdate,createtime ");
		if (!mysql_num_rows($resultcount1) == 0 )
		{
			while ($rowcount1 = mysql_fetch_array($resultcount1))
			{
			$no++;
			    $receipientname = '';
				 $resultemp = mysql_query("SELECT * FROM m_user where userid = '$rowcount2[receipient]'");
				if (!mysql_num_rows($resultemp) == 0 )
				{
					$receipientname = mysql_result($resultemp, 0, 'username');
				}
			   require('db_ems.php');
			   $balance -= $rowcount1[quantity] ;
			 
			}
		}

		$resultcount1 = mysql_query("SELECT * FROM mop_return where  storeid = '$_GET[storeid]' and
		                           sparepartid = '$row1[sparepartid]' and return_quantity != 0 and
								transdate >= '$open_startdate' and transdate < '$enddate' 
								order by transdate,createtime ");
		if (!mysql_num_rows($resultcount1) == 0 )
		{
			while ($rowcount1 = mysql_fetch_array($resultcount1))
			{
			$no++;
			    $receipientname = '';
				 $resultemp = mysql_query("SELECT * FROM m_user where userid = '$rowcount1[receipient]'");
				if (!mysql_num_rows($resultemp) == 0 )
				{
					$receipientname = mysql_result($resultemp, 0, 'username');
				}
			   require('db_ems.php');
			   $balance += $rowcount1[return_quantity];
			}
		}	

		$resultcount = mysql_query("SELECT * FROM mprv_reverse,mprv_reverse_header where
		                           mprv_reverse.sparepartid = '$row1[sparepartid]' and mprv_reverse_header.docdate >= '$open_startdate' and mprv_reverse_header.docdate <= '$enddate' 
								   and mprv_reverse.docno = mprv_reverse_header.docno
								   order by mprv_reverse_header.docdate,mprv_reverse.createtime ");
		if (!mysql_num_rows($resultcount) == 0 )
		{
			while ($rowcount = mysql_fetch_array($resultcount))
			{
			   $no++;
			   $balance -= $rowcount[quantity] ;
			
			}
		}

		$resultcount = mysql_query("SELECT * FROM mppr_return,mppr_return_header where
		                           mppr_return.sparepartid = '$row1[sparepartid]' and mppr_return_header.docdate >= '$open_startdate' and mppr_return_header.docdate <= '$enddate' 
								   and mppr_return.docno = mppr_return_header.docno
								   order by mppr_return_header.docdate,mppr_return.createtime ");
		if (!mysql_num_rows($resultcount) == 0 )
		{
			while ($rowcount = mysql_fetch_array($resultcount))
			{
			    $no++;
			   $balance -= $rowcount[quantity] ;
			
			}
		}
		

		$resultx = mysql_query("SELECT * from m_equipment_sparepart where sparepartid like $row1[sparepartid]");
		if (!mysql_num_rows($resultx) == 0 )
		{
			while ($rowx = mysql_fetch_array($resultx))
			{
				$resultxx = mysql_query("SELECT * FROM m_equipment where equipmentid = '$rowx[equipmentid]'");
				if (!mysql_num_rows($resultxx) == 0 )
				{
					$equipmentname = mysql_result($resultxx, 0, 'description');
				}
			}

		}

		if($balance<$safety_qty)
		{
			$num++;
			echo "<tr class='report' sparepartid='$row1[sparepartid]' equipmentid='$_GET[equipmentid]' barcode='$row1[barcode]' style='cursor:pointer;'>";
			echo "<td style='width:50px;height:24px;border-bottom:1px solid #E9E9E9;text-align:center;vertical-align:top;padding-top:3px;'>$num</td>";
			
			echo "<td style='width:200px;height:24px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;'>$row1[description]</td>";
			echo "<td style='width:200px;height:24px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;'>$equipmentname</td>";
			echo "<td style='width:103px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[sparepartid]</td>";
			
			echo "<td style='width:173px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[barcode]</td>";
			echo "<td style='width:100px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;'>$row1[safety_qty]</td>";

			echo "<td style='width:100px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;'>$balance</td>";
			echo "</tr>";
		}
		
		
		
		
	}	
	
	echo "<tr class='report' sparepartid='$row1[sparepartid]' equipmentid='$_GET[equipmentid]' barcode='$row1[barcode]' style='cursor:pointer;'>";
			echo "<td style='width:50px;height:24px;text-align:center;vertical-align:top;padding-top:3px;'></td>";
			
			echo "<td style='width:200px;height:24px;padding-left:3px;vertical-align:top;padding-top:3px;'></td>";
			echo "<td style='width:200px;height:24px;padding-left:3px;vertical-align:top;padding-top:3px;'></td>";
			echo "<td style='width:103px;padding-left:3px;vertical-align:top;padding-top:3px;' ></td>";
			
			echo "<td style='width:173px;padding-left:3px;vertical-align:top;padding-top:3px;' ></td>";
			echo "<td style='width:100px;padding-left:3px;vertical-align:top;'></td>";

			echo "<td style='width:100px;padding-left:3px;vertical-align:top;'></td>";
			echo "</tr>";
}
else
{

   echo "<p style=text-align:center;width:896px;font-size:10px;color:#FF0000;'>No record found</p>";

}

echo "</table>";

	/*	echo "<tr class='' sparepartid='$row1[sparepartid]' equipmentid='$_GET[equipmentid]' barcode='$row1[barcode]' style='cursor:pointer;'>";
		echo "<td style='width:50px;height:24px;border-bottom:1px solid #E9E9E9;text-align:center;vertical-align:top;padding-top:3px;'>$no</td>";
		echo "<td style='width:154px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[maker]</td>";
		echo "<td style='width:200px;height:24px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;'>$row1[description]</td>";
		echo "<td style='width:103px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[sparepartid]</td>";
		
		echo "<td style='width:173px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[barcode]</td>";
		echo "<td style='width:100px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[spgroup]</td>";	
		echo "<td style='width:100px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;'>$opening</td>";
		echo "</tr>";
	*/
?>