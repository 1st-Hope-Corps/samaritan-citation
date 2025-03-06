<?php
error_reporting (E_ALL ^ E_NOTICE);

require_once './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

global $user;

set_time_limit(30);

//if(strpos($_SERVER['HTTP_REFERER'], 'community')){
//}
/*
if(strpos($_SERVER['HTTP_REFERER'], 'hud')){
$_SESSION['location'] = 'hud';
}

if($_GET['location'] == 'community'){
$cookie_location = 'community';
}

if($_GET['location'] == 'hud'){
$cookie_location = 'hud';
}*/

$sUsername = (isset($_GET["q"])) ? $_GET["q"]:$user->name;

$bShowHeader = ($_SESSION["ka_bInHUD"]) ? false:true;

if (isset($_GET["q"])){
	$sqlUID = "SELECT uid FROM users WHERE name = '%s'";
	$oUIDResult = db_query($sqlUID, $sUsername);
	$iUID = db_fetch_object($oUIDResult)->uid;
	mysqli_free_result($oUIDResult);
}else{
	$iUID = $user->uid;
}

$roleresult = 0;
$roleres = db_query('SELECT r.rid, r.name FROM {role} r INNER JOIN {users_roles} ur ON ur.rid = r.rid WHERE ur.uid = %d', $iUID);
while ($role = db_fetch_object($roleres)){
  if($role->rid == '9'){
	$roleresult = 1;
  }
}
mysqli_free_result($roleres);

if ($roleresult == 0) {
$userRole = 'notahopeful';
} else{
$userRole = 'hopeful';
}

$bNotMember = (!$iUID) ? true:false;

if (!$bNotMember){
	$bVisitor = ($user->uid == 163 || empty($user->uid) || $user->uid == 0) ? true:false;
	
	// --BEGIN User Details
	$sqlDetails = "SELECT A.fid, B.name, `value`
					FROM profile_values A
					INNER JOIN profile_fields B ON B.fid = A.fid
					WHERE A.uid = %d";
	$oDetailsResult = db_query($sqlDetails, $iUID);

	while ($oDetails = db_fetch_object($oDetailsResult)){
		${$oDetails->name} = $oDetails->value;
	}
	mysqli_free_result($oDetailsResult);
	
	$aDOB = unserialize($profile_dob);
    $iAge = (date("md") < $aDOB["moth"].$aDOB["day"]) ? date("Y")-$aDOB["year"]-1 : date("Y")-$aDOB["year"];
	$bChild = ($iAge < 13) ? true:false;
	
	$sGender = ($profile_gender == 'Male') ? "Boy":"Girl";
	//$sLocation = ucwords($profile_address);
	//$sLocParam = ($sLocation != "" ) ? urlencode(str_replace(array("corner",".",","), array("","",""), strtolower($profile_address))):"No location specified.";
	$pr_address = $profile_city != "" && $profile_country != "" ? $profile_city.', '.$profile_country : '';
	$sLocation = ucwords($pr_address);
	$sLocParam = ($sLocation != "" ) ? urlencode(str_replace(array("corner",".",","), array("","",""), strtolower($pr_address))):"No location specified.";
	// --END User Details

	// --BEGIN Check if user is online
	$iNow = time();
	$iInterval = $iNow - variable_get('user_block_seconds_online', 900);
	$aOnlineUsers = array();

	$sqlOnlineUsers = "SELECT DISTINCT u.uid, u.name, u.mail, u.picture
						FROM users u 
						INNER JOIN sessions s ON u.uid = s.uid 
						WHERE s.timestamp >= %d 
							AND s.uid > 0 
						ORDER BY s.timestamp DESC";
	$oOnlineUsersResult = db_query($sqlOnlineUsers, $iInterval);

	while ($oOnlineUser = db_fetch_object($oOnlineUsersResult)){
		$aOnlineUsers[] = $oOnlineUser->uid;
	}
	mysqli_free_result($oOnlineUsersResult);
	
	$bUserOnline = (in_array($iUID, $aOnlineUsers)) ? "Yes":"No";
	// --END Check if user is online
	
	// --BEGIN Mentors
	
	// --END Mentors
	
	// --BEGIN Kindness Workz
	/*$iKindnessHours = _kindness_get_hours($iUID);
	$iCovertedHours = _kindness_get_hours($iUID, true);
	$iKindessWorkz = $iKindnessHours + $iCovertedHours;*/
	$iKindnessHours = _kindness_get_hours($iUID);
	$iCovertedHours = _kindness_get_hours($iUID, true);

	$iTotalHours = $iKindnessHours + $iCovertedHours;
	$iTotalTimeHour = intval($iTotalHours);
    $iTotalTimeMin = ($iTotalHours - floor($iTotalHours)) * 60;
	$iKindessWorkz = $iTotalTimeHour.' hrs and '.$iTotalTimeMin.' min';
	// --END Kindness Workz

	// --BEGIN Knowledge Portal
	$iKnowledgePortal = _time_tracker_get_time_spent($iUID) / 3600;
	// --END Knowledge Portal
	
	// --BEGIN Aid Status
	$iMentorCount = 0;
	$aMentors = array();
	$sqlMentorName = "SELECT A.uid, B.name
					FROM user_hierarchy_mentor A
					INNER JOIN users B ON B.uid = A.uid
					WHERE A.child_id = %d";
	$oMentorNameResult = db_query($sqlMentorName, $iUID);
	
	while ($oMentorName = db_fetch_object($oMentorNameResult)){
		$iMentorCount++;
		$aMentors[] = $oMentorName->name;
	}
	mysqli_free_result($oMentorNameResult);
	// --END Aid Status
}

if ($user->uid == $iUID && $bChild){
	$sUserType = "child";
}else{
	$sUserType = "other";
}

if(strpos($_SERVER['HTTP_REFERER'], 'group')){
$urlReferer = explode('/', $_SERVER['HTTP_REFERER']);

$sqlMemberstatus = "SELECT status
					FROM hope_teamusers
					WHERE uid = %d";
$oMemberResult = db_query($sqlMemberstatus,  array($user->uid));
$oMember = db_fetch_object($oMemberResult);
$disabled_member = $oMember->status;
mysqli_free_result($oMemberResult);
	
$sqlMemberexist = "SELECT count(team_userid) as maximummembers
					FROM hope_teamusers
					WHERE team_id = %d
					AND status is null";
					
$oMaxResult = db_query($sqlMemberexist,  array($urlReferer[5]));
$oMax = db_fetch_object($oMaxResult);
$maximum_members = $oMax->maximummembers;
mysqli_free_result($oMaxResult);

$sqlMemberexist = "SELECT count(uid) as memberexist
					FROM hope_teamusers
					WHERE uid = %d
					AND status is null";
					
$oExistResult = db_query($sqlMemberexist,  array($user->uid));
$oExist = db_fetch_object($oExistResult);
$alreadymember = $oExist->memberexist;
mysqli_free_result($oExistResult);

$sqlCountexist = "SELECT count(uid) as memberteamexist
					FROM hope_teamusers
					WHERE team_id = %d 
					AND uid = %d
					AND status is null";

$oMembersResult = db_query($sqlCountexist,  array($urlReferer[5], $user->uid));
$oStatexist = db_fetch_object($oMembersResult);
mysqli_free_result($oMembersResult);
$memberteamexist = $oStatexist->memberteamexist;
}

$sqlTeamId = "SELECT team_id, status
					FROM hope_teamusers
					WHERE uid = %d";
					
$oTeamIdResult = db_query($sqlTeamId,  $user->uid);
$oTeamId = db_fetch_object($oTeamIdResult);
mysqli_free_result($oTeamIdResult);
$TeamId = $oTeamId->team_id;
$TeamStatus = $oTeamId->status;

header("content-type: application/x-javascript");
?>
(function($j){
	$j.fn.center = function (bAbsolute){
		return this.each(
			function (){
				var oMainFunc = jQuery(this);

				oMainFunc
					.css(
						{
							position:	(bAbsolute) ? "absolute" : "fixed", 
							left:		"50%", 
							top:		"50%", 
							zIndex:		"100"
						}
					)
					.css(
						{
							marginLeft:	"-" + (oMainFunc.outerWidth() / 2) + "px", 
							marginTop:	"-" + (oMainFunc.outerHeight() / 2) + "px"
						}
					);

				if (bAbsolute){
					oMainFunc.css(
						{
							marginTop:	parseInt(oMainFunc.css("marginTop"), 10) + jQuery(window).scrollTop(), 
							marginLeft:	parseInt(oMainFunc.css("marginLeft"), 10) + jQuery(window).scrollLeft()
						}
					);
				}
			}
		);
	}
})(jQuery);

// this is used for videos, photos, message board to appear a volunteer design or hopeful design
var linkurl = window.location.href;
var cookielocation = '';
if(linkurl.search("location=community") !== -1){
cookielocation = 'community';
}

if(linkurl.search("location=hud") !== -1){
cookielocation = 'hud';
}

if(cookielocation == 'community' || cookielocation == 'hud'){
	if(getCookie('cookielocation') !== null){
		DeleteCookie('cookielocation');
	}
	var today = new Date();
	var expiry = new Date(today.getTime() + 365 * 24 * 60 * 60 * 1000);
	setCookie('cookielocation', cookielocation, expiry);	
}

/*
function joinHopeClub(){
    var oldjoin = '<input class="ka_button" type="button" onclick="Javascript:joinClub(this);" value="join this team">';
	joinClub(oldjoin);
	$j("#ka_groupStats .jointeam").html('<input class="ka_button" type="button" onclick="Javascript:leaveHopeClub(this);" value="leave this team">');
	
	var url = window.location.href;
	var sVarurl = url.split('/');
	var action = '';

	if("<?=$disabled_member?>" == 1){
	action = 'update';
	} else{
	action = 'join';
	}

	$j.post(
			"http://www.hopecybrary.org/community/assignteam/" + sVarurl[5] + "/" + "<?=$user->uid?>/"+action,
			{func: ""},
			function(oReply){
			 //if (oReply.STATUS == 1){
				    //console.log(oReply.RETURN);			
			// }
		    },
			"json"
	);
	
	$j("#ka_groupHeaderWrap").html("Welcome to the team.<br/>");
}
	
function leaveHopeClub(){
	var oldleave = '<input class="ka_button" type="button" onclick="Javascript:leaveClub(this);" value="leave this team">';
	leaveClub(oldleave);
	$j("#ka_groupStats .jointeam").html('<input class="ka_button" type="button" onclick="Javascript:joinHopeClub(this);" value="join this team">');
    
	var url = window.location.href;
	var sVarurl = url.split('/');

	$j.post(
			"http://www.hopecybrary.org/community/assignteam/" + sVarurl[5] + "/" + "<?=$user->uid?>/leave",
			{func: ""},
			function(oReply){
			 //if (oReply.STATUS == 1){
				    //console.log(oReply.RETURN);			
			// }
			
		    },
			"json"
	);
	$j("#ka_groupHeaderWrap").html("You have left the team.<br/>");
}*/

function joinHopeClub(teamid){
    var oldjoin = '<input class="ka_button" type="button" onclick="Javascript:joinClub(this);" value="join this team">';
	joinClub(oldjoin);

	$j.post(
			"http://www.hopecybrary.org/community/assignteam/" + teamid + "/" + "<?=$user->uid?>/"+"join",
			{func: ""},
			function(oReply){
			 //if (oReply.STATUS == 1){
				    //console.log(oReply.RETURN);			
			// }
		    },
			"json"
	);
}
	
function leaveHopeClub(teamid){
	var oldleave = '<input class="ka_button" type="button" onclick="Javascript:leaveClub(this);" value="leave this team">';
	leaveClub(oldleave);

	$j.post(
			"http://www.hopecybrary.org/community/assignteam/" + sVarurl[5] + "/" + "<?=$user->uid?>/leave",
			{func: ""},
			function(oReply){
			 //if (oReply.STATUS == 1){
				    //console.log(oReply.RETURN);			
			// }
			
		    },
			"json"
	);
}

function comment_profile(){
	<?php
	global $user;
	?>
	
	/*var linkurl = window.location.href;
	var arrlink = linkurl.split('/'); 
	var link = arrlink[3] + "box4life" + arrlink[4];*/

	if($j("#comment_hopenet_textarea").val() !== ""){
	$j.post(
			"http://www.hopecybrary.org/admin/instant/savetocomment/"+"<?=$user->uid?>"+"/"+$j("#kap_profileNewCommentTargetUsername").val() + "boxing123" + "0" +"/"+$j("#comment_hopenet_textarea").val()+"/"+"profile",
			{
			func: "",
			},
			function(oReply){
				alert(oReply.STATUS);
		    },
			"json"
	);
	$j("#ka_profileCommentControlTop").append("<p>Your comment was sent to the admin for approval.</p>");
	showCommentButtons();
	} else{
	alert("Please right a comment first.");
	}
	return false;
}

function comment_media(username, type){
	<?php
	global $user;
	?>

	var linkurl = window.location.href;
	var arrlink = linkurl.split('/'); 
	var link = arrlink[3] + "box4life" + arrlink[4] + "box4life" + arrlink[5];

	if($j("#comment_hopenet_textarea").val() !== ""){
	$j.post(
			"http://www.hopecybrary.org/admin/instant/savetocomment/"+"<?=$user->uid?>"+"/"+ username + "boxing123" + link +"/"+$j("#comment_hopenet_textarea").val()+"/"+type,
			{
			func: "",
			},
			function(oReply){
				alert(oReply.STATUS);
		    },
			"json"
	);
	$j("#comment_hopenet_textarea").val("");
	$j("#text_parent").append("<p>Your comment was sent to the admin for approval.</p>");
	} else{
	alert("Please right a comment first.");
	}
	
	return false;
}

function activateKindnessFunc(){
var win=null;
var strurl = window.location.href;
sUserName = $j("#ka_profileDetailsUsername h5").text();
if(strurl.search("kickapps_theme2010") == -1){ 
var mypage = 'http://www.hopecybrary.org/kindness_popup.php?user='+sUserName+'&env=hud';
} else{
var mypage = 'http://www.hopecybrary.org/kindness_popup.php?user='+sUserName+'&env=ext';
}
var myname = 'Kindness Workz';
var w = '478';
var h = '469';
var scroll = 'no';
var pos = 'center';

if(pos=="random"){LeftPosition=(screen.width)?Math.floor(Math.random()*(screen.width-w)):100;TopPosition=(screen.height)?Math.floor(Math.random()*((screen.height-h)-75)):100;}
if(pos=="center"){LeftPosition=(screen.width)?(screen.width-w)/2:100;TopPosition=(screen.height)?(screen.height-h)/2:100;}
else if((pos!="center" && pos!="random") || pos==null){LeftPosition=0;TopPosition=20}
settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
win=window.open(mypage,myname,settings);

return false;
}

$j(document).ready(
	
	function(){
		$j("body").show();
		
		var userRole = "<?=$userRole?>";
		var strurl = window.location.href;
		
		$j("body").css({position:"relative", top:"-127px"});
		
		// 2nd navigation
		MyHome = $j("#ka_login_area #ka_myhomeTab").html();
		MyProfilehref = $j("#ka_login_area .ka_username_welcome .ka_nomarginLogin").attr("href");
		var MyAccountLink = '';
		if(strurl.search("kickapps_theme2010") == -1){
		MyAccountLink = '&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.hopecybrary.org/user/ext/account/hud">My Account</a>';
		}
		$j("#ka_login_area .ka_username_welcome").html('<a href="http://affiliate.kickapps.com' + MyProfilehref +'">My Profile</a>' + MyAccountLink);
		$j("#ka_login_area span").html("");
		$j("#ka_login_area .ka_btmmyMessagesMail").remove();
		$j("#ka_login_area .ka_signout_auth").remove();
	
		// 1st navigation
		$j("#ka_homeTab_nav").html(MyHome);
		if(linkurl.search("displayMyPlace.kickAction") !== -1){
		$j("#ka_homeTab_nav span").html('<span style="color:#000000;font-weight:bold;">dashboard</span>');
		} else{
		$j("#ka_homeTab_nav span").html('dashboard');
		}
		
		// contentcontainer in member dashboard
		if (Ka.Info.PAGE == "pages/myPlace.jsp"){
			$j("#ka_myHomeURL").remove(); 
			$j("#ka_myHomeLevel").remove();
			$j("#ka_myHomePoints").remove();
			$j("#ka_getStart .message").remove();
			$j("#ka_lastLogin #ka_myMessages").remove();
			$j("#ka_lastLogin #ka_myNewMessages").remove();
		}
		
		//photoUpload
		photoupload = $j("#photoUpload").attr("action");
		$j("#photoUpload").attr("action", photoupload + "?css=kickapps_theme2010");
		
		$j("#ka_footer").remove();
		
		if(strurl.search("onlyprofile") !== -1){
		$j("#ka_headerTopNav").remove();
		$j("#ka_headerSubNav").remove();
		$j("#ka_headerBtmNav").remove();
		$j('#ka_mainContainer').attr('style', 'background-image: url(/myimage.jpg) !important;');
		}
		
		if(strurl.search("kickapps_theme2010") == -1){
		$j("#ka_userModule .ka_more").html("<a href='http://www.hopecybrary.org/community?page='>more members</a>");
		$j("#ka_memberModule .ka_more").html("<a href='http://www.hopecybrary.org/community?page='>more members</a>");
		$j("#ka_memberTab").html("<a href='http://www.hopecybrary.org/community/members?s=1'><span>members</span></a>");
		//$j("#ka_groupsTab_nav").html("<a href='http://www.hopecybrary.org/community?m=gr'><span>teams</span></a>");	
		$j("#ka_groupsTab").html("<a href='http://www.hopecybrary.org/community?m=gr'><span>teams</span></a>");	
		} else{
		$j("#ka_userModule .ka_more").html("<a href='http://www.hopecybrary.org/community?page=' target='_parent'>more members</a>");
		$j("#ka_memberModule .ka_more").html("<a href='http://www.hopecybrary.org/community?page=' target='_parent'>more members</a>");
		$j("#ka_memberTab_nav").html("<a href='http://www.hopecybrary.org/community/members?s=1' target='_parent'><span>members</span></a>");
		//$j("#ka_groupsTab_nav").html("<a href='http://www.hopecybrary.org/community?m=gr&css=kickapps_theme2010' target='_parent'><span>teams</span></a>");
		$j("#ka_groupsTab").html("<a href='http://www.hopecybrary.org/community?m=gr&css=kickapps_theme2010' target='_parent'><span>teams</span></a>");
		}
		
		$j("#ka_myhomeUpdates .ka_contentBody").html("<div style='padding-left:4px;'>Add other <a href='http://www.hopecybrary.org/community?page=' target='_parent'><span>members</span></a> to your friends and you'll receive updates when they are active in the community.</div>");
		
		// search fields
		$j("#ka_searchAdv_member").hide();
		
		//not login
		bmember = $j("#ka_becomeAMember").html();
		if(bmember !== null){
			$j("#ka_homeTab_nav").text('dashboard');
			
			$j("#ka_becomeAMember").remove();
			$j("#ka_videoModule .ka_add").remove();
			$j("#ka_photoModule .ka_add").remove();
			$j("#ka_blogModule .ka_add").remove();
			$j("#ka_audioModule .ka_add").remove();
			$j("#ka_discussionModule .jboxcontent").remove();
			$j("#ka_groupModule").remove();  
			$j("#ka_aboutContent .ka_button").attr("onClick", "Javascript:parent.location.href='http://www.hopecybrary.org/user/register'");
		}
	
		if (Ka.Info.PAGE == "pages/profilePage.jsp"){
		
			$j("#ka_profileUserInfo #ka_profileMessageLink").remove();
			$j("#ka_profileUserInfo #ka_profileFriendSuggest").remove();
			$j("#ka_profileUserInfo #ka_profileLevel").remove();
			$j("#ka_profileUserInfo #ka_profilePoints").remove();
			
			sUserName = $j("#ka_profileDetailsUsername h5").text().replace("_hope", "").toUpperCase();
			
			if(strurl.search("kickapps_theme2010") == -1 && strurl.search("onlyprofile") == -1){
				<?php
				$url = base64_encode("http://affiliate.kickapps.com/service/displayKickPlace.kickAction?as=158175&u=".$_SESSION['ka_uid']."&st=".$_SESSION['ka_st']."&tid=".$_SESSION['ka_tid']."&site=hud");
				$sqlCat = "SELECT count(sp_id) FROM {sitepal_users} WHERE user_id = %d";
				$count = db_result(db_query($sqlCat, $user->uid));

				$sqlCat2= "SELECT sitepal_id FROM {sitepal_users} WHERE user_id = %d";
				$sitepalid = db_result(db_query($sqlCat2, $user->uid));
						
				if($count == 0){
				?>
				//$j("#ka_profileDetailsUsername").prepend('<br/><center><img src="http://media.kickstatic.com/kickapps/images/user/defaultImage_160x120_D.jpg"><br/><center><a href="http://www.firstearthalliance.org/sitepaleditor.php?url=<?=$url?>"><?php echo 'Go to Avatar';?></a></center>');
				$j("#ka_profileDetailsUsername").prepend('<br/><center><a href="http://www.firstearthalliance.org/sitepaleditor.php?url=<?=$url?>"><?php echo 'Go to Avatar';?></a></center>');
				
				<?php
				}else{
				?>
				$j("#ka_profileDetailsUsername").prepend('<div style="width:180px;height:255px;">&nbsp;</div><center><a href="http://www.firstearthalliance.org/sitepaleditor.php?url=<?=$url?>"><?php echo 'Go to Avatar';?></a></center>');
				$j("#ka_profilePage").prepend('<div style="position:absolute;top:245px;border-style:solid;border-width:thin;background-color:#60b347;"><OBJECT id="VHSS" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,115,0" WIDTH=254 HEIGHT=254 STYLE="position:absolute;visibility:visible;z-index:999999;"><PARAM NAME="movie" VALUE="http://content.oddcast.com/vhss/vhss_v5.swf?doc=http%3A%2F%2Fvhss-d.oddcast.com%2Fphp%2FplayScene%2Facc%3D1309119%2Fss%3D<?=$sitepalid?>%2Fsl%3D0%3Fembedid%3D2c61823516533cb7ab84bab24b61d60c&acc=1309119&bgcolor=0x&embedid=2c61823516533cb7ab84bab24b61d60c"><PARAM NAME=quality VALUE=high><param name="allowScriptAccess" value="always"><PARAM NAME=scale VALUE=noborder><PARAM NAME=bgcolor VALUE="window"><PARAM NAME="wmode" VALUE="window"><EMBED src="http://content.oddcast.com/vhss/vhss_v5.swf?doc=http%3A%2F%2Fvhss-d.oddcast.com%2Fphp%2FplayScene%2Facc%3D1309119%2Fss%3D<?=$sitepalid?>%2Fsl%3D0%3Fembedid%3D2c61823516533cb7ab84bab24b61d60c&acc=1309119&bgcolor=0x&embedid=2c61823516533cb7ab84bab24b61d60c" swLiveConnect=true NAME="VHSS" quality=high allowscriptaccess="always" scale=noborder wmode="window" WIDTH=254 HEIGHT=254 TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"></EMBED></OBJECT></div>');
				<?php
				}
				?>
			}
			<?php
			$sqlPic= "SELECT picture FROM {users} WHERE name = '{$sUsername}'";
			$pic = db_result(db_query($sqlPic));
			?>
			$j("#ka_profileImg").html("<div align='center'><img src='http://www.hopecybrary.org/<?=$pic?>' style='min-height:120;min-width:160;'/></div>");
			
			// Age Mod
			iAge = parseInt($j("#ka_profileAgeItem").html().replace("<strong>Age:</strong> ", ""));
			if (iAge > 100) $j("#ka_profileAgeItem").html("<strong>Age:</strong> " + (iAge-100));
					
			// Additional details
			$j("#ka_profileUserInfo").prepend('<li class="ka_profileAgeItem"><strong>Grades:</strong> <?php echo $profile_grade ?></li><li class="ka_profileAgeItem"><strong>Gender:</strong> <?php echo $sGender ?></li>');
			$j("#ka_profileUserInfo").prepend($j("#ka_profileUserInfo li").get(2));
					
			// Left block template
			//$j("#ka_profileLeft").append('<div id="hc_KindnessWorkz" class="ka_profileSeg"><div id="hc_KindnessDetailsTitle" class="ka_profileSegHeader ka_contentTitle"><h5>Kindness Workz</h5></div><div class="ka_profileSegCont ka_contentBody" style="padding: 0px; height:110px;"></div></div>');
					
			// for comments for profile
			<?php
			$checkvolunteer = db_result(db_query("SELECT count(uid) as count 
												FROM {users_roles}
												WHERE uid = '{$user->uid}'
												AND rid in (4,7,5,6,11,12,13,14,15,16,17,18,19,20,21,22)"));
			
			$profileuserid = db_result(db_query("SELECT uid 
											 FROM {users}
											 WHERE name = '{$sUsername}'"));
			
			$checkhopeful = db_result(db_query("SELECT count(uid) as count 
												FROM {users_roles}
												WHERE uid = '{$profileuserid}'
												AND rid = 9"));
												
			//$urldecode = 'http%3A%2F%2Faffiliate.kickapps.com%2Fservice%2FdisplayKickPlace.kickAction%3Fas%3D158175%26u%3D23824743%26location%3Dcommunity%26view%3Donlyprofile%26%26css%3Dkickapps_theme2010';
			?>
			
			//$j("#ka_profileCommentsList").append('<?=htmlspecialchars(urldecode($urldecode))?>');
			
			<?php
			if($user->uid == 1){
			?>
				$j("#ka_profileCommentControlBot").hide();
				$j("#ka_profileCommentControlTop").hide();
			<?php
			}

			if($checkvolunteer > 0 && $checkhopeful == 1){
				$isAssignedtoEmentor = db_result(db_query("SELECT count(id) as count 
												FROM {instant_ementor_assignment}
												WHERE ementor_id = '{$user->uid}' 
												AND hopeful_id = '{$profileuserid}'"));
				if($isAssignedtoEmentor == 1){
				?>
				$j('#ka_profileNewCommentTextarea_parent').html("<textarea id='comment_hopenet_textarea' name='comment_hopenet_textarea' style='width:460px;' rows='10'></textarea>")
				$j("#ka_profileNewCommentSubmit").attr("onClick", "comment_profile(); return false;");
				<?php
				} else{
				?>
				$j("#ka_profileCommentControlBot").hide();
				$j("#ka_profileCommentControlTop").hide();
				<?php
				}
			} else if($checkvolunteer == 0 &&  $checkhopeful == 0){
				?>
				$j("#ka_profileCommentControlBot").hide();
				$j("#ka_profileCommentControlTop").hide();
				<?php
			}
			
			$filephoto = $_SERVER['DOCUMENT_ROOT'].'/sites/default/files/pictures/picture-'.$db_comment->commentfrom.'.jpg';
			if(file_exists($filephoto) == 1){
			$filepicname = 'http://www.hopecybrary.org/sites/default/files/pictures/picture-'.$db_comment->commentfrom.'.jpg';
			} else{
			$filepicname = 'http://www.hopecybrary.org/sites/default/files/pictures/none.png';
			}
			
			$sql_comments = db_query("select A.comment, A.commentfrom, A.commentto, commentdate, A.status from 
										  {comments_kickapps} A 
										  where commentto = '{$profileuserid}' 
										  and status = 1
										  and type = 'profile'");
			$ccount = 0;		
			
			while($db_comment = db_fetch_object($sql_comments)){
			?>
			$j("#ka_profileCommentsList").append('<li id="ka_profComment_id" class="ka_profComment clearfix" style="height: 0pt;"><div class="ka_profileCommentDate"><?=format_interval(time() - $db_comment->commentdate)?> ago<span class="ka_pipe">|</span><?=_instant_get_hopeful_name($db_comment->commentfrom)?></div><div class="ka_profileCommentImg"><img src="<?=$filepicname?>" width="60" height="69" /></div><div class="ka_profileCommentContent clearfix"><p>' + "<?=$db_comment->comment?>" + '</p></div></li>');
			<?php
			$ccount++;
			}
			mysqli_free_result($sql_comments);
			?>
			<?php
			if($ccount > 0){
			?>
			$j("#ka_profileCommentsEmptyCont").hide();
			<?php
			}
			?>
			// eof for comments for profile
			
			$j("span#hc_eMentors").click(
			 function(){
				$j("#hc_eMentorsList").toggle("slow").center();
			 }
			);
			
			$j("#hc_btnMentorsListClose").click(
			 function(){
				$j("#hc_eMentorsList").hide("slow");
			 } 
			);
			$j("#ka_profileDetailsUsername").hide();
			
			// Kindness Workz block
			$j("#ka_profileLeft").append('<div id="hc_KindnessWorkz" class="ka_profileSeg"><div id="hc_KindnessDetailsTitle" class="ka_profileSegHeader ka_contentTitle"><h5>Kindness Workz</h5></div><div class="ka_profileSegCont ka_contentBody"><div style="font-size:0.9em; line-height:1.3em;"><img align="left" src="http://www.firstearthalliance.org/hud_files/images/kindness_ima01.jpg" style="width:80px;padding-right:5px;" alt="Community Service" />' + sUserName + ' has completed <!--<?php// echo number_format($iKindessWorkz, 2) ?> hours--><?php echo $iKindessWorkz; ?> of Kindness Workz.<p style="margin:5px 0 0 0;"><a href="javascript:void(0);" onclick="activateKindnessFunc();">Click here for details.</a></p></div></div><div class="ka_profileSegFooter">&nbsp;</div></div>')
			
			if(userRole == "hopeful"){
			// Knowledge Portal block
			$j("#ka_profileLeft").append('<div id="hc_KnowledgePortal" class="ka_profileSeg"><div id="hc_KnowledgeDetailsTitle" class="ka_profileSegHeader ka_contentTitle"><h5>Knowledge Portal</h5></div><div class="ka_profileSegCont ka_contentBody"><div style="font-size:0.9em;line-height:1.3em;"><img src="http://www.firstearthalliance.org/hud_files/images/learning_portal_about.jpg" style="width:80px;padding-right:5px;height:60px;" alt="Knowledge Portal" align="left" />' + sUserName + ' has spent <?php echo number_format($iKnowledgePortal, 2) ?> hours in the Knowledge Portal.<p style="margin:5px 0 0 0;"><a href="javascript:void(0);">Click here for details</a>.</p></div></div><div class="ka_profileSegFooter">&nbsp;</div></div>')
			}
			
			if(userRole == "hopeful"){
			//Aid Status block
			$j("#ka_profileLeft").append('<div id="hc_AidStatus" class="ka_profileSeg"><div id="hc_AidDetailsTitle" class="ka_profileSegHeader ka_contentTitle"><h5>Aid Status</h5></div><div class="ka_profileSegCont ka_contentBody" style="padding: 0px; height:110px;"><h5 style="padding-bottom:0px;">eTutors - XX</h5><h5 style="padding-bottom:0px;">eMentors - <?php echo ($iMentorCount > 0) ? '<span id="hc_eMentors" style="cursor:pointer;">'.$iMentorCount.'</span>':0 ?></h5><h5 style="padding-bottom:0px;">Sponsors - XX</h5><p style="margin:5px 8px; line-height:1.3em;">Click the underlined to see the Hopeful\'s aid history.</p></div><div id="hc_eMentorsList" style="display:none; padding:15px; border-style:solid; border-width:5px; border-color:#769E6C; background-color:#ECECE1;"><h3>eMentors List</h3><div><?php echo (count($aMentors) > -1) ? "<ol><li>".'implode("</li><li>", $aMentors)'."</ol>":"No Mentors to list, yet." ?></div><div class="buttons" align="right"><input type="button" class="ka_button" value="close" id="hc_btnMentorsListClose" /></div></div><div class="ka_profileSegFooter">&nbsp;</div></div>');
			$j("#hc_AidStatus li").css("listStyleType", "decimal");
			}
			
			// Status block
			$j("#ka_profileLeft").append('<div id="hc_Status" class="ka_profileSeg"><div id="hc_StatusDetailsTitle" class="ka_profileSegHeader ka_contentTitle"><h5>Status</h5></div><div class="ka_profileSegCont ka_contentBody" style="padding: 5px;"><div><b>What I\'m Doing</b></div><div id="hc_WhatImDoingAnswer">xxxxx</div><div><b>In the Cybrary?</b></div><div id="hc_InTheCybraryAnswer"><?php echo $bUserOnline ?></div></div><div class="ka_profileSegFooter">&nbsp;</div></div>');
			
			$j("#ka_profileLeft").append('<div id="prof_groups" class="ka_profileSeg"></div>');
			$j("#prof_groups").html($j("#ka_profileGroups").html());
			$j("#ka_profileGroups").hide();
			
			$j("#ka_profileAudio").insertAfter('#prof_groups');
			$j("#ka_profileFavAudio").insertAfter('#prof_groups');
			$j("#ka_profileGroups").insertAfter('#prof_groups');
			$j("#ka_profileTags").insertAfter('#prof_groups');
			
			if(userRole == "hopeful"){
			// Video chat block
			//$j("#ka_profileLeft").append('<div id="hc_VideoChat" class="ka_profileSeg"><div id="hc_VideoDetailsTitle" class="ka_profileSegHeader ka_contentTitle"><h5>Live Video Chat</h5></div><div class="ka_profileSegCont ka_contentBody" style="padding: 0px;"><div align="center" style="padding-top:6px;"><img src="http://www.firstearthalliance.org/socialgo_images/live_video_chat.jpg" alt="Live Video Chat" /></div><p style="padding-top:10px">As a sponsor you will have access to unparalleled communications with your sponsored child. The list of communication tools include:</p><div style="margin-left:7px;"><ul style="color:white;"><li>Video Chat</li><li>Email</li><li>Chat</li><li>SMS</li><li>Phone Calls</li><li>Virtual World <em style="font-size:0.7em;">(coming soon)</em></li></ul></div><div class="buttons" style="padding-top:10px;" align="center"><input type="button" class="ka_button" style="font-weight:bold; margin-bottom:5px;" value="Learn More" id="hc_btnChatLearnMore" /></div></div><div class="ka_profileSegFooter">&nbsp;</div></div><div id="notice_live_video_chat" style="display:none; padding:15px; border-style:solid; border-width:5px; border-color:#769E6C; background-color:#ECECE1;"><h3>Learn more about Live Video Chat</h3><br /><div class="buttons" align="right"><input type="button" class="ka_button" value="close" id="hc_btnChatLearnMoreClose" /></div></div>');
			//$j("#ka_profileLeft").append('<div id="hc_VideoChat" class="ka_profileSeg"><div id="hc_VideoDetailsTitle" class="ka_profileSegHeader ka_contentTitle"><h5>My Profile</h5></div><div class="ka_profileSegCont ka_contentBody" style="padding: 0px;"><div align="center" style="padding-top:6px;"><OBJECT id="VHSS" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,115,0" WIDTH=161 HEIGHT=161><PARAM NAME="movie" VALUE="http://content.oddcast.com/vhss/vhss_v5.swf?doc=http%3A%2F%2Fvhss-d.oddcast.com%2Fphp%2FplayScene%2Facc%3D1309119%2Fss%3D1917577%2Fsl%3D0%3Fembedid%3D90e5507007fe3b5233110aa3ceae762a&acc=1309119&bgcolor=0x&embedid=90e5507007fe3b5233110aa3ceae762a"><PARAM NAME=quality VALUE=high><param name="allowScriptAccess" value="always"><PARAM NAME=scale VALUE=noborder><PARAM NAME=bgcolor VALUE="transparent"><PARAM NAME="wmode" VALUE="transparent"><EMBED src="http://content.oddcast.com/vhss/vhss_v5.swf?doc=http%3A%2F%2Fvhss-d.oddcast.com%2Fphp%2FplayScene%2Facc%3D1309119%2Fss%3D1917577%2Fsl%3D0%3Fembedid%3D90e5507007fe3b5233110aa3ceae762a&acc=1309119&bgcolor=0x&embedid=90e5507007fe3b5233110aa3ceae762a" swLiveConnect=true NAME="VHSS" quality=high allowscriptaccess="always" scale=noborder wmode="transparent" WIDTH=161 HEIGHT=161 TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"></EMBED></OBJECT><img src="http://www.firstearthalliance.org/socialgo_images/live_video_chat.jpg" alt="Live Video Chat" /></div><p style="padding-top:10px">As a sponsor you will have access to unparalleled communications with your sponsored child. The list of communication tools include:</p><div style="margin-left:7px;"><ul style="color:white;"><li>Video Chat</li><li>Email</li><li>Chat</li><li>SMS</li><li>Phone Calls</li><li>Virtual World <em style="font-size:0.7em;">(coming soon)</em></li></ul></div><div class="buttons" style="padding-top:10px;" align="center"><input type="button" class="ka_button" style="font-weight:bold; margin-bottom:5px;" value="Learn More" id="hc_btnChatLearnMore" /></div></div><div class="ka_profileSegFooter">&nbsp;</div></div><div id="notice_live_video_chat" style="display:none; padding:15px; border-style:solid; border-width:5px; border-color:#769E6C; background-color:#ECECE1;"><h3>Learn more about Live Video Chat</h3><br /><div class="buttons" align="right"><input type="button" class="ka_button" value="close" id="hc_btnChatLearnMoreClose" /></div></div>');
			/*$j("#hc_btnChatLearnMore").click(
			    function(){
					$j("#notice_live_video_chat").toggle("slow").center();
				}
			);*/
			}
			
			$j("#hc_btnChatLearnMoreClose").click(
				function(){
					$j("#notice_live_video_chat").hide("slow");
				}
			);
					
			// About me block
			if ($j("#ka_profileAboutMe strong:first").text().substr(0, 5) == "Sorry") //$j("#ka_profileAboutMe strong:first").remove();
					
			$j("#ka_profileAboutMe").append('<div><strong>Languages:</strong> <?php echo (isset($profile_language)) ? $profile_language:"Not specified" ?></div><div><strong>Talents:</strong> <?php echo (isset($profile_talents)) ? $profile_talents:"Not specified" ?></div><div><strong>Favorite Things:</strong> <?php echo (isset($profile_favorites)) ? $profile_favorites:"Not specified" ?></div><!--<div><strong>Lives with:</strong> <?php echo (isset($profile_lives_with)) ? $profile_lives_with:"Not specified" ?></div><div><strong>Family Income:</strong> <?php echo (isset($profile_parent_income)) ? "PHP ".number_format(intval($profile_parent_income), 2):"Not specified" ?></div>-->');
					
			// Location block
			$j("#ka_profileRight").prepend('<div id="hc_LocationMap" class="ka_profileSeg"><div class="ka_profileSegHeader ka_contentTitle"><h5>Location</h5></div><div class="ka_profileSegCont ka_contentBody clearfix"><div class="clearfix" id="ka_profileAboutMe"><div style="float:left; width:163px;"><strong>Lives in:</strong><br/><?php echo $sLocation ?><br/><br/><a href="http://maps.google.com/?q=<?php echo $sLocParam ?>+ph&mrt=loc&iwloc=A&z=15&output=embed" target="_blank">View a larger Location Map</a></div><div style="float:left; width:330px;"><iframe src="http://maps.google.com/?q=<?php echo $sLocParam ?>+ph&mrt=loc&iwloc=&z=15&output=embed" frameborder="0" style="width:330px; height:350px;"></iframe></div></div></div><div class="ka_profileSegFooter">&nbsp;</div></div>');
			
			$j("#ka_profileRight").prepend($j("#ka_profileRight div").get(7));
			
			$j("#ka_profileRight").prepend('<div id="hc_kindnessWrapper" class="ka_profileSeg" style="display:none;"><div class="kindness-content02"><div class="kindness-txt kindness-dashboard-box" id="kindness_dashboard_details"></div><div class="kindness-txt"><h3>Kindness Workz Hours : Pending - Approved - Disapproved</h3><div class="pending_top_txt"><div class="pending_top_title">Title</div><div class="pending_top_duration">Duration</div><div class="pending_top_date">Date Reported</div><div class="pending_top_monitor">Mentor</div><!--<div class="pending_top_admin">Admin</div>--></div><div class="pending-strip"></div><div id="kindness_approved_list"></div><div align="center" style="font-weight:normal; padding-top:260px; color:#FFE800;">To see the details, click on the title of the Kindness Workz.</div></div></div></div>');

			$j("#ka_profileActivityFeed").insertAfter("#ka_profileBlogs");
			$j("#ka_profileComments").insertAfter('#hc_LocationMap');
			
			sUserName2 = $j("#ka_profileDetailsUsername h5").text();
			//$j("#ka_profileBlogs .ka_profileSegCont").prepend('<object width="440.25" height="242" id="kickWidget_158175_487985" name="kickWidget_158175_487985" type="application/x-shockwave-flash" data="http://serve.a-widget.com/service/getWidgetSwf.kickAction"><param name="movie" value="http://serve.a-widget.com/service/getWidgetSwf.kickAction"></param><param name="FlashVars" value="affiliateSiteId=158175&amp;widgetId=487985&amp;width=440.25&amp;height=242&amp;revision=24&amp;mediaURL=http%3A//www.hopecybrary.org/kickapps_blogs_xml.php?username=' + sUserName2 + '" ></param><param name="wmode" value="transparent" ></param><param name="allowFullScreen" value="true" ></param><param name="allowScriptAccess" value="always" ></param></object>');
			$j("#ka_profileBlogs .ka_profileSegCont").prepend('<object width="440.25" height="242" id="kickWidget_158175_487985" name="kickWidget_158175_487985" type="application/x-shockwave-flash" data="http://serve.a-widget.com/service/getWidgetSwf.kickAction"><param name="movie" value="http://serve.a-widget.com/service/getWidgetSwf.kickAction"></param><param name="FlashVars" value="affiliateSiteId=158175&amp;widgetId=487985&amp;width=440.25&amp;height=242&amp;revision=24" ></param><param name="wmode" value="transparent" ></param><param name="allowFullScreen" value="true" ></param><param name="allowScriptAccess" value="always" ></param></object>');
				
			if(strurl.search("kickapps_theme2010") == -1){ 
				if(strurl.search("<?=$_SESSION['ka_uid']?>") !== -1){
					$j("#ka_profileVideos .ka_profileSegCont").prepend('<div class="ka_upvid2"><input type="button" onclick="Javascript:document.location.href=' + "'http://affiliate.kickapps.com/service/displayVideoUpload.kickAction?as=158175'" + '" value="Add a video" class="ka_button"></div><div>&nbsp;</div>');
					$j("#ka_profilePhotos .ka_profileSegCont").prepend('<div class="ka_upphoto2"><input type="button" onclick="Javascript:document.location.href=' + "'http://affiliate.kickapps.com/service/displayPhotoUpload.kickAction?as=158175'" + '" value="Add a photo" class="ka_button"></div><div>&nbsp;</div>');
					$j("#ka_profileBlogs .ka_profileSegCont").prepend('<div class="ka_addMedia_blog2"><input type="button" onclick="Javascript:document.location.href= ' + "'http://affiliate.kickapps.com/view/displayAddBlog.kickAction?as=158175'" + '" value="Add a blog post" class="ka_button"></div><div>&nbsp;</div>');
				}
			} else{
				if(strurl.search("<?=$_SESSION['ka_uid']?>") !== -1){
					$j("#ka_profileVideos .ka_profileSegCont").prepend('<div class="ka_upvid2"><input type="button" onclick="Javascript:document.location.href=' + "'http://affiliate.kickapps.com/service/displayVideoUpload.kickAction?as=158175&css=kickapps_theme2010'" + '" value="Add a video" class="ka_button"></div><div>&nbsp;</div>');
					$j("#ka_profilePhotos .ka_profileSegCont").prepend('<div class="ka_upphoto2"><input type="button" onclick="Javascript:document.location.href=' + "'http://affiliate.kickapps.com/service/displayPhotoUpload.kickAction?as=158175&css=kickapps_theme2010'" + '" value="Add a photo" class="ka_button"></div><div>&nbsp;</div>');
					$j("#ka_profileBlogs .ka_profileSegCont").prepend('<div class="ka_addMedia_blog2"><input type="button" onclick="Javascript:document.location.href= ' + "'http://affiliate.kickapps.com/view/displayAddBlog.kickAction?as=158175&css=kickapps_theme2010'" + '" value="Add a blog post" class="ka_button"></div><div>&nbsp;</div>');												
				}
			}
			$j("#ka_profileBlogs ul").remove();
			$j("#ka_profileBlogs").show();
			$j("#ka_profilePhotos").show();
			$j("#ka_profileVideos").show();
		}
		
		fixElements();
		if(Ka.Info.PAGE == 'pages/newVideoUpload.jsp' || Ka.Info.PAGE == 'pages/addBlog.jsp' || Ka.Info.PAGE == 'pages/newAudioUpload.jsp' || Ka.Info.PAGE == 'pages/newPhotoUpload.jsp' || Ka.Info.PAGE == 'pages/mediaPlayPage.jsp'){
			  var str = window.location.href;
   			  if(str.search("invite") !== -1){
				$j("body").css({position:"relative", top:"17px", width:"300px"});
				$j('#ka_mainContainer').attr('style', 'background-image: url(/myimage.jpg) !important;');
				$j("#ka_header").remove();
				$j("#ka_le_headercont").remove(); 
				$j("#ka_manageSubNav").html("<a href='http://affiliate.kickapps.com/_Hope-Team/group/<?=$TeamId?>/158175.html?css=kickapps_theme2010&invite=yes'>return to dashboard</a>"); 
			  }	
		}
			
        if(Ka.Info.PAGE == 'pages/clubHome.jsp'){
			var url = window.location.href;
			var sVarurl = url.split('/');
			if(sVarurl[5] == "<?=$TeamId?>"){
				if("<?=$TeamStatus?>" == 1){
				} else{
				joinHopeClub(sVarurl[5]);
				}
			}
	
			var groupname = $j("#ka_groupName").text().replace(/[1-999999$-]/g, "").toUpperCase();
			$j("#ka_groupName").html(groupname);
			var str = window.location.href;
			$j("#ka_otherGroup .ka_more").html("");
			
				if(str.search("invite") !== -1){
					$j("body").css({position:"relative", top:"17px", width:"300px"});
					$j('#ka_mainContainer').attr('style', 'background-image: url(/myimage.jpg) !important;');
					$j("#ka_joinButton").css({display:"none"});
					$j("#ka_groupSuccess").remove();
					$j("#ka_groupStats").prepend('<div id="ka_shoutBoxArea" style="display:none;">&nbsp;</div><div class="jointeam"><input class="ka_button" type="button" onclick="Javascript:joinHopeClub();" value="join this team"></div>');			   
					
					$j("#ka_header").remove();
					$j("#ka_le_headercont").remove(); 
					$j("#ka_groupHeader").hide();	 
					$j("#ka_groupProfile").hide();
					$j("#ka_groupFeeds").css({width:"350px"}); 
					$j("#ka_groupMember").css({width:"350px"}); 
					$j("#ka_groupVideo").css({width:"350px"});
					$j("#ka_groupPhoto ").css({width:"350px"});
					$j("#ka_groupCommentsTitle").css({width:"350px"});
					$j("#ka_leftColumn").css({width:"350px"}); 
					$j("#ka_rightColumn").css({"padding-right":"60px"}); 
					var oldjoin = '<input class="ka_button" type="button" onclick="Javascript:joinClub(this);" value="join this team">';
					//joinClub(oldjoin);
					$j("#ka_groupComments #ka_shoutBoxArea .ka_contentBody").html('You must join the team to enter messages');
				} else{
					var strurl = window.location.href;
					if(strurl.search("group") !== -1){
						  if("<?=$alreadymember?>" == 0){
						   if("<?=$maximum_members?>" <= 11){
						   $j("#ka_joinButton").css({display:"none"});
						   $j("#ka_groupStats").prepend('<div class="jointeam"><input class="ka_button" type="button" onclick="Javascript:joinHopeClub();" value="join this team"></div>');
						   } else{
						   $j("#ka_joinButton").css({display:"none"});
						   $j("#ka_groupStats").prepend('<div class="jointeam"><b>Limit reached. Please join other team.</b></div>');
						   }		
						  } else{
							if("<?=$memberteamexist?>" == '1' || "<?=$memberteamexist?>" == 1){
							$j("#ka_joinButton").css({display:"none"});
							$j("#ka_groupStats").prepend('<div class="jointeam"><input class="ka_button" type="button" onclick="Javascript:leaveHopeClub();" value="leave this team"></div>');
							} else{
							$j("#ka_joinButton").css({display:"none"});
							$j("#ka_groupStats").prepend('<div class="jointeam"><b>You are already a hope team member</b></div>');
							}
						  }
				}
			}
		}
		
		if(Ka.Info.PAGE == 'pages/mediaPlayPage.jsp'){
			// for comments for blogs, video and photos
			
			var urluser = window.location.href; 
			var typeparts = urluser.split('/');
			var typeurl = typeparts[4];
			
			switch(typeurl){
			case 'blog':
			var redparts = urluser.split('=');
			var redurl = redparts[3];
			break;
			case 'video':
			case 'photo':
			var redparts = urluser.split('=');
			var redurl = redparts[2];
			break;
			}
				if(redurl == undefined){
				var spaceusername = $j("#ka_upMeta .ka_contributorName").text();
				username = spaceusername.replace(/^\s+|\s+$/g,"");
					if(urluser.search("kickapps_theme2010") == -1){
						location.href= window.location.href + "?user=" + username;
					} else{
						location.href= window.location.href + "=user=" + username;
					}
				}
	
			<?php
			$type_url = explode('/', $_SERVER['HTTP_REFERER']);
			$type = $type_url[4];
			switch($type){
			case 'blog':
			$curr_url = explode('=', $_SERVER['HTTP_REFERER']);
			$ownerusername = $curr_url[3];
			break;
			case 'photo':
			case 'video':
			$curr_url = explode('=', $_SERVER['HTTP_REFERER']);
			$ownerusername = $curr_url[2];
			break;
			}
			
			$checkvolunteer = db_result(db_query("SELECT count(uid) as count 
												FROM {users_roles}
												WHERE uid = '{$user->uid}'
												AND rid in (4,7,5,6,11,12,13,14,15,16,17,18,19,20,21,22)"));
			
			$profileuserid = db_result(db_query("SELECT uid 
											 FROM {users}
											 WHERE name = '{$ownerusername}'"));
			
			$checkhopeful = db_result(db_query("SELECT count(uid) as count 
												FROM {users_roles}
												WHERE uid = '{$profileuserid}'
												AND rid = 9"));
					
			if($user->uid == 1){
			?>
			$j("#text_parent").hide();
			$j("#ka_sendButton").hide();
			<?php
			}
			
			?>
			//$j("#ka_noComments").append('Volunteer:'+ '<?=$checkvolunteer?>' +' Hopeful:'+ '<?=$checkhopeful?>');
			<?php
			
			if($checkvolunteer > 0 && $checkhopeful == 1){
				$isAssignedtoEmentor = db_result(db_query("SELECT count(id) as count 
												FROM {instant_ementor_assignment}
												WHERE ementor_id = '{$user->uid}' 
												AND hopeful_id = '{$profileuserid}'"));
				if($isAssignedtoEmentor == 1){
				?>
				$j('#text_parent').html("<textarea id='comment_hopenet_textarea' name='comment_hopenet_textarea' style='width:410px;' rows='9' cols='10'></textarea>")
				$j("#ka_sendButton").attr("onClick", "comment_media('<?=$ownerusername?>','<?=$type?>'); return false;");
				<?php
				} else{
				?>
				$j("#text_parent").hide();
				$j("#ka_sendButton").hide();
				<?php
				}
			} else if($checkvolunteer == 0 &&  $checkhopeful == 0){
				?>
				$j("#text_parent").hide();
				$j("#ka_sendButton").hide();
				<?php
			}
			/*
			$filephoto = $_SERVER['DOCUMENT_ROOT'].'/sites/default/files/pictures/picture-'.$db_comment->commentfrom.'.jpg';
			if(file_exists($filephoto) == 1){
			$filepicname = 'http://www.hopecybrary.org/sites/default/files/pictures/picture-'.$db_comment->commentfrom.'.jpg';
			} else{
			$filepicname = 'http://www.hopecybrary.org/sites/default/files/pictures/none.png';
			}
			
			$sql_comments = db_query("select A.comment, A.commentfrom, A.commentto, commentdate, A.status from 
										  {comments_kickapps} A 
										  where commentto = '{$profileuserid}' 
										  and status = 1
										  and type = '{$type}'");
			$ccount = 0;		
			
			while($db_comment = db_fetch_object($sql_comments)){
			?>
			$j("#ka_commentList").append('<li id="ka_commentItem_5294661" class="odd"><div class="ka_bubble"><blockquote class="ka_contentBody"><img src="<?=$filepicname?>" width="30" height="39" /><div class="ka_bubbleComment clearfix"><p>' + "<?=$db_comment->comment?>" + '</p></div></blockquote><cite><?=_instant_get_hopeful_name($db_comment->commentfrom)?>, <span class="ka_commentDate"><?=format_interval(time() - $db_comment->commentdate)?> ago</span></cite></div></li>');
			<?php
			$ccount++;
			}
			mysqli_free_result($sql_comments);
			?>
			<?php
			if($ccount > 0){
			?>
			$j("#ka_noComments").hide();
			<?php
			}
			*/
			?>

			// eof for comments for blogs, video and photos
		}
		
		
		var str = window.location.href;
			var sparam = '';
			if(str.search("kickapps_theme2010") !== -1 && str.search("invite") == -1 ){
     			var links = document.getElementsByTagName('a');
				var last = links.length;

				for (var i = 0; i < last; i++) {
					var strlink = links[i].href;
					if(strlink.search(".html") !== -1){
					sparam = '?';
					} else{
					sparam = '&';
					}
					
					if (strlink.search(".html") !== -1 && strlink.search("video") !== -1 && strlink.search("b=") !== -1){
					sparam = '&';
					}
					
					if(strlink.search("javascript:") !== -1){
					sparam = '';
					}else if(strlink.search("maps.google") !== -1){
					sparam = '';
					}else if(strlink.search("#") !== -1){
					sparam = '';
					}else if(strlink.search("f.lewis@hopecybrary.org") !== -1){
					sparam = '';
					}
					
					if(sparam !== ''){
					links[i].href = strlink + sparam +"css=kickapps_theme2010";
					}
				}
			}
			
			if(str.search("invite") !== -1 ){
			var links = document.getElementsByTagName('a');
			var last = links.length;
				for (var i = 0; i < last; i++) {
				var strlink = links[i].href;
					if(strlink.search(".html") !== -1){
					sparam = '?';
					} else{
					sparam = '&';
					}
					
					if (strlink.search(".html") !== -1 && strlink.search("video") !== -1 && strlink.search("b=") !== -1){
					sparam = '&';
					}
					
					if(strlink.search("javascript:") !== -1){
					sparam = '';
					}else if(strlink.search("maps.google") !== -1){
					sparam = '';
					}else if(strlink.search("#") !== -1){
					sparam = '';
					}else if(strlink.search("f.lewis@hopecybrary.org") !== -1){
					sparam = '';
					}
					
					if(sparam !== ''){
					    linkval = links[i].href;
						if(linkval.search("displayKickPlace") !== -1 && Ka.Info.PAGE == 'pages/clubHome.jsp'){
						links[i].href = "#";
						} else if(linkval.search("group") !== -1 && Ka.Info.PAGE == 'pages/clubHome.jsp'){
						links[i].href = "#";
						} else{
						links[i].href = strlink + sparam +"css=kickapps_theme2010&invite=yes";
						}
					}
				}
			}
	}
);