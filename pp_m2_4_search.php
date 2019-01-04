<?php
require("db_ems.php");
$s_docno = "%".$_GET[s_docno]."%";
$s_year = "%".$_GET[s_year]."%";
//$s_year = $_GET[s_year];
$s_supplierid = "%".$_GET[s_supplierid]."%";
//$s_spgroup = "%".$_GET[spgroup]."%";
//$s_username = "%".$_GET[username]."%";
echo "<table style='margin-top:20px;text-align:left;color:#007CB9;font-weight:bold;'>";
echo "<tr>";
echo "<td>Purchase Receipt : Deleted Documents </td> ";
echo "<td style='width:500px;'></td> ";
echo "<td id='pp_m1_reselect' style='font-size:9px;color:#FF8000;text-decoration:underline;cursor:pointer'>Reselect</td> ";
echo "</tr>";
//echo "<tr><td>s_supplierid $s_supplierid</td></tr>";
echo "</table>";
echo "<div style='min-height:100px;overflow-y:auto;overflow-x:hidden;border-bottom:1px solid #ACACAC'>";
echo "<table  style='font-size:10px;font-family:arial;margin-top:2px;margin-bottom:30px;text-align:left; border-collapse: collapse;' >";
$result1 = mysql_query("SELECT * from mpr_receipt,mpr_receipt_header where  YEAR(mpr_receipt_header.docdate) like '$s_year'
                                                       and mpr_receipt.docno like '$s_docno'
													   and mpr_receipt_header.supplierid like '$s_supplierid'
													   and mpr_receipt.docno = mpr_receipt_header.docno
													   and mpr_receipt_header.status = 'D'
														 group by mpr_receipt.docno
														
														 ");
if (!mysql_num_rows($result1) == 0 )
{
		echo "<tr class='' sparepartid='$row1[sparepartid]' docno='$row[docno]' style='background-color:#B86D0A;color:#FFFFFF;font-weight:bold;font-family:arial;'>";
		echo "<td style='font-weight:bold;width:100px;height:24px;border:1px solid #ACACAC;padding-left:3px;'>Doc Number</td>";
		echo "<td style='font-weight:bold;width:100px;border:1px solid #ACACAC;padding-left:3px;text-align:center;' >Doc. Date</td>";
		echo "<td style='font-weight:bold;width:300px;border:1px solid #ACACAC;padding-left:3px;' >Supplier</td>";
		echo "<td style='font-weight:bold;width:150px;border:1px solid #ACACAC;padding-left:3px;' >Purchase Order No</td>";	
		echo "<td style='font-weight:bold;width:150px;border:1px solid #ACACAC;padding-left:3px;' >Delivery Order No</td>";	
		echo "</tr>";
	while($row1 = mysql_fetch_array($result1))
    {
		$suppliername = '';
		$resultp = mysql_query("SELECT * from m_supplier where supplierid = '$row1[supplierid]'");
		if (!mysql_num_rows($resultp) == 0 )
		{
			 $suppliername = mysql_result($resultp, 0, 'description');
		}
        $docdate = convertdate($row1[docdate]);
		echo "<tr class='pp_m1_4_change' supplierid='$row1[supplierid]' docno='$row1[docno]' style='cursor:pointer;'>";
		echo "<td style='height:24px;border:1px solid #ACACAC;padding-left:3px;'>$row1[docno]</td>";
		echo "<td style='border:1px solid #ACACAC;text-align:center;' >$docdate</td>";
		echo "<td style='border:1px solid #ACACAC;padding-left:3px;' >$suppliername</td>";
		echo "<td style='border:1px solid #ACACAC;padding-left:3px;' >$row1[purchaseorderno]</td>";	
		echo "<td style='border:1px solid #ACACAC;padding-left:3px;' >$row1[deliveryorderno]</td>";	
		echo "</tr>";
		
		
	}	
	
}
else
{

   echo "<p style=text-align:center;width:896px;font-size:10px;color:#FF0000;'>No record found</p>";

}

echo "</table>";
echo "</div>";

echo "<div id='doc_details'></div>";

function convertdate($indate)
{
 $dd = substr( $indate,8,2);

  $mm = substr( $indate,5,2);

  $yyyy = substr( $indate,0,4);
$outdate = $dd ."-". $mm . "-" . $yyyy;
 return $outdate;

}
?>