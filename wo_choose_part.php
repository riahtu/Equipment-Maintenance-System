<?php
require("db_ems.php");
$result = mysql_query("SELECT * from m_sparepart where sparepartid = '$_GET[sparepartid]'");
if (!mysql_num_rows($result) == 0 )
{
		$sparepartdesc = mysql_result($result, 0, 'description');
		$barcode = mysql_result($result, 0, 'barcode');
		$maker = mysql_result($result, 0, 'maker');
}
echo "<table  border=0 style='font-size:10px;font-family:arial;margin-top:20px;margin-bottom:20px;' >";
    echo "<tr><td style='font-size:16px;font-weight:bold;height:30px;'>New Part</td></tr>";
	echo "<tr><td  style='width:200px;'>Sparepart id</td><td id='tn_sparepartid'>$_GET[sparepartid]</td></tr>";
	echo "<tr><td  style=''>Description</td><td id='tn_sparepartdesc'>$sparepartdesc</td></tr>";
	echo "<tr><td style=''>Barcode</td><td id='tn_barcode'>$barcode</td></tr>";
	echo "<tr><td style=''>Maker</td><td id='tn_maker'>$maker</td></tr>";
	echo "<tr><td style=''>Default Qty</td><td><input id='tn_def_qty' type='text' value='1' style='width:30px;height:24px;text-align:center;' /> </td></tr>";
	echo "<tr><td style='height:20px;'></td></tr>";
	echo "<tr><td colspan=2><button id='wo_eq_add_part' style='width:300px;height:50px;'>Confirm and save</button></td></tr>";


echo "</table>";

?>