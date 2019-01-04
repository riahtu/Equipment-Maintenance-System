<?php

require("db_ems.php");
$resultrec = mysql_query("SELECT * FROM m_equipment where linecode = '$_GET[linecode]'   ");
	if (!mysql_num_rows($resultrec) == 0 )
	{	
	    echo "<option value=''>Please select</option>    ";
		while($row11 = mysql_fetch_array($resultrec))
		{
			echo "<option value='$row11[equipmentid]'>$row11[description]($row11[equipmentid])</option>    ";
		}  
	}
?>