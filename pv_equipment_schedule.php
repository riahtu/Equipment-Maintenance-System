<?php
session_start();
if(isset($_POST[curyear])) $calyear = $_POST[curyear];
if(isset($_GET[curyear])) $calyear = $_GET[curyear];
echo "<table class='empinfo' style='text-align:center;color:#ffffff;margin-top:10px;'> ";
require("db_ems.php");
	echo "<table border=1 style='font-size:10px;font-family:Arial; border-collapse: collapse;text-align:left;'>";
	echo "<tr><td style='height:30px;width:30px;text-align:center;'>No</td>";
	echo "<td style='width:200px;padding-left:3px;'>Equipment description</td>";
	echo "<td style='width:80px;padding-left:3px;'>Serial No</td>	";	
	echo "<td style='width:50px;text-align:center;'>Eqpt. Id</td>";
	for ( $col = 1; $col <= 12; $col += 1)
	{
		$monthname = date("F", strtotime("2017-". $col . "-01"));
		echo "<td style='width:55px;text-align:center;'>$monthname</td>";
	}
	echo "</tr>";
	echo "</table>";
	echo "<div style='width:1100px;height:300px;overflow-y:auto;overflow-x:hidden;'>";
	$result1= mysql_query("SELECT * FROM  m_equipment where company = '$_SESSION[company]' and status = 'A' group by linecode");
	if (!mysql_num_rows($result1) == 0 )
	{   
			
		
				
		while($row1 = mysql_fetch_array($result1))
		{
			echo "<table border=0 style='font-size:10px;font-family:Arial; border-collapse: collapse;text-align:left;'>";
			echo "<tr><td style='height:10px;'></td></tr>";
			echo "<tr>";
			echo "<td style='width:200px;padding-left:3px;font-size:14px;color:#FF8000;font-weight:bold;'> $row1[linecode] </td>";
			echo "</tr>";
			echo "</table>";
			$n = 0;
			$result2 = mysql_query("SELECT * FROM  m_equipment where linecode = '$row1[linecode]' and company = '$_SESSION[company]' and status = 'A' order by linecode");
			if (!mysql_num_rows($result2) == 0 )
			{   
					
				echo "<table border=0 style='margin-top:5px;font-size:10px;font-family:Arial; border-collapse: collapse;text-align:left;'>";
						
				while($row2 = mysql_fetch_array($result2))
				{
					$n++;
					echo "<tr><td style='width:30px;border:1px solid #EBEBEB;text-align:center;'>$n</td>";
					echo "<td style='width:200px;padding-left:3px;border:1px solid #EBEBEB;'> $row2[description] </td >";
					echo "<td style='width:80px;padding-left:3px;border:1px solid #EBEBEB;'> $row2[serialno] </td >	";
					echo "<td style='height:30px;width:50px;text-align:center;border:1px solid #EBEBEB;'> $row2[equipmentid] </td>";
					for ( $col = 1; $col <= 12; $col += 1)
					{
						$monthname = date("F", strtotime("2017-". $col . "-01"));
						$t = 0; $pv_dd = ''; $disabled = ''; $bgcolor = ''; $workorderid = '';
						$resultpv = mysql_query("SELECT *,DAY(pv_date) as pv_dd FROM t_pv_schedules where equipmentid = '$row2[equipmentid]' 
						                                                     and YEAR(pv_date) = '$calyear' 
																			 and MONTH(pv_date) = '$col' ");
						if (!mysql_num_rows($resultpv) == 0 )
						{   
							while($rowpv = mysql_fetch_array($resultpv))
							{
								$t++;
							    if ($t > 1) $pv_dd .= ',';
							    $pv_dd .= $rowpv[pv_dd];
								$wo_found = ''; $disabled = ''; $bgcolor = ''; $workorderid = '';
								$resultw1 = mysql_query("SELECT * FROM  t_workorder where pv_schedule_recno = '$rowpv[recno]' ");
								if (!mysql_num_rows($resultw1) == 0 )
								{ 
								  $wo_found = 'X'; $disabled = 'disabled'; $bgcolor = '#008000';
								   $workorderid = mysql_result($resultw1, 0, 'workorderid');
								}
								
							}
						}
						echo "<td style='height:30px;width:55px;text-align:center;border:1px solid #EBEBEB;'> ";
						echo "<input type='text' title='$workorderid $rowpv[recno]' class='pv_dd' $disabled value='$pv_dd' dd_mth='$col' dd_year='$calyear' equipmentid='$row2[equipmentid]' style='font-size:11px;width:90%;height:90%;text-align:center;'/>";
						echo "</td>";
					}
					echo "</tr>";
				}
				echo "</table>";
			}
		}
	}
echo "</div>";


echo "<div id='pv_popup_bg' style='display:none;z-index:1000;position:fixed;top:0px;left:0px;background-color:#FFFFFF;width:100%;height:100%;opacity:0.2;'></div>";
echo "<div class='pv_popup_shadow' id='pv_popup_content' style='display:none;z-index:1010;position:fixed;top:100px;left:350px;background-color:#FFFFFF;width:600px;height:400px;;border:1px solid #282828;border-radius:5px;'></div>";

?>