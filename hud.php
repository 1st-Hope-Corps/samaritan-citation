<script>
setTimeout(function(){document.getElementById('tm_jaz').click();}, 4000);
</script> 
<?php
// header('Location:/hud-v2.php');
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
if ($user->uid == 0){
	header("Location: user?destination=hud.php");
}else{
	$_SESSION["ka_bInHUD"] = true;
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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="-1">
<meta http-equiv="Cache-Control" content="no-cache">

<title>Cybrary Heads Up Display</title>
<link type="text/css" href="sites/all/modules/mystudies/jquery.treeview.css" rel="stylesheet" />
<!--<link type="text/css" href="sites/all/modules/devel/devel.css" rel="stylesheet" />-->
<link type="text/css" href="hud_files/style.css" rel="stylesheet" />
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
<script type="text/javascript" src="hud_files/promises.js"></script>                                         
<script type="text/javascript" src="sites/all/modules/gtrans/gtranslate_files/jquery-translate.js"></script>
<script type="text/javascript" src="misc/jquery.pagination.js"></script>
<script type="text/javascript" src="hud_files/hud.js?q"></script>
<script src="http://malsup.github.com/jquery.form.js"></script> 
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

<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.js" ></script> -->

<style type="text/css">
   
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
// Checks if Time Tracker should be started. Then, load the JavaScript.
if ($_SESSION["time_tracker_bStartTimer"]){
	?>
	<script type="text/javascript">
	var time_tracker_sBasePath = '<?php echo base_path() ?>';
	var time_tracker_iSpent = '<?php echo $iTimeSpent; ?>';
	var time_tracker_iAvailable = <?php echo $iTimeAvailable; ?>;
	</script>
	
	<script type="text/javascript" src="<?php echo drupal_get_path("module", "time_tracker")."/time_tracker_hud.js" ?>"></script>
	<?php
}
?>

</head>

<body id='body2'> 
		<div id="popupYT">
            <div id="popupinfoYT">
                <div id="registerDiv">
                    <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" width="100%" height="345" id="as3yt" align="middle">
						<param name="allowScriptAccess" value="always"/>
						<param name="allowFullScreen" value="true"/>
						<param name="movie" value="hud_files/as3yt.swf"/>
						<param name="quality" value="high"/>
						<param name="wmode" value="transparent"/>
						<param name="bgcolor" value="#333333"/>
						<embed src="hud_files/as3yt.swf" quality="high" wmode="transparent" bgcolor="#333333" width="100%" height="345" name="as3yt" align="middle" allowScriptAccess="always" allowFullScreen="true" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"/>
					</object>                  
					<input type="button" value="Close" id="closeYT" onclick="HideYTPopup()" />
                </div>
            </div>
        </div>

	<div id="promisesboxes">
		<div id="promisesboxesdialog" class="window">
			<center>
				To serve as a guide for the Hopefuls to follow, Hope Street has created a pledge consisting of 7 Promises that 
				each child must memorize and promise to keep.<br/><br/>
				<img src="hud_files/images/sevenpromises2.png">
				<br/><br/>
				I promise to practice and keep the Seven Promises<br/><br/>
				<div style="width:330px;">
					<div style="float:left;"><a href="#" class="close"/><span id="promisesbutton">I Promise</span></a></div>
					<div style="float:right;">
						<!--a href="http://affiliate.kickapps.com/user/logoutUser.kickAction?as=158175" /-->
						<a href="<?php echo base_path();?>home.php" />
							<span id="promisesbutton">Logout</span>
						</a>
					</div>
				</div>
			</center>
		</div>
		<div id="promisesmask"></div>
	</div>

	<!--<img id="under_construction" src="<?php //echo base_path() ?>misc/under_construction_site.png" border="0" style="position:absolute; top:100px; z-index:3000;" title="Site Under Construction" />-->
	
	<!-- <img id="zoom_earth" src="<?php echo base_path() ?>hud_files/images/zoom_earth.png" border="0" style="position:absolute; top:155px; z-index:3000; cursor:pointer;" title="Zoom to Earth Base" />-->
	<div id="zoom_earth" style="background:url(<?php echo base_path() ?>hud_files/images/zoom_earth.png) no-repeat top right; width:200px; height:73px; position:absolute; top:155px; z-index:3000; cursor:pointer;">
		<div style="margin:10px 0 0 10px;font-size:14px;color:#ff0"><!--ZOOM to Earth BASE--></div>
	</div>
	<div>
	</div>	
		<div id="zoom_earth_movie" style="position:absolute; top:-1055px; z-index:3000; width:430px; height:355px;" title="Click to close this.">
		<!--<div id="zoom_earth_movie_close" style="cursor:pointer; position:absolute; top:-11px; left:176px; border:2px solid #6FDF23;"><img border="0" src="hud_files/images/btn-close.png"></div>-->
		<img src="hud_files/images/zoom_earth_video2.png" border="2" usemap="#zooom_earth_movie_header" />
		<map name="zooom_earth_movie_header">
			<area id="zoom_earth_movie_close" shape="rect" coords="150,10,185,32" title="Click to close this." style="cursor:pointer;" />
		</map>
		<iframe width="425" height="350" frameborder="2" style="border:2px solid #f8ff2c;" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/?ie=UTF8&amp;t=f&amp;ecpose=36.94744015,-67.35065816,16830092.55,9.128,0,0&amp;ll=36.94744,-67.350655&amp;spn=91.901989,149.765625&amp;z=2&amp;output=embed"></iframe>
	
	</div>
	
	<div id="wrapper">
		<!----------------------- Header Start ------------------------------>
		<div class="header">
			<div class="box_left">
				<div id="wrapper05">
					<div class="boxtop">
						<div class="text_area_mid_l"><span class="hl">Hi, <?php echo $timetrackername; ?>. Welcome Back.</span></div>
						<div class="text_area_mid_r"><a onclick="Toggle('myvar3');" title="Switch the Menu" class="closebtn"><img src="hud_files/images/btn-close.png" border="0" /></a></div>
					</div>
					<div class="boxbg"> </div>
					<div id="myvar3" class="hl-2"></div>
					<div class="boxbotl"></div>
				</div>
			</div>
			<div class="box_mid">
				<div id="wrapper02">
					<div class="time01"></div>
					<div class="timebg"> </div>
					<div class="timebg">
						<div class="text_area_mid_l">Fuel Left</div>
						<div class="text_area_mid_r"><span onclick="Toggle('time_tracker_TimeSpent', true); Toggle('time_tracker_TimeSpent_Title', true);" title="Switch the Menu" style="cursor:pointer;">(More)</span></div>
						<div class="clear"></div>
					</div>
					<div id="myvar">
						<span id="time_tracker_TimeAvailable" class="time"></span>
						<div id="time_tracker_TimeSpent_Title" style="color:#F8FF2C; font-size:0.7em; font-weight:bold; margin:2px 0 0 5px; display:none;">Fuel Spent</div>
						<span id="time_tracker_TimeSpent" class="time" style="display:none;"></span>
					</div>
					<div class="time03"> </div>
				</div>
			</div>
			<div class="box_right">
				<div id="wrapper05">
					<div class="boxtop">
						<div class="text_area_mid_l"></div>
						<div class="text_area_mid_r"><a onclick="Toggle('myvar4');" title="Switch the Menu" class="closebtn2"><img src="hud_files/images/btn-close.png" border="0" /></a></div>
					</div>
					<div class="boxbg" style="padding:5px;"></div>
					<div id="myvar4" class="hl-2" style="padding-left:15px;">
						<div>You have a balance of <span id="community_hours" style="color:#F8FF2C;"><?php echo $sCommunityHours ?></span> in your kindness account.</div>
						<div>You have <span style="color:#F8FF2C;">Cr <span id="bank_balance">100</span></span> in your Hope Bank account.</div>
					</div>
					<div class="boxbotr"></div>
				</div>
			</div>
			<div class="clear">
				<div id='PopUp' style='display:none; position:absolute; margin:323px 0 0 -25px; background-image:url(hud_files/images/city-zoom.jpg);background-repeat:no-repeat;border: 1px solid #fefe00; width: 830px; height: 503px; z-index:100;'>
					<div style='text-align: right;'><a onmouseover='this.style.cursor="pointer" ' style='font-size: 12px;' onfocus='this.blur();' onclick="document.getElementById('PopUp').style.display = 'none';document.getElementById('out').style.display = 'none';document.getElementById('in').style.display = 'block';document.getElementById('PopUp').style.display = 'none' " ><img src="hud_files/images/btn-close.png" border="0"></a></div>
				</div>
			</div>
		</div>
		<!----------------------- Header End ------------------------------>
		<!----------------------- Middle Start ------------------------------>
		<div id="content_wrapper1">
			<div class="nav_left" style="width:282px;">
				<div class="example">
					<ul class="menu">
						<li><div class="style1" style="text-align:center;">Services</div>
							<ul>
								<li> </li>
								<li><a style="cursor:pointer;" onclick="ToggleContent('hope_main');">HopeNet Main</a></li>
								<li>
									<div id="headerDivImgS">
										<a style="cursor:pointer;" onclick="Toggle('peace_sub'); ToggleContent('peace_about');">Values Building</a>
									</div>
									<div id="peace_sub" style="display:none; height:38px;" class="boxbgleftdownS boxbgleftS">
										<span class="hl" style="cursor:pointer;" onclick="ToggleContent('peace_kindness');">Kindness</span><br />
<!--										<span class="hl" style="cursor:pointer;" onclick="ToggleContent('peace_virtues');">Values Mentoring</span><br />-->
                                                                                <span class="hl" style="cursor:pointer;" onclick="ToggleContent('mentoring');">Values Mentoring</span><br />
										<span class="hl" style="cursor:pointer;" onclick="ToggleContent('peace_spirituality');">HopeGames</span>
									</div>
								</li>
								<!--<li><a style="cursor:pointer;" onclick="ToggleContent('learning_about');">Knowledge Portal</a></li>-->
								<li>
									<div id="headerDivImgS">
										<div><a style="cursor:pointer;" onclick="Toggle('knowledge_sub'); ToggleContent('learning_about');">Knowledge Portal</a></div>
									</div>
<!--									<div id="knowledge_sub" style="display: none; height:21px;" class="boxbgleftdownS2 boxbgleftS">
										<span class="hl" style="cursor:pointer;" onclick="location='hud.php?b=<?php echo md5(uniqid(rand(), true)) ?>'">Launch Knowledge Portal</span>
									</div>-->
								</li>
								
<!--		uncomment for    old layout with submenu						<li>
									<div id="headerDivImgS">
										<div> <a id="imageDivLink21S" style="cursor:pointer;" onclick="Toggle('tutoring_sub'); ToggleContent('tutoring_about');">eTutoring</a> </div>
									</div>
									<div id="tutoring_sub" style="display:none;" class="boxbgleftdownS boxbgleftS">
										<span class="hl" style="cursor:pointer;" onclick="ToggleContent('tutoring_ini');">Instant eTutoring</span><br />
										<span class="hl" style="cursor:pointer;" onclick="ToggleContent('tutoring_private');">Private eTutoring</span><br />
									</div>
								</li>-->


                                                                    <li>
									<div id="headerDivImgS">
										<div> <a id="imageDivLink21S" style="cursor:pointer;" onclick="Toggle('tutoring_sub'); ToggleContent('tutoring_ini');">eTutoring</a> </div>
									</div>
									
								</li>
								<li>
									<div id="headerDivImgS">
										<div><a style="cursor:pointer;" onclick="Toggle('livelihood_sub'); ToggleContent('livelihood_about');">eLivelihood</a></div>
									</div>
                                                                    <!--                                                                            uncomment below code to show sub links of eLivelihood-->
								<div id="livelihood_sub" style="display:none;" class="boxbgleftdownS boxbgleftS">
										<span class="hl" style="cursor:pointer;" onclick="ToggleContent('livelihood_commissary');">Commissary</span><br />
										<!--<span class="hl" style="cursor:pointer;" onclick="ToggleContent('livelihood_store');">My eStore</span><br />-->
									</div>
								</li>
<!--								<li><a style="cursor:pointer;" onclick="ToggleContent('mentoring');">eMentoring</a></li>-->
								
								<!--<li><a style="cursor:pointer;" onclick="ToggleContent('entertainment_about');">Entertainment Portal</a></li>-->
								<li>
									<div id="headerDivImgS">
										<div><a style="cursor:pointer;" onclick="Toggle('entertain_sub'); ToggleContent('entertainment_about');">Entertainment Portal</a></div>
									</div>
									<div id="entertain_sub" style="display: none; height:21px;" class="boxbgleftdownS2 boxbgleftS">
										<span class="hl" style="cursor:pointer;" onclick="location='hud.php?e=<?php echo md5(uniqid(rand(), true)) ?>'">Launch Entertainment Portal</span>
									</div>
								</li>
								<li>
									<div id="headerDivImgS">
										<div><a style="cursor:pointer;" onclick="Toggle('learning_sub'); ToggleContent('learning');">eLearning</a></div>
									</div>
									
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<div class="mid_map">
				<div class="zoom">
					<a onmouseover='this.style.cursor="pointer" ' onfocus='this.blur();' onclick="">
						<div id="in" onclick="document.getElementById('out').style.display = 'block';document.getElementById('in').style.display = 'none';document.getElementById('PopUp').style.display = 'block'"><img src="hud_files/images/zoomin.png" border="0" alt="" /></div>
						<div id="out" style="display:none" onclick="document.getElementById('out').style.display = 'none';document.getElementById('in').style.display = 'block';document.getElementById('PopUp').style.display = 'none'"><img src="hud_files/images/zoomin-on.png" border="0" alt="" /></div>
					</a>
				</div>
				<div class="cpanel">
					<ul class="adxm menuc" id="cssonclickswitch2">
						<li><span class="mainlink">Control Panel</span>
							<ul id="cpanel_links">
								<li><a style="cursor:pointer;" onclick="$('#agesetter').fadeIn();">Set Age</a></li>
								<li><a style="cursor:pointer" id="hud_stat_refresh_new">Update Statistics <span id="stat_update"> Updated...</span></a></li>
								<li><a style="cursor:pointer;" onclick="$('#languagesetter').fadeIn();">Set Language</a></li>
								<li><a style="cursor:pointer;" onclick="$('#profilepermssetter').fadeIn();">Profile Permissions</a></li>
								
								<li><a style="cursor:pointer;" href="#" onclick="logout_kickapps();">Logout</a></li>
							</ul>
							
							<ul id="agesetter" style="display:none">
								<li>
									<br /><br />
             						<b>Change Age Group</b>
									<br /><br />
									<span id="age_notice"></span>
									<div class="ddholder">
                                    <?php
                                     if($iS_IE){
                                        $iAgeNumber = mystudies_agemanagement(false, $user->uid, ""); 
                                        $iBgcolor = 'style="background-color:#3399ff"';
                                        $iAgeOne = $iAgeNumber=='' ? $iBgcolor : '';
                                        $iAgetwo = $iAgeNumber=='7-9' ? $iBgcolor : '';
                                        $iAgethree = $iAgeNumber=='10-12' ? $iBgcolor : '';  
                                        echo '<div style="width: 200px; height: 70px; overflow-y: scroll;">
                                                <div id="sAgeGroup1" '.$iAgeOne.'><a href="javascript:void(0);" onClick="setIEAgeGroup('."'-1'".', '."'1'".')">All Age</a></div>
                                                <div id="sAgeGroup2" '.$iAgetwo.'><a href="javascript:void(0);" onClick="setIEAgeGroup('."'7-9'".', '."'2'".')">7-9 Years Old</a></div>
                                                <div id="sAgeGroup3" '.$iAgethree.'><a href="javascript:void(0);" onClick="setIEAgeGroup('."'10-12'".', '."'3'".')">10-12 Years Old</a></div>
                                              </div>';
                                      } else{
                                        echo '<select name="sAgeGroup" id="sAgeGroup">
                                                <option value="-1">All Age</option>
                                                <option value="7-9">7-9 Years Old</option>
                                                <option value="10-12">10-12 Years Old</option>
                                              </select>';                                                        
                                      }
									?>  
									</div><br />
									<a style="cursor:pointer" onclick="$('#agesetter').hide();$('#cpanel_links').fadeIn();">&lt;&lt; Back to Control Panel</a>
								</li>
							</ul>
							<ul id="languagesetter" style="display:none">
								<li>
									<br /><br />
									<b>Change Language</b>
									<br /><br />
									<span id="language_notice"></span>
									<div class="ddholder"> 
                                        <?php
                                          if($iS_IE){
                                            echo '<div style="float: right; width: 150px; height: 90px; overflow-y: auto;">
                                                    '.$sLangOptions2.'
                                                  </div>';
                                          } else{
                                            echo '<select name="sLanguage" id="sLanguage">
                                                    '.$sLangOptions.'
                                                  </select>'; 
                                            
                                          }
									   ?>
									</div><br />
									<a style="cursor:pointer" onclick="$('#languagesetter').hide();$('#cpanel_links').fadeIn();">&lt;&lt; Back to Control Panel</a>
								</li>
							</ul>
							
							<ul id="profilepermssetter" style="display:none">
								<li>
									<br /><br />
									<b>Profile Permission</b>
									<br /><br />
									<span id="profile_perms_notice"></span>
									<div class="ddholder"> 
                                        <?php
                                          echo '<select name="sProfilePerms" id="sProfilePerms">
                                                    '.$sClearanceOptions.'
                                                  </select>'; 
                                        ?>
									</div><br />
									<a style="cursor:pointer" onclick="$('#profilepermssetter').hide();$('#cpanel_links').fadeIn();">&lt;&lt; Back to Control Panel</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<div class="nav_right">
				<div class="example2">
					<ul class="adxm menur" id="cssonclickswitch">
						<li><div class="style2" style="text-align:center;">Accounts</div>
							<ul>
								<li><!--<div><a style="cursor:pointer;" onclick="SetGeneric('Communication'); ToggleContent('generic'); $('#content_breadcrumb').html('HUD &gt; Communication');">Communication</a></div></li>-->
									<div id="headerDivImgS">
										<div> <a id="imageDivLink22RIGHT" style="cursor:pointer;" onclick="Toggle('communication_sub'); ToggleContent('my_communcation_about');">Communication</a></div>
									</div>
									<div id="communication_sub" style="display: none;" class="boxbgleftdownC2 boxbgleftC">
										<span class="hl" style="cursor:pointer;" onclick="ToggleContent('message_1');">Write New Message</span><br />
										<span class="hl" style="cursor:pointer;" onclick="ToggleContent('message_2');">View Inbox</span><br />
										<span class="hl" style="cursor:pointer;" onclick="ToggleContent('message_3');">View Sent Items</span><br />
										<span class="hl" style="cursor:pointer;" onclick="ToggleContent('message_4');">Manage Contacts</span><br />
										<span class="hl" style="cursor:pointer;" onclick="ToggleContent('message_5');">Manage Blacklists</span><br />
										<span class="hl" style="cursor:pointer;" onclick="ToggleContent('message_6');">Manage Clearance</span><br />
									</div>
								</li>
								<li>
									<div id="headerDivImgS">
										<div > <a id="imageDivLink22RIGHT" style="cursor:pointer;" onclick="Toggle('kindness_sub'); ToggleContent('kindness_about');">Kindness Workz</a></div>
									</div>
									<div id="kindness_sub" style="display: none;" class="boxbgleftdownS2 boxbgleftS">
										<span class="hl" style="cursor:pointer;" onclick="ToggleContent('kindness_convert');">Convert</span><br />
										<span class="hl" style="cursor:pointer;" onclick="ToggleContent('kindness_dashboard');">Status</span><br />
										<span class="hl" style="cursor:pointer;" onclick="ToggleContent('kindness_form');">Report</span><br />
										<span class="hl" style="cursor:pointer;" onclick="ToggleContent('kindness_about');">About</span><br />
									</div>
								</li>
								<li>
									<div id="headerDivImgS">
										<div > <a id="imageDivLink21RIGHT" style="cursor:pointer;" onclick="Toggle('bank_sub'); ToggleContent('bank_about');">My eBank</a> </div>
									</div>
									<div id="bank_sub" style="display: none; height:61px;" class="boxbgleftdownS2 boxbgleftS">
										<span class="hl" style="cursor:pointer;" onclick="ToggleContent('bank_statement');">Bank Statement</span><br />
										<span class="hl" style="cursor:pointer;" onclick="ToggleContent('bank_withdraw');">Withdraw Bucks</span><br />
										<span class="hl" style="cursor:pointer;" onclick="ToggleContent('bank_deposit');">Deposit Bucks</span><br />
										<span class="hl" style="cursor:pointer;" onclick="ToggleContent('bank_loans');">Loans</span><br />
										<span class="hl" style="cursor:pointer;" onclick="ToggleContent('bank_about');">About</span><br />
									</div>
								</li>
<!--								<li><a style="cursor:pointer;" onclick="Toggle('dummy'); ToggleContent('time_tracker')">Fuel Tracking</a></li>-->
								<li>
									<div id="headerDivImgS">
										<div><a style="cursor:pointer;" onclick="Toggle('profile_sub'); ToggleContent('my_profile_about');">My Profile</a></div>
									</div>
									<!--div id="profile_sub" style="display: none; height:21px;" class="boxbgleftdownS2 boxbgleftS">
										<span class="hl" style="cursor:pointer;" onclick="ToggleContent('my_profile_kickapps');">Launch My Profile</span>
									</div-->
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!----------------------- Middle End ------------------------------>
		
		<!--  BEGIN Breadcrumb -->
		<div id="content_breadcrumb">HUD &gt; HopeNet Main</div>
		<div style="border:0px solid red; position:relative; width:99px; height:19px; left:450px; top:20px;"></div>
		<!--  END Breadcrumb -->
		
		<!-- BEGIN HopeNet Content -->
		
		<!-- Main -->
		<div id="hopenet_main_content" class="winXP" style="width:810px; margin:52px 0px 0px 95px;">
			<div id="hopenet_main" style="height:295px;">
				<div class="hopenet_main_left">
					<div class="kindness-title">HopeNet Main</div>
					<img src="hud_files/images/main_hopenet.jpg" />
				</div>
				<div class="hopenet_main_middle"></div>
				<div id="hopenet_main_text" class="hopenet_main_right" style="height:285px; overflow:auto;">
					<p>Hello, <?php echo $timetrackername; ?>. We are very happy to have you as a member of Hope Street!
					The purpose of this HopeNet Main section is to explain Hope Street, HopeNet and how your Hope Shuttle 
					Craft works, and to answer your questions.</p>
					
					<p>Hope Street has given you command of your own Hope Shuttle. 
					HopeNet is a network of Hopefuls and it is also the services and software that you are using aboard your Hope 
					Shuttle Craft. The "About HopeNet" section will give you some background info on HopeNet and your Hope Shuttle. 
					Our "HopeNet Tour" will explain and show you how the Hope Shuttle and the various HopeNet services work.  If you 
					have any questions please try our "HopeNet FAQ's" (Frequently Asked Questions). We also have a special guide and 
					companion for you called Dr. Knowledge.  Dr. Knowledge is pretty smart, he's an artificially intelligent avatar 
					and he can answer just about anything that you can ask him.</p>
					
					<p>You may click on any of the buttons in the slider below to learn more. We suggest that you begin by clicking on 
					the "About HopeNet" button.</p>
				</div>
			</div>
			
			<div id="hopenet_main_generic" style="height:295px; display:none;">
				<div class="hopenet_main_left">
					<div class="kindness-title" id="hopenet_main_generic_title"></div>
					<!--<img src="hud_files/images/main_hopenet.jpg" />-->
					<div style="pdding-top:20px;color:#fff;">
						<OBJECT id="VHSS" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,115,0" WIDTH=307 HEIGHT=253>
						<PARAM NAME="movie" VALUE="http://content.oddcast.com/vhss/vhss_v5.swf?doc=http%3A%2F%2Fvhss-d.oddcast.com%2Fphp%2FplayScene%2Facc%3D1309119%2Fss%3D1917574%2Fsl%3D0%3Fembedid%3D9fe8ee95f7b5d29b2d897a3f262a7764&acc=1309119&bgcolor=0x&embedid=9fe8ee95f7b5d29b2d897a3f262a7764">
						<PARAM NAME=quality VALUE=high>
						<param name="allowScriptAccess" value="always">
						<PARAM NAME=scale VALUE=noborder>
						<PARAM NAME=bgcolor VALUE="transparent">
						<PARAM NAME="wmode" VALUE="transparent">
						<EMBED src="http://content.oddcast.com/vhss/vhss_v5.swf?doc=http%3A%2F%2Fvhss-d.oddcast.com%2Fphp%2FplayScene%2Facc%3D1309119%2Fss%3D1917574%2Fsl%3D0%3Fembedid%3D9fe8ee95f7b5d29b2d897a3f262a7764&acc=1309119&bgcolor=0x&embedid=9fe8ee95f7b5d29b2d897a3f262a7764" swLiveConnect=true NAME="VHSS" quality=high allowscriptaccess="always" scale=noborder wmode="transparent" WIDTH=307 HEIGHT=253 TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"></EMBED>
						</OBJECT>
						<OBJECT id="VHSS" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,115,0" WIDTH=307 HEIGHT=253><PARAM NAME="movie" VALUE="http://content.oddcast.com/vhss/vhss_v5.swf?doc=http%3A%2F%2Fvhss-d.oddcast.com%2Fphp%2FplayScene%2Facc%3D2030086%2Fss%3D2152696%2Fsl%3D0%3Fembedid%3D7e907cb97a2522e27ba9523bdf6bbefc&acc=2030086&bgcolor=0x&embedid=7e907cb97a2522e27ba9523bdf6bbefc"><PARAM NAME=quality VALUE=high><param name="allowScriptAccess" value="always"><PARAM NAME=scale VALUE=noborder><PARAM NAME=bgcolor VALUE="transparent"><PARAM NAME="wmode" VALUE="transparent"><EMBED src="http://content.oddcast.com/vhss/vhss_v5.swf?doc=http%3A%2F%2Fvhss-d.oddcast.com%2Fphp%2FplayScene%2Facc%3D2030086%2Fss%3D2152696%2Fsl%3D0%3Fembedid%3D7e907cb97a2522e27ba9523bdf6bbefc&acc=2030086&bgcolor=0x&embedid=7e907cb97a2522e27ba9523bdf6bbefc" swLiveConnect=true NAME="VHSS" quality=high allowscriptaccess="always" scale=noborder wmode="transparent" WIDTH=307 HEIGHT=253 TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"></EMBED></OBJECT>
					</div>
				</div>
				<div class="hopenet_main_middle"></div>
				<div id="hopenet_main_generic_text" class="hopenet_main_right">
					<h1 style="color:#E5F031; text-align:center;">COMING SOON</h1>
				</div>
			</div>
			
			<div id="hopenet_main_generic_faq" style="height:295px; display:none;">
				<div class="hopenet_main_left">
					<div class="kindness-title" id="hopenet_main_generic_title_faq"></div>
					<!--<img src="hud_files/images/main_hopenet.jpg" />-->
					<div style="pdding-top:20px;color:#fff;">
						<OBJECT id="VHSS" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,115,0" WIDTH=280 HEIGHT=253>
						<PARAM NAME="movie" VALUE="http://content.oddcast.com/vhss/vhss_v5.swf?doc=http%3A%2F%2Fvhss-d.oddcast.com%2Fphp%2FplayScene%2Facc%3D1309119%2Fss%3D2141500%2Fsl%3D0%3Fembedid%3D0432f70ef1a4f0ed7f1b33cfd676dc40&acc=1309119&bgcolor=0x&embedid=0432f70ef1a4f0ed7f1b33cfd676dc40">
						<PARAM NAME=quality VALUE=high><param name="allowScriptAccess" value="always"><PARAM NAME=scale VALUE=noborder><PARAM NAME=bgcolor VALUE="transparent"><PARAM NAME="wmode" VALUE="transparent">
						<EMBED src="http://content.oddcast.com/vhss/vhss_v5.swf?doc=http%3A%2F%2Fvhss-d.oddcast.com%2Fphp%2FplayScene%2Facc%3D1309119%2Fss%3D2141500%2Fsl%3D0%3Fembedid%3D0432f70ef1a4f0ed7f1b33cfd676dc40&acc=1309119&bgcolor=0x&embedid=0432f70ef1a4f0ed7f1b33cfd676dc40" swLiveConnect=true NAME="VHSS" quality=high allowscriptaccess="always" scale=noborder wmode="transparent" WIDTH=280 HEIGHT=253 TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"></EMBED>
						</OBJECT>
						<OBJECT id="VHSS" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,115,0" WIDTH=307 HEIGHT=253><PARAM NAME="movie" VALUE="http://content.oddcast.com/vhss/vhss_v5.swf?doc=http%3A%2F%2Fvhss-d.oddcast.com%2Fphp%2FplayScene%2Facc%3D2030086%2Fss%3D2152696%2Fsl%3D0%3Fembedid%3D7e907cb97a2522e27ba9523bdf6bbefc&acc=2030086&bgcolor=0x&embedid=7e907cb97a2522e27ba9523bdf6bbefc"><PARAM NAME=quality VALUE=high><param name="allowScriptAccess" value="always"><PARAM NAME=scale VALUE=noborder><PARAM NAME=bgcolor VALUE="transparent"><PARAM NAME="wmode" VALUE="transparent"><EMBED src="http://content.oddcast.com/vhss/vhss_v5.swf?doc=http%3A%2F%2Fvhss-d.oddcast.com%2Fphp%2FplayScene%2Facc%3D2030086%2Fss%3D2152696%2Fsl%3D0%3Fembedid%3D7e907cb97a2522e27ba9523bdf6bbefc&acc=2030086&bgcolor=0x&embedid=7e907cb97a2522e27ba9523bdf6bbefc" swLiveConnect=true NAME="VHSS" quality=high allowscriptaccess="always" scale=noborder wmode="transparent" WIDTH=307 HEIGHT=253 TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"></EMBED></OBJECT>
					</div>
				</div>
				<div class="hopenet_main_middle"></div>
				<div id="hopenet_main_generic_text" class="hopenet_main_right">
					<h1 style="color:#E5F031; text-align:center;">COMING SOON</h1>
				</div>
			</div>
			
			<div id="hopenet_about_1st_hope_corps" style="height:295px; display:none;">
				<div class="hopenet_main_left">
					<div class="kindness-title" style="font-size:0.75em; margin-bottom:1px;">What is Hope Street</div>
					<img src="hud_files/images/main_about_hope_corps.jpg" />
				</div>
				<div class="hopenet_main_middle"></div>
				<div id="hopenet_about_1st_hope_corps_text" class="hopenet_main_right">
					<p>You have been assigned to Hope Street.  The purpose of Hope Street is to create a movement for the 
					evolution of mankind - so that they may achieve peace and prosperity.  The primary members of Hope Street are 
					know as Hopefuls. Hopefuls can be any age, race, creed or color, but the age of  enrollment for Hope Street is 
					limited to children 7 - 12 years old.  The mission of the Hopefuls is to fulfill the Hope-Prophecies by giving 
					hope, as you search for the mythical Chest-of-Hope.  Once the Chest-of-Hope is found it will then be opened so 
					that the spirit of Hope can be released upon the world.  You can help in fulfilling the prophecies by giving-hope 
					to as many people as possible during your mission.  If you and the other Hopefuls fulfill your mission of giving 
					hope then the world can one day defeat evil and achieve peace and prosperity.</p>
					
					<p>You have been given remote access to your own Hope Shuttle to help you on your mission to give hope and find 
					the Chest of Hope.  You are the pilot of your Hope Craft and with it you can travel through both time and space to 
					virtually anywhere you wish to go.  Your Hope Shuttle is based from a floating island called Hope Island, which is 
					located just outside of the earth's atmosphere. The location of Hope Island is a secret and it has been cloaked 
					and shielded from earth to protect it from the forces of evil.  Your Hope Shuttle is currently orbiting Hope 
					Island and its orbit cannot be altered, nor can it be piloted to another location or another time-dimension until 
					you have completed  your training and evolution.  However until then, you will be able to remotely access HopeNet 
					and all of it's services.</p>
					
					<p>HopeNet is the software that provides all the services aboard the Hope Shuttle and it also allows you access 
					the network to communicate and work with the other Hopefuls.  To learn more about your HopeNet services just go to 
					the "HopeNet Services" menu on your Hope Shuttle HUD (Heads Up Display).</p>
				</div>
			</div>
			
			<div id="hopenet_about_shuttle" style="height:295px; display:none;">
				<div class="hopenet_main_left">
					<div class="kindness-title" style="font-size:0.6em; margin-bottom:4px;">How does the Hope Shuttle work</div>
					<img src="hud_files/images/main_about_shuttle.jpg" />
				</div>
				<div class="hopenet_main_middle"></div>
				<div id="hopenet_about_shuttle_text" class="hopenet_main_right">
					<p>Your Hope Shuttle is a USTV (Unmanned Space-Time Vehicle).  You can operate it remotely from any computer on 
					earth that is connected to the Internet.  Your USTV operates in a similar way to the earths  UAV's 
					(Unmanned Aerial Vehicles) <a href="http://en.wikipedia.org/wiki/Unmanned_aerial_vehicle" target="_blank" style="color:#E5F031;">http://en.wikipedia.org/wiki/Unmanned_aerial_vehicle</a>.  However your USTV is far more 
					advanced than a UAV because it is used for peace instead of war like the UAV, and your USTV can also travel 
					through both time and space.</p>
					
					<p>Your Hope Shuttle and HopeNet is powered by a very special fuel called - hope.  In fact the shuttle can only be 
					fueled by hope.  You can create hope to fuel your shuttle by  performing Workz of Kindness through the HopeNet 
					Peace Building Program. Once you have performed the Kindness Workz then the hope that you have created can be used 
					to power the shuttle.  The amount of hope available to fuel the shuttle is measured in units and the shuttle 
					consumes 5 Hope Units per hour. In effect each hour of your Kindness Workz provides the shuttle with one hour of 
					fuel. To learn more about the Kindness Workz program see Peace Building in the Services Menu of the HUD.</p>
					
					<p>As a Hopeful and a member of Hope Street you are part of a global community, but you are not separate from 
					your local community or your family. You must work, play and go to school within your local community, and obey 
					and be respectful of your parents. You are expected to participate both globally and locally, and to make your 
					community and your world a better place to live in for everyone.</p>
				</div>
			</div>
			
			<div id="hopenet_about_hopenet" style="height:295px; display:none;">
				<div class="hopenet_main_left">
					<div class="kindness-title" style="font-size:0.6em; margin-bottom:4px;">How does the HopeNet work</div>
					<img src="hud_files/images/main_hopenet.jpg" />
				</div>
				<div class="hopenet_main_middle"></div>
				<div id="hopenet_about_hopenet_text" class="hopenet_main_right">
					<p>Your mission of hope also requires you to embark on a quest for both wisdom and knowledge. To support your 
					hope mission and help you obtain wisdom and knowledge your Hope Shuttle has been equipped with many HopeNet 
					services including eTutoring, eMentoring, and most importantly the Knowledge Portal.  If you qualify you will also 
					receive tuition and scholarship assistance programs.</p>
					
					<p>Your Hope Shuttle has been equipped with a very special service called the Knowledge Portal. The Knowledge 
					Portal has been connected to the earths Internet and it will give you access to virtually all knowledge on earth. 
					It's been said that "all work and no play makes Jack & Jill very dull" so that's why we have also created the 
					Entertainment Portal so that you can also have some fun while you are on your mission. To learn more about 
					HopeNet services see the "HopeNet Services" menu on the HUD.</p>
					
					<p>The Hope Shuttle fleet and the HopeNet services being offered to you and the other Hopefuls requires a large 
					investment in financial and human resources.  These HopeNet services are not free of charge and you are expected 
					to pay for your share of the services that you use.  However, you will not be charged any money, to use the 
					HopeNet services.  Instead... as a member of Hope Street you are part of a very special and unique economic 
					system that issues its own currency.  This economic system is based upon Hope, and the currency called the Hope 
					Buck is backed by Kindness. You can earn a wage in Hope Bucks through the Kindness Workz program and you can spend 
					your Hope Bucks to pay for your share of the HopeNet services.  The Hope Development Bank has also provided you 
					with your very own bank account, where you can deposit and withdraw your Hope Bucks. To learn more about your bank 
					account, and the hope economic system look for banking under the Accounts Menu of the HUD.</p>
					
					<p>In order for you to best perform your hope mission and your quest for wisdom and knowledge; you will need to 
					obtain additional resources.  You will need these resources to support your education and yourself, and to become 
					a more productive member of your family.  To obtain these additional resources you must prove yourself to the Hope 
					Corps, and once you do that you will be given access to  HopeNet's eLivelihood, and Sponsoring services. To learn 
					more about the eLivelihood and Sponsoring services see the "HopeNet Services" menu on the HUD.</p>
				</div>
			</div>
			
			<div id="hopenet_about_why_hope_corps" style="height:295px; display:none;">
				<div class="hopenet_main_left">
					<div class="kindness-title">Why Hope Street</div>
					<img src="hud_files/images/main_about_why_hope_corps.jpg" />
				</div>
				<div class="hopenet_main_middle"></div>
				<div id="hopenet_about_why_hope_corps_text" class="hopenet_main_right">
					<p>There is a battle raging now on earth between good and evil, and the stakes are for the souls of man and the 
					destiny of mankind. Evil has tipped the balance, and war, poverty, hunger, hate and greed are threatening to 
					become the norm of our existence rather than the exception. Mankind is approaching a precipice and if we do not 
					evolve for the good before we reach the precipice then all shall be lost.</p>
					
					<p>Evil people die, but their evil can live on. Evil itself cannot be defeated through war, and perhaps one of 
					evils greatest victories was to convince good people that the battle of good and evil should be waged on the 
					battlefields and on the streets; however the only place that we can truly engage and defeat evil is within the 
					hearts of man.</p>
					
					<p>There is still much good in the world, and there are many virtues we can use to battle evil such as faith, love, 
					kindness and hope, but the pillar of good is hope and hope has been severally weakened.  With hope all things are 
					possible, but without it then evil wins and all is lost.</p>
					
					<p>According to the "Legend of Hope" the last chance for mankind to turn the battle against evil and begin to rid 
					the world of famine, poverty, war, hate, greed etc;  is for the Hopefuls to give hope to all that they meet and to 
					find the Chest of Hope and release the spirit of hope from within it. However, it is also said that an angel is 
					guarding the Hope-Chest, and only an uncorrupted person will be able to open the Hope - Chest.</p>
				</div>
			</div>
			
			<div id="hopenet_about_legend" style="height:295px; display:none;">
				<div class="hopenet_main_left">
					<div class="kindness-title">The Legend of Hope</div>
					<img src="hud_files/images/main_about_legend.jpg" />
				</div>
				<div class="hopenet_main_middle"></div>
				<div id="hopenet_about_legend_text" class="hopenet_main_right">
					<p>Long... long ago mankind was given a very special chest for safekeeping, and was told to never open it. One day 
					Pandora, the guardian of the chest was overcome with curiosity and decided to take a quick peek inside. Pandora 
					opened the lid and was shocked to see all the evils of the world inside... hate, war, disease, hunger, poverty 
					and rage. Pandora quickly closed the lid, but it was to late, for all the evil spirits had already escaped into 
					the world. Sadly, one spirit did not escape, and until this day it remains inside the chest, and that is the 
					Spirit of Hope!...</p>
					
					<p>Since that day, evil has plagued mankind unchecked, and the Spirit of Hope has stayed locked inside the chest. 
					However, all is not lost - for it is prophesied that: "the Hopefuls will walk the earth and give hope to mankind; 
					the uncorrupted will release the spirit of hope upon the world... and a child will lead them."</p>
				</div>
			</div>
			
			<div class="clear"></div>
			
			<div id="hopenet_main_slider" style="margin:80px 0px 0px 10px;">
				<div style="float:left; width:190px; cursor:pointer;" onclick="ToggleContent('hope_about_1st_hope_corps')"><img src="hud_files/images/temp_hopenet_main_about.jpg" /></div>
				<div style="float:left; width:190px; cursor:pointer; margin-left:10px;" onclick="ToggleContent('hope_main_generic'); $('#content_breadcrumb').html('HUD &gt; HopeNet Tour'); $('#hopenet_main_generic_title').text('HopeNet Tour');"><img src="hud_files/images/temp_hopenet_main_tour.jpg" /></div>
				<div style="float:left; width:190px; cursor:pointer; margin-left:10px;" onclick="ToggleContent('hope_main_generic_faq'); $('#content_breadcrumb').html('HUD &gt; HopeNet FAQ\'s'); $('#hopenet_main_generic_title_faq').text('HopeNet FAQ\'s');"><img src="hud_files/images/temp_hopenet_main_faq.jpg" /></div>
				<div style="float:left; width:190px; cursor:pointer; margin-left:10px;" onclick="ToggleContent('hope_main_generic'); $('#content_breadcrumb').html('HUD &gt; Ask Dr. Know'); $('#hopenet_main_generic_title').text('Ask Dr. Know');"><img src="hud_files/images/temp_hopenet_main_dr.jpg" /></div>
			</div>
			
			<div id="hopenet_about_slider" style="margin:70px 0 0 -2px; display:none;">
				<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="820" height="113" id="hopenet_about_slider" align="middle">
					<param name="allowScriptAccess" value="sameDomain" />
					<param name="allowFullScreen" value="false" />
					<param name="movie" value="hud_files/slider_hopenet_about.swf" />
					<param name="quality" value="high" />
					<param name="wmode" value="transparent" />
					<param name="bgcolor" value="#333333" />
					<embed src="hud_files/slider_hopenet_about.swf" quality="high" wmode="transparent" bgcolor="#333333" width="820" height="113" name="carousel" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
				</object>
			</div>
		</div>
		<!-- Main -->
		
		<!-- END HopeNet Content -->
		
		<!-- BEGIN Knowledge Portal Content -->
		
		<!-- Carousel -->
		<div id="carousel_content" style="display:none;">
			<iframe id="hud_google_news" src=""
				frameborder="0" width="728" height="90" scrolling="no" marginwidth="0" marginheight="0" style="display:none; position:absolute; margin:100px 0 0 40px;"></iframe>
		<?php /*jaz - added */ 
		if(isset($_GET['b']) && isset($_GET['mainpath'])){ ?>
			<div style="display:block;" class="elearning-zoomer"><a onclick="Toggle('learning_sub'); ToggleContent('learning');" style="cursor:pointer;">Return to eLerning</a></div>
		<?php } /* end jaz - added */?>
			<div id="Carousel" style="height:295px; margin-left: -215px;">
			
				<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="1239" height="609" id="carousel_main" align="middle">
					<param name="allowScriptAccess" value="sameDomain" />
					<param name="allowFullScreen" value="false" />
					<param name="movie" value="hud_files/carousel.swf" />
					<param name="quality" value="high" />
					<param name="wmode" value="transparent" />
					<param name="bgcolor" value="#333333" />
					<embed src="hud_files/carousel.swf" quality="high" wmode="transparent" bgcolor="#333333" width="1239" height="609" name="carousel_main" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
				</object>
			</div>
			<div class="clear"></div>
		</div>
		<?php /*jaz - added */ 
		if(isset($_GET['b']) && isset($_GET['mainpath'])){
 $iParent = $_GET['mainpath'];
 $sParents = $_GET['parentpath'];
$sTreeMenuDatae = mystudies_buildTreeMenu($iParent,$sParents); ?>
 <div style='visibility: hidden;'><?php print_r($sTreeMenuDatae);?> </div>
<?php  }
 /*jaz - end */ ?>
 
		<!-- Carousel -->
		
		<!-- Tree Menu -->
		<div id="tree_menu" class="winXP">
        	<div id="tree_screen">
				<b>Choose a Category</b>
				<?php echo $sTreeMenuData; ?>
            </div>
        </div>
        <div id="content_wrapper4"></div>
		<div id="content_wrapper5"></div>
        <div id="toggle_buttons">
			Select Display Modes :
            <input id="btnToggleTree" onclick="hideCarousel(true);" type="button" value="Tree Menu" />
            <input id="btnToggleCarousel" onclick="hideCarousel(false);" type="button" value="Carousel" />
        </div>
		<!-- Tree Menu -->
		
		<!-- About -->
		<div class="wrapper-kindness winXP" id="learning_about">
			<div class="wrapper-kindness01">
				<div class="kindness-title">Knowledge Portal</div>
				<div class="learning-about-image" style="margin-bottom:31px;"></div>
                                <!--<div style="display:none;" id="knowledge_sub_text"></div>--> <!-- by Jed Diaz -->
				<div class="tutering-content01" style="padding-top:0; width:295px; height:243px; overflow:auto;">
					<p>Knowledge is defined as: "the sum of what is known". Knowledge is the most valuable commodity on earth 
					(save wisdom) and is the key factor in determining success.</p>
					
					<p>The wonderful thing about knowledge is that in order to possess it we do not need to manufacture or create it, 
					we can in fact assimilate or absorb the Knowledge that has been created by others and pass it on. The goal of the 
					Knowledge Portal is to present the Hopefuls with the sum of the very best of all available human knowledge.</p>
					
					<div style="color:#FFF200;" align="center">
						<div class="buttonbg"><a><span><h2 style="cursor:pointer;" onclick="location='hud.php?b=<?php echo md5(uniqid(rand(), true)) ?>'">Launch Knowledge Portal</h2></span></a></div>
                                            <!--<div class="buttonbg" style="cursor:auto;"><a style="cursor:auto;"><span><h2 style="cursor:auto;" >Launch Knowledge Portal</h2></span></a></div>-->
					</div>
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="bank-r">
					<div class="tuter_main_top_bg">
						<div class="welcm_tutor_top_btn_arae">	
							<div class="welcm_tutor_top_btn" style="font-size:0.8em">Welcome to the Knowledge Portal</div>
						</div>
						<div class="hud_main_content" id="knowledge_main_text" style="height:473px; width:455px; overflow:auto;">
						<!--<img style=" z-index:100;position:absolute;height: 120px;margin-left: 90px;top: 135px;" src="hud_files/images/under_construction_site.png" border="0" alt="" />	-->
                                                    <p>The Knowledge Portal is your own virtual library and a portal to the trillion+ pages of information on 
							the earth's Internet. It provides you with instant access to the best of the best educational websites, 
							videos, books/reports, images, animations, designed especially to assist you with your studies. All major 
							subjects are covered including science, math, language, social studies, technology, etc.</p>
							
							<p>To get started just click on the "Launch Knowledge Portal" button on this page. You will then see a list 
							of subject categories.  Click on the subject of your choice and you will then see a list of sub-categories. 
							Click on the sub-category of your choice and you will then be given the option of selecting content such as: 
							Websites - Images - Videos - Books/Reports - Animations - News. If you hover your mouse-cursor over a 
							subject then you will see a description of that subject. You can also browse through the Tags to find the 
							subject and category of your choice.</p>
							
							<p>The content (website - image - book etc) of your choice will be displayed inside of a special frame. This 
							frame contains the name of the Volunteer that recommended the content and it also has a rating of the content. 
							After you have studied the content, please take the time to rate it yourself, we will use your rating to 
							improve the Knowledge Portal.</p>
							
							<p>The websites (including the text, images, videos, books, etc.) that you will see has been personally 
							recommended and screened by HopeNet volunteers from all over the world. However, the websites are not owned 
							or operated by HopeNet and HopeNet is not responsible for the content, practices, or privacy policies of the 
							owners - providers of the website.</p>
							
							<p>If something bad, creepy, or mean happens, leave the website immediately and report it to HopeNet.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- About -->
		
		<!-- END Knowledge Portal Content -->
		
		<!-- BEGIN Entertainment Portal Content -->
		
		<!-- Entertainment Carousel -->
		<div id="entertainment_content" style="display:none;">
			<div id="Entertainment_Carousel" style="height:295px; margin-left: -215px;>
				<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="1239" height="609" id="entertainment_carousel" align="middle">
					<param name="allowScriptAccess" value="sameDomain" />
					<param name="allowFullScreen" value="false" />
					<param name="movie" value="hud_files/entertainment_carousel.swf" />
					<param name="quality" value="high" />
					<param name="wmode" value="transparent" />
					<param name="bgcolor" value="#333333" />
					<embed src="hud_files/entertainment_carousel.swf" quality="high" wmode="transparent" bgcolor="#333333" width="1239" height="609" name="entertainment_carousel" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
				</object>
			</div>
			<div class="clear"></div>
		</div>
		<!-- Tree Menu -->
		
		<div id="etree_menu" class="winXP">
        	<div id="etree_screen">
				<b>Choose a Category</b>
				<?php echo $sETreeMenuData; ?>
            </div>
        </div>
		<div id="entertainment_content_wrapper4"></div>
		<div id="entertainment_content_wrapper5"></div>
		<div id="toggle_ebuttons">
			Select Display Modes :
            <input id="btnToggleTree" onclick="hideECarousel(true);" type="button" value="Tree Menu" />
            <input id="btnToggleCarousel" onclick="hideECarousel(false);" type="button" value="Carousel" />
        </div>
		<!-- Tree Menu -->
		<!-- Entertainment Carousel -->
		
		<!-- About -->
		<div class="wrapper-kindness" id="entertainment_content_about">
			<div class="wrapper-kindness01">
				<div class="kindness-title">Entertainment Portal</div>
				<div class="learning-about-image" style="background-image:url(hud_files/images/entertainment_img.jpg);"></div>
				<div class="tutering-content01">
					<div style="color:#FFF200;" align="center">
					<div class="buttonbg"><a><span><h2 style="cursor:pointer;" onclick="location='hud.php?e=<?php echo md5(uniqid(rand(), true)) ?>'">Launch Entertainment Portal</h2></span></a></div>
					</div>
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="bank-r">
					<div class="tuter_main_top_bg">
						<div class="welcm_tutor_top_btn_arae">	
							<div class="welcm_tutor_top_btn" style="font-size:0.75em">Welcome to the Entertainment Portal</div>
						</div>
						<div class="hud_main_content">
							<p>The Entertainment Portal will provide you with a wide variety of recreational activities such as social 
							networking, games, music, videos, books, and online-TV etc.  The entertainment activities are provided as a 
							reward for your help with HopeNet activities such as Kindness Workz, and Community Building.</p>
							
							<p>You can participate in the entertainment either individually or as part of a group of Hopefuls. For 
							Example: We will feature brain games including chess, checkers etc, but you can also play some video style 
							games so long as they are not violent.</p>
							
							<p>In the near future we will also provide customizable, intelligent Avatars and Virtual Worlds where you 
							can build your own home, city or even your own world.</p>
							
							<p>All of the entertainment activities are played through HopeNet on your Hope Shuttle, and your Hope 
							Shuttle needs fuel to operate.  So don't forget to use your Hope Bucks to buy fuel so you can enjoy 
							yourself and not be interrupted.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- About -->
		<!-- END Entertainment Portal Content -->
		
		<!-- BEGIN Livelihood -->
		
		<!-- Store -->
		<div class="wrapper-kindness" id="livelihood_content_store" style="height:600px;">
			<div class="wrapper-kindness01">
				<iframe id="livelihood_store_frame" src="" style="display:none; position:relative; top:-13px; left:-15px; width:820px; height:/*563px*/970px; border:0px solid red;"></iframe>
				<iframe id="livelihood_commissary_frame" src="" style="display:none; position:relative; top:-13px; left:-15px; width:820px; height:1030px; border:0px solid red;"></iframe>
			</div>
			<div class="wrapper-bank-r"></div>
		</div>
		<!-- Store -->
		
		<!-- About -->
		<div class="wrapper-kindness" id="livelihood_content_about">
			<div class="wrapper-kindness01">
				<div class="kindness-title">Livelihood</div>
				<div class="livelihood-about-image"></div>
				<div class="tutering-content01">
					The purpose of the eLivelihood program is to encourage entrepreneurship and responsible purchasing of products. 
					HopeNet has several eLivelihood programs including our My-eStore program, eCommissary and our Online Advertising 
					revenue program. One of our primary goals is to help you to learn to financial and business skills and become 
					financially self supporting.  
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="bank-r">
					<div class="tuter_main_top_bg">
						<div class="welcm_tutor_top_btn_arae">	
							<div class="welcm_tutor_top_btn">Welcome to eLivelihood</span></div>
						</div>
						<div class="welcm_tutor_top_txt" style="color:#54EC1A; font-size:0.8em; margin:20px 0 0 10px; width:450px;">
							<!--<div>Go to <u><a href="javascript:void(0);" onclick="ToggleContent('livelihood_store');" style="color:#FFF200; font-size:0.9em; font-weight:bold;">My eStore</a></u>.</div>
							<div>Go to <u><a href="javascript:void(0);" onclick="ToggleContent('livelihood_commissary');" style="color:#FFF200; font-size:0.9em; font-weight:bold;">Commissary</a></u>.</div>-->
							<p>Coming Soon... As a hopeful you will have access to our eCommissary where you can use your Hope-Bucks to 
							purchase products and down-loadable goods such as school supplies, computer electronics, books and some 
							entertainment items. The products will be provided by HopeNet sponsors who are more than happy to lend a 
							helping hand to Hopefuls such as yourself who are helping themselves and their community. We will notify 
							you once the eCommissary is opened for business.</p>
<!--uncomment below code to show link -->
							<div class="buttonbg3"><a><span><p style="cursor:pointer; color:#FFF200; font-weight:bold;" align="center" onclick="ToggleContent('livelihood_commissary');">Click here to see a demonstration of the eCommissary.</p></span></a></div>
							<!--<div class="buttonbg3"><a style="cursor: auto;"><span><p style="cursor: auto; color:#FFF200; font-weight:bold;" align="center" >Click here to see a demonstration of the eCommissary.</p></span></a></div>
                                                        <br/><br/><br/>
							 <img style=" z-index:100;position:absolute;height: 120px;margin-left: 65px;" src="hud_files/images/under_construction_site.png" border="0" alt="" />-->
							<p>After having been enrolled in HopeNet for a period of time and meeting the minimum requirements,
							we will also provide you with your own online store through our My-eStore program. My eStore allows you to
                                                       
							sell down-loadable goods that you create such as artwork, music, videos, etc. All transactions are made 
							using Hope-Bucks, which are purchased by volunteers and other supporters who wish to buy your creations. We 
							will notify you once when you are eligible to receive your own the mt eStore.</p>
			<!--uncomment below code to show link -->				
<!--							<div class="buttonbg3"><a><span><p style="cursor:pointer; color:#FFF200; font-weight:bold;" align="center" onclick="ToggleContent('livelihood_store');">Click here to see a demonstration of the My eStore.</p></span></a></div>-->
                                                        <div class="buttonbg3"><a style="cursor: auto;"><span><p style="cursor:auto; color:#FFF200; font-weight:bold;" align="center" >Click here to see a demonstration of the My eStore.</p></span></a></div>
							<br/><br/><br/>
							
							<p>When you become eligible you will also be provided with your own Advertising revenue program, which you 
							can use to run online advertisements in your My-eStore and your Virtual Community pages. The funds from the 
							Advertising revenue program will be deposited in a trust account for you and released after a predetermined 
							period of time.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- About -->
		
		<!-- END Livelihood -->
		
		<!-- BEGIN Bank Content --> 
		<div class="wrapper-bank winXP" id="bank_content_about">
			<div class="wrapper-bank01">
				<div class="bank-title">About</div>
				<div class="bank-image" style="margin-bottom:35px;"></div>
				<div id="bank_about_text" class="bank-content01" style="margin-top:0px; width:287px; height:235px; overflow:auto;">
					<p>My eBank is your own personal bank account, which is being provided by the Hope Development Bank. Your 
					account is where you will deposit and withdraw your Hope-Bucks and it will also keep track of your online spending. 
					You and the other Hopefuls are paid Hope-Bucks for your Kindness Workz, and you can also earn Hope-Bucks through 
					other activities such as the eLivelihood program. You can spend your Hope-Bucks in exchange for fuel for your Hope 
					Shuttle and time spent using the eTutoring, the eCommissary and other services. You may also apply for a Hope 
					Bucks micro-loan once you are eligible.</p>
					
					<p>To learn more about the Hope Economy and how you can spend, earn, and borrow Hope Bucks, click the "Hope Economy" 
					button.</p>
					
					<div style="color:#FFF200;" align="center">
					<div class="buttonbg2"><a><span><h2 style="cursor:pointer;" onclick="ToggleContent('bank_economy');">Hope Economy</h2></span></a></div>
					</div>
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="bank-r">
					<div class="box01">About Hope Banking</div>
					<div class="box02">
						<div class="in-box1">Balances:</div>
						<div class="in-box2"><span id="bank_balance"></span> Hope Bucks</div>
					</div>
				</div>
				<div class="bank-account">
					<div class="bank-account-title">My Bank Account</div>
					<div class="bank-account-content">
						<div class="bank-account-content01">
							<table width="450" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="30%">Account Number</td>
									<td width="10%">Balances</td>
									<td width="20%">&nbsp;</td>
									<td width="40%">Bank Name</td>
								</tr>
								<tr>
									<td colspan="4" class="hrbg"> </td>
								</tr>
								<tr>
									<td><span id="bank_account"></span></td>
									<td>Balance</td>
									<td Style="text-align:right; padding-right:5px;"><span id="bank_balance"></span></td>
									<td>Hope Development Bank</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>Pending</td>
									<td Style="text-align:right; padding-right:5px;"><span id="bank_pending"></span></td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>Turnover</td>
									<td Style="text-align:right; padding-right:5px;"><span id="bank_turnover"></span></td>
									<td>&nbsp;</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div class="bank-services">Overview of Services</div>
				<div class="bank-content02">
					<div class="bank-content03">
						<p>Your My eBank account works just like a real bank account and it provides you with four services including 
						your Bank Statement, Withdraw Bucks, Deposit Bucks and Micro-Loans. To make a deposit or to withdraw  Hope 
						Bucks from your My eBank account just click on the links below or in the HopeNet Accounts menu. If you would 
						like to see a history of all of your deposits and withdrawals of Hope Bucks then just click on the Bank 
						Statement link.</p>
						
						<p>The first time that you check your bank statement you will notice your beginning balance is HB5 (five Hope 
						Bucks).  The five Hope Bucks were loaned to you by the Hope Development Bank, and in the future you will need 
						to be repay the loan.</p>
						
						<p>You may also apply to the Hope Development Bank for a micro-loan to help pay for your HopeNet services such 
						as eTutoring, eMentoring and Sponsoring.</p>
						
						<p>To learn more about each of these services, just click on one of the Quick Links below.</p>
					</div>
				</div>
				
				<div class="hud_bank_quick_links">
					<div class="hud_bank_quick_links_left" style="width:75px;">Quick Links:</div>
					<div class="hud_bank_quick_links_right">
						<div class="hud_bank_quick_links_right_links" style="width:123px;" onclick="ToggleContent('bank_statement');">Bank Statement</div>
						<div class="hud_bank_quick_links_right_links" style="width:90px;" onclick="ToggleContent('bank_withdraw');">Withdraw Bucks</div>
						<div class="hud_bank_quick_links_right_links" style="width:80px;" onclick="ToggleContent('bank_deposit');">Deposit Bucks</div>
						<div class="hud_bank_quick_links_right_links" style="width:40px;" onclick="ToggleContent('bank_loans');">Loans</div>
						<div class="hud_bank_quick_links_right_links" style="width:40px;color:#FFF200;" onclick="ToggleContent('bank_about');">About</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Bank Statement -->
		<div class="wrapper-bank" id="bank_content_statement">
			<div class="wrapper-bank01">
				<div class="bank-title">Bank Statement</div>
				<div class="bank-image02"></div>
				<div class="bank-content01">
					<p>Your Bank Statement provides you with a history of all your My eBanking transactions, including deposits, 
					withdrawals and loans of your Hope Bucks.  You bank statement provides you with your account balance, the 
					description, amount, and the date and time of each transaction.</p>
					
					<p>Every time that you do a transaction you should check your bank statement to make sure that it is correct. If 
					you see any problems or errors with your bank statement then you should report it immediately to HopeNet.</p>
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="bank-r">
					<div class="box01">Bank Statement</div>
					<div class="box02">
						<div class="in-box1">Balances:</div>
						<div class="in-box2"><span id="bank_balance"></span> Hope Bucks</div>
					</div>
				</div>
				<div class="bank-account-statement">
					<div class="bank-account-title"></div>
					<div class="bank-account-content">
						<div id="bank_statement_list" class="bank-account-content01"></div>
					</div>
				</div>
				
				<div class="hud_bank_quick_links">
					<div class="hud_bank_quick_links_left" style="width:75px;">Quick Links:</div>
					<div class="hud_bank_quick_links_right">
						<div class="hud_bank_quick_links_right_links" style="width:123px; color:#FFF200;" onclick="ToggleContent('bank_statement');">Bank Statement</div>
						<div class="hud_bank_quick_links_right_links" style="width:90px;" onclick="ToggleContent('bank_withdraw');">Withdraw Bucks</div>
						<div class="hud_bank_quick_links_right_links" style="width:80px;" onclick="ToggleContent('bank_deposit');">Deposit Bucks</div>
						<div class="hud_bank_quick_links_right_links" style="width:40px;" onclick="ToggleContent('bank_loans');">Loans</div>
						<div class="hud_bank_quick_links_right_links" style="width:40px;" onclick="ToggleContent('bank_about');">About</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Bank Statement -->
		<!-- Bank Withdraw -->
		<div class="wrapper-bank" id="bank_content_withdraw">
			<div class="wrapper-bank01">
				<div class="bank-title">Withdraw Bucks</div>
				<div class="bank-image03"></div>
				<div class="bank-content01" style="font-size:0.75em;">
					<p>You can withdraw Hope Bucks at any time from your My eBank account and send them to another Hopeful, or you can 
					make a withdrawal to buy fuel for your Hope Shuttle. In the future you will be able to withdraw Hope Bucks and pay 
					for purchases through the Hope Commissary and also pay for your eMentoring and eTutoring.</p>
					
					<p>Using the Withdrawal service on this page you may only purchase fuel and send HopeBucks to another Hopeful. All 
					withdrawals are final and you will not receive a refund from HopeNet if you change your mind, so be careful how 
					you spend your Hope Bucks.</p>
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="w-bg">
					<table width="500" border="0" cellspacing="0" cellpadding="0">
						<tr></tr>
						<tr>
							<td width="135">
								<div class="box03">Send Bucks</div>
								<div class="bank-services">How to Send Bucks</div>
								<div class="bank-content04">
									You may send Hope Bucks to any Hopeful. Type in the amount you wish to send to the Hopeful recipient 
									along with the recipients bank account number and then click on the "Send" button. The bucks will be 
									sent immediately.
								</div>
							</td>
							<td width="265" style="vertical-align:top; padding-left:5px;">
								<table width="378" border="0" cellspacing="0" cellpadding="3px">
									<tr>
										<td width="378" style="width:100px; height: 20px; font-family:Arial, Helvetica, sans-serif;
		font-size:11px; color:#54ec1a; font-weight:bold">Amount:<span style="font-family:Arial, Helvetica, sans-serif;
		font-size:11px; color:#e5f031; font-weight:bold">*</span></td>
									</tr>
									<tr>
										<td>
											<input style=" background-color:#51644c; border:#e5f031 solid 1px; width:150px; height: 20px; font-family:Arial, Helvetica, sans-serif;
		font-size:11px; color:#54ec1a;" id="mBankSendAmount" name="mBankSendAmount" type="text" />
										</td>
									</tr>
									<tr>
										<td style="width:300px; height: 20px; font-family:Arial, Helvetica, sans-serif;
		font-size:11px; color:#54ec1a">The amount to be sent to recipient</td>
									</tr>
									<tr>
										<td style="width:300px; height: 20px; font-family:Arial, Helvetica, sans-serif;
		font-size:11px; color:#54ec1a; font-weight:bold">Account Number:<span style="font-family:Arial, Helvetica, sans-serif;
		font-size:11px; color:#e5f031; font-weight:bold">*</span></td>
									</tr>
									<tr>
										<td>
											<div style="float:left; width:51px;"><span style="width:50px;height:20px; float:left">
												<input style=" background-color:#51644c; border:#e5f031 solid 1px; width:50px; height: 20px; font-family:Arial, Helvetica, sans-serif;
		font-size:11px; color:#54ec1a;" id="sBankToAccount1" name="sBankToAccount1" type="text" />
												</span></div>
											<div style="float:left; width:10px; text-align:center;"><span style="font-family:Arial, Helvetica, sans-serif;
		font-size:11px; color:#e5f031; font-weight:bold">-</span></div>
											<div style="float:left; width:80px;">
												<input style=" background-color:#51644c; border:#e5f031 solid 1px; width:100px; height: 20px; font-family:Arial, Helvetica, sans-serif;
		font-size:11px; color:#54ec1a;" id="sBankToAccount2" name="sBankToAccount2" type="text" />
											</div>
										</td>
									</tr>
									<tr>
										<td style="clear:both; width:350px; height: 20px; font-family:Arial, Helvetica, sans-serif;
		font-size:9px; color:#54ec1a; padding-top: 3px">The account number of the recipient in this format ABCD-123456789</td>
									</tr>
									<tr>
										<td>
											<div style="width:30px; float:left">
												<input name="bBankForTrueCafe" type="checkbox" value="" style=" background-color:#51644c; border:#e5f031 solid 1px" />
											</div>
											<div style="float:left; width:300px; height: 20px; font-family:Arial, Helvetica, sans-serif;
		font-size:11px; color:#54ec1a; font-weight:bold">Bucks for deposit to my hope Cybrary Account</div>
										</td>
									</tr>
									<tr>
										<td>
											<input id="btnBankWithdrawSend" name="btnBankWithdrawSend" type="button" value="Send" onmouseover="this.style.color='#FFFFFF'" onmouseout="this.style.color='#e5f031'" style="background:url(./hud_files/images/buttonbg.jpg); cursor:pointer; border:#FFFFFF solid 1px; width:50px; height: 20px; font-family:Arial, Helvetica, sans-serif;	font-size:11px; color:#e5f031"/>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</div>
				<div>
					<div class="bank-account-title"></div>
					<div class="bank-account-content">
						<div></div>
					</div>
				</div>
				<div class="bank-services"></div>
<!--                                code for <div class="w-bg"> commented for not showing Fuel section -->
<!--				<div class="w-bg">
					<table width="500" border="0" cellspacing="0" cellpadding="0">
						<tr></tr>
						<tr>
							<td width="135">
								<div class="box03">Buy Fuel</div>
								<div class="bank-services">How to Buy Fuel</div>
								<div class="bank-content04">
									First check the amount of fuel that you have left in your Hope Shuttle, and decide how much fuel you 
									want to buy. The choose the amount of fuel from the Fuel Blocks, and then click on 
									"Buy Selected Fuel Block" button. The fuel will be added immediately to your shuttle.
								</div>
							</td>
							<td width="265" style="vertical-align:top; padding-left:5px;">
								<table width="378" border="0" cellspacing="0" cellpadding="3px">
									<tr>
										<td width="378" style="width:100px; height: 20px; font-family:Arial, Helvetica, sans-serif;
		font-size:11px; color:#54ec1a; font-weight:bold">Information</td>
									</tr>
									<tr>
										<td style="width:300px; height: 20px; font-family:Arial, Helvetica, sans-serif;
		font-size:9px; color:#54ec1a">You have <span id="bank_balance"></span> Hope Bucks in your account</td>
									</tr>
									<td style="width:300px; height: 20px; font-family:Arial, Helvetica, sans-serif;
		font-size:9px; color:#fff200"><span id="time_tracker_credit"></span></td>
									</tr>
									<tr>
										<td style="width:300px; height: 20px; font-family:Arial, Helvetica, sans-serif;
		font-size:11px; color:#54ec1a; font-weight:bold">Fuel Blocks:<span style="font-family:Arial, Helvetica, sans-serif;
		font-size:11px; color:#e5f031; font-weight:bold">*</span></td>
									</tr>
									<tr>
										<td>
											<div style="float:left; width:50px;">
											<label>
												<select name="iBankTimeBlock" id="iBankTimeBlock" style=" background-color:#51644c; border:#e5f031 solid 1px; width:220px; height: 20px; font-family:Arial, Helvetica, sans-serif;
		font-size:11px; color:#54ec1a;" name="input" type="text">
													<option value="0">Select a Fuel Block...</option>
												</select>
											</label>
											</span> </td>
									</tr>
									<tr>
										<td style="clear:both; width:350px; height: 20px; font-family:Arial, Helvetica, sans-serif;
		font-size:9px; color:#54ec1a; padding-top: 3px">These are the available blocks you can buy with your HOPE Bucks</td>
									</tr>
									<tr>
										<td>
											<input id="btnBankWithdrawBuy" name="btnBankWithdrawBuy" type="button" value="Buy Selected Fuel Block" onmouseover="this.style.color='#FFFFFF'" onmouseout="this.style.color='#e5f031'" style=" background:url(./hud_files/images/buttonbg.jpg); cursor:pointer; border:#FFFFFF solid 1px; width:150px; height: 20px; font-family:Arial, Helvetica, sans-serif;
		font-size:11px; color:#e5f031"/>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</div>-->
				
				<div class="hud_bank_quick_links" style="margin-top:95px; margin-left:7px; width:459px;">
					<div class="hud_bank_quick_links_left" style="width:75px;">Quick Links:</div>
					<div class="hud_bank_quick_links_right">
						<div class="hud_bank_quick_links_right_links" style="width:123px;" onclick="ToggleContent('bank_statement');">Bank Statement</div>
						<div class="hud_bank_quick_links_right_links" style="width:90px; color:#FFF200;" onclick="ToggleContent('bank_withdraw');">Withdraw Bucks</div>
						<div class="hud_bank_quick_links_right_links" style="width:80px;" onclick="ToggleContent('bank_deposit');">Deposit Bucks</div>
						<div class="hud_bank_quick_links_right_links" style="width:40px;" onclick="ToggleContent('bank_loans');">Loans</div>
						<div class="hud_bank_quick_links_right_links" style="width:40px;" onclick="ToggleContent('bank_about');">About</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Bank Withdraw -->
		
		<!-- Bank Deposit -->
		<div class="wrapper-bank" id="bank_content_deposit">
			<div class="wrapper-bank01">
				<div class="bank-title">Deposit Bucks</div>
				<div class="bank-image04"></div>
				<div class="bank-content01">
					You can deposit Hope Bucks at any time into your My eBank account by converting your Kindness Workz hours into 
					Hope Bucks, or you can receive Hope Bucks from another Hopeful and deposit them into your My eBank account. In the 
					future you will be able to deposit Hope Bucks earned through purchases made of the products in your My eStore.
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="bank-r">
					<div class="box01">Deposit Funds</div>
					<div class="box02">
						<div class="in-box1">Balances:</div>
						<div class="in-box2"><span id="bank_balance"></span> Hope Bucks</div>
					</div>
				</div>
				<div class="bank-account02">
					<div class="bank-account-title"></div>
					<div class="bank-account-content">
						<div id="bank_deposit_notice"></div>
						<table>
							<tr>
								<td>
									<div class="bank-account-info">
										To convert your Kindness Workz hours to Hope Bucks: first check your Kindness Workz balance. 
										Type in the number of hours you wish to convert and then click and then click the 
										"Convert to Hope Bucks" button. The Hope Bucks will be immediately deposited into your my eBank 
										account.
									</div>
								</td>
								<td style="vertical-align:top;">
									<div style="width:120px; height: 20px; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#54ec1a; font-weight:bold; padding-left:5px">
										Kindness Hours:<span style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#e5f031; font-weight:bold">*</span>
									</div>
									<div style="clear:both; padding:10px 0 10px 10px">
										<input style="background-color:#51644c; border:#e5f031 solid 1px; width:80px; height: 15px; font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#54ec1a; margin-bottom: 17px;" id="iTimeToConvert" name="iTimeToConvert" type="text" />
									</div>
									<div class="bank-account-content05">Amount of Kindness Workz Hours to be converted.<br />
										Example correct entries: 1. 1.5, 0.25 etc.</div>
									<div style="clear:both; padding-left:5px; padding-top:5px">
										<input id="btnBankDeposit" name="btnBankDeposit" type="button" value="Convert To Valiants" onmouseover="this.style.color='#FFFFFF'" onmouseout="this.style.color='#e5f031'" style="background:url(./hud_files/images/buttonbg.jpg); cursor:pointer; border:#FFFFFF solid 1px; width:150px; height: 18px; font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#e5f031"/>
									</div>
									<div id="bank_deposit_status" class="bank-account-content06"></div>
								</td>
							</tr>
						</table>
					</div>
				</div>
								
				<div class="hud_bank_quick_links" style="margin-top:266px; margin-left:7px; width:459px;">
					<div class="hud_bank_quick_links_left" style="width:75px;">Quick Links:</div>
					<div class="hud_bank_quick_links_right">
						<div class="hud_bank_quick_links_right_links" style="width:123px;" onclick="ToggleContent('bank_statement');">Bank Statement</div>
						<div class="hud_bank_quick_links_right_links" style="width:90px;" onclick="ToggleContent('bank_withdraw');">Withdraw Bucks</div>
						<div class="hud_bank_quick_links_right_links" style="width:80px; color:#FFF200;" onclick="ToggleContent('bank_deposit');">Deposit Bucks</div>
						<div class="hud_bank_quick_links_right_links" style="width:40px;" onclick="ToggleContent('bank_loans');">Loans</div>
						<div class="hud_bank_quick_links_right_links" style="width:40px;" onclick="ToggleContent('bank_about');">About</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Bank Deposit -->
		
		<!-- Bank Loans -->
		<div class="wrapper-bank" id="bank_content_loans">
			<div class="wrapper-bank01">
				<div class="bank-title">Loans</div>
				<div class="bank-image05"></div>
				<div class="bank-content01">
					
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="bank-r">
					<div class="box01" style="font-size:0.75em;">Apply for a Hope Bucks Loan</div>
					<div class="box02">
						<div class="in-box1">Balances:</div>
						<div class="in-box2"><span id="bank_balance"></span> Hope Bucks</div>
					</div>
				</div>
				<div class="bank-account02">
					<div class="bank-account-title"></div>
					<div class="bank-account-content">
						<h1 align="center" style="color:#E5F031; margin-top:40px;">COMING SOON</h1>
					</div>
				</div>
								
				<div class="hud_bank_quick_links" style="margin-top:418px; margin-left:7px; width:459px;">
					<div class="hud_bank_quick_links_left" style="width:75px;">Quick Links:</div>
					<div class="hud_bank_quick_links_right">
						<div class="hud_bank_quick_links_right_links" style="width:123px;" onclick="ToggleContent('bank_statement');">Bank Statement</div>
						<div class="hud_bank_quick_links_right_links" style="width:90px;" onclick="ToggleContent('bank_withdraw');">Withdraw Bucks</div>
						<div class="hud_bank_quick_links_right_links" style="width:80px;" onclick="ToggleContent('bank_deposit');">Deposit Bucks</div>
						<div class="hud_bank_quick_links_right_links" style="width:40px; color:#FFF200;" onclick="ToggleContent('bank_loans');">Loans</div>
						<div class="hud_bank_quick_links_right_links" style="width:40px;" onclick="ToggleContent('bank_about');">About</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Bank Loans -->
		
		<!-- Bank Hope Economy -->
		<div class="wrapper-bank" id="bank_content_economy">
			<div class="wrapper-bank01">
				<div class="bank-title">Hope Economy</div>
				<div class="bank-image"></div>
				<div class="bank-content01">
					
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="bank-r">
					<div class="box01" style="font-size:0.75em;">About Hope Economy</div>
					<div class="box02">
						<div class="in-box1">Balances:</div>
						<div class="in-box2"><span id="bank_balance"></span> Hope Bucks</div>
					</div>
				</div>
				<div class="bank-account02">
					<div class="bank-account-title"></div>
					<div class="bank-account-content">
						<h1 align="center" style="color:#E5F031; margin-top:40px;">COMING SOON</h1>
					</div>
				</div>
								
				<div class="hud_bank_quick_links" style="margin-top:418px; margin-left:7px; width:459px;">
					<div class="hud_bank_quick_links_left" style="width:75px;">Quick Links:</div>
					<div class="hud_bank_quick_links_right">
						<div class="hud_bank_quick_links_right_links" style="width:123px;" onclick="ToggleContent('bank_statement');">Bank Statement</div>
						<div class="hud_bank_quick_links_right_links" style="width:90px;" onclick="ToggleContent('bank_withdraw');">Withdraw Bucks</div>
						<div class="hud_bank_quick_links_right_links" style="width:80px;" onclick="ToggleContent('bank_deposit');">Deposit Bucks</div>
						<div class="hud_bank_quick_links_right_links" style="width:40px;" onclick="ToggleContent('bank_loans');">Loans</div>
						<div class="hud_bank_quick_links_right_links" style="width:40px;" onclick="ToggleContent('bank_about');">About</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Bank Hope Economy -->
		
		<!-- END Bank Content --> 
		
		
		<!-- BEGIN Kindness Content -->
		
		<!-- Kindness About -->
		<div class="wrapper-kindness winXP" id="kindness_content_about">
			<div class="wrapper-kindness01">
				<div class="kindness-title">About</div>
				<div class="kindness-image" style="margin-bottom:27px;"></div>
				<div id="kindness_about_text" class="kindness-content01" style="margin-top:0px; width:287px; height:240px; overflow:auto;">
					<p>Your Hope Shuttle is fueled by hope, and hope is created through the Kindness Workz and other HopeNet programs. 
					The HopeNet services are free of monetary cost to you and the other Hopefuls, but before you can utilize a HopeNet 
					services like the Knowledge or Entertainment Portals you are required to first create some hope by performing 
					Kindness Workz (community service) within your local community. Kindness Workz are kindness activities such as 
					repairs, planting trees, picking up trash etc. We measure the hope created by you and the other Hopefuls through 
					Kindness hours and you can convert your Kindness hours into Hope Bucks to use as fuel for your Hope Shuttle. To 
					learn more about Kindness Workz please see our Peace Building Program in the HopeNet Services menu.</p>
					
					<!-- <h2 align="center" style="color:#FFF200; cursor:pointer;">Learn More</h2> -->
					<div style="color:#FFF200;" align="center">
					<div class="buttonbg2"><a><span><h2 style="cursor:pointer;" href="javascript:void(0);" onclick="" >Learn More
					</h2></span></a></div>
					</div>
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="bank-r">
					<div class="kind_navi">
						<ul>
							<li><a href="javascript:ToggleContent('kindness_about')" class="active"><span>About</span></a></li>
							<li><a href="javascript:ToggleContent('kindness_form')"><span>Kindness Report</span></a></li>
							<li><a href="javascript:ToggleContent('kindness_dashboard')"><span>Kindness Status</span></a></li>
							<li><a href="javascript:ToggleContent('kindness_convert')"><span>Convert</span></a></li>
						</ul>
					</div>
					<div class="kindness_box02">
						<div class="in-box1">Balances:</div>
						<div class="in-box2"><span id="bank_balance"></span> Hope Bucks</div>
					</div>
				</div>
				<div class="kindness-content02">
					<div class="box01" style="width:452px; font-size:0.75em;">Kindness Workz Control Panel</div>
					
					<p>This is your Kindness Workz  Account - Control Panel. Your Kindness Workz account works like your My eBank 
					account. When you click on the Kindness Workz link on your HopeNet Accounts menu you will see your Kindness Workz 
					Control Panel.  The control panel provides you with four Kindness Workz control buttons, including your Kindness 
					Report, Convert Kindness, and Kindness Status.</p>
					
					<p>The Kindness Report is what you use to record your Kindness Workz, so that you can receive Kindness hours. The 
					Convert Kindness control is what you use to Convert your Kindness Hours to Hope Bucks. The Kindness Status control 
					will tell you the status of your Kindness Workz that you have reported and whether or not they are pending, 
					disapproved, or approved.  To learn more about your Kindness Workz account and the controls just click on the 
					Kindness Workz control buttons.</p>
					
					<p>The Kindness Workz program creates hope and it is hope that powers your Hope Shuttle. If your Hope Shuttle is 
					running low on fuel and you don't have any Hope Bucks left in your bank account, then all you need to do is to 
					perform a Kindness Workz and use the Hope that you create to fuel your Hope Shuttle!</p>
				</div>
				
				<div class="hud_kindness_quick_links" style="margin-top:7px; margin-left:6px; width:457px;">
					<div class="hud_kindness_quick_links_left" style="width:75px;">Quick Links:</div>
					<div class="hud_kindness_quick_links_right">
						<div class="hud_kindness_quick_links_right_links" style="width:150px;" onclick="ToggleContent('kindness_convert');">Convert</div>
						<div class="hud_kindness_quick_links_right_links" style="width:90px;" onclick="ToggleContent('kindness_dashboard')">Kindness Status</div>
						<div class="hud_kindness_quick_links_right_links" style="width:90px;" onclick="ToggleContent('kindness_form');">Kindness Report</div>
						<div class="hud_kindness_quick_links_right_links" style="width:40px; color:#FFF200;" onclick="ToggleContent('kindness_about');">About</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Kindness About -->
		
		<!-- Kindness Status/Dashboard -->
		<div class="wrapper-kindness winXP" id="kindness_content_dashboard">
			<div class="wrapper-kindness01">
				<div class="kindness-title">About</div>
				<div class="kindness-image" style="margin-bottom:27px;"></div>
				<div id="kindness_status_text" class="kindness-content01" style="margin-top:0px; width:287px; height:240px; overflow:auto;">
					<p>Your Kindness Works Status panel gives you a complete up to the minute status on all of your pending, approved, 
					and disapproved Kindness Workz. It also tells you your total Kindness Hours earned and the number of hours 
					converted to Hope Bucks as well as your current hours balance.</p>
					
					<p>You have been assigned a Kindness Monitor that screens each of your Kindness Workz reports to make sure that 
					they are accurate and qualified for Kindness Hours. If your Kindness Monitor has any questions about your report 
					they will send you a message.  If your monitor is still evaluating one of your Kindness Workz you will receive a 
					status of "Pending". Once your Kindness Workz has been accepted you will receive a status of "Approved". If your 
					Kindness Workz is rejected for any reason you will receive a status of disapproved.</p>
					
					<p>You may click on the title of a Kindness Workz to see details of the status.</p>
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="bank-r">
					<div class="kind_navi">
						<ul>
							<li><a href="javascript:ToggleContent('kindness_about')"><span>About</span></a></li>
							<li><a href="javascript:ToggleContent('kindness_form')"><span>Kindness Report</span></a></li>
							<li><a href="javascript:ToggleContent('kindness_dashboard')" class="active"><span>Kindness Status</span></a></li>
							<li><a href="javascript:ToggleContent('kindness_convert')"><span>Convert</span></a></li>
						</ul>
					</div>
					<div class="kindness_box02">
						<div class="in-box1">Balances:</div>
						<div class="in-box2"><span id="bank_balance"></span> Hope Bucks</div>
					</div>
				</div>
				<div class="kindness-content02">
					<div id='KSPopUp' style='display:none; background-color:#051700; position:absolute; margin:323px 800 0 300px;border: 1px solid #fefe00; width: 400px; height: 400px; z-index:100;'>
						<div style='text-align: right;'><a onmouseover='this.style.cursor="pointer" ' style='font-size: 12px;' onfocus='this.blur();' onclick="document.getElementById('KSPopUp').style.display = 'none';document.getElementById('out').style.display = 'none';document.getElementById('in').style.display = 'block';document.getElementById('KSPopUp').style.display = 'none' " ><img src="hud_files/images/btn-close.png" border="0"></a></div>
						<div>&nbsp;</div>
						<div style='text-align: left;padding-top:5px;padding-left:5px;overflow-y:auto;overflow-x:hidden;width:390px;height:360px;' id="hud_KSText">loading..</div>
					</div>
					<div class="kindness-txt kindness-dashboard-box" id="kindness_dashboard_details"></div>
					
					<div class="kindness-txt">
						<h3>Kindness Workz Hours : Pending - Approved - Disapproved</h3>
					   <div class="pending_top_txt">
							<div class="pending_top_title">Title</div>
							<div class="pending_top_duration">Duration</div>
							<div class="pending_top_date">Date Reported</div>
							<div class="pending_top_monitor">Mentor</div>
							<!--<div class="pending_top_admin">Admin</div>-->
						</div>
						<div class="pending-strip"></div>
						<div id="kindness_approved_list"></div>
						
						<div align="center" style="font-weight:normal; padding-top:260px; color:#FFE800;">
							To see the details, click on the title of the Kindness Workz.
						</div>
						<!--<div class="pending_kindness_txt">Pending Kindness </div>
						<div class="pending_top_txt">
							<div class="pending_top_title">Title</div>
							<div class="pending_top_duration">Duration</div>
							<div class="pending_top_date">Date Submitted</div>
						</div>
						<div class="pending-strip"></div>
						<div id="kindness_pending_list"></div>-->	
					</div>
				</div>
				
				<div class="hud_kindness_quick_links" style="margin-top:7px; margin-left:6px; width:457px;">
					<div class="hud_kindness_quick_links_left" style="width:75px;">Quick Links:</div>
					<div class="hud_kindness_quick_links_right">
						<div class="hud_kindness_quick_links_right_links" style="width:150px;" onclick="ToggleContent('kindness_convert');">Convert</div>
						<div class="hud_kindness_quick_links_right_links" style="width:90px; color:#FFF200;" onclick="ToggleContent('kindness_dashboard')">Kindness Status</div>
						<div class="hud_kindness_quick_links_right_links" style="width:90px;" onclick="ToggleContent('kindness_form');">Kindness Report</div>
						<div class="hud_kindness_quick_links_right_links" style="width:40px;" onclick="ToggleContent('kindness_about');">About</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Kindness Status/Dashboard -->
		
		<!-- Kindness Convert -->
		<div class="wrapper-kindness" id="kindness_content_convert">
			<div class="wrapper-kindness01">
				<div class="kindness-title">Convert</div>
				<div class="kindness-image kindness_image_convert"></div>
				<div class="kindness-content01" style="font-size:0.75em;">
					<p>You can convert your Kindness Workz hours into Hope Bucks at any time. To convert your Kindness Workz hours to 
					Hope Bucks: first check your Kindness Workz balance.  Type in the number of hours you wish to convert and then 
					click "Convert to Hope Bucks" button.  The Hope Bucks will be immediately deposited into your my eBank account.</p>
					
					<p>Once you have converted your Kindness Hours to Hope Bucks you should immediately check the balance of your my 
					eBank account to make sure that you were properly credited. If you not any problems with the conversion, then 
					please immediately contact the HopeNet Administrator.</p>
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="bank-r">
					<div class="kind_navi">
						<ul>
							<li><a href="javascript:ToggleContent('kindness_about')"><span>About</span></a></li>
							<li><a href="javascript:ToggleContent('kindness_form')"><span>Kindness Report</span></a></li>
							<li><a href="javascript:ToggleContent('kindness_dashboard')"><span>Kindness Status</span></a></li>
							<li><a href="javascript:ToggleContent('kindness_convert')" class="active"><span>Convert</span></a></li>
						</ul>
					</div>
					<div class="kindness_box02">
						<div class="in-box1">Balances:</div>
						<div class="in-box2"><span id="bank_balance"></span> Hope Bucks</div>
					</div>
				</div>
				<div class="kindness-content02">
					<div class="kindness-txt">
						<div class="box01" style="color:#FFF200; width:230px; font-size:1.0em; background:url(hud_files/images/welcome_tutring.png) no-repeat scroll 0 0 transparent;">
							Convert Kindness Workz to Hope Bucks
						</div>
						
						<div id="kindness_details_panel" class="kindness_panel_area"></div>
						<table style="float:left;">
							<tr>
								<td>
									<div class="kindness-account-info">
										To convert your Kindness Workz hours to Hope Bucks: first check your Kindness Workz balance. 
										Type in the number of hours you wish to convert and then click "Convert to Hope Bucks" button. 
										The Hope Bucks will be immediately deposited into your my eBank account.
									</div>
								</td>
								<td style="vertical-align:top;">
									<h3>Kindness Hours :</h3>
									
									<div class="kindness_panel_area2"> Kindness Hours<span>*</span></div>
									<div class="kindness_input_area">
										<div class="kindness_input_bg">
											<input name="iKindnessToConvert" type="text" class="kindness_input_search" id="iKindnessToConvert" border="0" />
										</div><br/>
										<div style="margin-top:20px; font-weight:normal; font-size:0.9em;">
											Amount of Kindness Workz Hours to be converted.<br>
											Example correct entries: 1. 1.5, 0.25 etc.
										</div>
									</div>
									
									<div class="kindness_panel_btn" id="KindnessConvertDiv">
										<input id="btnKindnessConvert" name="btnKindnessConvert" onclick="Kindness_SetConvert()" type="button" value="Convert To Hope Bucks" onmouseover="this.style.color='#FFFFFF'" onmouseout="this.style.color='#e5f031'" style="background:url(./hud_files/images/buttonbg.jpg); cursor:pointer; border:#FFFFFF solid 1px; width:150px; height: 18px; font-family:Arial, Helvetica, sans-serif;font-size:11px; color:#e5f031"/>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
				
				<div class="hud_kindness_quick_links" style="margin-top:7px; margin-left:6px; width:457px;">
					<div class="hud_kindness_quick_links_left" style="width:75px;">Quick Links:</div>
					<div class="hud_kindness_quick_links_right">
						<div class="hud_kindness_quick_links_right_links" style="width:150px; color:#FFF200;" onclick="ToggleContent('kindness_convert');">Convert</div>
						<div class="hud_kindness_quick_links_right_links" style="width:90px;" onclick="ToggleContent('kindness_dashboard')">Kindness Status</div>
						<div class="hud_kindness_quick_links_right_links" style="width:90px;" onclick="ToggleContent('kindness_form');">Kindness Report</div>
						<div class="hud_kindness_quick_links_right_links" style="width:40px;" onclick="ToggleContent('kindness_about');">About</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Kindness Convert -->
		
		<!-- Kindness Pending/Approved -->
		<div class="wrapper-kindness" id="kindness_content_pending_approved">
			<div class="wrapper-kindness01">
				<div class="pending-title">Kindness</div>
				<div class="kindness-image kindness_image_pending"></div>
				<div class="kindness-content01">Our hopeNet knowledgePortal services are 
					powered by your kidness. It won?t cost you 
					a single peso, but we will ask you to help 
					out and make your community a better place 
					to live by doing some Acts of Kindness.</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="bank-r">
					<div class="kind_navi">
						<ul>
							<li><a href="javascript:ToggleContent('kindness_dashboard')"><span>About</span></a></li>
							<li><a href="javascript:ToggleContent('kindness_form')"><span>Kindness Report</span></a></li>
							<li><a href="javascript:ToggleContent('kindness_pending_approved')" class="active"><span>Pending/Approved</span></a></li>
							<li><a href="javascript:ToggleContent('kindness_convert')"><span>Convert</span></a></li>
						</ul>
					</div>
					<div class="kindness_box02">
						<div class="in-box1">Balances:</div>
						<div class="in-box2"><span id="bank_balance"></span> Hope Bucks</div>
					</div>
				</div>
				<div class="kindness-content02">
					<div class="kindness-txt">
						<h3>Kindness Hours :</h3>
					   <div class="pending_top_txt">
							<div class="pending_top_title">Title</div>
							<div class="pending_top_duration">Duration</div>
							<div class="pending_top_date">Date Submitted</div>
							<div class="pending_top_date_approvd">Date Approved</div>
						</div>
						<div class="pending-strip"></div>
						<div id="kindness_approved_list"></div>
						
						<div class="pending_kindness_txt">Pending Kindness </div>
						<div class="pending_top_txt">
							<div class="pending_top_title">Title</div>
							<div class="pending_top_duration">Duration</div>
							<div class="pending_top_date">Date Submitted</div>
						</div>
						<div class="pending-strip"></div>
						<div id="kindness_pending_list"></div>	
					</div>
				</div>
				<div class="bottom_menu_area">
					<div class="quick_link"><a href="#">Quick Links:</a></div>
					<div class="bottom_menu">
						<ul>
							<li><a href="javascript:ToggleContent('kindness_convert')">Convert</a></li>
							<li><a href="javascript:ToggleContent('kindness_pending_approved')" class="active">Pending/Approved</a></li>
							<li><a href="javascript:ToggleContent('kindness_form')">Report</a></li>
							<li><a href="javascript:ToggleContent('kindness_dashboard')">About</a></li>
						</ul>
					</div>
				</div>
			</div>

		</div>
		<!-- Kindness Pending/Approved -->
		
		<!-- Kindness Form -->
		<div class="wrapper-kindness winXP" id="kindness_content_form">
			<div class="wrapper-kindness01" id="kindness_report_left_section">
				<div class="kindness-title">Kindness Report</div>
				<div class="kindness-image kindness_image_report" style="margin-bottom:27px;"></div>
				<div id="kindness_form_text" class="kindness-content01" style="margin-top:0px; width:265px; height:auto; overflow:auto;">
					<p>Once you have performed a Kindness Workz you must then fill out a Kindness Report that explains the Kindness 
					that you have performed.   The report must include a detailed explanation about the Kindness Workz that you 
					performed, where you did the Workz, how long the Workz took you, and who you did it for.  Make sure that 
					everything on the report is true and correct otherwise you may not receive Kindness Hours for your Kindness Workz.</p>
					
					<p>Once the Kindness Report is completely filled out just click on the "Submit Kindness Report" button, and your 
					report will be sent to your HopeNet Monitor and Administrator for their approval. Once your Kindness Report has 
					been approved you will be credited with Kindness Hours.</p>
					
					<p>To learn more about what type of Kindness Workz are acceptable and how you should perform the Kindness Workz, 
					click on the Kindness Workz Guidelines button.</p>
					
					<!--<h2 align="center" style="color:#FFF200; cursor:pointer;">Kindness Workz Guidelines</h2>-->
					<div style="color:#FFF200;" align="center">
					<div class="buttonbg2"><a><span><h3 style="cursor:pointer;" href="javascript:void(0);" onclick="" >Kindness Workz Guidelines
					</h3></span></a></div>
					</div>
				</div>
			</div>
			<div class="wrapper-bank-r" id="kindness_report_right_section" style="height:auto;">
				<div class="bank-r">
					<div class="kind_navi">
						<ul>
							<li><a href="javascript:ToggleContent('kindness_about')"><span>About</span></a></li>
							<li><a href="javascript:ToggleContent('kindness_form')" class="active"><span>Kindness Report</span></a></li>
							<li><a href="javascript:ToggleContent('kindness_dashboard')"><span>Kindness Status</span></a></li>
							<li><a href="javascript:ToggleContent('kindness_convert')"><span>Convert</span></a></li>
						</ul>
					</div>
					<div class="kindness_box02">
						<div class="in-box1">Balances:</div>
						<div class="in-box2"><span id="bank_balance"></span> Hope Bucks</div>
					</div>
				</div>
                            
				<div class="report-content02" id="kindness_report_content_section">
                                    <div id="report_post_above_section">
					<div class="report-main_top" >
						<div class="report-main_top_left">
							<div class="report_left_txt">
								<div class="report_left_txt_top">Title: *</div>
								<div class="report_top_bg">
									<input type="text" class="report_top_search" name='sTitle' id='sTitle' border="0" />
								</div>
								<div class="report_left_txt_top1">* Give your Kindness Workz a title.</div>
								<div class="report_left_txt_top_description">Description:<span>*</span></div>
								<div class="report_top_large_bg">
									<textarea name="sDescription" id='sDescription' class="report_top_large_search" border="0" ></textarea>
								</div>
								<div class="report_left_txt_top1">* Explain about your Kindness Workz.</div>
								<div class="report-strip"></div>
								<div class="report_left_txt_top">Name: *</div>
								<div class="report_top_bg">
									<input type="text" name="sWhom" id="sWhom" class="report_top_search" border="0" />
								</div>
								<div class="report_left_txt_top1">* The Full Name of the person or community that you did your Kindness Workz for.</div>
								<div class="report_left_txt_top">Address/Location: *</div>
								<div class="report_top_bg">
									<input type="text" name="sLocation" id="sLocation" class="report_top_search" border="0" />
								</div>
								<div class="report_left_txt_top1">* The address or location where your did your Kindness Workz.</div>
							</div>
						</div>
						<div class="report-main_top_right">
							<div class="report_left_txt_top_2">Duration</div>
							<div class="report_input_btm_text">Specify how long your Kindness Workz lasted in hours and minutes.</div>
							<div class="report_right_text_area">
								<div class="report_left_txt_top">Duration (hours): *</div>
								<div class="report_input">
									<select type="text" name="iHour" id="iHour" class="form_selectbox" >
									<?php
									for ($h=0; $h<=480; $h+=60){
										$sUnit = ($h > 60) ? "hours":"hour";
										?>
										<option value="<?php echo $h ?>"><?php echo ($h/60)." ".$sUnit ; ?></option>
										<?php
									}
									?>
									</select>
								</div>
								<div class="report_input_btm_text">The Hour part of the duration.</div>
							</div>
							<div class="report_right_text_area">
								<div class="report_left_txt_top">Duration (minutes): *</div>
								<div class="report_input">
									<select type="text" name="iMinute" id="iMinute" class="form_selectbox" >
									<?php
									for ($m=0; $m<=59; $m++){
										$sUnit = ($m > 0) ? "minutes":"minute";
										$sMin = str_pad($m, 2, "0", STR_PAD_LEFT);
										?>
										<option value="<?php echo $sMin ?>"><?php echo $sMin." ".$sUnit;?></option>
										<?php
									}
									?>
									</select>
								</div>
								<div class="report_input_btm_text">The Minute part of the duration.</div>
							</div>
							<div class="report_right_text_area">
								<div class="report_left_txt_top">Date: *</div>
								<div class="report_input">
									<div>
										<select name="iMonth" id="iMonth" class="form_selectbox">
										<?php
										$aMonths=array('1'=>'Jan','2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'Jun','7'=>'Jul','8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');

										foreach($aMonths as $key=>$value){
											$selected='';
											if ($key==date('m')) $selected='selected=selected';
											?>
											<option <?php echo $selected ?> value="<?php echo $key ?>"><?php echo $value ?></option>
											<?php
										}
										?>  
										</select>
									</div>
									<div>
									   <select name="iDay" id="iDay" class="form_selectbox">
									   <?php
									   for($day=1;$day<=31;$day++){
											$selected='';
											if($day==date('d')) $selected='selected=selected';
											?>
											<option <?php echo $selected ?> value="<?php echo $day ?>"><?php echo $day ?></option>
											<?php
										}
										?>  
									   </select>
									</div>
									<div>
									   <select name="iYear" id="iYear" class="form_selectbox">
									   <?php
										for($year=1900;$year<=2050;$year++){
											$selected='';
											if($year==date('Y')) $selected='selected=selected';
											?>
											<option <?php echo $selected ?> value="<?php echo $year ?>"><?php echo $year ?></option>
                                       <?php
										}
										?>  
									   </select>
									</div>
								</div>
								<div class="report_input_btm_text">The Date when you did your Kindness Workz.</div>
							</div>
						</div>
					</div>
					
					<div class="report-main_botom" id="kindness_report_bottom">
						<div class="report-main_botom_txt">
							<table>
								<tr>
									<td style="width:20px; vertical-align:top;"><input name="kindness_promise" id="kindness_promise" type="checkbox" class="chekbox" value="" border="0" /></td>
									<td>I promise that everything in this report is true and that I had permission to do the Kindness Workz.</td>
								</tr>
							</table>
						</div>
						<div class="report_left_txt_top02">Recipient Type: *</div>
						<div class="report_botom_btn">
							<select name="sRecipientType" id="sRecipientType" class="form_selectbox">
								<?php
								$aRelationship = array("" => "Select your relationship...","Family/Relative" => "Family/Relative","Neighbor" => "Neighbor","Stranger" => "Stranger", "Community" => "Community");
								
								foreach($aRelationship as $key=>$value){
									?>
									<option value="<?php echo $key ?>"><?php echo $value ?></option>
									<?php
								}
								?>
							</select>
                     </div>
						<div class="report_botom_bg01">* Select your relationship to whom you did the Good Deed.</div>
						<div class="report_botom_bg01">
							<input id="btnKindnessSubmit" name="btnKindnessSubmit" type="button" value="Submit Kindness Form" onmouseover="this.style.color='#FFFFFF'" onmouseout="this.style.color='#e5f031'" onclick="Kindness_SetFormSubmit();" style="background:url(./hud_files/images/buttonbg.jpg); cursor:pointer; border:#FFFFFF solid 1px; width:150px; height: 18px; font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#e5f031" />
						</div>
					</div>
                                    </div>
                                    <div class="kindness_report_posts" id="kindness_report_posts" style="float:left;" >
                                        
				 <?php echo user_ext_profile_kindness_wall_display( $user ); ?>	
                                 
                                        
				</div>
                                    </div>
			</div>
			<div class="hud_kindness_quick_links" style="margin-top:7px; margin-left: 335px; width:462px;float:left !important;">
				<div class="hud_kindness_quick_links_left" style="width:75px;">Quick Links:</div>
				<div class="hud_kindness_quick_links_right">
					<div class="hud_kindness_quick_links_right_links" style="width:150px;" onclick="ToggleContent('kindness_convert');">Convert</div>
					<div class="hud_kindness_quick_links_right_links" style="width:90px;" onclick="ToggleContent('kindness_dashboard')">Kindness Status</div>
					<div class="hud_kindness_quick_links_right_links" style="width:90px; color:#FFF200;" onclick="ToggleContent('kindness_form');">Kindness Report</div>
					<div class="hud_kindness_quick_links_right_links" style="width:40px;" onclick="ToggleContent('kindness_about');">About</div>
				</div>
			</div>
		</div>
		<!-- Kindness Form -->
		
		<!-- END Kindness Content -->
		
		
		<!-- BEGIN Time Tracker Content -->
		<div class="wrapper-kindness" id="time_tracker_content">
			<div class="wrapper-kindness01">
				<div class="kindness-title">Fuel Tracking</div>
				<div class="navigation-image"></div>
				<div class="kindness-content01">
					<p>This is your Fuel Tracking - Control Panel</p>
					
					<p>With this panel, you can see how much fuel you have left for your Hope Shuttle. Fuel is measured in hours and 
					minutes of fuel that you have left. You can use this panel to see a complete history of your fuel purchases and 
					you can also use it to to purchase more fuel with your Hope Bucks by clicking on the "Buy Fuel" button.</p>
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="bank-r">
					
						<div style="color:#FFF200;">
					<div class="buttonbg5"><a><span><h4 style="cursor:pointer;" onclick="ToggleContent('bank_withdraw');" href="javascript:void(0);">Buy Fuel
					</h4></span></a></div>
						</div>

				</div>
				<div class="navigation-main_bg">
					<div class="kindness-txt">
						<div style="text-align: center; margin-bottom: 10px;" id="time_tracker_credit1"></div>
						<div class="history">History</div>
						<div class="navigation_maintop_history_date">Date</div>
						<div class="navigation_maintop_history_discription">Description</div>
						<div class="navigation_maintop_history_time">Time Spent</div>
						<div class="navigation-strip1">&nbsp;</div>
						
						<span id="time_tracker_hisrory"></span>						 
						
						<div class="navigation-strip2">&nbsp;</div>
						<div class="navigation_mainbotom_txt" id="spent_time"> </div>
					</div>
				</div>
			</div>
		</div>
		<!-- END Time Tracker Content -->
		
		
		<!-- BEGIN Tutoring Content -->
		
		<!-- Instant Tutoring Old content-->
<!--		<div class="wrapper-kindness" id="tutoring_content_ini">
			<div class="wrapper-kindness01">
				<div class="kindness-title">Instant eTutoring</div>
				<div class="tutoring-image"></div>
				<div class="tutering-content01">
					<div style="color:#FFF200;" align="center">
					<div class="buttonbg"><a><span><h2 style="cursor:pointer;" onclick="ToggleContent('tutoring_start');">Launch Instant eTutoring</h2></span></a></div>
					</div>
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="bank-r">
					<div class="tuter6_main_top_bg">
						<div class="welcm_tutor_top_btn_arae">	
							<div class="welcm_tutor_top_btn">Welcome to Instant eTutoring</div>
						</div>
						<div class="hud_main_content">
							<p>Before you can use the Instant Tutoring service you must enroll first. To enroll click on the Launch 
							Instant Tutoring button below and then click on the Get Started button on the following page.</p>
							
							<p>Once you have enrolled in Instant eTutoring we suggest that you become familiar with how it works before 
							you ask a question.  Once you are ready then then click on the "Ask a New Instant Question" button. Your 
							questions are filtered by category, so that they can then be directed to eTutors who specialize in that 
							particular subject area. A nominal Hope Bucks fee of is charged for each questioned asked. If you are not 
							in a particular hurry then the Hope Buck fee is HB.25 for each question. If you need express service then 
							the fee is HB.40. Through the Instant eTutoring program volunteer eTutors with specialized skills will 
							provide you with invaluable assistance.  You may ask a maximum of 3 questions a day.</p>
						</div>
					</div>
					
					<div class="hud_tutoring_quick_links">
						<div class="hud_tutoring_quick_links_left">Quick Links:</div>
						<div class="hud_tutoring_quick_links_right">
							<div class="hud_tutoring_quick_links_right_links" onclick="ToggleContent('tutoring_about');">About</div>
							<div class="hud_tutoring_quick_links_right_links" style="width:130px; color:#FFF200;" onclick="ToggleContent('tutoring_ini');">Instant eTutoring</div>
							<div class="hud_tutoring_quick_links_right_links" style="width:130px;" onclick="ToggleContent('tutoring_private');">Private eTutoring</div>
						</div>
					</div>
				</div>
			</div>
		</div>-->
		<!-- Instant Tutoring -->
                
                <div class="wrapper-kindness" id="tutoring_content_ini">
			<div class="wrapper-kindness01">
				<div class="kindness-title">eTutoring</div>
				<div class="tutoring-image"></div>
				<div class="tutering-content01">
					<div style="color:#FFF200;" align="center">
					<div class="buttonbg"><a><span><h2 style="cursor:pointer;" onclick="ToggleContent('tutoring_start');">Launch  eTutoring</h2></span></a></div>
					</div>
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="bank-r">
					<div class="tuter6_main_top_bg">
						<div class="welcm_tutor_top_btn_arae">	
							<div class="welcm_tutor_top_btn">Welcome to eTutoring</div>
						</div>
						<div class="hud_main_content">
							<p>Before you can use the Instant Tutoring service you must enroll first. To enroll click on the Launch 
							Instant Tutoring button below and then click on the Get Started button on the following page.</p>
							
							<p>Once you have enrolled in Instant eTutoring we suggest that you become familiar with how it works before 
							you ask a question.  Once you are ready then then click on the "Ask a New Instant Question" button. Your 
							questions are filtered by category, so that they can then be directed to eTutors who specialize in that 
							particular subject area. A nominal Hope Bucks fee of is charged for each questioned asked. If you are not 
							in a particular hurry then the Hope Buck fee is HB.25 for each question. If you need express service then 
							the fee is HB.40. Through the Instant eTutoring program volunteer eTutors with specialized skills will 
							provide you with invaluable assistance.  You may ask a maximum of 3 questions a day.</p>
						</div>
					</div>
					
					<div class="hud_tutoring_quick_links">
						<div class="hud_tutoring_quick_links_left">Quick Links:</div>
						<div class="hud_tutoring_quick_links_right">
							<div class="hud_tutoring_quick_links_right_links" onclick="ToggleContent('tutoring_ini');">About</div>
							<div class="hud_tutoring_quick_links_right_links" style="width:130px; color:#FFF200;" onclick="ToggleContent('tutoring_ini');"> Launch</div>
<!--							<div class="hud_tutoring_quick_links_right_links" style="width:130px;" onclick="ToggleContent('tutoring_private');">Private eTutoring</div>-->
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Private Tutoring -->
		<div class="wrapper-kindness" id="tutoring_content_private">
			<div class="wrapper-kindness01">
				<div class="kindness-title">Private eTutoring</div>
				<div class="tutoring-image"></div>
				<div class="tutering-content01">
					<h2 align="center">Coming Soon<br/>Private eTutoring</h2>
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="bank-r">
					<div class="tuter6_main_top_bg">
						<div class="welcm_tutor_top_btn_arae">	
							<div class="welcm_tutor_top_btn">Welcome to Private eTutoring</div>
						</div>
						<div class="hud_main_content">
							<p>COMING SOON...</p>
							
							<p>Through the HopeNet Private eTutoring program, volunteer eTutors will provide you with online, one-on-one 
							tutoring from and to virtually any location in the world. You and your Private eTutors will be able to 
							IM/chat, talk and and see each other in real-time, as well as the tutor can see exactly what you are doing 
							on your computer and guide you appropriately. You and the eTutors can even share your computer screen and 
							mouse/keyboard controls should you choose to.</p>
							
							<p>For example an eTutor/artist located in the U.S. can teach you to use a graphic editing software, or a 
							eTutor located in China can help you learn the Chinese language. When the eTutor is off-line you can also 
							practice the language on your own using the HopeNet artificial intelligence software.</p>
							
							<p>You will be charged a fee in Hope-Bucks to participate in the Private eTutoring program, and if you do 
							not have enough Hope-Bucks to pay for the eTutoring, you may apply for a micro-loan. For details on the 
							micro-loan process and requirements please refer to the Hope Development Bank overview.</p>
						</div>
					</div>
					
					<div class="hud_tutoring_quick_links">
						<div class="hud_tutoring_quick_links_left">Quick Links:</div>
						<div class="hud_tutoring_quick_links_right">
							<div class="hud_tutoring_quick_links_right_links" onclick="ToggleContent('tutoring_about');">About</div>
							<div class="hud_tutoring_quick_links_right_links" style="width:130px;" onclick="ToggleContent('tutoring_ini');">Instant eTutoring</div>
							<div class="hud_tutoring_quick_links_right_links" style="width:130px; color:#FFF200;" onclick="ToggleContent('tutoring_private');">Private eTutoring</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Private Tutoring -->
		
		<!-- Instant Question - Get Started -->
		<div class="wrapper-kindness" id="tutoring_content_get_started">
			<div class="wrapper-kindness01">
				<div class="kindness-title">eTutoring</div>
				<div class="tutoring6-image"></div>
				<div id="tutor_announcement_all" class="tutering6-content01">Through the Cybrary eTutoring program, you can ask an Instant Question and have it answered by anyone of our volunteer tutors.</div>
			
				<div id="tutor_announcement_child" class="tutering2-content01">
					<div class="tutor2-title1">Instant Tutoring</div>
					<div class="tutor02_left_botom_bg_big">
						<strong>Tutor Status</strong>
						There are <span id="tutor_total_tutor">21</span> Tutors standing by to answer your questions in the following subjects:
						<br /><br />
						<ul id="tutor_cat_stats"></ul>
					</div>
					<div class="tutor02_left_botom_bg_small">
					<strong>Announcement</strong>
						<br />
						<br />
						announcement... announcement... announcement... 
						announcement... announcement... announcement... 
						announcement... 
					</div>
              </div>
			</div>
			<div class="wrapper-bank-r">
				<div class="bank-r">
					<div class="tutor2_right_top">
						
						<div id="tutor_enroll_notice" class="tutor2_right_top_left_bg">
							<div id="tutor_enroll_button" class="tutor2_right_top_left_btn01">Get Started</div>
							<div class="tutor3_right_top_left_btn_txt2">Before you can ask an Instant Question, you must enroll first. Tu enroll,just click on the button above and follow the instructions.</div>
						</div>
						
						<div id="tutor_ask_question" style="display:none;" class="tutor2_right_top_left_bg">
							<div class="tutor2_right_top_left_top_txt">Ask An Instant Question</div>
							<div id="tutor_ask_button" class="tutor2_right_top_left_btn">
								<div class="tutor2_right_top_left_btn_txt">Ask a new</div>
								<div class="tutor2_right_top_left_btn_txt1">Instant Question</div>
							</div>
							<div class="tutor2_right_top_left_btn_txt2">
								You have asked a total of <span id="tutor_child_question_count">0</span> question(s).<br />
								You have spent $<span id="tutor_child_money_spent">0.00</span> on Instant Questions.</div>
							<div class="tutor2_right_top_left_btn_txt3"><span id="tutor_question_stat_all">5 children have asked 14 question(s) already.</span></div>
						</div>
						
						<div id="tutor_open_questions_all" class="tutor2_right_top_right_bg">
							<div class="tutor3_right_top_right_txt">
								<div class="report_left_txt_top_4">Open Questions<br />Categories</div>
								<div class="report_input_btm_text_4_2"><span id="tutor_question_stat_all">26 childrens have asked a total of 64 question(s) already.</span> Click on a category below to see the questions in that category.</div>
							</div>
							<div class="tutor3_category_04">
								<ul id="tutor_open_cat_all"></ul>
							</div>
						</div>
						
						<div id="tutor_open_questions_child" style="display:none;" class="tutor2_right_top_right_bg">
							<div class="tutor2_right_top_right_txt">Open Questions Categories</div>
							<div class="tutor2_right_top_right_txt1">You have <span id="tutor_child_question_count"></span> open question (s) in the following categories:</div>
							
							<div id="cat_carousel" class="tutor2_right_top_right_txt2">
								<div class="arrow left" id="btnprev_c"><<</div>
								<div class="arrow right" id="btnnext_c">>></div>
								<ul id="tutor_open_cat_child" class="ul_c"></ul>
							</div>
							
							<div class="tutor2_right_top_right_txt1">The following tutors have answered your question(s):</div>
							<div id="answered_carousel" class="tutor2_right_top_right_txt2">
								<div class="arrow left" id="btnprev_a"><<</div>
								<div class="arrow right" id="btnnext_a">>></div>
								<ul id="tutor_who_answered" class="ul_c"></ul>
							</div>
						</div>
						
					</div>
					<div class="tuter6_main_top_bg_4">
						<div class="welcm_tutor_top_btn_arae">	
							<div class="report_input_text_4">
								<a name="tutor_scroll_here"/>
								<div id="tutor_question_group" class="tutor6_top_btn">Instant Tutoring</div>
								<div id="tutor_questions"></div>
							</div>
						</div>
					</div>
					<div class="tuter6_main_bottom_bg">
						<?php
						if (_askeet_is_tutor()){
							?>
							<div id="tutor_answer_form" class="pop_up_05" style="top:868px; width:446px; height:95px;">
								<div class="report_left_txt_top_4">Your answer :</div>
								<div class="report_input_4">
									<textarea id="askeet_post_answer" class="report_top_ans_4_text" style="width:435px"></textarea>
								</div>
								<div class="report_input_4">
									<div id="tutor_answer_form_post_button" class="preview_btn"><a href="javascript:void(0)">Post Answer</a></div>
									<div id="tutor_answer_form_cancel_button" class="preview_btn"><a href="javascript:void(0)">Cancel</a></div>
								</div>
							</div>
							<?php
						}
						?>
						<div class="tuter6_bottom_left_bg">
							<div class="tuter6_bottom_left_txt">
								<strong>Popular Tags</strong>
								<div id="tutor_popular_tags"></div>
							</div>
						</div>
						<div class="tutor6-strip">&nbsp;</div>
						<div class="tuter6_bottom_right_bg">
							<div class="tuter6_bottom_right_txt">
								<strong>Browse Askeet</strong>
								<table><tr><td>
								<ul>
									<li><a id="tutor_question_featured" href="#tutor_scroll_here">Featured Questions</a></li>
									<li><a id="tutor_question_popular" href="#tutor_scroll_here">Popular Questions</a></li>
									<li><a id="tutor_question_all_question" href="#tutor_scroll_here">All Questions</a></li>
									<!--<li><a id="tutor_question_latest_answer" href="#tutor_scroll_here">Latest Answer</a></li>-->
								</ul>
								</td></tr></table>
							</div>
						</div> 
						<div><a href="">&nbsp;</a></div>						
					</div>
				</div>
			</div>
		</div>
		<!-- Instant Question - Get Started -->
		
		<!-- Instant Question - Ask a Question -->
		<div class="wrapper-kindness" id="tutoring_content_ask_form">
			<div id="tutor_preview" class="pop_up_05">
				<div id="tutor_preview_content" style="display:none;">
					<div class="report_right_text_area_4_2">
						<div class="report_left_txt_top_4">Preview Question</div>
						<div id="tutor_preview_question_cat" class="report_left_txt_top_4_5"></div>
						<div class="report_input_btm_text_4_5">
							<div id="tutor_preview_question" style="font-weight:bold; font-size:2em;"></div>
							<div id="tutor_preview_question_desc" style="font-size:1.5em;"></div>
						</div>
						<div class="report_left_txt_top_4_6">Asking cost $ <span id="tutor_preview_post_cost">0.25</span>. You can ask <span id="tutor_preview_post_left">2</span> questions today.</div>
					</div>
					<div class="report_input_4">
						<div id="tutor_preview_post" class="preview_btn" style="width:50px;"><a href="javascript:void(0)">Ask it</a></div>
						<div id="tutor_preview_edit" class="preview_btn" style="width:50px;"><a href="javascript:void(0)">Edit</a></div>
					</div>
				</div>
				
				<div id="tutor_notice_content" style="display:none;"></div>
			</div>
			
			<div class="wrapper-kindness01">
				<div class="kindness-title">Ask a Question</div>
				<div class="tutering6-content_4">
					Through the Cybrary tutoring program, you can ask an Instant Question and have it answered by anyone of our volunteer tutors.
				</div>
				<div class="report_right_text_area_4">
					<div class="report_left_txt_top_4">Question :</div>
					<div class="report_input_4">
						<input id="tutor_form_question" type="text" class="report_top_ans_4" border="0" />
					</div>
				</div>
				<div class="report_right_text_area_4">
					<div class="report_left_txt_top_4">Describe it :</div>
					<div class="report_input_4">
						<textarea id="tutor_form_question_desc" rows="4" class="report_top_ans_4_text" border="0"></textarea>
					</div>
				</div>
				<div class="report_right_text_area_4">
					<div class="report_left_txt_top_4">Tags :</div>
					<div class="report_input_4">
						<input id="tutor_form_question_tag" type="text" class="report_top_ans_4" border="0" />
					</div>
				</div>
				<div class="report_right_text_area_4">
					<div class="report_left_txt_top_4">Category :</div>
					<div class="report_input_4">
						<div class="cat_treeview"><ul id="hud_VolunteerCatList1"></ul></div>
						<input type="hidden" id="volunteer_iGroupId" value="0" />
					</div>
				</div>
				<div class="report_right_text_area_4">
					<div class="report_left_txt_top_4">Priority :</div>
					<div class="report_input_4">
						<select id="tutor_form_question_cost" class="priority" size="2">
							<option value="0.25">Normal</option>
							<option value="0.40">High</option>
						</select>
					</div>
					<div class="report_input_4">
						<div id="tutor_ask_form_post" class="preview_btn"><a href="javascript:void(0)">Preview Question</a></div>
						<div id="tutor_ask_form_cancel" class="preview_btn"><a href="javascript:void(0)">Cancel</a></div>
					</div>
				</div>
				<div class="tutering6-content_4_2">
					Normal priority questions cost 25 Credits. High priority questions cost 40 Credits. If your question is high priority we
					will place it in the high priority section and we will notify all tutors that specialize in your questions subject.
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="bank-r">
					<div class="tuter_04_main_top">
						<div class="tuter_04_main_left">
							<div class="report_right_text_area_4_2">
								<div class="report_left_txt_top_4_2">
									Search for Similar <br />
									Questions
								</div>
								<div class="report_input_btm_text_4_2">
									description for test description for test <br />
									question 1 description for test que</div>
								<div class="report_input_btm_text_4_2">
									<div class="tutor_4_top_btn"><a href="#">Search it</a></div>
								</div>
								<div class="report_input_btm_text_4_2">
									<input type="text" class="report_botom_btn_search_4" value="..." border="0" />
								</div>
							</div>
						</div>
						<div class="report_input_4_2">
							<div class="cat_treeview_long"><ul id="hud_VolunteerCatList2"></ul></div>
						</div>
					</div>
					<div class="tuter6_main_top_bg_4">
						<div class="welcm_tutor_top_btn_arae">
							<div class="report_input_text_4">
								<a name="tutor_scroll_here"/>
								<div id="tutor_question_group" class="tutor6_top_btn">Instant Tutoring</div>
								<div id="tutor_questions"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="tuter6_main_bottom_bg_4">
					<div class="tuter6_bottom_left_bg">
						<div class="tuter6_bottom_left_txt">
							<strong>Popular Tags</strong>
							<div id="tutor_popular_tags"></div>
						</div>
					</div>
					<div class="tutor6-strip">&nbsp;</div>
					<div class="tuter6_bottom_right_bg">
						<div class="tuter6_bottom_right_txt">
							<strong>Browse Askeet</strong>
							<table><tr><td>
							<ul>
								<li><a id="tutor_question_featured" href="#tutor_scroll_here">Featured Questions</a></li>
								<li><a id="tutor_question_popular" href="#tutor_scroll_here">Popular Questions</a></li>
								<li><a id="tutor_question_all_question" href="#tutor_scroll_here">All Questions</a></li>
								<!--<li><a id="tutor_question_latest_answer" href="#tutor_scroll_here">Latest Answer</a></li>-->
							</ul>
							</td></tr></table>
						</div>
					</div> 
					<div><a href="">&nbsp;</a></div>
				</div>
			</div>
		</div>
		<!-- Instant Question - Ask a Question -->
		
		<!-- About -->
		<div class="wrapper-kindness" id="tutoring_content_about">
			<div class="wrapper-kindness01">
				<div class="kindness-title">About</div>
				<div class="tutoring6-image"></div>
				<div class="tutering6-content01">
					<p>HopeNet will provide you with two types of remote eTutoring assistance, including Instant eTutoring and 
					Private eTutoring. The eTutoring service provides assistance that supplements our self-service Knowledge 
					Portal. eTutoring is not meant to be used until you have first used your best efforts to answer your 
					questions through the Knowledge Portal.  The Instant eTutoring service will be available for beta testing 
					June 2010. The Private eTutoring will begin beta testing in December 2010. You will be notified of the beta 
					testing dates.</p>
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="bank-r">
					<div class="tuter6_main_top_bg">
						<div class="welcm_tutor_top_btn_arae">	
							<div class="tutor6_top_btn">Welcome to eTutoring</div>
						</div>
						<div class="hud_main_content">
							<p>The Instant eTutoring program is an online question and answer service. If you are have an important 
							study question that you need a fast answer to,  and you can't find the answer by using the Knowledge Portal 
							then you can ask your question online with the Instant Tutoring service. The Instant eTutoring volunteers 
							provide a service similar to librarians.  The Volunteers will use their best efforts to guide you to 
							discovering the answers to your questions through the Knowledge Portal, rather than simply answering the 
							question for you.</p>
							
							<div class="buttonbg4"><a><span><p style="cursor:pointer; color:#FFF200; font-weight:bold;" align="center" onclick="ToggleContent('tutoring_ini');">
								To learn more about the Instant eTutoring service or to get started using it, please click here.
							</p></span></a></div>
							<br/><br/><br/>
							
							<p>COMING SOON... The Private eTutoring program will provide you with one-on-one tutoring by volunteer 
							eTutors. Traditional tutoring programs require both you and the tutor to be in the same place at the same 
							time, but that is not the case with HopeNet Private eTutoring.</p>
							
							<div class="buttonbg4"><a><span><p style="cursor:pointer; color:#FFF200; font-weight:bold;" align="center" onclick="ToggleContent('tutoring_private');">
								To learn more about the Private eTutoring service please click here.
							</p></span></a></div>
							<br/>
						</div>
					</div>
					
					<div class="hud_tutoring_quick_links">
						<div class="hud_tutoring_quick_links_left">Quick Links:</div>
						<div class="hud_tutoring_quick_links_right">
							<div class="hud_tutoring_quick_links_right_links" style="color:#FFF200;" onclick="ToggleContent('tutoring_about');">About</div>
							<div class="hud_tutoring_quick_links_right_links" style="width:130px;" onclick="ToggleContent('tutoring_ini');">Instant eTutoring</div>
							<div class="hud_tutoring_quick_links_right_links" style="width:130px;" onclick="ToggleContent('tutoring_private');">Private eTutoring</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- About -->
		
		<!-- END Tutoring Content -->
		
		<!-- BEGIN Communication Page -->
		<div class="wrapper-kindness" id="my_communication_content_about" style="display:none;">
			<div class="wrapper-kindness01">
				<div class="kindness-title"><span>Communication</span></div>
				<div id="generic_image" class="tutoring-image"></div>
				<div class="tutering-content01">
					<span>Click the "Launch Communication" button below to access your Messages.</span>
					<br /><br />
					<div style="color:#FFF200;" align="center">
						<div class="buttonbg"><a><span><h2 style="cursor:pointer;" onclick="SetGeneric('Communication'); ToggleContent('generic');">Launch Communication</h2></span></a></div>
					</div>
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="bank-r">
					<div class="tuter_main_top_bg">
						<div class="welcm_tutor_top_btn_arae">	
							<div class="welcm_tutor_top_btn"><span>Welcome to Communication</span></div>
						</div>
						<div class="hud_main_content winXP">
							<div id="communication_page_content_text" style="height:480px; overflow:auto;"><span>
								<p>The Communication of the HopeNet HUD is where you can see and edit all of your personal and private 
								information about yourself, we call this information your "Profile"...</p>
								
								<p>You can use your Profile to display your favorite photos and videos, your HopeNet friends, and general 
								information about yourself. Your Profile shows the city and Barangay where you live, but not your home 
								because that is private information.  Your profile displays your photo, nick name, grade, and age, but it 
								doesn't list private information such as your real name, phone number or your birthday. Your profile is 
								also a kind of a dashboard that displays how long you have been a member of HopeNet, and it shows how 
								many Kindness Workz hours you have earned along with the numbers of hours you have spent in the Knowledge 
								Portal working on your studies, and some other information such as how many sponsors, eTutors and eMentors 
								that you have.</p>
								
								<p>Other people can see your profile, but we don't let strangers see your private information, like your 
								real name or home address. When a stranger or a friend visits your profile page they can leave a comment 
								for you to read, but before we display the comment we check it to make sure that it doesn't contain 
								anything creepy or bad.</p>
								
								<p>You can also visit the profiles of other HopeNet members and see their photos and videos and leave 
								comments for your friends.  If you have a Sponsor or Volunteer helping you such as a eTutor or eMentor 
								you can also see their profiles, but you cannot see the profiles of grown ups who are not  helping you.</p>
								
								<p>When you leave a comment or upload a picture or photo make sure that it does not contain your private 
								information like your name, address or phone number... and of course make sure that there is nothing bad 
								in your photos or videos.</p></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="wrapper-kindness" id="generic_page_content" style="display:none;">
			<div class="wrapper-kindness01">
				<span><div id="generic_title" class="kindness-title"></div></span>
				<div id="generic_image" class="tutoring-image"></div>
				<div class="tutering-content01">
				   <div>
					 <div style="float:left;width:58%;border-right:thin solid #c6c400;">
						<div style="color:#FFF200;">
						<div class="buttonbg6"><a><span><h4 style="cursor:pointer;" onclick="message_access(1);" href="javascript:void(0);">Write New Message</h4></span></a></div>
						</div>
						<div style="color:#FFF200;">
						<div class="buttonbg6"><a><span><h4 style="cursor:pointer;" onclick="message_access(2);" href="javascript:void(0);">View Inbox</h4></span></a></div>
						</div>
						<div style="color:#FFF200;">
						<div class="buttonbg6"><a><span><h4 style="cursor:pointer;" onclick="message_access(3);" href="javascript:void(0);">View Sent Items</h4></span></a></div>
						</div>
						<div style="clear:both;">&nbsp;</div>
						<div style="color:#FFF200;">
						<div class="buttonbg6"><a><span><h4 style="cursor:pointer;" onclick="message_access(4);" href="javascript:void(0);">Manage Contacts</h4></span></a></div>
						</div>
						<div style="color:#FFF200;">
						<div class="buttonbg6"><a><span><h4 style="cursor:pointer;" onclick="message_access(5);" href="javascript:void(0);">Manage Blacklists</h4></span></a></div>
						</div>
						<div style="color:#FFF200;">
						<div class="buttonbg6"><a><span><h4 style="cursor:pointer;" onclick="message_access(6);" href="javascript:void(0);">Manage Clearance</h4></span></a></div>
						</div>
					</div>
					 <div style="float:left;width:40%;padding-top:30px;margin-left:4px;">
					 <br/>
					 <div style="color:#e6de00;"><span id="comm_inbox">&nbsp;</span> messages</div>
					 <div style="padding-top:7px;color:#e6de00;"><span id="comm_sent">&nbsp;</span> sent items</div>
					 <div style="padding-top:30px;color:#e6de00;"><span id="comm_contact">&nbsp;</span> contacts</div>
					 <div style="padding-top:13px;color:#e6de00;"><span id="comm_blacklist">&nbsp;</span> blacklisted</div>
					 <div style="padding-top:11px;color:#e6de00;"><span id="comm_perm">&nbsp;</span> </div>
					 </div>
					</div>
					<!--<div id="tutor_answer_form_cancel_button" class="preview_btn">
					<a href="javascript:void(0)">Cancel</a>
					</div>-->
					<div style="padding-top:1px;clear:both;">&nbsp;</div>
					<div>
					<input type="text" style="height:20px;background-color:#1d3d0f; border:#c6c000 solid 1px;font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#c6c000;" id="searchmsgtxt" name="searchmsgtxt" size="35" />
					<input type="button" onclick="messageSearch();" style="cursor:pointer;height:20px;background-color:#1d3d0f; border:#c6c000 solid 1px;font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#c6c000;" id="searchsubmit" name="searchsubmit" value="Search Mail" />
					</div>
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="bank-r">
					<div class="tuter_main_top_bg">
						<div class="welcm_tutor_top_btn_arae">	
							<div class="welcm_tutor_top_btn"><span><b id="generic_sub_title"></b></span></div>
						</div>
						<div class="welcm_msg_top_txt" id="message_inbox">&nbsp;</div>
						<div class="welcm_msg_top_txt" id="message_block" style="display:none;">&nbsp;</div>
					
					<!-- start new message-->
				<div id="displaymsgloader" style="display:none;padding-top:80px;"><br/><br/><br/><br/><center><img src="<?php echo url( 'misc/ajaxload.gif', array( 'absolute' => true ) ); ?>" /><br/><span style="color:#fff;">Loading</span></center></div>
				<div class="report-content02" id="writenewmessage" style="display:none;">
					<div>
						<div>
							<div class="report_left_txt">
							    <div>&nbsp;</div>
								<div class="report_left_txt_top">Recipients: (Separate multiple recipients by comma) *</div>
								<div class="report_top_bg">
									<input type="text" class="report_top_search" name='sRecipients' id='sRecipients' border="0" />
								</div>
								<div align="left" class="report_left_txt_top1">Open Contacts</div>
								<div align="left" class="report_left_txt_top1">&nbsp;</div>
								<div class="report_left_txt_top">Subject:</div>
								<div class="report_top_bg">
									<input type="text" class="report_top_search" name='sSubject' id='sSubject' border="0" />
								</div>
								
								<div class="report_left_txt_top_description">Message:<span>*</span></div>
								<div class="report_top_large_bg">
									<textarea name="sMessage" id='sMessage' class="report_top_large_search" border="0" ></textarea>
								</div>
								<div class="report_left_txt_top_description">&nbsp;</div>
								<div class="report_botom_bg01">
									<!--<input id="btnKindnessSubmit" name="btnKindnessSubmit" type="button" value="Back to Messages" onmouseover="this.style.color='#FFFFFF'" onmouseout="this.style.color='#e5f031'" onclick="javascript:history(-1);" style="background:url(./hud_files/images/buttonbg.jpg); cursor:pointer; border:#FFFFFF solid 1px; width:150px; height: 18px; font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#e5f031" /> <input id="btnKindnessSubmit" name="btnKindnessSubmit" type="button" value="Send" onmouseover="this.style.color='#FFFFFF'" onmouseout="this.style.color='#e5f031'" onclick="Kindness_SetFormSubmit();" style="background:url(./hud_files/images/buttonbg.jpg); cursor:pointer; border:#FFFFFF solid 1px; width:150px; height: 18px; font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#e5f031" />-->
									<input type="button" onclick="hidemessageblock();" style="cursor:pointer;background-color:#061800; border:#49ec11 solid 1px;font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#dad200;" id="searchsubmit" name="searchsubmit" value="Back to Messages" /> <input type="button" onclick="sendMessageForm();" style="cursor:pointer;background-color:#061800; border:#49ec11 solid 1px;font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#dad200;" id="sendmsgsubmit" name="sendmsgsubmit" value="Send Message" />
								</div>
							</div>
						</div>
					</div>
					
				</div>
				<input type="hidden" id="currentmsg" name="currentmsg" value="" />
				<div style="display:none" id="currentmsgVal"></div>
				<div style="display:none" id="currentmsgSearch"></div>
						<!--  end new message-->
						
						<!-- open message-->
				<div class="report-content02" id="openmessage" style="display:none;width:90%;padding-top:20px;">
					<div>
						<div>
						    <div>&nbsp;</div>
							<div style="width:90%;padding-left:20px;padding-top:20px;" width="90%" class="hud_message_content winXP">
								<div class="report_left_txt_top" id="title_of_message"></div>
								<div class="report_left_txt_top">From: <span id="comm_author_name" class="msgcolor">&nbsp;</span></div>
								<div align="left" class="report_left_txt_top1">&nbsp;</div>
								<div>
									<div style="float:left;width:40%;"><span id="comm_author_name" class="msgcolor">&nbsp;</span><br/><span id="comm_timestamp" class="msgcolor" style="font-size:10px;">&nbsp;</span></div>
									<div style="float:left;width:60%;">
										<span id="comm_body" class="msgcolor">&nbsp;</span>
									</div>
								</div>
								<div style="clear:both;">&nbsp;</div>
								<div class="report_left_txt_top_description">Reply to message:<br/>Send message to : <span id="comm_author_name" class="msgcolor">&nbsp;</span></div>
								<div>
									<textarea style="background-color:#061800; border:#49ec11 solid 1px;font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#dad200;" name="commsMessage" id='commsMessage' border="0" rows="10" cols="70"></textarea>
									<input type="hidden" name='comm_author' id='comm_author' border="0" />
									<input type="hidden" name='comm_authorname' id='comm_authorname' border="0" />
									<input type="hidden" name='comm_authorsubject' id='comm_authorsubject' border="0" />
									<input type="hidden" name='comm_thread_id' id='comm_thread_id' border="0" />
								</div>
								<div style="clear:both;">&nbsp;</div>
								<div style="text-align:right;" width="500">
									<input type="button" onclick="message_access(2);" style="display:none;cursor:pointer;background-color:#061800; border:#49ec11 solid 1px;font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#dad200;" id="inboxreturn" name="inboxreturn" value="Back to Messages" /> <input type="button" onclick="message_access(3);" style="display:none;cursor:pointer;background-color:#061800; border:#49ec11 solid 1px;font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#dad200;" id="sentreturn" name="sentreturn" value="Back to Messages" /> <input type="button" onclick="sendReplyForm();" style="cursor:pointer;background-color:#061800; border:#49ec11 solid 1px;font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#dad200;" id="searchsubmit" name="searchsubmit" value="Reply" />
								</div>
							</div>
						</div>
					</div>
					
				</div>
						
						<!--  end open message-->
						
					</div>
				</div>
			</div>
		</div>
		<!-- END Communication Page -->
		
		<!-- BEGIN OLD Mentoring Page -->
<!--		<div class="wrapper-kindness" id="mentoring_page_content" style="display:none;">
			<div class="wrapper-kindness01">
				<div class="kindness-title">eMentoring</div>
				<div id="mentoring_page_content_image" class="tutoring-image" style="background-image:url(hud_files/images/mentoring_img.jpg);"></div>
				<div class="tutering-content01">
					<h2 align="center" style="color:#FFF200;">COMING SOON</h2>
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="bank-r">
					<div class="tuter_main_top_bg">
						<div class="welcm_tutor_top_btn_arae">	
							<div class="welcm_tutor_top_btn" style="font-size:0.8em">Welcome to eMentoring</div>
						</div>
						<div class="hud_main_content winXP">
							<div id="mentoring_page_content_text" style="height:480px; overflow:auto;">
								<p>Every Hopeful has a dream and the objective of the HopeNet eMentoring service is to provide yourself and 
								each of the other Hopefuls with a caring adult to help guide you toward  your dream. HopeNet eMentors from 
								around the world will provide you with guidance, counseling and friendship and serve as an example. The 
								eMentoring program is similar to the Big Brothers - Big Sisters program located in America, except that 
								this program would be done entirely online.</p>
								
								<p>Potential eMentors will find you by searching through the Hopefuls database. eMentors will choose you 
								based upon the information in your profile, so it's important that you keep your data up to date including 
								your bio-data, Kindness Workz, Knowledge Portal usage, your photos, videos, etc.</p>
								
								<p>However, sensitive and personally identifying info is withheld until the eMentor has been thoroughly 
								investigated. Both you and the mentor must agree to the match, therefore we also provide you with 
								information about your potential mentor, so that you can make an informed decision as to whether or not the 
								mentor poses a suitable match.</p>
								
								<p>The minimum time commitment for eMentoring is for 6 months, but it can last much longer. For the safety 
								of you and the other Hopefuls all eMentors must undergo a careful screening process. You will be 
								communicating with your eMentor through a wide range of tools including state of the art communications 
								tools such as email, IM/chat, and Video/Chat, virtual worlds, and desktop sharing. All communications 
								between yourself and the mentors is subject to screening by volunteer monitors and staff members. Your 
								eMentor will be kept informed of your progress progress and status involving the various HopeNet programs 
								and services.</p>
								
								<p>You will be charged a fee in Hope-Bucks to participate in the eMentoring program, and if you do not have 
								enough Hope-Bucks to pay for the eMentoring you may apply for a micro-loan. For details on the micro-loan 
								process and requirements please refer to the Hope Development Bank overview.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>-->
		<!-- END Mentoring Page -->
                
                <div class="wrapper-kindness" id="mentoring_page_content" style="display:none;">
			<div class="wrapper-kindness01" id="wrapper-kindness01">
				<div class="kindness-title">Values Mentoring</div>
				<div id="mentoring_page_content_image" class="value-mentoring-image" style="background-image:url(hud_files/images/values_mentoring.png);"></div>
                            <!--    <div class="hud_main_content winXP" style="overflow: hidden; height: 440px; margin-top: 24px; padding-left:0; font-family: Arial, Helvetica, sans-serif !important;"> 
                                    <div class="bank-content_values" id="values_monitoring_left" style="margin-top:0px; width:287px; height:235px; overflow:auto;">
                                            <p><span style="color:#FFF200">Draft Description...</span><br/><br/>
                                            Peace Building is the overall purpose of Hope Street, and your mission of hope is the key to building 
                                            global peace. Our Peace Building program includes Values & Virtues, Spirituality, and our Kindness program. Our 
                                            flagship Peace Building program is our Kindness program, where yourself and the other Hopefuls provide Kindness 
                                            Workz and community services, such as garbage clean up, tree planting, repair and other good deeds.</p>

                                            <p>In recognition of your participation in the Kindness program you will receive Hope-Bucks for your Kindness 
                                            Workz. The Values & Virtues program will help you practice and recognize the value of virtues such as empathy, 
                                            courage, persistence, wisdom and tolerance. Our Spirituality program encourages you and the other Hopefuls to 
                                            tolerate all faiths and to embrace and study the faith of your choosing.</p>
                                    </div>
                                </div> -->
								
								<div class="tutering-content01">
					
					<br /><br />
					<div align="center">
						<div class="buttonbg"><a href="#my_profile" onclick="ToggleContent('my_profile')"><span><h2 style="cursor:pointer;">Values Mentoring Launch</h2></span></a></div>
					</div>
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="bank-r">
					<div class="tuter_main_top_bg_1">
						<div class="welcm_tutor_top_btn_arae">	
							<div class="welcm_tutor_top_btn" style="font-size:0.8em">How Values Mentoring Works</div>
						</div>
                                            <div class="hud_main_content winXP" style="overflow: hidden;height: 450px;">
							<div id="mentoring_page_content_text" style="height:415px; overflow:auto; padding-bottom:40px;">
								<p>Every Hopeful has a dream and the objective of the HopeNet eMentoring service is to provide yourself and 
								each of the other Hopefuls with a caring adult to help guide you toward  your dream. HopeNet eMentors from 
								around the world will provide you with guidance, counseling and friendship and serve as an example. The 
								eMentoring program is similar to the Big Brothers - Big Sisters program located in America, except that 
								this program would be done entirely online.</p>
								
								<p>Potential eMentors will find you by searching through the Hopefuls database. eMentors will choose you 
								based upon the information in your profile, so it's important that you keep your data up to date including 
								your bio-data, Kindness Workz, Knowledge Portal usage, your photos, videos, etc.</p>
								
								<p>However, sensitive and personally identifying info is withheld until the eMentor has been thoroughly 
								investigated. Both you and the mentor must agree to the match, therefore we also provide you with 
								information about your potential mentor, so that you can make an informed decision as to whether or not the 
								mentor poses a suitable match.</p>
								
								<p>The minimum time commitment for eMentoring is for 6 months, but it can last much longer. For the safety 
								of you and the other Hopefuls all eMentors must undergo a careful screening process. You will be 
								communicating with your eMentor through a wide range of tools including state of the art communications 
								tools such as email, IM/chat, and Video/Chat, virtual worlds, and desktop sharing. All communications 
								between yourself and the mentors is subject to screening by volunteer monitors and staff members. Your 
								eMentor will be kept informed of your progress progress and status involving the various HopeNet programs 
								and services.</p>
								
								<p>You will be charged a fee in Hope-Bucks to participate in the eMentoring program, and if you do not have 
								enough Hope-Bucks to pay for the eMentoring you may apply for a micro-loan. For details on the micro-loan 
								process and requirements please refer to the Hope Development Bank overview.</p>
							</div>
						</div>
                                            <div class="hud_peace_quick_links" style="margin: 9px 0 0 0px;">
					<div class="hud_peace_quick_links_left" style="width:75px;">Quick Links:</div>
					<div class="hud_peace_quick_links_right">
						<div id="quick_links_kindess_6" class="hud_peace_quick_links_right_links" style="width:90px;" onclick="ToggleContent('peace_kindness');">Kindness</div>
						<div class="hud_peace_quick_links_right_links" style="width:145px; color:#FFF200;" onclick="ToggleContent('mentoring');">Values Mentoring</div>
						<div class="hud_peace_quick_links_right_links" style="width:105px;" onclick="ToggleContent('peace_spirituality');">HopeGames</div>
						<div class="hud_peace_quick_links_right_links" style="width:40px;" onclick="ToggleContent('peace_about');">About</div>
					</div>
					<div id="quick_links_kindess_menu_6" class="hud_peace_quick_links_kindness">
						<div style="cursor:pointer;" onclick="ToggleContent('peace_kindness_workz')">Kindness Workz</div>
						<div style="cursor:pointer;" onclick="ToggleContent('peace_kindness_act')">Act of Kindness</div>
						<div style="cursor:pointer;" onclick="ToggleContent('peace_kindness_reporter')">Kindness Reporter</div>
					</div>
				</div>
                                            
					</div>
				</div>
			</div>
		</div>
                
		<!-- BEGIN Learning Page -->
		<!--customization to add iframe for html5 based content @ 09May2016-->
		<?php
		
		if(isset($_GET['id']) && $_GET['id']=='url'){
			$url = 	'mystudies/'.$_GET['id'].'/'. $_GET['mainpath'].'/'.$_GET['tag'] ;
			?>
			<div  id="learning_page_content1" style="display:none;left: -8px;position: relative; top: 16px;">
			<div style="display:block;" class="elearning-zoomer1"  ><a onclick="Toggle('learning_sub'); ToggleContent('learning');" style="cursor:pointer;">Return to eLerning</a></div>
			
            
			<iframe id="elearning_iframe" width="817" frameborder="0" height="561" marginwidth="0" marginheight="0" src="<?php echo  $url ?>" style="position:relative; margin:30px auto 0; display:block;" ></iframe>
			
			
		     </div>

		<?php } ?>
		<div  id="learning_page_content" style="display:none;">
		<?php
		
		if(isset($_GET['id']) && $_GET['id']=='help'){
		?>
		<iframe id="elearning_iframe" width="817" frameborder="0" height="561" marginwidth="0" marginheight="0" src="elearning.php?id=help&parentpath=<?php echo $_GET['parentpath'] ?>&mainpath=<?php echo $_GET['mainpath'] ?>" style="position:relative; margin:30px auto 0; display:block;" ></iframe>
		<?php } else{ ?>
			<iframe id="elearning_iframe" width="817" frameborder="0" height="561" marginwidth="0" marginheight="0" src="elearning.php?u=<?php echo $B64Name; ?>&p=<?php echo $sB64Pass; ?>" style="position:relative; margin:30px auto 0; display:block;" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
		<?php } ?>
			<div class="elearning-zoom elearning-zoom-open-iframe" id="fullscreeniframe" >Full Screen</div>
			<div class = "elearning-zoom elearning-zoom-close-iframe">Close</div>
		</div>
		<div  id="learning_sub_page_content" style="display:none;">
			<iframe width="817" frameborder="0" height="561" marginwidth="0" marginheight="0" src="scrapedcontent.php?u=<?php echo $B64Name; ?>&p=<?php echo $sB64Pass; ?>" style="position:relative; margin:46px 93px 0; display:block;" ></iframe>
			<div onclick="location='moodleelearning.php'" class="ilms2-zoom">Full Screen</div>
		</div>
		<!-- END Learning Page -->
		
		<!-- BEGIN My Profile -->
		
		<div id="my_profile_content_profile" class="wrapper-content clearfix">
			<?php require_once drupal_get_path( 'module', 'user' ) . '/user.pages.inc'; echo user_view( $user ); ?>
		</div>
		
		<div class="wrapper-kindness" id="my_profile_content_about">
			<div class="wrapper-kindness01">
				<div class="kindness-title">My Profile</div>
				<div class="profile-about-image"></div>
				<div class="tutering-content01">
					Click the "Launch My Profile" button below to access your HopeNet account, personal membership information.
					<br /><br />
					<div align="center">
						<div class="buttonbg"><a href="#my_profile" onclick="ToggleContent('my_profile')"><span><h2 style="cursor:pointer;">Launch My Profile</h2></span></a></div>
					</div>
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="bank-r">
					<div class="tuter_main_top_bg">
						<div class="welcm_tutor_top_btn_arae">	
							<div class="welcm_tutor_top_btn" style="font-size:0.8em">Welcome to My Profile</div>
						</div>
						<div class="hud_main_content winXP">
							<div id="profile_page_content_text" style="height:480px; overflow:auto;">
								<p>The My Profile section of the HopeNet HUD is where you can see and edit all of your personal and private 
								information about yourself, we call this information your "Profile"...</p>
								
								<p>You can use your Profile to display your favorite photos and videos, your HopeNet friends, and general 
								information about yourself. Your Profile shows the city and Barangay where you live, but not your home 
								because that is private information.  Your profile displays your photo, nick name, grade, and age, but it 
								doesn't list private information such as your real name, phone number or your birthday. Your profile is 
								also a kind of a dashboard that displays how long you have been a member of HopeNet, and it shows how 
								many Kindness Workz hours you have earned along with the numbers of hours you have spent in the Knowledge 
								Portal working on your studies, and some other information such as how many sponsors, eTutors and eMentors 
								that you have.</p>
								
								<p>Other people can see your profile, but we don't let strangers see your private information, like your 
								real name or home address. When a stranger or a friend visits your profile page they can leave a comment 
								for you to read, but before we display the comment we check it to make sure that it doesn't contain 
								anything creepy or bad.</p>
								
								<p>You can also visit the profiles of other HopeNet members and see their photos and videos and leave 
								comments for your friends.  If you have a Sponsor or Volunteer helping you such as a eTutor or eMentor 
								you can also see their profiles, but you cannot see the profiles of grown ups who are not  helping you.</p>
								
								<p>When you leave a comment or upload a picture or photo make sure that it does not contain your private 
								information like your name, address or phone number... and of course make sure that there is nothing bad 
								in your photos or videos.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="my_profile_content_about_container" style="display:none;">
		<?php
		/*$kid = kickapps_getStatus();
		
		if($kid == 1){
			?>
			<!--<input type="hidden" id="my_profile_content_about_kickapps_input" name="my_profile_content_about_kickapps_input" value="<?php echo $_SESSION['ka_cname'] ?>/service/displayKickPlace.kickAction?as=158175&u=<?php echo $_SESSION['ka_uid']."&st=".$_SESSION['ka_st']."&tid=".$_SESSION['ka_tid'] ?>&location=hud">
			<iframe id="my_profile_content_about_kickapps" height="1900" style="height:2300px;" src="" frameborder="0" scrolling="auto"></iframe>-->
			<?php
		}*/
		?>
		</div>
		<!-- END My Profile -->
		
		
        <!-- BEGIN Leaving HopeNet Notice -->
        <div id="leave_hopenet_notice" style="display:none;">
			<!-- <iframe id="leaving_hopenet_notice" style="overflow:hidden;" src="sites/all/modules/mystudies/content/url/wrapper" frameborder="0"></iframe> -->
		</div>
		<!-- END Leaving HopeNet Notice -->
        
		
		<!-- BEGIN Peace Building -->
		
		<!-- About -->
		<div class="wrapper-bank winXP" id="peace_content_about">
			<div class="wrapper-bank01">
				<div class="bank-title">Values Building</div>
				<div class="peace image01"></div>
				<div class="bank-content01" id="peace_about_text" style="margin-top:0px; width:287px; height:235px; overflow:auto;">
					<p><span style="color:#FFF200">Draft Description...</span><br/><br/>
					Peace Building is the overall purpose of Hope Street, and your mission of hope is the key to building 
					global peace. Our Peace Building program includes Values & Virtues, Spirituality, and our Kindness program. Our 
					flagship Peace Building program is our Kindness program, where yourself and the other Hopefuls provide Kindness 
					Workz and community services, such as garbage clean up, tree planting, repair and other good deeds.</p>
					
					<p>In recognition of your participation in the Kindness program you will receive Hope-Bucks for your Kindness 
					Workz. The Values & Virtues program will help you practice and recognize the value of virtues such as empathy, 
					courage, persistence, wisdom and tolerance. Our Spirituality program encourages you and the other Hopefuls to 
					tolerate all faiths and to embrace and study the faith of your choosing.</p>
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="peace_content_box">
					<div class="welcm_tutor_top_btn" style="margin-left:5px;">How Values Building works</div>
					<div class="hud_main_content winXP">
						<div id="peace_page_content_text" style="height:446px; overflow:auto;">
							<p><span style="color:#FFF200">Draft Description...</span><br/><br/>
							The HopeNet - Peace Building program will lay the roots for peace by making peace building activities an 
							everyday part of your life. If mankind is to survive, we must bring peace to our planet, and the way that 
							we will start to bring peace back to earth is to first give HOPE. Peace Building is not a short term 
							program measurable in months, it will likely require a period of at least 7 years for the results of our 
							peace building to be seen and for the program to start making a difference in the communities where it is 
							practiced.</p>
							
							<p>Hope Street - defines peace as "a state of mutual harmony between people; where virtues such as 
							fairness, truth, respect, kindness and goodwill have replaced violence, fear and hate!". Peace is a simple 
							concept to understand and anyone can practice it. However, peace has proven itself difficult to achieve 
							even on a small community level, and on a global level,  war or the -lack of peace- threatens the existence 
							of every person on earth.</p>
							
							<p>The nations of mankind are fond of claiming that there is nothing that they value more than peace. 
							However, once they feel that their brand of freedom is being challenged they will often abandon peace and 
							resort to violence.  As a race we spend over a trillion dollars a year to insure the peace and yet for the 
							most part it escapes us; however in comparison we spend virtually nothing to cultivate peace.</p>
							
							<p>Peace must be built and the foundation of peace is hope, for without hope peace cannot take root. 
							Therefore the creation of hope is our primary mission. To bring hope to our world we have created HopeNet 
							where your peace building skills will be cultivated, harvested and rewarded, beginning from your very first 
							day as a member of HopeNet.</p>
							
							<p>The Hope Prophecies says that: "the Hopefuls will walk the earth and give hope to mankind;" - "the 
							uncorrupted will release the spirit of hope upon the world" ... and a child will lead them. You and the 
							other Hopefuls are peacemakers and the fulfillment of the prophecies... the world needs a hero and for you 
							to fulfill your destiny.  Blessed are the Peacemakers for you are the children of God. There are three 
							types of Peace Building Programs for you to become involved in, and they are: the Kindness Program; the 
							Virtues and Values program; and the Spirituality program.</p>
						</div>
					</div>
				</div>
				
				<div class="hud_peace_quick_links">
					<div class="hud_peace_quick_links_left" style="width:75px;">Quick Links:</div>
					<div class="hud_peace_quick_links_right">
						<div id="quick_links_kindess_1" class="hud_peace_quick_links_right_links" style="width:90px;" onclick="ToggleContent('peace_kindness');">Kindness</div>
						<div class="hud_peace_quick_links_right_links" style="width:145px;" onclick="ToggleContent('peace_virtues');">Values Mentoring</div>
						<div class="hud_peace_quick_links_right_links" style="width:105px;" onclick="ToggleContent('peace_spirituality');">HopeGames</div>
						<div class="hud_peace_quick_links_right_links" style="width:40px; color:#FFF200;" onclick="ToggleContent('peace_about');">About</div>
					</div>
					<div id="quick_links_kindess_menu_1" class="hud_peace_quick_links_kindness">
						<div style="cursor:pointer;" onclick="ToggleContent('peace_kindness_workz')">Kindness Workz</div>
						<div style="cursor:pointer;" onclick="ToggleContent('peace_kindness_act')">Act of Kindness</div>
						<div style="cursor:pointer;" onclick="ToggleContent('peace_kindness_reporter')">Kindness Reporter</div>
					</div>
				</div>
			</div>
		</div>
		<!-- About -->
		
		<!-- Kindness Program -->
		<div class="wrapper-bank" id="peace_content_kindness">
			<div class="wrapper-bank01">
				<div class="bank-title">Kindness</div>
				<div class="peace image02"></div>
				<div class="bank-content01" id="peace_about_text" style="margin-top:0px; width:287px; height:235px; overflow:auto;">
					<p align="center" style="width:270px;">Click on the buttons below to learn more about our different Kindness Programs:</p>
					<div style="color:#FFF200;" align="center">
						<div class="buttonbg"><a><span><h2 style="cursor:pointer;" onclick="ToggleContent('peace_kindness_workz')">Kindness Workz</h2></span></a></div><br/>
						<div class="buttonbg"><a><span><h2 style="cursor:pointer;" onclick="ToggleContent('peace_kindness_act')">Act of Kindness</h2></span></a></div><br/>
						<div class="buttonbg"><a><span><h2 style="cursor:pointer;" onclick="ToggleContent('peace_kindness_reporter')">Kindness Reporter</h2></span></a></div>
					</div>

				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="peace_content_box">
					<div class="welcm_tutor_top_btn" style="margin-left:5px;">Welcome to Kindness</div>
					<div class="hud_main_content winXP">
						<div id="peace_kindness_content_text" style="height:446px; overflow:auto;">
							<p><span style="color:#FFF200">Draft Description...</span><br/><br/>
							HopeNet is fueled by the Kindness program, which all other HopeNet programs are based upon. All HopeNet 
							services are free of monetary cost to you and the other Hopefuls, however before you can use  a HopeNet 
							service you are required to perform Kindness Workz (community service) within your local community.</p>
							
							<p>The purpose of the Kindness program is twofold: First of all our main goal is for you and the other 
							Hopefuls to spread hope and rekindle the faith of the people - giving them something to believe in. We 
							believe that the Kindness you perform will cause a chain reaction of Kindness - Hope and Faith, and 
							ultimately... Peace.  Secondly, the Kindness activities are intended to serve as a character building 
							exercise for you which will improve all areas of your life.</p>
							
							<p>Our goal is to create an environment on earth where Kindness activities, and charitable-humanitarian 
							services are deemed by the people of earth to be highly valuable and profitable. In fact we believe that 
							that the power of Kindness - Hope and Faith will prove to be of such a high value that it will serve as a 
							basis for a new kind of economy that we describe as "an Economy of Hope - a Currency of Kindness".</p>
							
							<p>Kindness activities are defined as unselfish good-deeds or good-works performed for the benefit of a 
							person or group. The kindness you provide must be performed without the requirement of payment and the 
							only condition upon the beneficiary (the person you help), is that you hope that they repay the kindness 
							forward by performing a similar kindness for the benefit of another.</p>
							
							<p>The Kindness programs are the heart of what we call our "hope economy" and the intent of this economy is 
							to encourage, recognize and assist us all in valuing kindness, compassion, empathy and other peace making 
							skills in the same way that we value human skills, such as strength, intelligence and speed.  Perhaps one 
							day there will even be a Kindness Olympics!</p>
							
							<p>You must keep in mind however that for the most part kindness provides its own reward and you should not 
							expect to be directly rewarded or even recognized for all your kindness activities. There are three types 
							of Kindness activity programs for you to become involved in, and they are: the Kindness Workz program; the 
							Acts of Kindness program; and the Kindness Reporter program.</p>
						</div>
					</div>
				</div>
				
				<div class="hud_peace_quick_links">
					<div class="hud_peace_quick_links_left" style="width:75px;">Quick Links:</div>
					<div class="hud_peace_quick_links_right">
						<div id="quick_links_kindess_2" class="hud_peace_quick_links_right_links" style="width:90px; color:#FFF200;" onclick="ToggleContent('peace_kindness');">Kindness</div>
						<div class="hud_peace_quick_links_right_links" style="width:145px;" onclick="ToggleContent('peace_virtues');">Values Mentoring </div>
						<div class="hud_peace_quick_links_right_links" style="width:105px;" onclick="ToggleContent('peace_spirituality');">HopeGames</div>
						<div class="hud_peace_quick_links_right_links" style="width:40px;" onclick="ToggleContent('peace_about');">About</div>
					</div>
					<div id="quick_links_kindess_menu_2" class="hud_peace_quick_links_kindness">
						<div style="cursor:pointer;" onclick="ToggleContent('peace_kindness_workz')">Kindness Workz</div>
						<div style="cursor:pointer;" onclick="ToggleContent('peace_kindness_act')">Act of Kindness</div>
						<div style="cursor:pointer;" onclick="ToggleContent('peace_kindness_reporter')">Kindness Reporter</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Kindness Program -->
		
		<!-- Kindness Workz -->
		<div class="wrapper-bank" id="peace_content_kindness_workz">
			<div class="wrapper-bank01">
				<div class="bank-title">Kindness Workz</div>
				<div class="peace image02"></div>
				<div class="bank-content01" id="peace_about_text" style="margin-top:0px; width:287px; height:235px; overflow:auto;">
					<p align="center" style="width:270px;">Click on the buttons below to learn more about our different Kindness Programs:</p>
					<div style="color:#FFF200;" align="center">
						<div class="buttonbg"><a><span><h2 style="cursor:pointer;" onclick="ToggleContent('peace_kindness_workz')">Kindness Workz</h2></span></a></div><br/>
						<div class="buttonbg"><a><span><h2 style="cursor:pointer;" onclick="ToggleContent('peace_kindness_act')">Act of Kindness</h2></span></a></div><br/>
						<div class="buttonbg"><a><span><h2 style="cursor:pointer;" onclick="ToggleContent('peace_kindness_reporter')">Kindness Reporter</h2></span></a></div>
					</div>

				</div>
			</div>
			<div class="wrapper-bank-r">
                            <div class="peace_content_box" style="height:500px">
					<div class="welcm_tutor_top_btn" style="margin-left:5px;">Welcome to Kindness Workz</div>
					<div class="hud_main_content winXP">
						<div id="peace_kindness_workz_content_text" style="height:446px; overflow:auto;">
							<p>The Kindness Workz program is designed to encourage and recognize you for your labor intensive kindness 
							activities such as repairs, planting trees, picking up litter etc.  All Hopefuls are required to 
							participate in the Kindness Workz program. In return for your participation in the Kindness Workz program 
							you will receive Kindness Hours which you can convert to Hope Bucks. Your Hope Bucks can then be used to 
							purchase HopeNet services.</p>
							
							<p>Before you do a Kindness Workz, you should first figure out what kind of kindness activity you want to 
							do such as planting trees, or picking up litter. For ideas on different kinds of Good Workz you can do then 
							click <u>here</u>. Next you need to decide who you want to do the Kindness Workz for such as your community, 
							your family, a neighbor or even a stranger. Remember before you do the Kindness Workz you must first talk 
							to your parents and the beneficiary (the person you want to do the kindness activity for), and get their 
							permission; and don't forget to tell them the place, day and time you want to help them. For a Kindness 
							activity to be qualified as a "Kindness Workz" you must not request any type of payment from the 
							beneficiary of your kindness activity. Once you are finished helping the beneficiary, you need to then fill 
							out your Kindness Report, you can see the report by clicking on the Kindness Workz link in the HopeNet 
							Accounts menu, or you can just click ,<u>here</u>.</p>
							
							<p>Once you have filled out your Kindness Report and submitted it to HopeNet you need to give us at least 
							3-5 days to process your report. The report will first be screened by a volunteer HopeNet Monitor that is 
							assigned to you.  If your Monitor has any questions about your report they will contact you otherwise they 
							will recommend your report for approval and submit it to the HopeNet Administrator. If the Administrator 
							has any questions they will ask you or your Monitor if there are no questions then your Kindness Report 
							will be approved and your Kindness Account will be credited with the approved Kindness Hours.</p>
							
							<p>You have been given a Kindness Account where you can fill out and submit your Kindness Workz report, and 
							keep track of your Kindness Hours that you have earned. To see your Kindness Account you may go to the 
							HopeNet Accounts menu or click <u>here</u>.</p>
							
							<p><em>This program is now operational and will launch with the Cybrary on June 2010.</em></p>
                                                        <div style="color:#FFF200;" align="center"> <div class="buttonbg"><a style="margin: -12px 0px 0px 90px;"><span><h2 style="cursor:pointer;width: 251px;" onclick="ToggleContent('kindness_about')">Launch Kindness Workz</h2></span></a></div><br/></div>
						</div>
					</div>
				</div>
				
				<div class="hud_peace_quick_links">
					<div class="hud_peace_quick_links_left" style="width:75px;">Quick Links:</div>
					<div class="hud_peace_quick_links_right">
						<div id="quick_links_kindess_3" class="hud_peace_quick_links_right_links" style="width:90px; color:#FFF200;" onclick="ToggleContent('peace_kindness');">Kindness</div>
						<div class="hud_peace_quick_links_right_links" style="width:145px;" onclick="ToggleContent('peace_virtues');">Virtues and Values Program</div>
						<div class="hud_peace_quick_links_right_links" style="width:105px;" onclick="ToggleContent('peace_spirituality');">Spirituality Program</div>
						<div class="hud_peace_quick_links_right_links" style="width:40px;" onclick="ToggleContent('peace_about');">About</div>
					</div>
					<div id="quick_links_kindess_menu_3" class="hud_peace_quick_links_kindness">
						<div style="cursor:pointer; color:#FFF200;" onclick="ToggleContent('peace_kindness_workz')">Kindness Workz</div>
						<div style="cursor:pointer;" onclick="ToggleContent('peace_kindness_act')">Act of Kindness</div>
						<div style="cursor:pointer;" onclick="ToggleContent('peace_kindness_reporter')">Kindness Reporter</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Kindness Workz -->
		
		<!-- Act of Kindness -->
		<div class="wrapper-bank" id="peace_content_kindness_act">
			<div class="wrapper-bank01">
				<div class="bank-title">Act of Kindness</div>
				<div class="peace image05"></div>
				<div class="bank-content01" id="peace_about_text" style="margin-top:0px; width:287px; height:235px; overflow:auto;">
					<p align="center" style="width:270px;">Click on the buttons below to learn more about our different Kindness Programs:</p>
					<div style="color:#FFF200;" align="center">
						<div class="buttonbg"><a><span><h2 style="cursor:pointer;" onclick="ToggleContent('peace_kindness_workz')">Kindness Workz</h2></span></a></div><br/>
						<div class="buttonbg"><a><span><h2 style="cursor:pointer;" onclick="ToggleContent('peace_kindness_act')">Act of Kindness</h2></span></a></div><br/>
						<div class="buttonbg"><a><span><h2 style="cursor:pointer;" onclick="ToggleContent('peace_kindness_reporter')">Kindness Reporter</h2></span></a></div>
					</div>

				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="peace_content_box">
					<div class="welcm_tutor_top_btn" style="margin-left:5px;">Welcome to Act of Kindness</div>
					<div class="hud_main_content winXP">
						<div id="peace_kindness_act_content_text" style="height:446px; overflow:auto;">
							<h3 align="center" style="color:#FFF200;">COMING SOON</h3><br/>
							
							<p>The Acts of Kindness program is to encourage and recognize shorter duration kindness activities such as 
							giving gifts, or giving a short note or card to cheer someone up, or keeping a friendly attitude when 
							someone is behaving badly.  All Hopefuls are encouraged to participate in the Acts of Kindness program. 
							However, recognition for the Kindness Acts is given on a group level rather than to individual Hopefuls. 
							You will not receive direct credit of Hope Bucks for your individual Acts of Kindness. However you can rest 
							assured that we are keeping track of all of your Acts of Kindness and you will one day be rewarded for your 
							kindness. You are also encouraged to perform the Acts of Kindness anonymously if the situation permits. For 
							a Kindness activity to be qualified as an "Act of Kindness" you may not ask for any type of payment for 
							your Act of Kindness activity, and if the act involves contact with the beneficiary's person or property 
							then you must first get permission from the beneficiary. This program is under development and will launch 
							2-3 months after the launch of the Cybrary.</p>
						</div>
					</div>
				</div>
				
				<div class="hud_peace_quick_links">
					<div class="hud_peace_quick_links_left" style="width:75px;">Quick Links:</div>
					<div class="hud_peace_quick_links_right">
						<div id="quick_links_kindess_4" class="hud_peace_quick_links_right_links" style="width:90px; color:#FFF200;" onclick="ToggleContent('peace_kindness');">Kindness Program</div>
						<div class="hud_peace_quick_links_right_links" style="width:145px;" onclick="ToggleContent('peace_virtues');">Virtues and Values Program</div>
						<div class="hud_peace_quick_links_right_links" style="width:105px;" onclick="ToggleContent('peace_spirituality');">Spirituality Program</div>
						<div class="hud_peace_quick_links_right_links" style="width:40px;" onclick="ToggleContent('peace_about');">About</div>
					</div>
					<div id="quick_links_kindess_menu_4" class="hud_peace_quick_links_kindness">
						<div style="cursor:pointer;" onclick="ToggleContent('peace_kindness_workz')">Kindness Workz</div>
						<div style="cursor:pointer; color:#FFF200;" onclick="ToggleContent('peace_kindness_act')">Act of Kindness</div>
						<div style="cursor:pointer;" onclick="ToggleContent('peace_kindness_reporter')">Kindness Reporter</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Act of Kindness -->
		
		<!-- Kindness Reporter -->
		<div class="wrapper-bank" id="peace_content_kindness_reporter">
			<div class="wrapper-bank01">
				<div class="bank-title">Kindness Reporter</div>
				<div class="peace image06"></div>
				<div class="bank-content01" id="peace_about_text" style="margin-top:0px; width:287px; height:235px; overflow:auto;">
					<p align="center" style="width:270px;">Click on the buttons below to learn more about our different Kindness Programs:</p>
					<div style="color:#FFF200;" align="center">
						<div class="buttonbg"><a><span><h2 style="cursor:pointer;" onclick="ToggleContent('peace_kindness_workz')">Kindness Workz</h2></span></a></div><br/>
						<div class="buttonbg"><a><span><h2 style="cursor:pointer;" onclick="ToggleContent('peace_kindness_act')">Act of Kindness</h2></span></a></div><br/>
						<div class="buttonbg"><a><span><h2 style="cursor:pointer;" onclick="ToggleContent('peace_kindness_reporter')">Kindness Reporter</h2></span></a></div>
					</div>

				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="peace_content_box">
					<div class="welcm_tutor_top_btn" style="margin-left:5px;">Welcome to Kindness Reporter</div>
					<div class="hud_main_content winXP">
						<div id="peace_kindness_reporter_content_text" style="height:446px; overflow:auto;">
							<h3 align="center" style="color:#FFF200;">COMING SOON</h3><br/>
							
							<p>The Kindness Reporter program is to encourage you and the other Hopefuls to recognize and report 
							Kindness activities performed by others. All Hopefuls are encouraged to participate in the Kindness 
							Reporter program. You will be recognized for your participation in the Kindness Reporter program and you 
							will also receive Hope - Points, which is a rewards program somewhat similar to the Hope Bucks. <em>This 
							program is under development and will launch 2-3 months after the launch of the Cybrary.</em></p>
						</div>
					</div>
				</div>
				
				<div class="hud_peace_quick_links">
					<div class="hud_peace_quick_links_left" style="width:75px;">Quick Links:</div>
					<div class="hud_peace_quick_links_right">
						<div id="quick_links_kindess_5" class="hud_peace_quick_links_right_links" style="width:90px; color:#FFF200;" onclick="ToggleContent('peace_kindness');">Kindness Program</div>
						<div class="hud_peace_quick_links_right_links" style="width:145px;" onclick="ToggleContent('peace_virtues');">Virtues and Values Program</div>
						<div class="hud_peace_quick_links_right_links" style="width:105px;" onclick="ToggleContent('peace_spirituality');">Spirituality Program</div>
						<div class="hud_peace_quick_links_right_links" style="width:40px;" onclick="ToggleContent('peace_about');">About</div>
					</div>
					<div id="quick_links_kindess_menu_5" class="hud_peace_quick_links_kindness">
						<div style="cursor:pointer;" onclick="ToggleContent('peace_kindness_workz')">Kindness Workz</div>
						<div style="cursor:pointer;" onclick="ToggleContent('peace_kindness_act')">Act of Kindness</div>
						<div style="cursor:pointer; color:#FFF200;" onclick="ToggleContent('peace_kindness_reporter')">Kindness Reporter</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Kindness Reporter -->
		
		<!-- Virtues and Values Program -->
		<div class="wrapper-bank" id="peace_content_virtues">
			<div class="wrapper-bank01">
				<div class="bank-title">Virtues and Values</div>
				<div class="peace image03"></div>
				<div class="bank-content01">
					<img src="hud_files/images/7_promises.jpg" />
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="peace_content_box" style="height:579px;">
					<div class="welcm_tutor_top_btn" style="margin-left:5px; font-size:0.7em;">Welcome to Virtues and Values Program</div>
					<div class="hud_main_content winXP"  style="height:549px;">
						<div id="peace_virtues_content_text" style="height:534px; overflow:auto;">
							<h3 align="center" style="color:#FFF200;">COMING SOON</h3><br/>
							
							<p><span style="color:#FFF200">Draft Description...</span><br/><br/>
							The understanding and the practice of Values & Virtues is the cornerstone of our Peace Program. As a society, 
							mankind will often mix up the terms - virtues and values, however there are some important differences 
							between the terms.  Sociology text books tell us that values are the "ideals, customs, institutions, etc., 
							of a society toward which groups of people have an affective regard. These values may be positive, as 
							cleanliness, freedom, or education, or negative, as cruelty, crime, or blasphemy.". Virtues on the other 
							hand are defined as "Moral excellence and righteousness; goodness". Values are the underlying component of 
							our belief system and they shape our beliefs, ideas, opinions, and in turn our actions. To reach our 
							ultimate goal of peace, it is crucial that virtues play a leading role in the values of yourself and the 
							other Hopefuls. Therefore we will be encouraging you to make virtues an important part of your value-system.</p>
							
							<p>Hope is at the core of all that we value including our faith, but to create hope (relative to peace) we 
							must refocus our value system.  The society we live in places a high value on skills such as intelligence, 
							business, strength and speed, and our society has evolved to cultivate and reward those skills. Our society 
							also claims to place a high value on peace building skills such as virtues, ethics, and tolerance etc, and 
							yet as a society we do very little to cultivate and recognize those skills. We have legions of sportsman 
							whom we cheer for and praise for their strength, agility and speed, in fact as a society we cultivate these 
							skills and values within our youth and in turn we are rewarded with excellence; however where is the league 
							for peacemakers, and which of our institutions cultivates, recognizes and rewards skills-values such as 
							empathy, conflict resolution and tolerance etc.</p>
							
							<p>The HopeNet Virtues Program will include a host of exercises for you and the other Hopefuls to 
							participate in, both individually and as a group. The virtues that you and the other Hopefuls will practice 
							will be chosen from a cooperative list created by the Hopefuls, such as empathy, courage, honesty, 
							persistence, wisdom etc. Everyone has both strong and weak virtues and you will be given the opportunity to 
							practice and improve all of your virtues. <em>This program is under development and will launch 4-6 months 
							after the launch of the Cybrary.</em></p>
						</div>
					</div>
				</div>
				
				<div class="hud_peace_quick_links">
					<div class="hud_peace_quick_links_left" style="width:75px;">Quick Links:</div>
					<div class="hud_peace_quick_links_right">
						<div id="quick_links_kindess_6" class="hud_peace_quick_links_right_links" style="width:90px;" onclick="ToggleContent('peace_kindness');">Kindness Program</div>
						<div class="hud_peace_quick_links_right_links" style="width:145px; color:#FFF200;" onclick="ToggleContent('peace_virtues');">Virtues and Values Program</div>
						<div class="hud_peace_quick_links_right_links" style="width:105px;" onclick="ToggleContent('peace_spirituality');">Spirituality Program</div>
						<div class="hud_peace_quick_links_right_links" style="width:40px;" onclick="ToggleContent('peace_about');">About</div>
					</div>
					<div id="quick_links_kindess_menu_6" class="hud_peace_quick_links_kindness">
						<div style="cursor:pointer;" onclick="ToggleContent('peace_kindness_workz')">Kindness Workz</div>
						<div style="cursor:pointer;" onclick="ToggleContent('peace_kindness_act')">Act of Kindness</div>
						<div style="cursor:pointer;" onclick="ToggleContent('peace_kindness_reporter')">Kindness Reporter</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Virtues and Values Program -->
		
		<!-- OLD Spirituality Program -->
<!--		<div class="wrapper-bank" id="peace_content_spirituality">
			<div class="wrapper-bank01">
				<div class="bank-title">Spirituality</div>
				<div class="peace image04"></div>
				<div class="bank-content01">
					<img src="hud_files/images/boy_praying.jpg" />
				</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="peace_content_box">
					<div class="welcm_tutor_top_btn" style="margin-left:5px; font-size:0.75em;">Welcome to the Spirituality Program</div>
					<div class="hud_main_content winXP">
						<div id="peace_spirituality_content_text" style="height:446px; overflow:auto;">
							<h3 align="center" style="color:#FFF200;">COMING SOON</h3><br/>
							
							<p>The HopeNet Spirituality Program will encourage you and the other Hopefuls to practice meditation, 
							reflection, prayer and other spiritual activities. The program does not promote any particular religion or 
							faith, but it does encourage you to practice your faith in God in the manner of your own choosing, and it 
							also encourages religious tolerance.</p>
							
							<p>You are encouraged to embark on a spiritual journey that will focus on discovering your inner spiritual 
							as well as how you are connected to others and the world around you. You will be given the opportunity to 
							participate in spiritual exercises including writing your own prayers, spiritual goals and thoughts. The 
							exercise will also include group discussions with other Hopefuls and collaborative spiritual writings. 
							<em>This program is under development and will launch 4-6 months after the launch of the Cybrary.</em></p>
						</div>
					</div>
				</div>
				
				<div class="hud_peace_quick_links">
					<div class="hud_peace_quick_links_left" style="width:75px;">Quick Links:</div>
					<div class="hud_peace_quick_links_right">
						<div  id="quick_links_kindess_7" class="hud_peace_quick_links_right_links" style="width:90px;" onclick="ToggleContent('peace_kindness');">Kindness Program</div>
						<div class="hud_peace_quick_links_right_links" style="width:145px;" onclick="ToggleContent('peace_virtues');">Virtues and Values Program</div>
						<div class="hud_peace_quick_links_right_links" style="width:105px; color:#FFF200;" onclick="ToggleContent('peace_spirituality');">Spirituality Program</div>
						<div class="hud_peace_quick_links_right_links" style="width:40px;" onclick="ToggleContent('peace_about');">About</div>
					</div>
					<div id="quick_links_kindess_menu_7" class="hud_peace_quick_links_kindness">
						<div style="cursor:pointer;" onclick="ToggleContent('peace_kindness_workz')">Kindness Workz</div>
						<div style="cursor:pointer;" onclick="ToggleContent('peace_kindness_act')">Act of Kindness</div>
						<div style="cursor:pointer;" onclick="ToggleContent('peace_kindness_reporter')">Kindness Reporter</div>
					</div>
				</div>
			</div>
		</div>-->
		<!-- Spirituality Program -->
		
		<!-- END Peace Building -->
                
                <div  id="peace_content_spirituality">
			<div style="margin-top: 36px;margin-left: 94px;float: left;height: 360px;">
                        <img src="hud_files/images/hopegames.jpg"/>
			</div>
                    <div class="clear"></div>
                    <div class="hopenet_below" style="float: left;margin-left: 95px;font-size: 14px;width: 810px;height: 90px;">
                       <img src="hud_files/images/under_construction_site.png" style="z-index: 100;position: absolute;margin-left: 280px;margin-top:5px;height: 100px;"/>  
                       <p><span style="color:#FFF200">Draft Description...</span></p>
<!--					<p><span style="color:#FFF200">Draft Description...</span><br/><br/>
					Peace Building is the overall purpose of Hope Street, and your mission of hope is the key to building 
					global peace. Our Peace Building program includes Values & Virtues, Spirituality, and our Kindness program. Our 
					flagship Peace Building program is our Kindness program, where yourself and the other Hopefuls provide Kindness 
					Workz and community services, such as garbage clean up, tree planting, repair and other good deeds.</p>
					
					<p>In recognition of your participation in the Kindness program you will receive Hope-Bucks for your Kindness 
					Workz. The Values & Virtues program will help you practice and recognize the value of virtues such as empathy, 
					courage, persistence, wisdom and tolerance. Our Spirituality program encourages you and the other Hopefuls to 
					tolerate all faiths and to embrace and study the faith of your choosing.</p>-->
		
                    </div>
                       <div class="clear"></div>
                       <div class="hud_peace_quick_links" style="float: right;margin-right: 104px;">
					<div class="hud_peace_quick_links_left" style="width:75px;">Quick Links:</div>
					<div class="hud_peace_quick_links_right">
						<div id="quick_links_kindess_6" class="hud_peace_quick_links_right_links" style="width:90px;" onclick="ToggleContent('peace_kindness');">Kindness</div>
						<div class="hud_peace_quick_links_right_links" style="width:145px; color:#FFF200;" onclick="ToggleContent('mentoring');">Values Mentoring</div>
						<div class="hud_peace_quick_links_right_links" style="width:105px;" onclick="ToggleContent('peace_spirituality');">HopeGames</div>
						<div class="hud_peace_quick_links_right_links" style="width:40px;" onclick="ToggleContent('peace_about');">About</div>
					</div>
					<div id="quick_links_kindess_menu_6" class="hud_peace_quick_links_kindness">
						<div style="cursor:pointer;" onclick="ToggleContent('peace_kindness_workz')">Kindness Workz</div>
						<div style="cursor:pointer;" onclick="ToggleContent('peace_kindness_act')">Act of Kindness</div>
						<div style="cursor:pointer;" onclick="ToggleContent('peace_kindness_reporter')">Kindness Reporter</div>
					</div>
				</div>	
		</div>
                
		
		<div class="clear"></div>
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