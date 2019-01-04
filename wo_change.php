<?php
require("db_ems.php");
session_start();
date_default_timezone_set('Asia/Kuala_lumpur');
$now = date("YmdHis");
$year = date("Y");
$result1= mysql_query("SELECT * from t_workorder where workorderid = '$_GET[workorderid]'");
if (!mysql_num_rows($result1) == 0 )
{
	
	while($row1 = mysql_fetch_array($result1))
    {
		$wo_type = $row1[wo_type];
		$wo_recno = $row1[recno];
		$equipmentid = $row1[equipmentid];
		$problem = $row1[problem];
		$instructions = $row1[instructions];
		$remarks = $row1[remarks];
		$pv_schedule_recno = $row1[pv_schedule_recno];
		$result11= mysql_query("SELECT * from m_equipment where equipmentid = '$row1[equipmentid]'");
		if (!mysql_num_rows($result11) == 0 )
		{
			while($row11 = mysql_fetch_array($result11))
			{
			  $linecode = $row11[linecode];
			}
		}
	
	}
}
//echo "<div id='test1' style='position:relative;top:100px;left:300px;width:300px;height:300px;z-index:1000;border:1px solid #004000;'></div>";
echo "<div id='workorder_new' style='position:relative;top:0px;left:0px;width:1000px;min-height:300px;'>";
echo "<table>";
echo "<tr><td style='width:900px;text-align:left;font-weight:bold;font-size:12px;'>Change Requisition : $_GET[workorderid]</td><td> </td></tr>";
echo "</table>";

echo "<input type='hidden' id='workorderid' value='$_GET[workorderid]'/>";
echo "<input type='hidden' id='wo_recno' value='$wo_recno'/>";

echo "<span style='display:inline-block;'>";
echo "<table style='text-align:left;margin-top:10px;font-size:12px;'>";
echo "<tr>";
echo "<td style='width:150px;'>Requisition Type</td>";
 echo "<td><select id='wo_select_wo_type' style='font:10px bold;font-family:arial;background-color:#EAFFF4;padding-left:5px;height:26px;border:1px solid #808080;'   >   ";
	$resultrec2 = mysql_query("SELECT * FROM m_wo_type    ");
	if (!mysql_num_rows($resultrec2) == 0 )
	{	
	
		while($row2 = mysql_fetch_array($resultrec2))
		{
			$selected = '';
		    if ($row2[wo_type] == $wo_type) $selected = 'selected';
			echo "<option value='$row2[wo_type]' $selected> $row2[desc] </option>    ";
		}  
	}
	echo "</select></td>"; 
echo "</tr>";
echo "<tr>";
echo "<td style='width:150px;'>Production Line</td>";
 echo "<td><select id='wo_select_linecode' style='font:10px bold;font-family:arial;background-color:#EAFFF4;padding-left:5px;height:26px;border:1px solid #808080;'   >   ";
	$resultrec = mysql_query("SELECT linecode FROM m_equipment  group by linecode order by linecode ");
	if (!mysql_num_rows($resultrec) == 0 )
	{	
	    
		while($row11 = mysql_fetch_array($resultrec))
		{
			$selected = '';
		    if ($row11[linecode] == $linecode) $selected = 'selected';
			echo "<option value='$row11[linecode]' $selected>$row11[linecode]</option>    ";
		}  
	}
	echo "</select></td>"; 
echo "</tr>";
echo "<tr>";
echo "<td style='width:150px;'>Machine</td>";
 echo "<td><select id='wo_select_equipmentid' name='select_equipmentid' style='font:10px bold;font-family:arial;background-color:#EAFFF4;padding-left:5px;height:26px;border:1px solid #808080;'   >   ";
	$resultrec = mysql_query("SELECT * FROM m_equipment where linecode = '$linecode'   ");
	if (!mysql_num_rows($resultrec) == 0 )
	{	
	  
		while($row11 = mysql_fetch_array($resultrec))
		{
			$selected = '';
		    if ($row11[equipmentid] == $equipmentid) $selected = 'selected';
			echo "<option value='$row11[equipmentid]' $selected>$row11[description]($row11[equipmentid])</option>    ";
		}  
	}
	echo "</select></td>"; 
echo "</tr>";




if($wo_type == 'PV')
{
echo "<tr id='pv_schedule' style=''>";
echo "<td style='width:150px;'>Preventive Schedule </td>";
 echo "<td><select id='wo_select_pv_schedule' name='select_pv_schedule' style='font:10px bold;font-family:arial;background-color:#EAFFF4;padding-left:5px;height:26px;border:1px solid #808080;'   >   ";
	$resultrec = mysql_query("SELECT * FROM t_pv_schedules where equipmentid = '$equipmentid' order by pv_date  ");
	if (!mysql_num_rows($resultrec) == 0 )
	{	
	  
		while($row11 = mysql_fetch_array($resultrec))
		{
			$resultrec22 = mysql_query("SELECT * FROM t_workorder where pv_schedule_recno = '$row11[recno]'  and workorderid = '$_GET[workorderid]' ");
			if (!mysql_num_rows($resultrec22) == 0 )
			{	
				$pv_date = convertdate($row11[pv_date]);
				echo "<option value='$row11[recno]' selected>$pv_date </option>    ";
			}
			$resultrec2 = mysql_query("SELECT * FROM t_workorder where pv_schedule_recno = '$row11[recno]'   ");
			if (mysql_num_rows($resultrec2) == 0 )
			{	
			
				$pv_date = convertdate($row11[pv_date]);
				echo "<option value='$row11[recno]' >$pv_date </option>    ";
			}
		
		}
	}
echo "</select></td>"; 
echo "</tr>";
}
echo "<tr><td style='width:150px;'>Problem</td>";
echo "<td><textarea id='wo_problem' style='vertical-align:top;font-size:10px;font-family:arial;width:500px;height:50px;text-transform: uppercase;' >$problem</textarea>    </td>   ";
echo "</tr>";

echo "<tr><td style='width:150px;'>Instructions</td>";
echo "<td><textarea id='wo_instructions' style='vertical-align:top;font-size:10px;font-family:arial;width:500px;height:50px;text-transform: uppercase;' >$instructions</textarea>  </td>   ";
echo "</tr>";

echo "<tr><td style='width:150px;'>Remarks</td>";
echo "<td><textarea id='wo_remarks' style='vertical-align:top;font-size:10px;font-family:arial;width:500px;height:50px;text-transform: uppercase;' >$remarks</textarea>  </td>   ";
echo "</tr>";
echo "</table>";
echo "</span>";

echo "<span id='machine_image' style='padding-left:10px;'>";
	$resultrec = mysql_query("SELECT * FROM m_equipment_file where equipmentid = ' $equipmentid'   ");
	if (!mysql_num_rows($resultrec) == 0 )
	{	
		$image = mysql_result($resultrec, 0, 'filepath');
	    echo "<img src='$image' style='width:260px;;height:300px;border:1px solid black;'>";
	}
	else
		echo "<p>No Image Uploaded</p>";
echo "</span>";


echo "<div id='wo_select_parts' style='width:98%;border-top:1px solid #51A2A2;margin-top:5px;'>";
?>
<script>
	var equipmentid = $('#wo_select_equipmentid').val();
	var workorderid = $('#workorderid').val();
	$.get('wo_select_equipment_change.php?equipmentid='+equipmentid+'&workorderid='+workorderid, function(data) {
		$("#wo_select_parts").html(data);
	});

</script>
<?php
echo "</div>";


echo "</div> ";


function convertdate($indate)
{
 $dd = substr( $indate,8,2);

  $mm = substr( $indate,5,2);

  $yyyy = substr( $indate,0,4);
$outdate = $dd ."-". $mm . "-" . $yyyy;
 return $outdate;

}
?>