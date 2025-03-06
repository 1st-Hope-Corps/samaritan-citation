				<div class="divider"></div>
				<div id="cybrarian_cbtop">
					<div class="cbb">
						<div class="left-border">
							<div class="right-border">
								<table width="980" border="0" cellpadding="0" cellspacing="0" id="gi_nav">
									<tr><td height="25" class="bgfix"></td></tr>
									<tr>
									  <td valign="top" align="left">
									  	<div id="gi_internal" style="width:960px">
											<div class="cbb" style="text-align:center">
												<table style="margin-top:10px;" width="100%" border="0" cellpadding="0" cellspacing="0">
													<tr>
														<td width="370" align="left">
															<table style="margin:0 0 13px;">
																<tr>
																	<td style="padding:0;">
																		<div class="jbox" style="width:180px; height:60px;">
																			<div class="jboxhead"><h2></h2></div>
																			<div class="jboxbody" id="top">
																				<div class="jboxcontent" style="text-align:center;">
																					Your account is: <div style="color:green; font-weight:bold;">Active</div>
																				</div>
																			</div>
																			<div class="jboxfoot"><p></p></div>
																		</div>
																	</td>
																	<td>&nbsp;</td>
																	<td style="padding:0;">
																		<div id="cybrary_btnVolunteerDeactivate" class="jbox" style="width:180px; height:60px;cursor:pointer;">
																			<div class="jboxhead"><h2></h2></div>
																			<div class="jboxbody">
																				<div class="jboxcontent" style="text-align:center;">
																					Click to <div style="color:red; font-weight:bold;">Deactivate Account</div>
																				</div>
																			</div>
																			<div class="jboxfoot"><p></p></div>
																		</div>
																		<input type="hidden" id="kindness_sVolunteerType" name="mystudies_sVolunteerType" value="mentor" />
																		<!--<div id="kindness_VolunteerDeactivateDialog" title="<span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>Deactivate Account Notice">
																			<p>Are you sure that you want to <u>deactivate</u> your account?</p>
																		</div>-->
																	</td>
																</tr>
															</table>
															
															<div class="jbox">
																<div class="jboxhead"><h2></h2></div>
																<div class="jboxbody">
																	<div class="jboxcontent" style="text-align:center">
																		<div class="jbox">
																			<div class="jboxhead"><h2></h2></div>
																			<div class="jboxbody">
																				<div class="jboxcontent" style="text-align:center">
																					Click one of the following buttons below:
																				</div>
																			</div>
																			<div class="jboxfoot"><p></p></div>
																		</div>
																	
																		<table cellpadding="0" cellspacing="0" border="0">
																			<tr>
																				<td height="20">&nbsp;</td>
																				<td rowspan="8" valign="top"><img src="<?php echo THEME_IMGPATH; ?>gi_editor_lines_cybrary.gif" border="0" /></td>
																			</tr>
																			<tr><td><input type="image" id="cybrarian_start" src="<?php echo THEME_IMGPATH; ?>gi_btncstart.png" border="0" /></td></tr>
																			<tr><td><input type="image" id="cybrarian_stop" src="<?php echo THEME_IMGPATH; ?>gi_btncstop.png" border="0" /></td></tr>
																			<tr><td><input type="image" id="cybrarian_current" src="<?php echo THEME_IMGPATH; ?>gi_btnccurrent.png" border="0" /></td></tr>
																			<tr><td><input type="image" id="cybrarian_status" src="<?php echo THEME_IMGPATH; ?>gi_btncstatus.png" border="0" /></td></tr>
																			<tr><td><input type="image" id="cybrarian_convert" src="<?php echo THEME_IMGPATH; ?>gi_btncconvert.png" border="0" /></td></tr>
																			<tr><td><input type="image" id="cybrarian_schedule" src="<?php echo THEME_IMGPATH; ?>gi_btncschedule.png" border="0" /></td></tr>
																			<tr><td><input type="image" id="cybrarian_duties" src="<?php echo THEME_IMGPATH; ?>gi_btncduties.png" border="0" /></td></tr>
																		</table>
																		
																		<div id="kindness_NoFeatureDialog" title="Mentor Notice" style="display:none;">
																			<p>{text here}</p>
																		</div>
																	</div>
																</div>
																<div class="jboxfoot"><p></p></div>
																
																<?php
																if (_tplvar('iRequest') > _tplvar('iAvailableHopefuls')){
																	?>
																	<div class="jbox" style="margin-top:13px;">
																		<div class="jboxhead"><h2></h2></div>
																		<div class="jboxbody">
																			<div class="jboxcontent">
																				<p style="text-align:center; font-size:1.3em; font-weight:bold; padding-bottom:10px;">Account Status</p>
																				You have chosen to be a Cybrarian for <?php echo _tplvar('iRequest')." Hopeful".((_tplvar('iRequest') > 1) ? 's':'') ?>. 
																				However, there <?php echo (_tplvar('iAvailableHopefuls') == 1) ? "is":"are" ?> only <?php echo _tplvar('iAvailableHopefuls')." Hopeful".((_tplvar('iAvailableHopefuls') > 1) ? 's':'') ?> available to be assigned to you. 
																				You will be notified when additional {text here} are available.
																			</div>
																		</div>
																		<div class="jboxfoot"><p></p></div>
																	</div>
																	<?php
																}
																?>
															</div>
														</td>
														<td width="1" class="dividerv"></td>
														<td align="right">
															<div class="jbox">
																<div class="jboxhead"><h2></h2></div>
																<div class="jboxbody">
																	<div class="jboxcontent">
																		<table width="100%" cellpadding="0" cellspacing="0" border="0" id="gi_editor_stats">
																		    <tr>
																				<td colspan="2">
																					<div align="left">
																						<div style="padding-left:78px;">Cybrary positions open</div>
																					</div>
																				</td>
																			</tr>
																			<tr>
																				<td colspan="2">
																					<div class="<?php echo _tplvar('iCybraryPositionCount')==0 ? 'gi_pink' :  'gi_green'; ?>" align="center">
																						<div><p><?php echo _tplvar('iCybraryPositionCount') ?></p><a href="javascript:void(0);" id="positionDetails">Click for Details</a></div>
																					</div>
																				</td>
																			</tr>
																			<tr>
																				<td width="70">&nbsp;</td>
																				<td valign="top">
																					<hr class="divider" style="margin:2px" />
																					<div class="jbox">
																						<div class="jboxhead"><h2></h2></div>
																						<div class="jboxbody">
																							<div class="jboxcontent">
																								<div style="float:left; margin-right:10px;">
																									<form method="post" action="<?php echo base_path(); ?>volunteer/positionchange">
																										<?php
																										global $user;
																										$strPosition = db_result(db_query("SELECT position FROM {cybrarian_optin} WHERE uid = '{$user->uid}'"));
																										
																										$SQLallPosition = db_query("SELECT cybpos_id, cybpos_name, max_available FROM {cybrarian_positions} WHERE cybschool_id = '"._tplvar('iCybSchoolID')."'");
																										
																										$arr_position = array();
																										while($oPosition = db_fetch_object($SQLallPosition)){
																										
																										$intTakenPosition = db_result(db_query("SELECT count(cyb_id) FROM {cybrarian_optin} WHERE position = '".strtolower($oPosition->cybpos_name)."' AND school = '"._tplvar('iCybSchoolName')."'"));
																											if($intTakenPosition < $oPosition->max_available){
																											$arr_position[$oPosition->cybpos_id] = strtolower($oPosition->cybpos_name);			
																											} else{
																												$strlowercybpos_name = strtolower($oPosition->cybpos_name);	
																												if($strlowercybpos_name == $strPosition){
																												$arr_position[$oPosition->cybpos_id] = strtolower($oPosition->cybpos_name);
																												}
																											}
																										}
																										
																										$valposition = '<select id="cybrarian_volunteer_count" name="cybrarian_volunteer_count">
																														<option value=""></option>';
																														
																										foreach($arr_position as $posid => $posname){
																											if($posname == $strPosition){
																											$valposition .= "<option value='".strtolower($posname)."' selected='selected'>".ucwords($posname)."</option>";
																											} else{
																											$valposition .= "<option value='".strtolower($posname)."'>".ucwords($posname)."</option>";
																											}
																										}
																										
																										$valposition .= '</select>';
																										
																										echo $valposition;
																										?>
																										<input type="image" align="absmiddle" id="kindness_mentor_hopefuls_post" name="kindness_mentor_hopefuls_post" src="<?php echo THEME_IMGPATH; ?>btn_blue_set.png" border="0" /></a>
																									</form>
																								</div>
																								Select from the drop down box the cybrary volunteer position of your choice.
																							</div>
																						</div>
																						<div class="jboxfoot"><p></p></div>
																					</div>
																					<hr class="divider" style="margin:2px" />
																				</td>
																			</tr>
																			<tr>
																				<td width="70">&nbsp;</td>
																				<td valign="top">
																					<hr class="divider" style="margin:2px" />
																					<div class="jbox">
																						<div class="jboxhead"><h2></h2></div>
																						<div class="jboxbody">
																							<div class="jboxcontent">
																								<div style="float:left; margin-right:10px;">
																									<form method="post" action="<?php echo base_path(); ?>volunteer/hourschange">
																									<?php
																										global $user;
																										$strHours = _tplvar('iHoursRequest');
					
																										$valhours = '<select id="cybrarian_volunteer_hours_count" name="cybrarian_volunteer_hours_count">
																													 <option value=""></option>';
																										$int = 1;
																										while($int <= 50){			 
																											if($int == $strHours){
																											$valhours .= "<option value='".$int."' selected='selected'>".$int."</option>";
																											} else{
																											$valhours .= "<option value='".$int."'>".$int."</option>";
																											}
																										$int++;
																										}
																										$valhours .= '</select>';
																										
																										echo $valhours;
																									?>
																									
																										<input type="image" align="absmiddle" id="kindness_mentor_hopefuls_post" name="kindness_mentor_hopefuls_post" src="<?php echo THEME_IMGPATH; ?>btn_blue_set.png" border="0" /></a>
																									</form>
																								</div>
																								Select from the drop down box the number of hours that you wish to volunteer a week.
																							</div>
																						</div>
																						<div class="jboxfoot"><p></p></div>
																					</div>
																					<hr class="divider" style="margin:2px" />
																				</td>
																			</tr>
																			<tr>
																				<td colspan="2" valign="middle">
																					<div class="<?php echo _tplvar('iHoursRequest')==0 ? 'gi_pink' :  'gi_green'; ?>" align="center" style="float:left">
																						<div><p><?php echo _tplvar('iHoursRequest') ?></p>Hours per week you requested</div>
																					</div>
																					<div class="note">You can change this number at any time</div> 
																				</td>
																			</tr>
																			<tr>
																				<td colspan="2" valign="middle">
																					<div class="<?php echo _tplvar('iAssignedCoordinators')==0 ? 'gi_pink' :  'gi_green'; ?>"" align="center" style="float:left">
																						<div><p><?php echo _tplvar('iAssignedCoordinators') ?></p>eAdministrator Assigned to you</div>
																					</div>
																				</td>
																			</tr>
																			<tr>
																				<td colspan="2">
																					<div class="<?php echo _tplvar('iHoursperWeekAssigned')==0 ? 'gi_pink' :  'gi_green'; ?>" align="center" style="float:left">
																						<div><p><?php echo _tplvar('iHoursperWeekAssigned') ?></p>Hours per week assigned to you</div>
																					</div>
																					<div class="note">You can change this number at any time</div> 
																				</td>
																			</tr>
																			<tr>
																				<td colspan="2">
																					<div class="<?php echo _tplvar('iKindness_Hours')==0 ? 'gi_pink' :  'gi_green'; ?>" align="center">
																						<div><p><?php echo _tplvar('iKindness_Hours') ?></p>Kindness Hours</div>
																					</div>
																				</td>
																			</tr>
																			<tr>
																				<td colspan="2">
																					<div class="<?php echo _tplvar('iKindness_Approved')==0 ? 'gi_pink' :  'gi_green'; ?>" align="center">
																						<div><p><?php echo _tplvar('iKindness_Approved') ?></p>Kindness Workz approved</div>
																					</div>
																				</td>
																			</tr>
																			<tr>
																				<td width="70">&nbsp;</td>
																				<td valign="top">
																					<hr class="divider" style="margin:2px" />
																					<div class="jbox">
																						<div class="jboxhead"><h2></h2></div>
																						<div class="jboxbody">
																							<div class="jboxcontent">
																								Click <a href="javascript:void(0);" id="assignedCoordinator">here</a> to see your assigned eAdministrator school and team<br />
																								<!--Click <a href="http://www.hopecybrary.org/community/members?css=kickapps_theme2010" target="blank">here</a> to see your Cybrary community<br />-->
																								Click <a href="javascript:void(0);" id="forgotstart">here</a> to write a kindness workz form if you forgot to click start 
																								<div id="forgot_start_Dialog" title="Forgot Kindness Workz" style="display:none;">
																									<div id="forgot_start_Dialog_content">&nbsp;</div>
																								</div>
																								<div id="calendar_Dialog" title="My Calendar" style="display:none;">
																									<iframe src="" width="1180" height="580" id="calendar_url" frameBorder="0"></iframe>
																								</div>
																							</div>
																						</div>
																						<div class="jboxfoot"><p></p></div>
																					</div>
																					<hr class="divider" style="margin:2px" />
																				</td>
																			</tr>
																			<tr>
																				<td colspan="2">
																					<div class="<?php echo _tplvar('iHopePoints')== 0 ? 'gi_pink' :  'gi_green'; ?>" align="center">
																						<div><p><?php echo _tplvar('iHopePoints') ?></p>Hope Points</div>
																					</div>
																				</td>
																			</tr>
																		</table>
																	</div>
																</div>
																<div class="jboxfoot"><p></p></div>
															</div>
														</td>
													</tr>
												</table>
											</div>		
										</div>	
									  </td>
								  </tr>
								</table>
							</div>
						</div>					
					</div>
				</div>
			
