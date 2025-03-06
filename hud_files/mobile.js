$(document).ready(function(){
	let workz_share_id = new URLSearchParams(window.location.search)

	if (workz_share_id.get('workz_share_id')) {
		Kindness_ApproveTitle2(workz_share_id.get('workz_share_id'));
	}

	$('.mobile-menu-action').click(function(){
		if($(this).hasClass('fa-bars')){
			$('.mobile-menu-action.fa-close').show();
			$('.mobile-menu-action.fa-bars').hide();
			$('#mobile-menu-open-wrapper').show();
			$('.mobile-wrapper').hide();

			if ($('#mobile-header-container-menu-open').length > 0 ) {

				$('#mobile-header-container').hide();
				$('#mobile-header-container-menu-open').css({
					'display': 'flex'
				});
			}
		}else if($(this).hasClass('fa-close')){
			$('.mobile_navigation_footer_element[target="hope_home_1st_hope_corps"]').click();
			// $('.mobile-menu-action.fa-close').hide();
			// $('.mobile-menu-action.fa-bars').show();
			// $('#mobile-menu-open-wrapper').hide();
			// $('.mobile-wrapper').show();

			// if ($('#mobile-header-container-menu-open').length > 0 ) {
			// 	$('#mobile-header-container').show();
			// 	$('#mobile-header-container-menu-open').hide();
			// }
		}
	});

	$('.mobile-hud-menu').click(function(){
		let toggleElement = $(this).attr('toggle-element');
		$('.mobile_navigation_footer_element').removeClass('active');

		$('.mobile-content-wrapper').hide()
		$('.' + toggleElement).show();

		$('.mobile-menu-action.fa-close').hide();
		$('.mobile-menu-action.fa-bars').show();
		$('#mobile-menu-open-wrapper').hide();
		$('#mobile-header-container').show();
		$('#mobile-header-container-menu-open').hide();
		
		$('.mobile-wrapper').show();
		if(toggleElement == 'citation_mobile_container'){
			$('.mobile_navigation_middle_element[target="citation_workz"]').click();
		}else if(toggleElement == 'rewards_mobile_container'){
			$('.mobile_navigation_middle_element[target="reward_about"]').click();
		}else if(toggleElement == 'members_mobile_container'){
			$('.mobile_navigation_middle_element[target="members_about"]').click();
		}else if(toggleElement == 'reviewer_dashboard_mobile_container'){
			setReviewerDashboardData();
			$('#mobile_navigation_middle_element_reviewer').addClass('active');
		}else if(toggleElement == 'booster_dashboard_mobile_container'){
			// Set data here
			setBoosterDashboardData()
			$('#mobile_navigation_middle_element_booster').addClass('active');
		}else if(toggleElement == 'reviewer_assigned_samaritan_mobile_container'){
			getAssignedSmaritanForReviewer();
		}

		$('.mobile_navigation_footer_element[target="'+ toggleElement +'"]').addClass('active');
	});

	$('.reviewer-column-link a').click(function(e){
		e.preventDefault();

		let target = $(this).attr('target');

		$('.mobile-hud-menu[toggle-element="'+ target +'"]').click();
		if (target === 'reviewer_workz_list_mobile_container' || target === 'booster_workz_list_mobile_container') {
			let target_workz_list = $(this).attr('target_workz_list');

			$('.mobile_navigation_middle_element[target="'+ target_workz_list +'"]').click();
		}

		if (target === 'reviewer_workz_list_mobile_container' || target === 'reporter_workz_list_mobile_container' || target === 'samaritan_workz_list_mobile_container') {
			let target_workz_list = $(this).attr('target_workz_list');

			$('.mobile_navigation_middle_element[target="'+ target_workz_list +'"]').click();
		}

		if (target === 'reviewer_requested_samaritan_mobile_container') {
			$.ajax({
		        url: "kindness/reviewer/anonymous-samaritan-status",
		        type: 'GET',
		        success: function(sReply) {
		        	let isChecked = sReply == 1 ? true : false;
		        	$('#kindness_mentor_hopefuls_count').val($('#review-dashboard-requested-samaritan').text());
		        	$('[name="review_anonymous_citation"]').attr('checked', isChecked)
		        }        
		    }); 
		}
	});

	$('.mobile_navigation_middle_element').click(function(){
		let target = $(this).attr('target');

		$('.mobile_navigation_middle_element').removeClass('active');
		$(this).addClass('active');

		$('.navigation_middle_target_container').hide();
		$('.navigation_middle_target_container#'+target).show();

		if (target == 'citation_status') {
			$('.citation_status_navigation_header[target="my_benefactor_status"]').click();
		}

		if (target == 'citation_report') {
			$('[name="is_benefactor_same_user"]').attr('checked', false).change();
		}

		if (target == 'reward_statement') {
			Bank_GetStatement();
		}

		if (target == 'reviewer_pending_workz_container') {
			$('#reviewer_mobile_workz_list_type_title').text('Pending Workz');
			setReviewerList('pending');
		}

		if (target == 'reviewer_approved_workz_container') {
			$('#reviewer_mobile_workz_list_type_title').text('Approved Workz');
			setReviewerList('approved');
		}

		if (target == 'reviewer_disapproved_workz_container') {
			$('#reviewer_mobile_workz_list_type_title').text('Dispproved Workz');
			setReviewerList('disapproved');
		}

		if (target == 'booster_available_workz_container') {
			$('#booster_mobile_workz_list_type_title').text('Workz Available for Boosting');
			setBoosterList('available');
		}

		if (target == 'booster_boosted_workz_container') {
			$('#booster_mobile_workz_list_type_title').text('Workz You Have Boosted');
			setBoosterList('boosted');
		}

		if (target == 'booster_waiting_workz_container') {
			$('#booster_mobile_workz_list_type_title').text('Workz Waiting For A Booster');
			setBoosterList('waiting');
		}
		if (target == 'reporter_reports_filed_available_workz_container') {
			$('#reporter_mobile_workz_list_type_title').text('Reports Filed');
			setReporterList('reports-filed');
		}
		if (target == 'reporter_reports_approved_available_workz_container') {
			$('#reporter_mobile_workz_list_type_title').text('Reports Approved');
			setReporterList('reports-approved');
		}
		if (target == 'reporter_reports_pending_available_workz_container') {
			$('#reporter_mobile_workz_list_type_title').text('Reports Pending');
			setReporterList('reports-pending');
		}
		if (target == 'reporter_reports_disapproved_available_workz_container') {
			$('#reporter_mobile_workz_list_type_title').text('Reports Disapproved');
			setReporterList('reports-disapproved');
		}

		if (target == 'reporter_reports_samaritan_container') {
			$('#reporter_mobile_workz_list_type_title').text('Samaritan Reported');
			setReporterList('reports-samaritan');
		}

		if (target == 'samaritan_pending_workz_container') {
			$('#samaritan_mobile_workz_list_type_title').text('Pending Workz');
			setSamaritanList('pending');
		}

		if (target == 'samaritan_approved_workz_container') {
			$('#samaritan_mobile_workz_list_type_title').text('Approved Workz');
			setSamaritanList('approved');
		}

		if (target == 'citation_workz') {
			$('.workz_list_tab_header[target="approved_workz_list_container"]').click();
			document.getElementById('all-workz-map').contentWindow.location.reload();
		}

		if (target == 'citation_news') {
			setNewsList();
		}

		let reviewerDashboardNav = $('.mobile-hud-menu[toggle-element="reviewer_dashboard_mobile_container"]').eq(0);
		let boosterDashboardNav = $('.mobile-hud-menu[toggle-element="booster_dashboard_mobile_container"]').eq(0);
		if (target == 'reviewer_dashboard') {
			reviewerDashboardNav.click();
		}

		if (target == 'mentor_dashboard') {
			boosterDashboardNav.click();
		}

		if (target == 'citation_samaritan') {
			setSamaritanCount();
		}
	});

	$('.workz_list_tab_header').click(function(){
		let target = $(this).attr('target');

		$('.workz_list_tab_header').removeClass('active');
		$(this).addClass('active');

		$('.workz_list_container').hide();
		$('.workz_list_container#'+target).show();

		if (target === 'pending_workz_list_container') {
			setAllWorkzList('pending');
		}

		if (target === 'approved_workz_list_container') {
			setAllWorkzList('approved');
		}
	});

	$('.mobile_navigation_footer_element').click(function(){
		let target = $(this).attr('target');

		$('.mobile_navigation_footer_element').removeClass('active');
		$(this).addClass('active');

		$('.mobile-hud-menu[toggle-element="'+ target +'"]').click();
		$("html, body").animate({ scrollTop: 0 }, "fast");
	});

	$('.citation_reporter_middle_element').click(function(e){
		$('.citation_reporter_dropdown_nav').toggle();
		if($(event.target).attr('target') != 'citation_report'){
			goToSamaritanStatus(e)
		}
	});

	$('body').click(function(event){
		if(event){
			if($(event.target).closest('.citation_reporter_middle_element').length === 0){
				$('.citation_reporter_dropdown_nav').hide();
			}
		}
	});

	$('.citation_status_navigation_header').click(function(){
		let target = $(this).attr('target');

		$('.citation_status_navigation_header').removeClass('active');
		$(this).addClass('active');

		// Kindness_GetDashboard();

		if(target == 'my_staus'){
			Kindness_GetApproved();
		}else if(target == 'my_benefactor_status'){
			Kindness_GetApproved_benefactors();
		}
	});

	$('.members-info-details').click(function(){
		let target = $(this).attr('target');

		$('.mobile_navigation_middle_element[target="'+ target +'"]').click();
	});

	$('.back-to-dashboard').click(function(){
		$('.mobile-hud-menu[toggle-element="reviewer_dashboard_mobile_container"]').click();
	});

	$('.back-to-booster-dashboard').click(function(){
		$('.mobile-hud-menu[toggle-element="booster_dashboard_mobile_container"]').click();
	});

	$('.back-to-reporter-dashboard').click(function(){
		goToSamaritanStatus();
	});

	$('.back-to-samaritan-dashboard').click(function(event){
		goToSamaritanDashboard(event)
	});

	$('#approve-workz').click(function(){
		let workz_ids = getSelectedWorkzIds(this);

		if (workz_ids.length === 0) {
			alert('Please select workz');return;
		}

		$('#kindnessProcessCommentTitle').text('Comment for approving the selected Workz(s):')
		$('#KSPopUpOverlay').show();
		$('#kindnessProcessCommentPopUp').show();

		$('#submit-process-workz').attr('workz-to-process', JSON.stringify(workz_ids));
		$('#submit-process-workz').attr('approve', 1);
	});

	$('.boost_citation_popup').live('click', function(){
		let workz_ids = [$(this).attr('citation_id')];
		$('#KSPopUpOverlay').show();
		$('#kindnessBoosterCommentPopUp').show();

		$('#boost-workz').attr('workz-to-process', JSON.stringify(workz_ids));
	});

	$('.citation-report-social-actions.like').live('click', function(){
		let workz_id = $(this).attr('rel');
		let self = this;
		let anonymous_unlike = false;
		if ($(this).hasClass('active') && uid == 0) {
			anonymous_unlike = true;
		}
		$.ajax({
	        url: "/kindness/react/"+ workz_id +"/like",
	        type: 'POST',
	        data: {
	        	'anonymous_unlike': anonymous_unlike
	        } ,
	        dataType : 'json',
	        success: function(sReply) {
	        	if (sReply.is_liked === true) {
	        		$(self).addClass('active');
				}else{
					$(self).removeClass('active');
				}

				$(self).find('span').text(sReply.like_count);
	        }
		});
	});

	$('.citation-report-social-actions.share').live('click', function(){

		let workz_id = $(this).attr('rel');
		let url = hud_sUrl + '?workz_share_id=' + workz_id + '&social_share=1';

		$('#share-link-url-text').val(url);

		$('#shareWorkzPopUp').show()
		$('#KSPopUpOverlay').show();
	});

	$('.social-container button.fb').live('click', function(){
		let url = $('#share-link-url-text').val();

		shareToFacebook(url);
	});

	$('.news-item').live('click', function(){
		let url = $(this).attr('src')

		window.open(url, '_blank');
	});

	$('.social-container button.twitter').live('click', function(){
		let url = $('#share-link-url-text').val();

		shareToTwitter(url);
	});

	$('.social-container button.mail').live('click', function(){
		let url = $('#share-link-url-text').val();

		shareToMail(url);
	});

	$('.workz-reporter-message').live('click', function(){
		messageFromReviewer(this, 'Reporter');
	});

	$('.workz-samaritan-message').live('click', function(){
		messageFromReviewer(this, 'Samaritan');
	});

	$('.workz-beneficiary-message').live('click', function(){
		messageFromReviewer(this, 'Beneficiary');
	});

	$('#messageFromReviewer').click(function(){
		let workz_id = $(this).attr('citation_id');
		let type = $(this).attr('user_type');
		$('#hud-loading').show();
		$.ajax({
	        url: "/kindness/message-from-reviewer/" + workz_id + "/" + type, // le nom du fichier indiqué dans le formulaire
	        data: {
	        	'message' : $('#kindnessReviewerMessageText').val()
	        },
	        type: 'POST',
	        success: function(sReply) {
	        	$('#hud-loading').hide();
	        	alert('Message Sent to '+ type +'!');
	        	document.getElementById('KSPopUp').style.display = 'none';
	        	document.getElementById('KSPopUpOverlay').style.display = 'none';
	        	document.getElementById('messageFromReviewerPopUp').style.display = 'none';
	        }
		});
	});

	$('#disapprove-workz').click(function(){
		let workz_ids = getSelectedWorkzIds(this);

		if (workz_ids.length === 0) {
			alert('Please select workz');return;
		}

		$('#kindnessProcessCommentTitle').text('Comment for disapproving the selected Workz(s):')
		$('#KSPopUpOverlay').show();
		$('#kindnessProcessCommentPopUp').show();
		
		$('#submit-process-workz').attr('workz-to-process', JSON.stringify(workz_ids));
		$('#submit-process-workz').attr('approve', 0);
	});

	$('.delete-workz').click(function(){
		let workz_ids = getSelectedWorkzIds(this);
		if (workz_ids.length === 0) {
			alert('Please select workz');return;
		}
		let container = $(this).closest('.navigation_middle_target_container');
		if (confirm("Are you sure you want to delete selected workz?") === true) {
		  	$.ajax({
		        url: "/kindness/callback/delete",
		        type: 'POST',
		        data: {
		        	'workz_to_delete': workz_ids
		        } ,
		        success: function(sReply) {
		        	alert('Workz has been deleted!');

		        	if (container.attr('id') == 'reviewer_pending_workz_container') {
		        		$('.mobile_navigation_middle_element[target="reviewer_pending_workz_container"]').click();
		        	} else if (container.attr('id') == 'reviewer_approved_workz_container') {
		        		$('.mobile_navigation_middle_element[target="reviewer_approved_workz_container"]').click();
		        	} else if (container.attr('id') == 'reviewer_disapproved_workz_container') {
		        		$('.mobile_navigation_middle_element[target="reviewer_disapproved_workz_container"]').click();
		        	}
		        }        
		    }); 
		}
	});

	$('#request-samaritan').click(function(e){
		e.preventDefault();
		$.ajax({
	        url: "kindness/reviewer/request-samaritan",
	        type: 'POST',
	        data: {
	        	'kindness_mentor_hopefuls_count': $('#kindness_mentor_hopefuls_count').val(),
	        	'review_anonymous_citation': $('[name="review_anonymous_citation"]').attr('checked')
	        } ,
	        success: function(sReply) {
	        	sReply = JSON.parse(sReply);

	        	$('#KSPopUpOverlay').show();
				$('#requestSamaritanPopup').show();

				if (parseInt(sReply.iHopefulToAdd) > 0) {
					$('#samaritanRequestedMessage').text('You have requested '+ sReply.iHopefulToAdd +' number of Samaritans. ' + 
						'Your Dashboard will be updated once the Samaritans have been assigned by the Admin.')
				}else{
					$('#samaritanRequestedMessage').text('You can only request up to 5 Samaritans.');
				}

				if (sReply.to_update_anonymous_status) {
					$('#reviewerStatusMessageUpdate').show();
				}else{
					$('#reviewerStatusMessageUpdate').hide();
				}
	        }        
	    }); 
	});

	$('#submit-process-workz').click(function(){
		let workz_ids = JSON.parse($(this).attr('workz-to-process'));
		let approve = $(this).attr('approve');
		let comment = $('#kindnessProcessComment').val();
		$('#hud-loading').show();
		$.post(
			'/kindness/reviewer/process',
			{
				'workz': workz_ids,
				'approve': approve,
				'comment': comment

			},
			function(data){
				$('#hud-loading').hide();
				$('.mobile_navigation_middle_element[target="reviewer_pending_workz_container"]').click();
				alert('Workz has been ' + (approve == '1' ? 'Approved' : 'Disapproved') + '!');
				$('#KSPopUpOverlay').hide();
				$('#kindnessProcessCommentPopUp').hide();
			}
		);
		
	});

	$('#boost-workz').click(function(){
		let workz_ids = JSON.parse($(this).attr('workz-to-process'));
		let approve = $(this).attr('approve');
		let comment = $('#kindnessBoosterComment').val();
		$('#hud-loading').show();
		$.post(
			'/kindness/booster/boost',
			{
				'workz': workz_ids,
				'comment': comment,

			},
			function(data){
				$('.mobile_navigation_middle_element[target="reviewer_pending_workz_container"]').click();
				alert('Workz has been boosted!');
				$('#KSPopUpOverlay').hide();
				$('#kindnessBoosterCommentPopUp').hide();
				$('#kindnessBoosterComment').val('');
				$('#commentModalContainer').append('<div>'+ $('#samCitUserName').text() +'</div><div style="margin-bottom:10px;">'+ comment +'</div>');
				$('#hud-loading').hide();
				$('.mobile_navigation_middle_element.active').click()
			}
		);
		
	});

	$('#close-process-workz').click(function(){
		$('#KSPopUpOverlay').hide();
		$('#kindnessProcessCommentPopUp').hide();
	});

	$('#close-delete-workz-confirmation').click(function(){
		$('#KSPopUpOverlay').hide();
		$('#deleteWorkzConfirmationPopUp').hide();
	});

	$('#close-booster-comment').click(function(){
		$('#KSPopUpOverlay').hide();
		$('#kindnessBoosterCommentPopUp').hide();
	});

	$('#close-message-from-reviewer-popup').click(function(){
		$('#KSPopUpOverlay').hide();
		$('#messageFromReviewerPopUp').hide();
	});

	$('#close-request-samaritan-popup').click(function(){
		$('#KSPopUpOverlay').hide();
		$('#requestSamaritanPopup').hide();
	});

	$('#close-workz-comment-popup').click(function(){
		$('#KSPopUpOverlay').hide();
		$('#workzCommentsPopUp').hide();
	});

	$('#close-reviewer-role-request').click(function(){
		$('#KSPopUpOverlay').hide();
		$('#requestReviewerRole').hide();
	});

	$('#close-reporter-role-request').click(function(){
		$('#KSPopUpOverlay').hide();
		$('#requestReporterRole').hide();
	});

	$('#close-workz-share-popup').click(function(){
		$('#KSPopUpOverlay').hide();
		$('#shareWorkzPopUp').hide();
	});

	$('.workz-comments').live('click', function(){
		let workz_id = $(this).closest('.mobile-table-row')
			.find('[col-name="workz-select"]')
			.attr('workz-id');

		$.post(
			'/kindness/callback/comments',
			{
				'iKindnessId': workz_id,

			},
			function(data){
				$('#workzCommentsContent').html(data);
				$('#KSPopUpOverlay').show();
				$('#workzCommentsPopUp').show();
			}
		);
		
	});	

	$('.workz-comments-boosted').live('click', function(){
		let workz_id = $(this).closest('.mobile-table-row')
			.find('[col-name="workz-select"]')
			.attr('workz-id');

		$.post(
			'/kindness/callback/boosted-comments',
			{
				'iKindnessId': workz_id,

			},
			function(data){
				$('#workzCommentsContent').html(data);
				$('#KSPopUpOverlay').show();
				$('#workzCommentsPopUp').show();
			}
		);
		
	});


	$('.edit-workz').live('click', function(){
		let workz_id = $(this).attr('rel');
		$('.edit_citation_report_wizard_header[target="edit_mobile-container-workz-wizard-b1"]').click();
		$.ajax({
	        url: "/kindness/get-information/" + workz_id,
	        type: 'GET',
	        success: function(data) {
	        	data = JSON.parse(data);

	        	//Workz Data
	        	$('[name="edit_workz_id"]').val(data.details.id);
	        	$('[name="edit_workz_type"]').val(data.details.workz_type);
	        	$('[name="edit_valor_act_type"]').val(data.details.valor_act_type);
	        	$('[name="edit_iKindnessHour"]').val(data.details.iKindnessHours);
	        	$('[name="edit_iKindnessMinute"]').val(data.details.iKindnessMins);
	        	$('[name="edit_kindness_act_type"]').val(data.details.kindness_act_type);
	        	$('[name="edit_sKindnessTitle"]').val(data.details.sTitle);
	        	$('[name="edit_sKindnessLocation"]').val(data.details.sLocation);
	        	$('[name="edit_sKindnessDesc"]').val(data.details.sDesc);
	        	$('[name="edit_dDate"]').val(data.details.sDate);

	        	//Benefactor Data
	        	if (data.details.is_benefactor_anonymous == '1') {
	        		$('[name="edit_is_benefactor_anonymous"]').attr('checked', true);
	        	}else{
	        		$('[name="edit_is_benefactor_anonymous"]').attr('checked', false);
	        	}


	        	// if (data.details.iUserId == data.details.reporter_id) {
	        	// 	$('[name="edit_is_benefactor_same_user"]').attr('checked', true);
	        	// }else{
	        	// 	$('[name="edit_is_benefactor_same_user"]').attr('checked', false);
	        	// }

	        	$('[name="edit_benefactor_first_name"]').val(data.benefactor.profile_first_name);
	        	$('[name="edit_benefactor_last_name"]').val(data.benefactor.profile_last_name);
	        	$('[name="edit_benefactor_address"]').val(data.benefactor.profile_address);
	        	$('[name="edit_benefactor_phone"]').val(data.benefactor.profile_phone);
	        	$('[name="edit_benefactor_email"]').val(data.benefactor.mail);
	        	$('[name="edit_benefactor_department_name"]').val(data.benefactor.profile_benefactor_department_name);
	        	$('[name="edit_benefactor_department_address"]').val(data.benefactor.profile_benefactor_department_address);
	        	$('[name="edit_benefactor_department_phone"]').val(data.benefactor.profile_benefactor_department_phone);
	        	$('[name="edit_benefactor_department_email"]').val(data.benefactor.profile_benefactor_department_email);

	        	//Beneficiary Data

	        	$('[name="edit_sToWhomFirstName"]').val(data.beneficiary.profile_first_name);
	        	$('[name="edit_sToWhomLastName"]').val(data.beneficiary.profile_last_name);
	        	$('[name="edit_beneficiary_address"]').val(data.beneficiary.profile_address);
	        	$('[name="edit_beneficiary_phone"]').val(data.beneficiary.profile_phone);
	        	$('[name="edit_beneficiary_email"]').val(data.beneficiary.mail);
	        	$('[name="edit_sToWhomType"]').val(data.details.sToWhomType);
	        	
	        	if (data.details.is_beneficiary_anonymous == '1') {
	        		$('[name="edit_is_beneficiary_anonymous"]').attr('checked', true);
	        	}else{
	        		$('[name="edit_is_beneficiary_anonymous"]').attr('checked', false);
	        	}

				$('#editWorkzPopUpOverlay').show();
				$('#editWorkzPopUp').show();

				$('#edit_workz-type_mobile').trigger('change');
				$('[name="edit_is_benefactor_anonymous"]').trigger('change');
				$('[name="edit_is_beneficiary_anonymous"]').trigger('change');

				// Image

				if (data.details.workz_image) {
					$('#edit_workz-picture_mobile-preview').attr('href', '/hud_files/uploads/workz/' + data.details.workz_image);
					$('#edit_workz-picture_mobile-preview').text('Click here to view');
					$('#edit_workz-picture_mobile-preview-container').show();
				}else{
					$('#edit_workz-picture_mobile-preview').attr('href', '');
					$('#edit_workz-picture_mobile-preview').text('');
					$('#edit_workz-picture_mobile-preview-container').hide();
				}

				if (data.benefactor.picture != 'sites/default/files/pictures/none.png') {
					$('#edit_benefactor-picture_mobile-preview').attr('href', '/' + data.benefactor.picture);
					$('#edit_benefactor-picture_mobile-preview').text('Click here to view');
					$('#edit_benefactor-picture_mobile-preview-container').show();
				}else{
					$('#edit_benefactor-picture_mobile-preview').attr('href', '');
					$('#edit_benefactor-picture_mobile-preview').text('');
					$('#edit_benefactor-picture_mobile-preview-container').hide();
				}

				if (data.beneficiary.picture != 'sites/default/files/pictures/none.png') {
					$('#edit_beneficiary-picture_mobile-preview').attr('href', '/' + data.beneficiary.picture);
					$('#edit_beneficiary-picture_mobile-preview').text('Click here to view');
					$('#edit_beneficiary-picture_mobile-preview-container').show();
				}else{
					$('#edit_beneficiary-picture_mobile-preview').attr('href', '');
					$('#edit_beneficiary-picture_mobile-preview').text('');
					$('#edit_beneficiary-picture_mobile-preview-container').hide();
				}
	        }        
	    }); 
	});

	$('.delete-single-workz').live('click', function(){
		let workz_id = $(this).attr('rel');
		$('#KSPopUpOverlay').show();
		$('#deleteWorkzConfirmationPopUp').attr('workz_id', workz_id);
		$('#deleteWorkzConfirmationPopUp').show();
	});

	$('#delete-single-process-workz').live('click', function(){
		let workz_id = $('#deleteWorkzConfirmationPopUp').attr('workz_id');
		$('#hud-loading').show();
		$.ajax({
	        url: "/kindness/delete-information/" + workz_id, // le nom du fichier indiqué dans le formulaire
	        type: 'POST', // la méthode indiquée dans le formulaire (get ou post)
	        cache : false,
			dataType    : 'json',
			processData : false,
	        contentType : false,
	        success: function(sReply) {
	        	alert('You successfully delete the workz!');
	        	document.getElementById('KSPopUp').style.display = 'none';
	        	document.getElementById('KSPopUpOverlay').style.display = 'none';
	        	document.getElementById('deleteWorkzConfirmationPopUp').style.display = 'none';
	        	
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

	        		$('#hud-loading').hide();
	        	}, 1000)
				
	        }        
		});
	});

	$('.menu-link').click(function(){
		let target = $(this).attr('target');

		$('.mobile-hud-menu[toggle-element="'+ target +'"]').click();
	});

	$('.readmore').live('click', function(e){
		e.preventDefault();
		$(this).hide();
		let target = $(this).attr('target');

		$('#' + target).show();
	});

	$('.showless').live('click', function(e){
		e.preventDefault();
		let target = $(this).attr('target');

		$('#' + target).hide();

		$(this).closest('.read-more-container').find('.readmore').show();
	});

	$('.signup-role').click(function(e){
		e.preventDefault();

		if($('[name="roles-list-array"]').length === 0){
			window.location.href = '/signup.php';
			return;
		}

		let role_to_signup = $(this).attr('role-to-signup');
		let roles_array = JSON.parse($('[name="roles-list-array"]').val());
		let isReporter = false;
		let isReviewer = false;

		for (let i in roles_array) {
			if (roles_array[i] === 'Reporter') {
				isReporter = true;
			}

			if (roles_array[i] === 'Reviewer') {
				isReviewer = true;
			}
		}

		if (role_to_signup === 'Booster') {
			alert('Coming Soon!');
			return;
		}

		if (role_to_signup === 'Reporter' && !isReporter) {
			$('#KSPopUpOverlay').show();
			$('#requestReporterRole').show();
			return;
		}else if(role_to_signup === 'Reporter' && isReporter){
			alert('Thanks for the interest of being a reporter. But based on our system, you are already a Reporter.');
			return;
		}

		if (role_to_signup === 'Reviewer' && !isReviewer) {
			$('#KSPopUpOverlay').show();
			$('#requestReviewerRole').show();
			return;
		}else if(role_to_signup === 'Reviewer' && isReviewer){
			alert('Thanks for the interest of being a reviewer. But based on our system, you are already a Reviewer.');
			return;
		}

		//Logic here to redirect to signup page if user is not logged in.
	});

	$('.add-role-submit').click(function(){
		let role = $(this).attr('role');

		$.ajax({
	        url: hud_sBasePath + "kindness/add-user-role",
	        type: 'POST',
	        data: {
	        	'role': role
	        },
	        success: function(sReply) {
	        	alert('You successfully enrolled as a ' + role)
	        	window.location.reload(true);
	        }        
	    }); 
	});

	$('#update_profile_form').submit(function(e){
		e.preventDefault();

		if (!$('#update_profile_form')[0].checkValidity()) {
			return;
		}

		let update_profile_form = $('#update_profile_form').serializeArray();
		let self = $(this);

		$('#hud-loading').show();
		var formData = new FormData();

		for(let i in update_profile_form){
			formData.append(update_profile_form[i]['name'], update_profile_form[i]['value']);
		}
		
		$.ajax({
	        url: "/user/profile/update-hud-profile",
	        type: 'POST',
	        cache : false,
			processData : false,
	        contentType : false,
	        data: formData ,
	        success: function(sReply) {
	        	self.find('[name="pass"]').val('');
	        	$('#hud-loading').hide();
	        }
	    })
	});

	$('#copy-share-link').click(function(){
		copyText('share-link-url-text');
	});
});

function goToMemberReporter()
{
	$('.mobile_navigation_middle_element[target="member_reporter"]').click();
}

function goToSamaritanReport()
{
	$('.mobile-hud-menu[toggle-element="citation_mobile_container"]').click();
	setTimeout(function(){
		$('.mobile_navigation_middle_element[target="citation_report"]').click();
	});
}

function goToSamaritanAbout(e)
{
	event.preventDefault();
	$('.mobile-hud-menu[toggle-element="citation_mobile_container"]').click();
	setTimeout(function(){
		$('.mobile_navigation_middle_element[target="citation_about"]').click();
	}, 1)
}

function goToSamaritanDashboard(e)
{
	event.preventDefault();
	$('.mobile-hud-menu[toggle-element="citation_mobile_container"]').click();
	setTimeout(function(){
		$('.mobile_navigation_middle_element[target="citation_samaritan"]').click();
	}, 1)
}

function goToSamaritanWorkz(e)
{
	event.preventDefault();
	$('.mobile-hud-menu[toggle-element="citation_mobile_container"]').click();
	setTimeout(function(){
		$('.mobile_navigation_middle_element[target="citation_workz"]').click();
	}, 1)
}

function goToNews(e)
{
	event.preventDefault();
	$('.mobile-hud-menu[toggle-element="citation_mobile_container"]').click();
	setTimeout(function(){
		$('.mobile_navigation_middle_element[target="citation_news"]').click();
	}, 1)
}

function goToSamaritanStatus(e)
{
	event.preventDefault();
	$('.mobile-hud-menu[toggle-element="citation_mobile_container"]').click();
	setTimeout(function(){
		$('.mobile_navigation_middle_element[target="citation_status"]').click();
	});
}

function goToSamaritanReviewerDashboard(e)
{
	event.preventDefault();
	$('.mobile-hud-menu[toggle-element="citation_mobile_container"]').click();
	setTimeout(function(){
		$('.mobile_navigation_middle_element[target="reviewer_dashboard"]').click();
	});
}

function goToSamaritanBooster(e)
{
	e.preventDefault();
	$('.mobile-hud-menu[toggle-element="citation_mobile_container"]').click();
	setTimeout(function(){
		$('.mobile_navigation_middle_element[target="mentor_dashboard"]').click();
	});
}

function getSelectedWorkzIds(self)
{
	let workz_ids = [];
	$(self)
		.closest('.navigation_middle_target_container')
		.find('[col-name="workz-select"]:checked')
		.each(function(){
			workz_ids.push($(this).attr('workz-id'));
		});

	return workz_ids;
}

function setReviewerList(type)
{
	getWorkzListForReviewer(type, function(workz){

		let mobile_content_row;

		$('#'+ type +'-workz-list-mobile').find('.workz-row-appended').remove();

		for (let i in workz) {
			mobile_content_row = $('#'+ type +'-workz-list-row-template').clone();

			mobile_content_row.find('[col-name="workz-select"]').attr('workz-id', workz[i].id);
			mobile_content_row.find('[col-name="workz-title"]').text(workz[i].sTitle);
			mobile_content_row.find('[col-name="description"]').text(workz[i].sDesc);
			// mobile_content_row.find('[col-name="date"]').text(workz[i].sDate);
			mobile_content_row.find('[col-name="date"]').text(timeAgo(workz[i].date_submitted));
			mobile_content_row.find('[col-name="samaritan-report"]').attr('kindness_id', workz[i].id);
			mobile_content_row.find('[col-name="workz-samaritan-name"]').text(workz[i].samaritan_name);
			if (workz[i].is_benefactor_anonymous != '1' && workz[i].workz_type != 'Random Kindness Workz') {
				mobile_content_row.find('.workz-samaritan-message').show();
			}

			mobile_content_row.find('[col-name="workz-beneficiary-name"]').text(workz[i].beneficiary_name);

			if (workz[i].is_beneficiary_anonymous != '1' && workz[i].workz_type != 'Random Kindness Workz') {
				mobile_content_row.find('.workz-beneficiary-message').show();
			}
			mobile_content_row.find('[col-name="workz-reporter-name"]').text(workz[i].reporter_name);
			mobile_content_row.find('[col-name="workz-image"]').attr('src', '/hud_files/uploads/workz/' + workz[i].workz_image);

			mobile_content_row.attr('id', '');
			mobile_content_row.addClass('workz-row-appended');
			mobile_content_row.removeClass('row-template');

			$('#'+ type +'-workz-list-mobile').append(mobile_content_row);
		}

		if (workz.length === 0) {
			$('#'+ type +'-workz-list-mobile').find('.no-records-workz').show();
			$('#'+ type +'-workz-list-mobile')
				.closest('.navigation_middle_target_container')
				.find('.form-action')
				.hide();
		} else {
			$('#'+ type +'-workz-list-mobile').find('.no-records-workz').hide();
			$('#'+ type +'-workz-list-mobile')
				.closest('.navigation_middle_target_container')
				.find('.form-action')
				.show();
		}
	});
}

function getWorkzListForReviewer(type, callback){

	$.get(
		"/kindness/reviewer/workz/list?type=" + type,
		function(data){
			callback(data)
		},
		"json"
	);
}

function setBoosterList(type)
{
	getWorkzListForBooster(type, function(workz){

		let mobile_content_row;

		$('#'+ type +'-workz-list-mobile').find('.workz-row-appended').remove();

		for (let i in workz) {
			mobile_content_row = $('#'+ type +'-workz-list-row-template').clone();

			mobile_content_row.find('[col-name="workz-select"]').attr('workz-id', workz[i].id);
			mobile_content_row.find('[col-name="workz-title"]').text(workz[i].sTitle);
			mobile_content_row.find('[col-name="description"]').text(workz[i].sDesc);
			mobile_content_row.find('[col-name="date"]').text(timeAgo(workz[i].date_submitted));
			console.log(mobile_content_row.find('[col-name="workz-image"]'))
			mobile_content_row.find('[col-name="workz-image"]').attr('src', '/hud_files/uploads/workz/' + workz[i].workz_image);
			mobile_content_row.find('[col-name="samaritan-report"]').attr('kindness_id', workz[i].id);
			mobile_content_row.find('.boost_citation_popup').attr('citation_id', workz[i].id);


			mobile_content_row.attr('id', '');
			mobile_content_row.addClass('workz-row-appended');
			mobile_content_row.removeClass('row-template');

			$('#'+ type +'-workz-list-mobile').append(mobile_content_row);
		}

		if (workz.length === 0) {
			$('#'+ type +'-workz-list-mobile').find('.no-records-workz').show();
			$('#'+ type +'-workz-list-mobile')
				.closest('.navigation_middle_target_container')
				.find('.form-action')
				.hide();
		} else {
			$('#'+ type +'-workz-list-mobile').find('.no-records-workz').hide();
			$('#'+ type +'-workz-list-mobile')
				.closest('.navigation_middle_target_container')
				.find('.form-action')
				.show();
		}
	});
}

function setSamaritanCount(){
	getWorkzListForSamaritan('approved', function(data){
		$('#samaritan_approved_count_mobile').text(data.length)
	})

	getWorkzListForSamaritan('pending', function(data){
		$('#samaritan_pending_count_mobile').text(data.length)
	});
}

function setNewsList()
{
	$('#hud-loading').show();
	getNewsList(function(data){
		let mobile_content_row;

		$('.news-item.appended').remove();
		let popular_response = data.popular_response.items;
		popular_response = popular_response.sort((a, b) => a.engagement > b.engagement ? -1 : 1)

		let other_response = data.other_response.items;
		other_response = other_response.sort((a, b) => a.engagement > b.engagement ? -1 : 1)

		appendNewsList(popular_response, '.news-list.most-popular');
		appendNewsList(other_response, '.news-list.yesterday-news');


		$('#hud-loading').hide();
	});
}

function appendNewsList(news, container)
{
	let url = '';
	let engagement = '';
	for (let i in news) {
		url = 'https://visuals.feedly.com/1x1.gif';
		engagement = '';
		if (news[i]['visual']) {
			url = news[i]['visual']['url'];
		}
		if (news[i]['engagement']) {
			engagement = kFormatter(news[i]['engagement']);
		}
		mobile_content_row = $(container).find('.template').clone();
		mobile_content_row.attr('src', news[i]['canonicalUrl']);
		mobile_content_row.find('.news-image').attr('src', url);
		mobile_content_row.find('.news-title').text(news[i]['title']);
		mobile_content_row.find('.news-author').text(news[i]['author']);
		mobile_content_row.find('.news-engagement').text(engagement);
		mobile_content_row.find('.news-published-at').text(timeSince(new Date(news[i]['crawled'])));
		mobile_content_row.find('.news-description').html(news[i]['summary']['content']);
		mobile_content_row.removeClass('template');
		mobile_content_row.addClass('appended');

		$(container).append(mobile_content_row);
	}
}

function setSamaritanList(type)
{
	getWorkzListForSamaritan(type, function(data){

		let mobile_content_row;

		$('#samaritan-'+ type +'-workz-list-mobile').find('.workz-row-appended').remove();

		for (let i in data) {
			mobile_content_row = $('#samaritan-'+ type +'-workz-list-row-template').clone();

			mobile_content_row.find('[col-name="workz-samaritan-name"]').text(data[i].samaritan_name);
			mobile_content_row.find('[col-name="workz-select"]').attr('workz-id', data[i].id);
			mobile_content_row.find('[col-name="workz-title"]').text(data[i].sTitle);
			mobile_content_row.find('[col-name="description"]').text(data[i].sDesc);
			mobile_content_row.find('[col-name="date"]').text(timeAgo(data[i].date_submitted));
			mobile_content_row.find('[col-name="workz-image"]').attr('src', '/hud_files/uploads/workz/' + data[i].workz_image);
			mobile_content_row.find('[col-name="samaritan-report"]').attr('kindness_id', data[i].id);

			mobile_content_row.attr('id', '');
			mobile_content_row.addClass('workz-row-appended');
			mobile_content_row.removeClass('row-template');

			$('#samaritan-'+ type +'-workz-list-mobile').append(mobile_content_row);
		}

		if (data.length === 0) {
			$('#samaritan-'+ type +'-workz-list-mobile').find('.no-records-workz').show();
			$('#samaritan-'+ type +'-workz-list-mobile')
				.closest('.navigation_middle_target_container')
				.find('.form-action')
				.hide();
		} else {
			$('#samaritan-'+ type +'-workz-list-mobile').find('.no-records-workz').hide();
			$('#samaritan-'+ type +'-workz-list-mobile')
				.closest('.navigation_middle_target_container')
				.find('.form-action')
				.show();
		}
	});
}

function setReporterList(type)
{
	getWorkzListForReporter(type, function(data){

		let mobile_content_row;

		$('#'+ type +'-workz-list-mobile').find('.workz-row-appended').remove();

		for (let i in data) {
			mobile_content_row = $('#'+ type +'-workz-list-row-template').clone();

			console.log(type)
			if (type === 'reports-samaritan') {
				mobile_content_row.find('[col-name="reported-samaritan-name"]').text(data[i].name);
				mobile_content_row.find('[col-name="reported-samaritan-grade"]').text(data[i].grade);
				mobile_content_row.find('[col-name="reported-samaritan-school"]').text(data[i].school);
				mobile_content_row.find('[col-name="reported-samaritan-mail"]').text(data[i].email);
			}else{
				mobile_content_row.find('[col-name="workz-samaritan-name"]').text(data[i].samaritan_name);
				mobile_content_row.find('[col-name="workz-select"]').attr('workz-id', data[i].id);
				mobile_content_row.find('[col-name="workz-title"]').text(data[i].sTitle);
				mobile_content_row.find('[col-name="description"]').text(data[i].sDesc);
				mobile_content_row.find('[col-name="date"]').text(timeAgo(data[i].date_submitted));
				mobile_content_row.find('[col-name="workz-image"]').attr('src', '/hud_files/uploads/workz/' + data[i].workz_image);
				mobile_content_row.find('[col-name="samaritan-report"]').attr('kindness_id', data[i].id);
			}

			mobile_content_row.attr('id', '');
			mobile_content_row.addClass('workz-row-appended');
			mobile_content_row.removeClass('row-template');

			$('#'+ type +'-workz-list-mobile').append(mobile_content_row);
		}

		if (data.length === 0) {
			$('#'+ type +'-workz-list-mobile').find('.no-records-workz').show();
			$('#'+ type +'-workz-list-mobile')
				.closest('.navigation_middle_target_container')
				.find('.form-action')
				.hide();
		} else {
			$('#'+ type +'-workz-list-mobile').find('.no-records-workz').hide();
			$('#'+ type +'-workz-list-mobile')
				.closest('.navigation_middle_target_container')
				.find('.form-action')
				.show();
		}
	});
}

function getWorkzListForBooster(type, callback){

	$.get(
		"/kindness/booster/workz/list?boost_list_type=" + type,
		function(data){
			callback(data)
		},
		"json"
	);
}

function getWorkzListForReporter(type, callback){

	$.get(
		"/kindness/reporter/workz/list?reporter_list_type=" + type,
		function(data){
			callback(data)
		},
		"json"
	);
}

function getWorkzListForSamaritan(type, callback){

	$.get(
		"/kindness/samaritan/workz/list?samaritan_list_type=" + type,
		function(data){
			callback(data)
		},
		"json"
	);
}

function getNewsList(callback){

	$.get(
		hud_sBasePath + 'kindness/callback/news',
		function(data){
			callback(data)
		},
		"json"
	);
}

function setAllWorkzList(type)
{
	getAllWorkzList(type, function(workz){

		let mobile_content_row;

		$('#all-'+ type +'-workz-list-mobile').find('.workz-row-appended').remove();
		$('.workz_list_tab_header[target="'+ type +'_workz_list_container"]').text(workz.length + ' Workz');
		for (let i in workz) {
			mobile_content_row = $('#all-'+ type +'-workz-list-row-template').clone();

			mobile_content_row.find('[col-name="workz-select"]').attr('workz-id', workz[i].id);
			mobile_content_row.find('[col-name="workz-title"]').text(workz[i].sTitle);
			mobile_content_row.find('[col-name="description"]').text(workz[i].sDesc);
			mobile_content_row.find('[col-name="date"]').text(timeAgo(workz[i].date_submitted));
			mobile_content_row.find('[col-name="workz-image"]').attr('src', '/hud_files/uploads/workz/' + workz[i].workz_image);
			mobile_content_row.find('[col-name="samaritan-report"]').attr('kindness_id', workz[i].id);
			mobile_content_row.find('.citation-report-social-actions-container').find('.like').attr('rel', workz[i].id)
			if (parseInt(workz[i].is_liked_by_current_user) > 0 && uid > 0) {
				mobile_content_row.find('.citation-report-social-actions-container').find('.like').addClass('active');
			}
			mobile_content_row.find('.citation-report-social-actions-container').find('.like span').text(workz[i].likes_count);
			mobile_content_row.find('.citation-report-social-actions-container').find('.share').attr('rel', workz[i].id)

			mobile_content_row.attr('id', '');
			mobile_content_row.addClass('workz-row-appended');
			mobile_content_row.removeClass('row-template');

			$('#all-'+ type +'-workz-list-mobile').append(mobile_content_row);
		}

		if (workz.length === 0) {
			$('#all-'+ type +'-workz-list-mobile').find('.no-records-workz').show();
			$('#all-'+ type +'-workz-list-mobile')
				.closest('.navigation_middle_target_container')
				.find('.form-action')
				.hide();
		} else {
			$('#all-'+ type +'-workz-list-mobile').find('.no-records-workz').hide();
			$('#all-'+ type +'-workz-list-mobile')
				.closest('.navigation_middle_target_container')
				.find('.form-action')
				.show();
		}
	});
}

function getAllWorkzList(type, callback){

	$.get(
		"/kindness/booster/all/workz/list?type=" + type,
		function(data){
			callback(data)
		},
		"json"
	);
}

function getAssignedSmaritanForReviewer(){

	$.get(
		"/kindness/reviewer/assigned-samaritan",
		function(data){
			data = JSON.parse(data);
			let mobile_content_row;
			$('#assigned-samaritan-list-mobile').find('.assigned-samaritan-row-appended').remove();

			for (let i in data) {
				mobile_content_row = $('#assigned-samaritan-row-template').clone();

				mobile_content_row.find('[col-name="assigned-samaritan-name"]').text(data[i].name);
				mobile_content_row.find('[col-name="assigned-samaritan-grade"]').text(data[i].grade);
				mobile_content_row.find('[col-name="assigned-samaritan-school"]').text(data[i].school);
				mobile_content_row.find('[col-name="assigned-samaritan-mail"]').text(data[i].email);
				mobile_content_row.attr('id', '');
				mobile_content_row.addClass('assigned-samaritan-row-appended');
				mobile_content_row.removeClass('row-template');

				$('#assigned-samaritan-list-mobile').append(mobile_content_row);
			}
		}
	);
}

function setReviewerDashboardData(){

	$.get(
		"/kindness/reviewer/dashboard-status",
		function(data){
			data = JSON.parse(data);
			$('#review-dashboard-pending-workz').text(data.iPendingWorkz)
			$('#review-dashboard-assigned-hopefuls').text(data.iAssignedHopeful)
			$('#review-dashboard-approved-workz').text(data.iApprovedWorkz)
			$('#review-dashboard-requested-samaritan').text(data.iRequest)
			$('#review-dashboard-disapproved-workz').text(data.iDisApprovedWorkz)
			$('#review-dashboard-available-hopefuls').text(data.iAvailableHopefuls)
		}
	);
}

function setBoosterDashboardData(){
	$.get(
		"/kindness/booster/dashboard",
		function(data){
			data = JSON.parse(data);
			$('#booster-available-workz-count').text(data.available);
			$('#booster-boosted-workz-count').text(data.boosted);
			$('#booster-waiting-workz-count').text(data.waiting);
			// $('#review-dashboard-pending-workz').text(data.iPendingWorkz)
			// $('#review-dashboard-assigned-hopefuls').text(data.iAssignedHopeful)
			// $('#review-dashboard-approved-workz').text(data.iApprovedWorkz)
			// $('#review-dashboard-requested-samaritan').text(data.iRequest)
			// $('#review-dashboard-disapproved-workz').text(data.iDisApprovedWorkz)
			// $('#review-dashboard-available-hopefuls').text(data.iAvailableHopefuls)
		}
	);
}
const MONTH_NAMES = [
  'January', 'February', 'March', 'April', 'May', 'June',
  'July', 'August', 'September', 'October', 'November', 'December'
];


function getFormattedDate(date, prefomattedDate = false, hideYear = false) {
  const day = date.getDate();
  const month = MONTH_NAMES[date.getMonth()];
  const year = date.getFullYear();
  const hours = date.getHours();
  let minutes = date.getMinutes();

  if (minutes < 10) {
    // Adding leading zero to minutes
    minutes = `0${ minutes }`;
  }

  if (prefomattedDate) {
    // Today at 10:20
    // Yesterday at 10:20
    return `${ prefomattedDate } at ${ hours }:${ minutes }`;
  }

  if (hideYear) {
    // 10. January at 10:20
    return `${ day }, ${ month } at ${ hours }:${ minutes }`;
  }

  // 10. January 2017. at 10:20
  return `${ day }, ${ month } ${ year }. at ${ hours }:${ minutes }`;
}


// --- Main function
function timeAgo(dateParam) {
  if (!dateParam) {
    return null;
  }

  const date = typeof dateParam === 'object' ? dateParam : new Date(dateParam);
  const DAY_IN_MS = 86400000; // 24 * 60 * 60 * 1000
  const today = new Date();
  const yesterday = new Date(today - DAY_IN_MS);
  const seconds = Math.round((today - date) / 1000);
  const minutes = Math.round(seconds / 60);
  const isToday = today.toDateString() === date.toDateString();
  const isYesterday = yesterday.toDateString() === date.toDateString();
  const isThisYear = today.getFullYear() === date.getFullYear();


  if (seconds < 5) {
    return 'now';
  } else if (seconds < 60) {
    return `${ seconds } seconds ago`;
  } else if (seconds < 90) {
    return 'about a minute ago';
  } else if (minutes < 60) {
    return `${ minutes } minutes ago`;
  } else if (isToday) {
    return getFormattedDate(date, 'Today'); // Today at 10:20
  } else if (isYesterday) {
    return getFormattedDate(date, 'Yesterday'); // Yesterday at 10:20
  } else if (isThisYear) {
    return getFormattedDate(date, false, true); // 10. January at 10:20
  }

  return getFormattedDate(date); // 10. January 2017. at 10:20
}

function messageFromReviewer(self, type)
{
	let workz_id = $(self).closest('.mobile-table-row').find('[col-name="workz-select"]')
			.attr('workz-id');
	$('#KSPopUpOverlay').show();
	$('#messageFromReviewerPopUp').show();
	$('#role-type-message').text(type);

	$('#messageFromReviewer').attr('citation_id', workz_id);
	$('#messageFromReviewer').attr('user_type', type);
	$('#kindnessReviewerMessageText').val('');
}

function copyText(text_id) {
  // Get the text field
  var copyText = document.getElementById(text_id);

  // Select the text field
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

   // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);
}

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function shareToFacebook(url)
{
	window.open('https://www.facebook.com/sharer/sharer.php?u=' + url,'facebook-share-dialog',"width=626, height=436")
}

function shareToTwitter(url)
{
	window.open('https://twitter.com/share?text=&url=' + url,'twitter-share-dialog',"width=626, height=436")
	window.open('https://twitter.com/intent/tweet?url='+ url +'&text=I want to share this workz with you&via=&related=','twitter-share-dialog',"width=626, height=436")
}

function shareToMail(url)
{
	window.open('mailto:?subject=I want to share this workz with you&body=' + url,'twitter-share-dialog',"width=626, height=436")
}

function kFormatter(num) {
    return Math.abs(num) > 999 ? Math.floor(Math.sign(num)*((Math.floor(num)/1000))) + 'k' : Math.sign(num)*Math.abs(num)
}

function timeSince(date) {

  var seconds = Math.floor((new Date() - date) / 1000);

  var interval = seconds / 31536000;

  if (interval > 1) {
    return Math.floor(interval) + "y";
  }
  interval = seconds / 2592000;
  if (interval > 1) {
    return Math.floor(interval) + "m";
  }
  interval = seconds / 86400;
  if (interval > 1) {
    return Math.floor(interval) + "d";
  }
  interval = seconds / 3600;
  if (interval > 1) {
    return Math.floor(interval) + "h";
  }
  interval = seconds / 60;
  if (interval > 1) {
    return Math.floor(interval) + "m";
  }
  return Math.floor(seconds) + "s";
}