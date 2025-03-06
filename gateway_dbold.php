<?php
/**
 * @file
 * Serves the list of children to the Offline Access Database
 * Can sync down (Drupal to Access) and sync up (Access to Drupal)
 * 
 * @argument
 * This is a JSON encoded array
 *		key		string
 *		pass	string
 *		module	string
 *		vars	array
 *
 		array(
			"key" => "de4931a928077bd537c88903915beb60", 
			"pass" => "be87bd8999a6276faebe2ce6455bd3e6a96abef8",
			"module" => "sync_down",
			"vars" => array()
		);
 */

require_once './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);


function _gateway_sql_error($sInputMethod, $sInputSQL){
	$sErrMsg = array(
					"STATUS" => "Error", 
					"METHOD" => $sInputMethod, 
					"ERR_TYPE" => 3306, 
					"ERR_MSG" => "There's an error in the SQL Statement.",
					"SQL" => $sInputSQL
				);
	
	exit(json_encode($sErrMsg));
}

$sThisQuery = (isset($_REQUEST["q"])) ? $_REQUEST["q"]:"";

if ($sThisQuery != ""){
	$aQuery = json_decode($sThisQuery, true);
	$sReturn = "";
	$aProfileKey	= array(1,2,3,4,5,6,7,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44);
	$aVarsKey 		= array(1,2,3,4,5,6,7,8,13,14,15,17,18,19,16,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47);
	
	switch ($aQuery["module"]){
		// Drupal to MS Access
		case "sync_down":
			$iNow = time();
			$aChildren = array();
			
			$sqlUsers = "SELECT A.status, A.uid, A.name, A.pass, A.mail, B.value, C.account_number, A.local_id
						FROM {profile_users_test} A 
						INNER JOIN {profile_values_test} B ON B.uid = A.uid 
						INNER JOIN {bank_users} C on C.uid = A.uid 
						WHERE A.uid > 1 
							AND B.fid = 5";
			
			$sqlDetails = "SELECT fid, uid, value 
							FROM profile_values_test 
							WHERE uid = %d 
								AND fid IN (".implode(",", $aProfileKey).") 
							ORDER BY uid, fid";
			
			$oUsers = db_query($sqlUsers);
			
			while ($oUser = db_fetch_object($oUsers)){
				$sPass = variable_get("pass_unmasked_".$oUser->name, $oUser->pass);
				$oDOB = $oUser->value;
				
				// Fix to let Drupal's serialize() understand PHP's serialize()
				if (substr($oDOB, 4, 1) != "{"){
					$sPart1 = substr($oDOB, 0, 4);
					$sPart2 = substr($oDOB, 4, strlen($oDOB));
					
					$oDOB = $sPart1."{".$sPart2."}";
				}
				
				$aDOB = unserialize($oDOB);
				$dDOB = $aDOB["year"]."-".str_pad($aDOB["month"], 2, 0, STR_PAD_LEFT)."-".str_pad($aDOB["day"], 2, 0, STR_PAD_LEFT);
				
				$iDOB = mktime(0, 0, 0, $aDOB["month"], $aDOB["day"], $aDOB["year"]);
				$iAge = floor(($iNow  - $iDOB) / (60*60*24*365));
				
				if ($iAge <= 12){
					$iUID = $oUser->uid;
					$aTemp1 = array($oUser->status, $iUID, $oUser->name, $sPass, $oUser->mail, $dDOB);
					$aTemp2 = array();
					$oDetails = db_query($sqlDetails, $iUID);
					
					while ($oDetail = db_fetch_object($oDetails)){
						if ($oDetail->fid == 5) continue;
						
						$aTemp2[] = ($oDetail->value == "") ? "0":$oDetail->value;
					}
					
					$aChildProfile = array_pad(array_merge($aTemp1, $aTemp2), 48, "0");
					$aChildProfile = array_merge($aChildProfile, array($oUser->account_number));
					$aChildProfile[38] = "1";
					$aChildProfile[100] = $oUser->local_id;
					
					$aChildren[] = $aChildProfile;
					
				}
			}
			
			$sReturn = array("STATUS" => "Success", "RETURN" => $aChildren);
			
			break;
		case "insert_user":
			$aVars = $aQuery["vars"];
			$iDrupalId = $aVars[0];
			$sLastName = ucwords($aVars[1]);
			$sFirstName = ucwords($aVars[2]);
			$sAddress = $aVars[3];
			$sGender = $aVars[4];
			$sUserName = $aVars[9];
			$sEmail = $aVars[10];
			$sPass = $aVars[11];
			$iMsAccessId = $aVars[48];
			$bProcess = $aVars[49];
			
			$iInsertCount = 0;
			$iUpdateCount = 0;
			
			$sqlInDB = "SELECT COUNT(uid) AS iRowCount FROM {profile_users_test} WHERE uid > 0 AND uid = %d";
			$oInDB = db_query($sqlInDB, $iDrupalId);
			$bInDB = (db_fetch_object($oInDB)->iRowCount == 1) ? true:false;
			
			$aDOB = explode("-", trim(str_replace("00:00:00", "", $aVars[5])));
			$aVars[5] = serialize(array("month" => $aDOB[1], "day" => $aDOB[2], "year" => $aDOB[0]));
			
			// Fix for some serialized date array in drupal
			if (substr($aVars[5], 4, 1) != "{"){
				$sPart1 = substr($aVars[5], 0, 4);
				$sPart2 = substr($aVars[5], 4, strlen($aVars[5]));
				
				$aVars[5] = $sPart1."{".$sPart2."}";
			}
			
			if (strlen($sPass) < 32) variable_set("pass_unmasked_".$sUserName, $sPass);
			
			if ($bProcess) {
				$sqlInsertUser = "INSERT INTO {profile_users_test} 
									VALUES(
										NULL,
										'".$sUserName."',
										MD5('".$sPass."'),
										'".$sEmail."',
										0,
										0,
										0,
										'',
										'',
										UNIX_TIMESTAMP(),
										0,
										0,
										".$aVars[12].",
										'28800',
										'',
										'',
										'".$sEmail."',
										NULL,
										0,
										0
									)";
				
				if (!db_query($sqlInsertUser)){
					_gateway_sql_error("Insert", $sqlInsertUser);
				}else{
					$iDrupalId = db_last_insert_id("profile_users_test", "uid");
					
					$sqlInsertProfile = "INSERT INTO {profile_values_test} VALUES";
					
					for ($x=0; $x<count($aProfileKey); $x++){
						$sqlInsertProfile .= ($x > 0) ? ",":"";
						if ($x == 4){
							$sqlInsertProfile .= "(".$aProfileKey[$x].", ".$iDrupalId.", '%s')";
							$sArgument = $aVars[$aVarsKey[$x]];
						}else{
							$sqlInsertProfile .= "(".$aProfileKey[$x].", ".$iDrupalId.", '".$aVars[$aVarsKey[$x]]."')";
						}
					}
					
					if (!db_query($sqlInsertProfile, $sArgument)){
						_gateway_sql_error("Insert", $sqlInsertProfile);
					}else{
						$dDOB = $aDOB["year"]."-".str_pad($aDOB["month"], 2, "0", STR_PAD_LEFT)."-".str_pad($aDOB["day"], 2, "0", STR_PAD_LEFT);
						
						$aVarFields = array(
											"fname" => $sFirstName, 
											"mname" => "", 
											"lname" => $sLastName, 
											"dob" => $dDOB, 
											"email" => $sEmail
										);
						
						$aBankReply = _bank_post("register", $aVarFields);
						
						if ($aBankReply["STATUS"] == "Success"){
							/*$sqlBankInsert = "INSERT INTO {bank_users} 
												VALUES(
													NULL, 
													".$iDrupalId.",
													'".$aBankReply["RETURN"]["ACCT"]."',
													'".$aBankReply["RETURN"]["PASS"]."',
													'".date("Y-m-d H:i:s")."'
												)";
							 
							if (!db_query($sqlBankInsert)) _gateway_sql_error("Insert", $sqlBankInsert);*/ 
						}
						
						/*db_set_active('moodle');
						
						$sqlMoodle = "INSERT INTO {mdl_user} 
										VALUES(
											NULL, 
											'manual', 
											1,
											0, 
											0, 
											1, 
											'".$sUserName."', 
											MD5('".$sPass."'), 
											'".$iDrupalId."', 
											'".$sFirstName."', 
											'".$sLastName."', 
											'".$sEmail."', 
											0, 
											'', 
											'', 
											'', 
											'', 
											'', 
											'', 
											'', 
											'', 
											'', 
											'".$sAddress."', 
											'', 
											'', 
											'en_utf8', 
											'', 
											'0.0', 
											0, 
											0, 
											0, 
											0, 
											'', 
											'', 
											0, 
											'', 
											NULL, 
											1, 
											0, 
											0, 
											1, 
											1, 
											1, 
											0, 
											0, 
											0, 
											NULL, 
											0
										)";
						
						if (!db_query($sqlMoodle)) _gateway_sql_error("Insert", $sqlMoodle);

						db_set_active('default');
						*/
						// --BEGIN SocialGO
						/*
						$iGender = ($sGender == "Male") ? 1:0;
						
						$sVarFields = "id=NULL" .
										"&email=".urlencode($sEmail) .
										"&password=".urlencode($sPass) .
										"&nickname=".urlencode($sUserName) .
										"&strapline=".urlencode("user created from http://www.firsthopecorps.org.") .
										"&name=".urlencode($sFirstName) .
										"&surname=Hope" .
										"&gender=".urlencode($iGender) .
										"&dob=".urlencode($dDOB) .
										"&avatar=http://static.socialgo.com/cache/2/thumb/711.jpg" .
										"&active=1";
						
						$oCreate = _socialgo_post("user/make", $sVarFields);
						*/
						// --END SocialGO
						
						// --BEGIN OsCommerce
						$sGender1 = ($sGender == "Male") ? "m":"f";
						$dDOB = str_pad($aDOB["month"], 2, "0", STR_PAD_LEFT)."/".str_pad($aDOB["day"], 2, "0", STR_PAD_LEFT)."/".$aDOB["year"];
						
						$sPostFields = "key=bXlnaXptb3oubmluZy5jb20/eWVz" .
										"&action=process" .
										"&gender=".$sGender1 .
										"&firstname=".$sFirstName .
										"&lastname=".$sLastName .
										"&dob=".$dDOB .
										"&email_address=".$sEmail .
										"&company=" .
										"&street_address=".$sAddress .
										"&suburb=" .
										"&postcode=1207" .
										"&city=Makati City" .
										"&state=NCR" .
										"&country=168" .
										"&ning=".$iDrupalId .
										"&telephone=+6328970471" .
										"&fax=" .
										"&newsletter=1" .
										"&password=".$sPass .
										"&confirmation=".$sPass;
						
						// $iCustCount = (int) _oscommerce_post("verify", "q=".$sEmail);
						// $sResponse = ($iCustCount == 1) ? "":_oscommerce_post("create", $sPostFields);
						$sStoreReply = _oscommerce_post("create", $sPostFields);
						// --END OsCommerce
						
						// Point System for Registration
						userpoints_userpointsapi(array("uid" => $iDrupalId, "tid" => 194));
					}
				}
			}
			$aReturnMsg = array("METHOD" => "Insert", "ID" => $iDrupalId, "STORE" => $sPostFields);
			$sReturn = array("STATUS" => "Success", "RETURN" => $aReturnMsg);
			break;
		case "update_local_id":
			$aVars = $aQuery["vars"];
			db_query("UPDATE profile_users_test SET local_id = '" . $aVars[1] . "' WHERE uid = '" . $aVars[0] . "'");
			$sReturn = array("STATUS" => "Success", "RETURN" => "");
			break;
		case "delete_user":
			$iDrupalId = $aQuery["vars"][0];
			$iMsAccessId = $aQuery["vars"][1];
			if (!empty($iDrupalId) && $iDrupalId != 0 && !empty($iMsAccessId) && $iMsAccessId != 0) {
				db_query("DELETE FROM profile_users_test WHERE uid = '" . $iDrupalId . "' AND local_id = '" . $iMsAccessId . "'");
				db_query("DELETE FROM profile_values_test WHERE uid = '" . $iDrupalId . "'");
				db_query("DELETE FROM bank_users WHERE uid = '" . $iDrupalId . "'");
				//db_set_active('moodle');
				//db_query("DELETE FROM mdl_user WHERE idnumber = '" . $iDrupalId . "'");
			}
			$sReturn = array("STATUS" => "Success", "RETURN" => "");
			break;
		// MS Access to Drupal
		case "sync_up":
			$aVars = $aQuery["vars"];
			$iDrupalId = $aVars[0];
			$sLastName = ucwords($aVars[1]);
			$sFirstName = ucwords($aVars[2]);
			$sAddress = $aVars[3];
			$sGender = $aVars[4];
			$sUserName = $aVars[9];
			$sEmail = $aVars[10];
			$sPass = $aVars[11];
			$iMsAccessId = $aVars[48];
			$bProcess = $aVars[49];
			
			$iInsertCount = 0;
			$iUpdateCount = 0;
			
			$sqlInDB = "SELECT COUNT(uid) AS iRowCount FROM {profile_users_test} WHERE uid > 0 AND uid = %d";
			$oInDB = db_query($sqlInDB, $iDrupalId);
			$bInDB = (db_fetch_object($oInDB)->iRowCount == 1) ? true:false;
			
			$aDOB = explode("-", trim(str_replace("00:00:00", "", $aVars[5])));
			$aVars[5] = serialize(array("month" => $aDOB[1], "day" => $aDOB[2], "year" => $aDOB[0]));
			
			// Fix for some serialized date array in drupal
			if (substr($aVars[5], 4, 1) != "{"){
				$sPart1 = substr($aVars[5], 0, 4);
				$sPart2 = substr($aVars[5], 4, strlen($aVars[5]));
				
				$aVars[5] = $sPart1."{".$sPart2."}";
			}
			
			if (strlen($sPass) < 32) variable_set("pass_unmasked_".$sUserName, $sPass);
			
			if ($bInDB){
				$sqlUpdateUser = "UPDATE {profile_users_test} SET ";
				$sqlUpdateUser .= (strlen($sPass) < 32) ? "pass = MD5('".$sPass."'), ":"";
				$sqlUpdateUser .= "mail = '".$sEmail."', status = ".$aVars[12].", init = '".$sEmail."', local_id='".$iMsAccessId."' WHERE uid = %d";
				
				if (!db_query($sqlUpdateUser, $iDrupalId)){
					_gateway_sql_error("Update", $sqlUpdateUser);
				}else{
					for ($x=0; $x<count($aProfileKey); $x++){
						$sqlUpdateProfile = "UPDATE {profile_values_test} SET value = '%s' WHERE fid = %d AND uid = %d";
						$sqlInsertProfile = "INSERT INTO {profile_values_test} (value, fid, uid) VALUES('%s', %d, %d)";
						
						$sqlInProfile = "SELECT COUNT(uid) AS iRowCount FROM {profile_values_test} WHERE fid = %d AND uid = %d";
						$oInProfile = db_query($sqlInProfile, $aProfileKey[$x], $iDrupalId);
						$bInProfile = (db_fetch_object($oInProfile)->iRowCount == 1) ? true:false;
						
						$sqlToExec = ($bInProfile) ? $sqlUpdateProfile:$sqlInsertProfile;
						
						if (!db_query($sqlToExec, $aVars[$aVarsKey[$x]], $aProfileKey[$x], $iDrupalId)){
							_gateway_sql_error("Update", $sqlToExec);
						}
					}
					/*
					db_set_active('moodle');
					
					$sqlMoodle = "UPDATE {mdl_user} SET ";
					$sqlMoodle .= (strlen($sPass) < 32) ? "password = MD5('".$sPass."'), ":"";
					$sqlMoodle .= "firstname = '".$sFirstName."', lastname = '".$sLastName."', email = '".$sEmail."', address = '".$sAddress."' WHERE idnumber = '".$iDrupalId."'";
					
					if (!db_query($sqlMoodle)){
						_gateway_sql_error("Update", $sqlMoodle);
					}else{
						// --BEGIN OsCommerce
						/*db_set_active('oscommerce');
						
						$dDOB = $aDOB["year"]."-".str_pad($aDOB["month"], 2, "0", STR_PAD_LEFT)."-".str_pad($aDOB["day"], 2, "0", STR_PAD_LEFT);
						$sSalt = substr(md5($sPass), 0, 2);
						$sPass = md5($sSalt.$sPass).":".$sSalt;
						
						$sqlUpdateUser = "UPDATE {customers} 
											SET customers_gender = '".$sGender."',
												customers_firstname = '".$sFirstName."',
												customers_lastname = '".$sLastName."',
												customers_dob = '".$dDOB."',
												customers_email_address = '".$sEmail."',
												customers_password = '".$sPass."' 
											WHERE customers_id = %d";
						$sqlUpdateAddr = "UPDATE {address_book} 
											SET entry_gender = '".$sGender."',
												entry_firstname = '".$sFirstName."',
												entry_lastname = '".$sLastName."',
												entry_street_address = '".$sAddress."' 
											WHERE customers_id = %d";
						
						db_query($sqlUpdateUser, $iDrupalId);
						db_query($sqlUpdateAddr, $iDrupalId);
						// --END OsCommerce
						
						db_set_active('default');*/
						
						// --BEGIN SocialGO
						/*
						$iGender = ($sGender == "Male") ? 1:0;
						$oGet = _socialgo_post("user/get", "id=".$sEmail."&fields=All");
						$iSocialGoId = $oGet->result->id;
						
						$sqlPicture = "SELECT picture FROM {users} WHERE uid = %d";
						$oPicture = db_query($sqlPicture, $iDrupalId);
						$sPicture = db_fetch_object($oPicture)->picture;
						
						$sVarFields = "id=".$iSocialGoId .
										"&name=".urlencode($sFirstName) .
										"&gender=".urlencode($iGender) .
										"&dob=".urlencode($dDOB) .
										"&avatar=".urlencode("http://www.firsthopecorps.org/".$sPicture);
						$sVarFields .= (strlen($sPass) < 32) ? "&password=".urlencode($sPass):"";
						
						$oUpdate = _socialgo_post("user/update", $sVarFields);
						*/
						// --END SocialGO
					//}
				}
				
				$aReturnMsg = array("METHOD" => "Update");
			}else{
				if (!empty($iDrupalId) && $iDrupalId != 0) {
					$aReturnMsg = array("METHOD" => "Delete", "ID" => $iDrupalId);
				} else {
					$aReturnMsg = array("METHOD" => "Insert", "ID" => $iDrupalId, "STORE" => "");
				}
			}
			$sReturn = array("STATUS" => "Success", "RETURN" => $aReturnMsg);
			
			break;
	}
	
	if ($sReturn == "") $sReturn = array("STATUS" => "Error", "ERR_TYPE" => 400, "ERR_MSG" => "No results where returned.");
	
	// echo "<pre>";
	// print_r($sReturn);
	echo json_encode($sReturn);
	// echo serialize($aChildren);
	// echo "</pre>";
}else{
	exit('{"STATUS":"Error","ERR_TYPE":100,"ERR_MSG":"Missing query."}');
}
