<?php
require("db_ems.php");
$s_suppliername = "%".$_GET[suppliername]."%";
$s_country = "%".$_GET[country]."%";
$s_supplierid = "%".$_GET[supplierid]."%";
//$s_spgroup = "%".$_GET[spgroup]."%";
//$s_username = "%".$_GET[username]."%";
//echo "<p>Supplier id $s_supplierid </p>";
echo "<div style='height:400px;overflow-y:scroll;overflow-x:hidden;border-bottom:1px solid #ACACAC'>";
echo "<table  style='font-size:10px;font-family:arial;margin-top:2px;border:1px solid #ACACAC;margin-bottom:30px;text-align:left;' >";
$result1 = mysql_query("SELECT * from m_supplier where description like '$s_suppliername'
                                                         and country like '$s_country'
														 and supplierid like '$s_supplierid'
														 
														 ");
if (!mysql_num_rows($result1) == 0 )
{
	
	while($row1 = mysql_fetch_array($result1))
    {


		echo "<tr class='pp_m1_2_c_supplier' supplierid='$row1[supplierid]'  style='cursor:pointer;'>";
		echo "<td style='width:300px;height:24px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$row1[description] $row1[supplierid]</td>";
		echo "<td style='width:205px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;' >$row1[country]</td>";
		echo "<td style='width:200px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;' >$row1[supplierid]</td>";
		//echo "<td style='width:100px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;' >$row1[spgroup]</td>";	
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