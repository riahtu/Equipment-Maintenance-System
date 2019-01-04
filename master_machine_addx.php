<?php
session_start();

 require('db_ems.php');
 date_default_timezone_set('Asia/Kuala_lumpur');
   $now = date("YmdHis");
   $today = date("Y-m-d");

    $machineName =  $_POST[machineName];
	$prodLine =  $_POST[prodLine];
	$serialno =  $_POST[serialno];
	$assetNo =  $_POST[assetNo];
	$vendor =  $_POST[vendor];
	$manufacturer =  $_POST[maker];
	$remarks =  $_POST[remarks];
	$mProcess =  $_POST[mProcess];
	$acquiredDate = $_POST[acquiredDate];
	$installedDate = $_POST[installedDate];

	$acquiredDate = substr($acquiredDate, 6,4)."-".substr($acquiredDate, 3,2)."-".substr($acquiredDate, 0,2);
	$installedDate = substr($installedDate, 6,4)."-".substr($installedDate, 3,2)."-".substr($installedDate, 0,2);

	$resultmax = mysql_query("SELECT equipmentid FROM m_equipment where equipmentid=(SELECT MAX(equipmentid) FROM m_equipment)");
 	list($max) = mysql_fetch_row($resultmax);
 	$equipmentid = $max + 1;

	$target_dir = "images/machines/";
	$filename = $_FILES["imageUpload"]["name"];
	$imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
	$target_file = $target_dir . $equipmentid . "."."$imageFileType";

	if (move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $target_file)){
        echo "The file ". basename( $_FILES["imageUpload"]["name"]). " has been uploaded.";
       
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

	$sql = "INSERT INTO m_equipment(equipmentid,description,linecode,serialno,asset_no,company,status,vendor,manufacturer,
									acquired_date,installed_date,remarks,process)
			VALUES ('$equipmentid','$machineName','$prodLine','$serialno','$assetNo','$_SESSION[company]','A','$vendor',
					'$manufacturer','$acquiredDate','$installedDate','$remarks','$mProcess')";

			if (!mysql_query($sql)) { die('Error: ' . mysql_error());}

	$sql = "INSERT INTO m_equipment_file(equipmentid,filepath,description,user,createtime)
			VALUES ('$equipmentid','$target_file','$description','$username','$now')";

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