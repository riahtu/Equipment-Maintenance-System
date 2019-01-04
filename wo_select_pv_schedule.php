<?php
require("db_ems.php");
$resultrec = mysql_query("SELECT * FROM t_pv_schedules where equipmentid = '$_GET[equipmentid]' order by pv_date  ");
if (!mysql_num_rows($resultrec) == 0 )
{	

		while($row11 = mysql_fetch_array($resultrec))
		{
		    $resultrec2 = mysql_query("SELECT * FROM t_workorder where pv_schedule_recno = '$row11[recno]'   ");
			if (mysql_num_rows($resultrec2) == 0 )
			{	
		    $pv_date = convertdate($row11[pv_date]);
			echo "<option value='$row11[recno]'>$pv_date</option>    ";
			}
		}  
}
	
function convertdate($indate)
{
 $dd = substr( $indate,8,2);

  $mm = substr( $indate,5,2);

  $yyyy = substr( $indate,0,4);
$outdate = $dd ."-". $mm . "-" . $yyyy;
 return $outdate;

}
?>