<?php
require("db_ems.php");
session_start();
date_default_timezone_set('Asia/Kuala_lumpur');
$now = date("YmdHis");
$year = date("Y");
$result= mysql_query("SELECT * FROM m_transtype_nr  where transtype =  'WO' and company = '$_SESSION[company]' and year = '$year' ");
	if (mysql_num_rows($result) == 0 )
	{	
		$sql = "INSERT INTO m_transtype_nr(transtype,company,year,doc_prefix,currentno,digits,trans_sign,lastupdate,userid)
				VALUES('WO','$_SESSION[company]','$year','MSPR',0,4,'-','$now','$_SESSION[userid]')";
		if (!mysql_query($sql))
		{
			die('Error: ' . mysql_error());                      
		}
	//echo "<p style='font-size:20px;color:#FF0000;'>Please maintain table m_transtype_nr for transtype WO , company $_SESSION[company] and year $year</p>";
	}

echo "<div id='workorder_new' style='position:relative;top:0px;left:0px;width:1000px;min-height:300px;'>"; 
echo "<table>";
echo "<tr><td style='width:900px;text-align:left;font-weight:bold;font-size:12px;'>Create New Requisition </td><td> </td></tr>";
echo "</table>";

echo "<span style='display:inline-block;'>";
echo "<table style='text-align:left;width:98%;font-size:12px;'>";
echo "<tr>";
echo "<td style='width:150px;'>Requisition Type</td>";
 echo "<td><select id='wo_select_wo_type' style='font:10px bold;font-family:arial;background-color:#EAFFF4;padding-left:5px;height:26px;border:1px solid #808080;'>";
	$resultrec2 = mysql_query("SELECT * FROM m_wo_type    ");
	if (!mysql_num_rows($resultrec2) == 0 )
	{	
	
		while($row2 = mysql_fetch_array($resultrec2))
		{
			echo "<option value='$row2[wo_type]'> $row2[desc] </option>    ";
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
	    echo "<option value=''>Please choose</option>    ";
		while($row11 = mysql_fetch_array($resultrec))
		{
			echo "<option value='$row11[linecode]'>$row11[linecode]</option>    ";
		}  
	}
	echo "</select></td>"; 
echo "</tr>";
echo "<tr>";
echo "<td style='width:150px;'>Machine</td>";
 echo "<td><select id='wo_select_equipmentid' name='select_equipmentid' style='font:10px bold;font-family:arial;background-color:#EAFFF4;padding-left:5px;height:26px;border:1px solid #808080;'   >   ";
	
	echo "</select></td>"; 
echo "</tr>";
echo "<tr id='pv_schedule' style='display:none;'>";
echo "<td style='width:150px;'>Preventive Schedule</td>";
 echo "<td><select id='wo_select_pv_schedule' name='select_pv_schedule' style='font:10px bold;font-family:arial;background-color:#EAFFF4;padding-left:5px;height:26px;border:1px solid #808080;'   >   ";
	
	echo "</select></td>"; 
echo "</tr>";

echo "<tr><td style='width:150px;'>Problem</td>";
echo "<td><textarea id='wo_problem' style='vertical-align:top;font-size:10px;font-family:arial;width:500px;height:50px;text-transform: uppercase;' ></textarea>    </td>   ";
echo "</tr>";

echo "<tr><td style='width:150px;'>Instructions</td>";
echo "<td><textarea id='wo_instructions' style='vertical-align:top;font-size:10px;font-family:arial;width:500px;height:50px;text-transform: uppercase;' ></textarea>  </td>   ";
echo "</tr>";

echo "<tr><td style='width:150px;'>Remarks</td>";
echo "<td><textarea id='wo_remarks' style='vertical-align:top;font-size:10px;font-family:arial;width:500px;height:50px;text-transform: uppercase;' ></textarea>  </td>   ";
echo "</tr>";
echo "</table>";
echo "</span>";

echo "<span id='machine_image'>";

echo "</span>";

echo "<div id='wo_select_parts' style='width:98%;margin-top:5px;'>";

echo "</div>";


echo "</div> ";
?>