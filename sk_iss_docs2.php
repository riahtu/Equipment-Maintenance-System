<?php

session_start();
 require('db_ems.php');
echo "<div style='text-align:left;width:80%;font-size:20px;text-align:left;font-weight:bold;color:#404000;'>Issue Parts Documents</div>";
 echo "<div id='show_iss_docs' style='width:1000px;min-height:100px;margin-top:10px;'>";
 echo "<p id='changeList' class='changeList' program='sk_iss_docs.php'>Change List Style</p>";

 $resulty= mysql_query("SELECT YEAR(createtime) as gyear from mop_issue_header group by YEAR(createtime) order by YEAR(createtime) desc");
	if (!mysql_num_rows($resulty) == 0 )
	{
		echo "<table style='margin-top:5px;width:100%;'><tr>";
		while($rowy = mysql_fetch_array($resulty))
		{
		  $n++;
		  $select = '';
		  if ($n == 1) { $tyear = $rowy[gyear]; $select = 'sk_iss_year_selectx'; }
		  echo "<td class='sk_iss_year $select'  style=''>$rowy[gyear]</td>";
		}
		echo "<td style='border-bottom:1px solid #A0A0A0;'></td>";
		echo "</tr></table>";
	}
	 echo "<div id='show_iss_docs_year' style='width:1000px;min-height:100px;margin-top:10px;'>";
 ?>
	<script>
        
	    var pick_year = $(".sk_iss_year_selectx").html();
		$.get('sk_iss_docs_year.php?pick_year='+pick_year, function(data){
			$("#show_iss_docs_year").html(data);
		
	});

	</script>
<?php
echo "</div>";
echo "</div>";

 echo "<div id='show_iss_docs_details' style='margin-top:10px;width:1000px;min-height:300px;text-align:left;'>";
 
 
 echo "</div>";
 
?>