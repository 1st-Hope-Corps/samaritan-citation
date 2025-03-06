/**
 * @author Maris Reyes <kakaiba at gmail dot com>
 * @version 1.0
 * @package Hope Cybrary
 * @dependencies jQuery 1.2.6 or later
 * @description JavaScript implementation based on Drupal's permissions
 **/

/**
 * BEGIN Reusable functions
 **/
(function($){
	$.fn.center = function (bAbsolute){
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

(function($){
	var keyString = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
	
	var uTF8Encode = function(string) {
		string = string.replace(/\x0d\x0a/g, "\x0a");
		var output = "";
		
		for (var n = 0; n < string.length; n++) {
			var c = string.charCodeAt(n);
			
			if (c < 128) {
				output += String.fromCharCode(c);
			} else if ((c > 127) && (c < 2048)) {
				output += String.fromCharCode((c >> 6) | 192);
				output += String.fromCharCode((c & 63) | 128);
			} else {
				output += String.fromCharCode((c >> 12) | 224);
				output += String.fromCharCode(((c >> 6) & 63) | 128);
				output += String.fromCharCode((c & 63) | 128);
			}
		}
		
		return output;
	};
	
	var uTF8Decode = function(input) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;
		
		while ( i < input.length ) {
			c = input.charCodeAt(i);
			
			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			} else if ((c > 191) && (c < 224)) {
				c2 = input.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			} else {
				c2 = input.charCodeAt(i+1);
				c3 = input.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}
		}
		
		return string;
	}
	
	$.extend({
		base64Encode: function(input) {
			var output = "";
			var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
			var i = 0;
			input = uTF8Encode(input);
			
			while (i < input.length) {
				chr1 = input.charCodeAt(i++);
				chr2 = input.charCodeAt(i++);
				chr3 = input.charCodeAt(i++);
				enc1 = chr1 >> 2;
				enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
				enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
				enc4 = chr3 & 63;
				
				if (isNaN(chr2)) {
					enc3 = enc4 = 64;
				} else if (isNaN(chr3)) {
					enc4 = 64;
				}
				
				output = output + keyString.charAt(enc1) + keyString.charAt(enc2) + keyString.charAt(enc3) + keyString.charAt(enc4);
			}
			
			return output;
		},
		base64Decode: function(input) {
			var output = "";
			var chr1, chr2, chr3;
			var enc1, enc2, enc3, enc4;
			var i = 0;
			input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
			
			while (i < input.length) {
				enc1 = keyString.indexOf(input.charAt(i++));
				enc2 = keyString.indexOf(input.charAt(i++));
				enc3 = keyString.indexOf(input.charAt(i++));
				enc4 = keyString.indexOf(input.charAt(i++));
				chr1 = (enc1 << 2) | (enc2 >> 4);
				chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
				chr3 = ((enc3 & 3) << 6) | enc4;
				output = output + String.fromCharCode(chr1);
				
				if (enc3 != 64)	output = output + String.fromCharCode(chr2);
				if (enc4 != 64) output = output + String.fromCharCode(chr3);
			}
			
			return uTF8Decode(output);
		}
	});
})(jQuery);


function GetQS(sKeyVar, sDefaultVal){
	if (sDefaultVal == null) sDefaultVal = "";
	
	sKeyVar = sKeyVar.replace(/[[]/,"[").replace(/[]]/,"]");
	
	var regex = new RegExp("[?&]"+sKeyVar+"=([^&#]*)");
	var oQS = regex.exec(window.location.href);
	
	return (oQS == null) ? sDefaultVal:oQS[1];
}

function HideThese(aInputId){
	for (i=0; i<aInputId.length; i++){
		var oHide = document.getElementById(aInputId[i]);
		if (oHide) oHide.style.display = "none";
	}
}

function FixLinks(sKey, sVal){
	for (i=0;i < document.links.length; i++){
		oThis = document.links[i];
		
		var oRegEx1 = new RegExp("[?]");
		var oSeparator = oRegEx1.exec(oThis.href);
		var sSeparator = (oSeparator == null) ? "?":"&";
		
		if (oThis.href.indexOf(sKey+"=") <= 0 && oThis.href.indexOf(";") <= 0) oThis.href += sSeparator+sKey+"="+sVal;
	}
}

function IsChild(){
	var sRawAge = $(".bday.dob").text();
	
	if (sRawAge.length > 0){
		var iAge = parseInt(sRawAge.substring(0, sRawAge.indexOf("year")));
		
		return (iAge < 15) ? true:false;
	}
	
	return false;
}

function ChangeSubNav(sURL){
	var sHighlightWhich = sURL.substring(0, 6);
	
	sClass1 = (sHighlightWhich == "browse") ? "nav-selected":"";
	sClass2 = (sHighlightWhich == "online") ? "nav-selected":"";
	sClass3 = (sURL.length > 18) ? "nav-selected":"";
	
	var sSubNav = '<li class="'+sClass1+'"><a title="Browse" href="http://mygizmoz.socialgo.com/members/browse?i=1">Browse</a></li>' +
					'<li class="'+sClass2+'"><a title="Online Now" href="http://mygizmoz.socialgo.com/members/online?i=1">Online Now</a></li>' +
					'<li class="'+sClass3+'"><a title="Children" href="http://mygizmoz.socialgo.com/members/advanced-search?i=1">Children</a></li>';
	
	$("ul#sub-navigation").html(sSubNav);
	HideSocialList();
}

function HideSocialList(){
	$("li.interact-send_message").hide();
	$("li.interact-add_to_friends").hide();
	$("li.interact-edit_profile").hide();
	$("li.interact-edit_account").hide();
	$("li.interact-edit_location").hide();
	$("li.interact-edit_privacy_and_settings").hide();
}

function IsLoggedIn(){
	return ($("form#formlogin").length == 1) ? false:true;
}

function RearrangeProfile(iRoleId){
	var sUserName = $("h3 .nickname").text().replace("_hope", "").toUpperCase();
	
	$("#sidebar").css("float", "right");
	$("#sidebar").html("");
	
	$("#zone-f").css("paddingRight", "8px");
	
	$("#zone-e").append('<div id="profile-community-service" class="content-box"><h2>Community Service</h2><div style="float:left; padding:0 0 0 10px; width:109px;"><img src="http://www.hopecybrary.org/socialgo_images/community_service.png" alt="Community Service" /></div><div style="float:right; padding:0; width:125px;">' + sUserName + ' has volunteered <p id="community_service"  style="padding:0; margin:0;"></p>Community Service to Barangay Olympia.</div><div style="clear:both;"></div></div>');
	$("#community_service").html('<iframe src="http://www.hopecybrary.org/gateway_community_service.php?q=' + $.base64Encode($("h3 .nickname").text().toLowerCase()) + '" style="width:9em; height:1.1em;" frameborder="0" scrolling="no"></iframe>');
	
	$("#profile-wall").appendTo($("#zone-e"));
	$("#profile-location").appendTo($("#zone-f"));
	$("#profile-video").appendTo($("#zone-f"));
	$("#profile-picture-carousel").appendTo($("#zone-f"));
	$("#profile-friends-list").appendTo($("#zone-f"));
	$("#profile-blog").appendTo($("#zone-f"));
	
	$("div.video_infos").css("width", "210px");
	
	$("#profile-location .content-box-content").css("padding", "9px");
	$("#profile-location .content-box-content .clearfix:first").css("padding", "8px");
	
	var oViewFullMap = $("#profile-location .content-box-content .clearfix:last");
	var sViewFullMap = oViewFullMap.html();
	oViewFullMap.remove();
	
	$("#profile-location .content-box-content .clearfix:first").append('<img src="http://www.hopecybrary.org/socialgo_images/location_info.png" alt="Location Info" /><div class="more clearfix">' + sViewFullMap + '</div>');
	$("#profile-description .custom").append('<div class="buttons" align="center"><button class="positive" style="font-weight:bold;" value="Sponsor Now" id="btnSponsorNow" type="button">Sponsor ' + sUserName + ' Now</button></div>');
	
	$("#sidebar").append('<div class="sidebar_top"></div><div class="sidebar_mid" style="padding:10px 15px 10px 15px;"><h3 style="color:#BC5500; font-weight:bold; font-size:0.9em; text-align:center; padding-top:10px;">Search for another Child</h3><form id="search_gender_age" class="clearfix" style="margin:0; padding: 6px 0 0 15px; width:176px; margin-left:auto; margin-right:auto;" name="members-search" action="/members/advanced-search" method="get"><input type="hidden" name="i" value="' + iRoleId + '" /><input type="hidden" name="q" value="2" /><label for="equals_age">Age</label><select id="equals_age" name="equals_age"></select><label for="equals_gender">Gender</label><select id="equals_gender" name="equals_gender"><option selected="selected" value="">Male and Female</option><option value="0">Female</option><option value="1">Male</option></select><div class="buttons" style="padding:10px 0 0 33px;"><button class="positive" style="font-weight:bold;" value="Search" id="btnGenderAge" type="submit">Search</button></div></form></div><div class="sidebar_bot"></div>');
	PopulateAge();
	
	$("#sidebar").append('<div class="sidebar_top"></div><div class="sidebar_mid" style="padding:10px 15px 10px 15px;"><h3 style="color:#BC5500; font-weight:bold; font-size:1em; text-align:center;">Learn More About Sponsorship</h3></div><div class="sidebar_bot"></div>');
	$("#sidebar").append('<div class="sidebar_top"></div><div class="sidebar_mid" style="padding:10px 15px 0px 15px;"><h3 style="color:#BC5500; font-weight:bold; font-size:1em; text-align:center;">In The Cybrary Now</h3><p id="children_container" style="padding:0; margin:0;"><iframe src="http://www.hopecybrary.org/gateway_in_the_cybrary_now.php" style="width:170px; height:117px;" frameborder="0" scrolling="no"></iframe></p></div><div class="sidebar_bot"></div>');
	$("#sidebar").append('<div class="sidebar_top"></div><div class="sidebar_mid" style="padding:10px 15px 10px 15px;"><h3 style="color:#BC5500; font-weight:bold; font-size:0.9em; text-align:center; padding-bottom:10px;">Live Video Chat</h3><img src="http://www.hopecybrary.org/socialgo_images/live_video_chat.jpg" alt="Live Video Chat" /><p>As a sponsor you will have access to unparalleled communications with your sponsored child. The list of communication tools include:</p><ul style="color:maroon;"><li>Video Chat</li><li>Email</li><li>Chat</li><li>SMS</li><li>Phone Calls</li><li>Virtual World <em style="font-size:0.7em;">(coming soon)</em></li></ul><div class="buttons" style="padding-top:10px;" align="center"><button class="positive" style="font-weight:bold;" value="Learn More" id="btnChatLearnMore" type="button">Learn More</button></div></div><div class="sidebar_bot"></div>');
	
	$("div[class=sidebar_bot]").css("marginBottom", "10px");
	
	$("#zone-f").append('<div id="notice_sponsor_now" style="display:none; padding:15px; border-style:solid; border-width:5px; border-color:#173303; background-color:#ECECE1;"><h3>Sponsor ' + sUserName + ' Now</h3><br /><div class="buttons" align="right"><button class="positive" style="font-weight:bold;" value="Sponsor Now" id="btnSponsorNowClose" type="button">close</button></div></div>');
	$("#zone-f").append('<div id="notice_live_video_chat" style="display:none; padding:15px; border-style:solid; border-width:5px; border-color:#173303; background-color:#ECECE1;"><h3>Learn more about Live Video Chat</h3><br /><div class="buttons" align="right"><button class="positive" style="font-weight:bold;" value="Sponsor Now" id="btnChatLearnMoreClose" type="button">close</button></div></div>');
	
	HideThese(Array("theform-search"));
	$("#zone-a").remove()
	
	$("form#theform-search").attr("action", $("form#theform-search").attr("action")+"?i="+iRoleId);
}

function PopulateAge(){
	var sOptions = '<option value="<:15">Select All</option>';
	
	for (var i=7; i<15; i++){
		sOptions += '<option value="=:'+i+'">'+i+'</option>';
	}
	
	$("select#equals_age").html(sOptions);
}
/**
 * END Reusable functions
 **/


/**
 * BEGIN Logic flow
 **/
$(document).ready(
	function(){
		$("#btnSponsorNow").click(
			function(){
				$("#notice_sponsor_now").show().center();
			}
		);
		
		$("#btnSponsorNowClose").click(
			function(){
				$("#notice_sponsor_now").hide("slow");
			}
		);
		
		$("#btnChatLearnMore").click(
			function(){
				$("#notice_live_video_chat").show().center();
			}
		);
		
		$("#btnChatLearnMoreClose").click(
			function(){
				$("#notice_live_video_chat").hide("slow")
			}
		);
	}
);

var sURL = top.location.href;
var aURL = sURL.split("/");
var bProceed = (aURL[4] == "profile") ? true:IsLoggedIn();

if (bProceed){
	var iRoleId = GetQS("i", 0);
	iRoleId = parseInt(iRoleId);
	
	var iQueryId = GetQS("q", 0);
	iQueryId = parseInt(iQueryId);
	
	var aInitHide = Array(
						"sb-manage-account","sb-admin-panel","sb-invite-contacts","sb-current-status",
						"sb-inbox","sb-moderate","sb-add-new","sb-friends-online","sb-upcoming-events"
					);
	
	if (iRoleId == 0){
		//location = "http://www.hopecybrary.org/gateway.php?q="+top.location.href;
	}else{
		FixLinks("i", iRoleId);
		$("#header .header_logo a").attr("href", "http://www.hopecybrary.org/");
		
		if (iRoleId == 0 || iRoleId == 1 || iRoleId == 10){
			HideThese(aInitHide);
			$("#sb-user-account").css("marginBottom", 0);
		}
		
		switch (aURL[3]){
			case "?i="+iRoleId:
			case "members.html?i="+iRoleId:
				if (iRoleId == 0 || iRoleId == 1 || iRoleId == 10) location = "/members/advanced-search?i="+iRoleId;
				
				HideSocialList();
				
				break;
			
			case "members":
				if (iRoleId == 0 || iRoleId == 1 || iRoleId == 10) ChangeSubNav(aURL[4]);
				
				if (aURL[4] == "profile"){
					RearrangeProfile(iRoleId);
					
					var aHideThese = new Array();
					
					switch (iRoleId){
						case 0:
						case 1: // Visitor
						case 10:// Guest
							aHideThese = Array(
											"profile-interact","profile-stories","profile-friends-list",
											"profile-groups-list","profile-events-list","profile-tags",
											"profile-mp3"
										);
						
							break;
							
						case 2: // Regular User
							$("li.buttons.interact-send_message").hide();
							$("li.buttons.interact-add_to_friends").hide();
							
							aHideThese = Array(
											"profile-stories","profile-friends-list","profile-groups-list",
											"profile-events-list","profile-tags","profile-mp3"
										);
							
							break;
							
						case 4: // Tutor
						case 6: // Mentor
						case 7: // Sponsor
							break;
						case 8: // Customize
							break;
						case 9: // Child
							break;
					}
					
					if (IsChild()) HideThese(aHideThese);
				
				}else if (aURL[4].substring(0, 15) == "advanced-search"){
					switch (iRoleId){
						case 0:
						case 1: // Visitor
						case 10:// Guest
							if (iQueryId != 1){
								$("h1.clearfix").html('<div class="left">Children</div><div class="right"></div>');
								
								var sGender = GetQS("equals_gender", 0);
								var sAge = decodeURIComponent(GetQS("equals_age", ">:"));
								
								if (sAge == ">:"){
									$("#operator-age").val("<");
									$("#equals-age").val("15");
								}else{
									var aAgeDetails = sAge.split(":");
									var sOperator = aAgeDetails[0];
									var iAge = parseInt(aAgeDetails[1]);
									
									$("#equals-gender_id").val(sGender);
									$("#operator-age").val(sOperator);
									$("#equals-age").val(iAge);
								}
																
								$("form#members-search").attr("action", $("form#members-search").attr("action")+"?i="+iRoleId+"&q=1");
								$("button[name=submit]").click();
							}else{
								$("div.content-box-content:first").html('<h1 class="clearfix"><div class="left">Children</div></h1>');
								
								$("li.interact-send_message").hide();
								$("li.interact-add_to_friends").hide();
							}
							
							break;
						
						default:
							if (iQueryId == 2){
								var sGender = GetQS("equals_gender", 0);
								var sAge = decodeURIComponent(GetQS("equals_age", ">:"));
								
								if ($("a[name=search-results]").length == 0){
									var aAgeDetails = sAge.split(":");
									var sOperator = aAgeDetails[0];
									var iAge = parseInt(aAgeDetails[1]);
									
									$("#equals-gender_id").val(sGender);
									$("#operator-age").val(sOperator);
									$("#equals-age").val(iAge);
									
									$("form#members-search").attr("action", $("form#members-search").attr("action")+"?i="+iRoleId+"&q=2");
									$("button[name=submit]").click();
								}
							}
							
							break;
					}
				}
				
				break;
		}
	}
}else{
	//location = "http://www.hopecybrary.org/";
}
/**
 * END Logic flow
 **/