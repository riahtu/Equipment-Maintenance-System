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
		<div style='font-size:12px;color:#804000;text-align:center;'>Sapura Machining Corporation Sdn Bhd</div>
	</div><!-- /header -->

	<div role="main" class="ui-content">
		<a href="a_phy_count_main.php" class="ui-btn ui-corner-all">Physical Count</a>
		<a href="#" class="ui-btn ui-corner-all">Sparepart Enquiry</a>
	</div><!-- /content -->

	<div data-role="footer">
		<h4></h4>
	</div><!-- /footer -->
</div><!-- /page -->
<script>
$(document).on('click', '#test',pc_refno_search);
function pc_refno_search()
{
	
	alert("test");
	
	
	
}
</script>
</body>
</html>
