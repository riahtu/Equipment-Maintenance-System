<?php
echo "<table class='empinfo' style='text-align:center;color:#ffffff;margin-top:10px;'> ";
			$date = '04/30/2009';
			// parse about any English textual datetime description into a Unix timestamp
			$ts = strtotime($date);
			// find the year (ISO-8601 year number) and the current week
			$year = date('o', $ts);
			$week = date('W', $ts);
            $calmth = $_GET[curmth];
			$calyear = $_GET[curyear];
			$h = mktime(0, 0, 0, $calmth, 1, $calyear);
			$d = date("F dS, Y", $h) ;
			$w = date("w", $h) ;
			$w1 = $w + 7;
			if ( $w1 > 7 ) { $w1 = $w1 - 7 ;}
	
			$nodays = date("t", strtotime($calyear . "-" . $calmth . "-01"));
		    for ( $rw = 1; $rw <= 1; $rw += 1)
			{
				echo "<tr>";
				for ( $col = 1; $col <= 7; $col += 1)
				{
					$ts = strtotime($year.'W'.$week.$col);
					$dayname = date("l", $ts);
					
					echo "<td style='height:40px;width:148px;border:1px solid #35BDFF;color:#387272;'>$dayname </td>";
				}
				echo "</tr>";
			}
			for ( $rw = 1; $rw <= 6; $rw += 1)
			{
				echo "<tr>";
				for ( $col = 0; $col <= 6; $col += 1)
				{
					$count++;
					if (($count >= $w1 ) && ( $datecount < $nodays ))
					{
						$datecount++;
						$prevdata = "N";
						//$s_date = $calyear.'-'.$calmth.'-'.$datecount;
						$s_date = date("Y-m-d", strtotime($calyear . "-" . $calmth ."-".$datecount));
						$bgcolor = 'white'; $holdesc = '';
						$pubhol = 'N';
						require("db_hra.php");
						$resultx10 = mysql_query("SELECT * FROM  las_holidays where  hgroup = '$hgroup' and
													h_date = '$s_date' ");
						if (!mysql_num_rows($resultx10) == 0 )
						{ 
						$pubhol = 'Y';
						$bgcolor = '#FFD7D7'; 
						$holdesc = mysql_result($resultx10, 0, 'description');
						}
						echo "<td style='color:#400040;height:150px;width:108px;background-color:$bgcolor;border:1px solid #35BDFF;text-align:left;vertical-align:top;'><font style='margin-left:3px;font-size:14px;color:#804000;font-weight:bold;'>$datecount</font><font style='margin-left:110px;font-size:13px;color:#FF0000;font-weight:bold;cursor:pointer;'>+</font> ";
						
							require("db_ems.php");
							
							$resultld = mysql_query("SELECT * FROM t_pv_schedules where pv_date = '$s_date' ");
							if (!mysql_num_rows($resultld) == 0 )
							{   
			
								echo "<table border=0 style='font-size:10px;font-family:Arial; border-collapse: collapse;'>";
								$jno = 0;
								while($row = mysql_fetch_array($resultld))
								{
									$bgcolor = '';
									$resultwo = mysql_query("SELECT * FROM t_workorder where pv_schedule_recno = '$row[recno]' ");
									if (!mysql_num_rows($resultwo) == 0 )
									{   
										$bgcolor = '#E1FCC7';
									}
								
								
								
								$jno++;
								$resultf = mysql_query("SELECT * FROM  m_equipment where equipmentid = '$row[equipmentid]'
			                                                    
	                                                                ");
								if (!mysql_num_rows($resultf) == 0 )
								{  
									$equipmentdesc = mysql_result($resultf, 0, 'description');
									$linecode = mysql_result($resultf, 0, 'linecode');
								}
									echo "<tr class='pv_d1' recno='$row[recno]' style='cursor:pointer;'><td style='vertical-align:top;width:20px;'>$jno.</td><td style='background-color:$bgcolor;' title='Eqpt-id : $row[equipmentid]'><font style='color:#545429;'>$equipmentdesc </font></td></tr>";
									echo "<tr class='pv_d1' recno='$row[recno]' style='cursor:pointer;'><td style='vertical-align:top;border-bottom:1px solid #DADADA;'></td><td style='border-bottom:1px solid #DADADA;background-color:$bgcolor;'><font style='color:#FF8000;'>$linecode</font></td></tr>";
								}
								echo "</table>";
							}
						echo "</td>";
					}
					else
					{
						echo "<td style='height:50px;width:108px;background-color:#DBDBDB;border:1px solid #35BDFF;'>.</td>";
					}
				}
					echo "</tr>";
				}
			echo "</table>";
echo "<div id='pv_popup_bg' style='display:none;z-index:1000;position:fixed;top:0px;left:0px;background-color:#FFFFFF;width:100%;height:100%;opacity:0.2;'></div>";
echo "<div class='pv_popup_shadow' id='pv_popup_content' style='display:none;z-index:1010;position:fixed;top:100px;left:350px;background-color:#FFFFFF;width:600px;height:400px;;border:1px solid #282828;border-radius:5px;'></div>";

?>