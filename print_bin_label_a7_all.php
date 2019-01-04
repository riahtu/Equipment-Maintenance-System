<?php
session_start();
ini_set('memory_limit','-1');
$_SESSION[groupmenu] = 'EMS';
include('check_browser.php');
  include('checkuser.php');
 require_once('db_ems.php');
 include('modules.php'); 
//include('db3.php');
include("mpdf/mpdf.php");
include('qrcode/qrlib.php');
$tempDir = 'qrcode/temp/';	
$mpdf = new mPDF('utf-8','A7-L'); //array(101,76) ); array(297,420) size A3 'A7-L'

$html = '<html><head><style>
@page {
  margin: 3%; 
  margin-header: 3mm; 
  margin-footer: 3mm;
}
body {font-family: sans-serif;
	font-size: 12pt;
	background: transparent url(\'bgbarcode.png\') repeat-y scroll left top;
}
h5, p {	margin: 0pt;
}
table.items {
	font-size: 9pt; 
	border-collapse: collapse;
	border: 3px solid #FFFFFF; 
}
td { vertical-align: top; 
}
table thead td { background-color: #EEEEEE;
	text-align: center;
}
table tfoot td { background-color: #AAFFEE;
	text-align: center;
}
.barcode {
	padding: 1.5mm;
	margin: 0;
	vertical-align: top;
	color: #000000;
}
.barcodecell {
	background: #FFFFFF;
	text-align: center;
	vertical-align: middle;
	padding: 0;
}
</style><body>';

// create some HTML content
date_default_timezone_set('Asia/Kuala_lumpur');
$now = date("YmdHis");
$now1 = date("d/m/Y H:i:s A");
$today = date("d/m/Y");
require_once('db.php');
date_default_timezone_set('Asia/Kuala_lumpur');

$sparepartid = $_GET[sparepartid];
	  
$result1= mysql_query("SELECT * from m_sparepart_loc where bal_qty > '0' order by sparepartid"); //where sparepartid = '$_GET[sparepartid]'  
while($row1 = mysql_fetch_array($result1))
{
	$sparepartid = $row1['sparepartid'];
	$balqty = $row1['bal_qty'];
	$resultd = mysql_query("SELECT * FROM m_sparepart where sparepartid = '$sparepartid' ");
	if (!mysql_num_rows($resultd) == 0 ) { 
		$keycode = mysql_result($resultd, 0, 'keycode');	
		$description = mysql_result($resultd, 0, 'description');	
		$maker = mysql_result($resultd, 0, 'maker');	
		$remarks = mysql_result($resultd, 0, 'remarks');	
		$spgroup = mysql_result($resultd, 0, 'spgroup');	
		$sptype = mysql_result($resultd, 0, 'sptype');	
		$barcode = mysql_result($resultd, 0, 'barcode');	
	} else {
		$keycode = '';	$description = '';	$maker = ''; $remarks = ''; $spgroup = ''; $sptype = ''; $barcode = '';
	}
	
	$resultc = mysql_query("SELECT * FROM m_sparepart_loc where sparepartid = '$sparepartid' ");
	if (!mysql_num_rows($resultc) == 0 ){ $lcode = mysql_result($resultc, 0, 'locationcode');	}
		
	$uprice2 = number_format($price, 3, '.', ','); 
				
	$qrlot = $sparepartid;// .'-'.$maker.'-'.$barcode;
	$qrlotName = $sp_id.'-'.$qrlot.'.png'; 
	$qrlotPath = $tempDir.$qrlotName;
	$qrlotFilePath = EXAMPLE_TMP_URLRELPATH.$qrlotName;
	QRcode::png($qrlot, $qrlotPath, QR_ECLEVEL_J, 4);
	$html .= '
	<table border="0"  width="100%" >	
	<tr><td style="text-align:center;font-weight:bold;color:#000000;font-size:16px;">SAPURA MACHINING CORPORATION SDN BHD</td></tr>
	</table>
	<table border="0"  width="100%">
	<tr>
	<td width="30%">
		<table border="1"  width="100%" style="border-spacing:0px;border-collapse:collapse;">
		<tr><td><img src="images/siblogo.jpg" border="0" align="center" style="width:150px;"></td></tr> 
		<tr><td><img src="'.$qrlotPath.'" border="0" style="width:152px;padding:0;"></td></tr>
		</table>
	</td>
	<td width="70%">
		<table border="1" width="100%" style="border-spacing:0px;border-collapse:collapse;font-size:22px;color:#000;font-weight:bold;">
			
			<tr><td align="center" colspan="4" style="color:#000;font-weight:bold;font-size:50px;">SPARE PARTS</td></tr>  
			<tr><td style="width:50px;">SPART ID</td><td colspan="3" style="width:250px;">:&nbsp;'.$sparepartid.'</td></tr>
			<tr><td style="width:50px;">MAKER</td><td colspan="3" style="width:250px;">:&nbsp;'.$maker.'</td></tr>
			<tr><td style="width:50px;">LOCATION</td><td colspan="3" style="width:250px;">:&nbsp;'.$lcode.'</td></tr>
			<tr><td style="width:50px;">BARCODE</td><td colspan="3" style="width:250px;">:&nbsp;'.$barcode.'</td></tr>
			<tr><td style="width:50px;">BALANCE</td><td colspan="3" style="width:250px;">:&nbsp;'.$balqty.'</td></tr>
		</table>
	</td></tr>
	<tr><td colspan="2">
		<table border="1"  width="100%"  style="font-weight:bold;font-size:17px;text-align:center;border-spacing:0px;border-collapse:collapse;color:#000;">			
			<tr>
				<td align="left" width="155px">&nbsp;KEY CODE</td>
				<td align="left" width="430px">:&nbsp;'.$keycode.'</td>
			</tr>
			<tr>
				<td align="left" width="155px">&nbsp;PART NAME</td>
				<td align="left" width="430px">:&nbsp;'.$description.'</td>
			</tr>			
			<tr>
				<td align="left" width="155px">&nbsp;REMARKS</td>
				<td align="left" width="430px">:&nbsp;'.$remarks.'</td>
			</tr>
			</table>
		
	</td> </tr>
	
	</table>
	<table border="0"  width="100%" >	
	<tr><td style="font-weight:bold;color:#000000;font-size:7px;">Label No :&nbsp;'.$qrlot.' Scanned on '.$createtime2.' by '.$creator.'.</td></tr>
	</table>';
	
	$lineno++;
}
//$bc->draw();	
$mpdf->WriteHTML($html);
//$mpdf->AutoPrint(true);
$mpdf->Output();
exit

?>