<?php // You need to add server side validation and better error handling here
session_start();
require("db_ems.php");
date_default_timezone_set('Asia/Kuala_lumpur');
$now = date("YmdHis");
$data = array();
$rec1 = "<p>Carid $_GET[carid]</p>";
$sparepartid = $_GET[sparepartid];
$barcode = $_GET[barcode];
if(isset($_GET['files']))
{	
	$error = false;
	$files = array();
	$file_dir = 'images/parts/';
	foreach($_FILES as $file)
	{
	    $name = $file['name'];
		$ext = getExtension($name);
		$newfile = $file_dir.$barcode.".".$ext;

		if(move_uploaded_file($file['tmp_name'], $uploaddir .$newfile))
		{
		$files[] = $uploaddir .$file['name'];
		$sql = "update m_sparepart_file set 
											filepath = '$newfile' ,
											description = '$name',
											createtime = '$now',
											user = '$_SESSION[user]'
											where sparepartid = '$_GET[sparepartid]'";
		if (!mysql_query($sql)) { die('Error: ' . mysql_error()); }
		
		}
		else
		{
		    $error = true;
		}
	}
	$data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
}
else
{
	$data = array('success' => 'Form was submitted', 'formData' => $_POST);
}
$data = array('d1' => $rec1, 'formData' => $_POST);
echo json_encode($data);

function getExtension($str) {$i=strrpos($str,".");if(!$i){return"";}$l=strlen($str)-$i;$ext=substr($str,$i+1,$l);return $ext;}
?>