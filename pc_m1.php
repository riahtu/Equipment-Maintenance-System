<?php
session_start();
 require('db_ems.php');
 date_default_timezone_set('Asia/Kuala_lumpur');
   $now = date("YmdHis");
   $today = date("d-m-Y");

		
		echo "<table border=0 style='width:100%;margin:0px auto;font-family:Arial;text-align:left;margin-top:10px;'>";
		echo "<tr>";
		echo "<td style='font-size:16px;color:#5D5D5D;font-weight:bold;' colspan=3>Generate New Physical Count Schedule</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td style='width:150px;font-size:14px;color:#5D5D5D;font-weight:bold;height:30px;'>Date of stock-take</td>";
		echo "<td style=''><input type='text' id='st_date' class='st_date' value='$today' style='width:100px;height:30px;font-style:italic;color:#003500;'/> </td>";
		echo "</tr>";
		
		
		
		echo "<tr><td>&nbsp</td></tr>";
		echo "<tr><td></td><td><button id='generate_st' class='confirm' data-popup-target='#example-popup' storeidid='$_GET[storeid]'  >Generate</button></td></tr>";
		echo "</table>";
		
		echo "<p id='message'></p>";
		
		$data_html2 = 'Success';	  
				   
//$data = array('item1'=>$data_html,'item2'=>$data_html2,);
//echo json_encode($data);
function starttrans()
{
mysql_query("START TRANSACTION");
}

function committrans()
{
mysql_query("COMMIT");
}
function convertdate($indate)
{
 $dd = substr( $indate,8,2);

  $mm = substr( $indate,5,2);

  $yyyy = substr( $indate,0,4);
$outdate = $dd ."-". $mm . "-" . $yyyy;
 return $outdate;

}


?>