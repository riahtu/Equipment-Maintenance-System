<?php
session_start();
 require_once('db_ems.php');
 include('modules.php'); 
 $curyear = date("Y");
 ?>
<HTML>
<HEAD>
 	<TITLE>Change Account Password</TITLE>
 	<link rel="stylesheet" type="text/css" href="mystyle.css" />
 	<link rel="stylesheet" type="text/css" href="cssstyle.css" />
 	<link rel="stylesheet" type="text/css" href="jqueryslidemenu.css" />
	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript" src="jqueryslidemenu.js"></script>
	<link type="text/css" href="jquery/css/ui-lightness/jquery-ui-1.8.17.custom.css" rel="stylesheet" />	
	<script type="text/javascript" src="jquery/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="jquery/js/jquery-ui-1.8.17.custom.min.js"></script>
	<link rel="stylesheet" href="jquery-ui-1.11.2.custom/jquery-ui.css">
	<script src="jquery-ui-1.11.2.custom/external/jquery/jquery.js"></script>
	<script src="jquery-ui-1.11.2.custom/jquery-ui.js"></script>
	  <script type="text/javascript" src="admin.js"></script>

</HEAD>
<BODY style="background:#FFF;" >

<script language="JavaScript">
$(document).ready(function(){
	$("form").submit(function(){
	var session = "<?php echo $_SESSION[userid]; ?>";
	var userid = $("#userid").val();
	var currPassword = $("#currPassword").val();
	var newPassword = $("#newPassword").val();
	var confPassword = $("#confPassword").val();
	//alert(confPassword);
	if(userid == ''){
		alert('User id is required');
		return false;
	}
	else if(session != userid){
		alert('Invalid User id');
		return false
	}
	else if(currPassword == ''){
		alert('Current password is required');
		return false;
	}
	else if(newPassword == ''){
		alert('New password is required');
		return false;
	}
	else if(currPassword == newPassword){
		alert('Invalid Password');
		return false;
	}
	else if(newPassword != confPassword){
		alert('Invalid Password')
		return false;
	}
	});
});
</script>

	<?php
	$userid = $_SESSION[userid];
	echo "<!--Logo Sapura--------------------------->";
	echo "<div style='background:url(images/sibbiruall.gif) repeat-X center;height:10%;'>
			<a href='index.php'>
			<img src='images/sibbiru2.gif' height='100%;' ></a>
		 </div>";

	echo"<form id='theForm' method='POST' action='changePassword.php'  > ";
	echo "<div style='background:#FFF;height:50%;width:50px;'>";	
	echo "<table width='50%'border=0 style='position:absolute;left:25%;right:25%;top:20%;bottom:30%;padding:0px;border-radius:5px;border:2px ridge #663333;font-size:15px;'>
		<tr>
			<td colspan=2 align='right'></td>
		</tr>
		<tr>
			<td width='35%';' ></td>
			<td  style='font-size:26px;color:#FF8000;text-align:left;padding-left:15px;' >Password Change</td>
		</tr>

		<tr height = '35px' style='line-height:40px;'>
			<td style='width:5px;text-align:right;'>Current Userid:</td>
			<td  style='padding-left:10px;'>&nbsp;
			<input style='text-align:center;border:1px solid #DFDFDF;height:30px;' id='userid' type='text' name='userid' class='username' placeholder='User ID' /></td></tr>

		<tr height = '35px' style='line-height:40px;'>
			<td style='width:5px; text-align:right;'>Current Password:</td>
			<td style='padding-left:10px;'>&nbsp;
			<input type='password' id='currPassword' name='currPassword' class='password' style='text-align:center;border:1px solid #DFDFDF;height:30px;' placeholder='******' /></td></tr>

		<tr height = '35px' style='line-height:40px;'>
			<td style='width:5px; text-align:right;'>New Password:</td>
			<td style='padding-left:10px;'>&nbsp;
			<input type='password' id='newPassword' name='newPassword' class='password' style='text-align:center;border:1px solid #DFDFDF;height:30px;' placeholder='******' /></td></tr>

		<tr height = '35px' style='line-height:40px;'>
			<td style='width:5px; text-align:right;'>Confirm Password:</td>
			<td style='padding-left:10px;'>&nbsp;
			<input type='password' id='confPassword' name='confPassword' class='password' style='text-align:center;border:1px solid #DFDFDF;height:30px;' placeholder='******' /></td></tr>

		<tr height = '35px' style='line-height:40px;'>
			<td style='width:5px; text-align:right;'></td>
			<td align='left' style='padding-left:40px;'>&nbsp;
			<input type='submit' name='submit' class='submit' value='Submit' style='width:80px;height:25px;' /></td></tr>


	</table>";	
	echo "</div>";
	echo "<p style='margin-left:450px;width:500px;color:#FF0000;font-size:18px;'>$_SESSION[alert]</p>";
	echo"</form>";
	echo "<p class='buttonCancel' id='buttonCancel'>Back to home</p>";
	echo "<div style='margin-top:170px;background:#CC0033;height:5%;text-align:center;'>
		<table width='100%' border=0 style='padding-top:7px;height:5%;font-size:13px;color:#FFF;text-align:center;font-family:Sapura;'>
			<tr style='vertical-align:middle;'><td>Copyright @ 2013 Sapura Industrial Berhad. All rights reserved.</td></tr></table>		
		</div>";
$today = date("Y-m-d");
$_SESSION[alert] = '';
?>


</BODY>
</HTML>
