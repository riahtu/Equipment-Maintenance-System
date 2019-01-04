<?php

session_start();
 require('db_ems.php');

	$result1= mysql_query("SELECT * from t_workorder where closed = '' ");
	if (!mysql_num_rows($result1) == 0 )
	{
		echo "<div style='display: inline-block;width:80%;'>Queue Of Outstanding Orders </div>";
		echo "<div style='display: inline-block;width:20%;'>Monitoring ON<input type='hidden' id='take_order_monitoring' value='ON'/> </div>";
		while($row1 = mysql_fetch_array($result1))
		{
			$no++;
			echo "<div class='pick_order_outstanding' workorderid='$row1[workorderid]' style=''>$row1[workorderid] </div>";
		}	
		
	}
	else
	{

	 echo "<div style='margin:0px auto;margin-top:200px;width:400px;text-align:center;font-size:30px;color:#FF0000;'>No Outstanding Order</div>";
	}


?>