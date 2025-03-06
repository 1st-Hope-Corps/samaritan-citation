<?php
$nodeids = '1723,1724';
$nodearray = instant_getContent($nodeids);
?>			

			<div id="cbrect">
					<div class="cb">
						<div class="bt">
							<div></div>
						</div>
					</div>
					<div class="i1">
						<div class="i2">
							<div class="i3">
								<div class="left-border">
									<div class="right-border">
										<table width="980" border="0" cellspacing="0" cellpadding="2">
										  <tr>
											<td width="240" align="center" valign="top">
												<img src="<?php echo $theme_imgpath; ?>gi-landing1_pigeon.png" border="0" />
											</td>
											<td valign="top" align="center">
												<h4><?=$nodearray['1723']['title']?></h4>
												<?=$nodearray['1723']['body']?>
											</td>
											<td width="240" align="center" valign="top">
												<img src="<?php echo $theme_imgpath; ?>gi-landing1_earth.jpg" border="0" />
											</td>
										  </tr>
										</table>
									</div>
								</div>
							</div> 
						</div>
					</div>
					<div class="bb">
						<div></div>
					</div>
				</div>
				
				<div style="margin:20px 0px 20px 0px" class="divider"></div>
				
				<div id="gi_landing">
					<div class="cb">
						<div class="bt">
							<div></div>
						</div>
						<div class="i1">
							<div class="i2">
								<div class="i3">
									<div class="left-border">
										<div class="right-border">
											<table width="980" border="0" cellpadding="0" cellspacing="0" id="gi_nav">
												<tr>
													<td width="283" valign="top" align="center">
														<div class="gi_landing_arrow">&nbsp;</div>
														<div><a href="<?php echo base_path()?>mystudies/getinvolved/volunteer"><img src="<?php echo $theme_imgpath; ?>gi-landing1_volunteer.jpg" border="0" /></a></div>
														<div class="gi_landing_arrow" style="text-align:right"><img src="<?php echo $theme_imgpath; ?>gi-landing1_arrowup.png" border="0" /></div>
													</td>
													<td width="11" class="dividerv"></td>
													<td valign="top" align="center" class="gi_landing_center_holder">
														<div class="gi_landing_center">
															<p>
																<?=html_entity_decode($nodearray['1724']['body'])?>
															</p>
														</div>
													</td>
													<td width="11" class="dividerv"></td>
													<td width="282" valign="top" align="center">
														<br />
														<div style="height:50px;text-align:left"><img src="<?php echo $theme_imgpath; ?>gi-landing1_arrowdown.png" border="0" /></div>
														<div>
															<a href="<?php echo base_path()?>mystudies/getinvolved/sponsor"><img src="<?php echo $theme_imgpath; ?>gi-landing1_sponsor.jpg" border="0" /></a>
															<span class="notice_small"><br />Coming Soon....</span>
														</div>
														
													</td>
												</tr>
											</table>
										</div>
									</div>	
								</div>	
							</div>
						</div>
						<div class="bb">
							<div></div>
						</div>
					</div>
				</div>
			