<?php
$nodeids = '1730,1733,1734,1735';
$nodearray = instant_getContent($nodeids);		
?>
			<div id="cbrect">
					<div class="cb">
						<div class="bt">
							<div></div>
						</div>
						<div class="i1">
							<div class="i2">
								<div class="i3">
									<div class="left-border">
										<div class="right-border">
											<table width="980" border="0" cellspacing="0" cellpadding="2">
											  <tr>
												<td width="310" align="center" valign="top">
													<img class="border_img" src="<?php echo $theme_imgpath; ?>gi_portal.jpg" border="0" />
												</td>
												<td valign="top">
													<h4><?=$nodearray['1730']['title']?></h4><br />
													<?=$nodearray['1730']['body']?>
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
				
				<div class="divider"></div>
				<div id="cbtop">
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
													<td width="310" valign="top">
														<h2><?=$nodearray['1733']['title']?></h2>
														<img align="right" src="<?php echo $theme_imgpath; ?>gi_portal_guide.jpg" border="0" />
														<?=$nodearray['1733']['body']?>
														<br /><br /><a href="<?php echo base_path()?>mystudies/getinvolved/guides">Learn More</a>
													</td>
													<td width="11" class="dividerv"></td>
													<td valign="top">
														<h2><?=$nodearray['1734']['title']?></h2>
														<img align="right" src="<?php echo $theme_imgpath; ?>gi_portal_editor.jpg" border="0" />
														<?=$nodearray['1734']['body']?>
														<br /><br /><a href="<?php echo base_path()?>mystudies/getinvolved/editors">Learn More</a>	
													</td>
													<td width="11" class="dividerv"></td>
													<td width="310" valign="top">
														<h2><?=$nodearray['1735']['title']?></h2>
														<img align="right" src="<?php echo $theme_imgpath; ?>gi_portal_admin.jpg" border="0" />
														<?=$nodearray['1735']['body']?>
														<br /><br /><a href="<?php echo base_path()?>mystudies/getinvolved/admins">Learn More</a>
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
-