<?php
require_once "./includes/bootstrap.inc";
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

// Checks if the current user is logged in.
//if ($user->uid == 0) header("Location: user?destination=home.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cybrary Time Tracker</title>
<script type="text/javascript" src="../misc/jquery.js?q"></script>
<script type="text/javascript" src="../home_files/home.js"></script>
<link href="../home_files/style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="../home_files/jquery.jScrollPane.css" type="text/css" />
<script type="text/javascript" src="../home_files/jquery.mousewheel.js"></script>
<script type="text/javascript" src="../home_files/jquery.jScrollPane.js"></script>
<!--[if IE 7]>
<link href="../home_files/ie7.css" rel="stylesheet" media="all" />
<![endif]-->
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
//location.href = 'http://hopefuls.hopecybrary.org/logout?page=home';
location.href = 'http://www.hopecybrary.org/logout?page=home';
}

function mockaccount(){
jQuery.cookie('cybraryhome', 'active', { path: '/' });
//location.href = 'http://hopefuls.hopecybrary.org/user/visitor?destination=user';
location.href = 'http://www.hopecybrary.org/user/visitor?destination=user';
}

var autologout = '<?=$_GET['logout']?>'; 

if(autologout == 'true'){
landch();
}
//-->
</script>
</head>
<body onload="MM_preloadImages('../home_files/images/member02.png','../home_files/images/but03-02.png')">
<img id="under_construction" src="<?php echo base_path() ?>misc/under_construction_site.png" border="0" style="position:absolute; top:90px; z-index:3000;" title="Site Under Construction" />

<div id="home_Carousel" style="display:none; position:absolute; top:420px; z-index:1; border:none;">
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="913" height="600" id="carousel" align="middle">
		<param name="allowScriptAccess" value="sameDomain" />
		<param name="allowFullScreen" value="false" />
		<param name="movie" value="../home_files/carousel.swf" />
		<param name="quality" value="high" />
		<param name="wmode" value="transparent" />
		<param name="bgcolor" value="#333333" />
		<embed src="../home_files/carousel.swf" quality="high" wmode="transparent" bgcolor="#333333" width="913" height="600" name="carousel" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
</div>

<div class="wrapper">
    <div id="top_nav">
		<?php
			global $user;
			if ($user->uid)
				echo '<b  style="margin:15px 0 0 10px;float:left;color:#fff">You are logged in as '. $user->name. "</b>";
		?>		
	</div>
	<div class="main">
		<div class="header">
			<div class="header_wrp">
				<div class="logo">
					<img src="../home_files/images/hopenet_logo.png" alt="Hope Net" height="63" width="149" border="0" />
					<div style="color:#FFFFFF; font-weight:bold; margin-top:10px; font-size:1.1em">1st Earth Alliance</div>
				</div>
				<div class="header_right_text">
					<div class="top_right_text">
						<strong>"and a child will lead them"</strong>
						<div style="font-size:0.9em"><i>... the Hope Prophecies</i></div>
					</div>
					<div class="hd_green_text_main_bg">
						<div class="hd_green_text_main_bg_top"></div>
						<div class="hd_green_text_main_bg_mid">
							<div class="hd_green_text">
								<h5>Welcome to 1st Earth Alliance</h5>
								<div>
									We hope that you will join us in the 1st Earth Alliance in our quest for hope and peace. We are a virtual 
									army of youths and adult volunteers who are dedicated to fulfilling the prophecies of the "Legend of Hope".
									
									<div style="display:none;" id="more_txt">
										<p>The mission of the 1st Earth Alliance is to restore hope with the goal of bringing peace and prosperity to our planet.</p>
										<p style="color:#FFFFFF;">If you would like to learn more about the 1st Earth Alliance then please begin by clicking on the Earth Alliance button in the slider below.</p>
									</div>
								</div>
								<div class="readmore" id="learn_more"> <strong><a href="javascript:ToggleMe();">Learn More &gt;&gt;</a></strong> </div>
								<div class="readmore" id="hide_more" style="display:none"> <strong><a href="javascript:ToggleMe();">Hide Me &gt;&gt;</a></strong> </div>
							</div>
						</div>
						<div class="hd_green_text_main_bg_bottom"></div>
					</div>
				</div>
				<div class="header_bottom">
				<?php if (!$user->uid) { ?>	 
					<div id="notlogeddinredirect" class="membership">
						<a href="javascript:void(0);" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image7','','../home_files/images/but03-02.png',1)" class="menuLink" style="background:url(../home_files/images/membership.png) right top no-repeat;">
							<img src="../home_files/images/but03.png" name="Image7" width="117" height="17" border="0" id="Image7" />
						</a>
						<div id="home_notLoggedinmessage">
							<center style="font-size:1.3em; color:#FFF200;">You have to log-in first.</center>
							<hr style="height:1px; color:#54EC1A;" />
							<p align="center">Please log-in below to see the alpha version of the Hope Shuttle HUD (Head Up display).</p>
					    </div>
					</div>
				<?php } else{ ?>
					<div id="logeddinredirect" class="membership">
						<a href="javascript:void(0);" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image7','','../home_files/images/but03-02.png',1)" class="menuLink" style="background:url(../home_files/images/membership.png) right top no-repeat;">
							<img src="../home_files/images/but03.png" name="Image7" width="117" height="17" border="0" id="Image7" />
						</a>
					</div>
				<?php } ?>
				</div>
				<div style="color:#FFFFFF; margin:270px 0px 0px 27px; font-size:0.8em;">Exodus to hope</div>
			</div>
		</div>
		<div class="bk_grid">
			<ul id="home_Breadcrumb">
				<li>Home &gt;&nbsp;</li>
				<li>1st Earth Alliance</li>
			</ul>
			<?php if (!$user->uid) { ?>	
			<div id="home_register" class="registertext">
						<a href="javascript:void(0);" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image8','','../home_files/images/registertexthover.png',1)" class="menuLink" style="height:30px; width:135px; background:url(../home_files/images/login.png) right top no-repeat;padding:10px 0 0px 4px;">
							<img src="../home_files/images/registertext.png" name="Image8" width="90" height="14" border="0" id="Image8" style="padding-left:45px;" />
						</a>
					<div id="home_MembershipNotice">
							<center style="font-size:1.3em; color:#FFF200;">Coming Soon</center>
							<hr style="height:1px; color:#54EC1A;" />
							<p align="center">The Membership Signup is coming soon.</p>
							<p align="center">Please first log-in and click on the "Launch HopeNet" above to see the alpha version of the Hope Shuttle HUD (Head Up display).</p>
					</div>	
			</div>
			<div id="home_login" class="logintext">
						<a href="javascript:void(0);" onclick="$('#divLogin').slideDown()" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image8','','../home_files/images/logintexthover.png',1)" class="menuLink" style="height:30px; width:135px; background:url(../home_files/images/login.png) right top no-repeat;padding:10px 0 0px -20px;">
							<img src="../home_files/images/logintext.png" name="Image8" width="90" height="14" border="0" id="Image8" style="padding-left:45px;" />
						</a>
			
            <?php if (!$user->uid) { ?>	
					<div style="position:absolute;z-index:200;width:250px;height:100px; display:none; text-align:center;" id="divLogin">
                        <div class="jbox">
                            <div class="jboxhead"><h2></h2></div>
                            <div class="jboxbody">
                                <div class="jboxcontent" style="text-align:center;color:#fff">
                                	<div class="notice" id="divLoginError"></div>
                                	<form action="<?php echo $sCurrPage; ?>user" method="post" onsubmit="return validateLogin(this);">
                                        <table cellpadding="2" cellspacing="2" border="0" width="100%">
                                            <tr><td style="padding:2px;" width="50">Username:</td><td style="padding:2px;"><input type="text" name="name" onfocus="if (this.value == 'Username') this.value = '';" /></td></tr>
                                            <tr><td style="padding:2px;">Password:</td><td style="padding:2px;"><input type="password" name="pass" onfocus="if (this.value == 'Password') this.value = '';" /></td></tr>
                                            <tr><td style="padding:2px;"></td><td style="padding:2px;">
                                                <input type="hidden" name="form_id" id="edit-user-login" value="user_login" />
                                                <input type="submit" name="op" value="Log in" class="btnuser" /> 
                                                <input type="button" name="btnClose" value="Close" class="btnuser" onclick="$('#divLogin').slideUp()" />
                                            </td></tr>
                                        </table>
									</form>
                                </div>
								<div align="left"><a href="javascript:void(0);" onclick="mockaccount();" style="color:#fff;text-decoration:underline;">Visitors click here</a></div>
                            </div>
                            <div class="jboxfoot"><p></p></div>
                        </div> 
                    </div>
					<?php } ?>
			</div>
			<?php } else{ ?>
			<div class="registertext">
						<a href="javascript:void(0);" onclick="landch();" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image8','','../home_files/images/logouttexthover.png',1)" class="menuLink" style="height:30px; width:135px; background:url(../home_files/images/login.png) right top no-repeat;padding:10px 0 0px 4px;">
							<img src="../home_files/images/logouttext.png" name="Image8" width="90" height="14" border="0" id="Image8" style="padding-left:45px;" />
						</a>
			</div>
			<?php } ?>
			
		</div>
		<div class="body_section">
			<div class="flash">
				<div class="bg_arrow"><a id="home_ContentTitle" href="#">1st Earth Alliance</a></div>
				
				<div class="clear"></div>
				<div class="flash_lft" style="border:0px solid yellow;">
					<img id="home_LeftNavImg" src="../home_files/images/sword_into_plow.png" />
					
					<div id="home_GoToKnowledgeDemo" style="display:none; font-size:0.9em; position:relative; top:-60px; padding-left:27px;" class="link_btm" onclick="ToggleContent('KnowledgeDemo')"><img src="../home_files/images/but02.png" /></div>
					<div id="home_GoToKnowledgePortal" style="display:none; font-size:0.9em; color:#000000; position:relative; top:-80px; font-weight:bold;" class="link_btm" onclick="ToggleContent('Knowledge')"><img src="../home_files/images/but01.png" /></div>
					
					<div id="home_LeftNavDemo" style="display:none; text-align:center;">
						<h2 style="color:yellow;">Knowledge Portal Demonstration</h2>
						
						<div style="border:3px solid yellow; color:yellow; width:95%; margin-top:35px; margin-left:auto; font-size:0.9em;">
							<p>For a demo of the Knowledge Portal, click only on the</p>
							
							<div>Science &gt; Space &gt; Space Exploration</div>
							
							<p>buttons in the rotating carousel.</p>
							
							<div style="font-size:0.8em; margin:30px 0px 10px 0px; width:100%; text-align:center; cursor:pointer;" onclick="ToggleContent('1stHopeCorps');">Back to Main Menu</div>
						</div>
					</div>
				</div>
				
				<div class="flash_rt winXP">
					<div class="content_style" id="home_Content1stHopeCorps">
						<div style="padding-top:20px;">
						<?php
						echo $content;
						?>
						</div>
					</div>
					
					<div id="home_ContentCybrary" class="content_style" style="display:none;">
						<p>The Hope Cybrary (cyber - library) is a children's sanctuary for knowledge, virtues and spirituality and 
						will eventually serve as a base of operations for our Hope Teams. The first Hope Cybrary has been established 
						in the Barangay Olympia, Makati City, Philippines. We are beginning with a small prototype 12 seat facility 
						that provides free library facilities and computer-Internet access. Beginning in June 2010, Makati, Philippines 
						we will begin to operate our first cybrary and as resources permit we then will expand to other cities, regions 
						and countries.</p>
						
						<p>Click the buttons on the slider below to learn more about HopeNet, the 1st Earth Alliance and the Hope Team.</p>
					</div>
					
					<div id="home_ContentHopeTeam" class="content_style" style="display:none;">
						<p>The Hope Team is somewhat similar in form to other youth organizations such as the Boy/Girl Scouts,YMCA and 
						Boys & Girls Clubs. However, rather than focus on sports, outdoor activities, or arts and crafts etc, the Hope 
						Teams will focus their efforts on community service and community/nation building skills.</p>
						
						<p>Beginning first quarter 2011 in Makati, Philippines we will establish our first Hope Team, and as resources 
						permit we then will expand to other cities, regions and countries.</p>
					</div>
					
					<div id="home_ContentHopeNet" class="content_style" style="display:none;">
						<p>HopeNet is designed to merge the virtual world with the real world to provide the Hopeful's with the optimum 
						learning, growing and life skills experience. HopeNet provides virtual world services such as the Knowledge 
						Portal, eTutoring, and eMentoring; and on a case-by-case basis, qualified Hopefuls will receive, school books, 
						uniform and scholarships through HopeNet Sponsors. HopeNet will also provides real-time, one-to-one contact 
						between the Hopefuls and their sponsors using email, chat messaging, 3-D virtual worlds, and video and voice 
						conferencing.</p>
						
						<p>Click the buttons on the slider below to learn more about the 1st Earth Alliance, the Cybrary and the Hope Team.</p>
					</div>
					
					<div id="home_ContentMentoring" class="content_style" style="display:none;">
						<p>Every Hopeful has a dream and the objective of the HopeNet eMentoring service is to provide each Hopeful 
						with a caring adult to help guide them to their dream. HopeNet eMentors from around the world will mentor the 
						Hopefuls by providing guidance, counseling and friendship. The eMentoring program is similar to the Big 
						Brothers - Big Sisters program located in the U.S., except that this program would be done entirely online.</p>
						
						<p>It is projected that the Private eMentoring program will launch December 2010.</p>
					</div>
					
					<div id="home_ContentEntertainment" class="content_style" style="display:none;">
						<p>The Entertainment Portal furnishes the Hopefuls with a wide variety of online recreational activities such 
						as social networking, games, music, videos, books, and online-TV etc. The entertainment activities are provided 
						as a reward for participating in HopeNet activities such as Kindness Workz, Community Building and the 
						Knowledge Portal. The Hopefuls can participate in the entertainment either individually or as part of a group. 
						For Example: We will feature brain- games including chess, checkers etc, but also allow some of the popular 
						(non violent) entertainment arcade and role playing games.  We will also provide customizable, intelligent 
						Avatars and Virtual World where the Hopefuls can create their own worlds.  Educational oriented games will have 
						no additional cost, but purely entertainment games/activities will require usage of additional Hope-Bucks.</p>
						
						<p>The Entertainment Portal will launch June 2010.</p>
					</div>
					<div id="home_ContentLivelihood" class="content_style" style="display:none;">
						<p>HopeNet will encourage entrepreneurship and responsible purchasing in the Hopefuls from the very beginning of 
						their entrance into HopeNet. HopeNet has several eLivelihood programs including our My-eStore program, 
						eCommissary and our Online Advertising revenue program.</p>
						
						<p>One of our primary goals is to enable the Hopefuls to become financially self supporting, and we feel	
						strongly that if we cultivate entrepreneurship and responsible purchasing from an early age then the children 
						will learn to be able to help support themselves and their families. From the very beginning the Hopefuls will 
						have access to our eCommissary where they can use their Hope-Bucks to purchase primarily necessary and 
						educational products and down-loadable goods such as school supplies, computer electronics, books and some 
						entertainment items. The products will be provided by HopeNet sponsors who are more than happy to lend a 
						helping hand to children who are proven to help themselves and their community.</p>

						<p>After having been enrolled in HopeNet for a period of time and meeting the minimum requirements, we will also 
						provide the Hopefuls with their own online store through our My-eStore program. My eStore allows the Hopefuls 
						to sell down-loadable goods of their own creation such as artwork, music, videos, etc. Eligible Hopefuls will 
						also be provided with their own Advertising revenue program which they can use to run online advertisements in 
						their My-eStore and their Virtual Community pages. The funds from the Advertising revenue program will be 
						deposited in a trust account for the Hopefuls and released after a predetermined period of time.</p>
						
						<p>It is projected that the eLivelihood program will launch fourth quarter 2010.</p>
					</div>
					
					<div id="home_ContentPeace" class="content_style" style="display:none;">
						<p>The HopeNet Peace Building program involves several programs including our Values & Virtues, Spirituality, 
						and our Kindness program.  Our flagship Peace Building program is our Kindness program, where the Hopefuls 
						provide community services such as garbage clean up, tree planting, repair and other Kindness-Workz. As a form 
						of encouragement and recognition to the Hopefuls for participating in the Kindness program they receive 
						Hope-Bucks for their Kindness Workz.</p>
						
						<p>The Values & Virtues program provides a forum for the Hopefuls to exercise and recognize the value of virtues 
						such as empathy, courage, persistence, wisdom and tolerance. Our Spirituality program encourages the Hopeful to 
						tolerate all faiths and to exercise and study the faith of their choosing.</p>
						
						<p>HopeNet is fueled by the Kindness program, which all other HopeNet programs are based upon. All HopeNet 
						services are free of monetary cost to the Hopefuls, however before a Hopeful can utilize a HopeNet service they 
						are required to perform Kindness Workz (community service) within their local community.</p>
						
						<p>The purpose of the Kindness program is twofold: First of all, our main goal is for the Hopefuls to spread 
						hope and rekindle the faith of the people - giving them something to believe in. We believe that the Kindness 
						performed by the Hopefuls on a consistent basis will cause a chain reaction of Kindness - Hope and Faith, and 
						ultimately... Peace.  Secondly, the Kindness activities are intended to serve as a character building exercise 
						for the Hopefuls which will permeate and enhance all facets of the lives of the Hopefuls.
						
						<p>It is projected that the Values & Virtues program along with the Spirituality program  will launch in the 
						third quarter 2010.</p>
					</div>
					
					<div id="home_ContentTutoring" class="content_style" style="display:none;">
						<p>HopeNet will provide two types of remote eTutoring assistance to the Hopefuls including Instant eTutoring and 
						Private eTutoring. The eTutoring service provides assistance that supplements our self-service Knowledge Portal.</p>   
						
						<p>The Instant eTutoring program will allow the Hopefuls to post questions online related to their studies and 
						those questions can then be answered by volunteer tutors. Similar to a librarian, our Volunteers will use their 
						best efforts to guide the Hopefuls to discovering the answers to their questions through the Knowledge Portal, 
						rather than simply answering the question for the Hopeful.</p>
						
						<p>It is projected that the Instant eTutoring program will launch 3rd quarter of 2010 and the Private eTutoring 
						program will launch 4th quarter of 2010.</p>
					</div>
					
					<div id="home_ContentKnowledge" class="content_style" style="display:none;">
						<p>The Knowledge Portal is a free, web based, collaborative, virtual library and a portal to the trillion+ pages 
						of information on the Internet. It provides the Hopefuls with instant access to the best of the best educational 
						websites, videos, books/reports, photos, animations, designed especially for children to assist them in their 
						studies. All major subjects are covered including science, math, language, social studies, technology etc.</p>
						
						<p>The Knowledge Portal will launch June 2010.</p>
						
						<p style="cursor:pointer;" onclick="ToggleContent('KnowledgeDemo')"><u>To see a demonstration of the Knowledge Portal, just click this link</u>.</p>
					</div>
				</div>
				
				<div class="bottom_sec">
					<div class="bottom_sec_lft">
						<p style="height:30px;">&nbsp;</p>
						
						<div class="img_btm_lft">
							<p>Click any of the slider buttons to preview our Earth Alliance Services</p>
							<div id="home_BackToMain" style="display:none;" class="link_btm" onclick="ToggleContent('1stHopeCorps');">Back to Main Menu</div>
						</div>
					</div>
					<div class="bottom_sec_rt">
						<div id="home_Slider1" style="margin:10px;">
							<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="613" height="140" id="slider1" align="middle">
								<param name="allowScriptAccess" value="sameDomain" />
								<param name="allowFullScreen" value="false" />
								<param name="movie" value="http://www.hopecybrary.org/home_files/slider.swf" />
								<param name="quality" value="high" />
								<param name="wmode" value="transparent" />
								<param name="bgcolor" value="#333333" />
								<embed src="http://www.hopecybrary.org/home_files/slider.swf" quality="high" wmode="transparent" bgcolor="#333333" width="613" height="140" name="carousel" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
							</object>
						</div>
						
						<div id="home_Slider2" style="display:none; margin:10px;">
							<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="613" height="140" id="slider2" align="middle">
								<param name="allowScriptAccess" value="sameDomain" />
								<param name="allowFullScreen" value="false" />
								<param name="movie" value="http://www.hopecybrary.org/home_files/slider_hopenet.swf" />
								<param name="quality" value="high" />
								<param name="wmode" value="transparent" />
								<param name="bgcolor" value="#333333" />
								<embed src="http://www.hopecybrary.org/home_files/slider_hopenet.swf" quality="high" wmode="transparent" bgcolor="#333333" width="613" height="140" name="carousel" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
							</object>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="flash_footer"></div>
		<div class="footer">
			<div class="footer_link">Hope Street Association, 5034 Banahaw Street, Barangay Olympia, Makati City, Philippines</div>
		</div>
	</div>
</div>
</body>
</html>
