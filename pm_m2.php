<script >
$(document).on('click', '#close_parts',closeParts);
function closeParts()
{
	$("#pm_search_result_master").hide();
}

$(document).on('click', '#close_machines',closeMachines);
function closeMachines()
{
	$("#pm_search_result_machine").hide();
}
</script>

<?php
session_start();
 require('db_ems.php');
echo "<div style='margin-top:10px;text-align:left;width:80%;font-size:14px;text-align:left;font-weight:bold;color:#404000;'>Search Parts</div>";
echo "<table style='margin-left:5px;margin-top:10px;text-align:left;border:1px solid #525252;'>";
echo "<tr><td style='width:300px;padding-left:3px;'>Part Name</td>";
echo "<td style='width:100px;text-align:center;'>Sparepart id</td>";
echo "<td style='width:200px;padding-left:3px;'>Manufacturer</td>";
echo "<td style='width:100px;padding-left:3px;'>Barcode</td>";
echo "<td style='width:100px;padding-left:3px;'>Group</td>";
echo "</tr>";
echo "<tr><td style='width:100px;'><input id='pm_s_m_partname' type='text' style='padding-left:3px;width:300px;height:20px;'/> </td>";
echo "<td style='width:100px;'><input id='pm_s_m_sparepartid' type='text' style='text-align:center;width:100px;height:20px;'/> </td>";
echo "<td style='width:100px;'><input id='pm_s_m_maker' type='text' style='padding-left:3px;width:200px;height:20px;'/> </td>";
echo "<td style='width:100px;'><input id='pm_s_m_barcode' type='text' style='padding-left:3px;width:100px;height:20px;'/> </td>";
echo "<td style='width:100px;'><input id='pm_s_m_spgroup' type='text' style='padding-left:3px;width:100px;height:20px;'/> </td>";
echo "</tr>";
echo "</table>";

echo "<div id='pm_search_result_master' style='margin-left:5px;'>Enter your selection in fields above.</div>";
echo "<p id='close_parts'>Close<p>";
echo "</div>";

echo "<div style='margin-top:10px;text-align:left;width:80%;font-size:14px;text-align:left;font-weight:bold;color:#404000;'>Search Machines</div>";
echo "<table style='margin-left:5px;margin-top:10px;text-align:left;border:1px solid #525252;'>";
echo "<tr><td style='width:300px;padding-left:3px;'>Machine Name</td>";
echo "<td style='width:100px;text-align:center;'>Machine id</td>";
echo "<td style='width:200px;padding-left:3px;'>Manufacturer</td>";
echo "<td style='width:100px;padding-left:3px;'>Line Code</td>";
echo "<td style='width:100px;padding-left:3px;'>Serial No</td>";
echo "</tr>";
echo "<tr><td style='width:100px;'><input id='pm_s_m_machineName' type='text' style='padding-left:3px;width:300px;height:20px;'/> </td>";
echo "<td style='width:100px;'><input id='pm_s_m_machineId' type='text' style='text-align:center;width:100px;height:20px;'/> </td>";
echo "<td style='width:100px;'><input id='pm_s_m_machineMaker' type='text' style='padding-left:3px;width:200px;height:20px;'/> </td>";
echo "<td style='width:100px;'><input id='pm_s_m_lineCode' type='text' style='padding-left:3px;width:100px;height:20px;'/> </td>";
echo "<td style='width:100px;'><input id='pm_s_m_serialno' type='text' style='padding-left:3px;width:100px;height:20px;'/> </td>";
echo "</tr>";
echo "</table>";

echo "<div id='pm_search_result_machine' style='margin-left:5px;'>Enter your selection in fields above.</div>";
echo "<p id='close_machines'style='font-weight:bold;cursor:pointer'>Close<p>";
echo "</div>";
?>