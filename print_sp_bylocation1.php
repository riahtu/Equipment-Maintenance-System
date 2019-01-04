<?php
session_start();
ini_set('memory_limit','-1');
$_SESSION[groupmenu] = 'EMS';
include('check_browser.php');
include('checkuser.php');
include('db_ems.php');
include('modules.php'); 
include("mpdf/mpdf.php");
include('qrcode/qrlib.php');
$tempDir = 'qrcode/temp/';		
// create some HTML content
date_default_timezone_set('Asia/Kuala_lumpur');
$now = date("YmdHis");
$now1 = date("d-m-Y H:i A");
$nowfull = date("d-m-Y H:i A");
$today = date("d/m/Y");

$mpdf = new mPDF('utf-8', 'A4'); 
$mpdf->setHeader('SAPURA MACHINING CORPORATION SDN BHD||SPARE PARTS BY LOCATION');
$mpdf->pagenumPrefix = 'Page ';
$mpdf->nbpgPrefix = ' of ';
$mpdf->setFooter('Report No : SPBL-001 Printed by '.$_SESSION[username].' on '.$nowfull.'||{PAGENO}{nbpg}');

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

$pageone = 'yes';
$mpdf->SetMargins(3, 3, 3);
$mpdf->AddPage('', 'NEXT-ODD', '1', '1', 'off',5,5,10,10,5,5);
require("db_ems.php");
$html .= '<table width="100%"  border="1" style="font-size:20px;color:#000;border-spacing:0px;border-collapse:collapse;">';
$no = 1;
$result1= mysql_query("SELECT distinct locationcode from m_sparepart_loc order by locationcode"); //where sparepartid = '$_GET[sparepartid]'  
while($row1 = mysql_fetch_array($result1))
{
	$locationcode = $row1['locationcode'];
	$no1 = sprintf("%02d", $no);
	
	$html .= '
	<tr style="color:#000000;font-size:8px;background:#A7A7A7">
		<th colspan="3" align="left" valign="middle" style="color:#003366;font-size:25px;font-weight:bold;height:25px;">&nbsp;LOCATION #'.$no1.'</th>	
		<th colspan="1" align="left" valign="middle" style="color:#003366;font-size:25px;font-weight:bold;height:25px;">&nbsp;BIN CODE</th>	
		<th colspan="2" align="left" valign="middle" style="color:#003366;font-size:25px;font-weight:bold;height:25px;">&nbsp;'.$locationcode.'</th>
	</tr>	
	<tr style="color:#003366;font-weight:bold;background-color:#FFF;">
		<th width="5%" style="vertical-align:middle;color:#003366;font-weight:bold;">NO </th> 
		<th width="15%" style="color:#003366;font-weight:bold;">S.P.ID</th> 
		<th width="40%" style="color:#003366;font-weight:bold;">PART NO / PART NAME / MAKER</th> 
		<th width="20%" style="color:#003366;font-weight:bold;">REMARKS</th> 			
		<th width="10%" style="color:#003366;font-weight:bold;">BAL.QTY</th> 
		<th width="10%" style="color:#003366;font-weight:bold;">BARCODE</th> 
	</tr>';
	$noa = 1;
	$resulte = mysql_query("SELECT * FROM m_sparepart_loc where locationcode = '$locationcode' order by sparepartid");
	while ($row2 = mysql_fetch_array($resulte))
	{
		$sparepartid = $row2['sparepartid'];
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
		
		$resultc = mysql_query("SELECT * FROM m_sparepart_bal where sparepartid = '$sparepartid' ");
		if (!mysql_num_rows($resultc) == 0 ) { $balqty = mysql_result($resultc, 0, 'bal_qty');	}
		
		$qrlot = $sparepartid.'-'.$maker.'-'.$barcode;
		$qrlotName = $sparepartid.'.png'; //'-'.$qrlot.
		$qrlotPath = $tempDir.$qrlotName;
		$qrlotFilePath = EXAMPLE_TMP_URLRELPATH.$qrlotName;
		QRcode::png($qrlot, $qrlotPath, QR_ECLEVEL_J, 4);
		if ($balqty > 0){
		$html .= '<tr style="font-weight:bold;">
			<td align="center">'.$noa.'</td> 
			<td align="center">&nbsp;'.$sparepartid.'</td> 
			<td align="left">&nbsp;'.$keycode.'<br />&nbsp;'.$description.'<br />&nbsp;'.$maker.'</td> 
			<td align="center">'.$remarks.'</td> 
			<td align="center">'.$balqty.'</td>
			<td align="center"><img src="'.$qrlotPath.'" border="0" style="width:80px;padding:0;"></td>
			</tr>';
		$noa++; //Part No :&nbsp; Part Name:&nbsp; Maker :&nbsp;
		}
	}		
	$no++;
}
$html .= '</table>';
/*	$html .= '
	<div align="right" width="100%" style="margin-right:40px;position:absolute;margin-top:630px">
	<table align="right" border="1" width="60%" style="background:#FFF;opacity:1;font-size:10px;border-spacing:0px;border-collapse:collapse" >
	<tr><td width="25%" height="10px" align="center">PREPARED BY</td>
		<td width="25%" align="center">CHECKED BY</td>
		<td width="25%" align="center">VERIFIED BY</td>
		<td width="25%" align="center">AUTHORISED BY</td></tr>  
	<tr><td height="30px" align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td></tr>
	<tr><td height="10px" align="center">PPC Executive</td>
		<td align="center">PPC Manager</td>
		<td align="center">Plant Manager</td>
		<td align="center">General Manager</td></tr>
	</table></div>';*/

$mpdf->WriteHTML($html);
$mpdf->Output();
exit;

?>