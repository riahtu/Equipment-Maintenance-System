
<?php

//session_start();
 require('db_ems.php');
    $result = mysql_query("SELECT * from t_workorder where workorderid = '$_GET[workorderid]'");
	if (!mysql_num_rows($result) == 0 )
	{
		 $technicianid = mysql_result($result, 0, 'userid');
	}
	require('db_hra.php');
	 $resultp = mysql_query("SELECT * from em_personaldata where employeeno = '$technicianid'");
	if (!mysql_num_rows($resultp) == 0 )
	{
		 $technicianname = mysql_result($resultp, 0, 'name');
	}
 require('db_ems.php');
    
 
	$result1= mysql_query("SELECT * from t_workorder_parts where workorderid = '$_GET[workorderid]' ");
	if (!mysql_num_rows($result1) == 0 )
	{
		echo "<div id='title_gradient' style=''>Pick Parts according to Order</div>";
		echo "<table style='font-size:12px;font-family:arial;margin-top:10px;font-weight:bold;'>";
	
		echo "<tr><td style='width:150px;'>Work Order No </td><td>$_GET[workorderid]</td><td style='width:400px;'></td><td><button id='reset_pickqty' workorderid='$_GET[workorderid]'>Reset Pick Qty</button></td></tr>";
		echo "<tr><td>Technician</td><td style='width:50px;'>$technicianid </td><td>$technicianname</td></tr>";
		echo "</table>";
		echo "<table id='t_wp' border=0 style='font-size:12px;font-family:arial;margin-top:20px;'>";
		echo "<tr>";
		echo "<td style='width:50px;text-align:center;font-weight:bold;border-bottom:1px solid #A6A6A6;' > Line No </td>";
		echo "<td style='width:100px;text-align:center;font-weight:bold;border-bottom:1px solid #A6A6A6;' > Work Order No </td>";
		echo "<td style='width:100px;text-align:center;font-weight:bold;border-bottom:1px solid #A6A6A6;' > Spare Part Id </td>";
		echo "<td style='width:100px;text-align:center;font-weight:bold;border-bottom:1px solid #A6A6A6;' > Barcode </td>";
		echo "<td style='width:300px;text-align:left;padding-left:3px;font-weight:bold;border-bottom:1px solid #A6A6A6;' > Description </td>";
		echo "<td style='width:100px;text-align:center;font-weight:bold;border-bottom:1px solid #A6A6A6;' > Order Qty </td>";
		$resultp= mysql_query("SELECT * from mop_issue_header where workorderid = '$_GET[workorderid]' ");
		if (!mysql_num_rows($resultp) == 0 )
		{ 
			$nn = 0;
			while($rowp = mysql_fetch_array($resultp))
			{
			$nn++;
			echo "<td style='width:50px;text-align:center;font-weight:bold;border-bottom:1px solid #A6A6A6;color:#D90000;' >$rowp[docno] </td>";
			$a_docno[$nn] = $rowp[docno];
			}
		}
		    echo "<td style='display:none;width:100px;text-align:center;font-weight:bold;border-bottom:1px solid #A6A6A6;' > Init Bal </td>";
			echo "<td style='width:100px;text-align:center;font-weight:bold;border-bottom:1px solid #A6A6A6;' > Pick Qty </td>";
			
				echo "<td style='width:120px;text-align:center;font-weight:bold;border-bottom:1px solid #A6A6A6;' > Bal2Pick  Qty </td>";
		echo "</tr> ";
		//echo "<div style='display: inline-block;width:20%;'>Monitoring ON<input type='hidden' id='take_order_monitoring' value='ON'/> </div>";
		while($row1 = mysql_fetch_array($result1))
		{
			$no++;
			echo "<tr style=''>";
			echo "<td style='text-align:center;height:18px;' > $no </td>";
			echo "<td style='text-align:center;' > $row1[workorderid] </td>";
			echo "<td class='s_sparepartid' style='text-align:center;' > $row1[sparepartid]  </td>";
			echo "<td class='s_barcode' style='text-align:center;' > $row1[barcode]  </td>";
			echo "<td style='text-align:left;padding-left:3px;' > $row1[sparepartname]  </td>";
			echo "<td class='s_orderqty' style='text-align:center;' > $row1[orderqty]  </td>";
			$pickbalance = $row1[orderqty];
			for ($loop = 1; $loop <= $nn; $loop += 1)
			{
			    $dn = $a_docno[$loop];
				$resultp = mysql_query("SELECT * from mop_issue where workorderid = '$_GET[workorderid]' and docno = '$dn' and sparepartid = '$row1[sparepartid]' ");
				if (!mysql_num_rows($resultp) == 0 )
				{
					$iss_qty = mysql_result($resultp, 0, 'quantity');
					echo "<td class='s_issqty' style='text-align:center;color:#D90000;' > $iss_qty  </td>";
					$pickbalance -= $iss_qty;
				}
				else
				{
					echo "<td class='s_issqty' style='text-align:center;' > 0  </td>";
				}
			}
			echo "<td style='display:none;' class='init_bal' >$pickbalance</td>";
			echo "<td class='s_pickqty' style='text-align:center;' > $row1[d_pickqty]  </td>";
			$pickbalance -= $row1[d_pickqty];
			
			echo "<td class='s_balqty' style='text-align:center;' > $pickbalance </td>";
			echo "</tr> ";
	
			
		}	
		echo "</table>";
		 echo "<table  border=0 style='font-size:12px;font-family:arial;margin-top:50px;'>";
		 echo "<tr>";
		 echo "<td style='text-align:center;' > <button id='scan_part' style='width:200px;height:30px;'>Scan to Pick</button></td>";
		  echo "<td style='text-align:center;' > <button id='gen_pickingdoc'  workorderid='$_GET[workorderid]' style='width:200px;height:30px;'>Generate Picking Document</button></td>";
		  echo "<td style='text-align:center;' > <button id='close_workorder'  workorderid='$_GET[workorderid]' style='width:200px;height:30px;'>Close Order</button></td>";
		
		  echo "</tr> ";
		 echo "</table>";
		
	}
	else
	{

	 echo "<div style='margin:0px auto;margin-top:20px;width:400px;text-align:center;font-size:30px;color:#808000;'>Order no $_GET[workorderid]'s detail not found</div>";
	}

    
 
?>