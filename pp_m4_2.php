<?php
 date_default_timezone_set('Asia/Kuala_lumpur');
 $now = date("YmdHis");
 $today = date("d-m-Y");
 $today2 = date("Y-m-d");
session_start();
 require('db_ems.php');
  
  $startdate = date("d-m-Y", strtotime($today2));
  if ($startdate == $today )
  {
    $startdate =  date("01-m-Y", strtotime("-1 year"));
  }
echo "<div style='margin-top:10px;text-align:left;width:80%;font-size:12px;text-align:left;font-weight:bold;color:#FF8000;'>History by Supplier</div>";

 echo "<div id='pm_select_pe' style='width:1000px;min-height:100px;margin-top:10px;text-align:left;'>";
 echo "<table border=0 style='width:99%'>";
 echo "<tr>";
 echo "<td style='font-weight:bold;font-size:14px;height:30px;'>Selection</td>";
 echo "</tr>";

 echo "<td style='width:100px;height:30px;'>Supplier</td><td><button id='pp_m4_2_get_supplier' style='height:30px;padding-left:10px;padding-right:10px;cursor:pointer;font-size:10px;'>Search Supplier</button></td><td></td><td></td></tr>";
 echo "<tr><td style='width:100px;height:30px;'>Date </td><td style='width:150px;'>From : <input type='text' class='get_date' value='$startdate' id='pp_m4_2_s_date_from' style='width:80px;height:26px;border:1px solid #7F7F7F;text-align:center;font-size:10px;'/> </td>
           <td style='width:200px;'>To : <input type='text' class='get_date' id='pp_m4_2_s_date_to' value='$today' style='width:80px;height:26px;border:1px solid #7F7F7F;text-align:center;font-size:10px;'/></td></tr>";
  echo "<tr>";
 echo "</table>";
 echo "<input type='hidden' id='pm_s_sparepartid'/>";
echo "</div>";

 echo "<div style='font-size:14px;text-align:left;margin-top:20px;width:100%;min-height:20px;border-bottom:1px solid #6B6B6B;font-weight:bold;'>Selection Result</div>";
 echo "<div id='pp_show_supplier_history' style='margin-top:10px;' >";
 
echo "</div>";
 
 
  echo "<div id='pm_box_get_part_bg'></div>";
   
   echo "<div id='pm_box_get_part'>";
?>