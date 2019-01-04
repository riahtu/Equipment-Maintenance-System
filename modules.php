<?php
function getmodulesup(&$showcontent,$menuid)
{
require("db_qmis.php");
$result4 = mysql_query("SELECT * FROM auth_menu where menuid = '$menuid'");
							if (!mysql_num_rows($result4) == 0 )
							{
								$showcontent = mysql_result($result4, 0, 'module');
							}
							else
							$showcontent = 't_car_main';

}

function parts_manage()
{

echo "<div style='margin-top:20px;' >";


echo "<table style='font-size:10px;font-family:arial;' cellpadding='0' cellspacing='0'>";
echo "<tr style='background-color:#3796AA;color:#FFFFFF;'>";
echo "<td style='width:30px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;text-align:center;'>No</td>";
echo "<td style='width:250px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Sparepart Code</td>";
echo "<td style='width:300px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Description</td>";
echo "<td style='width:110px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Group</td>";
echo "<td style='width:200px;height:30px;font-weight:bold;border:1px solid #ACACAC;padding-left:3px;'>Maker</td>";
echo "<td style='width:90px;height:30px;font-weight:bold;border:1px solid #ACACAC;padding-left:3px;'>Action</td>";
echo "</tr>";
echo "</table>";

echo "<table style='font-size:10px;font-family:arial;margin-top:2px;' cellpadding='0' cellspacing='0'>";
echo "<tr style='background-color:0xFFFFEA;color:#FF5555;'>";
echo "<td  style='width:30px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;text-align:center;'></td>";
echo "<td  style='width:250px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'><input type='text' placeholder='Filter keycode' id='s_part_keycode' style='width:96%;height:100%;background-color:#FFFFE8;border:0px;' /> </td>";
echo "<td  style='width:300px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'><input type='text' placeholder='Filter description' id='s_part_description' style='width:96%;height:100%;background-color:#FFFFE8;border:0px;' /></td>";
echo "<td  style='width:110px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'><input type='text' placeholder='Filter group' id='s_part_group' style='width:96%;height:100%;background-color:#FFFFE8;border:0px;' /></td>";
echo "<td  style='width:200px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'><input type='text' placeholder='Filter maker' id='s_part_maker' style='width:96%;height:100%;background-color:#FFFFE8;border:0px;' /></td>";
echo "<td  style='width:90px;height:30px;font-weight:bold;border:1px solid #ACACAC;padding-left:3px;'></td>";

echo "</tr>";
echo "</table>";

$result1= mysql_query("SELECT * from m_sparepart ");
if (!mysql_num_rows($result1) == 0 )
{
	echo "<table id='tm_show_content_list' style='font-size:10px;font-family:arial;margin-top:2px;border:1px solid #ACACAC;margin-bottom:30px;' cellpadding='0' cellspacing='0'>";
	while($row1 = mysql_fetch_array($result1))
    {
		$no++;
		echo "<tr class='mlist'>";
		echo "<td  style='width:30px;height:22px;border:1px solid #ACACAC;border-right:0px;border-left:0px;border-top:0px;text-align:center;'>$no</td>";
		echo "<td style='width:250px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$row1[keycode]</td>";
		echo "<td style='width:300px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$row1[description]</td>";
		echo "<td style='width:80px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$row1[spgroup]</td>";
		echo "<td style='width:200px;border:1px solid #ACACAC;border-top:0px;border-right:0px;padding-left:3px;'>$row1[maker]</td>";
		echo "<td style='width:90px;border:1px solid #ACACAC;border-top:0px;border-right:0px;padding-left:3px;'>";
		echo "<div class='icon_part_change' title='Change' sparepartid='$row1[sparepartid]' data-popup-target='#example-popup'></div>";
		echo "</td>";
		
		echo "</tr>";
		
	}	
	echo "</table>";
}

echo "</div> ";


}


function issue_w_workorder()
{

echo "<div id='show_area' style='margin-top:10px;'>";
?>
	<script>
		
		$('#show_area').html("<img src='images/loading.gif'  />");
		$.get('issue_w_workorder.php', function(data) {
		
			$("#show_area").html(data);
			var take_order_monitoring = $("#pick_order_monitoring").val();
	
			if(take_order_monitoring == 'ON' )
			{
				
				setInterval(show_outstanding, 20000);
				
			}
		});
		
	
	
		function show_outstanding() 
		{       
				
				
				$('#show_outstanding').html("<img src='images/loading.gif'  />");
				$.get('show_outstanding.php', function(data) {
				
					$("#show_outstanding").html(data);
				});
		}
	</script>
				
<?php
echo "</div>";
}


function workorder_manage()
{
//echo "<div id='test1' style='position:relative;top:100px;left:300px;width:300px;height:300px;z-index:1000;border:1px solid #004000;'></div>";
echo "<div id='workorder_manage_list' style='position:relative;top:0px;left:0px;width:1000px;min-height:300px;'>";
echo "<table>";
echo "<tr><td style='width:900px;'>List of active work orders </td><td><div id='icon_new_workorder'></div> </td></tr>";
echo "</table>";
echo "<div style='margin-top:1px;' >";
echo "<table style='font-size:10px;font-family:arial;' cellpadding='0' cellspacing='0'>";
echo "<tr style='background-color:#3796AA;color:#FFFFFF;'>";
echo "<td style='width:30px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;text-align:center;'>No</td>";
echo "<td style='width:100px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Work Order</td>";
echo "<td style='width:200px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Prod. Line</td>";
echo "<td style='width:200px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Equipment</td>";
echo "<td style='width:110px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'>Creation Time</td>";
echo "<td style='width:100px;height:30px;font-weight:bold;border:1px solid #ACACAC;padding-left:3px;'>Reason Code</td>";
echo "<td style='width:200px;height:30px;font-weight:bold;border:1px solid #ACACAC;padding-left:3px;'>Created by</td>";
//echo "<td style='width:50px;height:30px;font-weight:bold;border:1px solid #ACACAC;padding-left:3px;'>Closed</td>";
echo "<td style='width:60px;height:30px;font-weight:bold;border:1px solid #ACACAC;padding-left:3px;'>Action</td>";
echo "</tr>";
echo "</table>";

echo "<table style='font-size:10px;font-family:arial;margin-top:2px;' cellpadding='0' cellspacing='0'>";
echo "<tr style='background-color:0xFFFFEA;color:#FF5555;'>";
echo "<td  style='width:30px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;text-align:center;'></td>";
echo "<td  style='width:100px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'><input type='text' placeholder='' id='wo_workorderid' style='width:96%;height:100%;background-color:#FFFFE8;border:0px;' /> </td>";
echo "<td  style='width:200px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'><input type='text' placeholder='' id='wo_linecode' style='width:96%;height:100%;background-color:#FFFFE8;border:0px;' /></td>";
echo "<td  style='width:200px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'><input type='text' placeholder='' id='wo_equipment' style='width:96%;height:100%;background-color:#FFFFE8;border:0px;' /></td>";
echo "<td  style='width:110px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'></td>";
echo "<td  style='width:100px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'><input type='text' placeholder='' id='wo_reasoncode' style='width:96%;height:100%;background-color:#FFFFE8;border:0px;' /></td>";
echo "<td  style='width:200px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'></td>";
//echo "<td  style='width:50px;height:30px;font-weight:bold;border:1px solid #ACACAC;border-right:0px;padding-left:3px;'><input type='text' placeholder='' id='wo_closed' style='width:96%;height:100%;background-color:#FFFFE8;border:0px;' /></td>";
echo "<td  style='width:60px;height:30px;font-weight:bold;border:1px solid #ACACAC;padding-left:3px;'></td>";

echo "</tr>";
echo "</table>";
echo "<div id='wo_show_list'>";
echo "<table  style='font-size:10px;font-family:arial;margin-top:2px;border:1px solid #ACACAC;margin-bottom:30px;' cellpadding='0' cellspacing='0'>";
$result1= mysql_query("SELECT * from t_workorder where closed != 'X' order by createtime desc");
if (!mysql_num_rows($result1) == 0 )
{
	
	while($row1 = mysql_fetch_array($result1))
    {
	     $result = mysql_query("SELECT * from m_equipment where equipmentid = '$row1[equipmentid]'");
		if (!mysql_num_rows($result) == 0 )
		{
			 $equipmentdesc = mysql_result($result, 0, 'description');
			  $linecode = mysql_result($result, 0, 'linecode');
		}
		require('db_hra.php');
		$resultp = mysql_query("SELECT * from em_personaldata where employeeno = '$row1[user]'");
		if (!mysql_num_rows($resultp) == 0 )
		{
			 $username = mysql_result($resultp, 0, 'name');
		}
		require('db_ems.php');
		$no++;
		echo "<tr class='mlist'>";
		echo "<td  style='width:30px;height:22px;border:1px solid #ACACAC;border-right:0px;border-left:0px;border-top:0px;text-align:center;'>$no</td>";
		echo "<td style='width:100px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$row1[workorderid]</td>";
		echo "<td style='width:200px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;' >$linecode</td>";
		echo "<td style='width:200px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;' title='$row1[equipmentid]'>$equipmentdesc</td>";
		echo "<td style='width:110px;border:1px solid #ACACAC;border-right:0px;border-top:0px;padding-left:3px;'>$row1[createtime]</td>";
		
		echo "<td style='width:100px;border:1px solid #ACACAC;border-top:0px;border-right:0px;padding-left:3px;'>$row1[reasoncode]</td>";
		echo "<td style='width:200px;border:1px solid #ACACAC;border-top:0px;border-right:0px;padding-left:3px;'>$username</td>";
//		echo "<td style='width:50px;border:1px solid #ACACAC;border-top:0px;border-right:0px;padding-left:3px;'>$row1[closed]</td>";
		echo "<td style='width:60px;border:1px solid #ACACAC;border-top:0px;border-right:0px;padding-left:3px;'>";
		echo "<div class='icon_part_change' title='Change' sparepartid='$row1[sparepartid]' data-popup-target='#example-popup'></div>";
		echo "</td>";
		
		echo "</tr>";
		
	}	

}
	echo "</table>";
	echo  "</div>";
	
	
echo "</div> ";

echo "</div> ";
}