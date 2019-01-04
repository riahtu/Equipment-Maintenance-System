<?php
session_start();
echo 'test3';
$error_found = '';
require('db_ems.php');
starttrans();
date_default_timezone_set('Asia/Kuala_lumpur');
$now = date("YmdHis");
$today = date("Y-m-d");
//$storeidid =  $_POST[storeidid];
$st_date = substr($_POST[st_date], 6, 4).'-'. substr($_POST[st_date], 3, 2).'-'. substr($_POST[st_date], 0, 2);
$st_year = substr($_POST[st_date], 6, 4);

$result11 = mysql_query("SELECT * FROM m_transtype_nr where company = '$_SESSION[company]' and transtype = 'PC' and year = '$st_year'");
if (!mysql_num_rows($result11) == 0 )
{
	$doc_prefix = mysql_result($result11, 0, 'doc_prefix'); 
	$currentno = mysql_result($result11, 0, 'currentno'); 
	$digits = mysql_result($result11, 0, 'digits'); 
	$nextno = $currentno + 1;
	$new_docno = $doc_prefix.'-'.$st_year.'-'.str_pad($nextno, $digits, '0', STR_PAD_LEFT);
}
else 
{
	echo "<p>Please maintain m_transtype_nr table for year $st_year</p> ";
	$error_found = 'X';
}
$remarks = 'Physical Count for '.$st_date.'.';

$sql = "INSERT INTO physical_count_header(pc_docno,company,storeid,countdate,remarks,status,createtime,userid)
		VALUES ('$new_docno','$_SESSION[company]','$_SESSION[storeid]','$st_date','$remarks','A','$now','$_SESSION[userid]')";
		if (!mysql_query($sql)) { die('Error: ' . mysql_error());$error_found = 'X'; }

$result2 = mysql_query("SELECT * FROM m_sparepart order by sparepartid");

while($row2 = mysql_fetch_array($result2))
    {
    	$desc = mysql_real_escape_string($row2[description]);
    	$sql = "INSERT INTO physical_count_detail(pc_docno,storeid,sparepartid,sp_description,stocktake_qty,stocktake_date,remarks,status,createtime,userid)
		VALUES ('$new_docno','$_SESSION[storeid]','$row2[sparepartid]','$desc',0,'$st_date','$remarks','A','$now','$_SESSION[userid]')";
		if (!mysql_query($sql)) { die('Error: ' . mysql_error());$error_found = 'X'; }
    }
		
		
$sqlupd1 = "update m_transtype_nr set currentno='$nextno',lastupdate = '$now',userid='$_SESSION[userid]'
		where company = '$_SESSION[company]' and  transtype = 'PC' and year = '$st_year'";
if (!mysql_query($sqlupd1)) {	die('Error: ' . mysql_error()); 	}

committrans();	
		
$data = array('docno'=>$new_docno,'item2'=>$data2_html,'error_found'=>$error_found);
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