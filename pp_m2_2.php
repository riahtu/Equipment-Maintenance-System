<?php
 date_default_timezone_set('Asia/Kuala_lumpur');
 $today = date("d-m-Y");


echo "<div style='text-align:left;margin-top:20px;color:#007CB9;font-weight:bold;'>Purchase Reverse </div>";
echo "<table border=0 style='text-align:left;margin-top:20px;border:1px solid #C0C0C0;'>";
echo "<tr style='color:#008000;font-weight:bold;'><td style='text-decoration:underline;'>Header</td>";
echo "<td style='width:50px;'></td><td id='pp_m1_2_docno' style='text-align:right;padding-right:50px;font-size:30px;color:#512828;height:32px;'>$docno</td></tr>";
echo "<tr><td style='vertical-align:top;'>";

echo "<table border=0 style='text-align:left;margin-top:20px;'>";
echo "<tr><td style='width:150px;vertical-align:top;'>Supplier id</td><td style='vertical-align:top;height:30px;'><input type='text' id='pp_m1_2_supplierid' supplierid='' value='' style='text-align:center;font-size:10px;text-transform:uppercase;width:100px;height:20px;' /><button id='pp_m1_s_supplier' style='width:20px;height:20px;margin-left:10px;font-size:8px;vertical-align:top;'>F</button> </td></tr>";
echo "<tr><td style='width:150px;vertical-align:top;'>Date</td><td style='vertical-align:top;height:30px;'><input type='text' class='docdate' id='pp_m1_2_docdate' value='$today' style='text-align:center;font-size:10px;height:20px;' /> </td></tr>";
echo "<tr><td style='width:150px;vertical-align:top;'>Purchase Order No</td><td style='vertical-align:top;height:30px;'><input type='text' class='purchaseorderno' id='pp_m1_2_purchaseorderno' value='' style='text-transform:uppercase;text-align:left;font-size:10px;height:20px;' /> </td></tr>";
echo "<tr><td style='width:150px;vertical-align:top;'>Supplier Delivery Order No</td><td style='vertical-align:top;height:30px;'><input type='text' class='purchaseorderno' id='pp_m1_2_deliveryorderno' value='' style='text-transform:uppercase;text-align:left;font-size:10px;height:20px;' /> </td></tr>";
echo "</table>";


echo "<table style='margin-top:20px;'>";
echo "<tr><td style='width:100px;'></td><td><button id='pp_m1_2_next' style='display:none;cursor:pointer;width:200px;height:30px;font-size:10px;'>Next</button></td></tr>";
echo "</table>";
echo "</td>";

echo "<td  style='width:50px;'></td><td id='pp_m1_2_supplier_data' style='vertical-align:top;width:600px;'>";

echo "</td > ";
echo "</tr>";
echo "</table>";

echo "<div id='pp_m12_detail' style='display:none;'>";
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
for ($i = 1; $i <= 10; $i += 1)
	{

		echo "<tr>";
		echo "<td class='td1' style='width:200px;'><input type=text' value='' class='m12_barcode' style='width:98%;height:96%;font-size:10px;text-align:center;'/> </td>";
		echo "<td class='td1' style='width:100px;'><input type=text' value='' class='m12_sparepartid' style='width:96%;height:96%;font-size:10px;text-align:center;'/> </td>";
		echo "<td class='td1' style='width:325px;'><input type=text' value='' class='m12_sparepartname' style='width:98%;height:96%;font-size:10px;'/> </td>";
		echo "<td class='td1' style='width:200px;'><input type=text' value='' class='m12_maker' style='width:98%;height:96%;font-size:10px;'/> </td>";
		echo "<td  style='width:20px;' class='sp_status'></td>";
		echo "<td class='td1' style='width:100px;'><input type=text' value='' class='m12_rec_qty' style='width:96%;height:96%;font-size:10px;text-align:center;'/> </td>";
		echo "</tr>";
	}
echo "</table>";

echo "<table style='margin-top:20px;'>";
echo "<tr><td style='width:100px;'></td><td><button id='pp_m1_2_close' program='pp_m1_2.php' style='cursor:pointer;width:200px;height:30px;font-size:10px;'>Save and Close</button></td></tr>";
echo "</table>";


echo "</div>";//m12_detail


echo "<div id='pp_box_s_supplier_bg'></div>";
   
echo "<div id='pp_box_s_supplier'>";
?>