<?php
require("db_ems.php");
echo "<table style='margin-left:100px;background-color:#C3C3C3;' >";
echo "<tr id='tm_menu_l3'>";

		$resultmenu = mysql_query("SELECT * FROM auth_menu where menulevel = '2' and parentmenuid = '$_GET[menuid]'  order by seqno,parentmenuid");
        if (!mysql_num_rows($resultmenu) == 0 )
		{
			
			while($rmenu = mysql_fetch_array($resultmenu))
			{
				$programdetail = $rmenu[programdetail];
				echo "<td class='tm_menu_l3' style='height:16px;' menuid='$rmenu[menuid]'>$rmenu[description]</td>";
			
			}
			
		}

echo "</tr>";
echo "</table>";
?>