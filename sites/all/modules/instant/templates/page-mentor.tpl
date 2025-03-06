<?php
$sBasePath = base_path();
?>

				<script type="text/javascript" src="<?php echo $sBasePath ?>sites/all/modules/instant/instant.js"></script>
				<div id="hc_HopefulProfileContainer" style="display:none;">
					<div id="hc_HopefulProfileContainerClose" style="text-align:right; cursor:pointer; font-family:verdana; padding:5px 5px 5px 0; color:maroon; font-weight:bold; background-color:#F8F8F8;">[close this]</div>
					<iframe id="hc_HopefulProfile" src="" width="838" height="471" border="0"></iframe>
				</div>
				<div id="cbrect">
					<div class="cbb">
						<div class="left-border">
							<div class="right-border">
								<table width="970" border="0" cellspacing="0" cellpadding="2">
								  <tr>
									<td valign="top">
										<div style = "width:46%; float:right;">
										<h1 style="color:#2b29fc;font-size:34px; ">Become a vMentor Today!</h1>
										
										<h4 style="color:#9192fc; font-size:12px; margin-top:6px;">vMentoring Is A Powerful Way To Help A Student Help Themselves.</h4>
										<br/>
										</div>
										<div style = "width:450px">
											<img style = "margin-left:36px; float:left;" src="<?php echo $sBasePath ?>themes/theme2010/images/top-indication-pane.png" border="0" />
										</div>
										
									</td>
								  </tr>
								  <!-- start  -->
								  <tr>
										<td style="padding-right:5px;">		
											<div class="jboxcontent">
												<table width="100%" border="0" cellspacing="0" cellpadding="0" class="meet_info">
													<tr>
														<td valign="top">
															<div style = "float:left; width:100px; position:relative; z-index:1;margin-top:85px;">
																<img src="<?php echo $sBasePath ?>themes/theme2010/images/step1.png" border="0" />
															</div>
															<div id="instant-hopefuls-picklist" style="float:left;padding-left:25px;width:400px; margin-top:50px;">
																<table width="100%" border="0" cellspacing="0" cellpadding="2" class="meet_users">
																  <tr>
																	<td align="center">
																		
																		<div id="incybrary_hopeful_list"></div>
																	</td>
																  </tr>
																 
																</table>
																
																<div id="incybrary_hopeful_nav"></div>
															</div>
														</td>
														<td>
															<div style = "width:100%;"><img src="<?php echo $sBasePath ?>themes/theme2010/images/step2.png" border="0" /></div>
															<div style = "float:left; width:100px;">
																<img id="incybrary_avatar" alt="avatar" src="<?php echo $sBasePath ?>sites/default/files/pictures/none.png" border="0" style="cursor:pointer" />
															</div>
															<div id="incybrary_hopeful_details" style="float:left;width:230px;"></div>
															<div style = "width:100%;"><img style = "margin-left:100px; margin-top:5px;" src="<?php echo $sBasePath ?>themes/theme2010/images/step3.png" border="0" /></div>
														</td>
													</tr>
													<tr>
														<td colspan="2"><hr style="padding-top:20px; width:100%" class="divider" /></td>
													</tr>
												</table>  
											</div>
										</td>
									</tr>
										<!-- eof end -->
								</table>
							</div>
						</div>
					</div>
				</div>
				
				<div class="divider"></div>

				<?php echo instant_about_box(); ?>
