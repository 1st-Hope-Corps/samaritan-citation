				<div class="divider"></div>
				<div id="editor1_cbtop">
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
																		<div id="values_btnVolunteerDeactivate" class="jbox" style="width:180px; height:60px;">
																			<div class="jboxhead"><h2></h2></div>
																			<div class="jboxbody">
																				<div class="jboxcontent" style="text-align:center;">
																					Click to <div style="color:red; font-weight:bold;">Deactivate Account</div>
																				</div>
																			</div>
																			<div class="jboxfoot"><p></p></div>
																		</div>
																		<input type="hidden" id="values_sVolunteerType" name="values_sVolunteerType" value="editor" />
																		<div id="values_VolunteerDeactivateDialog" title="<span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>Deactivate Account Notice">
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
																					Choose the items of content that you wish to edit and then click one of the buttons below:
																				</div>
																			</div>
																			<div class="jboxfoot"><p></p></div>
																		</div>
																	
																		<table cellpadding="0" cellspacing="0" border="0">
																			<tr>
																				<td height="20">&nbsp;</td>
																				<td rowspan="4" valign="top"><img src="<?php echo THEME_IMGPATH; ?>gi_editor_lines.gif" border="0" /></td>
																			</tr>
																			<tr><td><input type="image" id="values_editor_pending_items" onclick="Volunteer_CheckIfToFollowlink('<?php echo _tplvar('bCanDoSomething') ?>', '<?php echo base_path(); ?>values/getinvolved/editors/pending');" <?php //echo _tplvar('sDisabled'); ?> src="<?php echo THEME_IMGPATH; ?>btn_blue_editpendingitems.gif" border="0" /></td></tr>
																			<tr><td><input type="image" id="values_editor_existing_items" onclick="Volunteer_CheckIfToFollowlink('<?php echo _tplvar('bCanDoSomething') ?>', '<?php echo base_path(); ?>values/getinvolved/editors/existing/items');" <?php //echo _tplvar('sDisabled'); ?> src="<?php echo THEME_IMGPATH; ?>btn_blue_editexistingitems.gif" border="0" /></td></tr>
																			<tr><td><input type="image" id="values_editor_existing_cats" onclick="Volunteer_CheckIfToFollowlink('<?php echo _tplvar('bCanDoSomething') ?>', '<?php echo base_path(); ?>values/getinvolved/editors/existing/cats');" <?php //echo _tplvar('sDisabled'); ?> src="<?php echo THEME_IMGPATH; ?>btn_blue_editexistingcategories.gif" border="0" /></td></tr>
																		</table>
																		
																		<div id="values_NoFeatureDialog" title="Editor Notice">
																			<p>You cannot edit any contents, yet. Please wait for, at least, a Guide and an Admin to be assigned to you first.</p>
																		</div>
																	</div>
																</div>
																<div class="jboxfoot"><p></p></div>
																
																<?php
																$iFreeGuideCount = _values_volunteer_available();
																
																if (_tplvar('iGuidesReqTotal') > $iFreeGuideCount){
																	?>
																	<div class="jbox" style="margin-top:13px;">
																		<div class="jboxhead"><h2></h2></div>
																		<div class="jboxbody">
																			<div class="jboxcontent">
																				<p style="text-align:center; font-size:1.3em; font-weight:bold; padding-bottom:10px;">Account Status</p>
																				You have chosen to be Editor for <?php echo _tplvar('iGuidesReqTotal')." Guide".((_tplvar('iGuidesReqTotal') > 1) ? 's':'') ?>. 
																				However, there <?php echo ($iFreeGuideCount == 1) ? "is":"are" ?> only <?php echo $iFreeGuideCount." Guide".(($iFreeGuideCount > 1) ? 's':'') ?> available to be assigned to you. 
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
																						<div><p><?php echo $iFreeGuideCount ?></p>Guides not assigned an Editor</div>
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
																									<form method="post" action="<?php echo base_path(); ?>values/getinvolved/editors/assign/guides">
																										<select id="values_editor_guides_count" name="values_editor_guides_count">
																											<option value="1">1</option>
																											<option value="2">2</option>
																											<option value="3">3</option>
																											<option value="4">4</option>
																											<option value="5">5</option>
																										</select>
																										
																										<input type="image" align="absmiddle" id="values_editor_guides_count_post" <?php echo ((_values_volunteer_available() == 0) ? 'disabled="disabled"':''); ?> name="values_editor_guides_count_post" src="<?php echo THEME_IMGPATH; ?>btn_blue_set.png" border="0" /></a>
																									</form>
																								</div>
																								Select from the Drop-Down Box the number of Guides that you wish to be Editor for.
																							</div>
																						</div>
																						<div class="jboxfoot"><p></p></div>
																					</div>
																					<hr class="divider" style="margin:2px" />
																				</td>
																			</tr>
																			<tr>
																				<td colspan="2" valign="middle">
																					<div class="<?php echo (_tplvar('iGuidesReqTotal') > 0) ? 'gi_green':'gi_pink' ?>" align="center" style="float:left">
																						<div><p><?php echo _tplvar('iGuidesReqTotal'); ?></p>Guides you have requested</div>
																					</div>
																				</td>
																			</tr>
																			<tr>
																				<td colspan="2" valign="middle">
																					<div class="<?php echo (_tplvar('bAssignedAdmin') == 'Yes') ? 'gi_green':'gi_pink' ?>" align="center" style="float:left">
																						<div><p><?php echo _tplvar('bAssignedAdmin'); ?></p>Administrator assigned to you</div>
																					</div>
																				</td>
																			</tr>
																			<tr>
																				<td colspan="2" valign="middle">
																					<div class="gi_green" align="center" style="float:left">
																						<div><p><?php echo _tplvar('iGuidesCounts'); ?></p>Guides assigned to you</div>
																					</div>
																					<div class="note">You can change this number at any time</div> 
																				</td>
																			</tr>
																			<tr>
																				<td colspan="2">
																					<div class="gi_green" align="center" style="float:left">
																						<div><p><?php echo _values_volunteer_rec_count(_tplvar('iUserId'), "editor"); ?></p>Items you have edited</div>
																					</div>
																					<div class="note"><a href="#">Click here to see all edited items</a></div> 
																				</td>
																			</tr>
																			<tr>
																				<td colspan="2">
																					<div class="gi_green" align="center" style="float:left">
																						<div><p><?php echo _tplvar('iApproveCount') ?></p>Items you have approved</div>
																					</div>
																				</td>
																			</tr>
																			<tr>
																				<td colspan="2">
																					<div class="gi_pink" align="center" style="float:left">
																						<div><p><?php echo _tplvar('iDispproveCount') ?></p>Items you have disapproved</div>
																					</div>
																				</td>
																			</tr>
																			<tr>
																				<td colspan="2">
																					<div class="gi_pink" align="center">
																						<div><p><?php echo _values_editors_pending_count(); ?></p>Items waiting for you to edit</div>
																					</div>
																				</td>
																			</tr>
																			<tr>
																				<td colspan="2">
																					<div class="gi_pink" align="center">
																						<div><p><?php echo _values_editors_pending_count("guides"); ?></p>Guides waiting for you</div>
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
																								Click <a href="javascript:void(0);" id="values_guides_block_show">here</a> to see your assigned Guides and Administrator<br />
																								Click <a href="#">here</a> to see the Community of all Entertainment Portal Volunteers.
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
																						<div><p><?php echo _tplvar('iHopePoints'); ?></p>Hope Points</div>
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
			
