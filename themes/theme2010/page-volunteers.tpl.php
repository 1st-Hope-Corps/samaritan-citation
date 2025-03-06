<script>
$('#login-select').hide();
</script>
<?php
/*echo '<pre>';
print_r($user);
echo '</pre>';*/


// Checks if the current user is logged in.

//echo $base_url;
if ($user->uid == 0){
	header("Location: ".$base_url."/user?destination=mystudies/getinvolved/volunteer");
}

$nodeids = '1725,1726,1727,1728,1729,1730,1731';
$nodearray = instant_getContent($nodeids);
//echo "test";
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
													<img src="<?php echo $theme_imgpath; ?>gi_volunteer_standout.jpg" border="0" />
												</td>
												<td valign="top">
													<br /><h4><?=$nodearray['1731']['title']?> <span style="color:#33CC00">Standout From the Crowd</span></h4><br />
													<?=$nodearray['1731']['body']?>
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
				
				<?php
				if ($user->status == 1){
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
												<table width="980" border="0" cellpadding="0" cellspacing="0" id="gi_volunteers">
													<tr>
														<td width="310" valign="top">
															<h4><?=$nodearray['1730']['title']?></h4>
															<img align="right" src="<?php echo $theme_imgpath; ?>gi_volunteer_portal.jpg" border="0" />
															<?=$nodearray['1730']['body']?>
															<br /><br /><div onclick="location.href='<?php echo $sCurrPage; ?>mystudies/getinvolved/knowledge-portal-volunteers'"><span style="color:#5b719b;text-decoration:underline;cursor:pointer;">Learn More</span></div>
														</td>
														<td width="11" class="dividerv"></td>
														<td valign="top">
															<h4><?=$nodearray['1729']['title']?></h4>
															<img align="right" src="<?php echo $theme_imgpath; ?>gi_volunteer_etutoring.jpg" border="0" />
															<?=$nodearray['1729']['body']?>
															<br /><br /><div onclick="location.href='<?php echo $sCurrPage; ?>mystudies/getinvolved/etutoring-volunteers'"><span style="color:#5b719b;text-decoration:underline;cursor:pointer;">Learn More</span></div>
														</td>
														<td width="11" class="dividerv"></td>
														<td width="310" valign="top">
															<h4><?=$nodearray['1728']['title']?></h4>
															<img align="right" src="<?php echo $theme_imgpath; ?>gi_volunteer_ementoring.jpg" border="0" />
															<?=$nodearray['1728']['body']?>
															<br /><br /><div onclick="location.href='<?php echo $sCurrPage; ?>mystudies/getinvolved/ementoring-volunteers'"><span style="color:#5b719b;text-decoration:underline;cursor:pointer;">Learn More</span></div>
														</td>
													</tr>
													<tr><td colspan="5" height="30">&nbsp;</td></tr>
													<tr>
														
														<td width="310" valign="top">
															<h4><?=$nodearray['1727']['title']?></h4>
															<img align="right" src="<?php echo $theme_imgpath; ?>gi_volunteer_hopeteam.jpg" border="0" />
															<?=$nodearray['1727']['body']?>
															<br /><br /><div onclick="location.href='<?php echo $sCurrPage; ?>mystudies/getinvolved/cybrarian-hopeteam-volunteers'"><span style="color:#5b719b;text-decoration:underline;cursor:pointer;">Learn More</span></div>
														</td>
														<td width="11" class="dividerv"></td>
														<td width="310" valign="top">
															<h4><?=$nodearray['1726']['title']?></h4>
															<img align="right" src="<?php echo $theme_imgpath; ?>gi_volunteer_monitor.jpg" border="0" />
															<?=$nodearray['1726']['body']?>
															<br /><br /><div onclick="location.href='<?php echo $sCurrPage; ?>mystudies/getinvolved/esupport-volunteers'"><span style="color:#5b719b;text-decoration:underline;cursor:pointer;">Learn More</span></div>
														</td>
														<td width="11" class="dividerv"></td>
														<td valign="top">
															<h4><?=$nodearray['1725']['title']?> <span class="notice_small">Coming Soon...</span></h4>
															<img align="right" src="<?php echo $theme_imgpath; ?>gi_volunteer_advocate.jpg" border="0" />
															<?=$nodearray['1725']['body']?>
															<br /><br />
														</td>
													</tr>
													<tr><td colspan="5" height="30">&nbsp;</td></tr>
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
					<?php
				}else{
					?>
					<div>
						<b style='margin:2px 0 0 10px; text-align:center; color:black;'>Your account has not been approved by the administrator, yet. Please wait for the approval.</b>
					</div>
					<?php
				}
				?>