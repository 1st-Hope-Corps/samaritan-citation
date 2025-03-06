/* HUD JavaScript
 *	Modules dependent on:
 *		Bank, Kindness, Askeet (Instant Tutoring), Time Tracker
 */
// Bank variables
var mBankBalance = -1;
var bBankIniDetails = false;
var iPageRec = 50;
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

// Executes the code if the document is ready.
$(document).ready(
	function(){
		ApplyOffset();
		$( ".elearning-zoom-open-iframe" ).click(function() {
			$(this).css('display', 'none');
			$( "#learning_page_content" ).addClass('learning_page_content_active');
			$( ".elearning-zoom-close-iframe" ).css('display', 'block');
		});
		$( ".elearning-zoom-close-iframe" ).click(function() {
			$(this).css('display', 'none');
			$( "#learning_page_content" ).removeClass('learning_page_content_active');
			$( ".elearning-zoom-open-iframe" ).css('display', 'block');
		});
		$("#sAgeGroup").change(
			function() {
				setAgeGroup(this.value);
			}
		);
		setAgeGroup('-2');
		
		$("#sLanguage").change(
			function() {
				setLanguage(this.value);
			}
		);
		
		setLanguage('-2');
		
		$("#sProfilePerms").change(
			function() {
				setProfilePerms(this.value);
			}
		);
		
		$("#tree_categories").treeview({
			collapsed: true,
			animated: "medium",
			unique:true,
			toggle:fixScrollbar,
		});
		
		$("#tree_ecategories").treeview({
			collapsed: true,
			animated: "medium",
			unique:true,
			toggle:fixScrollbar,
		});
		
		if (GetQuerystring("b", "") == "" && GetQuerystring("e", "") == "" && GetQuerystring("id", "") == ""){
			//SetGeneric("Main");
			// ToggleContent("hope_main");
			// ToggleContent("hope_about_1st_hope_corps");
			ToggleContent("hope_home_1st_hope_corps");
		}
		
		if (GetQuerystring("e", "") != ""){
			ToggleContent("entertainment");
		}
		
		if (GetQuerystring("b", "") != ""){
			ToggleContent("carousel");
		}
		if (GetQuerystring("id", "") == "help"){
			ToggleContent("learning");
		}
		//customization to add iframe for html5 based content @ 09May2016
		if (GetQuerystring("id", "") == "url"){
			ToggleContent("learning1");
			
		}
        
        if (GetQuerystring("t", "") == 1){  
            ToggleContent("bank_withdraw");
        }
        
        if (GetQuerystring("kindness_form_v2", "") == 1){  
            ToggleContent("kindness_form_v2");
        }
        
        if (GetQuerystring("kindness_dashboard", "") == 1){  
            ToggleContent("kindness_dashboard");
        }
		
		var iEarthMovieTimerId;

		$('[name="first_name"]').keyup(function(){
			setName()
		});

		$('[name="last_name"]').keyup(function(){
			setName()
		});
		
		$("#zoom_earth").click(
			function(){
				$("#zoom_earth").hide();
				//$("#zoom_earth_movie").show();
				$("#zoom_earth_movie").css("top","155px")
				//iEarthMovieTimerId = setTimeout("EarthMovieTimeout()", 36000);
			}
		);
		
		$("#zoom_earth_movie_close").click(
			function(){
				$("#zoom_earth").show();
				//$("#zoom_earth_movie").hide();
				$("#zoom_earth_movie").css("top","-1055px")
			}
		);
		
		
		Bank_GetDetails();
		
		$("#hud_VolunteerCatList1").treeview(
			{url: hud_sBasePath+"askeet/question/cats", unique: true}
		);
		
		$("#hud_VolunteerCatList2").treeview(
			{url: hud_sBasePath+"askeet/question/cats", unique: true}
		);/**/
		
		// Sets the click event for the refresh feature
		$("#hud_stat_refresh_new").click(
			function (){
				Bank_GetDetails();
				Time_GetCredit();
				$("#stat_update").fadeIn(300).fadeOut(2000);
			}
		);

		if(window.location.hash) {
			var hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
			ToggleContent(hash);
		}

		$('[name="is_benefactor_anonymous"]').change(function(){
			if ($(this).attr('checked')) {
				$('.benefactor-data-container').hide();
			}else{
				$('.benefactor-data-container').show();
			}
		});

		$('[name="edit_is_benefactor_anonymous"]').change(function(){
			if ($(this).attr('checked')) {
				$('.edit_benefactor-data-container').hide();
			}else{
				$('.edit_benefactor-data-container').show();
			}
		});

		$('[name="is_beneficiary_anonymous"]').change(function(){
			if ($(this).attr('checked')) {
				$('.beneficiary-data-container').hide();
			}else{
				$('.beneficiary-data-container').show();
			}
		});

		$('[name="edit_is_beneficiary_anonymous"]').change(function(){
			if ($(this).attr('checked')) {
				$('.edit_beneficiary-data-container').hide();
			}else{
				$('.edit_beneficiary-data-container').show();
			}
		});

		$('#workz-type').change(function(){
			$('.kind-type-options-container').hide();
			if($(this).val() == 'Kindness Workz'){
				$('#kindness-act-fields-container').show();
				$('#kindness-act-type-fields-container').show();
				$('.benefactor-info-fields-container').show();
				$('.beneficiary-info-fields-container').show();
			}else if($(this).val() == 'Valor Workz'){
				$('#valor-act-fields-container').show();
				$('.benefactor-info-fields-container').show();
				$('.beneficiary-info-fields-container').show();
			}else if($(this).val() == 'Random Kindness Workz'){
				$('#kindness-act-fields-container').hide();
				$('#kindness-act-type-fields-container').hide();
				$('#valor-act-fields-container').hide();
				$('.benefactor-info-fields-container').hide();
				$('.beneficiary-info-fields-container').hide();
			}else{
				$('.benefactor-info-fields-container').show();
				$('.beneficiary-info-fields-container').show();
			}
		});

		$('#workz-type_mobile').change(function(){
			$('#valor-act-fields-container_mobile').hide();
			$('#kindness-act-fields-container_mobile').hide();
			$('#kindness-act-type-fields-container_mobile').hide();
			$('.benefactor-info-fields-container').hide();
			$('.beneficiary-info-fields-container').hide();
			
			if($(this).val() == 'Kindness Workz'){
				$('#kindness-act-fields-container_mobile').show();
				$('#kindness-act-type-fields-container_mobile').show();
				$('.benefactor-info-fields-container').show();
				$('.beneficiary-info-fields-container').show();
			}else if($(this).val() == 'Valor Workz'){
				$('#valor-act-fields-container_mobile').show();
				$('.benefactor-info-fields-container').show();
				$('.beneficiary-info-fields-container').show();
			}else if($(this).val() == 'Random Kindness Workz'){
				$('#valor-act-fields-container_mobile').hide();
				$('#kindness-act-fields-container_mobile').hide();
				$('#kindness-act-type-fields-container_mobile').hide();
				$('.benefactor-info-fields-container').hide();
				$('.beneficiary-info-fields-container').hide();
			}else{
				$('.benefactor-info-fields-container').show();
				$('.beneficiary-info-fields-container').show();
			}
		});

		$('#edit_workz-type_mobile').change(function(){
			$('.edit_kind-type-options-container').hide();
			if($(this).val() == 'Kindness Workz'){
				$('#edit_kindness-act-fields-container_mobile').show();
				$('#edit_kindness-act-type-fields-container_mobile').show();
				$('.edit_benefactor-info-fields-container').show();
				$('.edit_beneficiary-info-fields-container').show();
			}else if($(this).val() == 'Valor Workz'){
				$('#edit_valor-act-fields-container_mobile').show();
				$('.edit_benefactor-info-fields-container').show();
				$('.edit_beneficiary-info-fields-container').show();
			}else if($(this).val() == 'Random Kindness Workz'){
				$('#valor-act-fields-container_mobile').hide();
				$('#kindness-act-fields-container_mobile').hide();
				$('#kindness-act-type-fields-container_mobile').hide();
				$('.edit_benefactor-info-fields-container').hide();
				$('.edit_beneficiary-info-fields-container').hide();
			}else{

				$('.edit_benefactor-info-fields-container').show();
				$('.edit_beneficiary-info-fields-container').show();
			}
		});

		$('#b1-next-button').click(function(event){
			let error  = 0;
			let benefactor_same_user = $(this).closest('form').find('[name="is_benefactor_same_user"]');
			let workz_type = $(this).closest('form').find('[name="workz_type"]');
			let is_benefactor_anonymous = $(this).closest('form').find('[name="is_benefactor_anonymous"]').attr('checked');

			$(this).closest('.form-wizard-content').find('[required]').each(function(){

				if(workz_type.val() === 'Random Kindness Workz' || is_benefactor_anonymous){
					if ($(this).val() === '' && !$(this).closest('.field-group').hasClass('benefactor-container-fields')) {
						error++;
						return;
					}
				}else{
					if(benefactor_same_user.attr('checked') == true){
						if ($(this).val() === '' && !$(this).closest('.field-group').hasClass('benefactor-container-fields')) {
							error++;
							return;
						}
					}else{
						if ($(this).val() === '') {
							error++;
							return;
						}
					}
				}
			})

			if (benefactor_same_user.attr('checked') == false) {
				if(error > 0){
					alert('Please fill out required fields');
					return;
				}
			}

			event.preventDefault();

			if (benefactor_same_user.attr('checked') == false && workz_type.val() != 'Random Kindness Workz' && !is_benefactor_anonymous) {
				if ($(this).closest('.form-wizard-content').find('[name="benefactor_phone"]').val() == '' && $(this).closest('.form-wizard-content').find('[name="benefactor_email"]').val() == '') {
					alert('You must input email or phone');
					return;
				}
			}

			
			$('#container-workz-wizard-b1').removeClass('active');
			$('#container-workz-wizard-b2').addClass('active');

			$('#header-workz-wizard-b1').removeClass('active');
			$('#header-workz-wizard-b2').addClass('active');
		});

		$('#b1-next-button-mobile').click(function(event){
			let error  = 0;
			let benefactor_same_user = $(this).closest('form').find('[name="is_benefactor_same_user"]');
			let workz_type = $(this).closest('form').find('[name="workz_type"]');
			let is_benefactor_anonymous = $(this).closest('form').find('[name="is_benefactor_anonymous"]').attr('checked');

			$(this).closest('.citation_report_wizard_target').find('[required]').each(function() {

				if(workz_type.val() === 'Random Kindness Workz' || is_benefactor_anonymous){
					if ($(this).val() === '' && !$(this).closest('.field-group').hasClass('benefactor-container-fields')) {
						error++;
						return;
					}
				}else{
					if(benefactor_same_user.attr('checked') == true){
						if ($(this).val() === '' && !$(this).closest('.field-group').hasClass('benefactor-container-fields')) {
							error++;
							return;
						}
					}else{
						if ($(this).val() === '') {
							error++;
							return;
						}
					}
				}
			})

			if(error > 0){
				alert('Please fill out required fields');
				return;
			}

			event.preventDefault();

			if (benefactor_same_user.attr('checked') == false && workz_type.val() != 'Random Kindness Workz' && !is_benefactor_anonymous) {
				if ($(this).closest('.citation_report_wizard_target').find('[name="benefactor_phone"]').val() == '' && $(this).closest('.citation_report_wizard_target').find('[name="benefactor_email"]').val() == '') {
					alert('You must input email or phone');
					return;
				}
			}

			$('#mobile-container-workz-wizard-b1').removeClass('active');
			$('#mobile-container-workz-wizard-b2').addClass('active');

			$('.citation_report_wizard_header[target="benefactor_information"]').removeClass('active');
			$('.citation_report_wizard_header[target="beneficiary_information"]').addClass('active');
		});

		$('.edit_citation_report_wizard_header').click(function(){
			let target = $(this).attr('target');

			$('.edit_citation_report_wizard_header').removeClass('active');
			$('.edit_citation_report_wizard_target').removeClass('active');

			$('.edit_citation_report_wizard_target#' + target).addClass('active');
			$(this).addClass('active');
		})

		$('#edit_b1-next-button-mobile').click(function(e){
			e.preventDefault();
			$('.edit_citation_report_wizard_header[target="edit_mobile-container-workz-wizard-b2"]').click();
		});

		$('#edit_b2-previous-button-mobile').click(function(e){
			e.preventDefault();
			$('.edit_citation_report_wizard_header[target="edit_mobile-container-workz-wizard-b1"]').click();
		});

		$('#b1-bypass-mobile').click(function(event){

			event.preventDefault();
			$('#mobile-container-workz-wizard-b1').removeClass('active');
			$('#mobile-container-workz-wizard-b2').addClass('active');

			$('.citation_report_wizard_header[target="benefactor_information"]').removeClass('active');
			$('.citation_report_wizard_header[target="beneficiary_information"]').addClass('active');
		});

		$('#b1-bypass').click(function(event){
			event.preventDefault();
			$('#container-workz-wizard-b1').removeClass('active');
			$('#container-workz-wizard-b2').addClass('active');

			$('#header-workz-wizard-b1').removeClass('active');
			$('#header-workz-wizard-b2').addClass('active');
		});

		$('#b2-previous-button').click(function(event){
			event.preventDefault();
			$('#container-workz-wizard-b1').addClass('active');
			$('#container-workz-wizard-b2').removeClass('active');

			$('#header-workz-wizard-b1').addClass('active');
			$('#header-workz-wizard-b2').removeClass('active');
		});

		$('#b2-previous-button').click(function(event){
			event.preventDefault();
			$('#container-workz-wizard-b1').addClass('active');
			$('#container-workz-wizard-b2').removeClass('active');

			$('#header-workz-wizard-b1').addClass('active');
			$('#header-workz-wizard-b2').removeClass('active');
		});

		$('#b2-previous-button-mobile').click(function(event){
			event.preventDefault();
			$('#mobile-container-workz-wizard-b1').addClass('active');
			$('#mobile-container-workz-wizard-b2').removeClass('active');

			$('.citation_report_wizard_header[target="benefactor_information"]').addClass('active');
			$('.citation_report_wizard_header[target="beneficiary_information"]').removeClass('active');
		});

		$('#b2-submit').click(function(event){
			let error = 0;
			let workz_type = $(this).closest('form').find('[name="workz_type"]');
			let is_beneficiary_anonymous = $(this).closest('form').find('[name="is_beneficiary_anonymous"]').attr('checked');
			$(this).closest('.form-wizard-content.active').find('[required]').each(function(){
				if(workz_type.val() === 'Random Kindness Workz' || is_beneficiary_anonymous){
					if ($(this).val() === '' && !$(this).closest('.field-group').hasClass('beneficiary-container-fields')) {
						error++;
						return;
					}
				}else{

					if ($(this).val() === '') {
						error++;
						return;
					}
				}
			})

			if(error > 0){
				alert('Please fill out required fields');
				return;
			}

			event.preventDefault();

			if (workz_type.val() != 'Random Kindness Workz' && !is_beneficiary_anonymous) {
				if ($(this).closest('.form-wizard-content').find('[name="beneficiary_phone"]').val() == '' && $(this).closest('.form-wizard-content').find('[name="beneficiary_email"]').val() == '') {
					alert('You must input email or phone');
					return;
				}
			}

			Kindness_SetFormSubmit_v2();
		});

		$('#b2-submit-mobile').click(function(event){
			let error = 0;

			let workz_type = $(this).closest('#workz_form_v2_mobile').find('[name="workz_type"]');
			let is_beneficiary_anonymous = $(this).closest('#workz_form_v2_mobile').find('[name="is_beneficiary_anonymous"]').attr('checked');

			$(this).closest('.citation_report_wizard_target').find('[required]').each(function() {
				if(workz_type.val() === 'Random Kindness Workz' || is_beneficiary_anonymous){
					if ($(this).val() === '' && !$(this).closest('.field-group').hasClass('beneficiary-container-fields')) {
						error++;
						return;
					}
				}else{

					if ($(this).val() === '') {
						error++;
						return;
					}
				}
			})

			if(error > 0){
				alert('Please fill out required fields');
				return;
			}

			event.preventDefault();

			if (workz_type.val() != 'Random Kindness Workz' && !is_beneficiary_anonymous) {
				if ($(this).closest('.citation_report_wizard_target').find('[name="beneficiary_phone"]').val() == '' && $(this).closest('.citation_report_wizard_target').find('[name="beneficiary_email"]').val() == '') {
					alert('You must input email or phone');
					return;
				}
			}

			Kindness_SetFormSubmit_v2_mobile();
		});

		$('#edit_b2-submit-mobile').click(function(event){
			let error = 0;

			let workz_type = $(this).closest('#edit_workz_form_v2_mobile').find('[name="edit_workz_type"]');
			let is_beneficiary_anonymous = $(this).closest('#edit_workz_form_v2_mobile').find('[name="edit_is_beneficiary_anonymous"]').attr('checked');

			$(this).closest('.citation_report_wizard_target').find('[required]').each(function() {
				if(workz_type.val() === 'Random Kindness Workz' || is_beneficiary_anonymous){
					if ($(this).val() === '' && !$(this).closest('.field-group').hasClass('edit_beneficiary-container-fields')) {
						error++;
						return;
					}
				}else{

					if ($(this).val() === '') {
						error++;
						return;
					}
				}
			})

			if(error > 0){
				alert('Please fill out required fields');
				return;
			}

			event.preventDefault();

			if (workz_type.val() != 'Random Kindness Workz' && !is_beneficiary_anonymous) {
				if ($(this).closest('.citation_report_wizard_target').find('[name="edit_beneficiary_phone"]').val() == '' && $(this).closest('.citation_report_wizard_target').find('[name="edit_beneficiary_email"]').val() == '') {
					alert('You must input email or phone');
					return;
				}
			}

			Kindness_SetFormSubmit_v2_mobile_edit();
		});

		$('#b2-bypass').click(function(event){
			event.preventDefault();
			$('#hud-loading').show();
			setTimeout(function(){
				$('#workz_form_v2')[0].reset();
				$('#b2-previous-button').click();
				$('#benefactor-picture-preview-container').hide();
				$('#beneficiary-picture-preview-container').hide();
				$('#workz-picture-preview-container').hide();
				alert('Your Kindness Form has been submitted.');
				$('#hud-loading').hide();
			}, 1000)
		});

		$('#b2-bypass-mobile').click(function(event){
			event.preventDefault();
			$('#hud-loading').show();
			setTimeout(function(){
				alert('Your Kindness Form has been submitted.');
				
				$('#hud-loading').hide();
			}, 1000)
		});

		$('#historyBack').click(function(e){
			event.preventDefault();
			if(page_history.length === 1){
				ToggleContent('hope_home_1st_hope_corps');
			}else{
				page_history.pop();
				ToggleContent(page_history.pop());
			}
		});

		$('#my-status-button').live('click', function(){
			$('#hud-loading').show();
			Kindness_GetDashboard();
			setTimeout(function(){
				Kindness_GetApproved();
				$('#hud-loading').hide();
			}, 1000)
		});

		$('#benefactor-status-button').live('click', function(){
			Kindness_GetDashboard();
			$('#hud-loading').show();
			setTimeout(function(){
				Kindness_GetApproved_benefactors();
				$('#hud-loading').hide();
			}, 1000)
		});

		$('.enrol-as-reporter').live('click', function(e){
			e.preventDefault();
			if (confirm('Are you sure you want to enrol as reporter?')) {
				$.post(
					hud_sBasePath+"kindness/callback/workz2_enroll_report",
					{
					},
					function(sReply){
						alert('You are now enrolled as reporter!');
						window.location.reload(true);
					},
					"json"
				);
			}
		});

		$('.enrol-as-reviewer').live('click', function(e){
			e.preventDefault();
			if (confirm('Are you sure you want to enrol as reviewer?')) {
				$.post(
					hud_sBasePath+"kindness/callback/workz2_enroll_reviewer",
					{
					},
					function(sReply){
						alert('You are now enrolled as reviewer!');
						window.location.reload(true);
					},
					"json"
				);
			}
		});

		$('.enrol-as-booster').live('click', function(e){
			e.preventDefault();
			if (confirm('Are you sure you want to enrol as booster?')) {
				$.post(
					hud_sBasePath+"kindness/callback/workz2_enroll_booster",
					{
					},
					function(sReply){
						alert('You are now enrolled as booster!');
						window.location.reload(true);
					},
					"json"
				);
			}
		});

		$('#upload-benefactor').click(function(){
			$('#benefactor-picture').click();
		});

		$('#upload-beneficiary').click(function(){
			$('#beneficiary-picture').click();
		});

		$('#upload-workz').click(function(){
			$('#workz-picture').click();
		});

		$('#upload-benefactor_mobile').click(function(){
			$('#benefactor-picture_mobile').click();
		});

		$('#upload-account_mobile').click(function(){
			$('#account-picture_mobile').click();
		});

		$('#upload-beneficiary_mobile').click(function(){
			$('#beneficiary-picture_mobile').click();
		});

		$('#upload-workz_mobile').click(function(){
			$('#workz-picture_mobile').click();
		});

		$('#edit_upload-benefactor_mobile').click(function(){
			$('#edit_benefactor-picture_mobile').click();
		});

		$('#edit_upload-beneficiary_mobile').click(function(){
			$('#edit_beneficiary-picture_mobile').click();
		});

		$('#edit_upload-workz_mobile').click(function(){
			$('#edit_workz-picture_mobile').click();
		});

		$('.workz-mobile-column-clickable').live('click', function(){
			let kindness_id = $(this).attr('kindness_id');

			Kindness_ApproveTitle2(kindness_id);
		});

		$('[name="is_benefactor_same_user"]').change(function(){
			if ($(this).attr('checked')) {
				$('.benefactor-container-fields').hide();
			} else {
				$('.benefactor-container-fields').show();
			}
		});
	}
);

function uploadOnChange(upload_input_id, input_id){
	$('#hud-loading').show();
	var formData = new FormData();

	formData.append("image", $('#'+upload_input_id)[0].files[0]);

	$.ajax({
        url: hud_sBasePath+"kindness/callback/upload_temp_image",
        type: 'POST',
        cache : false,
		dataType    : 'json',
		processData : false,
        contentType : false,
        data: formData ,
        success: function(sReply) {
        	$('#' + upload_input_id + '-preview-container').show();
        	$('#' + upload_input_id + '-preview').attr('href', '/hud_files/uploads/temp/' + sReply.original_name)
        	$('#' + upload_input_id + '-preview').text(sReply.upload_name)
        	$('#' + input_id).val(sReply.original_name)
			$('#hud-loading').hide();
        }        
    }); 
}

window.onresize = function(){
	ApplyOffset();
}

$(window).load(
	function(){
		Translate(hud_sLang);
		
		//$("div[class=nav_left] span[class=style1]").css("paddingRight", "81px");
	}
);

$(window).unload(
	function(){
		
	}
);

function hud_askeet_Rating(sType, iAnswerId){
	var askeet_sBasePath = '/';
	var sThisThumb = (sType == "up") ? "askeet_answer_rating_up_":"askeet_answer_rating_down_";
	
	$.post(
		askeet_sBasePath+"askeet/answer/rating",
		{
			id: iAnswerId,
			type: sType
		},
		function(sReply){
			if (sReply.STATUS == "Success"){
				$("#askeet_answer_rating_up_"+iAnswerId).unbind();
				$("#askeet_answer_rating_down_"+iAnswerId).unbind();
				
				$("#askeet_rating_up_"+iAnswerId).attr("src", askeet_sBasePath+"misc/thumbs_up_voted.gif");
				$("#askeet_rating_down_"+iAnswerId).attr("src", askeet_sBasePath+"misc/thumbs_down_voted.gif");
				$("#askeet_rating_up_"+iAnswerId).removeAttr("onclick");
				$("#askeet_rating_down_"+iAnswerId).removeAttr("onclick");

				$("#askeet_answer_rating_up_value_"+iAnswerId).text(sReply.RETURN[0].UP);
				$("#askeet_answer_rating_down_value_"+iAnswerId).text(sReply.RETURN[0].DOWN);
			}else{
				alert(sReply.ERRMSG + "\nSQL:\n" + sReply.SQL);
			}
		},
		"json"
	);
}

function Translate(sLang){
 if($.browser.msie && $.browser.version=="8.0"){ 
  jQuery(function($){                              
            $("div#wrapper05").translate('en', sLang);  
            $("div#promisesboxes").translate('en', sLang);
            $("div#hopenet_main_text").translate('en', sLang);
            $("div#content_wrapper1").translate('en', sLang);    
            $("div#cpanel").translate('en', sLang);
            $("div#nav_right").translate('en', sLang);
            $("div#nav_right").translate('en', sLang); 
            $("div#hopenet_about_1st_hope_corps").translate('en', sLang); 
            $("div#hopenet_about_shuttle").translate('en', sLang); 
            $("div#hopenet_about_hopenet").translate('en', sLang); 
            $("div#hopenet_about_why_hope_corps").translate('en', sLang); 
            $("div#hopenet_about_legend").translate('en', sLang); 
            $("div#learning_about").translate('en', sLang); 
            $("div#hud_main_content").translate('en', sLang); 
            $("div#livelihood_content_about").translate('en', sLang); 
            $("div#bank_content_about").translate('en', sLang); 
            $("div#bank_content_statement").translate('en', sLang); 
            $("div#bank_content_withdraw").translate('en', sLang); 
            $("div#bank_content_deposit").translate('en', sLang); 
            $("div#bank_content_loans").translate('en', sLang); 
            $("div#bank_content_economy").translate('en', sLang); 
            $("div#kindness_content_about").translate('en', sLang); 
            $("div#kindness_content_dashboard").translate('en', sLang); 
            $("div#kindness_content_convert").translate('en', sLang); 
            $("div#kindness_content_pending_approved").translate('en', sLang); 
            $("div#kindness_content_form").translate('en', sLang); 
            $("div#time_tracker_content").translate('en', sLang); 
            $("div#tutoring_content_ini").translate('en', sLang); 
            $("div#tutoring_content_private").translate('en', sLang); 
            $("div#tutoring_content_get_started").translate('en', sLang); 
            $("div#tutoring_content_ask_form").translate('en', sLang); 
            $("div#tutoring_content_about").translate('en', sLang); 
            $("div#generic_page_content").translate('en', sLang); 
            $("div#mentoring_page_content").translate('en', sLang); 
            $("div#peace_content_about").translate('en', sLang); 
            $("div#peace_content_kindness").translate('en', sLang); 
            $("div#peace_content_kindness_workz").translate('en', sLang); 
            $("div#peace_content_kindness_act").translate('en', sLang); 
            $("div#peace_content_kindness_reporter").translate('en', sLang); 
            $("div#peace_content_virtues").translate('en', sLang); 
            $("div#peace_content_spirituality").translate('en', sLang);             
          }
        ); 

 } else{
    if (sLang == "") sLang = (jQuery.cookie('glang')) ? $.cookie("glang"):"en";
	
	if (sLang != hud_sLangOrig){
		if (sLang == "pt") sLang = "pt-PT";
		
		jQuery.cookie("glang", sLang);
		jQuery(
			function($){
				var aTags = Array("body", "a", "p", "span", "div");
				
				for (i=0; i<aTags.length; i++){
					$(aTags[i]).translate(
						"en",
						sLang,
						{
							//walk:true,
							toggle:true,
							each:function(i){
								$("div#hopenet_main_text").jScrollPane({showArrows:true, scrollbarWidth: 17})
							}
						}
					);
				}
				
				sPrevLang = hud_sLangOrig;	
				hud_sLang = sLang;
				hud_sLangOrig = sLang;
			}
		);
	}
 }
}

function EarthMovieTimeout(){
	$("#zoom_earth").show();
	$("#zoom_earth_movie").hide();
}

function EarthMovie(){
	
}

function hideCarousel(bHide) {
	if (bHide) {
		$('#carousel_content').css('margin-top', '-99999px');
		$('#tree_menu').show();	
		if ($(".jScrollPaneContainer div#tree_screen").parent().length == 0){
			$("div#tree_screen").jScrollPane({showArrows:true, scrollbarWidth: 17, reinitialiseOnImageLoad: true});
		}
		$(".jScrollPaneContainer").show();
	} else {
		$('#carousel_content').css('margin-top', '51px');
		$('#tree_menu').hide();
		$('#carousel_content').hide(1,
			function() {		
				$('#carousel_content').show();
			}
		);
	}
}

function hideECarousel(bHide) {
	if (bHide) {
		$('#entertainment_content').css('margin-top', '-99999px');
		$('#etree_menu').show();	
		if ($(".jScrollPaneContainer div#etree_screen").parent().length == 0){
			$("div#etree_screen").jScrollPane({showArrows:true, scrollbarWidth: 17, reinitialiseOnImageLoad: true});
		}
		$(".jScrollPaneContainer").show();
	} else {
		$('#entertainment_content').css('margin-top', '51px');
		$('#etree_menu').hide();
		$('#entertainment_content').hide(1,
			function() {		
				$('#entertainment_content').show();
			}
		);
	}
}

function getEFlashContents(iGroupId,sParents) {
	var sNames = "";
	
	while (!flash) {
		if(navigator.appName.indexOf("Microsoft") != -1)
			flash = window.entertainment_carousel;
		else
			flash = document.entertainment_carousel;
	}

	var aParents = sParents.split(",");
	for (ctr = 1; ctr < aParents.length; ctr++) {
		var tmid = "#tm" + aParents[ctr];
		var namehtml = '';
		if($(tmid).html() == null){
		namehtml = 'Home';
		} else{
		namehtml = $(tmid).html();
		}
		
		sNames += "|" + namehtml;
			
	}
	
	$('#entertainment_content').css('margin-top', '51px');
	$('#etree_menu').hide();
	//console.log(iGroupId+', ' + sParents + ', ' + sNames.substr(1));
	flash.getFlashContents(iGroupId,sParents,sNames.substr(1));
}

function getFlashContents(iGroupId,sParents) {
	var sNames = "";
	
	while (!flash) {
		if(navigator.appName.indexOf("Microsoft") != -1)
			flash = window.carousel_main;
		else
			flash = document.carousel_main;
	}

	var aParents = sParents.split(",");
	for (ctr = 1; ctr < aParents.length; ctr++) {
		var tmid = "#tm" + aParents[ctr];
		sNames += "|" + $(tmid).html(); 
	}
	
	$('#carousel_content').css('margin-top', '51px');
	$('#tree_menu').hide();
	flash.getFlashContents(iGroupId,sParents,sNames.substr(1));
}

function fixScrollbar() {
	$("div#tree_screen").jScrollPane({showArrows:true, scrollbarWidth: 17});
	$("div#etree_screen").jScrollPane({showArrows:true, scrollbarWidth: 17});
	$(".jScrollPaneContainer").show();
}
function setIEAgeGroup(val,id) 
{            
    $("#age_notice").html("");
    $.ajax({
      url: 'mystudies/agemanagement/1/' + uid + '/' + val,
      dataType: 'text',
      success: function(data) {
        for(var i=1; i<=3; i++){
            if(i == id){
            $('#' + 'sAgeGroup'+id).css("background-color","#3399ff");  
            } else{
            $('#' + 'sAgeGroup'+i).css("background-color",""); 
            }
        }
        if (val != '-2')
            $("#age_notice").html("Age group has been successfully changed<br />");
        else
            $("#sAgeGroup").val(data);
      },
      error: function() {
            $("#age_notice").html("There was a problem with your request<br />");  
      }
    });
}
function setAgeGroup(val) 
{
	$("#age_notice").html("");
	$.ajax({
	  url: 'mystudies/agemanagement/1/' + uid + '/' + val,
	  dataType: 'text',
	  success: function(data) {
		if (val != '-2')
			$("#age_notice").html("Age group has been successfully changed<br />");
		else
			$("#sAgeGroup").val(data);
	  },
	  error: function() {
			$("#age_notice").html("There was a problem with your request<br />");  
	  }
	});
}


function setProfilePerms(val) 
{
	$("#profile_perms_notice").html("");
	$.ajax({
	  url: 'mystudies/profileperms/' + uid + '/2/' + val,
	  dataType: 'text',
	  success: function(data) {
		$("#profile_perms_notice").html("Profile permission has been successfully changed<br />");
	  },
	  error: function() {
			$("#profile_perms_notice").html("There was a problem with your request<br />");  
	  }
	});
}


function setLanguage(val) 
{
	$("#language_notice").html("");
	$.ajax({
	  url: 'mystudies/languagemanagement/1/' + uid + '/' + val,
	  dataType: 'text',
	  success: function(data) {
		if (val != '-2'){
			$("#language_notice").html("Language settings has been successfully changed<br />");
			location.reload();
		    //Translate(val);
		}else{
			$("#sLanguage").val(data);
		}
	  },
	  error: function(d,s,o) {
			$("#language_notice").html("There was a problem with your request<br />");  
	  }
	});
}



function NewWin(sOpenThisURL, iWidth, iHeight){
	window.open(sOpenThisURL, "Disclaimer", "width="+iWidth+", height="+iHeight+", status=0, toolbar=1, menubar=0, resizable=0, scrollbars=0");
}

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

// Computes and applies the offset depending on the dimensions of the browser window
function ApplyOffset(){
	iOffset = (GetWindowDimension().w/2);
	
	$("#zoom_earth").css("left", iOffset+129+"px");
	$("#zoom_earth_movie").css("left", iOffset+129+"px");
}



function News_Load(sNewQuery){
	$("#hud_google_news")
		.attr("src", "http://www.google.com/uds/modules/elements/newsshow/iframe.html?q="+encodeURIComponent(sNewQuery)+"&rsz=large")
		.show();
}

function News_Unload(){
	$("#hud_google_news").hide();
}

// start messages
function SetGeneric(sTitle){
	if (sTitle == "Mentoring") sTitle = "e"+sTitle;
	
	//$("#generic_title").text(sTitle); my_communication_content_about
	$("#my_communication_content_about").hide();
	$("#generic_page_content #generic_title").text(sTitle);
	$("#generic_sub_title").text('Welcome to ' + sTitle);
	
	if (sTitle == "eMentoring") sTitle = "Mentoring";
	
	$("#generic_image").css("backgroundImage", "url(hud_files/images/"+sTitle.replace(" ", "_").toLowerCase()+"_img.jpg)");
	
	inbox_access('inbox');	
	//document.getElementById('KSPopUp').style.display = 'block'
}

function stat_access(){
$.post(
		hud_sBasePath+"messages/callback/stat",
		{ func: "" },
		function(sReply){
			//if (sReply.STATUS == "Success"){
				var oReturn = sReply.RETURN;
				
				$("span#comm_inbox").text(oReturn.inbox > 0 ? oReturn.inbox : 0);
				$("span#comm_sent").text(oReturn.sent > 0 ? oReturn.sent : 0);
				$("span#comm_contact").text('0');
				$("span#comm_blacklist").text(oReturn.block > 0 ? oReturn.block : 0);
				$("span#comm_perm").text(oReturn.clearance);
			//}
		},
		"json"
	);
}

function pageselectCallback(page_index, jq){

var sCval = $("#currentmsg").val(); 
var sCsearch = $("#currentmsgSearch").val();
var searchval = '';
if(sCsearch !== ''){ 
		searchval = $('#searchmsgtxt').val();
} else{
		searchval = '';
}

$.post(
		hud_sBasePath+"messages/callback/" + sCval,
		{ search: searchval },
		function(sReply){
			//if (sReply.STATUS == "Success"){
				iPageStart = 0;
				//iPageEnd = iPageRec;
				iPageEnd = 100;
				oStatementRecs = sReply.RETURN;
				
				var oStatement = sReply.RETURN;
				var iRecCount = oStatement.length;
				var sContent = '';
				var sTransactType = '';
				var sDescription = '';
				var sMsgList = new Array();
				
				for (i=iPageStart; i<iPageEnd && i<iRecCount; i++){
					smid = oStatement[i].mid;
					ssubject = oStatement[i].subject;
					sbody = oStatement[i].body;
					stimestamp = oStatement[i].timestamp;
					sis_new = oStatement[i].is_new;
					sauthor = oStatement[i].author;
					sdate_started = oStatement[i].date_started;
					sMsgList.push([smid, ssubject, sbody, stimestamp, sis_new, sauthor, sdate_started]);
				}
				
				var items_per_page = 1000;
                //var max_elem = Math.min((page_index+0) * items_per_page, sMsgList.length);
				var max_elem = sMsgList.length;
                var newcontent = '';
				var smid = '';
				var ssubject = '';
				var sbody = '';
				var stimestamp = '';
				var sis_new = '';
				var sauthor = ''; 
				var sdate_started = '';

                for(var i=page_index*items_per_page;i<max_elem;i++){
					smid = sMsgList[i][0];
					ssubject = sMsgList[i][1];
					sbody = sMsgList[i][2];
					stimestamp = sMsgList[i][3];
					sis_new = sMsgList[i][4];
					sauthor = sMsgList[i][5]; 
					sdate_started = sMsgList[i][6];
					
					if(sis_new == 0){
					scolor = '#9bbd34'; 
					} else{
					scolor = '#fff200';
					}
					
					if(i == iPageEnd){
					sHr = '<hr style="color: #ddd200;background-color:#ddd200;height:2px;border:none;width:420px;"/></div>';
					} else{
					sHr = '<hr style="color: #40ce11;background-color:#40ce11;height:2px;border:none;width:420px;"/></div>';
					}
					
					newcontent += '<div style="padding-left:20px;"><div style="padding-top:4px;float:left;width:40%;height:50px;display:block;"><input type="checkbox" name="msgmid" id="msgmid" value="' + smid + '" style="border:#fff200 solid 2px;"/> <a href="javascript:void(0);" style="color:' + scolor + ';" onclick="viewMessage('+smid+', ' + "'" + sCval + "'" +');"><b>'+sauthor+'</b></a><div style="color:#268109;">' + stimestamp +'</div></div><div style="float:left;width:50%;height:50px;display:block;padding-top:4px;"><a href="javascript:void(0);" style="color:' + scolor + ';" onclick="viewMessage('+smid+', ' + "'" + sCval + "'" +');"><b>'+ssubject+'</b></a><div style="color:#268109;">'+sbody+'</div></div><div style="clear:both;margin-top:5px;"></div>' + sHr;
                }
                
                $('#Searchresult').html(newcontent);
                
                return false;
			/*
			if (iPageStart == 0) $("button#btnPrev").hide();
				if (iPageEnd == iRecCount) $("button#btnNext").hide();*/
			//}
		},
		"json"
	);
}

function getOptionsFromForm(){
                var opt = {callback: pageselectCallback};
                //opt['items_per_page'] = parseInt('2message_block');
				opt['items_per_page'] = parseInt('1');
				opt['num_display_entries'] = parseInt('3');
				opt['num_edge_entries'] = parseInt('3');
				opt['prev_text'] = 'prev';
				opt['next_text'] = 'next';
  
                var htmlspecialchars ={ "&":"&amp;", "<":"&lt;", ">":"&gt;", '"':"&quot;"}
                $.each(htmlspecialchars, function(k,v){
                    opt.prev_text = opt.prev_text.replace(k,v);
                    opt.next_text = opt.next_text.replace(k,v);
                })
                return opt;
}

function inbox_access(sCat){
$("#currentmsgSearch").val('');			
load_contentmsg(sCat);
}

function load_contentmsg(sCat){
stat_access();
$("#message_inbox").html($("#displaymsgloader").html());
$("#currentmsg").val(sCat);

	if(sCat == 'inbox'){
	var sTitle = 'Sender';
	} else if(sCat == 'sent'){
	var sTitle = 'Recipient';
	}
	
				var sHeader = '<div>&nbsp;</div><div style="padding-top:30px;"><form method="post" action="" name="theForm" id="theForm"><div style="display:block;width:100%;font-size:11px;"><div><div style="float:left;width:40%;height:20px;color:#fff200;" align="center"><h3 style="color:#fff200;">' + sTitle + ' / Date</h3></div><div style="float:left;width:60%;height:20px;text-align:left;" align="center"><h3 style="color:#fff200;">Subject / Message</h3></div></div><div style="clear:both;margin-top:12px;"><hr style="color:#ddd200;background-color:#ddd200;height:2px;border:none;"/></div><div style="clear:both;margin-top:12px;">&nbsp;</div>';
				var sFooterPaged = '<div><div style="padding-top:4px;float:left;width:50%;text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" style="cursor:pointer;background-color:#061800; border:#49ec11 solid 1px;font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#54ec1a;" id="searchsubmit" name="searchsubmit" onclick="message_unread(\''+sCat+'\');" value="Mark as Unread" /> <input type="button" onclick="message_delete(\''+sCat+'\');" style="cursor:pointer;background-color:#061800; border:#49ec11 solid 1px;font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#54ec1a;" id="deletemsgsubmit" name="deletemsgsubmit" value="Delete" /></div><div style="float:left;width:50%;padding-top:4px;"><div id="Pagination" style="display:none;"></div></div></div></div></form>';
				var sFooterPlain = '</form></div>';
				
				var sFooter = sFooterPaged;
				var divContent = '<div id="Searchresult" class="hud_message_content winXP"></div>';
				
				$("#message_inbox").html(sHeader + divContent + sFooter);
				
				get_inbox_sent();
}

function get_inbox_sent(){

var sCval = $("#currentmsg").val(); 
$.post(
		hud_sBasePath+"messages/callback/" + sCval,
		{ func: "" },
		function(sReply){
			//if (sReply.STATUS == "Success"){
				iPageStart = 0;
				//iPageEnd = iPageRec;
				iPageEnd = 100;
				oStatementRecs = sReply.RETURN;
				
				var oStatement = sReply.RETURN;
				var iRecCount = oStatement.length;
				var sContent = '';
				var sTransactType = '';
				var sDescription = '';
				var sMsgList = new Array();
				
				for (i=iPageStart; i<iPageEnd && i<iRecCount; i++){
					smid = oStatement[i].mid;
					ssubject = oStatement[i].subject;
					sbody = oStatement[i].body;
					stimestamp = oStatement[i].timestamp;
					sis_new = oStatement[i].is_new;
					sauthor = oStatement[i].author;
					sdate_started = oStatement[i].date_started;
					sMsgList.push([smid, ssubject, sbody, stimestamp, sis_new, sauthor, sdate_started]);
				}
				
				if(sMsgList.length > 0){
				var optInit = getOptionsFromForm();
                $("#Pagination").pagination(sMsgList.length, optInit);
				} else{
				$('#Searchresult').html('<div><span style="color:#fff;">&nbsp;&nbsp;You have no message yet.</span></div><br/><br/>');
				}
		
				/*if (iPageStart == 0) $("button#btnPrev").hide();
				if (iPageEnd == iRecCount) $("button#btnNext").hide();*/
			//}
		},
		"json"
	);
}

function messageSearch(){
   $("#message_inbox").html($("#displaymsgloader").html());
   $("#currentmsgSearch").val('search');

   load_contentmsg('inbox')
}

function message_delete(sCat){		
		 var sStatus = false;
		 $("input[name='msgmid']").each(function() {
			 if ($(this).attr('checked')){
				sStatus = true;
				$.post(
					hud_sBasePath+"messages/callback/status",
					{
						aMidId: $(this).val(),
						aStatus: 0,
						sDelete: 'yes'
					},
					function(sReply){
						if(sReply.STATUS == true){
						inbox_access(sCat);
						}
					},
					"json"
				);
			 }
		 });
	
	if(sStatus == false){
	alert('Please select one or more message.');
	} else{
	stat_access();
	alert('You have successfully deleted the message(s).');
	}
}

function message_unread(sCat){	
		 var sStatus = false;
		 $("input[name='msgmid']").each(function() {
			 if ($(this).attr('checked')){
				sStatus = true;
				$.post(
					hud_sBasePath+"messages/callback/status",
					{
						aMidId: $(this).val(),
						aStatus: 0,
						sDelete: 'no'
					},
					function(sReply){
						if(sReply.STATUS == true){
						inbox_access(sCat);
						}
					},
					"json"
				);
			 }
		 });
	
	if(sStatus == false){
	alert('Please select one or more message.');
	} else{
	stat_access();
	alert('You have successfully marked the message(s) as unread.');
	}
}

function hidemessageblock(){
$("#message_inbox").show(); 
$("#message_block").hide();
}

function message_access(no){
stat_access();
$("#message_inbox").show();
$("#message_block").hide();
switch(no){
	case 1:
	$("#generic_sub_title").text('Create a New Message');
	//$("#message_inbox").html($("#writenewmessage").html());
	$("#message_inbox").hide();
	$("#message_block").html($("#writenewmessage").html());
	$("#message_block").show();
	break;
	case 2:
	$("#generic_sub_title").text('My Inbox');
	inbox_access('inbox');
	break;
	case 3:
	$("#generic_sub_title").text('My Sent Items');
	inbox_access('sent');
	break;
	case 4:
	$("#generic_sub_title").text('Manage Contacts');
	$("#message_inbox").html('manage contacts');
	break;
	case 5:
	$("#generic_sub_title").text('Manage Blacklists');
	$("#message_inbox").html('manage blacklists');
	break;
	case 6:
	$("#generic_sub_title").text('Manage Clearance');
	$("#message_inbox").html('manage clearance');
	break;
}

}

function sendMessageForm(){
	
	var sAlertMsg = "Please check the following:\n";
	var iAlertMsgLen = sAlertMsg.length;
	
	var sRecipients = $("#sRecipients").val();
	var sSubject = $("#sSubject").val();
	var sMessage = $("#sMessage").val();

	if (jQuery.trim(sRecipients) == "") sAlertMsg += " - recipient of your message\n";
	if (jQuery.trim(sSubject) == "") sAlertMsg += " - the subject of your message\n";
	if (sMessage == "") sAlertMsg += " - the message";
	
	if (iAlertMsgLen < sAlertMsg.length){
		alert(sAlertMsg);
	}else{	
        $("#sendmsgsubmit").val("Please Wait..").attr("disabled", "disabled");
		$.post(
			hud_sBasePath+"messages/callback/send",
			{
				sRecipient: sRecipients,
				sSubject: sSubject,
				sMessage: sMessage
			},
			function(sReply){
				if (sReply.STATUS == true){
					stat_access();
					$("#sendmsgsubmit").val("Send Message").removeAttr('disabled');	
					$("#sRecipients").val("");
					$("#sSubject").val("");
					$("#sMessage").val("");
				}
			
				alert(sReply.RETURN);
			},
			"json"
		);

	}
}

function sendReplyForm(){
	var sAlertMsg = "Please check the following:\n";
	var iAlertMsgLen = sAlertMsg.length;
	
	var sRecipients = $("#comm_authorname").val();
	var sSubject = $("#comm_authorsubject").val();
	var sMessage = $("#commsMessage").val();

	if (sMessage == "") sAlertMsg += " - the message";
	
	if (iAlertMsgLen < sAlertMsg.length){
		alert(sAlertMsg);
	}else{	

		$.post(
			hud_sBasePath+"messages/callback/send",
			{
				sRecipient: sRecipients,
				sSubject: sSubject,
				sMessage: sMessage
			},
			function(sReply){
				if (sReply.STATUS == true){
					$("#sRecipients").val("");
					$("#sSubject").val("");
					$("#sMessage").val("");
				}
			
				alert(sReply.RETURN);
			},
			"json"
		);

	}
}

function viewMessage(iMidId, type){
stat_access();
//$("#message_inbox").html($("#displaymsgloader").html());
		$.post(
			hud_sBasePath+"messages/callback/view/"+iMidId,
			{func: ""},
			function(sReply){
			var aReturn = sReply.RETURN;
			
				//if (aReturn.length > 0){	
						$("input#comm_thread_id").val(aReturn.thread_id);
						$("input#comm_author").val(aReturn.author_uid); 
						$("input#comm_authorname").val(aReturn.author_name);
						$("input#comm_authorsubject").val(aReturn.subject);
						$("span#comm_author_name").text(aReturn.author_name);
						$("span#comm_body").html(aReturn.message);
						$("span#comm_timestamp").text(aReturn.timestamp);
						$("#generic_sub_title").html("Message");
						$("#title_of_message").html(aReturn.subject);
						$("#message_inbox").hide();
						$("#message_block").html($("#openmessage").html());
						$("#message_block").show();
						if(type == 'inbox'){
						$("#inboxreturn").show();
						} else{
						$("#sentreturn").show();
						}
				//}
			},
			"json"
		);
		
		 $.post(
				hud_sBasePath+"messages/callback/status",
				{
					aMidId: iMidId,
					aStatus: 1,
					sDelete: 'no'
				},
				function(sReply){
				},
				"json"
		);
}

// eof end messages

// Shows/Hides the Module's Content.

var page_history = [];
function ToggleContent(sContentType){
	let user_id = $('#user_id').val() || 0;
	if (user_id == 0 && (sContentType != 'hope_home_1st_hope_corps' && sContentType != 'hope_about_1st_hope_corps') && window.location.pathname != '/login.php') {
		alert('Please log in to continue');
		return;
	}

	if(page_history[page_history.length - 1] != sContentType){
		page_history.push(sContentType)
	}

	$('#top-navigation').find('li').removeClass('active-top-nav');
	switch (sContentType){
		case "hope_main":
		case "hope_main_generic":
		case "hope_main_generic_faq":
		case "hope_about_1st_hope_corps":
		case "hopenet_home_1st_hope_corps":
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
		case "my_profile":
			sImage = "scale-bare.png";
			break;
		default:
			sImage = "scale-banking.png";
	}
	
	// $("#wrapper").css("background", "url(hud_files/images/"+sImage+") top no-repeat");
	
	$(".jScrollPaneContainer div#hopenet_about_1st_hope_corps_text").parent().hide();
	$(".jScrollPaneContainer div#hopenet_about_shuttle_text").parent().hide();
	$(".jScrollPaneContainer div#mentoring_page_content_text").parent().hide();
	$(".jScrollPaneContainer div#profile_page_content_text").parent().hide();
	
	var bHopeMain = (sContentType.substring(0, 5) == "hope_") ? true:false;
	
	if (!bHopeMain) $("#hopenet_main_content").hide();
	
	$("#hopenet_main").hide();
	$("#hopenet_main_generic").hide();
	$("#hopenet_main_generic_faq").hide();
	$("#hopenet_about_1st_hope_corps").hide();
	$("#hopenet_home_1st_hope_corps").hide();
	$("#hopenet_about_shuttle").hide();
	$("#hopenet_about_hopenet").hide();
	$("#hopenet_about_why_hope_corps").hide();
	$("#hopenet_about_legend").hide();
	
	$("#peace_content_about").hide();
	$("#peace_content_kindness").hide();
	$("#peace_content_virtues").hide();
	$("#peace_content_spirituality").hide();

	$("#peace_content_kindness_workz").hide();
	$("#peace_content_kindness_act").hide();
	$("#peace_content_kindness_reporter").hide();
	
	$("#learning_about").hide();
	$("#carousel_content").hide();
	$("#content_wrapper4").hide();
	$("#content_wrapper5").hide();
	
	$("#entertainment_content_about").hide();
	$("#entertainment_content").hide();
	$("#entertainment_content_wrapper4").hide();
	$("#entertainment_content_wrapper5").hide();
	
	$("#mentoring_page_content").hide();
	
	$("#livelihood_content_about").hide();
	$("#livelihood_content_store").hide();
	$("#livelihood_store_frame").hide();
	$("#livelihood_commissary_frame").hide();
	$("#learning_page_content").hide();
	
	$("#bank_content_about").hide();
	$("#bank_content_statement").hide();
	$("#bank_content_rewards").hide();
	$("#bank_content_withdraw").hide();
	$("#bank_content_deposit").hide();
	$("#bank_content_loans").hide();
	$("#bank_content_economy").hide();
	
	$("#kindness_content_about").hide();
	$("#kindness_content_dashboard").hide();
	$("#kindness_content_convert").hide();
	$("#kindness_content_pending_approved").hide();
	$("#kindness_content_form").hide();
	$("#kindness_content_form_v2").hide();
	
	$("#time_tracker_content").hide();
	
	$("#tutoring_content_ini").hide();
	$("#tutoring_content_private").hide();
	$("#tutoring_content_get_started").hide();
	$("#tutoring_content_ask_form").hide();
	$("#tutoring_content_about").hide();
	$("#my_communication_content_about").hide();
	$("#generic_page_content").hide();
	
	$("#my_profile_content_about").hide();
	$("#my_profile_content_profile").hide();
	$("#my_profile_content_about_container").hide();
	
	$("#tree_menu").hide();
	$("#toggle_buttons").hide();
	$("#etree_menu").hide();
	$("#toggle_ebuttons").hide();
	
	News_Unload();
	
	if ((sContentType.substr(0, 4) == "bank" || sContentType.substr(0, 8) == "kindness") && !bBankIniDetails){
		Bank_GetDetails();
		Bank_SetWithdrawSend();
		Bank_SetDepositConvert();
		bBankIniDetails = true;
	}
	
	if (sContentType.substr(0, 8) == "tutoring"){
		Tutor_GetPopularTags();
		$("#tutor_answer_form").hide();
		
		if (!bTutorIniDetails){
			Bank_GetDetails();
			bTutorIniDetails = true;
		}
		
		Tutor_SetLinks();
	}
	
	switch (sContentType){
		case "my_communcation_about":
			// $("#content_breadcrumb").html('My Communication');
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
		case "peace_about":
			// $("#content_breadcrumb").html('Values Building');
			$("#peace_content_about").show();
			
			$("#quick_links_kindess_1").hover(
				function(){
					$("#quick_links_kindess_menu_1").show();
				},
				function(){
					$("#quick_links_kindess_menu_1").hide();
				}
			);
			
			$("#quick_links_kindess_menu_1").hover(
				function(){
					$("#quick_links_kindess_menu_1").show();
				},
				function(){
					$("#quick_links_kindess_menu_1").hide();
				}
			);
			
			if ($(".jScrollPaneContainer div#peace_about_text").parent().length == 0){
				$("div#peace_about_text").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}
			if ($(".jScrollPaneContainer div#peace_content_about").parent().length == 0){
				$("div#peace_about_text").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}
			if ($(".jScrollPaneContainer div#peace_page_content_text").parent().length == 0){
				$("div#peace_page_content_text").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}
                        
                        if ($(".jScrollPaneContainer div#values_monitoring_left").parent().length == 0){
				$("div#values_monitoring_left").jScrollPane({showArrows:true, scrollbarWidth: 17});
                            }
                             
			
			break;
		case "peace_kindness":
			// $("#content_breadcrumb").html('Peace Building &gt; Kindness &gt; About');
			$("#peace_content_kindness").show();
			
			$("#quick_links_kindess_2").hover(
				function(){
					$("#quick_links_kindess_menu_2").show();
				},
				function(){
					$("#quick_links_kindess_menu_2").hide();
				}
			);
			
			$("#quick_links_kindess_menu_2").hover(
				function(){
					$("#quick_links_kindess_menu_2").show();
				},
				function(){
					$("#quick_links_kindess_menu_2").hide();
				}
			);
			
			if ($(".jScrollPaneContainer div#peace_kindness_content_text").parent().length == 0){
				$("div#peace_kindness_content_text").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}
			
			break;
		case "peace_kindness_workz":
			// $("#content_breadcrumb").html('Peace Building &gt; Kindness Program &gt; Kindness Workz');
			$("#peace_content_kindness_workz").show();
			
			$("#quick_links_kindess_3").hover(
				function(){
					$("#quick_links_kindess_menu_3").show();
				},
				function(){
					$("#quick_links_kindess_menu_3").hide();
				}
			);
			
			$("#quick_links_kindess_menu_3").hover(
				function(){
					$("#quick_links_kindess_menu_3").show();
				},
				function(){
					$("#quick_links_kindess_menu_3").hide();
				}
			);
			
			if ($(".jScrollPaneContainer div#peace_kindness_workz_content_text").parent().length == 0){
				$("div#peace_kindness_workz_content_text").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}
			
			break;
		case "peace_kindness_act":
			// $("#content_breadcrumb").html('Peace Building &gt; Kindness Program &gt; Act of Kindness');
			$("#peace_content_kindness_act").show();
			
			$("#quick_links_kindess_4").hover(
				function(){
					$("#quick_links_kindess_menu_4").show();
				},
				function(){
					$("#quick_links_kindess_menu_4").hide();
				}
			);
			
			$("#quick_links_kindess_menu_4").hover(
				function(){
					$("#quick_links_kindess_menu_4").show();
				},
				function(){
					$("#quick_links_kindess_menu_4").hide();
				}
			);
			
			break;
		case "peace_kindness_reporter":
			// $("#content_breadcrumb").html('Peace Building &gt; Kindness Program &gt; Kindness Reporter');
			$("#peace_content_kindness_reporter").show();
			
			$("#quick_links_kindess_5").hover(
				function(){
					$("#quick_links_kindess_menu_5").show();
				},
				function(){
					$("#quick_links_kindess_menu_5").hide();
				}
			);
			
			$("#quick_links_kindess_menu_5").hover(
				function(){
					$("#quick_links_kindess_menu_5").show();
				},
				function(){
					$("#quick_links_kindess_menu_5").hide();
				}
			);
			
			break;
		case "peace_virtues":
			// $("#content_breadcrumb").html('Peace Building &gt; Virtues &amp; Values');
			$("#peace_content_virtues").show();
			
			$("#quick_links_kindess_6").hover(
				function(){
					$("#quick_links_kindess_menu_6").show();
				},
				function(){
					$("#quick_links_kindess_menu_6").hide();
				}
			);
			
			$("#quick_links_kindess_menu_6").hover(
				function(){
					$("#quick_links_kindess_menu_6").show();
				},
				function(){
					$("#quick_links_kindess_menu_6").hide();
				}
			);
			
			if ($(".jScrollPaneContainer div#peace_virtues_content_text").parent().length == 0){
				$("div#peace_virtues_content_text").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}
			
			break;
		case "peace_spirituality":
			// $("#content_breadcrumb").html('Values Building &gt; HopeGames');
			// $("#wrapper").css("background", "url(hud_files/images/scale.png) top no-repeat");
			$("#peace_content_spirituality").show();
			
			$("#quick_links_kindess_7").hover(
				function(){
					$("#quick_links_kindess_menu_7").show();
				},
				function(){
					$("#quick_links_kindess_menu_7").hide();
				}
			);
			
			$("#quick_links_kindess_menu_7").hover(
				function(){
					$("#quick_links_kindess_menu_7").show();
				},
				function(){
					$("#quick_links_kindess_menu_7").hide();
				}
			);
			
			break;
		case "hope_main":
			// $("#content_breadcrumb").html('About 1st Hope');
			$("#hopenet_main_content").show();
			$("#hopenet_main").show();
			$("#hopenet_main_slider").show();
			$("#hopenet_about_slider").hide();
			
			if ($(".jScrollPaneContainer div#hopenet_main_text").parent().length == 0){
				$("div#hopenet_main_text").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}else{
				$(".jScrollPaneContainer div#hopenet_main_text").parent().show();
			}
			
			break;
		case "hope_main_generic":
			$("#hopenet_main_content").show();
			$("#hopenet_main_generic").show();
			
			break;
		case "hope_main_generic_faq":
			$("#hopenet_main_content").show();
			$("#hopenet_main_generic_faq").show();
			
			break;
		case "hope_about_1st_hope_corps":
			$('#top-navigation').find('#about_top_nav').addClass('active-top-nav')
			// $("#content_breadcrumb").html('About');
			
			if ($("#hopenet_main_content").css("display") == "none") $("#hopenet_main_content").show();
			
			$("#hopenet_about_1st_hope_corps").show();
			
			// if ($("#hopenet_main_slider").css("display") == "block") $("#hopenet_main_slider").hide();
			// if ($("#hopenet_about_slider").css("display") == "none") $("#hopenet_about_slider").show();
			
			if ($(".jScrollPaneContainer div#hopenet_about_1st_hope_corps_text").parent().length == 0){
				$("div#hopenet_about_1st_hope_corps_text").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}else{
				$(".jScrollPaneContainer div#hopenet_about_1st_hope_corps_text").parent().show();
			}
			
			break;
		case "hope_home_1st_hope_corps":
			$('#top-navigation').find('#home_top_nav').addClass('active-top-nav')
			// $("#content_breadcrumb").html('Home');
			
			if ($("#hopenet_main_content").css("display") == "none") $("#hopenet_main_content").show();
			
			$("#hopenet_home_1st_hope_corps").show();
			
			// if ($("#hopenet_main_slider").css("display") == "block") $("#hopenet_main_slider").hide();
			// if ($("#hopenet_about_slider").css("display") == "none") $("#hopenet_about_slider").show();
			
			if ($(".jScrollPaneContainer div#hopenet_home_1st_hope_corps_text").parent().length == 0){
				$("div#hopenet_home_1st_hope_corps_text").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}else{
				$(".jScrollPaneContainer div#hopenet_home_1st_hope_corps_text").parent().show();
			}
			
			break;
		case "hope_about_shuttle":
			// $("#content_breadcrumb").html('About 1st Hope &gt; About &gt; How does the Hope Shuttle work');
			
			if ($("#hopenet_main_content").css("display") == "none") $("#hopenet_main_content").show();
			
			$("#hopenet_about_shuttle").show();
			
			if ($("#hopenet_about_slider").css("display") == "none") $("#hopenet_about_slider").show();
			
			if ($(".jScrollPaneContainer div#hopenet_about_shuttle_text").parent().length == 0){
				$("div#hopenet_about_shuttle_text").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}else{
				$(".jScrollPaneContainer div#hopenet_about_shuttle_text").parent().show();
			}
			
			break;
		case "hope_about_hopenet":
			// $("#content_breadcrumb").html('About 1st Hope &gt; About &gt; How does HopeNet work');
			
			if ($("#hopenet_main_content").css("display") == "none") $("#hopenet_main_content").show();
			
			$("#hopenet_about_hopenet").show();
			
			if ($("#hopenet_about_slider").css("display") == "none") $("#hopenet_about_slider").show();
			
			if ($(".jScrollPaneContainer div#hopenet_about_hopenet_text").parent().length == 0){
				$("div#hopenet_about_hopenet_text").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}else{
				$(".jScrollPaneContainer div#hopenet_about_hopenet_text").parent().show();
			}
			
			break;
		case "hope_about_why_hope_corps":
			// $("#content_breadcrumb").html('About 1st Hope &gt; About &gt; Why Hope Street');
			
			if ($("#hopenet_main_content").css("display") == "none") $("#hopenet_main_content").show();
			
			$("#hopenet_about_why_hope_corps").show();
			
			if ($("#hopenet_about_slider").css("display") == "none") $("#hopenet_about_slider").show();
			
			if ($(".jScrollPaneContainer div#hopenet_about_why_hope_corps_text").parent().length == 0){
				$("div#hopenet_about_why_hope_corps_text").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}else{
				$(".jScrollPaneContainer div#hopenet_about_why_hope_corps_text").parent().show();
			}
			
			break;
		case "hope_about_legend":
			// $("#content_breadcrumb").html('About 1st Hope &gt; About &gt; The Legend of Hope');
			
			if ($("#hopenet_main_content").css("display") == "none") $("#hopenet_main_content").show();
			
			$("#hopenet_about_legend").show();
			
			if ($("#hopenet_about_slider").css("display") == "none") $("#hopenet_about_slider").show();
			
			break;
		case "carousel":
			// $("#content_breadcrumb").html('Knowledge Portal');
			$("#carousel_content").show();
			$("#content_wrapper4").show();
			$("#content_wrapper5").show();
			$("#toggle_buttons").show();
			
			break;
		case "learning_about":
			// $("#content_breadcrumb").html('Knowledge Portal');
			$("#learning_about").show();

			/*if ($(".jScrollPaneContainer div#knowledge_sub_text").parent().length == 0){
				$("div#knowledge_sub_text").jScrollPane({showArrows:true, scrollbarWidth: 17});
				$(".jScrollPaneContainer div#knowledge_sub_text").parent().css({"marginLeft":"-9px"});
			}else{
				$(".jScrollPaneContainer div#knowledge_sub_text").parent().show();
			}*/ // by Jed Diaz
			
			if ($(".jScrollPaneContainer div#knowledge_main_text").parent().length == 0){
				$("div#knowledge_main_text").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}else{
				$(".jScrollPaneContainer div#knowledge_main_text").parent().show();
			}
                        
			break;
		case "entertainment_about":
			// $("#content_breadcrumb").html('Entertainment Portal');
			$("#entertainment_content_about").show();
			
			break;
		case "entertainment":
			
			// $("#content_breadcrumb").html('Entertainment Portal');
			// $("#wrapper").css("background", "url(hud_files/images/scale.png) top no-repeat");
			$("#entertainment_content").show();
			$("#entertainment_content_wrapper4").show();
			$("#entertainment_content_wrapper5").show();
			$("#toggle_ebuttons").show();
			
			
			break;
		case "mentoring":
			// $("#content_breadcrumb").html('Values Building &gt; Values Mentoring');
			$("#mentoring_page_content").show();
			
			if ($(".jScrollPaneContainer div#mentoring_page_content_text").parent().length == 0){
				$("div#mentoring_page_content_text").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}else{
				$(".jScrollPaneContainer div#mentoring_page_content_text").parent().show();
			}
			 if ($(".jScrollPaneContainer div#values_monitoring_left").parent().length == 0){
				$("div#values_monitoring_left").jScrollPane({showArrows:true, scrollbarWidth: 17});
                            }else{
                              $("div#values_monitoring_left").jScrollPane({showArrows:true, scrollbarWidth: 17});
                            }
            $("#quick_links_kindess_6").hover(
				function(){
					$("#quick_links_kindess_menu_6").show();
				},
				function(){
					$("#quick_links_kindess_menu_6").hide();
				}
			);             
			break;
		case "learning":
		     $("#learning_page_content1").hide();
			// $("#content_breadcrumb").html('eLearning');
			$("#learning_page_content").show();
			break;
			//customization to add iframe for html5 based content @ 09May2016
		case "learning1":

			// $("#content_breadcrumb").html('Knowledge Portal');
			$("#learning_page_content1").show();
			$("#gotoelearnig").show();
			break;
		case "learning_sub1":
		     $("#learning_page_content1").hide();
			// $("#content_breadcrumb").html('eLearning &gt; ILMS2');
			$("#learning_page_content").hide();
			$("#learning_sub_page_content").show();
			break;
		case "livelihood_about":
			// $("#content_breadcrumb").html('eLivelihood');
            $("#livelihood_content_about").show();
			
			break;
		case "livelihood_store":
			// $("#content_breadcrumb").html('Livelihood &gt; My eStore');
			$("#livelihood_content_store").show();
			$("#livelihood_store_frame").attr("src", hud_sStoreURL).show();
			
			break;
		case "livelihood_commissary":
			// $("#content_breadcrumb").html('Livelihood &gt; Commissary');
			$("#livelihood_content_store").show();
			$("#livelihood_commissary_frame").attr("src", hud_sCommissaryURL).show();
			
			break;
		case "bank_about":
			$('#top-navigation').find('#vault_top_nav').addClass('active-top-nav')
			// $("#content_breadcrumb").html('Vault &gt; About');
			$("#bank_content_about").show();
			
			if ($(".jScrollPaneContainer div#bank_about_text").parent().length == 0){
				$("div#bank_about_text").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}
			
			break;
		case "bank_statement":
			$('#top-navigation').find('#vault_top_nav').addClass('active-top-nav')
			// $("#content_breadcrumb").html('Vault &gt; Bank Statement');
			Bank_GetStatement();
			$("#bank_content_statement").show();
			
			break;
		case "bank_withdraw":
			$('#top-navigation').find('#vault_top_nav').addClass('active-top-nav')
			// $("#content_breadcrumb").html('Vault &gt; Withdraw Bucks');
			Time_GetCredit();
			Time_SetWithdrawBuy();
			$("#bank_content_withdraw").show();
			
			break;
		case "bank_rewards":
			$('#top-navigation').find('#vault_top_nav').addClass('active-top-nav')
			// $("#content_breadcrumb").html('Vault &gt; Withdraw Bucks');
			Time_GetCredit();
			Time_SetWithdrawBuy();
			$("#bank_content_rewards").show();
			
			break;
		case "bank_deposit":
			$('#top-navigation').find('#vault_top_nav').addClass('active-top-nav')
			// $("#content_breadcrumb").html('Vault &gt; Deposit Bucks');
			Kindness_GetDetails("bank");
			$("#bank_content_deposit").show();
			
			break;
		case "bank_loans":
			$('#top-navigation').find('#vault_top_nav').addClass('active-top-nav')
			// $("#content_breadcrumb").html('Vault &gt; Loans');
			$("#bank_content_loans").show();
			
			break;
		case "bank_economy":
			$('#top-navigation').find('#vault_top_nav').addClass('active-top-nav')
			// $("#content_breadcrumb").html('Vault &gt; Hope Economy');
			$("#bank_content_economy").show();
			
			break;
		case "kindness_about":
			$('#top-navigation').find('#workz_top_nav').addClass('active-top-nav')
			// $("#content_breadcrumb").html('Workz &gt; About');
			$("#kindness_content_about").show();
			
			if ($(".jScrollPaneContainer div#kindness_about_text").parent().length == 0){
				$("div#kindness_about_text").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}
			
			break;
		case "members":
			$('#top-navigation').find('#workz_top_nav').addClass('active-top-nav')
			// $("#content_breadcrumb").html('Workz &gt; About');
			$("#members_information").show();
			
			if ($(".jScrollPaneContainer div#kindness_about_text").parent().length == 0){
				$("div#kindness_about_text").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}
			
			break;
		case "kindness_dashboard":
			$('#top-navigation').find('#workz_top_nav').addClass('active-top-nav')
			// $("#content_breadcrumb").html('Workz &gt; Status');
			Kindness_GetDashboard();
			setTimeout(function(){
				Kindness_GetApproved();
			}, 1000);
			//Kindness_GetPending();
			$("#kindness_content_dashboard").show();
			
			if ($(".jScrollPaneContainer div#kindness_status_text").parent().length == 0){
				$("div#kindness_status_text").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}
                        if ($(".jScrollPaneContainer div.kindness_status_post").parent().length == 0){
				$("div.kindness_status_post").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}
			
			break;
		case "kindness_convert":
			$('#top-navigation').find('#workz_top_nav').addClass('active-top-nav')
			// $("#content_breadcrumb").html('Workz &gt; Convert');
			Kindness_GetDetails("kindness");
			//Kindness_SetConvert();
	
			$("#kindness_content_convert").show();
			
			break;
		/* case "kindness_pending_approved":
			$("#content_breadcrumb").html('Workz &gt; Pending/Approved');
			Kindness_GetApproved();
			Kindness_GetPending();
			$("#kindness_content_pending_approved").show();
			
			break; */
		case "kindness_form":
			$('#top-navigation').find('#workz_top_nav').addClass('active-top-nav')
                    // $("#wrapper").css("background", "url(hud_files/images/image1.png) top no-repeat");
                    // $('#kindness_content_form').css({"width":"850px","margin-top": "25px","float":"left","padding": "0px","float": "left","margin-left": "83px","min-height":"1370px"});
                     
                    // $('#kindness_report_left_section').css({"margin":"10px 0px 0px 10px","width":"100%","height":"auto","padding":"0px","float":"none"});
                   
                    // $('#kindness_report_right_section').css({"margin":"0px","height":"auto","padding-left":"0px","float":"left","width":"100%"});
                    // $('#kindness_report_content_section').css("height", "1230px");
                    // $('.kindness_image_report').css("width", "265px");
                    
			// $("#content_breadcrumb").html('Workz &gt; Report');
			$("#kindness_content_form").show();

			if ($(".jScrollPaneContainer div#kindness_form_text").parent().length == 0){
				$("div#kindness_form_text").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}
			
//                    if ($(".jScrollPaneContainer div.kindness_posts_tab").parent().length == 0){
//				$("div.kindness_posts_tab").jScrollPane({showArrows:true, scrollbarWidth: 17});
//			}
//			$(".jScrollPaneContainer").show();
			
			break;
		case "kindness_form_v2":
			$('#top-navigation').find('#workz_top_nav').addClass('active-top-nav')
                    // $("#wrapper").css("background", "url(hud_files/images/image1.png) top no-repeat");
                    // $('#kindness_content_form').css({"width":"850px","margin-top": "25px","float":"left","padding": "0px","float": "left","margin-left": "83px","min-height":"1370px"});
                     
                    // $('#kindness_report_left_section').css({"margin":"10px 0px 0px 10px","width":"100%","height":"auto","padding":"0px","float":"none"});
                   
                    // $('#kindness_report_right_section').css({"margin":"0px","height":"auto","padding-left":"0px","float":"left","width":"100%"});
                    // $('#kindness_report_content_section').css("height", "1230px");
                    // $('.kindness_image_report').css("width", "265px");
                    
			// $("#content_breadcrumb").html('Workz &gt; Report v2');
			$("#kindness_content_form_v2").show();

			if ($(".jScrollPaneContainer div#kindness_form_text_v2").parent().length == 0){
				$("div#kindness_form_text_v2").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}
			
//                    if ($(".jScrollPaneContainer div.kindness_posts_tab").parent().length == 0){
//				$("div.kindness_posts_tab").jScrollPane({showArrows:true, scrollbarWidth: 17});
//			}
//			$(".jScrollPaneContainer").show();
			
			break;
		case "time_tracker":
			// $("#content_breadcrumb").html('Fuel Tracking');
			Time_GetCredit();
            Time_SetWithdrawBuy();
			Time_GetHistory();
		    $("#time_tracker_content").show();
			
			break;
		case "tutoring_ini":
			// $("#content_breadcrumb").html('eTutoring &gt  eTutoring');
            $("#tutoring_content_ini").show();
			
			break;
		case "tutoring_private":
			// $("#content_breadcrumb").html('eTutoring &gt Private eTutoring');
            $("#tutoring_content_private").show();
			
			break;
		case "tutoring_start":
			// $("#content_breadcrumb").html('eTutoring &gt Instant Tutoring &gt; Instant Question');
			
			if (iTutorEnrollStatus == 0) Tutor_EnrolCheck();
			
			Tutor_GetQuestions(hud_sBasePath+"askeet/hud/callback/question/popular", "popular");
            $("#tutoring_content_get_started").show();
			
			break;
		case "tutoring_form":
			// $("#content_breadcrumb").html('eTutoring &gt Instant Tutoring &gt; Instant Question &gt; Ask a Question');
			Tutor_GetDetails();
			//Tutor_SetCats();
			Tutor_SetFormButtons();
			
			$("#tutor_answer_form").hide();
            $("#tutoring_content_ask_form").show();
			
			break;
		case "tutoring_about":
			// $("#content_breadcrumb").html('eTutoring &gt; About');
            $("#tutoring_content_about").show();
			
			break;
		case "my_profile_about":
			// $("#content_breadcrumb").html('My Profile');
			$("#my_profile_content_about").show();
			
			if ($(".jScrollPaneContainer div#profile_page_content_text").parent().length == 0){
				$("div#profile_page_content_text").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}else{
				$(".jScrollPaneContainer div#profile_page_content_text").parent().show();
			}
			
			break;
		case "my_profile":
			$("#my_profile_content_profile").show();
			
			break;
		case "my_profile_kickapps":
			$("#my_profile_content_about_kickapps").attr('src', $("#my_profile_content_about_kickapps_input").val());
			$("#my_profile_content_about_container").show();
			
			break;
	}
        
	
	sLang = (jQuery.cookie('glang')) ? $.cookie("glang"):"en";
	if (!sPrevLang)
		sPrevLang = "en";
	if (sLang != sPrevLang){
		if (sLang == "pt") 
			sLang = "pt-PT";
		// jQuery(function($){
		// 	google.language.translate($("#content_breadcrumb").html().replace(/\&gt\;/g,"#"),sPrevLang,sLang, 
		// 		function(result) {
		// 			if (result.translation)
  // 						$("#content_breadcrumb").html(result.translation.replace(/\#/g,"&gt;"));
		// 		}
		// 	);
		// });
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
			mBankBalance = sReply.BALANCES.BALANCE;
			
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
					
					sContent += '<tr class="statement-row"><td style="vertical-align:top;">'+oStatement[i].dTransactTime+'</td><td style="vertical-align:top;text-transform: capitalize;">'+sTransactType+'</td><td>'+sDescription+'</td><td style="vertical-align:top; text-align:right; padding-right:5px;">'+oStatement[i].mTransactAmount+'</td></tr>';
				}
				
				var sHeader = '<table id="table_statement" style="width:100%;"><tr><td style="width:25%;">Date<td style="width:10%;">Type</td><td style="width:55%;">Description</td><td style="text-align:right; padding-right:5px;">Amount</td></tr><tr><td colspan="4" id="bank-statement-separator"></td></tr><tr><td colspan="4" id="bank-statement-separator-2"></td></tr>';
				var sFooterPaged = '<tr><td colspan="4" style="text-align:center;"><button id="btnPrev" class="button button-blue-gradient" onclick="_Bank_PageStatement(\'prev\', '+iRecCount+')"><< Previous</button>&nbsp;<button id="btnNext" class="button button-blue-gradient" onclick="_Bank_PageStatement(\'next\', '+iRecCount+')">Next >></button></td></tr></table>';
				var sFooterPlain = '</table>';
				
				var sFooter = (iRecCount > iPageRec) ? sFooterPaged:sFooterPlain;
				
				$("#bank_statement_list").html(sHeader+sContent+sFooter);
				
				if (iPageStart == 0) $("button#btnPrev").hide();
				if (iPageEnd == iRecCount) $("button#btnNext").hide();

				let mobile_content_row;

				$('#rewards-statement-list-mobile').find('.statement-row-appended').remove();

				$('#table_statement .statement-row').each(function(){
					mobile_content_row = $('#rewards-statement-row-template-mobile').clone();
					mobile_content_row.find('.statement-date-mobile').text($(this).find('td').eq(0).text());
					mobile_content_row.find('.statement-type-mobile').text($(this).find('td').eq(1).text());
					mobile_content_row.find('.statement-description-mobile').text($(this).find('td').eq(2).text());
					mobile_content_row.find('.statement-amount-mobile').text($(this).find('td').eq(3).text());
					mobile_content_row.attr('id', '');
					mobile_content_row.addClass('statement-row-appended');
					mobile_content_row.removeClass('row-template');

					$('#rewards-statement-list-mobile').append(mobile_content_row);
				});

				if ($('#table_statement .statement-row').length > 0) {
					$('.no-records-statement').hide();
				} else {
					$('.no-records-statement').show();
				}
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

		sContent += '<tr><td style="vertical-align:top;">'+oRec.dTransactTime+'</td><td style="vertical-align:top;text-transform: capitalize;">'+sTransactType+'</td><td>'+sDescription+'</td><td style="vertical-align:top; text-align:right; padding-right:5px;">'+oRec.mTransactAmount+'</td></tr>';
	}
	
	var sHeader = '<table id="table_statement" style="width:100%;"><tr><td style="width:25%;">Date<td style="width:10%;">Type</td><td style="width:55%;">Description</td><td style="text-align:right; padding-right:5px;">Amount</td></tr>';
	var sFooterPaged = '<tr><td colspan="4" style="text-align:center;"><button id="btnPrev" class="button button-blue-gradient" onclick="_Bank_PageStatement(\'prev\', '+iTotalRec+')">Previous</button>&nbsp;<button id="btnNext" class="button button-blue-gradient" onclick="_Bank_PageStatement(\'next\', '+iTotalRec+')">Next</button></td></tr></table>';
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
				
				//$("#btnBankDeposit").val("Convert To Valiant").attr("enabled", "");
				$("#btnKindnessConvert").val("Convert To Valiant").attr("disabled", "");
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


// --BEGIN Time Tracker functions
// ------------------------------------------------------------
function Time_GetCredit(){
	$.post(
		hud_sBasePath+"time/callback/credit",
		{func: "time_tracker_credit"},
		function(sReply){
			$("#time_tracker_credit").text(sReply.RETURN);
            time_tracker_Update();
			
            // restart time
            /*var time_tracker_sBasePath = hud_sBasePath;
            var time_tracker_iSpent = sReply.TIMESPENT;
            var time_tracker_iAvailable = sReply.TIMEAVAILABLE;
            
            var js = document.createElement('script');
            js.setAttribute('type', 'text/javascript');
            js.src = '/sites/all/modules/time_tracker/time_tracker_hud.js';
            document.body.appendChild(js);*/  
            
            // eof restart time
		},
		"json"
	);
}

function Time_SetWithdrawBuy(){
	$.post(
		hud_sBasePath+"time/callback/blocks",
		{func: "time_tracker_blocks"},
		function(sReply){
			var oTimeBlocks = sReply.RETURN;
			var iRecCount = oTimeBlocks.length;
			
			$('#iBankTimeBlock').children().remove().end().append('<option value="0">Select a Fuel Block...</option>');
			
			for (i=0; i<iRecCount; i++){
				var oTimeBlock = oTimeBlocks[i];
				$("#iBankTimeBlock").append('<option value="'+oTimeBlock.id+'">'+oTimeBlock.desc+'</option>');
			}
		},
		"json"
	);
	
	$("#btnBankWithdrawBuy")
		.unbind("click")
		.click(
			function (){
				var iSelectedBlock = parseInt($("#iBankTimeBlock :selected").val());
				
				if (iSelectedBlock == 0){
					alert("You have to select a Time Block first.");
				}else{
					$("#btnBankWithdrawBuy").val("Wait...").attr("disabled", "true");
					
					$.post(
						hud_sBasePath+"time/callback/blocks/buy",
						{
							iPackageId: iSelectedBlock,
							mBalance: mBankBalance
						},
						function(sReply){
							if (sReply.STATUS == "Success"){
								Bank_GetDetails();                                         
                                Time_GetCredit(); 
                                window.location.href='http://' + window.location.host + '/hud.php?t=1';
                            }
							
							$("#btnBankWithdrawBuy").val("Buy Selected Time Block").attr("disabled", "");
							
							alert(sReply.RETURN);
						},
						"json"
					);
				}
			}
		);
}

function Time_GetHistory(){
	$.post(
		hud_sBasePath+"time/callback/history",
		{func: "time_tracker_history"},
		function(sReply){
			iPageStart = 0;
			iPageEnd = iPageRec;
			
		    /* custom added */
			oHistoryRec = sReply.sHistory;
			sHistory = sReply.sHistory;
			sTime = sReply.sTime;
			var iRecCount = sHistory.length;
			var sContent = '';
			
			for (i=iPageStart; i<iPageEnd && i<iRecCount; i++){
				sContent += sHistory[i];
			}
			
			var sFooterPaged = '<div class="navigation_maintop_history_date1">&nbsp;</div><div class="navigation_maintop_history_discription1"><button id="btnTimePrev" class="button" onclick="_Time_PageHistory(\'prev\', '+iRecCount+')">Previous</button>&nbsp;&nbsp;<button id="btnTimeNext" class="button" onclick="_Time_PageHistory(\'next\', '+iRecCount+')">Next</button></div><div class="navigation_maintop_history_time1">&nbsp;</div>';
			var sFooterPlain = '';
			var sFooter = (iRecCount > iPageRec) ? sFooterPaged:sFooterPlain;
			
			$("div[id^=spent_time]").each(
				function (){
					this.innerHTML = sTime;
				}
			);
			
			$("#time_tracker_credit1").text(sReply.aTime);
			$("#time_tracker_hisrory").html(sContent + sFooter);
			
			if (iPageStart == 0) $("button#btnTimePrev").hide();
			if (iPageEnd == iRecCount) $("button#btnTimeNext").hide();
		},
		"json"
	);
}

function _Time_PageHistory(sDirection, iTotalRec){
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
	
	for (i=iPageStart; i<iPageEnd && i<iTotalRec; i++){
			
		sContent += oHistoryRec[i];
	}
	
	var sFooterPaged = '<div class="navigation_maintop_history_date1">&nbsp;&nbsp;</div><div class="navigation_maintop_history_discription1"><button id="btnTimePrev" class="button" onclick="_Time_PageHistory(\'prev\', '+iTotalRec+')">Previous</button>&nbsp;&nbsp;<button id="btnTimeNext" class="button" onclick="_Time_PageHistory(\'next\', '+iTotalRec+')">Next</button></div><div class="navigation_maintop_history_time1">&nbsp;</div>';
	var sFooterPlain = '';
	
	var sFooter = (iTotalRec > iPageRec) ? sFooterPaged:sFooterPlain;
	
	$("#time_tracker_hisrory").html(sContent + sFooter);
	
	if (iPageStart == 0) $("button#btnTimePrev").hide();
	if (iPageEnd == iTotalRec) $("button#btnTimeNext").hide();
}
// ------------------------------------------------------------
// --END Time Tracker functions


// --BEGIN Instant Tutoring functions
// ------------------------------------------------------------
function Tutor_SetLinks(){
	$("a[id^=tutor_question_featured]").each(
		function (){
			$(this)
				.unbind("click")
				.click(
					function (){
						Tutor_GetQuestions(hud_sBasePath+"askeet/hud/callback/question/featured", "featured");
					}
				);
		}
	);
	
	$("a[id^=tutor_question_popular]").each(
		function (){
			$(this)
				.unbind("click")
				.click(
					function (){
						Tutor_GetQuestions(hud_sBasePath+"askeet/hud/callback/question/popular", "popular");
					}
				);
		}
	);
	
	$("a[id^=tutor_question_all_question]").each(
		function (){
			$(this)
				.unbind("click")
				.click(
					function (){
						Tutor_GetQuestions(hud_sBasePath+"askeet/hud/callback/question/all", "all");
					}
				);
		}
	);
	
	$("a[id^=tutor_question_latest_answer]").each(
		function (){
			$(this)
				.unbind("click")
				.click(
					function (){
						Tutor_GetQuestions(hud_sBasePath+"askeet/hud/callback/question/answer", "answer");
					}
				);
		}
	);
}

function Tutor_GetPopularTags(){
	$.post(
		hud_sBasePath+"askeet/hud/callback/tag/popular",
		{ func: "get_popular_tags" },
		function(sReply){
			var sOutput = '';
			var iCount = 0;
			
			for (sPopTag in sReply){
				sOutput += ((iCount > 0) && (iCount % 4 == 0)) ? "<br />":"";
				
				if (sReply[sPopTag] == 1){
					sTagClass = "one";
				}else if (sReply[sPopTag] == 2){
					sTagClass = "two";
				}else{
					sTagClass = "third";
				}
				
				sOutput += '<a href="#tutor_scroll_here" class="' + sTagClass + '" onclick="_Tutor_GetTagQuestion(\'' + sPopTag + '\')">' + sPopTag + '</a>';
				
				iCount++;
			}
			
			$("div[id^=tutor_popular_tags]").each(
				function (){
					$(this).html(sOutput);
				}
			);
		},
		"json"
	);
}

function _Tutor_GetTagQuestion(sTag){
	Tutor_GetQuestions(hud_sBasePath+"askeet/hud/callback/tag/question/"+sTag, "tag");
	
	$("div[id^=tutor_question_group]").each(
		function (){
			$(this).text("Tag: "+sTag);
		}
	);
}

function _Tutor_GetOpenQuestion(sSubject){
	Tutor_GetQuestions(hud_sBasePath+"askeet/hud/callback/open/question/"+sSubject, "open");
	
	$("div[id^=tutor_question_group]").each(
		function (){
			$(this).text(sSubject);
		}
	);
}

function _Tutor_GetTutorAnswers(sTutorName, iTutorId, sType){
	Tutor_GetQuestions(hud_sBasePath+"askeet/hud/callback/tutor/" + sTutorName + "/" + iTutorId + "/" + sType);
	
	$("div[id^=tutor_question_group]").each(
		function (){
			$(this).text("Tutor: "+sTutorName);
		}
	);
}

function _Tutor_GetFilteredQuestions(iSubjId){
	Tutor_GetQuestions(hud_sBasePath+"askeet/hud/callback/filter/subj/"+iSubjId, "filter");
	
	$("div[id^=tutor_question_group]").each(
		function (){
			$(this).text("Filtered");
		}
	);
}

function Tutor_GetQuestions(sURL, sType){
	if (typeof sTag == "undefined") sTag = "";
	
	$("#tutor_answer_form").hide();
	
	var sTitleGroup = "Instant Tutoring";
	iTutorPageStart = 0;
	iTutorPageEnd = iTutorPageRec;
	
	switch (sType){
		case "featured":
		case "popular":
			sTitleGroup = ucwords(sType);
			
			break;
		case "all":
		case "latest":
		case "answer":
			if (sType == "latest" || sType == "all") sType = "question";
			sTitleGroup = "All " + ucwords(sType) + "(s)";
			
			break;
	}
	
	$("div[id^=tutor_question_group]").each(
		function (){
			$(this).text(sTitleGroup);
		}
	);
	
	$("input[id^=btnTutor]").each(
		function (){
			$(this).hide();
		}
	);
	
	$.post(
		sURL,
		{ func: "get_question" },
		function(sReply){
			var aReturn = sReply.RETURN;
			var sOutput = '';
			
			if (aReturn.length > 0){
				oQuestionRecs = aReturn;
				var iRecCount = aReturn.length;
				
				for (i=iTutorPageStart; i<iTutorPageEnd && i<iRecCount; i++){
					var aRec = aReturn[i];
					var sBody = (aRec.BODY.length > 85) ? aRec.BODY.substring(0, 85) + "...":aRec.BODY;
					var aTag = aRec.TAGS;
					var sQuestion = aRec.QUESTION.TITLE;
					var iQuestionId = aRec.QUESTION.ID;
					var sTags = '';
					
					for (x=0; x<aTag.length; x++){
						sTags += (x > 0) ? " + ":"";
						sTags += aTag[x];
					}
					
					if (aRec.OWNER){
						sOption = (aRec.CLOSED) ? '<span style="margin-left:15px; color:red;">[closed]</span>':'<span id="tutor_delete_link_' + iQuestionId + '" title="Delete this Question" onclick=\'Tutor_DeleteQuestion(' + iQuestionId + ', "' + sQuestion + '")\' style="margin-left:15px; color:red;">[delete]</span>';
					}else{
						sOption = '';
					}
					
					sOutput += '<div class="report_right_text_area_4_3">';
					sOutput += '<div class="report_left_txt_top_4_3">';
					sOutput += '<strong><a href="javascript:void(0)" onclick="Tutor_GetAnswers(\'' + aRec.QUESTION.TITLE_STRIPPED + '\')">' + sQuestion + '</a></strong>';
					sOutput += sOption;
					sOutput += '<br/><span>asked by <a href="#">' + aRec.ASKED_BY + '</a> on ' + aRec.DATE_ASKED + '</span>';
					sOutput += '</div>';
					sOutput += '<div class="report_input_btm_text_4_3">' + sBody + '</div>';
					sOutput += '<div class="report_input_btm_text_4_3"><span>' + aRec.ANSWER_COUNT + ' answer(s) - tags: ' + sTags + '</span></div>';
					sOutput += '</div>';
				}
				
				var sPageButton = '<div style="position:relative; left:230px; top:10px"><input id="btnTutorPrev" type="image" src="hud_files/images/tutor_scroll_up.png" style="width:18px; height:18px; border:none;" onclick="_Tutor_PageQuestion(\'prev\', '+iRecCount+')" /></div>';
				sPageButton += '<div style="position:relative; left:230px; top:245px;"><input id="btnTutorNext" type="image" src="hud_files/images/tutor_scroll_down.png" style="width:18px; height:18px; border:none;" onclick="_Tutor_PageQuestion(\'next\', '+iRecCount+')" /></div>';
				
				sOutput = (iRecCount > iTutorPageRec) ? sPageButton+sOutput:sOutput;
			}else{
				sOutput = '<div class="report_right_text_area_4_3"><div class="report_input_btm_text_4_3">No records to list for now.</div></div>';
			}
			
			$("div[id^=tutor_questions]").each(
				function (){
					$(this).html(sOutput);
				}
			);
			
			$("span[id^=tutor_delete_link_]").each(
				function(){
					$(this).hover(
						function(){
							$(this).css("cursor", "pointer");
						},
						function(){
							$(this).css("cursor", "default");
						}
					);
				}
			);
			
			if (iRecCount > 0){
				$("input[id^=btnTutorPrev]").each(
					function (){
						if (iTutorPageStart == 0){
							$(this).hide();
						}else{
							$(this).show();
						}
					}
				);

				$("input[id^=btnTutorNext]").each(
					function (){
						if (iTutorPageEnd == iRecCount){
							$(this).hide();
						}else{
							$(this).show();
						}
					}
				);
			}
		},
		"json"
	);
}

function _Tutor_PageQuestion(sDirection, iTotalRec){
	if (sDirection == "next"){
		iTutorPageStart += iTutorPageRec;
		iTutorPageEnd += iTutorPageRec;
		
		if (iTutorPageEnd > iTotalRec) iTutorPageEnd = iTotalRec;
	}else{
		iTutorPageStart -= iTutorPageRec;
		
		iOffSet = iTutorPageEnd % iTutorPageRec;

		if (iOffSet == 0){
			iTutorPageEnd -= iTutorPageRec;
		}else{
			iTutorPageEnd -= iOffSet;
		}
		
		if (iTutorPageStart < 0) iTutorPageStart = 0;
	}
	
	var sOutput = '';
	
	for (i=iTutorPageStart; i<iTutorPageEnd && i<iTotalRec; i++){
		var aRec = oQuestionRecs[i];
		var sBody = (aRec.BODY.length > 85) ? aRec.BODY.substring(0, 85) + "...":aRec.BODY;
		var aTag = aRec.TAGS;
		var sQuestion = aRec.QUESTION.TITLE;
		var iQuestionId = aRec.QUESTION.ID;
		var sTags = '';
		
		for (x=0; x<aTag.length; x++){
			sTags += (x > 0) ? " + ":"";
			sTags += aTag[x];
		}
		
		if (aRec.OWNER){
			sOption = (aRec.CLOSED) ? '<span style="margin-left:15px; color:red;">[closed]</span>':'<span id="tutor_delete_link_' + iQuestionId + '" title="Delete this Question" onclick=\'Tutor_DeleteQuestion(' + iQuestionId + ', "' + sQuestion + '")\' style="margin-left:15px; color:red;">[delete]</span>';
		}else{
			sOption = '';
		}
		
		sOutput += '<div class="report_right_text_area_4_3">';
		sOutput += '<div class="report_left_txt_top_4_3">';
		sOutput += '<strong><a href="javascript:void(0);" onclick="Tutor_GetAnswers(\'' + aRec.QUESTION.TITLE_STRIPPED + '\')">' + sQuestion + '</a></strong>';
		sOutput += sOption;
		sOutput += '<br/><span>asked by <a href="#">' + aRec.ASKED_BY + '</a> on ' + aRec.DATE_ASKED + '</span>';
		sOutput += '</div>';
		sOutput += '<div class="report_input_btm_text_4_3">' + sBody + '</div>';
		sOutput += '<div class="report_input_btm_text_4_3"><span>' + aRec.ANSWER_COUNT + ' answer(s) - tags: ' + sTags + '</span></div>';
		sOutput += '</div>';
	}
	
	var sPageButton = '<div style="position:relative; left:230px; top:10px"><input id="btnTutorPrev" type="image" src="hud_files/images/tutor_scroll_up.png" style="width:18px; height:18px; border:none;" onclick="_Tutor_PageQuestion(\'prev\', '+iTotalRec+')" /></div>';
	sPageButton += '<div style="position:relative; left:230px; top:245px;"><input id="btnTutorNext" type="image" src="hud_files/images/tutor_scroll_down.png" style="width:18px; height:18px; border:none;" onclick="_Tutor_PageQuestion(\'next\', '+iTotalRec+')" /></div>';
	sPageButton = (iTotalRec > iTutorPageRec) ? sPageButton:"";
	
	$("div[id^=tutor_questions]").each(
		function (){
			$(this).html(sPageButton+sOutput);
		}
	);
	
	$("input[id^=btnTutorPrev]").each(
		function (){
			if (iTutorPageStart == 0){
				$(this).hide();
			}else{
				$(this).show();
			}
		}
	);

	$("input[id^=btnTutorNext]").each(
		function (){
			if (iTutorPageEnd == iTotalRec){
				$(this).hide();
			}else{
				$(this).show();
			}
		}
	);
}

function Tutor_DeleteQuestion(iQuestionId, sQuestion){
	var bConfirm = confirm("Are you sure you want to delete \""+sQuestion+"\" and all it's answers?");
	
	if (bConfirm){
		$.post(
			hud_sBasePath+"askeet/hud/callback/question/del/"+iQuestionId,
			{ func: "delete_question" },
			function(sReply){
				if (sReply.STATUS == "Success"){
					Tutor_GetQuestions(hud_sBasePath+"askeet/hud/callback/question/popular", "popular");
					Tutor_LoadQuestionStat();
				}
			},
			"json"
		);
	}
}

function Tutor_DeleteAnswer(iAnswerId, sStrippedTitle){
	var bConfirm = confirm("Are you sure you want to delete this answer?");
	
	if (bConfirm){
		$.post(
			hud_sBasePath+"askeet/hud/callback/answer/del/"+iAnswerId,
			{ func: "delete_answer" },
			function(sReply){
				if (sReply.STATUS == "Success"){
					Tutor_GetAnswers(sStrippedTitle);
				}
			},
			"json"
		);
	}
}

function Tutor_EnrolCheck(){
	$.post(
		hud_sBasePath+"askeet/enroll/check",
		{ func: "check_enrollee" },
		function(sReply){
			if (sReply.STATUS == 1){
				iTutorEnrollStatus = 1;
				
				Tutor_SetAskQuestion();
				$("#tutor_enroll_notice").hide();
				$("#tutor_ask_question").show();
			}else{
				Tutor_SetEnrolNow();
			}
			
			Tutor_LoadQuestionStat();
		},
		"json"
	);
}

function Tutor_SetEnrolNow(){
	$("#tutor_enroll_button").click(
		function (){
			$.post(
				hud_sBasePath+"askeet/enroll",
				{ func: "enrol_user" },
				function(sReply){
					if (sReply.STATUS == "Success"){
						iTutorEnrollStatus = 1;
						
						$("#tutor_enroll_notice").hide();
						$("#tutor_ask_question").show();
					}else{
						alert(sReply.ERRMSG);
					}
				},
				"json"
			);
		}
	);
}

function Tutor_SetAskQuestion(){
	$("#tutor_ask_button").click(
		function (){
			ToggleContent("tutoring_form");
		}
	);
}

function Tutor_DoCarousel(sCarouselType, sBtnNext, sBtnPrev) {
	var iCurrent = 0;
	var iLiSize = $('#'+sCarouselType+' ul li').size();
	var iMaximum = Math.ceil(iLiSize / 2) * 100;
	var iSpeed = 200;
	var iCarouselWidth = 200;

	$('#'+sBtnPrev).css("visibility","hidden");
	$('#'+sBtnNext).css("visibility", (iLiSize <= 4) ? "hidden":"visible");
	
	$('#'+sCarouselType+' ul').css("width", iMaximum+"px").css("position", "absolute");
	$('#'+sCarouselType).css("width", iCarouselWidth+"px").css("height", "21px").css("visibility", "visible").css("overflow", "hidden").css("position", "relative");

	$('#'+sBtnNext).click(
		function() {
			if (iCurrent > iMaximum - iCarouselWidth) {
				$('#'+sBtnNext).css("visibility","hidden");
				return;
			}else{
				iCurrent = iCurrent + (iCarouselWidth);
				
				$('#'+sCarouselType+' ul').animate(
					{left: -(iCurrent)},
					iSpeed,
					null
				);
				
				if (iCurrent > iMaximum - iCarouselWidth)$('#'+sBtnNext).css("visibility","hidden");
				
				$('#'+sBtnPrev).css("visibility","visible");
			}
		}
	);
	
	$('#'+sBtnPrev).click(
		function() {
			if (iCurrent <= 0) {
				$('#'+sBtnPrev).css("visibility","hidden");
				return;
			}else{
				iCurrent = iCurrent - (iCarouselWidth);
				
				$('#'+sCarouselType+' ul').animate(
					{left: -(iCurrent)},
					iSpeed,
					null
				);
				
				if (iCurrent <= 0) $('#'+sBtnPrev).css("visibility","hidden");
				
				$('#'+sBtnNext).css("visibility","visible");
			}

		}
	);
}

function Tutor_LoadQuestionStat(){
	var sStatType = (iTutorEnrollStatus == 1) ? "child":"all";
	
	$.post(
		hud_sBasePath+"askeet/hud/callback/stat/"+sStatType,
		{ func: "question_stat" },
		function(sReply){
			var iChildrenCount = sReply.CHILDREN_WITH_QUESTIONS;
			var iChildrenQuestionCount = sReply.CHILDREN_WITH_QUESTIONS_ALL_QUESTIONS;
			var sChildChildren = (iChildrenCount > 1) ? "children":"child";
			var sStatAllNotice = iChildrenCount + " " + sChildChildren + " have asked " + ((iTutorEnrollStatus == 0) ? "a total of ":"") + iChildrenQuestionCount + " question(s) already.";
			
			$("span[id^=tutor_question_stat_all]").each(
				function (){
					$(this).text(sStatAllNotice);
				}
			);
			
			if (iTutorEnrollStatus == 1){
				$("span[id^=tutor_child_question_count]").each(
					function (){
						$(this).text(sReply.CHILD_QUESTIONS);
					}
				);
				
				$("#tutor_child_money_spent").text(sReply.CHILD_MONEY_SPENT);
				
				var sOpenCatAll = '';
				var aChildOpenCat = sReply.CHILD_OPEN_QUESTIONS_CAT;
				
				for (sCatKey in aChildOpenCat){
					sOpenCatAll += '<li class="li_c"><a href="#tutor_questions" onclick="_Tutor_GetOpenQuestion(\'' + sCatKey + '\')">' + sCatKey + ' (' + aChildOpenCat[sCatKey] + ')</a></li>';
				}
				
				$("ul#tutor_open_cat_child").html(sOpenCatAll);
				$("#tutor_open_questions_child").show();
				$("#tutor_open_questions_all").hide();
				
				Tutor_DoCarousel('cat_carousel', 'btnnext_c', 'btnprev_c');
				
				var sTutorsWhoAnswered = '';
				var aTutorsWhoAnswered = sReply.TUTORS_WHO_ANSWERED;
				
				for (i=0; i<aTutorsWhoAnswered.length; i++){
					var oTutor = aTutorsWhoAnswered[i];
					sTutorsWhoAnswered += '<li class="li_c"><a href="#tutor_questions" onclick="_Tutor_GetTutorAnswers(\'' + oTutor.USER + '\', ' + oTutor.ID + ', \'answer\')">' + oTutor.USER + ' (' + oTutor.COUNT + ')</a></li>';
				}
				
				$("#tutor_who_answered").html(sTutorsWhoAnswered);
				
				Tutor_DoCarousel('answered_carousel', 'btnnext_a', 'btnprev_a');
				Tutor_GetTutorCatStat();
			}else{
				var sOpenCatAll = '';
				
				for (sCatKey in sReply.CHILDREN_OPEN_QUESTIONS_CAT){
					sOpenCatAll += '<li><a href="#">'+sCatKey+'</a></li>';
				}
				
				$("ul#tutor_open_cat_all").html(sOpenCatAll);
			}
		},
		"json"
	);
}

function Tutor_GetDetails(){
	$.post(
		hud_sBasePath+"askeet/hud/callback/details",
		{ func: "tutor_post_details" },
		function(sReply){
			var iOffset = ((GetWindowWidth()-253)/2)-287;
			var sNotice = "";
			
			iTutorAskeetId = sReply.ID;
			iTutorPostToday = sReply.POST_TODAY;
			iTutorMaxPostPerDay = sReply.POST_PER_DAY;
			mTutorPostCost = sReply.POST_COST;
			iTutorPostLeft = sReply.POST_LEFT_TODAY;
			
			if (iTutorPostLeft > 0){
				if (mBankBalance >= mTutorPostCost){
					$("#tutor_preview_post_cost").text(mTutorPostCost);
					$("#tutor_preview_post_left").text(iTutorPostLeft);
				}else{
					sNotice = "Your current balance is $ "+mBankBalance+". You do not have enough Valiant to post an Instant Question.<br/><br/>";
					sNotice += "To post an Instant Question, you should have, at least, $ "+mTutorPostCost+" in your bank account.";
				}
			}else{
				sNotice = "You already posted "+iTutorPostToday+" Instant Questions, which is the maximum, for the day.<br/><br/>";
				sNotice += "Try to post your question(s) tomorrow.";
			}
			
			if (sNotice != ""){
				$("#tutor_preview").css("left", iOffset+"px").show();
				$("#tutor_notice_content").html('<div class="report_input_btm_text_4_5" style="font-size:0.9em;">'+sNotice+'</div>').show();
				$("#tutor_preview_content").hide();
			}
		},
		"json"
	);
}

function Tutor_GetTutorCatStat(){
	$.post(
		hud_sBasePath+"askeet/hud/callback/tutors",
		{ func: "tutor_cat_stat" },
		function(sReply){
			var sCatWithTutors = '';
		
			for (sCatKey in sReply.CAT_STATS){
				sCatWithTutors += '<li><a href="javascript:void(0);" onclick="_Tutor_GetOpenQuestion(' + "'" + sCatKey + "'" +')">' + sCatKey + ' (' + sReply.CAT_STATS[sCatKey] + ')</a></li>';
			}
			
			$("#tutor_total_tutor").text(sReply.TOTAL_TUTORS);
			$("#tutor_cat_stats").html(sCatWithTutors);
			$("#tutor_announcement_all").hide();
			$("#tutor_announcement_child").show();
		},
		"json"
	);
}

function Tutor_PopulateCat(oContainer, iIdVal, oContainerToNull){
	if (oContainerToNull == null){
		// do nothing
	}else{
		$(oContainerToNull).each(
			function(){
				$(this).html('<optgroup label="No sub-category selected"></optgroup>');
			}
		);
	}
	
	$.post(
		hud_sBasePath+"askeet/question/cat",
		{ id: iIdVal },
		function(sReply){
			var sOptions = "";
			
			if (sReply.length > 0){
				for (i=0; i<sReply.length; i++){
					sTitle = sReply[i].TITLE;
					sTitle += (sReply[i].LEAF == 0) ? " >":"";
					
					sOptions += '<option value="'+sReply[i].ID+'" title="'+sTitle+'">'+sTitle+'</option>';
				}
			}else{
				sOptions += '<optgroup label="No sub-categories"></optgroup>';
			}
			
			$(oContainer).each(
				function (){
					$(this).html(sOptions);
				}
			);
		},
		"json"
	);
}

function Tutor_SetFormButtons(){
	$("#tutor_ask_form_post")
		.unbind("click")
		.click(
			function (){
				Tutor_ValidateForm();
			}
		);
	
	$("#tutor_ask_form_cancel")
		.unbind("click")
		.click(
			function (){
				ToggleContent("tutoring_start");
			}
		);
	
	$("#tutor_preview_post")
		.unbind("click")
		.click(
			function (){
				$.post(
					hud_sBasePath+"askeet/enroll/form/process",
					{
						q: $("#tutor_form_question").val(),
						b: $("#tutor_form_question_desc").val(),
						t: $("#tutor_form_question_tag").val(),
						c: $("#tutor_form_question_cost").val(),
						i: iTutorCatId
					},
					function(sReply){
						if (sReply.STATUS == "Success"){
							$("#tutor_notice_content").html('<div class="report_input_btm_text_4_5" style="font-size:0.9em;">Your question have been posted successfully.</div>').show();
							
							Tutor_GetDetails();
							Tutor_LoadQuestionStat();
							Tutor_GetQuestions(hud_sBasePath+"askeet/hud/callback/question/latest", "latest");
							
							setTimeout('$("#tutor_preview").hide();$("#tutor_notice_content").hide()', 3000);
						}else{
							var iOffset = ((GetWindowWidth()-253)/2)-287;
							
							$("#tutor_preview").css("left", iOffset+"px").show();
							$("#tutor_notice_content").html('<div class="report_input_btm_text_4_5" style="font-size:0.9em;">'+sReply.STATUS+'</div>').show();
						}
					},
					"json"
				);
			}
		);
	
	$("#tutor_preview_edit")
		.unbind("click")
		.click(
			function (){
				$("#tutor_preview").hide();
				$("#tutor_preview_content").hide();
			}
		);
}

function Tutor_ValidateForm(){
	iTutorCatId = $("#volunteer_iGroupId").val();
	
	if (jQuery.trim($("#tutor_form_question").val()) == ""){
		alert("You have to specify a question first before you can preview it.");
	}else if (iTutorCatId == 0){
		alert("Please select a category. A category with sub-categories is not a valid selection.");
	}else{
		$("#tutor_preview_question_cat").load(hud_sBasePath+"mystudies/getinvolved/full/cat/"+iTutorCatId)
		$("#tutor_preview_question").text($("#tutor_form_question").val());
		$("#tutor_preview_question_desc").html($("#tutor_form_question_desc").val());
		$("#tutor_preview_post_cost").text($("#tutor_form_question_cost").val());
		
		var iOffset = ((GetWindowWidth()-253)/2)-287;
		
		$("#tutor_preview").css("left", iOffset+"px").show();
		$("#tutor_preview_content").show();
	}
}

function Tutor_GetAnswers(sStrippedTitle){
	iTutorPageStart = 0;
	iTutorPageEnd = iTutorPageRec;
	
	$("input[id^=btnTutor]").each(
		function (){
			$(this).hide();
		}
	);
	
	$("#tutor_answer_form_cancel_button")
		.unbind("click")
		.click(
			function (){
				$("#tutor_answer_form").hide();
				Tutor_GetQuestions(hud_sBasePath+"askeet/hud/callback/question/popular", "popular");
			}
		);
	
	var iOffset = ((GetWindowWidth()-446)/2)+130;
	$("#tutor_answer_form").css("left", iOffset+"px").show();
	
	$.post(
		hud_sBasePath+"askeet/hud/callback/question/view/"+sStrippedTitle,
		{ func: "get_answers" },
		function (sReply){
			var sOutput = sReply.QUESTION;
			var aAnswers = sReply.ANSWERS;
			var iRecCount = aAnswers.length;
			var iQuestionId = sReply.QUESTION_ID;
			
			$("#tutor_answer_form_post_button")
				.unbind("click")
				.click(
					function (){
						Tutor_PostAnswer(sStrippedTitle, iQuestionId, $("#askeet_post_answer").val());
					}
				);
			
			oQuestionRecs = aAnswers;
			sOutput += '<div id="tutor_question_answers">';
			
			if (aAnswers.length > 0){
				for (i=iTutorPageStart; i<iTutorPageEnd && i<iRecCount; i++){
					sOutput += aAnswers[i];
				}
			}else{
				sOutput += '<div class="report_right_text_area_4_3"><div class="report_input_btm_text_4_3">No records to list for now.</div></div>';
			}
			
			sOutput += '</div>';
			var sPageButton = '<div style="position:relative; left:230px; top:10px"><input id="btnTutorAnswerPrev" type="image" src="hud_files/images/tutor_scroll_up.png" style="width:18px; height:18px; border:none;" onclick="_Tutor_PageAnswer(\'prev\', '+iRecCount+')" /></div>';
			sPageButton += '<div style="position:relative; left:230px; top:245px;"><input id="btnTutorAnswerNext" type="image" src="hud_files/images/tutor_scroll_down.png" style="width:18px; height:18px; border:none;" onclick="_Tutor_PageAnswer(\'next\', '+iRecCount+')" /></div>';
			
			sOutput = (iRecCount > iTutorPageRec) ? sPageButton+sOutput:sOutput;
			
			$("div[id^=tutor_questions]").each(
				function (){
					$(this).html(sOutput);
				}
			);
			
			$("#askeet_close_question")
				.hover(
					function(){
						$(this).css("cursor", "pointer");
					},
					function(){
						$(this).css("cursor", "default");
					}
				)
				.click(
					function(){
						var bConfirm = confirm("Are you sure you want to close this question?");
						
						if (bConfirm){
							$.post(
								hud_sBasePath+"askeet/question/close",
								{
									id: iQuestionId
								},
								function(sReply){
									if (sReply.STATUS == "Success"){
										$("#askeet_close_question").text("[you have closed this question]").css("width", "170px");
										$("#askeet_close_question").unbind("click").unbind("hover");
										Tutor_LoadQuestionStat();
									}else{
										alert(sReply.ERRMSG+": "+sReply.SQL);
									}
								},
								"json"
							);
						}
					}
				);
			
			if (iRecCount > 0){
				$("input[id^=btnTutorAnswerPrev]").each(
					function (){
						if (iTutorPageStart == 0){
							$(this).hide();
						}else{
							$(this).show();
						}
					}
				);

				$("input[id^=btnTutorAnswerNext]").each(
					function (){
						if (iTutorPageEnd == iRecCount){
							$(this).hide();
						}else{
							$(this).show();
						}
					}
				);
			}
		},
		"json"
	);
}

function _Tutor_PageAnswer(sDirection, iTotalRec){
	if (sDirection == "next"){
		iTutorPageStart += iTutorPageRec;
		iTutorPageEnd += iTutorPageRec;
		
		if (iTutorPageEnd > iTotalRec) iTutorPageEnd = iTotalRec;
	}else{
		iTutorPageStart -= iTutorPageRec;
		
		iOffSet = iTutorPageEnd % iTutorPageRec;

		if (iOffSet == 0){
			iTutorPageEnd -= iTutorPageRec;
		}else{
			iTutorPageEnd -= iOffSet;
		}
		
		if (iTutorPageStart < 0) iTutorPageStart = 0;
	}
	
	var sOutput = '';
	
	for (i=iTutorPageStart; i<iTutorPageEnd && i<iTotalRec; i++){
		sOutput += oQuestionRecs[i];
	}
	
	$("div[id^=tutor_question_answers]").each(
		function (){
			$(this).html(sOutput);
		}
	);
	
	$("input[id^=btnTutorAnswerPrev]").each(
		function (){
			if (iTutorPageStart == 0){
				$(this).hide();
			}else{
				$(this).show();
			}
		}
	);

	$("input[id^=btnTutorAnswerNext]").each(
		function (){
			if (iTutorPageEnd == iTotalRec){
				$(this).hide();
			}else{
				$(this).show();
			}
		}
	);
}

function Tutor_PostAnswer(sStrippedTitle, iQuestionId, sAnswer){
	$.post(
		hud_sBasePath+"askeet/answer/process",
		{
			id: iQuestionId,
			ans: sAnswer
		},
		function(sReply){
			if (sReply.STATUS == "Success"){
				Tutor_GetAnswers(sStrippedTitle);
				$("#askeet_post_answer").val("");
			}else{
				alert(sReply.ERRMSG);
			}
		},
		"json"
	);
}
// ------------------------------------------------------------
// --END Instant Tutoring functions



// --BEGIN Kindness functions
// ------------------------------------------------------------

function Kindness_ApproveTitle2(id){
	document.getElementById('KSPopUp').style.display = 'block';
	document.getElementById('KSPopUpOverlay').style.display = 'block';
$.ajax({
		url: 'kindness/details2/' + id + '/true/' + $("#env_pop").val(),
		  dataType: 'text',
		  success: function(data) {
			$("#hud_KSText").html(data);
			document.getElementById('KSPopUpOverlay').style.display = 'none';

		  },
		  error: function() {
			$("#hud_KSText").html("There was a problem with your request<br />"); 
			document.getElementById('KSPopUpOverlay').style.display = 'none';
		  }
		});

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
			$('#kindness_total_hours_mobile').text($('#kindness_total_hours').text());
			$('#kindness_total_wgold_mobile').text($('#kindness_total_wgold').text());
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
        var unique_kindness_report_id = $("#unique_kindness_report_id").val();
        
	
		
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
				iKindnessYear: iKindnessYear,
                                unique_kindness_report_id : unique_kindness_report_id

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
        var url = window.location.href;
        var split = url.split('#');
        var url = split[0];
      url = url+'#kindness_form_v2'; //redirect to same page
    window.location.href = url;
	}
		
}

function Kindness_SetFormSubmit_v2_mobile(){
	let workz_form_v2 = $('#workz_form_v2_mobile').serializeArray();

	$('#hud-loading').show();
	var formData = new FormData();

	for(let i in workz_form_v2){
		formData.append(workz_form_v2[i]['name'], workz_form_v2[i]['value']);
	}

	$.ajax({
        url: hud_sBasePath+"kindness-v2/callback/form", // le nom du fichier indiqué dans le formulaire
        type: 'POST', // la méthode indiquée dans le formulaire (get ou post)
        cache : false,
		dataType    : 'json',
		processData : false,
        contentType : false,
        data: formData ,
        success: function(sReply) { // je récupère la réponse du fichier PHP
			// return;
            if (sReply.STATUS == "Success"){
				Bank_GetDetails();
				// $("#btnKindnessSubmit").text("Submit Kindness Form").attr("disabled", "");
				$('#workz-type_mobile').val('').trigger('change')
				$('.benefactor-container-fields').show();
				$('#workz_form_v2_mobile')[0].reset();
				$('#b2-previous-button-mobile').click();
				$('#workz-picture_mobile-preview-container').hide();
				//TODO
				// $('#benefactor-picture-preview-container').hide();
				// $('#beneficiary-picture-preview-container').hide();
				// $('#workz-picture-preview-container').hide();
			}
		
			$('#hud-loading').hide();
			alert(sReply.RETURN);
        }        
        //return false; //
    }); 

	// $.post(
	// 	hud_sBasePath+"kindness-v2/callback/form",
	// 	formData,
	// 	function(sReply){
	// 		if (sReply.STATUS == "Success"){
	// 			Bank_GetDetails();
				
	// 			// $("#btnKindnessSubmit").text("Submit Kindness Form").attr("disabled", "");
	// 			$('#workz_form_v2')[0].reset();
	// 			$('#b2-previous-button').click();
	// 		}
		
	// 		$('#hud-loading').hide();
	// 		alert(sReply.RETURN);
                         
	// 	},
	// 	"json"
	// );
}

function Kindness_SetFormSubmit_v2_mobile_edit(){
	let workz_form_v2 = $('#edit_workz_form_v2_mobile').serializeArray();
	let workz_id = $('[name="edit_workz_id"]').val();
	$('#hud-loading').show();
	var formData = new FormData();

	for(let i in workz_form_v2){
		formData.append(workz_form_v2[i]['name'], workz_form_v2[i]['value']);
	}

	$.ajax({
        url: hud_sBasePath+"kindness/update-information/" + workz_id, // le nom du fichier indiqué dans le formulaire
        type: 'POST', // la méthode indiquée dans le formulaire (get ou post)
        cache : false,
		dataType    : 'json',
		processData : false,
        contentType : false,
        data: formData ,
        success: function(sReply) {
        	$('#editWorkzPopUpOverlay').hide();
        	$('#editWorkzPopUp').hide();
        	alert('You successfully updated the workz information!');
        	document.getElementById('KSPopUp').style.display = 'none';
        	document.getElementById('KSPopUpOverlay').style.display = 'none';
        	
        	setTimeout(function(){

        		//All Workz
        		if ($('.active[target="pending_workz_list_container"]').length > 0) {
        			setAllWorkzList('pending');
        			document.getElementById('all-workz-map').contentWindow.location.reload();
        		}

        		if ($('.active[target="approved_workz_list_container"]').length > 0) {
					setAllWorkzList('approved');
					document.getElementById('all-workz-map').contentWindow.location.reload();
        		}

        		//Reviewer List
        		if ($('.active[target="reviewer_pending_workz_container"]').length > 0) {
        			setReviewerList('pending');
        		}

        		if ($('.active[target="reviewer_disapproved_workz_container"]').length > 0) {
        			setReviewerList('approved');
        		}

        		if ($('.active[target="reviewer_approved_workz_container"]').length > 0) {
        			setReviewerList('disapproved');
        		}

        		//Reporter List
        		if ($('.active[target="my_staus"]').length > 0) {
        			Kindness_GetApproved();
        		}

        		if ($('.active[target="my_benefactor_status"]').length > 0) {
        			Kindness_GetApproved_benefactors();
        		}


        		//Boster List

        		if ($('.active[target="booster_available_workz_container"]').length > 0) {
        			setBoosterList('available');
        		}

        		if ($('.active[target="booster_boosted_workz_container"]').length > 0) {
        			setBoosterList('boosted');
        		}

        		if ($('.active[target="booster_waiting_workz_container"]').length > 0) {
        			setBoosterList('waiting');
        		}

        		setTimeout(function(){
					$('.workz-mobile-column-clickable[kindness_id="'+ workz_id +'"]').click();
					$('#hud-loading').hide();
	        	}, 1000)
        	}, 1000)
			
        }        
        //return false; //
    }); 

	// $.post(
	// 	hud_sBasePath+"kindness-v2/callback/form",
	// 	formData,
	// 	function(sReply){
	// 		if (sReply.STATUS == "Success"){
	// 			Bank_GetDetails();
				
	// 			// $("#btnKindnessSubmit").text("Submit Kindness Form").attr("disabled", "");
	// 			$('#workz_form_v2')[0].reset();
	// 			$('#b2-previous-button').click();
	// 		}
		
	// 		$('#hud-loading').hide();
	// 		alert(sReply.RETURN);
                         
	// 	},
	// 	"json"
	// );
}

function Kindness_SetFormSubmit_v2(){
	let workz_form_v2 = $('#workz_form_v2').serializeArray();

	$('#hud-loading').show();
	var formData = new FormData();

	for(let i in workz_form_v2){
		formData.append(workz_form_v2[i]['name'], workz_form_v2[i]['value']);
	}

	$.ajax({
        url: hud_sBasePath+"kindness-v2/callback/form", // le nom du fichier indiqué dans le formulaire
        type: 'POST', // la méthode indiquée dans le formulaire (get ou post)
        cache : false,
		dataType    : 'json',
		processData : false,
        contentType : false,
        data: formData ,
        success: function(sReply) { // je récupère la réponse du fichier PHP
			// return;
            if (sReply.STATUS == "Success"){
				Bank_GetDetails();
				// $("#btnKindnessSubmit").text("Submit Kindness Form").attr("disabled", "");
				$('#workz-type').val('').trigger('change');
				$('.benefactor-container-fields').show();
				$('#workz_form_v2')[0].reset();
				$('#b2-previous-button').click();
				$('#benefactor-picture-preview-container').hide();
				$('#beneficiary-picture-preview-container').hide();
				$('#workz-picture-preview-container').hide();
			}
		
			$('#hud-loading').hide();
			alert(sReply.RETURN);
        }        
        //return false; //
    }); 

	// $.post(
	// 	hud_sBasePath+"kindness-v2/callback/form",
	// 	formData,
	// 	function(sReply){
	// 		if (sReply.STATUS == "Success"){
	// 			Bank_GetDetails();
				
	// 			// $("#btnKindnessSubmit").text("Submit Kindness Form").attr("disabled", "");
	// 			$('#workz_form_v2')[0].reset();
	// 			$('#b2-previous-button').click();
	// 		}
		
	// 		$('#hud-loading').hide();
	// 		alert(sReply.RETURN);
                         
	// 	},
	// 	"json"
	// );
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
			
			var sFooterPaged = '<div class="pending_top_txt" style="margin-top:15px"><div class="pending_top_title_1">&nbsp;&nbsp;</div><div class="pending_top_duration_1"><button id="btnPrev" class="button button-blue-gradient" onclick="_Kindness_PageApproved(\'prev\', '+iRecCount+')"><< Previous</button></div><div class="pending_top_date_1" style="text-align:center">&nbsp;<button id="btnNext" class="button button-blue-gradient" onclick="_Kindness_PageApproved(\'next\', '+iRecCount+')">Next >></button></div><div class="pending_top_date_approvd_1">&nbsp;&nbsp;</div></div>';
			var sFooterPlain = '';
			var sFooter = (iRecCount > iPageRec) ? sFooterPaged:sFooterPlain;
			
			$("#kindness_approved_list").html(sContent + sFooter);
			
			if (iPageStart == 0) $("button#btnPrev").hide();
			if (iPageEnd == iRecCount) $("button#btnNext").hide();

			$('#all_workz_count').text(sReply.all_workz_count);
			$('#approved_workz_count').text(sReply.approved_count);
			$('#pending_workz_count').text(sReply.pending_count);
			$('#disapproved_workz_count').text(sReply.disapproved_count);

			$('#all_workz_count_mobile').text(sReply.all_workz_count);
			$('#approved_workz_count_mobile').text(sReply.approved_count);
			$('#pending_workz_count_mobile').text(sReply.pending_count);
			$('#disapproved_workz_count_mobile').text(sReply.disapproved_count);


			$('#workz-list-temporary-container').html(sContent);

			setMobileWorkzContent();
		},
		"json"
	);
}

function setMobileWorkzContent()
{
	let mobile_content_row;
	let kindness_id;

	$('#workz-list-mobile').find('.workz-row-appended').remove();

	$('#workz-list-temporary-container .pending_top_txt').each(function(){
		mobile_content_row = $('#workz-list-row-template').clone();
		mobile_content_row.find('.workz-title-mobile').text($(this).find('.kindness_title').text());
		kindness_id = $(this).find('.pending_top_title_1').find('a').eq(0).attr('kindness_id');
		mobile_content_row.find('.workz-title-mobile').closest('.mobile-table-column').attr('kindness_id', kindness_id)
		mobile_content_row.find('.workz-type-mobile').text($(this).find('.kindness_type').text());
		mobile_content_row.find('.workz-benefactor-mobile').text($(this).find('.pending_top_duration_1').text());
		mobile_content_row.find('.workz-date-mobile').text($(this).find('.pending_top_date_1').text());
		mobile_content_row.find('.workz-status-mobile').text($(this).find('.pending_top_monitor_1').text());

		let workz_certificate_id = $(this).find('.kindness_certificate_list').text().trim();
		if (workz_certificate_id !== '') {

			let workz_cert_field = mobile_content_row.find('.workz-certificate-mobile');
			workz_cert_field.closest('.mobile-table-column').show();
			workz_cert_field.find('a').attr('href', hud_sBasePath + 'kindness/certificate/' + workz_certificate_id);
		}

		mobile_content_row.attr('id', '');
		mobile_content_row.addClass('workz-row-appended');
		mobile_content_row.removeClass('row-template');

		$('#workz-list-mobile').append(mobile_content_row);
	});

	if ($('#workz-list-temporary-container .pending_top_txt').length === 0) {
		$('#workz-list-mobile').find('.no-records-workz').show();
	} else {
		$('#workz-list-mobile').find('.no-records-workz').hide();
	}
}

function Kindness_GetApproved_benefactors(){
	$.post(
		hud_sBasePath+"kindness/callback/workz2_benfactors",
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
			
			var sFooterPaged = '<div class="pending_top_txt" style="margin-top:15px"><div class="pending_top_title_1">&nbsp;&nbsp;</div><div class="pending_top_duration_1"><button id="btnPrev" class="button button-blue-gradient" onclick="_Kindness_PageApproved(\'prev\', '+iRecCount+')"><< Previous</button></div><div class="pending_top_date_1" style="text-align:center">&nbsp;<button id="btnNext" class="button button-blue-gradient" onclick="_Kindness_PageApproved(\'next\', '+iRecCount+')">Next >></button></div><div class="pending_top_date_approvd_1">&nbsp;&nbsp;</div></div>';
			var sFooterPlain = '';
			var sFooter = (iRecCount > iPageRec) ? sFooterPaged:sFooterPlain;
			
			$("#kindness_approved_list").html(sContent + sFooter);
			
			if (iPageStart == 0) $("button#btnPrev").hide();
			if (iPageEnd == iRecCount) $("button#btnNext").hide();

			$('#all_workz_count').text(sReply.all_workz_count)
			$('#approved_workz_count').text(sReply.approved_count)
			$('#pending_workz_count').text(sReply.pending_count)
			$('#disapproved_workz_count').text(sReply.disapproved_count)
			$('#kindness_total_hours').text(sReply.workz_hours)

			$('#all_workz_status_count_mobile').text(sReply.all_workz_count);
			$('#approved_workz_count_mobile').text(sReply.approved_count);
			$('#pending_workz_count_mobile').text(sReply.pending_count);
			$('#disapproved_workz_count_mobile').text(sReply.disapproved_count);
			$('#kindness_total_hours_mobile').text(sReply.workz_hours)
			$('#workz-list-temporary-container').html(sContent);

			// setMobileWorkzContent();
		},
		"json"
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
	
	var sFooterPaged = '<div class="pending_top_txt" style="text-align:center;margin-top:15px;"><button style="margin-right:10px" id="btnPrev" class="button button-blue-gradient"onclick="_Kindness_PageApproved(\'prev\', '+iTotalRec+')"><< Previous</button><button id="btnNext" class="button button-blue-gradient" onclick="_Kindness_PageApproved(\'next\', '+iTotalRec+')">Next >></button></div>';
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



function setName(){
	let first_name = $('[name="first_name"]').val();
	let last_name = $('[name="last_name"]').val();
	$('[name="username"]').val(first_name + ' ' + last_name);
}
// ------------------------------------------------------------
// --END Reusable functions

