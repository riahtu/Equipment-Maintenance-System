<?php
session_start();
 $error_found = '';
 require('db_ems.php');
 starttrans();
 date_default_timezone_set('Asia/Kuala_lumpur');
   $now = date("YmdHis");
   $today = date("Y-m-d");
   $remarks =  mysql_real_escape_string($_POST[remarks]);
   $docdate = substr($_POST[docdate], 6, 4).'-'. substr($_POST[docdate], 3, 2).'-'. substr($_POST[docdate], 0, 2);
   $docyear = substr($_POST[docdate], 6, 4);
    $result11 = mysql_query("SELECT * FROM m_transtype_nr where company = '$_SESSION[company]' and transtype = 'PR' and year = '$docyear'");
	if (!mysql_num_rows($result11) == 0 )
	{
		$doc_prefix = mysql_result($result11, 0, 'doc_prefix'); 
		$currentno = mysql_result($result11, 0, 'currentno'); 
		$digits = mysql_result($result11, 0, 'digits'); 
		$nextno = $currentno + 1;
		$new_docno = $doc_prefix.'-'.$docyear.'-'.str_pad($nextno, $digits, '0', STR_PAD_LEFT);
	}
	else 
	{
		echo "<p>Please maintain m_transtype_nr table for year $cur_year</p> ";
		$error_found = 'X';
	}
	
	
	
   
   
	$sql = "INSERT INTO mpr_receipt_header(docno,company,storeid,purchaseorderno,deliveryorderno,supplierid,docdate,
	                                   remarks,status,createtime,userid)
			VALUES ('$new_docno','$_SESSION[company]', '$_SESSION[storeid]',UPPER('$_POST[purchaseorderno]'),UPPER('$_POST[deliveryorderno]'), '$_POST[supplierid]','$docdate',
			                           '$remarks','N','$now','$_SESSION[userid]')";
			if (!mysql_query($sql)) { die('Error: ' . mysql_error());$error_found = 'X'; }
			
			
	$sqlupd1 = "update m_transtype_nr set currentno='$nextno',lastupdate = '$now',userid='$_SESSION[userid]'
			where company = '$_SESSION[company]' and  transtype = 'PR' and year = '$docyear'";
	if (!mysql_query($sqlupd1))
	{
		die('Error: ' . mysql_error());                      
	}
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