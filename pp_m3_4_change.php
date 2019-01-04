<?php
 date_default_timezone_set('Asia/Kuala_lumpur');
 $today = date("d-m-Y");
 session_start();
 require('db_ems.php');
$result1 = mysql_query("SELECT * from mpr_receipt_header where docno = '$_GET[docno]' and status = 'D' ");
if (!mysql_num_rows($result1) == 0 )
{
	$supplierid = mysql_result($result1, 0, 'supplierid');
	$docdate = convertdate(mysql_result($result1, 0, 'docdate'));
	$purchaseorderno = mysql_result($result1, 0, 'purchaseorderno');
	$deliveryorderno = mysql_result($result1, 0, 'deliveryorderno');
}
$suppliername = '';
$resultp = mysql_query("SELECT * from m_supplier where supplierid = '$supplierid'");
if (!mysql_num_rows($resultp) == 0 )
{
			 $suppliername = mysql_result($resultp, 0, 'description');
}
echo "<div style='text-align:left;margin-top:20px;color:#007CB9;font-weight:bold;'>View Deleted Purchase Receipt </div>";
echo "<table border=0 style='text-align:left;margin-top:20px;border:1px solid #C0C0C0;'>";
echo "<tr style='color:#008000;font-weight:bold;'><td style='text-decoration:underline;'>Header</td>";
echo "<td style='width:50px;'></td><td id='pp_m1_2_docno' style='text-align:right;padding-right:50px;font-size:30px;color:#693434;height:32px;'>Deleted : $_GET[docno] </td></tr>";
echo "<tr><td style='vertical-align:top;'>";

echo "<table border=0 style='text-align:left;margin-top:20px;'>";
echo "<tr><td style='width:150px;vertical-align:top;'>Supplier id</td><td style='vertical-align:top;height:30px;'><input type='text' disabled id='pp_m1_2_supplierid' supplierid='' value='$supplierid' style='text-align:center;font-size:10px;text-transform:uppercase;width:100px;height:20px;' /><button id='pp_m1_s_supplier' style='width:20px;height:20px;margin-left:10px;font-size:8px;vertical-align:top;'>F</button> </td></tr>";
echo "<tr><td style='width:150px;vertical-align:top;'>Date</td><td style='vertical-align:top;height:30px;'><input type='text' class='docdate' id='pp_m1_2_docdate' value='$docdate' style='text-align:center;font-size:10px;height:20px;' /> </td></tr>";
echo "<tr><td style='width:150px;vertical-align:top;'>Purchase Order No</td><td style='vertical-align:top;height:30px;'><input type='text' class='purchaseorderno' id='pp_m1_2_purchaseorderno' value='$purchaseorderno' style='text-transform:uppercase;text-align:left;font-size:10px;height:20px;' /> </td></tr>";
echo "<tr><td style='width:150px;vertical-align:top;'>Supplier Delivery Order No</td><td style='vertical-align:top;height:30px;'><input type='text' class='purchaseorderno' id='pp_m1_2_deliveryorderno' value='$deliveryorderno' style='text-transform:uppercase;text-align:left;font-size:10px;height:20px;' /> </td></tr>";
echo "</table>";


echo "</td>";

echo "<td  style='width:50px;'></td><td id='pp_m1_2_supplier_data' style='vertical-align:top;width:600px;'>";

echo "</td > ";
echo "</tr>";
echo "</table>";

echo "<div id='pp_m12_detail' style=''>";

echo "<table border=0 style='text-align:left;margin-top:10px;border-collapse:collapse;border-top:1px solid #C0C0C0; '>";
echo "<tr>";
echo "<td class='th1' style='width:200px;text-align:center;'>Barcode</td>";
echo "<td class='th1' style='width:100px;text-align:center;'>Sparepart id</td>";
echo "<td class='th1' style='width:325px;'>Sparepart Name</td>";
echo "<td class='th1' style='width:200px;'>Maker</td>";
echo "<td class='th1' style='width:20px;text-align:center;'>ST</td>";
echo "<td class='th1' style='width:100px;text-align:center;'>Receive Quantity</td>";
echo "</tr>";
echo "</table>";

echo "<table id='m21_input' border=0 style='text-align:left;margin-top:1px;border-collapse:collapse;'>";
$result2 = mysql_query("SELECT * from mpr_receipt where  docno = '$_GET[docno]' order by lineno	");
if (!mysql_num_rows($result2) == 0 )
{
	while($row2 = mysql_fetch_array($result2))
    {
		$n++;
	    $resultp = mysql_query("SELECT * from m_sparepart where sparepartid = '$row2[sparepartid]'");
		if (!mysql_num_rows($resultp) == 0 )
		{
			 $maker = mysql_result($resultp, 0, 'maker');
		}
		echo "<tr>";
		echo "<td class='td1' style='width:200px;'><input disabled type=text' value='$row2[barcode]' class='m12_barcode' style='width:98%;height:96%;font-size:10px;text-align:center;'/> </td>";
		echo "<td class='td1' style='width:100px;'><input disabled type=text' value='$row2[sparepartid]' class='m12_sparepartid' style='width:96%;height:96%;font-size:10px;text-align:center;'/> </td>";
		echo "<td class='td1' style='width:325px;'><input disabled type=text' value='$row2[sp_description]' class='m12_sparepartname' style='width:98%;height:96%;font-size:10px;'/> </td>";
		echo "<td class='td1' style='width:200px;'><input disabled type=text' value='$maker' class='m12_maker' style='width:98%;height:96%;font-size:10px;'/> </td>";
		echo "<td  style='width:20px;background-color:#008040;' class='sp_status'>F</td>";
		echo "<td class='td1' style='width:100px;'><input disabled type=text' value='$row2[quantity]' class='m12_rec_qty' style='width:96%;height:96%;font-size:10px;text-align:center;'/> </td>";
		echo "</tr>";
	}
}
	/*for ($i = $n; $i <= 10; $i += 1)
	{

		echo "<tr>";
		echo "<td class='td1' style='width:200px;'><input type=text' value='' class='m12_barcode' style='width:98%;height:96%;font-size:10px;text-align:center;'/> </td>";
		echo "<td class='td1' style='width:100px;'><input type=text' value='' class='m12_sparepartid' style='width:96%;height:96%;font-size:10px;text-align:center;'/> </td>";
		echo "<td class='td1' style='width:325px;'><input type=text' value='' class='m12_sparepartname' style='width:98%;height:96%;font-size:10px;'/> </td>";
		echo "<td class='td1' style='width:200px;'><input type=text' value='' class='m12_maker' style='width:98%;height:96%;font-size:10px;'/> </td>";
		echo "<td  style='width:20px;' class='sp_status'></td>";
		echo "<td class='td1' style='width:100px;'><input type=text' value='' class='m12_rec_qty' style='width:96%;height:96%;font-size:10px;text-align:center;'/> </td>";
		echo "</tr>";
	}*/
echo "</table>";

//echo "<table style='margin-top:20px;'>";
//echo "<tr><td style='width:100px;'></td><td><button id='pp_m1_1_delete' docno='$_GET[docno]' style='cursor:pointer;width:200px;height:30px;font-size:10px;'>Delete document</button></td></tr>";
//echo "</table>";


echo "</div>";//m12_detail


echo "<div id='pp_box_s_supplier_bg'></div>";
   
echo "<div id='pp_box_s_supplier'>";


function convertdate($indate)
{
 $dd = substr( $indate,8,2);

  $mm = substr( $indate,5,2);

  $yyyy = substr( $indate,0,4);
$outdate = $dd ."-". $mm . "-" . $yyyy;
 return $outdate;

}
?>