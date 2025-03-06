<?php
$nodeids = '1757,1756,1755,1754';
$nodearray = instant_getContent($nodeids);		
?>	
				<div class="divider"></div>
				<div id="main_mentor_cbtop">
                	<div class="cbb">
						<div class="left-border">
							<div class="right-border">
								<table width="980" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td valign="top" align="left">
											<table width="980" border="0" cellspacing="0" cellpadding="2">
											  <tr>
												<td width="310" align="center" valign="top">
													<img class="border_img" src="<?php echo $theme_imgpath; ?>gi_portal.jpg" border="0" />
												</td>
												<td valign="top">
													<h4><?=$nodearray['1757']['title']?></h4><br />
													<?=$nodearray['1757']['body']?>
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
				
				<div class="divider"></div>
				<div id="cbtop">
					<div class="cbb">
						<div class="left-border">
							<div class="right-border">
								<table width="980" border="0" cellpadding="0" cellspacing="0" id="gi_nav">
									<tr>
										<td width="310" valign="top">
											<h2><!--<span style="text-transform:lowercase;">e</span>Administrators--><?=$nodearray['1756']['title']?></h2>
											<img align="right" src="<?php echo $theme_imgpath; ?>gi_portal_guide.jpg" border="0" />
											<?=$nodearray['1756']['body']?>
									    	<br /><br /><a href="<?php echo base_path()?>coordinator/administer">Learn More</a>
										</td>
										<td width="11" class="dividerv"></td>
										<td valign="top">
											<h2><?=$nodearray['1755']['title']?> <span class="notice_small">Coming Soon...</span></h2>
											<img align="right" src="<?php echo $theme_imgpath; ?>gi_portal_editor.jpg" border="0" />
											<?=$nodearray['1755']['body']?>
										</td>
										<td width="11" class="dividerv"></td>
										<td width="310" valign="top">
											<h2><?=$nodearray['1754']['title']?> <span class="notice_small">Coming Soon...</span></h2>
											<img align="right" src="<?php echo $theme_imgpath; ?>gi_portal_admin.jpg" border="0" />
											<?=$nodearray['1754']['body']?>
									    </td>
									</tr>
								</table>
							</div>
						</div>					
					</div>
				</div>
-