<div class="mobile-content-wrapper" style="display: block;">
	<div style="text-align:center;">
		<span style="font-size: 2rem;">Signup</span>
	</div>
	<?php

	if (isset($_SESSION['validation_error'])) {
		?>
		<div style="color: #ffffff;font-size:1rem;margin-top: 15px;background-color: #f75050;padding: 10px;text-align: center;font-weight: bold;">Error: <?= $_SESSION['validation_error'] ?></div>
		<?php
		unset($_SESSION['validation_error']);
	}

	if (isset($_SESSION['signup_error'])) {
		?>
		<div style="color: #ffffff;font-size:1rem;margin-top: 15px;background-color: #f75050;padding: 10px;text-align: center;font-weight: bold;">Error: Your account is detected in our system. Please contact support.</div>
		<?php
		unset($_SESSION['signup_error']);
	}
	?>
	<form action="/signup.php" method="post" style="margin-top: 20px;padding: 20px;margin-left: 20px;">
		<div class="form-control" style="text-align: left;margin-bottom: 30px;font-size: 1.2rem;">
			<label style="font-weight: bold;">What's your role?</label>
			<div style="margin: 10px 10px;">
				<label>
					<input type="radio" name="role[]" required value="1" class="role_signup"> Reporter and Samaritan
					<div style="margin-top: 5px;font-size: 1rem ;">
						<small>This allows you to report a good samaritan and making yourself available to become a samaritan.</small>
					</div>
				</label>
			</div>
			<div style="margin: 10px 10px;">
				<label>
					<input type="radio" name="role[]" required value="2" class="role_signup"> Reporter Only
					<div style="margin-top: 5px;font-size: 1rem ;">
						<small>This allows you to report a good samaritan.</small>
					</div>
				</label>
			</div>
			<div style="margin: 10px 10px;">
				<label>
					<input type="radio" name="role[]" required value="3" class="role_signup"> Reviewer
					<div style="margin-top: 5px;font-size: 1rem ;">
						<small>This allows you to review a good samaritan reported by others.</small>
					</div>
				</label>
			</div>
			<div style="margin: 10px 10px;">
				<label>
					<input type="radio" name="role[]" required value="4" class="role_signup"> Booster
					<div style="margin-top: 5px;font-size: 1rem ;">
						<small>Text goes here!</small>
					</div>
				</label>
			</div>
		</div>
		<div class="form-control" style="text-align: left;margin-bottom: 20px;font-size: 1.2rem;">
			<label style="font-weight: bold;">User Information</label>
			<div style="margin-top: 10px">
				<small style="font-size: .9rem ;">
					All fields with (<small style="color:red">*</small>) are required
				</small>
			</div>

		</div>
		<div class="form-control">
			<input type="text" name="first_name" required placeholder="First Name" /> <small style="color:red;font-size: 1rem">*</small>
		</div>
		<div class="form-control">
			<input type="text" name="last_name" required placeholder="Last Name" /> <small style="color:red;font-size: 1rem">*</small>
		</div>
		<div class="form-control" style="margin-bottom: 20px;">
			<input type="text" name="username" required placeholder="Username" readonly style="margin-bottom: 5px;;" /> <small style="color:red;font-size: 1rem">*</small>
			<div>
				<small style="font-size: .9rem ;">
					* Auto populated based on first and last name. This will be your username when you login to the app.
				</small>
			</div>
		</div>
		<div class="form-control">
			<input type="password" name="pass" required placeholder="Password" /> <small style="color:red;font-size: 1rem">*</small>
		</div>
		<div class="form-control">
			<input type="password" name="c_pass" required placeholder="Confirm Password" /> <small style="color:red;font-size: 1rem">*</small>
		</div>
		<div class="form-control">
			<input type="text" name="email" required placeholder="Email" /> <small style="color:red;font-size: 1rem">*</small>
		</div>
		<div class="form-control">
			<input type="text" name="phone" placeholder="Phone" />
		</div>
		<div class="form-control" style="display: flex;">
			<small style="font-size: 1rem;margin-bottom: 10px;">
				Select Birth Month and Year
			</small>
		</div>
		<div class="form-control" style="display: flex;">
			<div style="width: 46%;">
				<select name="birth_month" style="float: left;margin-right: 10px;" required>
					<?php
					for ($i_month = 1; $i_month <= 12; $i_month++) { 
				        echo '<option value="'.$i_month.'">'. date('F', mktime(0,0,0,$i_month)).'</option>'."\n";
				    }
					?>
				</select>
			</div>
			<div style="width: 46%;">
				<select name="birth_year" style="float: left;width: 96%;" required>
					<?php
					for($i=0; $i<=60; $i++){
						$year = (date('Y') - 10) - $i;
						?>
						<option value="<?= $year ?>"><?= $year ?></option>
						<?php
						}
					?>
				</select>
				
			</div>
			<small style="color:red;font-size: 1rem">*</small>
			<div style="clear: both;"></div>
		</div>
		<div class="form-control" style="margin-top:-20px;margin-bottom:20px">
			<div style="margin-right: auto;">
				<a class="upload-field-button" id="upload-benefactor_mobile" style="width: 109px;">Browse</a> 
				<input type="file" id="benefactor-picture_mobile" style="display:none" onChange="uploadOnChange('benefactor-picture_mobile', 'benefactor-picture-filename_mobile')">
				<input type="text" id="benefactor-picture-filename_mobile" name="benefactor-picture-filename" style="display:none">
				<b style="margin-left: 8px;font-size: 1rem;">Upload your picture</b>
				<div id="benefactor-picture_mobile-preview-container" style="display:none;margin-top: 10px;">
					<a href="" id="benefactor-picture_mobile-preview" target="_blank" style="font-size: 1rem;"></a>
				</div>
			</div>
		</div>
		<div class="form-control reporter-fields">
			<input type="text" name="school" placeholder="School" /> <small style="color:red;font-size: 1rem">*</small>
		</div>
		<div class="form-control reporter-fields">
			<input type="text" name="grade_level" placeholder="Grade Level" /> <small style="color:red;font-size: 1rem">*</small>
		</div>
		<div class="form-control reviewer-fields">
			<input type="text" name="organization" placeholder="Organization" /> <small style="color:red;font-size: 1rem">*</small>
		</div>
		<div class="form-action" style="text-align: center;">
			<input type="hidden" name="form_id" id="edit-user-login" value="user_login" />
	        <input type="submit" name="op" value="Sign Up" class="btnuser" /> 
		</div>
	</form>
</div>