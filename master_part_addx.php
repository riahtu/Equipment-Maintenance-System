<?php
session_start();


 require('db_ems.php');
 date_default_timezone_set('Asia/Kuala_lumpur');
   $now = date("YmdHis");
   $today = date("Y-m-d");

   // $barcode =  'test';
	$keycode =  $_POST[keycode];
	$description =  $_POST[description];
	$partnumber =  $_POST[partnumber];
	$refDrawing =  $_POST[refDrawing];
	$maker =  $_POST[maker];
	$remarks =  $_POST[remarks];
	$spgroup =  $_POST[spgroup];
	$equipment =  $_POST[equipment];
	$safetyqty =  $_POST[safetyqty];
	$usageqty =  $_POST[usageqty];
	$life =  $_POST[life];
	$sptype =  $_POST[sptype];
	$fs = $_POST[fs];
	$critical = $_POST[critical];
	//$sparepartid =  $_POST[sparepartid];
	//$filename = $_FILES['imageUpload']['name'];
	//starttrans();
	$resultmax = mysql_query("SELECT sparepartid FROM m_sparepart where sparepartid=(SELECT MAX(sparepartid) FROM m_sparepart)");
 	list($max) = mysql_fetch_row($resultmax);

 	$sparepartid = $max + 1;
 	$barcode = 'BC' . str_pad($sparepartid, 5,'0',STR_PAD_LEFT);
 	//echo $barcode;

	if($critical == 'critical'){
		$critical = 'X';
	}
	else{
		$critical = '';
	}

	$target_dir = "images/parts/";
	$filename = $_FILES["imageUpload"]["name"];
	$imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
	$target_file = $target_dir . $barcode . "."."$imageFileType" ;

	if (move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $target_file)){
        echo "The file ". basename( $_FILES["imageUpload"]["name"]). " has been uploaded.";
       
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

	$result = mysql_query("SELECT username FROM m_user where userid = '$_SESSION[userid]'");
	$username = mysql_result($result, 0);
	
	$sql = "INSERT INTO m_sparepart(sparepartid,barcode,description,part_number,reference_drawing,
						keycode,maker,fs,sptype,critical,life,remarks,safety_qty,usage_qty,spgroup,updatetime,user,status)
			VALUES ('$sparepartid','$barcode','$description','$partnumber','$refDrawing','$keycode',
					'$maker','$fs','$sptype','$critical','$life','$remarks','$safetyqty','$usageqty','$spgroup','$now','$username','A')";

			if (!mysql_query($sql)) { die('Error: ' . mysql_error()); }

	$sql = "INSERT INTO m_equipment_sparepart(equipmentid,sparepartid,def_qty)
			VALUES ('$equipment','$sparepartid','$usageqty')";

			if (!mysql_query($sql)) { die('Error: ' . mysql_error()); }


	$sql = "INSERT INTO m_sparepart_file(sparepartid,filepath,description,user,createtime)
			VALUES ('$sparepartid','$target_file','$description','$username','$now')";

			if (!mysql_query($sql)) { die('Error: ' . mysql_error()); }
			
			committrans();	
			
header("location: index.php");

function starttrans()
{
mysql_query("START TRANSACTION");
}

function committrans()
{
mysql_query("COMMIT");
}

?>