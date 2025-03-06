<?php
	$is_reporter = '';
	if (in_array('Reporter', $user->roles)) {
		$is_reporter =  ' and Reporter';
	}

	if (in_array('Reviewer', $user->roles)) {
		$role_in_text = 'Reviewer';
	}else if (in_array('Samaritan', $user->roles)) {
		$role_in_text = 'Samaritan' . $is_reporter;
	}else if (in_array('Beneficiary', $user->roles)) {
		$role_in_text = 'Beneficiary'.$is_reporter;
	}else if (in_array('Booster', $user->roles)) {
		$role_in_text = 'Booster'.$is_reporter;
	}else if (in_array('eVolunteer - eAdministrator', $user->roles)) {
		$role_in_text = 'Administrator';
	}else{
		if ($is_reporter) {
			$role_in_text = 'Reporter';
		}else{
			$role_in_text = '-';
		}
	}
?>
<div id="mobile-header-container" style="flex-wrap: wrap;">
	<div style="width: 30%;">
		<img id="mobile-header-image" src="/hud_files/images/1st_Hope_Logo.png" style="width: 100px;">
	</div>
	<div id="mobile-header-title-container"  style="width: 59%;">
		<h2 id="mobile-header-title">1st Hope Corps</h2>
			<div id="mobile-header-subtitle">The Power of Hope</div>
	</div>
	<div style="margin-left: auto;padding-top: 10px;" id="hamburger-container">
		<i class="fas fa-bars mobile-menu-action"></i>
		<i class="fas fa-close mobile-menu-action" style="display: none;"></i>
	</div>
	<?php
	if ($user->uid > 0) {

	?>
	<div style="width: 100%;margin-top: 25px;">
		<div style="word-break: break-word;color: #484848;font-size: 1.2rem;width: 50%;float: left;">
			<small style="font-size: 1rem;">
				You are signed in as <b><?= $role_in_text ?></b>
			</small>
		</div>
		<div style="word-break: break-word;color: #484848;font-size: 1.2rem;width: 50%;float: right;text-align: right;">
			<small style="font-size: 1rem;    color: rgb(38,104,186);">
				God - People - Planet
			</small>
		</div>
	</div>
	<?php
	}

	?>
</div>
<?php
if ($user->uid > 0) {

?>
<div id="mobile-header-container-menu-open">
	<div style="width: 20%;">
		<i class="fa-solid fa-user" style="
		    color: #ffffff;
		    font-size: 1.2rem;
		    background-color: #545454;
		    padding: 10px;
		    border-radius: 100%;
		    margin-right: 15px;
		    margin-left: 15px;
			"></i> 
	</div>
	<div style="width: 70%;
	    color: #484848;
	    font-size: 1.1rem;">
	    <input type="hidden" name="roles-list-array" value="<?= htmlentities(json_encode($user->roles)) ?>">
		<div style="word-break: break-word;">
			<div style="margin-bottom: 5px">Hi, <?php echo $user->name; ?> </div>
			<small style="font-size: .8rem;">
				You are signed in as <?= $role_in_text ?>
			</small>
		</div>
			
			
	</div>
	<div style="width: 5%;" id="hamburger-container">
		<i class="fas fa-bars mobile-menu-action" style="display: inline-block;"></i>
		<i class="fas fa-close mobile-menu-action" style="display: none;"></i>
	</div>
</div>

<?php
}

?>
<div id="mobile-menu-open-wrapper" style="border-top: 1px solid #CCC;">
	<?php

	if ($user->uid == 0) {
		?>
			<div><a href="/home.php">Home</a></div>
			<div><a href="/login.php">Login</a></div>
			<div><a href="/signup.php">Signup</a></div>
		<?php
	}else{

	?>
		<?php

		if (in_array('Reviewer', $user->roles)) {
		?>
			<div><a href="#" class="mobile-hud-menu" toggle-element="reviewer_dashboard_mobile_container">Reviewer Dashboard</a></div>
			<?php
		}
		?>
		<?php

		if (in_array('Booster', $user->roles)) {
		?>
			<div><a href="#" class="mobile-hud-menu" toggle-element="booster_dashboard_mobile_container">Booster Dashboard</a></div>
			<?php
		}
		?>
		<?php

		if (in_array('Reporter', $user->roles)) {
		?>
			<div><a href="#" class="mobile-hud-menu" toggle-element="citation_mobile_container">Reporter Dashboard</a></div>
			<?php
		}
		?>
		<div><a href="#" class="mobile-hud-menu" toggle-element="account_mobile_container">Account</a></div>
		<div><a href="#" class="mobile-hud-menu" toggle-element="help_mobile_container">Help</a></div>
		<div><a href="/logout?page=home">Logout</a></div>
	<?php
		}
	?>
		<div style="display: none;"><a href="#" class="mobile-hud-menu" toggle-element="booster_dashboard_mobile_container">Booster Dashboard</a></div>
		<div style="display: none;"><a href="#" class="mobile-hud-menu" toggle-element="reviewer_dashboard_mobile_container">Reviewer Dashboard</a></div>
		<div style="display: none;"><a href="#" class="mobile-hud-menu" toggle-element="hope_home_1st_hope_corps">Home</a></div>
		<div style="display: none;"><a href="#" class="mobile-hud-menu" toggle-element="citation_mobile_container">Citation</a></div>
		<div style="display: none;"><a href="#" class="mobile-hud-menu" toggle-element="rewards_mobile_container">Awards</a></div>
		<div style="display: none;"><a href="#" class="mobile-hud-menu" toggle-element="hope_about_1st_hope_corps">About</a></div>
		<div style="display: none;"><a href="#" class="mobile-hud-menu" toggle-element="members_mobile_container">Get Involved</a></div>
		<div style="display: none;"><a href="#" class="mobile-hud-menu" toggle-element="reviewer_workz_list_mobile_container">Pending List</a></div>
		<div style="display: none;"><a href="#" class="mobile-hud-menu" toggle-element="reporter_workz_list_mobile_container">Reporter List</a></div>
		<div style="display: none;"><a href="#" class="mobile-hud-menu" toggle-element="samaritan_workz_list_mobile_container">Samaritan List</a></div>
		<div style="display: none;"><a href="#" class="mobile-hud-menu" toggle-element="booster_workz_list_mobile_container">Booster List</a></div>
		<div style="display: none;"><a href="#" class="mobile-hud-menu" toggle-element="reviewer_assigned_samaritan_mobile_container">Assigned Samaritan List</a></div>
		<div style="display: none;"><a href="#" class="mobile-hud-menu" toggle-element="reviewer_requested_samaritan_mobile_container">Request Samaritan</a></div>
	<div class="mobile_navigation_footer" style="bottom: 0px;position: absolute;width: 100%;">
		<div class="mobile_navigation_footer_element active" target="hope_home_1st_hope_corps"><i class="fas fa-home"></i> <small>Home</small></div>
		<div class="mobile_navigation_footer_element" target="citation_mobile_container"><i class="fa-solid fa-location-dot"></i> <small>Workz</small></div>
		<div class="mobile_navigation_footer_element" target="rewards_mobile_container"><i class="fa-solid fa-money-bill"></i> <small>Awards</small></div>
		<div class="mobile_navigation_footer_element" target="hope_about_1st_hope_corps"><i class="fa-solid fa-circle-info"></i> <small>About</small></div>
		<div class="mobile_navigation_footer_element" target="members_mobile_container"><i class="fa-solid fa-users"></i> <small>Get Involved</small></div>
	</div>
</div>
<div class="mobile-wrapper" style="position: relative;">

	<?php

		$home_display = 'display:block';
		if (isset($isSignup)) {
			$home_display = 'display:none';

			include_once('signup_form.php');
		}
		
		if (isset($isLogin)) {
			$home_display = 'display:none';

			include_once('login_form.php');
		}

	?>
	<div style="margin-bottom: 80px;">
		<div class="mobile-content-wrapper hope_home_1st_hope_corps" style="<?= $home_display ?>">
			<div class="hl" style="text-align:center">Welcome to the Samaritan Workz Program.</div>
			
			<div class="hopenet_middle_banner">
				<img src="/hud_files/images/home.png" style="width: 100%;">
			</div>
			<div>
				
			</div>
			<div class="mobile-text-middle-container">
				<div class="h3">Draft:</div>
				<p>
					<?= HOME_MIDDLE_TEXT ?>
				</p>
			</div>
		</div>
		<div class="mobile-content-wrapper account_mobile_container">
			<div class="hl" style="text-align:center">Account Information</div>
			<div class="mobile-text-middle-container">
				<form id="update_profile_form">
					<?php
					$user_info = user_load(['uid' => $user->uid]);
					?>
					<div class="form-control">
						<input type="text" name="first_name" required placeholder="First Name" value="<?= $user_info->profile_first_name ?>" />
					</div>
					<div class="form-control">
						<input type="text" name="last_name" required placeholder="Last Name" value="<?= $user_info->profile_last_name ?>" />
					</div>
					<div class="form-control" style="margin-bottom: 20px;">
						<input type="text" name="username" required placeholder="Username" readonly style="margin-bottom: 5px;" value="<?= $user_info->name ?>" />
						<div>
							<small style="font-size: .9rem ;">
								* Auto populated based on first and last name. This will be your username when you login to the app.
							</small>
						</div>
					</div>
					<div class="form-control" style="margin-bottom: 20px;">
						<input type="password" name="pass" placeholder="Password" style="margin-bottom: 5px;" />
						<div>
							<small style="font-size: .9rem ;">
								* Leave this field blank if you don't want to change your password.
							</small>
						</div>
					</div>
					<div class="form-control">
						<input type="text" name="email" required placeholder="Email" value="<?= $user_info->mail ?>" />
					</div>
					<div class="form-control">
						<input type="text" name="phone" required placeholder="Phone" value="<?= $user_info->profile_phone ?>" />
					</div>
					<div class="form-control">
						<input type="text" name="age" required placeholder="Age" value="<?= $user_info->profile_age ?>" />
					</div>
					<div class="form-control" style="display: flex;">
						<div style="width: 47%;">
							<select name="birth_month" style="float: left;margin-right: 10px;">
								<?php
								for ($i_month = 1; $i_month <= 12; $i_month++) { 
							        echo '<option value="'.$i_month.'" '. ($user_info->profile_birth_month == $i_month ? "selected" : "") .' >'. date('F', mktime(0,0,0,$i_month)).'</option>'."\n";
							    }
								?>
							</select>
						</div>
						<div style="width: 49%;margin-left: auto;">
							<select name="birth_year" style="float: left;">
								<?php
								for($i=0; $i<=60; $i++){
									$year = (date('Y') - 10) - $i;
									?>
									<option value="<?= $year ?>" <?=  $user_info->profile_birth_year == $year ? 'selected' : ''?> ><?= $year ?></option>
									<?php
									}
								?>
							</select>
						</div>
						<div style="clear: both;"></div>
					</div>
					<div class="form-control" style="margin-bottom:20px">
						<div style="margin-right: auto;">
							<a class="upload-field-button" id="upload-account_mobile" style="width: 109px;">Browse</a> 
							<input type="file" id="account-picture_mobile" style="display:none" onChange="uploadOnChange('account-picture_mobile', 'account-picture-filename_mobile')">
							<input type="text" id="account-picture-filename_mobile" name="account-picture-filename" style="display:none">
							<b style="margin-left: 8px;font-size: 1rem;">Upload your picture</b>
							<div id="account-picture_mobile-preview-container" style="display:block;margin-top: 10px;">
								<?php

									if (file_exists($user_info->picture)) {

								?>
									<a href="<?= '/'.$user_info->picture ?>" id="account-picture_mobile-preview" target="_blank" style="font-size: 1rem;">Picture</a>

								<?php

									}else{
										?>
										<a href="" id="account-picture_mobile-preview" target="_blank" style="font-size: 1rem;"></a>
										<?php
									}

								?>
							</div>
						</div>
					</div>

					<?php

					if (array_key_exists(25, $user->roles)) {

					?>
					<div class="form-control">
						<input type="text" name="school" required placeholder="School" value="<?= $user_info->profile_school ?>" />
					</div>

					<div class="form-control">
						<input type="text" name="grade_level" required placeholder="Grade Level" value="<?= $user_info->profile_grade ?>" />
					</div>
					<?php
					}
					?>
					<?php

					if (array_key_exists(23, $user->roles)) {

					?>
					<div class="form-control">
						<input type="text" name="organization" required placeholder="Organization" value="<?= $user_info->profile_organization ?>" />
					</div>
					<?php
					}
					?>
					<div class="form-action" style="text-align: center;">
				        <input type="submit" name="submit_profile" value="Save" class="btnuser" /> 
					</div>
				</form>
			</div>
		</div>
			<div class="mobile-content-wrapper reviewer_dashboard_mobile_container">
				<div class="hl" style="text-align:center">Workz</div>
				<div class="hopenet_middle_banner">
					<img src="/hud_files/images/citation.png" style="width: 100%;">
				</div>
				<div class="mobile_navigation_middle">
					<div class="mobile_navigation_middle_element" onclick="goToSamaritanWorkz(event)">Workz</div>
					<div class="mobile_navigation_middle_element" onclick="goToSamaritanDashboard(event)">Samaritans</div>
					<div class="citation_reporter_middle_element" target="citation_reporter">
						Reporter 
						<i class="fas fa-caret-down" style="font-size:.8rem"></i>
						<div class="citation_reporter_dropdown_nav">
							<div class="mobile_navigation_middle_element" onclick="goToSamaritanReport(event)">Report</div>
							<div class="mobile_navigation_middle_element" onclick="goToSamaritanStatus(event)">Dashboard</div>
						</div>
					</div>
					<div class="mobile_navigation_middle_element active" id="mobile_navigation_middle_element_reviewer"> Reviewer</div>
					<div class="mobile_navigation_middle_element" onclick="goToSamaritanBooster(event)">Booster</div>
					<div class="mobile_navigation_middle_element" onclick="goToNews(event)">News</div>
				</div>
				<div class="mobile-text-middle-container">
					<div class="h2 mobile_middle_title">Reviewer Dashboard</div>
					<div class="h3">Draft:</div>
					<div style="max-height: 300px;min-height: 200px;overflow: auto;">
						<?= REVIEWER_DASHBOARD_TEXT ?>
					</div>
					<hr style="margin: 30px 0px 30px 0px">
					<?php
					if($user->uid > 0){
						if (in_array('Reviewer', $user->roles)) {
							include_once('./hud_files/reviewer_functions.php');
							$reviewerDashboardData = getReviewerDashboardData($user);
					?>
					<!-- <div class="hl" style="margin-top: 20px;text-align: center;">Dashboard</div> -->
					<div class="rows-reviewer-dashboard">
						<div class="columns-reviewer-dashboard">
							<div class="reviewer-column-title">
								Pending Workz
							</div>
							<div class="reviewer-column-count" id="review-dashboard-pending-workz"><?= $reviewerDashboardData['iPendingWorkz'] ?></div>
							<div class="reviewer-column-link">
								<a href="#" target="reviewer_workz_list_mobile_container" target_workz_list="reviewer_pending_workz_container">Click to review</a>
							</div>
						</div>
						<div class="columns-reviewer-dashboard">
							<div class="reviewer-column-title">
								Assigned Samaritan
							</div>
							<div class="reviewer-column-count" id="review-dashboard-assigned-hopefuls"><?= $reviewerDashboardData['iAssignedHopeful'] ?></div>
							<div class="reviewer-column-link">
								<a href="#" target="reviewer_assigned_samaritan_mobile_container">Click to view</a>
							</div>
						</div>
					</div>
					<div class="rows-reviewer-dashboard">
						<div class="columns-reviewer-dashboard">
							<div class="reviewer-column-title">
								Approved Workz
							</div>
							<div class="reviewer-column-count" id="review-dashboard-approved-workz"><?= $reviewerDashboardData['iApprovedWorkz'] ?></div>
							<div class="reviewer-column-link">
								<a href="#" target="reviewer_workz_list_mobile_container" target_workz_list="reviewer_approved_workz_container">Click to view</a>
							</div>
						</div>
						<div class="columns-reviewer-dashboard">
							<div class="reviewer-column-title">
								Requested Samaritan
							</div>
							<div class="reviewer-column-count" id="review-dashboard-requested-samaritan"><?= $reviewerDashboardData['iRequest'] ?></div>
							<div class="reviewer-column-link">
								<a href="#" target="reviewer_requested_samaritan_mobile_container">Request samaritan</a>
							</div>
						</div>
					</div>
					<div class="rows-reviewer-dashboard">
						<div class="columns-reviewer-dashboard">
							<div class="reviewer-column-title">
								Disapproved Workz
							</div>
							<div class="reviewer-column-count" id="review-dashboard-disapproved-workz"><?= $reviewerDashboardData['iDisApprovedWorkz'] ?></div>
							<div class="reviewer-column-link">
								<a href="#" target="reviewer_workz_list_mobile_container" target_workz_list="reviewer_disapproved_workz_container">Click to view</a>
							</div>
						</div>
						<div class="columns-reviewer-dashboard">
							<div class="reviewer-column-title">
								Unassigned Samaritan
							</div>
							<div class="reviewer-column-count" id="review-dashboard-available-hopefuls"><?= $reviewerDashboardData['iAvailableHopefuls'] ?></div>
						</div>
					</div>
					<div class="rows-reviewer-dashboard">
						<div class="columns-reviewer-dashboard">
							<div class="reviewer-column-title">
								Valiant Balance
							</div>
							<div class="reviewer-column-count" id="review-dashboard-wgold"><?= $mBalance ?></div>
							<div class="reviewer-column-link">
								<a href="#" target="rewards_mobile_container">Go to awards</a>
							</div>
						</div>
					</div>
					<?php

						}else {
					  		?>
					  		<p style="margin-top: 15px;">
					  			You are not enrolled as a reviewer.
					  		</p>
					  		<p>Click <a href="#" class="enrol-as-reviewer">here</a> to enrol as a reviewer.</p>

					  		<?php
					  	}
				  	}

					?>
				</div>
			</div>
			<?php

			if (in_array('Reviewer', $user->roles)) {
				include_once('./hud_files/reviewer_functions.php');
				$reviewerDashboardData = getReviewerDashboardData($user);
			?>
			<div class="mobile-content-wrapper reviewer_workz_list_mobile_container">
				<div class="hl" style="text-align:center">Reviewing Workz</div>
				<div>
					
				</div>
				<div class="mobile-text-middle-container" style="text-align:center;">
					Instruction text here
				</div>
				<hr />

				<div class="big-blue-button back-to-dashboard" style="margin-top: 20px;margin-left: auto;margin-right: auto;width: 80%;">
					<div style="font-size: 1.2rem;font-weight: bold;text-transform: uppercase;">	Back to Dashboard
					</div>
				</div>
				<div class="hl" style="text-align:center;margin-top: 20px;" id="reviewer_mobile_workz_list_type_title">Pending Workz</div>
				<div class="mobile_navigation_middle" style="margin-top:20px">
					<div class="mobile_navigation_middle_element active" target="reviewer_pending_workz_container">Pending</div>
					<div class="mobile_navigation_middle_element" target="reviewer_approved_workz_container">Approved</div>
					<div class="mobile_navigation_middle_element" target="reviewer_disapproved_workz_container">Disapproved</div>
				</div>
				<div class="mobile-text-middle-container" style="padding:0px">
					<div class="navigation_middle_target_container" id="reviewer_pending_workz_container">
						<div class="mobile-table-container" id="pending-workz-list-mobile">
							<div class="mobile-table-row row-template" id="pending-workz-list-row-template">
								<div class="mobile-table-column no-decoration">
									<div style="flex-grow: 1;width: 30%;">
										<label>
											<input type="checkbox" name="" col-name="workz-select"> Select Workz
										</label>
									</div>
								</div>
								<div class="mobile-table-column" style="display: block;">
									<img src="" col-name="workz-image" style="display: block;
									    margin-left: auto;
									    margin-right: auto;
									    width: 50%;border: 1px solid #CCC;" onerror="this.onerror=null; this.src='hud_files/images/no_image_placeholder.png'" alt="">
									    <div col-name="date" style="text-align: right;font-size: .8rem;"></div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Workz Title:</div>
									<div style="flex-grow: 1;width: 65%;" col-name="workz-title">
										Assisting Pedestrian Accross the street
									</div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Description:</div>
									<div style="flex-grow: 1;width: 65%;" col-name="description">
										Joe stopped his car and helped an elderly woman cross the street
									</div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 41%;">Samaritan:</div>
									<div style="flex-grow: 2;width: 60%;" col-name="workz-samaritan-name">
									</div>
									<div style="flex-grow: 1;width: 20%;text-align: right;margin-right: 10px;" col-name="workz-samaritan-message">
										<button class="workz-samaritan-message info" style="width: 35px;display: none;"><i class="fas fa-envelope"></i></button>
									</div>
								</div>

								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 41%;">Beneficiary:</div>
									<div style="flex-grow: 2;width: 60%;" col-name="workz-beneficiary-name">
									</div>
									<div style="flex-grow: 1;width: 20%;text-align: right;margin-right: 10px;" col-name="workz-beneficiary-message">
										<button class="workz-beneficiary-message info" style="width: 35px;display: none;"><i class="fas fa-envelope"></i></button>
									</div>
								</div>

								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 41%;">Reporter:</div>
									<div style="flex-grow: 2;width: 60%;" col-name="workz-reporter-name">
									</div>
									<div style="flex-grow: 1;width: 20%;text-align: right;margin-right: 10px;" col-name="workz-reporter-message">
										<button class="workz-reporter-message info" style="width: 35px;"><i class="fas fa-envelope"></i></button>
									</div>
								</div>
								<div class="mobile-table-column" style="justify-content:center;">
									<div style="text-align: center;">
										<a href="#" style="color: #19a7de;" col-name="samaritan-report" class="workz-mobile-column-clickable">
											Click here to view Samaritan Workz Report
										</a>
									</div>
								</div>
							</div>
							<p class="no-records-workz" style="padding:10px;text-align: center;">No records found.</p>
						</div>

						<div class="form-action" style="margin-top:10px;text-align: center;">
			                <button class="success" style="width: 30%;" id="approve-workz">Approve</button> 
			                <button class="gray" style="width: 30%;" id="disapprove-workz">Disapproved</button> 
			                <button class="danger delete-workz" style="width: 30%;">Delete</button> 
						</div>
					</div>
					<div class="navigation_middle_target_container" id="reviewer_approved_workz_container" style="padding:0px">
						<div class="mobile-table-container" id="approved-workz-list-mobile">
							<div class="mobile-table-row row-template" id="approved-workz-list-row-template">
								<div class="mobile-table-column no-decoration">
									<div style="flex-grow: 1;width: 30%;">
										<label>
											<input type="checkbox" name="" col-name="workz-select"> Select Workz
										</label>
									</div>
									<div style="flex-grow: 1;width: 0%;text-align: right;">
										<a class="btn-success workz-comments">Comments</a>
									</div>
								</div>
								<div class="mobile-table-column" style="display: block;">
									<img src="" col-name="workz-image" style="display: block;
									    margin-left: auto;
									    margin-right: auto;
									    width: 50%;border: 1px solid #CCC;" onerror="this.onerror=null; this.src='hud_files/images/no_image_placeholder.png'" alt="">
									    <div col-name="date" style="text-align: right;font-size: .8rem;"></div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Workz Title:</div>
									<div style="flex-grow: 1;width: 65%;" col-name="workz-title">
										Assisting Pedestrian Accross the street
									</div>
								</div>
								
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Description:</div>
									<div style="flex-grow: 1;width: 65%;" col-name="description">
										Joe stopped his car and helped an elderly woman cross the street
									</div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 41%;">Samaritan:</div>
									<div style="flex-grow: 2;width: 60%;" col-name="workz-samaritan-name">
									</div>
									<div style="flex-grow: 1;width: 20%;text-align: right;margin-right: 10px;" col-name="workz-samaritan-message">
										<button class="workz-samaritan-message info" style="width: 35px;display: none;"><i class="fas fa-envelope"></i></button>
									</div>
								</div>

								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 41%;">Beneficiary:</div>
									<div style="flex-grow: 2;width: 60%;" col-name="workz-beneficiary-name">
									</div>
									<div style="flex-grow: 1;width: 20%;text-align: right;margin-right: 10px;" col-name="workz-beneficiary-message">
										<button class="workz-beneficiary-message info" style="width: 35px;display: none;"><i class="fas fa-envelope"></i></button>
									</div>
								</div>

								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 41%;">Reporter:</div>
									<div style="flex-grow: 2;width: 60%;" col-name="workz-reporter-name">
									</div>
									<div style="flex-grow: 1;width: 20%;text-align: right;margin-right: 10px;" col-name="workz-reporter-message">
										<button class="workz-reporter-message info" style="width: 35px;"><i class="fas fa-envelope"></i></button>
									</div>
								</div>
								<div class="mobile-table-column" style="justify-content:center;">
									<div style="text-align: center;">
										<a href="#" style="color: #19a7de;" col-name="samaritan-report" class="workz-mobile-column-clickable">
											Click here to view Samaritan Workz Report
										</a>
									</div>
								</div>
							</div>
							<p class="no-records-workz" style="padding:10px;text-align: center;">No records found.</p>
						</div>
						<div class="form-action" style="margin-top:10px;text-align: center;">
			                <button class="danger delete-workz" style="width: 30%;">Delete</button> 
						</div>
					</div>
					<div class="navigation_middle_target_container" id="reviewer_disapproved_workz_container" style="padding:0px">
						<div class="mobile-table-container" id="disapproved-workz-list-mobile">
							<div class="mobile-table-row row-template" id="disapproved-workz-list-row-template">
								<div class="mobile-table-column no-decoration">
									<div style="flex-grow: 1;width: 30%;">
										<label>
											<input type="checkbox" name="" col-name="workz-select"> Select Workz
										</label>
									</div>
									<div style="flex-grow: 1;width: 0%;text-align: right;">
										<a class="btn-success workz-comments">Comments</a>
									</div>
								</div>
								<div class="mobile-table-column" style="display: block;">
									<img src="" col-name="workz-image" style="display: block;
									    margin-left: auto;
									    margin-right: auto;
									    width: 50%;border: 1px solid #CCC;" onerror="this.onerror=null; this.src='hud_files/images/no_image_placeholder.png'" alt="">
									    <div col-name="date" style="text-align: right;font-size: .8rem;"></div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Workz Title:</div>
									<div style="flex-grow: 1;width: 65%;" col-name="workz-title">
										Assisting Pedestrian Accross the street
									</div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Description:</div>
									<div style="flex-grow: 1;width: 65%;" col-name="description">
										Joe stopped his car and helped an elderly woman cross the street
									</div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 41%;">Samaritan:</div>
									<div style="flex-grow: 2;width: 60%;" col-name="workz-samaritan-name">
									</div>
									<div style="flex-grow: 1;width: 20%;text-align: right;margin-right: 10px;" col-name="workz-samaritan-message">
										<button class="workz-samaritan-message info" style="width: 35px;display: none;"><i class="fas fa-envelope"></i></button>
									</div>
								</div>

								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 41%;">Beneficiary:</div>
									<div style="flex-grow: 2;width: 60%;" col-name="workz-beneficiary-name">
									</div>
									<div style="flex-grow: 1;width: 20%;text-align: right;margin-right: 10px;" col-name="workz-beneficiary-message">
										<button class="workz-beneficiary-message info" style="width: 35px;display: none;"><i class="fas fa-envelope"></i></button>
									</div>
								</div>

								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 41%;">Reporter:</div>
									<div style="flex-grow: 2;width: 60%;" col-name="workz-reporter-name">
									</div>
									<div style="flex-grow: 1;width: 20%;text-align: right;margin-right: 10px;" col-name="workz-reporter-message">
										<button class="workz-reporter-message info" style="width: 35px;"><i class="fas fa-envelope"></i></button>
									</div>
								</div>
								<div class="mobile-table-column" style="justify-content:center;">
									<div style="text-align: center;">
										<a href="#" style="color: #19a7de;" col-name="samaritan-report" class="workz-mobile-column-clickable">
											Click here to view Samaritan Workz Report
										</a>
									</div>
								</div>
							</div>
							<p class="no-records-workz" style="padding:10px;text-align: center;">No records found.</p>
						</div>
						<div class="form-action" style="margin-top:10px;text-align: center;">
			                <button class="danger delete-workz" style="width: 30%;">Delete</button> 
						</div>
					</div>
				</div>
			</div>
			<div class="mobile-content-wrapper reviewer_assigned_samaritan_mobile_container">
				<div class="hl" style="text-align:center">Assigned Samaritan</div>
				<div class="mobile-text-middle-container" style="text-align:center;">
					Instruction text here
				</div>
				<hr />

				<div class="big-blue-button back-to-dashboard" style="margin-top: 20px;margin-left: auto;margin-right: auto;width: 80%;">
					<div style="font-size: 1.2rem;font-weight: bold;text-transform: uppercase;">	Back to Dashboard
					</div>
				</div>
				<div class="mobile_navigation_middle" style="margin-top:30px">
				</div>
				<div class="mobile-text-middle-container" style="padding:0px">
					<div>
						<div class="mobile-table-container" id="assigned-samaritan-list-mobile">
							<div class="mobile-table-row row-template" id="assigned-samaritan-row-template">
								<div class="mobile-table-column no-decoration">
									<div style="flex-grow: 1;width: 30%;">
										Name:
									</div>
									<div style="flex-grow: 1;width: 65%;word-break: break-all;" col-name="assigned-samaritan-name">
										John Doe
									</div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Grade Level:</div>
									<div style="flex-grow: 1;width: 65%;word-break: break-all;" col-name="assigned-samaritan-grade">
										4
									</div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">School:</div>
									<div style="flex-grow: 1;width: 65%;word-break: break-all;" col-name="assigned-samaritan-school">
										Concordia High School
									</div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Email:</div>
									<div style="flex-grow: 1;width: 65%;word-break: break-all;" col-name="assigned-samaritan-mail">
										john.doe@gmail.com
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="mobile-content-wrapper reviewer_requested_samaritan_mobile_container">
				<div class="hl" style="text-align:center">Request Samaritan</div>

				<div class="mobile-text-middle-container" style="text-align:center;">
					Instruction text here
				</div>
				<hr />

				<div class="big-blue-button back-to-dashboard" style="margin-top: 20px;margin-left: auto;margin-right: auto;width: 80%;">
					<div style="font-size: 1.2rem;font-weight: bold;text-transform: uppercase;">	Back to Dashboard
					</div>
				</div>
				<div class="mobile-text-middle-container" style="padding-top: 0px;">
					<form>
						<div class="field-group" style="width:100%;margin-top: 20px;">
							<label style="font-size: 1rem !important;"><span class="required">*</span> Select from the Drop-Down box the number of Samaritans that you wish to review:</label>
							<select class="form-control" style="font-size: 1rem !important;height: auto !important;" id="kindness_mentor_hopefuls_count">
								<?php
									for($i=1;$i<=5;$i++){
										echo "<option value='$i'>$i</option>";
									}
								?>
							</select>
            			</div>
						<div style="margin-bottom: 10px !important;margin-top: 15px;text-align: left;">
							<?php
							$isAnonymousReviewer = _reviewer_anonymous_status($user);
							?>
            				<label>
	            				<input type="checkbox" name="review_anonymous_citation" <?= $isAnonymousReviewer == '1' ? 'checked': '' ?>>
	            				<b style="margin-left: 8px;font-size: 1rem;">Request to review an anonymous samaritan</b>
	            			</label>
            			</div>
            			<div class="form-action" style="margin-top:10px;text-align: center;">
			                <button class="success" style="width: 30%;" id="request-samaritan">Submit</button> 
						</div>
					</form>
				</div>
			</div>
			<?php

			}

			?>
			<div class="mobile-content-wrapper booster_dashboard_mobile_container">
				<div class="hl" style="text-align:center">Workz</div>
				
				<div class="hopenet_middle_banner">
					<img src="/hud_files/images/citation.png" style="width: 100%;">
				</div>
				<div class="mobile_navigation_middle">
					<div class="mobile_navigation_middle_element" onclick="goToSamaritanWorkz(event)">Workz</div>
					<div class="mobile_navigation_middle_element" onclick="goToSamaritanDashboard(event)">Samaritans</div>
					<div class="citation_reporter_middle_element" target="citation_reporter">
							Reporter 
							<i class="fas fa-caret-down" style="font-size:.8rem"></i>
						<div class="citation_reporter_dropdown_nav">
							<div class="mobile_navigation_middle_element" onclick="goToSamaritanReport(event)">Report</div>
							<div class="mobile_navigation_middle_element" onclick="goToSamaritanStatus(event)">Dashboard</div>
						</div>
					</div>
					<div class="mobile_navigation_middle_element" onclick="goToSamaritanReviewerDashboard(event)"> Reviewer</div>
					<div class="mobile_navigation_middle_element active" id="mobile_navigation_middle_element_booster">Booster</div>
					<div class="mobile_navigation_middle_element" onclick="goToNews(event)">News</div>
				</div>
				<div class="mobile-text-middle-container">
					<div class="h2 mobile_middle_title">Booster Dashboard</div>
					<div class="h3">Draft:</div>
					<div style="max-height: 300px;min-height: 200px;overflow: auto;">
						<?= BOOSTER_DASHBOARD_TEXT ?>
					</div>
					<hr style="margin: 30px 0px 30px 0px">
					<?php
					if($user->uid > 0){
						if (in_array('Booster', $user->roles)) {
							include_once('./hud_files/reviewer_functions.php');
							// $reviewerDashboardData = getReviewerDashboardData($user);
					?>
					<!-- <div class="hl" style="margin-top: 20px;text-align: center;">Dashboard</div> -->
					<div class="rows-reviewer-dashboard">
						<div class="columns-reviewer-dashboard">
							<div class="reviewer-column-title">
								Workz Available for Boosting
							</div>
							<div class="reviewer-column-count" id="booster-available-workz-count">10</div>
							<div class="reviewer-column-link">
								<a href="#" target="booster_workz_list_mobile_container" target_workz_list="booster_available_workz_container">Click to view</a>
							</div>
						</div>
						<div class="columns-reviewer-dashboard">
							<div class="reviewer-column-title">
								Workz You Have Boosted
							</div>
							<div class="reviewer-column-count" id="booster-boosted-workz-count">4</div>
							<div class="reviewer-column-link">
								<a href="#" target="booster_workz_list_mobile_container" target_workz_list="booster_boosted_workz_container">Click to view</a>
							</div>
						</div>
					</div>
					<div class="rows-reviewer-dashboard">
						<div class="columns-reviewer-dashboard">
							<div class="reviewer-column-title">
								Workz Waiting For A Booster
							</div>
							<div class="reviewer-column-count" id="booster-waiting-workz-count">10</div>
							<div class="reviewer-column-link">
								<a href="#" target="booster_workz_list_mobile_container" target_workz_list="booster_waiting_workz_container">Click to view</a>
							</div>
						</div>
						<div class="columns-reviewer-dashboard">
							<div class="reviewer-column-title">
								Valiant Balance
							</div>
							<div class="reviewer-column-count" id="review-dashboard-wgold"><?= $mBalance ?></div>
							<div class="reviewer-column-link">
								<a href="#" target="rewards_mobile_container">Go to awards</a>
							</div>
						</div>
					</div>

					<?php

						}else {
					  		?>
					  		<p style="margin-top: 15px;">
					  			You are not enrolled as a booster.
					  		</p>
					  		<p>Click <a href="#" class="enrol-as-booster">here</a> to enrol as a booster.</p>

					  		<?php
					  	}
				  	}
					?>
				</div>
			</div>
			<?php

			if (in_array('Booster', $user->roles)) {
				include_once('./hud_files/reviewer_functions.php');
				// $reviewerDashboardData = getReviewerDashboardData($user);
			?>
			<div class="mobile-content-wrapper booster_workz_list_mobile_container">
				<div class="hl" style="text-align:center">Boost a Workz</div>
				<div>
					
				</div>
				<div class="mobile-text-middle-container" style="text-align:center;">
					Instruction text here
				</div>
				<hr />

				<div class="big-blue-button back-to-booster-dashboard" style="margin-top: 20px;margin-left: auto;margin-right: auto;width: 80%;">
					<div style="font-size: 1.2rem;font-weight: bold;text-transform: uppercase;">	Back to Dashboard
					</div>
				</div>
				<div class="hl" style="text-align:center;margin-top: 20px;" id="booster_mobile_workz_list_type_title">Workz Available for Boosting</div>
				<div class="mobile_navigation_middle" style="margin-top:20px">
					<div class="mobile_navigation_middle_element active" target="booster_available_workz_container">Available</div>
					<div class="mobile_navigation_middle_element" target="booster_boosted_workz_container">Boosted</div>
					<div class="mobile_navigation_middle_element" target="booster_waiting_workz_container">Waiting</div>
				</div>
				<div class="mobile-text-middle-container" style="padding:0px">
					<div class="navigation_middle_target_container" id="booster_available_workz_container">
						<div class="mobile-table-container" id="available-workz-list-mobile">
							<div class="mobile-table-row row-template" id="available-workz-list-row-template">
								<div class="mobile-table-column no-decoration">
									<div style="flex-grow: 1;width: 30%;">
										<label>
											<input type="checkbox" name="" col-name="workz-select" style="display:none"> Workz
										</label>
									</div>
									<div style="flex-grow: 1;width: 0%;text-align: right;">
										<a class="btn-success boost_citation_popup">Boost</a>
									</div>
								</div>
								<div class="mobile-table-column" style="display: block;">
									<img src="" col-name="workz-image" style="display: block;
									    margin-left: auto;
									    margin-right: auto;
									    width: 50%;border: 1px solid #CCC;" onerror="this.onerror=null; this.src='hud_files/images/no_image_placeholder.png'" alt="">
									    <div col-name="date" style="text-align: right;font-size: .8rem;"></div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Workz Title:</div>
									<div style="flex-grow: 1;width: 65%;" col-name="workz-title">
										Assisting Pedestrian Accross the street
									</div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Description:</div>
									<div style="flex-grow: 1;width: 65%;" col-name="description">
										Joe stopped his car and helped an elderly woman cross the street
									</div>
								</div>
								<div class="mobile-table-column" style="justify-content:center;">
									<div style="text-align: center;">
										<a href="#" style="color: #19a7de;" col-name="samaritan-report" class="workz-mobile-column-clickable">
											Click here to view Samaritan Workz Report
										</a>
									</div>
								</div>
							</div>
							<p class="no-records-workz" style="padding:10px;text-align: center;">No records found.</p>
						</div>
					</div>
					<div class="navigation_middle_target_container" id="booster_boosted_workz_container" style="padding:0px">
						<div class="mobile-table-container" id="boosted-workz-list-mobile">
							<div class="mobile-table-row row-template" id="boosted-workz-list-row-template">
								<div class="mobile-table-column no-decoration">
									<div style="flex-grow: 1;width: 30%;">
										<label>
											<input type="checkbox" name="" col-name="workz-select" style="display:none"> Workz
										</label>
									</div>
									<div style="flex-grow: 1;width: 0%;text-align: right;">
										<a class="btn-success workz-comments-boosted">Boosted Comment</a>
									</div>
								</div>
								<div class="mobile-table-column" style="display: block;">
									<img src="" col-name="workz-image" style="display: block;
									    margin-left: auto;
									    margin-right: auto;
									    width: 50%;border: 1px solid #CCC;" onerror="this.onerror=null; this.src='hud_files/images/no_image_placeholder.png'" alt="">
									    <div col-name="date" style="text-align: right;font-size: .8rem;"></div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Workz Title:</div>
									<div style="flex-grow: 1;width: 65%;" col-name="workz-title">
										Assisting Pedestrian Accross the street
									</div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Description:</div>
									<div style="flex-grow: 1;width: 65%;" col-name="description">
										Joe stopped his car and helped an elderly woman cross the street
									</div>
								</div>
								<div class="mobile-table-column" style="justify-content:center;">
									<div style="text-align: center;">
										<a href="#" style="color: #19a7de;" col-name="samaritan-report" class="workz-mobile-column-clickable">
											Click here to view Samaritan Workz Report
										</a>
									</div>
								</div>
							</div>
							<p class="no-records-workz" style="padding:10px;text-align: center;">No records found.</p>
						</div>
					</div>
					<div class="navigation_middle_target_container" id="booster_waiting_workz_container" style="padding:0px">
						<div class="mobile-table-container" id="waiting-workz-list-mobile">
							<div class="mobile-table-row row-template" id="waiting-workz-list-row-template">
								<div class="mobile-table-column no-decoration">
									<div style="flex-grow: 1;width: 30%;">
										<label>
											<input type="checkbox" name="" col-name="workz-select" style="display:none">Workz
										</label>
									</div>
									<div style="flex-grow: 1;width: 0%;text-align: right;">
										<a class="btn-success boost_citation_popup">Boost</a>
									</div>
								</div>

								<div class="mobile-table-column" style="display: block;">
									<img src="" col-name="workz-image" style="display: block;
									    margin-left: auto;
									    margin-right: auto;
									    width: 50%;border: 1px solid #CCC;" onerror="this.onerror=null; this.src='hud_files/images/no_image_placeholder.png'" alt="">
									    <div col-name="date" style="text-align: right;font-size: .8rem;"></div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Workz Title:</div>
									<div style="flex-grow: 1;width: 65%;" col-name="workz-title">
										Assisting Pedestrian Accross the street
									</div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Description:</div>
									<div style="flex-grow: 1;width: 65%;" col-name="description">
										Joe stopped his car and helped an elderly woman cross the street
									</div>
								</div>
								<div class="mobile-table-column" style="justify-content:center;">
									<div style="text-align: center;">
										<a href="#" style="color: #19a7de;" col-name="samaritan-report" class="workz-mobile-column-clickable">
											Click here to view Samaritan Workz Report
										</a>
									</div>
								</div>
							</div>
							<p class="no-records-workz" style="padding:10px;text-align: center;">No records found.</p>
						</div>
					</div>
				</div>
			</div>

			<?php

			}

			?>
			<?php
			if (in_array('Reporter', $user->roles)) {
			?>
			<div class="mobile-content-wrapper reporter_workz_list_mobile_container">
				<div class="big-blue-button back-to-reporter-dashboard" style="margin-top: 20px;margin-left: auto;margin-right: auto;width: 80%;">
					<div style="font-size: 1.2rem;font-weight: bold;text-transform: uppercase;">	Back to Dashboard
					</div>
				</div>
				<div class="hl" style="text-align:center;margin-top: 20px;" id="reporter_mobile_workz_list_type_title">Workz Available for Boosting</div>
				<div class="mobile_navigation_middle" style="margin-top:20px">
					<div class="mobile_navigation_middle_element" style="font-size: .9rem;" target="reporter_reports_filed_available_workz_container">Reports Filed</div>
					<div class="mobile_navigation_middle_element" style="font-size: .9rem;" target="reporter_reports_approved_available_workz_container">Reports Approved</div>
					<div class="mobile_navigation_middle_element" style="font-size: .9rem;" target="reporter_reports_pending_available_workz_container">Reports Pending</div>
					<div class="mobile_navigation_middle_element" style="font-size: .9rem;" target="reporter_reports_disapproved_available_workz_container">Reports Disapproved</div>
				</div>
				<div class="mobile-text-middle-container" style="padding:0px">
					<div class="navigation_middle_target_container" id="reporter_reports_filed_available_workz_container">
						<div class="mobile-table-container" id="reports-filed-workz-list-mobile">
							<div class="mobile-table-row row-template" id="reports-filed-workz-list-row-template">
								<div class="mobile-table-column no-decoration">
									<div style="flex-grow: 1;">
										<label>
											<input type="checkbox" name="" col-name="workz-select" style="display:none"> Workz
										</label>
									</div>
									<div style="flex-grow: 1;text-align: right;" col-name="workz-samaritan-name">
									</div>
									<div style="flex-grow: 1;text-align: right;">
										<a class="btn-success workz-comments">Comments</a>
									</div>
								</div>
								<div class="mobile-table-column" style="display: block;">
									<img src="" col-name="workz-image" style="display: block;
									    margin-left: auto;
									    margin-right: auto;
									    width: 50%;border: 1px solid #CCC;" onerror="this.onerror=null; this.src='hud_files/images/no_image_placeholder.png'" alt="">
									    <div col-name="date" style="text-align: right;font-size: .8rem;"></div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Workz Title:</div>
									<div style="flex-grow: 1;width: 65%;" col-name="workz-title">
										Assisting Pedestrian Accross the street
									</div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Description:</div>
									<div style="flex-grow: 1;width: 65%;" col-name="description">
										Joe stopped his car and helped an elderly woman cross the street
									</div>
								</div>
								<div class="mobile-table-column" style="justify-content:center;">
									<div style="text-align: center;">
										<a href="#" style="color: #19a7de;" col-name="samaritan-report" class="workz-mobile-column-clickable">
											Click here to view Samaritan Workz Report
										</a>
									</div>
								</div>
							</div>
							<p class="no-records-workz" style="padding:10px;text-align: center;">No records found.</p>
						</div>
					</div>
					<div class="navigation_middle_target_container" id="reporter_reports_approved_available_workz_container">
						<div class="mobile-table-container" id="reports-approved-workz-list-mobile">
							<div class="mobile-table-row row-template" id="reports-approved-workz-list-row-template">
								<div class="mobile-table-column no-decoration">
									<div style="flex-grow: 1;">
										<label>
											<input type="checkbox" name="" col-name="workz-select" style="display:none"> Workz
										</label>
									</div>
									<div style="flex-grow: 1;text-align: right;" col-name="workz-samaritan-name">
									</div>
									<div style="flex-grow: 1;text-align: right;">
										<a class="btn-success workz-comments">Comments</a>
									</div>
								</div>
								<div class="mobile-table-column" style="display: block;">
									<img src="" col-name="workz-image" style="display: block;
									    margin-left: auto;
									    margin-right: auto;
									    width: 50%;border: 1px solid #CCC;" onerror="this.onerror=null; this.src='hud_files/images/no_image_placeholder.png'" alt="">
									    <div col-name="date" style="text-align: right;font-size: .8rem;"></div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Workz Title:</div>
									<div style="flex-grow: 1;width: 65%;" col-name="workz-title">
										Assisting Pedestrian Accross the street
									</div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Description:</div>
									<div style="flex-grow: 1;width: 65%;" col-name="description">
										Joe stopped his car and helped an elderly woman cross the street
									</div>
								</div>
								<div class="mobile-table-column" style="justify-content:center;">
									<div style="text-align: center;">
										<a href="#" style="color: #19a7de;" col-name="samaritan-report" class="workz-mobile-column-clickable">
											Click here to view Samaritan Workz Report
										</a>
									</div>
								</div>
							</div>
							<p class="no-records-workz" style="padding:10px;text-align: center;">No records found.</p>
						</div>
					</div>
					<div class="navigation_middle_target_container" id="reporter_reports_pending_available_workz_container">
						<div class="mobile-table-container" id="reports-pending-workz-list-mobile">
							<div class="mobile-table-row row-template" id="reports-pending-workz-list-row-template">
								<div class="mobile-table-column no-decoration">
									<div style="flex-grow: 1;">
										<label>
											<input type="checkbox" name="" col-name="workz-select" style="display:none"> Workz
										</label>
									</div>
									<div style="flex-grow: 1;text-align: right;" col-name="workz-samaritan-name">
									</div>
									<div style="flex-grow: 1;text-align: right;">
										<a class="btn-success workz-comments">Comments</a>
									</div>
								</div>
								<div class="mobile-table-column" style="display: block;">
									<img src="" col-name="workz-image" style="display: block;
									    margin-left: auto;
									    margin-right: auto;
									    width: 50%;border: 1px solid #CCC;" onerror="this.onerror=null; this.src='hud_files/images/no_image_placeholder.png'" alt="">
									    <div col-name="date" style="text-align: right;font-size: .8rem;"></div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Workz Title:</div>
									<div style="flex-grow: 1;width: 65%;" col-name="workz-title">
										Assisting Pedestrian Accross the street
									</div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Description:</div>
									<div style="flex-grow: 1;width: 65%;" col-name="description">
										Joe stopped his car and helped an elderly woman cross the street
									</div>
								</div>
								<div class="mobile-table-column" style="justify-content:center;">
									<div style="text-align: center;">
										<a href="#" style="color: #19a7de;" col-name="samaritan-report" class="workz-mobile-column-clickable">
											Click here to view Samaritan Workz Report
										</a>
									</div>
								</div>
							</div>
							<p class="no-records-workz" style="padding:10px;text-align: center;">No records found.</p>
						</div>
					</div>
					<div class="navigation_middle_target_container" id="reporter_reports_disapproved_available_workz_container">
						<div class="mobile-table-container" id="reports-disapproved-workz-list-mobile">
							<div class="mobile-table-row row-template" id="reports-disapproved-workz-list-row-template">
								<div class="mobile-table-column no-decoration">
									<div style="flex-grow: 1;">
										<label>
											<input type="checkbox" name="" col-name="workz-select" style="display:none"> Workz
										</label>
									</div>
									<div style="flex-grow: 1;text-align: right;" col-name="workz-samaritan-name">
									</div>
									<div style="flex-grow: 1;text-align: right;">
										<a class="btn-success workz-comments">Comments</a>
									</div>
								</div>
								<div class="mobile-table-column" style="display: block;">
									<img src="" col-name="workz-image" style="display: block;
									    margin-left: auto;
									    margin-right: auto;
									    width: 50%;border: 1px solid #CCC;" onerror="this.onerror=null; this.src='hud_files/images/no_image_placeholder.png'" alt="">
									    <div col-name="date" style="text-align: right;font-size: .8rem;"></div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Workz Title:</div>
									<div style="flex-grow: 1;width: 65%;" col-name="workz-title">
										Assisting Pedestrian Accross the street
									</div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Description:</div>
									<div style="flex-grow: 1;width: 65%;" col-name="description">
										Joe stopped his car and helped an elderly woman cross the street
									</div>
								</div>
								<div class="mobile-table-column" style="justify-content:center;">
									<div style="text-align: center;">
										<a href="#" style="color: #19a7de;" col-name="samaritan-report" class="workz-mobile-column-clickable">
											Click here to view Samaritan Workz Report
										</a>
									</div>
								</div>
							</div>
							<p class="no-records-workz" style="padding:10px;text-align: center;">No records found.</p>
						</div>
					</div>
				</div>
			</div>

			<?php

			}

			?>

			<div class="mobile-content-wrapper samaritan_workz_list_mobile_container">
				<div class="big-blue-button back-to-samaritan-dashboard" style="margin-top: 20px;margin-left: auto;margin-right: auto;width: 80%;">
					<div style="font-size: 1.2rem;font-weight: bold;text-transform: uppercase;">	Back to Dashboard
					</div>
				</div>
				<div class="hl" style="text-align:center;margin-top: 20px;" id="samaritan_mobile_workz_list_type_title">Pending Workz</div>
				<div class="mobile_navigation_middle" style="margin-top:20px">
					<div class="mobile_navigation_middle_element" style="font-size: .9rem;" target="samaritan_pending_workz_container">Pending Workz</div>
					<div class="mobile_navigation_middle_element" style="font-size: .9rem;" target="samaritan_approved_workz_container">Approved Workz</div>
				</div>
				<div class="mobile-text-middle-container" style="padding:0px">
					<div class="navigation_middle_target_container" id="samaritan_pending_workz_container">
						<div class="mobile-table-container" id="samaritan-pending-workz-list-mobile">
							<div class="mobile-table-row row-template" id="samaritan-pending-workz-list-row-template">
								<div class="mobile-table-column no-decoration">
									<div style="flex-grow: 1;">
										<label>
											<input type="checkbox" name="" col-name="workz-select" style="display:none"> Workz
										</label>
									</div>
									<div style="flex-grow: 1;text-align: right;" col-name="workz-samaritan-name">
									</div>
									<div style="flex-grow: 1;text-align: right;">
										<a class="btn-success workz-comments">Comments</a>
									</div>
								</div>
								<div class="mobile-table-column" style="display: block;">
									<img src="" col-name="workz-image" style="display: block;
									    margin-left: auto;
									    margin-right: auto;
									    width: 50%;border: 1px solid #CCC;" onerror="this.onerror=null; this.src='hud_files/images/no_image_placeholder.png'" alt="">
									    <div col-name="date" style="text-align: right;font-size: .8rem;"></div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Workz Title:</div>
									<div style="flex-grow: 1;width: 65%;" col-name="workz-title">
										Assisting Pedestrian Accross the street
									</div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Description:</div>
									<div style="flex-grow: 1;width: 65%;" col-name="description">
										Joe stopped his car and helped an elderly woman cross the street
									</div>
								</div>
								<div class="mobile-table-column" style="justify-content:center;">
									<div style="text-align: center;">
										<a href="#" style="color: #19a7de;" col-name="samaritan-report" class="workz-mobile-column-clickable">
											Click here to view Samaritan Workz Report
										</a>
									</div>
								</div>
							</div>
							<p class="no-records-workz" style="padding:10px;text-align: center;">No records found.</p>
						</div>
					</div>
					<div class="navigation_middle_target_container" id="samaritan_approved_workz_container">
						<div class="mobile-table-container" id="samaritan-approved-workz-list-mobile">
							<div class="mobile-table-row row-template" id="samaritan-approved-workz-list-row-template">
								<div class="mobile-table-column no-decoration">
									<div style="flex-grow: 1;">
										<label>
											<input type="checkbox" name="" col-name="workz-select" style="display:none"> Workz
										</label>
									</div>
									<div style="flex-grow: 1;text-align: right;" col-name="workz-samaritan-name">
									</div>
									<div style="flex-grow: 1;text-align: right;">
										<a class="btn-success workz-comments">Comments</a>
									</div>
								</div>
								<div class="mobile-table-column" style="display: block;">
									<img src="" col-name="workz-image" style="display: block;
									    margin-left: auto;
									    margin-right: auto;
									    width: 50%;border: 1px solid #CCC;" onerror="this.onerror=null; this.src='hud_files/images/no_image_placeholder.png'" alt="">
									    <div col-name="date" style="text-align: right;font-size: .8rem;"></div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Workz Title:</div>
									<div style="flex-grow: 1;width: 65%;" col-name="workz-title">
										Assisting Pedestrian Accross the street
									</div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Description:</div>
									<div style="flex-grow: 1;width: 65%;" col-name="description">
										Joe stopped his car and helped an elderly woman cross the street
									</div>
								</div>
								<div class="mobile-table-column" style="justify-content:center;">
									<div style="text-align: center;">
										<a href="#" style="color: #19a7de;" col-name="samaritan-report" class="workz-mobile-column-clickable">
											Click here to view Samaritan Workz Report
										</a>
									</div>
								</div>
							</div>
							<p class="no-records-workz" style="padding:10px;text-align: center;">No records found.</p>
						</div>
					</div>
				</div>
			</div>
		<div class="mobile-content-wrapper help_mobile_container">
			<div class="hl" style="text-align:center">Help</div>
			<div>
				
			</div>
			<div class="mobile-text-middle-container">
				Coming Soon!
			</div>
		</div>
		<div class="mobile-content-wrapper citation_mobile_container">
			<div class="hl" style="text-align:center">Workz</div>
			<div class="hopenet_middle_banner">
				<img src="/hud_files/images/citation.png" style="width: 100%;">
			</div>
			<div class="mobile_navigation_middle">
				<div class="mobile_navigation_middle_element" target="citation_workz">Workz</div>
				<div class="mobile_navigation_middle_element active" target="citation_samaritan">Samaritans</div>
				<div class="citation_reporter_middle_element" target="citation_reporter">
						Reporter 
						<i class="fas fa-caret-down" style="font-size:.8rem"></i>
					<div class="citation_reporter_dropdown_nav">
						<div class="mobile_navigation_middle_element" target="citation_report">Report</div>
						<div class="mobile_navigation_middle_element" target="citation_status" style="display:none;">Dashboard</div>
					</div>
				</div>
				<div class="mobile_navigation_middle_element" target="reviewer_dashboard">Reviewer</div>
				<div class="mobile_navigation_middle_element" target="mentor_dashboard">Booster</div>
				<div class="mobile_navigation_middle_element" target="citation_news">News</div>
			</div>
			<div class="mobile-text-middle-container">
				<div class="navigation_middle_target_container" id="citation_samaritan">
					<div class="h2 mobile_middle_title">Samaritan Dashboard</div>
					<div class="h3">Draft:</div>
					<p>
						<?= CITATION_SAMARITAN_TEXT ?>
					</p>
					<hr style="margin: 30px 0px 30px 0px" />
					<?php

					if ($user->uid > 0) {
						if (in_array('Samaritan', $user->roles)) {
					?>
					<div class="rows-reviewer-dashboard">
						<div class="columns-reviewer-dashboard">
							<div class="reviewer-column-title">
								Pending Workz
							</div>
							<div class="reviewer-column-count" id="samaritan_pending_count_mobile">-</div>
							<div class="reviewer-column-link">
								<a href="#" target="samaritan_workz_list_mobile_container" target_workz_list="samaritan_pending_workz_container">Click to view</a>
							</div>
						</div>
						<div class="columns-reviewer-dashboard">
							<div class="reviewer-column-title">
								Approved Workz
							</div>
							<div class="reviewer-column-count" id="samaritan_approved_count_mobile">-</div>
							<div class="reviewer-column-link">
								<a href="#" target="samaritan_workz_list_mobile_container" target_workz_list="samaritan_approved_workz_container">Click to view</a>
							</div>
						</div>
					</div>
					<div class="rows-reviewer-dashboard">
						<div class="columns-reviewer-dashboard">
							<div class="reviewer-column-title">
								Valiant Balance
							</div>
							<div class="reviewer-column-count" id="review-dashboard-wgold"><?= $mBalance ?></div>
							<div class="reviewer-column-link">
								<a href="#" target="rewards_mobile_container">Go to awards</a>
							</div>
						</div>
					</div>
					<?php
						}
					}
					?>
				</div>
				<div class="navigation_middle_target_container" id="citation_report">
					<div class="h2 mobile_middle_title">How to File a Samaritan Report</div>
					<div class="h3">Draft:</div>
					<p>
						<?= CITATION_REPORT_TEXT ?>
					</p>
					<div class="read-more-container">
						<a href="#" class="readmore" target="citation-report-readmore">Read More</a>
						<div id="citation-report-readmore" class="d-none">
							<?= CITATION_REPORT_TEXT_MORE ?>
							<a href="#" class="showless" target="citation-report-readmore">Show Less</a>
						</div>
					</div>
					<hr style="margin: 30px 0px 30px 0px" />
					<?php

					if ($user->uid > 0) {
					?>
					<div class="citation_report_container" style="display:none;">
						<div class="citation_report_wizard_header active" target="benefactor_information">Samaritan Information</div>
						<div class="citation_report_wizard_header" target="beneficiary_information">Beneficiary Information</div>
					</div>
					<?php

			      	if (in_array('Reporter', $user->roles)) {

			      	?>
					<form id="workz_form_v2_mobile">
						<div class="citation_report_wizard_target active" id="mobile-container-workz-wizard-b1">
							<div style="margin-top: 20px;text-align: center;">
								<div class="h3">Samaritan Report</div>
								<div class="h4" style="margin-top:20px">Workz Information</div>
								<div class="form-wizard-content-form">
									<div class="field-group">
											<label style="font-weight: bold;">Fields with <small style="color:red">*</small> are required
			            			</div>

			            			<div id="workz-type-main-container" style="margin-bottom:10px;">
				            			<div class="field-group" id="workz-type-container" style="width:50%;margin-top: 20px;">
												<label><span class="required">*</span> Workz Type:</label>
												<select class="form-control" id="workz-type_mobile" required name="workz_type">
													<option value="">Select Workz Type</option>
													<option value="Valor Workz">Valor Workz</option>
													<option value="Kindness Workz">Kindness Workz</option>
													<option value="Random Kindness Workz">Random Kindness Workz</option>
												</select>
				            			</div>
				            			<div style="margin-top: 20px;display: none;" class="kind-type-options-container" id="kindness-act-fields-container_mobile">
				            				<div style="margin-bottom: 10px;"><b>Duration</b></div>
				            				<small>Specify how long your workz lasted in hours and minutes</small>
				            				<div style="display: flex;margin-top: 20px;">
						            			<div class="field-group" style="margin-right: auto;">
						            				<label>Duration (hours)</label>
														<select class="form-control" name="iKindnessHour">
															<?php
															for ($h=0; $h<=480; $h+=60){
																$sUnit = ($h > 60) ? "hours":"hour";
																?>
																<option value="<?php echo $h ?>"><?php echo ($h/60)." ".$sUnit ; ?></option>
																<?php
															}
															?>
														</select>
						            			</div>
						            			<div class="field-group" style="margin-right: auto;" name="">
						            				<label>Duration (Minutues)</label>
														<select class="form-control" name="iKindnessMinute">
															<?php
															for ($m=0; $m<=59; $m++){
																$sUnit = ($m > 0) ? "minutes":"minute";
																$sMin = str_pad($m, 2, "0", STR_PAD_LEFT);
																?>
																<option value="<?php echo $sMin ?>"><?php echo $sMin." ".$sUnit;?></option>
																<?php
															}
															?>
														</select>
						            			</div>
						            		</div>
				            			</div>
				            			<div style="margin-top: 20px;display: none;" class="kind-type-options-container" id="valor-act-fields-container_mobile">
				            				<div style="width: 50%;margin-top: 20px;">
						            			<div class="field-group" style="margin-right: auto;">
						            				<label>Valor Type</label>
														<select class="form-control" name="valor_act_type">
															<option>Bronze</option>
															<option>Silver</option>
															<option>Gold</option>
														</select>
						            			</div>
						            		</div>
				            			</div>
				            			<div style="margin-top: 20px;display: none;" class="kind-type-options-container" id="kindness-act-type-fields-container_mobile">
				            				<div style="width: 50%;margin-top: 20px;">
						            			<div class="field-group" style="margin-right: auto;">
						            				<label>Kindness Workz Type</label>
														<select class="form-control" name="kindness_act_type">
															<option>Commendation</option>
															<option>Meritorious</option>
															<option>Distinguished</option>
														</select>
						            			</div>
						            		</div>
				            			</div>
				            		</div>
			            			<div class="field-group">
											<label><span class="required">*</span> Workz Title:</label>
										   <input type="text" class="form-control" placeholder="Give the Workz title" required name="sKindnessTitle">
			            			</div>
			            			<div class="field-group">
											<label><span class="required">*</span> Workz Address/Location:</label>
											<textarea class="form-control" placeholder="The address of the location where the Workz was performed" required name="sKindnessLocation"></textarea>
			            			</div>
			            			<div class="field-group">
											<label><span class="required">*</span> Workz Description:</label>
											<textarea class="form-control" placeholder="Write a description of the Workz activity that the person performed"  required name="sKindnessDesc"></textarea>
			            			</div>
		            				<div class="field-group" style="width:50%;margin-top: 20px;">
			            				<label><span class="required">*</span> Workz Date</label>
											<input type="date" class="form-control" name="dDate" required>
			            			</div>
			            			<div style="display: none;margin-top: 20px;" class="camera-fields">
			            				<div style="margin-right: auto;width: 49%;">
			            					<a class="upload-field-button">Start Camera</a> 
			            					<b style="margin-left: 8px;font-size: 12px;">Click to take a pic or video of Workz</b>
			            				</div>
			            			</div>
			            			<div style="display: flex;margin-top: 20px;margin-bottom: 10px;text-align: left;" class="camera-fields">
			            				<div>
			            					<a class="upload-field-button" id="upload-workz_mobile"  style="width: 109px;">Browse</a> 
			            					<input type="file" id="workz-picture_mobile" style="display:none" onChange="uploadOnChange('workz-picture_mobile', 'workz-picture_mobile-filename')">
			            					<input type="text" id="workz-picture_mobile-filename" name="workz-picture-filename" style="display:none">
			            					<b style="margin-left: 8px;font-size: 12px;">Click to upload a pic or video of Workz</b>
			            					<div id="workz-picture_mobile-preview-container" style="display:none;margin-top: 10px;">
			            						<a href="" id="workz-picture_mobile-preview" target="_blank"></a>
			            					</div>
			            				</div>
			            			</div>
			            			<div class="h4" style="margin-top:20px">Samaritan Contact Information</div>
			            			<div style="margin-bottom: 10px !important;margin-top: 15px;text-align: left;" class="anonymous-field-container benefactor-info-fields-container">
			            				<label>
				            				<input type="checkbox" name="is_benefactor_anonymous">
				            				<b style="margin-left: 8px;font-size: 12px;">Check if samaritan is anonymous</b>
				            			</label>
			            			</div>
			            			<div class="benefactor-info-fields-container benefactor-data-container">
										<div style="margin-bottom: 10px !important;margin-top: 15px;text-align: left;" class="anonymous-field-container">
				            				<label>
					            				<input type="checkbox" name="is_benefactor_same_user">
					            				<b style="margin-left: 8px;font-size: 12px;">Are you the samaritan of this workz?</b>
					            			</label>
				            			</div>
				            			<div class="field-group benefactor-container-fields">
												<label><span class="required">*</span> First Name:</label>
											   <input type="text" class="form-control" placeholder="First Name of the person who performed the Workz" required name="benefactor_first_name">
				            			</div>

				            			<div class="field-group benefactor-container-fields">
												<label><span class="required">*</span> Last Name:</label>
											   <input type="text" class="form-control" placeholder="Last Name of the person who performed the Workz" required name="benefactor_last_name">
				            			</div>
				            			<div class="field-group benefactor-container-fields">
												<label>Address:</label>
												<textarea class="form-control" placeholder="Mailing address of the person who performed the Workz" name="benefactor_address"></textarea>
				            			</div>
				            			<div class="field-group benefactor-container-fields">
												<label>Phone:</label>
											   <input type="text" class="form-control" placeholder="Phone Number of the person who performed the Workz" name="benefactor_phone">
				            			</div>
				            			<div class="field-group benefactor-container-fields">
												<label>Email:</label>
											   <input type="text" class="form-control" placeholder="Email of the person who performed the Workz" name="benefactor_email">
				            			</div>
				            			<div style="display: none;margin-top: 20px;" class="camera-fields">
				            				<div style="margin-right: auto;width: 49%;" class="benefactor-container-fields">
				            					<a class="upload-field-button">Start Camera</a> 
				            					<b style="margin-left: 8px;font-size: 12px;">Click to take a pic of samaritan</b>
				            				</div>
				            			</div>
				            			<div style="display: flex;margin-top: 20px;margin-bottom: 10px;text-align: left;" class="camera-fields">
				            				<div class="benefactor-container-fields">
				            					<a class="upload-field-button" id="upload-benefactor_mobile" style="width: 109px;">Browse</a> 
				            					<input type="file" id="benefactor-picture_mobile" style="display:none" onChange="uploadOnChange('benefactor-picture_mobile', 'benefactor-picture-filename_mobile')">
				            					<input type="text" id="benefactor-picture-filename_mobile" name="benefactor-picture-filename" style="display:none">
				            					<b style="margin-left: 8px;font-size: 12px;">Click to upload a pic of samaritan</b>
				            					<div id="benefactor-picture_mobile-preview-container" style="display:none;margin-top: 10px;">
				            						<a href="" id="benefactor-picture_mobile-preview" target="_blank"></a>
				            					</div>
				            				</div>
				            			</div>
				            			<div style="border-top: 1px solid #bbbbbb;margin-top: 30px;" class="benefactor-container-fields">
				            				<div style="text-align: center;margin-top: 5px;margin-bottom: 20px;padding-top: 20px;">
						            			<div class="h3">Samaritan Organization Information</div>
						            		</div>
						            		<div class="form-wizard-content-form">
							            		<div class="field-group">
														<label>Name:</label>
													   <input type="text" class="form-control" placeholder="Name of the organization samaritan is assigned to" name="benefactor_department_name">
						            			</div>
						            			<div class="field-group">
														<label>Address:</label>
														<textarea class="form-control" placeholder="Street address of the organization samaritan is assigned to" name="benefactor_department_address"></textarea>
						            			</div>
							            		<div class="field-group">
														<label>Phone:</label>
													   <input type="text" class="form-control" placeholder="Phone number of the organization samaritan is assigned to" name="benefactor_department_phone">
						            			</div>
							            		<div class="field-group">
														<label>Email:</label>
													   <input type="text" class="form-control" placeholder="Email of the organization samaritan is assigned to" name="benefactor_department_email">
						            			</div>
						            		</div>
				            			</div>
			            			</div>
			            		</div>
								<div class="form-action">
					                <input type="button" name="op" value="Next" class="btnuser" id="b1-next-button-mobile" style="margin-top:30px" /> 
					                <button id="b1-bypass-mobile" class="danger" style="margin-top:10px" >ByPass</button> 
								</div>
							</div>
						</div>
						<div class="citation_report_wizard_target" id="mobile-container-workz-wizard-b2">
							<div style="margin-top: 20px;text-align: center;">
								<div class="h3">Samaritan Report</div>
								<div class="h4" style="margin-top:20px">Beneficiary Contact Information</div>
								<div class="form-wizard-content-form">
									<div class="field-group">
											<label style="font-weight: bold;">Fields with <small style="color:red">*</small> are required
			            			</div>
			            			<div class="beneficiary-info-fields-container beneficiary-container-fields">
				            			<div style="margin-bottom: 10px !important;margin-top: 15px;text-align: left;" class="anonymous-field-container">
				            				<label>
					            				<input type="checkbox" name="is_beneficiary_anonymous">
					            				<b style="margin-left: 8px;font-size: 12px;">Check if beneficiary is anonymous</b>
					            			</label>
				            			</div>
			            			</div>
			            			<div class="beneficiary-info-fields-container beneficiary-container-fields beneficiary-data-container">
				            			<div class="field-group beneficiary-container-fields">
												<label><span class="required">*</span> First Name:</label>
											   <input type="text" class="form-control" placeholder="First Name of the person who benefited from the Workz" required name="sToWhomFirstName">
				            			</div>
				            			<div class="field-group beneficiary-container-fields">
												<label><span class="required">*</span> Last Name:</label>
											   <input type="text" class="form-control" placeholder="Last Name of the person who benefited from the Workz" required name="sToWhomLastName">
				            			</div>
				            			<div class="field-group beneficiary-container-fields">
												<label>Address:</label>
												<textarea class="form-control" placeholder="Mailing address of the person who benefited from the Workz" name="beneficiary_address"></textarea>
				            			</div>
				            			<div class="field-group">
												<label>Phone:</label>
											   <input type="text" class="form-control" placeholder="Phone number of the person who benefited from the Workz" name="beneficiary_phone">
				            			</div>
				            			<div class="field-group">
												<label>Email:</label>
											   <input type="text" class="form-control" placeholder="Email of the person who benefited from the Workz" name="beneficiary_email">
				            			</div>

				            			<div style="margin-top: 20px;display: none;" class="camera-fields">
				            				<div>
				            					<a class="upload-field-button">Start Camera</a> 
				            					<b style="margin-left: 8px;font-size: 12px;">Click to take a pic of beneficiary</b>
				            				</div>
				            			</div>
				            			<div style="margin-top: 20px;text-align: left;" class="camera-fields">
				            				<div>
				            					<a class="upload-field-button" id="upload-beneficiary_mobile" style="width: 109px;">Browse</a> 
				            					<input type="file" id="beneficiary-picture_mobile" style="display:none" onChange="uploadOnChange('beneficiary-picture_mobile', 'beneficiary-picture-filename_mobile')">
				            					<input type="text" id="beneficiary-picture-filename_mobile" name="beneficiary-picture-filename" style="display:none">
				            					<b style="margin-left: 8px;font-size: 12px;">Click to upload a pic or beneficiary</b>
				            					<div id="beneficiary-picture_mobile-preview-container" style="display:none;margin-top: 10px;">
				            						<a href="" id="beneficiary-picture_mobile-preview" target="_blank"></a>
				            					</div>
				            				</div>
				            			</div>	           
			            			</div>
			            			<div class="field-group" style="margin-top: 20px;margin-bottom: 20px !important; ">
										<label><span class="required">*</span> Beneficiary Type:</label>
										<select class="form-control" id="beneficiary-type" required name="sToWhomType">
											<option value="">Select Beneficiary Type</option>
											<option value="Family/Relative">Family/Relative</option>
											<option value="Neighbor">Neighbor</option>
											<option value="Stranger">Stranger</option>
											<option value="Community">Community</option>
										</select>
			            			</div>
			            		</div>
								<div class="form-action">
					                <input type="submit" name="op" value="Previous" style="width:45%" id="b2-previous-button-mobile" /> 
					                <input type="button" name="op" value="Submit" class="success" id="b2-submit-mobile" style="width:45%" /> 
					                <button id="b2-bypass-mobile" class="danger" style="margin-top:10px" >ByPass</button> 
								</div>
							</div>
						</div>
					</form>

					<?php

				      	} else {
				      		?>
				      		<p style="margin-top: 15px;">
				      			You are not enrolled as a reporter.
				      		</p>
				      		<p>Click <a href="#" class="enrol-as-reporter">here</a> to enrol as a reporter.</p>

				      		<?php
				      	}

				    ?>
				    <?php
					}
				    ?>
				</div>
				<div class="navigation_middle_target_container" id="citation_status">
					<div class="h2 mobile_middle_title">Reporter Dashboard</div>
					<div class="h3">Draft:</div>
					<div style="max-height: 300px;overflow: auto;">
						<?= CITATION_STATUS_TEXT ?>
					</div>
					<hr style="margin: 30px 0px 30px 0px" />
					<?php

					if ($user->uid > 0) {
						if (in_array('Reporter', $user->roles)) {

					?>
					<div class="citation_status_container" style="display:none;">
						<div class="citation_status_navigation_header active" target="my_staus">My Status</div>
						<div class="citation_status_navigation_header" target="my_benefactor_status">My Samaritan Status</div>
					</div>
					<div style="margin-top: 20px;text-align: center;display: none;">
						<div class="h3" style="margin-bottom:10px">Workz Status</div>
						<div style="display: flex;text-align: left;">
						</div>
					</div>
					<div id="workz-list-temporary-container" style="display:none;"></div>
					<div style="text-align: center;display: none;">
						<div class="h3" style="margin-bottom:10px">Workz List</div>
						<div class="mobile-table-container" id="workz-list-mobile">
							<div class="mobile-table-row row-template" id="workz-list-row-template">
								<div class="mobile-table-column workz-mobile-column-clickable">
									<div style="flex-grow: 1;width: 30%;">Title/Type:</div>
									<div style="flex-grow: 1;width: 65%;">
										<div class="workz-title-mobile">Sample Workz 1</div>
										<div class="workz-type-mobile">Kindness Workz</div>
									</div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Name:</div>
									<div style="flex-grow: 1;width: 65%;" class="workz-benefactor-mobile">
										John Doe
									</div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Date:</div>
									<div style="flex-grow: 1;width: 65%;" class="workz-date-mobile">
										September 29, 2022
									</div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Status:</div>
									<div style="flex-grow: 1;width: 65%;" class="workz-status-mobile">
										Pending
									</div>
								</div>
								<div class="mobile-table-column" style="display:none">
									<div style="flex-grow: 1;text-align: center;" class="workz-certificate-mobile">
										<a href="" target="_blank" style="color: #026eb0;">View Certificate</a>
									</div>
								</div>
							</div>
							<p class="no-records-workz">No records found.</p>
						</div>
					</div>

					<div class="rows-reviewer-dashboard">
						<div class="columns-reviewer-dashboard">
							<div class="reviewer-column-title">
								Reports Filed
							</div>
							<div class="reviewer-column-count" id="all_workz_status_count_mobile">-</div>
							<div class="reviewer-column-link">
								<a href="#" target="reporter_workz_list_mobile_container" target_workz_list="reporter_reports_filed_available_workz_container">Click to view</a>
							</div>
						</div>
						<div class="columns-reviewer-dashboard">
							<div class="reviewer-column-title">
								Reports Approved
							</div>
							<div class="reviewer-column-count" id="approved_workz_count_mobile">-</div>
							<div class="reviewer-column-link">
								<a href="#" target="reporter_workz_list_mobile_container" target_workz_list="reporter_reports_approved_available_workz_container">Click to view</a>
							</div>
						</div>
					</div>
					<div class="rows-reviewer-dashboard">
						<div class="columns-reviewer-dashboard">
							<div class="reviewer-column-title">
								Reports Pending
							</div>
							<div class="reviewer-column-count" id="pending_workz_count_mobile">-</div>
							<div class="reviewer-column-link">
								<a href="#" target="reporter_workz_list_mobile_container" target_workz_list="reporter_reports_pending_available_workz_container">Click to view</a>
							</div>
						</div>
						<div class="columns-reviewer-dashboard">
							<div class="reviewer-column-title">
								Reports Disapproved
							</div>
							<div class="reviewer-column-count" id="disapproved_workz_count_mobile">-</div>
							<div class="reviewer-column-link">
								<a href="#" target="reporter_workz_list_mobile_container" target_workz_list="reporter_reports_disapproved_available_workz_container">Click to view</a>
							</div>
						</div>
					</div>
					<div class="rows-reviewer-dashboard">
						<div class="columns-reviewer-dashboard">
							<div class="reviewer-column-title">
								Duration
							</div>
							<div class="reviewer-column-count" id="kindness_total_hours_mobile" style="font-size:1rem">-</div>
						</div>

						<div class="columns-reviewer-dashboard">
							<div class="reviewer-column-title">
								Valiant Balance
							</div>
							<div class="reviewer-column-count" id="review-dashboard-wgold"><?= $mBalance ?></div>
							<div class="reviewer-column-link">
								<a href="#" target="rewards_mobile_container">Go to awards</a>
							</div>
						</div>
					</div>
					<div class="rows-reviewer-dashboard">
						<?php
							$mySamaritanBalanceQuery = _bank_post("multiple_balance", array("key" => $oDetails->account_number, "pass" => $oDetails->account_pass, 'samaritanAccountNumbers' => _getSamaritansAccountNumber()));
							$mySamaritanBalance = (int)$mySamaritanBalanceQuery["RETURN"]["BALANCE"];

						?>
						<div class="columns-reviewer-dashboard">
							<div class="reviewer-column-title">
								Samaritan Valiant Balance
							</div>
							<div class="reviewer-column-count" id="booster-boosted-workz-count"><?= $mySamaritanBalance ?></div>
						</div>
					</div>
					<?php
						}else {
					  		?>
					  		<p style="margin-top: 15px;">
					  			You are not enrolled as a reporter.
					  		</p>
					  		<p>Click <a href="#" class="enrol-as-reporter">here</a> to enrol as a reporter.</p>

					  		<?php
					  	}
					}
					?>
				</div>
				
				<div class="navigation_middle_target_container" id="mentor_dashboard">
					<div class="h2 mobile_middle_title">Booster Information</div>
					<?= MENTOR_INFORMATION_TEXT ?>
				</div>
			</div>
			<div style="margin-top: -40px;">
				<div class="navigation_middle_target_container" id="citation_workz">
					<div class="h2 mobile_middle_title">Samaritan Workz</div>
						<div class="mobile-text-middle-container">
							<?= CITATION_TEXT ?>
						</div>
						<div style="">
							<h2 style="padding-top:5px;color:'.$colork.';font-weight:bold;text-align:center;margin-bottom:20px;font-size: 1.2rem;">Samaritan Workz Map</h2>
							<iframe src="/map.php" style="outline: none;
						    border: none;
						    width: 100%;
						    height: 300px;" id="all-workz-map">
							</iframe>
						    <p style="margin-top: 15px;text-align: center;font-size: 1rem">
						    	The red pin marker on the map shows the approximate location where the Samaritan workz was performed
						    </p>
						    <div class="workz_list_container_header">
								<div class="workz_list_tab_header active" target="approved_workz_list_container">Workz List</div>
							</div>
							<div style="margin-type: 30px;font-size: 1.2rem;">
								<div class="workz_list_container" id="pending_workz_list_container">
									<div class="mobile-table-container" id="all-pending-workz-list-mobile">
										<div class="mobile-table-row row-template" id="all-pending-workz-list-row-template">
											<div class="mobile-table-column no-decoration">
												<div style="flex-grow: 1;width: 30%;">
													<label>
														<input type="checkbox" name="" col-name="workz-select" style="display:none"> Workz
													</label>
												</div>
											</div>
											<div class="mobile-table-column" style="display: block;">
												<img src="" col-name="workz-image" style="display: block;
												    margin-left: auto;
												    margin-right: auto;
												    width: 50%;border: 1px solid #CCC;" onerror="this.onerror=null; this.src='hud_files/images/no_image_placeholder.png'" alt="">
												    <div col-name="date" style="text-align: right;font-size: .8rem;margin-top: 10px;"></div>
											</div>
											<div class="mobile-table-column">
												<div style="flex-grow: 1;width: 30%;">Workz Title:</div>
												<div style="flex-grow: 1;width: 65%;" col-name="workz-title">
													Assisting Pedestrian Accross the street
												</div>
											</div>
											<div class="mobile-table-column">
												<div style="flex-grow: 1;width: 30%;">Description:</div>
												<div style="flex-grow: 1;width: 65%;" col-name="description">
													Joe stopped his car and helped an elderly woman cross the street
												</div>
											</div>
											<div class="mobile-table-column" style="justify-content:center;">
												<div style="text-align: center;">
													<a href="#" style="color: #19a7de;" col-name="samaritan-report" class="workz-mobile-column-clickable">
														Click here to view Samaritan Workz Report
													</a>
												</div>
											</div>
										</div>
										<p class="no-records-workz" style="padding:10px;text-align: center;">No records found.</p>
									</div>
								</div>
								<div class="workz_list_container" id="approved_workz_list_container">
									<div class="mobile-table-container" id="all-approved-workz-list-mobile">
										<div class="mobile-table-row row-template" id="all-approved-workz-list-row-template">
											<div class="mobile-table-column no-decoration">
												<div style="flex-grow: 1;width: 30%;">
													<label>
														<input type="checkbox" name="" col-name="workz-select" style="display:none"> Workz
													</label>
												</div>
											</div>
											<div class="mobile-table-column" style="display: block;">
												<img src="" col-name="workz-image" style="display: block;
												    margin-left: auto;
												    margin-right: auto;
												    width: 50%;border: 1px solid #CCC;" onerror="this.onerror=null; this.src='hud_files/images/no_image_placeholder.png'" alt="">
												    <div col-name="date" style="text-align: right;font-size: .8rem;margin-top: 10px;"></div>
											</div>
											<div class="mobile-table-column">
												<div style="flex-grow: 1;width: 30%;">Workz Title:</div>
												<div style="flex-grow: 1;width: 65%;" col-name="workz-title">
													Assisting Pedestrian Accross the street
												</div>
											</div>
											<div class="mobile-table-column">
												<div style="flex-grow: 1;width: 30%;">Description:</div>
												<div style="flex-grow: 1;width: 65%;" col-name="description">
													Joe stopped his car and helped an elderly woman cross the street
												</div>
											</div>
											<div class="mobile-table-column" style="justify-content:center;">
												<div style="text-align: center;">
													<a href="#" style="color: #19a7de;" col-name="samaritan-report" class="workz-mobile-column-clickable">
														Click here to view Samaritan Workz Report
													</a>
												</div>
											</div>
											<div class="mobile-table-column" style="justify-content:center;">
												<div class="citation-report-social-actions-container" style="width:100%">
													<div class="citation-report-social-actions like" style="margin-right:5px" rel="">
														<i class="fas fa-thumbs-up"></i> <span>0</span>
													</div>
													<div class="citation-report-social-actions share" rel="" style="margin-left:auto"> 
														<i class="fas fa-share"></i> Share
													</div>
												</div>
											</div>
										</div>
										<p class="no-records-workz" style="padding:10px;text-align: center;">No records found.</p>
									</div>
								</div>
							</div>
						</div>
				</div>
			</div>
			<div style="margin-top: -40px;">
				<div class="navigation_middle_target_container" id="citation_news">
					<div class="h2 mobile_middle_title">Samaritan News</div>
					<div style="padding:0px 20px">
						<div class="h3" style="color: #787878;margin-bottom: 25px;">
							A Daily Dose of Positive News to Enthuse
						</div>
						<h2 class="news-type-label" id="">Most popular</h2>
						<div class="news-list most-popular" style="margin-bottom: 30px;">
							<div class="news-item template" src="">
							  <img class="news-image" src="" alt="News Image">
							  <div class="news-text">
							    <h2 class="news-title">News Title</h2>
							    <div class="news-details">
							    	<span class="news-engagement">3k</span>
							    	<span  class="news-author">By Good News Network</span>
							    	/
							    	<span  class="news-published-at">19h</span>
							    </div>
							    <div class="news-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel elit sem. Suspendisse tempus, sapien id vehicula rutrum, nulla tortor molestie nisi, ut mollis magna velit eu mi. </div>
							  </div>
							</div>
						</div>
						<hr style="border-top: 2px dotted;" />
						<h2 class="news-type-label" style="margin-top: 30px;">Yesterday</h2>
						<div class="news-list yesterday-news">
							<div class="news-item template" src="">
							  <img class="news-image" src="" alt="News Image">
							  <div class="news-text">
							    <h2 class="news-title">News Title</h2>
							    <div class="news-details">
							    	<span class="news-engagement">3k</span>
							    	<span  class="news-author">By Good News Network</span>
							    	/
							    	<span  class="news-published-at">19h</span>
							    </div>
							    <div class="news-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel elit sem. Suspendisse tempus, sapien id vehicula rutrum, nulla tortor molestie nisi, ut mollis magna velit eu mi. </div>
							  </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="mobile-content-wrapper rewards_mobile_container">
			<div class="hl" style="text-align:center">Awards</div>
			<div class="hopenet_middle_banner">
				<img src="/hud_files/images/vaullt_banner_image.png" style="width: 100%;">
			</div>
			<div class="mobile_navigation_middle">
				<div class="mobile_navigation_middle_element active" target="reward_about">Awards</div>
				<div class="mobile_navigation_middle_element" target="reward_statement">Statement</div>
				<div class="mobile_navigation_middle_element" target="reward_transfer">Transfer</div>
				<div class="mobile_navigation_middle_element" target="reward_oscommerce">View</div>
			</div>
			<div class="mobile-text-middle-container">
				<?php

				if ($user->uid > 0) {
				?>
				<div style="
				    border: 3px solid #2668BA;
				    width: 287px;
				    margin-left: auto;
				    margin-right: auto;
				    padding: 10px 15px;
				    border-radius: 11px;
				">
					<div class="mobile_middle_title" style="text-align: center; !important;font-size: 1.5rem;margin-bottom: 15px;">Total Available Balance</div>
					<div>
						<div style="">
							<div style="text-align: center;" class="hl" id="all_workz_count_mobile"><div style=""><?php echo $mBalance; ?></div></div>
						</div>
						<div style="display:flex;display: none;">
							<div class="h4" style="flex-grow: 1;width: 30%;">Samaritans:</div>
							<div style="flex-grow: 1;" id="approved_workz_count_mobile">-</div>
						</div>
					</div>
				</div>
				<hr  style="margin-top: 20px;margin-bottom: 20px;" />
				<?php
				}
				?>
				<div class="navigation_middle_target_container" id="reward_about">
					<div class="h2 mobile_middle_title" style="margin-top:20px">Valiant Awards</div>
					<?= REWARDS_AWARDS_TEXT ?>
				</div>
				<div class="navigation_middle_target_container" id="reward_statement">
					<div class="h2 mobile_middle_title">Valiant Awards Statement</div>
					<div class="h3">Draft:</div>
					<?= REWARDS_STATEMENT_TEXT ?>
					<?php

						if ($user->uid > 0) {
						?>
					<hr style="margin:20px 0px 20px 0px">
					<div style="text-align: center;">
						<div class="h3" style="margin-bottom:10px">Statement</div>
						<div class="mobile-table-container" id="rewards-statement-list-mobile">
							<div class="mobile-table-row row-template" id="rewards-statement-row-template-mobile">
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Date:</div>
									<div style="flex-grow: 1;width: 65%;" class="statement-date-mobile">
										-
									</div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Type:</div>
									<div style="flex-grow: 1;width: 65%;" class="statement-type-mobile">
										-
									</div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Description:</div>
									<div style="flex-grow: 1;width: 65%;" class="statement-description-mobile">
										-
									</div>
								</div>
								<div class="mobile-table-column">
									<div style="flex-grow: 1;width: 30%;">Amount:</div>
									<div style="flex-grow: 1;width: 65%;" class="statement-amount-mobile">
										-
									</div>
								</div>
							</div>
							<p class="no-records-statement">No records found.</p>
						</div>
					</div>
					<?php
					}
					?>
				</div>
				<div class="navigation_middle_target_container" id="reward_transfer">
					<div class="h2 mobile_middle_title">How to Transfer Valiants</div>
					<div class="h3">Draft:</div>
					<?= REWARDS_TRANSFER_TEXT ?>
					<div style="margin-top: 30px;text-align: center;">
						<p class="h2">Coming soon!</p>
					</div>
				</div>
				<div class="navigation_middle_target_container" id="reward_oscommerce">	
					<div>
						<?php

							$oscommerce = $oscommerce_url.'/index.php';
							
							if ($user->uid > 0) {
								$oscommerce = $oscommerce_url.'/login.php?sso='.$user->mail;
							}


						?>
						<iframe src="<?= $oscommerce; ?>" style="    width: 113%;
    height: 850px;
    outline: none;
    border: none;
    margin-left: -30px;"></iframe>
					</div>
				</div>
			</div>
		</div>
		<div class="mobile-content-wrapper hope_about_1st_hope_corps">
			<div class="hl" style="text-align:center">About Samaritan Workz</div>
			<div class="hopenet_middle_banner">
				<img src="/hud_files/images/about.png" style="width: 100%;">
			</div>
			<div class="mobile-text-middle-container">
				<div class="h2 mobile_middle_title">Our Mission</div>
				<div class="h3">Draft:</div>
				<p>
					<?= ABOUT_MIDDLE_TEXT ?>
				</p>
				<div class="read-more-container">
					<a href="#" class="readmore" target="about-readmore">Read More</a>
					<div id="about-readmore" class="d-none">
						<p>
							<?= ABOUT_MIDDLE_TEXT_MORE ?>
						</p>
						<a href="#" class="showless" target="about-readmore">Show Less</a>
					</div>
				</div>
				<div class="h2 mobile_middle_title">Who We Are</div>
				<p>
					<?= ABOUT_MIDDLE_TEXT_WHO_WE_ARE ?>
				</p>
				<div class="h2 mobile_middle_title">Contact Us</div>
				<p>
					<a href="mailto:support@1sthopecorps.com">support@1sthopecorps.com</a>
				</p>
				<div class="h2 mobile_middle_title">Our Partners</div>
				<div class="about_image_container_flex">
					<div class="about_image">
						<img src="/hud_files/images/about_images/image2.png">
					</div>
					<div class="about_image">
						<img src="/hud_files/images/about_images/image1.png">
					</div>
				</div>
				<div class="about_image_container_flex">
					<div class="about_image">
						<img src="/hud_files/images/about_images/image4.png">
					</div>
					<div class="about_image">
						<img src="/hud_files/images/about_images/image3.png">
					</div>
				</div>
			</div>
		</div>
		<div class="mobile-content-wrapper members_mobile_container">
			<div class="hl" style="text-align:center">Get Involved</div>
			<div style="padding: 15px;font-size: 1.2rem;margin-top: 10px;margin-bottom: 10px;">
				<p>
				<?= MEMBERS_MIDDLE_TEXT_1 ?>
				</p>
				<p>
				<?= MEMBERS_MIDDLE_TEXT_2 ?>
				</p>
			</div>
			<div class="mobile_navigation_middle" style="margin-bottom:5px">
				<div class="mobile_navigation_middle_element active" target="members_about">Get Involved</div>
				<div class="mobile_navigation_middle_element" target="member_reporter">Reporter</div>
				<div class="mobile_navigation_middle_element" target="member_samaritan">Samaritan</div>
			</div>
			<div class="mobile_navigation_middle">
				<div class="mobile_navigation_middle_element" target="member_beneficiary">Beneficiary</div>
				<div class="mobile_navigation_middle_element" target="member_reviewer">Reviewer</div>
				<div class="mobile_navigation_middle_element" target="member_mentor">Booster</div>
			</div>
			<div class="mobile-text-middle-container"  style="min-height: 600px;">
				<div class="navigation_middle_target_container" id="members_about">
					<div class="h2" style="margin-bottom: 10px;text-align: center;">Ways to Get Involved</div>
					<p>
						<?= MEMBERS_MIDDLE_TEXT_3 ?>
					</p>
					<div class="h3" style="margin-bottom: 20px;text-align: center;">Select an Option Below</div>
					<div class="members-info-details" target="member_samaritan">
						<div style="font-size: 1.5rem;font-weight: bold;text-transform: uppercase;">Samaritan</div>
						<div style="font-size: 1rem;">
							Become a champion of Valor and Kindness!
						</div>
					</div>
					<div class="members-info-details" target="member_reporter">
						<div style="font-size: 1.5rem;font-weight: bold;text-transform: uppercase;">Reporter</div>
						<div style="font-size: 1rem;">
							Report a workz of Valor or Kindness!
						</div>
					</div>
					<div class="members-info-details" target="member_reviewer">
						<div style="font-size: 1.5rem;font-weight: bold;text-transform: uppercase;">Reviewer</div>
						<div style="font-size: 1rem;">
							Help edit and validate Samaritan Reports!
						</div>
					</div>
					<div class="members-info-details" target="member_mentor">
						<div style="font-size: 1.5rem;font-weight: bold;text-transform: uppercase;">Booster</div>
						<div style="font-size: 1rem;">
							Read Samaritan Reports and give uplifting feedback!
						</div>
					</div>
					<div class="members-info-details" target="member_beneficiary">
						<div style="font-size: 1.5rem;font-weight: bold;text-transform: uppercase;">Beneficiary</div>
						<div style="font-size: 1rem;">
							Pay it forward!
						</div>
					</div>
				</div>
				<div class="navigation_middle_target_container" id="member_reporter" style="display:none;">
					<div>
						<div class="hl" style="margin-bottom: 10px;text-align: center;">Our Reporters</div>
						<p>
							Reporters are the front line of the Samaritan Workz program.   They help us to collect, verify, and publish a brief story about workz of valor and kindness performed by people living in Pflugerville and the nearby area. In recognition of your service, you as a reporter will be awarded Valiants for each Samaritan Report published.  You can use the app to exchange your Valiants for awards from merchants.  To learn more, click <b>
							<span class="link menu-link" target="rewards_mobile_container">Awards</span>.</b>
							<br /> 
							<div class="read-more-container">
								<a href="#" class="readmore" target="reporter_our-reporter">Read More</a>
								<div id="reporter_our-reporter" class="d-none">
									<p>
										Because of your help in sharing the good news with your community, kindness and valor can become contagious, encouraging more people to participate in the Samaritan program and resulting in a stronger sense of community. 
									</p>
									<p>
										The net effect is that neighbors feel more connected, forming positive relationships and social connections, resulting in a stronger, safer community that can completely transform and improve neighborhoods. 
									</p>
									<a href="#" class="showless" target="reporter_our-reporter">Show Less</a>
								</div>
							</div>
						</p>
					</div>
					<div>
						<div class="hl" style="margin-bottom: 10px;text-align: center;">
							What We Report
						</div>
						<p>
							We are seeking out and reporting on Samaritans, who are making our community a better place to live by performing workz of valor and kindness. We define workz of valor and kindness as noteworthy, selfless, and voluntary deeds of compassion to help another person without expecting compensation from the beneficiary. 
							<br /> 
							<div class="read-more-container">
								<a href="#" class="readmore" target="reporter_what-we-report">Read More</a>
								<div id="reporter_what-we-report" class="d-none">
									<p>
										“Valor workz” are acts of courage to help another person that places the Samaritan in physical or social danger.   Workz of kindness can take many forms, such as a small gesture we call “Random Kindness workz” or a larger, more significant action we call “Kindness workz.” 
									</p>
									<a href="#" class="showless" target="reporter_what-we-report">Show Less</a>
								</div>
							</div>
						</p>
					</div>
					<div>
						<div class="hl" style="margin-bottom: 10px;text-align: center;">
							How Reporting Works
						</div>
						<p>
							As a reporter, you are seeking and reporting workz of valor and kindness in your local community.   You may witness the workz yourself or hear about them through family, friends, or the media.
							<br /> 
							<div class="read-more-container">
								<a href="#" class="readmore" target="reporter_how-reporting-workz">Read More</a>
								<div id="reporter_how-reporting-workz" class="d-none">
									<p>
										As soon as you can, please arrange a short interview with the Samaritan and the beneficiary, and any witnesses to verify the circumstances of the workz.  When conducting an interview, approach the person with sensitivity and respect, being mindful of the person's comfort level and feelings about the publicity.  To learn more about how to report a workz, click on this app’s 
										<b><span class="link menu-link" target="citation_mobile_container">Workz section.</span>.</b> 
									</p>
									<a href="#" class="showless" target="reporter_how-reporting-workz">Show Less</a>
								</div>
							</div>
						</p>
					</div>
					<div>
						<div class="hl" style="margin-bottom: 10px;text-align: center;">
							How to Become a Reporter
						</div>
						<p>
							Becoming a reporter is as easy as 1-2-3.  Just click <a href="#" class="signup-role" role-to-signup="Reporter">Signup</a> to answer a few questions, and you're on your way to reporting your first workz of valor and kindness.
						</p>
					</div>
				</div>
				<div class="navigation_middle_target_container" id="member_samaritan" style="display:none;">
					<div>
						<div class="hl" style="margin-bottom: 10px;text-align: center;">
							Samaritans Wanted
						</div>
						<p>
							Samaritans are our champions. They are selfless and compassionate heroes who perform workz of kindness or valor to help others. They are willing to put the needs of others before their own.  Now more than ever, we need Samaritans; they give us hope and renew our faith in humanity!  In recognition of your workz, you, as a Samaritan, will be awarded Valiants for each workz that you perform.  You can use the app to exchange your Valiants for awards from merchants.  To learn more, just click 
							<span class="link menu-link" target="rewards_mobile_container">Awards</span>
							<br /> 
							<div class="read-more-container">
								<a href="#" class="readmore" target="samaritan_wanted">Read More</a>
								<div id="samaritan_wanted" class="d-none">
									<p>
										Samaritan workz of kindness can take many forms, such as spontaneous, random acts of generosity or honesty and simple acts like holding a door open for someone.   Kindness workz can also take the form of larger, more significant, and more complex actions, such as volunteering time or resources to help a person, charity, or community organization.  Samaritans are also seen as courageous, and willing to put themselves in potentially dangerous situations to help others. Their workz can often inspire others to be kinder and braver, creating a positive ripple effect within their community. They are valuable assets to their community and humanity as a whole.
									</p>
									<a href="#" class="showless" target="samaritan_wanted">Show Less</a>
								</div>
							</div>
						</p>
					</div>
					<div>
						<div class="hl" style="margin-bottom: 10px;text-align: center;">
							Samaritans Urgently Needed!
						</div>
						<p>
							We are being bombarded with negativity.  
							<a href="https://journals.sagepub.com/doi/full/10.1177/0011128720922539">70% of news channels open their coverage with a crime-related story</a>!
							<a href="https://letter.ly/negative-news-statistics/">Almost 90% of all news media is negative</a>!  
							<a href="https://www.aafp.org/about/policies/all/violence-media-entertainment.html">91% of movies</a> and 
							<a href="https://www.apa.org/about/policy/resolution-violent-video-games.pdf">85% of video games contain violence</a>!
							<a href="https://psmag.com/news/pop-music-lyrics-are-as-violent-as-those-in-hip-hop">A staggering 99.5% of popular music refers to violence</a>!
							<br /> 
							<div class="read-more-container">
								<a href="#" class="readmore" target="samaritan_urgently-needed">Read More</a>
								<div id="samaritan_urgently-needed" class="d-none">
									<p>
										A recent YouGov U.S. survey asked, “do you think the world is getting better or worse, or neither getting better nor worse?”
										<span style="color:red">Only 6% of Americans responded that the world is getting better!</span>
										The world and its youth has become caught up in a self-fulfilling prophecy, a feedback loop of negativity!  Despite the media’s focus on negativity, the Bible teaches us we can overcome evil with good! 
										<span style="color:red">“For as by one man's disobedience many were made sinners, so by the obedience of one shall many be made righteous”</span> (Romans 5:19)
									</p>
									<a href="#" class="showless" target="samaritan_urgently-needed">Show Less</a>
								</div>
							</div>
						</p>
					</div>
					<div>
						<div class="hl" style="margin-bottom: 10px;text-align: center;">
							Volunteer to Become a Samaritan
						</div>
						<p>
							<span style="color:rgb(0, 32, 96)">As a student</span>, can volunteer to be a Samaritan by signing up as a Reporter or requesting another person to report you as a Samaritan.  Becoming a reporter is as easy as 1-2-3.  Just click  <a href="#" class="signup-role" role-to-signup="Reporter">Signup</a> to answer a few questions, and you're on your way to performing your first workz of valor and kindness.  Once you have signed up to be a Reporter, you can report yourself as a Samaritan. To learn how to become a Reporter and report a workz, click on this app’s <span class="link" onclick="goToMemberReporter()">Members > Reporter</span> section.
						</p>
					</div>
				</div>
				<div class="navigation_middle_target_container" id="member_beneficiary" style="display:none;">

					<div class="h2" style="margin-bottom: 10px;text-align: center;">
						Our Beneficiaries
					</div>
					<p>
						A beneficiary is a person who benefits from a workz of valor or kindness performed by a Samaritan.  Beneficiaries can be anyone, regardless of age, gender, or background. They may be going through a difficult time, experiencing a challenge, or simply needing a pick-me-up.  Overall, the beneficiary has been touched by another person's courage, compassion, and generosity and has experienced the positive impact of that act on their life.
					</p>
					<p>
						When someone receives a workz of valor or kindness, they may feel grateful, uplifted, and supported. The workz may help them feel more positive, optimistic, and connected.
					</p>

					<div class="h2" style="margin-bottom: 10px;text-align: center;">
						What is Paying It forward?
					</div>
					<p>
						"Paying it forward" is based on repaying a workz of valor or kindness by doing a workz for someone else, rather than repaying the Samaritan who originally helped you. The goal is to create a positive ripple effect where workz is spread from one person to another, creating a chain of goodwill and positivity.
					</p>
					<p>
						For example, if someone receives a free coffee from a stranger, they could pay it forward by buying a coffee for the person behind them in line. Or if someone is being bullied and receives help from a Samaritan, they could pay it forward by standing up for someone else who is the victim of bullying. The idea is to create a positive cycle of valor or kindness, where each person who receives a workz also becomes a giver of workz.
						Ultimately, paying it forward is about creating a culture of courage and kindness where people look out for one another and seek to improve the world, one workz at a time.

					</p>
					<div class="h2" style="margin-bottom: 10px;text-align: center;">
						How To Pay It Forward
					</div>
					<p>
						In the event you become the beneficiary of a workz of valor or kindness, here are some common steps that you can take to pay it forward:
					</p>
					<div style="padding-left: 10p;">
						
						<ol>
							<li style="margin-bottom: 10px;">
								<b>Express gratitude:</b> The first step for many beneficiaries is to express gratitude, such as simply saying "thank you” to the person who performed the workz.
							</li>
							<li style="margin-bottom: 10px;">
								<b>Reflect on the impact:</b> Beneficiaries might also take time to reflect on the act of kindness’s impact on them. This could involve thinking about how it made them feel, improved their situation, or inspired them to help others.
							</li>
							<li style="margin-bottom: 10px;">
								<b>Be open to opportunities: </b> This could involve simply looking for opportunities to help others in need or volunteering in your community. The important thing is taking action to make the world a better place, just as someone did for you.
							</li>
						</ol>
					</div>
				</div>
				<div class="navigation_middle_target_container" id="member_reviewer" style="display:none;">
					<div>
						<div class="hl" style="margin-bottom: 10px;text-align: center;">
							Our Reviewers
						</div>
						<p>
							Reviewers help us to ensure the integrity of the Samaritan Workz program.   As a reviewer, you'll help us edit and verify the valor and kindness stories in the Samaritan Reports before publication. Click here to see an example of a <a class="workz-mobile-column-clickable" kindness_id="882">Samaritan Report</a>.
						</p>
						<p>
							Recognizing your help as a reviewer, you will be awarded Valiants for each Samaritan Report you review and publish.  You can use the app to exchange your Valiants for awards from merchants.  To learn more, just click <span class="link menu-link" target="rewards_mobile_container">Awards</span>.
						</p>
					</div>
					<div>
						<div class="hl" style="margin-bottom: 10px;text-align: center;">
							Why We Review
						</div>
						<p>
							It is essential that we verify and edit our Samaritan Reports before they are published.  Publishing unverified or unclear information can lead to clarity, trust, and misinformation. 
						</p>
						<p>
							Our goal is to uplift and motivate people with our stories of heroism and kindness, but we also must ensure that our stories are truthful and easy to read.  Our goal is to maintain our integrity and build trust with our readers.
						</p>
					</div>
					<div>
						<div class="hl" style="margin-bottom: 10px;text-align: center;">
							How Reviewing Works
						</div>
						<p>
							Our Reporters use the Samaritan report form on our app to write stories about workz of valor and kindness performed in our community by Samaritans.  Before a Samaritan, Report is published, you, as a Reviewer, will verify and edit the report to ensure its clarity and accuracy. 
							<br /> 
							<div class="read-more-container">
								<a href="#" class="readmore" target="reviewer_how-review-workz">Read More</a>
								<div id="reviewer_how-review-workz" class="d-none">
									<p>
										You can choose the number of Samaritan Reports you wish to review.   Some Samaritans may wish to remain anonymous, and you may choose to review the reports of known and anonymous Samaritans.  We will notify you by your choice of email or text once a Samaritan Report is ready to review.    After you have reviewed a Samaritan Report, you may need to clarify parts of the report.  For questions regarding the Samaritan Report, you can use the messaging function on the app to contact the Reporter or even the Samaritan and the Beneficiary. To learn more about reviewing a workz, click on the
										<span class="link menu-link" target="citation_mobile_container">Workz</span>
										section of this app.
									</p>
									<a href="#" class="showless" target="reviewer_how-review-workz">Show Less</a>
								</div>
							</div>
						</p>
					</div>
					<div>
						<div class="hl" style="margin-bottom: 10px;text-align: center;">
							How to Become a Reviewer
						</div>
						<p>
							Becoming a reviewer is as easy as 1-2-3. Just click <a href="#" class="signup-role" role-to-signup="Reviewer">Signup</a> to answer a few questions, and you're on your way to reviewing your first workz of valor and kindness.
						</p>
					</div>
				</div>
				<div class="navigation_middle_target_container" id="member_mentor" style="display:none;">
					<div class="hl" style="margin-bottom: 10px;text-align: center;">Our Boosters</div>
					<p>
						Our boosters provide encouragement and recognition to our Samaritans and reporters through their comments on the Samaritan Reports.  Along with positive comments, our boosters also promote the workz of valor and kindness by sharing the Samaritan Reports with their friends and family. Click here to see an example of a <a class="workz-mobile-column-clickable" kindness_id="882">Samaritan Reports</a>. In recognition of your help as a booster will be awarded Valiants for each Samaritan Report that you read and comment on or share.  You can use the app to exchange your Valiants for awards from merchants.  To learn more, just click <span class="link menu-link" target="rewards_mobile_container">Awards</span>. 
					</p>
					<div class="hl" style="margin-bottom: 10px;text-align: center;">Why We Need Boosters</div>
					<p>
						Our boosters play an invaluable and integral role in the Samaritan Workz program.  Positive reinforcement for student reporters and their Samaritans can help reinforce and encourage their participation and make them feel valued and appreciated. This can motivate them to continue reporting and performing acts of valor and kindness. In turn, this can contribute to a more positive and compassionate society, which can have ripple effects on positive social change and overall well-being.
						<div class="read-more-container">
							<a href="#" class="readmore" target="why_we_need_boosters-booster">Read More</a>
							<div id="why_we_need_boosters-booster" class="d-none">
								<p>
									As a booster, your advocacy and promotion of workz of valor and kindness can have the following impact on our student reporters and their Samaritans:
								</p>
								<p>
									<ul style="list-style: disc;">
										<li><b>Encouragement and motivation</b>: Leaving positive comments about Samaritans who have positively impacted their communities can provide encouragement and motivation for those Samaritans to continue doing good.</li>
										<li><b>Recognition and Affirmation</b>: By leaving positive comments, boosters recognize the positive contributions that reporters and Samaritans make in their communities. This can increase their confidence, make them feel valued and appreciated, help build community, and foster a culture of kindness and generosity.</li>
										<li><b>Setting an example</b>: boosters serve as role models for students, and by leaving positive comments, they set an example of how to be supportive and encouraging.</li>
										<li><n>Building relationships</n>: Leaving positive comments can also help build stronger relationships among students in the Samaritan Workz program.</li>
									</ul>
								</p>
								<a href="#" class="showless" target="why_we_need_boosters-booster">Show Less</a>
							</div>
						</div>
					</p>
					<div class="hl" style="margin-bottom: 10px;text-align: center;">How Boosting Works</div>
					<p>
						Our boosters use the Samaritan report form on our app to comment on stories about workz of valor and kindness performed in our community by Samaritans.  As a booster, you can choose how often you wish to comment on the workz.   Some Samaritans may wish to remain anonymous, and you may comment on the reports of known and/or anonymous Samaritans.  
						<div class="read-more-container">
							<a href="#" class="readmore" target="how_boosting_works-booster">Read More</a>
							<div id="how_boosting_works-booster" class="d-none">
								<p>
									We will notify you by your choice of email or text once a Samaritan Report is ready for boosting.   Please keep it positive: Comments should be supportive and encouraging. Guidance should be constructive and delivered in a positive and respectful way. To learn more about commenting workz, click on the <a href="#" id="booster-citation" onclick="goToSamaritanBooster(event)">Booster</a> section of this app.
								</p>
								<a href="#" class="showless" target="how_boosting_works-booster">Show Less</a>
							</div>
						</div>
					</p>
					<div class="hl" style="margin-bottom: 10px;text-align: center;">How to Become a Booster</div>
					<p>
						Becoming a booster is as easy as 1-2-3.  Just click <a href="#" class="signup-role" role-to-signup="Booster">Signup</a> to answer a few questions, and you're on your way to commenting on your first workz of valor and kindness.
					</p>
				</div>
			</div>
		</div>
	</div>

	<div class="mobile_navigation_footer" style="bottom: -80px;position: absolute;width: 100%;">
		<div class="mobile_navigation_footer_element active" target="hope_home_1st_hope_corps"><i class="fas fa-home"></i> <small>Home</small></div>
		<div class="mobile_navigation_footer_element" target="citation_mobile_container"><i class="fa-solid fa-location-dot"></i> <small>Workz</small></div>
		<div class="mobile_navigation_footer_element" target="rewards_mobile_container"><i class="fa-solid fa-money-bill"></i> <small>Awards</small></div>
		<div class="mobile_navigation_footer_element" target="hope_about_1st_hope_corps"><i class="fa-solid fa-circle-info"></i> <small>About</small></div>
		<div class="mobile_navigation_footer_element" target="members_mobile_container"><i class="fa-solid fa-users"></i> <small>Get Involved</small></div>
	</div>
</div>

<div id='KSPopUp'>
	<div id='workz-status-container'>

	<div id="workz-status-close-modal"><a onmouseover='this.style.cursor="pointer" ' style='' onfocus='this.blur();' onclick="document.getElementById('KSPopUp').style.display = 'none';document.getElementById('KSPopUpOverlay').style.display = 'none';document.getElementById('out').style.display = 'none';document.getElementById('in').style.display = 'block';document.getElementById('KSPopUp').style.display = 'none'; " >X</a></div>
		<div id="workz-status-header">
			<h1>Samaritan Report</h1>
		</div>
		<div id="hud_KSText">loading..</div>
	</div>
</div>


<div id="KSPopUpOverlay" style="    width: 100%;
    height: 100%;
    position: fixed;
    background-color: #000;
    opacity: .6;
    z-index: 100;
    top: 0px;
    left: 0px;display: none;">
    	
</div>
