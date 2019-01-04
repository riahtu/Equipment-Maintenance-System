<?php
session_start();
 require('db_ems.php');
echo "<div style='margin-top:10px;text-align:left;width:80%;font-size:14px;text-align:left;font-weight:bold;color:#404000;'>Search Parts</div>";
echo "<table border=0 style='border-radius:5px;width:98%;border:1px solid #D3D3D3;padding:5px;margin-top:5px;margin-left:10px;text-align:left;font-family:Arial;font-size:11px;height:60px;'>";
echo "<tr>";
echo "<td style='width:100px;padding-left:5px;color:#383838;'>Keycode</td>";
echo "<td style='width:100px;padding-left:5px;color:#383838;'>Description</td>";
echo "<td style='width:100px;padding-left:5px;color:#383838;'>Maker</td>";
echo "<td style='width:100px;padding-left:5px;color:#383838;'>Remarks</td>";
echo "<td style='width:100px;padding-left:5px;color:#383838;'>Group</td>";
echo "<td style='width:100px;padding-left:5px;color:#383838;'>Barcode</td>";
echo "<td style='width:50px;padding-left:5px;color:#383838;'>Type</td>";
echo "<td style='width:90px;padding-left:5px;color:#383838;'>Fast/Slow</td>";
echo "<td style='width:60px;padding-left:5px;color:#383838;'>Save</td>";
echo "</tr>";

$result1= mysql_query("SELECT * from m_sparepart order by description limit 20"); //where sparepartid = '$_GET[sparepartid]'  
while($row1 = mysql_fetch_array($result1))
{
	$sparepartid = $row1['sparepartid'];
	$keycode = $row1['keycode'];
	$description = $row1['description'];
	$maker = $row1['maker'];
	$remarks = $row1['remarks'];
	$spgroup = $row1['spgroup'];
	$sptype = $row1['sptype'];
	$barcode = $row1['barcode'];
	$fs = $row1['fs'];
	echo "<tr>";
	echo "<td><input id='keycode' value='$keycode' style='width:200px;height:24px;'>";
	echo "<td><input id='description' value='$description' style='width:250px;height:24px;'>";
	echo "<td><input id='maker' value='$maker' style='width:150px;height:24px;'>";
	echo "<td><input id='remarks' value='$remarks' style='width:150px;height:24px;'>";
	echo "<td><input id='spgroup' value='$spgroup' style='width:150px;height:24px;'>";
	echo "<td><input id='barcode' value='$barcode' style='width:100px;height:24px;'>";
	echo "<td style='width:70px;color:#383838;'><select id='sptype' style='font-size:11px;color:#202000;height:30px;width:50px;'>";
	$resultrec = mysql_query("SELECT * FROM m_sparepart_type  order by seqno");
	while($row11 = mysql_fetch_array($resultrec))
	{
		if ( $sptype == $row11[sptype] ) {
		echo  "<option value='$row11[sptype]' selected >$row11[description]</option>    ";
		} else {
		echo "<option value='$row11[sptype]'>$row11[description] </option>    ";
		}  
	}
	echo "</td>";
		echo "<td style='width:90px;color:#383838;'><select id='fs' style='font-size:11px;color:#202000;height:30px;width:80px;'>";
		$resultrec = mysql_query("SELECT * FROM m_sparepart_fs  order by seqno");
		while($row11 = mysql_fetch_array($resultrec))
		{
			if ( $fs == $row11[fs] ) {
			echo  "<option value='$row11[fs]' selected >$row11[description]</option>    ";
			} else {
			echo "<option value='$row11[fs]'>$row11[description] </option>    ";
			}  
		}
	echo "</td>";
	echo "<td><button id='part_change_save' sparepartid='$sparepartid' style='width:50px;height:30px;'>Save</button></tr>";
	echo "</tr>";
}
echo "</table>";

echo "<div id='pm_search_result_master' style='margin-left:5px;'>Enter your selection in fields above.</div>";

echo "</div>";
?>