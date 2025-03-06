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
								      <td valign="top" align="left" class="gi_title">Choose to edit an existing subject/category or add a new subject/category. Then, click 'GO'.</td>
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
																<ul id="valuesadmin_VolunteerCatList"><li id="0"><span id="0" style="background-color:#f1f19b;color:#000;padding:3px;">Main Level</span></li></ul>
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
														<div class="jboxcontent" style="height:350px;color:#000">
															<form id="editors_query_form" name="editors_query_form" method="post" action="<?php echo base_path(); ?>values/getinvolved/<?php echo _tplvar('sLoggedType'); ?>/existing/cats">
																<input type="hidden" id="volunteer_iGroupId" name="iGroupId" value="8" />
																<input type="hidden" id="editors_cat_form_sGroupLevel" name="sGroupLevel" value="" />
																
																<div style="width:90%">
																	<br /><br />
																	<hr class="divider" />
																	<br/>
																	<table>
																		<tr>
																			<td style="padding:10px 10px 10px 0px;"><input type="radio" id="values_editors_cat_add" name="editors_cat_option" value="add" /></td>
																			<td style="padding:10px 0px 10px 0px;"><label for="values_editors_cat_add">Add a new subject/category</label></td>
																		</tr>
																		<tr>
																			<td style="padding:0px 10px 20px 0px;"><input type="radio" id="values_editors_cat_edit" name="editors_cat_option" value="edit" checked="checked" checked /></td>
																			<td  style="padding:0px 0px 20px 0px;">
																				<label for="values_editors_cat_edit">Edit an existing subject/category</label>
																				<br/><br/>
																				Selected Category : <span id="EselectedCategory" style="background-color:#f1f19b;color:#000;padding:3px;">Values</span>
																			</td>
																		</tr>
																	</table>
																	<br /><br /><br /><br />
																	<button type="button" id="editors_btnGo" class="btn_blue_go" style="width:150px;"></button>
																	<button type="button" id="editors_btnCancel" class="btn_blue_cancel" onclick="location='<?php echo base_path(); ?>values/getinvolved/<?php echo _tplvar('sLoggedType'); ?>'"></button>
																	<br /><br /><br /><hr class="divider" />
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
			
            	<div id="editors_add_form" style="display:none;">
					<div class="divider"></div>
                    <div id="cbtop">
                        <div class="cbb">
                            <div class="left-border">
                                <div class="right-border">
                    				<div class="jboxh" style="width:980px">
                                        <div class="jboxhead"><h2>Please input your info below and click the "Suggest this Subject/Category" button.</h2></div>
                                        <div class="jboxbody">
                                            <div class="jboxcontent">
                                                <form id="values_add" method="post" action="<?php echo base_path(); ?>values/getinvolved/<?php echo _tplvar('sLoggedType'); ?>/existing/cats/add/process" enctype="multipart/form-data" onsubmit="return ValidateForm();" style="margin:20px 0px 0px 70px;">
                                                    <input type="hidden" id="volunteer_iGroupId" name="iGroupLevel" value="8" />
                                                    <input type="hidden" name="sRedirectTo" value="<?php echo base_path(); ?>values/getinvolved/<?php echo _tplvar('sLoggedType'); ?>/existing/cats" />
                                                    <input type="hidden" name="sVolunteerType" value="<?php echo _tplvar('sLoggedType') ?>" />
                                                    <br/>
                                                    
                                                    <table style="color:#000">
                                                        <tr>
                                                            <td style="width:100px; padding-bottom:5px;">Title</td>
                                                            <td><input type="text" id="sSubjTitle" name="sSubjTitle" style="width:300px;" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding-bottom:12px;">Icon/Image</td>
                                                            <td><input type="file" id="sSubjIcon" name="sSubjIcon" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Description</td>
                                                            <td style="padding-bottom:5px;"><textarea id="sSubjDesc" name="sSubjDesc" style="width:300px; height:100px;"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Will have?</td>
                                                            <td>
                                                                <select id="sSubjLeaf" name="sSubjLeaf">
                                                                    <option value="0">Sub-Categories</option>
                                                                    <option value="1">Content Items</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="text-align:right; padding-top:12px;">
                                                                <button id="btnSuggestCancel" type="button" name="btnSuggestCancel" class="btn_blue_cancel_small"></button>
                                                                <button type="submit" id="btnSuggest" name="btnSuggest" class="btn_blue_submit_small"></button>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </form>                                           
                                             </div>
                                        </div>
                                        <div class="jboxfoot"><p></p></div>
                                    </div>
                    			</div>
                            </div>					
                        </div>
                    </div>		
				</div>
