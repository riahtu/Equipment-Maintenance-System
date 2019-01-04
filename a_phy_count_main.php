<!DOCTYPE html>
<html>
<head>
	<title>Page Title</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css" />
	<script type="text/javascript" src="jquery/js/jquery-1.7.1.min.js"></script>
	<script src="jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>
	
	 <script type="text/javascript" src="android.js"></script>
</head>
<body>

<div data-role="page">

	<div data-role="header">
	<div style='font-size:14px;color:#FF8000;text-align:center;font-family:arial;'>Sparepart Management System</div>
		<div style='font-size:12px;color:#804000;text-align:center;'>Physical Count</div>
	</div><!-- /header -->

	<div role="main" class="ui-content">
		<div id="main_content" style='font-size:12px;'>
		
	
		
			<label for="pc_refno" class="select">Enter Physical Count Reference no</label>
			<select id='pc_refno' name='pc_refno' style='font-size:11px;font-family:arial;height:30px;' data-native-menu="false" >   
			<?php
			require("db_ems.php");
			$resultrec = mysql_query("SELECT * FROM physical_count_header  order by countdate ");
			while($row11 = mysql_fetch_array($resultrec))
			{
			echo "<option value='$row11[pc_docno]'> $row11[pc_docno] </option>    ";
			}  
			echo "</select>  </td></tr> ";
			?>
			<!--
			<label for="pc_refno2" class="select">Enter Physical Count Reference no2</label>
			<select id='pc_refno2' name='pc_refno' style='font-size:11px;font-family:arial;height:30px;' data-native-menu="true" >   
			<?php /*
			require("db_ems.php");
			$resultrec = mysql_query("SELECT * FROM physical_count_header  order by countdate ");
			while($row11 = mysql_fetch_array($resultrec))
			{
			echo "<option value='$row11[pc_docno]'> $row11[pc_docno] </option>    ";
			}  
			echo "</select>  </td></tr> "; */
			?>
			-->
			<input id="pc_refno_next" value="Next" type="button">
			<div id="a_message"></div>
			
		</div>
	</div><!-- /content -->
</div><!-- /page -->

</body>
</html>
