<?php
session_start();
 require('db_ems.php');

echo "<div style='margin-top:10px;text-align:left;width:80%;font-size:14px;text-align:left;font-weight:bold;color:#404000;'>Register New Production Line</div>";
		echo "<table border=0 style='border-radius:5px;width:50%;border:1px solid #D3D3D3;padding:5px;margin-top:5px;margin-left:10px;text-align:left;font-family:Arial;font-size:11px;height:60px;'>";
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Line Description</td>";
		echo "<td><input id='lineDescription' value='$lineDesciption' style='width:300px;height:24px;'></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Line Code</td>";
		echo "<td><input id='lineCode' value='$lineCode' style='width:300px;height:24px;'></tr>";

		echo "</table>";
		
	    echo "<table style='margin-top:10px;margin-left:100px;'>";
		echo "<tr>";
		echo "<td style='width:100px;'></td>";
		echo "<td><button id='master_prodline_save' style='width:100px;height:30px;'>Save</button></tr>";
		echo "</table>";

echo "<div style='margin-top:30px;text-align:left;width:80%;font-size:14px;text-align:left;font-weight:bold;color:#404000;'>Register New Supplier</div>";
		echo "<table border=0 style='border-radius:5px;width:50%;border:1px solid #D3D3D3;padding:5px;margin-top:5px;margin-left:10px;text-align:left;font-family:Arial;font-size:11px;height:60px;'>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Supplier Name</td>";
		echo "<td><input id='supplierName' value='$lineDesciption' style='width:300px;height:24px;'></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Country</td>";
		echo "<td><input id='supplierCountry' value='$lineCode' style='width:300px;height:24px;'></tr>";

		echo "</table>";
		
	    echo "<table style='margin-top:10px;margin-left:100px;'>";
		echo "<tr>";
		echo "<td style='width:100px;'></td>";
		echo "<td><button id='master_supplier_save' style='width:100px;height:30px;'>Save</button></tr>";
		echo "</table>";

echo "<div style='margin-top:30px;text-align:left;width:80%;font-size:14px;text-align:left;font-weight:bold;color:#404000;'>Register New Manufacturer</div>";
		echo "<table border=0 style='border-radius:5px;width:50%;border:1px solid #D3D3D3;padding:5px;margin-top:5px;margin-left:10px;text-align:left;font-family:Arial;font-size:11px;height:60px;'>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Manufacturer Name</td>";
		echo "<td><input id='manName' value='$lineDesciption' style='width:300px;height:24px;'></tr>";

		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Description</td>";
		echo "<td><input id='manDesc' value='$lineCode' style='width:300px;height:24px;'></tr>";

		echo "</table>";
		
	    echo "<table style='margin-top:10px;margin-left:100px;'>";
		echo "<tr>";
		echo "<td style='width:100px;'></td>";
		echo "<td><button id='master_manufacturer_save' style='width:100px;height:30px;'>Save</button></tr>";
		echo "</table>";

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