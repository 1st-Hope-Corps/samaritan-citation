				<div class="divider"></div>
				<div id="step3_cbtop">
					<div class="cbb">
						<div class="left-border">
							<div class="right-border">
								<table width="980" border="0" cellpadding="0" cellspacing="0">
									<tr>
									  <td height="50" class="bgfix3" width="100"></td>
								      <td valign="top" align="left" class="gi_title">Please add below the Title, Tags, Description and the Rating of the Website</td>
								    </tr>
									<tr>
									  <td>&nbsp;</td>	
									  <td>
									  	The Values Portal is powered by the Internet which is the world's largest library of videso, documents, photos, books, etc. on Earth. The Internet stores over a Trillion pages of information on, virtually, any subject but surfing throiiugh all these pages to find the best video, report, or photo on a particular subject can be a very difficult task. Especially, if you are a child. As a Guide, you will be leadin the children to the best content on the Internet.<br /><br />
									  	<div class="jbox">
											<div class="jboxhead"><h2></h2></div>
											<div class="jboxbody">
												<div class="jboxcontent">
													<form action="<?php echo base_path(); ?>values/url/edit/add" method="post" onsubmit="return ValidateSiteForm();">
														<input type="hidden" id="volunteer_iGroupId" name="iGroupLevel" value="0" />
														<input type="hidden" id="guides_sSiteType" name="sSiteType" value="" />
														<input type="hidden" name="sRedirectTo" value="<?php echo base_path(); ?>values/getinvolved/guides?b=1" />
														<input type="hidden" name="rating_iRatingId" id="rating_iRatingId" value="0" />
														
														<table>
															<tr>
																<td style="width:100px; padding-bottom:10px;">URL:</td>
																<td><input type="text" id="sSiteURL" name="sSiteURL" value="http://" style="width:400px;" /></td>
															</tr>
															<tr>
																<td style="width:100px; padding-bottom:10px;">Age Group:</td>
																<td><select id="sAgeGroup" name="sAgeGroup">
																	<option value="">All Age</option>
																	<option value="7-9">7 to 9 Years Old</option>
																	<option value="10-12">10 to 12 Years Old</option>
																</select>
																</td>
															</tr>
															<tr>
																<td style="width:100px; padding-bottom:10px;">Tags:</td>
																<td style="padding-bottom:10px;">
																	<input type="text" id="sTags" name="sTags" value="" style="width:400px;" /><br/>
																	<small>Separate tags with a comma (eg. space,shuttle,service).</small>
																</td>
															</tr>
															<tr>
																<td style="padding-bottom:10px;">Title:</td>
																<td><input type="text" id="sSiteTitle" name="sSiteTitle" style="width:400px;" /></td>
															</tr>
															<tr>
																<td>Description:</td>
																<td><textarea id="sSiteDesc" name="sSiteDesc" style="width:400px; height:100px;"></textarea></td>
															</tr>
															<tr>
																<td style="padding-top:5px; font-weight:bold;">Rating:</td>
																<td style="padding-top:5px; font-weight:bold;"><div id="rating_TempContainer1"></div></td>
															</tr>
															<tr>
																<td colspan="2" style="text-align:right;">
																	<input type="image" id="guides_btnSuggest"  name="guides_btnSuggest" src="<?php echo THEME_IMGPATH; ?>btn_blue_suggestthissite.gif" border="0" />&nbsp;&nbsp;
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
							</div>
						</div>					
					</div>
				</div>
			
