<?php

session_start();
 date_default_timezone_set('Asia/Kuala_lumpur');
   $now = date("YmdHis");
   $today = date("Y-m-d");
    $cyear = date("Y");
 require('db_ems.php');
echo "<p id='changeList_pp' class='changeList' program='pp_m2_1x.php'>Change List Style</p> ";
echo "<div style='margin-top:20px;text-align:left;color:#007CB9;font-weight:bold;'>Change Document : Enter Search Key</div>";
$result1= mysql_query("SELECT * from m_sparepart where sparepartid = '$_GET[sparepartid]'  ");
if (!mysql_num_rows($result1) == 0 )
{
	$keycode = mysql_result($result1, 0, 'keycode');
	$description = mysql_result($result1, 0, 'description');
	$barcode = mysql_result($result1, 0, 'barcode');
	$maker = mysql_result($result1, 0, 'maker');
	$remarks = mysql_result($result1, 0, 'remarks');
	$spgroup = mysql_result($result1, 0, 'spgroup');
	$sptype = mysql_result($result1, 0, 'sptype');
	$fs = mysql_result($result1, 0, 'fs');
}
		
	echo "<table border=0 style='border-radius:5px;width:98%;border:1px solid #D3D3D3;padding:5px;margin-top:5px;margin-left:10px;text-align:left;font-family:Arial;font-size:11px;height:60px;'>";
		
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Purchase Receive No</td>";
		echo "<td><input id='pp_m1_s_docno' value='$pp_m1_s_docno' style='width:300px;height:24px;'></tr>";
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Year</td>";
		echo "<td style='width:100px;color:#383838;'><select id='pp_m1_s_year' style='font-size:11px;color:#202000;height:30px;width:80px;'>";
			$result1 = mysql_query("SELECT *,YEAR(docdate) as gyear FROM mpr_receipt_header group by YEAR(docdate)  order by YEAR(docdate) desc");
			if (!mysql_num_rows($result1) == 0 )
			{
			    
				echo "<option value=''> </option>    ";
				while($row1 = mysql_fetch_array($result1))
				{
					$selected = '';
				    if ($cyear == $row1[gyear]) $selected = "selected";
					echo "<option value='$row1[gyear]' $selected >$row1[gyear] </option>    ";
					
				}
			}
		echo "</td></tr>";
		echo "<tr><td style='width:100px;padding-left:5px;color:#383838;'>Supplier</td>";
		echo "<td style='width:100px;color:#383838;'><select id='pp_m1_s_supplierid' style='font-size:11px;color:#202000;height:30px;width:400px;'>";
			$resultrec = mysql_query("SELECT * FROM m_supplier where status = ''  order by description");
			if (!mysql_num_rows($resultrec) == 0 )
			{
				echo "<option value=''> </option>    ";
				while($row11 = mysql_fetch_array($resultrec))
				{
					echo "<option value='$row11[supplierid]'>$row11[description] </option>    ";
					
				}
			}
		echo "</td></tr>";

		echo "</table>";
		echo "<div style='margin-top:10px;border-bottom:1px solid #ACACAC;>";
	    echo "<table >";
		echo "<tr>";
		echo "<td style='width:100px;'></td>";
		echo "<td><button id='pp_m1_1_search' sparepartid='$_GET[sparepartid]' style='margin-bottom:10px;width:100px;height:30px;'>SEARCH</button></tr>";
		echo "</table>";
		echo "</div>";

echo "<div id='pp_m2_1_result'>";

echo "<table style='margin-top:20px;text-align:left;color:#007CB9;font-weight:bold;'>";
echo "<tr>";
echo "<td>Purchase Receipt Documents </td> ";
echo "<td style='width:500px;'></td> ";
//echo "<td id='pp_m1_reselect' style='font-size:9px;color:#FF8000;text-decoration:underline;cursor:pointer'>Reselect</td> ";
echo "</tr>";
//echo "<tr><td>s_supplierid $s_supplierid</td></tr>";
echo "</table>";
echo "<div style='min-height:100px;overflow-y:auto;overflow-x:hidden;border-bottom:1px solid #ACACAC'>";
echo "<table  style='font-size:10px;font-family:arial;margin-top:2px;margin-bottom:30px;text-align:left; border-collapse: collapse;' >";
$result1 = mysql_query("SELECT * from mpr_receipt,mpr_receipt_header where mpr_receipt.docno = mpr_receipt_header.docno
																	 and mpr_receipt_header.status = 'C'
																	 order by mpr_receipt.docno desc
														
														 			");
if (!mysql_num_rows($result1) == 0 )
{
		echo "<tr class='' sparepartid='$row1[sparepartid]' docno='$row[docno]' style='background-color:#109FF5;color:#FFFFFF;font-weight:bold;font-family:arial;'>";
		echo "<td style='font-weight:bold;width:100px;height:24px;border:1px solid #ACACAC;padding-left:3px;'>Doc Number</td>";
		echo "<td style='font-weight:bold;width:100px;border:1px solid #ACACAC;padding-left:3px;text-align:center;' >Doc. Date</td>";
		echo "<td style='font-weight:bold;width:300px;border:1px solid #ACACAC;padding-left:3px;' >Supplier</td>";
		echo "<td style='font-weight:bold;width:150px;border:1px solid #ACACAC;padding-left:3px;' >Purchase Order No</td>";	
		echo "<td style='font-weight:bold;width:150px;border:1px solid #ACACAC;padding-left:3px;' >Delivery Order No</td>";	
		echo "</tr>";
	while($row1 = mysql_fetch_array($result1))
    {
		$suppliername = '';
		$resultp = mysql_query("SELECT * from m_supplier where supplierid = '$row1[supplierid]'");
		if (!mysql_num_rows($resultp) == 0 )
		{
			 $suppliername = mysql_result($resultp, 0, 'description');
		}
        $docdate = convertdate($row1[docdate]);
		echo "<tr id='pp_m2_1x_choose' class='pp_m1_1_change' supplierid='$row1[supplierid]' docno='$row1[docno]' style='cursor:pointer;'>";
		echo "<td style='height:24px;border:1px solid #ACACAC;padding-left:3px;'>$row1[docno]</td>";
		echo "<td style='border:1px solid #ACACAC;text-align:center;' >$docdate</td>";
		echo "<td style='border:1px solid #ACACAC;padding-left:3px;' >$suppliername</td>";
		echo "<td style='border:1px solid #ACACAC;padding-left:3px;' >$row1[purchaseorderno]</td>";	
		echo "<td style='border:1px solid #ACACAC;padding-left:3px;' >$row1[deliveryorderno]</td>";	
		echo "</tr>";
		
		
	}	
	
}
else
{

   echo "<p style=text-align:center;width:896px;font-size:10px;color:#FF0000;'>No record found</p>";

}

echo "</table>";
echo "</div>";

echo "<div id='doc_details'></div>";

function convertdate($indate)
{
 $dd = substr( $indate,8,2);

  $mm = substr( $indate,5,2);

  $yyyy = substr( $indate,0,4);
$outdate = $dd ."-". $mm . "-" . $yyyy;
 return $outdate;

}
echo "<div>";
?>