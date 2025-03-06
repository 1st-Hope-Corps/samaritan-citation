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

$(document).ready(
	function(){
	
	$("#btnBankWithdrawSend").click(
		function (){
			var sAlertMsg = "Please check the following:\n";
			var iAlertMsgLen = sAlertMsg.length;
			var mBankBalance = $("#bank_balance").val();
			
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
					"/hopebank/callback/send",
					{
						mAmount: mBankSendAmount,
						sAccount: sBankSendToAccount,
						bForTrueCafe: bBankForTrueCafe
					},
					function(sReply){
						var newBalance = mBankBalance - mBankSendAmount;
						$("#bank_balance").val(newBalance); 
						$("#current_balance").text(newBalance);
						
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
	
		if(window.location.pathname == '/secure/bank/statement'){
				$.post(
				"/hopebank/callback/statement",
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
		
		if(window.location.pathname == '/secure/bank/deposit'){
			$.post(
			"/secure/kindness/callback/details",
			{func: "kindness_details"},
			function(sReply){
				iKindnessBalance = sReply.RETURN.HOURS;
				var sKindnessNotice = sReply.RETURN.NOTICE;
					$("#bank_deposit_notice").text(sKindnessNotice);
				},
				"json"
			);
		}
		
		$("#btnBankDeposit")
		.unbind("click")
		.click(
			function (){
				_Bank_SetButtonConvert("iTimeToConvert");
			}
		);
	
	}
);

function _Bank_SetButtonConvert(sThisField){
	var iTimeToConvert = $("#"+sThisField).val();
	
	if (is_numeric(iTimeToConvert) && iTimeToConvert <= iKindnessBalance){
		$("#btnBankDeposit").val("Wait...").attr("disabled", "true");
		
		$.post(
			"/secure/kindness/callback/convert",
			{iTime: iTimeToConvert},
			function(sReply){
				if (sReply.STATUS == "Success"){
					alert("Convertion Successful!");
					$("#btnKindnessConvert").val("Convert to Hope Bucks");	
					$("#btnKindnessConvert").removeAttr('disabled');
				}
				
				$("#btnBankDeposit").val("Convert To Valiants").attr("disabled", "");
				//$("#bank_deposit_status").text(sReply.RETURN);
				alert(sReply.RETURN);
				location.href="/secure/bank/deposit"
			},
			"json"
		);
	}else{
		if (!is_numeric(iTimeToConvert)) alert("You have specified an invalid number. Example correct entries: 1, 1.5, 0.25, etc.");
		if (iTimeToConvert > iKindnessBalance) alert("The time you can convert cannot excees your accumulated time ("+iKindnessBalance+").")
	}
}

function is_numeric(mixed_var){ 
	if (mixed_var === '') return false;

	return !isNaN(mixed_var * 1);
}
