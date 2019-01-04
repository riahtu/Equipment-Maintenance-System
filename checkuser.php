<?php
session_start();
$useragent = $_SERVER['HTTP_USER_AGENT'];
if(!isset($_SESSION[userid]) )
{
	if (ismobile($useragent)) 
	{
		session_unset();
		session_destroy();
		header("Location: login_android.php");
		exit;
	}
	else
	{
	
		session_unset();
		session_destroy();
		header("Location: login.php");
		exit;
	}

}

?>