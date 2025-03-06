				<div class="divider"></div>
				<div id="step3_cbtop">
					<div class="cbb">
						<div class="left-border">
							<div class="right-border">
								<table width="980" border="0" cellpadding="0" cellspacing="0">
									<tr>
									  <td height="50" class="bgfix3" width="100"></td>
								      <td valign="top" align="left" class="gi_title"><span id="gi_title"></span></td>
								    </tr>
									<tr>
									  <td>&nbsp;</td>	
									  <td>
									  	The Knowledge Portal is powered by the Internet which is the world's largest library of vides, documents, photos, books, etc. on Earth. The Internet stores over a Trillion pages of information on, virtually, any subject but surfing throiiugh all these pages to find the best video, report, or photo on a particular subject can be a very difficult task. Especially, if you are a child. As a Guide, you will be leading the children to the best content on the Internet.
									  </td>
									</tr>
									<tr>
									  <td colspan="2" height="20">&nbsp;
									 	 
									  </td>
									</tr>
									<tr>
									  <td colspan="2">	
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
										  <tr>
											<td width="480" style="padding-right:5px;">
												<div class="jboxh">
													<div class="jboxhead"><h2 id="guides_FileFormEmbed"></h2></div>
													<div class="jboxbody">
														<div class="jboxcontent">
															<form id="mystudies_file_add_embed" method="post" action="<?php echo base_path(); ?>mystudies/file/edit/add" enctype="multipart/form-data" onsubmit="return ValidateEmbed();">
																<input type="hidden" id="iUserId" name="iUserId" value="<?php echo _tplvar('iUserId'); ?>" />
																<input type="hidden" id="sFileTypeEmbed" name="sFileType" value="" />
																<input type="hidden" id="volunteer_iGroupId" name="iGroupLevel" value="0" />
																<input type="hidden" name="sRedirectTo" value="<?php echo base_path(); ?>mystudies/getinvolved/guides?b=1" />
																<input type="hidden" id="rating_iRatingId" name="rating_iRatingId" value="0" />
																
																<table>
																	<tr>
																		<td style="width:100px;">Title:</td>
																		<td><input type="text" id="sFileEmbedTitle" name="sFileEmbedTitle" style="width:300px;" /></td>
																	</tr>
																	<tr>
																		<td style="padding-top:5px;">Embed Code:</td>
																		<td style="padding-top:5px;"><textarea id="sFileEmbedCode" name="sFileEmbedCode" style="width:300px; height:100px;"></textarea></td>
																	</tr>
																	<tr>
																		<td style="padding-top:5px;">External URL:</td>
																		<td style="padding-top:5px;"><input type="text" id="sFileEmbedURL" name="sFileEmbedURL" style="width:300px;" /></td>
																	</tr>
																	<tr>
																		<td style="padding-top:5px;">Description:</td>
																		<td style="padding-top:5px;"><textarea id="sFileEmbedCodeDesc" name="sFileEmbedCodeDesc" style="width:300px; height:100px;"></textarea></td>
																	</tr>
																	<tr>
																		<td style=" padding-bottom:10px; padding-top: 13px;">Grade:</td>
																		<td style=" padding-top:10px;"><select id="sAgeGroup" name="sAgeGroup">
																			<option value="">All Grades</option>
																			<option value="12">12th Grade</option>
																			<option value="11">11th Grade</option>
																			<option value="10">10th Grade</option>
																		</select>
																		</td>
																	</tr>
																	<tr>
																<td style="padding-top:10px; ">Difficulty:</td>
																<td style="padding-top:10px; "><select id="Difficulty" name="Difficulty">
																	<option value="easy">Easy</option>
																	<option value="average">Average</option>
																	<option value="difficult">Difficult</option>
																	
																</select>
																</td>
															</tr>
																	
																	<tr>
																		<td style="padding-top:5px;">Tags:<br /><small>Primary Objective</small></td>
																		<td style="padding-top:5px;"><input type="text" id="pFileEmbedTags" name="pFileEmbedTags" style="width:300px;" /></td>
																	</tr>
																	<tr>
																		<td style="padding-top:5px;">Tags:<br /><small>Secondary Objective</small></td>
																		<td style="padding-top:5px;"><input type="text" id="sFileEmbedTags" name="sFileEmbedTags" style="width:300px;" /></td>
																	</tr>
																	<tr>
																		<td colspan="2" style="text-align:right; padding-top:12px;">
																			<input type="image" id="btnSuggest" name="btnSuggest" value="Upload" src="<?php echo THEME_IMGPATH; ?>btn_blue_suggestthisembedcode.gif" border="0" />&nbsp;&nbsp;
																			<img style="cursor:pointer" id="guides_btnSuggestCancel" name="guides_btnSuggestCancel" src="<?php echo THEME_IMGPATH; ?>btn_blue_cancel.gif" border="0" />
																		</td>
																	</tr>
																</table>
															</form>
														</div>
													</div>
													<div class="jboxfoot"><p></p></div>
												</div>	
											</td>
											<td width="1" class="dividerv"></td>
											<td style="padding-left:5px;">
												<div class="jboxh">
													<div class="jboxhead"><h2 id="guides_FileFormUpload"></h2></div>
													<div class="jboxbody">
														<div class="jboxcontent">
                                                            <form id="mystudies_file_add" method="post" action="<?php echo base_path(); ?>mystudies/file/edit/add/response" enctype="multipart/form-data" onsubmit="return ValidateUpload();">
																<input type="hidden" id="iUserId" name="iUserId" value="<?php echo _tplvar('iUserId'); ?>" />
																<input type="hidden" id="sFileType" name="sFileType" value="" />
																<input type="hidden" id="volunteer_iGroupId" name="iGroupLevel" value="0" />
																<input type="hidden" id="upload_ticket" name="upload_ticket" value="<?php echo _tplvar('sUpTicket'); ?>" />
																<input type="hidden" id="response_url" name="response_url" value="<?php echo base_path(); ?>mystudies/file/edit/add/response" />
																<input type="hidden" name="sRedirectTo" value="<?php echo base_path(); ?>mystudies/getinvolved/guides?b=1" />
																<input type="hidden" id="rating_iRatingId" name="rating_iRatingId" value="0" />
																<input type="hidden" id="location_type" name="location_type" value="mystudies" />
																
																<table>
																	<tr>
																		<td style="width:100px;">Title:</td>
																		<td><input type="text" id="sFileTitle" name="sFileTitle" style="width:300px;" /></td>
																	</tr>
																	<tr>
																		<td style="padding-top:5px;">File to Upload:</td>
																		<td style="padding-top:5px;"><input type="file" id="file1" name="file1" /></td>
																	</tr>
																	<tr>
																		<td style="padding-top:5px;">Description:</td>
																		<td style="padding-top:5px;"><textarea id="file1_description" name="file1_description" style="width:300px; height:100px;"></textarea></td>
																	</tr>
																	
																	<tr>
																		<td style=" padding-bottom:10px; padding-top: 13px;">Grade:</td>
																		<td style=" padding-top:10px;"><select id="sAgeGroup" name="sAgeGroup">
																			<option value="">All Grades</option>
																			<option value="12">12th Grade</option>
																			<option value="11">11th Grade</option>
																			<option value="10">10th Grade</option>
																		</select>
																		</td>
																	</tr>
																	<tr>
																<td style="padding-top:10px;">Difficulty:</td>
																<td style="padding-top:10px;"><select id="Difficulty" name="Difficulty">
																	<option value="easy">Easy</option>
																	<option value="average">Average</option>
																	<option value="difficult">Difficult</option>
																	
																</select>
																</td>
															</tr>
																	<tr>
																		<td style="width:100px;">Tags:<br /><small>Primary Objective</small></td>
																		<td style="padding-top:5px;"><input type="text" id="pFileTags" name="pFileTags" style="width:300px;" /></td>
																	</tr>
																	<tr>
																		<td style="width:100px;">Tags:<br /><small>Secondary Objective</small></td>
																		<td style="padding-top:5px;"><input type="text" id="sFileTags" name="sFileTags" style="width:300px;" /></td>
																	</tr>
																	
																	<tr>
																		<td colspan="2" style="text-align:right; padding-top:12px;">
																			<input type="image" id="btnSuggest" name="btnSuggest" value="Upload" src="<?php echo THEME_IMGPATH; ?>btn_blue_uploadthisfile.gif" border="0" />&nbsp;&nbsp;
																			<img style="cursor:pointer" id="guides_btnSuggestCancel" name="guides_btnSuggestCancel" src="<?php echo THEME_IMGPATH; ?>btn_blue_cancel.gif" border="0" />
																		</td>
																	</tr>
																</table>
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
									<tr>
									  <td colspan="2">&nbsp;</td>
									</tr>
									<tr>
									  <td colspan="2" align="center">
									 	 <div class="borderratings"><div id="rating_TempContainer2" style="margin-top:15px; font-weight:bold;"></div></div>
									  </td>
									</tr>
								</table>
							</div>
						</div>					
					</div>
				</div>
			
