				<div class="divider"></div>
				<div id="mentor1_cbtop">
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
																			<div class="jboxbody">
																				<div class="jboxcontent" style="text-align:center;">
																					Your account is: <div style="color:green; font-weight:bold;">Active</div>
																				</div>
																			</div>
																			<div class="jboxfoot"><p></p></div>
																		</div>
																	</td>
																	<td>&nbsp;</td>
																	<td style="padding:0;">
																		<div id="kindness_btnVolunteerDeactivate" class="jbox" style="width:180px; height:60px;">
																			<div class="jboxhead"><h2></h2></div>
																			<div class="jboxbody">
																				<div class="jboxcontent" style="text-align:center;">
																					Click to <div style="color:red; font-weight:bold;">Deactivate Account</div>
																				</div>
																			</div>
																			<div class="jboxfoot"><p></p></div>
																		</div>
																		<input type="hidden" id="kindness_sVolunteerType" name="mystudies_sVolunteerType" value="mentor" />
																		<div id="kindness_VolunteerDeactivateDialog" title="<span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>Deactivate Account Notice">
																			<p>Are you sure that you want to <u>deactivate</u> your account?</p>
																		</div>
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
																					Choose the Citation that you wish to reviw and then click one of the following buttons below:
																				</div>
																			</div>
																			<div class="jboxfoot"><p></p></div>
																		</div>
																	
																		<table cellpadding="0" cellspacing="0" border="0">
																			<tr>
																				<td height="20">&nbsp;</td>
																				<td rowspan="4" valign="top"><img src="<?php echo THEME_IMGPATH; ?>gi_editor_lines.gif" border="0" /></td>
																			</tr>
																			<tr>
																				<td>
																					<button class="light-button-blue-gradient" id="kindness_mentor_pending" onclick="location='/kindness/mentor/pending'" >Pending Citation</button>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					<button class="light-button-blue-gradient" id="kindness_mentor_approve" onclick="location='/kindness/mentor/approve'" >Approved Citation</button>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					<button class="light-button-blue-gradient" id="kindness_mentor_disapprove" onclick="location='/kindness/mentor/disapprove'" >Disapproved Citation</button>
																				</td>
																			</tr>
																		</table>
																		
																		<div id="kindness_NoFeatureDialog" title="Mentor Notice" style="display:none;">
																			<p>You cannot approve any Citation, yet. Please wait for, at least, a Samaritan to be assigned to you first.</p>
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
																				You have chosen to be a Mentor for <?php echo _tplvar('iRequest')." Hopeful".((_tplvar('iRequest') > 1) ? 's':'') ?>. 
																				However, there <?php echo (_tplvar('iAvailableHopefuls') == 1) ? "is":"are" ?> only <?php echo _tplvar('iAvailableHopefuls')." Hopeful".((_tplvar('iAvailableHopefuls') > 1) ? 's':'') ?> available to be assigned to you. 
																				You will be notified when additional Guides are available.
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
																					<div class="gi_pink" align="center">
																						<div><p><?php echo _tplvar('iAvailableHopefuls') ?></p>Samaritans not assigned</div>
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
																									<form method="post" action="<?php echo base_path(); ?>kindness/mentor/assign/hopefuls">
																										<select id="kindness_mentor_hopefuls_count" name="kindness_mentor_hopefuls_count">
																											<option value="1">1</option>
																											<option value="2">2</option>
																											<option value="3">3</option>
																											<option value="4">4</option>
																											<option value="5">5</option>
																										</select>
																										<input type="image" align="absmiddle" id="kindness_mentor_hopefuls_post" name="kindness_mentor_hopefuls_post" src="<?php echo THEME_IMGPATH; ?>btn_blue_set.png" border="0" /></a>
																									</form>
																								</div>
																								Select from the Drop-Down Box the number of Samaritans that you wish to review.
																							</div>
																						</div>
																						<div class="jboxfoot"><p></p></div>
																					</div>
																					<hr class="divider" style="margin:2px" />
																				</td>
																			</tr>
																			<tr>
																				<td colspan="2" valign="middle">
																					<div class="gi_green" align="center" style="float:left">
																						<div><p><?php echo _tplvar('iRequest') ?></p>Samaritans you have requested</div>
																					</div>
																				</td>
																			</tr>
																			<tr>
																				<td colspan="2" valign="middle">
																					<div class="gi_green" align="center" style="float:left">
																						<div><p><?php echo _tplvar('iAssignedHopeful') ?></p>Samaritans assigned to you</div>
																					</div>
																					<div class="note">You can change this number at any time</div> 
																				</td>
																			</tr>
																			<tr>
																				<td colspan="2">
																					<div class="gi_green" align="center" style="float:left">
																						<div><p><?php echo _tplvar('iApprovedWorkz') ?></p>Citation you've reviewed</div>
																					</div>
																				</td>
																			</tr>
																			<tr>
																				<td colspan="2">
																					<div class="gi_pink" align="center">
																						<div><p><?php echo _tplvar('iPendingWorkz') ?></p>Citation waiting for you</div>
																					</div>
																				</td>
																			</tr>
																			<tr>
																				<td colspan="2">
																					<div class="gi_pink" align="center">
																						<div><p><?php echo _tplvar('iWaitingHopefuls') ?></p>Samaritans waiting for you</div>
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
																								Click <a href="javascript:void(0);" id="kindness_hopefuls_block_show">here</a> to see your assigned Hopefuls<br />
																								Click <a href="#">here</a> to see the Community of all Reviewer Volunteers.
 																							</div>
																						</div>
																						<div class="jboxfoot"><p></p></div>
																					</div>
																					<hr class="divider" style="margin:2px" />
																				</td>
																			</tr>
																			<tr>
																				<td colspan="2">
																					<div class="gi_green" align="center">
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
			
