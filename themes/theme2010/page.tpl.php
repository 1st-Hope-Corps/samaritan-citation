<?php

if (strpos($_SERVER['QUERY_STRING'], 'admin%2Fcontent%2Fnode%2Foverview') === false) {
  //instant_redirect(ereg_replace("[^0-9]", "", $_GET["q"]));
}

global $user;
// $Id: page.tpl.php,v 1.25 2008/01/24 09:42:53 goba Exp $

$sUrlq = 'none';
if($_GET['q']){
	$q = explode('/',$_GET['q']);
	if($q[0] == 'mystudies' && $q[1] == 'file' && $q[2] == 'image'){
		$sUrlq = 'image';
	}
}  
if($_GET['q']){
	$q = explode('/',$_GET['q']);
	if($q[0] == 'entertainment' && $q[1] == 'file' && $q[2] == 'image'){
		$sUrlq = 'image';
	}
}  
if($_GET['q'] == 'user/visitor'){
	user_authenticate(array("name" => "hope_visitor", "pass" => "pabx42"));
	drupal_goto($_GET['destination']);
}
if($_GET['q'] == 'time/buy'){

//echo $_SERVER['DOCUMENT_ROOT'];
require_once(realpath('./').'/hometime.php');

} else if($sUrlq == 'image'){
?>
<div align="center" style="padding-top:15px;background-color:#ffffff;">
<?php    
  echo mystudies_file_view_file('image','',$q[5]);
?>
<?php    
  echo entertainment_file_view_file('image','',$q[5]);
?>
</div>

<?php  
} else{

$sCurrPage = str_replace("index.php","",$_SERVER['PHP_SELF']);
$aBanners = array(
				"home" 		=> array(
								"pages"=>"node",
								"banner"=>"banner_home.jpg"
							   ),
				"cybrary"	=> array(
								"pages"=>"node/7",
								"banner"=>"banner_about.jpg"
							   ),
				"hopefuls"	=> array(
								"pages"=>"node/9",
								"banner"=>"banner_meet.jpg"
							   ),
				"programs"	=> array(
								"pages"=>"node/1704,node/1705,node/1706,node/1707,node/1708,node/1709,node/1710,node/1711,node/1712,node/1792,node/1793",
								"banner"=>"banner_about.jpg"
							   ),
				"involved"	=> array(
								"pages"=>"node/add/school|default,node/add/faq|default,node/add/meetthehopefuls|default,node/add/programs|default,node/add/visitourcybrary|default,node/add/aboutpage|default,node/add/home|default,node/add/getinvolved|default,mystudies/getinvolved|mystudy,entertainment/getinvolved/entertainment-portal-volunteers|entertain,entertainment/getinvolved|mystudy,node/1715,node/1713|volunteers,node/1714|knowledge,node/1716|mentor,node/18|support,volunteer/tutor|mystudy,volunteer/cybrarianhopeteam|mystudy,volunteer/cybrarianselect|mystudy,volunteer/cybrarian|mystudy,askeet|mystudy,kindness/mentor|mystudy,coordinator/administer|mystudy,instant/mentor|mystudy,node/194|sponsor,values/getinvolved|mystudy,values/getinvolved/guides|mystudy,values/getinvolved/editors|mystudy",
								"banner"=>"banner_getinvolved.jpg"
							   ),
				"about"		=> array(
								"pages"=>"node/15,node/1703,node/187,node/193",
								"banner"=>"banner_about.jpg"
							   ),
				"community"	=> array(
								"pages"=>"community,community/offlinevolunteerunit|mystudy",
								"banner"=>"banner_about.jpg"
							   ),
				"faq"		=> array(
								"pages"=>"node/11",
								"banner"=>"banner_about.jpg"
							   ),	   
			);

$iHomeRandom = rand(1, 4);
$sPageBanner = "banner_about.jpg";
$sNavArrow = "nav_arrow_home.png";
$sTemplate = "default";
$aActiveNav["home"] = "nav_active";	

if (!empty($_GET["q"])) {
	$dt_iBanners = 1;
	foreach ($aBanners as $sButton => $aBanner) {
		$aPages = explode(",",$aBanner["pages"]);
		
		foreach ($aPages as $sPageTpl) {
			list($sPage,$sTpl) = explode("|",$sPageTpl);
			
			if($sPage){
				if (stristr($_GET["q"],$sPage) && $_GET["q"] != "node" && substr($_GET["q"],0,6) != "admin/" && (!stristr($_GET["q"],"/edit") || stristr($_GET["q"],"/editors"))) {
					$sPageBanner = $aBanner["banner"];
					$aActiveNav["home"] = "";
					$aActiveNav[$sButton] = "nav_active";
					$sTemplate = (empty($sTpl) ? $sButton : $sTpl);
					break;
				} else if ($_GET["q"] == "node") {
					$sTemplate = "home";
					$sPageBanner = "banner_home" . $iHomeRandom . ".jpg";
					$sNavArrow = "nav_arrow_home" . $iHomeRandom . ".png";
				}
			}
		}
	//**devtest**//
	$ret = $ret . $aPages;
	//pqp_index_console_logMemory($ret, 'Total size of data Banners - Page-tpl.php -- iteration '.$dt_iBanners);
	$dt_iBanners++;
	//**eofdevtest**//
	}
} 

function in_array_like($sNeedle, $aHaystack){
	if (!in_array($sNeedle, array("mystudies/getinvolved","mystudies/getinvolved/guides","mystudies/getinvolved/guides/enroll","entertainment/getinvolved","entertainment/getinvolved/guides","entertainment/getinvolved/guides/enroll"))){
		$dt_iNeedle = 1;
		foreach ($aHaystack as $sReference){
			if (stristr($sNeedle, $sReference)) return true;
		//**devtest**//
		$ret = $ret . $sReference;
		//pqp_index_console_logMemory($ret, 'Total size of data Needle - Page-tpl.php -- iteration '.$dt_iNeedle);
		$dt_iNeedle++;
		//**eofdevtest**//
		}
	}
	
	return false;
}

$sHomeLink = ($user->uid > 0) ? "user/".$user->uid:"";

$aChildPortal = array(
					"menu-127" => array("attributes" => array("title" => ""), "href" => "<front>", "title" => "Visitor's Portal"),
					"menu-123" => array("attributes" => array("title" => ""), "href" => "node/20", "title" => "Children's Portal"),
					"menu-124" => array("attributes" => array("title" => ""), "href" => "community", "title" => "My Community"),
					"menu-125" => array("attributes" => array("title" => ""), "href" => "node/196", "title" => "Get Help"),
					"menu-126" => array("attributes" => array("title" => ""), "href" => "mystudies", "title" => "My Studies"),
					"menu-128" => array("attributes" => array("title" => ""), "href" => "store", "title" => "My Livelihood"),
				);

$aPageToCheck = array("entertainment","mystudies","askeet","community","store","hopebank","civicrm","node/20");

$primary_links = (in_array_like($_REQUEST["q"], $aPageToCheck)) ? $aChildPortal:$primary_links;

$theme_imgpath = base_path() . path_to_theme() . "/images/";

//**devtest**//
//pqp_index_console_logSpeed('Time it takes to load the banner + needle command of page-tpl.php');
//pqp_index_console_logMemory($this, 'Watch out of memory leak for Page-tpl.php -- 1');
//**eofdevtest**//


if (isset($_POST['form_id'])) {
	if ($_POST['form_id'] === 'user_login') {
		$_SESSION['login_error'] = 'error';
		header("Location: /login.php");
	}
}

if ($_SERVER['REQUEST_URI'] === '/' || strpos($_SERVER['REQUEST_URI'], 'workz_share_id') !== false) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/hud-v2.php');
	exit;
}

if ($_SERVER['REQUEST_URI'] === '/home') {
	require_once($_SERVER['DOCUMENT_ROOT'].'/home.php');
	exit;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language ?>" xml:lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">-->
<html xmlns:fb="http://www.facebook.com/2008/fbml" 
					xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" 
					lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
<head>
  <title><?php print $head_title ?></title>
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <meta name="google-site-verification" content="-XYIiWGr2JpQ7HsZyEFeWus2WAvLDTw25wycN6oPEgc" />
  <meta name="keywords" content="SEO,Hope Cybrary,Cybrary,hope,children's portal,child,Science,Math,English,Social Studies,Health,Entertainment,Technology,Peace Studies,Productivity,General Reference,Livelihood" />
  <meta name="description" content="The Hope Cybrary (Cyber Library) is a link to a past we can no longer see and a bridge to a future we have yet to address. Libraries represent the most democratic of our institutions, giving the greatest and the least of us alike access to the information they need to build the future of their choice." />
  <?php print $head ?>
  <?php print $styles ?>
	
	<?php
	//<script type="text/javascript" src="/misc/jqueryui/jquery.min.js"></script>
	//<script type="text/javascript" src="/misc/drupal.js"></script>
	
	$scripts = preg_replace('~<script\s+type="text/javascript"\s+src="<?php echo base_path() ?>sites/default/files/js/js_.*?></script>~si', '', $scripts);
	
	echo $scripts;
	?>
	
  <style></style>
  
  <script type="text/javascript">
	<!--
	if (document.images) {
	  preload_image_object = new Image();
	  
	  image_url = new Array();
	  image_url[0] = "<?php echo $theme_imgpath; ?>nav_home_over.jpg";
	  image_url[1] = "<?php echo $theme_imgpath; ?>nav_cybrary_over.jpg";
	  image_url[2] = "<?php echo $theme_imgpath; ?>nav_meet_over.jpg";
	  image_url[3] = "<?php echo $theme_imgpath; ?>nav_sponsor_over.jpg";
	  image_url[4] = "<?php echo $theme_imgpath; ?>nav_community_over.jpg";
	  image_url[5] = "<?php echo $theme_imgpath; ?>nav_about_over.jpg";
	  image_url[6] = "<?php echo $theme_imgpath; ?>nav_faq_over.jpg";
	  image_url[7] = "<?php echo $theme_imgpath; ?>nav_involved_over.jpg";
	   
	   var i = 0;
	   for(i=0; i<image_url.length; i++) 
		 preload_image_object.src = image_url[i];
	}
	var banner_cnt = 4;
	var curr_banner = <?php echo $iHomeRandom; ?>; 
	var curr_template = '<?php echo $sTemplate; ?>';
	
	function changeBanner() {
		curr_banner = (curr_banner == banner_cnt ? 1 : curr_banner * 1 + 1);
		$('<img />')
			.attr('src', "<?php echo $theme_imgpath; ?>banner_home" + curr_banner + ".jpg")
			.load(function(){
				$("#banner").html(' ');
				$("#banner").append( $(this) );
				$("#arrow_nav .nav1 img").attr('src', "<?php echo $theme_imgpath; ?>nav_arrow_home" + curr_banner + ".png")
		});
		setTimeout("changeBanner();", 15000);
	}
	if (curr_template == "home")
		setTimeout("changeBanner();", 15000);
	
	function include(file) {
	   if (document.createElement && document.getElementsByTagName) {
		 var head = document.getElementsByTagName('head')[0];

		 var script = document.createElement('script');
		 script.setAttribute('type', 'text/javascript');
		 script.setAttribute('src', file);

		 head.appendChild(script);
	   } else {
		 alert('Your browser can\'t deal with the DOM standard. That means it\'s old. Go fix it!');
	   }
	}
  //-->
  </script>
  
	<link type="text/css" rel="stylesheet" href="<?php echo base_path()?>misc/jqueryui/jquery-ui.css"/>
	<link type="text/css" rel="stylesheet" href="<?php print base_path().path_to_theme() ?>/sf/superfish.css" />
	<link type="text/css" rel="stylesheet" href="<?php print base_path().path_to_theme() ?>/sf/superfish-navbar.css" />
	
	<!--script type="text/javascript" src="/misc/jqueryui/jquery-ui.min.js"></script-->
	<script type="text/javascript" src="<?php echo base_path()?>misc/jquery.cookie.js"></script>
	
	<script type="text/javascript" src="<?php print base_path().path_to_theme() ?>/cb.js"></script>
	<script type="text/javascript" src="<?php print base_path().path_to_theme() ?>/sf/hoverIntent.js"></script>
	<script type="text/javascript" src="<?php print base_path().path_to_theme() ?>/sf/superfish.js"></script>
	<script type="text/javascript" src="<?php echo base_path()?>sites/all/modules/gtrans/gtranslate_files/jquery-translate.js"></script>

	<?php
	$uri_string = explode('/', $_GET['q']);
	
	if($uri_string[0] == 'askeet'){
		?>
		<link type="text/css" rel="stylesheet" href="<?php echo base_path()?>misc/jquery.treeview.css" />
		
		<script type="text/javascript" src="<?php echo base_path()?>misc/jquery.treeview.js"></script>
		<script type="text/javascript" src="<?php echo base_path()?>misc/jquery.treeview.async.js"></script>
		<script type="text/javascript" src="<?php echo base_path()?>sites/all/modules/askeet/js/askeet.js"></script>
		<?php
	}?>
	<?php 
	if($uri_string[0] == 'kindness'){
	?>
		<script type="text/javascript" src="<?php print base_path() ?>sites/all/modules/kindness/kindness.js?v=<?php echo time(); ?>"></script>
	<?php
	}
	?>
	
  <script type="text/javascript">
   // initialise plugins
  jQuery(function(){
		$("ul.sf-menu").superfish({ 
			pathClass:  'current' 
		}); 
  });
	
  if(jQuery.cookie('cybraryhome') == 'active'){
		jQuery.cookie('cybraryhome', 'inactive', { path: '/' });
		//window.location = 'http://hopefuls.hopecybrary.org/home.php';
		//window.location = 'http://www.hopecybrary.org/home.php';
		// window.location = "<?php echo base_path();?>" + "home.php";;
		window.location = "<?php echo base_path();?>";
  }
  
  function logoutUser(){
	//location.href = "http://" + window.location.host + "/logout";
	location.href = "<?php echo base_path();?>" + "logout";
  }
  jQuery.cookie('kickapps_user', '<?php echo $user->name; ?>', { path: '/' });
  
		
  function validateLogin(myform) {
	err = "";
	document.getElementById("divLoginError").innerHTML = "";
	if (myform.name.value == "")
		err += "Please input your username.<br />";
	if (myform.pass.value == "")
		err += "Please input your password.<br />";	
	
	if (err != "") {
	document.getElementById("divLoginError").innerHTML = err;
	return false;
	} else{		
		$.post(
			Drupal.settings.basePath + "user/ext/account/check/" + myform.name.value,
			{ func: "" },
			function(sReply){
				var oReturn = sReply.RETURN;
				
				if(oReturn == 'hopeful'){
					$("#loginForm").html("You logged in as a Hopeful. It is restricted to login here as a hopeful.<br/> Please click here to go to the <a href='/home.php'>hopeful login area</a>");
					return false;
				}else{
					$("input[name=name]").val(myform.name.value);
					$("input[name=pass]").val(myform.pass.value);
					$("input[name=form_id]").val(myform.form_id.value);
					$('#loginForm3').submit();
								
					//return true;
				}
			},
			"json"
		);
	return false;
	}
  }
  </script>  
  <!--[if IE 6]>
   <script type="text/javascript" src="<?php print base_path().path_to_theme() ?>/ie_png.js"></script>
   <script type="text/javascript">
	   ie_png.fix('.png');
   </script>
<![endif]-->
<!--<link type="text/css" rel="stylesheet" media="all" href="http://www.firsthopecorps.org/sites/all/modules/kickapps/kickapps_teammodal.css"/>-->

</head><!--
<div id="teamboxes">
	<div id="teamdialog" class="window">
	Simple Modal Window | 
	<a href="#"class="close"/>Close it</a>
	</div>
	<div id="teammask"></div>
	</div>-->
<body id="body" class="<?php print $body_classes; ?>">

<div id="page-wrapper"><div id="page">

	<div id="usernotify_Dialog" title="User Notification" style="display:none;">
			Thank you for your interest in joining HopeNet. Please update your information to complete your registration.
  </div>

	<div id="TimerBlockAvailable" style="display:none; position:absolute; z-index:9500; font-size:1.5em; color:#BC5500; padding: 4px 8px; background-color:#E5E5E5; border: 1px solid #B5B5B5;" align="center">
		<div style="text-align:left; font-size:0.8em;">Time Left <sup id="time_tracker_More" style="font-size:0.7em; padding-left:175px;">more</sup></div>
		<div id="time_tracker_TimeAvailable"></div>
	</div>

	<div id="TimerBlockSpent" style="display:none; position:absolute; z-index:9500; font-size:1.5em; color:#BC5500; padding: 4px 8px; background-color:#E5E5E5; border: 1px solid #B5B5B5; top:60px;" align="center">
		<div style="text-align:left; font-size:0.8em">This Session <sup id="time_tracker_Less" style="font-size:0.7em; padding-left:159px;">less</sup></div>
		<div id="time_tracker_TimeSpent"></div>
	</div>
	
	<div class="min-width">
		<div id="main">

			<div id="top_nav_fb" style="display:none;">

			<div id="usernotify_Dialog" title="User Notification" style="display:none;">
				<div id="usernotify_msg"></div>
			</div>

			<span id="login-name"></span>
			<?php
				global $user;
				if ($user->uid){
				
					echo '<b style="margin:15px 0 0 10px;float:left;color:black;">You are logged in as '. $user->name. "</b>";
				}
			?>	
			<span>
				<?php
				if($user->uid){
					echo '&nbsp;&nbsp;<a href="' . base_path() . 'user/' . $user->uid.'" style="color:black !important;font-weight:bold;">My Account</a>';
				}
				?>
			</span>
				
			</div>

			<div id="top_nav">

				<div id="usernotify_Dialog" title="User Notification" style="display:none;">
					<div id="usernotify_msg"></div>
				</div>
				<?php
					global $user;
					global $base_url;
					if ($user->uid){
						echo '<b style="margin:15px 0 0 10px;float:left;color:white;">You are logged in as '. $user->name. "</b>";
					}
				?>	
				<span id="top-selection">
					| <a href="<?=$base_url?>" style="color:#ffffff !important;">Visitors</a>
					| <a href="<?=$base_url?>/intro" style="color:#ffffff !important;">Children</a>
					| <a href="<?=$base_url?>/mystudies/getinvolved" style="color:#ffffff !important;">Volunteers - Sponsors</a>
					|
					<?php
					if($user->uid){
					//echo '&nbsp;&nbsp;<a href="http://visitor.firsthopecorps.org/user/'.$user->uid.'" style="color:#ffffff !important;">My Account</a>';
					echo '&nbsp;&nbsp;<a href="'.$base_url.'/user/'.$user->uid.'" style="color:#ffffff !important;">My Account</a>';
					}
					?>
				</span>
				
			</div> <!-- /#top_nav -->

			<?php if ($show_messages && $messages): print $messages; endif; ?>

			<img src="<?php echo $theme_imgpath; ?>header_construction.png" width="1007" height="119" id="header_image"/>
			
			<div id="banner">
				<img src="<?php echo $theme_imgpath . $sPageBanner; ?>" width="1007" height="217"/>
			</div>

			<div id="main_nav">
				<!--<div class="nav1 <?php //echo @$aActiveNav["home"]; ?>" onClick="location.href='http://visitor.firsthopecorps.org<?php //echo $sCurrPage; ?>'"></div>-->
				<div class="nav1 <?php echo @$aActiveNav["home"]; ?>" onClick="location.href='<?php echo $sCurrPage; ?>'"></div>
				<div class="nav2 <?php echo @$aActiveNav["cybrary"]; ?>" onClick="location.href='<?php echo $sCurrPage; ?>visit-our-cybrary'"></div>
				<div class="nav3 <?php echo @$aActiveNav["hopefuls"]; ?>" onClick="location.href='<?php echo $sCurrPage; ?>meet-the-hopefuls'"></div>
				<div class="nav4 <?php echo @$aActiveNav["programs"]; ?>" onClick="location.href='<?php echo $sCurrPage; ?>programs'"></div>
				<div class="nav5 <?php echo @$aActiveNav["involved"]; ?>">
				<ul class="sf-menu sf-navbar sf-js-enabled sf-shadow">
						<li class="">
						<!--<a class="sf-with-ul" style="border-left:0px solid #fff; border-top:0px solid #CFDEFF; padding:0em 0em;" href="http://visitor.firsthopecorps.org<?php echo $sCurrPage; ?>mystudies/getinvolved">-->
						 <a class="sf-with-ul" style="border-left:0px solid #fff; border-top:0px solid #CFDEFF; padding:0em 0em;" href="<?php echo $sCurrPage; ?>mystudies/getinvolved"> 
						  <div class="nav5 <?php echo @$aActiveNav["involved"]; ?>"></div>
						<span class="sf-sub-indicator"> »</span></a>
						<ul style="display: none; visibility: hidden;padding-top:4px;position:absolute;left: -25px; ">
							 
							<li class="">
								<a class="sf-with-ul" href="<?php echo $sCurrPage; ?>mystudies/getinvolved/ementoring-volunteers">eVolunteer</a>
								<!-- <a class="sf-with-ul" href="<?php echo $sCurrPage; ?>mystudies/getinvolved/volunteer">eVolunteer<span class="sf-sub-indicator"> »</span></a> -->
								<!-- <ul style="display: none; visibility: hidden; ">
									<li><a href="<?php echo $sCurrPage; ?>mystudies/getinvolved/knowledge-portal-volunteers">Knowledge Portal</a></li>
									<li><a href="<?php echo $sCurrPage; ?>entertainment/getinvolved/entertainment-portal-volunteers">Entertainment Portal</a></li>
									<li><a href="<?php echo $sCurrPage; ?>values/getinvolved">Values Portal</a></li>
									<li><a href="<?php echo $sCurrPage; ?>mystudies/getinvolved/etutoring-volunteers">eTutoring</a></li>
									<li><a href="<?php echo $sCurrPage; ?>mystudies/getinvolved/ementoring-volunteers">eMentoring</a></li>
									<li><a href="<?php echo $sCurrPage; ?>mystudies/getinvolved/cybrarian-hopeteam-volunteers">Team & Cybrary Volunteers</a></li>
									<li><a href="<?php echo $sCurrPage; ?>mystudies/getinvolved/esupport-volunteers">eSupport</a></li>
									<li><a href="<?php echo $sCurrPage; ?>mystudies/getinvolved/volunteer">Advocate</a></li>
								</ul> -->
							</li>
							<li class="">
								<a class="sf-with-ul" href="<?php echo $sCurrPage; ?>mystudies/getinvolved/sponsor">Sponsor</a>
							</li>
						</ul>
						</li>
				</ul></div>
				<div class="nav6 <?php echo @$aActiveNav["about"]; ?>" onClick="location.href='<?php echo $sCurrPage; ?>about'"></div>
				<div class="nav7 <?php echo @$aActiveNav["community"]; ?>" onClick="location.href='<?php echo $sCurrPage; ?>community'"></div>
				<div class="nav8 <?php echo @$aActiveNav["faq"]; ?>" onClick="location.href='<?php echo $sCurrPage; ?>faq'"></div>
			</div> <!-- /#main_nav -->

			<div id="arrow_nav">
				<div class="nav1 <?php echo @$aActiveNav["home"]; ?>"><img src="<?php echo $theme_imgpath . $sNavArrow; ?>" border="0" width="27" height="13" /></div>
				<div class="nav2 <?php echo @$aActiveNav["cybrary"]; ?>"><img src="<?php echo $theme_imgpath; ?>nav_arrow_home.png" border="0" width="27" height="13" /></div>
				<div class="nav3 <?php echo @$aActiveNav["hopefuls"]; ?>"><img src="<?php echo $theme_imgpath; ?>nav_arrow_meet.png" border="0" width="27" height="13" /></div>
				<div class="nav4 <?php echo @$aActiveNav["programs"]; ?>" style="width:125px;"><img src="<?php echo $theme_imgpath; ?>nav_arrow_programs.png" border="0" width="27" height="13" /></div>
				<div class="nav5 <?php echo @$aActiveNav["involved"]; ?>"><img src="<?php echo $theme_imgpath; ?>nav_arrow_getinvolved.png" border="0" width="27" height="13" /></div>
				<div class="nav6 <?php echo @$aActiveNav["about"]; ?>"><img src="<?php echo $theme_imgpath; ?>nav_arrow_about.png" border="0" width="27" height="13" /></div>
				<div class="nav7 <?php echo @$aActiveNav["community"]; ?>"><img src="<?php echo $theme_imgpath; ?>nav_arrow_community.png" border="0" width="27" height="13" /></div>
				<div class="nav8 <?php echo @$aActiveNav["faq"]; ?>"><img src="<?php echo $theme_imgpath; ?>nav_arrow_faq.png" border="0" width="27" height="13" /></div>
			</div> <!-- /#arrow_nav -->

			<div class="nav_divider"></div>

			<div id="breadcrumb" style="z-index:90;">
				<?php     
				if ($breadcrumb != ""){
					if ($breadcrumb == '<div class="breadcrumb"><a href="'.base_path().'">Home</a></div>'){
						echo '<div class="breadcrumb"><a href="'.base_path().'" id="home-link">Home</a> <img align="absmiddle" src="' . $theme_imgpath . 'breadcrumb_divider.gif" width="11" height="25" /></div>';
					}else{
						echo str_replace("»",'<img align="absmiddle" src="' . $theme_imgpath . 'breadcrumb_divider.gif" width="11" height="25" />',$breadcrumb);
					}
				}else{
					echo '<div class="breadcrumb"><a href="'.base_path().'">Home</a> <img align="absmiddle" src="' . $theme_imgpath . 'breadcrumb_divider.gif" width="11" height="25" /></div>';
				}
				?>
				
				<div id="login-select" style="position:relative; text-align:right;top:-25px; left:-6px; float:right; z-index:90;">
					<?php if (!$user->uid) { ?>	
					<input type="button" id="btn_userlogin" value="Login" class="btnuser" onClick="$('#divLogin').slideDown()" />
					<input type="button" id="btn_userregister" value="Register" class="btnuser" onClick="location.href='<?php echo $sCurrPage; ?>register/user'" />
					<?php } else { ?>
					<input type="button" id="btn_userlogout" value="Logout" class="btnlogout" onClick="logoutUser();" />
					<?php } ?>
					<select onChange="doTranslate(this);">
						<option value="">Select Language</option>
						<?php
						$target_path = $_SERVER['DOCUMENT_ROOT'].base_path().path_to_theme().'/gtrans_languages.xml'; 
						$xml = simplexml_load_file($target_path);
						$dbs = array();
						$dt_iLangxml = 1;
						foreach($xml as $languages):
							$dbs[htmlentities($languages->name)] = array(
										'name' => htmlentities($languages->name),
										'code'     => htmlentities($languages->code),
										'pixel'    => htmlentities($languages->pixel)
										);
							//**devtest**//
							$ret = $ret . $languages;
							//pqp_index_console_logMemory($ret, 'Total size of data for Language loading XML - Page-tpl.php -- iteration '.$dt_iLangxml);
							$dt_iLang++;
							//**eofdevtest**//
						endforeach;
						ksort($dbs);
						
						//**devtest**//
						//pqp_index_console_logMemory($this, 'Watch out of memory leak for Page-tpl.php -- 2');
						//pqp_index_console_logSpeed('Time it takes to load the language xml command of page-tpl.php');
						//**eofdevtest**//
						$image_base_path = base_path();
						$dt_iLang = 1;
						foreach($dbs as $field => $arr_values):
							  echo '<option value="'.$arr_values['code'].'" style="font-weight:bold;background:url('."'".$image_base_path."sites/all/modules/gtrans/gtranslate_files/16l.png"."'".') no-repeat scroll 0 -'.(int)$arr_values['pixel'].'px;padding-left:18px;">'.$arr_values['name'].'</option>';
						
							  //**devtest**//
							  $ret = $ret . $option;
							  //pqp_index_console_logMemory($ret, 'Total size of data for Language into select boxes - Page-tpl.php -- iteration '.$dt_iLang);
							  $dt_iLang++;
							  //**eofdevtest**//
						endforeach;
						
						//**devtest**//
						//pqp_index_console_logMemory($this, 'Watch out of memory leak for Page-tpl.php -- 3');
						//pqp_index_console_logSpeed('Time it takes to load the language option command of page-tpl.php');
						//**eofdevtest**//
						?>
					</select>
					<?php if (!$user->uid) : ?>
					<div style="position:absolute;z-index:200;width:650px;height:120px; display:none; text-align:left;margin-left:-320px;" id="divLogin">
						<div class="jbox">
							<div class="jboxhead"><h2></h2></div>
							<div class="jboxbody">
								<div id="loginForm" class="jboxcontent" style="text-align:left;color:#000000;margin-left:15px;">
									<h2>LOGIN</h2>
									There are two ways you can login to HopeNet. You can login with our<br/> HopeNet form, or you can login through Facebook.
									<div style="clear:both;height:140px;padding-top:5px;">
									  <div style="float:left;width:300px;height:120px;">
									  <h2>Login using Facebook</h2>
										<br/><?php 
										if(module_exists('fboauth')){
										print fboauth_action_display('connect');
										}
										?><br/><br/>
										Skip the forms by signing in with your Facebook account <a href="#">Learn More</a>
									  </div>
									  <div style="float:left;padding-left:40px;width:200px;height:120px;">
										<div class="notice" id="divLoginError"></div>
										<h2>Login using HopeNet</h2>
										<form id="loginForm2" action="<?php echo $sCurrPage; ?>user" method="post" onSubmit="return validateLogin(this);">
											<table cellpadding="2" cellspacing="2" border="0" width="100%">
												<tr><td style="padding:2px;" width="50">Username:</td><td style="padding:2px;"><input type="text" style="font-family:sans-serif;" name="name" onFocus="if (this.value == 'Username') this.value = '';" /></td></tr>
												<tr><td style="padding:2px;">Password:</td><td style="padding:2px;"><input type="password" style="font-family:sans-serif;" name="pass" onFocus="if (this.value == 'Password') this.value = '';" /></td></tr>
												<tr><td style="padding:2px;"></td><td style="padding:2px;">
													<input type="hidden" name="form_id" id="edit-user-login" value="user_login" />
													<input type="submit" name="op" value="Log in" class="btnuser" /> 
													<input type="button" name="btnClose" value="Close" class="btnuser" onClick="$('#divLogin').slideUp()" />
												</td></tr>
											</table>
										</form>
										<form id="loginForm3" action="<?php echo $sCurrPage; ?>user" method="post">
										<input type="hidden" name="name" />
										<input type="hidden" name="pass" />
										<input type="hidden" name="form_id" id="edit-user-login" value="user_login" />
										 <input type="hidden" name="op" value="Log in" class="btnuser" /> 
										</form>
									  </div>
									</div>
								</div>
							</div>
							<div class="jboxfoot"><p></p></div>
						</div> 
					</div>
					<?php endif; ?>
				</div>
				
				
			</div> <!-- /#breadcrumb -->

			<div id="mainpage">
				<!-- Main Content --> 			
				<?php   			
				if($_SESSION['ka_cname'] == null){
					if($_GET['redirectUrl']){
					} else{
					?>
					<!--<iframe id="hidden_kickapps" style="display:none;" src="http://affiliate.kickapps.com/user/logoutUser.kickAction?as=158175" frameborder="0"></iframe>-->
					<?php
					}
				} else{
				?>
				<!--<iframe id="hidden_kickapps" style="display:none;" src="http://affiliate.kickapps.com/service/displayKickPlace.kickAction?as=158175&u=<?php //echo $_SESSION['ka_uid']."&st=".$_SESSION['ka_st']."&tid=".$_SESSION['ka_tid'] ?>" frameborder="0"></iframe>-->
				<?php
				}
				
				if (strpos($_GET['q'],"mystudies/getinvolved/admins/pending/") !== false || strpos($_GET['q'],"adopt-team") !== false  || strpos($_GET['q'],"create-team") !== false ) {
					$sTemplate = 'mystudy';
				}

				if (file_exists("themes/theme2010/page-" . $sTemplate . ".tpl.php"))
					require_once("page-" . $sTemplate . ".tpl.php");
				else
					require_once("page-default.tpl.php");
				?>		
			</div> <!-- /#mainpage -->

			<div class="bottom-breadcrumbs" style="display:none;" align="center">
				<a href="<?php echo base_path()?>visit-our-cybrary">Visit our Cybrary</a> | <a href="<?php echo base_path()?>meet-the-hopefuls">Meet the HopeFuls</a> | <a href="<?php echo base_path()?>programs">Programs</a> | | <a href="<?php echo base_path()?>community">Community</a>
			</div>
		
			 
			<div class="divider"></div>

		</div> <!-- /#main -->

	</div> <!-- /.min-width -->

	<div id="footer">
		<div class="foot">
			<?php
			if ($footer_message || $footer) {
				print $footer_message;
			}
			?>
		</div>
		<div id="bottom_ad">
			<script type="text/javascript"><!--
			google_ad_client = "pub-2114077817725080";
			/* Hope Cybrary 728x90 */
			google_ad_slot = "1597925796";
			google_ad_width = 728;
			google_ad_height = 90;
			//-->
			</script>
			<!-- <script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script> -->
		</div>
	</div> <!-- /#footer -->

</div></div><!-- /#page, /#page-wrapper -->

<script type="text/javascript" src="<?php print base_path().path_to_theme() ?>/jquery.jcarousel.min.js"></script>
<?php
if($sTemplate == 'mystudy'){
$varfunct = 1;
} elseif($sTemplate == 'hopefuls'){
$varfunct = 2;
} elseif($sTemplate == 'programs'){
$varfunct = 3;
} else{
$varfunct = 0;
}
?>
<script type="text/javascript">
	function doTranslate(lang_pair, lang_load){
		if (lang_pair.value)lang_pair=lang_pair.value;
						
		var lang=lang_pair.split('|')[1];
						
		if (lang=='pt') lang='pt-PT';  					
		jQuery.cookie('glang_prev', (jQuery.cookie('glang')) ? jQuery.cookie('glang'):"en", { path: '/'});
		jQuery.cookie('glang', lang, { path: '/' });
		
		location.reload(true);
	}

	function defaultTranslate(lang){
		var func = <?php echo $varfunct; ?>;
		if ($("#mainpage").css("top") == "-15px") $("#mainpage").css("top", "0px");
		switch(func){
		case 1:
		jQuery(function($){$('body').translate(jQuery.cookie('glang_prev'), lang, addScript)});
		break;
		case 2:	
		jQuery(function($){$('body').translate(jQuery.cookie('glang_prev'), lang, loadinccybrary)});
		break;
		case 3:			
		jQuery(function($){$('body').translate(jQuery.cookie('glang_prev'), lang, loadCarousel)});
		break;
		default:
		jQuery(function($){$('body').translate(jQuery.cookie('glang_prev'), lang)});
		}
	}

	if(jQuery.cookie && jQuery.cookie('glang') !== null){
		defaultTranslate(jQuery.cookie('glang'));
	} 
	
	if(<?php echo $varfunct; ?> == 3){
		loadCarousel();
	}
	
	function addScript() {
		var js = document.createElement('script');
		js.setAttribute('type', 'text/javascript');
		//js.src = '/sites/all/modules/mystudies/mystudies.js';
		//js.src = '/sites/all/modules/entertainment/entertainment.js';
		js.src = "<?php echo base_path()?>sites/all/modules/mystudies/mystudies.js";
		js.src = "<?php echo base_path()?>sites/all/modules/entertainment/entertainment.js";
		document.body.appendChild(js);
		
		var css = document.createElement("link");
		css.setAttribute("rel", "stylesheet");
		css.setAttribute("type", "text/css");
		css.setAttribute("href", 'style.css');
		document.body.appendChild(css);
						  
		if ($("#mystudies_VolunteerCatList").length == 1){
			$("#mystudies_VolunteerCatList").treeview(
			{url: Drupal.settings.basePath+"askeet/question/cats", unique: true}
			);
		}
		if ($("#mystudies_VolunteerCatList2").length == 1){
			$("#mystudies_VolunteerCatList2").treeview(
			{url: Drupal.settings.basePath+"askeet/question/cats", unique: true}
			);
		}
	}
						
	function loadinccybrary() {
		var js = document.createElement('script');
		js.setAttribute('type', 'text/javascript');
		//js.src = '/sites/all/modules/incybrary/incybrary_meet_our_children.js';
		js.src = "<?php echo base_path()?>sites/all/modules/incybrary/incybrary_meet_our_children.js";
		document.body.appendChild(js);
	}
					
	function loadCarousel() {
		jQuery('#mycarousel').jcarousel({
		//wrap: 'circular'
		itemFallbackDimension : 210
		});
	}
	
	if (top === self) { 
	} else { 
	 //$('#home-link').html('<a href="/mystudies/getinvolved/volunteer" style="display:block;margin-top: 5px;">Get involved > Home</a>');
	  //$('#home-link').attr('href','/mystudies/getinvolved/volunteer');
	  $('#home-link').attr('href',"<?php echo base_path()?>instant/mentor/dashboard/");
	  $('#top-selection').hide();	
	  //$('#breadcrumb').hide();
	  $('#main_nav').hide();
	  $('#top_nav').hide();
	  $('#top_nav_fb').show();
	  $('#arrow_nav').hide();
	 // $('#banner').hide();
	  $('#banner').html('<div style="height:10px;">&nbsp;</div>');
	  //$('#login-select').hide();
	  $('#header_image').hide();
	  $('.nav_divider').hide();
	  $('#footer').hide();
	  // $('.bottom-breadcrumbs').show();
	  //$('.divider').hide();
	  $("#body").attr('style',"background-position:-50px;background:none;background-color:#D1D8E4;");
	  $("#login-select").html('<span style="margin-left:12px;"><a onclick="javascript:history.go(-1);" style="font-size:14px; cursor:pointer;color:white;font-weight:bolder;"><</a>&nbsp;&nbsp;&nbsp;<a onclick="javascript:history.go(+1);" style="font-size:14px; cursor:pointer;color:white;font-weight:bolder;">></a></span>')
	  //$("#login-bname").attr("style","color:black;margin-top:-15px;");	
	  //$("#login-baccount").attr("style","color:black;margin-top:-15px;");
	  $('#body').addClass('iframe');
	}
</script>

<?php print $closure;?>

</body>
</html>
<?php
}
?>

<?php
set_time_limit(30);

 drupal_set_title(check_plain('test'));
 
flush();
ob_flush();

//**devtest**//
//pqp_index_console_logMemory($this, 'Watch out of memory leak for Page-tpl.php -- 5');
//pqp_index_console_logSpeed('Time it takes to end the page-tpl.php');
//**eofdevtest**//
	
//$profiler = new PhpQuickProfiler(PhpQuickProfiler::getMicroTime());
//$profiler->display();
?>
