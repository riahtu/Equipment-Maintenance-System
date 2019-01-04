
 <TITLE>EMS- Stock Card</title>
<?php
session_start();
date_default_timezone_set('Asia/Kuala_lumpur');
$now = date("d-m-Y H:i:s");
require("db_ems.php");
$s_partname = $_GET[description];
$s_maker = "%".$_GET[maker]."%";
$s_sparepartid = "%".$_GET[sparepartid]."%";
$s_barcode = "%".$_GET[barcode]."%";
$s_spgroup = "%".$_GET[spgroup]."%";
$_GET[storeid] = 'SAI1';
 $nodays = date("t", strtotime($_POST[year] . "-" . $_POST[month] . "-01"));
 $enddate =  $_POST[year].'-'.$_POST[month].'-'.$nodays;
$startdate = substr($_GET[startdate], 6, 4).'-'. substr($_GET[startdate], 3, 2).'-'. substr($_GET[startdate], 0, 2);
$enddate = substr($_GET[enddate], 6, 4).'-'. substr($_GET[enddate], 3, 2).'-'. substr($_GET[enddate], 0, 2);
//$s_username = "%".$_GET[username]."%";

$result1= mysql_query("SELECT * from m_company where company = '$_SESSION[company]'  ");
if (!mysql_num_rows($result1) == 0 )
{
	$companydesc = mysql_result($result1, 0, 'description');
}
echo "<table style='font-family:arial;font-size:12px;'>";
echo "<tr><td style='font-weight:bold;font-size:15px;font-family:Sapura;'>$companydesc</td></tr>";
echo "<tr><td style='font-weight:bold;'>Equipment Maintenance System</td></tr>";
echo "<tr><td style='font-weight:bold;height:20px;'>Report : Machine Spare Part Control Card</td></tr>";
echo "<tr><td style='font-weight:bold;'>Selection from: $startdate  -  $enddate</td></tr>";
echo "</table>";
$result1 = mysql_query("SELECT * from m_sparepart where description like '$s_partname' 
													and sparepartid like '$s_sparepartid'
													and barcode     like '$s_barcode'
														");

if (!mysql_num_rows($result1) == 0 )
{
	$sparepartid =  mysql_result($result1, 0,'sparepartid');
	$partnumber = mysql_result($result1, 0,'part_number');
	$critical = mysql_result($result1, 0,'critical');
	$safety_qty = mysql_result($result1, 0,'safety_qty');

	if($critical == '')
		$critical = 'NO';
	else
		$critical = 'YES';

	$resulteq= mysql_query("SELECT * from m_equipment_sparepart where sparepartid like '$s_sparepartid'");
	if (!mysql_num_rows($resulteq) == 0 )
	{	
		while($roweq = mysql_fetch_array($resulteq))
	    {
			$result3 = mysql_query("SELECT * from m_equipment where equipmentid like '$roweq[equipmentid]'");
			if (!mysql_num_rows($result3)==0)
			{
				
				$machine_name = mysql_result($result3, 0,'description');
			}
		}
	}	
	
	//echo "</table>";


 $open_startdate = '2017-01-01';

 
       $count++; $opening = 0;
		require('db_ems.php');
		
	
		// GET opening stock
		unset($a_sort);unset($a_no);unset($a_date);unset($a_description);unset($a_sort);unset($a_trans_qty);unset($a_trans_type);
		unset($a_reason);
		$a_sort = (array) null;
		$a_no = (array) null;
		$resultcount = mysql_query("SELECT * FROM physical_count_detail where storeid = '$_GET[storeid]' and
		                           sparepartid = '$sparepartid' and stocktake_date < '$startdate'  order by stocktake_date desc,createtime limit 1");

		if (!mysql_num_rows($resultcount) == 0 )
		{
			while ($rowcount = mysql_fetch_array($resultcount))
			{
			$no++;
			 $receipientname = '';
				 $resultemp = mysql_query("SELECT * FROM m_user where userid = '$rowcount[userid]'");
				if (!mysql_num_rows($resultemp) == 0 )
				{
						$receipientname = mysql_result($resultemp, 0, 'username');
				}					
				
			   $stocktake_date = convertdate($rowcount[stocktake_date]);
			   $a_sort[$no] = $rowcount[stocktake_date];
			   $a_test[$no] = $rowcount[stocktake_date];
			   $a_no[$no] = $no;
			   $a_date[$no] = $rowcount[stocktake_date];
			   $a_description[$no] = 'Stock Count on the date of '.$stocktake_date ;
			   $a_trans_qty[$no] = $rowcount[stocktake_qty] ;
			   $a_trans_type[$no] = 'SC';
			   $a_pic[$cd_no] = $receipientname;
			   $a_docno[$cd_no] = $rowcount[pc_docno];
			   $open_startdate = $rowcount[stocktake_date];
			 
			  // echo "<tr><td>Stock count 1 $no open_startdate $open_startdate rowcount[stocktake_qty] $rowcount[stocktake_qty]</td></tr>";
			}
		}
		 // echo "<tr><td colspan=5>Stock count $no open_startdate $open_startdate startdate2 $startdate2</td></tr>";
		$resultcount = mysql_query("SELECT * FROM physical_count_detail where storeid = '$_GET[storeid]' and
		                           sparepartid = '$sparepartid' and stocktake_date > '$open_startdate' and stocktake_date < '$startdate' order by stocktake_date desc,createtime ");
		if (!mysql_num_rows($resultcount) == 0 )
		{
			while ($rowcount = mysql_fetch_array($resultcount))
			{
				$no++;
				 $receipientname = '';
				 $resultemp = mysql_query("SELECT * FROM m_user where userid = '$rowcount[userid]'");
				if (!mysql_num_rows($resultemp) == 0 )
				{
						$receipientname = mysql_result($resultemp, 0, 'username');
				}
				   $stocktake_date = convertdate($rowcount[stocktake_date]);
				   $a_sort[$no] = $rowcount[stocktake_date];
				   $a_test[$no] = $rowcount[stocktake_date];
				   $a_no[$no] = $no;
				   $a_date[$no] = $rowcount[stocktake_date];
				   $a_description[$no] = 'Stock Count on the date of '.$stocktake_date ;
				   $a_trans_qty[$no] = $rowcount[stocktake_qty] ;
				   $a_pic[$cd_no] = $receipientname;
				   $a_docno[$cd_no] = $rowcount[pc_docno];
				   $a_trans_type[$no] = 'SC';
			  // echo "<tr><td>Stock count   $no $_POST[storeid] $row1[sparepartid] $rowcount[stocktake_qty]</td></tr>";
			}
		}
		// echo "<tr><td>Receipt $no $_POST[storeid] $row1[sparepartid]</td></tr>";
		
		$resultcount = mysql_query("SELECT * FROM mpr_receipt,mpr_receipt_header where mpr_receipt.storeid = '$_GET[storeid]' and
		                           mpr_receipt.sparepartid = '$sparepartid' and mpr_receipt_header.docdate >= '$open_startdate' and mpr_receipt_header.docdate < '$startdate' 
								   and mpr_receipt.docno = mpr_receipt_header.docno
								   order by mpr_receipt_header.docdate,mpr_receipt.createtime ");
		if (!mysql_num_rows($resultcount) == 0 )
		{
			while ($rowcount = mysql_fetch_array($resultcount))
			{
			 $resultemp = mysql_query("SELECT * FROM m_supplier where supplierid = '$rowcount[supplierid]'");
				if (!mysql_num_rows($resultemp) == 0 )
				{
								$supplierdesc = mysql_result($resultemp, 0, 'description');
				}
				$no++;
			   $receipt_date = convertdate($rowcount[docdate]);
			   $a_sort[$no] = $rowcount[docdate]. $rowcount[createtime];
			   $a_test[$no] = $rowcount[docdate]. $rowcount[createtime];
			   $a_no[$no] = $no;
			   $a_date[$no] = $rowcount[docdate];
			   $a_supplier[$no] = $supplierdesc ;
			   $a_description[$no] = $supplierdesc ;
			   $a_trans_qty[$no] = $rowcount[quantity] ;
			   $a_trans_type[$no] = 'PR';
			   
			   // echo "<tr><td>Preceipt $no $_POST[storeid] $row1[sparepartid] $receipt_date $rowcount[quantity]  rowcount[docdate] $rowcount[docdate]</td></tr>";
			}
		}
		
		$resultcount1 = mysql_query("SELECT * FROM mop_issue where  storeid = '$_GET[storeid]' and
		                           sparepartid = '$sparepartid' and quantity != 0 and
								transdate >= '$open_startdate' and transdate < '$startdate' 
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
			   $a_sort[$no] = $rowcount1[transdate]. $rowcount1[createtime];
			   $a_test[$no] = $rowcount1[transdate]. $rowcount1[createtime];
			   $a_no[$no] = $no;
			   $a_date[$no] = $rowcount1[transdate];
			   $a_description[$no] = $receipientname;
			   $a_reason[$no] = $rowcount1[reason];
			   $a_trans_qty[$no] = $rowcount1[quantity] ;
			   $a_trans_type[$no] = 'STIS';
			   //echo "<tr><td>RI $no open_startdate rowcount1[transdate] $rowcount1[transdate] rowcount1[docno] $rowcount1[docno]$open_startdate $_POST[storeid] $row1[sparepartid] $rowcount1[quantity] -->$empname</td></tr>";
			}
		}

		array_multisort($a_sort,SORT_DESC, $a_no);
		foreach( $a_no as $key => $value) 
		{
			if ($a_trans_type[$value] == 'SC' ) 
			{
				if ($a_trans_qty[$value] != 0)
					$balance = $a_trans_qty[$value];

			}
			else if ($a_trans_type[$value] == 'STIS')
			{
				$balance += -($a_trans_qty[$value]);
			}
			else
				$balance += $a_trans_qty[$value];		
		}
		$opening = $balance;

	echo "<table  style='border-collapse:collapse;margin-top:20px;font-size:10px;font-family:arial;margin-bottom:10px;text-align:left;' >";

	echo "<tr>";
	echo "<td style='width:250px;height:28px;border-bottom:1px solid #373737;text-align:center;font-weight:bold;'>Machine Name : $machine_name</td>";
	echo "<td style='width:225px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Part Name: $s_partname</td>";
	echo "<td style='width:150px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Part Number: $partnumber</td>";
	echo "<td style='width:100px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Critical: $critical</td>";
	echo "<td style='width:100px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Safety Quantity: $safety_qty</td></tr>";
	echo "</table>";

	echo "<table class='stock_card' style='font-size:10px;font-family:arial;text-align:left;' >";
	echo "<tr class='test' style='border-bottom:1px solid black;'><td style='width:40px;'></td><tdstyle='width:100px;'></td><tdstyle='width:80px;'></td><td style='width:50px;'></td><td style='width:475px;'></td><td style='width:200px;font-weight:bold;'>Balance brought forward as opening:</td><td style='width:50px;'>$opening</td></tr>";
	echo "</table>";

	echo "<table class='stock_card' style='border-collapse:collapse;border:1px solid black;margin-top:10px;font-size:10px;font-family:arial;margin-bottom:30px;text-align:center;' >";
	echo "<tr class='' sparepartid='$row1[sparepartid]' equipmentid='$_GET[equipmentid]' barcode='$row1[barcode]' style='cursor:pointer;'>";
	echo "<td style='border-right:1px solid black;width:40px;height:24px;border-bottom:1px solid #373737;text-align:center;font-weight:bold;'>No</td>";
	echo "<td style='border-right:1px solid black;width:100px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Date</td>";
	echo "<td style='border-right:1px solid black;width:80px;height:24px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;'>Trans Type</td>";
	echo "<td style='border-right:1px solid black;width:200px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Document No</td>";
	echo "<td style='border-right:1px solid black;width:230px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Person In Charge</td>";
	echo "<td style='border-right:1px solid black;width:80px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Trans Qty</td>";	
	echo "<td style='border-right:1px solid black;width:80px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >Balance</td>";
	echo "<td style='border-right:1px solid black;width:80px;border-bottom:1px solid #373737;padding-left:3px;font-weight:bold;' >SC Variance</td>";	
	echo "</tr>";

	  // echo "<tr><td> openong $opening</td></tr>";
		array_multisort($a_sort, $a_no);
		
		
		unset($a_sort);unset($a_no);unset($a_date);unset($a_description);unset($a_sort);unset($a_trans_qty);unset($a_trans_type);
		unset($a_reason);
		$a_sort = (array) null;
		$a_no = (array) null;
		 $cd_no = 0;
		$resultcount = mysql_query("SELECT * FROM physical_count_detail where storeid = '$_GET[storeid]' and
		                           sparepartid = '$sparepartid'  and stocktake_date >= '$startdate' and stocktake_date <= '$enddate'
								   order by stocktake_date,createtime ");
		if (!mysql_num_rows($resultcount) == 0 )
		{
			while ($rowcount = mysql_fetch_array($resultcount))
			{
			$cd_no++;
			 $receipientname = '';
				 $resultemp = mysql_query("SELECT * FROM m_user where userid = '$rowcount[userid]'");
				if (!mysql_num_rows($resultemp) == 0 )
				{
						$receipientname = mysql_result($resultemp, 0, 'username');
				}
				 $resulteq = mysql_query("SELECT * FROM m_equipment_sparepart where sparepartid = '$sparepartid'"); 													
				if (!mysql_num_rows($resulteq) == 0 )
				{
					while ($rowx = mysql_fetch_array($resulteq))
					{ 
						$resultx = mysql_query("SELECT * FROM m_equipment where equipmentid = '$rowx[equipmentid]'");
						if (!mysql_num_rows($resulteq) == 0 )
						{
							$eqptdesc = mysql_result($resultx, 0, 'description');
						}
					}
				}
			   $stocktake_date = convertdate($rowcount[stocktake_date]);
			   $a_sort[$cd_no] = $rowcount[stocktake_date]. $rowcount[createtime];
			   $a_no[$cd_no] = $cd_no;
			   $a_date[$cd_no] = $rowcount[stocktake_date];
			   $a_description[$cd_no] = 'Stock Count on the date of '.$stocktake_date ;
			   $a_trans_qty[$cd_no] = $rowcount[stocktake_qty] ;
			   $a_docno[$cd_no] = $rowcount[pc_docno];
			   $a_trans_type[$cd_no] = 'SC';
			   $a_reason[$cd_no] = '';
			   $a_pic[$cd_no] = $receipientname;
			   $a_equipdesc[$cd_no]= $eqptdesc;
			}
		}
		
		$resultcount = mysql_query("SELECT * FROM mpr_receipt,mpr_receipt_header where mpr_receipt.storeid = '$_GET[storeid]' and
		                           mpr_receipt.sparepartid = '$sparepartid'  and
								   mpr_receipt_header.docdate >= '$startdate' and  mpr_receipt_header.docdate <= '$enddate'
								    and mpr_receipt.docno = mpr_receipt_header.docno
									order by mpr_receipt_header.docdate,mpr_receipt.createtime ");
		if (!mysql_num_rows($resultcount) == 0 )
		{
			while ($rowcount = mysql_fetch_array($resultcount))
			{
			//echo "<tr><td colspan=4>test $rowcount[transdate] $rowcount[quantity]</td></tr>";
				$resultemp = mysql_query("SELECT * FROM m_supplier where supplierid = '$rowcount[supplierid]'");
				if (!mysql_num_rows($resultemp) == 0 )
				{
						$supplierdesc = mysql_result($resultemp, 0, 'description');
				}
				$receipientname = '';
				$resultemp = mysql_query("SELECT * FROM m_user where userid = '$rowcount[userid]'");
				if (!mysql_num_rows($resultemp) == 0 )
				{
					$receipientname = mysql_result($resultemp, 0, 'username');
				}
				$resulteq = mysql_query("SELECT * FROM m_equipment_sparepart where sparepartid = '$sparepartid'"); 													
				if (!mysql_num_rows($resulteq) == 0 )
				{
					while ($rowx = mysql_fetch_array($resulteq))
					{ 
						$resultx = mysql_query("SELECT * FROM m_equipment where equipmentid = '$rowx[equipmentid]'");
						if (!mysql_num_rows($resulteq) == 0 )
						{
							$eqptdesc = mysql_result($resultx, 0, 'description');
						}
					}
				}
				$cd_no++;
			   $receipt_date = convertdate($rowcount[docdate]);
			   $a_sort[$cd_no] = $rowcount[docdate]. $rowcount[createtime];
			   $a_no[$cd_no] = $cd_no;
			   $a_docno[$cd_no] = $rowcount[docno];
			   $a_date[$cd_no] = $rowcount[docdate];
			   $a_supplier[$cd_no] = $supplierdesc;
			   $a_description[$cd_no] = 'Purchase Receipt from '.$supplierdesc ;
			   $a_trans_qty[$cd_no] = $rowcount[quantity] ;
			   $a_trans_type[$cd_no] = 'PR';
			   $a_pic[$cd_no] = $receipientname;
			   $a_reason[$cd_no] = '';
			   $a_equipdesc[$cd_no]= $eqptdesc;
			  // echo "<tr><td>pr $cd_no rowcount[docdate] $rowcount[docdate] $rowcount[docno] $rowcount[docno]</td></tr>";
			}
		}
		
		$resultcount1 = mysql_query("SELECT * FROM mop_issue where  storeid = '$_GET[storeid]' and
		                           sparepartid = '$sparepartid' and 
								transdate >= '$startdate' and transdate <= '$enddate' and
								quantity != 0 order by transdate,createtime ");
		if (!mysql_num_rows($resultcount1) == 0 )
		{
			while ($rowcount1 = mysql_fetch_array($resultcount1))
			{
			$cd_no++;
			    $receipientname = '';
				 $resultemp = mysql_query("SELECT * FROM m_user where userid = '$rowcount1[receipient]'");
				if (!mysql_num_rows($resultemp) == 0 )
				{
								$receipientname = mysql_result($resultemp, 0, 'username');
				}
				
				 $resulteq = mysql_query("SELECT * FROM m_equipment where equipmentid = '$rowcount1[equipmentid]'");
				if (!mysql_num_rows($resulteq) == 0 )
				{
								$eqptdesc = mysql_result($resulteq, 0, 'description');
				}
			   $a_sort[$cd_no] = $rowcount1[transdate]. $rowcount1[createtime];
			   $a_no[$cd_no] = $cd_no;
			   $a_docno[$cd_no] = $rowcount1[docno];
			   $a_date[$cd_no] = $rowcount1[transdate];
			   $a_pic[$cd_no] = $receipientname;
			   $a_equipdesc[$cd_no] = $eqptdesc;
			   $a_description[$cd_no] = 'Repair Issue';
			   $a_reason[$cd_no] = $rowcount1[reason];
			   $a_trans_qty[$cd_no] = $rowcount1[quantity] ;
			   $a_trans_type[$cd_no] = $rowcount1[transtype];
			   // echo "<tr><td>is $cd_no rowcount1[transdate] $rowcount1[transdate]</td></tr>";

			}
		}
		
		
		
      array_multisort($a_sort,SORT_ASC, $a_no);
		
		foreach( $a_no as $key => $value) 
		{
			$no2++;
			echo "<tr style='border-bottom: 1pt solid black ;'>";
			echo "<td class='list' style='border-right:1px solid black;height:20px;'>$no2 </td>";
			$date = convertdate($a_date[$value]);
			echo "<td class='list' style='border-right:1px solid black;'>$date </td>";
			if ($a_trans_type[$value] == 'SC')
				echo "<td bgcolor='green' class='list' style='border-right:1px solid black;'>$a_trans_type[$value]</td>";
			else
				echo "<td class='list' style='border-right:1px solid black;'>$a_trans_type[$value]</td>";
			echo "<td class='list' style='border-right:1px solid black;'>$a_docno[$value]</td>";
			echo "<td class='list' style='border-right:1px solid black;'>$a_pic[$value]</td>";
			if ($a_trans_type[$value] == 'SC' ) 
			{
				if ($balance != 0)
					$variance =  $balance - $a_trans_qty[$value] ;
				else
					$variance = '';
				if ($a_trans_qty[$value]!= 0)
					$balance = $a_trans_qty[$value];
			echo "<td class='list' style='border-right:1px solid black;text-align:center;padding-right:3px;'>$a_trans_qty[$value]</td>";
			}
			else if ($a_trans_type[$value] == 'STIS')
			{
			$variance = '';
			$balance += -($a_trans_qty[$value]);

			echo "<td class='list' style='border-right:1px solid black;text-align:center;padding-right:3px;'>-$a_trans_qty[$value]</td>";
			}
			else
			{
			$variance = '';
			$balance += $a_trans_qty[$value];
			echo "<td class='list' style='border-right:1px solid black;text-align:center;padding-right:3px;'>$a_trans_qty[$value]</td>";
			}
			//if($balance = 0)
				//$balance = prev($a_trans_qty[$value])
			echo "<td class='list' style='border-right:1px solid black;text-align:center;padding-right:3px;'>$balance</td>";
			echo "<td class='list' style='padding-right:3px;background-color:#F5F5F5;'>$variance</td>";
			echo "</tr>";
		
		}
		
		
		
		  echo "</table>";
		
		
		
}	
else
{

   echo "<p style=text-align:center;width:896px;font-size:10px;color:#FF0000;'>No record found</p>";

}

echo "</table>";

function convertdate($indate)
{
 $dd = substr( $indate,8,2);

 $mm = substr( $indate,5,2);

 $yyyy = substr( $indate,0,4);
$outdate = $dd ."-". $mm . "-" . $yyyy;
return $outdate;

}

?>