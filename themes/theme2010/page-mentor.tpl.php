<?php
$nodeids = '1743,1744,1745,1746';
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
													<h4><?=$nodearray['1743']['title']?></h4><br />
													<?=$nodearray['1743']['body']?>
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
											<h2><?=$nodearray['1744']['title']?></h2> 
											<img align="right" src="<?php echo $theme_imgpath; ?>gi_portal_guide.jpg" border="0" />
											<?=$nodearray['1744']['body']?>
									    	<br /><br /><a href="<?php echo base_path()?>instant/mentor/dashboard">Learn More</a>
										</td>
										<td width="11" class="dividerv"></td>
										<!--<td valign="top">
											<h2>Offline Volunteers Coordinator</h2>
											The goal of the HopeNet - Knowledge and Entertainment Portals is to become the world's best library of online content. The role of an Editor is to help us ensure the quality control of our portals. Editors help filter and verify the 
											<img align="right" src="<?php echo $theme_imgpath; ?>gi_portal_editor.jpg" border="0" />
											quality of the content that is being recommended by our Guides. The content that Editors validate includes websites, photos, videos, and online books/reports.
											<br /><br /><a href="/coordinator/administer">Learn More</a>
									    </td>-->
										<td valign="top">
											<h2><?=$nodearray['1745']['title']?></h2>
											<img align="right" src="<?php echo $theme_imgpath; ?>gi_portal_editor.jpg" border="0" />
											<?=$nodearray['1745']['body']?>
											<br /><br /><a href="<?php echo base_path()?>kindness/mentor">Learn More</a>
										</td>
										<td width="11" class="dividerv"></td>
										<td width="310" valign="top">
											<h2><?=$nodearray['1746']['title']?> <span class="notice_small">Coming Soon...</span></h2>
											<img align="right" src="<?php echo $theme_imgpath; ?>gi_portal_admin.jpg" border="0" />
											<?=$nodearray['1746']['body']?>
									    </td>
									</tr>
								</table>
							</div>
						</div>					
					</div>
				</div>
-