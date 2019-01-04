<?php

session_start();
 require('db_ems.php');
echo "<div style='text-align:left;width:80%;font-size:20px;text-align:left;font-weight:bold;color:#404000;'>Closed Requisitions</div>";
echo "<p id='changeList' class='changeList' program='sk_closed_wo.php'>Change List Style</p>";

 echo "<div id='show_closed_wo' style='width:1000px;min-height:100px;margin-top:10px;'>";
 $resulty= mysql_query("SELECT YEAR(createtime) as gyear from t_workorder where closed = 'X' group by YEAR(createtime) order by YEAR(createtime) desc");
	if (!mysql_num_rows($resulty) == 0 )
	{
		echo "<table style='margin-top:5px;width:100%;'><tr>";
		while($rowy = mysql_fetch_array($resulty))
		{
		  $n++;
		  $select = '';
		  if ($n == 1) { $tyear = $rowy[gyear]; $select = 'sk_wo_year_select'; }
		  echo "<td class='sk_wo_year $select'  style='' program='sk_closed_wo_year.php'>$rowy[gyear]</td>";
		}
		echo "<td style='border-bottom:1px solid #A0A0A0;'></td>";
		echo "</tr></table>";
	}
	 echo "<div id='show_outstanding' style='width:1000px;min-height:100px;margin-top:10px;'>";
 ?>
	<script>
        
	    var pick_year = $(".sk_wo_year_select").html();
		$.get('sk_closed_wo_year.php?pick_year='+pick_year, function(data){
			$("#show_outstanding").html(data);	
		});

	</script>
<?php
echo "</div>";
echo "</div>";

 echo "<div id='show_closed_wo_details' style='margin-top:10px;width:1000px;min-height:300px;text-align:left;'>";
 
 
 echo "</div>";
 
?>