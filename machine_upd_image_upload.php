<?php // You need to add server side validation and better error handling here
session_start();
require("db_ems.php");
date_default_timezone_set('Asia/Kuala_lumpur');
$now = date("YmdHis");
$data = array();
$rec1 = "<p>Carid $_GET[carid]</p>";
$equipmentid = $_GET[equipmentid];
if(isset($_GET['files']))
{	
	$error = false;
	$files = array();
	$file_dir = 'images/machines/';
	foreach($_FILES as $file)
	{
	    $name = $file['name'];
		$ext = getExtension($name);
		$newfile = $file_dir.$equipmentid.".".$ext;

		if(move_uploaded_file($file['tmp_name'], $uploaddir .$newfile))
		{
		$files[] = $uploaddir .$file['name'];
		$sql = "update m_equipment_file set 
											filepath = '$newfile' ,
											description = '$name',
											createtime = '$now',
											user = '$_SESSION[user]'
											where equipmentid = '$equipmentid'";
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