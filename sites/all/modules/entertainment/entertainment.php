<?php
define("SHRINKTHEWEB", 'http://images.shrinktheweb.com/xino.php?stwembed=1&stwu=1aaf6&stwaccesskeyid=85755ac2242b24a');
define('THEME_IMGPATH',base_path().drupal_get_path("theme", "theme2010") . "/images/");

/**
 * Help
 */
function entertainment_help($path, $arg) {
	$output = '';  //declare your output variable
	switch ($path){
		case "admin/help#entertainment":
			$output = '<p>'.  t("Lorem ipsum dolor") .'</p>';
			break;
	}
	return $output;
}

/**
 * Permissions
 */
function entertainment_perm() {
	return array('access entertainment content', 'administer entertainment');
}

function entertainment_init(){
	if (_entertainment_in_array($_REQUEST["q"], array("entertainment/*"))){
		drupal_add_js(drupal_get_path("module", "entertainment")."/jquery.tooltip.js");
		drupal_add_css(drupal_get_path("module", "entertainment")."/jquery.tooltip.css");
		drupal_add_css(drupal_get_path("module", "mystudies")."/redmond/jquery-ui-custom.css");
		drupal_add_js(drupal_get_path("module", "entertainment")."/jquery-ui.js");


		if (in_array("getinvolved", explode("/", $_REQUEST["q"]))){
			drupal_add_css(drupal_get_path("module", "entertainment")."/jquery.treeview.css");
			drupal_add_js(drupal_get_path("module", "entertainment")."/jquery.cookie.js");
			drupal_add_js(drupal_get_path("module", "entertainment")."/jquery.treeview.js");
			drupal_add_js(drupal_get_path("module", "entertainment")."/jquery.treeview.async.js");
			drupal_add_js(drupal_get_path("module", "entertainment")."/templates/entertainment.js");
		}
	}
}

function _entertainment_in_array($sNeedle, $aHaystack){
	foreach ($aHaystack as $sReference){
		if (strstr($sReference, "*")){
			if (stristr($sNeedle, str_replace("*", "", $sReference))) return true;
		}else{
			return ($sNeedle == $sReference);
		}
	}

	return false;
}

function entertainment_menu() {
	$items = array();

	$items['entertainment'] = array(
		'title' => 'Welcome to Our Hope Cybrary Reference Portal',
		'page callback' => 'entertainment_view',
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/%'] = array(
		'title' => 'Hope Cybrary Reference Portal',
		'page callback' => 'entertainment_view',
		'page arguments' => array(1),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/edit/%'] = array(
		'title' => 'Hope Cybrary Reference Portal',
		'page callback' => 'entertainment_edit',
		'page arguments' => array(2),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/edit/%/add'] = array(
		'title' => 'Suggest to Add a Subject',
		'page callback' => 'entertainment_edit_add',
		'page arguments' => array(2),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/edit/subj/add'] = array(
		'title' => 'Subject Suggestion',
		'page callback' => 'entertainment_edit_add_submit',
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/edit/submit'] = array(
		'title' => 'Hope Cybrary Reference Portal',
		'page callback' => 'entertainment_edit_submit',
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/image/%/%'] = array(
		'title' => 'Subject Suggestion',
		'page callback' => 'entertainment_show_image',
		'page arguments' => array(2, 3),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/url/click'] = array(
		'page callback' => 'entertainment_site_click',
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/url/%'] = array(
		'title' => 'Hope Cybrary Reference Portal',
		'page callback' => 'entertainment_site_view',
		'page arguments' => array(2),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/url/edit/%'] = array(
		'title' => 'Hope Cybrary Reference Portal',
		'page callback' => 'entertainment_site_edit',
		'page arguments' => array(3),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/url/edit/submit'] = array(
		'title' => 'Suggested Site Changes',
		'page callback' => 'entertainment_site_edit_submit',
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/url/edit/%/add'] = array(
		'title' => 'Suggest to Add a Site',
		'page callback' => 'entertainment_site_edit_add',
		'page arguments' => array(3),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/url/edit/add'] = array(
		'title' => 'Site Suggestion',
		'page callback' => 'entertainment_site_edit_add_submit',
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/url/edit/del'] = array(
		'title' => 'Site Suggestion for Deletion',
		'page callback' => 'entertainment_delete',
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/url/animation/%'] = array(
		'title' => 'Hope Cybrary Reference Portal',
		'page callback' => 'entertainment_site_animation',
		'page arguments' => array(3, "animation"),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/url/animation/edit/%'] = array(
		'title' => 'Hope Cybrary Reference Portal',
		'page callback' => 'entertainment_site_edit',
		'page arguments' => array(4, "animation"),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/url/animation/edit/%/add'] = array(
		'title' => 'Suggest to Add a Site',
		'page callback' => 'entertainment_site_edit_add',
		'page arguments' => array(4, "animation"),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/file/%/%'] = array(
		'title' => 'Hope Cybrary Reference Portal',
		'page callback' => 'entertainment_file_view',
		'page arguments' => array(2, 3),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/file/%/%/view/%'] = array(
		'title' => 'Hope Cybrary Reference Portal',
		'page callback' => 'entertainment_file_view_file',
		'page arguments' => array(2, 3, 5),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/file/%/%/view/%/admin'] = array(
		'title' => 'Hope Cybrary Reference Portal',
		'page callback' => 'entertainment_file_view_file',
		'page arguments' => array(2, 3, 5, true),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/file/%/%/edit'] = array(
		'title' => 'Suggest a File',
		'page callback' => 'entertainment_file_edit',
		'page arguments' => array(2, 3),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/file/edit/submit'] = array(
		'title' => 'Suggested File Changes',
		'page callback' => 'entertainment_file_edit_submit',
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/file/%/%/edit/add'] = array(
		'title' => 'Suggest a File',
		'page callback' => 'entertainment_file_add',
		'page arguments' => array(2, 3),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/file/edit/add/response'] = array(
		'title' => 'File Suggestion',
		'page callback' => 'entertainment_file_add_response',
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/file/edit/add'] = array(
		'title' => 'Embedded/External File Suggestion',
		'page callback' => 'entertainment_file_add_submit',
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/file/edit/del'] = array(
		'title' => 'File Suggestion for Deletion',
		'page callback' => 'entertainment_file_delete',
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/news/%'] = array(
		'title' => 'Hope Cybrary Reference Portal',
		'page callback' => 'entertainment_news',
		'page arguments' => array(2),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['admin/content/entertainment/subject'] = array(
		'title' => 'Approve or Delete Suggestion',
		'description' => "My Studies Admin for approving/deleting suggestions.",
		'page callback' => 'entertainment_approval',
		'page arguments' => array("subject"),
		'access arguments' => array('administer entertainment'),
		'type' => MENU_NORMAL_ITEM
	);

	$items['admin/content/entertainment/%'] = array(
		'title' => 'Approve or Delete Suggestion',
		'page callback' => 'entertainment_approval',
		'page arguments' => array(3),
		'access arguments' => array('administer entertainment'),
		'type' => MENU_CALLBACK
	);

	$items['admin/content/entertainment/%/process'] = array(
		'title' => 'Approve or Delete Suggestion',
		'page callback' => 'entertainment_approval_process',
		'page arguments' => array(3),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['admin/content/entertainment/cat/del/0'] = array(
		'title' => 'Delete Subjects',
		'description' => "entertainment Admin for deleting subjects/categories and all contents under it.",
		'page callback' => 'entertainment_subj_del',
		'page arguments' => array("0"),
		'access arguments' => array('access administration pages'),
		'type' => MENU_NORMAL_ITEM
	);

	$items['admin/content/entertainment/cat/del/%'] = array(
		'title' => 'Delete Subjects',
		'description' => "entertainment Admin for deleting subjects/categories and all contents under it.",
		'page callback' => 'entertainment_subj_del',
		'page arguments' => array(5),
		'access arguments' => array('access administration pages'),
		'type' => MENU_CALLBACK
	);

	$items['admin/content/entertainment/cat/del/submit'] = array(
		'page callback' => 'entertainment_subj_del_submit',
		'access arguments' => array('access administration pages'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/content/url/wrapper/%/%/%'] = array(
		'page callback' => 'entertainment_wrap_url',
		'page arguments' => array(4, 5, 6),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/content/url/display/%/%/%'] = array(
		'page callback' => 'entertainment_display_url',
		'page arguments' => array(4, 5, 6),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/getinvolved'] = array(
		'title' => 'Get Involved',
		'page callback' => 'entertainment_getinvolved',
		'access arguments' => array('access entertainment content'),
		'type' => MENU_NORMAL_ITEM,
		'menu_name' => 'menu-primary-links'
	);

	$items['entertainment/getinvolved/guides'] = array(
		'title' => 'Get Involved',
		'page callback' => 'entertainment_guides',
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/getinvolved/editors'] = array(
		'title' => 'Get Involved',
		'page callback' => 'entertainment_editors',
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/getinvolved/volunteer/%/deactivate'] = array(
		'page callback' => 'entertainment_volunteer_deactivate',
		'page arguments' => array(3),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/getinvolved/editors/assign/guides'] = array(
		'title' => 'Get Involved',
		'page callback' => 'entertainment_editors_assign_guides',
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/getinvolved/%/enroll'] = array(
		'title' => 'Get Involved',
		'page callback' => 'entertainment_volunteer_enroll',
		'page arguments' => array(2),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/getinvolved/admin/pending/subjects'] = array(
		'title' => 'Get Involved > Pending Subjects',
		'page callback' => 'entertainment_editors_pending_cats',
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/getinvolved/process/pending/subjects/admin'] = array(
		'title' => 'Get Involved > Pending Subjects',
		'page callback' => 'entertainment_editors_pending_cats_process',
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/getinvolved/%/pending'] = array(
		'title' => 'Get Involved > Edit Pending Items',
		'title callback' => '_entertainment_editors_pending_items_main_title',
		'page callback' => 'entertainment_editors_pending_items',
		'page arguments' => array("", 2),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_NORMAL_ITEM
	);

	$items['entertainment/getinvolved/%/pending/sites'] = array(
		'title' => 'Websites',
		'title callback' => '_entertainment_editors_pending_items_title',
		'title arguments' => array("site", 2),
		'page callback' => 'entertainment_editors_pending_items',
		'page arguments' => array("site", 2),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_DEFAULT_LOCAL_TASK,
		'weight' => 1
	);

	$items['entertainment/getinvolved/%/pending/photos'] = array(
		'title' => 'Photos',
		'title callback' => '_entertainment_editors_pending_items_title',
		'title arguments' => array("image", 2),
		'page callback' => 'entertainment_editors_pending_items',
		'page arguments' => array("image", 2),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_LOCAL_TASK,
		'weight' => 2
	);

	$items['entertainment/getinvolved/%/pending/books'] = array(
		'title' => 'Books',
		'title callback' => '_entertainment_editors_pending_items_title',
		'title arguments' => array("doc", 2),
		'page callback' => 'entertainment_editors_pending_items',
		'page arguments' => array("doc", 2),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_LOCAL_TASK,
		'weight' => 3
	);

	$items['entertainment/getinvolved/%/pending/videos'] = array(
		'title' => 'Videos',
		'title callback' => '_entertainment_editors_pending_items_title',
		'title arguments' => array("video", 2),
		'page callback' => 'entertainment_editors_pending_items',
		'page arguments' => array("video", 2),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_LOCAL_TASK,
		'weight' => 4
	);

	$items['entertainment/getinvolved/%/pending/animations'] = array(
		'title' => 'Videos',
		'title callback' => '_entertainment_editors_pending_items_title',
		'title arguments' => array("animation", 2),
		'page callback' => 'entertainment_editors_pending_items',
		'page arguments' => array("animation", 2),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_LOCAL_TASK,
		'weight' => 5
	);

	$items['entertainment/getinvolved/%/pending/%/process'] = array(
		'title' => 'Get Involved',
		'page callback' => 'entertainment_editors_pending_items_process',
		'page arguments' => array(4, 2),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/getinvolved/%/pending/%/edit/%'] = array(
		'title' => 'Get Involved',
		'page callback' => 'entertainment_editors_pending_items_edit',
		'page arguments' => array(4, 6, 2),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/getinvolved/%/pending/edit/process'] = array(
		'title' => 'Get Involved',
		'page callback' => 'entertainment_editors_pending_items_edit_process',
		'page arguments' => array(2),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	/* $items['entertainment/getinvolved/editors/existing/cats'] = array(
		'title' => 'Get Involved > Edit Existing Subjects or Categories',
		'page callback' => 'entertainment_editors_existing_cats',
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	); */

	$items['entertainment/getinvolved/%/existing/cats'] = array(
		'title' => 'Get Involved > Edit Existing Subjects or Categories',
		'page callback' => 'entertainment_editors_existing_cats',
		'page arguments' => array(2),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/getinvolved/%/existing/cats/%/process'] = array(
		'title' => 'Get Involved > Edit Existing Subjects or Categories',
		'page callback' => 'entertainment_editors_existing_cats_process',
		'page arguments' => array(2, 5),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	/* $items['entertainment/getinvolved/editors/existing/items'] = array(
		'title' => 'Get Involved > Edit Existing Items',
		'page callback' => 'entertainment_editors_existing_items',
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	); */

	$items['entertainment/getinvolved/%/existing/items'] = array(
		'title' => 'Get Involved > Edit Existing Items',
		'page callback' => 'entertainment_editors_existing_items',
		'page arguments' => array(2),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	/* $items['entertainment/getinvolved/editors/existing/items/process'] = array(
		'title' => 'Get Involved',
		'page callback' => 'entertainment_editors_existing_items_process',
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	); */

	$items['entertainment/getinvolved/%/existing/items/process'] = array(
		'title' => 'Get Involved',
		'page callback' => 'entertainment_editors_existing_items_process',
		'page arguments' => array(2),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/getinvolved/admins'] = array(
		'title' => 'Get Involved',
		'page callback' => 'entertainment_admins',
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/getinvolved/admin/assign/editors'] = array(
		'title' => 'Get Involved',
		'page callback' => 'entertainment_admins_assign_editors',
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/getinvolved/full/cat/%'] = array(
		'page callback' => 'entertainment_get_full_cat',
		'page arguments' => array(4),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['intro'] = array(
		'page callback' => 'entertainment_intro',
		'access arguments' => array('access content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/agemanagement/%/%/%'] = array(
		'title' => 'Age Group Management',
		'page callback' => 'entertainment_agemanagement',
		'page arguments' => array(2,3,4),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/languagemanagement/%/%/%'] = array(
		'title' => 'Language Management',
		'page callback' => 'entertainment_languagemanagement',
		'page arguments' => array(2,3,4),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/languagemanagement/%/%/%'] = array(
		'title' => 'Language Management',
		'page callback' => 'entertainment_languagemanagement',
		'page arguments' => array(2,3,4),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/profileperms/%/%/%'] = array(
		'title' => 'Profile Permissions',
		'page callback' => 'entertainment_set_user_clearance',
		'page arguments' => array(2,3,4),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/listcategories'] = array(
		'title' => 'List all categories',
		'page callback' => 'entertainment_listcategories',
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	$items['entertainment/getinvolved/search/%/%'] = array(
		'title' => 'Hope Cybrary Reference Portal',
		'page callback' => 'entertainment_search',
		'page arguments' => array(3, 4),
		'access arguments' => array('access entertainment content'),
		'type' => MENU_CALLBACK
	);

	return $items;
}

function entertainment_agemanagement($bAjax,$iUserId,$sNewAge) {
	$bIsAgeSet = false;
	$rsAge = db_query("SELECT data FROM users WHERE uid='" . $iUserId . "'");
	$rowAge = db_fetch_object($rsAge);
	if (!empty($rowAge->data)) {
		$aUserData = unserialize($rowAge->data);
		if (isset($aUserData["age_settings"])) {
			$bIsAgeSet = true;
			$sUserAgeSettings = $aUserData["age_settings"];
		}
	}

	if ($bAjax && $sNewAge != "-2") {
		$aUserData["age_settings"] = ($sNewAge == "-1" ? "" : $sNewAge);
		db_query("UPDATE users SET data = '%s' WHERE uid = '" . $iUserId . "'",array(serialize($aUserData)));
	}

	if (!$bIsAgeSet) {
		$rsUser = db_query("SELECT value FROM profile_values WHERE fid = '5' AND uid = '" . $iUserId . "'");
		$rowUser = db_fetch_object($rsUser);
		if (empty($rowUser->value)) {
			$iUserAge = 0;
		} else {
			$aUserBdate = unserialize($rowUser->value);
			$iUserAge = date("Y") - $aUserBdate["year"];
			if ((date("n") < $aUserBdate["month"] * 1) || ((date("n") > $aUserBdate["month"] * 1) && (date("j") < $aUserBdate["day"] * 1)))
				$iUserAge --;
		}

		$sUserAgeSettings = "";
		$aAgeGroups = array("7-9","10-12");
		foreach ($aAgeGroups as $sAgeGroup) {
			$aAgeGroup = explode("-",$sAgeGroup);
			if ($aAgeGroup[0] <= $iUserAge && $aAgeGroup[1] >= $iUserAge)
				$sUserAgeSettings = $sAgeGroup;
		}
		$aUserData["age_settings"] = $sUserAgeSettings;
		db_query("UPDATE users SET data = '%s' WHERE uid = '" . $iUserId . "'",array(serialize($aUserData)));
	}

	if ($bAjax)
		die($aUserData["age_settings"]);
	else
		return $sUserAgeSettings;

}

function entertainment_get_google_language($sUserLanguage = "") {
	$aLang = array(
				"af" => "Afrikaans",
				"sq" => "Albanian",
				"ar" => "Arabic",
				"hy" => "Armenian",
				"az" => "Azerbaijani",
				"eu" => "Basque",
				"be" => "Belarusian",
				"bg" => "Bulgarian",
				"ca" => "Catalan",
				"zh-CN" => "Chinese (Simplified)",
				"zh-TW" => "Chinese (Traditional)",
				"hr" => "Croatian",
				"cs" => "Czech",
				"da" => "Danish",
				"nl" => "Dutch",
				"en" => "English",
				"et" => "Estonian",
				"tl" => "Filipino",
				"fi" => "Finnish",
				"fr" => "French",
				"gl" => "Galician",
				"ka" => "Georgian",
				"de" => "German",
				"el" => "Greek",
				"ht" => "Haitian Creole",
				"iw" => "Hebrew",
				"hi" => "Hindi",
				"hu" => "Hungarian",
				"is" => "Icelandic",
				"id" => "Indonesian",
				"ga" => "Irish",
				"it" => "Italian",
				"ja" => "Japanese",
				"ko" => "Korean",
				"lv" => "Latvian",
				"lt" => "Lithuanian",
				"mk" => "Macedonian",
				"ms" => "Malay",
				"mt" => "Maltese",
				"no" => "Norwegian",
				"fa" => "Persian",
				"pl" => "Polish",
				"pt" => "Portuguese",
				"ro" => "Romanian",
				"ru" => "Russian",
				"sr" => "Serbian",
				"sk" => "Slovak",
				"sl" => "Slovenian",
				"es" => "Spanish",
				"sw" => "Swahili",
				"sv" => "Swedish",
				"th" => "Thai",
				"tr" => "Turkish",
				"uk" => "Ukrainian",
				"ur" => "Urdu",
				"vi" => "Vietnamese",
				"cy" => "Welsh",
				"yi" => "Yiddish",
	);

	if ($sUserLanguage == "")
		return $aLang;
	else
		return $aLang[$sUserLanguage];
}

function entertainment_languagemanagement($bAjax,$iUserId,$sNewLanguage) {
	$sUserLanguage = "en";
	$rs = db_query("SELECT data FROM users WHERE uid='" . $iUserId . "'");
	$row = db_fetch_object($rs);
	if (!empty($row->data)) {
		$aUserData = unserialize($row->data);
		if (isset($aUserData["language_settings"]))
			$sUserLanguage = $aUserData["language_settings"];
	}

	if ($bAjax && $sNewLanguage != "-2") {
		$aUserData["language_settings"] = $sNewLanguage;
		$sUserLanguage = $sNewLanguage;
		db_query("UPDATE users SET data = '%s' WHERE uid = '" . $iUserId . "'",array(serialize($aUserData)));
	}

	if ($bAjax)
		die($sUserLanguage);
	else
		return $sUserLanguage;
}

function entertainment_get_clearance() {
	$aData = array();
	$rs = db_query("SELECT * FROM users_roles_clearance");
	while($row = db_fetch_object($rs)) {
		$aData[$row->id] = $row->sClearance;
	}
	return $aData;
}

function entertainment_get_user_clearance($iUserId, $iModuleId) {
	$rs = db_query("SELECT iClearanceId FROM users_roles_user_modules_clearance WHERE iUserId='" . $iUserId . "' AND iModuleId = '" . $iModuleId . "'");
	$row = db_fetch_object($rs);
	if (!empty($row->iClearanceId))
		return $row->iClearanceId;
	return 1;
}

function entertainment_set_user_clearance($iUserId, $iModuleId, $iClearanceId) {
	db_query("DELETE FROM users_roles_user_modules_clearance WHERE iUserId='" . $iUserId . "' AND iModuleId = '" . $iModuleId . "'");
	db_query("INSERT INTO users_roles_user_modules_clearance SET
				iUserId='" . $iUserId . "',
				iModuleId = '" . $iModuleId . "',
				iClearanceId = '" . $iClearanceId . "'");
}

function entertainment_listcategories() {
	global $aTreeCategs;

	$aTreeCategs = array();
	$rsCategs = db_query("SELECT id, group_level, title, leaf FROM mystudyrecord ORDER by id, title where title = 'Entertainment'");
	while($rowCateg = db_fetch_object($rsCategs)) {
		$aTreeCategs[$rowCateg->group_level][$rowCateg->id] = array ("title" => $rowCateg->title, "leaf" => $rowCateg->leaf);
	}
	return entertainment_buildTreeMenu(0,0);
}


function entertainment_buildTreeMenu($iParent,$sParents) {
	global $aTreeCategs;

	if (!empty($aTreeCategs[$iParent])) {
		$sData = '<ul' . ($iParent == 0 ? ' class="jtreeview" id="tree_categories"' : '') . '>';
		foreach($aTreeCategs[$iParent] as $iCategId => $aCateg) {
			if ($aCateg["leaf"] == 1)
				$sData .= '<li><a id="tm' . $iCategId . '" onclick="getFlashContents(' . $iCategId . ',\'' . $sParents . '\')">' . ucwords(strtolower($aCateg["title"])) . '</a></li>';
			else
				$sData .= '<li><span id="tm' . $iCategId . '">' . ucwords(strtolower($aCateg["title"])) . '</span>' . entertainment_buildTreeMenu($iCategId,$sParents . "," . $iCategId) . '</li>';
		}
		return $sData . '</ul>';
	} else {
		return '<ul><li style="cursor:default">No subjects/subcategies yet</li></ul>';
	}
}

function entertainment_intro(){
	$sOutput = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title>Cybrary Intro</title>
				<script type="text/javascript" src="misc/jquery.js?q"></script>
				<script type="text/javascript">
				$(document).ready(
					function(){

					}
				);
				</script>
				</head>

				<body style="background-color:#003300;">

				<div id="Intro" style="width:947px; margin-left:auto; margin-right:auto; position:relative;">
					<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="947" height="601" id="intro" align="middle">
						<param name="allowScriptAccess" value="sameDomain" />
						<param name="allowFullScreen" value="false" />
						<param name="movie" value="home_files/intro.swf" />
						<param name="quality" value="high" />
						<param name="wmode" value="transparent" />
						<param name="bgcolor" value="#333333" />
						<embed src="home_files/intro.swf" quality="high" wmode="transparent" bgcolor="#333333" width="947" height="601" name="intro" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
					</object>
				</div>

				</body>

				</html>';

	exit($sOutput);
}

function entertainment_getinvolved(){
	drupal_set_breadcrumb(array(l("Home", "<front>"), l("Get Involved", "entertainment/getinvolved")));
	drupal_set_html_head('<style>#cont-col .ind {padding:10px 30px 20px 30px !important;}</style>');

	$sOutput = '<p>There are lots of ways to get involved with HopeNet. You can become a Sponsor or you can become an Online-Volunteer.</p>
				<br/>

				<h3 style="color:#F28502">SPONSORS</h3>
				<p>As a sponsor, you can XXXXXX. To learn more about sponsoring a child, click '.l("here", "node/10", array('attributes' => array("target" => "_blank"))).'.</p>

				<br/>
				<br/>

				<h3 style="color:#F28502">VOLUNTEER</h3>
				<p>HopeNet has many different ways that you can become involved as an Online-Volunteer. We have volunteer positions available that
				can, virtually, fit any schedule regardless of whether you only have 20 minutes or 2 hours a day available. HopeNet is in need of online
				Guides, Tutors, Mentors, Editors, Monitors, and Advocate.</p>

				<br/>

				<p><span style="color:#F28502">Guides:</span> As a Guide, you will help us search the Internet and recommend contents for our Knowledge Portal
				such as websites, photos, online books/reports, and videos. To learn more about becoming a HopeNet- Guide, click '.l("here", "entertainment/getinvolved/guides", array('attributes' => array("target" => "_blank"))).'.</p>
				<br/>

				<p><span style="color:#F28502">Tutors:</span> We are currently searching for Tutors for our Instant - Tutoring program and in the near
				future, we will be seeking Tutors for our Private Tutoring program. Through our Instant - Tutoring program, children can ask questions on,
				virtually, any subject related to their studies. To learn more about the HopeNet- Tutoring program, click '.l("here", "node/13", array('attributes' => array("target" => "_blank"))).'.</p>
				<br/>

				<p><span style="color:#F28502">Mentors:</span> The HopeNet - Mentoring program will provide children to caring adults who can XXXXX.
				We have not yet begun the program but we expect it to start in the summer of 2010. To learn more about our HopeNet- Mentoring program, click '.l("here", "node/12", array('attributes' => array("target" => "_blank"))).'.</p>
				<br/>

				<p><span style="color:#F28502">Editors:</span> The goal of the HopeNet - Knowledge Portal is to become the world\'s best library of
				online content. The role of an Editor is th help us ensure the quality control of our Knowledge Portal. As an Editor, you will us filter
				and verify the quality of the content that is being recommended by our Guides. The content that you will validate includes websites,
				photos, videos, and online books/reports. To learn more on becoming an Editor, click '.l("here", "entertainment/getinvolved/editors", array('attributes' => array("target" => "_blank"))).'.</p>
				<br/>

				<p><span style="color:#F28502">Monitors:</span> HopeNet is powered by the Acts of Kindness and Good Deeds of our Children and adult
				Volunteers and Sponsors. To protect the children and the integrity of our programs, we need volunteers to spot check our various programs.
				To learn more on becoming a Monitor, click <a href="#">here</a>.</p>
				<br/>

				<p><span style="color:#F28502">Advocates:</span> We are also searching for volunteers who can spread the good news about HopeNet and
				introduce us children who need our services and who can make time to help a child. To learn more about the HopeNet - Advocacy program, click '.l("here", "node/14", array('attributes' => array("target" => "_blank"))).'.</p>
				<br/>

				<p><span style="color:#F28502">Administrators:</span> Administrators are the fail-safe mechanism for HopeNet to make sure all programs
				are running smoothly and safely for the children. There are numerous roles for Administrators which , primarily, involve the oversight
				of the activities performed by the Children, Volunteers, and Sponsors. For example: Administrators review and approve/decline the posting
				of the Knowledge Portal content being recommended/edited by Guides and Editors. To learn more about becoming an Administrator, click '.l("here", "entertainment/getinvolved/admins", array('attributes' => array("target" => "_blank"))).'.</p>';

	return $sOutput;
}

function _entertainment_volunteer_status($iUserId, $sUserType){
	$sqlCheck = "SELECT bStatus FROM mystudies_volunteer WHERE uid = %d AND type = '%s'";
	$iStatus = db_result(db_query($sqlCheck, array($iUserId, $sUserType)));

	return ($iStatus > 0);
}

function entertainment_guides(){
	global $user, $sEditor, $iUserId, $sUpTicket, $sEnroll, $iHopePoints, $bAssignedEditor, $iApproveCount, $iDispproveCount;

	_rating_require();

	$iUserId = $user->uid;
	$sBasePath = base_path();

	// --BEGIN DivShare API
	/* require "divshare_api.php";

	$oDivShare = new divshare_api("3565-c19fab92b80e", "312e23305ca6");
	$sSessionKey = $oDivShare->login("f.lewis@firstearthalliance.org", "pabx42");

	if ($sSessionKey !== false) $sUpTicket = $oDivShare->get_upload_ticket();

	$oDivShare->logout(); */
	// --END DivShare API
	$_SESSION['developerKey'] = 'AI39si5Pn9BJ38zXp3jHxVfqFMRWDXFjUv18JX2Ap4xJBrcbgjRhhXaLTi-DaV7DfhCWxm2mUnHrqr__EdYOGaHCOXPdWqfMpA';


	drupal_set_breadcrumb(array(l("Home", "<front>"), l("Get Involved", "entertainment/getinvolved"), l("Guides", "entertainment/getinvolved/guides")));
	drupal_set_html_head('<style>#cont-col .ind {padding:10px 30px 20px 30px !important;}</style>');

	$sDisplayDash = (isset($_REQUEST["b"]) && $_REQUEST["b"] == 1) ? "none":"block";
	$sDisplayNotice = (isset($_REQUEST["b"]) && $_REQUEST["b"] == 1) ? "block":"none";

	$bEnrolled = _entertainment_volunteer_enroll_check($user->uid, "guide");
	$bActive = _entertainment_volunteer_status($user->uid, "guide");
	$sEnroll = "";

	if (!$bEnrolled && $user->uid > 1){
		$sEnroll = '<br /><br /><p>To enroll as a Guide, click '.l("here", "entertainment/getinvolved/guide/enroll").'. </p>';
	}elseif (!$bActive){
		$sEnroll = '<br /><br /><h3>You have enrolled as a Guide but is not cleared by the admin, yet. Until then, you cannot use this feature.</h3>';
	}

	$sOutput = drupal_eval(load_etemplate('page-guide'));

	if ($bEnrolled && $bActive){
		$iHopePoints = userpoints_get_current_points($iUserId, "all");
		$aEditor = _entertainment_volunteer_assignments($iUserId, "guide");
		$sEditor = (count($aEditor) == 1) ? l($aEditor[0]["name"], "user/".$aEditor[0]["uid"], array('attributes' => array("target" => "_blank"))):'none';

		$bAssignedEditor = ($sEditor == "none") ? "No":"Yes";

		$sqlStatCount = "SELECT IFNULL(iApprovedCount, 0) AS iApprovedCount, IFNULL(iDisapprovedCount, 0) AS iDisapprovedCount FROM mystudies_volunteer WHERE uid = %d AND `type` = '%s'";
		$oStatCountResult = db_query($sqlStatCount, array($user->uid, "guide"));
		$oStatCount = db_fetch_object($oStatCountResult);
		$iApproveCount = $oStatCount->iApprovedCount;
		$iDispproveCount = $oStatCount->iDisapprovedCount;

		$sOutput .= '<a name="dashboard"></a><div id="guides_Dashboard" style="display:'.$sDisplayDash.'">' . drupal_eval(load_etemplate('page-guide1')) . '</div>';
		$sOutput .= '<div id="guides_Categories" style="display:none;">' . drupal_eval(load_etemplate('page-guide2')) . '</div>';
		$sOutput .= '<div id="guides_Notice" style="display:'.$sDisplayNotice.';">' . drupal_eval(load_etemplate('page-guide6')) . '</div>';
		$sOutput .= '<div id="guides_WebsiteForm" style="display:none;">' . drupal_eval(load_etemplate('page-guide3')) . '</div>';
		$sOutput .= '<div id="guides_FileForm" style="display:none;">' . drupal_eval(load_etemplate('page-guide4')) . '</div>';
	}

	return $sOutput;
}

function _entertainment_volunteer_rec_count($iUserId, $sType="guide"){
	/* $sField = ($sType == "guide") ? "iUserId":"iEditorId";
	$sqlRecCount = "SELECT COUNT(id) FROM mystudyrecord_suggested_file WHERE %s = %d";
	$iRecCount = db_result(db_query($sqlRecCount, array($sField, $iUserId)));

	$sqlRecCount = "SELECT COUNT(id) FROM mystudyrecord_suggested_site WHERE %s = %d";
	$iRecCount += db_result(db_query($sqlRecCount, array($sField, $iUserId)));

	$sField = ($sType == "guide") ? "iGuideId":"iEditorId";
	$sqlRecCount = "SELECT COUNT(id) FROM mystudyrecord_file WHERE %s = %d";
	$iRecCount += db_result(db_query($sqlRecCount, array($sField, $iUserId)));

	$sqlRecCount = "SELECT COUNT(id) FROM mystudyrecord_site WHERE %s = %d";
	$iRecCount += db_result(db_query($sqlRecCount, array($sField, $iUserId))); */

	if ($sType == "guide"){
		$sField = "iUserId";
	}elseif ($sType == "editor"){
		$sField = "iEditorId";
	}else{
		$sField = "iAdminId";
	}

	$sqlRecCount = "SELECT COUNT(id) FROM mystudyrecord_suggested_site WHERE %s = %d AND id >= 1999";
	$iRecCount = db_result(db_query($sqlRecCount, array($sField, $iUserId)));

	if ($sType != "admin"){
		$sqlRecCount = "SELECT COUNT(id) FROM mystudyrecord_suggested_file WHERE %s = %d AND id >= 2390";
		$iRecCount += db_result(db_query($sqlRecCount, array($sField, $iUserId)));
	}

	if ($sType == "guide") $sField = "iGuideId";

	$sqlRecCount = "SELECT COUNT(id) FROM mystudyrecord_file WHERE %s = %d AND id >= 2844";
	$iRecCount += db_result(db_query($sqlRecCount, array($sField, $iUserId)));

	$sqlRecCount = "SELECT COUNT(id) FROM mystudyrecord_site WHERE %s = %d AND id >= 1260";
	$iRecCount += db_result(db_query($sqlRecCount, array($sField, $iUserId)));

	return $iRecCount;
}

function entertainment_volunteer_enroll($sType){
	global $user;

	$iUserId = $user->uid;

	drupal_add_js('setTimeout("location=\''.base_path().'entertainment/getinvolved/'.$sType.'s\'", 5000)', "inline");

	$sTitle = ($sType == "admin") ? "Administrators":ucfirst($sType)."s";

	drupal_set_breadcrumb(array(l("Home", "<front>"), l("Get Involved", "entertainment/getinvolved"), l($sTitle, "entertainment/getinvolved/guides")));

	if ($iUserId > 1 && ($sType == "guide" || $sType == "editor" || $sType == "admin")){
		$sqlVerify = "SELECT COUNT(id) AS iUserCount FROM {mystudies_volunteer} WHERE uid = %d AND type = '%s'";
		$iVerifyCount = db_result(db_query($sqlVerify, array($iUserId, $sType)));

		if ($iVerifyCount == 1){
			drupal_set_message("You are already enrolled as a HopeNet ".ucfirst($sType).". You do not have to enroll again.");
		}else{
			$sqlOptin = "INSERT INTO {mystudies_volunteer}
						VALUES(
							NULL,
							%d,
							'%s',
							0,
							0,
							0,
							'0',
							0,
							0
						)";


			if (!db_query($sqlOptin, array($iUserId, $sType))){
				drupal_set_message("An internal error occured.", "error");
			}else{
				$sqlInsert = "INSERT INTO users_roles VALUES(%d, %d)";
				$aParam = array($iUserId);

				switch ($sType){
					case "guide": $aParam[] = 13; break;
					case "editor": $aParam[] = 14; break;
					case "admin": $aParam[] = 15; break;
				}

				db_query($sqlInsert, $aParam);

				drupal_set_message("You have successfully enrolled as a HopeNet ".ucfirst($sType).".");

				// Point System for Volunteer Opt-in
				userpoints_userpointsapi(array("tid" => 198));
			}
		}
	}else{
		drupal_set_message("You are not authorize to access this page or your session has expired.", "error");
	}

	return "";
}

function _entertainment_volunteer_assignments($iUserId, $sUserType="guide"){
	if ($sUserType == "guide"){
		// Get the editor of a guide
		$sqlSelect = "SELECT A.iEditorId AS uid, B.name
						FROM mystudies_volunteer_editor_guides A
						INNER JOIN users B ON B.uid = A.iEditorId
						WHERE A.iGuideId = %d";
	}elseif ($sUserType == "editor"){
		// Get the guides of an editor
		$sqlSelect = "SELECT A.iGuideId AS uid, B.name
						FROM mystudies_volunteer_editor_guides A
						INNER JOIN users B ON B.uid = A.iGuideId
						WHERE A.iEditorId = %d";
	}elseif ($sUserType == "admin"){
		// Get the editors of an admin
		$sqlSelect = "SELECT A.iEditorId AS uid, B.name
						FROM mystudies_volunteer_admin_editors A
						INNER JOIN users B ON B.uid = A.iEditorId
						WHERE A.iAdminId = %d";
	}

	$aOutput = array();
	$oSelectResult = db_query($sqlSelect, $iUserId);

	while ($oSelect = db_fetch_object($oSelectResult)){
		$aOutput[] = array("uid" => $oSelect->uid, "name" => $oSelect->name);
	}

	return $aOutput;
}
function _entertainment_volunteer_enroll_check($iUserId, $sType){
	$sqlCheck = "SELECT id FROM mystudies_volunteer WHERE uid = %d AND type = '".$sType."'";
	$iVolId = db_result(db_query($sqlCheck, $iUserId));

	return ($iVolId > 0);
}
function _entertainment_volunteer_changelog($sUserType, $iRefId, $iItemId, $sItemType, $bTitle, $bDesc, $bCodeURL, $bTag, $bCat, $sSubType="NULL", $iItemIdOld=null){
	global $user;
	//dump_this(func_get_args());
	if ($sSubType != "NULL") $sSubType = "'".$sSubType."'";

	if (!is_null($iItemIdOld)){
		$sqlUpdate1 = "UPDATE mystudies_volunteer_changelog SET iItemId = %d WHERE iItemId = %d";
		db_query($sqlUpdate1, array($iItemId, $iItemIdOld));

		if ($sUserType == "admin"){
			$sqlUpdate2 = "UPDATE mystudies_volunteer_changelog SET iRefId = %d WHERE iRefId = %d AND iItemId = %d";
			db_query($sqlUpdate2, array($iItemId, $iItemIdOld, $iItemId));
		}
	}

	$sqlInsert = "INSERT INTO mystudies_volunteer_changelog VALUES(NULL, %d, %d, '%s', %d, '%s', %d, %d, %d, %d, %d, ".$sSubType.", '%s')";

	db_query($sqlInsert, array($iRefId, $user->uid, $sUserType, $iItemId, $sItemType, $bTitle, $bDesc, $bCodeURL, $bTag, $bCat, date("Y-m-d H:i:s")));
}

function _entertainment_list_changelog($iItemId, $sItemType){
	$sOutput = '<div id="changelog_partial_'.$sItemType.'_'.$iItemId.'" style="padding-bottom:5px; text-align:left;" title="Click to show full changelog if there are any.">
					<span style="font-weight:bold;">Changelog</span><br/>';

	$sqlMain = "SELECT A.id, A.iUserId, B.name, A.sUserType, A.sItemType, A.bTitle, A.bDesc, A.bCodeURL, A.bTag, A.bCat, A.sSubType,
					DATE_FORMAT(A.dDatetime, '%c/%e/%y') AS sDate
				FROM mystudies_volunteer_changelog A
				INNER JOIN users B ON B.uid = A.iUserId ";
	$sqlChangelog = $sqlMain."WHERE A.iItemId = %d AND A.sItemType = '%s' AND A.sUserType = 'guide'";
	$sqlSub1 = $sqlMain."WHERE A.iRefId = %d AND A.sItemType = '%s'";
	$sqlSub2 = $sqlMain."WHERE A.iItemId = %d
							AND A.sItemType = '%s'
							AND A.sUserType IN ('editor', 'admin')
							AND A.id NOT IN (%s)
						ORDER BY A.id";
	$sqlSub3 = $sqlMain."WHERE A.iItemId = %d
							AND A.sItemType = '%s'
							AND A.sUserType IN ('editor', 'admin')
						ORDER BY A.id";

	$oChangelogResult = db_query($sqlChangelog, array($iItemId, $sItemType));
	$iCount = 0;

	while ($oChangelog = db_fetch_object($oChangelogResult)){
		$iCount++;

		$aThisId[] = $oChangelog->id;
		$sOutput .= "- Recommended by: ".$oChangelog->name." on ".$oChangelog->sDate."<br/>";

		$oSub1Result = db_query($sqlSub1, array($oChangelog->id, $sItemType));

		while ($oSub1 = db_fetch_object($oSub1Result)){
			$iCount++;

			$aThisId[] = $oSub1->id;
			$sLogType = ($oSub1->sUserType == "editor") ? "Edited by:":"Administered by:";
			$sOutput .= "- ".$sLogType." ".$oSub1->name." on ".$oSub1->sDate;
			$sOutput .= ($iCount < 3) ? '<br/>':'</div>';
		}

		$oSub2Result = db_query($sqlSub2, array($iItemId, $sItemType, implode(",", $aThisId)));

		while ($oSub2 = db_fetch_object($oSub2Result)){
			$iCount++;

			$sLogType = ($oSub2->sUserType == "editor") ? "Edited by:":"Administered by:";
			$sOutput .= ($iCount == 4) ? '<div id="changelog_full_'.$sItemType.'_'.$iItemId.'" style="display:none;  text-align:left; background-color:#FFFFFF; padding:5px; border:2px solid red;"><div id="changelog_title_'.$iItemId.'" style="padding-bottom:5px;"></div>':'';
			$sOutput .= "- ".$sLogType." ".$oSub2->name." on ".$oSub2->sDate;
			$sOutput .= ($iCount > 3) ? '<br/>':'';
		}
	}

	if ($iCount == 0){
		$oSub3Result = db_query($sqlSub3, array($iItemId, $sItemType));

		while ($oSub3 = db_fetch_object($oSub3Result)){
			$iCount++;

			$sLogType = ($oSub3->sUserType == "editor") ? "Edited by:":"Administered by:";
			$sOutput .= "- ".$sLogType." ".$oSub3->name." on ".$oSub3->sDate;
			$sOutput .= ($iCount < 3) ? '<br/>':'</div>';
		}
	}

	if ($iCount <= 3 || $iCount > 3){
		$sOutput .= ($iCount == 0) ? 'Not applicable':'';
		$sOutput .= '</div>';
	}

	return $sOutput;
}

function _entertainment_list_changelog_highlight($iItemId, $sItemType){

	$sTable = ($sItemType == "site") ? "mystudyrecord_suggested_site":"mystudyrecord_suggested_file";

	if ($sItemType == "site"){
		$sqlChangelog = "SELECT B.iItemId, B.bTitle, B.bDesc, B.bCodeURL, B.bTag, B.bCat, B.sSubType
						FROM mystudyrecord_suggested_site A
						INNER JOIN mystudies_volunteer_changelog B ON B.iItemId = A.id
						WHERE A.promoted IN (0, 2, 3)
							AND B.iItemId = %d
							AND B.sItemType = '%s'";

	}else{
		$sqlChangelog = "SELECT B.iItemId, B.bTitle, B.bDesc, B.bCodeURL, B.bTag, B.bCat, B.sSubType
						FROM mystudyrecord_suggested_file A
						INNER JOIN mystudies_volunteer_changelog B ON B.iItemId = A.iRefId
						WHERE B.iItemId = %d
							AND B.sItemType = '%s'";
	}

	$oChangelogResult = db_query($sqlChangelog, array($iItemId, $sItemType));
	$aLastChanged = array();
	$bApproved = false;

	while ($oChangelog = db_fetch_object($oChangelogResult)){
		$aLastChanged["bTitle"] = $oChangelog->bTitle;
		$aLastChanged["bDesc"] = $oChangelog->bDesc;
		$aLastChanged["bCodeURL"] = $oChangelog->bCodeURL;
		$aLastChanged["bTag"] = $oChangelog->bTag;
		$aLastChanged["bCat"] = $oChangelog->bCat;
		$aLastChanged["sSubType"] = $oChangelog->sSubType;
	}

	return $aLastChanged;
}

function entertainment_admins(){
	global $user, $sEnroll, $sEditorOptions, /* $sDisabled, */ $iUserId, $iHopePoints, $bCanDoSomething, $iEditorsReqTotal, $iApproveCount, $iDispproveCount;

	$iUserId = $user->uid;
	$sBasePath = base_path();

	drupal_set_breadcrumb(array(l("Home", "<front>"), l("Get Involved", "entertainment/getinvolved"), l("Administrators", "entertainment/getinvolved/admins")));
	drupal_set_html_head('<style>#cont-col .ind {padding:10px 30px 20px 30px !important;}</style>');

	$bEnrolled = _entertainment_volunteer_enroll_check($user->uid, "admin");
	$bActive = _entertainment_volunteer_status($user->uid, "admin");
	$sEnroll = "";

	if (!$bEnrolled && $user->uid > 1){
		$sEnroll = '<br /><br /><p>To enroll as an Administrator, click '.l("here", "entertainment/getinvolved/admin/enroll").'. </p>';
	}elseif (!$bActive){
		$sEnroll = '<br /><br /><h3>You have enrolled as an Administrator but is not cleared by the admin, yet. Until then, you cannot use this feature.</h3>';
	}

	$sOutput = drupal_eval(load_etemplate('page-admins'));

	if (isset($_GET["deactivated"])){
		$sJavaScript = '$(document).ready(
							function(){
								$("#entertainment_VolunteerDeactivateSuccessDialog").dialog(
									{
										modal: true,
										autoOpen: true,
										resizable: false,
										width: 450,
										buttons: {
											"Ok": function(){
												$(this).dialog("close");
											}
										}
									}
								);
							}
						)';

		drupal_add_js($sJavaScript, "inline");

		$sOutput .= '<div id="entertainment_VolunteerDeactivateSuccessDialog" title="Account Deactivated">
						<p>You successfully deactivated your Volunteer- Admin account.</p>
					</div>';
	}

	if ($bEnrolled && $bActive){
		$iHopePoints = userpoints_get_current_points($iUserId, "all");
		$iAvailableEditors = _entertainment_volunteer_available("editor");
		$iEditorCounts = _entertainment_volunteer_assigned_count("admin");
		//$sDisabled = ($iEditorCounts == 0) ? 'disabled="disabled"':'';
		$sEditorOptions = "";

		for ($i=$iAvailableEditors; $i>0; $i--){
			$sEditorOptions .= '<option value="'.$i.'">'.$i.'</option>';
		}

		$sEditors = "";
		$aEditors = _entertainment_volunteer_assignments($iUserId, "admin");
		$bCanDoSomething = (count($aEditors) > 0) ? "true":"false";

		if (count($aEditors) > 0){
			for ($x=0; $x<count($aEditors); $x++){
				$aEditor = $aEditors[$x];
				$sEditors .= '<div>'.l($aEditor["name"], "user/".$aEditor["uid"], array('attributes' => array("target" => "_blank"))).'</div>';
			}
		}else{
			$sEditors .= '<div>No Editors have been assigned to you, yet.</div>';
		}

		$iEditorsReqTotal = _entertainment_volunteer_requested("admin");

		$sqlStatCount = "SELECT IFNULL(iApprovedCount, 0) AS iApprovedCount, IFNULL(iDisapprovedCount, 0) AS iDisapprovedCount FROM mystudies_volunteer WHERE uid = %d AND `type` = '%s'";
		$oStatCountResult = db_query($sqlStatCount, array($iUserId, "admin"));
		$oStatCount = db_fetch_object($oStatCountResult);
		$iApproveCount = $oStatCount->iApprovedCount;
		$iDispproveCount = $oStatCount->iDisapprovedCount;

		$sOutput .= '<div id="entertainment_guides_block" style="display:none; width:240px; padding:5px; position:absolute; left:600px; background-color:#FFFFFF; border:2px solid #acacac;">
						<h3>Your assigned Editors are:</h3>
						'.$sEditors.'
					</div>';
		$sOutput .= drupal_eval(load_etemplate('page-admins1'));
	}

	return $sOutput;
}

function entertainment_admins_assign_editors(){
	global $user;
	$iEditorsCount = $_REQUEST["entertainment_admin_editors_count"];

	drupal_set_breadcrumb(array(l("Home", "<front>"), l("Get Involved", "entertainment/getinvolved"), l("Admininstrator", "entertainment/getinvolved/admins")));
	drupal_add_js('setTimeout("location=\''.base_path().'entertainment/getinvolved/admins\'", 5000)', "inline");

	$sqlVerify = "SELECT iGuidesCount FROM mystudies_volunteer WHERE uid = %d AND type = 'admin'";
	$iCurrEditorCount = db_result(db_query($sqlVerify, $user->uid));

	if ($iCurrEditorCount == "" || $iCurrEditorCount == null) $iCurrEditorCount = 0;

	/* $sqlEditor = "SELECT A.uid
					FROM mystudies_volunteer A
					LEFT JOIN mystudies_volunteer_admin_editors B ON B.iEditorId = A.uid
					WHERE A.type = 'editor'
						AND A.uid != %d
						AND B.id IS NULL
					ORDER BY RAND()
					LIMIT 0, %d"; */

	if ($iEditorsCount < $iCurrEditorCount && $iCurrEditorCount > 0){
		$iEditorCountToRemove = $iCurrEditorCount - $iEditorsCount;
		$sqlGetEditor = "SELECT iEditorId FROM mystudies_volunteer_admin_editors WHERE iAdminId = %d ORDER BY RAND() LIMIT %d";
		$oGetEditorResult = db_query($sqlGetEditor, array($user->uid, $iEditorCountToRemove));
		$aEditorsToRemove = array();

		while ($oGetEditor = db_fetch_object($oGetEditorResult)){
			$aEditorsToRemove[] = $oGetEditor->iGuideId;
		}

		$sqlDelete = "DELETE FROM mystudies_volunteer_admin_editors WHERE iEditorId IN (%s)";
		db_query($sqlDelete, implode(",", $aEditorsToRemove));

		$sqlUpdate = "UPDATE mystudies_volunteer
						SET iGuidesCount = iGuidesCount - %d,
							iRequest = IF(iRequest=0, 0, iRequest - %d),
							iRequestTotal = IF(iRequestTotal=0, 0, iRequestTotal - %d)
						WHERE uid = %d
							AND type = 'admin'";
		db_query($sqlUpdate, array($iEditorCountToRemove, $iEditorCountToRemove, $iEditorCountToRemove, $user->uid));

		$sMessage = $iEditorCountToRemove." Editor(s) has been removed from your roster.";
	}elseif ($iEditorsCount > $iCurrEditorCount && $iCurrEditorCount > 0){
		$iEditorCountToAdd = $iEditorsCount - $iCurrEditorCount;
		$sqlUpdate = "UPDATE mystudies_volunteer
						SET iRequest = iRequest + %d,
							iRequestTotal = iRequestTotal + %d
						WHERE type = 'admin'
							AND uid = %d";

		db_query($sqlUpdate, array($iEditorCountToAdd, $iEditorCountToAdd, $user->uid));

		$sMessage = "You have requested ".$iEditorCountToAdd." additional Editor(s).";

		/* $iEditorCountToAdd = $iEditorsCount - $iCurrEditorCount;
		$oEditorResult = db_query($sqlEditor, array($user->uid, $iEditorCountToAdd));
		$iCount = 0;

		while ($oEditor = db_fetch_object($oEditorResult)){
			$sqlInsert = "INSERT INTO mystudies_volunteer_admin_editors VALUES(NULL, %d, %d)";
			db_query($sqlInsert, array($user->uid, $oEditor->uid));
			$iCount++;
		}

		$sqlUpdate = "UPDATE mystudies_volunteer
						SET iGuidesCount = iGuidesCount + %d
						WHERE uid = %d AND type = 'admin'";
		db_query($sqlUpdate, array($iCount, $user->uid));

		$sMessage = "You have been assigned ".$iCount." additional Editors(s)."; */
	}elseif ($iEditorsCount == $iCurrEditorCount && $iCurrEditorCount > 0){
		$iRequestTotal = _entertainment_volunteer_requested("admin");

		if ($iRequestTotal > $iEditorsCount){
			$sqlUpdate = "UPDATE mystudies_volunteer
							SET iRequest = IF(iRequest=0, 0, 0),
								iRequestTotal = %d
							WHERE uid = %d
								AND type = 'admin'";

			db_query($sqlUpdate, array($iCurrEditorCount, $user->uid));

			$sMessage = "Your request has been processed. You now have requested for ".$iEditorsCount." Editor(s).";
		}else{
			$sMessage = "You already have been assigned ".$iEditorsCount."Editor(s).";
		}
	}else{
		$sqlUpdate = "UPDATE mystudies_volunteer
						SET iRequest = iRequest + %d,
							iRequestTotal = iRequestTotal + %d
						WHERE type = 'admin'
							AND uid = %d";

		db_query($sqlUpdate, array($iEditorsCount, $iEditorsCount, $user->uid));

		$sMessage = "You have requested ".$iEditorsCount." Editor(s).";

		/* $oEditorResult = db_query($sqlEditor, array($user->uid, $iEditorsCount));
		$iCount = 0;

		while ($oEditor = db_fetch_object($oEditorResult)){
			$sqlInsert = "INSERT INTO mystudies_volunteer_admin_editors VALUES(NULL, %d, %d)";
			db_query($sqlInsert, array($user->uid, $oEditor->uid));
			$iCount++;
		}

		$sqlUpdate = "UPDATE mystudies_volunteer
						SET iGuidesCount = %d
						WHERE uid = %d AND type = 'admin'";
		db_query($sqlUpdate, array($iCount, $user->uid));

		$sMessage = "You have been assigned ".$iCount." Editor(s)."; */
	}

	drupal_set_message($sMessage);

	return '<div style="color:white; font-weight:bold; margin-top:25px;">'.$sMessage.'</div>';
}

function _entertainment_editors_admin($iUserId=null){
	if (is_null($iUserId)){
		global $user;
		$iUserId = $user->uid;
	}

	$sqlAdmin = "SELECT A.uid, A.name
				FROM users A
				INNER JOIN mystudies_volunteer_admin_editors B ON B.iAdminId = A.uid
				WHERE B.iEditorId = %d";

	$oAdminResult = db_query($sqlAdmin, $iUserId);
	$aAdmin = array();

	while ($oAdmin = db_fetch_object($oAdminResult)){
		$aAdmin[] = $oAdmin->uid;
		$aAdmin[] = $oAdmin->name;
	}

	return $aAdmin;
}

function _entertainment_volunteer_requested($sUserType, $iUserId=null){
	if (is_null($iUserId)){
		global $user;
		$iUserId = $user->uid;
	}

	$sqlRequestTotal = "SELECT iRequestTotal FROM mystudies_volunteer WHERE uid = %d AND `type` = '%s'";
	$iRequestTotal = db_result(db_query($sqlRequestTotal, array($iUserId, $sUserType)));

	return $iRequestTotal;
}

function entertainment_volunteer_deactivate($sType){
	if ($sType != ""){
		global $user;

		$iUserId = $user->uid;
		$sqlCheckRole = "SELECT uid FROM users_roles WHERE rid = %d AND uid = %d";
		$sqlDelete = "DELETE FROM mystudies_volunteer WHERE uid = %d AND `type` = '%s'";

		switch ($sType){
			case "guide":
				$iUID = db_result(db_query($sqlCheckRole, array(13, $iUserId)));

				if ($iUID == $iUserId){
					$bSuccess = db_query($sqlDelete, array($iUserId, "guide"));

					if ($bSuccess){
						$sqlDelete = "DELETE FROM mystudies_volunteer_editor_guides WHERE iGuideId = %d";
						db_query($sqlDelete, $iUserId);

						$sqlDelete = "DELETE FROM users_roles WHERE uid = %d AND rid = 13";
						db_query($sqlDelete, $iUserId);
					}

					// Point System for Volunteer Opt-out
					userpoints_userpointsapi(array("uid" => $iUserId, "tid" => 199, "description" => "User deactivated his/her Volunteer - Guide account."));

					header("Location: ".base_path()."entertainment/getinvolved/editors?deactivated");
				}else{
					$sMessage = 'Access denied. You are not a Volunteer - Guide.';
				}

				break;
			case "editor":
				$aAssignedAdmin = _entertainment_editors_admin();
				$iAssignedAdminId = $aAssignedAdmin[0];
				$iUID = db_result(db_query($sqlCheckRole, array(14, $iUserId)));

				if ($iUID == $iUserId){
					$bSuccess = db_query($sqlDelete, array($iUserId, "editor"));

					if ($bSuccess){
						$sqlDelete = "DELETE FROM mystudies_volunteer_editor_guides WHERE iEditorId = %d";
						db_query($sqlDelete, $iUserId);

						$sqlDelete = "DELETE FROM mystudies_volunteer_admin_editors WHERE iEditorId = %d AND iAdminId = %d";
						db_query($sqlDelete, array($iUserId, $iAssignedAdminId));

						$sqlDelete = "DELETE FROM users_roles WHERE uid = %d AND rid = 14";
						db_query($sqlDelete, $iUserId);
					}

					// Point System for Volunteer Opt-out
					userpoints_userpointsapi(array("uid" => $iUserId, "tid" => 199, "description" => "User deactivated his/her Volunteer - Editor account."));

					header("Location: ".base_path()."mystudies/getinvolved/editors?deactivated");
				}else{
					$sMessage = 'Access denied. You are not a Volunteer - Editor.';
				}

				break;
			case "admin":
				$iUID = db_result(db_query($sqlCheckRole, array(15, $iUserId)));

				if ($iUID == $iUserId){
					$bSuccess = db_query($sqlDelete, array($iUserId, "admin"));

					if ($bSuccess){
						$sqlDelete = "DELETE FROM mystudies_volunteer_admin_editors WHERE iAdminId = %d";
						db_query($sqlDelete, $iUserId);

						$sqlDelete = "DELETE FROM users_roles WHERE uid = %d AND rid = 15";
						db_query($sqlDelete, $iUserId);
					}

					// Point System for Volunteer Opt-out
					userpoints_userpointsapi(array("uid" => $iUserId, "tid" => 199, "description" => "User deactivated his/her Volunteer - Admin account."));

					header("Location: ".base_path()."entertainment/getinvolved/admins?deactivated");
				}else{
					$sMessage = 'Access denied. You are not a Volunteer - Admin.';
				}

				break;
		}
	}else{
		$sMessage = 'Access denied.';
		//drupal_access_denied();
	}

	drupal_set_message($sMessage);

	return '<div class="jbox" style="margin-top:15px;">
				<div class="jboxhead"><h2></h2></div>
				<div class="jboxbody">
					<div class="jboxcontent" style="text-align:center;">'.$sMessage.'</div>
				</div>
				<div class="jboxfoot"><p></p></div>
			</div>';
}

function entertainment_editors(){
	global $user, $sEnroll, $iUserId, $iGuidesCounts, $sGuideOptions, $iHopePoints, $bAssignedAdmin, $iGuidesReqTotal, $bCanDoSomething, $iApproveCount, $iDispproveCount;

	$iUserId = $user->uid;
	$sBasePath = base_path();

	drupal_set_breadcrumb(array(l("Home", "<front>"), l("Get Involved", "entertainment/getinvolved"), l("Editors", "entertainment/getinvolved/editors")));
	drupal_set_html_head('<style>#cont-col .ind {padding:10px 30px 20px 30px !important;}</style>');

	$bEnrolled = _entertainment_volunteer_enroll_check($user->uid, "editor");
	$bActive = _entertainment_volunteer_status($user->uid, "editor");
	$sEnroll = "";

	if (!$bEnrolled && $user->uid > 1){
		$sEnroll = '<br /><br /><p>To enroll as an Editor, click '.l("here", "entertainment/getinvolved/editor/enroll").'. </p>';
	}elseif (!$bActive){
		$sEnroll = '<br /><br /><h3>You have enrolled as an Editor but is not cleared by the admin, yet. Until then, you cannot use this feature.</h3>';
	}

	$sOutput = drupal_eval(load_etemplate('page-editors'));

	if (isset($_GET["deactivated"])){
		$sJavaScript = '$(document).ready(
							function(){
								$("#entertainment_VolunteerDeactivateSuccessDialog").dialog(
									{
										modal: true,
										autoOpen: true,
										resizable: false,
										width: 450,
										buttons: {
											"Ok": function(){
												$(this).dialog("close");
											}
										}
									}
								);
							}
						)';

		drupal_add_js($sJavaScript, "inline");

		$sOutput .= '<div id="entertainment_VolunteerDeactivateSuccessDialog" title="Account Deactivated">
						<p>You successfully deactivated your Volunteer- Editor account.</p>
					</div>';
	}

	if ($bEnrolled && $bActive){
		$iHopePoints = userpoints_get_current_points($iUserId, "all");
		$iAvailableGuides = _entertainment_volunteer_available();
		$iGuidesCounts = _entertainment_volunteer_assigned_count() * 1;
		$sGuideOptions = "";

		for ($i=$iAvailableGuides; $i>0; $i--){
			$sGuideOptions .= '<option value="'.$i.'">'.$i.'</option>';
		}

		$sGuides = "";
		$aGuides = _entertainment_volunteer_assignments($iUserId, "editor");

		if (count($aGuides) > 0){
			for ($x=0; $x<count($aGuides); $x++){
				$aGuide = $aGuides[$x];
				$sGuides .= '<div>'.l($aGuide["name"], "user/".$aGuide["uid"], array('attributes' => array("target" => "_blank"))).'</div>';
			}
		}else{
			$sGuides .= '<div>No Guides have been assigned to you, yet.</div>';
		}

		//$sDisabled = ($iGuidesCounts == 0) ? 'disabled="disabled"':'';
		$aAssignedAdmin = _entertainment_editors_admin();
		$sAssignedAdmin = (count($aAssignedAdmin) == 2) ? l($aAssignedAdmin[1], "user/".$aAssignedAdmin[0], array('attributes' => array("target" => "_blank"))):"none";
		$bAssignedAdmin = ($sAssignedAdmin == "none")? "No":"Yes";
		$bCanDoSomething = (count($aGuides) > 0 && count($aAssignedAdmin) == 2) ? "true":"false";
		$iGuidesReqTotal = _entertainment_volunteer_requested("editor");

		$sqlStatCount = "SELECT IFNULL(iApprovedCount, 0) AS iApprovedCount, IFNULL(iDisapprovedCount, 0) AS iDisapprovedCount FROM mystudies_volunteer WHERE uid = %d AND `type` = '%s'";
		$oStatCountResult = db_query($sqlStatCount, array($iUserId, "editor"));
		$oStatCount = db_fetch_object($oStatCountResult);
		$iApproveCount = $oStatCount->iApprovedCount;
		$iDispproveCount = $oStatCount->iDisapprovedCount;

		$sOutput .= '<div id="entertainment_guides_block" style="display:none; width:240px; padding:5px; position:absolute; left:600px; background-color:#FFFFFF; border:2px solid #acacac;">
						<h3>Your assigned Guides are:</h3>
						'.$sGuides.'
						<br/>
						Your assigned Administrator is: '.$sAssignedAdmin.'
					</div>';
		$sOutput .= drupal_eval(load_etemplate('page-editors1'));
	}

	return $sOutput;
}

/*
function _tplvar($sVar) {
	global $$sVar;
	return $$sVar;
}*/


function _entertainment_volunteer_available($sType="guide"){
	global $user;

	if ($sType == "guide"){
		$sqlCount = "SELECT COUNT(A.uid) AS iVolunteerCount
					FROM mystudies_volunteer A
					LEFT JOIN mystudies_volunteer_editor_guides B ON B.iGuideId = A.uid
					WHERE A.type = '%s'
						AND A.uid != %d
						AND B.id IS NULL";
	}else{
		$sqlCount = "SELECT COUNT(A.uid) AS iVolunteerCount
					FROM mystudies_volunteer A
					LEFT JOIN mystudies_volunteer_admin_editors B ON B.iEditorId = A.uid
					WHERE A.type = '%s'
						AND A.uid != %d
						AND B.id IS NULL";
	}

	$iVolunteerCount = db_result(db_query($sqlCount, $sType, $user->uid));

	return $iVolunteerCount;
}
function entertainment_editors_assign_guides(){
	global $user;
	$iGuidesCount = $_REQUEST["entertainment_editor_guides_count"];

	drupal_set_breadcrumb(array(l("Home", "<front>"), l("Get Involved", "entertainment/getinvolved"), l("Editors", "entertainment/getinvolved/editors")));
	drupal_add_js('setTimeout("location=\''.base_path().'entertainment/getinvolved/editors\'", 5000)', "inline");

	$sqlVerify = "SELECT iGuidesCount FROM mystudies_volunteer WHERE uid = %d AND type = 'editor'";
	$iCurrGuideCount = db_result(db_query($sqlVerify, $user->uid));

	if ($iCurrGuideCount == "" || $iCurrGuideCount == null) $iCurrGuideCount = 0;

	/* $sqlGuide = "SELECT A.uid
				FROM mystudies_volunteer A
				LEFT JOIN mystudies_volunteer_editor_guides B ON B.iGuideId = A.uid
				WHERE A.type = 'guide'
					AND A.uid != %d
					AND B.id IS NULL
				ORDER BY RAND()
				LIMIT 0, %d"; */

	/* echo '<pre>';
	print_r($_REQUEST);
	echo '</pre>';
	echo '<pre>';
	print_r("$iGuidesCount < $iCurrGuideCount && $iCurrGuideCount > 0");
	echo '</pre>';
	echo '<pre>';
	print_r("$iGuidesCount > $iCurrGuideCount && $iCurrGuideCount > 0");
	echo '</pre>';
	echo '<pre>';
	print_r("$iGuidesCount == $iCurrGuideCount && $iCurrGuideCount > 0");
	echo '</pre>';
	exit; */

	if ($iGuidesCount < $iCurrGuideCount && $iCurrGuideCount > 0){
		$iGuideCountToRemove = $iCurrGuideCount - $iGuidesCount;
		$sqlGetGuide = "SELECT iGuideId FROM mystudies_volunteer_editor_guides WHERE iEditorId = %d ORDER BY RAND() LIMIT %d";
		$oGetGuideResult = db_query($sqlGetGuide, array($user->uid, $iGuideCountToRemove));
		$aGuidesToRemove = array();

		while ($oGetGuide = db_fetch_object($oGetGuideResult)){
			$aGuidesToRemove[] = $oGetGuide->iGuideId;
		}

		$sqlDelete = "DELETE FROM mystudies_volunteer_editor_guides WHERE iGuideId IN (%s)";
		db_query($sqlDelete, implode(",", $aGuidesToRemove));

		$sqlUpdate = "UPDATE mystudies_volunteer
						SET iGuidesCount = iGuidesCount - %d,
							iRequest = IF(iRequest=0, 0, iRequest - %d),
							iRequestTotal = IF(iRequestTotal=0, 0, iRequestTotal - %d)
						WHERE uid = %d
							AND type = 'editor'";
		db_query($sqlUpdate, array($iGuideCountToRemove, $iGuideCountToRemove, $iGuideCountToRemove, $user->uid));

		$sMessage = $iGuideCountToRemove." Guide(s) has been removed from your roster.";
	}elseif ($iGuidesCount > $iCurrGuideCount && $iCurrGuideCount > 0){
		$iGuideCountToAdd = $iGuidesCount - $iCurrGuideCount;
		$sqlUpdate = "UPDATE mystudies_volunteer
						SET iRequest = iRequest + %d,
							iRequestTotal = iRequestTotal + %d
						WHERE type = 'editor'
							AND uid = %d";

		db_query($sqlUpdate, array($iGuideCountToAdd, $iGuideCountToAdd, $user->uid));

		$sMessage = "You have requested ".$iGuideCountToAdd." additional Guide(s).";

		/* $iGuideCountToAdd = $iGuidesCount - $iCurrGuideCount;
		$oGuideResult = db_query($sqlGuide, array($user->uid, $iGuideCountToAdd));
		$iCount = 0;

		while ($oGuide = db_fetch_object($oGuideResult)){
			$sqlInsert = "INSERT INTO mystudies_volunteer_editor_guides VALUES(NULL, %d, %d)";
			db_query($sqlInsert, array($user->uid, $oGuide->uid));
			$iCount++;
		}

		$sqlUpdate = "UPDATE mystudies_volunteer
						SET iGuidesCount = iGuidesCount + %d
						WHERE uid = %d AND type = 'editor'";
		db_query($sqlUpdate, array($iCount, $user->uid));

		$sMessage = "You have been assigned ".$iCount." additional Guide(s)."; */
	}elseif ($iGuidesCount == $iCurrGuideCount && $iCurrGuideCount > 0){
		$iRequestTotal = _entertainment_volunteer_requested("editor");

		if ($iRequestTotal > $iGuidesCount){
			$sqlUpdate = "UPDATE mystudies_volunteer
							SET iRequest = IF(iRequest=0, 0, 0),
								iRequestTotal = %d
							WHERE uid = %d
								AND type = 'editor'";

			db_query($sqlUpdate, array($iCurrGuideCount, $user->uid));

			$sMessage = "Your request has been processed. You now have requested for ".$iGuidesCount." Guide(s).";
		}else{
			$sMessage = 'You already have assigned '.$iGuidesCount.' Guide(s).';
		}
	}else{
		$sqlUpdate = "UPDATE mystudies_volunteer
						SET iRequest = iRequest + %d,
							iRequestTotal = iRequestTotal + %d
						WHERE type = 'editor'
							AND uid = %d";

		db_query($sqlUpdate, array($iGuidesCount, $iGuidesCount, $user->uid));

		$sMessage = "You have requested ".$iGuidesCount." Guide(s).";

		/* $oGuideResult = db_query($sqlGuide, array($user->uid, $iGuidesCount));
		$iCount = 0;

		while ($oGuide = db_fetch_object($oGuideResult)){
			$sqlInsert = "INSERT INTO mystudies_volunteer_editor_guides VALUES(NULL, %d, %d)";
			db_query($sqlInsert, array($user->uid, $oGuide->uid));
			$iCount++;
		}

		$sqlUpdate = "UPDATE mystudies_volunteer
						SET iGuidesCount = %d
						WHERE uid = %d AND type = 'editor'";
		db_query($sqlUpdate, array($iCount, $user->uid));

		$sMessage = "You have been assigned ".$iCount." Guide(s)."; */
	}

	drupal_set_message($sMessage);

	return '<div style="color:white; font-weight:bold; margin-top:25px;">'.$sMessage.'</div>';
}

function _entertainment_volunteer_assigned_count($sType="editor", $iUserId=null){
	if (is_null($iUserId)){
		global $user;
		$iUserId = $user->uid;
	}

	if ($sType == "editor"){
		//$sqlCount = "SELECT COUNT(id) FROM mystudies_volunteer_editor_guides WHERE iEditorId = %d";
		$sqlCount = "SELECT COUNT(A.id)
					FROM mystudies_volunteer_editor_guides A
					INNER JOIN users B ON B.uid = A.iGuideId
					WHERE A.iEditorId = %d";
	}else{
		//$sqlCount = "SELECT COUNT(id) FROM mystudies_volunteer_admin_editors WHERE iAdminId = %d";
		$sqlCount = "SELECT COUNT(A.id)
					FROM mystudies_volunteer_admin_editors A
					INNER JOIN users B ON B.uid = A.iEditorId
					WHERE A.iAdminId = %d";
	}

	$iGuideCount = db_result(db_query($sqlCount, $iUserId));

	return ($iGuideCount >= 1) ? $iGuideCount:0;
}

function _entertainment_editors_pending_count($sType="items"){
	$aGuides = _entertainment_volunteer_dependents();
	$iPendingCount = 0;

	if (count($aGuides) > 0){
		$sGuidesId = implode(",", $aGuides);
		$sField = ($sType == "items") ? "COUNT(A.id)":"DISTINCT A.iUserId";

		$sqlCount = "SELECT %s
					FROM mystudyrecord_suggested_site A
					WHERE A.iUserId IN (%s)
						AND A.promoted = 0
						AND (A.iEditorId IS NULL OR A.iEditorId = '')
						AND A.id >= 1999";

		if ($sType == "items"){
			$iPendingCount = db_result(db_query($sqlCount, array($sField, $sGuidesId)));
		}else{
			$aResult = array();
			$oGuidesResult = db_query($sqlCount, array($sField, $sGuidesId));

			while ($oGuides = db_fetch_object($oGuidesResult)){
				$aResult[] = $oGuides->iUserId;
			}
		}

		$sqlCount = "SELECT %s
					FROM mystudyrecord_suggested_file A
					WHERE A.iUserId IN (%s)
						AND (A.iEditorId IS NULL OR A.iEditorId = '')
						AND A.id >= 2390";

		if ($sType == "items"){
			$iPendingCount += db_result(db_query($sqlCount, array($sField, $sGuidesId)));

			return $iPendingCount;
		}else{
			$oGuidesResult = db_query($sqlCount, array($sField, $sGuidesId));

			while ($oGuides = db_fetch_object($oGuidesResult)){
				$aResult[] = $oGuides->iUserId;
			}

			return count(array_unique($aResult));
		}
	}else{
		return $iPendingCount;
	}
}

function _entertainment_volunteer_dependents($sType="editors"){
	global $user;

	$aDependents = array();

	if ($sType == "editors"){
		$sqlSelect = "SELECT iGuideId AS iVolunteerId
						FROM mystudies_volunteer_editor_guides
						WHERE iEditorId = %d";
	}else{
		$sqlSelect = "SELECT iEditorId AS iVolunteerId
						FROM mystudies_volunteer_admin_editors
						WHERE iAdminId = %d";
	}

	$oSelectResult = db_query($sqlSelect, $user->uid);

	while ($oDependents = db_fetch_object($oSelectResult)){
		$aDependents[] = $oDependents->iVolunteerId;
	}

	return $aDependents;
}

function _entertainment_editors_pending_items_main_title($sType="site"){
	$aQuery = explode("/", $_REQUEST["q"]);
	$sTitle = (isset($aQuery[4])) ? ucfirst($aQuery[4]):"Websites";

	return "Get Involved > Edit Pending Items > ".$sTitle;
}

function _entertainment_editors_pending_items_title($sType="site", $sUserType="editors", $bNumOnly = false){
	$iItemsCount = 0;
	$required_ids = _entertainment_get_full_ids();

	if ($sType == "site" || $sType == "animation"){
		$sqlQuery = "SELECT COUNT(A.id)
					FROM mystudyrecord_suggested_site A
					LEFT JOIN mystudyrecord_site C ON C.id = A.fid";
	}else{
		$sqlQuery = "SELECT COUNT(A.id)
					FROM mystudyrecord_suggested_file A";
	}

	$aDependentsId = _entertainment_volunteer_dependents($sUserType);
	$sYoutubeOption = ($sType == "site" || $sType == "animation") ? "" : "OR A.sFileType = 'video_youtube'";
	$sFieldName = ($sUserType == "editors") ? "iUserId":"iEditorId";
	$sqlQuery .= " LEFT JOIN users B ON B.uid = A.iUserId
					WHERE (A.".$sFieldName." IN (".implode(", ", $aDependentsId).") " . $sYoutubeOption . ") ";

	if ($sType == "site" || $sType == "animation"){
		$sqlQuery .= "
					AND A.group_level in (".implode(',',$required_ids).")
					AND A.sSiteType = '".$sType."'
						AND A.promoted IN (0, 2, 3)
						AND A.id >= 1999 ";

		if ($sUserType == "editors"){
			$sqlQuery .= "AND (A.iEditorId IS NULL OR A.iEditorId = '')";
		}else{
			$sqlQuery .= "AND (A.iEditorId IS NOT NULL OR A.iEditorId != '')
							AND (A.iAdminId IS NULL OR A.iAdminId = '')";
		}

		if ($sUserType == "admins"){
			$aSiteTypes = array('site_rec', 'site_other');
			$aSiteTables = array('mystudyrecord_site', 'mystudyrecord_suggested_site');
			$sqlItemDelete = "SELECT COUNT(A.id)
								FROM mystudyrecord_suggested_delete A
								INNER JOIN %s B ON B.id = A.iRefId
								WHERE A.iUserId IN (%s)
									AND A.sType = '%s'
									AND B.sSiteType = '%s'";

			for ($i=0; $i<count($aSiteTypes); $i++){
				$sDelSiteType = $aSiteTypes[$i];
				$iItemsCount += db_result(db_query($sqlItemDelete, array($aSiteTables[$i], implode(", ", $aDependentsId), $sDelSiteType, $sType)));
			}
		}
	}else{
		$sqlQuery .= "	AND A.iGroupLevel in (".implode(',',$required_ids).")
						AND A.sFileType IN ('".$sType."', '".$sType."_ext', '".$sType."_embed', '".$sType."_youtube')
						AND A.id >= 2390";

		if ($sUserType == "editors"){
			$sqlQuery .= " AND (A.iEditorId IS NULL OR A.iEditorId = '')";
		}else{
			$sqlQuery .= " AND (A.iEditorId IS NOT NULL OR A.iEditorId != '')
							AND (A.iAdminId IS NULL OR A.iAdminId = '')";
		}

		if ($sUserType == "admins"){
			$sqlItemDelete = "SELECT COUNT(A.id)
								FROM mystudyrecord_suggested_delete A
								LEFT JOIN mystudyrecord_file B ON B.id = A.iRefId
								WHERE A.iUserId IN (%s)
									AND A.sType = 'file'
									AND B.sFileType IN ('".$sType."', '".$sType."_ext', '".$sType."_embed', '".$sType."_youtube')";
			$iItemsCount += db_result(db_query($sqlItemDelete, implode(", ", $aDependentsId)));
		}
	}

	$iItemsCount += db_result(db_query($sqlQuery));

	if ($sType == "site"){
		$sTitle = "Websites";
	}elseif ($sType == "image"){
		$sTitle = "Photos";
	}elseif ($sType == "doc"){
		$sTitle = "Books";
	}elseif ($sType == "video"){
		$sTitle = "Videos";
	}else{
		$sTitle = "Animations";
	}

	return ($bNumOnly) ? $iItemsCount:$sTitle." (".$iItemsCount.")";
    //return $sqlQuery;
}

function _entertainment_admins_pending_count($sType="items"){
	$iItemsCount = 0;
	$aItemsCount = array();
	$aDependentsId = _entertainment_volunteer_dependents("admins");
	$sField = ($sType == "items") ? "COUNT(A.id)":"DISTINCT A.iEditorId";

	if (count($aDependentsId) > 0){
		$sDependentsId = implode(", ", $aDependentsId);

		// Pending site/animation
		$sqlQuery = "SELECT ".$sField."
						FROM mystudyrecord_suggested_site A
						LEFT JOIN mystudyrecord_site C ON C.id = A.fid
						INNER JOIN users B ON B.uid = A.iUserId
						WHERE A.iEditorId IN (".$sDependentsId.")
							AND A.promoted IN (0, 2, 3)
							AND (A.iEditorId IS NOT NULL OR A.iEditorId != '')
							AND (A.iAdminId IS NULL OR A.iAdminId = '')
							AND (A.id >= 1999 OR C.id >= 1260)";

		if ($sType == "items"){
			$iItemsCount += db_result(db_query($sqlQuery));
		}else{
			$oQueryResult = db_query($sqlQuery);

			while ($oQuery = db_fetch_object($oQueryResult)){
				$aItemsCount[] = $oQuery->iEditorId;
			}
		}

		// Pending image,doc,video
		$sqlQuery = "SELECT ".$sField."
					FROM mystudyrecord_suggested_file A
					INNER JOIN users B ON B.uid = A.iUserId
					WHERE A.iEditorId IN (".$sDependentsId.")
						AND (A.iEditorId IS NOT NULL OR A.iEditorId != '')
						AND (A.iAdminId IS NULL OR A.iAdminId = '')
						AND A.id >= 2390";

		if ($sType == "items"){
			$iItemsCount += db_result(db_query($sqlQuery));
		}else{
			$oQueryResult = db_query($sqlQuery);

			while ($oQuery = db_fetch_object($oQueryResult)){
				$aItemsCount[] = $oQuery->iEditorId;
			}
		}

		// Pending for deletion
		$sField = ($sType == "items") ? "COUNT(A.id)":"DISTINCT A.iUserId";
		$aSiteTables = array('mystudyrecord', 'mystudyrecord_site', 'mystudyrecord_suggested_site', 'mystudyrecord_file');
		$aLastIdToCountFrom = array(1, 1260, 1999, 2860);
		$sqlItemDelete = "SELECT ".$sField."
							FROM mystudyrecord_suggested_delete A
							INNER JOIN %s B ON B.id = A.iRefId
							WHERE A.iUserId IN (%s)
								AND (A.id >= 58 OR B.id >= %d)";

		for ($i=0; $i<count($aSiteTables); $i++){
			if ($sType == "items"){
				$iItemsCount += db_result(db_query($sqlItemDelete, array($aSiteTables[$i], $sDependentsId, $aLastIdToCountFrom[$i])));
			}else{
				$oItemDeleteResult = db_query($sqlItemDelete, array($aSiteTables[$i], $sDependentsId, $aLastIdToCountFrom[$i]));

				while ($ItemDelete = db_fetch_object($oItemDeleteResult)){
					$aItemsCount[] = $ItemDelete->iUserId;
				}
			}
		}

		return ($sType == "items") ? $iItemsCount:count(array_unique($aItemsCount));
	}else{
		return 0;
	}
}

function entertainment_editors_pending_items_edit($sType="site", $iItemId, $sUserType="editors"){
	global $user;

	$iUserId = $user->uid;
	$sBasePath = base_path();
	$sSubType = ($sType != "site") ? "file":"site";
	$aDependentsId = _entertainment_volunteer_dependents($sUserType);

	$aBreadcrumb = array(
						l("Home", "<front>"),
						l("Get Involved", "entertainment/getinvolved"),
						l((($sUserType == "editors") ?"Editors":"Administrators"), "entertainment/getinvolved/".$sUserType),
						l("Pending ".(($sUserType == "editors") ? "Items":"Contents"), "entertainment/getinvolved/".$sUserType."/pending"),
					);

	drupal_set_breadcrumb($aBreadcrumb);
	drupal_set_html_head('<style>#cont-col .ind {padding:10px 30px 20px 30px !important;} input, textarea{width:400px; margin:3px; padding:3px;}</style>');

	if ($sType == "site"  || $sType == "animation"){
		$sqlQuery = "SELECT A.id, A.sSiteType, A.group_level AS iGroupLevel, A.title AS sSubject, A.url, A.sAgeGroup,
						A.promoted AS iStatusId, A.fid AS iRefId, B.name, A.sTags, A.sSubType AS sFiledUnder,
						IF(A.description IS NULL, 'No description avaiable.', A.description) AS sDescription, A.iUserId AS iGuideId, A.iEditorId,
						C.title AS sSubject_orig, IF(C.description IS NULL, 'No description avaiable.', C.description) AS sDescription_orig, C.sAgeGroup AS sAgeGroup_orig,
						C.url AS url_orig, C.sTags AS sTags_orig, C.group_level AS iGroupLevel_orig
					FROM mystudyrecord_suggested_site A
					LEFT JOIN mystudyrecord_site C ON C.id = A.fid";
	}else{
		$sqlQuery = "SELECT A.id, A.iUserId, A.sFileType, A.sFileId, A.sEmbedCode, A.iGroupLevel, A.iUserId AS iGuideId, A.iEditorId, A.sAgeGroup,
						A.sTitle AS sSubject, A.sDesc AS sDescription, B.name, A.sTags, A.iRefId, A.sFileGroup AS sFiledUnder,
						C.sTitle AS sSubject_orig, IF(C.sDesc IS NULL, 'No description avaiable.', C.sDesc) AS sDescription_orig, C.sEmbedCode AS sEmbedCode_orig, C.sTags AS sTags_orig, C.sAgeGroup AS sAgeGroup_orig,
						C.iGroupLevel AS iGroupLevel_orig
					FROM mystudyrecord_suggested_file A
					LEFT JOIN mystudyrecord_file C ON C.id = A.iRefId";
	}

	if ($sType == "site" || $sType == "animation"){
		$sVideoQuery = "";
	} else {
		$sVideoQuery = " OR A.sFileType = 'video_youtube'";
	}
	$sFieldName = ($sUserType == "editors") ? "iUserId":"iEditorId";
	$sqlQuery .= " LEFT JOIN users B ON B.uid = A.iUserId
					WHERE (A.".$sFieldName." IN ('".implode("','", $aDependentsId)."') " . $sVideoQuery . ")
						AND A.id = ".$iItemId." ";

	if ($sType == "site" || $sType == "animation"){
		$sqlQuery .= "AND A.sSiteType = '".$sType."' AND A.promoted IN (0, 2, 3) ";

		if ($sUserType == "editors"){
			$sqlQuery .= "AND (A.iEditorId IS NULL OR A.iEditorId = '')";
		}else{
			$sqlQuery .= "AND (A.iEditorId IS NOT NULL OR A.iEditorId != '')
							AND (A.iAdminId IS NULL OR A.iAdminId != '')";
		}

		$sqlQuery .= " ORDER BY B.name, A.promoted, sSubject";
	}else{
		$sqlQuery .= "AND A.sFileType IN ('".$sType."', '".$sType."_ext', '".$sType."_embed', '".$sType."_youtube') ";

		if ($sUserType == "editors"){
			$sqlQuery .= "AND (A.iEditorId IS NULL OR A.iEditorId = '')";
		}else{
			$sqlQuery .= "AND (A.iEditorId IS NOT NULL OR A.iEditorId != '')
							AND (A.iAdminId IS NULL OR A.iAdminId != '')";
		}

		$sqlQuery .= " ORDER BY B.name";
	}

	$oQueryResult = db_query($sqlQuery);

	$sTableHeader = '<div id="cbtop">
						<div class="cbb">
							<div class="left-border">
								<div class="right-border">
									<div class="jbox" style="width:980px">
										<div class="jboxhead"><h2></h2></div>
										<div class="jboxbody">
											<div class="jboxcontent">
												<div id="entertainment_editors_cats" style="display:none; position:absolute; left:320px; top:700px; z-index:5000;">
													<table style="background-color:#FFFFFF; border:5px solid #087C01;">
														<tr>
															<td style="padding:10px;"><ul id="entertainment_VolunteerCatList"></ul></td>
														</tr>
														<tr>
															<td style="text-align:right; padding:0px 10px 10px 0px;">
																<button type="button" id="entertainment_editors_cat_cancel" class="btn_blue_cancel_small"></button>
																<button type="button" id="entertainment_editors_cat_set" class="btn_blue_ok"></button>
															</td>
														</tr>
													</table>
												</div>
												<form action="'.base_path().'entertainment/getinvolved/'.$sUserType.'/pending/edit/process" method="post">
												<table border="0" style="width:100%;">';
	$sTableFooter = '							</table></form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="jboxfoot"><p></p></div>
					</div>';
	$sPrevName = "";

	switch ($sType){
		case "image": $sNewType = "photo"; break;
		case "doc": $sNewType = "book"; break;
		default: $sNewType = $sType; break;
	}

	while ($oQuery = db_fetch_object($oQueryResult)){
		$iRecordCount++;
		$iId = $oQuery->id;
		$sSubject = stripslashes(@$oQuery->sSubject);
		$iGroupId = $oQuery->iGroupLevel;
		$sFullCat = _entertainment_get_full_cat($iGroupId);
		$sTags = $oQuery->sTags;
		$sDesc = $oQuery->sDescription;
		$iRefId = $oQuery->iRefId;
		$iGuideId = $oQuery->iGuideId;
		$iEditorId = $oQuery->iEditorId;
		$sFileId = $oQuery->sFileId;
		$sAgeGroup = $oQuery->sAgeGroup;
		$sFiledUnder = $oQuery->sFiledUnder;

		$sSubjectOrig = $oQuery->sSubject_orig;
		$sSubjectOrig = ($sSubjectOrig != "") ? $sSubjectOrig:$sSubject;

		$sDescOrig = $oQuery->sDescription_orig;
		$sDescOrig = ($sDescOrig != "No description avaiable.") ? $sDescOrig:$sDesc;

		$sTagsOrig = $oQuery->sTags_orig;
		$sTagsOrig = ($sTagsOrig != "") ? $sTagsOrig:$sTags;

		$sAgeGroupOrig = $oQuery->sAgeGroup_orig;
		$sAgeGroupOrig = ($sAgeGroupOrig != "") ? $sAgeGroupOrig : $sAgeGroup;

		$iGroupIdOrig = $oQuery->iGroupLevel_orig;
		$iGroupIdOrig = ($iGroupIdOrig != "") ? $iGroupIdOrig:$iGroupId;

		$sFullCatOrig = _entertainment_get_full_cat($iGroupIdOrig);

		if ($sPrevName != $oQuery->name){
			if ($sPrevName != ""){
				$sOutput .= '<tr>
								<td colspan="3" style="padding-top:5px;">
									<button type="submit" name="btnApprove" value="approve" class="btn_blue_approve"></button>&nbsp;
									<button type="submit" name="btnDisapprove" value="disapprove" class="btn_blue_disapprove"></button>
								</td>
							</tr>';
			}

			$sOutput .= '<tr><td colspan="3" style="padding-top:15px;"><h3>'.ucfirst($sNewType).' was submitted for approval by: <em>'.$oQuery->name.'</em></h3></td></tr>';
		}

		if ($sType != "site" && $sType != "animation"){
			$sFileType = $oQuery->sFileType;
			$sEmbedCode = $oQuery->sEmbedCode;

			if ($sSubType == "file"){
				$bYoutube = false;
				if (strpos($oQuery->sEmbedCode,"youtube.com/") !== false) {
					preg_match("/youtube\.com\/v\/([0-9a-zA-Z_-]+)/s",$oQuery->sEmbedCode,$aTmp);
					if (empty($aTmp[1]))
						preg_match("/youtube\.com\/watch\?v\=([0-9a-zA-Z_-]+)/s",$oQuery->sEmbedCode,$aTmp);
					if (!empty($aTmp[1])) {
						$bYoutube = true;
					}
				}


				$sFileHref = (substr($sFileType, -4) == "_ext" && !$bYoutube) ? $sEmbedCode:base_path().'entertainment/file/'.(str_replace(array("_embed","_ext"), array("",""), $oQuery->sFileType)).'/'.$iGroupId.'/view/'.$iId.'/admin';
				$sSubjectHTML = '<a id="entertainment_file_tooltip_'.$iId.'" href="'.$sFileHref.'" target="_blank" title="Click to view the file in a new tab/window.">'.$sSubjectOrig.'</a>';
				$sHTML = '<table style="width:100%;">
							<tr>
								<td>
									'._entertainment_list_changelog($iRefId, "file").'
									File Type: '.$sFileType.'
								</td>
							</tr>
						</table>';
			}

			$sOutput .= '<tr>
							<td style="width:0px;"></td>
							<td style="width:210px; padding:3px;">'.$sHTML.'</td>
							<td style="padding:3px;">
								<p><b>Category</b>: '.$sFullCatOrig.'</p>
								<p><b>Title</b>: '.$sSubjectHTML.'</p>
								<p><b>Tags</b>: '.$sTagsOrig.'</p>
								<p style="padding-bottom:5px;"><b>Age Group</b>: ' . ($sAgeGroupOrig == "" ? "All Ages" : $sAgeGroupOrig . " years old") . '<p>
								<b>Description:</b>
								<div>'.$sDescOrig.'</div>
							</td>
						</tr>';

			$sForm = '<input type="hidden" id="sFileType" name="entertainment_sFileType" value="'.$sFileType.'" />
						<input type="hidden" name="entertainment_iGuideId" value="'.$iGuideId.'" />';
			$aLastChanges = _entertainment_list_changelog_highlight($iRefId, "file");
			//dump_this($aLastChanges);

			if (in_array($sFileType, array("image", "doc", "video"))){
				$sForm .= '<table>
							<tr>
								<td style="width:100px; text-align:right; padding-right:10px; vertical-align:middle;">Title:</td>
								<td><input type="text" id="entertainment_sTitle" name="entertainment_sTitle" value="'.$sSubject.'" '.(($aLastChanges["bTitle"] == 1) ? 'style="background-color:#FFFFCC"':'').' /></td>
							</tr>
							<tr>
								<td style="width:100px; text-align:right; padding-right:10px; vertical-align:middle;">Age Group:</td>
								<td style="padding-left:3px;"><select id="sAgeGroup" name="sAgeGroup" '.(($aLastChanges["bTag"] == 1) ? 'style="background-color:#FFFFCC"':'').'>
									' . ($sAgeGroup == '-1' ? '<option value="-1" selected="selected">Not Yet Set</option>' : '') . '
									<option ' . ($sAgeGroup == '' ? 'selected="selected"' : '') . ' value="">All Age</option>
									<option ' . ($sAgeGroup == '7-9' ? 'selected="selected"' : '') . ' value="7-9">7 to 9 Years Old</option>
									<option ' . ($sAgeGroup == '10-12' ? 'selected="selected"' : '') . ' value="10-12">10 to 12 Years Old</option>
								</select>
								</td>
							</tr>

							<tr>
								<td style="text-align:right; padding:6px 10px 0px 0px;">Description:</td>
								<td><textarea id="entertainment_sFileDesc" name="entertainment_sFileDesc" style="height:100px; '.(($aLastChanges["bDesc"] == 1) ? 'background-color:#FFFFCC':'').'">'.$sDesc.'</textarea></td>
							</tr>
							<tr>
								<td style="text-align:right; padding-right:10px; vertical-align:middle;">Tags:</td>
								<td><input type="text" id="entertainment_sFileTags" name="entertainment_sFileTags" value="'.$sTags.'" '.(($aLastChanges["bTag"] == 1) ? 'style="background-color:#FFFFCC"':'').' /></td>
							</tr>
						</table>';
			}else{
				$sCondition = substr($sFileType, -4);
				$sCode = ($sCondition == "_ext") ? "":$sEmbedCode;
				$sExtURL = ($sCondition == "_ext") ? $sEmbedCode:"";

				if ($sCondition != "_ext"){
					$sCodeHTML = '<tr>
									<td style="text-align:right; padding:6px 10px 0px 0px;">Embed Code:</td>
									<td><textarea id="entertainment_sFileEmbedCode" name="entertainment_sFileEmbedCode" maxlength="5" style="height:100px; '.(($aLastChanges["bCodeURL"] == 1) ? 'background-color:#FFFFCC':'').'">'.$sCode.'</textarea></td>
								</tr>';
				}else{
					$sCodeHTML = '<tr>
									<td style="text-align:right; padding-right:10px; vertical-align:middle;">External URL:</td>
									<td><input type="text" id="entertainment_sFileEmbedURL" name="entertainment_sFileEmbedURL" value="'.$sExtURL.'" '.(($aLastChanges["bCodeURL"] == 1) ? 'style="background-color:#FFFFCC"':'').' /></td>
								</tr>';
				}
				$sForm .= '<input type="hidden" name="entertainment_sFileId" value="'.$sFileId.'" />
							<table>
								<tr>
									<td style="width:100px; text-align:right; padding-right:10px; vertical-align:middle;">Title:</td>
									<td><input type="text" id="entertainment_sTitle" name="entertainment_sTitle" value="'.$sSubject.'" '.(($aLastChanges["bTitle"] == 1) ? 'style="background-color:#FFFFCC"':'').' /></td>
								</tr>
								'.$sCodeHTML.'
								<tr>
									<td style="width:100px; text-align:right; padding-right:10px; vertical-align:middle;">Age Group:</td>
									<td><select id="sAgeGroup" name="sAgeGroup">
										' . ($sAgeGroup == '-1' ? '<option value="-1" selected="selected">Not Yet Set</option>' : '') . '
										<option ' . ($sAgeGroup == '' ? 'selected="selected"' : '') . ' value="">All Age</option>
										<option ' . ($sAgeGroup == '7-9' ? 'selected="selected"' : '') . ' value="7-9">7 to 9 Years Old</option>
										<option ' . ($sAgeGroup == '10-12' ? 'selected="selected"' : '') . ' value="10-12">10 to 12 Years Old</option>
									</select>
									</td>
								</tr>
								<tr>
									<td style="text-align:right; padding:6px 10px 0px 0px;">Description:</td>
									<td><textarea id="entertainment_sFileDesc" name="entertainment_sFileDesc" style="height:100px; '.(($aLastChanges["bDesc"] == 1) ? 'background-color:#FFFFCC':'').'">'.$sDesc.'</textarea></td>
								</tr>
								<tr>
									<td style="text-align:right; padding-right:10px; vertical-align:middle;">Tags:</td>
									<td><input type="text" id="entertainment_sFileTags" name="entertainment_sFileTags" value="'.$sTags.'" '.(($aLastChanges["bTag"] == 1) ? 'style="background-color:#FFFFCC"':'').' /></td>
								</tr>
								<tr>
									<td style="text-align:right; padding-right:10px; vertical-align:top;">Rating:</td>
									<td>'.rating_include_review("file", $sFileType, $iId).'</td>
								</tr>
							</table>';
			}
		}else{
			$sSiteURL = $oQuery->url;
			$sSiteURLOrig = ($iRefId == 0) ? $sSiteURL:$oQuery->url_orig;
			$iStatusId = $oQuery->iStatusId;
			$sImageURL = SHRINKTHEWEB.'&stwxmax=144&stwymax=108&stwinside=1&stwurl='.$sSiteURL;
			$aLastChanges = _entertainment_list_changelog_highlight($iId, "site");

			//dump_this($aLastChanges);

			if ($iStatusId == 3){
				$sqlOrig = "SELECT title AS sSubject_orig, IF(description IS NULL, 'No description avaiable.', description) AS sDescription_orig, sAgeGroup AS sAgeGroup_orig
								url AS url_orig, sTags AS sTags_orig, group_level AS iGroupLevel_orig
							FROM mystudyrecord_suggested_site
							WHERE id = %d";

				$oOrigResult = db_query($sqlOrig, $iRefId);
				$oOrig = db_fetch_object($oOrigResult);
				$sAgeGroupOrig = $oOrig->sAgeGroup_orig;
				$sSubjectOrig = $oOrig->sSubject_orig;
				$sDescOrig = $oOrig->sDescription_orig;
				$sTagsOrig = $oOrig->sTags_orig;
				$iGroupIdOrig = $oOrig->iGroupLevel_orig;
				$sFullCatOrig = _entertainment_get_full_cat($iGroupIdOrig);
			}

			if ($iStatusId == 0 || $iStatusId == 2){
				$iRefLogId = $iId;
			}else{
				$iRefLogId = $iRefId;
			}

			$sOutput .= '<tr>
							<td style="width:0px;"></td>
							<td style="width:210px; padding:3px 3px 10px 0px; text-align:center;">
								'._entertainment_list_changelog($iRefLogId, "site").'
								<a id="entertainment_file_tooltip_'.$iId.'" href="'.$sSiteURL.'" target="_blank" title="Click to view the site in a new tab/window."><img src="'.$sImageURL.'" width="144" alt="'.$sSubjectOrig.'" /></a>
							</td>
							<td style="padding:3px 3px 10px 20px;">
								<table style="width:100%;">
									<tr>
										<th>Original Version</th>
									</tr>
									<tr>
										<td>
											<p>Site Type: '.ucwords($oQuery->sSiteType).'</p>
											<p style="padding-bottom:5px;">1Category: '.$sFullCatOrig.'</p>

											<div><b>Title:</b> <a id="entertainment_file_tooltip_'.$iId.'" href="'.$sSiteURL.'" target="_blank" title="Click to view the site in a new tab/window.">'.$sSubjectOrig.'</a></div>
											<div><b>URL:</b> '.$sSiteURLOrig.'</div>
											<div><b>Tags:</b> '.$sTagsOrig.'</div>
											<div style="padding-bottom:5px;"><b>Age Group:</b> ' . ($sAgeGroupOrig == "" ? "All Ages" : $sAgeGroupOrig . " years old") . '</div>
											<b>Description:</b>

											<div>'.$sDescOrig.'</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>';

			$sForm = '<input type="hidden" name="entertainment_iStatusId" value="'.$iStatusId.'" />
					<table>
						<tr>
							<td style="width:100px; text-align:right; padding-right:10px; vertical-align:middle;">URL:</td>
							<td><input type="text" id="entertainment_sURL" name="entertainment_sURL" value="'.$sSiteURL.'" '.(($aLastChanges["bCodeURL"] == 1) ? 'style="background-color:#FFFFCC"':'').' /></td>
						</tr>
						<tr>
							<td style="text-align:right; padding-right:10px; vertical-align:middle;">Title:</td>
							<td><input type="text" id="entertainment_sTitle" name="entertainment_sTitle" value="'.$sSubject.'" '.(($aLastChanges["bTitle"] == 1) ? 'style="background-color:#FFFFCC"':'').' /></td>
						</tr>
						<tr>
							<td style="text-align:right; padding-right:10px; vertical-align:middle;">Tags:</td>
							<td><input type="text" id="entertainment_sTags" name="entertainment_sTags" value="'.$sTags.'" '.(($aLastChanges["bTag"] == 1) ? 'style="background-color:#FFFFCC"':'').' /></td>
						</tr>
						<tr>
							<td style="text-align:right; padding-right:10px; vertical-align:middle;">Age Group:</td>
							<td style="padding-left:3px;"><select id="sAgeGroup" name="sAgeGroup" '.(($aLastChanges["bTag"] == 1) ? 'style="background-color:#FFFFCC"':'').'>
								' . ($sAgeGroup == '-1' ? '<option value="-1" selected="selected">Not Yet Set</option>' : '') . '
								<option ' . ($sAgeGroup == '' ? 'selected="selected"' : '') . ' value="">All Age</option>
								<option ' . ($sAgeGroup == '7-9' ? 'selected' : '') . ' value="7-9">7 to 9 Years Old</option>
								<option ' . ($sAgeGroup == '10-12' ? 'selected' : '') . ' value="10-12">10 to 12 Years Old</option>
							</select>
							</td>
						</tr>

						<tr>
							<td style="text-align:right; padding:6px 10px 0px 0px;">Description:</td>
							<td><textarea id="entertainment_sDesc" name="entertainment_sDesc" style="height:100px; '.(($aLastChanges["bDesc"] == 1) ? 'background-color:#FFFFCC':'').'">'.$sDesc.'</textarea></td>
						</tr>
						<tr>
							<td style="text-align:right; padding-right:10px; vertical-align:top;">Rating:</td>
							<td>'.rating_include_review($sType, $sFiledUnder, $iId).'</td>
						</tr>
					</table>';
		}

		$sPrevName = $oQuery->name;
	}

	$aItemType = explode("_", $sType);
	$sItemType = $aItemType[0];

	if ($sItemType == "site"){
		$sItemType = "Sites";
	}elseif ($sItemType == "image"){
		$sItemType = "Photos";
	}elseif ($sItemType == "doc"){
		$sItemType = "Books";
	}elseif ($sItemType == "video"){
		$sItemType = "Videos";
	}

	if (isset($sFiledUnder)){
		$sOptionSelect1 = ($sFiledUnder == "rec") ? "selected":"";
		$sOptionSelect2 = ($sFiledUnder == "other") ? "selected":"";
	}

	$sOutput .= '<tr>
					<td colspan="3"><hr/></td>
				</tr>
				<tr>
					<td colspan="3">
						<table>
							<tr>
								<td style="width:208px; padding:63px 3px 10px 3px;">
									File under:
									<select name="sSiteType" style="font-size:1em;">
										<option value="other" '.$sOptionSelect2.'>Other Great '.$sItemType.'</option>
										<option value="rec" '.$sOptionSelect1.'>Recommended '.$sItemType.'</option>
									</select>
									<br/><br />

									<button type="submit" id="btnEditApprove" name="btnEditApprove" value="approve" class="btn_blue_approve"></button>&nbsp;
									<button type="button" name="btnCancel" value="cancel" class="btn_blue_cancel_small" onclick="history.back(1);"></button>
									<br/><br/><br/>

									To '.(($sUserType == "editors") ? "edit":"administer").' a pending item, just edit the text in the blocks as desired and click the Approve button. The edited
									item will then be forwarded to the Administrator for final approval. Once approved, the Guide who recommended
									the item will be notified that his/her recommendation was approved with edits.
								</td>
								<td>
									<h3>Edited Version</h3>
									<p style="padding-bottom:15px;">2Category: <span id="entertainment_editors_full_cat">'.$sFullCat.'</span></p>

									<input type="hidden" id="volunteer_iGroupId" name="entertainment_iGroupId" value="'.$iGroupId.'" />
									<input type="hidden" name="entertainment_iRefId" value="'.$iRefId.'" />
									<input type="hidden" name="entertainment_iGuideId" value="'.$iGuideId.'" />
									<input type="hidden" name="entertainment_iEditorId" value="'.$iEditorId.'" />
									<input type="hidden" name="entertainment_iItemId" value="'.$iId.'" />
									<input type="hidden" name="entertainment_sType" value="'.$sType.'" />

									'.$sForm.'
								</td>
							</tr>
						</table>
					</td>
				</tr>';

	if ($iRecordCount == 0){
		$sOutput .= '<tr><td style="padding-top:15px;">Selected '.$sNewType.' to edit is not available.</td></tr>';
	}

	return $sTableHeader.$sOutput.$sTableFooter;
}

function entertainment_get_full_cat($iGroupId){
	echo _entertainment_get_full_cat($iGroupId);
	exit;
}

function entertainment_editors_pending_items_edit_process($sUserType="editors"){
	global $user, $sMessage;

	$sBasePath = base_path();

	//dump_this($_REQUEST);

	foreach ($_REQUEST as $sKey => $sData) {
		${$sKey} = $sData;
	}

	if ($entertainment_sType == "site"){
		$sTypeRedirect = "sites";
	}elseif ($entertainment_sType == "image"){
		$sTypeRedirect = "photos";
	}elseif ($entertainment_sType == "doc"){
		$sTypeRedirect = "books";
	}elseif ($entertainment_sType == "video"){
		$sTypeRedirect = "videos";
	}elseif ($entertainment_sType == "animation"){
		$sTypeRedirect = "animations";
	}

	$aBreadcrumb = array(
						l("Home", "<front>"),
						l("Get Involved", "entertainment/getinvolved"),
						l((($sUserType == "editors") ?"Editors":"Administrators"), "entertainment/getinvolved/".$sUserType),
						l("Pending ".(($sUserType == "editors") ? "Items":"Contents"), "entertainment/getinvolved/".$sUserType."/pending/".$sTypeRedirect)
					);

	drupal_set_breadcrumb($aBreadcrumb);
	drupal_add_js('setTimeout("location=\''.$sBasePath.'entertainment/getinvolved/'.$sUserType.'/pending/'.$sTypeRedirect.'\'", 5000)', "inline");


	$sFieldName = ($sUserType == "editors") ? "iEditorId":"iAdminId";
	$entertainment_sTitle = ucwords($entertainment_sTitle);

	$iRefId_old = null;
	$iRefId_new = $entertainment_iRefId;

	$sqlDelete = "DELETE FROM %s WHERE id IN (%s)";

	if ($sUserType == "editors"){
		$iEditorId = $user->uid;

		if ($entertainment_sType == "site" || $entertainment_sType == "animation"){
			if ($entertainment_iStatusId == 0) $iRefId_new = $entertainment_iItemId;

			$sqlUpdate = "UPDATE mystudyrecord_suggested_site
							SET group_level = %d,  title = '%s', url = '%s', description = '%s', sTags = '%s', iEditorId = %d, sSubType = '%s', sAgeGroup = '%s'
							WHERE id = %d";
			$aParam = array($entertainment_iGroupId, $entertainment_sTitle, $entertainment_sURL, $entertainment_sDesc, $entertainment_sTags, $iEditorId, $sSiteType, $sAgeGroup, $entertainment_iItemId);
		}else{
			if ($entertainment_iRefId == 0) $iRefId_new = $entertainment_iItemId;

			$sqlUpdate = "UPDATE mystudyrecord_suggested_file
							SET sEmbedCode = '%s', iGroupLevel = %d, sTitle = '%s', sDesc = '%s', sTags = '%s', iEditorId = %d, sFileGroup = '%s', sAgeGroup = '%s'
							WHERE id = %d";
			$sCondition = substr($entertainment_sFileType, -4);
			$sEmbedCode = ($sCondition == "_ext") ? $entertainment_sFileEmbedURL:$entertainment_sFileEmbedCode;
			$aParam = array($sEmbedCode, $entertainment_iGroupId, $entertainment_sTitle, $entertainment_sFileDesc, $entertainment_sFileTags, $iEditorId, $sSiteType, $sAgeGroup, $entertainment_iItemId);
		}

		db_query($sqlUpdate, $aParam);
	}else{
		$iAdminId = $user->uid;

		$sqlUpdateStat = "UPDATE mystudies_volunteer
							SET iApprovedCount = IFNULL(iApprovedCount, 0) + 1
							WHERE uid = %d
								AND `type` = 'guide'";
		db_query($sqlUpdateStat, $entertainment_iGuideId);

		if ($entertainment_sType == "site" || $entertainment_sType == "animation"){
			if ($sSiteType == "other"){
				if ($entertainment_iStatusId == 3){
					$sqlUpdate = "UPDATE mystudyrecord_suggested_site
									SET fid = 0, promoted = 1, group_level = %d,  title = '%s', url = '%s', description = '%s', sTags = '%s', iAdminId = %d, sSubType = '%s', sAgeGroup = '%s'
									WHERE id = %d";
					$aAdminParam = array($entertainment_iGroupId, $entertainment_sTitle, $entertainment_sURL, $entertainment_sDesc, $entertainment_sTags, $iAdminId, $sSiteType, $sAgeGroup, $entertainment_iItemId);

					db_query($sqlUpdate, $aAdminParam);

					$iRefId_old = $entertainment_iRefId;
					$iRefId_new = $entertainment_iItemId;

					db_query($sqlDelete, array("mystudyrecord_suggested_site", $entertainment_iRefId));
				}elseif ($entertainment_iStatusId == 2){
					$sqlUpdate = "UPDATE mystudyrecord_suggested_site
									SET fid = 0, promoted = 1, group_level = %d,  title = '%s', url = '%s', description = '%s', sTags = '%s', iAdminId = %d, sSubType = '%s', sAgeGroup = '%s'
									WHERE id = %d";
					$aAdminParam = array($entertainment_iGroupId, $entertainment_sTitle, $entertainment_sURL, $entertainment_sDesc, $entertainment_sTags, $iAdminId, $sSiteType, $sAgeGroup, $entertainment_iItemId);

					db_query($sqlUpdate, $aAdminParam);

					$iRefId_old = $entertainment_iRefId;
					$iRefId_new = $entertainment_iItemId;

					db_query($sqlDelete, array("mystudyrecord_site", $entertainment_iRefId));
				}else{
					$sqlUpdate = "UPDATE mystudyrecord_suggested_site
									SET promoted = 1, group_level = %d,  title = '%s', url = '%s', description = '%s', sTags = '%s', iAdminId = %d, sSubType = '%s', sAgeGroup = '%s'
									WHERE id = %d";
					$aAdminParam = array($entertainment_iGroupId, $entertainment_sTitle, $entertainment_sURL, $entertainment_sDesc, $entertainment_sTags, $iAdminId, $sSiteType, $sAgeGroup, $entertainment_iItemId);

					db_query($sqlUpdate, $aAdminParam);
				}
			}else{
				if ($entertainment_iStatusId == 3){
					$sqlInsert = "INSERT INTO mystudyrecord_site VALUES(NULL, '%s', %d, '%s', '%s', '%s', '%s', %d, %d, %d, '%s')";
					$aAdminParam = array($entertainment_sType, $entertainment_iGroupId, $entertainment_sTitle, $entertainment_sURL, $entertainment_sDesc, $entertainment_sTags, $entertainment_iGuideId, $entertainment_iEditorId, $iAdminId, $sAgeGroup);

					db_query($sqlInsert, $aAdminParam);

					$iRefId_old = $entertainment_iRefId;
					$iRefId_new = db_last_insert_id("mystudyrecord_site", "id");

					db_query($sqlDelete, array("mystudyrecord_suggested_site", $entertainment_iRefId.",".$entertainment_iItemId));
				}elseif ($entertainment_iStatusId == 2){
					$sqlUpdate = "UPDATE mystudyrecord_site
									SET group_level = %d, title = '%s', url = '%s', description = '%s', sTags = '%s', iAdminId = %d, sAgeGroup = '%s'
									WHERE id = %d";
					$aAdminParam = array($entertainment_iGroupId, $entertainment_sTitle, $entertainment_sURL, $entertainment_sDesc, $entertainment_sTags, $iAdminId, $entertainment_iRefId, $sAgeGroup);

					db_query($sqlUpdate, $aAdminParam);
					db_query($sqlDelete, array("mystudyrecord_suggested_site", $entertainment_iItemId));
				}else{
					$sqlInsert = "INSERT INTO mystudyrecord_site VALUES(NULL, '%s', %d, '%s', '%s', '%s', '%s', %d, %d, %d, '%s')";
					$aAdminParam = array($entertainment_sType, $entertainment_iGroupId, $entertainment_sTitle, $entertainment_sURL, $entertainment_sDesc, $entertainment_sTags, $entertainment_iGuideId, $entertainment_iEditorId, $iAdminId, $sAgeGroup);

					db_query($sqlInsert, $aAdminParam);

					$iRefId_old = $entertainment_iItemId;
					$iRefId_new = db_last_insert_id("mystudyrecord_site", "id");

					db_query($sqlDelete, array("mystudyrecord_suggested_site", $entertainment_iItemId));
				}
			}
		}else{
			$sqlInsert = "INSERT INTO mystudyrecord_file VALUES(NULL, '%s', '%s', '%s', %d, '%s', '%s', '%s', %d, %d, %d, 'rec', '%s')";
			$sCondition = substr($entertainment_sFileType, -4);
			$sEmbedCode = ($sCondition == "_ext") ? $entertainment_sFileEmbedURL:$entertainment_sFileEmbedCode;
			$aAdminParam = array($entertainment_sFileType, $entertainment_sFileId, $sEmbedCode, $entertainment_iGroupId, $entertainment_sTitle, $entertainment_sFileDesc, $entertainment_sFileTags, $iGuideId, $iEditorId, $iAdminId, $sAgeGroup);

			db_query($sqlInsert, $aAdminParam);

			$iRefId_old = $entertainment_iItemId;
			$iRefId_new = db_last_insert_id("mystudyrecord_file", "id");
			if ($entertainment_sFileType == "doc_ext")
				file_get_contents("http://images.shrinktheweb.com/xino.php?stwembed=1&stwu=1aaf6&stwaccesskeyid=85755ac2242b24a&stwxmax=512&stwymax=384&stwinside=1&stwdelay=5&stwurl=http://firstearthalliance.org/viewer.php?pg=" . $iRefId_new);


			db_query($sqlDelete, array("mystudyrecord_suggested_file", $entertainment_iItemId));
		}
	}


	/* if ($mystudies_sType == "site"){
		$sPromoteField = ($sUserType == "admins") ? ", promoted = 1":"";
		$sWhere = "title = '%s', url = '%s', description = '%s', sTags = '%s', %s = %d, sSubType = '%s'".$sPromoteField;
		$aParam = array($mystudies_sTitle, $mystudies_sURL, $mystudies_sDesc, $mystudies_sTags, $sFieldName, $user->uid, $sSiteType, $mystudies_iItemId);
	}else{
		$sWhere = "sEmbedCode = '%s', iGroupLevel = %d, sTitle = '%s', sDesc = '%s', sTags = '%s', %s = %d, sFileGroup = '%s'";

		$sCondition = substr($mystudies_sFileType, -4);
		$sEmbedCode = ($sCondition == "_ext") ? $mystudies_sFileEmbedURL:$mystudies_sFileEmbedCode;

		$aParam = array($sEmbedCode, $mystudies_iGroupId, $mystudies_sTitle, $mystudies_sFileDesc, $mystudies_sFileTags, $sFieldName, $user->uid, $sSiteType, $mystudies_iItemId);
	}

	$sqlCheck = "SELECT * FROM %s WHERE id = %d";
	$oCheckResult = db_query($sqlCheck, array($sTable, $mystudies_iItemId));
	$oCheck = db_fetch_object($oCheckResult);

	$bTitle = ($oCheck->title == $mystudies_sTitle) ? 0:1;

	$sDesc = ($sTable == "mystudyrecord_suggested_file") ? $oCheck->sDesc:$oCheck->description;
	$bDesc = ($sDesc == $mystudies_sDesc) ? 0:1;

	$sCodeURL = ($sTable == "mystudyrecord_suggested_file") ? $oCheck->sEmbedCode:$oCheck->url;
	$sCodeURL_new = ($mystudies_sType == "site" || $mystudies_sType == "animation") ? $mystudies_sURL:$sEmbedCode;
	$bCodeURL = ($sCodeURL == $sCodeURL_new) ? 0:1;

	$sTag = ($mystudies_sType == "site" || $mystudies_sType == "animation") ? $mystudies_sTags:$mystudies_sFileTags;
	$bTag = ($oCheck->sTags == $sTag) ? 0:1;

	$bCat = ($oCheck->group_level == $mystudies_iGroupId) ? 0:1;
	$sSubType = ($mystudies_sType == "site" || $mystudies_sType == "animation") ? $mystudies_sType:"file";

	$iRefId_old = null;
	$iRefId_new = $mystudies_iItemId;

	$sqlUpdate = "UPDATE ".$sTable." SET ".$sWhere." WHERE id = %s";
	db_query($sqlUpdate, $aParam);

	if ($sUserType == "admins"){
		$sAddlField = ($mystudies_sType == "site" || $mystudies_sType == "animation") ? "fid AS iRefId, ":"iRefId, sFileId, ";
		$sqlQuery = "SELECT %s iUserId, iEditorId, iAdminId FROM %s WHERE id = %d";
		$oQueryResult = db_query($sqlQuery, array($sAddlField, $sTable, $mystudies_iItemId));
		$oQuery = db_fetch_object($oQueryResult);

		$iRefId = $oQuery->iRefId;
		$iGuideId = $oQuery->iUserId;
		$iEditorId = $oQuery->iEditorId;
		$iAdminId = $oQuery->iAdminId;

		$sqlDelete = "DELETE FROM %s WHERE id = %d";

		if ($mystudies_sType == "site" || $mystudies_sType == "animation"){
			if ($iRefId != 0){
				$iRefId_new = $iRefId;
				$sqlUpdate = "UPDATE mystudyrecord_site
								SET group_level = %d, title = '%s', url = '%s', description = '%s', sTags = '%s'
								WHERE id = %d";

				db_query($sqlUpdate, array($mystudies_iGroupId, $mystudies_sTitle, $mystudies_sURL, $mystudies_sDesc, $mystudies_sTags, $iRefId));
				db_query($sqlDelete, array($sTable, $mystudies_iItemId));
			}else{
				if ($sSiteType == "rec"){
					$sqlInsert = "INSERT INTO mystudyrecord_site VALUES(NULL, '%s', %d, '%s', '%s', '%s', '%s', %d, %d, %d)";
					$aAdminParam = array($mystudies_sType, $mystudies_iGroupId, $mystudies_sTitle, $mystudies_sURL, $mystudies_sDesc, $mystudies_sTags, $iGuideId, $iEditorId, $iAdminId);

					db_query($sqlInsert, $aAdminParam);

					$iRefId_old = $mystudies_iItemId;
					$iRefId_new = db_last_insert_id("mystudyrecord_site", "id");

					db_query($sqlDelete, array($sTable, $mystudies_iItemId));
				}
			}
		}else{
			if ($iRefId != 0){
				$iRefId_new = $iRefId;
				$sqlUpdate = "UPDATE mystudyrecord_file
								SET sEmbedCode = '%s', iGroupLevel = %d, sTitle = '%s', sDesc = '%s', sTags = '%s'
								WHERE id = %d";

				db_query($sqlUpdate, array($sEmbedCode, $mystudies_iGroupId, $mystudies_sTitle, $mystudies_sFileDesc, $mystudies_sFileTags, $iRefId));
			}else{
				$sFileId = $oQuery->sFileId;
				$sqlInsert = "INSERT INTO mystudyrecord_file VALUES(NULL, '%s', '%s', '%s', %d, '%s', '%s', '%s', %d, %d, %d)";
				$aAdminParam = array($mystudies_sType, $sFileId, $sEmbedCode, $mystudies_iGroupId, $mystudies_sTitle, $mystudies_sFileDesc, $mystudies_sFileTags, $iGuideId, $iEditorId, $iAdminId);

				db_query($sqlInsert, $aAdminParam);

				$iRefId_old = $mystudies_iItemId;
				$iRefId_new = db_last_insert_id("mystudyrecord_file", "id");
			}

			db_query($sqlDelete, array($sTable, $mystudies_iItemId));
		}
	} */

	$sTable = ($entertainment_sType == "site" || $entertainment_sType == "animation") ? "mystudyrecord_suggested_site":"mystudyrecord_suggested_file";
	$sqlCheck = "SELECT * FROM %s WHERE id = %d";
	$oCheckResult = db_query($sqlCheck, array($sTable, $entertainment_iItemId));
	$oCheck = db_fetch_object($oCheckResult);

	$bTitle = ($oCheck->title == $entertainment_sTitle) ? 0:1;

	$sDesc = ($sTable == "mystudyrecord_suggested_file") ? $oCheck->sDesc:$oCheck->description;
	$bDesc = ($sDesc == $entertainment_sDesc) ? 0:1;

	$sCodeURL = ($sTable == "mystudyrecord_suggested_file") ? $oCheck->sEmbedCode:$oCheck->url;
	$sCodeURL_new = ($entertainment_sType == "site" || $entertainment_sType == "animation") ? $entertainment_sURL:$sEmbedCode;
	$bCodeURL = ($sCodeURL == $sCodeURL_new) ? 0:1;

	$sTag = ($entertainment_sType == "site" || $entertainment_sType == "animation") ? $entertainment_sTags:$entertainment_sFileTags;
	$bTag = ($oCheck->sTags == $sTag) ? 0:1;

	$bCat = ($oCheck->group_level == $entertainment_iGroupId) ? 0:1;
	$sSubType = ($entertainment_sType == "site" || $entertainment_sType == "animation") ? "site":"file";

	$sqlLog = "SELECT id FROM mystudies_volunteer_changelog WHERE iRefId = %d";
	$iLogRefId = db_result(db_query($sqlLog, $entertainment_iItemId));

	_entertainment_volunteer_changelog(substr($sUserType, 0, strlen($sUserType)-1), $iLogRefId, $iRefId_new, $sSubType, $bTitle, $bDesc, $bCodeURL, $bTag, $bCat, $sSiteType, $iRefId_old);

	// Point System for Suggestion - Approve
	userpoints_userpointsapi(array("tid" => 196));

	$aItemType = explode("_", $entertainment_sType);
	$sItemType = $aItemType[0];

	if ($sItemType == "site"){
		$sItemType = "Site";
	}elseif ($sItemType == "image"){
		$sItemType = "Photo";
	}elseif ($sItemType == "doc"){
		$sItemType = "Book";
	}elseif ($sItemType == "video"){
		$sItemType = "Video";
	}

	$sMessage = "Recommended ".$sItemType.", ".$entertainment_sTitle.", has been successfully ".(($sUserType == "editors") ? "edited":"administered").".";
	$sOutput = drupal_eval(load_etemplate('page-confirmation'));

	return $sOutput;
}

function entertainment_editors_pending_cats(){
	global $user;

	drupal_set_breadcrumb(
		array(
			l("Home", "<front>"),
			l("Get Involved", "entertainment/getinvolved"),
			l("Administrators", "entertainment/getinvolved/admins"),
			l("Pending Subjects", "entertainment/getinvolved/admin/pending/subjects"),
		)
	);

	$aEditors = _entertainment_volunteer_assignments($iUserId, "admin");
	$bCanDoSomething = (count($aEditors) > 0) ? true:false;

	if (!$bCanDoSomething){
		$sDialogJS = '$("document").ready(
						function(){
							if ($("#entertainment_NoFeatureDialog_EditorAdmin").length == 1){
								$("#entertainment_NoFeatureDialog_EditorAdmin").dialog(
									{
										autoOpen: true,
										resizable: false,
										modal: true,
										width: 500,
										buttons: {
											"Go to Dashboard": function() {
												location = "'.$sBasePath.'entertainment/getinvolved/'.(($sUserType == "editors") ? "editors":"admins").'";
											}
										}
									}
								);
							}
						}
					)';

		drupal_add_js($sDialogJS, "inline");

		return '<div id="entertainment_NoFeatureDialog_EditorAdmin" title="Administrator Notice">
					<p>You cannot administer any contents, yet. Please wait for, at least, an Editor to be assigned to you first.</p>
				</div>';
	}

	drupal_set_html_head('<style>#cont-col .ind {padding:10px 30px 20px 30px !important;}</style>');

	$sBasePath = base_path();
	$aDependentsId = _entertainment_volunteer_dependents("admins");
	$sOutput = '';
	$sqlQuery = "SELECT A.id, A.iGroupLevel, A.sSubject, A.sIcon, A.sDescription, A.iRefId, B.name
				FROM mystudyrecord_suggested_subj A
				INNER JOIN users B ON B.uid = A.iUserId
				ORDER BY B.name, A.sSubject";

	$oQueryResult = db_query($sqlQuery);
	$sTableHeader = '<form action="'.$sBasePath.'entertainment/getinvolved/process/pending/subjects/admin" method="post" style="color:#000">
						<div id="cbtop">
							<div class="cbb">
								<div class="left-border">
									<div class="right-border">';
	$sTableFooter = '				</div>
								</div>
							</div>
						<div>
					</form>';
	$sPrevName = "";
	$iRecordCount = 0;

	$sDelOutput = "";

	$sqlItemDelete = "SELECT A.iGroupLevel, A.sType, A.iRefId, A.sComment, B.title AS sSubject
						FROM mystudyrecord_suggested_delete A
						INNER JOIN mystudyrecord B ON B.id = A.iRefId
						WHERE A.iUserId IN (%s)
							AND A.sType = 'subject'";

	$oSiteDeleteResult = db_query($sqlItemDelete, array(implode(", ", $aDependentsId)));

	while ($oSiteDelete = db_fetch_object($oSiteDeleteResult)){
		$iRecordCount++;

		$aFileType = explode("_", $oSiteDelete->sFileType);
		$sDelOutput .= '<div class="jbox" style="width:980px">
							<div class="jboxhead"><h2></h2></div>
							<div class="jboxbody">
								<div class="jboxcontent">
									<table >
										<tr>
											<td style="padding-top:3px;"><input type="checkbox" name="subject_id[]" value="'.$oSiteDelete->iRefId.'" /></td>
											<td style="width:150px; padding:3px 3px 10px 3px;">
												<img src="'.$sBasePath.'entertainment/image/main/'.$oSiteDelete->iRefId.'" width="194" alt="'.$oSiteDelete->sSubject.'" />
											</td>


											<td style="padding:3px 3px 10px 5px;">
												<p style="padding-bottom:5px;">3Category: '._entertainment_get_full_cat($oSiteDelete->iGroupLevel).'</p>

												<table style="width:100%;">
												<tr>
													<th>For Deletion</th>
												</tr>
												<tr>
													<td>
														<div><b>Subject:</b> '.$oSiteDelete->sSubject.'</div>
														<b>Comment/Reason:</b>
														<div>'.$oSiteDelete->sComment.'</div>
													</td>
												</tr>
												</table>
											</td>
										</tr>
									</table>
								</div>
							</div>
							<div class="jboxfoot"><p></p></div>
						</div>
						<hr class="divider" style="margin:5px 0 5px 0;width:980px" />';
	}

	if ($sDelOutput != "") $sOutput .= '<div class="jboxh" style="width:980px"><div class="jboxhead"><h2>The following was submitted for deletion:</h2></div></div>'.$sDelOutput;

	while ($oQuery = db_fetch_object($oQueryResult)){
		$iRecordCount++;
		$iId = $oQuery->id;
		$iImageId = ($oQuery->iRefId != 0) ? $oQuery->iRefId:$iId;
		$sSubject = $oQuery->sSubject;

		if ($oQuery->iRefId != 0){
			$sNotice = "Edited Subject";
			$sHTML = '<img src="'.$sBasePath.'entertainment/image/main/'.$oQuery->iRefId.'" width="194" alt="'.$sSubject.'" />';
		}else{
			$sNotice = "New Subject";
			$sHTML = '<img src="'.$sBasePath.'entertainment/image/subject/'.$iId.'" width="194" alt="'.$sSubject.'" />';
		}

		if ($sPrevName != $oQuery->name){
			if ($sPrevName != ""){
				$sOutput .= '<div style="text-align:right;padding-right:30px;">
									<button type="submit" name="btnApprove" value="approve" class="btn_blue_approve"></button>&nbsp;
									<button type="submit" name="btnDisapprove" value="disapprove" class="btn_blue_disapprove"></button>
							</div>';
			}

			$sOutput .= '<div class="jboxh" style="width:980px"><div class="jboxhead"><h2>Subject was submitted for approval by: <em>'.$oQuery->name.'</em></div></div>';
		}

		$sOutput .= '<div class="jbox" style="width:980px">
						<div class="jboxhead"><h2></h2></div>
						<div class="jboxbody">
							<div class="jboxcontent">
								<table>
									<tr>
										<td style="padding-top:3px;"><input type="checkbox" name="id[]" value="'.$iId.'" /></td>
										<td style="width:200px; padding:3px;">'.$sHTML.'</td>
										<td style="padding:5px 5px 5px 5px;">
											<b>'.$sNotice.'</b>
											<p style="padding-bottom:5px;">4Category: '._entertainment_get_full_cat($oQuery->iGroupLevel).'</p>
											<u>'.$oQuery->sSubject.'</u><br />
											'.$oQuery->sDescription.'
										</td>
									</tr>
								</table>
							</div>
						</div>
						<div class="jboxfoot"><p></p></div>
					</div>
					<hr class="divider" style="margin:5px 0 5px 0;width:980px" />';

		$sPrevName = $oQuery->name;
	}

	if ($iRecordCount > 0){
		$sOutput .= '<div style="text-align:right;padding-right:30px;">
							<button type="submit" name="btnApprove" value="approve" class="btn_blue_approve"></button>&nbsp;
							<button type="submit" name="btnDisapprove" value="disapprove" class="btn_blue_disapprove"></button>
					</div>';
	}else{
		$sOutput .= '<div class="sysnotice">No suggested Subject(s) to approve/disapprove, yet.</div>';
	}

	return $sTableHeader.$sOutput.$sTableFooter;
}

function entertainment_editors_pending_cats_process(){
	global $user;

	foreach ($_REQUEST as $sKey => $sData) {
		${$sKey} = $sData;
	}

	//dump_this($_REQUEST);

	drupal_set_breadcrumb(
		array(
			l("Home", "<front>"),
			l("Get Involved", "entertainment/getinvolved"),
			l("Administrators", "entertainment/getinvolved/admins"),
			l("Pending Subjects", "entertainment/getinvolved/admin/pending/subjects"),
		)
	);

	drupal_add_js('setTimeout("location=\''.base_path().'entertainment/getinvolved/admin/pending/subjects\'", 5000)', "inline");

	if (isset($_REQUEST["btnApprove"])){
		if (count($subject_id) > 0){
			for ($i=0; $i<count($subject_id); $i++){
				$iItemId = $subject_id[$i];
				$aSubjId = _entertainment_recurse_subj($iItemId);

				$sSubjId = implode(",", $aSubjId["aSubjectId"]);
				$sDataId = implode(",", $aSubjId["aContentId"]);

				$sqlDelSubj = "DELETE FROM mystudyrecord WHERE id IN (%s)";
				$sqlDelData1 = "DELETE FROM mystudyrecord_file WHERE iGroupLevel IN (%s)";
				$sqlDelData2 = "DELETE FROM mystudyrecord_site WHERE group_level IN (%s)";
				$sqlDelData3 = "DELETE FROM mystudyrecord_suggested_delete WHERE iGroupLevel IN (%s)";
				$sqlDelData4 = "DELETE FROM mystudyrecord_suggested_desc WHERE fid IN (%s)";
				$sqlDelData4 = "DELETE FROM mystudyrecord_suggested_file WHERE iGroupLevel IN (%s)";
				$sqlDelData5 = "DELETE FROM mystudyrecord_suggested_icon WHERE fid IN (%s)";
				$sqlDelData6 = "DELETE FROM mystudyrecord_suggested_site WHERE group_level IN (%s)";
				$sqlDelData7 = "DELETE FROM mystudyrecord_suggested_subj WHERE iGroupLevel IN (%s)";
				$sqlDelData8 = "DELETE FROM mystudyrecord_suggested_title WHERE fid IN (%s)";

				db_query($sqlDelSubj, $sSubjId);
				//echo str_replace("%s", $sSubjId, $sqlDelSubj)."<br />";

				if (count($aSubjId["aContentId"]) > 0){
					for ($i=1; $i<=8; $i++){
						db_query(${"sqlDelData".$i}, $sDataId);
						//echo str_replace("%s", $sDataId, ${"sqlDelData".$i})."<br />";
					}
				}
			}

			$sMessage = "Selected subject(s) have been deleted.";
		}
	}else{
		if (count($subject_id) > 0){
			for ($i=0; $i<count($subject_id); $i++){
				$iItemId = $subject_id[$i];
				$sqlDelete = "DELETE FROM mystudyrecord_suggested_delete WHERE sType = 'subject' AND iRefId = %d";

				db_query($sqlDelete, $iItemId);
			}
		}
	}

	if (isset($id)){
		$sSubjectList = "";
		$sqlDelete = "DELETE FROM mystudyrecord_suggested_subj WHERE id = %d";
		$sqlCat = "SELECT id, iUserId, iRefId, iGroupLevel, sSubject, sIcon, sDescription, sLeaf
					FROM mystudyrecord_suggested_subj
					WHERE id IN (%d)";
		$oCatResult = db_query($sqlCat, implode(",", $id));

		while ($oCat = db_fetch_object($oCatResult)){
			$iItemId = $oCat->id;
			$iRefId = $oCat->iRefId;
			$sSubject = $oCat->sSubject;

			$sSubjectList .= (strlen($sSubjectList) > 0) ? ", ":"";
			$sSubjectList .= $sSubject;

			$sDescription = $oCat->sDescription;
			$sIcon = $oCat->sIcon;

			if (isset($_REQUEST["btnApprove"])){
				if ($iRefId != 0){
					$sqlUpdate = "UPDATE mystudyrecord
									SET `desc` = '%s', title = '%s'
									WHERE id = %d";

					db_query($sqlUpdate, array($sDescription, $sSubject, $iRefId));

					if ($sIcon != ""){
						$sqlUpdate = "UPDATE mystudyrecord SET icon = %b WHERE id = %d";
						db_query($sqlUpdate, array($sIcon, $iRefId));
					}
				}else{
					$sqlInsert = "INSERT mystudyrecord
									SELECT NULL, iGroupLevel, sSubject, sLeaf, sIcon, sDescription
									FROM mystudyrecord_suggested_subj
									WHERE id = %d";
					db_query($sqlInsert, $iItemId);
				}

				db_query($sqlDelete, $iItemId);

				// Point System for Suggestion - Approve
				userpoints_userpointsapi(array("tid" => 196));
			}else{
				db_query($sqlDelete, $iItemId);

				// Point System for Suggestion - Disapprove
				userpoints_userpointsapi(array("uid" => $oCat->iUserId, "tid" => 197));
			}
		}

		$sMessage = "The subject(s) <i>".$sSubjectList."</i> have been ".((isset($_REQUEST["btnApprove"])) ? "administered":"disapproved").".";
	}else{
		if ($sMessage == "") $sMessage = "No subjects were selected. ".l("Please try again", "entertainment/getinvolved/admin/pending/subjects").".";
	}

	drupal_set_message($sMessage);

	return "";
}

function entertainment_editors_pending_items($sType="", $sUserType="editors"){
	global $user;

	$iUserId = $user->uid;
	$sBasePath = base_path();
	$sSubType = ($sType != "site") ? "file":"site";
	$sOutput2 = drupal_eval(load_etemplate('page-' . $sUserType));

	$aBreadcrumb = array(
						l("Home", "<front>"),
						l("Get Involved", "entertainment/getinvolved"),
						l((($sUserType == "editors") ?"Editors":"Administrators"), "entertainment/getinvolved/".$sUserType),
						l("Pending ".(($sUserType == "editors") ? "Items":"Contents"), "entertainment/getinvolved/".$sUserType."/pending"),
					);

	drupal_set_breadcrumb($aBreadcrumb);

	if ($sUserType == "editors"){
		$aGuides = _entertainment_volunteer_assignments($iUserId, "editor");
		$aAssignedAdmin = _entertainment_editors_admin();
		$bCanDoSomething = (count($aGuides) > 0 && count($aAssignedAdmin) == 2) ? true:false;
	}elseif ($sUserType == "admins"){
		$aEditors = _entertainment_volunteer_assignments($iUserId, "admin");
		$bCanDoSomething = (count($aEditors) > 0) ? true:false;
	}

	if (!$bCanDoSomething){
		$sDialogJS = '$("document").ready(
						function(){
							if ($("#entertainment_NoFeatureDialog_EditorAdmin").length == 1){
								$("#entertainment_NoFeatureDialog_EditorAdmin").dialog(
									{
										autoOpen: true,
										resizable: false,
										modal: true,
										width: 500,
										buttons: {
											"Go to Dashboard": function() {
												location = "'.$sBasePath.'entertainment/getinvolved/'.(($sUserType == "editors") ? "editors":"admins").'";
											}
										}
									}
								);
							}
						}
					)';

		drupal_add_js($sDialogJS, "inline");

		return '<div id="entertainment_NoFeatureDialog_EditorAdmin" title="'.(($sUserType == "editors") ? "Editor":"Administrator").' Notice">
					<p>You cannot '.(($sUserType == "editors") ? "edit":"administer").' any contents, yet. Please wait for, at least, '.(($sUserType == "editors") ? "a Guide and an Administrator":"an Editor").' to be assigned to you first.</p>
				</div>';
	}

	if ($sType == "") {
		$sOutput2 .= drupal_eval(load_etemplate('page-' . $sUserType . '2'));
		return $sOutput2;
	}

	$aDependentsId = _entertainment_volunteer_dependents($sUserType);

	drupal_set_html_head('<style>#cont-col .ind {padding:10px 30px 20px 30px !important;}</style>');

	if ($sType == "site" || $sType == "animation"){
		$sqlQuery = "SELECT A.id, A.sSiteType, A.group_level AS iGroupLevel, A.title AS sSubject, A.url, A.sAgeGroup,
						A.promoted, B.name, C.title AS sSubject_orig, A.sTags, A.sSubType, A.fid AS iRefId, C.sAgeGroup AS sAgeGroup_orig,
						IF(A.description IS NULL, 'No description avaiable.', A.description) AS sDescription,
						IF(C.description IS NULL, 'No description avaiable.', C.description) AS sDescription_orig,
						A.promoted AS iStatusId
					FROM mystudyrecord_suggested_site A
					LEFT JOIN mystudyrecord_site C ON C.id = A.fid";
	}else{
		$sqlQuery = "SELECT A.id, A.iUserId, A.sFileType, A.sFileId, A.sEmbedCode, A.iGroupLevel, A.sAgeGroup,
						A.sTitle AS sSubject, A.sDesc AS sDescription, B.name, A.sTags, A.iRefId
					FROM mystudyrecord_suggested_file A";
	}

	$sFieldName = ($sUserType == "editors") ? "iUserId":"iEditorId";
	$sYoutubeOption = ($sType == "site" || $sType == "animation") ? "" : "OR A.sFileType = 'video_youtube'";
	$sqlQuery .= " LEFT JOIN users B ON B.uid = A.iUserId
					WHERE (A.".$sFieldName." IN (".implode(", ", $aDependentsId).") " . $sYoutubeOption . ")  ";

	if ($sType == "site" || $sType == "animation"){
		$sqlQuery .= " AND A.sSiteType = '".$sType."'
						AND A.promoted IN (0, 2, 3)
						AND A.id >= 1999 ";

		if ($sUserType == "editors"){
			$sqlQuery .= " AND (A.iEditorId IS NULL OR A.iEditorId = '')";
		}else{
			$sqlQuery .= " AND (A.iEditorId IS NOT NULL OR A.iEditorId != '')
							AND (A.iAdminId IS NULL OR A.iAdminId != '')";
		}

		$sqlQuery .= " ORDER BY B.name, A.promoted, sSubject";
	}else{
		$sqlQuery .= " AND A.sFileType IN ('".$sType."', '".$sType."_ext', '".$sType."_embed', '".$sType."_youtube')
						AND A.id >= 2390 ";

		if ($sUserType == "editors"){
			$sqlQuery .= " AND (A.iEditorId IS NULL OR A.iEditorId = '')";
		}else{
			$sqlQuery .= " AND (A.iEditorId IS NOT NULL OR A.iEditorId != '')
							AND (A.iAdminId IS NULL OR A.iAdminId != '')";
		}

		$sqlQuery .= " ORDER BY B.name LIMIT 0,50";
	}

	//dump_this($sqlQuery);

	$oQueryResult = db_query($sqlQuery);

	$iRecordCount = 0;


	$sTableHeader = '<div class="divider"></div>
					<div id="cbtop">
						<div class="cbb">
							<div class="left-border">
								<div class="right-border">
									<div id="rating_RatingContainer" style="display:none; position:absolute; overflow:auto; width:400px; height:auto; z-index:2000; background-color:#FFFFFF; border:3px solid orange; padding:10px;"></div>
									<form action="'.base_path().'entertainment/getinvolved/'.$sUserType.'/pending/'.$sType.'/process" method="post" onsubmit="return checkEditorRating(this,\''.$sUserType.'\')" name="pendingForm" id="pendingForm">';

	$sTableFooter = '				</form>
								</div>
							</div>
						</div>
					</div>';
	$sImageThumbURL = SHRINKTHEWEB.'&stwxmax=144&stwymax=108&stwinside=1&stwurl=';
	$sPrevName = "";

	switch ($sType){
		case "image": $sNewType = "photo"; break;
		case "doc": $sNewType = "book"; break;
		default: $sNewType = $sType; break;
	}

	if ($sUserType == "admins"){
		$sDelOutput = "";

		if ($sType != "site"){
			$sqlItemDelete = "SELECT A.iUserId, A.iGroupLevel, A.sType, A.iRefId, A.sComment, B.sEmbedCode AS sCodeURL, B.sTitle AS sSubject, B.sFileType
								FROM mystudyrecord_suggested_delete A
								INNER JOIN %s B ON B.id = A.iRefId
								WHERE A.iUserId IN (%s)
									AND A.sType = '%s'";

			$oSiteDeleteResult = db_query($sqlItemDelete, array("mystudyrecord_file", implode(", ", $aDependentsId), "file"));

			while ($oSiteDelete = db_fetch_object($oSiteDeleteResult)){
				$iRecordCount++;

				$oUser = user_load(array("uid" => $oSiteDelete->iUserId));
				$aFileType = explode("_", $oSiteDelete->sFileType);
				$sSubject = '<a id="entertainment_file_tooltip_'.$oSiteDelete->iRefId.'" href="'.$sFileHref.'" target="_blank" title="Click to view the file in a new tab/window.">'.$oSiteDelete->sSubject.'</a>';
				$sDelOutput .= '<div class="jbox" style="width:980px">
									<div class="jboxhead"><h2></h2></div>
									<div class="jboxbody">
										<div class="jboxcontent">
											<table>
												<tr>
													<td style="padding-top:3px;"><input type="checkbox" name="'.$oSiteDelete->sType.'_id[]" value="'.$oSiteDelete->iRefId.'" /></td>
													<td style="width:150px; padding:3px 3px 10px 3px;">
														File Type: '.$oSiteDelete->sFileType.'
													</td>
													<td style="padding:3px 3px 10px 5px;">
														<p style="padding-bottom:5px;">5Category: '._entertainment_get_full_cat($oSiteDelete->iGroupLevel).'</p>

														<table style="width:100%;">
														<tr>
															<th>For Deletion</th>
														</tr>
														<tr>
															<td><b>Recommended by:</b> '.$oUser->name.'</td>
														</tr>
														<tr>
															<td>
																<div><b>Title:</b> <a id="entertainment_file_tooltip_'.$oSiteDelete->iRefId.'" title="Click to view the file." href="'.$sBasePath.'entertainment/file/'.$aFileType[0].'/'.$oSiteDelete->iGroupLevel.'/view/'.$oSiteDelete->iRefId.'">'.$oSiteDelete->sSubject.'</a></div>
																<b>Comment/Reason:</b>
																<div>'.$oSiteDelete->sComment.'</div>
															</td>
														</tr>
														</table>
													</td>
												</tr>
											</table>
										</div>
									</div>
									<div class="jboxfoot"><p></p></div>
								</div>
								<hr class="divider" style="width:980px;margin:5px 0 5px 0" />';
			}

			if ($sDelOutput != "") $sOutput .= '<div class="jboxh" style="width:980px"><div class="jboxhead"><h2>The following files were submitted for deletion:</h2></div></div>'.$sDelOutput;
		}else{
			$aSiteTypes = array('site_rec', 'site_other');
			$aSiteTables = array('mystudyrecord_site', 'mystudyrecord_suggested_site');
			$sqlItemDelete = "SELECT A.iUserId, A.iGroupLevel, A.sType, A.iRefId, A.sComment, B.url AS sCodeURL, B.title AS sSubject
								FROM mystudyrecord_suggested_delete A
								INNER JOIN %s B ON B.id = A.iRefId
								WHERE A.iUserId IN (%s)
									AND A.sType = '%s'";

			for ($i=0; $i<count($aSiteTypes); $i++){
				$sDelSiteType = $aSiteTypes[$i];
				$oSiteDeleteResult = db_query($sqlItemDelete, array($aSiteTables[$i], implode(", ", $aDependentsId), $sDelSiteType));

				$sDelSiteType = ($sDelSiteType == "site_rec") ? "Recommended":"Other";

				while ($oSiteDelete = db_fetch_object($oSiteDeleteResult)){
					$iRecordCount++;
					$oUser = user_load(array("uid" => $oSiteDelete->iUserId));

					$sDelOutput .= '<div class="jbox" style="width:980px">
										<div class="jboxhead"><h2></h2></div>
										<div class="jboxbody">
											<div class="jboxcontent">
												<table>
													<tr>
														<td style="padding-top:3px;"><input type="checkbox" name="'.$oSiteDelete->sType.'_id[]" value="'.$oSiteDelete->iRefId.'" /></td>
														<td style="width:150px; padding:3px 3px 10px 3px; text-align:center;">
															<a id="entertainment_file_tooltip_'.$oSiteDelete->iRefId.'" href="'.$oSiteDelete->sCodeURL.'" target="_blank" title="Click to view the site in a new tab/window.">
																<img src="'.$sImageThumbURL.$oSiteDelete->sCodeURL.'" width="144" alt="'.$oQuery->sSubject.'" />
															</a>
														</td>
														<td style="padding:3px 3px 10px 20px;">
															<p style="padding-bottom:5px;">Filed Under: '.$sDelSiteType.'</p>
															<p style="padding-bottom:5px;">6Category: '._entertainment_get_full_cat($oSiteDelete->iGroupLevel).'</p>

															<table style="width:100%;">
															<tr>
																<th>For Deletion</th>
															</tr>
															<tr>
																<td><b>Recommended by:</b> '.$oUser->name.'</td>
															</tr>
															<tr>
																<td>
																	<div><b>Title:</b> <a id="entertainment_file_tooltip_'.$oSiteDelete->iRefId.'" href="'.$oSiteDelete->sCodeURL.'" target="_blank" title="Click to view the site in a new tab/window.">'.$oSiteDelete->sSubject.'</a></div>
																	<b>Comment/Reason:</b>
																	<div>'.$oSiteDelete->sComment.'</div>
																</td>
															</tr>
															</table>
														</td>
													</tr>
												</table>
											</div>
										</div>
										<div class="jboxfoot"><p></p></div>
									</div>
									<hr class="divider" style="width:980px;margin:5px 0 5px 0" />';
				}
			}

			if ($sDelOutput != "") $sOutput .= '<div class="jboxh" style="width:980px"><div class="jboxhead"><h2>The following sites were submitted for deletion:</h2></div></div>'.$sDelOutput;
		}
	}

	while ($oQuery = db_fetch_object($oQueryResult)){
	 if(_entertainment_parent_full_cat($oQuery->iGroupLevel) == 1){
		$iRecordCount++;
		$iId = $oQuery->id;
		$sSubject = stripslashes(@$oQuery->sSubject);
		$sStatus = ($oQuery->iRefId == 0) ? "New Content":"Edited Content";

		if ($sPrevName != $oQuery->name){
			if ($sPrevName != ""){
				$sOutput .= '<div style="text-align:right;padding-right:30px">
								<button type="submit" name="btnApprove" value="approve" class="btn_blue_approve"></button>&nbsp;
								<button type="submit" name="btnDisapprove" value="disapprove" class="btn_blue_disapprove"></button>
							</div>';
			}

			$sOutput .= '<div class="jboxh" style="width:980px"><div class="jboxhead"><h2>'.ucfirst($sNewType).' was submitted for approval by: <em>'.$oQuery->name.'</em></h2></div></div>';
		}

		if ($sType != "site" && $sType != "animation"){
			$bYoutube = false;
			if (strpos($oQuery->sEmbedCode,"youtube.com/") !== false) {
				preg_match("/youtube\.com\/v\/([0-9a-zA-Z_-]+)/s",$oQuery->sEmbedCode,$aTmp);
				if (empty($aTmp[1]))
					preg_match("/youtube\.com\/watch\?v\=([0-9a-zA-Z_-]+)/s",$oQuery->sEmbedCode,$aTmp);
				if (!empty($aTmp[1])) {
					//$oQuery->sEmbedCode	= '<object width="340" height="285"><param name="movie" value="http://www.youtube.com/v/' . $aTmp[1] . '&hl=en&fs=1&rel=0&color1=0x234900&color2=0x4e9e00&border=1"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/RDS8sbalYcw&hl=en&fs=1&rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="340" height="285"></embed></object>';
					$oQuery->sEmbedCode    = '<object width="340" height="285"><param name="movie" value="http://www.youtube.com/v/' . $aTmp[1] . '&hl=en&fs=1&rel=0&color1=0x234900&color2=0x4e9e00&border=1"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/' . $aTmp[1] . '&hl=en&fs=1&rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="340" height="285"></embed></object>';

					$bYoutube = true;
					$sOutput .= "";
				}
			}

			if ($sSubType == "file"){
				$sFileType = $oQuery->sFileType;

				/*
				$sFileHref = (substr($sFileType, -4) == "_ext") ? $oQuery->sEmbedCode:($sFileType == "video_embed" && $sStatus == "New Content") ? "":$sBasePath.'mystudies/file/'.(str_replace(array("_embed","_youtube"), array("",""), $sFileType)).'/'.$oQuery->iGroupLevel.'/view/'.$oQuery->iRefId;
				*/


				$sEditType = "Photo";
				if (substr($sFileType, -4) == "_ext" && !$bYoutube) {
					$sFileHref = $oQuery->sEmbedCode;
				} else if ($sFileType == "video_embed" && $sStatus == "New Content") {
					$sFileHref = "";
				} else if ($sFileType == "video_youtube" || $bYoutube) {
					$sFileHref = $sBasePath.'entertainment/file/'.(str_replace(array("_embed","_youtube","_ext"), array("","",""), $sFileType)).'/'.$oQuery->iGroupLevel.'/view/'.$oQuery->id .'/admin/';
					$sEditType = "Video";
				} else {
					$sFileHref = $sBasePath.'entertainment/file/'.(str_replace(array("_embed","_youtube"), array("",""), $sFileType)).'/'.$oQuery->iGroupLevel.'/view/'.$oQuery->iRefId;
				}

				$sSubject = '<a id="entertainment_file_tooltip_'.$oQuery->sFileId.'" href="'.$sFileHref.'" title="Click to view the file." '.((substr($sFileType, -4) == "_ext") ? 'target="_blank"':'').'>'.$sSubject.'</a>';
				$sHTML = '<table style="width:100%;">
								<tr>
									<td>
										File Type: '.$sFileType.'<br/>
										<button type="button" id="entertainment_pending_edit_'.$iId.'" name="entertainment_pending_edit" class="btn_blue_editthis" style="margin-top:5px; font-size:0.8em;" onclick="location=\''.$sBasePath.'entertainment/getinvolved/'.$sUserType.'/pending/'.$sType.'/edit/'.$iId.'\'"></button>
									</td>
								</tr>
							</table>';
			}

				$sOutput .= '<div class="jbox" style="width:980px">
							<div class="jboxhead"><h2></h2></div>
							<div class="jboxbody">
								<div class="jboxcontent" style="color:#000">
									<table>
										<tr>
											<td style="padding-top:3px;"><input type="checkbox" name="id[]" value="'.$iId.'" /></td>
											<td style="width:200px; padding:3px;">'.$sHTML.'</td>
											<td style="padding:3px 3px 10px 3px;">
												<p>'.$sStatus.'</p>
												<p style="padding-bottom:5px;">7Category: '._entertainment_get_full_cat($oQuery->iGroupLevel).'</p>
												<u>'.$sSubject.'</u><br />
												'.$oQuery->sDescription.'
												'.((($sFileType == "video_embed" || $bYoutube)) ? '<div style="margin-top:10px;"'.$oQuery->sEmbedCode.'</div>':"").'
											</td>
										</tr>
										<tr>
											<td></td>
											<td style="text-align:right;">Rating:</td>
											<td style="padding:0px 0px 10px 5px;">'.rating_include_review("file", $sFileType, $iId, stripslashes(@$oQuery->sSubject)).'</td>
										</tr>
									</table>
								</div>
							</div>
							<div class="jboxfoot"><p></p></div>
						</div>
						<hr class="divider" style="width:980px;margin:5px 0 5px 0" />';

		}else{
			$sImageURL = $sImageThumbURL.$oQuery->url;
			$sSubType = $oQuery->sSubType;

			if ($sSubType == "rec"){
				$sFiledUnder = "Recommended";
			}elseif ($sSubType == "other"){
				$sFiledUnder = "Others";
			}else{
				$sFiledUnder = "Not Set";
			}

				$sOutput .= '<div class="jbox" style="width:980px">
							<div class="jboxhead"><h2></h2></div>
							<div class="jboxbody">
								<div class="jboxcontent" style="color:#000">
									<table>
										<tr>
											<td style="padding-top:3px;"><input type="checkbox" name="id[]" value="'.$iId.'" /></td>
											<td style="width:150px; padding:3px 3px 10px 3px; text-align:center;">
												<a id="entertainment_file_tooltip_'.$iId.'" href="'.$oQuery->url.'" target="_blank" title="Click to view the site in a new tab/window."><img src="'.$sImageURL.'" width="144" alt="'.$sSubject.'" /></a>
												<br/>
												<button type="button" id="entertainment_pending_edit_'.$iId.'" name="entertainment_pending_edit" class="btn_blue_editthis" style="margin-top:5px; font-size:0.8em;" onclick="location=\''.$sBasePath.'entertainment/getinvolved/'.$sUserType.'/pending/'.$sType.'/edit/'.$iId.'\'"></button>
											</td>
											<td style="padding:3px 3px 5px 20px;">
												<p>'.$sStatus.'</p>
												<p>Type: '.ucwords($oQuery->sSiteType).'</p>
												<p style="padding-bottom:5px;">Filed Under: '.$sFiledUnder.'</p>
												<p style="padding-bottom:5px;">8Category: '._entertainment_get_full_cat($oQuery->iGroupLevel).'</p>

												<table style="width:100%;">
													<tr>
														<th>Recommended</th>
													</tr>
													<tr>
														<td>
															<div><b>Title:</b> <a id="entertainment_file_tooltip_'.$iId.'" href="'.$oQuery->url.'" target="_blank" title="Click to view the site in a new tab/window.">'.$sSubject.'</a></div>
															<div style="padding-bottom:5px;"><b>Tags:</b> '.stripslashes($oQuery->sTags).'</div>
															<b>Description:</b>
															<div>'.stripslashes($oQuery->sDescription).'</div>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td></td>
											<td style="text-align:right; padding-top:3px;">Rating:</td>
											<td style="padding:3px 3px 10px 20px;">'.rating_include_review($sType, (($sSubType == "") ? "other":$sSubType), $iId, $sSubject).'</td>
										</tr>
									</table>
								</div>
							</div>
							<div class="jboxfoot"><p></p></div>
						</div>
						<hr class="divider" style="width:980px;margin:5px 0 5px 0" />';
		}

		$sPrevName = $oQuery->name;
	  }
	}

	if ($iRecordCount > 0){
		$sOutput .= '<div style="text-align:right;padding-right:30px">
						<button type="submit" name="btnApprove" value="approve" class="btn_blue_approve"></button>&nbsp;
						<button type="button" onclick="disapprovedButton();" name="btnDisapprove" value="disapprove" class="btn_blue_disapprove"></button>
					</div>';

		if (($sType == "site" || $sType == "animation" || $sType == "image") && $sUserType == "editors"){
			$sOutput = '<div style="margin-bottom:10px;">
							File under:
							<select name="sSiteType">
								<option value="other">Other Great '.ucfirst($sNewType).'</option>
								<option value="rec">Recommended '.ucfirst($sNewType).'</option>
							</select>
						</div>'.$sOutput;
		}
	}else{
		$sOutput .= '<div class="sysnotice">No recommended '.$sNewType.'(s) to approve/edit, yet.</div>';
	}

	return $sOutput2.$sTableHeader.$sOutput.$sTableFooter;
}

function entertainment_editors_pending_items_process($sType="site", $sUserType="editors"){
	global $user, $sMessage;

	$sBasePath = base_path();

	//dump_this($_REQUEST);

	if ($sType == "site"){
		$sTypeRedirect = "sites";
	}elseif ($sType == "image"){
		$sTypeRedirect = "photos";
	}elseif ($sType == "doc"){
		$sTypeRedirect = "books";
	}elseif ($sType == "video"){
		$sTypeRedirect = "videos";
	}elseif ($sType == "animation"){
		$sTypeRedirect = "animations";
	}

	if (isset($_REQUEST["btnApprove"])) $sAction = "approve";
	if (isset($_REQUEST["btnDisapprove"])) $sAction = "disapprove";

	$sqlDelete = "DELETE FROM %s WHERE id IN (%s)";
	$aBreadcrumb = array(
						l("Home", "<front>"),
						l("Get Involved", "entertainment/getinvolved"),
						l((($sUserType == "editors") ?"Editors":"Administrators"), "entertainment/getinvolved/".$sUserType),
						l("Pending ".(($sUserType == "editors") ? "Items":"Contents"), "entertainment/getinvolved/".$sUserType."/pending/".$sTypeRedirect),
					);

	drupal_set_breadcrumb($aBreadcrumb);
	drupal_add_js('setTimeout("location=\''.$sBasePath.'entertainment/getinvolved/'.$sUserType.'/pending/'.$sTypeRedirect.'\'", 5000)', "inline");

	if (strtolower($sAction) == "approve"){
		if (count($_REQUEST["site_rec_id"]) > 0 || count($_REQUEST["site_other_id"]) > 0 || count($_REQUEST["file_id"]) > 0 || count($_REQUEST["subject_id"]) > 0){
			for ($i=0; $i<count($_REQUEST["site_rec_id"]); $i++){
				$iItemId = $_REQUEST["site_rec_id"][$i];

				$sqlDelete1 = "DELETE FROM mystudyrecord_site WHERE id = %d";
				db_query($sqlDelete1, $iItemId);

				$sqlDelete2 = "DELETE FROM mystudyrecord_suggested_delete WHERE sType = 'site_rec' AND iRefId = %d";
				db_query($sqlDelete2, $iItemId);
			}

			for ($i=0; $i<count($_REQUEST["site_other_id"]); $i++){
				$iItemId = $_REQUEST["site_other_id"][$i];

				$sqlDelete1 = "DELETE FROM mystudyrecord_suggested_site WHERE id = %d";
				db_query($sqlDelete1, $iItemId);

				$sqlDelete2 = "DELETE FROM mystudyrecord_suggested_delete WHERE sType = 'site_other' AND iRefId = %d";
				db_query($sqlDelete2, $iItemId);
			}

			for ($i=0; $i<count($_REQUEST["file_id"]); $i++){
				$iItemId = $_REQUEST["file_id"][$i];

				$sqlDelete1 = "DELETE FROM mystudyrecord_file WHERE id = %d";
				db_query($sqlDelete1, $iItemId);

				$sqlDelete2 = "DELETE FROM mystudyrecord_suggested_delete WHERE sType = 'file' AND iRefId = %d";
				db_query($sqlDelete2, $iItemId);
			}

			for ($i=0; $i<count($_REQUEST["subject_id"]); $i++){
				$iItemId = $_REQUEST["subject_id"][$i];

				$sqlDelete1 = "DELETE FROM mystudyrecord_suggested_subj WHERE id = %d";
				db_query($sqlDelete1, $iItemId);

				$sqlDelete2 = "DELETE FROM mystudyrecord_suggested_delete WHERE sType = 'subject' AND iRefId = %d";
				db_query($sqlDelete2, $iItemId);
			}

			if (count($_REQUEST["id"]) <= 0){
				drupal_set_message("Recommended ".$sTypeRedirect." to be deleted has been successfully administered.");

				return "";
			}
		}
	}else{
		if (count($_REQUEST["site_rec_id"]) > 0 || count($_REQUEST["site_other_id"]) > 0 || count($_REQUEST["file_id"]) > 0 || count($_REQUEST["subject_id"]) > 0){
			for ($i=0; $i<count($_REQUEST["site_rec_id"]); $i++){
				$iItemId = $_REQUEST["site_rec_id"][$i];
				$sqlRecDelete = "DELETE FROM mystudyrecord_suggested_delete WHERE iRefId = %d AND sType = 'site_rec'";

				db_query($sqlRecDelete, $iItemId);
			}

			for ($i=0; $i<count($_REQUEST["site_other_id"]); $i++){
				$iItemId = $_REQUEST["site_other_id"][$i];
				$sqlRecDelete = "DELETE FROM mystudyrecord_suggested_delete WHERE iRefId = %d AND sType = 'site_other'";

				db_query($sqlRecDelete, $iItemId);
			}

			for ($i=0; $i<count($_REQUEST["file_id"]); $i++){
				$iItemId = $_REQUEST["file_id"][$i];
				$sqlRecDelete = "DELETE FROM mystudyrecord_suggested_delete WHERE iRefId = %d AND sType = 'file'";

				db_query($sqlRecDelete, $iItemId);
			}

			for ($i=0; $i<count($_REQUEST["subject_id"]); $i++){
				$iItemId = $_REQUEST["subject_id"][$i];
				$sqlRecDelete = "DELETE FROM mystudyrecord_suggested_delete WHERE iRefId = %d AND sType = 'subject'";

				db_query($sqlRecDelete, $iItemId);
			}

			if (count($_REQUEST["id"]) <= 0){
				drupal_set_message("Recommended ".$sTypeRedirect." to be deleted has been successfully disapproved.");

				return "";
			}
		}
	}

	if (count($_REQUEST["id"]) > 0){
		$sId = implode(",", $_REQUEST["id"]);
		$sItemType = $_REQUEST["sSiteType"];
		$sTitles = "";

		if ($sType == "site" || $sType == "animation"){
			$sqlQuery = "SELECT A.id, A.sSiteType, A.fid AS iRefId, A.promoted AS iStatusId, A.group_level AS iGroupLevel, A.title AS sSubject, A.url AS sCodeURL, A.sAgeGroup,
							A.description AS sDesc, A.promoted, A.sTags, A.iUserId, A.iEditorId, A.iAdminId, A.sSubType,
							B.group_level AS iGroupLevel_orig, B.title AS sSubject_orig, B.url AS sCodeURL_orig, B.description AS sDesc_orig, B.sAgeGroup AS sAgeGroup_orig,
							B.sTags AS sTags_orig
						FROM mystudyrecord_suggested_site A
						LEFT JOIN mystudyrecord_site B ON B.id = A.fid";
		}else{
			$sqlQuery = "SELECT A.id, A.iUserId, A.iEditorId, A.sFileType, A.sFileId, A.sFileGroup, A.sEmbedCode AS sCodeURL, A.iGroupLevel, A.sAgeGroup,
							A.iRefId, A.sTitle AS sSubject, A.sDesc, A.sTags, A.iAdminId, B.iGroupLevel AS iGroupLevel_orig, B.sTitle AS sSubject_orig, B.sAgeGroup AS sAgeGroup_orig,
							B.sDesc AS sDesc_orig, B.sTags AS sTags_orig, B.sEmbedCode AS sCodeURL_orig
						FROM mystudyrecord_suggested_file A
						LEFT JOIN mystudyrecord_file B ON B.id = A.iRefId";
		}

		$sqlQuery .= " WHERE A.id IN (%s)";
		$oQueryResult = db_query($sqlQuery, $sId);

		$sFieldName = ($sUserType == "editors") ? "iEditorId":"iAdminId";
		$sTable = ($sType == "site") ? "mystudyrecord_suggested_site":"mystudyrecord_suggested_file";

		while ($oQuery = db_fetch_object($oQueryResult)){
			$sTitles .= ($sTitles == "") ? "":", ";
			$sTitles .= @$oQuery->sSubject;
			$iThisId = $oQuery->id;

			$iRefId = $oQuery->iRefId;
			$iStatusId = $oQuery->iStatusId;

			$iGuideId = $oQuery->iUserId;
			$iEditorId = $oQuery->iEditorId;
			$iAdminId = $oQuery->iAdminId;

			$iRefId_old = null;
			$iRefId_new = $iRefId;

			if (strtolower($sAction) == "approve"){
				db_query("UPDATE mystudies_volunteer SET iApprovedCount = IFNULL(iApprovedCount,0) + 1 WHERE uid = '" . $user->uid . "' AND type = '" . ($sUserType == "editors" ? "editor" : "admin") . "'");

				if ($sUserType == "editors"){
					if ($sType == "site" || $sType == "animation"){
						if ($iStatusId == 0) $iRefId_new = $iThisId;

						$sqlUpdate = "UPDATE mystudyrecord_suggested_site
										SET %s = %d,
											sSubType = '%s'
										WHERE id = %d";
						$aParam = array($sFieldName, $user->uid, $sItemType, $iThisId);
					}else{
						if ($iRefId == 0) $iRefId_new = $iThisId;
						$sqlUpdate = "UPDATE mystudyrecord_suggested_file
										SET %s = %d,
											sFileGroup = '%s'
										WHERE id = %d";
						$aParam = array($sFieldName, $user->uid, $sItemType, $iThisId);
					}

					db_query($sqlUpdate, $aParam);
				}else{
					$sqlUpdateStat = "UPDATE mystudies_volunteer
										SET iApprovedCount = IFNULL(iApprovedCount, 0) + 1
										WHERE uid = %d
											AND `type` = 'guide'";
					db_query($sqlUpdateStat, $iGuideId);

					$sItemType = ($sType == "site" || $sType == "animation") ? $oQuery->sSubType:$oQuery->sFileGroup;

					if ($sType == "site" || $sType == "animation"){
						if ($sItemType == "other"){
							if ($iStatusId == 3){
								$iRefId_old = $iRefId;
								$iRefId_new = $iThisId;
								$sqlUpdate = "UPDATE mystudyrecord_suggested_site
												SET fid = 0, promoted = 1, iAdminId = %d
												WHERE id = %d";

								db_query($sqlUpdate, array($user->uid, $iThisId));
								db_query($sqlDelete, array("mystudyrecord_suggested_site", $iRefId));
							}elseif ($iStatusId == 2){
								$iRefId_old = $iRefId;
								$iRefId_new = $iThisId;
								$sqlUpdate = "UPDATE mystudyrecord_suggested_site
												SET fid = 0, promoted = 1, iAdminId = %d
												WHERE id = %d";

								db_query($sqlUpdate, array($user->uid, $iThisId));
								db_query($sqlDelete, array("mystudyrecord_site", $iRefId));
							}else{
								$iRefId_new = $iThisId;
								$sqlUpdate = "UPDATE mystudyrecord_suggested_site
												SET promoted = 1, iAdminId = %d
												WHERE id = %d";

								db_query($sqlUpdate, array($user->uid, $iThisId));
							}
						}else{
							if ($iStatusId == 3){
								$sqlInsert = "INSERT INTO mystudyrecord_site VALUES(NULL, '%s', %d, '%s', '%s', '%s', '%s', %d, %d, %d, '%s')";

								db_query($sqlInsert, array($oQuery->sSiteType, $oQuery->iGroupLevel, $oQuery->sSubject, $oQuery->sCodeURL, $oQuery->sDesc, $oQuery->sTags, $iGuideId, $iEditorId, $user->uid, $oQuery->sAgeGroup));
								db_query($sqlDelete, array("mystudyrecord_suggested_site", $iThisId.",".$iRefId));

								$iRefId_old = $iRefId;
								$iRefId_new = db_last_insert_id("mystudyrecord_site", "id");
							}elseif ($iStatusId == 2){
								$sqlUpdate = "UPDATE mystudyrecord_site
												SET group_level = %d, title = '%s', url = '%s', description = '%s', sTags = '%s', iAdminId = %d, sAgeGroup = '%s'
												WHERE id = %d";

								db_query($sqlUpdate, array($oQuery->iGroupLevel, $oQuery->sSubject, $oQuery->sCodeURL, $oQuery->sDesc, $oQuery->sTags, $user->uid, $oQuery->sAgeGroup, $iRefId));
								db_query($sqlDelete, array("mystudyrecord_suggested_site", $iThisId));
							}else{
								$sqlInsert = "INSERT INTO mystudyrecord_site VALUES(NULL, '%s', %d, '%s', '%s', '%s', '%s', %d, %d, %d, '%s')";

								db_query($sqlInsert, array($oQuery->sSiteType, $oQuery->iGroupLevel, $oQuery->sSubject, $oQuery->sCodeURL, $oQuery->sDesc, $oQuery->sTags, $iGuideId, $iEditorId, $user->uid, $oQuery->sAgeGroup));
								db_query($sqlDelete, array("mystudyrecord_suggested_site", $iThisId));

								$iRefId_old = $iThisId;
								$iRefId_new = db_last_insert_id("mystudyrecord_site", "id");
							}
						}
					}else{
						if ($iRefId == ""){
							$sqlInsert = "INSERT INTO mystudyrecord_file VALUES(NULL, '%s', '%s', '%s', %d, '%s', '%s', '%s', %d, %d, %d, '%s', '%s')";
							db_query($sqlInsert, array($oQuery->sFileType, $oQuery->sFileId, $oQuery->sCodeURL, $oQuery->iGroupLevel, $oQuery->sSubject, $oQuery->sDesc, $oQuery->sTags, $iGuideId, $iEditorId, $user->uid, $oQuery->sFileGroup, $oQuery->sAgeGroup));
						}else{
							$sqlUpdate = "UPDATE mystudyrecord_file
											SET sEmbedCode = '%s', iGroupLevel = %d, sTitle = '%s', sDesc = '%s', sTags = '%s', sFileGroup = '%s', sAgeGroup = '%s'
											WHERE id = %d";
							db_query($sqlUpdate, array($oQuery->sCodeURL, $oQuery->iGroupLevel, $oQuery->sSubject, $oQuery->sDesc, $oQuery->sTags, $sItemType, $oQuery->sAgeGroup, $iRefId));
						}

						db_query($sqlDelete, array("mystudyrecord_suggested_file", $iThisId));
					}

					// -------------------------------------------------------------------------
					/* if ($iRefId != 0){
						if ($sType == "site"){
							if ($sItemType == "other"){
								if ($iStatusId == 3){
									$sqlUpdate = "UPDATE mystudyrecord_suggested_site
													SET fid = 0,
														group_level = %d,
														title = '%s',
														url = '%s',
														description = '%s',
														promoted = 1,
														sTags = '%s',
														sSubType = '%s'
													WHERE id = %d";

									db_query($sqlUpdate, array($oQuery->iGroupLevel, $oQuery->sSubject, $oQuery->sCodeURL, $oQuery->sDesc, $oQuery->sTags, $sItemType, $iRefId);
									db_query($sqlDelete, array("mystudyrecord_suggested_site", $iThisId));
								}elseif ($iStatusId == 2){
									$sqlUpdate = "UPDATE mystudyrecord_suggested_site
													SET fid = 0,
														group_level = %d,
														title = '%s',
														url = '%s',
														description = '%s',
														promoted = 1,
														sTags = '%s',
														sSubType = '%s'
													WHERE id = %d";

									db_query($sqlUpdate, array($oQuery->iGroupLevel, $oQuery->sSubject, $oQuery->sCodeURL, $oQuery->sDesc, $oQuery->sTags, $sItemType, $iThisId);
									db_query($sqlDelete, array("mystudyrecord_site", $iRefId));
								}else{
									$sqlUpdate = "UPDATE mystudyrecord_site
													SET group_level = %d, title = '%s', url = '%s', description = '%s', sTags = '%s'
													WHERE id = %d";

									$aParam = array($oQuery->iGroupLevel, $oQuery->sSubject, $oQuery->sCodeURL, $oQuery->sDesc, $oQuery->sTags, $iRefId);

									db_query($sqlUpdate, $aParam);
									db_query($sqlDelete, array($sTable, $iThisId));
								}
							}
						}else{
							$sqlUpdate = "UPDATE mystudyrecord_file
											SET sEmbedCode = '%s', iGroupLevel = %d, sTitle = '%s', sDesc = '%s', sTags = '%s'
											WHERE id = %d";

							$aParam = array($oQuery->sCodeURL, $oQuery->iGroupLevel, $oQuery->sSubject, $oQuery->sDesc, $oQuery->sTags, $iRefId);

							db_query($sqlUpdate, $aParam);
							db_query($sqlDelete, array($sTable, $iThisId));
						}
					}else{
						if ($sType == "site"){
							if ($sItemType == "other"){
								$iRefId_new = $iThisId;
								$sqlUpdate = "UPDATE mystudyrecord_suggested_site
												SET %s = %d,
													promoted = 1
												WHERE id = %d";

								db_query($sqlUpdate, array($sFieldName, $user->uid, $iThisId));
							}else{
								$sqlInsert = "INSERT INTO mystudyrecord_site VALUES(NULL, '%s', %d, '%s', '%s', '%s', '%s', %d, %d, %d)";

								db_query($sqlInsert, array($sType, $oQuery->iGroupLevel, $oQuery->sSubject, $oQuery->sCodeURL, $oQuery->sDesc, $oQuery->sTags, $iGuideId, $iEditorId, $user->uid));
								db_query($sqlDelete, array($sTable, $iThisId));

								$iRefId_new = db_last_insert_id("mystudyrecord_site", "id");
								$iRefId_old = $iThisId;
							}
						}else{
							$sqlUpdate = "INSERT INTO mystudyrecord_file VALUES(NULL, '%s', '%s', '%s', %d, '%s', '%s', '%s', %d, %d, %d, '%s')";

							db_query($sqlUpdate, array($oQuery->sFileType, $oQuery->sFileId, $oQuery->sEmbedCode, $oQuery->iGroupLevel, $oQuery->sTitle, $oQuery->sDesc, $oQuery->sTags, $iGuideId, $iEditorId, $user->uid, $oQuery->sFileGroup));
							db_query($sqlDelete, array($sTable, $iThisId));

							$iRefId_new = db_last_insert_id("mystudyrecord_file", "id");
							$iRefId_old = $iThisId;
						}
					} */
				}

				$sqlLog = "SELECT id FROM mystudies_volunteer_changelog WHERE iRefId = %d";
				$iLogRefId = db_result(db_query($sqlLog, $iThisId));

				_entertainment_volunteer_changelog(substr($sUserType, 0, strlen($sUserType)-1), $iLogRefId, $iRefId_new, $sType, 0, 0, 0, 0, 0, $sItemType, $iRefId_old);

				// Point System for Suggestion - Approve
				userpoints_userpointsapi(array("tid" => 196));
			}else{
				if ($oQuery->sFileType == 'video_youtube') {
					$sqlYoutubeDelete = "INSERT INTO mystudyrecord_youtube_delete SET
											sTitle = '%s',
											sUrl = '%s',
											iGroupLevel = %d,
											iUserId = %d";
					db_query($sqlYoutubeDelete, array($oQuery->sSubject, $oQuery->sCodeURL, $oQuery->iGroupLevel,  $user->uid));
				}

				db_query("UPDATE mystudies_volunteer SET iDisapprovedCount = IFNULL(iDisapprovedCount,0) + 1 WHERE uid = '" . $user->uid . "' AND type = '" . ($sUserType == "editors" ? "editor" : "admin") . "'");
				db_query($sqlDelete, array($sTable, $iThisId));

				$sqlUpdateStat = "UPDATE mystudies_volunteer
									SET iDisapprovedCount = IFNULL(iDisapprovedCount,0) + 1
									WHERE uid = %d
										AND `type` = 'guide'";
				db_query($sqlUpdateStat, $iGuideId);

				// Point System for Suggestion - Disapprove
				$iSuggUID = ($sUserType == "editors") ? $iGuideId:$iEditorId;
				userpoints_userpointsapi(array("uid" => $iSuggUID, "tid" => 197));
			}
		}

		$sTitles = '<em>"'.ucwords($sTitles).'"</em> ';
		$sType = $sType."(s)";

		$sMessage = "Recommended ".$sType." ".$sTitles."has been successfully ".(($sUserType == "editors") ? "edited":"administered").".";
	}else{
		$sPrevURL = $sBasePath.'entertainment/getinvolved/'.$sUserType.'/pending/'.$sTypeRedirect;
		$sMessage = 'No recommendation was selected. Please <a href="'.$sPrevURL.'">try again</a>.';
	}

	$sOutput = drupal_eval(load_etemplate('page-confirmation'));

	return $sOutput;
}

function entertainment_editors_existing_items($sType="editors"){
	global $user, $sLoggedType;

	$iUserId = $user->uid;
	$sBasePath = base_path();
	$sLoggedType = $sType;

	$aBreadcrumb = array(
						l("Home", "<front>"),
						l("Get Involved", "entertainment/getinvolved"),
						l((($sType == "editors") ?"Editors":"Administrators"), "entertainment/getinvolved/".$sType),
						l("Existing ".(($sType == "editors") ?"Items":"Contents"), "entertainment/getinvolved/".$sType."/existing/items")
					);

	drupal_set_breadcrumb($aBreadcrumb);

	if ($sType == "editors"){
		$aGuides = _entertainment_volunteer_assignments($iUserId, "editor");
		$aAssignedAdmin = _entertainment_editors_admin();
		$bCanDoSomething = (count($aGuides) > 0 && count($aAssignedAdmin) == 2) ? true:false;
	}elseif ($sType == "admins"){
		$aEditors = _entertainment_volunteer_assignments($iUserId, "admin");
		$bCanDoSomething = (count($aEditors) > 0) ? true:false;
	}

	if (!$bCanDoSomething){
		$sDialogJS = '$("document").ready(
						function(){
							if ($("#entertainment_NoFeatureDialog_EditorAdmin").length == 1){
								$("#entertainment_NoFeatureDialog_EditorAdmin").dialog(
									{
										autoOpen: true,
										resizable: false,
										modal: true,
										width: 500,
										buttons: {
											"Go to Dashboard": function() {
												location = "'.$sBasePath.'entertainment/getinvolved/'.(($sType == "editors") ? "editors":"admins").'";
											}
										}
									}
								);
							}
						}
					)';

		drupal_add_js($sDialogJS, "inline");

		return '<div id="entertainment_NoFeatureDialog_EditorAdmin" title="'.(($sType == "editors") ? "Editor":"Administrator").' Notice">
					<p>You cannot '.(($sType == "editors") ? "edit":"administer").' any contents, yet. Please wait for, at least, '.(($sType == "editors") ? "a Guide and an Administrator":"an Editor").' to be assigned to you first.</p>
				</div>';
	}

	drupal_set_html_head('<style>#cont-col .ind {padding:10px 30px 20px 30px !important;} input, textarea{width:400px; margin:3px; padding:3px;}</style>');

	$bEnrolled = _entertainment_volunteer_enroll_check($user->uid, substr($sType, 0, strlen($sType)-1));

	$sOutput = drupal_eval(load_etemplate('page-'. $sType));

	if ($bEnrolled){
		$sOutput .= drupal_eval(load_etemplate('page-editors3'));

		if (isset($_REQUEST["editors_sContentType"])){
			foreach ($_REQUEST as $sKey => $sData) {
				${$sKey} = $sData;
			}
			//dump_this($_REQUEST);

			if ($editors_sContentType == "site" || $editors_sContentType == "animation"){
				$sqlQuery = "SELECT id, 'mystudyrecord_site' AS sTable, group_level AS iGroupLevel, title, url, description, sTags,
								'rec' AS sSubType, 0 AS iRefId, 1 AS iStatusId, iGuideId, iEditorId, iAdminId, sAgeGroup
							FROM mystudyrecord_site
							WHERE sSiteType = '".$editors_sContentType."' AND group_level = ".$editors_iGroupLevel."
							UNION
							SELECT id, 'mystudyrecord_suggested_site' AS sTable, group_level AS iGroupLevel, title, url, description, sTags,
								sSubType, fid AS iRefId, promoted AS iStatusId, iUserId AS iGuideId, iEditorId, iAdminId, sAgeGroup
							FROM mystudyrecord_suggested_site
							WHERE sSiteType = '".$editors_sContentType."' AND promoted = 1 AND group_level = ".$editors_iGroupLevel;
			}else{
				$sqlQuery = "SELECT id, sFileType, sFileId, sEmbedCode, iGroupLevel, sTitle, sDesc, sTags, sFileGroup, sFileGroup,
								iGuideId, iEditorId, iAdminId, sAgeGroup
							FROM mystudyrecord_file
							WHERE sFileType IN ('".$editors_sContentType."', '".$editors_sContentType."_ext', '".$editors_sContentType."_embed', '".$editors_sContentType."_youtube')
								AND iGroupLevel = ".$editors_iGroupLevel."
							ORDER BY sFileType";
			}

			$oQueryResult = db_query($sqlQuery);

			if ($editors_sContentType == "site"){
				$sDisplayType = "Websites";
			}elseif ($editors_sContentType == "image"){
				$sDisplayType = "Photos";
			}elseif ($editors_sContentType == "video"){
				$sDisplayType = "Videos";
			}elseif ($editors_sContentType == "animation"){
				$sDisplayType = "Animations";
			}elseif ($editors_sContentType == "doc"){
				$sDisplayType = "Books/Reports";
			}

			$sImageGen = SHRINKTHEWEB."&stwxmax=1024&stwymax=768&stwinside=1&stwurl=";
			$sFullCat = _entertainment_get_full_cat($editors_iGroupLevel);
			$sOutput .= '<div class="divider"></div>
							<div id="cbtop">
								<div class="cbb">
									<div class="left-border">
										<div class="right-border">
											<div class="jboxh" style="width:980px;">
												<div class="jboxhead"><h2>'.$sFullCat.' ('.$sDisplayType.')</h2></div>
											</div>


											<div id="entertainment_editors_cats" style="display:none; position:absolute; left:300px; z-index:5000;">
												<input type="hidden" id="volunteer_iContentId" value="" />
												<input type="hidden" id="volunteer_iGroupId_edit" value="" />

												<table style="background-color:#FFFFFF;width:100%">
													<tr>
														<td style="padding:10px;"><ul id="entertainment_VolunteerCatList2"></ul></td>
													</tr>
													<tr>
														<td align="center" style="padding:0px 10px 10px 0px;">
															<button type="button" id="entertainment_editors_cat_change" class="btn_blue_go"></button>
															<button type="button" id="entertainment_editors_cat_cancel" class="btn_blue_cancel"></button>
														</td>
													</tr>
												</table>
											</div>

											<form method="post" action="'.$sBasePath.'entertainment/getinvolved/'.$sType.'/existing/items/process">
												<input type="hidden" name="editors_sContentTypeGlobal" value="'.$editors_sContentType.'" />
												<div id="rating_RatingContainer" style="display:none; position:absolute; overflow:auto; width:400px; height:auto; z-index:2000; background-color:#FFFFFF; border:3px solid orange; padding:10px;"></div>';


			$iRecordCount = 0;

			while ($oQuery = db_fetch_object($oQueryResult)){
				$iRecordCount++;
				$iContentId = $oQuery->id;
				$iGroupId = $oQuery->iGroupLevel;
				$sTags = $oQuery->sTags;

				$iGuideId = $oQuery->iGuideId;
				$iEditorId = $oQuery->iEditorId;
				$iAdminId = $oQuery->iAdminId;
				$iRefId = $oQuery->iRefId;

				if ($editors_sContentType == "site" || $editors_sContentType == "animation"){
					$sSiteURL = $oQuery->url;
					$sImageURL = $sImageGen.$sSiteURL;
					$sTitle = $oQuery->title;
					$sDesc = $oQuery->description;
					$sSubType = $oQuery->sSubType;
					$iStatusId = $oQuery->iStatusId;
					$sAgeGroup = $oQuery->sAgeGroup;

					$sSubOption1 = ($sSubType == "other") ? "selected":"";
					$sSubOption2 = ($sSubType == "rec") ? "selected":"";

					$sOutput .= '<div class="jbox" style="width:980px;">
                                    <div class="jboxhead"><h2></h2></div>
                                    <div class="jboxbody">
                                        <div class="jboxcontent">
											<table width="100%" border="0" cellpadding="0" cellspacing="0" id="gi_form">
                                                <tr>
                                                  <td colspan="3"><div><label><strong>Edited Version</strong></label><span class="gi_editor_categ">9Category: <span id="editors_change_cat_'.$iContentId.'">'.$sFullCat.'</span></span></div></td>
                                                </tr>
                                                <tr>
                                                  <td width="440" valign="top">
                                               			<input type="hidden" name="editors_aGuideId[]" value="'.$iGuideId.'" />
														<input type="hidden" name="editors_aEditorId[]" value="'.$iEditorId.'" />
														<input type="hidden" name="editors_aAdminId[]" value="'.$iAdminId.'" />
														<input type="hidden" name="editors_aStatusId[]" value="'.$iStatusId.'" />
														<input type="hidden" name="editors_aRefId[]" value="'.$iRefId.'" />
														<input type="hidden" name="editors_aContentId[]" value="'.$iContentId.'" />
														<input type="hidden" name="editors_aGroupId_orig[]" value="'.$iGroupId.'" />
														<input type="hidden" id="editors_iGroupId_'.$iContentId.'" name="editors_aGroupId[]" value="'.$iGroupId.'" />
														<input type="hidden" id="editors_sContentType_'.$iContentId.'" name="editors_aContentType[]" value="'.$editors_sContentType.'" />
														<input type="hidden" id="editors_sTable_'.$iContentId.'" name="editors_aTable[]" value="'.$oQuery->sTable.'" />

														<div>
                                                        	<label for="">File Under:</label>
                                                            <input type="hidden" name="editors_aSubType_orig[]" value="'.$sSubType.'" />
															<select name="editors_aSubType[]">
																<option value="other" '.$sSubOption1.'>Other Great Site</option>
																<option value="rec" '.$sSubOption2.'>Recommended Site</option>
															</select>
                                                        </div>
                                                        <div>
															<label for="">Title:</label>
															<input type="hidden" name="editors_aTitle_orig[]" value="'.$sTitle.'" />
															<input style="width:300px" type="text" id="editors_sTitle_'.$iContentId.'" name="editors_aTitle[]" value="'.$sTitle.'"  style="width:400px;" />
														</div>
                                                        <div>
															<label for="">External URL:</label>
															<input type="hidden" name="editors_aEmbedURL_orig[]" value="'.$sSiteURL.'" />
															<input style="width:300px" type="text" name="editors_aEmbedURL[]" value="'.$sSiteURL.'" style="width:400px;" />
														</div>
                                                        <div>
															<label for="">Description:</label>
															<input type="hidden" name="editors_aDesc_orig[]" value="'.$sDesc.'" />
															<textarea name="editors_aDesc[]" style="width:300px; height:120px;">'.$sDesc.'</textarea>
														</div>
                                                        <div>
															<label for="">Age Group:</label>
															<input type="hidden" name="editors_aAgeGroup_orig[]" value="'.$sAgeGroup.'" />
															<select name="editors_aAgeGroup[]">
																<option value="">All Age</option>
																<option ' . ($sAgeGroup == '7-9' ? 'selected' : '') . ' value="7-9">7 to 9 Years Old</option>
																<option ' . ($sAgeGroup == '10-12' ? 'selected' : '') . ' value="10-12">10 to 12 Years Old</option>
															</select>
														</div>
                                                        <div>
															<label for="">Tags:</label>
															<input type="hidden" name="editors_aTags_orig[]" value="'.$sTags.'" />
															<input style="width:300px" type="text" name="editors_aTags[]" value="'.$sTags.'"  style="width:400px;" />
														</div>
                                                        <div>
															'.rating_include_review("site", $sSubType, $iContentId, (($sType == "editors") ? "":$sTitle)).'
														</div>
                                                  </td>
                                                  <td valign="top" align="center" width="260">
												  		<a href="'.$sSiteURL.'" target="_blank"><img id="entertainment_site_thumb_'.$iContentId.'" src="'.$sImageURL.'" width="250" /></a>
                                                  		<button type="button" style="margin-top:5px;" id="btnItemDelete" name="btnItemDelete" value="'.$iContentId.'" class="btn_blue_deletethiscontentitem"></button>
												  </td>
                                                  <td valign="top">
                                                  		'._entertainment_list_changelog($iContentId, "site").'
										          </td>
                                                </tr>
											</table>
                                        </div>
                                    </div>
                                    <div class="jboxfoot"><p></p></div>
                                </div>
								<hr class="divider" style="margin:5px 0 5px 0; width:980px;" />';
				}else{
					$sFileType = $oQuery->sFileType;
					$sFileId = $oQuery->sFileId;
					$sFileEmbedCode = $oQuery->sEmbedCode;
					$sTitle = $oQuery->sTitle;
					$sDesc = $oQuery->sDesc;
					$sFileGroup = $oQuery->sFileGroup;
					$sAgeGroup = $oQuery->sAgeGroup;
                    $sFileImageURL = $sImageGen.$sFileEmbedCode;

					$sSubOption1 = ($sFileGroup == "other") ? "selected":"";
					$sSubOption2 = ($sFileGroup == "rec") ? "selected":"";
					$sInputType = "URL";

			        if ($sFileType == $editors_sContentType){
                        if ($sFileType == "doc"){
                            $sImageURL = '<div style="border:2px solid #087C01; padding:3px;" align="center">
                                            <a href="'.$sBasePath.'entertainment/file/image/'.$iGroupId.'/view/'.$iContentId.'" target="_blank">Click to view Book/Report<br/>
                                            <img src="'.$sBasePath.'misc/file_doc.png" style="padding:5px 0px 5px 0px;" /></a>
                                        </div>';
                        }elseif ($sFileType == "video"){
                            preg_match("/youtube\.com\/watch\?v\=([0-9a-zA-Z_-]+)/s",$oQuery->sEmbedCode,$sEmbed);
                            $sVidFile= $sImageURL.str_replace("/watch?v=", "/v/", $sFileEmbedCode);
                            $sImageURL = '<div style="border:2px solid #087C01; padding:3px;" align="center">
                                            <a href="http://www.divshare.com/flash/video?myId='.$sFileId.'" target="_blank">Click to view Video</a>
                                            <!--<img src="'.$sBasePath.'misc/file_doc.png" style="padding:5px 0px 5px 0px;" /></a>-->
                                            '.'<object width="200" height="200"><param name="movie" name="wmode" value="transparent" ></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="'.$sVidFile.'" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="200" height="200" wmode="transparent"></embed></object>'.'
                                        </div>';
                        }else{
                            $sImageURL = '<a href="'.$sBasePath.'entertainment/file/image/'.$iGroupId.'/view/'.$iContentId.'" target="_blank">
                                            <img id="entertainment_image_thumb_'.$iContentId.'" src="http://www.divshare.com/img/thumb/'.$sFileId.'" width="250" />
                                        </a>';
                        }

                        $sFileURL = '<input type="hidden" name="editors_aEmbedURL_orig[]" value="NULL" />
                                    <input type="hidden" name="editors_aEmbedURL[]" value="NULL" />';
                    }elseif ($sFileType == "video_youtube"){
                                preg_match("/youtube\.com\/v\/([0-9a-zA-Z_-]+)/s",$oQuery->sEmbedCode,$aTmp);
                                if (empty($aTmp[1]))
                                    preg_match("/youtube\.com\/watch\?v\=([0-9a-zA-Z_-]+)/s",$oQuery->sEmbedCode,$aTmp);
                                if (!empty($aTmp[1])) {

                                    $sImageURL = '<div style="border:2px solid #087C01; padding:3px;" align="center">
                                                    <a href="'.$sBasePath.'entertainment/file/video/'.$iGroupId.'/view/'.$oQuery->id.'" target="_blank">Click to view '.$sFileTitle.'</a>
                                                    <!--<img src="'.$sBasePath.'misc/file_doc.png" style="padding:5px 0px 5px 0px;" /></a>-->
                                                    '.'<object width="200" height="200"><param name="wmode" value="transparent" ></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/'.$aTmp[1].'" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="200" height="200" wmode="transparent"></embed></object>'.'
                                                </div>';
                                }
                        $sFileURL = '<input style="width:300px" type="text" name="editors_aEmbedURL[]" value="'.$sFileEmbedCode.'" style="width:400px;" />';
                    }elseif ($sFileType == $editors_sContentType."_ext" && $sFileType !== "video_youtube"){
                        if ($sFileType != "image_ext"){
                            $sFileTitle = ($sFileType == "doc_ext") ? "Book/Report":"Video";

                            $sImageURL = '<div style="border:2px solid #087C01; padding:3px;" align="center">
                                            <a href="'.$sFileEmbedCode.'" target="_blank">Click to view '.$sFileTitle.'<br/>
                                            <a href="'.$sFileEmbedCode.'" target="_blank"><img id="entertainment_site_thumb_'.$iContentId.'" src="'.$sFileImageURL.'" width="250" /></a>
                                            <!--<img src="'.$sBasePath.'misc/file_doc.png" style="padding:5px 0px 5px 0px;" />--></a>
                                        </div>';

                            if (strpos($oQuery->sEmbedCode,"youtube.com/") !== false) {
                                preg_match("/youtube\.com\/v\/([0-9a-zA-Z_-]+)/s",$oQuery->sEmbedCode,$aTmp);
                                if (empty($aTmp[1]))
                                    preg_match("/youtube\.com\/watch\?v\=([0-9a-zA-Z_-]+)/s",$oQuery->sEmbedCode,$aTmp);
                                if (!empty($aTmp[1])) {

                                    $sImageURL = '<div style="border:2px solid #087C01; padding:3px;" align="center">
                                                    <a href="'.$sBasePath.'entertainment/file/video/'.$iGroupId.'/view/'.$oQuery->id.'" target="_blank">Click to view '.$sFileTitle.'</a>
                                                    <!--<img src="'.$sBasePath.'misc/file_doc.png" style="padding:5px 0px 5px 0px;" /></a>-->
                                                    '.'<object width="200" height="200"><param name="wmode" value="transparent" ></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/'.$aTmp[1].'" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="200" height="200" wmode="transparent"></embed></object>'.'
                                                </div>';
                                }
                            }
                        }else{
                            $aURL = explode(".", $sFileEmbedCode);
                            $sFileExt = $aURL[count($aURL)-1];

                            if (strlen($sFileExt) > 3 || in_array($sFileExt, array("html","htm","php","asp","aspx","cfm","jsp","cgi"))){
                                $sImgSrc = $sImageGen.$sFileEmbedCode;
                            }else{
                                $sImgSrc = $sFileEmbedCode;
                            }

                            $sImageURL = '<a href="'.$sFileEmbedCode.'" target="_blank"><img id="entertainment_image_thumb_'.$iContentId.'" src="'.$sImgSrc.'" width="250" /></a>';
                        }

                        $sFileURL = '<input style="width:300px" type="text" name="editors_aEmbedURL[]" value="'.$sFileEmbedCode.'" style="width:400px;" />';
                    }elseif ($sFileType == $editors_sContentType."_embed"){
                        if ($sFileType != "image_embed"){
                            $sFileTitle = ($sFileType == "doc_embed") ? "Book/Report":"Video";

                            if($sFileTitle == "Video"){
                             if(strpos($sFileEmbedCode, 'object')){
                             $aNewstring = preg_replace('/\width=".*?"/', 'width="200"', $sFileEmbedCode);
                             $sFinalString = preg_replace('/\ height=".*?"/', ' height="200"', $aNewstring);
                             $sFinalString = str_replace('<param name="allowFullScreen" value="true"></param>', '<param name="allowFullScreen" value="true"></param><param name="wmode" value="transparent" ></param>', $sFinalString);
                             $sFinalString = str_replace('></embed>', ' wmode="transparent">', $sFinalString);
                             }
                             if(strpos($sFileEmbedCode, 'iframe')){
                             $aNewstring = preg_replace('/\width=".*?"/', 'width="200"', $sFileEmbedCode);
                             $sFinalString = preg_replace('/\ height=".*?"/', ' height="200"', $aNewstring);
                             }
                            }

                            if($sFileType == 'doc_embed' && strpos($sFileEmbedCode, 'iframe')){
                            $oDomDoc = new DOMDocument();
                            @$oDomDoc->loadHTML('<iframe width=100% height=560px frameborder=0 src=https://docs.google.com/a/hopecybrary.org/viewer?a=v&pid=explorer&chrome=false&embedded=true&srcid=0B6tfruvzeXdjNDE3NjU5OTItZmQ5MS00OWM3LWExMTAtNWIzZDI0YWYwNGIz&authkey=CIHxvZsH&hl=en></iframe>');
                            $oEmbed = $oDomDoc->getElementsByTagName("iframe");
                            $oEmbedMovie = $oEmbed->item(0);
                            $sFileFull = $oEmbedMovie->getAttribute("src");
                            $sFileImageURL = $sImageGen.$sFileFull;
                            $sFinalString = '<a href="'.$sFileEmbedCode.'" target="_blank"><img id="entertainment_site_thumb_'.$iContentId.'" src="'.$sFileImageURL.'" width="250" /></a>';
                            }

                            $sImageURL = '<div style="border:2px solid #087C01; padding:3px;" align="center">
                                            <a href="'.$sBasePath.'entertainment/file/image/'.$iGroupId.'/view/'.$iContentId.'" target="_blank">Click to view '.$sFileTitle.'</a>
                                            <!--<img src="'.$sBasePath.'misc/file_doc.png" style="padding:5px 0px 5px 0px;" /></a>-->
                                            '.$sFinalString.'
                                        </div>';
                        }else{
                            $sFileEmbedCodeMod = _entertainment_replace_attr('width', 'width="250"', $sFileEmbedCode);
                            $sFileEmbedCodeMod = _entertainment_replace_attr('height', '', $sFileEmbedCodeMod);

                            $sImageURL = str_replace('<img', '<img id="entertainment_image_thumb_'.$iContentId.'"', $sFileEmbedCodeMod);
                            $sImageURL = '<a href="'._entertainment_get_attr("src", $sImageURL).'" target="_blank">'.$sImageURL.'</a>';
                        }

                        $sInputType = "Code";
                        $sFileURL = '<textarea name="editors_aEmbedURL[]" style="width:300px; height:70px;">'.$sFileEmbedCode.'</textarea>';
                    }

                    if ($sFileType != $editors_sContentType){
                        $sOption = '<div>
                                        <label for="">'.$sInputType.':</label>
                                        <input type="hidden" name="editors_aEmbedURL_orig[]" value="'.htmlentities($sFileEmbedCode).'" />
                                        '.$sFileURL.'
                                    </div>';
                    }else{
                        $sOption = $sFileURL;
                    }

					$sOutput .= '<div class="jbox" style="width:980px;">
                                    <div class="jboxhead"><h2></h2></div>
                                    <div class="jboxbody">
                                        <div class="jboxcontent">
											<table width="100%" border="0" cellpadding="0" cellspacing="0" id="gi_form">
                                                <tr>
                                                  <td colspan="3"><div><label><strong>Edited Version</strong></label><span class="gi_editor_categ">10Category: <span id="editors_change_cat_'.$iContentId.'">'.$sFullCat.'</span></span></div></td>
                                                </tr>
                                                <tr>
                                                  <td width="440" valign="top">
                                               			<input type="hidden" name="editors_aGuideId[]" value="'.$iGuideId.'" />
														<input type="hidden" name="editors_aEditorId[]" value="'.$iEditorId.'" />
														<input type="hidden" name="editors_aAdminId[]" value="'.$iAdminId.'" />
														<input type="hidden" name="editors_aRefId[]" value="'.$iRefId.'" />
														<input type="hidden" name="editors_aContentId[]" value="'.$iContentId.'" />
														<input type="hidden" name="editors_aGroupId_orig[]" value="'.$iGroupId.'" />
														<input type="hidden" id="editors_iGroupId_'.$iContentId.'" name="editors_aGroupId[]" value="'.$iGroupId.'" />
														<input type="hidden" name="editors_aContentType[]" value="'.$sFileType.'" />

														<div>
                                                        	<label for="">File Under:</label>
															<input type="hidden" name="editors_sFileGroup_orig[]" value="'.$sFileGroup.'" />
															<select name="editors_sFileGroup[]">
																<option value="other" '.$sSubOption1.'>Other Great Site</option>
																<option value="rec" '.$sSubOption2.'>Recommended Site</option>
															</select>
                                                        </div>
                                                        <div>
															<label for="">Title:</label>
															<input type="hidden" name="editors_aTitle_orig[]" value="'.$sTitle.'" />
															<input style="width:300px" type="text" id="editors_sTitle_'.$iContentId.'" name="editors_aTitle[]" value="'.$sTitle.'"  style="width:400px;" />
														</div>
                                                        '.$sOption.'
														<div>
															<label for="">Description:</label>
															<input type="hidden" name="editors_aDesc_orig[]" value="'.$sDesc.'" />
															<textarea name="editors_aDesc[]" style="width:300px; height:120px;">'.$sDesc.'</textarea>
														</div>
                                                        <div>
															<label for="">Age Group:</label>
															<input type="hidden" name="editors_aAgeGroup_orig[]" value="'.$sAgeGroup.'" />
															<select name="editors_aAgeGroup[]">
																<option value="">All Age</option>
																<option ' . ($sAgeGroup == '7-9' ? 'selected' : '') . ' value="7-9">7 to 9 Years Old</option>
																<option ' . ($sAgeGroup == '10-12' ? 'selected' : '') . ' value="10-12">10 to 12 Years Old</option>
															</select>
														</div>
                                                        <div>
															<label for="">Tags:</label>
															<input type="hidden" name="editors_aTags_orig[]" value="'.$sTags.'" />
															<input style="width:300px" type="text" name="editors_aTags[]" value="'.$sTags.'"  style="width:400px;" />
														</div>
                                                        <div>
															'.rating_include_review("file", $sFileType, $iContentId, (($sType == "editors") ? "":$sTitle)).'
														</div>
                                                  </td>
                                                  <td valign="top" align="center" width="260">
												  		'.$sImageURL.'
														<button type="button" style="margin-top:5px;" id="btnItemDelete" name="btnItemDelete" value="'.$iContentId.'" class="btn_blue_deletethiscontentitem"></button>
												  </td>
                                                  <td valign="top">
                                                  		'._entertainment_list_changelog($iContentId, "file").'
										          </td>
                                                </tr>
											</table>
                                        </div>
                                    </div>
                                    <div class="jboxfoot"><p></p></div>
                                </div>
								<hr class="divider" style="margin:5px 0 5px 0; width:980px;" />';
				}
			}

			if ($iRecordCount == 0){
				$sOutput .= '<div class="sysnotice">No '.$sDisplayType.' to edit under this subject/category, yet.</div></form>';
			}else{
				if ($sType == "admins"){
					$sDeleteBlock = 'You are about to delete this item. Are you sure?<br />
									<div align="right" style="padding-top:5px;">
										<button id="btnExistingItemDeleteCancel" type="button" name="btnDeleteCancel" class="form-submit"">NO</button>
										<button id="btnExistingItemDelete" type="submit" name="btnDelete" class="form-submit"">YES</button>
									</div>';
				}else{
					$sDeleteBlock = 'Reason for suggesting this Content Item for deletion:<br />
									<textarea id="sDeleteComment" name="sDeleteComment" style="width:288px; height:100px;"></textarea><br />
									<div align="right" style="padding-top:5px;">
										<button id="btnExistingItemDeleteCancel" type="button" name="btnDeleteCancel" class="form-submit"">Cancel</button>&nbsp;
										<button id="btnExistingItemDelete" type="submit" name="btnDelete" class="form-submit"">Suggest for Deletion</button>
									</div>';
				}

				$sOutput .= '<div style="text-align:right; padding-right:30px"><button type="submit" name="editors_btnEditExistingItemsSubmit" class="btn_blue_applychanges"></button></div>
							</form>
										</div>
									</div>
								</div>
							</div>


							<div id="entertainment_ExistingItemDeleteComment" style="z-index:2;display:none; width:300px; border: 5px solid #acacac; padding:5px; background-color:#E2E2D3;">
								<form action="'.$sBasePath.'entertainment/url/edit/del" method="post" onsubmit="return ValidateSiteDelForm();">
									<input type="hidden" id="sUserType" name="sUserType" value="'.$sType.'" />
									<input type="hidden" id="sType" name="sType" value="" />
									<input type="hidden" id="iRecId" name="iRecId" value="" />
									<input type="hidden" id="iGroupLevel" name="iGroupLevel" value="'.$iGroupId.'" />
									<input type="hidden" name="sRedirectTo" value="'.$sBasePath.'entertainment/getinvolved/'.$sType.'/existing/items" />

									<div id="sDeleteTitle" style="text-decoration:underline; font-weight:bold; padding-bottom:5px;"></div>
									'.$sDeleteBlock.'
								</form>
							</div>

							<div class="popup">
								<div class="popup_dscp">
									<table width="100%" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td align="center"><img src="" /></td>
										</tr>
										<tr>
											<td class="link"><h3></h3></td>
										</tr>
									</table>
								</div>
							</div>';
			}
		}

		return $sOutput;
	}else{
		drupal_access_denied();
	}
}

function _entertainment_get_attr($sAttr, $sTag){
	//get attribute from html tag
	$sRegEx = '/'.preg_quote($sAttr).'=([\'"])?((?(1).+?|[^\s>]+))(?(1)\1)/is';

	if (preg_match($sRegEx, $sTag, $aMatch)) return urldecode($aMatch[2]);

	return false;
}

function _entertainment_replace_attr($sAttr, $sReplacement, $sSource){
	$sRegEx = '/'.preg_quote($sAttr).'=([\'"])?((?(1).+?|[^\s>]+))(?(1)\1)/is';
	$sSourceOrig = $sSource;
	$sSource = preg_replace($sRegEx, $sReplacement, $sSource);

	if ($sSourceOrig == $sSource && $sAttr == "width") $sSource = str_replace("<img ", '<img width="250" ', $sSource);

	return $sSource;
}

function entertainment_editors_existing_items_process($sType="editors"){
	global $user;

	//dump_this($_REQUEST);

	foreach ($_REQUEST as $sKey => $sData) {
		${$sKey} = $sData;
	}

	$aBreadcrumb = array(
						l("Home", "<front>"),
						l("Get Involved", "entertainment/getinvolved"),
						l((($sType == "editors") ?"Editors":"Administrators"), "entertainment/getinvolved/".$sType),
						l("Existing ".(($sType == "editors") ?"Items":"Contents"), "entertainment/getinvolved/".$sType."/existing/items")
					);

	drupal_set_breadcrumb($aBreadcrumb);
	drupal_add_js('setTimeout("location=\''.base_path().'entertainment/getinvolved/'.$sType.'/existing/items\'", 5000)', "inline");

	$bProcessed = false;

	for ($i=0; $i<count($editors_aContentId); $i++){
		$iContentId = $editors_aContentId[$i];
		$sContentType = $editors_aContentType[$i];

		$iRefId_old = null;
		$iRefId_new = $iContentId;

		$iGuideId = (isset($editors_aGuideId[$i]) && $editors_aGuideId[$i] != "") ? $editors_aGuideId[$i]:1;
		$iEditorId = $editors_aEditorId[$i];
		$iAdminId = $editors_aAdminId[$i];

		$iGroupId = $editors_aGroupId[$i];
		$sEmbedURL = $editors_aEmbedURL[$i];
		$sTitle = $editors_aTitle[$i];
		$sTags = preg_replace('/\s\s+/', " ", str_replace(", ", ",", $editors_aTags[$i]));
		$sDesc = $editors_aDesc[$i];
		$sAgeGroup = $editors_aAgeGroup[$i];

		$bCat = ($iGroupId != $editors_aGroupId_orig[$i]) ? 1:0;
		$bCodeURL = ($sEmbedURL != $editors_aEmbedURL_orig[$i]) ? 1:0;
		$bTitle = ($sTitle != $editors_aTitle_orig[$i]) ? 1:0;
		$bTag = ($sTags != $editors_aTags_orig[$i]) ? 1:0;
		$bDesc = ($sDesc != $editors_aDesc_orig[$i]) ? 1:0;

		$sqlDelete = "DELETE FROM %s WHERE id = %d";

		if ($editors_sContentTypeGlobal == "site" || $editors_sContentTypeGlobal == "animation"){
			$sSubType = $editors_aSubType[$i];
			$sSubType_orig = $editors_aSubType_orig[$i];

			if (
				$iGroupId != $editors_aGroupId_orig[$i] || $sEmbedURL != $editors_aEmbedURL_orig[$i] ||
				$sTitle != $editors_aTitle_orig[$i] || $sTags != $editors_aTags_orig[$i] ||
				$sDesc != $editors_aDesc_orig[$i] || $sSubType != $sSubType_orig ||
				$sAgeGroup != $editors_aAgeGroup_orig[$i]
			){

				if ($editors_aTable[$i] == "mystudyrecord_site"){
					if ($sType == "editors"){
						$sqlInsert = "INSERT INTO mystudyrecord_suggested_site
										VALUES(NULL, '%s', %d, %d, %d, '%s', '%s', '%s', 2, '%s', '%s', %d, NULL, '%s', '%s')";

						db_query($sqlInsert, array($sContentType, $iGuideId, $iContentId, $iGroupId, $sTitle, $sEmbedURL, $sDesc, date("Y-m-d H:i:s"), $sTags, $user->uid, $sSubType, $sAgeGroup));

						$iRefId_new = db_last_insert_id("mystudyrecord_suggested_site", "id");
					}else{
						if ($sSubType == "other"){
							$sqlInsert = "INSERT INTO mystudyrecord_suggested_site
											VALUES(NULL, '%s', %d, 0, %d, '%s', '%s', '%s', 1, '%s', '%s', %d, NULL, '%s', '%s')";

							db_query($sqlInsert, array($sContentType, $iGuideId, $iGroupId, $sTitle, $sEmbedURL, $sDesc, date("Y-m-d H:i:s"), $sTags, $user->uid, $sSubType, $sAgeGroup));

							$iRefId_old = $iContentId;
							$iRefId_new = db_last_insert_id("mystudyrecord_suggested_site", "id");

							db_query($sqlDelete, array("mystudyrecord_site", $iContentId));
						}else{
							$sqlUpdate = "UPDATE mystudyrecord_site
											SET group_level = %d,
												title = '%s',
												url = '%s',
												description = '%s',
												sTags = '%s',
												iAdminId = %d,
												sAgeGroup = '%s'
											WHERE id = %d";

							db_query($sqlUpdate, array($iGroupId, $sTitle, $sEmbedURL, $sDesc, $sTags, $user->uid, $sAgeGroup, $iContentId));
						}
					}
				}else{
					$iStatusId = $editors_aStatusId[$i];
					$iRefId = $editors_aRefId[$i];

					if ($sType == "editors"){
						$sqlInsert = "INSERT INTO mystudyrecord_suggested_site
										VALUES(NULL, '%s', %d, %d, %d, '%s', '%s', '%s', 3, '%s', '%s', %d, NULL, '%s', '%s')";

						db_query($sqlInsert, array($sContentType, $iGuideId, $iContentId, $iGroupId, $sTitle, $sEmbedURL, $sDesc, date("Y-m-d H:i:s"), $sTags, $user->uid, $sSubType, $sAgeGroup));

						$iRefId_new = db_last_insert_id("mystudyrecord_suggested_site", "id");
					}else{
						if ($sSubType == "other"){
							/* if ($iStatusId == 3){
								$sqlUpdate = "UPDATE mystudyrecord_suggested_site
												SET fid = 0,
													group_level = %d,
													title = '%s',
													url = '%s',
													description = '%s',
													promoted = 1,
													sTags = '%s',
													sSubType = '%s',
													iAdminId = %d,
													sAgeGroup = '%s'
												WHERE id = %d";

								db_query($sqlUpdate, array($iGroupId, $sTitle, $sEmbedURL, $sDesc, $sTags, $sSubType, $user->uid, $sAgeGroup, $iContentId));
								db_query($sqlDelete, array("mystudyrecord_suggested_site", $iRefId));
							}elseif ($iStatusId == 2){
								$iRefId_old = $iRefId;
								$sqlUpdate = "UPDATE mystudyrecord_suggested_site
												SET fid = 0,
													group_level = %d,
													title = '%s',
													url = '%s',
													description = '%s',
													promoted = 1,
													sTags = '%s',
													sSubType = '%s',
													iAdminId = %d,
													sAgeGroup = '%s'
												WHERE id = %d";

								db_query($sqlUpdate, array($iGroupId, $sTitle, $sEmbedURL, $sDesc, $sTags, $sSubType, $user->uid, $sAgeGroup, $iContentId));
								db_query($sqlDelete, array("mystudyrecord_site", $iRefId));
							}elseif ($iStatusId == 1){ */
								$sqlUpdate = "UPDATE mystudyrecord_suggested_site
												SET group_level = %d,
													title = '%s',
													url = '%s',
													description = '%s',
													sTags = '%s',
													sSubType = '%s',
													iAdminId = %d,
													sAgeGroup = '%s'
												WHERE id = %d";

								db_query($sqlUpdate, array($iGroupId, $sTitle, $sEmbedURL, $sDesc, $sTags, $sSubType, $user->uid, $sAgeGroup, $iContentId));
							//}
						}else{
							/* if ($iStatusId == 3){
								$sqlInsert = "INSERT INTO mystudyrecord_site
												VALUES(NULL, '%s', %d, '%s', '%s', '%s', '%s', %d, %d, %d, '%s')";

								db_query($sqlInsert, array($sContentType, $iGroupId, $sTitle, $sEmbedURL, $sDesc, $sTags, $iGuideId, $iEditorId, $user->uid, $sAgeGroup));

								$iRefId_old = $iContentId;
								$iRefId_new = db_last_insert_id("mystudyrecord_site", "id");

								db_query($sqlDelete, array("mystudyrecord_suggested_site", $iContentId));
							}elseif ($iStatusId == 2){
								$iRefId_new = $iRefId;
								$sqlUpdate = "UPDATE mystudyrecord_site
												SET group_level = %d,
													title = '%s',
													url = '%s',
													description = '%s',
													sTags = '%s',
													iAdminId = %d,
													sAgeGroup = '%s'
												WHERE id = %d";

								db_query($sqlUpdate, array($iGroupId, $sTitle, $sEmbedURL, $sDesc, $sTags, $user->uid, $sAgeGroup, $iRefId));
								db_query($sqlDelete, array("mystudyrecord_suggested_site", $iContentId));
							}elseif ($iStatusId == 1){ */
								$sqlInsert = "INSERT INTO mystudyrecord_site
												VALUES(NULL, '%s', %d, '%s', '%s', '%s', '%s', %d, %d, %d, '%s')";

								db_query($sqlInsert, array($sContentType, $iGroupId, $sTitle, $sEmbedURL, $sDesc, $sTags, $iGuideId, $iEditorId, $user->uid, $sAgeGroup));

								$iRefId_old = $iContentId;
								$iRefId_new = db_last_insert_id("mystudyrecord_site", "id");

								db_query($sqlDelete, array("mystudyrecord_suggested_site", $iContentId));
							//}
						}
					}
				}

				$bProcessed = true;

				_entertainment_volunteer_changelog(substr($sType, 0, strlen($Type)-1), $iRefId_new, $iRefId_new, "site", $bTitle, $bDesc, $bCodeURL, $bTag, $bCat, $sSubType, $iRefId_old);
			}
		}else{
			$sFileGroup = $editors_sFileGroup[$i];

			if (
				$iGroupId != $editors_aGroupId_orig[$i] || $sEmbedURL != $editors_aEmbedURL_orig[$i] ||
				$sTitle != $editors_aTitle_orig[$i] || $sTags != $editors_aTags_orig[$i] ||
				$sDesc != $editors_aDesc_orig[$i] || $sFileGroup != $editors_sFileGroup_orig[$i] ||
				$sAgeGroup != $editors_aAgeGroup_orig[$i]
			){
				if ($sType == "editors"){
					$sqlInsert = "INSERT INTO {mystudyrecord_suggested_file}
									SET iUserId = %d,
										sFileType = '%s',
										sEmbedCode = '%s',
										iGroupLevel = %d,
										iRefId = %d,
										sTitle = '%s',
										sDesc = '%s',
										sTags = '%s',
										iEditorId = %d,
										sFileGroup = '%s'";

					db_query($sqlInsert, array($user->uid, $sContentType, $sEmbedURL, $iGroupId, $iContentId, $sTitle, $sDesc, $sTags, $user->uid, $sFileGroup));
				}else{
					$sqlUpdate = "UPDATE mystudyrecord_file
									SET sEmbedCode = '%s',
										iGroupLevel = %d,
										sTitle = '%s',
										sDesc = '%s',
										sTags = '%s',
										iAdminId = %d,
										sFileGroup = '%s'
									WHERE id = %d";

					db_query($sqlUpdate, array($sEmbedURL, $iGroupId, $sTitle, $sDesc, $sTags, $user->uid, $sFileGroup, $iContentId));
				}

				$bProcessed = true;

				_entertainment_volunteer_changelog(substr($sType, 0, strlen($Type)-1), $iContentId, $iRefId_new, "file", $bTitle, $bDesc, $bCodeURL, $bTag, $bCat, $sFileGroup, $iRefId_old);
			}
		}
	}

	if ($sType == "editors"){
		$sMessage = ($bProcessed) ? "Suggested changes have been successfully submitted.":"No suggestion(s) have been made.";

		// Point System for Suggestion - Submit
		userpoints_userpointsapi(array("tid" => 195));
	}else{
		$sMessage = ($bProcessed) ? "Your changes have been successfully applied.":"No changes have been made.";
	}

	drupal_set_message($sMessage);

	return "";
}

function entertainment_editors_existing_cats($sType="editors"){
	global $user, $sLoggedType;

	$iUserId = $user->uid;
	$sBasePath = base_path();
	$aBreadcrumb = array(
						l("Home", "<front>"),
						l("Get Involved", "entertainment/getinvolved"),
						l((($sType == "editors") ?"Editors":"Administrators"), "entertainment/getinvolved/".$sType),
						l("Existing Categories", "entertainment/getinvolved/".$sType."/existing/cats")
					);
	$sLoggedType = $sType;

	drupal_set_breadcrumb($aBreadcrumb);

	if ($sType == "editors"){
		$aGuides = _entertainment_volunteer_assignments($iUserId, "editor");
		$aAssignedAdmin = _entertainment_editors_admin();
		$bCanDoSomething = (count($aGuides) > 0 && count($aAssignedAdmin) == 2) ? true:false;
	}elseif ($sType == "admins"){
		$aEditors = _entertainment_volunteer_assignments($iUserId, "admin");
		$bCanDoSomething = (count($aEditors) > 0) ? true:false;
	}

	if (!$bCanDoSomething){
		$sDialogJS = '$("document").ready(
						function(){
							if ($("#entertainment_NoFeatureDialog_EditorAdmin").length == 1){
								$("#entertainment_NoFeatureDialog_EditorAdmin").dialog(
									{
										autoOpen: true,
										resizable: false,
										modal: true,
										width: 500,
										buttons: {
											"Go to Dashboard": function() {
												location = "'.$sBasePath.'entertainment/getinvolved/'.(($sType == "editors") ? "editors":"admins").'";
											}
										}
									}
								);
							}
						}
					)';

		drupal_add_js($sDialogJS, "inline");

		return '<div id="entertainment_NoFeatureDialog_EditorAdmin" title="'.(($sType == "editors") ? "Editor":"Administrator").' Notice">
					<p>You cannot '.(($sType == "editors") ? "edit":"administer").' any contents, yet. Please wait for, at least, '.(($sType == "editors") ? "a Guide and an Administrator":"an Editor").' to be assigned to you first.</p>
				</div>';
	}

	drupal_set_html_head('<style>#cont-col .ind {padding:10px 30px 20px 30px !important;}</style>');

	$sOutput = drupal_eval(load_etemplate('page-editors5'));
	$sOutput .= '';

	if (isset($_REQUEST["iGroupId"])){
		$iGroupId = $_REQUEST["iGroupId"];
		$sqlCat = "SELECT A.id, A.group_level, A.title, A.leaf, A.icon,
						IF(A.desc IS NULL, 'Description will go here.', A.desc) AS sDescription
					FROM {mystudyrecord} A
					WHERE group_level = %d
					ORDER BY id";
		$oCatResult = db_query($sqlCat, $iGroupId);

		if ($sType == "admins"){
			$sDeleteBlock = 'You are about to delete this subject and everything under it. Are you sure?<br />
							<div align="right" style="padding-top:5px;">
								<button id="btnExistingCatDeleteCancel" type="button" name="btnDeleteCancel" class="form-submit"">NO</button>
								<button id="btnExistingCatDelete" type="submit" name="btnDelete" class="form-submit"">YES</button>
							</div>';
		}else{
			$sDeleteBlock = 'Reason for suggesting this Subject/Category for deletion:<br />
							<textarea id="sDeleteComment" name="sDeleteComment" style="width:300px; height:100px;"></textarea><br />
							<div align="right" style="padding-top:5px;">
								<button id="btnExistingCatDeleteCancel" type="button" name="btnDeleteCancel" class="form-submit"">Cancel</button>
								<button id="btnExistingCatDelete" type="submit" name="btnDelete" class="form-submit"">Suggest for Deletion</button>
							</div>';
		}

		$sOutputIni = '<div id="editors_edit_form" style="margin-top:20px">
						<div class="divider"></div>
						<div id="cbtop">
							<div class="cbb">
								<div class="left-border">
									<div class="right-border">
										<div class="jboxh" style="width:980px">
											<div class="jboxhead"><h2>You have chosen to edit existing subject/category under <u>'._entertainment_get_full_cat($iGroupId).'</u></h2></div>
										</div>

										<div id="entertainment_ExistingCatDeleteComment" style="display:none; width:300px; border: 5px solid #acacac; padding:5px; background-color:#ffffff; color:#000">
											<form action="'.$sBasePath.'entertainment/url/edit/del" method="post" onsubmit="return ValidateSiteDelForm();">
												<input type="hidden" id="sType" name="sType" value="subj" />
												<input type="hidden" id="iRecId" name="iRecId" value="" />
												<input type="hidden" id="iGroupLevel" name="iGroupLevel" value="'.$iGroupId.'" />
												<input type="hidden" name="sUserType" value="'.$sType.'" />
												<input type="hidden" name="sRedirectTo" value="'.$sBasePath.'entertainment/getinvolved/'.$sType.'/existing/cats" />

												<div id="sDeleteTitle" style="text-decoration:underline; font-weight:bold; padding-bottom:5px;"></div>
												'.$sDeleteBlock.'
											</form>
										</div>

										<form action="'.$sBasePath.'entertainment/getinvolved/'.$sType.'/existing/cats/edit/process" enctype="multipart/form-data" method="post">
											<input type="hidden" name="iGroupId" value="'.$iGroupId.'"/>
											<input type="hidden" name="sRedirectTo" value="'.$sBasePath.'entertainment/getinvolved/'.$sType.'/existing/cats" />';

		$iSubjCount = 0;

		while ($oCat = db_fetch_object($oCatResult)){
			$iSubjCount++;
			$iCatId = $oCat->id;
			$sCatName = $oCat->title;

			$sOutputIni .= '<div class="jbox" style="width:980px;color:#000">
								<div class="jboxhead"><h2></h2></div>
								<div class="jboxbody">
									<div class="jboxcontent">
										<table>
										<tr>
											<td>
												<div class="jbox" style="width:260px">
													<div class="jboxhead"><h2></h2></div>
													<div class="jboxbody">
														<div class="jboxcontent" style="text-align:center">
															<img src="'.$sBasePath.'entertainment/image/main/'.$iCatId.'" alt="'.$sCatName.'" title="'.$sCatName.'" style="width:205px;" />
														</div>
													</div>
													<div class="jboxfoot"><p></p></div>
												</div>
											</td>
											<td style="padding:5px;">
												<table style="width:100%;">
													<tr>
														<td>Title: </td>
													</tr>
													<tr>
														<td>
															<input type="hidden"  name="title_orig['.$iCatId.']" value="'.$sCatName.'" />
															<input type="text" id="editors_sTitle_'.$iCatId.'" name="title['.$iCatId.']" value="'.$sCatName.'" style="width:400px;" />
														</td>
													</tr>
													<tr>
														<td style="padding-top:5px">Description: </td>
													</tr>
													<tr>
														<td>
															<input type="hidden"  name="desc_orig['.$iCatId.']" value="'.$oCat->sDescription.'" />
															<textarea name="desc['.$iCatId.']" style="width:400px; height:88px;">'.$oCat->sDescription.'</textarea>
														</td>
													</tr>
													<tr>
														<td style="padding-top:5px">Image: </td>
													</tr>
													<tr>
														<td><input type="file" name="icon['.$iCatId.']" style="width:400px;" /></td>
													</tr>
													<tr>
														<td style="padding-top:5px"><button type="button" style="margin-top:5px;" id="btnCatDelete" name="btnCatDelete" value="'.$iCatId.'" class="btn_blue_deletethissubject"></button></td>
													</tr>
												</table>
											</td>
										</tr>
										</table>
									</div>
								</div>
								<div class="jboxfoot"><p></p></div>
							</div>
							<hr style="width:980px;margin:5px 0 5px 0" class="divider" />';
		}

		if ($iSubjCount == 0){
			$sOutput .= '<br/><br/><center>There are no subjects/categories under <u>'.$_REQUEST["sGroupLevel"].'</u></center></form></div></div></div></div></div>';
		}else{
			$sOutputIni .= '<div style="text-align:right;padding-right:30px"><input type="submit" class="btn_blue_applychanges" value="" /></div>
								</form></div></div></div></div></div>';

			$sOutput .= $sOutputIni;
		}
	}

	return $sOutput;
}

function entertainment_editors_existing_cats_process($sUserType, $sActionType){
	global $user;
	$iUserId = $user->uid;

	foreach ($_REQUEST as $sKey => $sData) {
		${$sKey} = $sData;
	}

	//dump_this($_REQUEST);

	$aBreadcrumb = array(
						l("Home", "<front>"),
						l("Get Involved", "entertainment/getinvolved"),
						l((($sUserType == "editors") ?"Editors":"Administrators"), "entertainment/getinvolved/".$sUserType),
						l("Existing Categories", "entertainment/getinvolved/".$sUserType."/existing/cats")
					);


	drupal_set_breadcrumb($aBreadcrumb);
	drupal_add_js('setTimeout("location=\''.$sRedirectTo.'\'", 5000)', "inline");

	if ($sActionType == "add"){
		$sTempIconName = $_FILES["sSubjIcon"]["tmp_name"];
		$iTempIconSize = $_FILES["sSubjIcon"]["size"];

		$oFP = fopen($sTempIconName, "r");
		$sIconData = fread($oFP, filesize($sTempIconName));
		fclose($oFP);

		if ($sUserType == "editors"){
			$sqlSubj = "INSERT INTO {mystudyrecord_suggested_subj}
							(iUserId, iRefId, iGroupLevel, sSubject, sIcon, sDescription, sLeaf)
						VALUES (%d, 0, %d, '%s', %b, '%s', '%s')";
			$aParam = array($iUserId, $iGroupLevel, ucwords($sSubjTitle), $sIconData, ucfirst($sSubjDesc), $sSubjLeaf);

			// Point System for Suggestion - Submit
			userpoints_userpointsapi(array("tid" => 195));
		}else{
			$sqlSubj = "INSERT INTO {mystudyrecord}
							(group_level, title, leaf, icon, `desc`)
						VALUES(%d, '%s', '%s', %b, '%s')";
			$aParam = array($iGroupLevel, ucwords($sSubjTitle), $sSubjLeaf, $sIconData, ucfirst($sSubjDesc));
		}

		db_query($sqlSubj, $aParam);

		drupal_set_message("Subject <em>\"".ucwords($sSubjTitle)."\"</em> has been successfully ".(($sUserType == "editors") ? "submitted":"added").".");
	}elseif ($sActionType == "edit"){
		$iUpdateCount = 0;

		if ($sUserType == "editors"){
			$sqlSubj = "INSERT INTO {mystudyrecord_suggested_subj}
							(iUserId, iGroupLevel, iRefId, sSubject, sIcon, sDescription)
						VALUES (%d, %d, %d, '%s', %b, '%s')";
			$aParam = array($iUserId, $iGroupId);
		}else{
			$sqlUpdate = "UPDATE {mystudyrecord} SET title = '%s', ";
			$sqlAdmin = "`desc` = '%s' WHERE id = %d";
		}

		foreach ($title as $iKey => $sVal){
			$sqlUpdate = "UPDATE {mystudyrecord} SET title = '%s', ";

			if ($sVal != $title_orig[$iKey] || $desc[$iKey] != $desc_orig[$iKey] || $_FILES["icon"]["name"][$iKey] != ""){
				$iUpdateCount++;

				if (count($aParam) == 2 && $sUserType == "editors") $aParam[] = $iKey;

				$aParam[] = $sVal;

				if ($_FILES["icon"]["name"][$iKey] != "" && $_FILES["icon"]["size"][$iKey] > 0){
					$sTempIconName = $_FILES["icon"]["tmp_name"][$iKey];
					$iTempIconSize = $_FILES["icon"]["size"][$iKey];

					$oFP = fopen($sTempIconName, "r");
					$sIconData = fread($oFP, filesize($sTempIconName));
					fclose($oFP);

					$sqlUpdate .= "icon = %b, ";
					if ($sUserType == "admins") $aParam[] = $sIconData;
				}else{
					if ($sUserType == "editors") $aParam[] = "";
				}

				$aParam[] = $desc[$iKey];

				if (count($aParam) == 2 && $sUserType == "admins") $aParam[] = $iKey;

				if ($sUserType == "admins") $sqlSubj = $sqlUpdate.$sqlAdmin;

				db_query($sqlSubj, $aParam);
			}
		}

		if ($sUserType == "editors"){
			// Point System for Suggestion - Submit
			userpoints_userpointsapi(array("tid" => 195));

			$sMessage = ($iUpdateCount > 0) ? "Your suggestion(s) has been submitted.":"No suggestion(s) was submitted.";
		}else{
			$sMessage = ($iUpdateCount > 0) ? "Your changes have been successfully applied.":"No changes were made.";
		}

		drupal_set_message($sMessage);
	}

	return "";
}

/*
function html_view_top_0() {
	$page_content = '';
	$page_content .= '<div class="ch_ltop">';
	$page_content .= '<div class="ch_rtop">';
	$page_content .= '<div class="ch_lbtm">';
	$page_content .= '<div class="ch_rbtm">';
	return $page_content;
}
function html_view_bot_0() {
	$page_content = '';
	$page_content .= '</div>';
	$page_content .= '</div>';
	$page_content .= '</div>';
	$page_content .= '</div>';
	return $page_content;
}

function html_view_top_m() {
	$page_content = '';
	$page_content .= '<table border="0" cellpadding="0" cellspacing="0" width="100%">';
	return $page_content;
}
function html_view_bot_m() {
	$page_content = '';
	$page_content .= '</table>';
	return $page_content;
}

function html_choose() {
	$page_content = '';
   $page_content .= '	<div class="chbx_topl chose_first">';
   $page_content .= '		<div class="firs_bx"><img src="'.base_path().'sites/default/files/childrens_portal/ch_first_bx.gif" /></div>';
   $page_content .= '	</div>';
	return $page_content;
}*/

function entertainment_wrap_url($iRefId, $sRefType, $sBase64URL){
	$sOutput = '<html>
				<head>
				<title>Hope Cybrary</title>
				<style>
				body{
					font-family:arial;
					color:#e5f031;
					font-size:10px;
					background:#0d3802 url('.base_path().'hud_files/images/leaving_bg.png) no-repeat top center;
				}
				td {
					font-size:11px;
				}
				</style>
				</head>
				<body>
					<center>
					<table cellpadding="0" style="width:700px;margin-top:120px;">
						<tr>
							<td valign="top" width="50%" style="padding:0 20px 0 10px;">
								<h3>For Kids, Parents, and Teachers</h3>
								<p>Kids, please make sure to have you parents permission before you use HopeNet and this Knowledge Portal.</p>
								<p>
								If you click "Go to website" button, you will be leaving the HopeNet website. The website (including the text, images, videos, books, etc.)
								that you will see has been recommended and screened by HopeNet volunteers. However, the website is not owned
								or operated by HopeNet and HopeNet is not responsible for the content, practices, or privacy policies of
								the owners - providers of the website.
								</p>
								<p>If you see anything that you feel is offensive, imemdiately leave the website and report it to HopeNet.</p>
							</td>
							<td valign="top" style="padding:0 20px 0 30px;">
								<h3>Safe Viewing Rules for Kids</h3>
								<ul>
									<li>Do not login to any websites unless you are instructed to do so by HopeNet or your parents.</li>
									<li>Keep all your passwords private. Do not share it with others except for your parents.</li>
									<li>We do not recommend that you use this website for chatting, sharing photos or videos, or sharing other informations.</li>
									<li>Under no circumstances should you talk to or send pictures to strangers. Never share your real name, school, age, phone number, or address.</li>
									<li>If something bad, creepy, or mean happens, leave the website immediately and report it to HopeNet.</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td align="center" style="padding-top:30px;">
								<a href="#" onclick="javascript:self.close();"><img src="'.base_path().'hud_files/images/leaving_return_btn.png" alt="Return to HopeNet" title="Return to HopeNet" border="0" /></a>
							</td>
							<td align="center" style="padding-top:30px;">
								<a href="'.base_path().'entertainment/content/url/display/'.$iRefId.'/'.$sRefType.'/'.$sBase64URL.'"><img src="'.base_path().'hud_files/images/leaving_goto_btn.png" alt="Go to website" title="Go to website" border="0" /></a>
							</td>
						</tr>
					</table>
					</center>
				</body>
				</html>';

	echo $sOutput;

	exit;
}

function entertainment_display_url($iRefId, $sRefType, $sBase64URL){
	global $user;
	$iUserId = $user->uid;

	$sBasePath = base_path();
	$aRefType = explode("_", $sRefType);
	$sType = ($aRefType[0] == "site") ? $aRefType[0]:"file";
	$sSubType = ($aRefType[0] == "site") ? $aRefType[1]:$sRefType;
	$iVoteCount = _rating_check_vote_hud($sType, $sSubType, $iRefId);

	$sUserLanguage = entertainment_languagemanagement(0,$user->uid,'-2');
	$sUserLanguageName = entertainment_get_google_language($sUserLanguage);
	$sFrameJs = 'document.getElementById("entertainment_frame").className = "kframe";';
	$sNoTranslateBtn = "";
	$sOrigUrl = base64_decode($sBase64URL);
	$sTranslatedUrl = $sOrigUrl;

	$data = "";
	if (strpos($sTranslatedUrl, "docs.google.com") !== false)
		$data = file_get_contents($sTranslatedUrl . "&browserok=true");

	if (preg_match("/src=\"([^\"]+)\"\s+alt=\"Item Thumbnail\"/s",$data,$match)) {
		$sTranslatedUrl = $match[1];
	} else if (strpos($sTranslatedUrl, "docs.google.com") !== false){
		//$aFindThese = array("leaf", "fileview", "id=", "?");
		//$aReplaceWithThese = array("gview", "gview", "srcid=", "?a=v&pid=explorer&chrome=false&api=true&embedded=true&hl=en_US&");
		//$sTranslatedUrl = str_replace($aFindThese, $aReplaceWithThese, $sTranslatedUrl);
		if (strpos($sTranslatedUrl, "docs.google.com/") !== false && strpos($sTranslatedUrl, "src=") !== false) {
			if (preg_match("/src=\"?([^\>|\"|\s]+)/s",$sTranslatedUrl,$match))
				$sTranslatedUrl = $match[1];
		}

        if(strpos($sTranslatedUrl, "viewer") !== false){
        $aFindThese = array("viewer", 'https:');
        $aReplaceWithThese = array("gview", '');
        $sTranslatedUrl = "http://" . str_replace($aFindThese, $aReplaceWithThese, $sTranslatedUrl);
        } else{
         $arr_url = explode('id=', $sTranslatedUrl);
         $arr_result = explode('&', $arr_url[1]);
         $sNumber = strlen($arr_result[0]);
          if($sNumber == 44){
            $sTranslatedUrl = 'https://docs.google.com/a/hopecybrary.org/document/d/'.$arr_result[0].'/edit?hl=en&authkey=CJLj0u4F#';
          } else{
            $sTranslatedUrl = str_replace(array("a=v&","pid=explorer&","chrome=false&","chrome=true&","api=true&","embedded=true&","hl=en_US&"),"",$sTranslatedUrl);
            $sTranslatedUrl = str_replace("?id=","?srcid=",$sTranslatedUrl);
            $aFindThese = array("https://", "http://", "leaf", "fileview", "&id=", "?");
            $aReplaceWithThese = array("", "", "gview", "gview", "&srcid=", "?a=v&pid=explorer&chrome=false&api=true&embedded=true&hl=en_US&");
            $sTranslatedUrl = "http://" . str_replace($aFindThese, $aReplaceWithThese, $sTranslatedUrl);
          }
        }

		if ($sUserLanguage != "en") {
		$sFrameJs = '';
		//$sTranslatedUrl = 'http://translate.google.com/translate?js=y&prev=_t&hl=en&ie=UTF-8&layout=1&eotf=1&u='.str_replace(array("http://", "&"), array("", "%26"), trim($sTranslatedUrl)).'&sl=auto&tl=' . $sUserLanguage;
		}
	} else{
		if ($sUserLanguage != "en") {
		$sFrameJs = '';
		$sTranslatedUrl = 'http://translate.google.com/translate?js=y&prev=_t&hl=en&ie=UTF-8&layout=1&eotf=1&u='.str_replace(array("http://", "&"), array("", "%26"), trim($sTranslatedUrl)).'&sl=auto&tl=' . $sUserLanguage;
		}
	}

	if(_entertainment_check_hopeful($iUserId) == 'hopeful'){
		$sWriteReview = ($iVoteCount == 0) ? '<img align="absmiddle" src="'.base_path().'hud_files/images/leaving_review_btn.png" border="0" id="rating_WriteReview" />':'';
		$sReviewForm = ($iVoteCount == 0) ? rating_include_review_form($sType, $sSubType, $iRefId):'';
	} else{
		$sWriteReview = '';
		$sReviewForm = '';
	}

	$sOutput = '<html>
				<head>
				<title>Hope Cybrary</title>
				<style>
				body{
					font-family:arial;
					color:#e5f031;
					font-size:12px;
					background:#0d3802 url('.base_path().'hud_files/images/leaving_top.png) repeat-x top center;
					overflow:scroll;
				}
				td{
					font-size:11px;
				}
				.rating{
					margin-bottom: 0px;
				}
				.jframe {
					position: absolute;
					top:50px;
					z-index:0;
				}
				.kframe {
					position: absolute;
					top:130px;
					z-index:0;
				}
				.hrating div {
					background:#0d3802;
				}

				#rating_btnSubmit {
					width:109px;
					height:32px;
					border:none;
					background:#0d3802 url('.base_path().'hud_files/images/leaving_submitreview_btn.png) no-repeat;
				}
				</style>
				<link type="text/css" rel="stylesheet" media="all" href="'.$sBasePath.'sites/all/modules/rating/rating.css?t" />
				<script type="text/javascript" src="'.$sBasePath.'misc/jquery.js?t"></script>
				<script type="text/javascript" src="'.$sBasePath.'sites/all/modules/rating/rating.js?t"></script>
				<script type="text/javascript">
				var sBasePath = \''.$sBasePath.'\';
				var iContentId = '.$iRefId.';
				var sOrigUrl = "'.$sOrigUrl.'";
				var sLang = "' . $sUserLanguage . '";

				function disableTranslation() {
					document.getElementById("entertainment_frame").src = sOrigUrl;
					document.getElementById("entertainment_frame").className = "kframe";
					sLang = "en";
					setIframeHeight("entertainment_frame");
				}

				function setIframeHeight(iframeName) {
					var iframeEl = document.getElementById? document.getElementById(iframeName): document.all? document.all[iframeName]: null;
					var iHeightfix = (sLang == "en" ? 0 : 80);
					if (iframeEl) {
						iframeEl.style.height = "auto"; // helps resize (for some) if new doc shorter than previous
						// need to add to height to be sure it will all show
						var h = alertSize();
						var new_h = (h-135);
						iframeEl.style.height = (iHeightfix *1) + new_h + "px";
					}
				}

				function alertSize() {
					var myHeight = 0;
					if( typeof( window.innerWidth ) == "number" ) {
						//Non-IE
						myHeight = window.innerHeight;
						} else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
						//IE 6+ in standards compliant mode
						myHeight = document.documentElement.clientHeight;
						} else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
						//IE 4 compatible
						myHeight = document.body.clientHeight;
					}
					return myHeight;
				}

				function closeFrame() {
					//if (typeof(window.scrollbars) != "undefined")
					//	window.scrollbars.visible = true;
					//if (typeof(window.toolbar) != "undefined")
					//	window.toolbar.visible = true;

					var options = "scrollbars=yes,resizable=yes,status=1,toolbar=1,menubar=no,location=no";
					options += ",width=" + screen.availWidth + ",height=" + screen.availHeight;
					options += ",screenX=0,screenY=0,top=0,left=0";
					var win = window.open(\''.$sTranslatedUrl.'\', "", options);
					win.focus();
					win.moveTo(0, 0);
					window.close();
				}
				</script>
				</head>
				<body onload="setIframeHeight(\'entertainment_frame\');" onresize="setIframeHeight(\'entertainment_frame\');">
					<iframe class="jframe" id="entertainment_frame" src="' . $sTranslatedUrl . '" style="width:97%; height:550px;" frameborder="0"></iframe>

					<table style="width:99%;margin-top:20px;z-index:1000;position:absolute;top:0px" bgcolor="#0d3802">
						<tr style="height:93px;">
							<td width="3" bgcolor="#56ee1b" style="padding:0px;"></td>
							<td style="width:150px;" valign="top"><img src="'.base_path().'hud_files/images/leaving_hopenet.png" /></td>
							<td width="3" bgcolor="#56ee1b" style="padding:0px;"></td>
							<td align="center" width="180" valign="top" class="hrating">
								<div style="font-weight:bold; padding-bottom:5px;">HopeNet Rating</div>
								'.rating_include_star("hopenet", $sType, $sSubType, $iRefId).'
								<div style="font-size:0.8em; cursor:pointer;" onclick="rating_ShowList(\''.$sType.'\', \''.$sSubType.'\', '.$iRefId.', \'hopenet\')">Detailed HopeNet Rating</div>
							</td>
							<td width="3" bgcolor="#56ee1b" style="padding:0px;"></td>
							<td width="185" align="center" valign="top">
								<div style="font-weight:bold; padding-bottom:5px;">Average Hopeful Rating</div>
								'.rating_include_star("child", $sType, $sSubType, $iRefId).'
								<div style="font-size:0.8em; cursor:pointer;"><a href="#" style="text-decoration:none;color:#e5f031" onclick="rating_ShowList(\''.$sType.'\', \''.$sSubType.'\', '.$iRefId.', \'child\')">See all hopeful reviews</a>&nbsp;&nbsp;&nbsp;'.$sWriteReview.'</div>
								'.$sReviewForm.'
							</td>
							<td width="3" bgcolor="#56ee1b" style="padding:0px;"></td>
							<td valign="top">
								<span style="font-weight:bold;">This page has been translated to <span id="language">' . $sUserLanguageName . '</span></span>
								<p align="right"><a href="#" onclick="javascript:disableTranslation()"><img src="'.base_path().'hud_files/images/leaving_translate_btn.png" border="0" /></a></p>
							</td>
							<td width="3" bgcolor="#56ee1b" style="padding:0px;"></td>
							<td width="235" valign="top">
								<p align="right"><a href="#" onclick="closeFrame();"><img src="'.base_path().'hud_files/images/leaving_close_btn.png" border="0" /></a></p>
								<div style="width:100%; font-size:0.8em;color:56ee1b;">
									'._entertainment_list_changelog($iRefId, "site").'
								</div>
							</td>
							<td width="3" bgcolor="#56ee1b" style="padding:0px;"></td>
						</tr>
					</table>

					<div id="rating_RatingContainer" style="display:none; overflow:auto; width:400px; height:auto; z-index:2000; background-color:#0d3802; border:3px solid yellow; position:absolute; top:87px; left:26%; padding:10px;"></div>

				<script type="text/javascript">
				' . $sFrameJs . '
				</script>
				<style>
				ul.rating li a:hover {
					z-index:2;
					width:80px;
					height:16px;
					overflow:hidden;
					left:0;
					background: url('.base_path().'sites/all/modules/rating/rating.png) no-repeat 0 0
				}
				.rating{
					width:80px;
					height:16px;
					margin:0 0 20px 0;
					padding:0;
					list-style:none;
					clear:both;
					position:relative;
					background: url('.base_path().'sites/all/modules/rating/rating.png) no-repeat 0 0;
				}
				.nostar {background-position:0 0}
				.onestar {background-position:0 -16px}
				.twostar {background-position:0 -32px}
				.threestar {background-position:0 -48px}
				.fourstar {background-position:0 -64px}
				.fivestar {background-position:0 -80px}
				</style>
				</body>
				</html>';

	exit($sOutput);
}

function _entertainment_check_hopeful($iUserId){
global $user;

    $result = 0;
    foreach($user->roles as $values => $fields){
           if($values == '9'){
                $result = 1;
           }
    }

	if ($result == 0) {
		return 'notahopeful';
	} else {
		return 'hopeful';
	}
}

function entertainment_delete(){
	global $user;

	//dump_this($_REQUEST);

	if (count($_POST) >= 4  && $user->uid > 0){
		foreach ($_REQUEST as $sKey => $sData) {
			${$sKey} = $sData;
		}

		if (isset($sRedirectTo)){
			drupal_set_breadcrumb(
				array(
					l("Home", "<front>"),
					l("Get Involved", "entertainment/getinvolved"),
					l((($sUserType == "editors") ? "Editors":"Administrators"), "entertainment/getinvolved/".$sUserType),
					l("Existing ".(($sUserType == "editors") ? "Items":"Contents"), "entertainment/getinvolved/".$sUserType."/existing/items"),
				)
			);
		}else{
			$sRedirectTo = base_path().'entertainment/url/'.$iGroupLevel;
			entertainment_set_site_breadcrumb($iGroupLevel);
		}

		drupal_add_js('setTimeout("location=\''.$sRedirectTo.'\'", 5000)', "inline");

		if ($sType == "subj") $sTrueType = "subject";
		if ($sType == "rec") $sTrueType = "site_rec";
		if ($sType == "other") $sTrueType = "site_other";
		if ($sType == "file") $sTrueType = "file";

		if ($sUserType == "editors"){
			$sqlDelete = "INSERT INTO {mystudyrecord_suggested_delete}
							VALUES(NULL, %d, %d, '%s', %d, '%s')";
			db_query($sqlDelete, array($user->uid, $iGroupLevel, $sTrueType, $iRecId, $sDeleteComment));

			$sNotice = "The item has been successfully submitted.";
		}elseif ($sUserType == "admins"){
			$sqlDelete = "DELETE FROM %s WHERE id = %d";

			if ($sType == "rec"){
				$sTable = "mystudyrecord_site";
			}elseif ($sType == "other"){
				$sTable = "mystudyrecord_suggested_site";
			}elseif ($sType == "file"){
				$sTable = "mystudyrecord_file";
			}elseif ($sType == "subj"){
				$aSubjId = _entertainment_recurse_subj($iRecId);
				$sSubjId = implode(",", $aSubjId["aSubjectId"]);
				$sDataId = implode(",", $aSubjId["aContentId"]);

				$sqlDelSubj = "DELETE FROM mystudyrecord WHERE id IN (%s)";
				$sqlDelData1 = "DELETE FROM mystudyrecord_file WHERE iGroupLevel IN (%s)";
				$sqlDelData2 = "DELETE FROM mystudyrecord_site WHERE group_level IN (%s)";
				$sqlDelData3 = "DELETE FROM mystudyrecord_suggested_delete WHERE iGroupLevel IN (%s)";
				$sqlDelData4 = "DELETE FROM mystudyrecord_suggested_desc WHERE fid IN (%s)";
				$sqlDelData4 = "DELETE FROM mystudyrecord_suggested_file WHERE iGroupLevel IN (%s)";
				$sqlDelData5 = "DELETE FROM mystudyrecord_suggested_icon WHERE fid IN (%s)";
				$sqlDelData6 = "DELETE FROM mystudyrecord_suggested_site WHERE group_level IN (%s)";
				$sqlDelData7 = "DELETE FROM mystudyrecord_suggested_subj WHERE iGroupLevel IN (%s)";
				$sqlDelData8 = "DELETE FROM mystudyrecord_suggested_title WHERE fid IN (%s)";

				db_query($sqlDelSubj, $sSubjId);

				if (count($aSubjId["aContentId"]) > 0){
					for ($i=1; $i<=8; $i++){
						db_query(${"sqlDelData".$i}, $sDataId);
					}
				}

				$sNotice = "Selected subject has been deleted.";
			}

			if ($sType != "subj"){
				db_query($sqlDelete, array($sTable, $iRecId));

				$sNotice = "The item has been successfully deleted.";
			}
		}

		drupal_set_message($sNotice);

		return "";
	}else{
		drupal_access_denied();
	}
}

function entertainment_file_delete(){
	global $user;

	if (count($_POST) >= 4 && $user->uid > 0){
		foreach ($_REQUEST as $sKey => $sData) {
			${$sKey} = $sData;
		}

		drupal_add_js('setTimeout("location=\''.base_path().'entertainment/file/'.$sFileType.'/'.$iGroupLevel.'\'", 5000)', "inline");
		entertainment_set_site_breadcrumb($iGroupLevel);

		$sqlDelete = "INSERT INTO {mystudyrecord_suggested_delete}
						VALUES(NULL, %d, %d, '%s', %d, '%s')";
		db_query($sqlDelete, array($user->uid, $iGroupLevel, $sType, $iRecId, $sDeleteComment));

		// Point System for Suggestion - Submit
		userpoints_userpointsapi(array("tid" => 195));

		drupal_set_message("The file has been successfully submitted.");

		return "";
	}else{
		drupal_access_denied();
	}
}
function entertainment_subj_del($iGroupLevel=0){
	global $user;

	$iId = $iGroupLevel;
	$sBreadcrumb = "";

	while ($iId > 0) {
      $query = "SELECT * FROM {mystudyrecord} where id = %d";
      $queryResult = db_query($query, $iId);
      $rec = db_fetch_object($queryResult);
      $aTrail[] =  l($rec->title, "admin/content/entertainment/cat/del/".$iId);
      $iId = $rec->group_level;
	}

	$aTrail[] =  l("Main", "admin/content/entertainment/cat/del/0");

	foreach (array_reverse($aTrail) as $sLink){
		$sBreadcrumb .= ($sBreadcrumb != "") ? ' <span style="color:#173101;">&raquo;</span> ':'';
		$sBreadcrumb .= str_replace('<a ', '<a style="color:#173101; text-transform:uppercase;" ', $sLink);
	}

	$sBasePath = base_path();
	$sOutput = '<form action="'.$sBasePath.'admin/content/entertainment/cat/del/submit" method="post" onsubmit="return ValidateSubjDel();">
				<input type="hidden" name="entertainment_group_id" value="'.$iGroupLevel.'" />
				<table><tr><td colspan="4"><div class="breadcrumb" style="padding:10px 0px 20px; 0px">'.$sBreadcrumb.'</div></td></tr>';
	$sqlSubj = "SELECT A.id, A.group_level, A.title, A.leaf, A.icon
				FROM {mystudyrecord} A
				WHERE A.group_level = %d
				ORDER BY A.id";
	$oSubjResult = db_query($sqlSubj, $iGroupLevel);

	$iColCount = 4;
	$iCount = 0;

	while ($oSubj = db_fetch_object($oSubjResult)){
		$iCount++;

		$iSubjId = $oSubj->id;
		$sSubjTitle = strtoupper($oSubj->title);
		$sURL = ($oSubj->leaf == "0") ? $sBasePath."admin/content/entertainment/cat/del/".$iSubjId:"javascript:void(0);";

		if ($iCount == 1) $sOutput .= '<tr>';

		$sOutput .= '<td>
						<table style="margin:0px 3px 10px 0px">
							<tr>
								<td style="width:20px;"><input type="radio" id="entertainment_del_subj_'.$iSubjId.'" name="entertainment_del_subj" value="'.$iSubjId.'" /></td>
								<td style="width:130px;"><label for="entertainment_del_subj_'.$iSubjId.'">'.((strlen($sSubjTitle) > 15) ? substr($sSubjTitle, 0, 15)."...":$sSubjTitle).'</label></td>
							</tr>
							<tr>
								<td colspan="2" style="padding-top:5px;">
									<a href="'.$sURL.'"><img src="'.$sBasePath.'entertainment/image/main/'.$iSubjId.'" title="'.$sSubjTitle.'" width="150" height="150" /></a>
								</td>
							</tr>
						</table>
					</td>';

		if ($iCount == 4){
			$iCount = 0;
			$sOutput .= '</tr>';
		}
	}

	$sOutput .= str_repeat('<td></td>', ($iColCount-$iCount)).'</tr><tr><td colspan="4" style="text-align:right;"><button type="submit" name="entertainment_del_subj_button" value="delete_subject" class="form-submit">Delete Subject</button></td></tr></table></form>';

	return $sOutput;
}

function entertainment_subj_del_submit(){
	$iGroupId = $_REQUEST["entertainment_group_id"];
	$iSubjId = $_REQUEST["entertainment_del_subj"];
	$aSubjId = _entertainment_recurse_subj($iSubjId);

	$sSubjId = implode(",", $aSubjId["aSubjectId"]);
	$sDataId = implode(",", $aSubjId["aContentId"]);

	$sqlDelSubj = "DELETE FROM mystudyrecord WHERE id IN (%s)";
	$sqlDelData1 = "DELETE FROM mystudyrecord_file WHERE iGroupLevel IN (%s)";
	$sqlDelData2 = "DELETE FROM mystudyrecord_site WHERE group_level IN (%s)";
	$sqlDelData3 = "DELETE FROM mystudyrecord_suggested_delete WHERE iGroupLevel IN (%s)";
	$sqlDelData4 = "DELETE FROM mystudyrecord_suggested_desc WHERE fid IN (%s)";
	$sqlDelData4 = "DELETE FROM mystudyrecord_suggested_file WHERE iGroupLevel IN (%s)";
	$sqlDelData5 = "DELETE FROM mystudyrecord_suggested_icon WHERE fid IN (%s)";
	$sqlDelData6 = "DELETE FROM mystudyrecord_suggested_site WHERE group_level IN (%s)";
	$sqlDelData7 = "DELETE FROM mystudyrecord_suggested_subj WHERE iGroupLevel IN (%s)";
	$sqlDelData8 = "DELETE FROM mystudyrecord_suggested_title WHERE fid IN (%s)";

	db_query($sqlDelSubj, $sSubjId);
	//echo str_replace("%s", $sSubjId, $sqlDelSubj)."<br />";

	for ($i=1; $i<=8; $i++){
		db_query(${"sqlDelData".$i}, $sDataId);
		//echo str_replace("%s", $sDataId, ${"sqlDelData".$i})."<br />";
	}

	drupal_add_js('setTimeout("location=\''.base_path().'admin/content/entertainment/cat/del/'.$iGroupId.'\'", 5000)', "inline");

	$sMessage = "<br />Your selected subject and all data under it has been deleted successfully.<br /><br />
				<small>You will be redirected back to the subjects in awhile...</small>";
	drupal_set_message($sMessage);

	return "";
}

function _entertainment_recurse_subj($iSubjId){
	$aSubjToDel = array($iSubjId);
	$aContentToDel = array();

	$sqlDel = "SELECT id, group_level, title, leaf FROM mystudyrecord WHERE group_level = %d";
	$oDelResult = db_query($sqlDel, $iSubjId);

	while ($oDel = db_fetch_object($oDelResult)){
		$iThisId = $oDel->id;

		if ($oDel->leaf == 1){
			$aContentToDel[] = $iThisId;
		}else{
			$aSubToDel = _entertainment_recurse_subj($iThisId);

			$aSubjToDel = array_merge($aSubjToDel, $aSubToDel["aSubjectId"]);
			$aContentToDel = array_merge($aContentToDel, $aSubToDel["aContentId"]);
		}
	}

	return array("aSubjectId" => $aSubjToDel, "aContentId" => $aContentToDel);
}

function entertainment_view($group_level=0){
	global $user;

	$sJavaScript = 'var entertainment_iGroupLevel = '.$group_level.';
					var entertainment_sBasePath = "'.base_path().'";';

	drupal_add_js($sJavaScript, "inline");

	$page_content = '';
	$numCols = 3;

	if ($group_level == 0) $numCols = 4;

	$page_content .= entertainment_category_title($group_level);

	entertainment_set_cat_breadcrumb($group_level);

	$query = "SELECT A.id, A.group_level, A.title, A.leaf, A.icon,
					IF(A.desc IS NULL, 'No description available.', A.desc) AS sDescription
				FROM {mystudyrecord} A
				WHERE A.group_level = %d
				ORDER BY A.id";
	$queryResult = db_query($query, $group_level);

	if ($group_level == 0){
		$page_content .= html_view_top_0();
		$page_content .= '<div class="child_r">';
		$page_content .= html_choose();
		$counter = 1;

		while ($rec = db_fetch_object($queryResult)){
			if ($counter % $numCols == 0) $page_content .= '<div class="child_r">';

			$counter = $counter + 1;
			if (($counter/$numCols) < 1){
				$page_content .= (($counter % $numCols) != 0) ? '<div class="chbx_topl">':'<div class="chbx_topr">';
			}elseif ($counter / $numCols >2){
				$page_content .= (($counter % $numCols) != 0) ? '<div class="chbx_btml">':'<div class="chbx_btmr">';
			}else{
				$page_content .= (($counter % $numCols) != 0) ? '<div class="chbx_midl">':'<div class="chbx_midr">';
			}

			$aurl = base_path().'entertainment/'.$rec->id;

			if ($rec->leaf != 0) $aurl = base_path().'entertainment/url/'.$rec->id;

			$page_content .= '<div class="ch_subj">
								<div><h3><a href="'.$aurl .'">'.$rec->title.'</a></h3></div>
								<div><a href="'.$aurl.'"><img id="img_'.$rec->id.'" src="'.base_path().'entertainment/image/main/'.$rec->id.'" title="" /></a></div>
								<div id="img_'.$rec->id.'_desc" style="display:none;">'.$rec->sDescription.'</div>
							</div>';

			$page_content .= '</div>';

			if ($counter % $numCols == 0) {
				$page_content .= '<div class="clear"></div>';
				$page_content .= '</div>';
			}
		}

		$page_content .= html_view_bot_0();
	}else{
		$page_content .= html_view_top_m();

		$counter = 0;
		while ($rec = db_fetch_object($queryResult)){
			if ($counter % $numCols == 0) $page_content .= '<tr>';

			$counter = $counter + 1;

			$aurl = base_path().'entertainment/' . $rec->id;
			if ($rec->leaf != 0) $aurl = base_path().'entertainment/url/' . $rec->id;

			$page_content .= '<td width="33%">
								<table width="100%" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td class="book_title"><h4>'.$rec->title.'</h4></td>
									</tr>
									<tr>
										<td class="book_img">
											<a href="'.$aurl.'"><img id="img_'.$rec->id.'" width="162" height="162" src="'.base_path().'entertainment/image/main/'.$rec->id.'" /></a>
											<div id="img_'.$rec->id.'_desc" style="display:none;">'.$rec->sDescription.'</div>
										</td>
									</tr>
								</table>
							</td>';

			$page_content .= '</div>';

			if (($counter % $numCols) == 0) $page_content .= '</tr>';
		}

		$page_content .= html_view_bot_m();
	}
	if ($user->uid > 0){
		$page_content .= '<br />
							<button id="entertainment_edit_mode" class="form-submit" style="display:none;">Edit Mode</button>
							<div id="entertainment_edit_mode_notice" style="display:none; width:230px; text-align:center; background-color:#FFFFFF; padding:10px; border: 5px solid #C0C0C0;">
								<div style="width:100%; background-color:#C0C0C0;"><b>Edit Mode</b></div>
								<h3>What do you want to do?</h3><br />
								<button id="entertainment_edit_mode_notice_amend" type="button" class="form-submit" style="width:220px;">Amend the existing '.(($group_level == 0) ? 'Subjects':'Sub-Categories').'</button><br />
								<button id="entertainment_edit_mode_notice_add" type="button" class="form-submit" style="width:220px; margin-top:10px;">Add a '.(($group_level == 0) ? 'Subject':'Sub-Category').'</button>
								<button id="entertainment_edit_mode_notice_cancel" type="button" class="form-submit" style="width:220px; margin-top:10px;">Cancel</button>
							</div>';
	}

	return $page_content;
}

/**
 * Edit Categories
 */
function entertainment_edit($group_level = 0) {
	global $user;

	if ($user->uid <= 0) drupal_access_denied();

	entertainment_set_cat_breadcrumb($group_level);

	$numCols = 3;
	$page_content = '';
	$submit_success = $_GET['submit_success'];

	if ($submit_success) $page_content .= '<div>Your suggestions have been submitted</div>';
	if ($group_level == 0) $numCols = 4;

	$page_content .= entertainment_category_title($group_level);
	$page_content .= '<form action="'.base_path().'entertainment/edit/submit" enctype="multipart/form-data" method="post">
						<input type="hidden" name="user_id" value="'.$user->uid.'"/>
						<input type="hidden" name="group_level" value="'.$group_level.'"/>';

	$query = "SELECT A.id, A.group_level, A.title, A.leaf, A.icon,
					IF(A.desc IS NULL, 'Description will go here.', A.desc) AS sDescription
				FROM {mystudyrecord} A
				WHERE group_level = %d
				ORDER BY id";
	$queryResult = db_query($query, $group_level);

	if ($group_level == 0){
		$page_content .= html_view_top_0();
		$page_content .= '<div class="child_r">';
		$page_content .= html_choose();
		$counter = 1;

		while ($rec = db_fetch_object($queryResult)){
			if (($counter % $numCols) == 0)  $page_content .= '<div class="child_r">';

			$counter = $counter + 1;

			if (($counter/$numCols) < 1){
				$page_content .= (($counter % $numCols) != 0) ? '<div class="chbx_topl">':'<div class="chbx_topr">';
			}elseif ($counter / $numCols > 2){
				$page_content .= (($counter % $numCols) != 0) ? '<div class="chbx_btml">':'<div class="chbx_btmr">';
			}else{
				$page_content .= (($counter % $numCols) != 0) ? '<div class="chbx_midl">':'<div class="chbx_midr">';
			}

			$aurl = base_path().'entertainment/'.$rec->id;

			if ($rec->leaf != 0) $aurl = base_path().'entertainment/url/'.$rec->id;

			$page_content .= '<div class="ch_subj">
								<div><input type="text" name="title['.$rec->id.']" value="'.$rec->title.'" style="width:122px;" /></div>
								<div><img src="'.base_path().'entertainment/image/main/'.$rec->id.'" /></div>
								<div><input style="position: relative; top: -12px; font-size:12px"  type="file" name="icon['.$rec->id.']" size="5"/></div>
								<div><textarea name="desc['.$rec->id.']" style="width:122px; position:relative; top:-85px;">'.$rec->sDescription.'</textarea></div>
							</div>';

			$page_content .= '</div>';

			if (($counter % $numCols) == 0) {
				$page_content .= '<div class="clear"></div>';
				$page_content .= '</div>';
			}
		}

	  $page_content .= html_view_bot_0();
	}else{
		$page_content .= html_view_top_m();
		$counter = 0;
		while ($rec = db_fetch_object($queryResult)){
			if ($counter % $numCols == 0) $page_content .= '<tr>';

			$counter = $counter + 1;

			$aurl = base_path.'entertainment/'.$rec->id;

			if ($rec->leaf != 0) $aurl = base_path().'entertainment/url/'.$rec->id;

			$page_content .= '<td width="33%">
								<table width="100%" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td class="book_title"><h4><input type="text" name="title['.$rec->id.']" value="'.$rec->title.'" style="width:162px;" /></h4></td>
									</tr>
									<tr><td class="book_img">
										<img width="162" height="162" src="'.base_path().'entertainment/image/main/'.$rec->id.'" />
										<div><input style="position: relative; top: -12px; font-size:12px" type="file" name="icon['.$rec->id.']" size="13"/></div></td>
									</tr>
									<tr>
										<td><textarea name="desc['.$rec->id.']" style="width:162px; height:100px;">'.$rec->sDescription.'</textarea></td>
									</tr>
								</table>
							</td>';

			$page_content .= '</div>';

			if ($counter % $numCols == 0) $page_content .= '</tr>';
		}

		$page_content .= html_view_bot_m();
	}

	$page_content .= '<br /><button id="btnSuggestCancel" type="button" name="btnSuggestCancel" class="form-submit"">Cancel</button>&nbsp;&nbsp;<input type="submit" class="form-submit" value="Suggest Changes">';
	$page_content .= '</form>';

	return $page_content;
}
function entertainment_edit_add($iGroupLevel){
	global $user;

	if ($user->uid <= 0) drupal_access_denied();

	$sJavaScript = 'var entertainment_iGroupLevel = '.$iGroupLevel.';
					var entertainment_sBasePath = "'.base_path().'";';

	drupal_add_js($sJavaScript, "inline");

	entertainment_set_cat_breadcrumb($iGroupLevel);

	$sPageTitle = ($iGroupLevel == 0) ? "Main Subject":"Sub-Category";
	$sOutput = '<h3>'.$sPageTitle.'</h3>
				<form id="entertainment_add" method="post" action="'.base_path().'entertainment/edit/subj/add" enctype="multipart/form-data" onsubmit="return ValidateForm();">
					<input type="hidden" id="iUserId" name="iUserId" value="'.$user->uid.'" />
					<input type="hidden" id="iGroupLevel" name="iGroupLevel" value="'.$iGroupLevel.'" />

					<table>
						<tr>
							<td style="width:100px; padding-bottom:5px;">Title</td>
							<td><input type="text" id="sSubjTitle" name="sSubjTitle" style="width:300px;" /></td>
						</tr>
						<tr>
							<td style="padding-bottom:12px;">Icon/Image</td>
							<td><input type="file" id="sSubjIcon" name="sSubjIcon" /></td>
						</tr>
						<tr>
							<td>Description</td>
							<td><textarea id="sSubjDesc" name="sSubjDesc" style="width:300px; height:100px;"></textarea></td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:right; padding-top:12px;">
								<button id="btnSuggestCancel" type="button" name="btnSuggestCancel" class="form-submit"">Cancel</button>
								<button type="submit" id="btnSuggest" name="btnSuggest" class="form-submit">Suggest this '.(($iGroupLevel == 0) ? 'Main Subject':'Sub-Category').'</button>
							</td>
						</tr>
					</table>
				</form>';

	return $sOutput;
}

function entertainment_edit_add_submit(){
	global $user;
	$iUserId = $user->uid;

	if ($user->uid > 0 && count($_REQUEST) >= 5){
		foreach ($_REQUEST as $sKey => $sData) {
			${$sKey} = $sData;
		}

		$sRedirectTo = (isset($sRedirectTo)) ? $sRedirectTo:base_path().'entertainment/'.$iGroupLevel;
		$sSubjLeaf = (isset($sSubjLeaf)) ? "'".$sSubjLeaf."'":"NULL";

		drupal_add_js('setTimeout("location=\''.$sRedirectTo.'\'", 5000)', "inline");
		entertainment_set_cat_breadcrumb($iGroupLevel);

		$sTempIconName = $_FILES["sSubjIcon"]["tmp_name"];
		$iTempIconSize = $_FILES["sSubjIcon"]["size"];

		$oFP = fopen($sTempIconName, "r");
		$sIconData = fread($oFP, filesize($sTempIconName));
		fclose($oFP);

		/*
		$sqlSubj = "INSERT INTO {mystudyrecord_suggested_subj}
						(iUserId, iGroupLevel, sSubject, sIcon, sDescription, sLeaf)
					VALUES (%d, %d, '%s', %b, '%s', %s)";
		db_query($sqlSubj, $iUserId, $iGroupLevel, ucwords($sSubjTitle), $sIconData, ucfirst($sSubjDesc), $sSubjLeaf);
		*/

		/* --BEGIN Temporary workaround */
		$oConn = mysql_connect("localhost", "drupal", "drupadmin");
		mysql_select_db("drupal", $oConn);

		if ($sVolunteerType == "editors"){
			$sqlInsert = "INSERT INTO mystudyrecord_suggested_subj
							VALUES(NULL, ".$iUserId.", ".$iGroupLevel.", '".ucwords($sSubjTitle)."', '".addslashes($sIconData)."', '".addslashes(ucfirst($sSubjDesc))."', ".$sSubjLeaf.")";
		}else{
			$sqlInsert = "INSERT INTO mystudyrecord
							VALUES(NULL, ".$iGroupLevel.", '".ucwords($sSubjTitle)."', ".$sSubjLeaf.", '".addslashes($sIconData)."', '".addslashes(ucfirst($sSubjDesc))."')";
		}

		/* if (!mysql_query($sqlInsert)){
			mysql_error($oConn);
			mysql_close($oConn);
			exit;
		} */
		mysql_query($sqlInsert);
		mysql_close($oConn);
		/* --END Temporary workaround */

		drupal_set_message("Subject <em>\"".ucwords($sSubjTitle)."\"</em> has been successfully submitted.");

		return "";
	}else{
		drupal_access_denied();
	}
}

function entertainment_edit_submit(){
	foreach ($_REQUEST as $sKey => $sData) {
		${$sKey} = $sData;
	}

	$bProcessed = false;
	$sRedirectTo = (isset($sRedirectTo)) ? $sRedirectTo:base_path().'entertainment/'.$group_level;
	//$user_id = $_POST['user_id'];
	//$group_level = $_POST['group_level'];

	entertainment_set_cat_breadcrumb($group_level);
	drupal_add_js('setTimeout("location=\''.$sRedirectTo.'\'", 5000)', "inline");

	$range = array_keys($_POST['title']);

	foreach ($range as $key){
		$title = trim($_POST['title'][$key]);

		if ($title != ''){
			$count1_sql = "SELECT COUNT(*) as count FROM {mystudyrecord} WHERE id=%d AND title='%s'";
			$count1_result = db_result(db_query($count1_sql, array($key, $title)));
			$count2_sql = "SELECT COUNT(*) as count FROM {mystudyrecord_suggested_title} WHERE fid=%d AND title='%s'";
			$count2_result = db_result(db_query($count2_sql, array($key, $title)));
			$count = $count1_result +  $count2_result;

			if ($sVolunteerType == "editors"){
				if ($count <=0){
					$insert_sql = "INSERT INTO {mystudyrecord_suggested_title} (iUserId, fid, title, submit_date) VALUES(%d, %d, '%s', now())";
					db_query($insert_sql, array($user_id, $key, $title));
				}

				$bProcessed = true;
			}else{
				$sqlUpdate = "UPDATE mystudyrecord SET title = '%s' WHERE id = %d";
				db_query($sqlUpdate, array($title, $key));

				$bProcessed = true;
			}
		}
	}

	$range = array_keys($_FILES['icon']['name']);

	foreach ($range as $key){
		$tmpName = $_FILES['icon']['tmp_name'][$key];
		$fileSize = $_FILES['icon']['size'][$key];

		if ($fileSize > 0){
			$fp = fopen($tmpName, 'r');
			$content = fread($fp, filesize($tmpName));
			fclose($fp);

			if ($sVolunteerType == "editors"){
				$insert_sql = "INSERT INTO {mystudyrecord_suggested_icon} (iUserId, fid, icon, submit_date) VALUES(%d, %d, %b, now())";
				db_query($insert_sql, array($user_id, $key, $content));

				$bProcessed = true;
			}else{
				$sqlUpdate = "UPDATE mystudyrecord SET icon = %b WHERE id = %d";
				db_query($sqlUpdate, array($content, $key));

				$bProcessed = true;
			}
		}
	}

	$range = array_keys($_POST['desc']);

	foreach ($range as $key){
		$desc = ($_POST['desc'][$key] == "Description will go here.") ? "":trim($_POST['desc'][$key]);

		if ($desc != ""){
			$count1_sql = "SELECT COUNT(*) as count FROM {mystudyrecord} WHERE id=%d AND mystudyrecord.desc='%s'";
			$count1_result = db_result(db_query($count1_sql, array($key, $desc)));
			$count2_sql = "SELECT COUNT(*) as count FROM {mystudyrecord_suggested_desc} WHERE fid=%d AND mystudyrecord_suggested_desc.desc='%s'";
			$count2_result = db_result(db_query($count2_sql, array($key, $desc)));
			$count = $count1_result +  $count2_result;

			if ($sVolunteerType == "editors"){
				if ($count <= 0){
					$insert_sql = "INSERT INTO {mystudyrecord_suggested_desc} VALUES(NULL, %d, %d, '%s', NOW())";
					db_query($insert_sql, array($user_id, $key, $desc));

					$bProcessed = true;
				}
			}else{
				$sqlUpdate = "UPDATE mystudyrecord SET `desc` = '%s' WHERE id = %d";
				db_query($sqlUpdate, array($desc, $key));

				$bProcessed = true;
			}
		}
	}

	if ($sVolunteerType == "editors"){
		$sMessage = ($bProcessed) ? "Your suggestion(s) has been submitted.":"No suggestion(s) was submitted.";
	}else{
		$sMessage = ($bProcessed) ? "Your changes have been successfully applied.":"No changes were made.";
	}


	drupal_set_message($sMessage);

	return "";
}

function _entertainment_site($group_level, $sSiteType="site", $bEdit=false){
	entertainment_set_site_breadcrumb($group_level);

	$sImageURL = SHRINKTHEWEB.'&stwxmax=1024&stwymax=768&stwinside=1&stwurl=';
	$iSiteCount = 0;
	$sPageTitle = ($sSiteType == "site") ? "":" ".ucwords($sSiteType);

	$page_content = ($bEdit) ? '<form action="'.base_path().'entertainment/url/edit/submit" method="post"><input type="hidden" name="group_level" value="'.$group_level.'" /><input type="hidden" name="sSiteType" value="'.$sSiteType.'" />':'';
	$page_content .= '<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr><td><h3 style="color:red;">Recommended'.$sPageTitle.' Sites</h3></td></tr>
						<tr><td class="book_pg_descp">';

	# --BEGIN Recommended Sites
	$query = "SELECT *
				FROM {mystudyrecord_site}
				WHERE group_level = %d
					AND sSiteType = '".$sSiteType."'
				ORDER BY id ASC";
	$queryResult = db_query($query, $group_level);

	while ($rec = db_fetch_object($queryResult)){
		$iSiteCount++;
		$iRecId = $rec->id;
		$sSiteTitle = $rec->title;
		$sSiteURL = $rec->url;
		$sNewImageURL = $sImageURL.$sSiteURL;

		if ($bEdit){
			$sTitleHTML = '<input type="text" id="sRecTitle_'.$iRecId.'" name="aSiteTitle[]" value="'.$sSiteTitle.'" style="width:400px;" />
							<input type="hidden" name="aSiteTitle_orig[]" value="'.$sSiteTitle.'" />
							<input type="hidden" name="aSiteURL[]" value="'.$sSiteURL.'" />
							<input type="hidden" name="aSiteId[]" value="'.$iRecId.'" />';
			$sDescHTML = '<textarea name="aSiteDesc[]" style="width:400px; height:90px;">'.stripslashes($rec->description).'</textarea>
							<input type="hidden" name="aSiteDesc_orig[]" value="'.stripslashes($rec->description).'" /><br />
							<input type="text" id="sRecTags_'.$iRecId.'" name="aSiteTags[]" value="'.$rec->sTags.'" style="width:400px;" /><br />
							<input type="hidden"  name="aSiteTags_orig[]" value="'.$rec->sTags.'" style="width:400px;" />
							<button type="button" style="margin-top:5px;" id="btnDelRecSite_'.$iRecId.'" name="btnDelRecSite" value="'.$iRecId.'">Delete this Site</button>';
		}else{
			$sTitleHTML = '<h5><a id="entertainment_site_rec_link_'.$iRecId.'" href="'.$sSiteURL.'" target="_blank">'.$sSiteTitle.'</a></h5>';
			$sDescHTML = stripslashes($rec->description);
		}

		$page_content .= '<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="35%" class="book_pg_img" style="padding-bottom:15px;">
									<a href="'.$sSiteURL.'" target="_blank"><img width="162" height="162" src="'.$sNewImageURL.'" /></a>
								</td>
								<td width="65%" class="book_pg_dsp">' .
									$sTitleHTML .
									$sDescHTML.'
								</td>
							</tr>
						</table>';
	}

	$page_content .= ($iSiteCount == 0) ? '<table><tr><td>No recommended sites to display.</td></tr></table>':'';
	# --END Recommended Sites

	# --BEGIN Favorite Sites
	if (!$bEdit){
		$page_content .= '</td></tr>
						<tr><td><h3 style="color:red; padding-top:15px;">Favorite'.$sPageTitle.' Sites</h3></td></tr>
						<tr><td class="book_pg_descp">';

		$sqlFavorite = "(SELECT A.iVisitCount AS iVisitCount, B.id, B.group_level, B.title, B.url, B.description
						FROM mystudyrecord_favorite A
						INNER JOIN mystudyrecord_site B ON B.id = A.iRefId
						WHERE B.group_level = %d
							AND B.sSiteType = '%s')
						UNION
						(SELECT C.iVisitCount AS iVisitCount, D.id, D.group_level, D.title, D.url, D.description
						FROM mystudyrecord_favorite C
						INNER JOIN mystudyrecord_suggested_site D ON D.id = C.iRefId
						WHERE D.promoted = 1
							AND D.group_level = %d
							AND D.sSiteType = '%s')
						ORDER BY iVisitCount DESC
						LIMIT 3";
		$oFaveResult = db_query($sqlFavorite, array($group_level, $sSiteType, $group_level, $sSiteType));
		$iFaveSiteCount = 0;

		while ($oFave = db_fetch_object($oFaveResult)){
			$iFaveSiteCount++;
			$iRecId = $oFave->id;
			$sSiteTitle = $oFave->title;
			$sSiteURL = $oFave->url;
			$sNewImageURL = $sImageURL.$sSiteURL;

			$page_content .= '<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="35%" class="book_pg_img" style="padding-bottom:15px;">
										<a href="'.$sSiteURL.'" target="_blank"><img width="162" height="162" src="'.$sNewImageURL.'" /></a>
									</td>
									<td width="65%" class="book_pg_dsp">
										<h5><a id="entertainment_site_fave_link_'.$iRecId.'" href="'.$sSiteURL.'" target="_blank">'.$sSiteTitle.'</a></h5>'.
										$oFave->description.'
									</td>
								</tr>
							</table>';
		}

		$page_content .= ($iFaveSiteCount == 0) ? '<table><tr><td>No favorite sites to display.</td></tr></table>':'';
	}
	# --END Favorite Sites

	# --BEGIN Other Great Sites
	$page_content .= '</td></tr>
						<tr><td><h3 style="color:red; padding-top:15px;">Other Great'.$sPageTitle.' Sites</h3></td></tr>
						<tr><td class="book_pg_descp">';

	$sqlQuery = "SELECT id, title, url, description, sTags
				FROM {mystudyrecord_suggested_site}
				WHERE group_level = %d
					AND promoted = 1
					AND sSiteType = '".$sSiteType."'
				ORDER BY id ASC";
	$oQueryResult = db_query($sqlQuery, $group_level);
	$iOtherSiteCount = 0;

	while ($oQuery = db_fetch_object($oQueryResult)){
		$iOtherSiteCount++;
		$iRecId = $oQuery->id;
		$sSiteTitle = $oQuery->title;
		$sSiteURL = $oQuery->url;
		$sNewImageURL = $sImageURL.$sSiteURL;

		if ($bEdit){
			$sTitleHTML = '<input type="text" id="sOtherTitle_'.$iRecId.'" name="aOtherSiteTitle[]" value="'.$sSiteTitle.'" style="width:400px;" />
							<input type="hidden" name="aOtherSiteTitle_orig[]" value="'.$sSiteTitle.'" />
							<input type="hidden" name="aOtherSiteURL[]" value="'.$sSiteURL.'" />
							<input type="hidden" name="aOtherSiteId[]" value="'.$iRecId.'" />';
			$sDescHTML = '<textarea name="aOtherSiteDesc[]" style="width:400px; height:90px;">'.$oQuery->description.'</textarea>
							<input type="hidden" name="aOtherSiteDesc_orig[]" value="'.$oQuery->description.'" /><br />
							<input type="text" id="sOtherSiteTags_'.$iRecId.'" name="aOtherSiteTags[]" value="'.$oQuery->sTags.'" style="width:400px;" /><br />
							<input type="hidden" name="aOtherSiteTags_orig[]" value="'.$oQuery->sTags.'" style="width:400px;" />
							<button type="button" style="margin-top:5px" id="btnDelOtherSite_'.$iRecId.'" name="btnDelOtherSite" value="'.$iRecId.'">Delete this Site</button>';
		}else{
			$sTitleHTML = '<h5><a id="entertainment_site_other_link_'.$iRecId.'" href="'.$sSiteURL.'" target="_blank">'.$sSiteTitle.'</a></h5>';
			$sDescHTML = $oQuery->description;
		}

		$page_content .= '<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="35%" class="book_pg_img" style="padding-bottom:15px;">
									<a href="'.$sSiteURL.'" target="_blank"><img width="162" height="162" src="'.$sNewImageURL.'" /></a>
								</td>
								<td width="65%" class="book_pg_dsp">' .
									$sTitleHTML .
									$sDescHTML.'
								</td>
							</tr>
						</table>';
	}

	$page_content .= ($iOtherSiteCount == 0) ? '<table><tr><td>No other great sites to display.</td></tr></table>':'';
	# --END Other Great Sites

	$page_content .= '</td></tr>'.(($bEdit) ? '<tr><td colspan="2" align="right"><button id="btnSuggestCancel" type="button" name="btnSuggestCancel" class="form-submit"">Cancel</button>&nbsp;&nbsp;<button type="submit" name="btnSuggest" class="form-submit">Suggest Changes</button></td></tr>':'').'</table>';
	$page_content .= ($bEdit) ? '</form>':'';

	$page_content .= '<div id="entertainment_DeleteComment" style="display:none; width:300px; border: 5px solid #173102; padding:5px; background-color:#E2E2D3;">
							<form action="'.base_path().'entertainment/url/edit/del" method="post" onsubmit="return ValidateSiteDelForm();">
								<input type="hidden" id="sType" name="sType" value="" />
								<input type="hidden" id="iRecId" name="iRecId" value="" />
								<input type="hidden" id="iGroupLevel" name="iGroupLevel" value="'.$group_level.'" />

								<div id="sDeleteTitle" style="text-decoration:underline; font-weight:bold; padding-bottom:5px;"></div>
								Reason for suggesting this Site for deletion:<br />
								<textarea id="sDeleteComment" name="sDeleteComment" style="width:300px; height:100px;"></textarea><br />
								<div align="right" style="padding-top:5px;">
									<button id="btnDeleteCancel" type="button" name="btnDeleteCancel" class="form-submit"">Cancel</button>
									<button id="btnDelete" type="submit" name="btnDelete" class="form-submit"">Suggest for Deletion</button>
								</div>
							</form>
						</div>

						<div class="popup">
							<div class="popup_dscp">
								<table width="100%" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td align="center"><img src="" />	</td>
									</tr>
									<tr>
										<td class="link"><h3></h3></td>
									</tr>
								</table>
							</div>
						</div>';

	return $page_content;
}

function _entertainment_nav_icons($sType="site", $iGroupLevel){
	$sBasePath = base_path();
	$sBaseBorder = 'border: 1px solid #C0C0C0;';
	$sHighBorder = 'border: 2px solid #66A3D9;';

	$sHighlightVideo = ($sType == "video") ? $sHighBorder:$sBaseBorder;
	$sHighlightPic = ($sType == "image") ? $sHighBorder:$sBaseBorder;
	$sHighlightDoc = ($sType == "doc") ? $sHighBorder:$sBaseBorder;
	$sHighlightLink = ($sType == "site") ? $sHighBorder:$sBaseBorder;
	$sHighlightAnime = ($sType == "animation") ? $sHighBorder:$sBaseBorder;
	$sHighlightNews = ($sType == "news") ? $sHighBorder:$sBaseBorder;

	$sOutput = '<div align="center" style="position:relative; left:20%; font-size:.9em;">
					<table cellpadding="2">
						<tr>
							<td style="text-align:center;">
								<a href="'.$sBasePath.'entertainment/file/video/'.$iGroupLevel.'">
									<div style="width:72px; padding:16px; text-align:center; background-color:#FFFFFF; '.$sHighlightVideo.'">
										<img src="'.$sBasePath.'misc/icon_video_new.jpg" alt="Videos" />
										<div>VIDEOS</div>
									</div>
								</a>
							</td>
							<td style="text-align:center;">
								<a href="'.$sBasePath.'entertainment/file/image/'.$iGroupLevel.'">
									<div style="width:72px; margin-left:5px; padding:16px; text-align:center; background-color:#FFFFFF; '.$sHighlightPic.'">
										<img src="'.$sBasePath.'misc/icon_picture_new.jpg" alt="Pictures" />
										<div>PHOTOS</div>
									</div>
								</a>
							</td>
							<td style="text-align:center;">
								<a href="'.$sBasePath.'entertainment/file/doc/'.$iGroupLevel.'">
									<div style="width:88px; margin-left:5px; padding:9px; text-align:center; background-color:#FFFFFF; '.$sHighlightDoc.'">
										<img src="'.$sBasePath.'misc/icon_article_new.jpg" alt="Articles" />
										<div>BOOKS & REPORTS</div>
									</div>
								</a>
							</td>
							<td style="text-align:center;">
								<a href="'.$sBasePath.'entertainment/url/'.$iGroupLevel.'">
									<div style="width:72px; margin-left:5px; padding:16px; text-align:center; background-color:#FFFFFF; '.$sHighlightLink.'">
										<img src="'.$sBasePath.'misc/icon_link_new.jpg" alt="Web Links" />
										<div>WEB SITES</div>
									</div>
								</a>
							</td>
							<td style="text-align:center;">
								<a href="'.$sBasePath.'entertainment/url/animation/'.$iGroupLevel.'">
									<div style="width:72px; margin-left:5px; padding:16px; text-align:center; background-color:#FFFFFF; '.$sHighlightAnime.'">
										<img src="'.$sBasePath.'misc/icon_animation.jpg" alt="Animation" />
										<div>ANIMATIONS</div>
									</div>
								</a>
							</td>
							<td style="text-align:center;">
								<a href="'.$sBasePath.'entertainment/news/'.$iGroupLevel.'">
									<div style="width:72px; margin-left:5px; padding:16px; text-align:center; background-color:#FFFFFF; '.$sHighlightNews.'">
										<img src="'.$sBasePath.'misc/icon_news.jpg" alt="News" />
										<div>LATEST NEWS</div>
									</div>
								</a>
							</td>
						</tr>
					</table>
				</div>';

	return $sOutput;
}

function entertainment_news($iGroupLevel){
	$sCategory = entertainment_category_title($iGroupLevel, false);

	drupal_set_html_head('<script type="text/javascript" src="http://www.google.com/jsapi"></script>');

	$sJavaScript = 'google.load("elements", "1", {packages : ["newsshow"]});

					function onLoad() {
						var options = {
							"format" : "300x250",//728x90
							"linkTarget" : "_blank",
							"queryList" : [
								{
									"title" : "News about '.ucwords($sCategory).'",
									"q" : "'.$sCategory.'",
									"rsz" : "large"
								}
							]
						}

						var content = document.getElementById("entertainment_google_news");
						var newsShow = new google.elements.NewsShow(content, options);
					}

					google.setOnLoadCallback(onLoad);';

	drupal_add_js($sJavaScript, "inline");

	entertainment_set_site_breadcrumb($iGroupLevel);

	$sOutput = _entertainment_nav_icons("news", $iGroupLevel);
	$sOutput .= '<div id="entertainment_google_news" style="padding-top:15px; position:relative; left:50%;"></div>';

	return $sOutput;
}

function entertainment_file_add($sFileType="video", $iGroupLevel){
	global $user;

	if ($user->uid <= 0) drupal_access_denied();

	require "divshare_api.php";

	entertainment_set_site_breadcrumb($iGroupLevel);

	$sBasePath = base_path();
	$sJavaScript = 'var entertainment_iGroupLevel = '.$iGroupLevel.';
					var entertainment_sBasePath = "'.$sBasePath.'";';

	drupal_add_js($sJavaScript, "inline");

	$oDivShare = new divshare_api("3565-c19fab92b80e", "312e23305ca6");
	$sSessionKey = $oDivShare->login("f.lewis@firstearthalliance.org", "pabx42");

	if ($sSessionKey !== false) $sUpTicket = $oDivShare->get_upload_ticket();

	$oDivShare->logout();

	$sPageTitle = ($iGroupLevel == 0) ? "Main Subject":"Sub-Category";

	if ($sFileType == "video") $sPageTitle = " Video";
	if ($sFileType == "image") $sPageTitle = " Picture";
	if ($sFileType == "doc") $sPageTitle = "n Article";

	$sOutput = '<table style="position:relative; width:850px;">
					<tr>
						<td>
							<h3>Embed a'.$sPageTitle.' or External'.$sPageTitle.' Link</h3>
							<form id="entertainment_file_add_embed" method="post" action="'.$sBasePath.'entertainment/file/edit/add" enctype="multipart/form-data" onsubmit="return ValidateEmbed();">
								<input type="hidden" id="iUserId" name="iUserId" value="'.$user->uid.'" />
								<input type="hidden" id="sFileType" name="sFileType" value="'.$sFileType.'_embed" />
								<input type="hidden" id="iGroupLevel" name="iGroupLevel" value="'.$iGroupLevel.'" />

								<table>
									<tr>
										<td style="width:100px;">Title</td>
										<td><input type="text" id="sFileEmbedTitle" name="sFileEmbedTitle" style="width:300px;" /></td>
									</tr>
									<tr>
										<td style="padding-top:5px;">Embed Code</td>
										<td style="padding-top:5px;"><textarea id="sFileEmbedCode" name="sFileEmbedCode" maxlength="5" style="width:300px; height:100px;"></textarea></td>
									</tr>
									<tr>
										<td style="padding-top:5px;">External URL</td>
										<td style="padding-top:5px;"><input type="text" id="sFileEmbedURL" name="sFileEmbedURL" style="width:300px;" /></td>
									</tr>
									<tr>
										<td style="padding-top:5px;">Description</td>
										<td style="padding-top:5px;"><textarea id="sFileEmbedCodeDesc" name="sFileEmbedCodeDesc" style="width:300px; height:100px;"></textarea></td>
									</tr>
									<tr>
										<td style="padding-top:5px;">Tags</td>
										<td style="padding-top:5px;"><input type="text" id="sFileEmbedTags" name="sFileEmbedTags" style="width:300px;" /></td>
									</tr>
									<tr>
										<td colspan="2" style="text-align:right; padding-top:12px;">
											<button id="btnSuggestCancel_embed" type="button" name="btnSuggestCancel" class="form-submit"">Cancel</button>
											<button type="submit" id="btnSuggest" name="btnSuggest" value="Upload" class="form-submit">Suggest this Embed Code</button>
										</td>
									</tr>
								</table>
							</form>
						</td>
						<td style="width:50px;">&nbsp;</td>
						<td>
							<h3>Upload a'.$sPageTitle.'</h3>
							<form id="entertainment_file_add" method="post" action="http://upload.divshare.com/api/upload" enctype="multipart/form-data" onsubmit="return ValidateUpload();">
								<input type="hidden" id="iUserId" name="iUserId" value="'.$user->uid.'" />
								<input type="hidden" id="sFileType" name="sFileType" value="'.$sFileType.'" />
								<input type="hidden" id="iGroupLevel" name="iGroupLevel" value="'.$iGroupLevel.'" />
								<input type="hidden" id="upload_ticket" name="upload_ticket" value="'.$sUpTicket.'" />
								<input type="hidden" id="response_url" name="response_url" value="http://volunteer.firstearthalliance.org/entertainment/file/edit/add/response" />

								<table>
									<tr>
										<td style="width:100px;">Title</td>
										<td><input type="text" id="sFileTitle" name="sFileTitle" style="width:300px;" /></td>
									</tr>
									<tr>
										<td style="padding-top:5px;">File to Upload</td>
										<td style="padding-top:5px;"><input type="file" id="file1" name="file1" /></td>
									</tr>
									<tr>
										<td style="padding-top:5px;">Description</td>
										<td style="padding-top:5px;"><textarea id="file1_description" name="file1_description" style="width:300px; height:100px;"></textarea></td>
									</tr>
									<tr>
										<td style="width:100px;">Tags</td>
										<td style="padding-top:5px;"><input type="text" id="sFileTags" name="sFileTags" style="width:300px;" /></td>
									</tr>
									<tr>
										<td colspan="2" style="text-align:right; padding-top:12px;">
											<button id="btnSuggestCancel_add" type="button" name="btnSuggestCancel" class="form-submit"">Cancel</button>
											<button type="submit" id="btnSuggest" name="btnSuggest" value="Upload" class="form-submit">Upload this File</button>
										</td>
									</tr>
								</table>
							</form>
						</td>
					</tr>
				</table>';

	return $sOutput;
}

function entertainment_file_add_response(){
	if (!empty($_FILES["file1"])) {
		foreach ($_POST as $sKey => $sData) {
			${$sKey} = $sData;
		}

		ini_set('include_path',ini_get('include_path'). PATH_SEPARATOR . $_SERVER["DOCUMENT_ROOT"] . base_path() . 'sites/all/modules/mystudies');
		require_once 'Zend/Loader.php';

		if ($sFileType == "video") {
			Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
			Zend_Loader::loadClass('Zend_Gdata_YouTube');
			Zend_Loader::loadClass('Zend_Gdata_YouTube_VideoEntry');

			$authenticationURL= 'https://www.google.com/accounts/ClientLogin';
			$httpClient =
			  Zend_Gdata_ClientLogin::getHttpClient(
						  $username = 'hopecybrary@gmail.com',
						  $password = 'pabx42pabx42',
						  $service = 'youtube',
						  $client = null,
						  $source = 'HopeNet', // a short string identifying your application
						  $loginToken = null,
						  $loginCaptcha = null,
						  $authenticationURL);

			$developerKey = 'AI39si6mi3Wj_oCe3hjkyS2BsNTowkNL3q8OBQzTvAdcM0l1o1qZ6sENF-i8Ysg-uKYsK9TYuPNDWYWvQNlIR8MVslqWsUv5CA';
			$applicationId = '';
			$clientId = '';
			//yt:validationinvalid_valuemedia:group/media:category[@scheme='http://gdata.youtube.com/schemas/2007/categories.cat']/text()
			$yt = new Zend_Gdata_YouTube($httpClient, $applicationId, $clientId, $developerKey);
			$myVideoEntry = new Zend_Gdata_YouTube_VideoEntry();
			$filesource = $yt->newMediaFileSource($_FILES["file1"]["tmp_name"]);
			$filesource->setContentType($_FILES["file1"]["type"]);
			$filesource->setSlug($_FILES["file1"]["name"]);

			$myVideoEntry->setMediaSource($filesource);
			$myVideoEntry->setVideoTitle($sFileTitle);
			$myVideoEntry->setVideoDescription('My Test Movie');
			$myVideoEntry->setVideoCategory('entertainment');
			$myVideoEntry->SetVideoTags($sFileTags);

			$uploadUrl = 'http://uploads.gdata.youtube.com/feeds/api/users/default/uploads';
			try {
			  $newEntry = $yt->insertEntry($myVideoEntry, $uploadUrl, 'Zend_Gdata_YouTube_VideoEntry');
			} catch (Zend_Gdata_App_HttpException $httpException) {
			  echo $httpException->getRawResponseBody();
			} catch (Zend_Gdata_App_Exception $e) {
				echo $e->getMessage();
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}

			$sEmbedCode =  "http://www.youtube.com/watch?v=" . $newEntry->getVideoId() . "&feature=related";
			$file1 = '';
			$sFileType = "video_ext";
		} else {
			Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
			Zend_Loader::loadClass('Zend_Gdata_Docs');

			//$username = 'hopecybrary@gmail.com';
			$username = 'f.lewis@hopecybrary.org';
			$password = 'pabx42pabx42';
			$service = Zend_Gdata_Docs::AUTH_SERVICE_NAME;
			$httpClient = Zend_Gdata_ClientLogin::getHttpClient($username, $password, $service);

			$gdClient = new Zend_Gdata_Docs($httpClient);
			try {
				$gd = new Zend_Gdata_Docs($httpClient);
				$filenameParts = explode('.', $_FILES["file1"]["name"]);
          		$fileExtension = end($filenameParts);
          		$mimeType = $gd->lookupMimeType($fileExtension);
				$convert = "";
				if ($sFileType == "image" || in_array(strtolower($fileExtension),array("jpg","jpeg","gif","png","bmp")))
					$convert = "?convert=false";

				//$folder_id = "0B42gSlLPcU-oZDBmMGMzYjItYjU2OC00ZjJkLWJlODQtZTdkNzM2NmVhNzVh";
				$folder_id = "0B6tfruvzeXdjNjU5MDFlMWQtODFiOC00ZjBkLWI2NzctOGUwNDFlODY1MTll";
				 //$feed = $gd->getDocumentListFeed();
				// var_dump($feed); die;
				$newDocumentEntry = $gd->uploadFile($_FILES["file1"]["tmp_name"], $sFileTitle, $mimeType, "http://docs.google.com/feeds/default/private/full/folder%3A" . $folder_id . "/contents/" . $convert, array("GData-Version"=>"3.0"));
				//var_dump($newDocumentEntry);die;
				$sLink = $newDocumentEntry->getLink();
				$sEmbedCode = $sLink[0]->getHref();
			} catch (Zend_Gdata_App_HttpException $httpException) {
			  echo $httpException->getRawResponseBody();
			} catch (Zend_Gdata_App_Exception $e) {
				echo $e->getMessage();
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}

			$file1 = "";
			$data = file_get_contents($sEmbedCode . "&browserok=true");
			if (preg_match("/src=\"([^\"]+)\"\s+alt=\"Item Thumbnail\"/s",$data,$match))
				$file1 = $match[1];

			if ($sFileType == "image")
				$sFileType = "image_ext";
			else
				$sFileType = "doc_ext";
		}
	} else {
		foreach ($_GET as $sKey => $sData) {
			${$sKey} = $sData;
			$sEmbedCode = '';
		}
	}

	drupal_add_js('setTimeout("location=\''.base_path().'entertainment/file/'.$sFileType.'/'.$iGroupLevel.'\'", 5000)', "inline");
	entertainment_set_site_breadcrumb($iGroupLevel);

	$sFileTags = preg_replace('/\s\s+/', " ", str_replace(", ", ",", $sFileTags));
	$sqlInsert = "INSERT INTO mystudyrecord_suggested_file VALUES(NULL, %d, '%s', '%s', '%s', %d, NULL, '%s', '%s', '%s', NULL, NULL, 'other','%s')";
	db_query($sqlInsert, array($iUserId, $sFileType, $file1, $sEmbedCode, $iGroupLevel, $sFileTitle, $file1_description, $sFileTags, $sAgeGroup));
	db_query("UPDATE mystudies_volunteer SET iApprovedCount = IFNULL(iApprovedCount,0) + 1 WHERE uid = '" . $iUserId . "' AND type = 'guide'");


	$iRefId = db_last_insert_id("mystudyrecord_suggested_file", "id");
	$iItemId = $iRefId;

	_entertainment_volunteer_changelog("guide", $iRefId, $iItemId, "file", 1, 1, 1, 1, 1, "other");

	$sqlRating = "UPDATE rating_vote SET iContentId = %d, sSubType = '%s' WHERE id = %d";
	db_query($sqlRating, array($iRefId, $sFileType, $rating_iRatingId));

	// Point System for Suggestion - Submit
	userpoints_userpointsapi(array("tid" => 195));

	if (isset($sRedirectTo)){
		header("Location: ".urldecode($sRedirectTo));
	}else{
		drupal_set_message("Your suggestion has been submitted.");
	}

	return "";
}

function entertainment_file_add_submit(){
	if (count($_REQUEST) >= 5){
		foreach ($_REQUEST as $sKey => $sData) {
			${$sKey} = $sData;
		}

		drupal_add_js('setTimeout("location=\''.base_path().'entertainment/file/'.str_replace("_embed", "", $sFileType).'/'.$iGroupLevel.'\'", 5000)', "inline");
		entertainment_set_site_breadcrumb($iGroupLevel);

		if (trim($sFileEmbedCode) != ""){
			$sFileValue = $sFileEmbedCode;
		}else{
			$sFileType = str_replace("embed", "ext", $sFileType);
			$sFileValue = $sFileEmbedURL;
		}

		$sFileEmbedTags = preg_replace('/\s\s+/', " ", str_replace(", ", ",", $sFileEmbedTags));
		$sqlInsert = "INSERT INTO mystudyrecord_suggested_file VALUES(NULL, %d, '%s', NULL, '%s', %d, NULL, '%s', '%s', '%s', NULL, NULL, 'other','%s')";
		db_query($sqlInsert, array($iUserId, $sFileType, $sFileValue, $iGroupLevel, $sFileEmbedTitle, $sFileEmbedCodeDesc, $sFileEmbedTags,$sAgeGroup));
		db_query("UPDATE mystudies_volunteer SET iApprovedCount = IFNULL(iApprovedCount,0) + 1 WHERE uid = '" . $iUserId . "' AND type = 'guide'");

		$iRefId = db_last_insert_id("mystudyrecord_suggested_file", "id");
		$iItemId = $iRefId;

		_entertainment_volunteer_changelog("guide", $iRefId, $iItemId, "file", 1, 1, 1, 1, 1, "other");

		$sqlRating = "UPDATE rating_vote SET iContentId = %d, sSubType = '%s' WHERE id = %d";
		db_query($sqlRating, array($iRefId, $sFileType, $rating_iRatingId));

		// Point System for Suggestion - Submit
		userpoints_userpointsapi(array("tid" => 195));

		if (isset($sRedirectTo)){
			header("Location: ".$sRedirectTo);
		}else{
			drupal_set_message("Your suggestion has been submitted.");
		}

		return "";
	}else{
		drupal_access_denied();
	}
}

function entertainment_file_view($sFileType="video", $iGroupLevel){
	global $user;

	entertainment_set_site_breadcrumb($iGroupLevel);

	$sBasePath = base_path();
	$sJavaScript = 'var entertainment_iGroupLevel = '.$iGroupLevel.';
					var entertainment_sFileType = "'.$sFileType.'";
					var entertainment_sBasePath = "'.$sBasePath.'";';

	drupal_add_js($sJavaScript, "inline");

	$sOutput = _entertainment_nav_icons($sFileType, $iGroupLevel);
	$sOutput .= entertainment_category_title($iGroupLevel);

	$sHeader = '<div id="entertainment_file_content" style="position:relative; %css% border:0" align="center"><table style="width:100%;"><tr>';
	$sFooter = '</table></div>';
	$sBasePath = base_path();
	$iResultCount = 0;

	if ($sFileType == "video"){
		$sThisType = ucfirst($sFileType);
		$sDisplayCode = '<div style="margin-left:15px; margin-top:15px;">
							<object id="%s%" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,18,0" width="400" height="353">
								<param name="movie" value="http://www.divshare.com/flash/video?myId=%s%" />
								<param name="allowFullScreen" value="true" />
								<embed wmode="opaque" id="%s%" src="http://www.divshare.com/flash/video?myId=%s%" width="400" height="353" name="divflv" allowfullscreen="true" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>
							</object>
							<div><b>%title%</b></div>
							<div>%desc%</div>
						</div>';
	}

	if ($sFileType == "image"){
		$sThisType = "Picture";
		$sDisplayCode = '<div align="center" style="margin-left:10px; margin-top:10px; padding:2px; width:100px; height:100px; border:1px solid #C0C0C0;">
							<img class="thumbnail" id="%s%" src="http://www.divshare.com/img/thumb/%s%" />
						</div>
						<div style="margin-left:10px; margin-top:2px; padding:2px; width:100px;">
							<div style="text-align:center;">%title%</div>
						</div>';
	}

	if ($sFileType == "doc"){
		$sThisType = "Article";
		$sDisplayCode = '<div align="center" style="margin-left:10px; margin-top:10px; padding:2px; width:150px; border:1px solid #C0C0C0;">
							<img src="'.$sBasePath.'misc/file_doc.png" />
						</div>
						<div style="margin-left:10px; margin-top:2px; padding:2px; width:150px;">
							<div align="center"><b>%title%</b></div>
						</div>';
	}

	$sImageURL = SHRINKTHEWEB.'&stwinside=1';

	$sqlQuery = "SELECT id, sFileType, sFileId, sEmbedCode, iGroupLevel,
					IF(sTitle != '', sTitle, 'No Title Specified') AS sTitle, sDesc
				FROM mystudyrecord_file
				WHERE sFileType IN ('%s', '%s', '%s')
					AND iGroupLevel = %d";

	$oQueryResult = db_query($sqlQuery, array($sFileType, $sFileType."_embed", $sFileType."_ext", $iGroupLevel));

	while ($oQuery = db_fetch_object($oQueryResult)){
		$iResultCount++;
		$sSubFileType = $oQuery->sFileType;

		switch ($sFileType){
			case "video":
				$iCountPerCol = 2;
				$sWidth = "50%";
				$sCSS = "";

				if ($sSubFileType == $sFileType){
					$sData = str_replace(array("%s%", "%title%", "%desc%"), array($oQuery->sFileId, $oQuery->sTitle, $oQuery->sDesc), $sDisplayCode);
				}elseif ($sSubFileType == "video_embed"){
					$sData = '<div style="margin-left:15px; margin-top:15px;">'.str_replace('<embed', '<embed wmode="opaque"', $oQuery->sEmbedCode).'<div><h3>'.$oQuery->sTitle.'</h3></div><div>'.$oQuery->sDesc.'</div></div>';
				}else{
					$sData = '<div style="margin-left:15px; margin-top:15px;"><a href="'.$oQuery->sEmbedCode.'" target="_blank"><img src="'.$sImageURL.'&xmax=400&ymax=353&stwUrl='.$oQuery->sEmbedCode.'" /></a><div><h3>'.$oQuery->sTitle.'</h3></div><div>'.$oQuery->sDesc.'</div></div>';
				}

				break;
			case "image":
				$iCountPerCol = 6;
				$sWidth = "16%";
				$sCSS = "left:15%;";
				$sURL = $sBasePath.'entertainment/file/image/'.$iGroupLevel.'/view/'.$oQuery->id;

				if ($sSubFileType == $sFileType){
					$sData = str_replace(array("%s%", "%title%"), array($oQuery->sFileId, $oQuery->sTitle), $sDisplayCode);
				}elseif ($sSubFileType == "image_embed"){
					$sData = '<div align="center" style="margin-left:10px; margin-top:10px; padding:2px; height:100px; width:100px; border:1px solid #C0C0C0;">' .
								str_replace('<img', '<img class="thumbnail"', $oQuery->sEmbedCode).'
							</div>
							<div align="center" style="margin-left:10px; margin-top:2px; padding:2px; width:100px;">'.$oQuery->sTitle.'</div>';
				}else{
					$sData = '<div align="center" style="margin-left:10px; margin-top:10px; padding:2px; height:100px; width:100px; border:1px solid #C0C0C0;">
								<img class="thumbnail" src="'.$sImageURL.'&xmax=100&ymax=100&stwUrl='.$oQuery->sEmbedCode.'" />
							</div>
							<div align="center" style="margin-left:10px; margin-top:2px; padding:2px; width:100px;">'.$oQuery->sTitle.'</div>';
				}

				if ($sSubFileType == "image_ext"){
					$sData = '<a href="'.$oQuery->sEmbedCode.'" target="_blank">'.$sData.'</a>';
				}else{
					$sData = '<a href="'.$sBasePath.'entertainment/file/image/'.$iGroupLevel.'/view/'.$oQuery->id.'">'.$sData.'</a>';
				}

				break;
			case "doc":
				$iCountPerCol = 4;
				$sWidth = "25%";
				$sCSS = "left:15%;";

				$sFileHref = ($sSubFileType == "doc_ext") ? $oQuery->sEmbedCode:$sBasePath.'entertainment/file/image/'.$iGroupLevel.'/view/'.$oQuery->id;
				$sFileTab = ($sSubFileType == "doc_ext") ? 'target="_blank"':'';
				$sData = '<a href="'.$sFileHref.'" '.$sFileTab.'>'.str_replace(array("%s%", "%title%"), array($oQuery->sFileId, $oQuery->sTitle), $sDisplayCode).'</a>';

				break;
		}

		$sOutput .= ($iResultCount == 1) ? str_replace("%css%", $sCSS, $sHeader):"";
		$sOutput .= '<td style="width:'.$sWidth.';">'.$sData.'</td>';
		$sOutput .= ($iResultCount % $iCountPerCol != 0) ? "":"</tr><tr>";
	}

	if ($iResultCount == 0){
		$sOutput .= '<div>No '.strtolower($sThisType).'(s) to display, yet.</div>';
	}else{
		$sOutput .= str_repeat('<td style="width:'.$sWidth.';"></td>', ($iCountPerCol - ($iResultCount%$iCountPerCol)));
		$sOutput = $sOutput.$sFooter;
	}

	if ($user->uid > 0){
		$sOutput .= '<br />
					<button id="entertainment_edit_mode" class="form-submit" style="display:none;">Edit Mode</button>
					<div id="entertainment_edit_mode_notice" style="display:none; width:230px; text-align:center; background-color:#FFFFFF; padding:10px; border: 5px solid #C0C0C0;">
						<div style="width:100%; background-color:#C0C0C0;"><b>Edit Mode</b></div>
						<h3>What do you want to do?</h3><br />
						<button id="entertainment_edit_mode_file_notice_amend" type="button" class="form-submit" style="width:220px;">Amend the existing '.$sThisType.'s</button><br />
						<button id="entertainment_edit_mode_file_notice_add" type="button" class="form-submit" style="width:220px; margin-top:10px;">Add '.$sThisType.'</button>
						<button id="entertainment_edit_mode_notice_cancel" type="button" class="form-submit" style="width:220px; margin-top:10px;">Cancel</button>
					</div>';
	}

	return $sOutput;
}

function entertainment_file_view_file($sFileType="image", $iGroupLevel, $iFileId, $bSuggested=false){
	entertainment_set_site_breadcrumb($iGroupLevel);

	$sTable = (!$bSuggested) ? "mystudyrecord_file":"mystudyrecord_suggested_file";
	$sqlQuery = "SELECT id, sFileType, sFileId, sEmbedCode, iGroupLevel, sTitle, sDesc
				FROM %s
				WHERE id = %d";
	$oQueryResult = db_query($sqlQuery, array($sTable, $iFileId));
	$oQuery = db_fetch_object($oQueryResult);

	$sType = $oQuery->sFileType;
	$sFileId = $oQuery->sFileId;
	$sTitle = $oQuery->sTitle;
	$sDesc = $oQuery->sDesc;

	$sOutput = ($bSuggested) ? '':'<!--<div align="right" style="position:relative; width:880px; margin-bottom:5px;"><button id="entertainment_back_button" class="form-submit">Go Back</button></div>-->';

    if ($sType !== "image_embed"){
	$sOutput .= '<div id="entertainment_view_file" align="center" style="position:relative; padding:0px 10px 10px 10px; width:860px; border:1px solid #C0C0C0;"><h3>'.$oQuery->sTitle.'</h3>';
    }

	if (strpos($oQuery->sEmbedCode,"youtube.com/") !== false) {
		preg_match("/youtube\.com\/v\/([0-9a-zA-Z_-]+)/s",$oQuery->sEmbedCode,$aTmp);
		if (empty($aTmp[1]))
			preg_match("/youtube\.com\/watch\?v\=([0-9a-zA-Z_-]+)/s",$oQuery->sEmbedCode,$aTmp);
		if (!empty($aTmp[1])) {
			if (strpos($oQuery->sEmbedCode,"<object") !== false) {
				$sOutput .= $oQuery->sEmbedCode;
			} else {
				$sOutput .= '<object width="340" height="285">
								<param name="movie" value="' . str_replace("watch?v=","v/",$oQuery->sEmbedCode) . '"></param>
								<param name="allowFullScreen" value="true"></param>
								<param name="allowscriptaccess" value="always"></param>
								<embed src="' . str_replace("watch?v=","v/",$oQuery->sEmbedCode) . '" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="340" height="285"></embed>
							</object>';
			}
		}
	} else if ($sType == "image"){
		$sOutput .= '<img src="http://www.divshare.com/img/'.$sFileId.'" />';
	} else if ($sType == "image_embed"){
        $sOutput .= '
                <div align="center" style="width:400px;">
                    '.$oQuery->sEmbedCode.'
                    '.(($sTitle != "") ? '<h3>'.$sTitle.'</h3>':'').'
                    <div>'.$sDesc.'</div>
                </div>';

	} else if ($sType == "doc"){
		$sOutput .= '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="840" height="500" id="divdoc">
						<param name="movie" value="http://www.divshare.com/flash/document/'.$sFileId.'" />
						<embed src="http://www.divshare.com/flash/document/'.$sFileId.'" width="840" height="500" name="divdoc" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>
					</object>';
	} else if (in_array($sType, array("doc_embed", "video_embed"))){
		$sOutput .= $oQuery->sEmbedCode;
	} else if ($sType == "video_youtube"){
		$sOutput .= '<object width="340" height="285">
						<param name="movie" value="' . $oQuery->sEmbedCode . '"></param>
						<param name="allowFullScreen" value="true"></param>
						<param name="allowscriptaccess" value="always"></param>
						<embed src="' . $oQuery->sEmbedCode . '" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="340" height="285"></embed>
					</object>';

	}


    if($sType !== "image_embed"){
	$sOutput .= '</div>
				<div align="center" style="position:relative; left:39%; padding:5px; border:0px solid red; margin-top:5px; width:400px;">
					'.(($sTitle != "") ? '<h3>'.$sTitle.'</h3>':'').'
					<div>'.$sDesc.'</div>
				</div>';
    }
	return $sOutput;
}

function entertainment_file_edit($sFileType="video", $iGroupLevel){
	global $user;

	entertainment_set_site_breadcrumb($iGroupLevel);

	if ($user->uid <= 0) drupal_access_denied();

	$sBasePath = base_path();
	$sImageURL = SHRINKTHEWEB.'&stwinside=1';
	$sJavaScript = 'var entertainment_iGroupLevel = '.$iGroupLevel.';
					var entertainment_sFileType = "'.$sFileType.'";
					var entertainment_sBasePath = "'.$sBasePath.'";';

	drupal_add_js($sJavaScript, "inline");

	$sOutput = _entertainment_nav_icons($sFileType, $iGroupLevel);
	$sOutput .= entertainment_category_title($iGroupLevel);

	$sHeader = '<div id="entertainment_file_content" style="position:relative; %css% border:0" align="center">
					<form method="post" action="'.$sBasePath.'entertainment/file/edit/submit">
						<input type="hidden" name="iGroupLevel" value="'.$iGroupLevel.'" />
						<input type="hidden" name="sFileType" value="'.$sFileType.'" />
						<table style="width:100%;"><tr>';
	$sFooter = '</table></form></div>';
	$sBasePath = base_path();
	$iResultCount = 0;

	$sTextDisplay = '<input type="hidden" name="aFileId[]" value="%id%" />
					<input type="hidden" name="aFileTitle_orig[]" value="%title%" />
					<input type="hidden" name="aFileDesc_orig[]" value="%desc%" />
					<input type="hidden" name="aFileTags_orig[]" value="%tags%" />
					<div><input type="text" id="sFileTitle_%id%" name="aFileTitle[]" value="%title%" maxlength="50" style="width:400px;" /></div>
					<div><textarea name="aFileDesc[]" style="width:400px;">%desc%</textarea></div>
					<div><input type="text" id="sFileTags_%id%" name="aFileTags[]" value="%tags%" style="width:400px;" /></div>
					<button type="button" id="btnDelFile_%id%" name="btnDelFile" value="%id%">Delete this File</button>';

	if ($sFileType == "video"){
		$sThisType = ucfirst($sFileType);
		$sDisplayCode = '<div style="margin-left:15px; margin-top:15px;">
							<object id="%s%" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,18,0" width="400" height="353">
								<param name="movie" value="http://www.divshare.com/flash/video?myId=%s%" />
								<param name="allowFullScreen" value="true" />
								<embed wmode="opaque" id="%s%" src="http://www.divshare.com/flash/video?myId=%s%" width="400" height="353" name="divflv" allowfullscreen="true" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>
							</object>
							'.$sTextDisplay.'
						</div>';
	}

	if ($sFileType == "image"){
		$sThisType = "Picture";
		$sDisplayCode = '<div align="center" style="margin-left:10px; margin-top:10px; padding:2px; width:100px; height:100px; border:1px solid #C0C0C0;">
							<img id="%s%" class="thumbnail" src="http://www.divshare.com/img/thumb/%s%" />
						</div>
						<div style="margin-left:10px; margin-top:2px; padding:2px; width:100px;">
							'.$sTextDisplay.'
						</div>';
	}

	if ($sFileType == "doc"){
		$sThisType = "Article";
		$sDisplayCode = '<div align="center" style="margin-left:10px; margin-top:10px; padding:2px; width:150px; border:1px solid #C0C0C0;">
							<img src="'.$sBasePath.'misc/file_doc.png" />
						</div>
						<div style="margin-left:10px; margin-top:2px; padding:2px; width:150px;">
							'.$sTextDisplay.'
						</div>';
	}

	$sqlQuery = "SELECT id, sFileType, sFileId, sEmbedCode, iGroupLevel, sTitle, sDesc, sTags
				FROM mystudyrecord_file
				WHERE sFileType IN ('%s', '%s', '%s')
					AND iGroupLevel = %d";

	$oQueryResult = db_query($sqlQuery, array($sFileType, $sFileType."_embed", $sFileType."_ext", $iGroupLevel));

	while ($oQuery = db_fetch_object($oQueryResult)){
		$iResultCount++;

		$aFindThese = array("%id%", "%s%", "%title%", "%desc%", "%tags%");
		$aReplaceThese = array($oQuery->id, $oQuery->sFileId, $oQuery->sTitle, $oQuery->sDesc, $oQuery->sTags);

		switch ($sFileType){
			case "video":
				$iCountPerCol = 2;
				$sWidth = "50%";
				$sCSS = "";

				if ($oQuery->sFileType == $sFileType){
					$sData = str_replace($aFindThese, $aReplaceThese, $sDisplayCode);
				}elseif ($oQuery->sFileType == "video_embed"){
					$sData = '<div style="margin-left:15px; margin-top:15px;">'.str_replace('<embed', '<embed wmode="opaque"', $oQuery->sEmbedCode).str_replace($aFindThese, $aReplaceThese, $sTextDisplay);
				}else{
					$sData = '<div style="margin-left:15px; margin-top:15px;"><img src="'.$sImageURL.'&xmax=400&ymax=353&stwUrl='.$oQuery->sEmbedCode.'" /></a>'.str_replace($aFindThese, $aReplaceThese, $sTextDisplay);
				}

				break;
			case "image":
				$iCountPerCol = 6;
				$sWidth = "16%";
				$sCSS = "left:15%;";

				$aFindThese[] = "width:400px";
				$aReplaceThese[] = "width:100px";

				if ($oQuery->sFileType == $sFileType){
					$sData = str_replace($aFindThese, $aReplaceThese, $sDisplayCode);
				}else{
					$sEmbedCode = $oQuery->sEmbedCode;

					if ($oQuery->sFileType == "image_ext"){
						$sEmbedCode = '<img class="thumbnail" src="'.$sImageURL.'&xmax=100&ymax=100&stwUrl='.$sEmbedCode.'" />';
					}else{
						$sEmbedCode = str_replace('<img ', '<img class="thumbnail" ', $sEmbedCode);
					}

					$sData = '<div align="center" style="margin-left:10px; margin-top:10px; padding:2px; width:100px; height:100px; border:1px solid #C0C0C0;">'.$sEmbedCode.'</div><div style="margin-left:10px; margin-top:2px; padding:2px; width:100px;">'.str_replace($aFindThese, $aReplaceThese, $sTextDisplay).'</div>';
				}

				break;
			case "doc":
				$iCountPerCol = 4;
				$sWidth = "25%";
				$sCSS = "left:15%;";

				$aFindThese[] = "width:400px";
				$aReplaceThese[] = "width:150px";

				$sData = str_replace($aFindThese, $aReplaceThese, $sDisplayCode);

				break;
		}

		$sOutput .= ($iResultCount == 1) ? str_replace("%css%", $sCSS, $sHeader):"";
		$sOutput .= '<td style="width:'.$sWidth.';">'.$sData.'</td>';
		$sOutput .= ($iResultCount % $iCountPerCol != 0) ? "":"</tr><tr>";
	}

	if ($iResultCount == 0){
		$sOutput .= '<div>No '.strtolower($sThisType).'(s) to display, yet.</div>';
	}else{
		$sOutput .= str_repeat('<td style="width:'.$sWidth.';"></td>', ($iCountPerCol - ($iResultCount%$iCountPerCol)));
		$sOutput = $sOutput.'<tr><td colspan="'.$iCountPerCol.'" style="text-align:right; padding-top:15px;"><button type="submit" class="form-submit">Suggest Changes</button></td></tr>'.$sFooter;
	}

	$sOutput .= '<div id="entertainment_DeleteComment" style="display:none; width:300px; border: 5px solid #173102; padding:5px; background-color:#E2E2D3;">
						<form action="'.$sBasePath.'entertainment/file/edit/del" method="post" onsubmit="return ValidateSiteDelForm();">
							<input type="hidden" id="sType" name="sType" value="" />
							<input type="hidden" id="iRecId" name="iRecId" value="" />
							<input type="hidden" id="iGroupLevel" name="iGroupLevel" value="'.$iGroupLevel.'" />
							<input type="hidden" id="sFileType" name="sFileType" value="'.$sFileType.'" />

							<div id="sDeleteTitle" style="text-decoration:underline; font-weight:bold; padding-bottom:5px;"></div>
							Reason for suggesting this File for deletion:<br />
							<textarea id="sDeleteComment" name="sDeleteComment" style="width:300px; height:100px;"></textarea><br />
							<div align="right" style="padding-top:5px;">
								<button id="btnDeleteCancel" type="button" name="btnDeleteCancel" class="form-submit"">Cancel</button>
								<button id="btnDelete" type="submit" name="btnDelete" class="form-submit"">Suggest for Deletion</button>
							</div>
						</form>
					</div>';

	return $sOutput;
}

function entertainment_file_edit_submit(){
	global $user;
	$bProcessed = false;

	foreach ($_REQUEST as $sKey => $sData) {
		${$sKey} = $sData;
	}

	entertainment_set_site_breadcrumb($iGroupLevel);
	drupal_add_js('setTimeout("location=\''.base_path().'entertainment/file/'.$sFileType.'/'.$iGroupLevel.'\'", 5000)', "inline");

	for ($x=0; $x<count($aFileId); $x++){
		$sFileTitle = trim($aFileTitle[$x]);
		$sFileDesc = trim($aFileDesc[$x]);
		$sFileTags = preg_replace('/\s\s+/', " ", str_replace(", ", ",", $aFileTags[$x]));

		if ($sFileTitle == trim($aFileTitle_orig[$x]) && $sFileDesc == trim($aFileDesc_orig[$x]) && $sFileTags == trim($aFileTags_orig[$x])){
			continue;
		}else{
			$bProcessed = true;
			$sqlInsert = "INSERT INTO {mystudyrecord_suggested_file}
							SET iUserId = %d,
								sFileType = NULL,
								iRefId = %d,
								sTitle = '%s',
								sDesc = '%s',
								sTags = '%s'";

			db_query($sqlInsert, array($user->uid, $aFileId[$x], $sFileTitle, $sFileDesc, $sFileTags));
		}
	}

	// Point System for Suggestion - Submit
	userpoints_userpointsapi(array("tid" => 195));

	$sMessage = ($bProcessed) ? "Suggested file changes has been successfully submitted.":"No suggestion(s) have been made.";
	drupal_set_message($sMessage);

	return "";
}

function entertainment_site_view($group_level=0) {
	global $user;

	$sJavaScript = 'var entertainment_iGroupLevel = '.$group_level.';
					var entertainment_sBasePath = "'.base_path().'";';

	drupal_add_js($sJavaScript, "inline");

	$page_content = _entertainment_nav_icons("site", $group_level);
	$page_content .= entertainment_category_title($group_level);
	$page_content .= _entertainment_site($group_level);

	if ($user->uid > 0){
		$page_content .= '<br />
						<button id="entertainment_edit_mode_url" class="form-submit" style="display:none;">Edit Mode</button>
						<div id="entertainment_edit_mode_url_notice" style="display:none; width:230px; text-align:center; background-color:#FFFFFF; padding:10px; border: 5px solid #C0C0C0;">
							<div style="width:100%; background-color:#C0C0C0;"><b>Edit Mode</b></div>
							<h3>What do you want to do?</h3><br />
							<button id="entertainment_edit_mode_url_notice_amend" type="button" class="form-submit" style="width:220px;">Amend the existing Sites</button><br />
							<button id="entertainment_edit_mode_url_notice_add" type="button" class="form-submit" style="width:220px; margin-top:10px;">Add a Site</button>
							<button id="entertainment_edit_mode_url_notice_cancel" type="button" class="form-submit" style="width:220px; margin-top:10px;">Cancel</button>
						</div>';
	}

	return $page_content;
}

function entertainment_site_animation($iGroupLevel=0) {
	global $user;

	$sJavaScript = 'var entertainment_iGroupLevel = '.$iGroupLevel.';
					var entertainment_sBasePath = "'.base_path().'";';

	drupal_add_js($sJavaScript, "inline");

	$page_content = _entertainment_nav_icons("animation", $iGroupLevel);
	$page_content .= entertainment_category_title($iGroupLevel);
	$page_content .= _entertainment_site($iGroupLevel, "animation");

	if ($user->uid > 0){
		$page_content .= '<br />
						<button id="entertainment_edit_mode_url_animation" class="form-submit" style="display:none;">Edit Mode</button>
						<div id="entertainment_edit_mode_url_animation_notice" style="display:none; width:230px; text-align:center; background-color:#FFFFFF; padding:10px; border: 5px solid #C0C0C0;">
							<div style="width:100%; background-color:#C0C0C0;"><b>Edit Mode</b></div>
							<h3>What do you want to do?</h3><br />
							<button id="entertainment_edit_mode_url_animation_notice_amend" type="button" class="form-submit" style="width:220px;">Amend the existing Sites</button><br />
							<button id="entertainment_edit_mode_url_animation_notice_add" type="button" class="form-submit" style="width:220px; margin-top:10px;">Add a Site</button>
							<button id="entertainment_edit_mode_url_animation_notice_cancel" type="button" class="form-submit" style="width:220px; margin-top:10px;">Cancel</button>
						</div>';
	}

	return $page_content;
}

function entertainment_site_click(){
	foreach ($_REQUEST as $sKey => $sData) {
		${$sKey} = $sData;
	}

	if (isset($sType) && isset($iRefId)){
		$aFieldVal = array($sType, $iRefId);

		$sqlCheck = "SELECT COUNT(id) AS iCount
					FROM {mystudyrecord_favorite}
					WHERE sType = '%s'
						AND iRefId = %d";

		$iRecCount = db_result(db_query($sqlCheck, $aFieldVal));

		if ($iRecCount == 1){
			$sqlToExecute = "UPDATE {mystudyrecord_favorite}
							SET iVisitCount = iVisitCount + 1
							WHERE sType = '%s'
								AND iRefId = %d";
		}else{
			$sqlToExecute = "INSERT INTO {mystudyrecord_favorite}
							VALUES(NULL, '%s', %d, 1)";
		}

		db_query($sqlToExecute, $aFieldVal);

		echo json_encode(array("STATUS" => "Success"));
	}else{
		echo json_encode(array("STATUS" => "Error", "ERRMSG" => "Site Statistics: Incomplete post variables."));
	}

	exit;
}

function entertainment_site_edit($group_level=0, $sSiteType="site") {
	global $user;

	if ($user->uid <= 0) drupal_access_denied();

	$page_content = entertainment_category_title($group_level);
	$page_content .= _entertainment_site($group_level, $sSiteType, true);

	return $page_content;
}

function entertainment_site_edit_submit(){
	global $user;
	$bProcessed = false;

	foreach ($_REQUEST as $sKey => $sData) {
		${$sKey} = $sData;
	}

	entertainment_set_site_breadcrumb($group_level);
	drupal_add_js('setTimeout("location=\''.base_path().'entertainment/url/'.$group_level.'\'", 5000)', "inline");

	for ($i=0; $i<count($aSiteTitle_orig); $i++){
		$sSiteTitle = $aSiteTitle[$i];
		$sSiteDesc = $aSiteDesc[$i];
		$sSiteURL = $aSiteURL[$i];
		$iSiteId = $aSiteId[$i];
		$sSiteTags = preg_replace('/\s\s+/', " ", str_replace(", ", ",", $aSiteTags[$i]));

		if ($aSiteTitle_orig[$i] != $sSiteTitle || $aSiteDesc_orig[$i] != $sSiteDesc || $aSiteTags_orig[$i] != $sSiteTags){
			$bProcessed = true;
			$sqlInsert = "INSERT INTO mystudyrecord_suggested_site
							VALUES(NULL, '%s', %d, %d, %d, '%s', '%s', '%s', 2, '%s', '%s', NULL, NULL)";
			db_query($sqlInsert, array($sSiteType, $user->uid, $iSiteId, $group_level, $sSiteTitle, $sSiteURL, $sSiteDesc, date("Y-m-d H:i:s"), $sSiteTags));
		}
	}

	for ($i=0; $i<count($aOtherSiteTitle_orig); $i++){
		$sOtherSiteTitle = $aOtherSiteTitle[$i];
		$sOtherSiteDesc = $aOtherSiteDesc[$i];
		$sOtherSiteURL = $aOtherSiteURL[$i];
		$iOtherSiteId = $aOtherSiteId[$i];
		$sOtherSiteTags = preg_replace('/\s\s+/', " ", str_replace(", ", ",", $aOtherSiteTags[$i]));

		if ($aOtherSiteTitle_orig[$i] != $sOtherSiteTitle || $aOtherSiteDesc_orig[$i] != $sOtherSiteDesc || $aOtherSiteTags_orig[$i] != $sOtherSiteTags){
			$bProcessed = true;

			$sqlUpdate = "UPDATE mystudyrecord_suggested_site
							SET title = '%s',
								description = '%s',
								promoted = 0,
								sTags = '%s',
								iUserId = %d
							WHERE id = %d";
			db_query($sqlUpdate, array($sOtherSiteTitle, $sOtherSiteDesc, $iOtherSiteId, $user->uid, $sOtherSiteTags));
		}
	}

	$sMessage = ($bProcessed) ? "Suggested site changes has been successfully submitted.":"No suggestion(s) have been made.";
	drupal_set_message($sMessage);

	return "";
}

function entertainment_site_edit_add($iGroupLevel, $sSiteType="site"){
	global $user;

	if ($user->uid <= 0) drupal_access_denied();

	entertainment_set_site_breadcrumb($iGroupLevel);

	$sJavaScript = 'var entertainment_iGroupLevel = '.$iGroupLevel.';
					var entertainment_sBasePath = "'.base_path().'";';

	drupal_add_js($sJavaScript, "inline");

	$sOutput = '<form action="'.base_path().'entertainment/url/edit/add" method="post" onsubmit="return ValidateSiteForm();">
					<input type="hidden" name="iGroupLevel" value="'.$iGroupLevel.'" />
					<input type="hidden" name="sSiteType" value="'.$sSiteType.'" />

					<table>
						<tr>
							<td style="width:100px; padding-bottom:10px;">URL</td>
							<td><input type="text" id="sSiteURL" name="sSiteURL" value="http://" style="width:400px;" /></td>
						</tr>
						<tr>
							<td style="width:100px; padding-bottom:10px;">Tags</td>
							<td style="padding-bottom:10px;">
								<input type="text" id="sTags" name="sTags" value="" style="width:400px;" /><br/>
								<small>Searate tags with a comma (eg. space,shuttle,service).</small>
							</td>
						</tr>
						<tr>
							<td style="padding-bottom:10px;">Title</td>
							<td><input type="text" id="sSiteTitle" name="sSiteTitle" style="width:400px;" /></td>
						</tr>
						<tr>
							<td>Description</td>
							<td><textarea id="sSiteDesc" name="sSiteDesc" style="width:400px; height:100px;"></textarea></td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:right; padding-top:12px;">
								<button id="btnSuggestCancel" type="button" name="btnSuggestCancel" class="form-submit"">Cancel</button>
								<button type="submit" id="btnSuggest" name="btnSuggest" class="form-submit">Suggest this Site</button>
							</td>
						</tr>
					</table>
				</form>';

	return $sOutput;
}

function entertainment_site_edit_add_submit(){
	global $user;
	//dump_this($_REQUEST);
	foreach ($_REQUEST as $sKey => $sData) {
		${$sKey} = $sData;
	}

	entertainment_set_site_breadcrumb($iGroupLevel);
	drupal_add_js('setTimeout("location=\''.base_path().'entertainment/url'.(($sSiteType == "animation") ? '/animation':'').'/'.$iGroupLevel.'\'", 5000)', "inline");

	$sTags = preg_replace('/\s\s+/', " ", str_replace(", ", ",", $sTags));
	$sqlInsert = "INSERT INTO mystudyrecord_suggested_site
					VALUES(NULL, '%s', %d, 0, %d, '%s', '%s', '%s', 0, '%s', '%s', NULL, NULL, 'other', '%s')";
	db_query($sqlInsert, array($sSiteType, $user->uid, $iGroupLevel, $sSiteTitle, $sSiteURL, $sSiteDesc, date("Y-m-d H:i:s"), $sTags, $sAgeGroup));
	db_query("UPDATE mystudies_volunteer SET iApprovedCount = IFNULL(iApprovedCount,0) + 1 WHERE uid = '" . $user->uid . "' AND type = 'guide'");

	$iRefId = db_last_insert_id("mystudyrecord_suggested_site", "id");
	$iItemId = $iRefId;

	_entertainment_volunteer_changelog("guide", $iRefId, $iItemId, "site", 1, 1, 1, 1, 1, "other");

	$sqlRating = "UPDATE rating_vote SET iContentId = %d WHERE id = %d";
	db_query($sqlRating, array($iRefId, $rating_iRatingId));

	// Point System for Suggestion - Submit
	userpoints_userpointsapi(array("tid" => 195));

	if (isset($sRedirectTo)){
		header("Location: ".$sRedirectTo);
	}else{
		drupal_set_message("Suggested site has been successfully submitted.");
	}

	return "";
}

function entertainment_approval($sType="subject"){
	$iRecordCount = 0;
	$sSubjActive = ($sType == "subject") ? "active":"";
	$sTitleActive = ($sType == "title") ? "active":"";
	$sIconActive = ($sType == "icon") ? "active":"";
	$sSiteActive = ($sType == "site") ? "active":"";
	$sDescActive = ($sType == "description") ? "active":"";
	$sDelActive = ($sType == "delete") ? "active":"";
	$sFileActive = ($sType == "file") ? "active":"";
	$sFileDescActive = ($sType == "filedesc") ? "active":"";
	$sFileDelActive = ($sType == "filedel") ? "active":"";

	$sOutput = '<div id="tabs-wrapper" class="clear-block">
					<ul class="tabs primary">
						<ul class="tabs primary">
							<li class="'.$sSubjActive.'"><span><span><a href="subject" class="'.$sSubjActive.'">Subject</a></span></span></li>
							<li class="'.$sTitleActive.'"><span><span><a href="title" class="'.$sTitleActive.'">Title</a></span></span></li>
							<li class="'.$sIconActive.'"><span><span><a href="icon" class="'.$sIconActive.'">Icon</a></span></span></li>
							<li class="'.$sDescActive.'" style="margin-right:10px;"><span><span><a href="description" class="'.$sDescActive.'">Description</a></span></span></li>
							<li class="'.$sSiteActive.'"><span><span><a href="site" class="'.$sSiteActive.'">Site</a></span></span></li>
							<li class="'.$sDelActive.'" style="margin-right:10px;"><span><span><a href="delete" class="'.$sDelActive.'">Delete</a></span></span></li>

						</ul>
					</ul>
				</div>

				<div id="tabs-wrapper" class="clear-block" style="padding-top:5px;">
					<ul class="tabs primary">
						<ul class="tabs primary">
							<li class="'.$sFileActive.'"><span><span><a href="file" class="'.$sFileActive.'">Files</a></span></span></li>
							<li class="'.$sFileDescActive.'"><span><span><a href="filedesc" class="'.$sFileDescActive.'">Details</a></span></span></li>
							<li class="'.$sFileDelActive.'"><span><span><a href="filedel" class="'.$sFileDelActive.'">Delete</a></span></span></li>
						</ul>
					</ul>
				</div>';

	if ($sType == "subject"){
		$sqlQuery = "SELECT A.id, A.iGroupLevel, A.sSubject, A.sIcon, A.sDescription AS sDescription_orig, B.name
					FROM mystudyrecord_suggested_subj A";
	}elseif ($sType == "title"){
		$sqlQuery = "SELECT A.id, A.iUserId, A.fid AS iGroupLevel, A.title AS sSubject, B.name,
						C.title AS sSubject_orig,
						IF(C.desc IS NULL, 'No description avaiable.', C.desc) AS sDescription_orig
					FROM mystudyrecord_suggested_title A
					INNER JOIN mystudyrecord C ON C.id = A.fid";
	}elseif ($sType == "icon"){
		$sqlQuery = "SELECT A.id, A.fid AS iGroupLevel, A.icon, B.name, UPPER(C.title) AS sSubject,
						IF(C.desc IS NULL, 'No description avaiable.', C.desc) AS sDescription
					FROM mystudyrecord_suggested_icon A
					INNER JOIN mystudyrecord C ON C.id = A.fid";
	}elseif ($sType == "site"){
		$sqlQuery = "SELECT A.id, A.sSiteType, A.group_level AS iGroupLevel, A.title AS sSubject, A.url,
						A.promoted, B.name, C.title AS sSubject_orig,
						IF(A.description IS NULL, 'No description avaiable.', A.description) AS sDescription,
						IF(C.description IS NULL, 'No description avaiable.', C.description) AS sDescription_orig
					FROM mystudyrecord_suggested_site A
					LEFT JOIN mystudyrecord_site C ON C.id = A.fid";
	}elseif ($sType == "description"){
		$sqlQuery = "SELECT A.id, A.iUserId, A.fid AS iGroupLevel, A.desc AS sDescription, B.name,
						IF(C.desc IS NULL, 'No description avaiable.', C.desc) AS sDescription_orig,
						C.title AS sSubject
					FROM mystudyrecord_suggested_desc A
					INNER JOIN mystudyrecord C ON C.id = A.fid";
	}elseif ($sType == "delete" || $sType == "filedel"){
		$sqlQuery = "SELECT A.id, A.iUserId, A.iGroupLevel, A.sType, A.iRefId, A.sComment, B.name
					FROM mystudyrecord_suggested_delete A";
	}elseif ($sType == "file"){
		$sqlQuery = "SELECT A.id, A.iUserId, A.sFileType, A.sFileId, A.sEmbedCode, A.iGroupLevel,
						A.sTitle AS sSubject_orig, A.sDesc AS sDescription_orig, B.name, A.sTags AS sTags_orig
					FROM mystudyrecord_suggested_file A";
	}elseif ($sType == "filedesc"){
		$sqlQuery = "SELECT A.id, A.iUserId, C.sFileType, C.sFileId, C.sEmbedCode, C.iGroupLevel,
						A.sTitle AS sSubject_new, C.sTitle AS sSubject_orig, A.sDesc AS sDescription,
						IF(C.sTitle IS NULL OR C.sTitle = '', 'No Title Specified', C.sTitle) AS sSubject,
						C.sDesc AS sDescription_orig, B.name, A.sTags, C.sTags AS sTags_orig
					FROM mystudyrecord_suggested_file A
					INNER JOIN mystudyrecord_file C ON C.id = A.iRefId";
	}

	switch ($sType){
		case "site":
		case "file":
		case "filedesc":
			$sqlQueryInner = " INNER JOIN users B ON B.uid = A.iEditorId";

			break;
		default:
			$sqlQueryInner = " INNER JOIN users B ON B.uid = A.iUserId";
	}

	$sqlQuery .= $sqlQueryInner;

	if (!in_array($sType, array("delete", "file", "filedel"))){
		$sqlSub = ($sType == "site") ? "A.promoted, ":"";
		$sqlQuery .= ($sType == "site") ? " WHERE A.promoted != 1":"";
		$sqlQuery .= ($sType == "delete") ? " WHERE A.sType != 'file'":"";
		$sqlQuery .= " ORDER BY B.name, ".$sqlSub."sSubject";
	}else{
		$sqlQuery .= ($sType == "file") ? " WHERE A.sFileType IS NOT NULL AND A.iRefId IS NULL":"";
		$sqlQuery .= ($sType == "filedel") ? " WHERE A.sType = 'file'":"";
		$sqlQuery .= ($sType == "delete") ? " WHERE A.sType LIKE 'site%'":"";

		$sqlQuery .= " ORDER BY B.name";
	}

	//dump_this($sqlQuery);

	$oQueryResult = db_query($sqlQuery);

	$sTableHeader = '<form action="'.base_path().'admin/content/entertainment/'.$sType.'/process" method="post">
					<table border="0" style="width:100%;">';
	$sTableFooter = '</form></table>';
	$sPrevName = "";
	$sNewType = ($sType == "delete") ? "Site Deletion":$sType;
	$sNewType = ($sType == "filedel") ? "File Deletion":$sType;

	while ($oQuery = db_fetch_object($oQueryResult)){
		$iRecordCount++;
		$iId = $oQuery->id;
		$sSubject = stripslashes(@$oQuery->sSubject);

		if ($sPrevName != $oQuery->name){
			if ($sPrevName != ""){
				$sOutput .= '<tr>
								<td colspan="3" style="padding-top:5px;">
									<button type="submit" name="btnApprove" value="approve" class="form-submit">Approve</button>&nbsp;
									<button type="submit" name="btnDisapprove" value="disapprove" class="form-submit">Disapprove</button>
								</td>
							</tr>';
			}

			$sOutput .= '<tr><td colspan="3" style="padding-top:15px;"><h3>'.ucfirst($sNewType).' was submitted for approval by: <em>'.$oQuery->name.'</em></h3></td></tr>';
		}

		if ($sType != "site"){
			if ($sType == "subject"){
				$sHTML = '<img src="'.base_path().'entertainment/image/'.$sType.'/'.$iId.'" width="194" alt="'.$sSubject.'" />';
			}elseif ($sType == "title"){
				$sHTML = '<table style="width:100%;">
								<tr>
									<th style="width:50%;">Suggestion</th>
									<th style="width:50%;">Original</th>
								</tr>
								<tr>
									<td>'.$sSubject.'</td>
									<td>'.$oQuery->sSubject_orig.'</td>
								</tr>
							</table>';
			}elseif ($sType == "icon"){
				$sHTML = '<table style="width:100%;">
								<tr>
									<td style="text-align:center;">Suggestion</td>
									<td style="text-align:center;">Original</td>
								</tr>
								<tr>
									<td style="text-align:center;"><img src="'.base_path().'entertainment/image/'.$sType.'/'.$iId.'" width="94" alt="'.$sSubject.'" /></td>
									<td style="text-align:center;"><img src="'.base_path().'entertainment/image/main/'.$oQuery->iGroupLevel.'" width="94" alt="'.$sSubject.'" /></td>
								</tr>
							</table>';
			}elseif ($sType == "description"){
				$sHTML = '<table style="width:100%;">
								<tr>
									<td>Suggested</td>
								</tr>
								<tr>
									<td>'.$oQuery->sDescription.'</td>
								</tr>
							</table>';
			}elseif ($sType == "file"){
				$sFileHref = (substr($oQuery->sFileType, -4) == "_ext") ? $oQuery->sEmbedCode:base_path().'entertainment/file/'.(str_replace("_embed", "", $oQuery->sFileType)).'/'.$oQuery->iGroupLevel.'/view/'.$oQuery->id.'/admin';
				$sSubject = '<a id="entertainment_file_tooltip_'.$oQuery->sFileId.'" href="'.$sFileHref.'" target="_blank" title="Click to view the file in a new tab/window.">'.$oQuery->sSubject_orig.'</a>';
				$sHTML = '<table style="width:100%;">
								<tr>
									<td>
										File Type: '.$oQuery->sFileType.'<br/>
										'.$sSubject.'
									</td>
								</tr>
							</table>';
			}elseif ($sType == "filedesc"){
				$sHTML = '<table style="width:100%;">
								<tr>
									<th>Suggestion ('.$oQuery->sFileType.')</th>
								</tr>
								<tr>
									<td style="padding-top:5px;">
										<p style="padding-bottom:5px;">11Category: '._entertainment_get_full_cat($oQuery->iGroupLevel).'</p>
										<u>'.$oQuery->sSubject_new.'</u><br />
										Tags: '.$oQuery->sTags.'<br /><br />
										'.$oQuery->sDescription.'
									</td>
								</tr>
							</table>';
			}

			if (!in_array($sType, array("delete", "filedel"))){
				$sOutput .= '<tr>
								<td style="padding-top:3px;"><input type="checkbox" name="id[]" value="'.$iId.'" /></td>
								<td style="width:290px; padding:3px;">'.$sHTML.'</td>
								<td style="padding:23px 5px 5px 5px;">
									<p style="padding-bottom:5px;">12Category: '._entertainment_get_full_cat($oQuery->iGroupLevel).'</p>
									<u>'.$oQuery->sSubject_orig.'</u><br />
									Tags: '.$oQuery->sTags_orig.'<br /><br />
									'.$oQuery->sDescription_orig.'
								</td>
							</tr>';
			}else{
				$iRefId = $oQuery->iRefId;

				if ($sType == "delete"){
					$sRefTable = ($oQuery->sType == "site_rec") ? "mystudyrecord_site":"mystudyrecord_suggested_site";
					$sqlQuerySub = "SELECT title AS sTitle, description AS sDesc, url FROM %s WHERE id = %d";
					$oQuerySubResult = db_query($sqlQuerySub, $sRefTable, $iRefId);
				}else{
					$sqlQuerySub = "SELECT id, sFileType, sFileId, sEmbedCode, iGroupLevel, sTitle, sDesc FROM {mystudyrecord_file} WHERE id = %d";
					$oQuerySubResult = db_query($sqlQuerySub, $iRefId);
				}

				while ($oQuerySub = db_fetch_object($oQuerySubResult)){
					$sHRef = ($sType == "delete") ? base_path().'entertainment/file/'.(str_replace("_embed", "", $oQuerySub->sFileType)).'/'.$oQuerySub->iGroupLevel.'/view/'.$oQuerySub->id:$oQuerySub->sEmbedCode;
					$sTitle	= '<u><a id="entertainment_file_tooltip_'.$oQuerySub->sFileId.'" href="'.$sHRef.'" target="_blank" title="Click to view the file in a new tab/window.">'.$oQuerySub->sTitle.'</a>';
					$sTitle	.= ($sType == "delete") ? "</u>":"</u> <em>(".$oQuerySub->sFileType.")</em>";
					$sOutput .= '<tr>
									<td style="padding-top:3px;"><input type="checkbox" name="id[]" value="'.$iId.'" /></td>
									<td style="padding:3px;">
										<p style="padding-bottom:5px;">13Category: '._entertainment_get_full_cat($oQuery->iGroupLevel).'</p>
										'.$sTitle.'<br />
										'.$oQuerySub->sDesc.'
									</td>
									<td style="padding:3px; width:300px;">
										<b>Reason for suggesting:</b>
										<p>'.$oQuery->sComment.'</p>
									</td>
								</tr>';
				}
			}
		}else{
			if ($oQuery->promoted == 2){
				$sHTML = '<div style="padding-bottom:5px;">Title: '.stripslashes($oQuery->sSubject_orig).'</div>
							<div>'.stripslashes($oQuery->sDescription_orig).'</div>';
			}else{
				$sHTML = 'Not applicable.';
			}

			$sImageURL = SHRINKTHEWEB.'&stwxmax=144&stwymax=108&stwinside=1&stwurl='.$oQuery->url;
			$sOutput .= '<tr>
							<td style="padding-top:3px;"><input type="checkbox" name="id[]" value="'.$iId.'" /></td>
							<td style="width:150px; padding:3px 3px 10px 3px;"><a id="entertainment_file_tooltip_'.$oQuery->id.'" href="'.$oQuery->url.'" target="_blank" title="Click to view the site in a new tab/window."><img src="'.$sImageURL.'" width="144" alt="'.$sSubject.'" /></a></td>
							<td style="padding:3px 3px 10px 3px;">
								<p>Site Type: '.ucwords($oQuery->sSiteType).'</p>
								<p style="padding-bottom:5px;">14Category: '._entertainment_get_full_cat($oQuery->iGroupLevel).'</p>

								<table style="width:100%;">
									<tr>
										<th style="width:50%">Suggested</th>
										<th style="width:50%">Original</th>
									</tr>
									<tr>
										<td>
											<div style="padding-bottom:5px;">Title: <a id="entertainment_file_tooltip_'.$oQuery->id.'" href="'.$oQuery->url.'" target="_blank" title="Click to view the site in a new tab/window.">'.$sSubject.'</a></div>
											<div>'.stripslashes($oQuery->sDescription).'</div>
										</td>
										<td>'.$sHTML.'</td>
									</tr>
								</table>
							</td>
						</tr>';
		}

		$sPrevName = $oQuery->name;
	}

	if ($iRecordCount > 0){
		$sOutput .= '<tr>
						<td colspan="3" style="padding-top:5px;">
							<button type="submit" name="btnApprove" value="approve" class="form-submit">Approve</button>&nbsp;
							<button type="submit" name="btnDisapprove" value="disapprove" class="form-submit">Disapprove</button>
						</td>
					</tr>';

		if ($sType == "site"){
			$sOutput = '<tr>
							<td colspan="3" style="padding-top:5px;">
								File under:
								<select name="sSiteType">
									<option value="site_other">Other Great Site</option>
									<option value="site_rec">Recommended Site</option>
								</select>
							</td>
						</tr>'.$sOutput;
		}
	}else{
		$sOutput .= '<tr><td style="padding-top:15px;">No suggested '.$sNewType.'(s) to approve/disapprove, yet.</td></tr>';
	}

	return $sTableHeader.$sOutput.$sTableFooter;
}

function entertainment_approval_process($sType="subject"){
	drupal_add_js('setTimeout("location=\''.base_path().'admin/content/entertainment/'.$sType.'\'", 5000)', "inline");

	if (count($_REQUEST["id"]) > 0){
		if (isset($_REQUEST["btnApprove"])) $sAction = $_REQUEST["btnApprove"];
		if (isset($_REQUEST["btnDisapprove"])) $sAction = $_REQUEST["btnDisapprove"];

		$sId = implode(",", $_REQUEST["id"]);
		$sSiteType = $_REQUEST["sSiteType"];
		$sTitles = "";

		if ($sType == "subject"){
			$sqlQuery = "SELECT A.id, A.iGroupLevel, A.sSubject, A.sIcon, A.sDescription, A.sLeaf
						FROM mystudyrecord_suggested_subj A";
		}elseif ($sType == "title"){
			$sqlQuery = "SELECT A.id, A.fid, A.title AS sSubject
						FROM mystudyrecord_suggested_title A
						INNER JOIN mystudyrecord B ON B.id = A.fid";
		}elseif ($sType == "icon"){
			$sqlQuery = "SELECT A.id, A.fid, A.icon, UPPER(B.title) AS sSubject
						FROM mystudyrecord_suggested_icon A
						INNER JOIN mystudyrecord B ON B.id = A.fid";
		}elseif ($sType == "site"){
			$sqlQuery = "SELECT A.id, A.sSiteType, A.fid, A.group_level, A.title AS sSubject, A.url, A.sAgeGroup,
							A.description AS sDescription, A.promoted, A.sTags, A.iUserId, A.iEditorId, A.sSubType
						FROM mystudyrecord_suggested_site A
						LEFT JOIN mystudyrecord_site B ON B.id = A.fid";
		}elseif ($sType == "description"){
			$sqlQuery = "SELECT A.id, A.fid, A.desc AS sDescription, B.title AS sSubject
						FROM mystudyrecord_suggested_desc A
						INNER JOIN mystudyrecord B ON B.id = A.fid";
		}elseif ($sType == "delete" || $sType == "filedel"){
			$sqlQuery = "SELECT A.id, A.iUserId, A.iGroupLevel, A.sType, A.iRefId, A.sComment
						FROM mystudyrecord_suggested_delete A";
		}elseif ($sType == "file" || $sType == "filedesc"){
			$sqlQuery = "SELECT A.id, A.iUserId, A.iEditorId, A.sFileType, A.sFileId, A.sEmbedCode, A.iGroupLevel, A.sAgeGroup,
							A.iRefId, A.sTitle AS sSubject, A.sDesc, A.sTags, A.sFileGroup
						FROM mystudyrecord_suggested_file A";
		}

		$sqlQuery .= " WHERE A.id IN (%s)";
		$oQueryResult = db_query($sqlQuery, $sId);

		while ($oQuery = db_fetch_object($oQueryResult)){
			$sTitles .= ($sTitles == "") ? "":", ";
			$sTitles .= @$oQuery->sSubject;

			if ($sType == "subject"){
				if ($sAction == "approve"){
					$sqlInsert = "INSERT INTO mystudyrecord VALUES(NULL, %d, '%s', '%s', %b, '%s')";
					db_query($sqlInsert, array($oQuery->iGroupLevel, $oQuery->sSubject, $oQuery->sLeaf, $oQuery->sIcon, $oQuery->sDescription));
				}

				$sTable = "mystudyrecord_suggested_subj";
			}elseif ($sType == "title"){
				if ($sAction == "approve"){
					$sqlUpdate = "UPDATE mystudyrecord
									SET title = '%s'
									WHERE id = %d";

					db_query($sqlUpdate, array($oQuery->sSubject, $oQuery->fid));
				}

				$sTable = "mystudyrecord_suggested_title";
			}elseif ($sType == "icon"){
				if ($sAction == "approve"){
					$sqlUpdate = "UPDATE mystudyrecord
									SET icon = %b
									WHERE id = %d";

					db_query($sqlUpdate, array($oQuery->icon, $oQuery->fid));
				}

				$sTable = "mystudyrecord_suggested_icon";
			}elseif ($sType == "description"){
				if ($sAction == "approve"){
					$sqlUpdate = "UPDATE mystudyrecord
									SET mystudyrecord.desc = '%s'
									WHERE id = %d";

					db_query($sqlUpdate, array($oQuery->sDescription, $oQuery->fid));
				}

				$sTable = "mystudyrecord_suggested_desc";
			}elseif ($sType == "site"){
				if ($sAction == "approve"){
					if ($oQuery->sSubType == "rec"){
						if ($oQuery->promoted == 2){
							$sqlUpdate = "UPDATE mystudyrecord_site
											SET title = '%s',
												description = '%s',
												url = '%s',
												sTags = '%s',
												sAgeGroup = '%s',
											WHERE id = %d";

							db_query($sqlUpdate, array($oQuery->sSubject, $oQuery->sDescription, $oQuery->url, $oQuery->sTags, $oQuery->sAgeGroup, $oQuery->fid));
						}else{
							$sqlInsert = "INSERT INTO mystudyrecord_site
											VALUES(NULL, '%s', %d, '%s', '%s', '%s', '%s', %d, %d, NULL, '%s')";

							db_query($sqlInsert, array($oQuery->sSiteType, $oQuery->group_level, $oQuery->sSubject, $oQuery->url, $oQuery->sDescription, $oQuery->sTags, $oQuery->iUserId, $oQuery->iEditorId, $oQuery->sAgeGroup));
						}

						$sTable = "mystudyrecord_suggested_site";
					}else{
						if ($oQuery->promoted == 2){
							$sqlUpdate = "UPDATE mystudyrecord_suggested_site SET fid = 0, promoted = 1 WHERE id = %d";
							db_query($sqlUpdate, $oQuery->id);

							$sTable = "mystudyrecord_site";
						}else{
							$sqlUpdate = "UPDATE mystudyrecord_suggested_site SET promoted = 1 WHERE id = %d";
							db_query($sqlUpdate, $oQuery->id);

							$sTable = "";
						}
					}
				}else{
					$sTable = "mystudyrecord_suggested_site";
				}
			}elseif ($sType == "delete" || $sType == "filedel"){
				if ($sAction == "approve"){
					if ($sType == "delete"){
						$sRefTable = ($oQuery->sType == "site_rec") ? "mystudyrecord_site":"mystudyrecord_suggested_site";
						$sqlDelete = "DELETE FROM %s WHERE id = %d";

						db_query($sqlDelete, array($sRefTable, $oQuery->iRefId));
					}else{
						$sqlDelete = "DELETE FROM {mystudyrecord_file} WHERE id = %d";
						db_query($sqlDelete, $oQuery->iRefId);
					}
				}

				$sTable = "mystudyrecord_suggested_delete";
			}elseif ($sType == "file" || $sType == "filedesc"){
				if ($sAction == "approve"){
					if ($sType == "file"){
						$sqlInsert = "INSERT INTO mystudyrecord_file VALUES(NULL, '%s', '%s', '%s', %d, '%s', '%s', '%s', %d, %d, NULL, '%s','%s')";
						db_query($sqlInsert, array($oQuery->sFileType, $oQuery->sFileId, $oQuery->sEmbedCode, $oQuery->iGroupLevel, $oQuery->sSubject, $oQuery->sDesc, $oQuery->sTags, $oQuery->iUserId, $oQuery->iEditorId, $oQuery->sFileGroup, $oQuery->sAgeGroup));
					}else{
						$sqlUpdate = "UPDATE mystudyrecord_file
										SET sEmbedCode = '%s',
											iGroupLevel = %d,
											sTitle = '%s',
											sDesc = '%s',
											sTags = '%s',
											sFileGroup = '%s',
											sAgeGroup = '%s'
										WHERE id = %d";
						db_query($sqlUpdate, array($oQuery->sEmbedCode, $oQuery->iGroupLevel, $oQuery->sSubject, $oQuery->sDesc, $oQuery->sTags, $oQuery->sFileGroup, $oQuery->sAgeGroup, $oQuery->iRefId));
					}
				}

				$sTable = "mystudyrecord_suggested_file";
			}

			if ($sType == "site" && $sAction == "approve" && $oQuery->promoted == 0 && $oQuery->sSubType == "other") continue;

			$sqlDelete = "DELETE FROM %s WHERE id = %d";
			$iThisId = ($sTable == "mystudyrecord_site") ? $oQuery->fid:$oQuery->id;

			db_query($sqlDelete, array($sTable, $iThisId));
		}

		$sTitles = ($sType == "delete" || $sType == "filedel") ? '':'<em>"'.ucwords($sTitles).'"</em> ';

		if ($sType == "filedesc"){
			$sType = "file title/description(s)";
		}elseif ($sType == "delete"){
			$sType = "site(s) for deletion";
		}elseif ($sType == "filedel"){
			$sType = "file(s) for deletion";
		}else{
			$sType = $sType."(s)";
		}

		drupal_set_message("Suggested ".$sType." ".$sTitles."has been successfully ".$sAction."d.");
	}else{
		$sPrevURL = base_path().'admin/content/entertainment/'.$sType;
		drupal_set_message('No suggestion was selected. Please <a href="'.$sPrevURL.'">try again</a>.');
	}

	return "";
}

function _entertainment_get_full_cat($iGroupId){
	if ($iGroupId == 0){
		$sFullCat = "Main Subject";
	}else{
		$sqlCat = "SELECT id, group_level, title
					FROM mystudyrecord
					WHERE id = %d";

		$oCat = db_fetch_object(db_query($sqlCat, $iGroupId));
		$iGroupId = $oCat->group_level;
		$sFullCat = stripslashes($oCat->title);

		while ($iGroupId != 0){
			$oCat = db_fetch_object(db_query($sqlCat, $iGroupId));
			$iGroupId = $oCat->group_level;
			$sFullCat = stripslashes($oCat->title)." &gt; ".$sFullCat;
		}
	}

	return $sFullCat;
}

function _entertainment_get_full_ids(){

	$sFullCat = array();
		$result = db_query("SELECT id,group_level,title FROM mystudyrecord where group_level = '6'");
		while($oCat = db_fetch_object($result)) {
			if($oCat->leaf == 1){
			array_push($sFullCat, $oCat->id);
			} else{
				$result2 = db_query("SELECT id,group_level,title,leaf FROM mystudyrecord where group_level = '".$oCat->id."'");
				while($oCat2 = db_fetch_object($result2)) {
				  if($oCat2->leaf == 1){
					array_push($sFullCat, $oCat2->id);
				  } else{
					$result3 = db_query("SELECT id,group_level,title,leaf FROM mystudyrecord where group_level = '".$oCat2->id."'");
					while($oCat3 = db_fetch_object($result3)) {
						array_push($sFullCat, $oCat3->id);
					}
				  }
				}
			}
	}

	return $sFullCat;
}

function _entertainment_parent_full_cat($iGroupId){
	$eCount = 0;
	if ($iGroupId == 0){
		$sFullCat = "Main Subject";
	}else{
		$sqlCat = "SELECT id, group_level, title
					FROM mystudyrecord
					WHERE id = %d";

		$oCat = db_fetch_object(db_query($sqlCat, $iGroupId));
		$iGroupId = $oCat->group_level;
		$sFullCat = stripslashes($oCat->title);

		while ($iGroupId != 0){
			$oCat = db_fetch_object(db_query($sqlCat, $iGroupId));
			$iGroupId = $oCat->group_level;
			$sFullCat = stripslashes($oCat->title)." &gt; ".$sFullCat;
			if($oCat->id == 6){
			$eCount = 1;
			}
		}
	}

	return $eCount;
}

function entertainment_show_image($sType="subject", $iSubjId){
	if ($sType == "subject"){
		$sqlField = "sIcon";
		$sqlTable = "mystudyrecord_suggested_subj";
	}elseif ($sType == "main"){
		$sqlField = "icon";
		$sqlTable = "mystudyrecord";
	}elseif ($sType == "icon"){
		$sqlField = "icon";
		$sqlTable = "mystudyrecord_suggested_icon";
	}

	$sqlIcon = "SELECT %s FROM {%s} WHERE id = %d";
	$sIconData = db_result(db_query($sqlIcon, array($sqlField, $sqlTable, $iSubjId)));

	header("Content-type: image");
	exit($sIconData);
}


function entertainment_set_cat_breadcrumb($group_level, $aTrail = array()) {
  	$id = $group_level;
	while ($id > 0) {
      //$id = $_GET['id'];
      $query = "SELECT * FROM {mystudyrecord} where id = %d";
      $queryResult = db_query($query, $id);
      $rec = db_fetch_object($queryResult);
      $aTrail[] =  l($rec->title, "entertainment/".$id);
      $id = $rec->group_level;
	}

	$aTrail[] =  l("My Studies", "entertainment");
	$aTrail[] =  l("Children's Portal", "node/20");
	$aTrail[] =  l("Home", "<front>");
	drupal_set_breadcrumb(array_reverse($aTrail));
}

function entertainment_set_site_breadcrumb($group_level, $aTrail = array()) {
  $id = $group_level;

  $query = "SELECT * FROM {mystudyrecord} where id = %d";
  $queryResult = db_query($query, $id);
  $rec = db_fetch_object($queryResult);
  $aTrail[] =  l($rec->title, "entertainment/url/".$id);
  $id = $rec->group_level;

  entertainment_set_cat_breadcrumb($id, $aTrail);
}

function entertainment_category_title($id, $bHTML=true) {
  $query = "SELECT * FROM {mystudyrecord} where id = %d";
  $queryResult = db_query($query, $id);
  $rec = db_fetch_object($queryResult);
  return ($bHTML) ? '<h3>' . $rec->title . '</h3>':$rec->title;
}

function load_etemplate($sPage) {
	ob_start();
	include drupal_get_path('module', 'entertainment') . '/templates/' . $sPage . '.tpl.php';
	$sOutput = ob_get_contents();
	ob_end_clean();
	return $sOutput;
}

function entertainment_search($sTxt, $iPage) {
	$sTxt = $_POST["sTxt"];

	$result = db_query("SELECT id,group_level,title FROM mystudyrecord");
	while($row = db_fetch_object($result)) {
		$aCategs[$row->id] = array(
								'group' => $row->group_level,
								'title' => ucwords(strtolower($row->title))
							);
	}

	$qry = "SELECT 'S',id,sSiteType AS type,title,description,url,group_level,'' AS sFileId
			FROM mystudyrecord_site
				WHERE url LIKE '%s'
			UNION
			SELECT 'F',id,sFileType AS type,sTitle AS title,sDesc AS description,sEmbedCode AS url,iGroupLevel AS group_level,sFileId
				FROM mystudyrecord_file
				WHERE sEmbedCode LIKE '%s'
			UNION
			SELECT 'SS',id,sSiteType AS type,title,description,url,group_level,'' AS sFileId
				FROM mystudyrecord_suggested_site
				WHERE promoted = 1
				AND url LIKE '%s'
			UNION
			SELECT 'SF',id,sFileType AS type, sTitle AS title,sDesc AS description,sEmbedCode AS url,iGroupLevel AS group_level,sFileId
				FROM mystudyrecord_suggested_file
				WHERE IFNULL(iAdminId,0) <> 0
				AND sEmbedCode LIKE '%s'";

	$iCtr = 0;
	$iItemPerPage = 10;
	$sQryTxt = "%" . urldecode($sTxt) . "%";
	$queryResult = db_query($qry,$sQryTxt,$sQryTxt,$sQryTxt,$sQryTxt);
	$iRowCount = db_affected_rows($queryResult);
	$iPageCount = ceil($iRowCount / $iItemPerPage);
	$sBasePath = base_path();

	ob_clean();
	if ($iRowCount == 0) {
		echo '<div style="text-align:center;color:#000"><br /><br />Your query does not match any content<br /><br /></div>';
	} else {
		echo '<div style="color:#6699ff;margin-left:20px;"><strong>' . $sTxt . '</strong> returned <strong>' . $iRowCount . '</strong> matches.</div>';
		echo '<ul class="search">';
		while($row = db_fetch_object($queryResult)) {
			$iCtr ++;
			if ($iCtr <= (($iPage-1) * $iItemPerPage))
				continue;
			else if ($iCtr > ($iPage - 1) * $iItemPerPage + $iItemPerPage)
				break;
			$aType = explode("_",$row->type);

			if ($row->type == "site" || $row->type == "animation" || $row->type == "doc_ext" || $row->type == "image_ext" || $row->type == "video_ext") {
				$sLink = $row->url;
			} else if ($row->type == "doc" || $row->type == "image" || $row->type == "doc_embed" || $row->type == "video_embed" || $row->type == "video_youtube") {
				$sLink = $sBasePath.'entertainment/file/image/'.$row->group_level.'/view/'.$row->id;
			} else if ($row->type == "video") {
				$sLink = "http://www.divshare.com/flash/video?myId=" .$row->sFileId;
			} else if ($row->type == "image_embed") {
				$sLink = _entertainment_get_attr("src", $row->url);
			} else {
				$sLink = "#";
			}
			$iGroup = "";
			$iGroupLevel = $row->group_level;
			while ($iGroupLevel != 0 && !empty($aCategs[$iGroupLevel])) {
				$iGroup = $aCategs[$iGroupLevel]["title"] . " > " . $iGroup;
				$iGroupLevel = $aCategs[$iGroupLevel]["group"];
			}

			echo '<li>
					<a href="'. $sLink . '" target="_blank">' . ($row->title == "" ? "Not title available" : $row->title) . '</a>
					<em>[' . $aType[0] . ']</em> - ' .
					substr($row->description,0,300) . '...<br />
					<span class="search_group">' . substr($iGroup,0,-3) . '</span>
				  </li>';
		}
		echo '</ul><div class="pager">';

		if ($iPage > 1)  {
			echo '<a href="javascript:void(0)" onclick="searchContent('.($iPage-1).')">&lt;prev</a>';
		}

		$ctr = ($iPage > 10 ? $iPage - 9 : 1);
		for($ctr2=0;$ctr2<10 && $ctr<=$iPageCount;$ctr++,$ctr2++) {
			if ($ctr == $iPage)
				echo ' <strong>' . $ctr . '</strong>';
			else
				echo ' <a href="javascript:void(0)" onclick="searchContent('. $ctr .')">' . $ctr . '</a>';
		}

		if ($iPage < $iPageCount) {
			echo ' <a href="javascript:void(0)" onclick="searchContent('.($iPage+1).')">next&gt;</a>';
		}
	}

}
