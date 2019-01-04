<?php

session_start();
 require('db_ems.php');

 echo "<div id='show_outstanding' style='width:1000px;min-height:100px;'>";
	$result1= mysql_query("SELECT * from t_workorder where closed = '' ");
	if (!mysql_num_rows($result1) == 0 )
	{
		echo "<div style='display: inline-block;width:80%;'>Queue Of Outstanding Orders</div>";
		echo "<div style='display: inline-block;width:20%;'>Monitoring ON<input type='hidden' id='pick_order_monitoring' value='ON'/> </div>";
		while($row1 = mysql_fetch_array($result1))
		{
			$no++;
			echo "<div class='pick_order_outstanding' workorderid='$row1[workorderid]' style=''>$row1[workorderid] </div>";
			
		}	
		
	}
	else
	{

	 echo "<div style='margin:0px auto;margin-top:20px;width:400px;text-align:center;font-size:30px;color:#FF0000;'>No Outstanding Order</div>";
	}

echo "</div>";

 echo "<div id='process_pick_order_show' style='margin-top:10px;width:1000px;min-height:300px;'>";
 
 
 echo "</div>";
 
?>