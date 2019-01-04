<?php
$useragent = $_SERVER['HTTP_USER_AGENT'];
//echo "<p>useragent  :$useragent</p>";
if (ismobile($useragent)) {

			//echo"<p>3</p>";
			if (empty($_SESSION[userid]) )
			{
				//echo"<p>4</p>";
				header("Location: login_android.php");
			}
			else
			{
				//echo"<p>5</p>";
				 header("Location: index_android.php");
			}
        
    
} else {
	if (empty($_SESSION[userid]) )
	{
	//	echo"<p>6</p>";
//	header("Location: login.php");
	}
}



function ismobile() 
{
    $is_mobile = '0';
    if(preg_match('/(googlebot-mobile|android|ipad|up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|intermec)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
      // echo "<p>x1</p>";  
	$is_mobile=1;
    }
    if((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml')>0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
       // echo "<p>x1</p>";
	$is_mobile=1;
    }
    $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));    $mobile_agents = array('w3c ','acs-','alav','alca','amoi','andr','audi','avan','benq','bird','blac','blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno','ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-','maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-','newt','noki','oper','palm','pana','pant','phil','play','port','prox','qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar','sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-','tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp','wapr','webc','winw','winw','xda','xda-');

    if(in_array($mobile_ua,$mobile_agents)) {
      // echo "<p>x1</p>";
	$is_mobile=1;
    }
    if (isset($_SERVER['ALL_HTTP'])) {
        if (strpos(strtolower($_SERVER['ALL_HTTP']),'OperaMini')>0) {
         // echo "<p>x1</p>";  
		$is_mobile=1;
        }
    }
    if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows')>0) {
      //  echo "<p>x1</p>";
	$is_mobile=0;
    }

    return $is_mobile;
}



function isiphone($useragent) 
{
    $iphone=0;
    if (preg_match('/iphone/',strtolower($useragent))) {
        $iphone=1;
    }
    return $iphone;
}


function isipad($useragent) 
{
    $ipad=0;
    if (preg_match('/ipad/',strtolower($useragent))) {
        $ipad=1;
    }
    return $ipad;

}


?>
