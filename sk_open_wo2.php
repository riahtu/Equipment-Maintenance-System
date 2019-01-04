<?php

session_start();
 require('db_ems.php');
echo "<div style='display: inline-block;width:80%;font-size:20px;text-align:left;font-weight:bold;color:#404000;'>Open Requisitions</div>";
echo "<div style='display: inline-block;width:20%;'>Monitoring ON<input type='hidden' id='pick_order_monitoring' value='ON'/> </div>";
echo "<p id='changeList' class='changeList' program='sk_open_wo.php'>Change List Style</p>";

 echo "<div id='show_open_wo' style='width:1000px;min-height:100px;margin-top:10px;'>";
 $resulty= mysql_query("SELECT YEAR(createtime) as gyear from t_workorder where closed = '' group by YEAR(createtime) order by YEAR(createtime) desc");
	if (!mysql_num_rows($resulty) == 0 )
	{
		echo "<table style='margin-top:5px;width:100%;'><tr>";
		while($rowy = mysql_fetch_array($resulty))
		{
		  $n++;
		  $select = '';
		  if ($n == 1) { $tyear = $rowy[gyear]; $select = 'sk_wo_year_select'; }
		  echo "<td class='sk_wo_year $select'  style='' program='sk_open_wo_year.php'>$rowy[gyear]</td>";
		}
		echo "<td style='border-bottom:1px solid #A0A0A0;'></td>";
		echo "</tr></table>";
	}


 echo "<div id='show_outstanding' style='width:1000px;min-height:100px;margin-top:10px;'>";
/*	$result1= mysql_query("SELECT * from t_workorder where closed = '' order by createtime desc ");
	if (!mysql_num_rows($result1) == 0 )
	{
		while($row1 = mysql_fetch_array($result1))
		{
			$no++;
				$result2 = mysql_query("SELECT * from m_user where userid = '$row1[userid]'");
				if (!mysql_num_rows($result2) == 0 )
				{
					 $shortname = mysql_result($result2, 0, 'shortname');
				}
			echo "<div id='pick_order_outstanding' class='pick_order_outstanding' workorderid='$row1[workorderid]' style=''>$row1[workorderid] <br/><text style='color:#5EAEAE;font-size:12px;'> $shortname</text></div>";
			
		}	
		
	}
	else
	{

	 echo "<div style='margin:0px auto;margin-top:20px;width:400px;text-align:center;font-size:30px;color:#FF0000;'>No Outstanding Order</div>";
	}*/

echo "</div>";
echo "</div>";

 echo "<div id='process_pick_order_show' style='margin-top:10px;width:1000px;min-height:300px;text-align:left;'>";
 
 
 echo "</div>";
 
?>

<script>
  var pick_year = $(".sk_wo_year_select").html();
		$.get('sk_open_wo_year.php?pick_year='+pick_year, function(data){
			$("#show_outstanding").html(data);	
		});

</script>