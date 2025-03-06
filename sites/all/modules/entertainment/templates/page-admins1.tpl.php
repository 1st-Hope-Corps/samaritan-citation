				<div class="divider"></div>
				<div id="admin1_cbtop">
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
																		<div id="entertainment_btnVolunteerDeactivate" class="jbox" style="width:180px; height:60px;">
																			<div class="jboxhead"><h2></h2></div>
																			<div class="jboxbody">
																				<div class="jboxcontent" style="text-align:center;">
																					Click to <div style="color:red; font-weight:bold;">Deactivate Account</div>
																				</div>
																			</div>
																			<div class="jboxfoot"><p></p></div>
																		</div>
																		<input type="hidden" id="entertainment_sVolunteerType" name="entertainment_sVolunteerType" value="admin" />
																		<div id="entertainment_VolunteerDeactivateDialog" title="<span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>Deactivate Account Notice">
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
																				<td valign="top">
                                                                                	<div style="height:40px;">&nbsp;</div>
                                                                                	<div style="height:60px;"><input type="image" id="entertainment_admin_pending_items" onclick="Volunteer_CheckIfToFollowlink('<?php echo _tplvar('bCanDoSomething') ?>', '<?php echo base_path(); ?>entertainment/getinvolved/admins/pending/items');" src="<?php echo THEME_IMGPATH; ?>btn_blue_administerpendingcontent.png" border="0" /></div>
                                                                                	<div style="height:70px;"><input type="image" id="entertainment_admin_existing_items" onclick="Volunteer_CheckIfToFollowlink('<?php echo _tplvar('bCanDoSomething') ?>', '<?php echo base_path(); ?>entertainment/getinvolved/admins/existing/items');" src="<?php echo THEME_IMGPATH; ?>btn_blue_administerexistingcontent.png" border="0" /></div>
																					<div style="height:70px;"><input type="image" id="entertainment_admin_pending_cats" onclick="Volunteer_CheckIfToFollowlink('<?php echo _tplvar('bCanDoSomething') ?>', '<?php echo base_path(); ?>entertainment/getinvolved/admin/pending/subjects');" src="<?php echo THEME_IMGPATH; ?>btn_blue_administerpendingcategories.png" border="0" /></div>
																					<div><input type="image" id="entertainment_admin_existing_cats" onclick="Volunteer_CheckIfToFollowlink('<?php echo _tplvar('bCanDoSomething') ?>', '<?php echo base_path(); ?>entertainment/getinvolved/admins/existing/cats');" src="<?php echo THEME_IMGPATH; ?>btn_blue_administerexistingcategories.png" border="0" /></div>
                                                                                </td>
																				<td valign="top" rowspan="5" valign="top"><img src="<?php echo THEME_IMGPATH; ?>gi_admin_line.gif" border="0" /></td>
																			</tr>
																		</table>
																		
																		<div id="entertainment_NoFeatureDialog" title="Administrator Notice">
																			<p>You cannot administer any contents, yet. Please wait for, at least, an Editor to be assigned to you first.</p>
																		</div>
																	</div>
																</div>
																<div class="jboxfoot"><p></p></div>
																
																<?php
																$iFreeEditorCount = _entertainment_volunteer_available("editor");
																
																if (_tplvar('iEditorsReqTotal') > $iFreeEditorCount){
																	?>
																	<div class="jbox" style="margin-top:13px;">
																		<div class="jboxhead"><h2></h2></div>
																		<div class="jboxbody">
																			<div class="jboxcontent">
																				<p style="text-align:center; font-size:1.3em; font-weight:bold; padding-bottom:10px;">Account Status</p>
																				You have chosen to be an Admin for <?php echo _tplvar('iEditorsReqTotal')." Editor".((_tplvar('iEditorsReqTotal') > 1) ? 's':'') ?>. 
																				However, there <?php echo ($iFreeEditorCount == 1) ? "is":"are" ?> only <?php echo $iFreeEditorCount." Editor".(($iFreeEditorCount > 1) ? 's':'') ?> available to be assigned to you. 
																				You will be notified when additional Editors are available.
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
																						<div><p><?php echo _entertainment_volunteer_available("editor"); ?></p>Editors not assigned an Admin</div>
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
																									<form method="post" action="<?php echo base_path(); ?>entertainment/getinvolved/admin/assign/editors">
																										<select id="entertainment_admin_editors_count" name="entertainment_admin_editors_count" style="font-size:1.2em; font-weight:bold; vertical-align:bottom;">
																											<option value="1">1</option>
																											<option value="2">2</option>
																											<option value="3">3</option>
																											<option value="4">4</option>
																											<option value="5">5</option>
																										</select>
																										
																										<input type="image" id="entertainment_editor_guides_count_post" name="entertainment_editor_guides_count_post" align="absmiddle" <?php echo ((_entertainment_volunteer_available("editor") == 0) ? 'disabled="disabled"':''); ?> src="<?php echo THEME_IMGPATH; ?>btn_blue_set.png" border="0" /></a>
																									</form>
																								</div>
																								Select from the Drop-Down Box the number of Editors that you wish to Administer.
																							</div>
																						</div>
																						<div class="jboxfoot"><p></p></div>
																					</div>
																					<hr class="divider" style="margin:2px" />
																				</td>
																			</tr>
																			<tr>
																				<td colspan="2" valign="middle">
																					<div class="<?php echo (_tplvar('iEditorsReqTotal') > 0) ? 'gi_green':'gi_pink' ?>" align="center" style="float:left">
																						<div><p><?php echo _tplvar('iEditorsReqTotal'); ?></p>Editors you have requested</div>
																					</div>
																				</td>
																			</tr>
																			<tr>
																				<td colspan="2" valign="middle">
																					<div class="gi_green" align="center" style="float:left">
																						<div><p><?php echo _entertainment_volunteer_assigned_count("admin"); ?></p>Editors assigned to you</div>
																					</div>
																					<div class="note">You can change this number at any time</div> 
																				</td>
																			</tr>
																			<tr>
																				<td colspan="2">
																					<div class="gi_green" align="center" style="float:left">
																						<div><p><?php echo _entertainment_volunteer_rec_count(_tplvar('iUserId'), "admin"); ?></p>Items you have Administered</div>
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
																						<div><p><?php echo _entertainment_admins_pending_count(); ?></p>Items waiting to be Administered</div>
																					</div>
																				</td>
																			</tr>
																			<tr>
																				<td colspan="2">
																					<div class="gi_pink" align="center">
																						<div><p><?php echo _entertainment_admins_pending_count("editor"); ?></p>Editors waiting for you</div>
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
																								Click <a href="javascript:void(0);" id="entertainment_guides_block_show">here</a> to see your assigned Editors<br />
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
			
