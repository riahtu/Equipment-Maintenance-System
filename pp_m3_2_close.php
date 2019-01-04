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
   
	
	
   
   
	$sql = "update mpr_receipt_header set supplierid = '$_POST[supplierid]',
	                                      purchaseorderno = '$_POST[purchaseorderno]',
										  deliveryorderno = '$_POST[deliveryorderno]',
										  docdate  = '$docdate',
										  status = 'C',
										  updatetime = '$now',
										  updateuserid = '$_SESSION[userid]'
										  
										  where docno = '$_POST[docno]'";
			if (!mysql_query($sql)) { die('Error: ' . mysql_error());$error_found = 'X'; }
			
			
	
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