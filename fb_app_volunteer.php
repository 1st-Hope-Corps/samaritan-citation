<?php
/*
 @filename		fb_app_volunteer.php
 @date			20131021 1010
 
 @dependencies	facebook-php-sdk
				urllogin module
				
 */

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


require_once 'fb_app_files/facebook.php';

// Facebook app settings
$fb_iAppId				= '636255993085643';
$fb_sAppSecret		= '20e405b52005d5c36b28088c1a8438e5';
$fb_sCanvasURL		= 'https://apps.facebook.com/vmentoring/';


$drupal_sPath		= $base_url;
$drupal_sCodeKeyNew	= date('Ymd', mktime(0, 0, 0, date('m'), date('d')+1, date('Y')));
$drupal_sCodeKey	= $drupal_sCodeKeyNew;
$drupal_sCodeMinNew	= date('Ymd', mktime(0, 0, 0, date('m'), date('d'), date('Y')-20));
$drupal_sCodeMin	= $drupal_sCodeMinNew;

variable_set('fbapp_id', $fb_iAppId);
variable_set('urllogin_codekey', $drupal_sCodeKey);
variable_set('urllogin_codemin', $drupal_sCodeMin);

// Paths and URLs to various pages
$sAuthURL	= "https://www.facebook.com/dialog/oauth?client_id=" . $fb_iAppId . "&redirect_uri=" . urlencode($fb_sCanvasURL) . "&scope=email";
$drupal_sLandingPageAnonymous = 'instant/mentor/fb/welcome/';
$drupal_sLandingPage = 'instant/mentor/dashboard/';
$drupal_sChangeInfoURL = $drupal_sPath . '/?q=fboauth/fbchangeinfo/';


function fb_app_display_page ( $path ) {
	menu_set_active_item( $path );
	$sOutput = menu_execute_active_handler();
	print theme( 'page', $sOutput );
}

$aFbConfig = array();
$aFbConfig['appId']			= $fb_iAppId;
$aFbConfig['secret']		= $fb_sAppSecret;
$aFbConfig['fileUpload']	= false; // optional

// Initiate the Facebook class
$oFacebook = new Facebook($aFbConfig);

// Get the current signed request being used by the SDK.
// A concatenation of a HMAC SHA-256 signature string, a period (.), and a base64url encoded JSON object
$sSignedRequest = $oFacebook->getSignedRequest();

if ($sSignedRequest != '') {
	// We know we're running in a Facebook app
	
	// Get User ID
	$iUserId = $oFacebook->getUser();

	if ($iUserId) {
		// Proceed knowing you have a logged in user who's authenticated.
		try {
			$oUserProfile = $oFacebook->api('/me');
			
			/* echo '<pre>';
			print_r($oUserProfile);
			echo '</pre>'; */
			
			$fb_id = $oUserProfile['id'];
			$fb_sUserName = $oUserProfile['username'];
			$fb_sEmail = $oUserProfile['email'];
			
			//$drupal_id = fboauth_uid_load($fb_id);
			
			$drupal_sqlCheck = "SELECT B.uid
								FROM {fboauth_users} A
								INNER JOIN {users} B ON B.uid = A.uid
								WHERE A.fbid = '%s'";
			
			$drupal_CheckResult = db_query($drupal_sqlCheck, $fb_id);
			$drupal_id = db_result($drupal_CheckResult);
			$drupal_id = ($drupal_id) ? (int)$drupal_id:false;
			
			/* echo '<pre>';
			print_r($fb_id);
			echo '</pre>'; */
			
			/* echo '<pre>';
			print_r($drupal_id);
			echo '</pre>'; */
			
			if ($drupal_id){
				// Found a matching Drupal user
				
				$oUserResult = db_query("select name, status from {users} where uid = '".$drupal_id."'"); 
				$oUser = db_fetch_object($oUserResult);
				
				$drupal_sUserStatus = $oUser->status;
				$drupal_sUsername = $oUser->name;
				
				/* echo '<pre>';
				print_r($oUser);
				echo '</pre>'; */
				
				//exit;
				
				if ($drupal_sUserStatus == '1'){
					// User has been approved by admin

					$drupal_aUserParam = array("name" => $drupal_sUsername, "pass" => 'default', "facebook_user" => true);
					$drupal_oUser = user_authenticate($drupal_aUserParam);

					if (is_object($oUser)){
						$drupal_sLoginKey = urllogin_encode($drupal_id, $drupal_sCodeKey, urllogin_passphrase());
						$drupal_sRedirectTo = $drupal_sLandingPage;
						?>
						<script>
						self.location.href = '<?php echo $drupal_sPath ?>/l/<?php echo $drupal_sLoginKey ?>/<?php echo $drupal_sRedirectTo ?>';
						</script>
						<?php
						exit;
					}else{
						echo 'Something went wrong.';
						
						echo '<pre>';
						print_r($drupal_aUserParam);
						echo '</pre>';
						
						echo '<pre>';
						print_r($drupal_oUser);
						echo '</pre>';
						
						exit;
					}
				}else{
					$drupal_sNotice = 'Your account has not been approved by the administrator, yet. Please wait for the approval.';
					echo $styles;
					?>
					<html>
					<head>
						<link type="text/css" rel="stylesheet" media="all" href="<?php echo $drupal_sPath ?>/themes/theme2010/style.css" />
					</head>
					<body id="body">
						<div class="min-width">
							<div id="main">
								<div id="mainpage" style="top:50px !important;">
									<div id="cbrect">
										<div class="cb">
											<div class="bt">
												<div></div>
											</div>
											<div class="i1">
												<div class="i2">
													<div class="i3">
														<div class="left-border">
															<div class="right-border">
																<table width="980" cellspacing="0" cellpadding="2" border="0">
																  <tbody><tr>
																	<td width="310" valign="top" align="center">
																		<img border="0" src="<?php echo $drupal_sPath ?>/themes/theme2010/images/gi_volunteer_standout.jpg">
																	</td>
																	<td valign="top">
																		<br><h4>HopeNet Volunteers <span style="color:#33CC00">Standout From the Crowd</span></h4><br>
																		HopeNet Volunteers are a dedicated group of Global Citizens who have made the decision to spend some of their free time helping HopeNet and the Hopefuls. HopeNet has many different ways that students and adults can become involved as an Online-Volunteer. We have volunteer positions available that can, virtually fit any schedule regardless of whether the person has only 20 minutes or 2 hours a day available. HopeNet is recruiting Knowledge Portal, eTutors, eMentors, Monitors, and Advocate Volunteers. 												</td>
																  </tr>
																</tbody></table>
															</div>
														</div>	
													</div>	
												</div>
											</div>
											<div class="bb">
												<div></div>
											</div>
										</div>
									</div>
									
									<div class="divider"></div>
									
									<div style="text-align:center; background-color:rgb(255, 255, 255); padding:10px; font-size: 1.4em;"><?php echo $drupal_sNotice ?></div>
								</div>
							</div>
						</div>
					</body>
					</html>
					<?php
					exit;
				}
			}else{
				// Delete the existing Facebook ID if present for this Drupal user.
				$drupal_sqlDeleteQuery = "DELETE FROM {fboauth_users} WHERE uid = '%d'";
				$drupal_aDeleteArgs = array($drupal_id);

				// If setting a new Facebook ID for an account, also make sure no other
				// Drupal account is connected with this Facebook ID.
				if (isset($fb_id)) {
					$drupal_sqlDeleteQuery .= ' OR fbid = %d';
					$drupal_aDeleteArgs[] = $fb_id;
				}

				db_query($drupal_sqlDeleteQuery, $drupal_aDeleteArgs);
				
				
				$drupal_iRandomId = mt_rand();
				//$drupal_sUserName = $drupal_iRandomId.'default';
				$drupal_sUserName = $drupal_iRandomId.'_'.$fb_sUserName;
				$drupal_sPass = 'default';
				//$drupal_sEmail = $drupal_iRandomId.'default@mail.com';
				$drupal_sEmail = $drupal_iRandomId.'_'.$fb_sEmail;
				
				db_query("INSERT INTO {users} 
								VALUES(
									NULL,
									'".$drupal_sUserName."',
									MD5('".$drupal_sPass."'),
									'".$drupal_sEmail."',
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
									'".$drupal_sEmail."',
									NULL,
									0,
									0,
									'5'
								)");
				
				$drupal_id = db_result(db_query("select uid from {users} where mail = '".$drupal_sEmail."'"));
		
				db_query('INSERT INTO {fboauth_users} (uid, fbid) VALUES (%d, %d)', $drupal_id, $fb_id);
				db_query("INSERT INTO {users_roles} (uid, rid) VALUES ('{$drupal_id}', '2')");
				
				?>
				<script>
				self.location.href = '<?php echo $drupal_sChangeInfoURL . $drupal_id ?>';
				</script>
				<?php
				exit;
			}
			
			/*
			<hr/>
			<img src="https://graph.facebook.com/<?php echo $iUserId ?>/picture">
			*/
		} catch (FacebookApiException $e){
			error_log($e);
			$iUserId = null;
			
			echo '<pre>';
			print_r($oFacebook);
			echo '</pre>';
			
			echo '<pre>';
			print_r($e);
			echo '</pre>';
		}
	} else {
		// User hasn't yet authorized our app
		fb_app_display_page( $drupal_sLandingPageAnonymous );
	}
} else {
	?>
	<script>
	var sHost = location.host;

	if (sHost != 'apps.facebook.com'){
		top.location.href = '<?php echo $sAuthURL ?>';
	}
	</script>
	<?php
}


// Login or logout url will be needed depending on current user state.
/* if ($iUserId){
	$sLogoutUrl = $oFacebook->getLogoutUrl();
}else{
	$sLoginUrl = $oFacebook->getLoginUrl();
} */
