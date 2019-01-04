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
 $result2 = mysql_query("SELECT * from mpr_receipt where docno = '$_POST[docno]' and lineno = '$_POST[lineno]' ");
		if (!mysql_num_rows($result2) == 0 )
		{
		  $sqldel = "delete from mpr_receipt where docno = '$_POST[docno]' and lineno = '$_POST[lineno]'";
			if (!mysql_query($sqldel)) { die('Error: ' . mysql_error());$error_found = 'X'; }
		}
	
   
	$sql = "INSERT INTO mpr_receipt(docno,company,storeid,lineno,sparepartid,barcode,sp_description,quantity,
	                                   createtime,userid)
			VALUES ('$_POST[docno]', '$_SESSION[company]', '$_SESSION[storeid]', '$_POST[lineno]', '$_POST[sparepartid]',
			                           '$_POST[barcode]','$_POST[sparepartname]','$_POST[recv]',
			                           '$now','$_SESSION[userid]')";
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