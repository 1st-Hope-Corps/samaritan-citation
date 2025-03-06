/*(function($){
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
})(jQuery);*/

/*
$(document).ready(
	function(){
		$("#invent_computer").css("font-weight", "bold");
		
		$("#invent_computer").click(
			function(){
				var sHTML = '<p><b>Computer and Internet Learning...</b></p>' +
							'<p>The Cybrary is equipped with Pentium class computers with high-speed internet acceess. The children, under the supervision of a Librarian, can work individually or with assistance of a tutor to research and prepare their homework, assignments, and special projects. We provide both online and offline access to the best educational websites and software. Throught he use of Infofrmation Technology, we hope to inspire the children to create a future of their choice.</p>' +
							'<a id="learn_computer" href="javascript:void(0);">LEARN MORE</a>';
				
				$("#invent_image").attr("src", "/misc/visit_computer.jpg");
				$("#invent_image").show();
				$("#invent_image_replacement").hide();
				$("#invent_desc").html(sHTML);
				
				$("button").each(
					function(){
						sFontWeight = (this.id == "invent_computer") ? "bold":"normal";
						
						$(this).css("font-weight", sFontWeight);
					}
				);
				
				$("#learn_computer").click(
					function(){
						$("#notice_title").html("Learn more about Computer and Internet");
						$("#notice").show().center();
					}
				);
			}
		);
		
		$("#invent_library").click(
			function(){
				var sHTML = '<p><b>Title will go here...</b></p>' +
							'<p>Some description will go here.</p>' +
							'<a id="learn_library" href="javascript:void(0);">LEARN MORE</a>';
				
				$("#invent_image").hide();
				$("#invent_image_replacement").show();
				$("#invent_desc").html(sHTML);
				
				$("button").each(
					function(){
						sFontWeight = (this.id == "invent_library") ? "bold":"normal";
						
						$(this).css("font-weight", sFontWeight);
					}
				);
				
				$("#learn_library").click(
					function(){
						$("#notice_title").html("Learn more about Library");
						$("#notice").show().center();
					}
				);
			}
		);
		
		$("#invent_values").click(
			function(){
				var sHTML = '<p><b>Title will go here...</b></p>' +
							'<p>Some description will go here.</p>' +
							'<a id="learn_values" href="javascript:void(0);">LEARN MORE</a>';
				
				$("#invent_image").hide();
				$("#invent_image_replacement").show();
				$("#invent_desc").html(sHTML);
				
				$("button").each(
					function(){
						sFontWeight = (this.id == "invent_values") ? "bold":"normal";
						
						$(this).css("font-weight", sFontWeight);
					}
				);
				
				$("#learn_values").click(
					function(){
						$("#notice_title").html("Learn more about Values");
						$("#notice").show().center();
					}
				);
			}
		);
		
		$("#invent_commerce").click(
			function(){
				var sHTML = '<p><b>Title will go here...</b></p>' +
							'<p>Some description will go here.</p>' +
							'<a id="learn_commerce" href="javascript:void(0);">LEARN MORE</a>';
				
				$("#invent_image").hide();
				$("#invent_image_replacement").show();
				$("#invent_desc").html(sHTML);
				
				$("button").each(
					function(){
						sFontWeight = (this.id == "invent_commerce") ? "bold":"normal";
						
						$(this).css("font-weight", sFontWeight);
					}
				);
				
				$("#learn_commerce").click(
					function(){
						$("#notice_title").html("Learn more about Commerce");
						$("#notice").show().center();
					}
				);
			}
		);
		
		$("#notice_close").click(
			function(){
				$("#notice").hide();
			}
		);
	}
); */

$(document).ready(function() {
						$("a[id^=future_nav]").click( 
							function() {
								$(".cnavactive").removeClass("cnavactive");
								$(this).addClass("cnavactive");
								$("div[id^=content_future_nav]").hide();					
								$("#content_" + $(this).attr("id")).show();
							}
						);
						
						$("a[id^=why]").click( 
							function() {
								$("#default_why").hide();
								$("#content_" + $(this).attr("id")).show();
							}
						);
						
						$("div[id^=content_why]").click( 
							function() {
								$(this).hide();
								$("#default_why").show();
							}
						);
					});

var cybrary_iErrorCount = 0;
var cybrary_iErrorCount_static = 0;
var cybrary_iCamToUse = 1;
//var cybrary_sCamServer = "http://hopecybrary.dlinkddns.com:8080";
var cybrary_sCamServer = "http://meeshc.dyndns.tv:8080";
var cybrary_sLoadingImage = "http://www.hopecybrary.org/misc/loading.gif"
var cybrary_sOfflineImage = "http://www.hopecybrary.org/themes/theme2010/images/gi_webcam_large.jpg"

function cybrary_LoadImage(){
	cybrary_iUnique = Math.random();
	document.images.Cybrary_CamContainer.src = cybrary_sCamServer+"/cam_"+cybrary_iCamToUse+".jpg?i="+cybrary_iUnique;
}

function cybrary_RefreshCam(iInputCamToUse){
	if (iInputCamToUse != null) cybrary_iCamToUse = iInputCamToUse;
	window.setTimeout("cybrary_LoadImage("+cybrary_iCamToUse+");", 1000);
}

function cybrary_OnError(bInputCount, iInputCamId){
	cybrary_iErrorCount++;
	document.images.Cybrary_CamContainer.src = cybrary_sOfflineImage; 
	$("#webcamStatus").html("<h3 style='color:#f48502;'>- Webcams currently offline -</h3>");
	$("#StaticCam1").attr("src", "http://www.hopecybrary.org/themes/theme2010/images/gi_webcam_small1.png");
	$("#StaticCam2").attr("src", "http://www.hopecybrary.org/themes/theme2010/images/gi_webcam_small2.png");
	$("#StaticCam3").attr("src", "http://www.hopecybrary.org/themes/theme2010/images/gi_webcam_small3.png");
	$("#StaticCam4").attr("src", "http://www.hopecybrary.org/themes/theme2010/images/gi_webcam_small4.png");
	
	if (cybrary_iErrorCount > 0){
		document.images.Cybrary_CamContainer.onload = "";
	}else{
		cybrary_LoadImage();
	}
}

function cybrary_OnError_static(sInputCamId){
	cybrary_iErrorCount_static++;
	
	eval("var oCamSource = document.images."+sInputCamId+";");
	
	var cybrary_sOldSrc = oCamSource.src;
	oCamSource.src = cybrary_sOfflineImage;
	
	if (cybrary_iErrorCount_static <= 2){
		oCamSource.src = cybrary_sOldSrc;
		oCamSource.title = "Cam is unavailable.";
	}
}

function schoolWebcam(val){
	if(val !== '3'){
		$("#webcamSmall1").hide();
		$("#webcamSmall2").hide();
		$("#largeWebcam").hide();
		$("#webcamSmall1_hide").show();
		$("#webcamSmall2_hide").show();
		$("#largeWebcam_hide").show();
	} else{
		$("#webcamSmall1_hide").hide();
		$("#webcamSmall2_hide").hide();
		$("#largeWebcam_hide").hide();
		$("#webcamSmall1").show();
		$("#webcamSmall2").show();
		$("#largeWebcam").show();
	}
}

function openVisitCybraryDialog(div){
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

function requestInTheCybraryNow(){
			$.post(
				"/incybrary/total",
				{ func: "GetChildren" },
				function(sReply){
					var sOutput = '';
					aTotalChildren = sReply.TOTALCHILDREN;
					aTotalVolunteers = sReply.TOTALVOLUNTEER;
					aTotalSchools = sReply.TOTALSCHOOLS;
				    aChildren = sReply.CHILDREN;
					aVolunteer = sReply.VOLUNTEER;
					
					$("#hopefulstotal").text(aTotalChildren);
					$("#volunteerstotal").text(aTotalVolunteers);
					$("#cybrariestotal").text(aTotalSchools);
					
					if(aTotalSchools == '1' || aTotalSchools == '0'){
					$("#cybrariesTerm").text("Cybrary");
					} else{
					$("#cybrariesTerm").text("Cybraries");
					}
						PageChildInCybrary();
						PageVolunteerInCybrary();
						
					if (aChildren.length < 0){
						$("#childList").html("<br/>There are no children online in the Cybrary, yet.");
					}
					
					if (aVolunteer.length < 0){
						$("#volunteerList").html("<br/>There are no volunteers online in the Cybrary, yet.");
					}
				},
				"json"
			);
}

function tempchangeschool(val){
	if(val !== ''){
		$.post(
				"/incybrary/individualschool/"+val,
				{ func: "GetChildren" },
				function(sReply){
					var sOutput = '';
					aChildren = sReply.CHILDREN;
					aVolunteer = sReply.VOLUNTEER;

						PageChildInCybrary();
						PageVolunteerInCybrary();
					
					if (aChildren.length == 0){
						$("#childList").html("<br/><span style='color:black;'>There are no children online in the Cybrary, yet.</span>");
						$("#inCybrary_hopeful_nav").html("");
					}
					
					if (aVolunteer.length == 0){
						$("#volunteerList").html("<br/><span style='color:black;'>There are no volunteers online in the Cybrary, yet.</span>");
						$("#inCybrary_volunteer_nav").html("");
					}
				},
				"json"
		);
	} 
}

function PageChildInCybrary(iThisOffSet, iThisInSet){
	if (aChildren.length > 0){
		var iResultsPerPage = 10;
		
		iThisOffSet = (iThisOffSet == null) ? 0:iThisOffSet;
		iThisInSet = (iThisInSet == null) ? iResultsPerPage:iThisInSet;
		
		var iRecordCount = aChildren.length;
		var iRawTotalPages = iRecordCount/iResultsPerPage;
		var iTotalPages = Math.floor(iRawTotalPages);
		var iCurrPage = iThisInSet/iResultsPerPage;
		var sOutput = "";
		
		if (iTotalPages == 0) iTotalPages = 1;
		if (iRawTotalPages > iTotalPages) iTotalPages++;
		
		sDescription = '<br/><b style="color:black;">Hopeful(s)</b><br/><br/>';
		for (i=iThisOffSet; i<iThisInSet && i<iRecordCount; i++){
			sImageURL = "/" + aChildren[i].picture;
			iUserId = aChildren[i].uid;
			sChildName = aChildren[i].name;
			sChildEmail = aChildren[i].mail;
		
			//if (i == 0){
				var iUID = iUserId;
				var sName = sChildName;
				var sEmail = sChildEmail;
				
				sDescription += '' + sChildName + '<br/>';
				$("#childList").html(sDescription+'</table>');
			//}
		}
		
		iThisOffSet += iResultsPerPage;
		iThisInSet += iResultsPerPage;
		sPageNext = (iThisOffSet < iRecordCount) ? "<a class=\"link\" href=\"javascript:PageChildInCybrary("+iThisOffSet+", "+iThisInSet+");\">Next &gt;</a>":"";
		iThisOffSet -= (iThisOffSet < 0) ? 0:(iResultsPerPage * 2);
	    iThisInSet -= (iThisInSet == 0) ? iResultsPerPage:(iResultsPerPage * 2);
	    sPagePrev = (iThisOffSet < 0 && iThisInSet == 0) ? "":"<a class=\"link\" href=\"javascript:PageChildInCybrary("+iThisOffSet+", "+iThisInSet+");\">&lt; Previous</a>";
		
		sPageNav = '<table border="0" style="width:100%; font-size:0.9em;"><tr><td style="width:25%;">'+sPagePrev+'</td><td style="text-align:center; width:50%;">Page '+iCurrPage+' of '+iTotalPages+'</td><td style="text-align:right; width:25%;">'+sPageNext+'</td></tr></table>';
		
		$("#inCybrary_hopeful_nav").html(sPageNav);
	}
}

function PageVolunteerInCybrary(iThisOffSet, iThisInSet){
  if (aVolunteer.length > 0){
	var iResultsPerPage = 10;
	
	iThisOffSet = (iThisOffSet == null) ? 0:iThisOffSet;
	iThisInSet = (iThisInSet == null) ? iResultsPerPage:iThisInSet;
	
	var iRecordCount = aVolunteer.length;
	var iRawTotalPages = iRecordCount/iResultsPerPage;
	var iTotalPages = Math.floor(iRawTotalPages);
	var iCurrPage = iThisInSet/iResultsPerPage;
	var sOutput = "";
	
	if (iTotalPages == 0) iTotalPages = 1;
	if (iRawTotalPages > iTotalPages) iTotalPages++;
	
	sDescription = '<br/><b style="color:black;">Volunteer(s)</b><br/><br/>';
	for (i=iThisOffSet; i<iThisInSet && i<iRecordCount; i++){
		sImageURL = "/" + aVolunteer[i].picture;
		iUserId = aVolunteer[i].uid;
		sChildName = aVolunteer[i].name;
		sChildEmail = aVolunteer[i].mail;
	
		//if (i == 0){
			var iUID = iUserId;
			var sName = sChildName;
			var sEmail = sChildEmail;
			
			sDescription += '' + sChildName + '<br/>';

			$("#volunteerList").html(sDescription+'</table>');
		//}
	}
	
	iThisOffSet += iResultsPerPage;
	iThisInSet += iResultsPerPage;
	sPageNext = (iThisOffSet < iRecordCount) ? "<a class=\"link\" href=\"javascript:PageVolunteerInCybrary("+iThisOffSet+", "+iThisInSet+");\">Next &gt;</a>":"";
	iThisOffSet -= (iThisOffSet < 0) ? 0:(iResultsPerPage * 2);
	iThisInSet -= (iThisInSet == 0) ? iResultsPerPage:(iResultsPerPage * 2);
	sPagePrev = (iThisOffSet < 0 && iThisInSet == 0) ? "":"<a class=\"link\" href=\"javascript:PageVolunteerInCybrary("+iThisOffSet+", "+iThisInSet+");\">&lt; Previous</a>";
		
	sPageNav = '<table border="0" style="width:100%; font-size:0.9em;"><tr><td style="width:25%;">'+sPagePrev+'</td><td style="text-align:center; width:50%;">Page '+iCurrPage+' of '+iTotalPages+'</td><td style="text-align:right; width:25%;">'+sPageNext+'</td></tr></table>';
		
	$("#inCybrary_volunteer_nav").html(sPageNav);
  }
}
requestInTheCybraryNow();