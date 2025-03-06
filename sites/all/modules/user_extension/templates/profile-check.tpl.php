<?php
require_once './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
?>
<?php
$path = isset($_GET['q']) ? $_GET['q'] : '<front>'; 
$uid = preg_replace("/[^0-9]/", '', $path);	
?>
<div style="clear:both;">
<form action="http://www.hopecybrary.org/<?=$path?>"  accept-charset="UTF-8" method="post" id="user-profile-form" enctype="multipart/form-data">
<input type="hidden" name="form_build_id" id="form-<?=drupal_get_token('user_profile_form')?>" value="form-<?=drupal_get_token('user_profile_form')?>"  />
<input type="hidden" name="form_token" id="edit-user-profile-form-form-token" value="<?=drupal_get_token('user_profile_form')?>"  />
<input type="hidden" name="form_id" id="edit-user-profile-form" value="user_profile_form"  />
<?php
$aCvalues = array('Accounts Creation' => '28,29,30,31,32,33,34,35', 
				  'Hopestreet and Hopenet' => '37,38,39,40,41', 
				  'Issuance of Cybrary Card' => '43,44,45,46,47', 
				  'Basic Training' => '51,50,49');
				  
	foreach($aCvalues as $legend => $group){
	   echo '<fieldset><legend>'.$legend.'</legend>';
	   $sqlFields = "SELECT * FROM profile_fields 
								WHERE
									category = 'User Checklist'
								AND 
									fid in ({$group})
								ORDER BY 
									fid ASC"; 
	   $oAFields = db_query($sqlFields); 
	   while ($oAVal = db_fetch_object($oAFields)){ 
			$sqlProfV = "SELECT value FROM profile_values 
								WHERE
									fid = '{$oAVal->fid}'
								AND
									uid = '{$uid}'"; 
			$oValues = db_query($sqlProfV); 
			$oVal = db_fetch_object($oValues);                         
			$checked = $oVal->value ? 'checked="checked"' : ''; 
			echo '<div class="form-item" id="edit-'.$oAVal->name.'-wrapper" style="padding-left:20px;">
					  <label class="option" for="edit-'.$oAVal->name.'"><input type="checkbox" name="'.$oAVal->name.'" id="edit-'.$oAVal->name.'" value="1" '.$checked.' class="form-checkbox" /> '.$oAVal->title.'</label>
				  </div>';  
	   }
	echo '</fieldset>';
	}

	$sqlMessaging = "SELECT iClearanceId FROM users_roles_user_modules_clearance 
                            WHERE
                                iUserId = '{$uid}'
							AND 
								iModuleId = 1";
	$osqlMessaging = db_query($sqlMessaging); 
	$oMessaging = db_fetch_object($osqlMessaging);
	$mBasic = $oMessaging->iClearanceId == 1 ? 'selected="selected"' : '';
	$mRestricted = $oMessaging->iClearanceId == 2 ? 'selected="selected"' : '';
	$mConfidential = $oMessaging->iClearanceId == 3 ? 'selected="selected"' : '';
	
	$sqlProfile = "SELECT iClearanceId FROM users_roles_user_modules_clearance 
                            WHERE
                                iUserId = '{$uid}'
							AND 
								iModuleId = 2"; 
	$osqlProfile = db_query($sqlProfile); 
	$oProfile = db_fetch_object($osqlProfile); 	
	$pBasic = $oProfile->iClearanceId == 1 ? 'selected="selected"' : '';
	$pRestricted = $oProfile->iClearanceId == 2 ? 'selected="selected"' : '';
	$pConfidential = $oProfile->iClearanceId == 3 ? ' selected="selected"' : '';
?>
<fieldset class=" collapsible"><legend>Permissions</legend>
<div class="description"> Assign the type of restrictions that you want for each module</div>
<div class="form-item" id="edit-module-1-wrapper">
 <label for="edit-module-1">Messaging: </label>
 <select name="module_1" id="edit-module-1" >
	 <option value="1" <?=$mBasic?>>Basic Clearance</option>
	 <option value="2" <?=$mRestricted?>>Restricted Clearance</option>
	 <option value="3" <?=$mConfidential?>>Confidential Clearance</option>
 </select>
</div>

<div class="form-item" id="edit-module-2-wrapper">
 <label for="edit-module-2">Profile: </label>
 <select name="module_2" id="edit-module-2" >
	<option value="1" <?=$pBasic?>>Basic Clearance</option>
	<option value="2" <?=$pRestricted?>>Restricted Clearance</option>
	<option value="3" <?=$pConfidential?>>Confidential Clearance</option>
</select>
</div>
</fieldset>
<input type="submit" name="op" id="edit-submit" value="Save"  class="form-submit" />
<input type="submit" name="op" id="edit-delete" value="Delete"  class="form-submit" />
</form>
</div>