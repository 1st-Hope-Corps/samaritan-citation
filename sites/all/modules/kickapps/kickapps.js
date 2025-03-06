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
					Drupal.settings.basePath + "teamchildren/profile",
					{
						uid: $("#MyProfileid").val(),
						user: $("#MyProfileuser").val()
					},
					function(oReply){
						if (oReply.STATUS == 1){
						$("#MyProfileMemberiframe").attr("href", "http://affiliate.kickapps.com/service/displayKickPlace.kickAction?u=" + oReply.RETURN+ "&as=158175&css=kickapps_theme2010");
						
							var strurl = window.location.href;
							if(strurl.search("kickapps_theme2010") !== -1 || strurl.search("volunteerteams") !== -1 || strurl.search("offlinevolunteerunit") !== -1 || strurl.search("volunteerteamdashboard") !== -1){
							$("#MyProfileMember").attr("href", "http://www.hopecybary.org/community?m=pf&id=" + oReply.RETURN);
							} else{
							$("#MyProfileMember").attr("href", "http://affiliate.kickapps.com/service/displayKickPlace.kickAction?u="+oReply.RETURN+"&as=158175");
							}
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
					function(){
						$("#profile_Dialog_loader").html('<img src="/misc/button-loader-big.gif" /><span>');
						$("#hc_HopefulProfile1").attr("src", "");
						$.post(
							Drupal.settings.basePath + "teamchildren/profile",
							{
								uid: iUserId,
								user: sUser
							},
							function(oReply){
								if (oReply.STATUS == 1){
								
									$("#hc_HopefulProfileContainer").css("position","absolute");
									//$("#hc_HopefulProfileContainer").css("top", (($(window).height() - $("#hc_HopefulProfileContainer").outerHeight()) / 2) + $(window).scrollTop() + "px");
									$("#hc_HopefulProfileContainer").css("top", "5px");
									$("#hc_HopefulProfileContainer").css("left", (($(window).width() - $("#hc_HopefulProfileContainer").outerWidth()) / 2) + $(window).scrollLeft() + "px");
	
									$("#hc_HopefulProfileContainer")
										.css('zIndex', '9000')
										.show();								
									
									/*
									$("#profile_Dialog").dialog({
													modal: true,
													autoOpen: true,
													resizable: false,
													width: 836,
													height: 650,
													buttons: {
														"Close": function(){
														$(this).dialog("close");
														}
													}
									});	*/
									
									var strurl = window.location.href;
									var cssLink = '&css=kickapps_theme2010';
									var varLocation = '&location=community';
									if(strurl.search("kickapps_theme2010") == -1){
									cssLink = '';
									varLocation = '&location=hud';
									}
									$("#hc_HopefulProfile").attr("src", "http://affiliate.kickapps.com/service/displayKickPlace.kickAction?as=158175&u="+oReply.RETURN+varLocation+"&view=onlyprofile&"+cssLink);
									$("#profile_Dialog_loader").html('');
								}
							},
							"json"
						);
					}
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
		
		if(window.location.pathname == '/community/manageteam'){
		    /*if(window.location.search !== ''){
			var urlvar = window.location.search;
			var strsplit = urlvar.split('=');
			change_troopteams(strsplit[1], 'team', 1);
			}*/
			RequestImage("online");
		}
		
		$("a#button_children_online").click(

			function(){
				$("#incybrary_block_title").text("In the Cybrary Now");
				RequestImage("online");
			}
		); 
		
		$("#join_team_button").click(
			function(){
				$("#request_message_div").html("<br/><br/><center><span style='color:white;'><b>Your request was sent to the administrator. The administrator will review your request.</b></span></center>");
				$("#request_message_div").show();
			}
		);
		
		$("a#button_children_24").click(
			function(){
				$("#incybrary_block_title").text("In the last 24 hours");
				RequestImage(24);
			}
		);
		
		$("a#button_children_all").click(
			function(){
				$("#incybrary_block_title").text("All Hopefuls");
				RequestImage("all");
			}
		);
		
		function RequestImage(sRequestType){
			//$("#incybrary_avatar").attr("src", "/sites/default/files/pictures/default_image.jpg");
			$("#incybrary_avatar").hide();
			$("#incybrary_hopeful_details").html("The selected child's description will go here.");
			
			$("#incybrary_hopeful_nav").html("&nbsp;");
			$("div#incybrary_hopeful_list").text("Fetching data...");
			
			$.post(
				Drupal.settings.basePath + "teamchildren/"+sRequestType+'/'+$("#teamid").val(),
				{ func: "GetChildren" },
				function(sReply){
					var sOutput = '';
					aChildren = sReply.RETURN;
					aDetails = sReply.DETAILS;
					aTotal = sReply.TOTAL;
				
					$("#kindnesstotaltext").text(aTotal[0].totalkindness);
					$("#knowledgetotaltext").text(aTotal[0].totalknowledge);
					if (aChildren.length > 0){
						PageThis();
					}else{
						$("div#incybrary_hopeful_list").html("No children to list, yet.");
					}
				if(sRequestType == 'online'){
				$("#inthecybrarynow").html("<span style='color:red'>In The Cybrary Now</span>");
				}
				},
				"json"
			);
		}
		
		$("#hc_HopefulProfileContainerClose").click(
			function(){
				$("#hc_HopefulProfileContainer").hide();
				$("#hc_HopefulProfile").attr("src", "");
			}
		);		
	}
);

// paging teams 
function isset(){
	var aArgs = arguments, iArgsLen = aArgs.length, i = 0;

	if (iArgsLen === 0) throw new Error('Empty isset'); 

	while (i !== iArgsLen){
		if (typeof(aArgs[i]) == "undefined" || aArgs[i] === null){
			return false; 
		}else{
			i++; 
		}
	}
	
	return true;
}

function PageThis(iThisOffSet, iThisInSet){
	var iResultsPerPage = 5;
	
	iThisOffSet = (iThisOffSet == null) ? 0:iThisOffSet;
	iThisInSet = (iThisInSet == null) ? iResultsPerPage:iThisInSet;
	
	var iRecordCount = aChildren.length;
	var iRawTotalPages = iRecordCount/iResultsPerPage;
	var iTotalPages = Math.floor(iRawTotalPages);
	var iCurrPage = iThisInSet/iResultsPerPage;
	var sOutput = "";
	
	if (iTotalPages == 0) iTotalPages = 1;
	if (iRawTotalPages > iTotalPages) iTotalPages++;
	
	for (i=iThisOffSet; i<iThisInSet && i<iRecordCount; i++){
		sImageURL = "/" + aChildren[i].picture;
		iUserId = aChildren[i].uid;
		sChildName = aChildren[i].name;
		sChildEmail = aChildren[i].mail;
		
		sOutput += '<div style="float:left;padding: 5px;text-align: center;"><img class="incybrary_thumbnail" id="' + iUserId + '" user="' + sChildName + '" src="' + sImageURL + "?" + Math.floor(Math.random()*1000) + '" alt="' + sChildName + '" title="' + aChildren[i].name + '" /><br />' + sChildName + '</div>';
		
		if (i == 0){
			$("#incybrary_hopeful_details").html("The selected child's description will go here.");
			$("#incybrary_avatar").attr("src", sImageURL);
			
			var iUID = iUserId;
			var sName = sChildName;
			var sEmail = sChildEmail;
			
			sDescription = '<table width="100%" border="0" cellspacing="0" cellpadding="2">' +
								'<tr><td colspan="2" class="header">' + sChildName + ' <div id="inthecybrarynow"></div></td></tr>';

			for (x=0; x<aDetails.length; x++){
				if (aDetails[x].uid == iUserId){
					sDescription += '<tr><td width="150" style="font-size:12px;"><b>What I\'m doing now:</b></td><td class="info" style="font-size:12px;">' + ((isset(aDetails[x].doingnow)) ? aDetails[x].doingnow:'Not specified') + '</td></tr>';
					sDescription += '<tr><td style="font-size:12px;"><b>Knowledge Portal Hours:</b></td><td class="info" style="font-size:12px;">' + ((isset(aDetails[x].knowledgeportalhours)) ? aDetails[x].knowledgeportalhours:'Not specified') + '</td></tr>';
					sDescription += '<tr><td style="font-size:12px;"><b>Kindness Hours:</b></td><td class="info" style="font-size:12px;">' + ((isset(aDetails[x].kindnesshours)) ? aDetails[x].kindnesshours:'Not specified') + '</td></tr>';
					break;
				}
			}
			
			$("#incybrary_hopeful_details").html(sDescription+'</table>');
		}
	}
	
	
	if (iUID && sName){
		$("#incybrary_avatar")
			.unbind()
			.click(
				function(){
					$.post(
						Drupal.settings.basePath + "teamchildren/profile",
						{
							uid: iUID,
							user: sName
						},
						function(sReply){
							if (sReply.STATUS == 1){
								$("#hc_HopefulProfileContainer")
									.center()
									.css('zIndex', '9000')
									.show();
								$("#hc_HopefulProfile").attr("src", "http://affiliate.kickapps.com/service/displayKickPlace.kickAction?css=kickapps_theme2010&as=158175&u="+sReply.RETURN+"&location=community&view=onlyprofile");
							}
						},
						"json"
					);
					
					
				}
				);
	}
		
	iThisOffSet += iResultsPerPage;
	iThisInSet += iResultsPerPage;
	
	sPageNext = (iThisOffSet < iRecordCount) ? "<a class=\"link\" href=\"javascript:PageThis("+iThisOffSet+", "+iThisInSet+");\">Next &gt;</a>":"";
	
	iThisOffSet -= (iThisOffSet < 0) ? 0:(iResultsPerPage * 2);
	iThisInSet -= (iThisInSet == 0) ? iResultsPerPage:(iResultsPerPage * 2);
	sPagePrev = (iThisOffSet < 0 && iThisInSet == 0) ? "":"<a class=\"link\" href=\"javascript:PageThis("+iThisOffSet+", "+iThisInSet+");\">&lt; Previous</a>";
	
	sPageNav = '<table border="0" style="width:100%; font-size:0.9em;"><tr><td style="width:25%;">'+sPagePrev+'</td><td style="text-align:center; width:50%;">Page '+iCurrPage+' of '+iTotalPages+'</td><td style="text-align:right; width:25%;">'+sPageNext+'</td></tr></table>';
	
	$("#incybrary_hopeful_nav").html(sPageNav);
	$("div#incybrary_hopeful_list").html(sOutput);
	
	ApplyStyles();
	$("#incybrary_avatar").show();
}

function ApplyStyles(){
	$("img[class=incybrary_thumbnail]").each(
		function(){
			$(this).hover(
				function(){
					$(this).css("cursor", "pointer");
				},
				function(){
					$(this).css("cursor", "default");
				}
			)
			.click(
				function(){
					var iUserId = $(this).attr("id");
					var sUserName = $(this).attr("user");
					var sUserEmail = $(this).attr("email");
					
					var sDescription = '<table width="100%" border="0" cellspacing="0" cellpadding="2">' +
											'<tr><td colspan="2" class="header">' + $(this).attr("alt") + ' <div id="inthecybrarynow"></div></td></tr>';
					
					for (i=0; i<aDetails.length; i++){
						if (aDetails[i].uid == iUserId){
							$("#incybrary_avatar")
								.unbind()
								.attr("src", $(this).attr("src"))
								.click(
									function(){
										$.post(
											Drupal.settings.basePath + "teamchildren/profile",
											{
												uid: iUserId,
												user: sUserName
											},
											function(sReply){
												if (sReply.STATUS == 1){
													$("#hc_HopefulProfileContainer")
														.center()
														.css('zIndex', '9000')
														.show();
													$("#hc_HopefulProfile").attr("src", "http://affiliate.kickapps.com/service/displayKickPlace.kickAction?css=kickapps_theme2010&as=158175&view=onlyprofile&u="+sReply.RETURN);
												}
											},
											"json"
										);
										
										
									}
								);
							
							sDescription += '<tr><td width="150" style="font-size:12px;">What I\'m doing now:</td><td class="info">' + ((isset(aDetails[i].doingnow)) ? aDetails[i].doingnow:'Not specified') + '</td></tr>';
							sDescription += '<tr><td style="font-size:12px;">Knowledge Portal Hours:</td><td class="info">' + ((isset(aDetails[i].knowledgeportalhours)) ? aDetails[i].knowledgeportalhours:'Not specified') + '</td></tr>';
							sDescription += '<tr><td style="font-size:12px;">Kindness Hours:</td><td class="info">' + ((isset(aDetails[i].kindnesshours)) ? aDetails[i].kindnesshours:'Not specified') + '</td></tr>';
							
							break;
						}
					}
					
					$("#incybrary_hopeful_details").html(sDescription+'</table>');
				}
			);
		}
	);
}
// eof paging teams

function AdvancedSearch(){
	var strurl = window.location.href;
	if(strurl.search("kickapps_theme2010") !== -1 || strurl.search("volunteerteams") !== -1 || strurl.search("offlinevolunteerunit") !== -1 || strurl.search("volunteerteamdashboard") !== -1){
	$("#ka_searchText").html('<a id="ka_search_advanced" href="#"	onclick="BasicSearch(); return false;"><span>basic</span></a>');
	} else{
	$("#ka_searchText").html('<a id="ka_search_advanced" href="#"	onclick="BasicSearch(); return false;"><span style="color:#b8b800;text-decoration:underline;font-size:11px;">basic</span></a>');
	}
	$("#ka_searchAdv1").show();
}

function BasicSearch(){
	var strurl = window.location.href;
	if(strurl.search("kickapps_theme2010") !== -1 || strurl.search("volunteerteams") !== -1 || strurl.search("offlinevolunteerunit") !== -1 || strurl.search("volunteerteamdashboard") !== -1){
	$("#ka_searchText").html('<a id="ka_search_advanced" href="#"	onclick="AdvancedSearch(); return false;"><span>advanced</span></a>');
	} else{
	$("#ka_searchText").html('<a id="ka_search_advanced" href="#"	onclick="AdvancedSearch(); return false;"><span style="color:#b8b800;text-decoration:underline;font-size:11px;">advanced</span></a>');
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

function change_troopteams(id, type, coltroop){
		$.post(
		"/community/loadtroopteams/" + id + "/" + type + "/" + coltroop + "/" + "hopeful",
		{func: ""},
		function(oReply){
			$("#teams_div").html(oReply.OUTPUT);
			$("#teams_lines").html(oReply.LINES);
		},
		"json"
		);
		
}

function teamsselectbyschools(val){
   if(val !== ''){
	if(val == 'Maximo Estrella Elementary School'){
	$("#group_name_teams").html('<b>'+val+'</b><br/>Community Building Teams');
	$("#coming_soonmsg").hide(); 
	$("#heirarchy_menu").show();
	} else{ 
	$("#group_name_teams").html('<b>'+val+'</b><br/>Community Building Teams');
	$("#coming_soonmsg").show();
	$("#heirarchy_menu").hide();
	}
 }
}
