<?php
session_start();
 require_once('db_ems.php');
 include('modules.php'); 
 $curyear = date("Y");
 ?>
<HTML>
<HEAD>



 <TITLE>Login to EMS</TITLE>
 <link href="logincss.css" type="text/css" rel="stylesheet"/>
  <link rel="stylesheet" type="text/css" href="cssstyle.css" />
   <link rel="stylesheet" type="text/css" href="jqueryslidemenu.css" />
   <script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="jqueryslidemenu.js"></script>
</HEAD>
<BODY style="background:#FFF;" >


 <script language="JavaScript">

function autoSubmit()
{
    var formObject = document.forms['theForm'];
    formObject.submit();
}

</script>

	<?php
	echo "<!--Logo Sapura--------------------------->";
	echo "<div style='background:url(images/sibbiruall.gif) repeat-X center;height:10%;'>
		<img src='images/sibbiru2.gif' height='100%;' >
			</div>";
	
	//echo "<div class='tophead'></div>";
	echo"<form method='POST' action='checkauth.php' > ";
	//echo "<div style='background:yellow;width:25%;'></div>";
	echo "<div style='background:#FFF;height:85%;width:50px;'>";	
	//echo "<div width='950px' align='center'><img src = 'images/header.png' width='750px' style='padding-top:50px;'></div>";
	echo "<table width='50%' border=0 style='position:absolute;left:25%;right:25%;top:20%;bottom:30%;padding:0px;background:#FFF;border-radius:5px;border:2px ridge #663333;font-size:15px;'>
		<tr>
			<td colspan=2 align='right'><img src = 'images/header.png' width='100%'></td>
		</tr>
		<tr>
			<td rowspan=6 width='30%'><img src = 'images/lock.jpg' height = '200px'></td>
			<td width='70%' style='font-size:26px;color:#FF8000;padding-left:45px;text-align:center;' >Equipment Management System</td>
		</tr>
		<tr height = '35px' style='line-height:40px;'>
			<td align='center' style='padding-left:40px;'>&nbsp;
			<input style='text-align:center;border:1px solid #DFDFDF;height:30px;' type='text' name='userid' class='username' placeholder='User ID' /></td></tr>
		<tr height = '35px' style='line-height:40px;'>
			<td align='center' style='padding-left:40px;'>&nbsp;
			<input type='password' name='password' class='password' style='text-align:center;border:1px solid #DFDFDF;height:30px;' placeholder='******' /></td></tr>
		
		<tr height = '35px' style='line-height:40px;'>
			<td align='center' style='padding-left:40px;'>&nbsp;
			<input type='submit' name='submit' class='submit' value='Sign In' style='width:222px'/></td></tr>
	
	</table>";
		
	echo "</div>";
	echo "<p style='color:#FF0000;font-size:12px;'>$_SESSION[msg]</p>";
	echo"</form>";
	//echo "<div style='background:yellow;width:25%;'></div>";
	echo "<div style='background:#CC0033;height:5%;text-align:center;'>
		<table width='100%' border=0 style='padding-top:7px;height:5%;font-size:13px;color:#FFF;text-align:center;font-family:Sapura;'>
			<tr style='vertical-align:middle;'><td>Copyright @ 2013 Sapura Industrial Berhad. All rights reserved.</td></tr></table>		
		</div>";
$today = date("Y-m-d");
/*
echo "<div align='center'>
	<table border='0' height = '30%' width='750px' align='center' style='border:1px solid #D8D8D8;border-radius:10px;padding:10px;background-color:#fff;'>";

echo "<tr><td></td></tr>";
echo "<tr><td style='text-align:center;font-size:25px;color:red;font-weight:bold;text-decoration:blink;'>Invalid ID or PASSWORD!!. <br />Please contact Pn Mahsurah Manan (HR) for your login info.<br /><a href ='index.php'>BACK TO MENU</a></td></tr>";
echo "<tr><td></td></tr>";

echo "</table></div>";
*/
//echo "</div>";	
?>


</BODY>
</HTML>
