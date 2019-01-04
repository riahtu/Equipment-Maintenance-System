<?php
//Group 1
require("db_ems.php");
$resultmenu = mysql_query("SELECT * FROM auth_menu where menulevel = '3' and parentmenuid = '$_GET[menuid]' order by seqno,parentmenuid");
if (!mysql_num_rows($resultmenu) == 0 )
{
			echo "<div style='width:200px;height:100%;font-size:10px;'>";
			echo "<table border=0 style='width:200px;color:#420000;font-weight:bold;text-align:left;border-collapse: collapse;'>";
			echo "<tr><td style='height:60px;font-size:14px;font-weight:bold;color:#FFFFFF;text-align:center;border-bottom:1px solid #E6E6E6;background-color:#838383;' menuid='$rmenu[menuid]'>SAPURA </br> My Beloved Company</td></tr>";
		
			
			while($rmenu = mysql_fetch_array($resultmenu))
			{
				$n++;
				$programdetail = $rmenu[programdetail];
				$addclass = '';
				if ($n == 1) $addclass = 'tm_left_menu_pick'; 
				echo "<tr><td class='tm_left_menu' left_menuid='$rmenu[menuid]'>$rmenu[description]</td></tr>";
			
			}
			echo "</table>";
			echo "</div>";
			
}




?>