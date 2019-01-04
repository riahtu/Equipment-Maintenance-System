$(document).on('click', '#pc_refno_next',pc_refno_next);
var refno = $("#pc_refno").val();
function pc_refno_next()
{
	var html = "<div>data</div>";
	$("#main_content").html("");
	$("#main_content").html(html);
	
	
}

function pc_refno_next2()
{
	
	$.ajax({
    url:'a_phy_refno_next.php?refno='+refno,
  
    cache: false,
	dataType:"JSON",
    contentType: false,
    processData: false,
  //  data: form_data, // Setting the data attribute of ajax with file_data
    type: 'post',
    success: function(data) {
			$('#show_area').html("<img src='images/loading.gif'  />");
			$.get('mpart_picture_show.php?sparepartid='+sparepartid, function(data) {
			
				$("#show_area").html(data);
			});
    },
	 error : function(data, status, error) {
           $("#a_message").html("<p>Error : Cannot access file </p>");
          //  e.preventDefaultEvent();
        }
  });
	
	
	
}