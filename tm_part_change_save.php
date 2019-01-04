<?php
session_start();
$_SESSION[company] = 'SMC';
$_SESSION[store] = 'SMC1';

 date_default_timezone_set('Asia/Kuala_lumpur');
 $now = date("YmdHis");
 $today = date("Ymd");
require('db_ems.php');
$array_barcode = json_decode(stripslashes($_POST['array_barcode']), true);
$array_orderqty = json_decode(stripslashes($_POST['array_orderqty']), true);
$array_sparepartid = json_decode(stripslashes($_POST['array_sparepartid']), true);

$workorderid = $_POST[workorderid];
$problem =  mysql_real_escape_string($_POST[problem]);
$instructions =  mysql_real_escape_string($_POST[instructions]);
$remarks =  mysql_real_escape_string($_POST[remarks]);


starttrans();
$sql = "update t_workorder set equipmentid = '$_POST[equipmentid]',
                               wo_type = '$_POST[wo_type]',
							   problem = UPPER('$problem'),
							   instructions = UPPER('$instructions'),
							   remarks = UPPER('$remarks'),
							   pv_schedule_recno = '$_POST[pv_schedule_recno]'
							   
							   where workorderid = '$_POST[workorderid]' ";
if (!mysql_query($sql))
{
	die('Error: ' . mysql_error());                      
}


$rectot = sizeof($array_sparepartid) - 1;
$sqldel = "delete from t_workorder_parts where workorderid = '$_POST[workorderid]' ";
if (!mysql_query($sqldel))
{
		die('Error: delete t_workorder_parts ' . mysql_error());                      
}
for ( $i = 1 ; $i <= $rectot; $i += 1)
{
   $sp = $array_sparepartid[$i];
   $bc = $array_barcode[$i]; $tt = $array_barcode[1];
   $oq = $array_orderqty[$i];
    $sp_desc = '';
   $resultsp = mysql_query("SELECT * from m_sparepart where sparepartid = '$sp'");
	if (!mysql_num_rows($resultsp) == 0 )
	{
		 $sp_desc = mysql_result($resultsp, 0, 'description');
	
	}
		
	$sql = "INSERT INTO t_workorder_parts(workorder_recno,workorderid,company,equipmentid,sparepartid,barcode,sparepartname,orderqty,createtime,createuser)
			VALUES ('$_POST[wo_recno]','$workorderid','$_SESSION[company]','$_POST[equipmentid]', '$sp', '$bc','$sp_desc',
			'$oq',  '$now','$_SESSION[userid]')";
			if (!mysql_query($sql))
			{
				die('Error: t_workorder_parts ' . mysql_error());                      
			}
	
	
					
}
		

committrans();
$data = array('item1'=>$data1_html,'item2'=>$data2_html);
echo json_encode($data);



function starttrans()
{
mysql_query("START TRANSACTION");
}

function committrans()
{
mysql_query("COMMIT");
}

?>