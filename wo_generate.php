<?php
session_start();


 date_default_timezone_set('Asia/Kuala_lumpur');
 $now = date("YmdHis");
 $today = date("Ymd");
 $cur_year = date("Y");
require('db_ems.php');
$array_barcode = json_decode(stripslashes($_POST['array_barcode']), true);
$array_orderqty = json_decode(stripslashes($_POST['array_orderqty']), true);
$array_sparepartid = json_decode(stripslashes($_POST['array_sparepartid']), true);
$array_partnumber = json_decode(stripslashes($_POST['array_partnumber']), true);


$problem =  mysql_real_escape_string($_POST[problem]);
$instructions =  mysql_real_escape_string($_POST[instructions]);
$remarks =  mysql_real_escape_string($_POST[remarks]);

/*$result1 = mysql_query("SELECT * FROM m_currentmonth ");
if (!mysql_num_rows($result1) == 0 )
{
	$cur_year = mysql_result($result1, 0, 'cur_year');
	$cur_month = mysql_result($result1, 0, 'cur_month');
}else{
	$sql = "INSERT INTO m_currentmonth(cur_year,cur_month,user,updatetime)
			VALUES('$year',1,'$_SESSION[userid]','$now')";
	if (!mysql_query($sql))
	{
		die('Error: ' . mysql_error());                      
	}		
}
 /*$result = mysql_query("SELECT * from t_workorder where workorderid = '$_POST[workorderid]'");
	if (!mysql_num_rows($result) == 0 )
	{
		 $receipient = mysql_result($result, 0, 'user');
		 $equipmentid = mysql_result($result, 0, 'equipmentid');
	}
*/
 $result11 = mysql_query("SELECT * FROM m_transtype_nr where company = '$_SESSION[company]' and transtype = 'WO' and year = '$cur_year'");
if ($result11)
{
	if (!mysql_num_rows($result11) == 0 )
	{
		$doc_prefix = mysql_result($result11, 0, 'doc_prefix'); 
		$currentno = mysql_result($result11, 0, 'currentno'); 
		$digits = mysql_result($result11, 0, 'digits'); 
		$nextno = $currentno + 1;
		$new_docno = $doc_prefix.'-'.$cur_year.'-'.str_pad($nextno, $digits, '0', STR_PAD_LEFT);
	}
	else 
	{
	echo "<p>Please maintain m_transtype_nr table for year $cur_year</p> ";
	exit;
	}
	
	
}
 else
{
	die('Error database: ' . mysql_error());                      
}	
starttrans();
$sql = "INSERT INTO t_workorder(workorderid,company,equipmentid,wo_type,problem,instructions,remarks,pv_schedule_recno,createtime,userid)
			VALUES ('$new_docno','$_SESSION[company]','$_POST[equipmentid]','$_POST[wo_type]',UPPER('$problem'),UPPER('$instructions'),UPPER('$remarks'),'$_POST[pv_schedule_recno]','$now','$_SESSION[userid]' )";
if (!mysql_query($sql))
{
	die('Error: ' . mysql_error());                      
}
	$workorder_recno = mysql_insert_id();
	
/*$resultp = mysql_query("SELECT * FROM m_period_mth where fiscal_period = '$fiscal_period'");

		if (!mysql_num_rows($resultp) == 0 )
		{
							$c_month = mysql_result($resultp, 0, 'month'); 
							$p_year = mysql_result($resultp, 0, 'year'); 
							$c_year = $fiscal_year + $p_year ;
		}
					
		$doc_date = date("Y-m-t", strtotime($c_year . "-" . $c_month . "-01"));
*/
//$arraydata = json_decode(stripslashes($_POST['arraydata']), true);
$rectot = sizeof($array_barcode) - 1;

for ( $i = 1 ; $i <= $rectot; $i += 1)
{
   $sp = $array_sparepartid[$i];
   $bc = $array_barcode[$i]; $tt = $array_barcode[1];
   $oq = $array_orderqty[$i];
   $pn = $array_partnumber[$i];
    $sp_desc = '';
   $resultsp = mysql_query("SELECT * from m_sparepart where sparepartid = '$sp'");
	if (!mysql_num_rows($resultsp) == 0 )
	{
		 $sp_desc = mysql_result($resultsp, 0, 'description');
	
	}
		
	$sql = "INSERT INTO t_workorder_parts(workorder_recno,workorderid,company,equipmentid,sparepartid,part_number,barcode,sparepartname,orderqty,createtime,createuser)
			VALUES ('$workorder_recno','$new_docno','$_SESSION[company]','$_POST[equipmentid]', '$sp', '$pn', '$bc','$sp_desc',
			'$oq',  '$now','$_SESSION[userid]')";
			if (!mysql_query($sql))
			{
				die('Error: t_workorder_parts ' . mysql_error());                      
			}
	
	
					
}
		
$sqlupd1 = "update m_transtype_nr set currentno='$nextno',lastupdate = '$now',userid='$_SESSION[userid]'
where company = '$_SESSION[company]' and  transtype = 'WO' and year = '$cur_year'";
if (!mysql_query($sqlupd1))
{
	die('Error: ' . mysql_error());                      
}
else
{
  $data2_html = "Database updated";
}
$data1_html = $new_docno;
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