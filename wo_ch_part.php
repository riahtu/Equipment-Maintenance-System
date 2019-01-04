<?php
require("db_ems.php");
echo "<table style='margin-left:20px;margin-top:5px;'>";
			$result = mysql_query("SELECT * from m_sparepart where sparepartid = '$_GET[sparepartid]'");
			if (!mysql_num_rows($result) == 0 )
			{
				 $equipmentdesc = mysql_result($result, 0, 'description');
				  $barcode = mysql_result($result, 0, 'barcode');
				  $maker = mysql_result($result, 0, 'maker');
				
			}
		  echo "<table>";
		
		  echo "<tr><td style='width:100px;font-weight:bold;'>Spartpart ID</td><td style='text-align:left;'>$_GET[sparepartid]</td></tr>";
		  echo "<tr><td style='width:100px;font-weight:bold;'>Description</td><td style='text-align:center;'> $equipmentdesc</td></tr>";
		  echo "<tr><td style='width:100px;font-weight:bold;'>Maker</td><td style=''>$maker</td></tr>";
		  echo "<tr><td style='width:100px;font-weight:bold;'>Default Qty</td><td style=''><input type='text' id='wo_df_qty' value = '1' style='width:30px;height:20px;border:1px solid #696969;text-align:center;' /> </td></tr>";
		  
		echo "</table>";
	
?>