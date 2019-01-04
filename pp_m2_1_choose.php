<?php
require("db_ems.php");
$resultpr = mysql_query("SELECT * from mpr_receipt_header where docno like '$_GET[docno]' ");
if (!mysql_num_rows($resultpr) == 0 )
{
     $docdate = mysql_result($resultpr, 0, 'docdate');
	 $supplierid = mysql_result($resultpr, 0, 'supplierid');
	 $purchaseorderno = mysql_result($resultpr, 0, 'purchaseorderno');
	 $deliveryorderno = mysql_result($resultpr, 0, 'deliveryorderno');
     
}

$resultpr2 = mysql_query("SELECT * from m_supplier where supplierid =  '$supplierid' ");
if (!mysql_num_rows($resultpr2) == 0 )
{
     $suppliername = mysql_result($resultpr2, 0, 'description');

}
$docdate2 = convertdate($docdate);
echo "<div style='color:#008200;font-size:10px;font-weight:bold;text-align:left;margin-top:20px;'>Purchase Receipt Detail</div>";
echo "<table border=0 style='text-align:left;margin-top:10px;font-weight:bold;font-size:10px;'>";
echo "<tr style='font-weight:bold;'><td style='width:100px;'>Document No </td><td>$_GET[docno]</td></tr>";
echo "<tr><td style='width:100px;'>Document Date</td><td>$docdate2</td></tr>";
echo "<tr><td style='width:100px;'>Supplier</td><td>$suppliername</td></tr>";
echo "<tr><td style='width:100px;'>Purchase Order</td><td>$purchaseorderno</td></tr>";
echo "<tr><td style='width:100px;'>Delivery Order</td><td>$deliveryorderno</td></tr>";
echo "</table>";
echo "<div style='margin-top:10px;height:400px;overflow-y:auto;overflow-x:hidden;border-bottom:1px solid #ACACAC'>";
echo "<table  style='border-collapse: collapse;font-size:10px;font-family:arial;margin-top:2px;border:1px solid #ACACAC;margin-bottom:30px;text-align:left;' >";
echo "<tr class='pm_choose_part' sparepartid='$row1[sparepartid]' equipmentid='$_GET[equipmentid]' barcode='$row1[barcode]' style='font-weight:bold;'>";

echo "<td style='width:205px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;' >Description</td>";
echo "<td style='width:103px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;' >Barcode</td>";
echo "<td style='width:100px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;text-align:center;' >Quantity</td>";	
echo "</tr>";

$result1 = mysql_query("SELECT * from mpr_receipt where docno like '$_GET[docno]'  ");
if (!mysql_num_rows($result1) == 0 )
{
	
	while($row1 = mysql_fetch_array($result1))
    {

		$resultpr = mysql_query("SELECT * FROM m_sparepart where sparepartid = '$row1[sparepartid]'");
		if (!mysql_num_rows($resultpr) == 0 )
		{
			$sparepartdesc = mysql_result($resultpr, 0, 'description');
		}
		echo "<tr class='pm_choose_part' sparepartid='$row1[sparepartid]' equipmentid='$_GET[equipmentid]' barcode='$row1[barcode]' style='cursor:pointer;'>";

		echo "<td style='width:205px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;' >$sparepartdesc</td>";
		echo "<td style='width:103px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;' >$row1[barcode]</td>";
		echo "<td style='width:100px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;text-align:center;' >$row1[quantity]</td>";	
		echo "</tr>";
		
		
	}	
	
}
else
{

   echo "<p style=text-align:center;width:896px;font-size:10px;color:#FF0000;'>No record found</p>";

}

echo "</table>";
echo "</div>";


function convertdate($indate)
{
 $dd = substr( $indate,8,2);

  $mm = substr( $indate,5,2);

  $yyyy = substr( $indate,0,4);
$outdate = $dd ."-". $mm . "-" . $yyyy;
 return $outdate;

}
?>