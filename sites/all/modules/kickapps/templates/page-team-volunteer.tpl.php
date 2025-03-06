<html>
<div id="hc_HopefulProfileContainer" style="display:none; z-index:9000;" align="center">
					<div style="text-align:right; cursor:pointer; font-family:verdana; padding:5px 5px 5px 0; color:maroon; font-weight:bold; background-color:#F8F8F8;"><span id="hc_HopefulProfileContainerMaximize">[maximize]</span>&nbsp;<span id="hc_HopefulProfileContainerClose">[close this]</span></div>
					<iframe id="hc_HopefulProfile" src="" width="838" height="471" border="0"></iframe>
				</div>
<head>
<link class="ka_style" rel="stylesheet" type="text/css" href="http://www.firsthopecorps.org/sites/all/modules/mystudies/jquery.tooltip.css" />
<link class="ka_style" rel="stylesheet" type="text/css" href="http://www.firsthopecorps.org/sites/all/modules/mystudies/redmond/jquery-ui-custom.css" />
<script type="text/javascript" src="http://www.firsthopecorps.org/sites/all/modules/kickapps/kickapps.js"></script>
<script type="text/javascript" src="http://www.firsthopecorps.org/sites/all/modules/mystudies/jquery.tooltip.js"></script>
<script type="text/javascript" src="http://www.firsthopecorps.org/sites/all/modules/mystudies/jquery-ui.js"></script>

<link class="ka_style" rel="stylesheet" type="text/css" href="http://css.kickstatic.com/kickapps/cssc/5.5.3-1019/ka_generalStyle.css" />
<link class="ka_style" rel="stylesheet" id="LE_setCSS" type="text/css" href="http://www.firsthopecorps.org/themes/theme2010/getKickplacecss.members.css" />
<link type="text/css" rel="stylesheet" media="all" href="http://www.firsthopecorps.org/themes/theme2010/kickapps_members.css" />
<script type="text/javascript" src="http://serve.a-widget.com/kickFlash/scripts/swfobject2.js?2"></script>
</head>
<body id="ka_myhome" class="ka_myhome_pages">
		<div id="ka_mainContainer" class="ka_myPlace">
	<div id="ka_header" class="clearfix">
		<div id="ka_headerTopNav" style="display:block;">
			<input type="hidden" id="selectedTab" name="selectedTab" value="" />
			<input type="hidden" id="selectedSubNavTab" name="selectedSubNavTab" value="" />
			<ul id="ka_headerTopNav_ul">
				<li id="ka_homeTab">
						<a id="ka_myhomeTab_nav" href="http://www.firsthopecorps.org/community?css=kickapps_theme2010"><span>dashboard</span></a>
					</li>
				<li id="ka_videoTab" >
						<a id="ka_videoTab_nav" href="http://www.firsthopecorps.org/community?m=v&css=kickapps_theme2010"><span>videos</span></a>
					</li>
				<li id="ka_audioTab" >
						<a id="ka_audioTab_nav" href="http://www.firsthopecorps.org/community?m=a&css=kickapps_theme2010"><span>audio</span></a>
					</li>
				<li id="ka_photoTab" >
						<a id="ka_photoTab_nav" href="http://www.firsthopecorps.org/community?m=p&css=kickapps_theme2010"><span>photos</span></a>
					</li>
				<li id="ka_blogTab" >
						<a id="ka_blogTab_nav" href="http://www.firsthopecorps.org/community?m=b&css=kickapps_theme2010"><span>blogs</span></a>
					</li>
				<li id="ka_memberTab">

						<a id="ka_memberTab_nav" href="http://www.firsthopecorps.org/community/members?css=kickapps_theme2010"><span>members</span></a>
					</li>
				<li id="ka_groupsTab" class="current">
						<a id="ka_groupsTab_nav" href="http://www.firsthopecorps.org/community?m=gr&css=kickapps_theme2010"><span>teams</span></a>
					</li>
				<li id="ka_messageBoardsTab" >
					<a id="ka_messageBoardsTab_nav" href="http://www.firsthopecorps.org/community?m=mb&css=kickapps_theme2010"><span>message board</span></a>
				</li>
				</ul>
		</div><div id="ka_headerSubNav" class="ka_myhome_classic">
</div>
<div id="hc_HopefulProfileContainer" style="display:none;">
	<div id="hc_HopefulProfileContainerClose" style="text-align:right; cursor:pointer; font-family:verdana; padding:5px 5px 5px 0; color:maroon; font-weight:bold; background-color:#F8F8F8;">[close this]</div>
	<iframe id="hc_HopefulProfile" src="" width="838" height="471" border="0"></iframe>
</div>
<div id="ka_headerBtmNav" class="clearfix">
			<div id="ka_headerLogin">
				<div id="ka_headerLoginAuth">
					<ul id="ka_login_area">
						<li class="ka_username_welcome">
							<a id="MyProfileMember" href="">My Profile</a></span>
							<?php
							global $user;
							?>
							<input type="hidden" id="MyProfileid" value="<?=$user->uid?>"/>
							<input type="hidden" id="MyProfileuser" value="<?=$user->name?>"/>
						</li>
					</ul>
				</div>
			</div>
			<div id="ka_headerSearch">
		   <form name="ka_search" method="get" action="http://www.firsthopecorps.org/community" enctype="application/x-www-form-urlencoded" accept-charset="UTF-8" >
                        <div id="ka_searchText">
                                <a id="ka_search_advanced" href="#"	onclick="AdvancedSearch(); return false;"><span>advanced</span></a>

                        </div>
			<button class="ka_searchButton ka_sprite_search" type="submit" title="searchbutton">
				Search</button>
			<input class="ka_searchField" type="text" tabindex="50" alt="searchfield" name="keywords" value="" maxlength="50" />
			<div id="ka_searchAdv1" style="display: none">
                            <ul>
					<li id="ka_searchAdv_vid">
							<span><input type="checkbox" id="includeVideo" name="includeVideo" checked="checked" /> video</span>

						</li>
					<li id="ka_searchAdv_aud">
							<span><input type="checkbox" id="includeAudio" name="includeAudio" checked="checked" /> audio</span>
						</li>
					<li id="ka_searchAdv_pho">
							<span><input type="checkbox" id="includePhoto" name="includePhoto" checked="checked" /> photo</span>
						</li>

					<li id="ka_searchAdv_blog">
							<span><input type="checkbox" id="includeBlog" name="includeBlog" checked="checked" /> blog</span>
						</li>
					<!--<li id="ka_searchAdv_member">
						<span><input type="checkbox" id="includeUser" name="includeUser" checked="checked" /> member</span>
					</li>-->
					<li id="ka_searchAdv_group">

							<span><input type="checkbox" id="includeGroups" name="includeGroups" checked="checked" /> group</span>
						</li>
					<li id="ka_searchAdv_messages">
							<span><input type="checkbox" id="includeMessages" name="includeMessages" checked="checked" /> message</span>
						</li>
					</ul>
                                 </div>

			<input type="hidden" name="as" value="158175" escapeXml="false"/>
			<input type="hidden" name="sortType" value="relevance" escapexml="false"/>
			<input type="hidden" id="m" name="m" value="s"/>
		</form>
	</div>
		</div>
	</div>
<div id="ka_contentContainer" class="clearfix">
<div id="ka_manageAccountInfo" style="display:none">
	<a href="http://affiliate.kickapps.com/service/displayKickPlace.kickAction?u=23824743&as=158175">
		<span id="ka_letterboxUserProfile" style="background:#000
		    
							url(http://media.kickstatic.com/kickapps/images/158175/photos/PHOTO_13757895_158175_23824743_ap_100X75.jpg)
						  no-repeat center center"></span></a>
			<h3 id="ka_myHome">
	</h3>

	<div id="ka_manageNav">
		<ul>
			<li id="ka_myProfile" class="ka_sprite_media">
				<a href="/view/manageProfileQuestions.kickAction?as=158175">My Profile</a>
			</li>
		</ul>
	</div>
	<span id="ka_profileUrl">My Profile URL: http://affiliate.kickapps.com/158175/hope_visitor</span>

</div>

<div id="ka_manageContent" class="clearfix">
    <div class="ka_adFullBannerMiddle"></div>