
<?php // sk_show_iss_docs
echo "<div id='sk_iss_docs' style='cursor:pointer;margin-top:10px;color:#FF2D2D;text-decoration:underline;text-align:left;font-family:arial;font-weight:bold;'>BACK TO SELECTION</div>";

//session_start();
 require('db_ems.php');
  echo "<div id='wo_item_listx' style='margin-top:10px;'>";
    $result = mysql_query("SELECT * from mop_issue_header where docno = '$_GET[docno]'");
	if (!mysql_num_rows($result) == 0 )
	{
		 $receipient = mysql_result($result, 0, 'receipient');
		 $createtime = mysql_result($result, 0, 'createtime');
		 $createtime2 = convertdatetime($createtime);
		 $userid = mysql_result($result, 0, 'userid');
		 $wo_remarks = mysql_result($result, 0, 'wo_remarks');
		 $recno = mysql_result($result, 0, 'recno');
		 $equipmentid = mysql_result($result, 0, 'equipmentid');
		 $wo_type =  mysql_result($result, 0, 'reasoncode');
	}
	require('db_ems.php');
	 $resultp = mysql_query("SELECT * from m_equipment where equipmentid = '$equipmentid'");
	if (!mysql_num_rows($resultp) == 0 )
	{
		 $equipmentdesc = mysql_result($resultp, 0, 'description');
	}

	 $resultp = mysql_query("SELECT * from m_user where userid = '$receipient'");
	if (!mysql_num_rows($resultp) == 0 )
	{
		 $username = mysql_result($resultp, 0, 'username');
	}
	 $resultp = mysql_query("SELECT * from m_user where userid = '$userid'");
	if (!mysql_num_rows($resultp) == 0 )
	{
		 $preparedby = mysql_result($resultp, 0, 'username');
	}
	$resultp= mysql_query("SELECT * from mop_issue where docno = '$_GET[docno]' ");
	if (!mysql_num_rows($resultp) == 0 )
	{
		 $workorderid = mysql_result($resultp, 0, 'workorderid');
	}
 require('db_ems.php');
    

	$result1= mysql_query("SELECT * from mop_issue where docno = '$_GET[docno]' ");
	if (!mysql_num_rows($result1) == 0 )
	{
	

		echo "<div id='title_gradient' style='text-align:left;'>Issue Part Document Details</div>";
		echo "<table border=0 style='font-size:12px;font-family:arial;margin-top:10px;font-weight:bold;'>";
	
		echo "<tr><td style='width:150px;height:30px;'>Issue Document No </td><td  recno='$recno' style='font-size:20px;color:#D96C00;'>$_GET[docno]</td><td style=''></td><td></td></tr>";
		echo "<tr><td style='width:100px;'>Recepient </td><td style='width:300px;'>$username </td><td style='width:50px;'></td>";
		echo "<td style='width:100px;'>Create Time </td><td style='width:300px;'>$createtime2</td></tr>";
		echo "<tr><td>Machine</td><td style=''>$equipmentdesc</td><td style=''></td>";
		echo "<tr><td>Requisition Type</td><td style=''>$wo_type</td><td style=''></td>";
		echo "<td>Prepared by </td><td style=''>$preparedby</td></tr>";
		echo "<tr><td>Requisition No</td><td id='ir_workorderid' style='' colspan=4>$workorderid </td></tr>";
		echo "<tr><td>Remarks</td><td style='' colspan=4>$wo_remarks</td></tr>";
		echo "</table>";

		echo "<table id='t_ir' border=0 style='font-size:12px;font-family:arial;margin-top:20px;'>";
		echo "<tr>";
		echo "<td style='height:26px;width:50px;text-align:center;font-weight:bold;border-bottom:1px solid #6B6B6B;' > Line No </td>";
		echo "<td style='width:100px;text-align:center;font-weight:bold;border-bottom:1px solid #6B6B6B;' > Spare Part Id </td>";
		echo "<td style='width:115px;text-align:center;font-weight:bold;border-bottom:1px solid #6B6B6B;' > Part Number</td>";
		echo "<td style='width:100px;text-align:center;font-weight:bold;border-bottom:1px solid #6B6B6B;' > Barcode </td>";
		echo "<td style='width:300px;text-align:left;padding-left:3px;font-weight:bold;border-bottom:1px solid #6B6B6B;' > Description </td>";
		echo "<td style='width:100px;text-align:center;font-weight:bold;border-bottom:1px solid #6B6B6B;' >Issued Qty </td>";

		$resultdoc= mysql_query("SELECT * from mop_return_header where workorderid = '$workorderid' ");
		if (!mysql_num_rows($resultdoc) == 0 )
		{ 
			$nn = 0;
			while($rowp = mysql_fetch_array($resultdoc))
			{
			$nn++;
			echo "<td class='' recno='$rowp[recno]' style='width:100px;text-align:center;font-weight:bold;border-bottom:1px solid #A6A6A6;color:#D90000;' >$rowp[docno] </td>";
			$a_docno[$nn] = $rowp[docno];
			}
		}
		else
			echo "<td style='display:none;' >ss </td>";

		echo "<td style='width:100px;text-align:center;font-weight:bold;border-bottom:1px solid #6B6B6B;' >Return Qty </td>";
		echo "</tr> ";
		
		while($row1 = mysql_fetch_array($result1))
		{
			$no++;
			$qty = $row1[quantity];
			
			echo "<tr style=''>";
			echo "<td style='text-align:center;height:20px;border-bottom:1px solid #D8D8D8;' > $no </td>";
			echo "<td class='r_sparepartid' style='text-align:center;border-bottom:1px solid #D8D8D8;' > $row1[sparepartid]  </td>";
			echo "<td class='r_partnumber' style='text-align:center;border-bottom:1px solid #D8D8D8;' > $row1[part_number]  </td>";
			echo "<td class='r_barcode' style='text-align:center;border-bottom:1px solid #D8D8D8;' > $row1[barcode]  </td>";
			echo "<td style='text-align:left;padding-left:3px;border-bottom:1px solid #D8D8D8;' > $row1[sp_description]  </td>";
			echo "<td class='r_issueqty' style='text-align:center;border-bottom:1px solid #D8D8D8;' > $qty  </td>";
			$total = 0;
			for ($loop = 1; $loop <= $nn; $loop += 1)
			{
			    $dn = $a_docno[$loop];
				$resultx = mysql_query("SELECT * from mop_return where workorderid = '$workorderid' and docno = '$dn' and sparepartid = '$row1[sparepartid]'");
				if (!mysql_num_rows($resultx) == 0 )
				{
					$return_qty = mysql_result($resultx, 0, 'return_quantity');
					echo "<td class='' style='text-align:center;color:#D90000;border-bottom:1px solid #D8D8D8;'>$return_qty</td>";
					$total += $return_qty;
				}
				else
				{
					echo "<td class='r_quantity'style='text-align:center;border-bottom:1px solid #D8D8D8;'> 0 </td>";
				}
			}
			echo "<td  class='r_total' style='display:none;text-align:center;border-bottom:1px solid #D8D8D8;'> $total </td>";
			if($total < $qty)
				 echo "<td class='' style='text-align:center;border-bottom:1px solid #D8D8D8;'> 
				 <input class='iss_return_qty' style='width:30px;'></input> </td>";
			else
				echo "<td class='' style='text-align:center;border-bottom:1px solid #D8D8D8;background-color:lightgrey;'>$total</td>";

			echo "</tr> ";
		}	
		echo "</table>";
	    echo "<table  border=0 style='margin-left:800px;font-size:12px;font-family:arial;margin-top:50px;'>";
	    echo "<tr><td style='width:30px;'><button id='update_iss_return' docno='$_GET[docno]' style='width:100px;height:30px;'>Update</button></td>";
		echo "</tr> ";
		echo "</table>";
		
	}
	else
	{

	 echo "<div style='margin:0px auto;margin-top:20px;width:400px;text-align:center;font-size:30px;color:#808000;'>Order no $_GET[workorderid]'s detail not found</div>";
	}

   echo "</div>";
   
   echo "<div id='pick_part_bg'></div>";
   
   echo "<div id='pick_part'>";
   
   echo "<div id='scan_input' style='text-align:center;'>";
	   echo "<div style='font-size:14px;color:#2D2D2D;font-weight:bold;margin:10px;'>Scan part</div>";
	  
	   echo "<div id='t_qty' style='font-size:11px;color:#2D2D2D;font-weight:bold;margin:0px auto;margin-top:10px; width:200px;text-align:center;'>Quantity</div>";
	   echo "<input id='p_qty' workorderid='$_GET[workorderid]' value='1' style='font-size:20px;color:#2D2D2D;font-weight:bold;width:100px;height:30px;margin:0px auto;margin-top:5px;background-color:#FF8204;border:1px solid #5C5C5C;text-align:center;'>";
		 echo "<div id='t_barcode' style='font-size:11px;color:#2D2D2D;font-weight:bold;margin:0px auto;margin-top:20px; width:200px;text-align:center;'>Barcode</div>";
	   echo "<input id='p_barcode' workorderid='$_GET[workorderid]'  style='font-size:20px;color:#2D2D2D;font-weight:bold;width:400px;height:30px;margin-top:5px;background-color:#FF8204;border:1px solid #5C5C5C;text-align:center;'>";
	   echo "<div id='p_message' style='color:#FF0000;font-size:10px;text-align:center;width:400px;margin:0px auto;'></div>";
		echo "<div id='p_stop' style='color:#FF0000;font-size:10px;text-align:center;width:100px;margin:0px auto;margin-top:10px;'>Stop</div>";
		echo "<input id='p_check'  style='width:5px;height:2px;border:0px;'>";
   echo "</div>";//scan_input
   
    echo "<div id='add_new_part' style='display:none;'>";
		echo "<div id='new_confirm' style='margin:20px;font-size:20px;font-weight:bold;color:#FF0606;text-align:center;'></div>";
		echo "<table style='margin:0px auto;'><tr>";
		echo "<td><button id='add_yes' barcode='' workorderid='' pickqty='' style='width:100px;height:50px;'>Yes</button></td><td><button id='add_no' style='width:100px;height:50px;'>No</button></td>";
		echo "</tr></table>";
	echo "</div>"; //add_new_part
   
	echo "<div id='new_part_pickqty' style='display:none;'>";
		echo "<div id='t2_qty' style='font-size:11px;color:#2D2D2D;font-weight:bold;margin:0px auto;margin-top:20px; width:200px;text-align:center;'>New Part's Quantity</div>";
		echo "<input id='p2_qty' workorderid='$_GET[workorderid]' placeholder='0' style='font-size:20px;color:#2D2D2D;font-weight:bold;width:400px;height:30px;margin-top:5px;margin-left:95px;background-color:#FF8204;border:1px solid #5C5C5C;text-align:center;'>";
	echo "</div>"; //new_part_pickqty
	
   echo "</div>"; //pick_part
   
   // Picking Document show
	echo " <div id='show_print_overlay' style='display:none;opacity:0.2;z-index:900;position:fixed;top:0px;left:0px;width:100%;height:100%;background-color:#E8E8E8;'></div>";
	echo "<div id='show_print_doc' style='display:none;z-index:1000;border-radius:10px;position:fixed;top:20px;left:120px;width:1100px;min-height:550px;border:3px solid #818141;background-color:#FFFFFF'></div>";

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