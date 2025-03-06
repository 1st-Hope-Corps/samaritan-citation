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

$(document).ready(
	function(){
		var sPrePic = 'picture_';
		var sPreName = 'name_';
		//parent.document.getElementById('communityiframe').height = document['body'].offsetHeight;
		if($("#MyProfileMember").length > 0){
			$.post(
					"/children/profile",
					{
						uid: $("#MyProfileid").val(),
						user: $("#MyProfileuser").val()
					},
					function(oReply){
						if (oReply.STATUS == 1){
							//$("#MyProfileMemberiframe").attr("href", "http://affiliate.kickapps.com/service/displayKickPlace.kickAction?u=" + oReply.RETURN+ "&as=158175&css=kickapps_theme2010");
							$("#MyProfileMemberiframe").hide();
							var strurl = window.location.href;
							//if(strurl.search("kickapps_theme2010") == -1){
							//$("#MyProfileMember").attr("href", "http://affiliate.kickapps.com/service/displayKickPlace.kickAction?u="+oReply.RETURN+"&as=158175");
							//} else{
							$("#MyProfileMember").attr("href", "http://www.hopecybrary.org/community?m=pf&id=" + oReply.RETURN);
							//}
						}
				},
				"json"
			);
		}
		
		$("img[id^="+sPrePic+"]").each(
			function(){
				var iUserId = this.id.replace(sPrePic, "");
				var sUser = $("#name_"+iUserId).text();
				
				$(this).click(
					alert("This feature is deprecated and has been disabled.");
					
					/*function(){
						$.post(
							"/children/profile",
							{
								uid: iUserId,
								user: sUser
							},
							function(oReply){
								if (oReply.STATUS == 1){
									$("#hc_HopefulProfileContainer")
										.center()
										.css('zIndex', '9000')
										.show();
										
									var strurl = window.location.href;
									var cssLink = '&css=kickapps_theme2010';
									var varLocation = '&location=community';
									if(strurl.search("kickapps_theme2010") == -1){
									cssLink = '';
									varLocation = '&location=hud';
									}
									$("#hc_HopefulProfile").attr("src", "http://affiliate.kickapps.com/service/displayKickPlace.kickAction?as=158175&u="+oReply.RETURN+varLocation+"&view=onlyprofile&"+cssLink);
								}
							},
							"json"
						);
					}*/
				)
			}
		);
		
		$("#hc_HopefulProfileContainerClose").click(
			function(){
				$("#hc_HopefulProfileContainer").hide();
				$("#hc_HopefulProfile").attr("src", "");
			}
		);
		
		$("#sBrowseTeams").click(
			function(){
				$("#sBrowseTeamsMenu").toggle();
			}
		);
		
		$("#hc_HopefulProfileContainerMaximize").click(
			function(){
				var iWinWidth = $(window).width()-2;
				var iWinHeight = $(window).height()-3;
				
				var sThis = $(this).text();
				
				if (sThis == '[maximize]'){
					$(this).text("[restore]");
					
					$("#hc_HopefulProfileContainer")
						.width(iWinWidth)
						.height(iWinHeight)
						.center()
						.css('zIndex', '9000');
					
					$("#hc_HopefulProfile")
						.width(iWinWidth)
						.height(iWinHeight);
				}else{
					$(this).text("[maximize]");
					
					$("#hc_HopefulProfileContainer")
						.width(842)
						.height(499)
						.center()
						.css('zIndex', '9000');
					
					$("#hc_HopefulProfile")
						.width(838)
						.height(471);
				}
			}
		);							
	}
);

function AdvancedSearch(){
	var strurl = window.location.href;
	if(strurl.search("kickapps_theme2010") == -1){
	$("#ka_searchText").html('<a id="ka_search_advanced" href="#"	onclick="BasicSearch(); return false;"><span style="color:#b8b800;text-decoration:underline;font-size:11px;">basic</span></a>');
	} else{
	$("#ka_searchText").html('<a id="ka_search_advanced" href="#"	onclick="BasicSearch(); return false;"><span>basic</span></a>');
	}
	$("#ka_searchAdv1").show();
}

function BasicSearch(){
	var strurl = window.location.href;
	if(strurl.search("kickapps_theme2010") == -1){
	$("#ka_searchText").html('<a id="ka_search_advanced" href="#"	onclick="AdvancedSearch(); return false;"><span style="color:#b8b800;text-decoration:underline;font-size:11px;">advanced</span></a>');
	} else{
	$("#ka_searchText").html('<a id="ka_search_advanced" href="#"	onclick="AdvancedSearch(); return false;"><span>advanced</span></a>');
	}
	$("#ka_searchAdv1").hide();
}

function loadTeamsTable(troop_id){
    $("#loadText").html('loading teams..');
	$("#teams_table").html("");
	$("#sPath").html("");
	if(troop_id !== null){
		$.post(
		//Drupal.settings.basePath+"community/loadteamtable/" + troop_id,
		"/community/loadteamtable/" + troop_id,
		{func: ""},
		function(oReply){
			if (oReply.STATUS == 1){
				$("#sPath").html(oReply.Path);
				$("#teams_table").html(oReply.Output);
				$("#loadText").html('');
			}
		},
		"json"
		);
	}
}