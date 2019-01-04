<?php
session_start();
 include('modules.php');
 require_once('db_ems.php');
 
//    inc_rec1_save();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml2/DTD/xhtml1-strict.dtd">
<HEAD>
 <TITLE>Maintenance Upload</TITLE>
  <link rel="stylesheet" type="text/css" href="mystyle1.css" />
   <link rel="stylesheet" type="text/css" href="jqueryslidemenu.css" />
   <script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="jqueryslidemenu.js"></script>


 
</HEAD>
<BODY>




<div class="mrp1">
	<form enctype="multipart/form-data" action="import_sparepart.php" method="post">

		<div style='text-align:right;padding-right:20px;'>
     
			<table class='componentmain' cellpadding='0' cellspacing='0' border='0' width="100%" style="margin-left:30px;">
				<tr style="background-color:#C0C0C0" ><tr><td align="left" style="font-size:16px;color:#000000;padding-left:5px;font-weight:bold;height:40px;">Selection screen : Upload SMC Maintenance Data</td>
				<td style="padding-right:20px;"> <input name="next" type="image" src='images/next24g.png' width="24px" alt='Next' width='50px' value="next" ></td></tr>
			</table>
		</div>
	  
	  

	<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
	  <table width="600" border="0" style="text-align:left;margin-left:30px;margin-top:20px;">
	  <tr>
	  <td style="margin-top:30px;">Manual Maintenance File:</td>
	  <td><input type="file" name="file" size="100"/></td>            </tr>
		 
	 <td><input type="submit" value="Upload" style="margin-top:30px;" /></td>
	  </tr>
	  </table>
  </form>
</div>





</BODY>
</HTML>
