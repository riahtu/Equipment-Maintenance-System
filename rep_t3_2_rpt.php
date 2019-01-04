
 <TITLE>EMS-Report - Stock Balance Listing</title>
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
echo "<tr><td style='font-weight:bold;'>Report : Stock Balance Listing</td></tr>";
echo "<tr><td style=''>Date : $startdate to $enddate</td></tr>";
echo "</table>";
echo "<table  style='margin-top:20px;font-size:10px;font-family:arial;margin-bottom:30px;text-align:left;' >";
$result1 = mysql_query("SELECT * from m_sparepart order by sparepartid ");
														 
if (!mysql_num_rows($result1) == 0 )
{
	echo "<tr class='' sparepartid='$row1[sparepartid]' equipmentid='$_GET[equipmentid]' barcode='$row1[barcode]' style='cursor:pointer;'>";
	echo "<td style='width:80px;height:24px;border-bottom:1px solid #373737;text-align:center;font-weight:bold;'>No</td>";
	echo "<td style='width:200px;height:24px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;'>Sparepart Name</td>";
	echo "<td style='width:103px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Sparepart Id</td>";
	
	echo "<td style='width:173px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Barcode</td>";	
	echo "<td style='width:100px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Balance</td>";	
	echo "</tr>";

	while($row1 = mysql_fetch_array($result1))
    {
   // $open_startdate = $startdate;
 // Getting opening value
   
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
			   echo "<tr><td> Check pc $row1[sparepartid]</td></tr>";
			   $balance = $rowcount[stocktake_qty] ;
			    $open_startdate = $rowcount[stocktake_date];
			  // echo "<tr><td>Stock count 1 $no open_startdate $open_startdate rowcount[stocktake_qty] $rowcount[stocktake_qty]</td></tr>";
			}
		}
		 // echo "<tr><td colspan=5>Stock count $no open_startdate $open_startdate startdate2 $startdate2</td></tr>";
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
		
		//echo "<tr class='' sparepartid='$row1[sparepartid]' equipmentid='$_GET[equipmentid]' barcode='$row1[barcode]' style='cursor:pointer;'>";
		//echo "<td style='width:100px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >$stocktake_quantity</td>";		
		// echo "<tr><td>Receipt $no $_POST[storeid] $row1[sparepartid]</td></tr>";
		
		$resultcount = mysql_query("SELECT * FROM mpr_receipt,mpr_receipt_header where
		                           mpr_receipt.sparepartid = '$row1[sparepartid]' and mpr_receipt_header.docdate >= '$open_startdate' and mpr_receipt_header.docdate <= '$enddate' 
								   and mpr_receipt.docno = mpr_receipt_header.docno
								   order by mpr_receipt_header.docdate,mpr_receipt.createtime ");
		if (!mysql_num_rows($resultcount) == 0 )
		{
			while ($rowcount = mysql_fetch_array($resultcount))
			{
				$no++;
			   $balance = $rowcount[quantity] ;
			
			   // echo "<tr><td>Preceipt $no $_POST[storeid] $row1[sparepartid] $receipt_date $rowcount[quantity]  rowcount[docdate] $rowcount[docdate]</td></tr>";
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
			   $balance += $rowcount1[quantity] ;
			 
			   //echo "<tr><td>RI $no open_startdate rowcount1[transdate] $rowcount1[transdate] rowcount1[docno] $rowcount1[docno]$open_startdate $_POST[storeid] $row1[sparepartid] $rowcount1[quantity] -->$empname</td></tr>";
			}
		}
		/*array_multisort($a_sort,SORT_DESC, $a_no);
		foreach( $a_no as $key => $value) 
		{		
			$no2++;
			if ($a_trans_type[$value] == 'SC' ) 
			{
			$variance =  $a_trans_qty[$value] - $balance;
			$balance = $a_trans_qty[$value];
			}
			else if ($a_trans_type[$value] == 'STIS')
			{
			$variance = '';
			$balance += -($a_trans_qty[$value]);
			}
			else
			{
			$variance = '';
			$balance += $a_trans_qty[$value];
			}
			
		}*/
		$num++;
		echo "<tr class='' sparepartid='$row1[sparepartid]' equipmentid='$_GET[equipmentid]' barcode='$row1[barcode]' style='cursor:pointer;'>";
		echo "<td style='width:50px;height:24px;border-bottom:1px solid #E9E9E9;text-align:center;vertical-align:top;padding-top:3px;'>$num</td>";
		
		echo "<td style='width:200px;height:24px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;'>$row1[description]</td>";
		echo "<td style='width:103px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[sparepartid]</td>";
		
		echo "<td style='width:173px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[barcode]</td>";
		echo "<td style='width:100px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;'>$balance</td>";
		echo "</tr>";
		
		
		
	}	
	
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