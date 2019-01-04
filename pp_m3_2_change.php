<?php
 date_default_timezone_set('Asia/Kuala_lumpur');
 $today = date("d-m-Y");
 session_start();
 require('db_ems.php');
 $docno = $_GET[docno];
$result1 = mysql_query("SELECT * from mpr_receipt_header where docno = '$_GET[docno]' and status = 'C'");
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

echo "<div style='text-align:left;margin-top:20px;color:#007CB9;font-weight:bold;'>Generate Purchase Return</div>";
echo "<table border=0 style='text-align:left;margin-top:20px;border:1px solid #C0C0C0;'>";
echo "<tr style='color:#008000;font-weight:bold;'><td style='text-decoration:underline;'>Header</td>";

echo "<td style='width:50px;'></td><td id='ppr_docno' style='text-align:right;padding-right:50px;font-size:30px;color:#512828;height:32px;'>$docno</td></tr>";
echo "<tr><td style='vertical-align:top;'>";

echo "<table border=0 style='text-align:left;margin-top:20px;'>";
echo "<tr><td style='width:150px;vertical-align:top;'>Supplier Name</td><td  style='vertical-align:top;height:30px;'>$suppliername</td></tr>";

echo "<tr><td style='width:150px;vertical-align:top;'>Supplier Id</td><td id='ppr_supplierid' style='vertical-align:top;height:30px;'>$supplierid</td></tr>";


echo "<tr><td style='width:150px;vertical-align:top;'>Receive Date</td><td id='ppr_docdate' style='vertical-align:top;height:30px;'>$docdate</td></tr>";

echo "<tr><td style='width:150px;vertical-align:top;'>Today</td><td id='ppr_today' style='vertical-align:top;height:30px;'>$today</td></tr>";

echo "<tr><td style='width:150px;vertical-align:top;'>Purchase Order No</td><td id='ppr_po' style='vertical-align:top;height:30px;'>$purchaseorderno</td></tr>";

echo "<tr><td style='width:150px;vertical-align:top;'>Supplier Delivery Order No</td><td id='ppr_do' style='vertical-align:top;height:30px;'>$deliveryorderno </td></tr>";

echo "</table>";
echo "</td>";

echo "<td  style='width:50px;'></td><td id='pp_m1_2_supplier_data' style='vertical-align:top;width:600px;'>";

echo "</td > ";
echo "</tr>";
echo "</table>";

echo "<div id='pp_m12_detail' style=''>";

echo "<table border=0 style='text-align:center;margin-top:10px;border-collapse:collapse;border-top:1px solid #C0C0C0; '>";
echo "<tr>";
echo "<td class='th1' style='width:200px;text-align:center;'>Barcode</td>";
echo "<td class='th1' style='width:100px;text-align:center;'>Sparepart id</td>";
echo "<td class='th1' style='width:250px;'>Sparepart Name</td>";
echo "<td class='th1' style='width:150px;'>Maker</td>";
echo "<td class='th1' style='width:100px;text-align:center;'>Receive Quantity</td>";

$resultdoc = mysql_query("SELECT * from mppr_return_header where purchaseorderno = '$purchaseorderno' and deliveryorderno = '$deliveryorderno'");
if (!mysql_num_rows($resultdoc) == 0 )
		{ 
			$nn = 0;
			while($rowp = mysql_fetch_array($resultdoc))
			{
			$nn++;
			echo "<td class='th1' recno='$rowp[recno]' style='width:100px;text-align:center;font-weight:bold;border-bottom:1px solid #A6A6A6;color:#D90000;' >$rowp[docno] </td>";
			$a_docno[$nn] = $rowp[docno];
			}
		}

echo "<td class='th1' style='width:100px;text-align:center;'>Return Quantity</td>";
echo "</tr>";
echo "</table>";

echo "<table id='ppr_table' border=0 style='text-align:left;margin-top:1px;border-collapse:collapse;'>";
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
		$qty = $row2[quantity];
		echo "<tr>";
		echo "<td class='td1' id='ppr_barcode' style='width:200px;text-align:center;'>$row2[barcode]</td>";
		echo "<td class='td1' id='ppr_sparepartid' style='width:100px;text-align:center;'>$row2[sparepartid]</td>";
		echo "<td class='td1' id='ppr_description' style='width:250px;text-align:center;'>$row2[sp_description]</td>";
		echo "<td class='td1' id='ppr_maker' style='width:150px;text-align:center;'>$maker</td>";
		echo "<td class='td1' id='ppr_receiveqty' style='width:100px;text-align:center;'>$qty</td>";
		$total = 0;
		for ($loop = 1; $loop <= $nn; $loop += 1)
			{
			    $dn = $a_docno[$loop];
				$resultx = mysql_query("SELECT * from mppr_return where docno = '$dn' and sparepartid = '$row2[sparepartid]'");
				if (!mysql_num_rows($resultx) == 0 )
				{
					$return_qty = mysql_result($resultx, 0, 'quantity');
					echo "<td class='td1' id='' style='width:100px;text-align:center;'>$return_qty</td>";
					$total += $return_qty;
				}
				else
					echo "<td class='td1' id='' style='width:100px;text-align:center;'>0</td>";
			}

		echo "<td class='td1' id='ppr_total' style='display:none;width:100px;text-align:center;'>$total</td>";
		if($total < $qty){
			echo "<td class='td1' style='width:100px;'><input type=text' value='0' id='ppr_quantity' style='width:96%;height:96%;font-size:10px;text-align:center;'/> </td>";
			echo "<td class='td1' id='ppr_full'style='display:none;background-color:lightgrey;width:100px;text-align:center;'>0</td>";
		}
		else {
			echo "<td class='td1' style='display:none;width:100px;'><input type=text' value='0' id='ppr_quantity' style='width:96%;height:96%;font-size:10px;text-align:center;'/> </td>";
			echo "<td class='td1' id='ppr_full'style='background-color:lightgrey;width:100px;text-align:center;'>$total</td>";
		}
		echo "</tr>";
	}
}
	
echo "</table>";

echo "<table style='margin-top:20px;'>";
echo "<tr><td style='width:100px;'></td><td><button id='pp_m3_2_return' program='pp_m3_2_change.php' style='cursor:pointer;width:200px;height:30px;font-size:10px;'>Return Purchase</button></td></tr>";
echo "</table>";


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