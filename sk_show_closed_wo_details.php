<script>

$(document).ready(function(){
    $("input#p_qty").keypress(function(e){
	
	   if (e.which > 31 && (e.which < 48 || e.which > 57)) {
        return false;
    }
	   
       if(e.which == 13) {
	   
	   var workorderid = $(this).attr("workorderid");
       check_qty(workorderid);
	   //$("#p_barcode").focus();
    }
    });
	
	$("input#p2_qty").keypress(function(e){
	 
       if(e.which == 13) {
	   var workorderid = $(this).attr("workorderid");
       check_p2_qty(workorderid);
    }
    });
	
	 $("input#p_barcode").keypress(function(e){
       if(e.which == 13) {
	   var workorderid = $(this).attr("workorderid");
	 
       check_barcode(workorderid);
    }
    });
	
	function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 49 || charCode > 57)) {
        return false;
    }
    return true;
}
	
	
});

function check_qty(workorderid) 
{
	var qty = $("#p_qty").val();
	var g_qty = parseInt(qty || 0);
	var barcode = $("#p_barcode").val();
	if(g_qty <= 0)
	{
		alert("Please insert quantity value");
	
	}
	else $("#p_barcode").focus();
	
	//var workorderid = $(this).attr("workorderid");
	/*
	if(qty > 0) 
	{
		//$('#pick_part_bg').hide();
		//$('#pick_part').hide();
		
		var table_id="t_wp";
		var rows = $("#"+table_id+" tr");
		var mylength = rows.length;
		var new_qty = 0;
		new_qty += parseInt(qty);
		for(var i=1; i < mylength;i++)
		{
			var bal_qty = 0;
			var w_barcode = $("#t_wp tr " ).eq(i).find("td.s_barcode").html();
			var w_pickqty = $("#t_wp tr " ).eq(i).find("td.s_pickqty").html();
			var w_orderqty = $("#t_wp tr " ).eq(i).find("td.s_orderqty").html();
			var w_init_bal = $("#t_wp tr " ).eq(i).find("td.init_bal").html();
		
			var trim_w_barcode = w_barcode.trim();
			
			var trim_barcode = barcode.trim();
			
			if(trim_w_barcode == trim_barcode)
			{
			
			    //var trim_w_orderqty = w_orderqty.trim();
				bal_qty += parseInt(w_init_bal || 0);
				//alert("w_orderqty "+w_orderqty+" bal_qty "+bal_qty);
				var trim_w_pickqty = w_pickqty.trim();
				new_qty += parseInt(trim_w_pickqty || 0);
				bal_qty -= new_qty;
				
				$("#t_wp tr " ).eq(i).find("td.s_pickqty").html(new_qty);
				$("#t_wp tr " ).eq(i).find("td.s_balqty").html(bal_qty);
				$("#p_qty").hide();$("#t_qty").hide();
				$("#p_barcode").show();$("#t_barcode").show();
				$("#p_barcode").val("");
				$("#p_check").focus();
				$("#p_barcode").focus();
				//alert("trim_barcode "+trim_barcode+" workorderid "+workorderid);
				$.get('upd_draf_pickqty.php?barcode='+trim_barcode+'&workorderid='+workorderid+'&d_pickqty='+new_qty, function(data) {
				
				
				});
			}
		}
	}
	*/
	
}


function check_barcode(workorderid) 
{
	var barcode = $("#p_barcode").val();

	$.get('check_barcode.php?barcode='+barcode+'&workorderid='+workorderid, function(data) {
		
	if(data == 'Y')
	{
			var qty = $("#p_qty").val();	
			if(qty > 0) 
			{
				//$('#pick_part_bg').hide();
				//$('#pick_part').hide();
				
				var table_id="t_wp";
				var rows = $("#"+table_id+" tr");
				var mylength = rows.length;
				var new_qty = 0;
				new_qty += parseInt(qty);
				for(var i=1; i < mylength;i++)
				{
					var bal_qty = 0;
					var w_barcode = $("#t_wp tr " ).eq(i).find("td.s_barcode").html();
					var w_pickqty = $("#t_wp tr " ).eq(i).find("td.s_pickqty").html();
					var w_orderqty = $("#t_wp tr " ).eq(i).find("td.s_orderqty").html();
					var w_init_bal = $("#t_wp tr " ).eq(i).find("td.init_bal").html();
				
					var trim_w_barcode = w_barcode.trim();
					
					var trim_barcode = barcode.trim();
					
					if(trim_w_barcode == trim_barcode)
					{
					
						//var trim_w_orderqty = w_orderqty.trim();
						bal_qty += parseInt(w_init_bal || 0);
						//alert("w_orderqty "+w_orderqty+" bal_qty "+bal_qty);
						var trim_w_pickqty = w_pickqty.trim();
						new_qty += parseInt(trim_w_pickqty || 0);
						bal_qty -= new_qty;
						
						$("#t_wp tr " ).eq(i).find("td.s_pickqty").html(new_qty);
						$("#t_wp tr " ).eq(i).find("td.s_balqty").html(bal_qty);
						$("#p_qty").val("1");
						
						$("#p_barcode").val("");
						$("#p_check").focus();
						$("#p_barcode").focus();
						//alert("trim_barcode "+trim_barcode+" workorderid "+workorderid);
						$.get('upd_draf_pickqty.php?barcode='+trim_barcode+'&workorderid='+workorderid+'&d_pickqty='+new_qty, function(data) {
						
						
						});
					}
				}
			}
			}
			else if(data == 'NY')
			{
			    var pickqty = $("#p_qty").val();
				$("<audio></audio>").attr({
						'src':'sounds/wrong.mp3',
						'volume':0.4,
						'autoplay':'autoplay'
					}).appendTo("body");
				$("#scan_input").hide();
				$("#add_new_part").show();
				$("#add_yes").attr("barcode",barcode);
				$("#add_yes").attr("workorderid",workorderid);
				$("#add_yes").attr("pickqty",pickqty);
				$("#new_confirm").html("This barcode "+barcode+" is not included in the workorder part list, are you want add it ? ");
				$("#add_no").focus();
				
				
			}
			else
			{
			
				$("<audio></audio>").attr({
						'src':'sounds/wrong.mp3',
						'volume':0.4,
						'autoplay':'autoplay'
					}).appendTo("body");
					$("#p_barcode").val("");
					$("#p_barcode").focus();
				
				
			}
			
		});
	
	
}

$(document).on('click', '#add_no',add_no);
function add_no() 
{
	$("#add_new_part").hide();
	$("#scan_input").show();
	$("#p_barcode").val("");
	$("#p_barcode").focus();
	
	
}

$(document).on('click', '#add_yes',add_yes);
function add_yes() 
{
   var workorderid = $(this).attr("workorderid");
   var barcode = $(this).attr("barcode");
   var pickqty= $("#p_qty").val();
   $("#add_new_part").hide();
   $("#new_part_pickqty").show();
   $("#p2_qty").focus();
  
}

function check_p2_qty(workorderid) 
{
	var pickqty = $("#p2_qty").val();
	var barcode = $("#p_barcode").val();
	//var workorderid = $(this).attr("workorderid");
	alert("workorderid "+workorderid);
	if(pickqty > 0) 
	{
		$.get('issue_add_new_item.php?barcode='+barcode+'&workorderid='+workorderid+'&pickqty='+pickqty, function(data) 
		{
		
			$.get('process_pick_order_show.php?workorderid='+workorderid, function(data) {
			$("#process_pick_order_show").html(data);
			});
				
		});
	
	
	}
}
// alert("workorderid "+workorderid+"  barcode "+barcode+" pickqty "+pickqty);
//   $.get('issue_add_new_item.php?barcode='+barcode+'&workorderid='+workorderid+'&pickqty='+pickqty, function(data) {
//				alert(data);
//				
//				});

$(document).on('click', '#show_print_overlay',clear_print_popup);
function clear_print_popup() 
{
	
	$("#show_print_overlay").hide();
	$("#show_print_doc").hide();
	
}
</script>
<?php
echo "<div id='sk_show_closed_wo' style='cursor:pointer;margin-top:10px;color:#FF2D2D;text-decoration:underline;text-align:left;font-family:arial;font-weight:bold;'>BACK TO SELECTION</div>";

//session_start();
 require('db_ems.php');
  echo "<div id='wo_item_list' style='margin-top:10px;'>";
    $result = mysql_query("SELECT * from t_workorder where workorderid = '$_GET[workorderid]'");
	if (!mysql_num_rows($result) == 0 )
	{
		 $technicianid = mysql_result($result, 0, 'userid');
		 $equipmentid = mysql_result($result, 0, 'equipmentid');
		 $wo_type = mysql_result($result, 0, 'wo_type');
	}
	require('db_ems.php');
	 $resultp = mysql_query("SELECT * from m_equipment where equipmentid = '$equipmentid'");
	if (!mysql_num_rows($resultp) == 0 )
	{
		 $equipmentdesc = mysql_result($resultp, 0, 'description');
	}
	require('db_ems.php');
	 $resultp = mysql_query("SELECT * from m_user where userid = '$technicianid'");
	if (!mysql_num_rows($resultp) == 0 )
	{
		 $technicianname = mysql_result($resultp, 0, 'username');
	}
 require('db_ems.php');
    

	$result1= mysql_query("SELECT * from t_workorder_parts where workorderid = '$_GET[workorderid]' ");
	if (!mysql_num_rows($result1) == 0 )
	{
		echo "<div id='title_gradient' style='text-align:left;'>Requisition Details</div>";
		echo "<table ' style='font-size:12px;font-family:arial;margin-top:10px;font-weight:bold;'>";
	
		echo "<tr><td style='width:150px;'>Requisition No </td><td>$_GET[workorderid]</td><td style='width:400px;'></td><td></td></tr>";
		echo "<tr><td>Technician</td><td style='width:150px;'>$technicianname </td><td> Id: $technicianid</td></tr>";
		echo "<tr><td>Machine</td><td style='width:50px;'> $equipmentdesc </td></tr>";
		echo "<tr><td>Requisition Type</td><td style='width:50px;'> $wo_type</td></tr>";
		echo "</table>";
		echo "<table id='t_wp' border=0 style='font-size:12px;font-family:arial;margin-top:20px;'>";
		echo "<tr>";
		echo "<td style='width:50px;text-align:center;font-weight:bold;border-bottom:1px solid #A6A6A6;' > No </td>";
		echo "<td style='width:100px;text-align:center;font-weight:bold;border-bottom:1px solid #A6A6A6;' > Part Number </td>";
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
			echo "<td class='show_picking_doc' recno='$rowp[recno]' style='cursor:pointer;width:100px;text-align:center;font-weight:bold;border-bottom:1px solid #A6A6A6;color:#D90000;'>$rowp[docno] </td>";
			$a_docno[$nn] = $rowp[docno];
			}
		}
		    echo "<td style='display:none;width:100px;text-align:center;font-weight:bold;border-bottom:1px solid #A6A6A6;' > Init Bal </td>";
			echo "</tr> ";
		//echo "<div style='display: inline-block;width:20%;'>Monitoring ON<input type='hidden' id='take_order_monitoring' value='ON'/> </div>";
		while($row1 = mysql_fetch_array($result1))
		{
			$no++;
			echo "<tr style=''>";
			echo "<td style='text-align:center;height:18px;' > $no </td>";
			echo "<td class='s_sparepartid' style='text-align:center;' > $row1[part_number]  </td>";
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

			echo "</tr> ";
	
			
		}	
		echo "</table>";
		 echo "<table  border=0 style='font-size:12px;font-family:arial;margin-top:50px;'>";
		 echo "<tr><td style='width:300px;'></td>";
	  echo "<td style='text-align:center;' > <button id='reopen_workorder'  workorderid='$_GET[workorderid]' style='width:200px;height:30px;'>Reopen WorkOrder</button></td>";
		
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

 
?>