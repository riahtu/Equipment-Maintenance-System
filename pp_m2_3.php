<?php

session_start();
 date_default_timezone_set('Asia/Kuala_lumpur');
   $now = date("YmdHis");
   $today = date("Y-m-d");
    $cyear = date("Y");
 require('db_ems.php');
echo "<div style='margin-top:20px;text-align:left;color:#007CB9;font-weight:bold;'>List of Incompleted New Documents</div>";
$result1 = mysql_query("SELECT * from mpr_receipt_header where  status = 'C'	");
if (!mysql_num_rows($result1) == 0 )
{
	while($row1 = mysql_fetch_array($result1))
    {
		$resultp = mysql_query("SELECT * from m_supplier where supplierid = '$row1[supplierid]'");
		if (!mysql_num_rows($resultp) == 0 )
		{
			 $suppliername = mysql_result($resultp, 0, 'description');
		}
		 $docdate = convertdate($row1[docdate]);
		echo "<div class='pp_m1_3_choose' docno='$row1[docno]' style='cursor:pointer;border:1px solid #63B1B1;width:250px;min-height:100px;border-radius:5px;display: inline-block;margin:20px;'>";
		echo "<table style='width:100%;text-align:left; border-collapse: collapse;'>";
		echo "<tr><td colspan=2 style='border-bottom:1px solid #808080;height:30px;font-size:16px;color:#FFFF3E;font-weight:bold;background-color:#4397D6;text-align:center;'>$row1[docno]</td></tr>";
		echo "<tr><td style='width:60px;border-bottom:1px solid #808080;height:30px;padding-left:5px;'>Date</td><td style='border-bottom:1px solid #808080;'>$docdate</td></tr>";
		echo "<tr><td style='border-bottom:1px solid #808080;height:30px;padding-left:5px;'>Supplier</td><td style='border-bottom:1px solid #808080;height:30px;'>$suppliername</td></tr>";
		echo "<tr><td style='border-bottom:1px solid #808080;height:30px;padding-left:5px;'>PO no</td><td style='border-bottom:1px solid #808080;height:30px;'>$row1[purchaseorderno]</td></tr>";
		echo "<tr><td style='height:30px;padding-left:5px;'>DO no</td><td style='height:30px;'>$row1[deliveryorderno]</td></tr>";
		echo "</table>";
		echo "</div>";
	
	}
}
function convertdate($indate)
{
 $dd = substr( $indate,8,2);

  $mm = substr( $indate,5,2);

  $yyyy = substr( $indate,0,4);
$outdate = $dd ."-". $mm . "-" . $yyyy;
 return $outdate;

}
?>