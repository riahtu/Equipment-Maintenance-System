//

$(document).on("click",".docdate",function(){      
                 
                    $(this).datepicker({                       
                            changeMonth: true,
                            changeYear: true,
                            dateFormat: 'dd-mm-yy'                     
                        }).datepicker("show");
                });



$(document).on('click', '.popup-exit',clearPopup);
$(document).on('click', '.popup-overlay',clearPopup);
$(document).on('click', 'td.tm_menu_l2',show_menu_l3);

$(document).on("click",".get_date",function(){      
                 
                    $(this).datepicker({                       
                            changeMonth: true,
                            changeYear: true,
                            dateFormat: 'dd-mm-yy'                     
                        }).datepicker("show");
                });

$(document).ready(function(){
	
	var pick_order_monitoring = $("#pick_order_monitoring").val();
	if(pick_order_monitoring == 'ON' )
	{
		
		setInterval(pick_order_main, 60000);
		
	}
})
function show_menu_l3()
{
	$(".tm_menu_l2").removeClass("tm_menu_l2_pick");
	$(this).addClass("tm_menu_l2_pick");
	$("#tm_menu_l3").empty();
	var menuid = $(this).attr("menuid");
	$.get('tm_show_menu_l3.php?menuid='+menuid, function(data) {
					 $("#tm_menu_l3").html(data);
			});
}

/*
$(document).ready(function(){
   $(".tm_menu_l2").hover(function(){
	    $("#tm_menu_l3").empty();
    $("#tm_menu_l3").append("<td>test</td><td>test2</td>");
},
function(){
   
}); 
});
*/

$(document).on('click', '#logoff',logoff);

function logoff()
{
  location.href = 'logoff.php';
}

$(document).on('click', '#changePassword',changePassword);

function changePassword()
{
  location.href = 'change_password.php';
}

$(document).on('click', '#buttonCancel',buttonCancel);
function buttonCancel()
{
 // alert('test');	
  location.href = 'index.php';
}

$(document).on('click', 'td.tm_menu_l3',show_left_menu);

function show_left_menu()
{
	$(".tm_menu_l3").removeClass("tm_menu_l3_pick");
	$(this).addClass("tm_menu_l3_pick");
	var menuid = $(this).attr("menuid");
	$.get('tm_show_left_menu.php?menuid='+menuid, function(data) {
					 $("#tm_left_menu").html(data);
					 var left_menuid = $(".tm_left_menu_pick").attr("left_menuid");
						$("#show_content").show();
			});
			
	
}


$(document).on('click', '.tm_left_menu',tm_left_menu);

function tm_left_menu()
{
	 $("#show_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
	 var left_menuid = $(this).attr("left_menuid");
	 $(".tm_left_menu").removeClass("tm_left_menu_pick");
	 $(this).addClass("tm_left_menu_pick");
	$.get('tm_show_content.php?left_menuid='+left_menuid, function(data) {
		
					 $("#show_content").html(data);
	});
	
}


$(document).on('change', '#s_part_keycode',search_part_list);
$(document).on('change', '#s_part_maker',search_part_list);
$(document).on('change', '#s_part_description',search_part_list);
$(document).on('change', '#s_part_group',search_part_list);
function search_part_list()
{
	var keycode = $("#s_part_keycode").val();
	var maker = $("#s_part_maker").val();
	var description = $("#s_part_description").val();
	var spgroup = $("#s_part_group").val();
	$.get('tm_show_content_list.php?keycode='+keycode+'&maker='+maker+'&description='+description+'&spgroup='+spgroup, function(data) {
					$("#tm_show_content_list").empty();
					$("#tm_show_content_list").append(data);
	});
	
}

$(document).on('click', '#wo_delete',wo_delete);
function wo_delete()
{
	var workorderid = $(this).attr("workorderid");
	$("#wo_popup_bg").hide();
	$("#wo_popup_content").hide();
	r = confirm("Delete document "+workorderid+"?");
	if(r==false)
		return;

	$.get('wo_delete_button.php?workorderid='+workorderid, function(data) {
			$("#mm_right_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
			$.get('mm_my_wo_closed.php', function(data) {
				$("#mm_right_content").html(data);
			});
		});

}

function tm_part_change()
{
	
	var sparepartid = $(this).attr("sparepartid");
	 $('html').addClass('overlay');
    var activePopup = $(this).attr('data-popup-target');
	$(activePopup).addClass('visible');
	//alert("sparepartid "+sparepartid);
	$.get('tm_part_change.php?sparepartid='+sparepartid, function(data) {
		$(".popup-content").empty();
		$(".popup-content").html(data);
	});
}

//update sparepart
$(document).on('click', '#part_change_save',part_change_save);
function part_change_save()
{
	
	var sparepartid = $(this).attr("sparepartid");
	var keycode = $("#keycode").val();
	var description = $("#description").val();
	var partnumber = $("#partNumber").val();
	var refDrawing = $("#refDrawing").val();
	var maker = $("#maker").val();
	var barcode = $("#barcode").val();
	var remarks = $("#remarks").val();
	var spgroup = $("#spgroup").val();
	var sptype = $("#sptype").val();
	var fs = $("#fs").val();
	var safetyqty = $("#safetyqty").val();
	var usageqty = $("#usageqty").val();
	var critical = $("#critical").val();

	if(critical == 'critical')
		critical = 'X';
	else
		critical = '';

	var r = confirm('Confirm Changes')
	if(r == false)
		return;
	
	$.get('part_change_save.php?sparepartid='+sparepartid+'&keycode='+keycode+'&barcode='+barcode+'&description='+description+'&partnumber='+partnumber+'&refDrawing='+refDrawing+
	                            '&maker='+maker+'&remarks='+remarks+'&spgroup='+spgroup+'&sptype='+sptype+
								'&fs='+fs+'&safetyqty='+safetyqty+'&usageqty='+usageqty+'&critical='+critical, function(data) {
									if(data!='') alert("data"+data);
		  alert("Part was successfully updated ");
		  pm_parts_master();
	});

}

//update Machine
$(document).on('click', '#machine_change_save',machine_change_save);
function machine_change_save()
{
	var equipmentid = $(this).attr("equipmentid");
	var machineName = $("#machineName").val();
	var prodLine = $("#prodLine").val();
	var serialno = $("#serialno").val();
	var assetNo = $("#assetNo").val();
	var vendor = $("#vendor").val();
	var maker = $("#maker").val();
	var remarks = $("#remarks").val();
	var mProcess = $("#process").val();
	var acquiredDate = $("#acquiredDate").val();
	var installedDate = $("#installedDate").val();
	acquiredDate = acquiredDate.substring(6)+'-'+acquiredDate.substring(3,5)+'-'+acquiredDate.substring(0,2);
	installedDate = installedDate.substring(6)+'-'+installedDate.substring(3,5)+'-'+installedDate.substring(0,2);
	
	var r = confirm('Confirm changes');
	if(r == false)
		return;

	$.get('machine_change_save.php?equipmentid='+equipmentid+'&machineName='+machineName+'&prodLine='+prodLine+'&serialno='+serialno+'&assetNo='+assetNo+
	                            '&vendor='+vendor+'&maker='+maker+'&remarks='+remarks+'&mProcess='+mProcess+'&acquiredDate='+acquiredDate+'&installedDate='+installedDate, function(data){
									if(data!='') alert("data"+data);
		  alert("Machine was successfully updated ");
		  pm_parts_master();
	});
}

$(document).on('click', '#machine_change_delete',machine_change_delete);
function machine_change_delete()
{
	var r = confirm('Confirm delete');
	if(r == false)
		return;
	var equipmentid = $(this).attr("equipmentid");
	$.get('machine_change_delete.php?equipmentid='+equipmentid, function(data){
		  if(data!='') alert("data"+data);
		  alert("Machine was successfully deleted");
		  pm_parts_master();
	});

}

$(document).on('click', '#part_change_delete',part_change_delete);
function part_change_delete()
{
	var r = confirm('Confirm delete');
	if(r == false)
		return;
	var sparepartid = $(this).attr("sparepartid");
	$.get('part_change_delete.php?sparepartid='+sparepartid, function(data){
		  if(data!='') alert("data"+data);
		  alert("Part was successfully deleted");
		  pm_parts_master();
	});
}

$(document).on('click', '#set_status',set_status);
function set_status()
{
	$.get('part_set_status.php', function(data){
		  if(data!='') alert("data"+data);
		  alert("Part was successfully set");
		  pm_parts_master();
	});
}

//Register New Sparepart
$(document).on('click', '#master_part_save',master_part_save);
function master_part_save()
{
	//rest of variable:
	var keycode = $("#keycode").val();
	var description = $("#description").val();
	var partnumber = $("#partnumber").val();
	var refDrawing = $("#refDrawing").val();
	var maker = $("#maker").val();
	var remarks = $("#remarks").val();
	var spgroup = $("#spgroup").val();
	var equipment = $("#equipment").val();
	var safetyqty = $("#safetyqty").val();
	var usageqty = $("#usageqty").val();
	var life = $("#life").val();
	var sptype = $("#sptype").val();
	var fs = $("#fs").val();
	var critical = $("#critical").val();

	// Check safety qty and usage qty
	var nanSafetyqty = isNaN(safetyqty);
	var nanUsageqty = isNaN(usageqty);
	var nanLife = isNaN(life);


	if(nanSafetyqty == true){
		alert('Invalid Safety Quantity');
		return;
	}
	if(nanUsageqty == true){
		alert('Invalid Usage Quantity');
		return;
	}
	if(nanLife == true){
		alert('Invalid Life input');
		return;
	}


	if(critical == 'critical')
		critical = 'X';
	else
		critical = '';

	if(partnumber =='' && description=='' && safetyqty == '' && usageqty == ''){
		alert('Input Error');
		return;
	}

	var r = confirm("Confirm to add sparepart");
	if(r==false){
		return;
	}
	else{
		alert("Part "+description+" was successfully added");
		$('#formPart').submit();
	}

}

$(document).on('change', '#checkImage',checkImage);
function checkImage()
{
	var ext = $('#checkImage').val().replace(/^.*\./, '');
	if(ext == 'jpg' || ext == 'png' || ext == 'gif' || ext == 'jpeg'){
		return;
	}
	else{
		alert('Please upload jpg, jpeg, png, and gif image only');
		return
	}
}
//Register New Machine
$(document).on('click', '#master_machine_save',master_machine_save);
function master_machine_save()
{
	var machineName = $("#machine_name").val();
	var prodLine = $("#prodline").val();
	var serialno = $("#serialno").val();
	var assetNo = $("#assetNo").val();
	var vendor = $("#vendor").val();
	var manufacturer = $("#maker").val();
	var remarks = $("#remarks").val();
	var mProcess = $("#process").val();
	var acquiredDate = $("#acquired_date").val();
	var installedDate = $("#installed_date").val();

	acquiredDate = acquiredDate.substring(6)+'-'+acquiredDate.substring(3,5)+'-'+acquiredDate.substring(0,2);
	installedDate = installedDate.substring(6)+'-'+installedDate.substring(3,5)+'-'+installedDate.substring(0,2);
	
	if(machineName == '' && prodLine == ''){
		alert('Input Error');
		return;
	}
	var r = confirm('Confirm add Machine')
	if(r == false){
		return;
	}
	else{
		alert("Machine "+machineName+" was successfully added");
		$('#formMachine').submit();
	}
}

//Register Production Line
$(document).on('click', '#master_prodline_save',master_prodline_save);
function master_prodline_save()
{
	var lineDescription = $("#lineDescription").val();
	var lineCode = $("#lineCode").val();
	
	if(lineDescription == '' && lineCode == ''){
		alert('Input Error');
		return;
	}

	var r = confirm('Confirm add Production Line')
	if(r == false)
		return;
 
	
	$.get('master_prodline_add.php?lineDescription='+lineDescription+'&lineCode='+lineCode, function(data) {
									if(data!='') alert("data"+data);
		  alert("Production Line "+lineDescription+" was successfully added");
		  $.get('pm_m2_others.php', function(data) {
			 $('#right_content_sub').html(data);
		  });
	});
}

//Register New Manufacturer
$(document).on('click', '#master_manufacturer_save',master_manufacturer_save);
function master_manufacturer_save()
{
	var manName = $("#manName").val();
	var manDesc = $("#manDesc").val();
	
	if(manName == '' && manDesc == ''){
		alert('Input Error');
		return;
	}

	var r = confirm('Confirm add New Manufacturer')
	if(r == false)
		return;

	
	$.get('master_manufacturer_add.php?manName='+manName+'&manDesc='+manDesc, function(data) {
									if(data!='') alert("data"+data);
		  alert("Manufacturer "+manName+" was successfully added");
		   $.get('pm_m2_others.php', function(data) {
			 $('#right_content_sub').html(data);
		  });
		 
	});
}

//Register New Supplier
$(document).on('click', '#master_supplier_save',master_supplier_save);
function master_supplier_save()
{
	var supplierName = $("#supplierName").val();
	var supplierCountry = $("#supplierCountry").val();
	
	if(supplierName == '' && supplierCountry == ''){
		alert('Input Error');
		return;
	}

	var r = confirm('Confirm add New Supplier')
	if(r == false)
		return;

	
	$.get('master_supplier_add.php?supplierName='+supplierName+'&supplierCountry='+supplierCountry, function(data) {
									if(data!='') alert("data"+data);
		  alert("Supplier "+supplierName+" was successfully added");
		   $.get('pm_m2_others.php', function(data) {
			 $('#right_content_sub').html(data);
		  });
		 
	});
}

$('.popup-overlay').click(function () {
        clearPopup();
    });
 $(document).keyup(function (e) {
	
        if (e.keyCode == 27 && $('html').hasClass('overlay')) {
            clearPopup();
        }
    });
function clearPopup() {
		
	
        $('.popup.visible').addClass('transitioning').removeClass('visible');
        $('html').removeClass('overlay');
 
        setTimeout(function () {
            $('.popup').removeClass('transitioning');
        }, 200);
		
    }

	
$(document).on('click', '.mpart_tabmenu',mpart_tabmenu);
function mpart_tabmenu() 
{
		$(".mpart_tabmenu").attr("id","");
	    $(this).attr("id","tab_selected");
		var carid = $("#carid").val();
		var choose = $(this).attr("choose");
		
		if(choose == 't1')
		{
		$('#show_area').html("<img src='images/loading.gif'  />");
		$.get('mpart_main_show.php?sparepartid='+sparepartid, function(data) {
		
			$("#show_area").html(data);
		});
		}
		
		if(choose == 't2')
		{
		$('#show_area').html("<img src='images/loading.gif'  />");
		$.get('mpart_picture_show.php?sparepartid='+sparepartid, function(data) {
		
			$("#show_area").html(data);
		});
		}		
}

$(document).on('click', '.mpart_picture_upload',mpart_picture_upload);
function mpart_picture_upload() 
{
	var sparepartid = $(this).attr("sparepartid");
	$("#popup_upload").show();
	$("#temp_sparepartid").val(sparepartid);	
}

$(document).on('click', '#b_cancel',b_cancel);
function b_cancel() 
{
	$("#popup_upload").hide();	
}

$(document).on("click", "#update_part_image", function(){
r = confirm('Confirm upload');
if(r == false) return;

var sparepartid = $("#temp_sparepartid").val();
var barcode = $("#barcode").val();
var file_data = $("#file_upload").prop("files")[0]; // Getting the properties of file from file field
var form_data = new FormData(); // Creating object of FormData class
form_data.append("file", file_data) // Appending parameter named file with properties of file_field to form_data
var ext = $('#file_upload').val().replace(/^.*\./, '');
//form_data.append("user_id", 123) // Adding extra parameters to form_data
if(ext == 'jpg' || ext == 'png'){
  $.ajax({
    url:'mpart_picture_upload.php?files&sparepartid='+sparepartid+'&barcode='+barcode,
    cache: false,
	dataType:"JSON",
    contentType: false,
    processData: false,
    data: form_data, // Setting the data attribute of ajax with file_data
    type: 'post',
    success: function(data) {
			$('#right_content_sub').html("<img src='images/loading.gif'  />");
			alert("Successfully Updated image")
			$.get('pm_mpart_picture_show.php?sparepartid='+sparepartid, function(data) {
				$("#right_content_sub").html(data);
			});
    },
	 error : function(data, status, error) {
            alert("error data "+data.d1);
            e.preventDefaultEvent();
        }
  });
} 
else
	alert('Error: Please upload jpeg or png file');
});

$(document).on("click", "#update_machine_image", function(){
r = confirm('Confirm upload');
if(r == false) return;

var equipmentid = $("#equipmentid").val();
var file_data = $("#file_upload").prop("files")[0]; // Getting the properties of file from file field
var form_data = new FormData(); // Creating object of FormData class
form_data.append("file", file_data) // Appending parameter named file with properties of file_field to form_data
var ext = $('#file_upload').val().replace(/^.*\./, '');
//form_data.append("user_id", 123) // Adding extra parameters to form_data
if(ext == 'jpg' || ext == 'png'){
  $.ajax({
    url:'machine_upd_image_upload.php?files&equipmentid='+equipmentid,
    cache: false,
	dataType:"JSON",
    contentType: false,
    processData: false,
    data: form_data, // Setting the data attribute of ajax with file_data
    type: 'post',
    success: function(data) {
			$('#right_content_sub').html("<img src='images/loading.gif'  />");
			alert("Successfully Updated image")
			$.get('pm_upd_machine_image.php?sparepartid='+sparepartid, function(data) {
				$("#right_content_sub").html(data);
			});
    },
	 error : function(data, status, error) {
            alert("error data "+data.d1);
            e.preventDefaultEvent();
        }
  });
} 
else
	alert('Error: Please upload jpeg or png file');
});

$(document).ready(function(){
	
/*	var take_order_monitoring = $("#take_order_monitoring").val();
	
	if(take_order_monitoring == 'ON' )
	{
		
		setInterval(alertFunc, 2000);
		
	}
	*/
})
function pick_order_main() 
{       
		//alert("Monitor");
		var sparepartid = $("#sparepartid").val();
		$('#show_area').html("<img src='images/loading.gif'  />");
		$.get('inv_pick_order_main.php?sparepartid='+sparepartid, function(data) {
		
			$("#show_area").html(data);
		});
}


$(document).on('click', '#pick_order_outstanding',process_take_order);
function process_take_order() 
{

	var workorderid = $(this).attr('workorderid');
	$("#show_open_wo").hide();
	$("#show_outstanding").hide();
	$("#changeList").hide();
	$.get('process_pick_order_show.php?workorderid='+workorderid, function(data) {
			$("#process_pick_order_show").html(data);
		});
}

$(document).on('click', '#scan_part',scan_part);
function scan_part() 
{
	
    $('#pick_part_bg').show();
    $('#new_part_pickqty').hide();
    $('#add_new_part').hide();
	$('#pick_part').show();
	$('#scan_input').show();
	$("#p_barcode").val("");
	$("#p_barcode").focus();
	
	
}
$(document).on('click', '#pick_part_bg',clear_popup_pick);
function clear_popup_pick() 
{
	$('#pick_part_bg').hide();
	$('#pick_part').hide();
	
}

//$(document).on('change', '#p_barcode',check_barcode);
/*function check_barcode() 
{
	var barcode = $("#p_barcode").val();
	var workorderid = $(this).attr("workorderid");
	$.get('check_barcode.php?barcode='+barcode+'&workorderid='+workorderid, function(data) {
		
			if(data == 'Y')
			{
				$("#p_barcode").hide();$("#t_barcode").hide();
				$("#p_qty").fadeIn();$("#t_qty").fadeIn();
				$("#p_qty").focus();
				$("#p_message").html("");
			}
			else
			{
				$("#pick_part").hide();
				$("#add_new_part").show();
				$("#p_message").html('Barcode not valid - '+barcode);
				$("#p_barcode").val("");
				$("#p_check").focus();
				$("#p_barcode").focus();
			}
		});
	
	
}


i = 0;
$(document).ready(function(){
    $("input#test1").keypress(function(){
        $("#test2").text(i += 1);
    });
});
*/ 
 
//$(document).on('change', '#p_qty',check_qty);
function check_qty() 
{
	var qty = $("#p_qty").val();
	var barcode = $("#p_barcode").val();
	var workorderid = $(this).attr("workorderid");
	if(qty > 0) 
	{
		//$('#pick_part_bg').hide();
		//$('#pick_part').hide();
		
		var table_id="t_wp";
		var rows = $("#"+table_id+" tr");
		var mylength = rows.length;
		
		for(var i=1; i < mylength;i++)
		{
			var w_barcode = $("#t_wp tr " ).eq(i).find("td.s_barcode").html();
			
			var trim_w_barcode = w_barcode.trim();
			
			var trim_barcode = barcode.trim();
			
			if(trim_w_barcode == trim_barcode)
			{
				
				$("#t_wp tr " ).eq(i).find("td.s_pickqty").html(qty);
				$("#p_qty").hide();$("#t_qty").hide();
				$("#p_barcode").fadeIn();$("#t_barcode").fadeIn();
				$("#p_check").focus();
				$("#p_barcode").focus();
			}
		}
	}
	
	
}


$(document).on('click', '#gen_pickingdoc',gen_pickingdoc);
function gen_pickingdoc() 
{
	
	var workorderid = $(this).attr("workorderid");
	var table_id="t_wp";
	var rows = $("#"+table_id+" tr");
	var mylength = rows.length;
	var a_barcode =[]; var a_pickqty =[]; var a_sparepartid =[]; var a_partnumber =[]; var count=0; var total = 0;

	for(var i=1; i < mylength;i++)
	{
		var w_pickqty = $("#t_wp tr " ).eq(i).find("td.s_pickqty").html();
		w_pickqty = parseInt(w_pickqty || 0);
		total += w_pickqty;
		if(w_pickqty > 0 )
		{
			count++;
			var w_barcode = $("#t_wp tr " ).eq(i).find("td.s_barcode").html();
			var w_sparepartid = $("#t_wp tr " ).eq(i).find("td.s_sparepartid").html();
			var w_partnumber = $("#t_wp tr " ).eq(i).find("td.s_partnumber").html();
			
			a_barcode[count] = w_barcode.trim();
			a_pickqty[count] = w_pickqty;
			a_sparepartid[count] = w_sparepartid;
			a_partnumber[count] = w_partnumber;
		}
	}
	if(total == 0){
		alert('Error');
		return;
	}
	//alert("workorderid "+workorderid);
	$.ajax({
        type: "POST",
        url: "issue_gen_pickinglist.php",
        data: {workorderid:workorderid, array_barcode: JSON.stringify(a_barcode),array_pickqty: JSON.stringify(a_pickqty),array_sparepartid: JSON.stringify(a_sparepartid),array_partnumber: JSON.stringify(a_partnumber)},
        success: function(datax) {
           //alert("data"+datax);
		   var jsonData = JSON.parse(datax);
		   var t1 = jsonData.item1;
		 //  alert("datax.item1 "+t1);
		   // reset pick qty
		$.get('reset_pickqty.php?workorderid='+workorderid, function(data) {
		
			$.get('process_pick_order_list.php?workorderid='+workorderid, function(data) {
			$("#wo_item_list").html(data);
			});
		});
		//Show pre-printing document
			$("#show_print_overlay").show();
			$("#show_print_doc").show();
		//	alert("data.item1 "+data.item1);
			$.get('issue_show_pickingdoc.php?recno='+t1, function(datapic) {
				$("#show_print_doc").html(datapic);
			});
        }
    });
}

$(document).on('click', '#update_iss_return',update_iss_return);
function update_iss_return() 
{
	var workorderid = $("#ir_workorderid").html();
	var docno = $(this).attr("docno");
	var table_id="t_ir";
		var rows = $("#"+table_id+" tr");
		var mylength = rows.length;
		var a_barcode =[]; var a_return_qty =[]; var a_sparepartid =[]; var sparepartid =[]; var a_partnumber =[]; var a_issueqty =[];  var count=0;
		for(var i=1; i < mylength;i++)
		{
		    
			var w_return_qty = $("#t_ir tr " ).eq(i).find("input.iss_return_qty").val();
			var w_issueqty = $("#t_ir tr " ).eq(i).find("td.r_issueqty").html();

			var w_barcode = $("#t_ir tr " ).eq(i).find("td.r_barcode").html();
		    var w_sparepartid = $("#t_ir tr " ).eq(i).find("td.r_sparepartid").html();
		    var w_partnumber = $("#t_ir tr " ).eq(i).find("td.r_partnumber").html();
		    var w_issueqty = $("#t_ir tr " ).eq(i).find("td.r_issueqty").html();
		    var total = $("#t_ir tr " ).eq(i).find("td.r_total").html();

		    total = parseInt(total);

		    w_return_qty = parseInt(w_return_qty || 0);
			w_issueqty = parseInt(w_issueqty);
			balance = w_issueqty - total;

		    if(w_return_qty > 0 && w_return_qty <= w_issueqty && w_return_qty <= balance)
			{
				count++;
				a_barcode[count] = w_barcode.trim();
				a_return_qty[count] = w_return_qty;
				a_sparepartid[count] = w_sparepartid;
				a_partnumber[count] = w_partnumber;
				a_issueqty[count] = w_issueqty;
			}	
		}
		if(a_barcode == ''){
			alert('Error');
			return;
		}

$.ajax({
        type: "POST",
        url: "upd_iss_return.php",
        data: {workorderid:workorderid, array_barcode: JSON.stringify(a_barcode),array_returnqty: JSON.stringify(a_return_qty),array_sparepartid: JSON.stringify(a_sparepartid),array_partnumber: JSON.stringify(a_partnumber),array_issueqty: JSON.stringify(a_issueqty)},
        success: function(datax) {
           alert("data"+datax);
		   var jsonData = JSON.parse(datax);
		   var t1 = jsonData.item1;

		$.get('sk_show_iss_docs_return.php?docno='+docno, function(data) {
			//$("#sk_iss_docs").hide();
			$("#show_iss_docs_details").html(data);
		});

        }
    });
}

$(document).on('click', '#reset_pickqty',reset_pickqty);
function reset_pickqty() 
{
	
	var workorderid = $(this).attr("workorderid");
	$.get('reset_pickqty.php?workorderid='+workorderid, function(data) {
		
		   
			if(data != '') alert(data);
			$('#process_pick_order_show').html("<img src='images/loading.gif'  />");
			$.get('process_pick_order_show.php?workorderid='+workorderid, function(data) {
		
		   
			$("#process_pick_order_show").html(data);
		});
		});
}


$(document).on('click', '#close_workorder',close_workorder);
function close_workorder() 
{
	var check = confirm("Are you sure to close this workorder?");
	if (check == true)
	{
	var workorderid = $(this).attr("workorderid");
	$.get('sk_close_workorder.php?workorderid='+workorderid, function(data) {
			if(data != '') alert(data);
		
			sk_open_wo();
		});
	}
}


function reshow_menu_l3()
{
     
	 $("#show_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
	 var left_menuid = $(".tm_left_menu_pick").attr("left_menuid");
     
	$.get('tm_show_content.php?left_menuid='+left_menuid, function(data) {
		
					 $("#show_content").html(data);
	});
   
	
}


$(document).on('click', '.show_picking_doc',show_picking_doc);
function show_picking_doc() 
{

	$("#show_print_overlay").show();
	$("#show_print_doc").show();
	var recno = $(this).attr("recno");
	$.get('issue_show_pickingdoc.php?recno='+recno, function(datapic) {
				$("#show_print_doc").html(datapic);
			});
}

$(document).on('change', '#wo_workorderid',search_wo_list);
$(document).on('change', '#wo_equipment',search_wo_list);
$(document).on('change', '#wo_linecode',search_wo_list);
$(document).on('change', '#wo_reasoncode',search_wo_list);

function search_wo_list()
{
	
	var workorderid = $("#wo_workorderid").val();
	var equipment = $("#wo_equipment").val();
	var linecode = $("#wo_linecode").val();
	var reasoncode = $("#wo_reasoncode").val();
	var username = $("#wo_username").val();
	var closed = $("#wo_closed").val();

	$.get('wo_show_list.php?workorderid='+workorderid+'&equipment='+equipment+'&linecode='+linecode+'&reasoncode='+reasoncode+'&username='+username+'&closed='+closed, function(data) {
				
		
		$("#wo_show_list").html(data);
					
					
	});
	
}
$(document).on('click', '#create_new_workorder',new_workorder);
$(document).on('click', '#icon_new_workorder',new_workorder);
$(document).on('click', '#mm_my_wo_new',new_workorder);


function new_workorder()
{
	$(".mm_left_menu").removeClass("mm_pick");
	$("#mm_my_wo_new").addClass("mm_pick");
    $("#workorder_manage_list").fadeOut(1000);
	 	$.get('wo_new.php', function(data) {
	    $("#mm_right_content").html(data);			
	});
}

$(document).on('change', '#wo_select_linecode',wo_select_linecode);
function wo_select_linecode()
{
	
	var linecode = $(this).val();
	
	$.get('wo_select_linecode.php?linecode='+linecode, function(data) {
		$("#wo_select_equipmentid").html(data);
	});
	
}

$(document).on('change', '#wo_select_equipmentid',wo_change_image);
function wo_change_image()
{
	var equipmentid = $('#wo_select_equipmentid').val();
	$.get('wo_select_image.php?equipmentid='+equipmentid, function(data){
		$("#machine_image").html(data);
	});
	
}

$(document).on('change', '#wo_select_equipmentid',wo_select_equipmentid);
function wo_select_equipmentid()
{
	var equipmentid = $('#wo_select_equipmentid').val();
	var wo_type = $("#wo_select_wo_type").val();
	if(wo_type=='PV')
	{
		$.get('wo_select_pv_schedule.php?equipmentid='+equipmentid, function(data) {
			
		$("#wo_select_pv_schedule").html(data);
	});
		
		
		
		
	}
	var linecode = $('#wo_select_linecode').val();

	
	$.get('wo_select_equipment.php?equipmentid='+equipmentid, function(data) {
		$("#wo_select_parts").html(data);
	});
	
}

$(document).on('click', '.wo_part_choose',wo_part_choose);
function wo_part_choose()
{
	var wo_def_qty = $(this).find("td.wo_def_qty").html();
	//alert("wo_def_qty "+wo_def_qty);
	var wo_orderqty = $(this).find("input.wo_orderqty").val();
	var wo_selected = $(this).find("td.wo_selected").html();
	if(wo_selected == '')
	{
		$(this).find("td.wo_selected").html("X");
		$(this).css("background-color","#E5E5E5");
		$(this).find("input.wo_orderqty").val(wo_def_qty);
	}
	else
	{
		$(this).find("td.wo_selected").html("");
		$(this).css("background-color","");
		$(this).find("input.wo_orderqty").val('');
	}

}

$(document).on('click', '#wo_new_assign',wo_new_assign);
function wo_new_assign()
{
	var equipmentid = $("#wo_select_equipmentid").val();
	$("#wo_bg").show();
	$("#equipment_sparepart_assignment").show();
	
	$.get('wo_equipment_sparepart_assignment.php?equipmentid='+equipmentid, function(data) {
		$("#equipment_sparepart_assignment").html(data);
	});
}

$(document).on('click', '#wo_bg',clear_wo_bg);
function clear_wo_bg()
{
	$("#wo_bg").hide();
	$("#equipment_sparepart_assignment").hide();
	
}


$(document).on('change', '#wo_ch_part',wo_ch_part);
function wo_ch_part()
{
	var sparepartid = $(this).val();
	$.get('wo_ch_part.php?sparepartid='+sparepartid, function(data) {
		$("#wo_ch_part_detail").html(data);
	});
	
}


$(document).on('change', '#wop_partname',wop_search_part);
$(document).on('change', '#wop_maker',wop_search_part);
$(document).on('change', '#wop_barcode',wop_search_part);
$(document).on('change', '#wop_spgroup',wop_search_part);
function wop_search_part()
{
	var equipmentid = $("#equipmentid").val();
	var partname = $("#wop_partname").val();
	var maker = $("#wop_maker").val();
	var barcode = $("#wop_barcode").val();
	var spgroup = $("#wop_spgroup").val();
	$.get('wop_search_part.php?partname='+partname+'&maker='+maker+'&barcode='+barcode+'&spgroup='+spgroup+'&equipmentid='+equipmentid, function(data) {
		$("#wop_search_result").html(data);
	});
	
}

$(document).on('click', '.choose_part',choose_part);
function choose_part()
{
	var sparepartid = $(this).attr("sparepartid");
	var equipmentid = $(this).attr("equipmentid");
	$.get('wo_choose_part.php?equipmentid='+equipmentid+'&sparepartid='+sparepartid, function(data) {
		$("#wo_find_part").hide();
		$("#wo_new_eqpt_part").show();
		$("#wo_new_eqpt_part").html(data);
		
	});
	
}


$(document).on('click', '#wo_eq_add_part',wo_eq_add_part);
function wo_eq_add_part()
{
	
	var sparepartid = $("#tn_sparepartid").html();
	var equipmentid = $("#wop_equipmentid").val();
	var def_qty = $("#tn_def_qty").val();
	//alert("sparepartid "+sparepartid+"equipmentid "+equipmentid);
	$.get('wo_eq_add_part.php?equipmentid='+equipmentid+'&sparepartid='+sparepartid+'&def_qty='+def_qty, function(data) {
	
		$("#equipment_sparepart_assignment").hide(data);
		$("#wo_eq_part_list").append(data);
		
	});
	
}


$(document).on('click', '#wo_save',wo_save);
function wo_save()

{
	var wo_type = $('#wo_select_wo_type').val();
	var remarks = $('#wo_remarks').val();
	var instructions = $('#wo_instructions').val();
	var pv_schedule_recno = $('#wo_select_pv_schedule').val();
	var problem = $('#wo_problem').val();
    var equipmentid = $('#wo_select_equipmentid').val();
	var table_id="wo_eq_part_list";
		var rows = $("#"+table_id+" tr");
		var tableLength = rows.length;
		var a_barcode =[]; var a_orderqty =[]; var a_sparepartid =[]; var a_partnumber =[]; var count=0;
		for(var i=1; i < tableLength;i++)
		{
			
			var w_orderqty = $("#wo_eq_part_list tr " ).eq(i).find("input.wo_orderqty").val();
			var wo_partDesc = $("#wo_eq_part_list tr " ).eq(i).find("td.wo_partDesc").html();
			w_orderqty = parseInt(w_orderqty || 0);
			var nan = isNaN(w_orderqty);
			if (nan == true){
				alert('Input error for part: '+wo_partDesc);
				return;
			}
			if(w_orderqty > 0)
			{
				count++;
				var w_barcode = $("#wo_eq_part_list tr " ).eq(i).find("td.wo_barcode").html();
				var w_sparepartid = $("#wo_eq_part_list tr " ).eq(i).find("td.wo_sparepartid").html();
				var w_partnumber = $("#wo_eq_part_list tr " ).eq(i).find("td.wo_partnumber").html();
				
				a_barcode[count] = w_barcode;
				a_orderqty[count] = w_orderqty;
				a_sparepartid[count] = w_sparepartid;
				a_partnumber[count] = w_partnumber;
			}
		}
		
	
	$.ajax({
        type: "POST",
        url: "wo_generate.php",
        data: {equipmentid:equipmentid,wo_type:wo_type,pv_schedule_recno:pv_schedule_recno,problem:problem,instructions:instructions,remarks:remarks,array_barcode: JSON.stringify(a_barcode),array_orderqty: JSON.stringify(a_orderqty),array_sparepartid: JSON.stringify(a_sparepartid),array_partnumber: JSON.stringify(a_partnumber)},
        success: function(datax) {
        //  alert("data"+datax);
		   var jsonData = JSON.parse(datax);
		   var t1 = jsonData.item1;
		   var resulthtml = "<div style='margin-top:40px;text-align:center;font-size:25px;'> Workorder id "+t1+" was created </div>";
		   resulthtml += "<table style='margin-top:40px;text-align:center;font-size:25px;'>";
		   resulthtml += "<tr><td style='width:320px;'></td><td><button id='wo_create_another' style='width:400px;height:40px;font-size:14px;'>Create another workorder </button></td>";
		   resulthtml += "</tr>";
		   resulthtml += "<tr><td style='height:30px'></td></tr>";
		   resulthtml += "<tr><td style='width:320px;'></td><td><button id='wo_show_active_list' style='width:400px;height:40px;font-size:14px;'>Show Active WO Listing </button></td>";
		   resulthtml += "</tr>";
		   resulthtml += " </table>";
			$("#mm_right_content").html(resulthtml);		
        },
		 error: function(datax) {
          // alert("data"+datax);
		   var jsonData = JSON.parse(datax);
		   var t1 = jsonData.item1;
		    var t2 = jsonData.item2;
			alert("error t2 "+t2);


        }
    });
 


}
	

$(document).on('click', '#wo_create_another',new_workorder);
$(document).on('click', '#wo_show_active_list',mm_my_wo);
$(document).on('click', '#mm_my_wo',mm_my_wo);
function mm_my_wo()
{
	   
		$.get('mm_my_wo_active.php', function(data) {
	
			$("#mm_right_content").html(data);
	});
	
}

$(document).on('click', '#mm_my_wo_active',mm_my_wo_active);
function mm_my_wo_active()
{
	     $(".mm_left_menu").removeClass("mm_pick");
		$(this).addClass("mm_pick");
	    $("#mm_right_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
		$.get('mm_my_wo_active.php', function(data) {
	
			$("#mm_right_content").html(data);
		
	});
	
}

$(document).on('click', '#mm_my_wo_closed',mm_my_wo_closed);
function mm_my_wo_closed()
{
	    $(".mm_left_menu").removeClass("mm_pick");
		$(this).addClass("mm_pick");
		$("#mm_right_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
		$.get('mm_my_wo_closed.php', function(data) {
	
			
			$("#mm_right_content").html(data);
		
	});
	
}

$(document).on('click', '#mm_my_wo_deleted',mm_my_wo_deleted);
function mm_my_wo_deleted()
{
	    $(".mm_left_menu").removeClass("mm_pick");
		$(this).addClass("mm_pick");
		$("#mm_right_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
		$.get('mm_my_wo_deleted.php', function(data) {
			$("#mm_right_content").html(data);
		
		});
	
}

$(document).on('click', '#home',home);
function home()
{
	location.href = 'index.php';
	
}

$(document).on('click', '#changeList',changeList);
function changeList()
{
	var program = $(this).attr("program"); 
	$("#mm_right_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
		$.get(program, function(data) {
			$("#mm_right_content").html(data);
		
		});
}

$(document).on('click', '#changeList_pp',changeList_pp);
function changeList_pp()
{
	var program = $(this).attr("program"); 
	$("#right_content_sub").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
		$.get(program, function(data) {
			$("#right_content_sub").html(data);
		
		});
}
/*
$(document).on('click', '#mm_oth_wo',mm_oth_wo);
function mm_oth_wo()
{
		$.get('mm_oth_wo.php', function(data) {
	
		
			$("#main_content").html(data);
		
	});
	
}
*/
$(document).on('click', '#mm_oth_wo_active',mm_oth_wo_active);
function mm_oth_wo_active()
{
	     $(".mm_left_menu").removeClass("mm_pick");
		$(this).addClass("mm_pick");
	    $("#mm_right_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
		$.get('mm_oth_wo_active.php', function(data) {
	
			$("#mm_right_content").html(data);
		
	});
	
}

$(document).on('click', '#mm_oth_wo_closed',mm_oth_wo_closed);
function mm_oth_wo_closed()
{
	    $(".mm_left_menu").removeClass("mm_pick");
		$(this).addClass("mm_pick");
		$("#mm_right_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
		$.get('mm_oth_wo_closed.php', function(data) {
	
			
			$("#mm_right_content").html(data);
		
	});
	
}

$(document).on('click', '#mm_oth_wo_deleted',mm_oth_wo_deleted);
function mm_oth_wo_deleted()
{
	    $(".mm_left_menu").removeClass("mm_pick");
		$(this).addClass("mm_pick");
		$("#mm_right_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
		$.get('mm_oth_wo_deleted.php', function(data) {
	
			
			$("#mm_right_content").html(data);
		
	});
	
}

/*
$(document).on('click', '#mm_eq_hist',mm_eq_hist);
function mm_eq_hist()
{
		$.get('mm_eq_hist.php', function(data) {
	
		
			$("#main_content").html(data);
		
	});
	
}
*/

$(document).on('click', '.eqh_menu',eq_hist_main);
function eq_hist_main()
{
	     var linecode = $(this).attr("linecode");
		  $(".eqh_menu").removeClass("eqh_pick");
			$(this).addClass("eqh_pick");
		$.get('eqh_main.php?linecode='+linecode, function(data) 
		{
			$("#eqh_right_content").html(data);
		});
	
}


$(document).on('click', '.box_eqh',eqh_wo_list);
function eqh_wo_list()
{
	$(".box_eqh").removeClass("box_eqh_pick");
	$(this).addClass("box_eqh_pick");
	var equipmentid = $(this).attr("equipmentid");
	$.get('eqh_wo_list.php?equipmentid='+equipmentid, function(data) 
		{
			$("#eqh_content").html(data);
		});
	
}


$(document).on('click', '.eqd_year_select',eqd_year_select);
function eqd_year_select()
{
	$(".eqd_year_select").removeClass("eqd_year_select_pick");
	$(this).addClass("eqd_year_select_pick");
	var year_select = $(this).html();
	var equipmentid = $(this).attr("equipmentid");
	var tab_id = $('.eqd_tabmenu_selected').attr("id");
	$.get('eqd_show_records.php?year_select='+year_select+'&equipmentid='+equipmentid+'&tab_id='+tab_id, function(data) 
		{
			$("#eqd_show").html(data);
		});
	
}


$(document).on('click', '.eqd_tabmenu',eqd_show_records_1);
function eqd_show_records_1()
{
	$(".eqd_tabmenu").removeClass("eqd_tabmenu_selected");
	$(this).addClass("eqd_tabmenu_selected");
	var tab_id = $(this).attr("id");
	var year_select = $('.eqd_year_select_pick').html();
	var equipmentid = $(this).attr("equipmentid");
	
	$.get('eqd_show_records.php?year_select='+year_select+'&equipmentid='+equipmentid+'&tab_id='+tab_id, function(data) 
		{
			$("#eqd_show").html(data);
		});
	
}

//closed wo popup
$(document).on('click', '#wo_popup_wo',wo_popup_wo);
function wo_popup_wo(x)
{
	
	var workorderid = $(this).attr('workorderid');

	$("#wo_popup_bg").show();
	$("#wo_popup_content").show();
	$.get('popup_wo_data.php?workorderid='+workorderid, function(data) 
		{
			$("#wo_popup_content").html(data);
		});
}

// Clear popup
$(document).on('click', '#pp_wo_cancel',wo_popup_clear);
$(document).on('click', '#wo_popup_bg',wo_popup_clear);
function wo_popup_clear()
{
	$("#wo_popup_bg").hide();
	$("#wo_popup_content").hide();
	$("#wo_popup_content").empty();
}

$(document).on('click', '#wo_change_cancel',wo_change_popup_clear);
function wo_change_popup_clear()
{
	$("#wo_change_popup_bg").hide();
	$("#wo_change_popup_content").hide();
	$("#wo_change_popup_content").empty();
}

$(document).on('click', '#toggle_wo_status',toggle_wo_status);
function toggle_wo_status()
{
	var wo_status = $("#pp_wo_status").html();
	if(wo_status == 'OPEN') $("#pp_wo_status").html("CLOSED");
	if(wo_status == 'CLOSED') $("#pp_wo_status").html("OPEN");
}

$(document).on('click', '#pp_wo_save',pp_wo_save);
function pp_wo_save()
{
	var workorderid = $(this).attr("workorderid");
	var remarks = $("#pp_wo_remarks").val();
	var instructions = $("#pp_wo_instructions").val();
	var wo_status = $("#pp_wo_status").html();
	if(wo_status == 'CLOSED') { wo_status2 = 'X'; } else {  wo_status2 = ''; }
	//alert("remarks "+remarks);
	$.ajax({
        type: "POST",
        url: "pp_wo_save.php",
        data: {workorderid:workorderid,remarks:remarks,instructions:instructions,wo_status2:wo_status2},
        success: function(datax) {
          // alert("data"+datax);
		   var jsonData = JSON.parse(datax);
		   var t1 = jsonData.item1;
		    var t2 = jsonData.item2;
			wo_popup_clear();
			$("#mm_right_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
			$.get('mm_my_wo_active.php', function(data) {
			
					$("#mm_right_content").html(data);
				
			});

        },
		 error: function(datax) {
          // alert("data"+datax);
		   var jsonData = JSON.parse(datax);
		   var t1 = jsonData.item1;
		    var t2 = jsonData.item2;
			alert("error t2 "+t2);


        }
    });
}

$(document).on('click', '.popup_wo_tabmenu',popup_wo_tabmenu);
function popup_wo_tabmenu()
{
	
	$(".popup_wo_tabmenu").removeClass("popup_wo_tabmenu_selected");
	$(this).addClass("popup_wo_tabmenu_selected");
	var tabmenu = $(this).attr("id");
	var workorderid = $("#pp_workorderid").val();
	var equipmentid = $("#pp_equipmentid").val();
	
	if(tabmenu == 'pp_wo_tab1') 
	{
		$.get('popup_wo_main.php?workorderid='+workorderid+'&equipmentid='+equipmentid, function(data) 
		{
			$("#pp_wo_content").html(data);
		});
	}
	
	if(tabmenu == 'pp_wo_tab2') 
	{
		$.get('popup_wo_part_order.php?workorderid='+workorderid+'&equipmentid='+equipmentid, function(data) 
		{
			$("#pp_wo_content").html(data);
		});
	}
	
	if(tabmenu == 'pp_wo_tab3') 
	{
		$.get('popup_wo_part_issued.php?workorderid='+workorderid+'&equipmentid='+equipmentid, function(data) 
		{
			$("#pp_wo_content").html(data);
		});
	}
}


$(document).on('click', '#popup_wo_add_part',popup_wo_add_part);
function popup_wo_add_part()
{
	

	var equipmentid = $("#wo_select_equipmentid").val();
	$("#popup_wo_part_search_bg").show();
	$("#popup_wo_part_search").show();
	
	$.get('popup_wo_search_part.php?equipmentid='+equipmentid, function(data) {
		$("#popup_wo_part_search").html(data);
	});
}

$(document).on('click', '#popup_wo_update',popup_wo_update);
function popup_wo_update()

{

    var equipmentid = $(this).attr("equipmentid");
	var workorderid = $(this).attr("workorderid");
	var table_id="wo_eq_part_list";
		var rows = $("#"+table_id+" tr");
		var mylength = rows.length;
		var a_barcode =[]; var a_orderqty =[]; var a_sparepartid =[]; var a_partnumber =[]; var count=0;
		for(var i=1; i < mylength;i++)
		{
			
			var w_orderqty = $("#wo_eq_part_list tr " ).eq(i).find("input.wo_orderqty").val();
			w_orderqty = parseInt(w_orderqty || 0);
		   // alert("loop "+i +" orderqty "+w_orderqty);
			if(w_orderqty > 0 )
			{
				
				count++;
				var w_barcode = $("#wo_eq_part_list tr " ).eq(i).find("td.wo_barcode").html();
				var w_sparepartid = $("#wo_eq_part_list tr " ).eq(i).find("td.wo_sparepartid").html();
				var w_partnumber = $("#wo_eq_part_list tr " ).eq(i).find("td.wo_partnumber").html();
				
				a_barcode[count] = w_barcode;
				a_orderqty[count] = w_orderqty;
				a_sparepartid[count] = w_sparepartid;
				a_partnumber[count] = w_partnumber;
				//alert("sparepartid "+w_sparepartid);
			}
		}
		
	
	$.ajax({
        type: "POST",
        url: "popup_wo_update.php",
        data: {equipmentid:equipmentid,workorderid:workorderid,array_barcode: JSON.stringify(a_barcode),array_orderqty: JSON.stringify(a_orderqty),array_sparepartid: JSON.stringify(a_sparepartid),array_partnumber: JSON.stringify(a_partnumber)},
        success: function(datax) {
        //  alert("data"+datax);
		   var jsonData = JSON.parse(datax);
		   var t1 = jsonData.item1;
		   var resulthtml = "<div style='margin-top:40px;text-align:center;font-size:25px;'> Part Items in Workorder id "+workorderid+" was updated</div>";
		  
		   
		
			$("#pp_wo_content").html(resulthtml);
					
				
        }
    });

	
}

/*
$(document).on('click', '#sk_store_trans',sk_store_trans);
function sk_store_trans()
{
	   
		$.get('sk_store_trans.php', function(data) {
	
		
			$("#main_content").html(data);
		
	});
	
}
*/
$(document).on('click', '#sk_reselect',sk_open_wo);
$(document).on('click', '#sk_open_wo',sk_open_wo);
function sk_open_wo()
{
	    $('.mm_left_menu').removeClass("mm_pick");
	    $(this).addClass("mm_pick");
	   $("#mm_right_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
		$.get('sk_open_wo.php', function(data) {
	
		
			$("#mm_right_content").html(data);
		
	});
	
}

$(document).on('click', '#sk_show_closed_wo',sk_closed_wo);
$(document).on('click', '#sk_closed_wo',sk_closed_wo);
function sk_closed_wo()
{
	   $('.mm_left_menu').removeClass("mm_pick");
	    $(this).addClass("mm_pick");
	   $("#mm_right_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
		$.get('sk_closed_wo.php', function(data){
			$("#mm_right_content").html(data);
	});
	
}

$(document).on('click', '#pick_wo_closed',sk_show_closed_wo_details);
function sk_show_closed_wo_details() 
{
	var workorderid = $(this).attr('workorderid');
	$("#show_closed_wo").hide();
	$("#changeList").hide();
	$("#wo_show_list").hide();
	$.get('sk_show_closed_wo_details.php?workorderid='+workorderid, function(data){
		$("#show_closed_wo_details").html(data);
	});
}

$(document).on('click', '#reopen_workorder',reopen_workorder);
function reopen_workorder() 
{
	var check = confirm("Are you sure to reopen this workorder.");
	if (check == true)
	{
	var workorderid = $(this).attr("workorderid");
	$.get('sk_reopen_workorder.php?workorderid='+workorderid, function(data) {
		
		   
			if(data != '') alert(data);
		
			sk_closed_wo();
		});
	}
}


$(document).on('click', '.sk_wo_year',sk_wo_year);
function sk_wo_year() 
{
		
	    $(".sk_wo_year").removeClass("sk_wo_year_select");
		$(this).addClass("sk_wo_year_select");
		var pick_year = $(".sk_wo_year_select").html();
		var program = $(this).attr('program');
		$.get(program+'?pick_year='+pick_year, function(data) {
	
			$("#show_outstanding").html(data);
		})
	
}


$(document).on('click', '#sk_iss_docs',sk_iss_docs);
function sk_iss_docs()
{
	   $('.mm_left_menu').removeClass("mm_pick");
	    $(this).addClass("mm_pick");
	   $("#mm_right_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
		$.get('sk_iss_docs.php', function(data) {
			$("#mm_right_content").html(data);
		
	});
	
}

$(document).on('click', '.sk_iss_year',sk_iss_year);
function sk_iss_year() 
{
		
    $(".sk_iss_year").removeClass("sk_iss_year_select");
	$(this).addClass("sk_iss_year_select");
	var pick_year = $(".sk_iss_year_select").html();
	$.get('sk_iss_docs_year.php?pick_year='+pick_year, function(data) {

		$("#show_iss_docs_year").html(data);
	})

}

$(document).on('click', '.sk_iss_yearx',sk_iss_yearx);
function sk_iss_yearx() 
{
		
    $(".sk_iss_yearx").removeClass("sk_iss_year_selectx");
	$(this).addClass("sk_iss_year_selectx");
	var pick_year = $(".sk_iss_year_selectx").html();
	$.get('sk_iss_return_year.php?pick_year='+pick_year, function(data) {
		$("#show_iss_docs_year").html(data);
	})
	
}

$(document).on('click', '#pick_iss_docs',sk_show_iss_docs_details);
function sk_show_iss_docs_details() 
{

	var docno = $(this).attr('docno');
	$("#changeList").hide();
	$("#show_iss_docs").hide();
	$.get('sk_show_iss_docs_details.php?docno='+docno, function(data) {
		$("#show_iss_docs_details").html(data);
	});
}

$(document).on('click', '#pick_iss_docsx',sk_show_iss_docs_return);
function sk_show_iss_docs_return() 
{

	var docno = $(this).attr('docno');
	$("#show_iss_docs").hide();
	$.get('sk_show_iss_docs_return.php?docno='+docno, function(data) {
			$("#show_iss_docs_details").html(data);
		});
}
/*
$(document).on('click', '#pm_main',pm_main);
function pm_main()
{
	   
		$.get('pm_main.php', function(data) {
	
		
			$("#main_content").html(data);
		
	});
	
}

*/
$(document).on('click', '#pm_get_part',pm_get_part);
function pm_get_part() 
{
	
    $('#pm_box_get_part_bg').show();
	$('#pm_box_get_part').show();
	 $.get('pm_get_part.php', function(data) {
		$("#pm_box_get_part").html(data);
	});
	
	
}

$(document).on('change', '#pm_s_partname',pm_search_part);
$(document).on('change', '#pm_s_maker',pm_search_part);
$(document).on('change', '#pm_s_barcode',pm_search_part);
$(document).on('change', '#pm_s_spgroup',pm_search_part);
function pm_search_part()
{
	var equipmentid = $("#equipmentid").val();
	var partname = $("#pm_s_partname").val();
	var maker = $("#pm_s_maker").val();
	var barcode = $("#pm_s_barcode").val();
	var spgroup = $("#pm_s_spgroup").val();
	$("#pm_s_barcode").focus();
	 $("#pm_search_result").html("<img  style='margin-top:50px;margin-left:50px;'  src='images/loading.gif'/> Searching in Progress Please wait");
	$.get('pm_search_part.php?partname='+partname+'&maker='+maker+'&barcode='+barcode+'&spgroup='+spgroup+'&equipmentid='+equipmentid, function(data) {
		$("#pm_search_result").html(data);
	});
	
}

$(document).on('click', '#pm_box_get_part_bg',pm_clear_get_part);
function pm_clear_get_part() 
{
	$('#pm_box_get_part_bg').hide();
	$('#pm_box_get_part').hide();
	
}

$(document).on('click', '.pm_choose_part',pm_choose_part);
function pm_choose_part()
{
	//var sparepartid = $(this).attr("sparepartid");
	
	var startdate = $("#pm_s_date_from").val();
	var enddate = $("#pm_s_date_to").val();
	var barcode = $(this).attr("barcode");
	//alert("barcode"+barcode);
	var sparepartid = $(this).attr("sparepartid");
    //$("#pm_s_barcode").val(barcode);
	 $("#pm_s_sparepartid").val(sparepartid);
	$('#pm_box_get_part_bg').hide();
	$('#pm_box_get_part').hide();
	$("#pm_s_barcode").focus();
     $("#pm_show_parts_trans").html("<img  style='margin-top:50px;margin-left:50px;'  src='images/loading.gif'/> Searching in Progress Please wait");
	$.get('pm_show_parts_trans.php?sparepartid='+sparepartid+'&startdate='+startdate+'&enddate='+enddate, function(data) {
		
		//alert("data"+data);
		$("#pm_show_parts_trans").html(data);
	});
	
}
$(document).on('change', '#pm_s_date_from',pm_show_result);
$(document).on('change', '#pm_s_date_to',pm_show_result);
$(document).on('change', '#pm_s_barcode',pm_show_result);
function pm_show_result()
{
	var barcode = $("#pm_s_barcode").val();
	var sparepartid =  $("#pm_s_sparepartid").val();
	var startdate = $("#pm_s_date_from").val();
	var enddate = $("#pm_s_date_to").val();
	 $("#pm_show_parts_trans").html("<img  style='margin-top:50px;margin-left:50px;'  src='images/loading.gif'/> Searching in Progress Please wait");
	$.get('pm_show_parts_trans.php?sparepartid='+sparepartid+'&barcode='+barcode+'&startdate='+startdate+'&enddate='+enddate, function(data) {
		
		
		$("#pm_show_parts_trans").html(data);
		$("#pm_s_barcode").val("");
		
	});
}


$(document).on('click', '#pm_parts_enquiry',pm_parts_enquiry);
function pm_parts_enquiry()
{
	     $(".mm_left_menu").removeClass("mm_pick");
		$(this).addClass("mm_pick");
	   $("#mm_right_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
	
	    
		$.get('pm_parts_enquiry.php', function(data) {
	
			$("#mm_right_content").html(data);
			$("#pm_s_barcode").focus();
		
	});
	
}

$(document).on('click', '#pm_parts_master',pm_parts_master);
function pm_parts_master()
{
	$(".mm_left_menu").removeClass("mm_pick");
	$(this).addClass("mm_pick");
	$("#mm_right_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
	 $.get('pm_parts_master.php', function(data) {
	
			$("#mm_right_content").html(data);
		
		
	});
	
}

$(document).on('click', '#pm_parts_master_all',pm_parts_master_all);
function pm_parts_master_all()
{
	$(".mm_left_menu").removeClass("mm_pick");
	$(this).addClass("mm_pick");
	$("#mm_right_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
	 $.get('pm_masterdata.php', function(data) {
	
			$("#mm_right_content").html(data);
		
		
	});
	
}

$(document).on('change', '#pm_s_m_partname',pm_search_partmaster);
$(document).on('change', '#pm_s_m_sparepartid',pm_search_partmaster);
$(document).on('change', '#pm_s_m_maker',pm_search_partmaster);
$(document).on('change', '#pm_s_m_barcode',pm_search_partmaster);
$(document).on('change', '#pm_s_m_spgroup',pm_search_partmaster);
function pm_search_partmaster()
{
	var equipmentid = $("#equipmentid").val();
	var partname = $("#pm_s_m_partname").val();
	var maker = $("#pm_s_m_maker").val();
	var sparepartid = $("#pm_s_m_sparepartid").val();
	var barcode = $("#pm_s_m_barcode").val();
	var spgroup = $("#pm_s_m_spgroup").val();
 	$("#pm_search_result_master").show();

	$("#pm_search_result_master").html("<img  style='margin-top:50px;margin-left:50px;'  src='images/loading.gif'/> Searching in Progress Please wait");
	$.get('pm_search_parts_master.php?partname='+partname+'&maker='+maker+'&sparepartid='+sparepartid+'&barcode='+barcode+'&spgroup='+spgroup+'&equipmentid='+equipmentid, function(data) {
		$("#pm_search_result_master").html(data);
	});
	
	$("#pm_search_result_masterall").html("<img  style='margin-top:50px;margin-left:50px;'  src='images/loading.gif'/> Searching 2 in Progress Please wait");
	$.get('pm_search_parts_masterall.php?partname='+partname+'&maker='+maker+'&sparepartid='+sparepartid+'&barcode='+barcode+'&spgroup='+spgroup+'&equipmentid='+equipmentid, function(data) {
		$("#pm_search_result_masterall").html(data);
	});
	
}

$(document).on('change', '#pm_s_m_machineName',pm_search_machinemaster);
$(document).on('change', '#pm_s_m_machineId',pm_search_machinemaster);
$(document).on('change', '#pm_s_m_machineMaker',pm_search_machinemaster);
$(document).on('change', '#pm_s_m_lineCode',pm_search_machinemaster);
$(document).on('change', '#pm_s_m_serialno',pm_search_machinemaster);
function pm_search_machinemaster()
{
	var machineName = $("#pm_s_m_machineName").val();
	var machineId = $("#pm_s_m_machineId").val();
	var machineMaker = $("#pm_s_m_machineMaker").val();
	var lineCode = $("#pm_s_m_lineCode").val();
	var serialno = $("#pm_s_m_serialno").val();
 	$("#pm_search_result_machine").show();

	$("#pm_search_result_machine").html("<img  style='margin-top:50px;margin-left:50px;'  src='images/loading.gif'/> Searching in Progress Please wait");
	$.get('pm_search_machine_master.php?machineName='+machineName+'&machineId='+machineId+'&machineMaker='+machineMaker+'&lineCode='+lineCode+'&serialno='+serialno, function(data) {
		$("#pm_search_result_machine").html(data);
	});
	
	
}



$(document).on('click', '#pm_choose_parts_master',pm_choose_parts_master);
function pm_choose_parts_master()
{
	 var sparepartid = $(this).attr("sparepartid");
     $("#parts_master_show").html("<img  style='margin-top:50px;margin-left:50px;'  src='images/loading.gif'/> Searching in Progress Please wait");
	 $.get('pm_main_upd_part.php?sparepartid='+sparepartid, function(data) {
		
		//alert("data"+data);
		$("#parts_master_show").html(data);
	});
	
}

$(document).on('click', '#pm_choose_machine_master',pm_choose_machine_master);
function pm_choose_machine_master()
{
	 var equipmentid = $(this).attr("equipmentid");
     $("#parts_master_show").html("<img  style='margin-top:50px;margin-left:50px;' src='images/loading.gif'/> Searching in Progress Please wait");
	 $.get('pm_main_upd_machine.php?equipmentid='+equipmentid, function(data){	
		//alert("data"+data);
		$("#parts_master_show").html(data);
	});
	
}

$(document).on('change', '#sc_s_m_partname',sc_search_partmaster);
$(document).on('change', '#sc_s_m_sparepartid',sc_search_partmaster);
$(document).on('change', '#sc_s_m_maker',sc_search_partmaster);
$(document).on('change', '#sc_s_m_barcode',sc_search_partmaster);
$(document).on('change', '#sc_s_m_spgroup',sc_search_partmaster);
function sc_search_partmaster()
{
	//alert('test');
	//var equipmentid = $("#equipmentid").val();
	var startdate = $("#sc_s_date_from").val();
	var enddate = $("#sc_s_date_to").val();
	var partname = $("#sc_s_m_partname").val();
	var maker = $("#sc_s_m_maker").val();
	var sparepartid = $("#sc_s_m_sparepartid").val();
	var barcode = $("#sc_s_m_barcode").val();
	var spgroup = $("#sc_s_m_spgroup").val();
 	
	$("#sc_search_result_master").html("<img  style='margin-top:50px;margin-left:50px;'  src='images/loading.gif'/> Searching in Progress Please wait");
	$.get('sc_search_parts_master.php?partname='+partname+'&maker='+maker+'&sparepartid='+sparepartid+'&barcode='+barcode+'&spgroup='+spgroup+'&startdate='+startdate+'&enddate='+enddate, function(data) {
		$("#sc_search_result_master").html(data);
	});
	
	$("#sc_search_result_masterall").html("<img  style='margin-top:50px;margin-left:50px;'  src='images/loading.gif'/> Searching 2 in Progress Please wait");
	$.get('pm_search_parts_masterall.php?partname='+partname+'&maker='+maker+'&sparepartid='+sparepartid+'&barcode='+barcode+'&spgroup='+spgroup+'&equipmentid='+equipmentid+'&startdate='+startdate+'&enddate='+enddate, function(data) {
		$("#pm_search_result_masterall").html(data);
	});	
}

$(document).on('click', '#sc_choose_parts_master',sc_choose_parts_master);
function sc_choose_parts_master()
{
	 var sparepartid = $(this).attr("sparepartid");
	 var barcode = $(this).attr("barcode");
	 var description = $(this).attr("description");
	 var startdate = $("#sc_s_date_from").val();
	 var enddate = $("#sc_s_date_to").val();
	 var program = $(this).attr("program");
	 programloc = program+'?sparepartid='+sparepartid+'&description='+description+'&barcode='+barcode+'&startdate='+startdate+'&enddate='+enddate;
     window.open(programloc, "_blank", "toolbar=no,scrollbars=yes,location=no,menubar=no,resizable=yes,top=50,left=50,width=1200,height=500");
     /*$("#parts_master_show").html("<img  style='margin-top:50px;margin-left:50px;'  src='images/loading.gif'/> Searching in Progress Please wait");
	 $.get('stock_card.php?sparepartid='+sparepartid, function(data) {
		
		//alert("data"+data);
		$("#parts_master_show").html(data);
	 });*/
}

$(document).on('change', '#pb_partname',pb_search_partmaster);
$(document).on('change', '#pb_sparepartid',pb_search_partmaster);
$(document).on('change', '#pb_maker',pb_search_partmaster);
$(document).on('change', '#pb_barcode',pb_search_partmaster);
$(document).on('change', '#pb_spgroup',pb_search_partmaster);
function pb_search_partmaster()
{
	//alert('test');
	var startdate = $("#rep_s_date_from").val();
	var enddate = $("#rep_s_date_to").val();
	var partname = $("#pb_partname").val();
	var maker = $("#pb_maker").val();
	var sparepartid = $("#pb_sparepartid").val();
	var barcode = $("#pb_barcode").val();
	var spgroup = $("#pb_spgroup").val();
 
	$("#search_result_master").html("<img  style='margin-top:50px;margin-left:50px;'  src='images/loading.gif'/> Searching in Progress Please wait");
	$.get('pb_search_parts_master.php?partname='+partname+'&maker='+maker+'&sparepartid='+sparepartid+'&barcode='+barcode+'&spgroup='+spgroup+'&startdate='+startdate+'&enddate='+enddate, function(data) {
		$("#search_result_master").html(data);
	});
	
}

$(document).on('click', '.pb_choose_parts_master',pb_choose_parts_master);
function pb_choose_parts_master()
{
	 var sparepartid = $(this).attr("sparepartid");
	 var barcode = $(this).attr("barcode");
	 var description = $(this).attr("description");
	 var startdate = $("#rep_s_date_from").val();
	 var enddate = $("#rep_s_date_to").val();
	 var program = $(this).attr("program");
	 $("#search_result_master").html("<img  style='margin-top:50px;margin-left:50px;'  src='images/loading.gif'/> Searching in Progress Please wait");
	 programloc = program+'?sparepartid='+sparepartid+'&description='+description+'&barcode='+barcode+'&startdate='+startdate+'&enddate='+enddate;
     window.open(programloc, "_blank", "toolbar=no,scrollbars=yes,location=no,menubar=no,resizable=yes,top=50,left=50,width=1200,height=500");
}


$(document).on('click', '.pm_m2_menu',pm_m2_menu);
function pm_m2_menu()
{
	var sparepartid = $("#sparepartid").val();
	$(".pm_m2_menu").removeClass("pm_m2_menu_pick");
	$(this).addClass("pm_m2_menu_pick");
	var program = $(this).attr("program")+"?sparepartid="+sparepartid;
	//alert("run program"+program);
	$.get(program, function(data) {
  //  $('#right_sub_content').show();
	 $('#right_content_sub').html(data);
	});
}	

$(document).on('click', '.pm_m2_menu2',pm_m2_menu2);
function pm_m2_menu2()
{
	var equipmentid = $("#equipmentid").val();
	$(".pm_m2_menu2").removeClass("pm_m2_menu2_pick");
	$(this).addClass("pm_m2_menu2_pick");
	var program = $(this).attr("program")+"?equipmentid="+equipmentid;
	//alert("run program"+program);
	$.get(program, function(data) {
  //  $('#right_sub_content').show();
	 $('#right_content_sub').html(data);
	});
}

$(document).on('click', '.pm_m3_menu',pm_m3_menu);
function pm_m3_menu()
{
	$(".pm_m3_menu").removeClass("pm_m3_menu_pick");
	$(this).addClass("pm_m3_menu_pick");
	var program = $(this).attr("program")
	//alert("run program"+program);
	$.get(program, function(data) {
  //  $('#right_sub_content').show();
	 $('#right_content_sub').html(data);
	});
}	


$(document).on('click', '#part_change_location_save',part_change_location_save);
function part_change_location_save()
{
	jQuery.ajaxSetup({async:false});
		var sparepartid = $(this).attr("sparepartid");
		var table_id="pm_location";
		var rows = $("#"+table_id+" tr");
		var mylength = rows.length;
	
       // alert("sparepartid "+sparepartid);
		$.get('pm_sp_location_delete.php?sparepartid='+sparepartid, function(data) {
			
			//alert("delete data"+data);
			});	
		
		for(var i=0; i < mylength;i++)
		{
			
	
			pm_location = $("#pm_location tr " ).eq(i).find("input.locationcode").val();
			
			if( pm_location =='') continue;
			if(typeof(pm_location)  === "undefined") continue;

	
			//alert("pm_location "+pm_location);
			$.get('pm_sp_location_save.php?sparepartid='+sparepartid+'&pm_location='+pm_location					  
				, function(data) {
		
			});	
				
		}
		alert("Successfully Updated");
}
/*
$(document).on('click', '#pp_main',pp_main);
function pp_main()
{
	   
		$.get('pp_main.php', function(data) {
	
		
			$("#main_content").html(data);
		
	});
	
}

*/
$(document).on('click', '#pp_m1_1_search',pp_m1_search);
function pp_m1_search()
{
	var s_year = $("#pp_m1_s_year").val();
	var s_docno = $("#pp_m1_s_docno").val();
	var s_supplierid = $("#pp_m1_s_supplierid").val();
	$.get('pp_m2_1_search.php?s_year='+s_year+'&s_docno='+s_docno+'&s_supplierid='+s_supplierid, function(data) {
		$("#pp_m2_1_result").html(data);
		
	});
	
}


$(document).on('click', '#pp_m1_reselect',pp_m1_reselect);
function pp_m1_reselect()
{
	
	var program = 'pp_m1_1.php';
	$.get(program, function(data) {
	
    $('#right_content_sub').html(data);
	});
	
}


$(document).on('click', '.pp_m1_1_change',pp_m1_change);
function pp_m1_change()
{
	$(".pp_m1_1_change").removeClass("pp_m1_1_change_pick");
	$(this).addClass("pp_m1_1_change_pick");
	var docno = $(this).attr("docno");
	var program = 'pp_m1_1_change.php?docno='+docno;
	$.get(program, function(data) {
	
    $("#right_content_sub").html(data);
	pp_get_supplier_data();
	});
	
}


$(document).on('click', '.pp_m1_menu',pp_m1_menu);
function pp_m1_menu()
{
	//var sparepartid = $("#sparepartid").val();
	$(".pp_m1_menu").removeClass("pp_m1_menu_pick");
	$(this).addClass("pp_m1_menu_pick");
	var program = $(this).attr("program");
	//alert("run program"+program);
	$.get(program, function(data) {
  //  $('#right_sub_content').show();
	 $('#right_content_sub').html(data);
	});
}	


$(document).on('click', '#pp_m1_s_supplier',pp_m1_s_supplier);
function pp_m1_s_supplier() 
{
	
    $('#pp_box_s_supplier_bg').show();
	$('#pp_box_s_supplier').show();
	 $.get('pp_m1_s_supplier.php', function(data) {
		$("#pp_box_s_supplier").html(data);
	});
}

$(document).on('click', '#pp_m2_1_search',pp_m2_search);
function pp_m2_search()
{
	   var s_year = $("#pp_m2_s_year").val();
	    var s_docno = $("#pp_m2_s_docno").val();
		var s_supplierid = $("#pp_m2_s_supplierid").val();
		$.get('pp_m2_1_search.php?s_year='+s_year+'&s_docno='+s_docno+'&s_supplierid='+s_supplierid, function(data) {
	
		
			$("#right_content_sub").html(data);
		
	});
	
}


$(document).on('click', '#pp_m2_reselect',pp_m2_reselect);
function pp_m2_reselect()
{
	
	var program = 'pp_m2_1.php';
	$.get(program, function(data) {
	
    $('#right_content_sub').html(data);
	});
	
}


$(document).on('click', '.pp_m2_1_change',pp_m2_change);
function pp_m2_change()
{
	$(".pp_m2_1_change").removeClass("pp_m2_1_change_pick");
	$(this).addClass("pp_m2_1_change_pick");
	var docno = $(this).attr("docno");
	var program = 'pp_m2_1_change.php?docno='+docno;
	$.get(program, function(data) {
	
    $("#right_content_sub").html(data);
	pp_get_supplier_data();
	});
	
}


$(document).on('click', '.pp_m2_menu',pp_m2_menu);
function pp_m2_menu()
{
	//var sparepartid = $("#sparepartid").val();
	$(".pp_m2_menu").removeClass("pp_m2_menu_pick");
	$(this).addClass("pp_m2_menu_pick");
	var program = $(this).attr("program");
	//alert("run program"+program);
	$.get(program, function(data) {
	 $('#right_content_sub').html(data);
	});
}	


$(document).on('click', '#pp_m2_s_supplier',pp_m2_s_supplier);
function pp_m2_s_supplier() 
{
	
    $('#pp_box_s_supplier_bg').show();
	$('#pp_box_s_supplier').show();
	 $.get('pp_m2_s_supplier.php', function(data) {
		$("#pp_box_s_supplier").html(data);
	});
}

$(document).on('click', '#pp_m3_1_search',pp_m3_search);
function pp_m3_search()
{
	   var s_year = $("#pp_m3_s_year").val();
	    var s_docno = $("#pp_m3_s_docno").val();
		var s_supplierid = $("#pp_m3_s_supplierid").val();
		$.get('pp_m3_1_search.php?s_year='+s_year+'&s_docno='+s_docno+'&s_supplierid='+s_supplierid, function(data) {
	
		
			$("#right_content_sub").html(data);
		
	});
	
}


$(document).on('click', '#pp_m3_reselect',pp_m3_reselect);
function pp_m3_reselect()
{
	
	var program = 'pp_m3_1.php';
	$.get(program, function(data) {
	
    $('#right_content_sub').html(data);
	});
	
}


$(document).on('click', '.pp_m3_1_change',pp_m3_change);
function pp_m3_change()
{
	$(".pp_m3_1_change").removeClass("pp_m3_1_change_pick");
	$(this).addClass("pp_m3_1_change_pick");
	var docno = $(this).attr("docno");
	var program = 'pp_m3_1_change.php?docno='+docno;
	$.get(program, function(data) {
	
    $("#right_content_sub").html(data);
	pp_get_supplier_data();
	});
	
}


$(document).on('click', '.pp_m3_menu',pp_m3_menu);
function pp_m3_menu()
{
	//var sparepartid = $("#sparepartid").val();
	$(".pp_m3_menu").removeClass("pp_m3_menu_pick");
	$(this).addClass("pp_m3_menu_pick");
	var program = $(this).attr("program");
	//alert("run program"+program);
	$.get(program, function(data) {
  //  $('#right_sub_content').show();
	 $('#right_content_sub').html(data);
	});
}	


$(document).on('click', '#pp_m3_s_supplier',pp_m3_s_supplier);
function pp_m3_s_supplier() 
{
	
    $('#pp_box_s_supplier_bg').show();
	$('#pp_box_s_supplier').show();
	 $.get('pp_m3_s_supplier.php', function(data) {
		$("#pp_box_s_supplier").html(data);
	});
}

$(document).on('click', '#pp_box_s_supplier_bg',pp_box_s_supplier_bg);
function pp_box_s_supplier_bg() 
{
	$('#pp_box_s_supplier_bg').hide();
	$('#pp_box_s_supplier').hide();
	
}


$(document).on('change', '#pp_s_suppliername',pp_search_supplier);
$(document).on('change', '#pp_s_country',pp_search_supplier);
//$(document).on('change', '#pp_s_supplierid',pp_search_supplier);
$(document).on('change', '#pp_s_supid',pp_search_supplier);
//$(document).on('change', '#pm_s_m_spgroup',pm_search_partmaster);
function pp_search_supplier()
{
	//var supplierid = $("#pp_s_supplierid").val();
	var supid = $("#pp_s_supid").val();
	var suppliername = $("#pp_s_suppliername").val();
	var country = $("#pp_s_country").val();
	//alert("id "+supid);
	 $("#pp_search_result").html("<img  style='margin-top:50px;margin-left:50px;'  src='images/loading.gif'/> Searching in Progress Please wait");
	$.get('pp_search_supplier.php?supplierid='+supid+'&suppliername='+suppliername+'&country='+country, function(data) {
		$("#pp_search_result").html(data);
	});
	
}
$(document).on('click', '.pp_m1_2_c_supplier',pp_get_supplier_data2);
//$(document).on('change', '#pm_s_m_spgroup',pm_search_partmaster);

function pp_test()
{
	alert("testtttttt");
	
}


$(document).on('change', '#pp_m1_2_supplierid',pp_get_supplier_data);
//$(document).on('change', '#pm_s_m_spgroup',pm_search_partmaster);
function pp_get_supplier_data()
{
	
	 var supplierid = $("#pp_m1_2_supplierid").val();
	 $("#pp_m1_2_supplier_data").html("<img  style='margin-top:50px;margin-left:50px;'  src='images/loading.gif'/> Searching in Progress Please wait");
	$.get('pp_get_supplier_data.php?supplierid='+supplierid, function(data) {
		
		$("#pp_m1_2_supplier_data").html(data);
		if(data != '')
		{ 
			if ($('#pp_m12_detail').is(":hidden"))
			{
				$("#pp_m1_2_next").show();
			}
		}
		else
		{
			$("#pp_m1_2_supplierid").val("");
			$("#pp_m1_2_next").hide();
		}
	});
	
	
}


$(document).on('click', '.pp_m1_2_c_supplier',pp_get_supplier_data2);
function pp_get_supplier_data2()
{
	
	var c_supplierid = $(this).attr("supplierid");
	
	$('#pp_box_s_supplier_bg').hide();
	$('#pp_box_s_supplier').hide();
	$("#pp_m1_2_supplierid").val(c_supplierid);
	pp_get_supplier_data();
}


$(document).on('click', '#pp_m1_2_next',pp_m1_2_next);
function pp_m1_2_next()
{
  $("#pp_m12_detail").show();
  $("#pp_m1_2_next").hide();
  var supplierid = $("#pp_m1_2_supplierid").val();
  var docdate = $("#pp_m1_2_docdate").val();
  var purchaseorderno = $("#pp_m1_2_purchaseorderno").val();
  var deliveryorderno = $("#pp_m1_2_deliveryorderno").val();
  $.ajax({
        type: "POST",
        url: "pp_m12_create_temp.php",
        data: {supplierid:supplierid,docdate:docdate,purchaseorderno:purchaseorderno,deliveryorderno:deliveryorderno},
        success: function(datax) {
          // alert("data"+datax);
		   var jsonData = JSON.parse(datax);
		   var error_found = jsonData.error_found;
		   var docno = jsonData.docno;
		   $("#pp_m1_2_docno").html(docno);
	       if(error_found != '') alert("Error found");
        },
		 error : function(dataerr, status, error) {
            alert("error data "+dataerr);
            e.preventDefaultEvent();
        }
		
    });
  
  
}



$(document).on('change', '.m12_barcode',pp_m12_get_barcode_info);
function pp_m12_get_barcode_info()
{
  var barcode = $(this).val();
  var tr_line = $(this).parents("tr").index();
//  alert("line index "+tr_line);
  var qty = 2000;
    $("#m21_input tr").eq(tr_line).find("input.m12_rec_qty").focus();
//  $("#m21_input tr").eq(tr_line).find("input.m12_rec_qty").val(qty);
    $this=$(this);
$.ajax({
        type: "POST",
        url: "pp_m12_get_barcode_info.php",
        data: {barcode:barcode},
        success: function(datax) {
         //  alert("data"+datax);
		   var jsonData = JSON.parse(datax);
		   var sp_name = jsonData.sp_name;
		   var sp_id = jsonData.sp_id;
		   var sp_maker = jsonData.sp_maker;
		   var sp_status = jsonData.sp_status;
		//   alert("sp_status "+sp_status);
			$("#m21_input tr").eq(tr_line).find("input.m12_sparepartid").val(sp_id);
			$("#m21_input tr").eq(tr_line).find("input.m12_sparepartname").val(sp_name);
			$("#m21_input tr").eq(tr_line).find("input.m12_maker").val(sp_maker);
		
			if(sp_status=='F')
			{
				$("#m21_input tr").eq(tr_line).find("td.sp_status").css("background-color","#FFFF11");
				$("#m21_input tr").eq(tr_line).find("td.sp_status").html(sp_status);
			}
			if(sp_status=='NF')
			{
				$("#m21_input tr").eq(tr_line).find("td.sp_status").css("background-color","#FF0000");
				$("#m21_input tr").eq(tr_line).find("td.sp_status").html(sp_status);
				$("#m21_input tr").eq(tr_line).find("input.m12_sparepartid").val('');
				$("#m21_input tr").eq(tr_line).find("input.m12_sparepartname").val('');
				$("#m21_input tr").eq(tr_line).find("input.m12_maker").val('');
				$("#m21_input tr").eq(tr_line).find("input.m12_barcode").val('');
				 $("#m21_input tr").eq(tr_line).find("input.m12_barcode").focus();
			}
			
        }
    });
	
}

$(document).on('change', '.m12_sparepartid',pp_m12_get_barcode_info2);
function pp_m12_get_barcode_info2()
{
  var sparepartid = $(this).val();
  var tr_line = $(this).parents("tr").index();
 // alert("line index "+tr_line);
  var qty = 2000;
    $("#m21_input tr").eq(tr_line).find("input.m12_rec_qty").focus();
//  $("#m21_input tr").eq(tr_line).find("input.m12_rec_qty").val(qty);
$.ajax({
        type: "POST",
        url: "pp_m12_get_barcode_info2.php",
        data: {sparepartid:sparepartid},
        success: function(datax) {
         //  alert("data"+datax);
		   var jsonData = JSON.parse(datax);
		   var sp_name = jsonData.sp_name;
		   var sp_barcode = jsonData.sp_barcode;
		   var sp_maker = jsonData.sp_maker;
		   var sp_status = jsonData.sp_status;
			$("#m21_input tr").eq(tr_line).find("input.m12_barcode").val(sp_barcode);
			$("#m21_input tr").eq(tr_line).find("input.m12_sparepartname").val(sp_name);
			$("#m21_input tr").eq(tr_line).find("input.m12_maker").val(sp_maker);
			
			if(sp_status=='F')
			{
				$("#m21_input tr").eq(tr_line).find("td.sp_status").css("background-color","#FFFF11");
				$("#m21_input tr").eq(tr_line).find("td.sp_status").html(sp_status);
				
				
				
				
			}
			if(sp_status=='NF')
			{
				$("#m21_input tr").eq(tr_line).find("td.sp_status").css("background-color","#FF0000");
				$("#m21_input tr").eq(tr_line).find("td.sp_status").html(sp_status);
				$("#m21_input tr").eq(tr_line).find("input.m12_sparepartid").val('');
				$("#m21_input tr").eq(tr_line).find("input.m12_sparepartname").val('');
				$("#m21_input tr").eq(tr_line).find("input.m12_maker").val('');
				$("#m21_input tr").eq(tr_line).find("input.m12_barcode").val('');
				 $("#m21_input tr").eq(tr_line).find("input.m12_barcode").focus();
			}
        }
    });
	
}

//$(document).on('change', '.m12_barcode',m12_rec_qty);
//$(document).on('change', '.m12_sparepartid',m12_rec_qty);
$(document).on('change', '.m12_rec_qty',m12_rec_qty);
function m12_rec_qty()
{
	jQuery.ajaxSetup({async:false});
	var docno = $("#pp_m1_2_docno").html();
	var tr_line = $(this).parents("tr").index();
	
	var sp_status = $("#m21_input tr").eq(tr_line).find("td.sp_status").html();
	var sparepartid = $("#m21_input tr").eq(tr_line).find("input.m12_sparepartid").val();
	var barcode = $("#m21_input tr").eq(tr_line).find("input.m12_barcode").val();
	var sparepartname = $("#m21_input tr").eq(tr_line).find("input.m12_sparepartname").val();
	var docdate = $("#pp_m1_2_docdate").val();
	var recv = $("#m21_input tr").eq(tr_line).find("input.m12_rec_qty").val();
	alert("barcode "+barcode+" sparepartname "+sparepartname);
	if(sp_status == 'F' && recv > 0 ) 
	{
		$("#m21_input tr").eq(tr_line).find("td.sp_status").css("background-color","#008000");
		// Update mpr_receipt
		 $.ajax({
				type: "POST",
				url: "pp_m12_create_temp_detail.php",
				data: {docno:docno,lineno:tr_line,docno:docno,barcode:barcode,sparepartid:sparepartid,sparepartname:sparepartname,recv:recv},
				success: function(datax) {
					
					if(datax.search("Error") != -1) alert("Data error found : "+datax);
				   var jsonData = JSON.parse(datax);
				   var error_found = jsonData.error_found;
				   if(error_found != '') alert("Error found");
				},
				 error : function(dataerr, status, error) {
					alert("error data "+dataerr);
					e.preventDefaultEvent();
				}
				
			});
	}
	
	if(sp_status == 'F' && recv == 0 ) 
	{
		$("#m21_input tr").eq(tr_line).find("td.sp_status").css("background-color","#FFFF11");
	}
}


$(document).on('click', '#pp_m1_2_close',pp_m1_2_close);
function pp_m1_2_close()
{
  var program = $(this).attr("program");
  var supplierid = $("#pp_m1_2_supplierid").val();
  var docdate = $("#pp_m1_2_docdate").val();
  var purchaseorderno = $("#pp_m1_2_purchaseorderno").val();
  var deliveryorderno = $("#pp_m1_2_deliveryorderno").val();
  var docno = $("#pp_m1_2_docno").html();

  var purchaseordernoNaN = isNaN(purchaseorderno);
  var deliveryordernoNaN = isNaN(deliveryorderno);
  if(purchaseordernoNaN == true){
  	alert("Invalid Purchase Order No");
  	return;
  }
  if(deliveryordernoNaN == true){
  	alert("Invalid Delivery Order No");
  	return;
  }


$.ajax({

		type: "POST",
		url: "pp_m1_2_close.php",
		data: {docno:docno,supplierid:supplierid,docdate:docdate,purchaseorderno:purchaseorderno,deliveryorderno:deliveryorderno},
		success: function(datax) {
			
		if(datax.search("Error") != -1)
		  alert("Data error found : "+datax);
		var jsonData = JSON.parse(datax);
		var error_found = jsonData.error_found;
		 if(error_found != '') alert("Error found");
		$("#right_content_sub").html("<div style='margin-top:50px;font-size:20px;'>Document "+docno+" was succesfully saved and closed</div>");
		},
		 error : function(program_err, status, error) {
			alert("error data "+program_err);
			e.preventDefaultEvent();
		}
			
	 });	
}

$(document).on('click', '#pp_m2_2_close',pp_m2_2_close);
function pp_m2_2_close()
{
  var r = confirm('Confirm Return Purchase Order');
  if(r == false)
  	return;
  var program = $(this).attr("program");
  var supplierid = $("#prv_supplierid").html();
  var docdate = $("#prv_today").html();
  var purchaseorderno = $("#prv_po").html();
  var deliveryorderno = $("#prv_do").html();
  var docno = $("#prv_docno").html();
  //alert(docno);
  var rows = $("#prv_table tr").length
  var a_barcode = []; var a_sparepartid = []; var a_description =[]; var a_quantity = []; var count =0;
  for (i=0; i<rows; i++)
  {

  	var barcode = $("#prv_table tr").eq(i).find("#prv_barcode").html();
  	var sparepartid = $("#prv_table tr").eq(i).find("#prv_sparepartid").html();
  	var description = $("#prv_table tr").eq(i).find("#prv_description").html();
  	var quantity =$("#prv_table tr").eq(i).find("#prv_quantity").html();
  	quantity = parseInt(quantity);
  	a_barcode[count] = barcode;
  	a_sparepartid[count] = sparepartid;
  	a_description[count] = description;
  	a_quantity[count] = quantity;
  	count++;
  }
 	$.ajax({
				type: "POST",
				url: "pp_m2_2_reverse.php",
				data: {docno:docno,supplierid:supplierid,docdate:docdate,purchaseorderno:purchaseorderno,deliveryorderno:deliveryorderno,barcode:JSON.stringify(a_barcode),sparepartid:JSON.stringify(a_sparepartid),description:JSON.stringify(a_description),quantity:JSON.stringify(a_quantity)},
				success: function(datax) {
					
				if(datax.search("Error") != -1)
				  alert("Data error found : "+datax);
				var jsonData = JSON.parse(datax);
				var error_found = jsonData.error_found;
				 if(error_found != '') alert("Error found");
				$("#right_content_sub").html("<div style='margin-top:50px;font-size:20px;'>Document "+jsonData.docno+" was succesfully saved and closed</div>");
				},
				 error : function(program_err, status, error) {
					alert("error data "+program_err);
					e.preventDefaultEvent();
				}
				
			});	
}


$(document).on('click', '#pp_m3_2_return',pp_m3_2_return);
function pp_m3_2_return()
{
  var r = confirm('Confirm Return');
  if(r == false)
  	return;
  var program = $(this).attr("program");
  var supplierid = $("#ppr_supplierid").html();
  var docdate = $("#ppr_today").html();
  var purchaseorderno = $("#ppr_po").html();
  var deliveryorderno = $("#ppr_do").html();
  var docno = $("#ppr_docno").html();
  var rows = $("#ppr_table tr").length
  var a_barcode = []; var a_sparepartid = []; var a_description =[]; var a_quantity = []; var a_receiveqty =[]; var a_total =[]; var count =0;
  var ppr_total = 0; var return_total = 0; var receive_total = 0; var newTotal = 0;
  for (i=0; i<rows; i++)
  {

  	var barcode = $("#ppr_table tr").eq(i).find("#ppr_barcode").html();
  	var sparepartid = $("#ppr_table tr").eq(i).find("#ppr_sparepartid").html();
  	var description = $("#ppr_table tr").eq(i).find("#ppr_description").html();
  	var quantity = $("#ppr_table tr").eq(i).find("#ppr_quantity").val();
  	var receiveqty = $("#ppr_table tr").eq(i).find("#ppr_receiveqty").html();
  	var total = $("#ppr_table tr").eq(i).find("#ppr_total").html();
  	var newQty = $("#ppr_table tr").eq(i).find("#ppr_full").html();

  	newQty = parseInt(newQty);
  	total = parseInt(total);
  	quantity = parseInt(quantity);
  	receiveqty = parseInt(receiveqty);
  	var balance = receiveqty - total;
 
 	if(quantity > 0 && quantity <= receiveqty && quantity <= balance){
  	  	a_quantity[count] = quantity;
  		a_barcode[count] = barcode;
  		a_sparepartid[count] = sparepartid;
  		a_description[count] = description;	
  		a_receiveqty[count] = receiveqty;
  		a_total[count] = total;
  	}
  	count++;	
  	receive_total += receiveqty;

  	if(total != receiveqty)
  		return_total += quantity + newQty + total;
  	else
  		return_total += newQty;

  }
  newTotal = return_total;
  if(a_sparepartid == ''){
  	alert('error');
  	return;
  }
  //remove empty elements in array
  a_barcode = a_barcode.filter(function () { return true });
  a_sparepartid = a_sparepartid.filter(function () { return true });
  a_description = a_description.filter(function () { return true });
  a_quantity = a_quantity.filter(function () { return true });
  a_receiveqty = a_receiveqty.filter(function () { return true });
  //alert(a_barcode);alert(a_sparepartid);alert(a_description);alert(a_quantity);
$.ajax({
				type: "POST",
				url: "pp_m3_2_return.php",
				data: {docno:docno,supplierid:supplierid,docdate:docdate,purchaseorderno:purchaseorderno,
					   deliveryorderno:deliveryorderno,barcode:JSON.stringify(a_barcode),sparepartid:JSON.stringify(a_sparepartid),
					   description:JSON.stringify(a_description),quantity:JSON.stringify(a_quantity),
					   receiveqty:JSON.stringify(a_receiveqty),receive_total:receive_total,newTotal:newTotal},
				success: function(datax) {
					
				if(datax.search("Error") != -1)
				  alert("Data error found : "+datax);
				var jsonData = JSON.parse(datax);
				var error_found = jsonData.error_found;
				 if(error_found != '') alert("Error found");
				$("#right_content_sub").html("<div style='margin-top:50px;font-size:20px;'>Document "+jsonData.docno+" was succesfully saved and closed</div>");
				},
				 error : function(program_err, status, error) {
					alert("error data "+program_err);
					e.preventDefaultEvent();
				}
				
			});	
}

$(document).on('click', '#prv_delete',prv_delete)
function prv_delete()
{
    var r = confirm("Delete this document?");
    if(r==false)
    	return;
	var program = $(this).attr("program")
	var docno = $("#prv_docno").html();
	var head = docno.substring(0,3);
	$.get('upd_mprv_header.php?docno='+docno+'&head='+head, function(data,status) {
		alert("Document Deleted"); 
		$.get(program, function(data){
			$("#right_content_sub").html(data);
		});				
	});
}





$(document).on('click', '.pp_m1_3_choose',pp_m1_3_choose);
function pp_m1_3_choose()
{
	jQuery.ajaxSetup({async:false});
	var docno = $(this).attr("docno");
	$.get('pp_m1_3_change.php?docno='+docno, function(data) {
		$("#right_content_sub").html(data);
	});
	pp_get_supplier_data();
	
	
}

$(document).on('click', '#pp_m2_1x_choose',pp_m2_1x_choose);
function pp_m2_1x_choose()
{
	jQuery.ajaxSetup({async:false});
	var docno = $(this).attr("docno");
	$.get('pp_m2_2_change.php?docno='+docno, function(data) {
		$("#right_content_sub").html(data);
	});
	pp_get_supplier_data();
}

$(document).on('click', '.pp_m2_2x_choose',pp_m2_2x_choose);
function pp_m2_2x_choose()
{
	jQuery.ajaxSetup({async:false});
	var docno = $(this).attr("docno");
	$.get('pp_m2_2_details.php?docno='+docno, function(data) {
		$("#right_content_sub").html(data);
	});
	pp_get_supplier_data();
	
	
}


$(document).on('click', '.pp_m2_4x_choose',pp_m2_4x_choose);
function pp_m2_4x_choose()
{
	jQuery.ajaxSetup({async:false});
	var docno = $(this).attr("docno");
	$.get('pp_m2_4_details.php?docno='+docno, function(data) {
		$("#right_content_sub").html(data);
	});
	pp_get_supplier_data();
	
	
}

$(document).on('click', '#pp_m3_2_choose',pp_m3_2_choose);
function pp_m3_2_choose()
{
	jQuery.ajaxSetup({async:false});
	var docno = $(this).attr("docno");
	$.get('pp_m3_2_change.php?docno='+docno, function(data) {
		$("#right_content_sub").html(data);
	});
	pp_get_supplier_data();
	
	
}

$(document).on('click', '.pp_m3_1_choose',pp_m3_1_choose);
function pp_m3_1_choose()
{
	jQuery.ajaxSetup({async:false});
	var docno = $(this).attr("docno");
	$.get('pp_m3_1x_change.php?docno='+docno, function(data) {
		$("#right_content_sub").html(data);
	});
	pp_get_supplier_data();
	
	
}

$(document).on('click', '#pp_m3_3_choose',pp_m3_3_choose);
function pp_m3_3_choose()
{
	jQuery.ajaxSetup({async:false});
	var docno = $(this).attr("docno");
	$.get('pp_m3_3_change.php?docno='+docno, function(data) {
		$("#right_content_sub").html(data);
	});
	pp_get_supplier_data();	
}

$(document).on('click', '.pp_m3_4_choose',pp_m3_4_choose);
function pp_m3_4_choose()
{
	jQuery.ajaxSetup({async:false});
	var docno = $(this).attr("docno");
	$.get('pp_m3_4_details.php?docno='+docno, function(data) {
		$("#right_content_sub").html(data);
	});
	pp_get_supplier_data();	
}


$(document).on('click', '#pp_m1_1_update',pp_m1_1_update);
function pp_m1_1_update()
{

	var docno = $(this).attr("docno");
	var docdate = $("#pp_m1_1_docdate").val();
	var purchaseorderno = $("#pp_m1_1_po").val();
	var deliveryorderno = $("#pp_m1_1_do").val();

	alert(docdate);alert(purchaseorderno);alert(deliveryorderno);
	$.ajax({
				type: "POST",
				url: "pp_m1_1_update.php",
				data: {docno:docno,docdate:docdate,purchaseorderno:purchaseorderno,deliveryorderno:deliveryorderno},
				success: function(datax) {
					
				if(datax.search("Error") != -1)
				  alert("Data error found : "+datax);
				var jsonData = JSON.parse(datax);
				var error_found = jsonData.error_found;
				if(error_found != '') alert("Error found");
				$("#right_content_sub").html("<div style='margin-top:50px;font-size:20px;'>Document "+docno+" was succesfully updated</div>");
				},
				 error : function(program_err, status, error) {
					alert("error data "+program_err);
					e.preventDefaultEvent();
				}	
			});
}	

$(document).on('click', '#pp_m1_1_delete',pp_m1_1_delete);
function pp_m1_1_delete()
{

	var docno = $(this).attr("docno");
	$.ajax({
				type: "POST",
				url: "pp_m1_1_delete.php",
				data: {docno:docno},
				success: function(datax) {
					
					if(datax.search("Error") != -1)
				  alert("Data error found : "+datax);
				   var jsonData = JSON.parse(datax);
				   var error_found = jsonData.error_found;
				   if(error_found != '') alert("Error found");
				$("#right_content_sub").html("<div style='margin-top:50px;font-size:20px;'>Document "+docno+" was succesfully deleted</div>");
				},
				 error : function(program_err, status, error) {
					alert("error data "+program_err);
					e.preventDefaultEvent();
				}
				
			});
}	


$(document).on('click', '#pp_m1_4_search',pp_m1_4_search);
function pp_m1_4_search()
{
	   var s_year = $("#pp_m1_s_year").val();
	    var s_docno = $("#pp_m1_s_docno").val();
		var s_supplierid = $("#pp_m1_s_supplierid").val();
		$.get('pp_m1_4_search.php?s_year='+s_year+'&s_docno='+s_docno+'&s_supplierid='+s_supplierid, function(data) {
	
		
			$("#right_content_sub").html(data);
		
	});
	
}

$(document).on('click', '.pp_m1_4_change',pp_m1_4_change);
function pp_m1_4_change()
{

	var docno = $(this).attr("docno");
	var program = 'pp_m1_4_change.php?docno='+docno;
	$.get(program, function(data) {
	
    $("#right_content_sub").html(data);
	pp_get_supplier_data();
	});
	
}

$(document).on('click', '.pp_left_menu',pp_left_menu);
function pp_left_menu()
{
	$(".pp_left_menu").removeClass("pp_left_menu_pick");
		$(this).addClass("pp_left_menu_pick");
	    $("#mm_right_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
	var program  = $(this).attr("program");
		$.get(program, function(data) {
			$("#mm_right_content").html(data);
		
	});
	
}

$(document).on('change', '#pp_m4_1_s_barcode',pp_m4_1_search_part);
function pp_m4_1_search_part()
{
	var barcode = $("#pp_m4_1_s_barcode").val();
	var sparepartid =  $("#pm_s_sparepartid").val();
	var startdate = $("#pp_m4_1_s_date_from").val();
	var enddate = $("#pp_m4_1_s_date_to").val();
	 $("#pp_show_parts_history").html("<img  style='margin-top:50px;margin-left:50px;'  src='images/loading.gif'/> Searching in Progress Please wait");
	$.get('pp_m4_1_show_parts_history.php?sparepartid='+sparepartid+'&barcode='+barcode+'&startdate='+startdate+'&enddate='+enddate, function(data) {
		
		
		$("#pp_show_parts_history").html(data);
		$("#pp_m4_1_s_barcode").val("");
		
	});
	
}

$(document).on('click', '#pp_m4_1_get_part',pp_m4_1_get_part);
function pp_m4_1_get_part() 
{
	
    $('#pm_box_get_part_bg').show();
	$('#pm_box_get_part').show();
	 $.get('pp_m4_1_get_part.php', function(data) {
		$("#pm_box_get_part").html(data);
	});
	
	
}

$(document).on('change', '#pp_m4_1_s_partname',pp_m4_1_search_part);
$(document).on('change', '#pp_m4_1_s_maker',pp_m4_1_search_part);
$(document).on('change', '#pp_m4_1_s_barcode',pp_m4_1_search_part);
$(document).on('change', '#pp_m4_1_s_spgroup',pp_m4_1_search_part);
$(document).on('change', '#pp_m4_1_s_sparepartid',pp_m4_1_search_part);
function pp_m4_1_search_part()
{
	var equipmentid = $("#equipmentid").val();
	var partname = $("#pp_m4_1_s_partname").val();
	var sparepartid = $("#pp_m4_1_s_sparepartid").val();
	var maker = $("#pp_m4_1_s_maker").val();
	var barcode = $("#pp_m4_1_s_barcode").val();
	var spgroup = $("#pp_m4_1_s_spgroup").val();
	$("#pp_m4_1_s_barcode").focus();
	 $("#pp_m4_1_search_result").html("<img  style='margin-top:50px;margin-left:50px;'  src='images/loading.gif'/> Searching in Progress Please wait");
	$.get('pp_m4_1_search_part.php?partname='+partname+'&sparepartid='+sparepartid+'&maker='+maker+'&barcode='+barcode+'&spgroup='+spgroup+'&equipmentid='+equipmentid, function(data) {
		$("#pp_m4_1_search_result").html(data);
	});
	
}

$(document).on('click', '.pp_m4_1_choose_part',pp_m4_1_choose_part);
function pp_m4_1_choose_part()
{
	//var sparepartid = $(this).attr("sparepartid");
	
	var startdate = $("#pp_m4_1_s_date_from").val();
	var enddate = $("#pp_m4_1_s_date_to").val();
	var barcode = $(this).attr("barcode");
	//alert("barcode"+barcode);
	var sparepartid = $(this).attr("sparepartid");
    //$("#pm_s_barcode").val(barcode);
	 $("#pp_m4_1_s_sparepartid").val(sparepartid);
	$('#pm_box_get_part_bg').hide();
	$('#pm_box_get_part').hide();
	$("#pp_m4_1_s_barcode").focus();
     $("#pp_show_parts_history").html("<img  style='margin-top:50px;margin-left:50px;'  src='images/loading.gif'/> Searching in Progress Please wait");
	$.get('pp_m4_1_show_parts_history.php?sparepartid='+sparepartid+'&startdate='+startdate+'&enddate='+enddate, function(data) {
		
		//alert("data"+data);
		$("#pp_show_parts_history").html(data);
	});
	
}


$(document).on('click', '#pp_m4_2_get_supplier',pp_m4_2_get_supplier);
function pp_m4_2_get_supplier() 
{
	
    $('#pm_box_get_part_bg').show();
	$('#pm_box_get_part').show();
	 $.get('pp_m4_2_get_supplier.php', function(data) {
		$("#pm_box_get_part").html(data);
	});
	
	
}

$(document).on('change', '#pp_m4_2_s_suppliername',pp_m4_2_search_supplier);
$(document).on('change', '#pp_m4_2_s_supplierid',pp_m4_2_search_supplier);

function pp_m4_2_search_supplier()
{
	
	var suppliername = $("#pp_m4_2_s_suppliername").val();
	var supplierid = $("#pp_m4_2_s_supplierid").val();
	
	 $("#pp_m4_2_search_result").html("<img  style='margin-top:50px;margin-left:50px;'  src='images/loading.gif'/> Searching in Progress Please wait");
	$.get('pp_m4_2_search_supplier.php?suppliername='+suppliername+'&supplierid='+supplierid, function(data) {
		$("#pp_m4_2_search_result").html(data);
	});
	
}

$(document).on('click', '.pp_m4_2_choose_supplier',pp_m4_2_choose_supplier);
function pp_m4_2_choose_supplier()
{
	//var sparepartid = $(this).attr("sparepartid");
	
	var startdate = $("#pp_m4_2_s_date_from").val();
	var enddate = $("#pp_m4_2_s_date_to").val();
	var barcode = $(this).attr("barcode");
	//alert("barcode"+barcode);
	var supplierid = $(this).attr("supplierid");
    //$("#pm_s_barcode").val(barcode);
	 $("#pp_m4_2_s_supplierid").val(supplierid);
	$('#pm_box_get_part_bg').hide();
	$('#pm_box_get_part').hide();
		
     $("#pp_show_supplier_history").html("<img  style='margin-top:50px;margin-left:50px;'  src='images/loading.gif'/> Searching in Progress Please wait");
	$.get('pp_m4_2_show_supplier_history.php?supplierid='+supplierid+'&startdate='+startdate+'&enddate='+enddate, function(data) {
		
		//alert("data"+data);
		$("#pp_show_supplier_history").html(data);
	});
	
}

$(document).on('click', '.tech_menu',tech_menu);
function tech_menu()
{
	
	    var program = $(this).attr("program");
	
		$.get(program, function(data) {
	
		
			$("#main_content").html(data);
		
	});
	
}

$(document).on('click', '.pv_mswitch',pv_switch_month);
function pv_switch_month()
{
	var curmth = $("#curmth").val() - 1;
	var curyear = $("#curyear").val();
	var pv_direction = $(this).attr("id");
	
	
	var date = new Date(curyear, curmth, 1); // 2012-03-31
	if(pv_direction == 'pv_next')
	{
		date.setMonth(date.getMonth() + 1); 
		var newmmyyyy =
		date.toLocaleString("en", { month: "long"  }) + ' ' +
		date.toLocaleString("en", { year: "numeric"});
		//alert(' newdate '+newmmyyyy);
		var newyear = date.getFullYear();
		var newmth = date.getMonth() + 1;
		$("#curyear").val(newyear);
		$("#curmth").val(newmth);
		$("#pv_newmmyyyy").html(newmmyyyy);
		
		 $("#pv_monthly_schedule").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
		$.get('pv_month_schedule.php?curmth='+newmth+'&curyear='+newyear, function(data) {
			$("#pv_monthly_schedule").html(data);
		});
	}
	
	if(pv_direction == 'pv_previous')
	{
		date.setMonth(date.getMonth() - 1); 
		var newmmyyyy =
		date.toLocaleString("en", { month: "long"  }) + ' ' +
		date.toLocaleString("en", { year: "numeric"});
		//alert(' newdate '+newmmyyyy);
		var newyear = date.getFullYear();
		var newmth = date.getMonth() + 1;
		$("#curyear").val(newyear);
		$("#curmth").val(newmth);
		$("#pv_newmmyyyy").html(newmmyyyy);
		
		 $("#pv_monthly_schedule").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
		$.get('pv_month_schedule.php?curmth='+newmth+'&curyear='+newyear, function(data) {
			$("#pv_monthly_schedule").html(data);
		});
	}
	
}

$(document).on('click', '.pv_d1',pv_d1);
function pv_d1()
{
	$("#pv_popup_bg").show();
	$("#pv_popup_content").show();
	var recno = $(this).attr("recno");
	$.get('popup_pv_data.php?recno='+recno, function(data) 
		{
			$("#pv_popup_content").html(data);
		});
}

$(document).on('click', '#pv_popup_bg',clear_pv_popup_bg);
function clear_pv_popup_bg()
{
	$("#pv_popup_bg").hide();
	$("#pv_popup_content").hide();
	
}


$(document).on('click', '.pv_m1_menu',pv_m1_menu);
function pv_m1_menu()
{
	//var sparepartid = $("#sparepartid").val();
	$(".pv_m1_menu").removeClass("pv_m1_menu_pick");
	$(this).addClass("pv_m1_menu_pick");
	var program = $(this).attr("program");
	//alert("run program"+program);
	$.get(program, function(data) {
  //  $('#right_sub_content').show();
	 $('#right_content_sub').html(data);
	});
}	


$(document).on('change', '.pv_dd',pv_dd);
function pv_dd()
{
	var original = $(this).prop("defaultValue");
	//alert("original "+original);
	var $this=$(this);
	var dd1 = $(this).val();
	var dd = dd1.replace(/ /g,'');
	var mm = $(this).attr("dd_mth");
	var yy = $(this).attr("dd_year");
	var equipmentid = $(this).attr("equipmentid");
	
	var date = new Date(yy, mm, 0); 
	var mmdays = date.getDate();

	if(dd < 1 || dd > mmdays || !$.isNumeric(dd)  ) 
	{
		if(dd != '')
		{
		alert("Invalid Date number entered");
		 $this.val(original);
		setTimeout(function() { $this.focus(); }, 50);
		return;
		}
		
	}
	
	$.ajax({
				type: "POST",
				url: "pv_m1_2_update.php",
				data: {equipmentid:equipmentid,dd:dd,mm:mm,yy:yy},
				success: function(datax) 
				{
					if(datax.search("Error") != -1) alert("Data error found : "+datax);
					var jsonData = JSON.parse(datax);
					var error_found = jsonData.error_found;
					if(error_found != '') alert("Error found");
					//$("#right_content_sub").html("<div style='margin-top:50px;font-size:20px;'>Document "+docno+" was succesfully deleted</div>");
				},
				error : function(program_err, status, error) 
				{
					alert("error data "+program_err);
					e.preventDefaultEvent();
				}
				
			});
}


$(document).on('click', '.pv_yswitch',pv_switch_year);
function pv_switch_year()
{
	//var curmth = $("#curmth").val() - 1;
	var curyear = parseInt($("#curyear").val());
	var pv_direction = $(this).attr("id");

	if(pv_direction == 'pv_next')
	{
	
		var newyear = curyear + 1;
		$("#curyear").val(newyear);
		$("#pv_newyyyy").html(newyear);
		
		 $("#pv_equipment_schedule").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
		$.get('pv_equipment_schedule.php?curyear='+newyear, function(data) {
			$("#pv_equipment_schedule").html(data);
		});
	}
	
	if(pv_direction == 'pv_previous')
	{
	
		var newyear = curyear - 1;
		$("#curyear").val(newyear);
		$("#pv_newyyyy").html(newyear);
		
		 $("#pv_equipment_schedule").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
		$.get('pv_equipment_schedule.php?curyear='+newyear, function(data) {
			$("#pv_equipment_schedule").html(data);
		});
	}
	
}

$(document).on('change', '#wo_select_wo_type',wo_select_wo_type);
function wo_select_wo_type()
{
	var wo_type = $("#wo_select_wo_type").val();
	if(wo_type=='PV')
	{
		$("#pv_schedule").show();
		
	}
	
}

$(document).on('click', '.wo_change',wo_change);
function wo_change()
{
	var workorderid = $(this).attr("workorderid");
	 $.get('wo_change.php?workorderid='+workorderid, function(data) {
		 $("#mm_right_content").html(data);			
	});	
}

$(document).on('click', 'tr.eqd_wo_details',eqd_wo_details);
function eqd_wo_details()
{
	//alert ("test"); 
	var workorderid = $(this).attr("workorderid");
	 $.get('eqd_wo_details.php?workorderid='+workorderid, function(data) {
		 $("#eqd_wo_details_show").html(data);	
		 //$("#pop_bg").show();
		 //$("#pop_content").show();
		 //$("#pop_content").html(data);
		 
	});	
}

$(document).on('click', '#wo_change_save',wo_change_save);
function wo_change_save()

{
	var workorderid = $('#workorderid').val();
	var wo_recno = $('#wo_recno').val();
	var wo_type = $('#wo_select_wo_type').val();
	var remarks = $('#wo_remarks').val();
	var instructions = $('#wo_instructions').val();
	var pv_schedule_recno = $('#wo_select_pv_schedule').val();
	var problem = $('#wo_problem').val();
    var equipmentid = $('#wo_select_equipmentid').val();
	var table_id="wo_eq_part_list";
	var rows = $("#"+table_id+" tr");
	var mylength = rows.length;
	var a_barcode =[]; var a_orderqty =[]; var a_sparepartid =[]; var a_partnumber =[]; var count=0;
	for(var i=1; i < mylength;i++)
	{
		
		var w_orderqty = $("#wo_eq_part_list tr " ).eq(i).find("input.wo_orderqty").val();
		var wo_partDesc = $("#wo_eq_part_list tr " ).eq(i).find("td.wo_partDesc").html();

		var nan = isNaN(w_orderqty);
		if(nan == true){
			alert('Input error for part: '+wo_partDesc);
			return;
		}

		w_orderqty = parseInt(w_orderqty || 0);
		if(w_orderqty > 0 )
		{
			count++;
			var w_barcode = $("#wo_eq_part_list tr " ).eq(i).find("td.wo_barcode").html();
			var w_sparepartid = $("#wo_eq_part_list tr " ).eq(i).find("td.wo_sparepartid").html();
			var w_partnumber = $("#wo_eq_part_list tr " ).eq(i).find("td.wo_partnumber").html();
			
			a_barcode[count] = w_barcode;
			a_orderqty[count] = w_orderqty;
			a_sparepartid[count] = w_sparepartid;
			a_partnumber[count] = w_partnumber;
		}
	}
		
	$.ajax({
        type: "POST",
        url: "wo_change_save.php",
        data: {workorderid:workorderid,wo_recno:wo_recno,equipmentid:equipmentid,wo_type:wo_type,pv_schedule_recno:pv_schedule_recno,problem:problem,instructions:instructions,remarks:remarks,array_barcode: JSON.stringify(a_barcode),array_orderqty: JSON.stringify(a_orderqty),array_sparepartid: JSON.stringify(a_sparepartid),array_partnumber: JSON.stringify(a_partnumber)},
        success: function(datax) {
        //  alert("data"+datax);
		   var jsonData = JSON.parse(datax);
		   var t1 = jsonData.item1;
		   var resulthtml = "<div style='margin-top:40px;text-align:center;font-size:25px;'> Workorder id "+t1+" was created </div>";
		   resulthtml += "<table style='margin-top:40px;text-align:center;font-size:25px;'>";
		   resulthtml += "<tr><td style='width:320px;'></td><td><button id='create_new_workorder' style='width:400px;height:40px;font-size:14px;'>Create another workorder </button></td>";
		   resulthtml += "</tr>";
		   resulthtml += "<tr><td style='height:30px'></td></tr>";
		   resulthtml += "<tr><td style='width:320px;'></td><td><button id='mm_my_wo_active' style='width:400px;height:40px;font-size:14px;'>Show Active WO Listing </button></td>";
		   resulthtml += "</tr>";
		   resulthtml += " </table>";
		   
		
			$("#mm_right_content").html(resulthtml);
					
				
        }
    });

	
}

$(document).on('click', '.oth_wo_change',oth_wo_change);
function oth_wo_change()
{
	var workorderid = $(this).attr("workorderid");
	 $.get('oth_wo_change.php?workorderid='+workorderid, function(data) {
		 $("#mm_right_content").html(data);			
	});	
}


$(document).on('click', '#oth_wo_change_save',oth_wo_change_save);
function oth_wo_change_save()

{
	var workorderid = $('#workorderid').val();
	var wo_recno = $('#wo_recno').val();
	var wo_type = $('#wo_select_wo_type').val();
	var remarks = $('#wo_remarks').val();
	var instructions = $('#wo_instructions').val();
	var pv_schedule_recno = $('#wo_select_pv_schedule').val();
	var problem = $('#wo_problem').val();
    var equipmentid = $('#wo_select_equipmentid').val();
	var table_id="wo_eq_part_list";
		var rows = $("#"+table_id+" tr");
		var mylength = rows.length;
		var a_barcode =[]; var a_orderqty =[]; var a_sparepartid =[]; var count=0;
		for(var i=1; i < mylength;i++)
		{
			
			var w_orderqty = $("#wo_eq_part_list tr " ).eq(i).find("input.wo_orderqty").val();
			w_orderqty = parseInt(w_orderqty || 0);
		   // alert("loop "+i +" orderqty "+w_orderqty);
			if(w_orderqty > 0 )
			{
				
				count++;
				var w_barcode = $("#wo_eq_part_list tr " ).eq(i).find("td.wo_barcode").html();
				var w_sparepartid = $("#wo_eq_part_list tr " ).eq(i).find("td.wo_sparepartid").html();
				
				a_barcode[count] = w_barcode;
				a_orderqty[count] = w_orderqty;
				a_sparepartid[count] = w_sparepartid;
				//alert("sparepartid "+w_sparepartid);
			}
		}
		
	alert("problem"+problem);
	$.ajax({
        type: "POST",
        url: "oth_wo_change_save.php",
        data: {workorderid:workorderid,wo_recno:wo_recno,equipmentid:equipmentid,wo_type:wo_type,pv_schedule_recno:pv_schedule_recno,problem:problem,instructions:instructions,remarks:remarks,array_barcode: JSON.stringify(a_barcode),array_orderqty: JSON.stringify(a_orderqty),array_sparepartid: JSON.stringify(a_sparepartid)},
        success: function(datax) {
        //  alert("data"+datax);
		   var jsonData = JSON.parse(datax);
		   var t1 = jsonData.item1;
		   var resulthtml = "<div style='margin-top:40px;text-align:center;font-size:25px;'> Workorder id "+t1+" was created </div>";
		   resulthtml += "<table style='margin-top:40px;text-align:center;font-size:25px;'>";
		   resulthtml += "<tr><td style='width:320px;'></td><td><button id='wo_create_another' style='width:400px;height:40px;font-size:14px;'>Create another workorder </button></td>";
		   resulthtml += "</tr>";
		   resulthtml += "<tr><td style='height:30px'></td></tr>";
		   resulthtml += "<tr><td style='width:320px;'></td><td><button id='wo_show_active_list' style='width:400px;height:40px;font-size:14px;'>Show Active Others WO Listing </button></td>";
		   resulthtml += "</tr>";
		   resulthtml += " </table>";
		   
		
			$("#mm_right_content").html(resulthtml);
					
				
        }
    });

	
}
/*
$(document).on('click', '.rep_left_menu',rep_left_menu);
function rep_left_menu()
{
	
	var program = $(this).attr("program");
	$.get(program, function(data) {
	
    $('#rep_right_content').html(data);
	});
	
}
*/
$(document).on('click', '#rep_m1_1_execute',rep_m1_1_execute);
function rep_m1_1_execute()
{
	var company = $("#rep_s_company").val();
	var sparepartname = $("#rep_s_sparepartname").val();
	var barcode = $("#rep_s_barcode").val();
	var maker = $("#rep_s_maker").val();
	var supplier = $("#rep_s_supplier").val();
	var program = $(this).attr("program");
	programloc = program+'?company='+company+'&sparepartname='+sparepartname+'&barcode='+barcode+'&maker='+maker+'&supplier='+supplier;
    window.open(programloc, "_blank", "toolbar=no,scrollbars=yes,location=no,menubar=no,resizable=yes,top=50,left=50,width=1200,height=500"); 
	
	}
	
	
$(document).on('click', '.rep_m1_menu',rep_m1_menu);
function rep_m1_menu()
{
	//var sparepartid = $("#sparepartid").val();
	$(".rep_m1_menu").removeClass("rep_m1_menu_pick");
	$(this).addClass("rep_m1_menu_pick");
	var program = $(this).attr("program");
	//alert("run program"+program);
	$.get(program, function(data) {
  //  $('#right_sub_content').show();
	 $('#right_content_sub').html(data);
	});
}	

$(document).on('click', '.rep_left_menu',rep_left_menu);

function rep_left_menu()
{
	 $("#show_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
	 var left_menuid = $(this).attr("left_menuid");
	 $(".rep_left_menu").removeClass("rep_left_menu_pick");
	 $(this).addClass("rep_left_menu_pick");
	var program = $(this).attr("program");
	$.get(program, function(data) {
	
    $('#rep_right_content').html(data);
	});
	
}

$(document).on('click', '#pop_bg',clear_pop_bg);
function clear_pop_bg()
{
	$("#pop_bg").hide();
	$("#pop_content").hide();
}

$(document).on('click', 'tr.eqd_giss_details',eqd_giss_details);
function eqd_giss_details()
{
	//alert ("test"); 
	var stisdocno = $(this).attr("stisdocno");
	 $.get('eqd_giss_details.php?stisdocno='+stisdocno, function(data) {
		 $("#eqd_giss_details_show").html(data);	
		 
	});	
}

$(document).on('click', 'tr.eqd_gret_details',eqd_gret_details);
function eqd_gret_details()
{
	//alert ("test"); 
	var retdocno = $(this).attr("retdocno");
	 $.get('eqd_gret_details.php?retdocno='+retdocno, function(data) {
		 $("#eqd_gret_details_show").html(data);	
		 
	});	
}

$(document).on('click', '#rep_t1_1_execute',rep_t1_1_execute);
function rep_t1_1_execute()
{
	
	var company = $("#rep_s_company").val();
	var sparepartname = $("#rep_s_sparepartname").val();
	var barcode = $("#rep_s_barcode").val();
	var maker = $("#rep_s_maker").val();
	var supplier = $("#rep_s_supplier").val();
	var program = $(this).attr("program");
	programloc = program+'?company='+company+'&sparepartname='+sparepartname+'&barcode='+barcode+'&maker='+maker+'&supplier='+supplier;
    window.open(programloc, "_blank", "toolbar=no,scrollbars=yes,location=no,menubar=no,resizable=yes,top=50,left=50,width=1200,height=500"); 
	
}

$(document).on('click', '#generate_st',generate_st);
function generate_st()
{
  $("#generate_st_detail").show();
  $("#generate_st").hide();
  var storeidid = $("#storeidid").val();
  var st_date = $("#st_date").val();
  alert('test');
  $.ajax({
        type: "POST",
        url: "pc_m1_new.php",
        data: {st_date:st_date,storeidid:storeidid},
        success: function(datax) {
           alert("success data"+datax);
		   var jsonData = JSON.parse(datax);
		   var error_found = jsonData.error_found;
		   var docno = jsonData.docno;
		   $("#st_date").html(docno);
	       if(error_found != '') alert("Error found");
        },
		 error : function(dataerr, status, error) {
            alert("error data "+dataerr);
            e.preventDefaultEvent();
        }
		
    });
    alert('testccc');

  
}

$(document).on('click', '#pc_m2',pc_m2);
function pc_m2()
{
	    $(".mm_left_menu").removeClass("mm_pick");
		$(this).addClass("mm_pick");
		$("#mm_right_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
		$.get('pc_m2.php', function(data) {
	
			
			$("#mm_right_content").html(data);
		
	});
	
}

$(document).on('click', '.pc_m2_view',pc_m2_view);
function pc_m2_view()
{
	var pcdocno = $(this).attr("pcdocno");
	var countdate = $(this).attr("countdate");
	var storeid = $(this).attr("storeid");
	var username = $(this).attr("username");
	 $("#wo_show_list").html("<img  style='margin-top:50px;margin-left:50px;'  src='images/loading.gif'/> Searching in Progress Please wait");
	 $.get('pc_m2_view.php?pcdocno='+pcdocno+'&countdate='+countdate+'&storeid='+storeid+'&username'+username, function(data) {
		 $("#mm_right_content").html(data);			
	});	
}

$(document).on('click', '.pc_m2_change',pc_m2_change);
function pc_m2_change()
{
	var pcdocno = $(this).attr("pcdocno");
	 $.get('pc_m2_change.php?pcdocno='+pcdocno, function(data) {
		 $("#mm_right_content").html(data);			
	});	
}

$(document).on("click",".st_date",function(){
	$(this).datepicker({                       
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd-mm-yy'                     
		}).datepicker("show");
});

$(document).on('click', '#pp_m5',pp_m5);
function pp_m5()
{
	$(".mm_left_menu").removeClass("mm_pick");
	$(this).addClass("mm_pick");
	$("#mm_right_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
	 $.get('pp_m5_label.php', function(data) {
	
			$("#mm_right_content").html(data);
		
		
	});
	
}

$(document).on('click', '#pp_m6',pp_m6);
function pp_m6()
{
	$(".mm_left_menu").removeClass("mm_pick");
	$(this).addClass("mm_pick");
	$("#mm_right_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
	 $.get('pp_m6_label.php', function(data) {
	
			$("#mm_right_content").html(data);
		
		
	});
	
}

$(document).on('click', '#pp_m7',pp_m7);
function pp_m7()
{
	$(".mm_left_menu").removeClass("mm_pick");
	$(this).addClass("mm_pick");
	$("#mm_right_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
	 $.get('pp_m7_label.php', function(data) {
	
			$("#mm_right_content").html(data);
		
		
	});
	
}

$(document).on('click', '#pp_m8',pp_m8);
function pp_m8()
{
	$(".mm_left_menu").removeClass("mm_pick");
	$(this).addClass("mm_pick");
	$("#mm_right_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
	 $.get('pm_byloc.php', function(data) {
	
			$("#mm_right_content").html(data);
		
		
	});
	
}

$(document).on('click', '.box_loc',pm_byloc_list);
function pm_byloc_list()
{
	$(".box_loc").removeClass("box_loc_pick");
	$(this).addClass("box_loc_pick");
	var bingroup = $(this).attr("bingroup");
	$.get('pm_bybin_list.php?bingroup='+bingroup, function(data) 
		{
			$("#eqh_content").html(data);
		});
	
}

$(document).on('click', '.box_bin',pm_bybin_list);
function pm_bybin_list()
{
	$(".box_bin").removeClass("box_bin_pick");
	$(this).addClass("box_bin_pick");
	var locationcode = $(this).attr("locationcode");
	$.get('pm_byloc_list.php?locationcode='+locationcode, function(data) 
		{
			$("#eqh_content").html(data);
		});
	
}

$(document).on('click', '.rep_m2_menu',rep_m2_menu);
function rep_m2_menu()
{
	
	//var sparepartid = $("#sparepartid").val();
	$(".rep_m2_menu").removeClass("rep_m2_menu_pick");
	$(this).addClass("rep_m2_menu_pick");
	var program = $(this).attr("program");
	//alert("run program"+program);
	$.get(program, function(data) {
    //$('#right_sub_content').show();
	  $('#right_content_sub').html(data);
	});
}	

$(document).on('click', '#rep_m2_1_execute',rep_m2_1_execute);
function rep_m2_1_execute()
{
	
	var company = $("#rep_s_company").val();
	var equipmentid = $("#rep_s_equipmentid").val();
	var linecode = $("#rep_s_linecode").val();
	//var maker = $("#rep_s_maker").val();
	var description = $("#rep_s_description").val();
	var program = $(this).attr("program");
	programloc = program+'?company='+company+'&equipmentid='+equipmentid+'&linecode='+linecode+'&description='+description;
    window.open(programloc, "_blank", "toolbar=no,scrollbars=yes,location=no,menubar=no,resizable=yes,top=50,left=50,width=1200,height=500"); 
	
}
	
$(document).on('click', '#rep_t1_2_execute',rep_t1_2_execute);
function rep_t1_2_execute()
{
	var company = $("#rep_s_company").val();
	var sparepartname = $("#rep_s_sparepartname").val();
	var barcode = $("#rep_s_barcode").val();
	var maker = $("#rep_s_maker").val();
	var supplier = $("#rep_s_supplier").val();
	var program = $(this).attr("program");
	programloc = program+'?company='+company+'&sparepartname='+sparepartname+'&barcode='+barcode+'&maker='+maker+'&supplier='+supplier;
    window.open(programloc, "_blank", "toolbar=no,scrollbars=yes,location=no,menubar=no,resizable=yes,top=50,left=50,width=1200,height=500"); 
	
}

$(document).on('click', '#rep_t1_3_execute',rep_t1_3_execute);
function rep_t1_3_execute()
{
	var company = $("#rep_s_company").val();
	var sparepartname = $("#rep_s_sparepartname").val();
	var barcode = $("#rep_s_barcode").val();
	var maker = $("#rep_s_maker").val();
	var supplier = $("#rep_s_supplier").val();
	var program = $(this).attr("program");
	programloc = program+'?company='+company+'&sparepartname='+sparepartname+'&barcode='+barcode+'&maker='+maker+'&supplier='+supplier;
    window.open(programloc, "_blank", "toolbar=no,scrollbars=yes,location=no,menubar=no,resizable=yes,top=50,left=50,width=1200,height=500"); 
	
}

$(document).on('click', '#print_pbe',print_pbe);
function print_pbe()
{
	//$("#print_select").show();
	//window.print();
	//var company = $("#rep_s_company").val();
	//var sparepartname = $("#rep_s_sparepartname").val();
	//var barcode = $("#rep_s_barcode").val();
	//var maker = $("#rep_s_maker").val();
	//var supplier = $("#rep_s_supplier").val();
	var sparepartid = $("#pr_sparepartid").html();
	var start_date = $("#pm_s_date_from").val();
	var end_date = $("#pm_s_date_to").val();
	var barcode = $("#pm_s_barcode").val();
	var program = $(this).attr("program");
	programloc = "pm_show_print.php"+'?sparepartid='+sparepartid+'&startdate='+start_date+'&enddate='+end_date;
    window.open(programloc, "_blank", "toolbar=no,scrollbars=yes,location=no,menubar=no,resizable=yes,top=50,left=50,width=1200,height=500"); 

	
}

$(document).on('click', '.rep_m3_menu',rep_m3_menu);
function rep_m3_menu()
{
	
	//var sparepartid = $("#sparepartid").val();
	$(".rep_m3_menu").removeClass("rep_m3_menu_pick");
	$(this).addClass("rep_m3_menu_pick");
	var program = $(this).attr("program");
	//alert("run program"+program);
	$.get(program, function(data) {
  //  $('#right_sub_content').show();
	  $('#right_content_sub').html(data);
	});
}	

$(document).on('click', '#rep_m3_1_execute',rep_m3_1_execute);
function rep_m3_1_execute()
{
	
	//var company = $("#rep_s_company").val();
	var description = $("#rep_s_description").val();
	var sparepartid = $("#rep_s_sparepartid").val();
	var startdate = $("#rep_s_date_from").val();
	var todate = $("#rep_s_date_to").val();
	//var maker = $("#rep_s_maker").val();
	//var supplier = $("#rep_s_supplier").val();
	var program = $(this).attr("program");
	programloc = program+'?description='+description+'&sparepartid='+sparepartid+'&startdate='+startdate+'&todate='+todate;
    window.open(programloc, "_blank", "toolbar=no,scrollbars=yes,location=no,menubar=no,resizable=yes,top=50,left=50,width=1200,height=500"); 
	
}

$(document).on('click', '#rep_m2_2_execute',rep_m2_2_execute);
function rep_m2_2_execute()
{
	
	var company = $("#rep_s_company").val();
	var equipmentid = $("#rep_s_equipmentid").val();
	var linecode = $("#rep_s_linecode").val();
	//var maker = $("#rep_s_maker").val();
	var description = $("#rep_s_description").val();
	var program = $(this).attr("program");
	programloc = program+'?company='+company+'&equipmentid='+equipmentid+'&linecode='+linecode+'&description='+description;
    window.open(programloc, "_blank", "toolbar=no,scrollbars=yes,location=no,menubar=no,resizable=yes,top=50,left=50,width=1200,height=500"); 
	
}

$(document).on('click', '#rep_m2_3_execute',rep_m2_3_execute);
function rep_m2_3_execute()
{
	
	var company = $("#rep_s_company").val();
	var equipmentid = $("#rep_s_equipmentid").val();
	var linecode = $("#rep_s_linecode").val();
	//var maker = $("#rep_s_maker").val();
	var description = $("#rep_s_description").val();
	var program = $(this).attr("program");
	programloc = program+'?company='+company+'&equipmentid='+equipmentid+'&linecode='+linecode+'&description='+description;
    window.open(programloc, "_blank", "toolbar=no,scrollbars=yes,location=no,menubar=no,resizable=yes,top=50,left=50,width=1200,height=500"); 
	
}

$(document).on('change', '#pc_stocktake_qty',update_stocktake_qty);
function update_stocktake_qty(){
	var stocktake_qty = $(this).val();
	var sparepartid = $(this).attr('sparepartid');
	var pc_docno = $(this).attr('pc_docno');


	$.get('upd_stocktake_qty.php?stocktake_qty='+stocktake_qty+'&pcdocno='+pc_docno+'&sparepartid='+sparepartid, function(data,status) {
			
		alert('Updated');		
	});
}

$(document).on('change', '#rep_safety_qty',update_safety_qty);
function update_safety_qty(){
	var safety_qty = $(this).val();
	var sparepartid = $(this).attr('sparepartid');



	$.get('upd_safety_qty.php?safety_qty='+safety_qty+'&sparepartid='+sparepartid, function(data,status) {
			
		alert('Safety Quantity Updated');		
	});
}

$(document).on('click', '#sk_iss_return',sk_iss_return);
function sk_iss_return()
{
	   $('.mm_left_menu').removeClass("mm_pick");
	    $(this).addClass("mm_pick");
	   $("#mm_right_content").html("<img  style='margin-top:150px;margin-left:230px;'  src='images/loading.gif'/> Please wait");
		$.get('sk_iss_return.php', function(data) {
	
		
			$("#mm_right_content").html(data);
		
	});	
}

$(document).on('click', '#repSpBalance',rep_balance);
function rep_balance()
{
	  var sparepartid = $(this).attr('sparepartid')
	  var equipmentdesc = $(this).attr('equipmentdesc')

	  $.get('rep_part_balance.php'+'?sparepartid='+sparepartid+'&equipmentdesc='+equipmentdesc, function(data) {
		$("#rep_balanceDetail").html(data);
		
	  });		
}

$(document).on('click', '#btn_spBalanceBack',btn_spBalanceBack);
function btn_spBalanceBack()
{
	  $("#rep_balanceDetail").html("<img  style='margin-top:150px;margin-left:100px;'  src='images/loading.gif'/> Please wait");
	  $.get('rep_m1_1_rpt.php', function(data) {
		$("#rep_balance").html(data);
	  });		
}


/*
$(document).on('change', '#partmaster_change_save',part_change_save);
function part_change_save()
{
	
	var sparepartid = $(this).attr("sparepartid");
	var keycode = $("#keycode").val();
	var description = $("#description").val();
	var maker = $("#maker").val();
	var barcode = $("#barcode").val();
	var remarks = $("#remarks").val();
	var spgroup = $("#spgroup").val();
	var sptype = $("#sptype").val();
	//var barcode = $("#barcode").val();
	var fs = $("#fs").val();
     alert("updated Part "+barcode);
	$.get('part_change_save.php?sparepartid='+sparepartid+'&keycode='+keycode+'&barcode='+barcode+'&description='+description+
	                            '&maker='+maker+'&remarks='+remarks+'&spgroup='+spgroup+'&sptype='+sptype+
								'&fs='+fs, function(data) {
									if(data!='') alert("data"+data);
		  alert("Part was successfully updated ");
		  pm_parts_master();
	});
}*/