<?php
include('qrcode/qrlib.php');
date_default_timezone_set('Asia/Kuala_lumpur');
$year = date("Y");
$curdate = date("d-m-Y");
$mth = (int) date("m");
if($mth > 1) 
{
$curperiod = $mth - 1;
$curyear = $year + 1; 
}
else 
{
$curyear = $year;
$curperiod = 12;
}
if(strlen($curperiod) < 2) $cyp = $curyear.'0'.$curperiod; else $cyp = $curyear.$curperiod;


require("db_ems.php");

 $s_partname = "%".$_GET[partname]."%";
   $s_sparepartid = "%".$_GET[sparepartid]."%";
	$s_maker = "%".$_GET[maker]."%";
	$s_barcode = "%".$_GET[barcode]."%";
	   
$result1 = mysql_query("SELECT * from m_sparepart where description like '$s_partname'
														and sparepartid like '$s_sparepartid'
                                                         and maker like '$s_maker'
														 and barcode like '$s_barcode'
														 and spgroup like '$s_spgroup'
														 order by maker,description
														 ");
if (!mysql_num_rows($result1) == 0 )
{

	while($row1 = mysql_fetch_array($result1))
    {
		
		$nn++;
		$tempDir = 'qrcode/temp/';	
		$tagtext = $row1[barcode];
	
		$fileName = $nn.'.png'; 
		$fileImage = $tempDir.$fileName;

		QRcode::png($tagtext, $tempDir.$fileName, QR_ECLEVEL_L);
		$getfile = $tempDir.$fileName;	
		$html .= "<table style='page-break-after:always;margin-top:2px;margin-left:5px;font-family:Times;'  >";

			//$html .= "<tr><td style='text-align:center;vertical-align:top;width:70px;' rowspan=1><img src='$getfile' style='' /> </td><td style='vertical-align:top;font-size:20px;text-align:left;font-weight:bold;width:220px;'>$row0[assetid]</td><td></td></tr>";
			$assetdesc_limit = substr($assetdesc, 0, 120);
			
			$html .= "<tr>";
			$html .= "<td style='width:190px;vertical-align:top;vertical-align:middle;'>";
			//$html .= "<span style='font-size:14px;font-weight:bold;' >Fixed Asset</span> "; 
			$html .= "<span style='font-size:10px;font-weight:bold;' >$companydesc</span> "; 
			$html .= "<br/><span style='font-size:18px;font-weight:bold;' >$row1[description] </span> "; 
			//$html .= "<br/><span style='font-size:10px;font-weight:bold;' >Asset Date : $assetdate</span>";
			//$html .= "<br/><span style='font-size:10px;font-weight:bold;' >Asset Control No : $row0[assetno] </span>";
			$html .= "</td>";
			$html .= "<td style='width:90px;'><img src='$getfile' style='vertical-align:middle;'/></td>";
			$html .= "</tr> ";
			//$html .= "<tr><td style='font-size:11px;vertical-align:middle;;text-align:center;' rowspan=2><img src='$getfile' style='width:150px;vertical-align:middle;'/></td><td style='font-size:30px;vertical-align:middle;text-align:left;font-weight:bold;' > $row0[assetid] <br/><span style='font-size:14px;font-weight:bold;'>$row0[assetno]</span></td></tr>";
			//$html .= "<tr><td style='height:60px;border:1px solid #000000;vertical-align:top;font-size:10px;text-align:left;font-weight:bold;width:200px;'>$assetdesc_limit</td></tr>";
		
			//$html .= "<tr><td style='font-size:10px;vertical-align:top;text-align:left;' >$assetdesc</td></tr>";
		$html .= "</table>";
		//$html .= "</div>";
	}
 }
?>