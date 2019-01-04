<?php
require("db_ems.php");
include('modules.php'); 

$resultmenu = mysql_query("SELECT * FROM auth_menu where menuid = '$_GET[left_menuid]' order by seqno,parentmenuid");
if (!mysql_num_rows($resultmenu) == 0 )
{
$c_title = mysql_result($resultmenu, 0, 'description');
$c_module = mysql_result($resultmenu, 0, 'module');
}
echo "<div style='margin-top:10px;font-size:14px;font-weight:bold;color:#383838;'>$c_title</div>";
echo "<div id='content_main'>";
			$c_module(); 
echo "</div>";



?>