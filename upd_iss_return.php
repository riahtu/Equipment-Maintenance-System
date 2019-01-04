<?php
session_start();

date_default_timezone_set('Asia/Kuala_lumpur');
$now = date("YmdHis");
$today = date("Ymd");
require('db_ems.php');
$array_barcode = json_decode(stripslashes($_POST['array_barcode']), true);
$array_return_qty = json_decode(stripslashes($_POST['array_returnqty']), true);
$array_sparepartid = json_decode(stripslashes($_POST['array_sparepartid']), true);
$array_partnumber = json_decode(stripslashes($_POST['array_partnumber']), true);
$array_issue_qty = json_decode(stripslashes($_POST['array_issueqty']), true);




$result1 = mysql_query("SELECT * FROM m_currentmonth ");
if (!mysql_num_rows($result1) == 0 )
{
	$cur_year = mysql_result($result1, 0, 'cur_year');
	$cur_month = mysql_result($result1, 0, 'cur_month');
}
 $result = mysql_query("SELECT * from t_workorder where workorderid = '$_POST[workorderid]'");
	if (!mysql_num_rows($result) == 0 )
	{
		 $technician = mysql_result($result, 0, 'userid');
		 $equipmentid = mysql_result($result, 0, 'equipmentid');
		 $wo_type = mysql_result($result, 0, 'wo_type');
	}
 $result11 = mysql_query("SELECT * FROM m_transtype_nr where transtype = 'IR' and year = '$cur_year'");
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

$sql = "INSERT INTO mop_return_header(docno,company,storeid,equipmentid,workorderid,technician_empno,transdate,reason,createtime,userid)
			VALUES ('$new_docno','$_SESSION[company]','$_SESSION[storeid]','$equipmentid','$_POST[workorderid]','$technician','$today','$wo_type','$now','$_SESSION[userid]')";
if (!mysql_query($sql))
{
	die('Error: ' . mysql_error());                      
}
	$headerid = mysql_insert_id();
	

$rectot = sizeof($array_barcode) - 1;

for ( $i = 1 ; $i <= $rectot; $i += 1)
{
   $sp = $array_sparepartid[$i];
   $bc = $array_barcode[$i]; $tt = $array_barcode[1];
   $rq = $array_return_qty[$i];
   $pn = $array_partnumber[$i];
   $iq = $array_issue_qty[$i];
   $sp_desc = '';
   $resultsp = mysql_query("SELECT * from m_sparepart where sparepartid = '$sp'");
	if (!mysql_num_rows($result) == 0 )
	{
		 $sp_desc = mysql_result($resultsp, 0, 'description');
	
	}
    //$quantity = $pq * -1;
    $quantity = $rq;
	$sql = "INSERT INTO mop_return(docno,transtype,iss_quantity,storeid,technician_empno,equipmentid,sparepartid,part_number,barcode,sp_description,workorderid,return_quantity,transdate,headerid,createtime,userid)
			VALUES ('$new_docno','IR', '$iq','$_SESSION[storeid]','$technician', '$equipmentid', '$sp', '$pn','$bc','$sp_desc',
			'$_POST[workorderid]', '$quantity', '$today', '$headerid', '$now','$_SESSION[userid]')";
			if (!mysql_query($sql))
			{
				die('Error: mop_issue ' . mysql_error());                      
			}
	
	
					
}
		
$sqlupd1 = "update m_transtype_nr set currentno='$nextno',lastupdate = '$now',userid='$_SESSION[userid]'
where transtype = 'IR' and year = '$cur_year'";
if (!mysql_query($sqlupd1))
{
	die('Error: ' . mysql_error());                      
}
else
{
  $data2_html = "Database updated";
}
$data1_html = $headerid;

$data = array('item1'=>$data1_html,'item2'=>$data2_html);
echo json_encode($data);
?>