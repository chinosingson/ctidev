<?php

require_once("../../assets/UserFrosting/models/config.php");

// Request method: GET
$ajax = checkRequestMode("get");

/*if (!securePage(__FILE__)){
    apiReturnError($ajax);
}*/

setReferralPage(getAbsoluteDocumentPath(__FILE__));

//Log the user out
echo isUserLoggedIn();
if(isUserLoggedIn())
{
	$loggedInUser->userLogOut();
	return true;
} //else {
	//echo "<pre>";
	//echo print_r($_SESSION,1)."<br/>";
	//echo print_r($loggedInUser,1);
	//echo "</pre>";
	//return false;
//}
//echo "__FILE__ ".__FILE__."<br/>";
//echo "SITE_ROOT ".SITE_ROOT."<br/>";

// Forward to index root page
//header("Location: " . SITE_ROOT);
//header("Location: http://localhost/ctidev/bootleaf1/");
//header("Refresh: 0");
//die();

?>