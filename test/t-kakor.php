<?php

if(!isset($_COOKIE['cookies'])){
	// First time visitor
	// Get the user countrycode by ip
	if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	$geo = json_decode(file_get_contents('http://www.geoplugin.net/json.gp?ip='.$ip),True);
	$country_codesEU=['AT', 'BE', 'BG', 'HR', 'CY', 'CZ', 'DE', 'DK', 'EE', 'EL', 'ES', 'FI', 'FR', 'GB', 'HU', 'IE', 'IT', 'LT', 'LU', 'LV', 'MT', 'NL', 'PL', 'PT', 'RO', 'SE', 'SI', 'SK'];
    
    if ($geo['geoplugin_countryCode'] == Null || in_array($geo['geoplugin_countryCode'],$country_codesEU)){
		// User is in the EU or we do not know where he is from.
		// Ask for cookies consent, if within 15 minutes the user comes back, they accept
		$show_consent = True;	
		$cookies = ['consent'=>0,'analytic' => 0, 'ads' => 0];
		$cookies_string = json_encode($cookies);
		setcookie("cookies",$cookies_string,time() + (60*15),'/','mountcreo.com');
	}else{
		// The user is not in the EU, so we can set cookies
		$show_consent =  False;
		$cookies = ['consent'=>1,'analytic' => 1, 'ads' => 1];
		$cookies_string = json_encode($cookies);
		setcookie("cookies",$cookies_string,time() + (60*60*24*90),'/','mountcreo.com'); // Set cookie for 90 days
	}
}else{
	// We'll get the user preferences
    $show_consent = False; // Don't show the popup	
	$cookies = json_decode($_COOKIE['cookies'],True);

	// If consent == 'asking', the user continued on the website and has accepted
	if($cookies['consent']==0){
		$cookies = ['consent'=>1,'analytic' => 1, 'ads' => 1];
		$cookies_string = json_encode($cookies);
		setcookie("cookies",$cookies_string,time() + (60*60*24*90),'/','mountcreo.com'); // Set cookie for 90 days
		$page = $_GET['page']; // Or whatever you reference your pages with
		if($page == "cookies"){ // user's second visit is the cookies page
			$cookies = ['consent'=>1,'analytic' => 0, 'ads' => 0];
		}
	}	
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #close_cookie{display:none;}
	    #close_cookie:checked + #cookie_consent_popup{display:none;}	
        #cookie_consent_popup{
            position:fixed;
            bottom:30px;left:30px;
            width:400px;
            height:180px;
            background-color:#fbb63e;
            padding:20px;
            z-index:2;
        }
        #cookie_consent_popup h1{
            font-size:1.2em;
        }
		#cookie_consent_popup h1:before{
			content:"";
			padding:0;
		}
        #cookie_consent_popup p{
            font-size:0.7em;
        }
        #cookie_consent_popup #close_cookie_box{
            position:absolute;
            top:20px;right:20px;
            cursor:pointer;
            font-size:1.3em;
        }
        #cookie_consent_popup #ok_cookie_box{
            position:absolute;
            bottom:20px;right:20px;
            cursor:pointer;
            font-size:1.6em;
            padding:10px 20px;
            font-weight:700;
            color:white;
        }
    </style>
</head>
<body>
    <?php if($show_consent == True){ ?>
        <input type="checkbox" id="close_cookie"></input>
        <div id="cookie_consent_popup">
            <h1>Cookies</h1>
            <label for="close_cookie" id="close_cookie_box">X</label>
            <p>Mount CREO uses cookies to store preferences, analyse traffic and provide personalized ads. Read more about the used cookies and disable them on our <a href="cookies" title="Cookie Policy">Cookie page</a>. By clicking 'OK', 'X' or continuing using our site, you consent to the use of cookies unless you disabled them.<p>
            <label for="close_cookie" id="ok_cookie_box">OK</label>
        </div>
    <?php }?>
</body>
</html>