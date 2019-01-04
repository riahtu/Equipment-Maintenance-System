<?php
require("db_ems.php");
$_GET[storeid] = 'SAI1';
$s_partname = "%".$_GET[partname]."%";
$s_maker = "%".$_GET[maker]."%";
$s_barcode = "%".$_GET[barcode]."%";
$s_spgroup = "%".$_GET[spgroup]."%";
$s_sparepartid = "%".$_GET[sparepartid]."%";

$startdate = substr($_GET[startdate], 6, 4).'-'. substr($_GET[startdate], 3, 2).'-'. substr($_GET[startdate], 0, 2);
$enddate = substr($_GET[enddate], 6, 4).'-'. substr($_GET[enddate], 3, 2).'-'. substr($_GET[enddate], 0, 2);

echo "<div style='height:400px;overflow-y:auto;overflow-x:hidden;border-bottom:1px solid #ACACAC'>";

echo "<table style='font-size:10px;font-family:arial;margin-top:2px;border:1px solid #ACACAC;border-collapse:collapse;margin-bottom:30px;text-align:left;'>";
echo "<td></td><td></td><td></td><td></td><td></td><td>Balance</td>";

$result1 = mysql_query("SELECT * from m_sparepart where description like '$s_partname'
                                                         and maker like '$s_maker'
														 and sparepartid like '$s_sparepartid'
														 and barcode like '$s_barcode'
														 and spgroup like '$s_spgroup'
														 ");
if (!mysql_num_rows($result1) == 0 )
{
	
	while($row1 = mysql_fetch_array($result1))	
    {
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
			   $balance += $rowcount[stocktake_qty] ;
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
    	
		echo "<tr description='$row1[description]' sparepartid='$row1[sparepartid]' equipmentid='$_GET[equipmentid]' barcode='$row1[barcode]' style='cursor:pointer;'>";
		echo "<td style='width:300px;height:24px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$row1[description]</td>";
		echo "<td style='width:105px;border:1px solid #ACACAC;border-right:0px;border-top:0px;text-align:center;' >$row1[sparepartid]</td>";
		echo "<td style='width:205px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;' >$row1[maker]</td>";
		echo "<td style='width:103px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;' >$row1[barcode]</td>";
		echo "<td style='width:102px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;' >$row1[spgroup]</td>";	
		echo "<td style='width:100px;border:1px solid #ACACAC;border-right:0px;border-top:1pxsolid #ACACAC;padding-left:3px;' >$balance</td>";	
		echo "</tr>";	
	}	
	
}
else
{

   echo "<p style=text-align:center;width:896px;font-size:10px;color:#FF0000;'>No record found</p>";

}

echo "</table>";
echo "</div>";
?>