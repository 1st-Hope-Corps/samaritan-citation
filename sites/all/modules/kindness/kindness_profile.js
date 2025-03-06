// --BEGIN Kindness functions
// ------------------------------------------------------------

var iPageRec = 10;

function Kindness_ApproveTitle(sDialogBoxId, sDialogTextId, id){
  if (sDialogBoxId == null || sDialogBoxId == '') sDialogBoxId = 'KSPopUp';
  if (sDialogTextId == null || sDialogTextId == '') sDialogTextId = 'hud_KSText';
  
  $("#"+sDialogTextId).text('loading...');
  
  $.ajax(
    {
      url: Drupal.settings['basePath'] + 'kindness/details/' + id + '/true/',
      dataType: 'text',
      success: function(data) {
        $("#"+sDialogTextId).html(data);
      },
      error: function() {
        $("#"+sDialogTextId).html("There was a problem with your request<br />");  
      }
    }
  );
  
  //document.getElementById('KSPopUp').style.display = 'block';
  $('#'+sDialogBoxId).show();
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
      Drupal.settings['basePath'] + "kindness/callback/edit",
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
  document.getElementById('KSPopUp').style.display = 'block';
}

function Kindness_GetDetails(sWhich){
  $.post(
    Drupal.settings['basePath'] + "kindness/callback/details",
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

function Kindness_GetDashboard ( sAccountId, sDialogTextId ) {
  if (sDialogTextId == null) sDialogTextId = 'kindness_dashboard_details';
  
  /*  $.post(
    Drupal.settings['basePath'] + "kindness/callback/dash",
    {func: "kindness_dash"},
    function(sReply){
      if (sDialogTextId == 'KindnessWorkz_Text') $("#"+sDialogTextId).html('<div id="kindness_dashboard_details" class="kindness-txt kindness-dashboard-box">');
      
      if (sDialogTextId == 'KindnessWorkz_Text'){
        $("#"+sDialogTextId).append(sReply.RETURN);
      }else{
        $("#"+sDialogTextId).html(sReply.RETURN);
      }
      
      if (sDialogTextId == 'KindnessWorkz_Text') $("#"+sDialogTextId).append('</div>');
    },
    "json"
  ); */
  
  $.ajax(
    {
      type: 'POST',
      url: Drupal.settings['basePath'] + 'kindness/callback/dash/' + sAccountId,
      data: {func: "kindness_dash"},
      success: function(sReply){
        $("#"+sDialogTextId).html(sReply.RETURN);
      },
      dataType: 'json',
      async:false
    }
  );
}

function Kindness_Block ( sAccountId, sDialogTextId1, sDialogTextId2Sub, sDialogTextId2 ) {
  $('#dialog_KindnessWorkz').toggle();
  $('#KindnessWorkz_Title').text('').parent().parent().css('padding', '0px');
  
  Kindness_GetDashboard( sAccountId, sDialogTextId2Sub );
  Kindness_GetApproved( sAccountId, sDialogTextId2 );
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
      Drupal.settings['basePath'] + "kindness/callback/form",
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

function Kindness_GetApproved ( sAccountId, sDialogTextId ) {
  if (sDialogTextId == null) sDialogTextId = 'kindness_approved_list';
  
  $("#"+sDialogTextId).text('loading...');
  
  $.ajax(
    {
      type: 'POST',
      url: Drupal.settings['basePath'] + 'kindness/callback/workz/' + sAccountId,
      data: {func: "kindness_approved"},
      success: function(sReply){
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
        
        if (sDialogTextId == 'KindnessWorkz_Text2'){
          sContent = sContent.replace(/Kindness_ApproveTitle\(/g, "Kindness_ApproveTitle('dialog_KindnessWorkz_Details', 'KindnessWorkz_Details', ");
          
          $("#"+sDialogTextId).html(sContent + sFooter);
        }else{
          sContent = sContent.replace(/Kindness_ApproveTitle\(/g, "Kindness_ApproveTitle('', '', ");
          
          $("#"+sDialogTextId).html(sContent + sFooter);
        }
        
        if (iPageStart == 0) $("button#btnPrev").hide();
        if (iPageEnd == iRecCount) $("button#btnNext").hide();
      },
      dataType: 'json',
      async:false
    }
  );
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
    Drupal.settings['basePath'] + "kindness/callback/pending",
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



// Shows/Hides the applicable sub menus.
function Toggle(sDivId, bToggle){
  if (typeof bToggle == "undefined") bToggle = true;
  
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



$(document).ready(function(){

  $('#profile-kindess-workz-summary .content a').live('click', function(e){
    e.preventDefault();
    var uid = $(this).data('uid');
    Kindness_Block( uid, 'KindnessWorkz_Text1', 'KindnessWorkz_Text1Sub', 'KindnessWorkz_Text2' );
  });
  
});
