<html>
<div id="hc_HopefulProfileContainer" style="display:none; z-index:9000;" align="center">
					<div style="text-align:right; cursor:pointer; font-family:verdana; padding:5px 5px 5px 0; color:maroon; font-weight:bold; background-color:#F8F8F8;"><span id="hc_HopefulProfileContainerMaximize">[maximize]</span>&nbsp;<span id="hc_HopefulProfileContainerClose">[close this]</span></div>
					<iframe id="hc_HopefulProfile" src="" width="838" height="471" border="0"></iframe>
				</div>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="http://www.firsthopecorps.org/misc/drupal.js"></script>
<script type="text/javascript" src="http://www.firsthopecorps.org/sites/all/modules/kickapps/kickapps.js"></script>
<link class="ka_style" rel="stylesheet" type="text/css" href="http://css.kickstatic.com/kickapps/cssc/5.5.3-1019/ka_generalStyle.css" />
<link class="ka_style" rel="stylesheet" id="LE_setCSS" type="text/css" href="http://www.firsthopecorps.org/themes/theme2010/getKickplacecsshopeful.members.css" />
<link type="text/css" rel="stylesheet" media="all" href="http://www.firsthopecorps.org/themes/theme2010/kickapps_members.css" />
<script type="text/javascript" src="http://serve.a-widget.com/kickFlash/scripts/swfobject2.js?2"></script>
<link href="http://www.firsthopecorps.org/sites/all/modules/mystudies/redmond/jquery-ui-custom.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<style>
body {
    background-color: transparent !important;
    background-image: url("http://www.firsthopecorps.org/hud_files/images/bg.jpg") !important;
	background-position: center -420px !important;
    background-repeat: no-repeat !important;
}
</style> 
<script type="text/javascript">
						$(document).ready(
							function(){				
									$("#submitscreenUpdate").hide();	
									$("#editscreennameadd").click(
										function(){
										
											$("#myaccount_AccountScreenNameDialog").dialog(
												{
													modal: true,
													autoOpen: true,
													resizable: false,
													width: 450,
													position: 'top',
													buttons: {
														"Close": function(){
															$(this).dialog("close");
															window.location.href = "http://www.firsthopecorps.org/user/ext/account/hud";
														}
													}
												}
											);
										
										}
									);
									
									$("#accountsearchbutton").click(
										function(){
										
											var accountvalue = $("#accountvalue").val();
											
											if(accountvalue){
												$.post(
													"/user/ext/account/search/" + accountvalue,
													{ func: "" },
													function(sReply){
														var NAME = sReply.NAME;
														var FIRST = sReply.FIRST;
														var LAST = sReply.LAST;
														var SCREENNAME = sReply.SCREENNAME;
														$("#validationHeader").html('');
														$("#validationName").html('');
														$("#validationFirst").html('');
														$("#validationLast").html('');
														$("#submitscreenUpdate").hide();
														
														if(NAME == 'notavailable' || FIRST == 'notavailable' || LAST == 'notavailable'){
														$("#validationHeader").html('Checking complete. The system has encountered an error below:<br/>');
														}
														
														if(NAME == 'notavailable'){
														$("#validationName").html('<span style="color:red;">The screen name is not available.</span><br/>');
														}
														
														if(FIRST == 'notavailable'){
														$("#validationFirst").html('<span style="color:red;">The screen name contains your first name.</span><br/>');
														}
														
														if(LAST == 'notavailable'){
														$("#validationLast").html('<span style="color:red;">The screen name contains your last name.</span>');
														}
														
														if(NAME == 'available' && FIRST == 'available' && LAST == 'available'){
														$("#validationHeader").html('<span style="color:green;">The screen name is available.</span> <input type="hidden" id="screennameval" name="screennameval" value="' + SCREENNAME + '" />');
														$("#submitscreenUpdate").show();
														}
													},
													"json"
												);
											} else{
											$("#validationHeader").html('Checking complete. The system has encountered an error below:<br/>');
											$("#validationName").html('<span style="color:red;">The Screen Name is empty.</span>');
											}
										
										}
									);
									
									$("#userscreenupdate").click(
										function(){
											var screennameval = $("#screennameval").val();
											
											$.post(
												"/user/ext/account/update/" + screennameval,
												{ func: "" },
												function(sReply){
													var RETURN = sReply.RETURN;
													if(RETURN == 'success'){
													$("#ScreenNameContainer").html("Your new screen name was successfully updated.");
													}
													
													//$("#ScreenNameContainer").html(RETURN);
												},
												"json"
											);
										}
									);
							}
						)
</script>
</head>
<body id="ka_myhome" class="ka_myhome_pages">
		<div id="ka_mainContainer" class="ka_myPlace">
	<div id="ka_header" class="clearfix">
		<div id="ka_headerTopNav" style="display:block;">
			<input type="hidden" id="selectedTab" name="selectedTab" value="" />
			<input type="hidden" id="selectedSubNavTab" name="selectedSubNavTab" value="" />
			<ul id="ka_headerTopNav_ul">
				<li id="ka_homeTab">
						<a id="ka_myhomeTab_nav" href="http://affiliate.kickapps.com/service/displayMyPlace.kickAction?as=158175"><span>dashboard</span></a>
					</li>
				<li id="ka_videoTab" >
						<a id="ka_videoTab_nav" href="http://affiliate.kickapps.com/service/searchEverything.kickAction?as=158175&mediaType=video&sortType=recent&tab=yes&includeVideo=on&d-7095067-p=1"><span>videos</span></a>
					</li>
				<li id="ka_audioTab" >
						<a id="ka_audioTab_nav" href="http://affiliate.kickapps.com/service/searchEverything.kickAction?as=158175&mediaType=audio&sortType=recent&tab=yes&includeAudio=on&d-7095067-p=1"><span>audio</span></a>
					</li>
				<li id="ka_photoTab" >
						<a id="ka_photoTab_nav" href="http://affiliate.kickapps.com/service/searchEverything.kickAction?as=158175&mediaType=photo&sortType=recent&tab=yes&includePhoto=on&d-7095067-p=1"><span>photos</span></a>
					</li>
				<li id="ka_blogTab" >
						<a id="ka_blogTab_nav" href="http://affiliate.kickapps.com/service/searchEverything.kickAction?as=158175&mediaType=blog&sortType=recent&includeBlog=on&d-7095067-p=1"><span>blogs</span></a>
					</li>
				<li id="ka_memberTab" class="current">
						<a id="ka_memberTab_nav" href="http://www.firsthopecorps.org/community/members"><span>members</span></a>
					</li>
				<li id="ka_groupsTab">
						<a id="ka_groupsTab_nav" href="http://www.firsthopecorps.org/community?m=gr"><span>teams</span></a>
					</li>
				<li id="ka_messageBoardsTab" >
					<a id="ka_messageBoardsTab_nav" href="http://affiliate.kickapps.com/service/displayMessageBoard.kickAction?as=158175&mediaType=messageBoards&sortType=recent&includeMessages=on"><span>message board</span></a>
				</li>
				</ul>
		</div><div id="ka_headerSubNav" class="ka_myhome_classic">
</div>
<div id="ka_headerBtmNav" class="clearfix">
			<div id="ka_headerLogin">
				<div id="ka_headerLoginAuth">
					<ul id="ka_login_area">
						<li class="ka_username_welcome">
							<a id="MyProfileMember" href=""><span style="color:#b8b800;text-decoration:underline;font-size:11px;">My Profile</span></a></span>&nbsp;&nbsp;&nbsp;<a id="MyProfileMember" href="http://www.firsthopecorps.org/user/ext/account/hud"><span style="color:#b8b800;text-decoration:underline;font-size:11px;">My Account</span></a></span>
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
		   <form name="ka_search" method="get" action="http://affiliate.kickapps.com/service/searchEverything.kickAction?as=158175" enctype="application/x-www-form-urlencoded" accept-charset="UTF-8" >
                        <div id="ka_searchText" style="color:#e5f031;text-decoration:none;">
                                <a id="ka_search_advanced" href="#"	onclick="AdvancedSearch(); return false;"><span style="color:#b8b800;text-decoration:none;font-size:11px;">advanced</span></a>

                        </div>
			<button class="ka_searchButton ka_sprite_search" type="submit" title="searchbutton">
				Search</button>
			<input class="ka_searchField" type="text" tabindex="50" alt="searchfield" name="keywords" value="" maxlength="50" />
			<div id="ka_searchAdv1" style="display:none;color:#b8b800;">
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
		<span id="ka_letterboxUserProfile" style="background:#000 url(http://media.kickstatic.com/kickapps/images/158175/photos/PHOTO_13757895_158175_23824743_ap_100X75.jpg) no-repeat center center"></span></a>
			<h3 id="ka_myHome">
	</h3>

	<div id="ka_manageNav">
		<ul>
			<li id="ka_myProfile" class="ka_sprite_media" style="color:#e5f031;">
				<a href="/view/manageProfileQuestions.kickAction?as=158175"><span style="color:#e5f031;">My Profile</span></a>
			</li>
		</ul>
	</div>
	<span id="ka_profileUrl">My Profile URL: http://affiliate.kickapps.com/158175/hope_visitor</span>

</div>

<div id="ka_manageContent" class="clearfix">
    <div class="ka_adFullBannerMiddle"></div>