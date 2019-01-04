<?php
session_start();
// Line 1
 require('db_ems.php');
$resultp = mysql_query("SELECT * from m_company where company = '$_SESSION[company]'");
		if (!mysql_num_rows($resultp) == 0 )
		{
			 $companyname = mysql_result($resultp, 0, 'description');
		}
$resultp = mysql_query("SELECT * from m_store where storeid = '$_SESSION[storeid]'");
		if (!mysql_num_rows($resultp) == 0 )
		{
			 $storename = mysql_result($resultp, 0, 'description');
		}
echo "<div style='width:100%;min-width:1300px;height:70px;background-color:#FFFFFF;font-size:12px;border-bottom:1px solid #999999;'>";
echo "<table border=0 style='font-weight:bold;'>";
echo "<tr>";
echo "<td style='width:10px;height:30px;'></td>";
echo "<td style='width:500px;text-align:left;color:#CA0065;font-size:20px;font-family:arial;'>Equipment Maintenance System</td>";
echo "<td style='width:350px;text-align:left;padding-right:5px;font-size:14px;color:#FF8000'>$_SESSION[username]</td>";
echo "<td style='width:200px;text-align:right;padding-right:20px;font-size:12px;color:#FF0000'>Role as $_SESSION[role]</td>";
echo "<td id='changePassword' class='changePassword'>Change Password</td>";
echo "<td id='logoff' class='logoff'>Logoff</td>";
echo "</tr>";
echo "<tr style=''>";
echo "<td style='width:10px;height:30px;'></td>";
echo "<td style='width:500px;text-align:left;color:#2F5E5E;font-size:12px;font-family:arial;'>$companyname</td>";
echo "<td style='width:350px;text-align:left;padding-right:5px;font-size:12px;color:#2F5E5E'>Store : $storename</td>";
echo "</tr>";
echo "</table>";
echo "</div>";

// Line 2
/*
echo "<div style='width:100%;min-width:1300px;height:24px;background-color:#575757;font-size:10px;'>";
echo "<table style='color:#FFFFFF;font-weight:bold;text-align:left;'>";
echo "<tr>";
 require("db_ems.php");
		$resultmenu = mysql_query("SELECT * FROM auth_menu where menulevel = '1'  order by seqno,parentmenuid");
        if (!mysql_num_rows($resultmenu) == 0 )
		{
			echo "<td style='width:100px;'></td>";
			while($rmenu = mysql_fetch_array($resultmenu))
			{
				$programdetail = $rmenu[programdetail];
				echo "<td class='tm_menu_l2' style='' menuid='$rmenu[menuid]'>$rmenu[description]</td>";
			
			}
			
		}

echo "</table>";
echo "</div>";


// Line 2
echo "<div id='tm_menu_l3' style='width:100%;min-width:1300px;height:23px;background-color:#9A9A9A;border-bottom:1px solid #626262;font-size:10px;'>";
echo "</div>";
*/
?>