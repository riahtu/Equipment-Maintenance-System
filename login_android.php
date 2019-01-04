<?php
session_start();
 require_once('db_ems.php');
 include('modules.php'); 
  $curyear = date("Y");
 ?>
<HTML>
<HEAD>



 <TITLE>Login to SIB Intranet</TITLE>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
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

	echo"<form method='POST' action='checkauth_android.php' > "; //<img src = 'images/intranet2.png' width = '150px'>
	//echo "<div style='background:yellow;width:25%;'></div>";
	echo "<div style='background:#FFF;height:90%;width:50px;top:0px;'>";	
	//echo "<div width='950px' align='center'><img src = 'images/header.png' width='750px' style='padding-top:50px;'></div>";
	echo "<table width='100%'  border=0 style='font-family:arial;position:absolute;left:0;right:0;top:0;bottom:0;padding:0px;background:#FFF;font-size:15px;'>
		<tr>
			<td style='line-height:20px;font-size:0.8em;font-weight:bold;color:#003366;' align='center'>Sapura Machining Corporation Sdn Bhd</td>
		</tr>
		<tr>
			<td style='line-height:20px;font-size:0.8em;font-weight:bold;color:#003366;' align='center'>Equipment Management System</td>
		</tr>
		<tr>
			<td align='center'><img src = 'images/lock.jpg' height = '80px'></td>
		</tr>
		<tr height = '45px'>
			<td align='center'>&nbsp;
			<input align='center' type='text' name='userid' class='username' placeholder='User ID' style='font-size:1.3em;color:#CC0033;' /></td></tr>
		<tr height = '45px'>
			<td align='center'>&nbsp;
			<input type='password' name='password' class='password' placeholder='******' style='font-size:1.3em;color:#CC0033;' /></td></tr>
		
		<tr >
			<td align='center'>&nbsp;
			<input type='submit' name='submit' class='submit' value='Sign In' style='width:65%;font-size:1.5em;' /></td></tr>
		
	</table>";
		
	
	echo "</div>";
	echo"</form>";
	//echo "<div style='background:yellow;width:25%;'></div>";
	
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
