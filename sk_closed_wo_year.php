<?php
 require('db_ems.php');

$result1= mysql_query("SELECT * from t_workorder where closed = 'X' and YEAR(createtime) = '$_GET[pick_year]' order by createtime desc");
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
			echo "<div id='pick_wo_closed' class='pick_wo_closed' workorderid='$row1[workorderid]' style='border:2px solid #FFA042;'>$row1[workorderid]<br/><text style='color:#5EAEAE;font-size:12px;'> $shortname</text></div>";
		}	
	}
	else
	{
	 echo "<div style='margin:0px auto;margin-top:20px;width:400px;text-align:center;font-size:30px;color:#FF0000;'>No record found</div>";
	}

?>