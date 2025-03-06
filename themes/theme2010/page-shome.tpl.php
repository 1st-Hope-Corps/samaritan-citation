				<?php
				$nodeids = '1717,1719,1720,1721,1722';
				$nodearray = instant_getContent($nodeids);
				?>
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
											<table width="970" border="0" cellpadding="0" cellspacing="0">
												<tr>
													<td>
														<div class="main_content">
															<div class="home_top">
																<table width="973" border="0" cellpadding="0" cellspacing="0">
																	<tr>
																		<td width="240" align="center" valign="top" style="padding:5px 5px 5px 0;">
																			<h2><?=$nodearray['1717']['title']?></h2>
																			<?=$nodearray['1717']['body']?>
																			<br /><br />
																			<a href="<?php echo $sCurrPage; ?>visit-our-cybrary"><img src="<?php echo $theme_imgpath; ?>home_take_a_tour.jpg" border="0" /></a>
																		</td>
																		<td width="1" class="dividerv"></td>
																		<td width="240" align="center" valign="top" style="padding:5px;">
																			<h2><?=$nodearray['1719']['title']?></h2>
																			<?=$nodearray['1719']['body']?>
																			<br /><br />
																			<a href="<?php echo $sCurrPage; ?>meet-the-hopefuls"><img src="<?php echo $theme_imgpath; ?>home_meet_our_children.jpg" border="0" /></a>
																		</td>
																		<td width="1" class="dividerv"></td>
																		<td width="240" align="center" valign="top" style="padding:5px;">
																			<h2><?=$nodearray['1720']['title']?></h2>
																			<?=$nodearray['1720']['body']?>
																			<br /><br />
																			<a href="<?php echo $sCurrPage; ?>about"><img src="<?php echo $theme_imgpath; ?>home_about_1st_hope.jpg" border="0" /></a>
																		</td>
																		<td width="1" class="dividerv"></td>
																		<td width="250" align="center" valign="top" style="padding:5px 0 5px 5px;">
																			<h2><?=$nodearray['1721']['title']?></h2>
																			<?=$nodearray['1721']['body']?>
																			<br /><br />
																			<a href="<?php echo $sCurrPage; ?>mystudies/getinvolved"><img src="<?php echo $theme_imgpath; ?>home_get_involved.jpg" border="0" /></a>
																		</td>
																	</tr>
																</table>
															</div>
														</div>
													</td>
												</tr>	
											</table>
										</div> <!-- eof right border-->
									</div> <!-- eof left border-->
								</div> 
							</div>
						</div>
						<div class="bb">
							<div></div>
						</div>
					</div>
				</div>
				<div class="divider"></div>
				<div id="cbbottom">
					<div class="cb">
						<div class="bt">
							<div></div>
						</div>
						<div class="i1">
							<div class="i2">
								<div class="i3">
									<div class="left-border">
										<div class="right-border">
											<table width="970" border="0" cellpadding="0" cellspacing="0">
												<tr>
													<td rowspan="3" width="275" align="center">
														<img src="<?php echo $theme_imgpath; ?>home_investor.jpg" border="0" /><br />
														You - Investor
													</td>
													<td width="420" align="left" height="49" class="bottom_fix">
														<img src="<?php echo $theme_imgpath; ?>home_arrow_up.png" border="0" />
													</td>
													<td rowspan="3" width="275" align="center">
														<img src="<?php echo $theme_imgpath; ?>home_hopeful.jpg" border="0" /><br />
														Hopeful - Child
													</td>
												</tr>
												<tr>
													<td class="hopenet_def" align="center">
														<?=$nodearray['1722']['body']?>
													</td>
												</tr>
												<tr>
													<td align="right" height="46"><img src="<?php echo $theme_imgpath; ?>home_arrow_down.png" border="0" /></td>
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