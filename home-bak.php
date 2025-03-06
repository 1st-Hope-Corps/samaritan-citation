<?php
require_once "./includes/bootstrap.inc";
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

// Checks if the current user is logged in.
//if ($user->uid == 0) header("Location: user?destination=home.php");

require_once(drupal_get_path('module', 'pqp_index').'/classes/PhpQuickProfiler.php');
pqp_index_console_log('Begin logging data');
?>
<?php
//echo $_COOKIE['cybraryhome'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Samaritan Citation - Home</title>
<script type="text/javascript" src="misc/jqueryui/jquery.min.js?q"></script>
<script type="text/javascript" src="home_files/home.js"></script>
<link href="home_files/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="sites/all/modules/devel/devel.css" rel="stylesheet" />
<link rel="stylesheet" href="home_files/jquery.jScrollPane.css" type="text/css" />
<script type="text/javascript" src="home_files/jquery.mousewheel.js"></script>
<script type="text/javascript" src="home_files/jquery.jScrollPane.js"></script>
<!--[if IE 7]>
<link href="home_files/ie7.css" rel="stylesheet" media="all" />
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
</head>
<body onload="MM_preloadImages('home_files/images/member02.png','home_files/images/but03-02.png')">
<img id="under_construction" src="<?php echo base_path() ?>misc/under_construction_site.png" border="0" style="position:absolute; top:440px; z-index:3000;
    left: 42%;" title="Site Under Construction" />

<div id="home_Carousel" style="display:none;" style="display:none; position:absolute; top:420px; z-index:1; border:none;">
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="913" height="600" id="carousel" align="middle">
		<param name="allowScriptAccess" value="sameDomain" />
		<param name="allowFullScreen" value="false" />
		<param name="movie" value="home_files/carousel.swf" />
		<param name="quality" value="high" />
		<param name="wmode" value="transparent" />
		<param name="bgcolor" value="#333333" />
		<embed src="home_files/carousel.swf" quality="high" wmode="transparent" bgcolor="#333333" width="913" height="600" name="carousel" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
</div>

<div class="wrapper">
	<div class="main">

		<div class="bk_grid" style="background: url(home_files/images/bk_grid_bg_top.png) left top no-repeat;height: 150px;display: flex;">
			<div style="padding: 10px;background-color: #FFF;border: 2px solid #efdb53;border-radius: 15px;    width: 125px;
    height: 113px;
    margin-top: -5px;">
					<img id="home_LeftNavImg" src="/hud_files/images/1st-hope-logo.png" style="    width: 100%;
    height: 120px;">
						
					</div>
			<div style="    margin-left: auto;
    width: 40%;
    display: flex;
    align-items: center;
  justify-content: center;">
				
			
			<?php if (!$user->uid) { ?>	
				<div id="home_login" class="logintext" style="margin-top:-40px">
						<a href="javascript:void(0);" onclick="$('#divLogin').slideDown()" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image8','','home_files/images/logintexthover.png',1)" class="menuLink" style="background: linear-gradient( to top, rgb(255 255 255 / 62%) 0%, rgb(217 217 217 / 50%) 50%, rgb(52 52 52 / 52%) 99%, rgb(173 173 173) 100%);
    width: 100px;
    height: 17px;
    text-align: center;
    font-size: 1rem;
    vertical-align: middle;
    border: 1px solid #efdb53;
    padding-top: 10px;
    border-radius: 5px;
    padding-bottom: 10px;">
							Login
						</a>
			
            <?php if (!$user->uid) { ?>	
					<div style="position:absolute;z-index:200;height:100px; display:none; text-align:center;" id="divLogin">
                        <div class="jbox">
                            <div class="jboxhead"><h2></h2></div>
                            <div class="jboxbody">
                                <div class="jboxcontent" style="text-align:center;color:#fff">
                                	<div class="notice" id="divLoginError"></div>
                                	<form action="<?php echo $sCurrPage; ?>user?page=home" method="post" onsubmit="return validateLogin(this);">
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
			<div id="home_register" class="registertext" style="margin-left: 20px;margin-top:-40px">
				<a href="javascript:void(0);" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image8','','home_files/images/registertexthover.png',1)" class="menuLink" style="background: linear-gradient( to top, rgb(255 255 255 / 62%) 0%, rgb(217 217 217 / 50%) 50%, rgb(52 52 52 / 52%) 99%, rgb(173 173 173) 100%);
    width: 100px;
    height: 17px;
    text-align: center;
    font-size: 1rem;
    vertical-align: middle;
    border: 1px solid #efdb53;
    padding-top: 10px;
    border-radius: 5px;
    padding-bottom: 10px;">
					Register
				</a>
				<div id="home_MembershipNotice">
						<center style="font-size:1.3em; color:#FFF200;">Coming Soon</center>
						<hr style="height:1px; color:#54EC1A;" />
						<p align="center">The Membership Signup is coming soon.</p>
						<p align="center">Please first log-in and click on the "Launch HopeNet" above to see the alpha version of the Hope Shuttle HUD (Head Up display).</p>
				</div>	
			</div>
			
			<?php } else{ ?>
				<div class="registertext">

							<a href="javascript:void(0);" onclick="landch();" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image8','','home_files/images/logouttexthover.png',1)" class="menuLink"  style="background: linear-gradient( to top, rgb(255 255 255 / 62%) 0%, rgb(217 217 217 / 50%) 50%, rgb(52 52 52 / 52%) 99%, rgb(173 173 173) 100%);
							    width: 100px;
							    height: 17px;
							    text-align: center;
							    font-size: 1rem;
							    vertical-align: middle;
							    border: 1px solid #efdb53;
							    padding-top: 10px;
							    border-radius: 5px;
							    padding-bottom: 10px;">
												Logout
											</a>
				</div>
			<?php } ?>
			</div>
		</div>
		<div class="header" style="background: url(/hud_files/images/home-banner-v3.png) left top no-repeat;margin-left: 8px;">
			<div class="header_wrp">
				<div class="header_right_text" style="display:none;">
					<div class="top_right_text">
						<strong>"and a child will lead them"</strong>
						<div style="font-size:0.9em"><i>... the Hope Prophecies</i></div>
					</div>
					<div class="hd_green_text_main_bg">
						<div class="hd_green_text_main_bg_top"></div>
						<div class="hd_green_text_main_bg_mid">
							<div class="hd_green_text">
								<h5>Welcome to Hope Street</h5>
								<div>
									We hope that you will join us in Hope Street in our quest for hope and peace. We are a virtual 
									army of youths and adult volunteers who are dedicated to fulfilling the prophecies of the "Legend of Hope".
									
									<div style="display:none;" id="more_txt">
										<p>The mission of Hope Street is to restore hope with the goal of bringing peace and prosperity to our planet.</p>
										<p style="color:#FFFFFF;">If you would like to learn more about Hope Street then please begin by clicking on Hope Street button in the slider below.</p>
									</div>
								</div>
								<div class="readmore" id="learn_more"> <strong><a href="javascript:ToggleMe();">Learn More &gt;&gt;</a></strong> </div>
								<div class="readmore" id="hide_more" style="display:none"> <strong><a href="javascript:ToggleMe();">Hide Me &gt;&gt;</a></strong> </div>
							</div>
						</div>
						<div class="hd_green_text_main_bg_bottom"></div>
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
			</div>
		</div>
		<div class="bk_grid">
			
		</div>
		<div class="body_section">
			<div class="flash" style="
    height: 425px;
    background: url(/home_files/images/flash1.jpg) no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
    ">
				
				<div class="flash_rt winXP" style="
    width: 87%;
    background: none;
    padding: 0px;
    margin-left: -15px;
    margin-top: 45px;
">
					<div class="content_style" id="home_Content1stHopeCorps" style="
    border: 1px solid yellow;
    width: 100%;
    border-radius: 10px;
">
						
					</div>
					
					<div id="home_ContentCybrary" class="content_style" style="display:none;">
						<p>The Hope Cybrary (cyber - library) is a children's sanctuary for knowledge, virtues and spirituality and 
						will eventually serve as a base of operations for our Hope Teams. The first Hope Cybrary has been established 
						in the Barangay Olympia, Makati City, Philippines. We are beginning with a small prototype 12 seat facility 
						that provides free library facilities and computer-Internet access. Beginning in June 2010, Makati, Philippines 
						we will begin to operate our first cybrary and as resources permit we then will expand to other cities, regions 
						and countries.</p>
						
						<p>Click the buttons on the slider below to learn more about HopeNet, Hope Street and the Hope Team.</p>
					</div>
					
					<div id="home_ContentHopeTeam" class="content_style" style="display:none;">
						<p>The Hope Team is somewhat similar in form to other youth organizations such as the Boy/Girl Scouts,YMCA and 
						Boys &amp; Girls Clubs. However, rather than focus on sports, outdoor activities, or arts and crafts etc, the Hope 
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
						
						<p>Click the buttons on the slider below to learn more about Hope Street, the Cybrary and the Hope Team.</p>
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
					<div class="jScrollPaneContainer" style="height: 340px; width: 535px; display: none;"><div id="home_ContentLivelihood" class="content_style" style="display: none; overflow: visible; height: auto; width: 503px; padding-right: 5px; position: absolute; top: 0px;">
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
					</div><div class="jScrollPaneTrack" style="width: 17px; height: 306px; top: 17px;"><div class="jScrollPaneDrag" style="width: 17px; height: 262.727px; top: 0px;"><div class="jScrollPaneDragTop" style="width: 17px;"></div><div class="jScrollPaneDragBottom" style="width: 17px;"></div></div></div><a href="javascript:;" class="jScrollArrowUp disabled" style="width: 17px;">Scroll up</a><a href="javascript:;" class="jScrollArrowDown" style="width: 17px;">Scroll down</a></div>
					
					<div class="jScrollPaneContainer" style="height: 340px; width: 535px; display: none;"><div id="home_ContentPeace" class="content_style" style="display: none; overflow: visible; height: auto; width: 503px; padding-right: 5px; position: absolute; top: 0px;">
						<p>The HopeNet Peace Building program involves several programs including our Values &amp; Virtues, Spirituality, 
						and our Kindness program.  Our flagship Peace Building program is our Kindness program, where the Hopefuls 
						provide community services such as garbage clean up, tree planting, repair and other Kindness-Workz. As a form 
						of encouragement and recognition to the Hopefuls for participating in the Kindness program they receive 
						Hope-Bucks for their Kindness Workz.</p>
						
						<p>The Values &amp; Virtues program provides a forum for the Hopefuls to exercise and recognize the value of virtues 
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
						
						</p><p>It is projected that the Values &amp; Virtues program along with the Spirituality program  will launch in the 
						third quarter 2010.</p>
					</div><div class="jScrollPaneTrack" style="width: 17px; height: 306px; top: 17px;"><div class="jScrollPaneDrag" style="width: 17px; height: 254.377px; top: 0px;"><div class="jScrollPaneDragTop" style="width: 17px;"></div><div class="jScrollPaneDragBottom" style="width: 17px;"></div></div></div><a href="javascript:;" class="jScrollArrowUp disabled" style="width: 17px;">Scroll up</a><a href="javascript:;" class="jScrollArrowDown" style="width: 17px;">Scroll down</a></div>
					
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
				
				<div class="bottom_sec" style="display:none;">
					<div class="bottom_sec_lft">
						<p style="height:30px;">&nbsp;</p>
						
						<div class="img_btm_lft">
							<p>Click any of the slider buttons to preview our Hope Street Services</p>
							<div id="home_BackToMain" style="display:none;" class="link_btm" onclick="ToggleContent('1stHopeCorps');">Back to Main Menu</div>
						</div>
					</div>
					<div class="bottom_sec_rt">
						<div id="home_Slider1" style="margin:10px;">
							<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="613" height="140" id="slider1" align="middle">
								<param name="allowScriptAccess" value="sameDomain">
								<param name="allowFullScreen" value="false">
								<param name="movie" value="home_files/slider.swf">
								<param name="quality" value="high">
								<param name="wmode" value="transparent">
								<param name="bgcolor" value="#333333">
								<embed src="home_files/slider.swf" quality="high" wmode="transparent" bgcolor="#333333" width="613" height="140" name="carousel" align="middle" allowscriptaccess="sameDomain" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer">
							</object>
						</div>
						
						<div id="home_Slider2" style="display:none; margin:10px;">
							<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="613" height="140" id="slider2" align="middle">
								<param name="allowScriptAccess" value="sameDomain">
								<param name="allowFullScreen" value="false">
								<param name="movie" value="home_files/slider_hopenet.swf">
								<param name="quality" value="high">
								<param name="wmode" value="transparent">
								<param name="bgcolor" value="#333333">
								<embed src="home_files/slider_hopenet.swf" quality="high" wmode="transparent" bgcolor="#333333" width="613" height="140" name="carousel" align="middle" allowscriptaccess="sameDomain" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer">
							</object>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="flash_footer"></div>
		<div class="footer">
			<div class="footer_link"></div>
		</div>
	</div>
</div>
</body>
</html>
<?php
//**devtest**//

set_time_limit(30);

pqp_index_console_logMemory($this, 'Watch out of memory leak for home.php');
pqp_index_console_logSpeed('Time it takes to end the home.php');
//**eofdevtest**//
				
//$profiler = new PhpQuickProfiler(PhpQuickProfiler::getMicroTime());
//$profiler->display();
?>
