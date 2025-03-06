<?php
/**
 * @file
 * The PHP page that serves the user's detail as outputted by Drupal that can be 
 * accessed through JavaScript via SocialGO.
 */

require_once './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

//echo json_encode($user);

ksort($user->roles);

foreach ($user->roles as $iRoleId => $sRoleName){
	$iThisRoleId = $iRoleId;
}

$sReferer = (isset($_SERVER["HTTP_REFERER"])) ? $_SERVER["HTTP_REFERER"]:$_GET["q"]; // http://localhost/SIDELINE/POWERON/SOCIALGO/iframe.html?i=2
$aReferer = explode("?", $sReferer); // [0] => http://localhost/SIDELINE/POWERON/SOCIALGO/iframe.html, [1] => i=2

if (count($aReferer) == 2){
	$aQueryString = explode("=", $aReferer[1]); // [0] => i, [1] => 2
	
	if (count($aQueryString) != 2){
		header("Location: ".$aReferer[0].'?i='.$iThisRoleId);
	}elseif (count($aQueryString) == 2 && $aQueryString[1] != $iThisRoleId){
		header("Location: ".$aReferer[0].'?i='.$iThisRoleId);
	}
}else{
	header("Location: ".$aReferer[0].'?i='.$iThisRoleId);
}