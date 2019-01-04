<?php

session_start();
 require('db_ems.php');
echo "<div style='margin-top:20px;text-align:left;color:#007CB9;font-weight:bold;'>Enter Search Key</div>";
$result1= mysql_query("SELECT * from m_sparepart where sparepartid = '$_GET[sparepartid]'  ");
if (!mysql_num_rows($result1) == 0 )
{
	$keycode = mysql_result($result1, 0, 'keycode');
	$description = mysql_result($result1, 0, 'description');
	$barcode = mysql_result($result1, 0, 'barcode');
	$maker = mysql_result($result1, 0, 'maker');
	$remarks = mysql_result($result1, 0, 'remarks');
	$spgroup = mysql_result($result1, 0, 'spgroup');
	$sptype = mysql_result($result1, 0, 'sptype');
	$fs = mysql_result($result1, 0, 'fs');
}
		
	echo "<table border=0 style='border-radius:5px;width:98%;border:1px solid #D3D3D3;padding:5px;margin-top:5px;margin-left:10px;text-align:left;font-family:Arial;font-size:11px;height:60px;'>";
		
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Purchase Receive No</td>";
		echo "<td><input id='pp_m1_s_docno' value='$pp_m1_s_docno' style='width:300px;height:24px;'></tr>";
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Year</td>";
		echo "<td style='width:100px;color:#383838;'><select id='sptype' style='font-size:11px;color:#202000;height:30px;width:80px;'>";
			$result1 = mysql_query("SELECT *,YEAR(docdate) as gyear FROM mpr_receipt_header group by YEAR(docdate)  order by YEAR(docdate) desc");
			if (!mysql_num_rows($result1) == 0 )
			{
				echo "<option value=''> </option>    ";
				while($row1 = mysql_fetch_array($result1))
				{
					echo "<option value='$row1[gyear]'>$row1[gyear] </option>    ";
					
				}
			}
		echo "</td></tr>";
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Supplier</td>";
		echo "<td style='width:100px;color:#383838;'><select id='sptype' style='font-size:11px;color:#202000;height:30px;width:400px;'>";
			$resultrec = mysql_query("SELECT * FROM m_supplier where status = ''  order by description");
			if (!mysql_num_rows($resultrec) == 0 )
			{
				echo "<option value=''> </option>    ";
				while($row11 = mysql_fetch_array($resultrec))
				{
					echo "<option value='$row11[supplierid]'>$row11[description] </option>    ";
					
				}
			}
		echo "</td></tr>";
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Sparepart </td>";
		echo "<td><input id='pp_m1_s_docno' value='$pp_m1_s_sparepartname' sparepartid='' style='width:400px;height:24px;'></tr>";
		
		echo "</table>";
		
	    echo "<table style='margin-top:30px;margin-left:100px;'>";
		echo "<tr>";
		echo "<td style='width:100px;'></td>";
		echo "<td><button id='pp_m1_search' sparepartid='$_GET[sparepartid]' style='width:100px;height:30px;'>SEARCH</button></tr>";
		echo "</table>";
	
?>