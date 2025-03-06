<?php
$nodeids = '1758';
$nodearray = instant_getContent($nodeids);		
?>			
				<div id="cbrect">
					<div class="cbb">
						<div class="left-border">
							<div class="right-border">
								<table width="970" border="0" cellspacing="0" cellpadding="2">
								  <tr>
									<td width="200" align="center" valign="top">
										<img src="<?php echo THEME_IMGPATH; ?>gi_guide.jpg" border="0" />
									</td>
									<td valign="top">
										<h4><?=$nodearray['1758']['title']?></h4>
										<?=$nodearray['1758']['body']?>
										<?php echo _tplvar('sEnroll'); ?>
									</td>
								  </tr>
								</table>
							</div>
						</div>
					</div>
				</div>