/* HUD JavaScript
 *	Modules dependent on:
 *		Bank, Kindness, Askeet (Instant Tutoring), Time Tracker
 */
// Bank variables
var mBankBalance = -1;
var bBankIniDetails = false;
var iPageRec = 10;
var iPageStart = 0;
var iPageEnd = iPageRec;
var oStatementRecs;
// Kindness variables
var iKindnessBalance = 0;
// Tutoring variables
var bTutorIniDetails = false;
var iTutorEnrollStatus = 0;
var iTutorPageRec = 3;
var iTutorPageStart = 0;
var iTutorPageEnd = iTutorPageRec;
var oQuestionRecs;
var iTutorCatId = 0;
var sTutorCatTitle = "";
var iTutorPostToday = 0;
var iTutorMaxPostPerDay = 0;
var mTutorPostCost = 0.25;
var iTutorPostLeft = 0;
var iTutorAskeetId;
// Time Tracking variables
var oHistoryRec;
// Kindness variables
var oApprovedRec;
var oPendingRec;
var flash;
var sPrevLang;
var hud_sBasePath = '/';

// Shows/Hides the applicable sub menus.
function Toggle(sDivId, bToggle){
	if (typeof bToggle == "undefined") sTag = false;
	
	$("div[id*=_sub]").each(
		function (){
			$("#"+this.id).hide();
		}
	);
	
	if (bToggle){
		$("#"+sDivId).toggle();
	}else{
		$("#"+sDivId).show();
	}
}

// Shows/Hides the Module's Content.
function ToggleContent(sContentType){
	switch (sContentType){
		case "hope_main":
		case "hope_main_generic":
		case "hope_main_generic_faq":
		case "hope_about_1st_hope_corps":
		case "hope_about_shuttle":
		case "hope_about_hopenet":
		case "hope_about_why_hope_corps":
		case "hope_about_legend":
		case "carousel":
			sImage = "scale.png";
			
			break;
		case "tutoring_form":
			sImage = "scale-banking_2.png";
			break;
		case "peace_virtues":
			sImage = "scale-banking_3.png";
			break;
		default:
			sImage = "scale-banking.png";
	}
	
	$("#wrapper").css("background", "url(hud_files/images/"+sImage+") top no-repeat");
	
	$(".jScrollPaneContainer div#hopenet_about_1st_hope_corps_text").parent().hide();
	$(".jScrollPaneContainer div#hopenet_about_shuttle_text").parent().hide();
	$(".jScrollPaneContainer div#mentoring_page_content_text").parent().hide();
	$(".jScrollPaneContainer div#profile_page_content_text").parent().hide();
	
	var bHopeMain = (sContentType.substring(0, 5) == "hope_") ? true:false;
	
	if (!bHopeMain) $("#hopenet_main_content").hide();
	$("#kindness_content_about").hide();
	$("#kindness_content_dashboard").hide();
	$("#kindness_content_convert").hide();
	$("#kindness_content_pending_approved").hide();
	$("#kindness_content_form").hide();
	
	$("#time_tracker_content").hide();
	
	$("#tutoring_content_ini").hide();
	$("#tutoring_content_private").hide();
	$("#tutoring_content_get_started").hide();
	$("#tutoring_content_ask_form").hide();
	$("#tutoring_content_about").hide();
	$("#my_communication_content_about").hide();
	$("#generic_page_content").hide();
	
	$("#my_profile_content_about").hide();
	$("#my_profile_content_about_container").hide();
	
	$("#tree_menu").hide();
	$("#toggle_buttons").hide();
	$("#etree_menu").hide();
	$("#toggle_ebuttons").hide();
	
	if ((sContentType.substr(0, 4) == "bank" || sContentType.substr(0, 8) == "kindness") && !bBankIniDetails){
		Bank_GetDetails();
		Bank_SetWithdrawSend();
		Bank_SetDepositConvert();
		bBankIniDetails = true;
	}
	

	switch (sContentType){
		case "my_communcation_about":
			$("#content_breadcrumb").html('HUD &gt; My Communication');
			$("#my_communication_content_about").show();
			
			if ($(".jScrollPaneContainer div#communication_page_content_text").parent().length == 0){
				$("div#communication_page_content_text").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}else{
				$(".jScrollPaneContainer div#communication_page_content_text").parent().show();
			}
		break;
		case "generic":
		$("#my_communication_content_about").hide();
        $("#generic_page_content").show();
		break;
		case "message_1":
		$("#my_communication_content_about").hide();
		$("#generic_page_content").show();
        message_access(1);
		break;
		case "message_2":
		$("#my_communication_content_about").hide();
		$("#generic_page_content").show();
        message_access(2);
		break;
		case "message_3":
		$("#my_communication_content_about").hide();
		$("#generic_page_content").show();
        message_access(3);
		break;
		case "message_4":
		$("#my_communication_content_about").hide();
		$("#generic_page_content").show();
        message_access(4);
		break;
		case "message_5":
		$("#my_communication_content_about").hide();
		$("#generic_page_content").show();
        message_access(5);
		break;
		case "message_6":
		$("#my_communication_content_about").hide();
		$("#generic_page_content").show();
        message_access(6);
		break;
		case "kindness_about":
			$("#content_breadcrumb").html('HUD &gt; Kindness &gt; About');
			$("#kindness_content_about").show();
			
			if ($(".jScrollPaneContainer div#kindness_about_text").parent().length == 0){
				$("div#kindness_about_text").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}
			
			break;
		case "kindness_dashboard":
			$("#content_breadcrumb").html('HUD &gt; Kindness');
			Kindness_GetDashboard();
			Kindness_GetApproved();
			//Kindness_GetPending();
			$("#kindness_content_dashboard").show();
			
			if ($(".jScrollPaneContainer div#kindness_status_text").parent().length == 0){
				$("div#kindness_status_text").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}
			
			break;
		case "kindness_convert":
			$("#content_breadcrumb").html('HUD &gt; Kindness &gt; Convert');
			Kindness_GetDetails("kindness");
			//Kindness_SetConvert();
	
			$("#kindness_content_convert").show();
			
			break;
		/* case "kindness_pending_approved":
			$("#content_breadcrumb").html('HUD &gt; Kindness &gt; Pending/Approved');
			Kindness_GetApproved();
			Kindness_GetPending();
			$("#kindness_content_pending_approved").show();
			
			break; */
		case "kindness_form":
			$("#content_breadcrumb").html('HUD &gt; Kindness &gt; Report');
			$("#kindness_content_form").show();
			
			if ($(".jScrollPaneContainer div#kindness_form_text").parent().length == 0){
				$("div#kindness_form_text").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}
			
			break;
	}
}

// --BEGIN Bank functions
// ------------------------------------------------------------
function Bank_GetDetails(){
	$.post(
		hud_sBasePath+"hopebank/callback/details",
		{ func: "bank_details" },
		function(sReply){
			$("span#bank_account").text(sReply.ACCOUNT);
			$("span#bank_pending").text(sReply.BALANCES.PENDING);
			$("span#bank_turnover").text(sReply.BALANCES.TURNOVER);
			mBankBalance = parseFloat(sReply.BALANCES.BALANCE);
			
			$("span[id^=bank_balance]").each(
				function (){
					$(this).text(mBankBalance);
				}
			);
		},
		"json"
	);
}

function Bank_GetStatement(){
	$.post(
		hud_sBasePath+"hopebank/callback/statement",
		{ func: "bank_statement" },
		function(sReply){
			if (sReply.STATUS == "Success"){
				iPageStart = 0;
				iPageEnd = iPageRec;
				oStatementRecs = sReply.RETURN;
				
				var oStatement = sReply.RETURN;
				var iRecCount = oStatement.length;
				var sContent = '';
				var sTransactType = '';
				var sDescription = '';
				
				for (i=iPageStart; i<iPageEnd && i<iRecCount; i++){
					sTransactType = oStatement[i].sTransactType;
					sDescription = oStatement[i].sTransactDesc;
					
					sContent += '<tr><td style="vertical-align:top;">'+oStatement[i].dTransactTime+'</td><td style="vertical-align:top;">'+sTransactType.toUpperCase()+'</td><td>'+sDescription+'</td><td style="vertical-align:top; text-align:right; padding-right:5px;">'+oStatement[i].mTransactAmount+'</td></tr>';
				}
				
				var sHeader = '<table id="table_statement" style="width:100%;"><tr><td style="width:25%;">Date<td style="width:10%;">Type</td><td style="width:55%;">Description</td><td style="text-align:right; padding-right:5px;">Amount</td></tr>';
				var sFooterPaged = '<tr><td colspan="4" style="text-align:center;"><button id="btnPrev" class="button" onclick="_Bank_PageStatement(\'prev\', '+iRecCount+')">Previous</button>&nbsp;<button id="btnNext" class="button" onclick="_Bank_PageStatement(\'next\', '+iRecCount+')">Next</button></td></tr></table>';
				var sFooterPlain = '</table>';
				
				var sFooter = (iRecCount > iPageRec) ? sFooterPaged:sFooterPlain;
				
				$("#bank_statement_list").html(sHeader+sContent+sFooter);
				
				if (iPageStart == 0) $("button#btnPrev").hide();
				if (iPageEnd == iRecCount) $("button#btnNext").hide();
			}
		},
		"json"
	);
}

function _Bank_PageStatement(sDirection, iTotalRec){
	if (sDirection == "next"){
		iPageStart += iPageRec;
		iPageEnd += iPageRec;
		
		if (iPageEnd > iTotalRec) iPageEnd = iTotalRec;
	}else{
		iPageStart -= iPageRec;
		
		iOffSet = iPageEnd % iPageRec;

		if (iOffSet == 0){
			iPageEnd -= iPageRec;
		}else{
			iPageEnd -= iOffSet;
		}
		
		if (iPageStart < 0) iPageStart = 0;
	}
	
	var sContent = '';
	var sTransactType = '';
	var sDescription = '';
	
	for (i=iPageStart; i<iPageEnd && i<iTotalRec; i++){
		var oRec = oStatementRecs[i];
		sTransactType = oRec.sTransactType;
		sDescription = oRec.sTransactDesc;
		
		sContent += '<tr><td style="vertical-align:top;">'+oRec.dTransactTime+'</td><td style="vertical-align:top;">'+sTransactType.toUpperCase()+'</td><td>'+sDescription+'</td><td style="vertical-align:top; text-align:right; padding-right:5px;">'+oRec.mTransactAmount+'</td></tr>';
	}
	
	var sHeader = '<table id="table_statement" style="width:100%;"><tr><td style="width:25%;">Date<td style="width:10%;">Type</td><td style="width:55%;">Description</td><td style="text-align:right; padding-right:5px;">Amount</td></tr>';
	var sFooterPaged = '<tr><td colspan="4" style="text-align:center;"><button id="btnPrev" class="button" onclick="_Bank_PageStatement(\'prev\', '+iTotalRec+')">Previous</button>&nbsp;<button id="btnNext" class="button" onclick="_Bank_PageStatement(\'next\', '+iTotalRec+')">Next</button></td></tr></table>';
	var sFooterPlain = '</table>';
	
	var sFooter = (iTotalRec > iPageRec) ? sFooterPaged:sFooterPlain;
	
	$("#bank_statement_list").html(sHeader+sContent+sFooter);
	
	if (iPageStart == 0) $("button#btnPrev").hide();
	if (iPageEnd == iTotalRec) $("button#btnNext").hide();
}

function Bank_SetWithdrawSend(){
	$("#btnBankWithdrawSend").click(
		function (){
			var sAlertMsg = "Please check the following:\n";
			var iAlertMsgLen = sAlertMsg.length;
			
			var mBankSendAmount = $("#mBankSendAmount").val();
			var sBankSendToAccount = jQuery.trim($("#sBankToAccount1").val()) + "-" + jQuery.trim($("#sBankToAccount2").val());
			var bBankForTrueCafe = ($('[name=bBankForTrueCafe]').attr('checked')) ? 1:0;
			
			if (mBankSendAmount > mBankBalance) sAlertMsg += " - The amount you can send should not be more than your current balance (H$"+mBankBalance+").\n";
			if (!is_numeric(mBankSendAmount) || mBankSendAmount <= 0) sAlertMsg += " - You must specify a valid amount to send.\n";
			if (sBankSendToAccount == "-")  sAlertMsg += " - You must specify an account number to send the funds to.\n";
			
			if (iAlertMsgLen < sAlertMsg.length){
				alert(sAlertMsg);
			}else{
				$("#btnBankWithdrawSend").val("Wait...").attr("disabled", "true");
				
				$.post(
					hud_sBasePath+"hopebank/callback/send",
					{
						mAmount: mBankSendAmount,
						sAccount: sBankSendToAccount,
						bForTrueCafe: bBankForTrueCafe
					},
					function(sReply){
						if (sReply.STATUS == "Success") Bank_GetDetails();
						
						$("#mBankSendAmount").val("");
						$("#sBankToAccount1").val("");
						$("#sBankToAccount2").val("");
						$('[name=bBankForTrueCafe]').attr('checked', '');
						$("#btnBankWithdrawSend").val("Send").attr("disabled", "");
						
						alert(sReply.RETURN);
					},
					"json"
				);
			}
		}
	);
}

function Bank_SetDepositConvert(){
	$("#btnBankDeposit")
		.unbind("click")
		.click(
			function (){
				_Bank_SetButtonConvert("iTimeToConvert");
			}
		);
}

function _Bank_SetButtonConvert(sThisField){
	var iTimeToConvert = $("#"+sThisField).val();

	if (is_numeric(iTimeToConvert) && iTimeToConvert <= iKindnessBalance){
		//$("#btnBankDeposit").val("Wait...").attr("disabled", "true");
		$("#btnKindnessConvert").val("Wait...").attr("disabled", "true");
		
		$.post(
			hud_sBasePath+"kindness/callback/convert",
			{iTime: iTimeToConvert},
			function(sReply){
				if (sReply.STATUS == "Success"){
					alert("Convertion Successful!");
					Kindness_GetDetails("bank");
					Kindness_GetDetails("kindness");
					Bank_GetDetails();
				} else{
					alert(sReply.RETURN);
				}
				
				//$("#btnBankDeposit").val("Convert To Valiants").attr("enabled", "");
				$("#btnKindnessConvert").val("Convert To Valiants").attr("disabled", "");
				$("#bank_deposit_status").text(sReply.RETURN);
			},
			"json"
		);
	} else{
		if (!is_numeric(iTimeToConvert)) alert("You have specified an invalid number. Example correct entries: 1, 1.5, 0.25, etc.");
		if (iTimeToConvert > iKindnessBalance) alert("The time you can convert cannot excees your accumulated time ("+iKindnessBalance+").")
	}
}
// ------------------------------------------------------------
// --END Bank functions


// --BEGIN Kindness functions
// ------------------------------------------------------------
function Kindness_ApproveTitle2(id){
$.ajax({
		url: 'kindness/details2/' + id + '/true/' + $("#env_pop").val(),
		  dataType: 'text',
		  success: function(data) {
			$("#hud_KSText").html(data);
		  },
		  error: function() {
				$("#hud_KSText").html("There was a problem with your request<br />");  
		  }
		});
document.getElementById('KSPopUp').style.display = 'block';
}

function Kindness_EditReport(type, id){

    var sAlertMsg = "Please check the following:\n";
	var iAlertMsgLen = sAlertMsg.length;
	
	var sKindnessTitle = $("#sTitle").val();
	var sKindnessDesc = $("#sDescription").val();
	var sKindnessLocation = $("#sLocation").val();
	var sKindnessWhom = $("#sWhom").val();
	var iKindnessHour = $("#iHour").val();
	var iKindnessMinute = $("#iMinute").val();
	var iKindnessDay = $("#iDay").val();
	var iKindnessMonth = $("#iMonth").val();
	var iKindnessYear = $("#iYear").val();
	var sKindnessRecipientType = $("#sRecipientType").val();
	
	if (jQuery.trim(sKindnessTitle) == "") sAlertMsg += " - title of your good Deed\n";
	if (jQuery.trim(sKindnessDesc) == "") sAlertMsg += " - descriptiion of your good Deed\n";
	if (iKindnessHour == 0 && iKindnessMinute == 0) sAlertMsg += " - a valid time for the Duration (hours) and (minutes)\n";
	if (jQuery.trim(sKindnessWhom) == "") sAlertMsg += " - the name of the person you did the Good Deed for\n";
	if (jQuery.trim(sKindnessLocation) == "") sAlertMsg += " - the location where you did your Good Deed\n";
	if (sKindnessRecipientType == "") sAlertMsg += " - your relationship to whom you did the Good Deed for";
	
	if (iAlertMsgLen < sAlertMsg.length){
		alert(sAlertMsg);
	}else{
		$("#btnKindnessSubmit2").text("Wait...").attr("disabled", "true");
		$.post(
			hud_sBasePath+"kindness/callback/edit",
			{
				sKindnessTitle: sKindnessTitle,
				sKindnessDesc: sKindnessDesc,
				sKindnessWhom: sKindnessWhom,
				sKindnessLocation: sKindnessLocation,
				iKindnessHour:iKindnessHour,
				iKindnessMinute: iKindnessMinute,
				sKindnessRecipientType: sKindnessRecipientType,
				sKindnessSubmitID: id,
				iKindnessDay: iKindnessDay,
				iKindnessMonth: iKindnessMonth,
				iKindnessYear: iKindnessYear,
				iKindnessType: type

			},
			function(sReply){
				if (sReply.STATUS == "Success"){
				$("#hud_KSText").html(sReply.RETURN);
				
				javascript:ToggleContent('kindness_dashboard');
				} else{
				$("#hud_KSText").html(sReply.RETURN);  
				}
			},
			"json"
		);
	}
document.getElementById('KSPopUp').style.display = 'block'
}

function Kindness_GetDetails(sWhich){
	$.post(
		hud_sBasePath+"kindness/callback/details",
		{func: "kindness_details"},
		function(sReply){
			iKindnessBalance = sReply.RETURN.HOURS;
			var sKindnessNotice = sReply.RETURN.NOTICE;
			if (sWhich == "bank"){
				$("#bank_deposit_notice").text(sKindnessNotice);
			}else{
				$("#kindness_details_panel").each(
					function (){
						$(this).text(sKindnessNotice);
					}
				);
			}
		},
		"json"
	);
}

function Kindness_SetConvert(){
	/*$("#btnKindnessConvert")
		.unbind("click")
		.click(
			function (){
				//$("#btnKindnessConvert").hide();
				//$("#btnKindnessConvert").show();
				//$("#btnKindnessConvert").val("Wait..").attr("disabled", "disabled");
				_Bank_SetButtonConvert("iKindnessToConvert");
			}
		);*/
	_Bank_SetButtonConvert("iKindnessToConvert");	
		
}

function Kindness_GetDashboard(){
   $.post(
		hud_sBasePath+"kindness/callback/dash2",
		{func: "kindness_dash",
		 uid : $("#uid_pop").val(),
		 env : $("#env_pop").val()
		},
		function(sReply){
			$("#kindness_dashboard_details").html(sReply.RETURN);
		},
		"json"
	);
}

function Kindness_SetFormSubmit(){
	var sAlertMsg = "Please check the following:\n";
	var iAlertMsgLen = sAlertMsg.length;
	
	var sKindnessTitle = $("#sTitle").val();
	var sKindnessDesc = $("#sDescription").val();
	var sKindnessLocation = $("#sLocation").val();
	var sKindnessWhom = $("#sWhom").val();
	var iKindnessHour = $("#iHour").val();
	var iKindnessMinute = $("#iMinute").val();
	var iKindnessDay = $("#iDay").val();
	var iKindnessMonth = $("#iMonth").val();
	var iKindnessYear = $("#iYear").val();
	var sKindnessRecipientType = $("#sRecipientType").val();
	var iForTruePromise = ($('[name=kindness_promise]').attr('checked')) ? 1:0;
	
	
	
	if (jQuery.trim(sKindnessTitle) == "") sAlertMsg += " - title of your good Deed\n";
	if (jQuery.trim(sKindnessDesc) == "") sAlertMsg += " - descriptiion of your good Deed\n";
	//if (iKindnessHour == 0 && iKindnessMinute) sAlertMsg += " - a valid time for the Duration (hours) and (minutes)\n";
	if (iKindnessHour == 0 && iKindnessMinute == 0) sAlertMsg += " - a valid time for the Duration (hours) and (minutes)\n";
	if (jQuery.trim(sKindnessWhom) == "") sAlertMsg += " - the name of the person you did the Good Deed for\n";
	if (jQuery.trim(sKindnessLocation) == "") sAlertMsg += " - the location where you did your Good Deed\n";
	if (iForTruePromise == 0) sAlertMsg += " - you must promise that this Good Deed is true\n";
	if (sKindnessRecipientType == "") sAlertMsg += " - your relationship to whom you did the Good Deed for";
	
	if (iAlertMsgLen < sAlertMsg.length){
		alert(sAlertMsg);
	}else{
		$("#btnKindnessSubmit").text("Wait...").attr("disabled", "true");
		
		$.post(
			hud_sBasePath+"kindness/callback/form",
			{
				sKindnessTitle: sKindnessTitle,
				sKindnessDesc: sKindnessDesc,
				iForTruePromise: iForTruePromise,
				sKindnessWhom: sKindnessWhom,
				sKindnessLocation: sKindnessLocation,
				iKindnessHour:iKindnessHour,
				iKindnessMinute: iKindnessMinute,
				sKindnessRecipientType: sKindnessRecipientType,
				iKindnessDay: iKindnessDay,
				iKindnessMonth: iKindnessMonth,
				iKindnessYear: iKindnessYear

			},
			function(sReply){
				if (sReply.STATUS == "Success"){
					Bank_GetDetails();
					
					$("#btnKindnessSubmit").text("Submit Kindness Form").attr("disabled", "");
					$("#sTitle").val("");
					$("#sDescription").val("");
					$("#sLocation").val("");
					$("#sWhom").val("");
					$("#iHour").val("");
					$("#iMinute").val("");
					$("#iRecipientType").val("");
					$('[name=kindness_promise]').attr('checked', '');
				}
			
				alert(sReply.RETURN);
			},
			"json"
		);
	}
		
}

function Kindness_GetApproved(){
	$.post(
		hud_sBasePath+"kindness/callback/workz2",
		{func: "kindness_approved",
		 uid : $("#uid_pop").val(),
		 env : $("#env_pop").val()},
		function(sReply){
			iPageStart = 0;
			iPageEnd = iPageRec;
			
		    /* custom added */
			oApprovedRec = sReply.RETURN;
			sApproved =  sReply.RETURN;
			
			var iRecCount = sApproved.length;
			var sContent = '';
			
			for (i=iPageStart; i<iPageEnd && i<iRecCount; i++){
				sContent += sApproved[i];
			}
			
			var sFooterPaged = '<div class="pending_top_txt"><div class="pending_top_title_1">&nbsp;&nbsp;</div><div class="pending_top_duration_1"><button id="btnPrev" class="button" onclick="_Kindness_PageApproved(\'prev\', '+iRecCount+')">Previous</button></div><div class="pending_top_date_1">&nbsp;<button id="btnNext" class="button" onclick="_Kindness_PageApproved(\'next\', '+iRecCount+')">Next</button></div><div class="pending_top_date_approvd_1">&nbsp;&nbsp;</div></div>';
			var sFooterPlain = '';
			var sFooter = (iRecCount > iPageRec) ? sFooterPaged:sFooterPlain;
			
			$("#kindness_approved_list").html(sContent + sFooter);
			
			if (iPageStart == 0) $("button#btnPrev").hide();
			if (iPageEnd == iRecCount) $("button#btnNext").hide();
		},
		"json"
	);
}

function testjedjed(){
	alert('test');
}

function _Kindness_PageApproved(sDirection, iTotalRec){
	if (sDirection == "next"){
		iPageStart += iPageRec;
		iPageEnd += iPageRec;
		
		if (iPageEnd > iTotalRec) iPageEnd = iTotalRec;
	} else{
		iPageStart -= iPageRec;
		
		iOffSet = iPageEnd % iPageRec;

		if (iOffSet == 0){
			iPageEnd -= iPageRec;
		}else{
			iPageEnd -= iOffSet;
		}
		
		if (iPageStart < 0) iPageStart = 0;
	}
	
	var sContent = '';
	
	for (i=iPageStart; i<iPageEnd && i<iTotalRec; i++){
			
		sContent += oApprovedRec[i];
	}
	
	var sFooterPaged = '<div class="pending_top_txt"><div class="pending_top_title_1">&nbsp;&nbsp;</div><div class="pending_top_duration_1"><button id="btnPrev" class="button"onclick="_Kindness_PageApproved(\'prev\', '+iTotalRec+')">Previous</button></div><div class="pending_top_date_1">&nbsp;<button id="btnNext" class="button" onclick="_Kindness_PageApproved(\'next\', '+iTotalRec+')">Next</button></div><div class="pending_top_date_approvd_1">&nbsp;&nbsp;</div></div>';
	var sFooterPlain = '';
	
	var sFooter = (iTotalRec > iPageRec) ? sFooterPaged:sFooterPlain;
	
	$("#kindness_approved_list").html(sContent + sFooter);
	
	if (iPageStart == 0) $("button#btnPrev").hide();
	if (iPageEnd == iTotalRec) $("button#btnNext").hide();
}

function Kindness_GetPending(){
	$.post(
		hud_sBasePath+"kindness/callback/pending",
		{func: "kindness_list"},
		function(sReply){
		    iPageStart = 0;
			iPageEnd = iPageRec;
			
			/* custom added */
			oPendingRec = sReply.RETURN;
			sPending =  sReply.RETURN;
			
			var iRecCount = sPending.length;
			var sContent = '';
			
			for (i=iPageStart; i<iPageEnd && i<iRecCount; i++){
				sContent += sPending[i];
			}
			
			var sFooterPaged = '<div class="pending_top_txt"><div class="pending_top_title_1">&nbsp;&nbsp;</div><div class="pending_top_duration_1"><button id="btnPrev" class="button" onclick="_Kindness_PagePending(\'prev\', '+iRecCount+')">Previous</button></div><div class="pending_top_date_1">&nbsp;<button id="btnNext" class="button" onclick="_Kindness_PagePending(\'next\', '+iRecCount+')">Next</button></div></div>';
			var sFooterPlain = '';
			var sFooter = (iRecCount > iPageRec) ? sFooterPaged:sFooterPlain;
			
			$("#kindness_pending_list").html(sContent + sFooter);
			
			if (iPageStart == 0) $("button#btnPrev").hide();
			if (iPageEnd == iRecCount) $("button#btnNext").hide();
		},
		"json"
	);
}

function _Kindness_PagePending(sDirection, iTotalRec){
	if (sDirection == "next"){
		iPageStart += iPageRec;
		iPageEnd += iPageRec;
		
		if (iPageEnd > iTotalRec) iPageEnd = iTotalRec;
	} else{
		iPageStart -= iPageRec;
		
		iOffSet = iPageEnd % iPageRec;

		if (iOffSet == 0){
			iPageEnd -= iPageRec;
		}else{
			iPageEnd -= iOffSet;
		}
		
		if (iPageStart < 0) iPageStart = 0;
	}
	
	var sContent = '';
	
	for (i=iPageStart; i<iPageEnd && i<iTotalRec; i++){
			
		sContent += oPendingRec[i];
	}
	
	var sFooterPaged = '<div class="pending_top_txt"><div class="pending_top_title_1">&nbsp;&nbsp;</div><div class="pending_top_duration_1"><button id="btnPrev" class="button"onclick="_Kindness_PagePending(\'prev\', '+iTotalRec+')">Previous</button></div><div class="pending_top_date_1">&nbsp;<button id="btnNext" class="button" onclick="_Kindness_PagePending(\'next\', '+iTotalRec+')">Next</button></div></div>';
	var sFooterPlain = '';
	var sFooter = (iTotalRec > iPageRec) ? sFooterPaged:sFooterPlain;
	
	$("#kindness_pending_list").html(sContent + sFooter);
	
	if (iPageStart == 0) $("button#btnPrev").hide();
	if (iPageEnd == iTotalRec) $("button#btnNext").hide();
}
// ------------------------------------------------------------
// --END Kindness functions

// --BEGIN Reusable functions
// ------------------------------------------------------------
function GetQuerystring(sKey, sDefault){
	if (sDefault == null) sDefault = "";
	
	sKey = sKey.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
	
	var regex = new RegExp("[\\?&]" + sKey + "=([^&#]*)");
	var aQS = regex.exec(window.location.href);
	
	return (aQS == null) ? sDefault:aQS[1];
}

// Return the current width of the browser.
function GetWindowWidth(){
	return GetWindowDimension().w;
}

function GetWindowDimension(){
	if (parseInt(navigator.appVersion) > 3) {
		if (navigator.appName == "Netscape") {
			iWinW = window.innerWidth;
			iWinH = window.innerHeight;
		}
		
		if (navigator.appName.indexOf("Microsoft") != -1) {
			iWinW = document.body.offsetWidth;
			iWinH = document.body.offsetHeight;
		}
	}
	
	return {w:iWinW, h:iWinH};
}

// Returns true if value is a number or a numeric string.
function is_numeric(mixed_var){ 
	if (mixed_var === '') return false;

	return !isNaN(mixed_var * 1);
}

// Uppercase the first character of every word in a string.
function ucwords(str){
	return (str+'').replace(/^(.)|\s(.)/g, function ($1){ return $1.toUpperCase(); });
}

// Formats a number with grouped thousands.
function number_format(number, decimals, dec_point, thousands_sep){
	var n = number, prec = decimals;

	var toFixedFix = function (n,prec){
		var k = Math.pow(10,prec);
		return (Math.round(n*k)/k).toString();
	};

	n = !isFinite(+n) ? 0 : +n;
	prec = !isFinite(+prec) ? 0 : Math.abs(prec);
	
	var sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep;
	var dec = (typeof dec_point === 'undefined') ? '.' : dec_point;
	var s = (prec > 0) ? toFixedFix(n, prec) : toFixedFix(Math.round(n), prec); //fix for IE parseFloat(0.55).toFixed(0) = 0;
	var abs = toFixedFix(Math.abs(n), prec);
	var _, i;

	if (abs >= 1000){
		_ = abs.split(/\D/);
		i = _[0].length % 3 || 3;

		_[0] = s.slice(0,i + (n < 0)) +
		_[0].slice(i).replace(/(\d{3})/g, sep+'$1');
		s = _.join(dec);
	}else{
		s = s.replace('.', dec);
	}
	
	var decPos = s.indexOf(dec);
	
	if (prec >= 1 && decPos !== -1 && (s.length-decPos-1) < prec){
		s += new Array(prec-(s.length-decPos-1)).join(0)+'0';
	}else if (prec >= 1 && decPos === -1){
		s += dec+new Array(prec).join(0)+'0';
	}
	
	return s;
}

// Prints out or returns information about the specified variable.
// Dependencies: echo
function print_r(array, return_val){
    var output = "", pad_char = " ", pad_val = 4, d = this.window.document;
    var getFuncName = function (fn) {
        var name = (/\W*function\s+([\w\$]+)\s*\(/).exec(fn);
        if (!name) {
            return '(Anonymous)';
        }
        return name[1];
    };

    var repeat_char = function (len, pad_char) {
        var str = "";
        for (var i=0; i < len; i++) {
            str += pad_char;
        }
        return str;
    };

    var formatArray = function (obj, cur_depth, pad_val, pad_char) {
        if (cur_depth > 0) {
            cur_depth++;
        }

        var base_pad = repeat_char(pad_val*cur_depth, pad_char);
        var thick_pad = repeat_char(pad_val*(cur_depth+1), pad_char);
        var str = "";

        if (typeof obj === 'object' && obj !== null && obj.constructor && getFuncName(obj.constructor) !== 'PHPJS_Resource') {
            str += "Array\n" + base_pad + "(\n";
            for (var key in obj) {
                if (obj[key] instanceof Array) {
                    str += thick_pad + "["+key+"] => "+formatArray(obj[key], cur_depth+1, pad_val, pad_char);
                } else {
                    str += thick_pad + "["+key+"] => " + obj[key] + "\n";
                }
            }
            str += base_pad + ")\n";
        } else if (obj === null || obj === undefined) {
            str = '';
        } else { // for our "resource" class
            str = obj.toString();
        }

        return str;
    };

    output = formatArray(array, 0, pad_val, pad_char);

    if (return_val !== true) {
        if (d.body) {
            this.echo(output);
        }
        else {
            try {
                d = XULDocument; // We're in XUL, so appending as plain text won't work; trigger an error out of XUL
                this.echo('<pre xmlns="http://www.w3.org/1999/xhtml" style="white-space:pre;">'+output+'</pre>');
            }
            catch (e) {
                this.echo(output); // Outputting as plain text may work in some plain XML
            }
        }
        return true;
    } else {
        return output;
    }
}

function echo(){
    // !No description available for echo. @php.js developers: Please update the function summary text file.
    // 
    // version: 909.322
    // discuss at: http://phpjs.org/functions/echo
    // +   original by: Philip Peterson
    // +   improved by: echo is bad
    // +   improved by: Nate
    // +    revised by: Der Simon (http://innerdom.sourceforge.net/)
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   bugfixed by: Eugene Bulkin (http://doubleaw.com/)
    // +   input by: JB
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // %        note 1: If browsers start to support DOM Level 3 Load and Save (parsing/serializing),
    // %        note 1: we wouldn't need any such long code (even most of the code below). See
    // %        note 1: link below for a cross-browser implementation in JavaScript. HTML5 might
    // %        note 1: possibly support DOMParser, but that is not presently a standard.
    // %        note 2: Although innerHTML is widely used and may become standard as of HTML5, it is also not ideal for
    // %        note 2: use with a temporary holder before appending to the DOM (as is our last resort below),
    // %        note 2: since it may not work in an XML context
    // %        note 3: Using innerHTML to directly add to the BODY is very dangerous because it will
    // %        note 3: break all pre-existing references to HTMLElements.
    // *     example 1: echo('<div><p>abc</p><p>abc</p></div>');
    // *     returns 1: undefined
    var arg = '', argc = arguments.length, argv = arguments, i = 0;
    var win = this.window;
    var d = win.document;
    var ns_xhtml = 'http://www.w3.org/1999/xhtml';
    var ns_xul = 'http://www.mozilla.org/keymaster/gatekeeper/there.is.only.xul'; // If we're in a XUL context

    var holder;

    var stringToDOM = function (str, parent, ns, container) {
        var extraNSs = '';
        if (ns === ns_xul) {
            extraNSs = ' xmlns:html="'+ns_xhtml+'"';
        }
        var stringContainer = '<'+container+' xmlns="'+ns+'"'+extraNSs+'>'+str+'</'+container+'>';
        if (win.DOMImplementationLS &&
            win.DOMImplementationLS.createLSInput &&
            win.DOMImplementationLS.createLSParser) { // Follows the DOM 3 Load and Save standard, but not
            // implemented in browsers at present; HTML5 is to standardize on innerHTML, but not for XML (though
            // possibly will also standardize with DOMParser); in the meantime, to ensure fullest browser support, could
            // attach http://svn2.assembla.com/svn/brettz9/DOMToString/DOM3.js (see http://svn2.assembla.com/svn/brettz9/DOMToString/DOM3.xhtml for a simple test file)
            var lsInput = DOMImplementationLS.createLSInput();
            // If we're in XHTML, we'll try to allow the XHTML namespace to be available by default
            lsInput.stringData = stringContainer;
            var lsParser = DOMImplementationLS.createLSParser(1, null); // synchronous, no schema type
            return lsParser.parse(lsInput).firstChild;
        }
        else if (win.DOMParser) {
            // If we're in XHTML, we'll try to allow the XHTML namespace to be available by default
            return new DOMParser().parseFromString(stringContainer, 'text/xml').documentElement.firstChild;
        }
        else if (win.ActiveXObject) { // We don't bother with a holder in Explorer as it doesn't support namespaces
            var d = new ActiveXObject('MSXML2.DOMDocument');
            d.loadXML(str);
            return d.documentElement;
        }
        /*else if (win.XMLHttpRequest) { // Supposed to work in older Safari
            var req = new win.XMLHttpRequest;
            req.open('GET', 'data:application/xml;charset=utf-8,'+encodeURIComponent(str), false);
            if (req.overrideMimeType) {
                req.overrideMimeType('application/xml');
            }
            req.send(null);
            return req.responseXML;
        }*/
        else { // Document fragment did not work with innerHTML, so we create a temporary element holder
            // If we're in XHTML, we'll try to allow the XHTML namespace to be available by default
            //if (d.createElementNS && (d.contentType && d.contentType !== 'text/html')) { // Don't create namespaced elements if we're being served as HTML (currently only Mozilla supports this detection in true XHTML-supporting browsers, but Safari and Opera should work with the above DOMParser anyways, and IE doesn't support createElementNS anyways)
            if (d.createElementNS &&  // Browser supports the method
                d.documentElement.namespaceURI && (d.documentElement.namespaceURI !== null || // We can use if the document is using a namespace
                d.documentElement.nodeName.toLowerCase() !== 'html' || // We know it's not HTML4 or less, if the tag is not HTML (even if the root namespace is null)
                (d.contentType && d.contentType !== 'text/html') // We know it's not regular HTML4 or less if this is Mozilla (only browser supporting the attribute) and the content type is something other than text/html; other HTML5 roots (like svg) still have a namespace
            )) { // Don't create namespaced elements if we're being served as HTML (currently only Mozilla supports this detection in true XHTML-supporting browsers, but Safari and Opera should work with the above DOMParser anyways, and IE doesn't support createElementNS anyways); last test is for the sake of being in a pure XML document
                holder = d.createElementNS(ns, container);
            }
            else {
                holder = d.createElement(container); // Document fragment did not work with innerHTML
            }
            holder.innerHTML = str;
            while (holder.firstChild) {
                parent.appendChild(holder.firstChild);
            }
            return false;
        }
        // throw 'Your browser does not support DOM parsing as required by echo()';
    };


    var ieFix = function (node) {
        if (node.nodeType === 1) {
            var newNode = d.createElement(node.nodeName);
            var i, len;
            if (node.attributes && node.attributes.length > 0) {
                for (i = 0, len = node.attributes.length; i < len; i++) {
                    newNode.setAttribute(node.attributes[i].nodeName, node.getAttribute(node.attributes[i].nodeName));
                }
            }
            if (node.childNodes && node.childNodes.length > 0) {
                for (i = 0, len = node.childNodes.length; i < len; i++) {
                    newNode.appendChild(ieFix(node.childNodes[i]));
                }
            }
            return newNode;
        }
        else {
            return d.createTextNode(node.nodeValue);
        }
    };

    for (i = 0; i < argc; i++ ) {
        arg = argv[i];
        if (this.php_js && this.php_js.ini && this.php_js.ini['phpjs.echo_embedded_vars']) {
            arg = arg.replace(/(.?)\{\$(.*?)\}/g, function (s, m1, m2) { 
                // We assume for now that embedded variables do not have dollar sign; to add a dollar sign, you currently must use {$$var} (We might change this, however.)
                // Doesn't cover all cases yet: see http://php.net/manual/en/language.types.string.php#language.types.string.syntax.double
                if (m1 !== '\\') {
                    return m1+eval(m2);
                }
                else {
                    return s;
                }
            });
        }
        if (d.appendChild) {
            if (d.body) {
                if (win.navigator.appName == 'Microsoft Internet Explorer') { // We unfortunately cannot use feature detection, since this is an IE bug with cloneNode nodes being appended
                    d.body.appendChild(ieFix(stringToDOM(arg)));
                }
                else {
                    var unappendedLeft = stringToDOM(arg, d.body, ns_xhtml, 'div').cloneNode(true); // We will not actually append the div tag (just using for providing XHTML namespace by default)
                    if (unappendedLeft) {
                        d.body.appendChild(unappendedLeft);
                    }
                }
            } else {
                d.documentElement.appendChild(stringToDOM(arg, d.documentElement, ns_xul, 'description')); // We will not actually append the description tag (just using for providing XUL namespace by default)
            }
        } else if (d.write) {
            d.write(arg);
        }/* else { // This could recurse if we ever add print!
            print(arg);
        }*/
    }
}
// ------------------------------------------------------------
// --END Reusable functions