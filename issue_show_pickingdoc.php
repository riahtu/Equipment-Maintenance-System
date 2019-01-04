
 <script type="text/javascript">
 $(document).on('click', '#printdoc',PrintDiv);
        function PrintDiv() {
            var data=document.getElementById("myDiv").innerHTML;
            var myWindow = window.open('', 'my div', 'height=10,width=10');
            myWindow.document.write('<html><head><title>my div</title>');
            /*optional stylesheet*/ //myWindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
            myWindow.document.write('</head><body >');
            myWindow.document.write(data);
            myWindow.document.write('</body></html>');
            myWindow.document.close(); // necessary for IE >= 10

            myWindow.onload=function(){ // necessary if the div contain images

                myWindow.focus(); // necessary for IE >= 10
                myWindow.print();
                myWindow.close();
            };
        }
 </script>

<?php

//session_start();
 require('db_ems.php');
   
   echo "<div id='myDiv' style='width:1000px;float:left;'>";
    $result = mysql_query("SELECT * from mop_issue_header where recno = '$_GET[recno]'");
	if (!mysql_num_rows($result) == 0 )
	{
		 $docno = mysql_result($result, 0, 'docno');
		 $company = mysql_result($result, 0, 'company');
		 $storeid = mysql_result($result, 0, 'storeid');
		 $workorderid = mysql_result($result, 0, 'workorderid');
		 $equipmentid = mysql_result($result, 0, 'equipmentid');
		 $receipient = mysql_result($result, 0, 'receipient');
		 $transdate = mysql_result($result, 0, 'transdate');
		 $reasoncode = mysql_result($result, 0, 'reasoncode');
		 $createtime = mysql_result($result, 0, 'createtime');
		 $userid = mysql_result($result, 0, 'userid');
		 $createtime2 = convertdatetime($createtime);
	}
	 $result = mysql_query("SELECT * from m_store where storeid = '$storeid'");
	if (!mysql_num_rows($result) == 0 )
	{
		 $storedesc = mysql_result($result, 0, 'description');
	}
	
	 $resulte = mysql_query("SELECT * from m_equipment where equipmentid = '$equipmentid'");
	if (!mysql_num_rows($resulte) == 0 )
	{
	
		 $equipmentdesc = mysql_result($resulte, 0, 'description');
		
	}
	
	$resultp = mysql_query("SELECT * from m_user where userid = '$receipient'");
	if (!mysql_num_rows($resultp) == 0 )
	{
		 $receipientname = mysql_result($resultp, 0, 'username');
	}
	 $resultp = mysql_query("SELECT * from m_user where userid = '$userid'");
	if (!mysql_num_rows($resultp) == 0 )
	{
		 $username = mysql_result($resultp, 0, 'username');
	}
 require('db_ems.php');
    
 
	$result1= mysql_query("SELECT * from mop_issue where headerid = '$_GET[recno]' ");
	if (!mysql_num_rows($result1) == 0 )
	{
		echo "<table border=0 style='font-size:10px;font-family:arial;margin-top:10px;margin-left:20px;'>";
	    echo "<tr><td style='font-size:20px;font-weight:bold;width:300px;'>Issue Document</td><td style='width:500px;'></td>";
		echo "<td style='font-size:20px;font-weight:bold;'>$docno</td></tr></table>";
		
		echo "<table border=0 style='font-size:10px;font-family:arial;margin-top:10px;margin-left:20px;'>";
	    echo "<tr><td style='vertical-align:top;'>";  //left
			echo "<table  border=0 style='font-size:10px;'>";
			echo "<tr><td style='font-weight:bold;font-size:10px;' colspan=3>ISSUE INFORMATION</td></tr>";
			echo "<tr><td style='width:100px;vertical-align:top;font-size:10px;'>Store</td><td style='font-size:10px;width:50px;vertical-align:top;'>$store </td><td style='width:150px;vertical-align:top;'>$storedesc</td></tr>";
			echo "<tr><td style='font-size:10px;'>Issued by </td><td style='font-size:10px;'> </td><td>$username </td></tr>";
			echo "<tr><td style='vertical-align:top;'>Issued Time </td><td style='font-size:10px;'> </td><td style='vertical-align:top;' colspan=2>$createtime2</td></tr>";
			echo "</table>";
		echo "<td style='width:50px;'></td></td><td style='vertical-align:top;'>"; //right
		echo "<table  border=0 style='font-size:10px;'>";
			echo "<tr><td style='font-weight:bold;' colspan=3>RECEIVE INFORMATION</td></tr>";
			echo "<tr><td style='width:100px;'>Workorder:</td><td style='width:100px;'>$workorderid</td><td></td></tr>";
			echo "<tr><td>Receipient:</td><td style='' colspan=2>$receipientname ($receipient)</td></tr>";
			echo "<tr><td>Reason:</td><td style=''>$reasoncode</td></tr>";
			echo "<tr><td>Machine:</td><td style='' colspan=2>$equipmentdesc</td></tr>";
			
			echo "</table>";
		echo "</td></tr>";
		echo "</table>";
		
		
		echo "<table id='' border=0 style='border-collapse:collapse;font-size:10px;font-family:arial;margin-top:20px;margin-left:20px;'>";
		echo "<tr>";
			echo "<td style='width:50px;text-align:center;font-weight:bold;border-bottom:1px solid #A6A6A6;border-right:1px solid #A6A6A6;' > Line No </td>";
			echo "<td style='width:100px;text-align:left;font-weight:bold;border-bottom:1px solid #A6A6A6;border-right:1px solid #A6A6A6;' > Barcode </td>";
			echo "<td style='width:100px;text-align:center;font-weight:bold;border-bottom:1px solid #A6A6A6;border-right:1px solid #A6A6A6;' > Spare Part Id </td>";
			echo "<td style='width:100px;text-align:center;font-weight:bold;border-bottom:1px solid #A6A6A6;border-right:1px solid #A6A6A6;' > Part Number </td>";
			echo "<td style='width:300px;text-align:left;padding-left:3px;font-weight:bold;border-bottom:1px solid #A6A6A6;border-right:1px solid #A6A6A6;' > Description </td>";
			echo "<td style='width:100px;text-align:center;font-weight:bold;border-bottom:1px solid #A6A6A6;' > Received Qty </td>";
		echo "</tr> ";
		while($row1 = mysql_fetch_array($result1))
		{
			
			$no++;
			echo "<tr style=''>";
			echo "<td style='text-align:center;height:18px;' > $no </td>";
			echo "<td style='text-align:left;' > $row1[barcode] </td>";
			echo "<td class='s_sparepartid' style='text-align:center;' > $row1[sparepartid]  </td>";
			echo "<td class='s_sparepartid' style='text-align:center;' > $row1[part_number]  </td>";
			echo "<td class='s_barcode' style='text-align:left;' > $row1[sp_description]  </td>";
			echo "<td class='s_orderqty' style='text-align:center;' > $row1[quantity]  </td>";
			echo "</tr> ";
		}	
		echo "</table>";
		 echo "<table  border=0 style='font-size:10px;font-family:arial;margin-top:50px;margin-left:30px;text-align:left;'>";
		 echo "<tr><td>"; //left
		 
			echo "<table  border=0 style='border:1px solid #373737;font-size:10px;'>";
			echo "<tr><td style='text-align:left;font-weight:bold;border-bottom:1px solid #252525;height:30px;' colspan=3 >Prepared/Issued by</td></tr>";
			echo "<tr><td style='font-weight:bold;height:30px;width:100px;vertical-align:bottom;' >Signature</td><td style='width:200px;border-bottom:1px solid #000000;' ></td><td style='width:5px;'></td></tr>";
			echo "<tr><td style='font-weight:bold;vertical-aligm:bottom;height:30px;'>Name</td><td style='text-align:left;' colspan=3 >$username</td></tr>";
			echo "<tr><td style='font-weight:bold;vertical-aligm:bottom;height:20px;'>Date </td><td style='text-align:left;' colspan=3 ></td></tr>";
			
			echo "</table>";
			
		echo "<td style='width:70px;'></td></td><td>"; // right
		
			echo "<table  border=0 style='border:1px solid #373737;font-size:10px;'>";
			echo "<tr><td style='text-align:left;font-weight:bold;border-bottom:1px solid #252525;height:30px;' colspan=3 >Received by</td></tr>";
			echo "<tr><td style='font-weight:bold;height:30px;width:100px;vertical-align:bottom;' >Signature</td><td style='width:200px;border-bottom:1px solid #000000;' ></td><td style='width:5px;'></td></tr>";
			echo "<tr><td style='font-weight:bold;vertical-aligm:bottom;height:30px;'>Name </td><td style='text-align:left;' colspan=3 >$receipientname</td></tr>";
			echo "<tr><td style='font-weight:bold;vertical-aligm:bottom;height:20px;'>Date </td><td style='text-align:left;' colspan=3 ></td></tr>";
			echo "</table>";
			
		  echo "</td></tr> ";
		 echo "</table>";
		
	}
	else
	{

	 echo "<div style='margin:0px auto;margin-top:20px;width:400px;text-align:center;font-size:30px;color:#808000;'>Order no $_GET[workorderid]'s detail not found</div>";
	}
echo "</div>";

echo "<div style='position:relative;top:0px;right:20px;'><button id='printdoc' style='width:100px;height:50px;font-size:30px;margin-top:200px;'>Print</button></div>";

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