<?php
require_once './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);


$sUsername = (isset($_GET["q"]) && $_GET["q"] != "") ? base64_decode($_GET["q"]):"";
$sqlAccount = "SELECT A.uid, A.account_number, A.account_pass
				FROM bank_users A
				INNER JOIN users B ON B.uid = A.uid
				WHERE B.name = '%s';";

$oAccountResult = db_query($sqlAccount, $sUsername);
$oDetails = db_fetch_object($oAccountResult);
$aReqParam = array(
				"key" => $oDetails->account_number, 
				"pass" => $oDetails->account_pass
			);

$aBankReply = _bank_post("community", $aReqParam);

if ($aBankReply["STATUS"] == "Success"){
	$aRecord = $aBankReply["RETURN"];
	$iRecordCount = count($aRecord);
	
	if ($iRecordCount > 0){
		$iHours = 0;
		$iMinutes = 0;
		
		for ($i=0; $i<$iRecordCount; $i++){
			$aTime = explode(":", $aRecord[$i]["sCommmunityTime"]);
			$iHours += (int)$aTime[0];
			$iMinutes += (int)$aTime[1];
		}
		
		$iMinsToDec = $iMinutes / 60;
		
		echo '<div style="position:absolute; top:0; left:0; margin:0; padding:0; font-family:arial; font-size:0.8em; color:#4F4F4F;"><u>'.number_format($iHours + $iMinsToDec, 2).'</u> hours</div>';
	}else{
		echo '<div style="position:absolute; top:0; left:0; margin:0; padding:0; font-family:arial; font-size:0.8em; color:#4F4F4F;"><u>0.00</u> hours</div>';
	}
}