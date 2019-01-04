<?php

session_start();

$_SESSION[groupmenu] = 'EMS';
include('check_browser.php');
  include('checkuser.php');
 require_once('db_ems.php');
 include('modules.php'); 
// include('moddashboard.php'); 
//   include('fusionchart/PHPClass/includes/FusionCharts_Gen.php');
//  include("fusionchart/phpclass/Includes/FusionCharts.php");
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML>
<HEAD>


 <TITLE>Equipment Maintenance System</TITLE>
   <link rel="stylesheet" type="text/css" href="mystyle.css" />
	 <link rel="stylesheet" type="text/css" href="print.css" media="print" />
<link rel="stylesheet" type="text/css" href="popup.css" />
   <link rel="stylesheet" type="text/css" href="jqueryslidemenu.css" />
  
<script type="text/javascript" src="jqery.min.js"></script>

<link type="text/css" href="jquery/css/ui-lightness/jquery-ui-1.8.17.custom.css" rel="stylesheet" />	
	<script type="text/javascript" src="jquery/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="jquery/js/jquery-ui-1.8.17.custom.min.js"></script>
	<link rel="stylesheet" href="jquery-ui-1.11.2.custom/jquery-ui.css">
	<script src="jquery-ui-1.11.2.custom/external/jquery/jquery.js"></script>
	<script src="jquery-ui-1.11.2.custom/jquery-ui.js"></script>
	<script type="text/javascript" src="admin.js"></script>
	
<script>
i = 0;
$(document).ready(function(){
    $("input#test1").keypress(function(){
        $("span#test2").text(i += 1);
    });
});
</script>

		
</HEAD>
<BODY>

<?php

require("top_menu.php");
require("main_content.php");
//require("show_content.php");


?>

<div id="example-popup" class="popup">
		<div class="popup-body" ><span class="popup-exit"></span>
			<div class="popup-content" ></div>
		</div>
	</div>
	<div class="popup-overlay"></div>
	
</BODY>
</HTML>
