<?php
require("db_ems.php");
echo "<div style='margin-left:20px;font-size:12px;font-weight:bold;margin-top:10px;'>Assign Part to Machine</div>";

$result = mysql_query("SELECT * from m_equipment where equipmentid = '$_GET[equipmentid]'");
if (!mysql_num_rows($result) == 0 )
{
		$equipmentdesc = mysql_result($result, 0, 'description');
		$linecode = mysql_result($result, 0, 'linecode');
}
echo "<table style='width:96%;margin-left:20px;margin-top:10px;border-bottom:1px solid #949494;'>";

echo "<tr><td style='width:100px;'>Equipment</td><td style='width:300px;'>$equipmentdesc</td><td style='width:100px;'></td><td style='width:100px;'> Line Code</td><td style='width:200px;'>$linecode</td><td></td></tr>";
echo "<tr><td style='height:20px;'></td></tr>";
echo "</table>";

echo "<div id='wo_find_part'>";

echo "<table style='margin-left:20px;margin-top:10px;background-color:#F4F2F2'>";
echo "<tr><td style='width:100px;font-weight:bold;text-align:center;font-size:16px;' colspan=4>Search</td></tr>";
echo "<tr><td style='width:300px;padding-left:3px;'>Part Name</td>";
echo "<td style='width:200px;padding-left:3px;'>Maker</td>";
echo "<td style='width:100px;padding-left:3px;'>Barcode</td>";
echo "<td style='width:100px;padding-left:3px;'>Group</td>";
echo "</tr>";
echo "<tr><td style='width:100px;'><input id='wop_partname' type='text' style='padding-left:3px;width:300px;height:20px;'/> </td>";
echo "<td style='width:100px;'><input id='wop_maker' type='text' style='padding-left:3px;width:200px;height:20px;'/> </td>";
echo "<td style='width:100px;'><input id='wop_barcode' type='text' style='padding-left:3px;width:100px;height:20px;'/> </td>";
echo "<td style='width:100px;'><input id='wop_spgroup' type='text' style='padding-left:3px;width:100px;height:20px;'/> </td>";
echo "</tr>";
echo "</table>";
echo "<input type='hidden' id='wop_equipmentid' value='$_GET[equipmentid]'/>";
echo "<div id='wop_search_result' style='margin-left:25px;height:300px;'></div>";
echo "</div>";// wo_find_part

echo "<div id='wo_new_eqpt_part' style='display:none;margin-left:20px;'>";
echo "</div>";

?>