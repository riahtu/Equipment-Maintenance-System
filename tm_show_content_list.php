<?php
require("db_ems.php");
$s_keycode = "%".$_GET[keycode]."%";
$s_maker = "%".$_GET[maker]."%";
$s_description = "%".$_GET[description]."%";
$s_spgroup = "%".$_GET[spgroup]."%";
$result1= mysql_query("SELECT * from m_sparepart where keycode like '$s_keycode' and maker like '$s_maker' and description like '$s_description' and spgroup like '$s_spgroup' ");
if (!mysql_num_rows($result1) == 0 )
{
	echo "<table id='tm_show_content_list' style='font-size:10px;font-family:arial;margin-top:2px;border:1px solid #ACACAC;margin-bottom:30px;' cellpadding='0' cellspacing='0'>";
	while($row1 = mysql_fetch_array($result1))
    {
		$no++;
		echo "<tr class='mlist'>";
		echo "<td  style='width:30px;height:22px;border:1px solid #ACACAC;border-right:0px;border-left:0px;border-top:0px;text-align:center;'>$no</td>";
		echo "<td style='width:250px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$row1[keycode]</td>";
		echo "<td style='width:300px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$row1[description]</td>";
		echo "<td style='width:80px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$row1[spgroup]</td>";
		echo "<td style='width:200px;border:1px solid #ACACAC;border-top:0px;border-right:0px;padding-left:3px;'>$row1[maker]</td>";
		echo "<td style='width:90px;border:1px solid #ACACAC;border-top:0px;border-right:0px;padding-left:3px;'>";
		echo "<div class='icon_part_list_change' title='Change'></div>";
		echo "</td>";
		
	}	
	echo "</table>";
}
else
{

   echo "<p style=text-align:center;width:896px;font-size:10px;color:#FF0000;'>No record found</p>";

}


?>