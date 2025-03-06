				<div class="divider"></div>
				<div id="step12_cbtop">
					<div class="cbb">
						<div class="left-border">
							<div class="right-border">
								<table width="980" border="0" cellpadding="0" cellspacing="0">
									<tr>
									  <td height="50" class="bgfix1" width="100"></td>
								      <td valign="top" align="left" width="405" class="gi_title">Choose a Subject</td>
								      <td valign="top" class="bgfix2" width="100">&nbsp;</td>
								      <td valign="top" align="left" class="gi_title">Choose the type of content from the dropdown list below and then, click the GO button</td>
								  	</tr>
									<tr>
									  <td height="25" colspan="4">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
										  <tr>
											<td width="50%" valign="top" style="padding-right:5px;">
												<div class="jbox">
													<div class="jboxhead"><h2></h2></div>
													<div class="jboxbody">
														<div class="jboxcontent" style="height:350px;">
															<div style="height:320px;padding:0px 20px 10px 0px;overflow:auto;">
																<ul id="values_VolunteerCatList"></ul>
															</div>
														</div>
													</div>
													<div class="jboxfoot"><p></p></div>
												</div>
											</td>
											<td width="1" class="dividerv"></td>
											<td valign="top" style="padding-left:5px;" align="center">
												<div class="jbox">
													<div class="jboxhead"><h2></h2></div>
													<div class="jboxbody">
														<div class="jboxcontent" style="height:350px">
															<form name="edit_existing_items" method="post" action="<?php echo base_path(); ?>values/getinvolved/<?php echo _tplvar('sLoggedType'); ?>/existing/items">
																<input type="hidden" id="volunteer_iGroupId" name="editors_iGroupLevel" value="" />
																<div style="width:90%">
																	<br /><hr class="divider" />
																	<br/>
																	<div class="gi_white" align="center">
																		<p>
																			<!--<select id="editors_sContentType" name="editors_sContentType">
																				<option value="site">Website</option>
																				<option value="image">Photo</option>
																				<option value="video">Video</option>
																				<option value="animation">Animation</option>
																				<option value="doc">Book/Report</option>
																			</select>-->
																			<input type="hidden" id="editors_sContentType" name="editors_sContentType" value="content" />
																			<label id="guides_sContentTypeLabel">Please select any Category</label>
																		</p>
																	</div>
																	<br />
																	<img style="margin-right:50px;cursor:pointer;" id="editors_btnExistingItemsGo" src="<?php echo THEME_IMGPATH; ?>btn_blue_go.png" border="0" />
																	<img style="cursor:pointer;" id="editors_btnCancel" onclick="location='<?php echo base_path(); ?>values/getinvolved/<?php echo _tplvar('sLoggedType'); ?>'" src="<?php echo THEME_IMGPATH; ?>btn_blue_cancel.png" border="0" />
																	<br /><br /><hr class="divider" />
																	<br />
																	<h4 style="color:#000000;text-align:left;">Legend</h4>
																	<p style="color:#000000;text-align:left;height:30px;">All subjects are color coded to show the number of items of content in each section<br /></p>
																	<p style="color:#000000;text-align:left;margin-top:5px;" class="categ_red">Some subjects or subsections have 0 content</p>
																	<p style="color:#000000;text-align:left;margin-top:5px;" class="categ_yellow">Some subjects or subsections have less than 5 items of content</p>
																	<p style="color:#000000;text-align:left;margin-top:5px;" class="categ_green">All subjects and subsections have at least 5 items</p>
																</div>
															</form>
														</div>
													</div>
													<div class="jboxfoot"><p></p></div>
												</div>
											</td>
										  </tr>
										</table>
									  </td>
									</tr>
								</table>
							</div>
						</div>					
					</div>
				</div>
			
