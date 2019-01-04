<?php // You need to add server side validation and better error handling here
session_start();
require("db_ems.php");
date_default_timezone_set('Asia/Kuala_lumpur');
 $now = date("YmdHis");
$data = array();
$resultbf = mysql_query("SELECT * FROM  las_year_bf  where employeeno = '$_SESSION[employeeno]'
															and leavetype = '$leavetype'
															and year = '$_SESSION[selectyear]'
															 ");
			if (!mysql_num_rows($resultbf) == 0 )
			{  
				$bf = mysql_result($resultbf, 0, 'bf');
			}
			

$data = array('d1' => $rec1, 'formData' => $_POST);
echo json_encode($data);

function getExtension($str) {$i=strrpos($str,".");if(!$i){return"";}$l=strlen($str)-$i;$ext=substr($str,$i+1,$l);return $ext;}
?>