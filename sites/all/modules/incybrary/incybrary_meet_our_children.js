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


var aChildren;
var aDetails;

$(document).ready(
	function(){
		
		RequestImage("all");

		$("a#button_children_online").click(
			function(){
				//$("#incybrary_block_title").text("In the Cybrary Now");
				$("#incybrary_status_title").text("In the Cybrary Now");
				RequestImage("online");
			}
		);
		
		$("a#button_children_24").click(
			function(){
				//$("#incybrary_block_title").text("In the last 24 hours");
				$("#incybrary_status_title").text("In the last 24 hours");
				RequestImage(24);
			}
		);
		
		$("a#button_children_all").click(
			function(){
				//$("#incybrary_block_title").text("All Hopefuls");
				$("#incybrary_status_title").text("All Hopefuls");
				RequestImage("all");
			}
		);
		
		function RequestImage(sRequestType){
			$("#incybrary_avatar").attr("src", "/sites/default/files/pictures/none.png");
			$("#incybrary_hopeful_details").html("The selected child's description will go here.");
			
			$("#incybrary_hopeful_nav").html("&nbsp;");
			$("div#incybrary_hopeful_list").text("Fetching data...");
			
			var addGlobalSchool = '';
			if($("#globalCurrentSchool").val() !== ""){
				addGlobalSchool = "/" + $("#globalCurrentSchool").val();
			}
			
			$.post(
				"/children/"+sRequestType + addGlobalSchool,
				{ func: "GetChildren" },
				function(sReply){
					var sOutput = '';
					
					aChildren = sReply.RETURN;
					aDetails = sReply.DETAILS;
					
					if (aChildren.length > 0){
						PageThis();
					}else{
						$("div#incybrary_hopeful_list").html("No children to list, yet.");
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
		
		sOutput += '<div><img width="70" height="84" class="incybrary_thumbnail" id="' + iUserId + '" user="' + sChildName + '" src="' + sImageURL + "?" + Math.floor(Math.random()*1000) + '" alt="' + sChildName + '" title="' + aChildren[i].name + '" /><br />' + sChildName + '</div>';
		
		if (i == 0){
			$("#incybrary_hopeful_details").html("The selected child's description will go here.");
			$("#incybrary_avatar").attr("src", sImageURL);
			
			var iUID = iUserId;
			var sName = sChildName;
			var sEmail = sChildEmail;
			
			sDescription = '<table width="100%" border="0" cellspacing="0" cellpadding="2">' +
								'<tr><td colspan="2" class="header">' + sChildName + '</td></tr>';
			
			for (x=0; x<aDetails.length; x++){
				if (aDetails[x].uid == iUserId){
					sDescription += '<tr><td width="110">Language(s):</td><td class="info">' + ((isset(aDetails[x].language)) ? aDetails[x].language:'Not specified') + '</td></tr>';
					sDescription += '<tr><td>Talent(s):</td><td class="info">' + ((isset(aDetails[x].talent)) ? aDetails[x].talent:'Not specified') + '</td></tr>';
					sDescription += '<tr><td>Favorite(s):</td><td class="info">' + ((isset(aDetails[x].favorite)) ? aDetails[x].favorite:'Not specified') + '</td></tr>';
					sDescription += '<tr><td>Lives with:</td><td class="info">' + ((isset(aDetails[x].lives_with)) ? aDetails[x].lives_with:'Not specified') + '</td></tr>';
					sDescription += '<tr><td>Family Income:</td><td class="info">' + ((isset(aDetails[x].income)) ? aDetails[x].income:'Not specified') + ' per month</td></tr>';
					
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
					alert("This feature is deprecated and has been disabled.");
					
					/*$.post(
						"/children/profile",
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
								$("#hc_HopefulProfile").attr("src", "http://affiliate.kickapps.com/service/displayKickPlace.kickAction?css=kickapps_theme2010&as=158175&u="+sReply.RETURN+"&location=community");
							}
						},
						"json"
					);*/
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
											'<tr><td colspan="2" class="header">' + $(this).attr("alt") + '</td></tr>';
					
					for (i=0; i<aDetails.length; i++){
						if (aDetails[i].uid == iUserId){
							$("#incybrary_avatar")
								.unbind()
								.attr("src", $(this).attr("src"))
								.click(
									function(){
										$.post(
											"/children/profile",
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
													
													alert("This feature is deprecated and has been disabled.");
													//$("#hc_HopefulProfile").attr("src", "http://affiliate.kickapps.com/service/displayKickPlace.kickAction?css=kickapps_theme2010&as=158175&u="+sReply.RETURN);
												}
											},
											"json"
										);
										
										
									}
								);
							
							sDescription += '<tr><td width="110">Language(s):</td><td class="info">' + ((isset(aDetails[i].language)) ? aDetails[i].language:'Not specified') + '</td></tr>';
							sDescription += '<tr><td>Talent(s):</td><td class="info">' + ((isset(aDetails[i].talent)) ? aDetails[i].talent:'Not specified') + '</td></tr>';
							sDescription += '<tr><td>Favorite(s):</td><td class="info">' + ((isset(aDetails[i].favorite)) ? aDetails[i].favorite:'Not specified') + '</td></tr>';
							sDescription += '<tr><td>Lives with:</td><td class="info">' + ((isset(aDetails[i].lives_with)) ? aDetails[i].lives_with:'Not specified') + '</td></tr>';
							sDescription += '<tr><td>Family Income:</td><td class="info">' + ((isset(aDetails[i].income)) ? aDetails[i].income:'Not specified') + ' per month</td></tr>';
							
							break;
						}
					}
					
					$("#incybrary_hopeful_details").html(sDescription+'</table>');
				}
			);
		}
	);
}

function openMeetHopefulDialog(div){
$("#"+div).dialog(
	{
											modal: true,
											autoOpen: true,
											resizable: false,
											width: 750,
											buttons: {
												"Ok": function(){
													$(this).dialog("close");
												}
											}
	});
}

function tempchangeschoolMeetHopefuls(val){
		$("#globalCurrentSchool").val(val);
		RequestImage("all");
}

function RequestImage(sRequestType){
			$("#incybrary_avatar").attr("src", "/sites/default/files/pictures/none.png");
			$("#incybrary_hopeful_details").html("The selected child's description will go here.");
			
			$("#incybrary_hopeful_nav").html("&nbsp;");
			$("div#incybrary_hopeful_list").text("Fetching data...");
			
			var addGlobalSchool = '';
			if($("#globalCurrentSchool").val() !== ""){
				addGlobalSchool = "/" + $("#globalCurrentSchool").val();
			}
			
			$.post(
				"/children/"+sRequestType + addGlobalSchool,
				{ func: "GetChildren" },
				function(sReply){
					var sOutput = '';
					
					aChildren = sReply.RETURN;
					aDetails = sReply.DETAILS;
					
					if (aChildren.length > 0){
						PageThis();
					}else{
						$("div#incybrary_hopeful_list").html("No children to list, yet.");
					}
				},
				"json"
			);
		}