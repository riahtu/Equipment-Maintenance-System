
 <?php
ini_set('memory_limit','-1');
	session_start();
 //include('check_browser.php');
 //include('modules.php'); 
require_once('db_ems.php');
$classid = $_GET[classid];
/*$resultmemo = mysql_query("SELECT * FROM m_memotemplate where 
													memotemplate = '$_GET[memotemplate]'
													");
												
if (!mysql_num_rows($resultmemo) == 0 )
{
	$contentfile = mysql_result($resultmemo, 0, 'contentfile');
}*/

//echo "<p>$_GET[classid] contentfile $contentfile $_GET[memotemplate]</p>";
	include("stock_cardx.php");
//	include("memo_ME1_test.php");
	include("MPDF56/mpdf.php");

//$mpdf=new mPDF('utf-8', array(70,20)); 
//$mpdf = new mPDF(' ', 'A10-L', '1', '1', 1, 1, 1, 1, 1, 1, 'L'); 
//$mpdf=new mPDF(' ','7x2','1','1',1,1,1,1,1,1,'L'); 

$mpdf=new mPDF('c','A4', '30', '', 10, 10, 5, 5, 18, 8);
$mpdf->SetDisplayMode('fullpage');
$mpdf->AddPage();
//$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list

// LOAD a stylesheet
$stylesheet = file_get_contents('mpdfstyles.css');
$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($html);
$filename = 'tag/'.$classid.'.pdf';
$mpdf->Output($filename, 'I');
//   $mpdf->Output($filename, 'F');
   
	
	
//Header("Location: index.php?menuid=96");
//exit;

	
	
function convertdate($indate)
{
 $dd = substr( $indate,8,2);

  $mm = substr( $indate,5,2);

  $yyyy = substr( $indate,0,4);
$outdate = $dd ."-". $mm . "-" . $yyyy;
 return $outdate;

}
function convertdatetime($indate)
{
 $dd = substr( $indate,8,2);

  $mm = substr( $indate,5,2);

  $yyyy = substr( $indate, 0, 4);
   $hms = substr( $indate,10,10);
$outdatetime = $dd ."-". $mm . "-" . $yyyy. ' '.$hms;
 return $outdatetime;

}
	?>