<?php

require("db_ems.php");
$resultrec = mysql_query("SELECT * FROM m_equipment_file where equipmentid = '$_GET[equipmentid]'   ");
	if (!mysql_num_rows($resultrec) == 0 )
	{	
		$image = mysql_result($resultrec, 0, 'filepath');
	    echo "<img src='$image' style='width:260px;;height:300px;border:1px solid black;'>";
	}
	else
		echo "<p>No Image Uploaded</p>";
?>