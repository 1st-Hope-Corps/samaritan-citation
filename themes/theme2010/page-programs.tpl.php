				<div id="cbtop">
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
										<?php echo $content; ?>
									</div>
								</div>
							</div> 
						</div>
					</div>
				</div>
				
				<div class="divider"></div>
				
				<div id="cbtop">
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
										<?php
										$aNormalNav = array(1704, 1705, 1792, 1793);
										if (in_array(str_replace("node/","",$_GET["q"]),$aNormalNav)) {
											?>
											<table width="980" border="0" cellpadding="0" cellspacing="0" id="about_nav">
												<tr>
													<td width="236" align="center" valign="top" class="<?php echo (@$_GET["q"] == "node/1704" ? "active" : ""); ?>">
														<!--<a href="<?php echo $sCurrPage; ?>node/1704">
															<h4>HopeNet Overview</h4>
															<img src="<?php echo $theme_imgpath; ?>programs_nav_hopenet.png" border="0" />
														</a>-->
														<div onclick="location.href='<?php echo $sCurrPage; ?>programs/hope-overview'" style="cursor:pointer;"><h4>HopeNet Overview</h4> <img src="<?php echo $theme_imgpath; ?>programs_nav_hopenet.png" border="0" /></div>
													</td>
													<td width="11" class="dividerv"></td>
													<td width="236" align="center" valign="top" class="<?php echo (@$_GET["q"] == "node/1792" ? "active" : ""); ?>">
														<!--<a href="<?php echo $sCurrPage; ?>node/1704">
															<h4>HopeNet Overview</h4>
															<img src="<?php echo $theme_imgpath; ?>programs_nav_hopenet.png" border="0" />
														</a>-->
														<div onclick="location.href='<?php echo $sCurrPage; ?>programs/values-portal'" style="cursor:pointer;"><h4>Values Portal</h4> <img src="<?php echo $theme_imgpath; ?>programs_nav_values_portal.png" border="0" /></div>
													</td>
													<td width="11" class="dividerv"></td>
													<td width="237" align="center" valign="top" class="<?php echo (@$_GET["q"] == "node/1705" ? "active" : ""); ?>">
														<!--<a href="<?php echo $sCurrPage; ?>node/1705">
															<h4>Hope Cybrary</h4>
															<img src="<?php echo $theme_imgpath; ?>programs_nav_hopecybrary.png" border="0" />
														</a>-->
														<div onclick="location.href='<?php echo $sCurrPage; ?>programs/hope-cybrary'" style="cursor:pointer;"><h4>Hope Cybrary</h4> <img src="<?php echo $theme_imgpath; ?>programs_nav_hopecybrary.png" border="0" /></div>
													</td>
												</tr>
											</table>
											<?php
										} else {
											?>
											<ul id="mycarousel" class="jcarousel-skin-tango"> 
												<li>
													<h4>Knowledge Portal</h4>
													<a href="<?php echo base_path()?>programs/knowledge-portal"><img src="<?php echo $theme_imgpath; ?>programs_nav_knowledgeportal.png" /></a>
												</li>
												<li>
													<h4>Peace Building</h4>
													<a href="<?php echo base_path()?>programs/peace-building"><img src="<?php echo $theme_imgpath; ?>programs_nav_peacebuilding.png" /></a>
												</li>
												<li>
													<h4>eTutoring</h4>
													<a href="<?php echo base_path()?>programs/e-tutoring"><img src="<?php echo $theme_imgpath; ?>programs_nav_etutoring.png" /></a>
												</li>
												<li>
													<h4>Livelihood</h4>
													<a href="<?php echo base_path()?>programs/livelihood"><img src="<?php echo $theme_imgpath; ?>programs_nav_livelihood.png" /></a>
												</li>
												<li>
													<h4>My eBank</h4>
													<a href="<?php echo base_path()?>programs/my-ebank"><img src="<?php echo $theme_imgpath; ?>programs_nav_myebank.png" /></a>
												</li>
												<li>
													<h4>eMentoring</h4>
													<a href="<?php echo base_path()?>programs/e-mentoring"><img src="<?php echo $theme_imgpath; ?>programs_nav_ementoring.png" /></a>
												</li>
												<li>
													<h4>Entertainment Portal</h4>
													<a href="<?php echo base_path()?>programs/entertainment-portal"><img src="<?php echo $theme_imgpath; ?>programs_nav_entertainmentportal.png" /></a>
												</li>
											</ul>	
											<?php
										}
											?>
									</div> <!-- eof right border-->
								</div> <!-- eof left border-->
							</div> 
						</div>
					</div>
					<div class="bb">
							<div></div>
					</div>
				</div>

