<script>
// setTimeout(function(){document.getElementById('tm_jaz').click();}, 4000);
</script> 
<?php
# --BEGIN No caching
//header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
//header("Cache-Control: no-store, no-cache, must-revalidate"); 
//header("Cache-Control: post-check=0, pre-check=0", false); 
//header("Pragma: no-cache");
# --END No caching

// Load Drupal's core.
require_once "./includes/bootstrap.inc";
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

$_SESSION["ka_bInHUD"] = false;

// Checks if the current user is logged in.
if ($user->uid != 0){
	$_SESSION["ka_bInHUD"] = true;
	header("Location: /hud-v2.php");
}

// --BEGIN Compute the Kindness Balance
$iKindnessHours = _kindness_get_hours();

$iKindnessHour = intval($iKindnessHours);
$iKindnessMin = ($iKindnessHours - floor($iKindnessHours)) * 60;
$sCommunityHours = $iKindnessHour." hrs and ".$iKindnessMin." mins";
// --END Compute the Kindness Balance
// commenting Time Tracker code for disable fuel tracking and added code time_tracker_bStartTimer = false
// --BEGIN Load the Time Tracker
/*if (_time_tracker_in_array(basename($_SERVER["SCRIPT_NAME"]), array("hud.php")) 
		&& in_array("Hopeful", $user->roles) 
		&& $user->uid > 1){
	
	$iTimeAvailable = _time_tracker_get_credits();

	if ($iTimeAvailable <= 180){
		drupal_goto("time/buy");
	}else{
		$_SESSION["time_tracker_bStartTimer"] = true;
		$iTimeSpent = _time_tracker_get_time();
	}
}else{
	$_SESSION["time_tracker_bStartTimer"] = false;
}*/
//disable fuel tracking for now , by using time_tracker_bStartTimer = false
$_SESSION["time_tracker_bStartTimer"] = false;
// --END Load the Time Tracker

// --BEGIN Store URL construct
$sBaseURL = variable_get('oscommerce_url', '#').'/login2.php?io=bXlnaXptb3oubmluZy5jb20/eWVz';
$B64Email = base64_encode($user->mail);
$B64Name = base64_encode($user->name);
$sB64Pass = base64_encode(variable_get("pass_unmasked_".$user->name, "12345"));

$sStoreURL = $sBaseURL.'&u='.$B64Email.'&p='.$sB64Pass.'&q=store';
$sCommissaryURL = $sBaseURL.'&u='.$B64Email.'&p='.$sB64Pass.'&q=comm&uid='.$user->uid;
// --END Store URL construct

if($_GET['b']){
$sTreeMenuData = mystudies_listcategories();
}

if($_GET['e']){
$sETreeMenuData = mystudies_elistcategories(); 
}

$sLangOptions = "";
$sLangOptions2 = "";
$aLang = mystudies_get_google_language(); 

$count = 1;

$currentLang = mystudies_languagemanagement(false, $user->uid, ""); // memory leach
foreach($aLang as $id => $sLang) {
		$sLangOptions .= '<option value="' . $id . '">' . $sLang . '</option>';
		if($currentLang == $id){
		$aBgColor = 'style="background-color:#3399ff;"';
		} else{
		$aBgColor = '';
		}
		$sLangOptions2 .= '<div id="sLangOptions'.$count.'" '.$aBgColor.'><a href="javascript:void(0);" onClick="setLanguage('."'".$id."'".')">'.$sLang.'</a></div>';    
$count++;
}

// detect of browser is ie
$u_agent = $_SERVER['HTTP_USER_AGENT'];
$iS_IE = False;
if(preg_match('/MSIE/i',$u_agent)){
 $iS_IE = True;
}
// eof detect of browser is ie

$aClearance = mystudies_get_clearance(); 
$iProfileClearance = mystudies_get_user_clearance($user->uid,2);

$sClearanceOptions = "";
foreach($aClearance as $id => $sClearance) {
	$sel = ($id == $iProfileClearance ? "selected" : "");
	$sClearanceOptions .= '<option value="' . $id . '" ' . $sel . '>' . $sClearance . '</option>'; 
}

$timetrackername = _time_tracker_get_name();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="-1">
<meta http-equiv="Cache-Control" content="no-cache">

<title>Samaritan Citation</title>
<link type="text/css" href="sites/all/modules/mystudies/jquery.treeview.css" rel="stylesheet" />
<!--<link type="text/css" href="sites/all/modules/devel/devel.css" rel="stylesheet" />-->
<link type="text/css" href="home_files/style.css?<?php echo time(); ?>" rel="stylesheet" />
<link type="text/css" href="hud_files/style-v2.css?<?php echo time(); ?>" rel="stylesheet" />
<link type="text/css" href="hud_files/jquery.treeview.css" rel="stylesheet" />
<link type="text/css" href="home_files/jquery.jScrollPane.css" rel="stylesheet" />
<link type="text/css" href="misc/jqueryui/jquery-ui.css" rel="stylesheet" />
<link rel="stylesheet" href="misc/pagination.css" />

<?php echo drupal_get_js(); ?>

<script type="text/javascript" src="misc/jqueryui/jquery-ui.min.js?q"></script>
<script type="text/javascript" src="sites/all/modules/mystudies/jquery.cookie.js?q"></script>
<script type="text/javascript" src="sites/all/modules/mystudies/jquery.treeview.js?q"></script>
<script type="text/javascript" src="sites/all/modules/mystudies/jquery.treeview.async.js?q"></script>
<script type="text/javascript" src="home_files/jquery.mousewheel.js"></script>
<script type="text/javascript" src="home_files/jquery.jScrollPane.js"></script>
<script type="text/javascript" src="hud_files/promises.js?v=<?= time() ?>"></script>                                         
<script type="text/javascript" src="sites/all/modules/gtrans/gtranslate_files/jquery-translate.js"></script>
<script type="text/javascript" src="misc/jquery.pagination.js"></script>
<script type="text/javascript" src="hud_files/hud-v2.js?q=<?= time() ?>"></script>
<script type="text/javascript" src="home_files/home.js?q=<?= time() ?>"></script>
<!-- <script src="http://malsup.github.com/jquery.form.js"></script>  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script> 
<script type="text/javascript">
	var hud_sBasePath = '<?php echo base_path() ?>';
	var hud_sStoreURL = '<?php echo $sStoreURL ?>';
	var hud_sCommissaryURL = '<?php echo $sCommissaryURL ?>';
	var uid = '<?php echo $user->uid; ?>';
	var hud_iChildId = '<?php echo $user->uid; ?>';
	var hud_sLang = "<?php //echo mystudies_languagemanagement(false, $user->uid, "")
					echo $currentLang;
					?>";
	var hud_sLangOrig = "en";

	function logout_kickapps(){
		jQuery.cookie('promises', null, { path: '/' })
		//location.href = 'http://affiliate.kickapps.com/user/logoutUser.kickAction?as=158175';
		//location.href = 'http://www.hopecybrary.org/home.php';
		location.href = "<?php echo $base_url?>/home.php";
	}
</script>
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function validateLogin(myform) {
        if(jQuery.cookie('cybraryhome') == null){
		jQuery.cookie('cybraryhome', 'active', { path: '/' });
		}
		err = "";
		document.getElementById("divLoginError").innerHTML = "";
		if (myform.name.value == "")
			err += "Please input your username.<br />";
		if (myform.pass.value == "")
			err += "Please input your password.<br />";	
		if (err != "") {
			document.getElementById("divLoginError").innerHTML = err;
			return false;
		}
		return true;
}
jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // CAUTION: Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};

if(jQuery.cookie('cybraryhome') == 'inactive'){
jQuery.cookie('cybraryhome', null, { path: '/' });
}

function landch(){
jQuery.cookie('cybraryhome', 'active', { path: '/' });
location.href = '<?php echo $sCurrPage; ?>logout?page=home';
}

function mockaccount(){
jQuery.cookie('cybraryhome', 'active', { path: '/' });
location.href = '<?php echo $sCurrPage; ?>user/visitor?destination=user';
}

var autologout = '<?=$_GET['logout']?>'; 

if(autologout == 'true'){
landch();
}
//-->
</script>
<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.js" ></script> -->

<style type="text/css">
   	body{
   		color: #FFF;
   	}
	#registerDiv{
		display:none;
		border:2px solid #333;
		padding:3px;
		background:#cdcdcd;
		width:460px;
		text-align:center;
	}
	#popupYT{
		display:none;
		padding:10px;
		background:#969696;
		position:absolute;
		top:65%;
		left:35%;
		z-index: 99999;
		opacity:100%;

	}
	#popupinfoYT{
		padding:2px;
		text-align:center;
		background:#cfcfcf;
	}
	#popupinfoYT p{
		font-size:14px;
	}

	#popupinfoYT .button {
		text-align:center;
	}
	#popupinfoYT .button a{
		text-decoration:none;
		border:1px solid #333;
		width:20px;
		padding:5px;
		background:#1A1A1A;
		color:#eee;
	}

	#popupinfoYT .button a:hover{
		background:#eee;
		color:#1a1a1a;
	}

	#maskyt{

		background: #000;
		position: fixed;
		left: 0;
		top: 0;
		z-index: 10;
		width: 100%;
		height: 100%;
		opacity: 0.8;
		z-index: 999;

	}		

	.menur li:hover>ul {
	    visibility: visible;
	    bottom: 100%;
	    background-image: none;
	    width: 146px;
	    top: 27px;
	    background-color: #183404;
	    border: 2px solid #a9ff00;
	}

	#hud-loading {
	    position:fixed;
	    width:100%;
	    left:0;right:0;top:0;bottom:0;
	    background-color: rgba(255,255,255,0.7);
	    z-index:9999;
	    display:none;
	}

	@-webkit-keyframes spin {
		from {-webkit-transform:rotate(0deg);}
		to {-webkit-transform:rotate(360deg);}
	}

	@keyframes spin {
		from {transform:rotate(0deg);}
		to {transform:rotate(360deg);}
	}

	#hud-loading::after {
	    content:'';
	    display:block;
	    position:absolute;
	    left:48%;top:40%;
	    width:40px;height:40px;
	    border-style:solid;
	    border-color:black;
	    border-top-color:transparent;
	    border-width: 4px;
	    border-radius:50%;
	    -webkit-animation: spin .8s linear infinite;
	    animation: spin .8s linear infinite;
	}

	.dropdown-content {
	  /*display: none;*/
	  position: absolute;
	  background-color: #f9f9f9;
	  min-width: 160px;
	  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	  z-index: 1;
	}
</style>

<script type="text/javascript">
	var strYTID = "";
	function loadYTPlayer(uid)
	{
		strYTID = uid;
		//-- Show yt player div
		//alert("YT Id =" + strYTID);
		openYTPopup();
	}
	
	function getYTID()
	{
		return strYTID;
	}
	
	function openYTPopup()
	{               
		$("#registerDiv").fadeIn(2000);
		$("body").append("<div id='maskyt'></div>");
		$("#maskyt").fadeIn(2000);
		$("#popupYT").fadeIn(2000);
	}

	function HideYTPopup()
	{
		$("#registerDiv").fadeOut(500);
		$("#maskyt").fadeOut(500);
		$("#popupYT").fadeOut(500);
		$("#maskyt").remove();
	}
</script>
<?php
$middle_text = 'Samaritan Citation Program';
?>

</head>
	<input type="text" style="display: none;" id="user_id" value="<?php echo $user->uid; ?>">
	<div id="hud-loading"></div>
<ul class="circles">
	           <li></li>
	           <li></li>
	           <li></li>
	           <li></li>
	           <li></li>
	           <li></li>
	           <li></li>
	           <li></li>
	           <li></li>
	           <li></li>
	   </ul>
<body id='body2'> 

	<div id="wrapper-container">
	<div style="display: flex;padding: 20px;">
		<div style="margin-right: auto;width: 50%;">
		</div>
		<div style="margin-right: auto;width: 50%;text-align: right;">
			<a class="hl welcome_header_text" href="#" onclick="$('#divLogin').slideDown();$('#divLogin').css('left', ($('.welcome_header_text').position().left - 230) + 'px')" onmouseout="MM_swapImgRestore()" style="    font-size: 16px;">Login</a>
			<div style="position:absolute;z-index:200;height:100px; display:none; text-align:center;margin-top: 10px;" id="divLogin">
                <div class="jbox" style="
				    background: #FFF;
				    border-radius: 5px;
				    color: #000;
				">
                    <div class="jboxbody" style="
						    padding-top: 10px;
						    padding-bottom: 10px;
						    background: none;
						">
                        <div class="jboxcontent" style="text-align:center;color:#fff;background: none;">
                        	<div class="hl" style="color:#004a60;margin-bottom: 10px;">Login</div>
                        	<form action="<?php echo $sCurrPage; ?>user?page=home" method="post" onsubmit="return validateLogin(this);">
                                <table cellpadding="2" cellspacing="2" border="0" width="100%" style="color: #000;">
                                    <tr><td style="padding:2px;" width="50">Username:</td><td style="padding:2px;"><input type="text" name="name" onfocus="if (this.value == 'Username') this.value = '';" /></td></tr>
                                    <tr><td style="padding:2px;">Password:</td><td style="padding:2px;"><input type="password" name="pass" onfocus="if (this.value == 'Password') this.value = '';" /></td></tr>
                                    <tr><td style="padding:2px;"></td><td style="padding:2px;">
                                        <input type="hidden" name="form_id" id="edit-user-login" value="user_login" />
                                        <input type="submit" name="op" value="Log in" class="btnuser" /> 
                                        <input type="button" name="btnClose" value="Close" class="btnuser" onclick="$('#divLogin').slideUp()" />
                                    </td></tr>
                                </table>
							</form>

                        	<small class="notice" id="divLoginError" style="color: red;text-align: left;"></small>
                        </div>
                    </div>
                </div> 
            </div>
		</div>
	</div>
	<div id="wrapper" style="border: 1px solid #193802;
    background-color: #7da0b5;margin-top: 10px;
    border-radius: 24px;">
<div id="header-container">
   <img id="header-image" src="/hud_files/images/1st_Hope_Logo.png">
   <div id="header-title-container">
      <h2 id="header-title">1st Hope Corps</h2>
      <div id="header-subtitle">The Power of Hope</div>
   </div>
   <div id="header-right-title-container">
      <h2>God - People - Planet</h2>
   </div>
</div>
	<div id="top-navigation">
		<ul>
			<li onclick="ToggleContent('hope_home_1st_hope_corps');" id="home_top_nav">Home</li>
			
			<li onclick="Toggle('bank_sub'); ToggleContent('bank_about'); $('#nav-container').css('height', '210px');" id="vault_top_nav">Rewards</li>
			
			<li onclick="Toggle('kindness_sub'); ToggleContent('kindness_about'); $('#nav-container').css('height', '205px');" id="workz_top_nav">Citations</li>
			
			<li onclick="ToggleContent('hope_about_1st_hope_corps');" id="about_top_nav">About</li>
		</ul>
	</div>
		<!--  BEGIN Breadcrumb -->
		<div style="display: flex;display: flex;padding-left: 30px;margin-top: 10px;"> 
			<a href="#" style="color: #FFF;margin-right: 14px;text-decoration: none;" id="historyBack" > << </a> 
			<div id="content_breadcrumb" class="hl" style="display:none;">Home</div>
		</div>
		<!--  END Breadcrumb -->
		
		<!-- BEGIN HopeNet Content -->
		
		<!-- Main -->
		<div id="hopenet_main_content" class="winXP" style="padding: 30px;padding-top: 0px;">


			<div id="hopenet_home_1st_hope_corps"  class="hopenet_main_module_container" style="height: auto;">
				<div class="kindness-title" style="font-size:0.75em; margin-bottom:1px;">About</div>
				<div class="hopenet_text_top">
					<span class="hl"><?php echo $middle_text; ?></span>
				</div>
				<div style="background: url('/hud_files/images/police pic4.png') 0% 0% / cover;height: 440px;" class="hopenet_middle_banner"></div>
				<div class="hopenet_main_left" style="display:none;">
					<img src="hud_files/images/main_about_hope_corps.jpg" />
				</div>
				<div class="hopenet_middle_text_container">
					<div class="hopenet_middle_text_container_draft">
						Draft:
					</div>
					Welcome to the 1 st Hope Corps Samaritan Citation Program. 1st Hope is
					partnering with local law enforcement to seek out, promote and reward acts of
					valor, and acts of kindness performed in our local community. Too often it is the
					negative forces that take center stage and get the most publicity. People tend to
					lose hope when the positive takes a back seat to the negative! We propose to
					promote the positive and foster hope in our citizens by focusing on the “good” in
					our communities. The Good Book tells us that hope is the “anchor of the soul”.
					Hope is a powerful force - a single act or phrase, even an image, can give us hope,
					inspire us to action, and lift the spirits of millions. Our communities will thrive on
					the positive… we need hope, we need Good Samaritan heroes.
				</div>
			</div>

			<div id="hopenet_about_1st_hope_corps"  class="hopenet_main_module_container" style="height: auto;display: none;">
				<div class="kindness-title" style="font-size:0.75em; margin-bottom:1px;">About</div>
				<div class="hopenet_text_top">
					<span class="hl"><?php echo $middle_text; ?></span>
				</div>
				<div style="height: auto;" class="hopenet_middle_banner">
					<img src="/hud_files/images/about_banner_v3.png" style="border-radius: 10px;width: 100%;">
				</div>
				<div class="hopenet_main_left" style="display:none;">
					<img src="hud_files/images/main_about_hope_corps.jpg" />
				</div>
				<div class="hopenet_text_middle">
					<span class="hl">About Samaritan Citation</span>
				</div>
				<div class="hopenet_middle_text_container">
					<div class="hopenet_middle_text_container_draft">
						Draft:
					</div>
					1st Hope will launch its services to the community with the Samaritan Citation
					Program. The purpose of the program is to seek out and focus on the “positive”
					by promoting and rewarding acts of valor and acts of kindness performed in our
					local community. We call the acts “Workz,” Workz is defined as unselfish acts of
					valor and kindness performed by Benefactors without compensation for the
					benefit of a beneficiary person or group. The Workz include acts of valor such as
					rescues and acts of kindness such as repairs, planting trees, picking up trash, etc.
					Samaritan Citation rewards its participants that provide Workz to the community
					by awarding them with wGold, which they can redeem for services and products
					provided by local merchants. 1st Hope will collaborate with local police and
					sheriff’s departments to institute a Community Workz Citation program. Law
					enforcement officers will issue “Samaritan Citations” to reward citizens they
					observe or have become aware of doing Workz for the benefit of their
					communities. This program will help foster an improved relationship between law
					enforcement and their community.
				</div>
			</div>
		</div>
 
		<!-- Carousel -->
		<div id="hopenet_main_content2" style="padding: 30px;padding-top: 0px;">
				<div id="" class="bottom-navigation-container">
					<div class="bottom-navigation" onclick="Toggle('kindness_sub'); ToggleContent('kindness_about'); $('#nav-container').css('height', '205px');">
						<img src="/hud_files/images/workz-footer-nav-image.png" style="border: 2px solid #0bc4d7;width: 120px;height: 100px;">
						<div class="bottom-navigation-text">Citations</div>
					</div>

					<div class="bottom-navigation" onclick="Toggle('bank_sub'); ToggleContent('bank_about'); $('#nav-container').css('height', '210px');">
						<img src="/hud_files/images/img01.jpg" style="border: 2px solid #0bc4d7;width: 120px;height: 100px;">
						<div class="bottom-navigation-text">Rewards</div>
					</div>
					<div class="bottom-navigation-spacer"></div>
					<div class="bottom-navigation" onclick="ToggleContent('hope_about_1st_hope_corps');">
						<img src="/hud_files/images/temp_hopenet_main_about_img.jpg" style="border: 2px solid #0bc4d7;width: 120px;height: 100px;">
						<div class="bottom-navigation-text">About</div>
					</div>
				</div>
		</div>
		</div>
	</div>
	<div class="header_bottom" style="height: auto;width: 300px;float: right;position: relative;display: none;">
		<?php if (!$user->uid) { ?>	 
			<div id="notlogeddinredirect" class="membership">
				<a href="javascript:void(0);" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image7','','home_files/images/but03-02.png',1)" class="menuLink" style="background:url(home_files/images/membership.png) right top no-repeat;">
					<img src="home_files/images/but03.png" name="Image7" width="117" height="17" border="0" id="Image7" />
				</a>
				<div id="home_notLoggedinmessage">
					<center style="font-size:1.3em; color:#FFF200;">You have to log-in first.</center>
					<hr style="height:1px; color:#54EC1A;" />
					<p align="center">Please log-in below to see the alpha version of the Hope Shuttle HUD (Head Up display).</p>
			    </div>
			</div>
		<?php } else{ ?>
			<div id="logeddinredirect" class="membership">
				<a href="javascript:void(0);" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image7','','home_files/images/but03-02.png',1)" class="menuLink" style="background:url(home_files/images/membership.png) right top no-repeat;">
					<img src="home_files/images/but03.png" name="Image7" width="117" height="17" border="0" id="Image7" />
				</a>
			</div>
		<?php } ?>
		</div>
</body>
<?php 
if($_GET['et'] && isset($_GET['et'])){
?>
<script>
$(document).ready(function(){
	var iTutorEnrollStatus = 0;
	var sImage = "scale-banking.png";
	$("#wrapper").css("background", "url(hud_files/images/"+sImage+") top no-repeat");
	//$("#content_breadcrumb").html('HUD &gt; eTutoring &gt Instant eTutoring');
    $("#hopenet_main_content").hide();
	//$("#tutoring_content_about").show();
    //$("#tutoring_content_ini").show();
	$("#content_breadcrumb").html('HUD &gt; eTutoring &gt Instant Tutoring &gt; Instant Question');
			
	if (iTutorEnrollStatus == 0) Tutor_EnrolCheck();
	
	Tutor_GetQuestions(hud_sBasePath+"askeet/hud/callback/question/popular", "popular");
	$("#tutoring_content_get_started").show();
});
</script>
<?php
}
?>
 <?php 
if($_GET['commissary'] && isset($_GET['commissary'])){
?>  
    <script>
        $(document).ready(function(){
ToggleContent('livelihood_commissary');
});
    </script> 
  <?php
}
?>  
   <?php 
if($_GET['etutoring'] && isset($_GET['etutoring'])){
?>  
    <script>
        $(document).ready(function(){
ToggleContent('tutoring_start');
});
    </script> 
  <?php
}
?>   
</html>
<?php

set_time_limit(30);

// Now, clear the output buffer
flush();
ob_flush();

//$dir = '/vol/var/www/drupal/';
//require_once($dir.'/sites/all/modules/pqp_index/classes/PhpQuickProfiler.php');
	
//pqp_index_init();
//$profiler = new PhpQuickProfiler(PhpQuickProfiler::getMicroTime());
//$profiler->display();

//mysqli_close();
?>