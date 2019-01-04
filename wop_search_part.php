<?php
require("db_ems.php");
$s_partname = "%".$_GET[partname]."%";
$s_maker = "%".$_GET[maker]."%";
$s_barcode = "%".$_GET[barcode]."%";
$s_spgroup = "%".$_GET[spgroup]."%";
//$s_username = "%".$_GET[username]."%";
echo "<div style='height:270px;overflow-y:scroll;overflow-x:hidden;border-bottom:1px solid #ACACAC'>";
echo "<table  style='font-size:10px;font-family:arial;margin-top:2px;border:1px solid #ACACAC;margin-bottom:30px;' >";
$result1 = mysql_query("SELECT * from m_sparepart where description like '$s_partname'
                                                         and maker like '$s_maker'
														 and barcode like '$s_barcode'
														 and spgroup like '$s_spgroup'
														 ");
if (!mysql_num_rows($result1) == 0 )
{
	
	while($row1 = mysql_fetch_array($result1))
    {


		echo "<tr class='choose_part' sparepartid='$row1[sparepartid]' equipmentid='$_GET[equipmentid]' style='cursor:pointer;'>";
		echo "<td style='width:300px;height:24px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$row1[description]</td>";
		echo "<td style='width:200px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;' >$row1[maker]</td>";
		echo "<td style='width:100px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;' >$row1[barcode]</td>";
		echo "<td style='width:100px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;' >$row1[spgroup]</td>";	
		echo "</tr>";
		
		
	}	
	
}
else
{

   echo "<p style=text-align:center;width:896px;font-size:10px;color:#FF0000;'>No record found</p>";

}

echo "</table>";
echo "</div>";
?>