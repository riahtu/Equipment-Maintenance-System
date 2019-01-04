<?php

session_start();
 require('db_ems.php');
    $result = mysql_query("SELECT * from t_workorder_parts where workorderid = '$_GET[workorderid]' and barcode = '$_GET[barcode]' ");
	if (!mysql_num_rows($result) == 0 )
	{
		 echo "Y";
	}
	else
	{


		$result2 = mysql_query("SELECT * from m_sparepart where barcode = '$_GET[barcode]' ");
		if (!mysql_num_rows($result2) == 0 )
		{
			 echo "NY";
		}
		else  echo "NN";
		
	}

    
 
?>