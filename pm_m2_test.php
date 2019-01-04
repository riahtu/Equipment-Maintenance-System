<?php
session_start();
 require('db_ems.php');

echo "<div style='margin-top:10px;text-align:left;width:80%;font-size:14px;text-align:left;font-weight:bold;color:#404000;'>File Upload</div>";
	
echo "<form action = 'uploadTest.php' method = 'POST' enctype = 'multipart/form-data'>";
		echo "<table border=0 style='border-radius:5px;width:50%;border:1px solid #D3D3D3;padding:5px;margin-top:5px;margin-left:10px;text-align:left;font-family:Arial;font-size:11px;height:60px;'>";
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Choose Image File</td>";
		echo "<td><input type='file' id='image' name='fileToUpload' value='' style='width:300px;height:24px;'></tr>";

		echo "</table>";
		
	    echo "<table style='margin-top:10px;margin-left:100px;'>";
		echo "<tr>";
		echo "<td style='width:100px;'></td>";
		echo "<td><input type='submit' value='save' ></tr>";
		echo "</table>";
echo "</form>";
/*
		echo "<table border=0 style='border-radius:5px;width:98%;border:1px solid #D3D3D3;padding:5px;margin-top:5px;margin-left:10px;text-align:left;font-family:Arial;font-size:11px;height:60px;'>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Line Description</td>";
		echo "<td><input id='lineDesciption' value='$lineDesciption' style='width:300px;height:24px;'></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Line Code</td>";
		echo "<td><input id='linecode' value='$linecode' style='width:300px;height:24px;'></tr>";

		echo "</table>";
		
	    echo "<table style='margin-top:10px;margin-left:100px;'>";
		echo "<tr>";
		echo "<td><button id=''  style='width:100px;height:30px;'>Cancel</button>";
		echo "<td style='width:100px;'></td>";
		echo "<td><button id='master_machine_save' max='$max' style='width:100px;height:30px;'>Save</button></tr>";
		echo "</table>";
*/
?>