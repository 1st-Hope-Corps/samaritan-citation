/**
 * @author Maris Reyes <kakaiba at gmail dot com>
 * @version 1.0
 * @package Hope Cybrary
 * @dependencies jQuery 1.2.6 or later
 * @description JavaScript implementation based on Drupal's permissions for KickApps
 **/

//document.write(unescape("%3Cscript src='http://www.firsthopecorps.org/kickapps_permission.js' type='text/javascript'%3E%3C/script%3E"));

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


$j(document).ready(
	function(){
		// Age Mod
		iAge = parseInt($j("#ka_profileAgeItem").html().replace("<strong>Age:</strong> ", ""));
		if (iAge > 100) $j("#ka_profileAgeItem").html("<strong>Age:</strong> " + (iAge-100));
		
		// Status block
		$j("#ka_profileLeft").append('<div id="hc_Status" class="ka_profileSeg"><div id="hc_StatusDetailsTitle" class="ka_profileSegHeader ka_contentTitle"><h5>Status</h5></div><div class="ka_profileSegCont ka_contentBody" style="padding: 5px;"><div><b>What I\'m Doing</b></div><div id="hc_WhatImDoingAnswer">xxxxx</div><div><b>In the Cybrary?</b></div><div id="hc_InTheCybraryAnswer">xxx</div></div><div class="ka_profileSegFooter">&nbsp;</div></div>');
		
		sUserName = $j("#ka_profileDetailsUsername h5").text().replace("_hope", "").toUpperCase();
		
		// Kindness Workx block
		$j("#ka_profileLeft").append('<div id="hc_KindnessWorkz" class="ka_profileSeg"><div id="hc_KindnessDetailsTitle" class="ka_profileSegHeader ka_contentTitle"><h5>Kindness Workz</h5></div><div class="ka_profileSegCont ka_contentBody" style="padding: 0px; height:110px;"><div style="float:left; padding:0px; width:109px;"><img src="http://www.hopecybrary.org/socialgo_images/community_service.png" alt="Community Service" /></div><div style="float:right; padding:0; width:72px;">' + sUserName + ' has completed <p id="community_service"  style="padding:0; margin:0;"></p>of Kindness Workz.</div></div><div class="ka_profileSegFooter">&nbsp;</div></div>')
		$j("#community_service").html('<iframe src="http://www.hopecybrary.org/gateway_community_service.php?q=' + _base64Encode($j("#ka_profileDetailsUsername h5").text().toLowerCase()) + '" style="width:70px; height:1.2em;" frameborder="0" scrolling="no"></iframe>');
		
		//$j("#ka_profileLeft").append('<div id="hc_KindnessWorkz" class="ka_profileSeg"><div id="hc_KindnessDetailsTitle" class="ka_profileSegHeader ka_contentTitle"><h5>Kindness Workz</h5></div><div class="ka_profileSegCont ka_contentBody" style="padding: 0px; height:110px;"></div></div>');
		
		// Video chat block
		$j("#ka_profileLeft").append('<div id="hc_VideoChat" class="ka_profileSeg"><div id="hc_VideoDetailsTitle" class="ka_profileSegHeader ka_contentTitle"><h5>Live Video Chat</h5></div><div class="ka_profileSegCont ka_contentBody" style="padding: 0px;"><div align="center" style="padding-top:6px;"><img src="http://www.hopecybrary.org/socialgo_images/live_video_chat.jpg" alt="Live Video Chat" /></div><p style="padding-top:10px">As a sponsor you will have access to unparalleled communications with your sponsored child. The list of communication tools include:</p><div style="margin-left:7px;"><ul style="color:maroon;"><li>Video Chat</li><li>Email</li><li>Chat</li><li>SMS</li><li>Phone Calls</li><li>Virtual World <em style="font-size:0.7em;">(coming soon)</em></li></ul></div><div class="buttons" style="padding-top:10px;" align="center"><input type="button" class="ka_button" style="font-weight:bold; margin-bottom:5px;" value="Learn More" id="hc_btnChatLearnMore" /></div></div></div><div id="notice_live_video_chat" style="display:none; padding:15px; border-style:solid; border-width:5px; border-color:#769E6C; background-color:#ECECE1;"><h3>Learn more about Live Video Chat</h3><br /><div class="buttons" align="right"><input type="button" class="ka_button" value="close" id="hc_btnChatLearnMoreClose" /></div><div class="ka_profileSegFooter">&nbsp;</div></div>');
		
		$j("#hc_btnChatLearnMore").click(
			function(){
				$j("#notice_live_video_chat").show("slow").center();
			}
		);
		
		$j("#hc_btnChatLearnMoreClose").click(
			function(){
				$j("#notice_live_video_chat").hide("slow");
			}
		);
		
	}
);


function _base64Encode(input){
	var keyString = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
	var output = "";
	var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
	var i = 0;
	input = _uTF8Encode(input);
	
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
}

function _uTF8Encode(string){
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