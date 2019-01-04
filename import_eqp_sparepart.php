<?php
set_time_limit(0);
date_default_timezone_set('Asia/Kuala_lumpur');
$now = date("YmdHis");
require_once("db_ems.php");
require_once 'PHPExcel_1.7.9_doc/Classes/PHPExcel.php';
require_once 'PHPExcel_1.7.9_doc/Classes/PHPExcel/Reader/Excel2007.php';
/*$resulttrans = mysql_query("SELECT * FROM m_product where 
													 
												product = '$_POST[product]'
														   ");
							if (!mysql_num_rows($resulttrans) == 0 )
							{
								$customer = mysql_result($resulttrans, 0, 'customer');
								$sheetname = mysql_result($resulttrans, 0, 'sheetname');
							} */
class MyReadFilter implements PHPExcel_Reader_IReadFilter
{
	public function readCell($column, $row, $worksheetName = '') {
		$Retour=false;
		$column=PHPExcel_Cell::columnIndexFromString($column);// Warning ! A=1, not zero as usual
		if($row<2 || $column>20)
			$Retour=false;
		else
			$Retour=true;
		return $Retour;
	}
}

$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objReader->setReadDataOnly(true);
$objReader->setReadFilter( new MyReadFilter() );
 $inputfile = $_FILES["file"]["name"];
 $tempf = $_FILES["file"]["tmp_name"];
 echo "<p>inputfile : $inputfile $tempf</p>";
$objPHPExcel = $objReader->load($tempf);
//$objPHPExcel->setActiveSheetIndexByName($sheetname);
// $worksheet = $objPHPExcel->getActiveSheet();
echo "<p>step 1</p>";
$worksheet = $objPHPExcel->getSheet(0);
 echo "<table style='font-size:12px;'>";
foreach ($worksheet->getRowIterator() as $row) {
$recno++; $a = '';$b = '';$c = '';$d = '';$e = '';$f = '';$g = '';$h = '';$i = '';
      
		if($row->getRowIndex()>1){
			$rownumber = $row->getRowIndex();
			
			$cellIterator = $row->getCellIterator();
			//Not needed for you, i think, else add a test if(!is_null($cell)) in foreach
			//$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			 $found = '';
		//	 echo "<tr><td>test</td></tr>";
		     $txno = ''; $rel = ''; $employeeno = ''; $familyrecno = '';
			foreach ($cellIterator as $cell) 
			{
				
			   $whichcolumn = $cell->getColumn();
			   if (($whichcolumn == 'A') || ($whichcolumn == 'B') )
			   {
			    $value1 = $cell->getFormattedValue();
				$celldata = PHPExcel_Style_NumberFormat::toFormattedString($value1, 'YYYY-MM-DD');
			   }
			   else
			   {
			    $celldata= $cell->getCalculatedValue();
			   }
			 
			  
			   switch ($whichcolumn) {
				case "A": // remark
					$a = $celldata; 
				break;
				case "B": //descriptioon
					$b = $celldata; 
				break;
				case "C": //part number
					$c = $celldata;
				break;
				case "D": //
					$d = $celldata;
				break;
				case "E":// maker
					$e = $celldata;
				break;
				case "F": //
					$f = $celldata;
				break;
				case "G": // 
					$g = $celldata;
				break;
				case "H": // type
					$h = $celldata;
				break;
				case "I": //critical
					$i= $celldata;
				break;
				case "J": //
					$j = $celldata;
				break;
				case "K"://
					$k = $celldata;
				break;
				case "L": //usage per machine
					$l = $celldata;
				break;
				case "M"://safety qty
					$m = $celldata; 
				break;
				case "O"://upload no
					$o = $celldata; 
				break;
				case "P"://equipmentid
					$p = $celldata;
				break;
				}
             
			  
			}
			$description = mysql_real_escape_string($b);
			  
			$uploadno = preg_replace('/\s+/', '', $o);
			
			if ($uploadno == '') continue;
			$critical = '';
			if ($i == 'O')$critical = 'X';
			
			  
			  $sparepartid = "";
			 $resultsp = mysql_query("SELECT * FROM m_sparepart where uploadno like '$uploadno'");
				if (!mysql_num_rows($resultsp) == 0 ) 
					{
					$sparepartid = mysql_result($resultsp, 0, 'sparepartid');
					}
				echo "<tr><td>description $b</td><td>uploadno $uploadno sparepartid $sparepartid</td>"; 	
			   $resultrec = mysql_query("SELECT * FROM m_equipment_sparepart where sparepartid like '$sparepartid'");
				if (mysql_num_rows($resultrec) == 0 ) 
					{
				
					 echo "<td>----> Insert</td></tr>";
						$sql = "INSERT INTO m_equipment_sparepart(equipmentid,sparepartid,def_qty)
							VALUES ('$p','$sparepartid','$l')";
							if (!mysql_query($sql))
							{
						      die('Error: ' . mysql_error());                    
							}
					}
		}
}
	echo "</table>";

?>