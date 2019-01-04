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

$purchaseorderno = $_POST[purchaseorderno];
$deliveryorderno = $_POST[deliveryorderno];
$supplierid = $_POST[supplierid];
$docno = $_POST[docno];

$barcode = json_decode(stripslashes($_POST['barcode']), true);
$sparepartid = json_decode(stripslashes($_POST['sparepartid']), true);
$description = json_decode(stripslashes($_POST['description']), true);
$quantity = json_decode(stripslashes($_POST['quantity']), true);



    $result11 = mysql_query("SELECT * FROM m_transtype_nr where company = '$_SESSION[company]' and transtype = 'PRV' and year = '$docyear'");
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
   
	$sql = "INSERT INTO mprv_reverse_header(docno,company,storeid,purchaseorderno,deliveryorderno,supplierid,docdate,
	                                   remarks,status,createtime,userid)
			VALUES ('$new_docno','$_SESSION[company]', '$_SESSION[storeid]',UPPER('$_POST[purchaseorderno]'),UPPER('$_POST[deliveryorderno]'), '$_POST[supplierid]','$docdate',
			                           '$remarks','C','$now','$_SESSION[userid]')";
			if (!mysql_query($sql)) { die('Error: ' . mysql_error());$error_found = 'X'; }
	

	$size = sizeof($barcode);
	for($i=0;$i<$size;$i++)
	{
		$bc = $barcode[$i];
		$spid= $sparepartid[$i];
		$desc = $description[$i];
		$qty = $quantity[$i];

		$resultline = mysql_query("SELECT * FROM m_equipment_sparepart where sparepartid = '$spid'");
		if(!mysql_num_rows($resultline)== 0)
		{
			$eqid = mysql_result($resultline, 0, 'equipmentid');
			while($row1 = mysql_fetch_array($resultline)){
				$resultx = mysql_query("SELECT * FROM m_equipment where equipmentid = '$row1[equipmentid]'");
				if(!mysql_num_rows($resultx)==0)
					$lineno = mysql_result($resultx, 0, 'linecode');
			}
		}

		$sql = "INSERT INTO mprv_reverse(docno,company,storeid,lineno,sparepartid,barcode,sp_description,quantity,createtime,userid)
			VALUES ('$new_docno','$_SESSION[company]', '$_SESSION[storeid]','$lineno', '$spid','$bc',
			                           '$desc','$qty','$now','$_SESSION[userid]')";
			if (!mysql_query($sql)) { die('Error: ' . mysql_error());$error_found = 'X'; }


	}		
			
	

	$sqlupd1 = "update m_transtype_nr set currentno='$nextno',lastupdate = '$now',userid='$_SESSION[userid]'
			where company = '$_SESSION[company]' and  transtype = 'PRV' and year = '$docyear'";
	if (!mysql_query($sqlupd1))
	{
		die('Error: ' . mysql_error());                      
	}

	$sqlupd2 = "update mpr_receipt_header set status = 'R' where company = '$_SESSION[company]' and docno = '$docno'";
	if (!mysql_query($sqlupd2))
	{
		die('Error: ' . mysql_error());                      
	}
	
			committrans();	
		
$data = array('docno'=>$new_docno,'error_found'=>$error_found);

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