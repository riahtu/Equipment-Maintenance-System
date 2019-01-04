<?php
require("db_ems.php");
$s_suppliername = "%".$_GET[suppliername]."%";
$s_supplierid = "%".$_GET[supplierid]."%";

echo "<div style='height:400px;overflow-y:scroll;overflow-x:hidden;border-bottom:1px solid #ACACAC'>";
echo "<table  style='font-size:10px;font-family:arial;margin-top:2px;border:1px solid #ACACAC;margin-bottom:30px;text-align:left;' >";
$result1 = mysql_query("SELECT * from m_supplier where description like '$s_suppliername'
														and supplierid like '$s_supplierid'
                                               
														 ");
if (!mysql_num_rows($result1) == 0 )
{
	
	while($row1 = mysql_fetch_array($result1))
    {


		echo "<tr class='pp_m4_2_choose_supplier' supplierid='$row1[supplierid]'  style='cursor:pointer;'>";
		echo "<td style='width:200px;height:24px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$row1[description]</td>";
		echo "<td style='width:103px;border:1px solid #ACACAC;border-right:0px;border-top:0px;text-align:center;' >$row1[supplierid]</td>";
	
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