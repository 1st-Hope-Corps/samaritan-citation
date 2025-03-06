				<div class="divider"></div>
				<div id="guide1_cbtop">
					<div class="cbb">
						<div class="left-border">
							<div class="right-border">
								<table width="980" border="0" cellpadding="0" cellspacing="0" id="gi_nav">
									<tr><td height="25" class="bgfix"></td></tr>
									<tr>
									  <td valign="top" align="left">
									  	<div id="gi_internal" style="width:960px">
											<div class="cbb" style="text-align:center">
												<div class="jbox" style="width:920px;text-align:left">
													<div class="jboxhead"><h2></h2></div>
													<div class="jboxbody">
														<div class="jboxcontent">
															The Entertainment Portal is powered by the Internet which is the world's largest library of videso, documents, photos, books, etc. on Earth. The Internet stores over a Trillion pages of information on, virtually, any subject but surfing throiiugh all these pages to find the best video, report, or photo on a particular subject can be a very difficult task. Especially, if you are a child. As a Guide, you will be leadin the children to the best content on the Internet.
														</div>
													</div>
													<div class="jboxfoot"><p></p></div>
												</div>
												<table style="margin-top:10px;" width="100%" border="0" cellpadding="0" cellspacing="0">
													<tr>
														<td width="570" align="left">
															<div class="jbox">
																<table style="margin:0 0 13px;">
																	<tr>
																		<td style="padding:0;">
																			<div class="jbox" style="width:277px; height:60px;">
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
																			<div id="entertainment_btnVolunteerDeactivate" class="jbox" style="width:277px; height:60px;">
																				<div class="jboxhead"><h2></h2></div>
																				<div class="jboxbody">
																					<div class="jboxcontent" style="text-align:center;">
																						Click to <div style="color:red; font-weight:bold;">Deactivate Account</div>
																					</div>
																				</div>
																				<div class="jboxfoot"><p></p></div>
																			</div>
																			<input type="hidden" id="entertainment_sVolunteerType" name="entertainment_sVolunteerType" value="guide" />
																			<div id="entertainment_VolunteerDeactivateDialog" title="<span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>Deactivate Account Notice">
																				<p>Are you sure that you want to <u>deactivate</u> your account?</p>
																			</div>
																		</td>
																	</tr>
																</table>
																
																<div class="jboxhead"><h2></h2></div>
																<div class="jboxbody">
																	<div class="jboxcontent" style="text-align:center">
																		<img id="entertainmentGuides" src="<?php echo THEME_IMGPATH; ?>gi_guide_clicktorecommend.jpg" border="0" />
																		<div id="entertainment_NoFeatureDialog" title="Guide Notice">
																			<p>You cannot suggest any contents, yet. Please wait for an Editor to be assigned to you first.</p>
																		</div>
																	</div>
																</div>
																<div class="jboxfoot"><p></p></div>
															</div>
														</td>
														<td width="1" class="dividerv"></td>
														<td align="right">
															<div class="jbox">
																<div class="jboxhead"><h2></h2></div>
																<div class="jboxbody">
																	<div class="jboxcontent" style="text-align:center">
																		<div class="btn_guide_editor">
																			<?php
																			if (_tplvar('sEditor') != "none"){
																				echo '<span id="guide_editor_value">'._tplvar('sEditor').'</span> is your assigned editor';
																			}else{
																				echo '<span id="guide_editor_value" style="display:none;">none</span>No editor is assigned to you, yet.';
																			}
																			?>
																		</div>
																		<hr class="divider" />
																		<!--<div class="gi_green" align="center">
																			<div><p><?php //echo _entertainment_volunteer_rec_count(_tplvar('iUserId')); ?></p>Items you have recommended</div>
																		</div>-->
																		
																		<div class="gi_green" align="center">
																			<div><p><?php echo _tplvar('iApproveCount'); ?></p>Items approved</div>
																		</div>
																		
																		<p class="gi_comment">Click <a href="#">here</a> to see all of your recommended items</p>
																		
																		<div class="<?php echo (_tplvar('bAssignedEditor') == 'Yes') ? 'gi_green':'gi_pink' ?>" align="center">
																			<div><p><?php echo _tplvar('bAssignedEditor'); ?></p>Editor assigned</div>
																		</div>
																		
																		<div class="gi_pink" align="center">
																			<div><p><?php echo _tplvar('iDispproveCount'); ?></p>Items disapproved</div>
																		</div>
																		
																		<div class="gi_green" align="center">
																			<div><p><?php echo _tplvar('iHopePoints'); ?></p>Hope points</div>
																		</div>					
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
			
