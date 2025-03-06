<?php
require_once "settings.php";

$sThisQuery = (isset($_REQUEST["q"])) ? $_REQUEST["q"]:"";

if (!isset($_REQUEST["q"]) || empty($sThisQuery)){
	exit('{"ERR_TYPE":100,"ERR_MSG":"Missing query."}');
}else{
	$oBank = new Bank($oConn, $oDrupalConn, $oJSON, $sThisQuery);
	$oBank->Execute();
}

/* 
$aThisQuery = array(
					"key" => "de4931a928077bd537c88903915beb60", 
					"pass" => "be87bd8999a6276faebe2ce6455bd3e6a96abef8",
					"module" => "register", 
					"vars" => array(
									"fname" => "Mars",
									"mname" => "Garin",
									"lname" => "Reyes",
									"dob" => "1979-04-27",
									"email" => "kakaiba@gmail.com"
								)
				);


if (isset($aThisQuery)){
	$sQueryJSON = $oJSON->encode($aThisQuery);

	$oBank = new Bank($oConn, $oJSON, $sQueryJSON);
	$oBank->Execute();
}else{
	exit('{"ERR_TYPE":100,"ERR_MSG":"Missing query."}');
}
*/
?>