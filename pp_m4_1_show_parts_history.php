<?php

session_start();
 date_default_timezone_set('Asia/Kuala_lumpur');
 $now = date("YmdHis");
 $now2 = date("d-m-Y H:i:s");
 $today = date("d/m/Y");
 //$_POST[month] = 2;
 $_GET[storeid] = 'SMC1';
 $nodays = date("t", strtotime($_POST[year] . "-" . $_POST[month] . "-01"));
 $enddate =  $_POST[year].'-'.$_POST[month].'-'.$nodays;
 require('db_ems.php');
 $startdate = substr($_GET[startdate], 6, 4).'-'. substr($_GET[startdate], 3, 2).'-'. substr($_GET[startdate], 0, 2);
 $enddate = substr($_GET[enddate], 6, 4).'-'. substr($_GET[enddate], 3, 2).'-'. substr($_GET[enddate], 0, 2);

 if ($_GET[barcode] != '') 
 {
   $resultpr = mysql_query("SELECT * FROM m_sparepart where barcode = '$_GET[barcode]'");
 
 }
 else
 {
 
	$resultpr = mysql_query("SELECT * FROM m_sparepart where sparepartid = '$_GET[sparepartid]'");
 }
	if (!mysql_num_rows($resultpr) == 0 )
	{
		$sparepartdesc = mysql_result($resultpr, 0, 'description');
		$maker = mysql_result($resultpr, 0, 'maker');
		$spgroup = mysql_result($resultpr, 0, 'spgroup');
		$fs = mysql_result($resultpr, 0, 'fs');
		$sptype = mysql_result($resultpr, 0, 'sptype');
		$barcode = mysql_result($resultpr, 0, 'barcode');
		$sparepartid = mysql_result($resultpr, 0, 'sparepartid');
	}
else
{
 echo "<p style='font-size:20px;'>Barcode $_GET[barcode]</p>";
echo "<p style='font-size:20px;color:#FF0000;'>Sorry, You are entering an Invalid Barcode No</p>";
exit;
}
	
 echo "<table border=0 style='font-size:10px;font-family:arial;text-align:left;'>";
 echo "<tr><td style='width:100px;'>Part Name</td><td style='font-weight:bold;'>$sparepartdesc</td><td style='width:50px;'></td><td style='width:100px;'>Sparepart Id</td><td style='font-weight:bold;'>$sparepartid</td><td style='width:50px;'></td><td style='width:100px;'>Barcode</td><td style='font-weight:bold;font-size:14px;color:#FF0000;'>$barcode</td></tr>";
 echo "<tr><td style='width:100px;'>Maker</td><td style='font-weight:bold;'>$maker</td><td style='width:50px;'></td><td style='width:100px;'>Product group</td><td style='font-weight:bold;'>$spgroup</td></tr>";
 echo "<tr><td style='width:100px;'>Fs</td><td style='font-weight:bold;'>$fs</td><td style='width:50px;'></td><td style='width:100px;'>Sp Type</td><td style='font-weight:bold;'>$sptype</td></tr>";
 //echo "<tr><td style='width:100px;'>Selection From</td><td style='font-weight:bold;'>$_GET[startdate]</td><td style='width:50px;'></td><td style='width:100px;'>Selection to</td><td style='font-weight:bold;'>$_GET[enddate]</td></tr>";

 
 
 echo "</table>";

		unset($a_sort);unset($a_no);unset($a_date);unset($a_description);unset($a_sort);unset($a_trans_qty);unset($a_trans_type);
		unset($a_reason);
		$a_sort = (array) null;
		$a_no = (array) null;
		$resultcount = mysql_query("SELECT * FROM mpr_receipt,mpr_receipt_header where mpr_receipt.storeid = '$_SESSION[storeid]' and
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
			}
		}
		
		
		
		
		echo "<table border=0 style='font-size:10px;font-family:arial;text-align:left;margin-top:10px;'>";
		echo "<tr>";
		echo "<td class='list_h2'  style='width:40px;'>No</td>";
		echo "<td class='list_h2'>Date </td>";
		echo "<td class='list_h2' style='width:200px;'>Supplier</td>";
		echo "<td class='list_h2'>Trans. Type</td>";
		echo "<td class='list_h2' style='width:120px;'>Document No</td>";
		echo "<td class='list_h2' style='width:120px;'>Person in Charge</td>";
		echo "<td class='list_h2' style='width:120px;'>Purchase Order</td>";
		echo "<td class='list_h2' style='width:120px;'>Delivery Order No</td>";
		echo "<td class='list_h2' style='text-align:right;padding-right:3px;'>Trans. Qty</td>";

		echo "</tr>";

      
		
		$resultcount = mysql_query("SELECT * FROM mpr_receipt,mpr_receipt_header where mpr_receipt.storeid = '$_SESSION[storeid]' and
		                           mpr_receipt.sparepartid = '$sparepartid'  and
								   mpr_receipt_header.docdate >= '$startdate' and  mpr_receipt_header.docdate <= '$enddate'
								    and mpr_receipt.docno = mpr_receipt_header.docno
									order by mpr_receipt_header.docdate desc,mpr_receipt.createtime ");
		if (!mysql_num_rows($resultcount) == 0 )
		{
			while ($rowcount = mysql_fetch_array($resultcount))
			{
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
				$no2++;
				echo "<tr>";
				echo "<td class='list' style='height:20px;'>$no2 </td>";
				$date = convertdate($rowcount[docdate]);
				echo "<td class='list'>$date </td>";
				echo "<td class='list'>$supplierdesc</td>";
				echo "<td class='list'>PR</td>";
				echo "<td class='list'>$rowcount[docno]</td>";
				echo "<td class='list'>$receipientname </td>";
				echo "<td class='list'>$rowcount[purchaseorderno]</td>";
				echo "<td class='list'>$rowcount[deliveryorderno]</td>";
				
				echo "<td class='list' style='text-align:right;padding-right:3px;'>$rowcount[quantity]</td>";
				if ($a_trans_type[$value] == 'SC' ) 
				{
				$variance =  $a_trans_qty[$value] - $balance;
				$balance = $a_trans_qty[$value];
				}
				else
				{
				$variance = '';
				$balance += $a_trans_qty[$value];
				}
			
				echo "</tr>";
		
			}
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