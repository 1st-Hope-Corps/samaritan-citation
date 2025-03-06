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

/* jQuery.cookie = function(name, value, options) {
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
}; */


var aChildren;
var aDetails;

$(document).ready(
	function(){				
		RequestImage("all");

		$("div#instruction1").click(
			function(){
				$("#instruction1_selected").fadeIn('slow', function() {});
				$("#instruction2").show();
				$("#instruction3").show();
				$("#instruction4").show();
				$("#instruction5").show();
				$("#instruction1").hide();
				$("#instruction2_selected").hide();
				$("#instruction3_selected").hide();
				$("#instruction4_selected").hide();
				$("#instruction5_selected").hide();
				
				$("#instruction_message2").hide();
				$("#instruction_message3").hide();
				$("#instruction_message4").hide();
				$("#instruction_message5").hide();
				$('#instruction_message1').fadeIn('slow', function() {});
			}
		);
		
		$("div#instruction2").click(
			function(){
				$("#instruction2_selected").fadeIn('slow', function() {});
				$("#instruction1").show();
				$("#instruction3").show();
				$("#instruction4").show();
				$("#instruction5").show();
				$("#instruction2").hide();
				$("#instruction1_selected").hide();
				$("#instruction3_selected").hide();
				$("#instruction4_selected").hide();
				$("#instruction5_selected").hide();
				
				$("#instruction_message1").hide();
				$("#instruction_message3").hide();
				$("#instruction_message4").hide();
				$("#instruction_message5").hide();
				$('#instruction_message2').fadeIn('slow', function() {});
				
			}
		);
		
		$("div#instruction3").click(
			function(){
				$("#instruction3_selected").fadeIn('slow', function() {});
				$("#instruction1").show();
				$("#instruction2").show();
				$("#instruction4").show();
				$("#instruction5").show();
				$("#instruction3").hide();
				$("#instruction1_selected").hide();
				$("#instruction2_selected").hide();
				$("#instruction4_selected").hide();
				$("#instruction5_selected").hide();
				
				$("#instruction_message1").hide();
				$("#instruction_message2").hide();
				$("#instruction_message4").hide();
				$("#instruction_message5").hide();
				$('#instruction_message3').fadeIn('slow', function() {});
			}
		);
		
		$("div#instruction4").click(
			function(){
				$("#instruction4_selected").fadeIn('slow', function() {});
				$("#instruction1").show();
				$("#instruction2").show();
				$("#instruction3").show();
				$("#instruction5").show();
				$("#instruction4").hide();
				$("#instruction1_selected").hide();
				$("#instruction2_selected").hide();
				$("#instruction3_selected").hide();
				$("#instruction5_selected").hide();
				
				$("#instruction_message1").hide();
				$("#instruction_message2").hide();
				$("#instruction_message3").hide();
				$("#instruction_message5").hide();
				$('#instruction_message4').fadeIn('slow', function() {});
			}
		);
		
		$("div#instruction5").click(
			function(){
				$("#instruction5_selected").fadeIn('slow', function() {});
				$("#instruction1").show();
				$("#instruction2").show();
				$("#instruction3").show();
				$("#instruction4").show();
				$("#instruction5").hide();
				$("#instruction1_selected").hide();
				$("#instruction2_selected").hide();
				$("#instruction3_selected").hide();
				$("#instruction4_selected").hide();
				
				$("#instruction_message1").hide();
				$("#instruction_message2").hide();
				$("#instruction_message3").hide();
				$("#instruction_message4").hide();
				$('#instruction_message5').fadeIn('slow', function() {});
			}
		);
		
		$("img#instruction1_img").hover(
			function(){
				$("#instruction1_s_img").show();
				$("#instruction1_img").hide();
				
				$("#instruction2_s_img").hide();
				$("#instruction3_s_img").hide();
				$("#instruction4_s_img").hide();
				$("#instruction5_s_img").hide();
				$("#instruction2_img").show();
				$("#instruction3_img").show();
				$("#instruction4_img").show();
				$("#instruction5_img").show();
			}
		); 
		
		$("img#instruction1_s_img").mouseout(
			function(){
				$("#instruction1_img").show();
				$("#instruction1_s_img").hide();
			}
		); 
		
		$("img#instruction2_img").hover(
			function(){
				$("#instruction2_s_img").show();
				$("#instruction2_img").hide();
				
				$("#instruction1_s_img").hide();
				$("#instruction3_s_img").hide();
				$("#instruction4_s_img").hide();
				$("#instruction5_s_img").hide();
				$("#instruction1_img").show();
				$("#instruction3_img").show();
				$("#instruction4_img").show();
				$("#instruction5_img").show();
			}
		); 
		
		$("img#instruction2_s_img").mouseout(
			function(){
				$("#instruction2_img").show();
				$("#instruction2_s_img").hide();
			}
		);
		
		$("img#instruction3_img").hover(
			function(){
				$("#instruction3_s_img").show();
				$("#instruction3_img").hide();
				
				$("#instruction1_s_img").hide();
				$("#instruction2_s_img").hide();
				$("#instruction4_s_img").hide();
				$("#instruction5_s_img").hide();
				$("#instruction1_img").show();
				$("#instruction2_img").show();
				$("#instruction4_img").show();
				$("#instruction5_img").show();
			}
		); 
		
		$("img#instruction3_s_img").mouseout(
			function(){
				$("#instruction3_img").show();
				$("#instruction3_s_img").hide();
			}
		);
		
		$("img#instruction4_img").hover(
			function(){
				$("#instruction4_s_img").show();
				$("#instruction4_img").hide();
				
				$("#instruction1_s_img").hide();
				$("#instruction2_s_img").hide();
				$("#instruction3_s_img").hide();
				$("#instruction5_s_img").hide();
				$("#instruction1_img").show();
				$("#instruction2_img").show();
				$("#instruction3_img").show();
				$("#instruction5_img").show();
			}
		); 
		
		$("img#instruction4_s_img").mouseout(
			function(){
				$("#instruction4_img").show();
				$("#instruction4_s_img").hide();
			}
		);
		
		$("img#instruction5_img").hover(
			function(){
				$("#instruction5_s_img").show();
				$("#instruction5_img").hide();
				
				$("#instruction1_s_img").hide();
				$("#instruction2_s_img").hide();
				$("#instruction3_s_img").hide();
				$("#instruction4_s_img").hide();
				$("#instruction1_img").show();
				$("#instruction2_img").show();
				$("#instruction3_img").show();
				$("#instruction4_img").show();
			}
		); 
		
		$("img#instruction5_s_img").mouseout(
			function(){
				$("#instruction5_img").show();
				$("#instruction5_s_img").hide();
			}
		);
		
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
		
		$("#review-choice-button").click(
			function(){
				/*$("#terms-conditions").slideDown(); 
				$("#reviewchoice").hide(); 
				$("#confirmchoice").fadeIn('slow', function() {});
				$("#indication-pane-2").fadeIn('slow', function() {});
				$("#indication-pane-1").hide();
				$("#cancel1").hide();
				$("#cancel2").show();*/
				if($('#agreetermsandconditions').is(':checked') == true){
					location.href=Drupal.settings.basePath+"instant/mentor/confirm";
				} else{
					alert("Please accept the terms and conditions.");
				}	
			}
		); 
		
		/*$("#confirm-choice-button").click(
			function(){
				if($('#agreetermsandconditions').is(':checked') == true){
					location.href=Drupal.settings.basePath+"instant/mentor/confirm";
				} else{
					alert("Please accept the terms and conditions.");
				}				
			}
		); */
		
		$("#finish-choice-button").click(
			function(){
				jQuery.cookie('uids', null, { path: '/' });
				location.href=Drupal.settings.basePath+"instant/mentor/dashboard";				
			}
		); 
		
		/*$("#confirm-choice-button").click(
			function(){
				if($('#agreetermsandconditions').is(':checked') == true){
					jQuery.cookie('uids', null, { path: '/' });
					location.href=Drupal.settings.basePath+"instant/mentor/dashboard?addnew=1";	
				} else{
					alert("Please accept the terms and conditions.");
				}				
			}
		); */
		
		$("#cancelbutton2").click(
			function(){
				$("#terms-conditions").slideUp(); 
				$("#reviewchoice").fadeIn('slow', function() {});
				$("#confirmchoice").hide();
				$("#indication-pane-2").hide();
				$("#indication-pane-1").fadeIn('slow', function() {});	
				$("#cancel2").hide();
				$("#cancel1").show();
			}
		);
		
		$("#ementor_btnVolunteerDeactivate").click(
			function(){
				$("#deactivate_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 430,
						buttons: {
							"Deactivate": function(){
								location = Drupal.settings.basePath+"instant/mentor/deactivate";
							},
							"Cancel": function(){
								$(this).dialog("close");
							}
						}
				});
			}
		); 
		
		var urlpath = location.pathname.split("/");
		if(urlpath[3] == 'dashboard'){
				$.post(
				Drupal.settings.basePath+"secure/kindness/callback/details",
				{func: "kindness_details"},
				function(sReply){
					iKindnessBalance = sReply.RETURN.HOURS;
					iHopeBucksBalance = sReply.RETURN.BALANCE;
					$("#iKindnessBalance").val(iKindnessBalance);
					    //var sKindnessNotice = sReply.RETURN.NOTICE;
						//$("#bank_deposit_notice").text(sKindnessNotice);
						if(iHopeBucksBalance > 0){
						$("#hopebucks").text(iHopeBucksBalance);
						$("#hopedivbucks").addClass("gi_green");
						} else{
						$("#hopebucks").text(0);
						$("#hopedivbucks").addClass("gi_green");
						}
					},
					"json"
				);
		}
		
		var estart = 0;
		var nb = 4;
		var eend = estart + nb;
		var length = $('.div-list div').length;
		var elist = $('.div-list div');
		elist.hide().filter(':lt('+(eend)+')').show();
		$('.eprev, .enext').click(function(e){
		   e.preventDefault();

		   if( $(this).hasClass('eprev') ){
			   estart -= nb;
		   } else {
			   estart += nb;
		   }

		   if( estart < 0 || estart >= length ) estart = 0;
		   eend = estart + nb;       

		   if( estart == 0 ) elist.hide().filter(':lt('+(eend)+')').show();
		   else elist.hide().filter(':lt('+(eend)+'):gt('+(estart-1)+')').show();
		});

		function RequestImage(sRequestType){
			$("#incybrary_avatar").attr("src", Drupal.settings.basePath+"sites/default/files/pictures/none.png");
			$("#incybrary_hopeful_details").html("The selected child's description will go here.");
			
			$("#incybrary_hopeful_nav").html("&nbsp;");
			$("div#incybrary_hopeful_list").text("Fetching data...");
			
			var addGlobalSchool = '';
			if($("#globalCurrentSchool").val() !== ""){
				addGlobalSchool = "/" + $("#globalCurrentSchool").val();
			}
			
			$.post(
				Drupal.settings.basePath+"children/"+sRequestType + addGlobalSchool,
				{ func: "GetChildren" },
				function(sReply){
					var sOutput = '';
					aChildren = sReply.RETURN;
					aDetails = sReply.DETAILS;
					//console.log(aChildren.length);
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
	var iResultsPerPage = 8;
	
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
		sImageURL = Drupal.settings.basePath + aChildren[i].picture;
		iUserId = aChildren[i].uid;
		sChildName = aChildren[i].name;
		sChildEmail = aChildren[i].mail;
		
		
		sOutput += '<div><img width="70" height="84" class="incybrary_thumbnail" id="' + iUserId + '" user="' + sChildName + '" src="' + sImageURL + "?" + Math.floor(Math.random()*1000) + '" alt="' + sChildName + '" title="' + aChildren[i].name + '" /><br />' + sChildName + '<br/><span style="color:#f9b164;">Has <span id="pagingHopefuls_'+iUserId+'">loading</span> eMentors</div>';
		
		if (i == 0){
			$("#incybrary_hopeful_details").html("The selected child's description will go here.");
			$("#incybrary_avatar").attr("src", sImageURL);
			
			var iUID = iUserId;
			var sName = sChildName;
			var sEmail = sChildEmail;
			
			sDescription = '<table width="100%" border="0" cellspacing="0" cellpadding="2">' +
								'<tr><td colspan="2"><h3 style="color:black;"><b>Hello! My name is: ' + sChildName + '</b></h3><span stye="font-size:14px;">If you would like to Instant eMentor me then please click the "eMentor Now" button</span><br/><span style="color:#f9b164;">I have <span id="pagingHopefuls2_'+iUserId+'">loading</span> eMentors</span></td></tr>';
			
			for (x=0; x<aDetails.length; x++){
				if (aDetails[x].uid == iUserId){
					sDescription += '<tr><td width="110">Language(s):</td><td class="info">' + ((isset(aDetails[x].language)) ? aDetails[x].language:'Not specified') + '</td></tr>';
					sDescription += '<tr><td>Talent(s):</td><td class="info">' + ((isset(aDetails[x].talent)) ? aDetails[x].talent:'Not specified') + '</td></tr>';
					sDescription += '<tr><td>Favorite(s):</td><td class="info">' + ((isset(aDetails[x].favorite)) ? aDetails[x].favorite:'Not specified') + '</td></tr>';
					sDescription += '<tr><td>Lives with:</td><td class="info">' + ((isset(aDetails[x].lives_with)) ? aDetails[x].lives_with:'Not specified') + '</td></tr>';
					sDescription += '<tr><td>Family Income:</td><td class="info">' + ((isset(aDetails[x].income)) ? aDetails[x].income:'Not specified') + ' per month</td></tr>';
					sDescription += '<tr><td colspan="2">&nbsp;</div></td></tr>';
					//sDescription += '<tr><td colspan="2"><div style="cursor:pointer;" onclick="location.href='+"'/instant/mentor/choose/"+iUID+"'"+';"><img src="/themes/theme2010/images/instant_ementor_now.png" border="0"/></div></td></tr>';
					sDescription += '<tr><td colspan="2"><div style="cursor:pointer;" onclick="saveChildredirect('+"'"+iUID+"'"+')"><img src="'+Drupal.settings.basePath+'themes/theme2010/images/instant_ementor_now.png" border="0"/></div></td></tr>';
					
					break;
				}
			}
			
			$("#incybrary_hopeful_details").html(sDescription+'</table>');
		}
		getEmentorCount(iUserId);
	}
	
	
	if (iUID && sName){
		$("#incybrary_avatar")
			.unbind()
			.click(
				function(){
					activate_view(iUID, sName)
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

function saveChildredirect(iUid){
	
	/* var uids = "";
	var array = "";
	
	if(jQuery.cookie('uids')){
		var uids = jQuery.cookie('uids');
		var array = uids.split('-');
		var conf = false;

		$.each(array, function(index, key) { 
		  if(key == iUid){
			conf = true;
		  }
		});

		if(conf == false){
		uids = jQuery.cookie('uids')+"-"+iUid;
		}
	
	} else{
		uids = iUid;
	}
	
	jQuery.cookie('uids', uids, { path: '/' }); */
	
	/* var sUid = "<?php echo $_SESSION['uids'] ?>";
	var aUid;
	var bExist = false;
	
	if (sUid == ''){
		sUid = iUid;
	}else{
		aUid = sUid.split('-');
		iUidLen = aUid.length;
		
		$.each(
			aUid,
			function(index, key){
				if (key == iUid){
					bExist = true;
				}
			}
		);
		
		if (!bExist) aUid[] = iUid;
	} */
	
	//$.cookie('uids', sUid, { path:'/' });
	
	location.href = Drupal.settings.basePath+"instant/mentor/choose/"+iUid;
}

function removeHopeful(iUid, sName, iListCount){
//alert(iUid);
	
	if ($('#removeHopeful_'+iUid).is(':checked')){
		var bAnswer = confirm("Remove " + sName + " from your list?");
		
		if (bAnswer){
			location.href = Drupal.settings.basePath+"instant/mentor/choose/remove/"+iUid+"/"+iListCount;
		}
	}
	
	/* if ($('#removeHopeful_'+iUid).is(':checked')){
		var bAnswer = confirm("Remove " + sName + " from your list?");
		
		if (bAnswer){
			$('#removeHopeful_'+iUid).attr('checked', false);
			
			if ($.cookie('uids') === null){
				sUid = iUid;
			}else{
				var sUid = $.cookie('uids');
				var aUid = sUid.split('-');
				var sNewUid = "";
				
				$.each(
					aUid,
					function(index, key){
						if (key != iUid){
							sNewUid += key+'-';
						}
					}
				);
				
				sNewUid = sNewUid.substring(0, sNewUid.length-1);
			}
			
			$.cookie('uids', sNewUid, { path:'/' });
			location.href = "/instant/mentor/choose/"+iUid;
		}
	} */
}

function confirm_hopeful_ementor(iUserID){
	$("#selected-hopeful-list").html('<img src="/misc/button-loader-big.gif" /><span>');
	$.post(
		Drupal.settings.basePath+"instant/mentor/confirm_save",
		{
			uid: iUserID
		},
		function(sReply){
			if (sReply.STATUS == 1){
				$("#selected-hopeful-list").html(sReply.RETURN);
				$("#usermentor_"+iUserID).html(sReply.COUNT);
				$('#finish-choice-button').css('display','inline-block');
			}
		},
		"json"
	);
}

function getEmentorCount(iUserID){
	$.post(
		Drupal.settings.basePath+"instant/mentor/iMentorCount/"+iUserID,
		{
			ajax: '1'
		},
		function(sReply){
				$("#pagingHopefuls_"+iUserID).text(sReply.COUNT);
				$("#pagingHopefuls2_"+iUserID).text(sReply.COUNT);
		}, 
		"json"
	);
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
											'<tr><td colspan="2"><h3><b style="color:black;">Hello! My name is: ' + $(this).attr("alt") + '</b></h3><span stye="font-size:12px;">If you would like to Instant eMentor me then please click the "eMentor Now" button</span><br/><span style="color:#f9b164;">I have <span id="pagingHopefuls2_'+iUserId+'">loading</span> eMentors</span></td></tr>';
					
					for (i=0; i<aDetails.length; i++){
						if (aDetails[i].uid == iUserId){
							$("#incybrary_avatar")
								.unbind()
								.attr("src", $(this).attr("src"))
								.attr("alt", sUserName)
								.click(
									function(){
										var bOpenWin = confirm('This will open a new window/tab. Would you like to proceed?');
	
										if (bOpenWin){
											var oInstantUserWin = window.open(Drupal.settings.basePath+'user/'+iUserId, iUserId);
											
											if (window.focus) oInstantUserWin.focus();
										}
										
										/* $.post(
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
										); */
										
										
									}
								);
							
							sDescription += '<tr><td width="110">Language(s):</td><td class="info">' + ((isset(aDetails[i].language)) ? aDetails[i].language:'Not specified') + '</td></tr>';
							sDescription += '<tr><td>Talent(s):</td><td class="info">' + ((isset(aDetails[i].talent)) ? aDetails[i].talent:'Not specified') + '</td></tr>';
							sDescription += '<tr><td>Favorite(s):</td><td class="info">' + ((isset(aDetails[i].favorite)) ? aDetails[i].favorite:'Not specified') + '</td></tr>';
							sDescription += '<tr><td>Lives with:</td><td class="info">' + ((isset(aDetails[i].lives_with)) ? aDetails[i].lives_with:'Not specified') + '</td></tr>';
							sDescription += '<tr><td>Family Income:</td><td class="info">' + ((isset(aDetails[i].income)) ? aDetails[i].income:'Not specified') + ' per month</td></tr>';
							sDescription += '<tr><td colspan="2">&nbsp;</div></td></tr>';
							//sDescription += '<tr><td colspan="2"><div style="cursor:pointer;" onclick="location.href='+"'/instant/mentor/choose"+iUserId+"'"+';"><img src="/themes/theme2010/images/instant_ementor_now.png" border="0"/></div></td></tr>';
							sDescription += '<tr><td colspan="2"><div style="cursor:pointer;" onclick="saveChildredirect('+"'"+iUserId+"'"+')"><img src="'+Drupal.settings.basePath+'themes/theme2010/images/instant_ementor_now.png" border="0"/></div></td></tr>';
					
							break;
						}
					}
					getEmentorCount(iUserId);
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
			$("#incybrary_avatar").attr("src", Drupal.settings.basePath+"sites/default/files/pictures/none.png");
			$("#incybrary_hopeful_details").html("The selected child's description will go here.");
			
			$("#incybrary_hopeful_nav").html("&nbsp;");
			$("div#incybrary_hopeful_list").text("Fetching data...");
			
			var addGlobalSchool = '';
			
			if ($("#schoolSelectWebcam").length == 1 && $("#schoolSelectWebcam").val() !== ""){
			//if($("#schoolSelectWebcam").val() !== ""){
				addGlobalSchool = "/" + $("#schoolSelectWebcam").val();
			}

			var gender = $("#genderSelect").val();
			var ageselect = $("#ageSelect").val();
			
			$.post(
				Drupal.settings.basePath+"children/"+sRequestType + addGlobalSchool,
				{ 
				func: "GetChildren",
				gender : gender,
				ageselect: ageselect
				},
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

function activate_view(iUID, sName){
	/*var bOpenWin = confirm('This will open a new window/tab. Would you like to proceed?');
	
	if (bOpenWin){
		var oInstantUserWin = window.open(Drupal.settings.basePath+'user/'+iUID, iUID);
		
		if (window.focus) oInstantUserWin.focus();
	}*/

	 $.post(
		Drupal.settings.basePath + 'user/ext/profile/ajax/' + iUID,
		function( sReply ) {
			$('#page').hide();

			$('#hc_HopefulProfileContainer')
				.html( sReply )
				.dialog(
					{
						autoOpen: true,
						modal: false,
						draggable: false,
						height: 'auto',
						width: 'auto',
						position: { my: "top center", at: "top center", of: body },
						title: "Hopeful's Profile",
						buttons: {
							'Close': function(){
								$(this).dialog('close');
							}
						},
						close: function(event, ui){
							$('#page').show();

							// TODO - Set scroll position back to previous
						}
					}
				);

			// TODO - Get current scroll position
			
			window.scrollTo(0,0);
		}
	); 
	
	// $('#hc_HopefulProfileContainer')
	// 	.html('<iframe style="border:0px; width:100%; height:100%;" src="'+Drupal.settings.basePath+'user/'+iUID+'"></iframe>')
	// 	.dialog(
	// 		{
	// 			autoOpen: true,
	// 			modal: true,
	// 			height: 650,
	// 			width: 1030,
	// 			title: "Hopeful's Profile",
	// 			buttons: {
	// 				'Close': function(){
	// 					$(this).dialog('close');
	// 				}
	// 			}
	// 		}
	// 	)
	// 	.css('padding', '0');
	
	/* $.post(
		"/children/profile",
		{
			uid: iUID,
			user: sName
		},
		function(sReply){
			if (sReply.STATUS == 1){
				$("#hc_HopefulProfileContainer")
					.center()
					.css("zIndex", "9000")
					.show();
				
				alert("This feature is deprecated and has been disabled.");
				//$("#hc_HopefulProfile").attr("src", "http://affiliate.kickapps.com/service/displayKickPlace.kickAction?css=kickapps_theme2010&as=158175&u="+sReply.RETURN+"&location=community");
			}
		},
		"json"
	); */
}

function removeHopefulDashboard(){
	var global_remove_check = false;
	var global_remove_val = "";
	
	$("input[id=removeHopeful]").each(
		function(){
			if ($(this).is(':checked') == true){
				global_remove_check = true;
				global_remove_val += $(this).val()+'-';							
			}
		}
	);
	
	global_remove_val = global_remove_val.replace(/(\s+)?.$/, "");
	
	if (global_remove_check == false){
		alert("Please select a hopeful to delete.");
	}else{
		var bAnswer = confirm("Are you sure you want to remove this Hopeful from your list?");
		
		if (bAnswer){
				$.post(
					Drupal.settings.basePath+"instant/mentor/remove",
					{uids : global_remove_val},
					function(oReply){
						if(oReply.STATUS == true){
							alert("The hopeful was successfully removed.");
							location.href = Drupal.settings.basePath+"instant/mentor/dashboard";
						}
					},
					"json"
				);
		}
	}
}
