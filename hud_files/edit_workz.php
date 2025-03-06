<div id="edit_citation_report" style="font-size: 1.2rem;">
	<div class="edit_citation_report_container" style="display: none;">
		<div class="edit_citation_report_wizard_header active" target="edit_mobile-container-workz-wizard-b1">Samaritan Information</div>
		<div class="edit_citation_report_wizard_header" target="edit_mobile-container-workz-wizard-b2">Beneficiary Information</div>
	</div>
	<form id="edit_workz_form_v2_mobile">
		<input type="hidden" name="edit_workz_id" value="">
		<div class="edit_citation_report_wizard_target active" id="edit_mobile-container-workz-wizard-b1">
			<div style="margin-top: 20px;text-align: center;">
				<div class="h3">Samaritan Information</div>
				<div class="h4">Person who performed the Workz</div>
				<div class="form-wizard-content-form">
					<div class="field-group">
							<label style="color: #fff;font-weight: bold;">Fields with <small style="color:red">*</small> are required
        			</div>
        			<div id="edit_workz-type-main-container" style="margin-bottom:10px;">
            			<div class="field-group" id="edit_workz-type-container" style="width:50%;margin-top: 20px;">
								<label><span class="required">*</span> Workz Type:</label>
								<select class="form-control" id="edit_workz-type_mobile" required name="edit_workz_type">
									<option value="">Select Workz Type</option>
									<option value="Valor Workz">Valor Workz</option>
									<option value="Kindness Workz">Kindness Workz</option>
									<option value="Random Kindness Workz">Random Kindness Workz</option>
								</select>
            			</div>
            			<div style="margin-top: 20px;display: none;" class="edit_kind-type-options-container" id="edit_kindness-act-fields-container_mobile">
            				<div style="margin-bottom: 10px;"><b>Duration</b></div>
            				<small>Specify how long your workz lasted in hours and minutes</small>
            				<div style="display: flex;margin-top: 20px;">
		            			<div class="field-group" style="margin-right: auto;">
		            				<label>Duration (hours)</label>
										<select class="form-control" name="edit_iKindnessHour">
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
		            			<div class="field-group" style="margin-right: auto;">
		            				<label>Duration (Minutues)</label>
										<select class="form-control" name="edit_iKindnessMinute">
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
            			<div style="margin-top: 20px;display: none;" class="edit_kind-type-options-container" id="edit_valor-act-fields-container_mobile">
            				<div style="width: 50%;margin-top: 20px;">
		            			<div class="field-group" style="margin-right: auto;">
		            				<label>Valor Type</label>
										<select class="form-control" name="edit_valor_act_type">
											<option>Bronze</option>
											<option>Silver</option>
											<option>Gold</option>
										</select>
		            			</div>
		            		</div>
            			</div>
            			<div style="margin-top: 20px;display: none;" class="edit_kind-type-options-container" id="edit_kindness-act-type-fields-container_mobile">
            				<div style="width: 50%;margin-top: 20px;">
		            			<div class="field-group" style="margin-right: auto;">
		            				<label>Kindness Workz Type</label>
										<select class="form-control" name="edit_kindness_act_type">
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
						   <input type="text" class="form-control" placeholder="Give the Workz title" required name="edit_sKindnessTitle">
        			</div>
        			<div class="field-group">
							<label><span class="required">*</span> Workz Address/Location:</label>
							<textarea class="form-control" placeholder="The address of the location where the Workz was performed" required name="edit_sKindnessLocation"></textarea>
        			</div>
        			<div class="field-group">
							<label><span class="required">*</span> Workz Description:</label>
							<textarea class="form-control" placeholder="Write a description of the Workz activity that the person performed"  required name="edit_sKindnessDesc"></textarea>
        			</div>
    				<div class="field-group" style="width:50%;margin-top: 20px;">
        				<label><span class="required">*</span> Workz Date</label>
							<input type="date" class="form-control" name="edit_dDate" required>
        			</div>
        			<div style="display: none;margin-top: 20px;" class="camera-fields">
        				<div style="margin-right: auto;width: 49%;">
        					<a class="upload-field-button">Start Camera</a> 
        					<b style="margin-left: 8px;font-size: 12px;">Click to take a pic or video of Workz</b>
        				</div>
        			</div>
        			<div style="display: flex;margin-top: 20px;margin-bottom: 10px;text-align: left;" class="camera-fields">
        				<div>
        					<a class="upload-field-button" id="edit_upload-workz_mobile"  style="width: 109px;">Browse</a> 
        					<input type="file" id="edit_workz-picture_mobile" style="display:none" onChange="uploadOnChange('edit_workz-picture_mobile', 'edit_workz-picture_mobile-filename')">
        					<input type="text" id="edit_workz-picture_mobile-filename" name="edit_workz-picture-filename" style="display:none">
        					<b style="margin-left: 8px;font-size: 12px;">Click to upload a pic or video of Workz</b>
        					<div id="edit_workz-picture_mobile-preview-container" style="display:none;margin-top: 10px;">
        						<a href="" id="edit_workz-picture_mobile-preview" target="_blank"></a>
        					</div>
        				</div>
        			</div>

        			<div style="margin-bottom: 10px !important;margin-top: 15px;text-align: left;" class="anonymous-field-container edit_benefactor-info-fields-container">
        				<label>
            				<input type="checkbox" name="edit_is_benefactor_anonymous">
            				<b style="margin-left: 8px;font-size: 12px;">Check if samaritan is anonymous</b>
            			</label>
        			</div>
        			<div class="edit_benefactor-info-fields-container edit_benefactor-data-container">
						<!-- <div style="margin-bottom: 10px !important;margin-top: 15px;text-align: left;" class="anonymous-field-container">
            				<label>
	            				<input type="checkbox" name="edit_is_benefactor_same_user">
	            				<b style="margin-left: 8px;font-size: 12px;">Are you the samaritan of this workz?</b>
	            			</label>
            			</div> -->
            			<div class="field-group benefactor-container-fields">
								<label><span class="required">*</span> First Name:</label>
							   <input type="text" class="form-control" placeholder="First Name of the person who performed the Workz" required name="edit_benefactor_first_name">
            			</div>

            			<div class="field-group benefactor-container-fields">
								<label><span class="required">*</span> Last Name:</label>
							   <input type="text" class="form-control" placeholder="Last Name of the person who performed the Workz" required name="edit_benefactor_last_name">
            			</div>
            			<div class="field-group benefactor-container-fields">
								<label>Address:</label>
								<textarea class="form-control" placeholder="Mailing address of the person who performed the Workz" name="edit_benefactor_address"></textarea>
            			</div>
            			<div class="field-group benefactor-container-fields">
								<label>Phone:</label>
							   <input type="text" class="form-control" placeholder="Phone Number of the person who performed the Workz" name="edit_benefactor_phone">
            			</div>
            			<div class="field-group benefactor-container-fields">
								<label>Email:</label>
							   <input type="text" class="form-control" placeholder="Email of the person who performed the Workz" name="edit_benefactor_email">
            			</div>
            			<div style="display: none;margin-top: 20px;" class="camera-fields">
            				<div style="margin-right: auto;width: 49%;" class="benefactor-container-fields">
            					<a class="upload-field-button">Start Camera</a> 
            					<b style="margin-left: 8px;font-size: 12px;">Click to take a pic of samaritan</b>
            				</div>
            			</div>
            			<div style="display: flex;margin-top: 20px;margin-bottom: 10px;text-align: left;" class="camera-fields">
            				<div class="benefactor-container-fields">
            					<a class="upload-field-button" id="edit_upload-benefactor_mobile" style="width: 109px;">Browse</a> 
            					<input type="file" id="edit_benefactor-picture_mobile" style="display:none" onChange="uploadOnChange('edit_benefactor-picture_mobile', 'edit_benefactor-picture-filename_mobile')">
            					<input type="text" id="edit_benefactor-picture-filename_mobile" name="edit_benefactor-picture-filename" style="display:none">
            					<b style="margin-left: 8px;font-size: 12px;">Click to upload a pic of samaritan</b>
            					<div id="edit_benefactor-picture_mobile-preview-container" style="display:none;margin-top: 10px;">
            						<a href="" id="edit_benefactor-picture_mobile-preview" target="_blank"></a>
            					</div>
            				</div>
            			</div>
            			<div style="border-top: 1px solid #c5ff3a;margin-top: 30px;" class="benefactor-container-fields">
            				<div style="text-align: center;margin-top: 5px;margin-bottom: 20px;padding-top: 20px;">
		            			<div class="h3">Samaritan Organization Information</div>
		            		</div>
		            		<div class="form-wizard-content-form">
			            		<div class="field-group">
										<label>Name:</label>
									   <input type="text" class="form-control" placeholder="Name of the organization samaritan is assigned to" name="edit_benefactor_department_name">
		            			</div>
		            			<div class="field-group">
										<label>Address:</label>
										<textarea class="form-control" placeholder="Street address of the organization samaritan is assigned to" name="edit_benefactor_department_address"></textarea>
		            			</div>
			            		<div class="field-group">
										<label>Phone:</label>
									   <input type="text" class="form-control" placeholder="Phone number of the organization samaritan is assigned to" name="edit_benefactor_department_phone">
		            			</div>
			            		<div class="field-group">
										<label>Email:</label>
									   <input type="text" class="form-control" placeholder="Email of the organization samaritan is assigned to" name="edit_benefactor_department_email">
		            			</div>
		            		</div>
            			</div>
        			</div>
        		</div>
				<div class="form-action"  style="margin-bottom:20px">
	                <input type="button" name="edit_op" value="Next" class="btnuser" id="edit_b1-next-button-mobile" /> 
				</div>
			</div>
		</div>
		<div class="edit_citation_report_wizard_target" id="edit_mobile-container-workz-wizard-b2">
			<div style="margin-top: 20px;text-align: center;">
				<div class="h3">Beneficiary Information</div>
				<div class="h4">Person who benefited from the Workz</div>
				<div class="form-wizard-content-form">
					<div class="field-group">
							<label style="color: #fff;font-weight: bold;">Fields with <small style="color:red">*</small> are required
        			</div>
        			<div class="edit_beneficiary-info-fields-container edit_beneficiary-container-fields">
            			<div style="margin-bottom: 10px !important;margin-top: 15px;text-align: left;" class="anonymous-field-container">
            				<label>
	            				<input type="checkbox" name="edit_is_beneficiary_anonymous">
	            				<b style="margin-left: 8px;font-size: 12px;">Check if beneficiary is anonymous</b>
	            			</label>
            			</div>
        			</div>
        			<div class="edit_beneficiary-info-fields-container edit_beneficiary-container-fields edit_beneficiary-data-container">
            			<div class="field-group edit_beneficiary-container-fields">
								<label><span class="required">*</span> First Name:</label>
							   <input type="text" class="form-control" placeholder="First Name of the person who benefited from the Workz" required name="edit_sToWhomFirstName">
            			</div>
            			<div class="field-group edit_beneficiary-container-fields">
								<label><span class="required">*</span> Last Name:</label>
							   <input type="text" class="form-control" placeholder="Last Name of the person who benefited from the Workz" required name="edit_sToWhomLastName">
            			</div>
            			<div class="field-group edit_beneficiary-container-fields">
								<label>Address:</label>
								<textarea class="form-control" placeholder="Mailing address of the person who benefited from the Workz" name="edit_beneficiary_address"></textarea>
            			</div>
            			<div class="field-group">
								<label>Phone:</label>
							   <input type="text" class="form-control" placeholder="Phone number of the person who benefited from the Workz" name="edit_beneficiary_phone">
            			</div>
            			<div class="field-group">
								<label>Email:</label>
							   <input type="text" class="form-control" placeholder="Email of the person who benefited from the Workz" name="edit_beneficiary_email">
            			</div>

            			<div style="margin-top: 20px;display: none;" class="camera-fields">
            				<div>
            					<a class="upload-field-button">Start Camera</a> 
            					<b style="margin-left: 8px;font-size: 12px;">Click to take a pic of beneficiary</b>
            				</div>
            			</div>
            			<div style="margin-top: 20px;text-align: left;" class="camera-fields">
            				<div>
            					<a class="upload-field-button" id="edit_upload-beneficiary_mobile" style="width: 109px;">Browse</a> 
            					<input type="file" id="edit_beneficiary-picture_mobile" style="display:none" onChange="uploadOnChange('edit_beneficiary-picture_mobile', 'edit_beneficiary-picture-filename_mobile')">
            					<input type="text" id="edit_beneficiary-picture-filename_mobile" name="edit_beneficiary-picture-filename" style="display:none">
            					<b style="margin-left: 8px;font-size: 12px;">Click to upload a pic or beneficiary</b>
            					<div id="edit_beneficiary-picture_mobile-preview-container" style="display:none;margin-top: 10px;">
            						<a href="" id="edit_beneficiary-picture_mobile-preview" target="_blank"></a>
            					</div>
            				</div>
            			</div>	           
        			</div>
        			<div class="field-group" style="margin-top: 20px;margin-bottom: 20px !important; ">
						<label><span class="required">*</span> Beneficiary Type:</label>
						<select class="form-control" id="edit_beneficiary-type" required name="edit_sToWhomType">
							<option value="">Select Beneficiary Type</option>
							<option value="Family/Relative">Family/Relative</option>
							<option value="Neighbor">Neighbor</option>
							<option value="Stranger">Stranger</option>
							<option value="Community">Community</option>
						</select>
        			</div>
        		</div>
				<div class="form-action" style="margin-bottom:20px">
	                <input type="submit" name="edit_op" value="Previous" style="width:45%" id="edit_b2-previous-button-mobile" /> 
	                <input type="button" name="edit_op" value="Submit" class="success" id="edit_b2-submit-mobile" style="width:45%" /> 
				</div>
			</div>
		</div>
	</form>
</div>