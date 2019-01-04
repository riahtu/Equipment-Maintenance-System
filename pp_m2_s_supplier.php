<?php
echo "<table style='margin-left:20px;margin-top:10px;background-color:#F4F2F2;text-align:left;'>";
echo "<tr><td style='width:100px;font-weight:bold;text-align:left;font-size:16px;height:40px;' colspan=4>Supplier Search</td></tr>";
echo "<tr><td style='width:300px;padding-left:3px;'>Supplier Name</td>";
echo "<td style='width:200px;padding-left:3px;'>Country</td>";
echo "<td style='width:100px;padding-left:3px;'>Supplier Id</td>";

echo "</tr>";
echo "<tr><td style='width:100px;'><input id='pp_s_suppliername' type='text' style='padding-left:3px;width:300px;height:20px;'/> </td>";
echo "<td style='width:100px;'><input id='pp_s_country' type='text' style='padding-left:3px;width:200px;height:20px;'/> </td>";
echo "<td style='width:100px;'><input id='pp_s_supid' type='text' style='padding-left:3px;width:200px;height:20px;'/> </td>";
//echo "<td style='width:100px;'><input id='pp_s_supplierid' type='text' style='padding-left:3px;width:100px;height:20px;'/> </td>";
//echo "<td style='width:100px;'><input id='pm_s_spgroup' type='text' style='padding-left:3px;width:100px;height:20px;'/> </td>";
echo "</tr>";
echo "</table>";

echo "<div id='pp_search_result' style='margin-left:20px;'></div>";
?>