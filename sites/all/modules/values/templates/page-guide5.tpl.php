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
									  	The Values Portal is powered by the Internet which is the world's largest library of vides, documents, photos, books, etc. on Earth. The Internet stores over a Trillion pages of information on, virtually, any subject but surfing throiiugh all these pages to find the best video, report, or photo on a particular subject can be a very difficult task. Especially, if you are a child. As a Guide, you will be leading the children to the best content on the Internet.
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
												<div class="jboxh" align="center">
													<div class="jboxhead"><h2 id="guides_FileFormEmbed"></h2></div>
													<div class="jboxbody">
														<div class="jboxcontent">
															<form id="values_file_add_embed" method="post" action="<?php echo base_path(); ?>values/file/edit/add" enctype="multipart/form-data" onsubmit="return ValidateEmbed();">
																<input type="hidden" id="iUserId" name="iUserId" value="<?php echo _tplvar('iUserId'); ?>" />
																<input type="hidden" id="sFileTypeEmbed" name="sFileType" value="" />
																<input type="hidden" id="volunteer_iGroupId" name="iGroupLevel" value="0" />
																<input type="hidden" name="sRedirectTo" value="<?php echo base_path(); ?>values/getinvolved/guides?b=1" />
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
																		<td style="padding-top:5px;">Age Group:</td>
																		<td style="padding-top:5px;"><select id="sAgeGroup" name="sAgeGroup">
																			<option value="">All Age</option>
																			<option value="7-9">7 to 9 Years Old</option>
																			<option value="10-12">10 to 12 Years Old</option>
																		</select>
																		</td>
																	</tr>
																	
																	<tr>
																		<td style="padding-top:5px;">Tags:</td>
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
			
