
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
echo "<tr><td style='font-weight:bold;'>Report : Equipment Listing</td></tr>";
echo "<tr><td style=''>Date : $now</td></tr>";
echo "</table>";
echo "<table border=0 style='margin-top:20px;font-size:10px;font-family:arial;margin-bottom:30px;text-align:left;' >";
$result1 = mysql_query("SELECT * from m_equipment ");
if (!mysql_num_rows($result1) == 0 )
{
	echo "<tr class='' sparepartid='$row1[sparepartid]' equipmentid='$_GET[equipmentid]' barcode='$row1[barcode]' style='cursor:pointer;'>";
	echo "<td style='width:154px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Linecode</td>";
	echo "<td style='width:80px;height:24px;border-bottom:1px solid #373737;text-align:center;font-weight:bold;'>No</td>";
	
	//echo "<td style='width:200px;height:24px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;'>Equipmentid</td>";
	echo "<td style='width:103px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;'>Equipment Name</td>";
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
		$result2 = mysql_query("SELECT * from m_equipment_sparepart where equipmentid like '$row1[equipmentid]'");
		if (!mysql_num_rows($result2) == 0 )
		{	
			echo "<table style='font-size:10px;font-family:arial;'>";
			echo "<tr><td style='width:200px;border-bottom:1px solid #E9E9E9;padding-left:3px;font-weight:bold;vertical-align:top;padding-top:3px;'>Sparepart Name</td>";
			echo "<td style='width:103px;font-weight:bold;text-align:center;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;'>Sparepart id</td>";
			echo "<td style='width:103px;font-weight:bold;text-align:center;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;'>Safety Quantity</td>";
			echo "<td style='width:103px;font-weight:bold;text-align:center;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;'>Balance</td></tr>";
				
			while($row2 = mysql_fetch_array($result2))
			{
				$sparepart_name = "";
				$result3 = mysql_query("SELECT * from m_sparepart where sparepartid like '$row2[sparepartid]' ");
				if (!mysql_num_rows($result3) == 0 )
				{	
					while($row3 = mysql_fetch_array($result3))
					{
						$sparepart_name = $row3[description];
						$safety_qty = $row3[safety_qty];
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
						                           sparepartid = '$row3[sparepartid]' and stocktake_date < '$startdate'  order by stocktake_date desc,createtime limit 1");

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
						                           sparepartid = '$row3[sparepartid]' and stocktake_date >= '$open_startdate' and stocktake_date <= '$enddate' order by stocktake_date desc,createtime ");
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
						                           mpr_receipt.sparepartid = '$row3[sparepartid]' and mpr_receipt_header.docdate >= '$open_startdate' and mpr_receipt_header.docdate <= '$enddate' 
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
						                           sparepartid = '$row3[sparepartid]' and quantity != 0 and
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
							 
							}
						}
						if($balance<$safety_qty)
						{
							$num++;
						/*	echo "<tr class='' sparepartid='$row1[sparepartid]' equipmentid='$_GET[equipmentid]' barcode='$row1[barcode]' style='cursor:pointer;'>";
							echo "<td style='width:50px;height:24px;border-bottom:1px solid #E9E9E9;text-align:center;vertical-align:top;padding-top:3px;'>$num</td>";
							
							echo "<td style='width:200px;height:24px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;'>$row1[description]</td>";
							echo "<td style='width:103px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[sparepartid]</td>";
							
							echo "<td style='width:173px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row1[barcode]</td>";*/
							echo "<td style='width:200px;height:24px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;'>$row3[description]</td>";
							echo "<td align='center' style='width:103px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;' >$row3[sparepartid]</td>";
							echo "<td align='center'style='width:100px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;'>$safety_qty</td>";
							echo "<td align='center' style='width:100px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;'>$balance</td>";
							echo "</tr>";
						}
					
					}
				}
				//echo "<tr><td style='width:200px;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;'>$sparepart_name</td><td style='width:103px;text-align:center;border-bottom:1px solid #E9E9E9;padding-left:3px;vertical-align:top;padding-top:3px;'>$row2[def_qty]</td></tr>";
				
			
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