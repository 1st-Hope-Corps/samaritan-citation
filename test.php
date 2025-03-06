<?php
require_once './includes/bootstrap.inc';

drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

include 'sites/all/modules/urllogin/urllogin_security.inc';

// -- BEGIN Destroy existing sessions
// Destroy the current session:
session_destroy();

// Only variables can be passed by reference workaround.
$null = NULL;
user_module_invoke('logout', $null, $user);

// Load the anonymous user
$user = drupal_anonymous_user();
// -- END Destroy existing sessions


// -- BEGIN Facebook App
$app_id = "636255993085643";
$app_secret = '20e405b52005d5c36b28088c1a8438e5';
$signed_request = $_POST["signed_request"];

variable_set('fbapp_id', $app_id);

list($encoded_sig, $payload) = explode('.', $signed_request, 2); 
$data = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);

$canvas_page = 'https://apps.facebook.com/instantmentoring/';
$auth_url = "https://www.facebook.com/dialog/oauth?client_id=" . $app_id . "&redirect_uri=" . urlencode($canvas_page) . "&scope=email";

echo '<pre>';
print_r($data);
echo '</pre>';

exit;

if (empty($data["user_id"])) {
	echo "<script>top.location.href='" . $auth_url . "';</script>";
} else {
	/* echo '<pre>';
	print_r($data);
	echo '</pre>'; */
	
	$fb_id = $data['user_id'];
	$drupal_id = fboauth_uid_load($fb_id);
	//$userloginid = db_result(db_query("select uid from {fboauth_users} where fbid = '".$fbid."'")); 
	
	if ($drupal_id){
		$user_result = db_query("select name, status from {users} where uid = '".$drupal_id."'"); 
		$db_user_result = db_fetch_object($user_result);
		
		$usercheckstatus = $db_user_result->status;
		$username = $db_user_result->name;
		
		if ($usercheckstatus == '1'){
			$aUserParam = array("name" => $username, "pass" => 'default', "facebook_user" => true);
			$oUser = user_authenticate($aUserParam);
			
			if (is_object($oUser)){
				$sCodeKey = variable_get('urllogin_codekey', 0);
				$sLoginKey = urllogin_encode($oUser->uid, $sCodeKey, urllogin_passphrase());
				
				//header('location: l/'.$sLoginKey.'/mystudies/getinvolved/volunteer');
				
				echo "<script>self.location.href='https://www.samaritancitation.com/l/".$sLoginKey."/mystudies/getinvolved/volunteer';</script>";
				//echo "<script>self.location.href='https://www.samaritancitation.com/mystudies/getinvolved/volunteer?fbid=".$fb_id."';</script>";
				exit;
			}else{
				echo 'Something went wrong.';
				
				echo '<pre>';
				print_r($aUserParam);
				echo '</pre>';
				
				echo '<pre>';
				print_r($oUser);
				echo '</pre>';
				
				exit;
			}
		}else{
			echo 'Your account has not been approved by the administrator, yet. Please wait for the approval.';
			exit;
		}
	}
	
	$db_fbid = db_result(db_query("select fbid from {fboauth_users} where fbid = '".$fb_id."'")); 
	
	if (empty($db_fbid)){
		// Delete the existing Facebook ID if present for this Drupal user.
		$delete_query = 'DELETE FROM {fboauth_users} WHERE uid = %d';
		$delete_arguments = array($drupal_id);

		// If setting a new Facebook ID for an account, also make sure no other
		// Drupal account is connected with this Facebook ID.
		if (isset($fb_id)) {
			$delete_query .= ' OR fbid = %d';
			$delete_arguments[] = $fb_id;
		}

		db_query($delete_query, $delete_arguments);
		
		
		$randid = mt_rand();
		$sUserName = $randid.'default';
		$sPass = 'default';
		$sEmail = $randid.'default@mail.com';
		
		db_query("INSERT INTO {users} 
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
									'0',
									'28800',
									'',
									'sites/default/files/pictures/none.png',
									'".$sEmail."',
									NULL,
									0,
									0,
									'5'
								)");
		
		$uid = db_result(db_query("select uid from {users} where mail = '".$sEmail."'"));
		
		db_query('INSERT INTO {fboauth_users} (uid, fbid) VALUES (%d, %d)', $uid, $fb_id);
		db_query("INSERT INTO {users_roles} (uid, rid) VALUES ('{$uid}', '2')");
		
		echo "<script>location.href='https://www.samaritancitation.com/?q=fboauth/fbchangeinfo/".$uid."';</script>";
	}/* else {
		//$db_uid = db_result(db_query("select uid from {fboauth_users} where fbid = '".$fbid."'")); 
		$pass = db_result(db_query("select pass from {users} where uid = '".$drupal_id."'"));
		
		if ($pass == 'c21f969b5f03d33d43e04f8f136e7682'){
			echo "<script>location.href='https://www.samaritancitation.com/?q=fboauth/fbchangeinfo/".$drupal_id."';</script>";
		} else{
			echo "<script>self.location.href='https://www.samaritancitation.com/mystudies/getinvolved/volunteer?fbid=';</script>";
			//echo "2 ## https://www.samaritancitation.com/mystudies/getinvolved/volunteer?fbid='".$db_fbid;
		}
	}*/
}
// -- END Facebook App
?>