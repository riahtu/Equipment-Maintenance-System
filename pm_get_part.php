<?php
echo "<table style='margin-left:20px;margin-top:10px;background-color:#F4F2F2;text-align:left;'>";
echo "<tr><td style='width:100px;font-weight:bold;text-align:left;font-size:16px;height:40px;' colspan=4>Sparepart Search</td></tr>";
echo "<tr><td style='width:300px;padding-left:3px;'>Part Name</td>";
echo "<td style='width:200px;padding-left:3px;'>Maker</td>";
echo "<td style='width:100px;padding-left:3px;'>Barcode</td>";
echo "<td style='width:100px;padding-left:3px;'>Group</td>";
echo "</tr>";
echo "<tr><td style='width:100px;'><input id='pm_s_partname' type='text' style='padding-left:3px;width:300px;height:20px;'/> </td>";
echo "<td style='width:100px;'><input id='pm_s_maker' type='text' style='padding-left:3px;width:200px;height:20px;'/> </td>";
echo "<td style='width:100px;'><input id='pm_s_barcode' type='text' style='padding-left:3px;width:100px;height:20px;'/> </td>";
echo "<td style='width:100px;'><input id='pm_s_spgroup' type='text' style='padding-left:3px;width:100px;height:20px;'/> </td>";
echo "</tr>";
echo "</table>";

echo "<div id='pm_search_result' style='margin-left:20px;'></div>";
?>