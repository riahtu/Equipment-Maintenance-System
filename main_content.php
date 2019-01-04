<?php
session_start();
// Line 1
echo "<div id='main_content' style='width:100%;height:100%;background-color:#FFFFFF;font-size:10px;'>";
//Technican
if(($_SESSION[role] == 'TECHNICIAN')||($_SESSION[role] == 'ADMIN'))
{
echo "<table border=0 style='width:90%;margin:0px auto;font-weight:bold;margin-top:20px;'>";
echo "<tr>";
echo "<td class='tech_menu' id='mm_my_wo' program='mm_my_wo.php' style='width:15%;height:120px;border-radius:5px;font-size:24px;background:url(images/tech_m2.jpg) no-repeat right top;'><div style='width:120px;'>My <br/>Sparepart Request</div></td>";
echo "<td style='width:2%;'></td>";
echo "<td class='tech_menu' id='mm_oth_wo' program='mm_oth_wo.php' style='width:15%;border-radius:5px;font-size:24px;background:url(images/tech_m1.png) no-repeat right top;'><div style='width:120px;'>Sparepart Request - Others</div></td>";
echo "<td style='width:2%;'></td>";
echo "<td class='tech_menu' id='pv_main' program='pv_main.php' style='width:15%;border-radius:5px;font-size:26px;background:url(images/tech_m4.png) no-repeat right top;'><div style='width:150px;'>Preventive <br/> Maintenance</div></td>";
echo "</tr>";
echo "<tr><td style='height:30px;'></td></tr> ";
echo "<tr>";
echo "<td class='tech_menu' id='rep_tech_main' program='rep_tech_main.php' style='height:120px;border-radius:5px;font-size:26px;background:url(images/tech_m5.png) no-repeat right top;'><div style='width:120px;'>Sparepart Maintenance Reports</div></td>";
echo "<td style=''></td>";
echo "<td class='tech_menu' id='enq_main' program='enq_main.php' style='border-radius:5px;font-size:26px;background:url(images/tech_m20.jpg) no-repeat right top;'><div style='width:150px;'>Parts <br/>Inquiry</div></td>";
echo "<td style=''></td>";
echo "<td class='tech_menu' id='mm_eq_hist' program='mm_eq_hist.php' style='border-radius:5px;font-size:26px;background:url(images/tech_m7.png) no-repeat right top;'><div style='width:150px;'>Equipment Maintenance History</div></td>";
echo "</tr>";
echo "</table>";
}
//StoreKeeper
if(($_SESSION[role] == 'STOREKEEPER')||($_SESSION[role] == 'ADMIN'))
{
echo "<table border=0 style='width:90%;margin:0px auto;font-weight:bold;margin-top:20px;'>";
echo "<tr>";
echo "<td class='tech_menu' id='sk_store_trans' program='sk_store_trans.php' style='width:15%;height:120px;border-radius:5px;font-size:26px;background:url(images/store_m1.png) no-repeat right top;'><div style='width:120px;'>My <br/>Store Transactions</div></td>";
echo "<td style='width:2%;'></td>";
echo "<td class='tech_menu' id='pp_main' program='pp_main.php' style='width:15%;border-radius:5px;font-size:26px;background:url(images/tech_m1.png) no-repeat right top;'><div style='width:120px;'>Parts Purchase</div></td>";
echo "<td style='width:2%;'></td>";
echo "<td class='tech_menu' program='pc_main.php' style='width:15%;border-radius:5px;font-size:26px;background:url(images/tech_m4.png) no-repeat right top;'><div style='width:150px;'>Physical Count</div></td>";
echo "</tr>";
echo "<tr><td style='height:30px;'></td></tr> ";
echo "<tr>";
echo "<td class='tech_menu' id='rep_store_main' program='rep_store_main.php' style='height:120px;border-radius:5px;font-size:26px;background:url(images/tech_m5.png) no-repeat right top;'><div style='width:120px;'>Storekeeper Reports</div></td>";
echo "<td style=''></td>";
echo "<td class='tech_menu' id='pm_main' program='pm_main.php' style='border-radius:5px;font-size:26px;background:url(images/tech_m20.jpg) no-repeat right top;'><div style='width:150px;'>Parts <br/>Management</div></td>";
echo "<td style=''></td>";
echo "<td class='tech_menu' id='mm_eq_hist' program='mm_eq_hist.php' style='border-radius:5px;font-size:26px;background:url(images/tech_m7.png) no-repeat right top;'><div style='width:150px;'>Equipment Maintenance History</div></td>";
echo "</tr>";
echo "</table>";
}

echo "<div style='margin:0px auto;width:200px;height:145px;margin-top:40px;background:url(images/tech_m10.jpg) no-repeat right top;'></div>";
echo "</div>";
?>