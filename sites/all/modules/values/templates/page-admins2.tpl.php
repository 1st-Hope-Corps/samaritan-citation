				<?php
					$aTypes = array('site', 'image', 'doc', 'animation', 'video');
					foreach ($aTypes as $sType) {
						$aTypes[$sType]["cnt"] = _values_editors_pending_items_title($sType,"admins",true);
						$aTypes[$sType]["class"] = ($aTypes[$sType]["cnt"] == 0 ?  "gi_gray" : "gi_blue");
					}
				
				?>
				
				<div class="divider"></div>
				<div id="cbtop">
					<div class="cbb">
						<div class="left-border">
							<div class="right-border">
								<div class="jbox" style="width:980px">
									<div class="jboxhead"><h2></h2></div>
									<div class="jboxbody">
										<div class="jboxcontent" style="text-align:center">
											<br /><br />
											<table width="900" border="0" cellpadding="0" cellspacing="0" id="gi_admin_lines_entertainment">
												<tr><td height="130">&nbsp;</td></tr>
												<tr>
												  <td valign="top" align="center">
													<div style="width:690px;">
														<div class="<?php echo $aTypes["site"]["class"]; ?>" style="float:left;cursor">
															<div><p><?php echo $aTypes["site"]["cnt"]; ?></p><p class="lbl"><a href="<?php echo base_path(); ?>values/getinvolved/admins/pending/sites">Websites</a></p></div>
														</div>
														<div class="<?php echo $aTypes["image"]["class"]; ?>" style="float:left;margin:0 70px 0 90px; text-align:center">
															<div><p><?php echo $aTypes["image"]["cnt"]; ?></p><p class="lbl"><a href="<?php echo base_path(); ?>values/getinvolved/admins/pending/photos">Photos</a></p></div>
														</div>														
														<div class="<?php echo $aTypes["doc"]["class"]; ?>" style="float:left">
															<div><p><?php echo $aTypes["doc"]["cnt"]; ?></p><p class="lbl"><a href="<?php echo base_path(); ?>values/getinvolved/admins/pending/books">Books</a></p></div>
														</div>
													</div>
												  </td>
											    </tr>
												<tr>
												  <td valign="top" align="center">
													<div style="width:430px;">
														<div class="<?php echo $aTypes["video"]["class"]; ?>" style="float:left;">
															<div><p><?php echo $aTypes["video"]["cnt"]; ?></p><p class="lbl"><a href="<?php echo base_path(); ?>values/getinvolved/admins/pending/videos">Videos</a></p></div>
														</div>
														<div class="<?php echo $aTypes["animation"]["class"]; ?>" style="float:left;margin-left:70px; text-align:center">
															<div><p><?php echo $aTypes["animation"]["cnt"]; ?></p><p class="lbl"><a href="<?php echo base_path(); ?>values/getinvolved/admins/pending/animations">Animations</a></p></div>
														</div>														
													</div>
												  </td>
											    </tr>
												<!--<tr>
												  <td valign="top" align="center">
													<div style="width:690px;">
														<div class="gi_empty" style="background:;float:left;cursor">
															<div>&nbsp;</div>
														</div>
														<div class="<?php echo $aTypes["content"]["class"]; ?>" style="float:left;margin:0 70px 0 90px; text-align:center">
															<div><p><?php echo $aTypes["content"]["cnt"]; ?></p><p class="lbl"><a href="<?php echo base_path(); ?>entertainment/getinvolved/admins/pending/contents">Contents</a></p></div>
														</div>														
														<div class="gi_empty" style="float:left">
															<div>&nbsp;</div>
														</div>
													</div>
												  </td>
											    </tr>-->
												<tr>
												  <td valign="top" align="center">
													<div style="width:430px;">
														<div class="gi_empty" style="background:;float:left;">
															<div>&nbsp;</div>
														</div>
														<div class="gi_empty" style="background:;float:left;margin-left:70px; text-align:center">
															<div>&nbsp;</div>
														</div>														
													</div>
												  </td>
											    </tr>
											</table>
										</div>
									</div>
									<div class="jboxfoot"><p></p></div>
								</div>
							</div>
						</div>					
					</div>
				</div>
			
