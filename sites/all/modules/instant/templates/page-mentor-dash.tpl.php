<?php
$sBasePath = base_path();
if (isset($_GET['msg'])){
	?>
	<script type="text/javascript">
	$(document).ready(
		function(){
			$('#dialog_InstantMentor')
				.html('<?php echo base64_decode($_GET['msg']) ?>')
				.dialog(
					{
						modal: true,
						resizable: false,
						autoOpen: true,
						width: 400,
						buttons: {
							'Okay': function(){
								$(this).dialog('close');
							}
						}
					}
				);
		}
	);
	
	</script>
	<?php
}
session_start();
?>
<style>
.add_hover{
	background: url(/misc/tooltip_arrow.png) no-repeat scroll 0 0 transparent;
	background-size:100%;
   /* border-radius: 17px 17px 17px 19px;
    box-shadow: 2px 2px 2px #666666;*/
    height: 95px;
    left: -230px;
    padding-left: 18px;
    position: absolute;
    top: -54px;
    width: 210px;
	display:block;
}
</style>

			<div id="dialog_InstantMentor" title="Kindness Workz Comment Notice" style="display:none;"></div>
			
			<div id="hc_HopefulProfileContainer" style="display:none; padding:0;">
				<!--div id="hc_HopefulProfileContainerClose" style="text-align:right; cursor:pointer; font-family:verdana; padding:5px 5px 5px 0; color:maroon; font-weight:bold; background-color:#F8F8F8;">[close this]</div>
				<iframe id="hc_HopefulProfile" src="" width="838" height="471" border="0"></iframe-->
			</div>
                        
			<div class="divider"></div>
				<div id="mentor2_cbtop">
					<div class="cbb">
						<div class="left-border">
							<div class="right-border">
								<table width="980" border="0" cellpadding="0" cellspacing="0" id="gi_nav">
									<tr><td height="25" class="bgfix">
										<div style="float:right;color:#0d05f3;margin-right: 70px;">
											<h1 style="color:#0d05f3;font-size: 30px;">Become a vMentor Today!</h1>
											<p>vMentoring Is A Powerful way to help a Student help Themselves</p>
										</div>
										<div style="clear:both"></div>
									</td></tr>
									<tr>
									  <td valign="top" align="left">
									  	<div id="gi_internal" style="width:960px">
											<div class="cbb" style="text-align:center">
												<table style="margin-top:10px;" width="100%" border="0" cellpadding="0" cellspacing="0">
													<tr>
														<td width="570" align="left">
															<div class="jbox">
																<div class="jboxhead"><h2></h2></div>
																<div class="jboxbody">
																	<div class="jboxcontent" style="text-align:left">
																		<h1 style="color:#0d05f3;">My vMentoring Students</h1>
																		<div>&nbsp;</div>
																		
																		<form>
																		<div class="div-list clearfix" style="clear:both; min-height: 225px;">
																			<?php
																			
																			$sqlQuery = db_query("select * from instant_ementor_assignment where ementor_id = %d", _tplvar("iUserId"));
																			$sqlCount = db_result(db_query("select count(id) as count from instant_ementor_assignment where ementor_id = %d", _tplvar("iUserId")));
																			
																			$count = 0;
																			while($usQuery = db_fetch_object($sqlQuery)){
																				$iUserID = $usQuery->hopeful_id;
																				$dateadded = $usQuery->date_added;
																				$aPathpluspicture = 'sites/default/files/pictures/none.png'; 
																				$sAuth = "SELECT u.uid, u.name, u.mail, IF(u.picture = '','{$aPathpluspicture}',u.picture) as picture FROM users u WHERE u.uid = '".$iUserID."'";
																				$oAuthUsers = db_query($sAuth);
																				$sAuthUsers = db_fetch_object($oAuthUsers);
																				
																				echo '<div class="hopeful clearfix" style = "float:left; width:115px;">
																							<center><img onclick="activate_view('."'".$iUserID."'".','."'".$sAuthUsers->name."'".')" src="'.$sBasePath.$sAuthUsers->picture.'" border="0" style="cursor:pointer;height:76px;min-width:85px;" /></center>
																							<center>'.ucfirst($sAuthUsers->name).'</center>
																							<center><span style="color:#f9b164;">Has <span id="usermentor_'.$iUserID.'">'._instant_mentor_count($iUserID).'</span> eMentors</span></center>
																							<center><span style="color:#f9b164;"><span id="usermentor_'.$iUserID.'">'._instant_hopeful_comment($iUserID).'</span> Comments</span></center>
																							<center><span style="color:#f9b164;"><span id="usermentor_'.$iUserID.'">'._instant_get_lastest_comment_date($iUserID).'</span></center>
																							<center><input type="checkbox" onclick="removeHopefulDashboard();" id="removeHopeful" name="removeHopeful[]" value="'."'".$iUserID."'".'"/> Remove</center>
																							</div>';
																			$count++;
																			}
																			
																			if($count == 0){
																				
																				echo "<span style='font-size: 17px;'>You haven't yet chosen any Student to vMentor.</span>";
																			}
																			else if (isset($_SESSION['add_new'])) {
																					unset($_SESSION['add_new']);
																					echo '<div style="margin-top: -10px; margin-left:10px; margin-bottom:8px; width:290px; height:298px; float:right; background:url('.$sBasePath.'themes/theme2010/images/thankyou_box.png) no-repeat; background-size:100%;">
																					</div>';
																				} else {
																					
																					echo '<div class="clear" style="margin-top: 10px;"><img src="'.$sBasePath.'themes/theme2010/images/begin_vmentoring_balloon.png" /></div>';
																				}
																				?>
																			
																		</div>
																		</form>

																		<div style="clear:both;width:87%;" align="right">
																		<?php
																		
																		if($sqlCount < 5){
																		echo '<div style="display:none;" align="right">';
																		}
																		
																		echo '<a href="#" class="eprev">Prev</a>&nbsp;&nbsp;
																					 <a href="#" class="enext">Next</a>';
																					 
																		if($sqlCount < 5){
																		echo '</div>';
																		}
																		?>
																		</div>
																	</div>
																</div>
																<div class="jboxfoot"><p></p></div>
																<table style="margin:13px 0 13px; width:100%;">
																	<tr>
																		<td style="padding:0;">
																		<div style = "background:url('<?php echo $sBasePath; ?>themes/theme2010/images/toolkit_bg.png'); width:279px; height:66px;">
																			<div class="jbox" style="width:277px;">
																				<div class="jboxhead" style = "background:none !important;"><h2 style = "background:none !important;"></h2></div>
																				<div class="jboxbody" style = "background:none !important;">
																					<div class="jboxcontent" style="text-align:center;padding:0; background:none !important;">
																						<img style="float:left" src="<?php echo $sBasePath; ?>themes/theme2010/images/toolkit_icon.png"/>
																						<p style="float:left;float: left;padding-top: 14px;width: 70%;">vMentoring Toolkit</p>
																						<div style="clear:both"></div>
																					</div>
																				</div>
																				<div class="jboxfoot" style = "background:none !important;"><p style = "background:none !important;"></p></div>
																			</div>
																			</div>
																			<div class="jbox" style="margin-top:3px;width:147px; height:60px;">
																				<div class="jboxhead"><h2></h2></div>
																				<div class="jboxbody">
																					<div class="jboxcontent" style=" padding: 2px 0 2px 7px;">
																						<p style="font-size: 11px;">Hope Bucks Balance: <span style=" color: red;">35</span></p>
																					</div>
																				</div>
																				<div class="jboxfoot"><p></p></div>
																			</div>
																		</td>
																		<td>&nbsp;</td>
																		<td style="padding:0;">
																		<div class = "active_deactive_section" style = "background:url('<?php echo $sBasePath; ?>themes/theme2010/images/active_deactivate_bg.png'); width:199px; height:113px;">
																			<div id="ementor_btnVolunteerDeactivate" class="jbox" style="width:100%; height:60px;cursor:pointer;">
																			<div class="jboxhead" style = "background:none !important;"><h2 style = "background:none !important;"></h2></div>
																			<div class="jboxbody" style = "background:none !important;">
																				<div class="jboxcontent" style="text-align:center; background:none !important;"><img style = "float:left;" src = "<?php echo $sBasePath; ?>themes/theme2010/images/active_icon.png">
																						Your account is: <div style="color:green; font-weight:bold;">Active</div>
																						<div id="ementor_btnVolunteerDeactivate" class="jbox" style="width:100%; cursor:pointer;margin-top: 18px;">
																							<img style = "float:left;" src = "<?php echo $sBasePath; ?>themes/theme2010/images/deactivate_icon.png">
																							<div align="center">
																								Click to <div style="color:red; font-weight:bold;">Deactivate Account</div>
																							</div>

																				
																							<div id="deactivate_Dialog" title="Deactivate Account" style="display:none;" align="center">
																								<span style="color:black; font-weight:bold;">Click to Deactivate Account</span>
																							</div>
																						</div>
																					</div>
																			</div>
																			<div class="jboxfoot" style = "background:none !important;"><p style = "background:none !important;"></p></div>
																			</div>
																			
																			<div id="deactivate_Dialog" title="Deactivate Account" style="display:none;" align="center">
																				<span style="color:black; font-weight:bold;">Click to Deactivate Account</span>
																			</div>
																		</div>
																		</td>
																	</tr>
																</table>
															</div>
														</td>
														<td width="1" class="dividerv"></td>
														<td align="right">
															<div class="jbox">
																<div class="jboxhead"><h2></h2></div>
																<div class="jboxbody">
																	<div class="jboxcontent" style="text-align:center">
																		<div class="<?php echo (_tplvar('iNoMentorHopefuls') > 0) ? 'gi_green':'gi_pink' ?>" align="center">
																			<div><p><?php echo _tplvar('iNoMentorHopefuls'); ?></p><span style="font-size:11px;">Students with no vMentor</span></div>
																		</div>
																		<div style="margin:5px 0" class="jbox">
																			<div class="jboxhead"><h2></h2></div>
																				<div class="jboxbody">
																					<div class="jboxcontent">
																					  <div style="clear:both;">
																						<div class="add_button" style="float:left;width:20%;position:relative">
																							<img src="<?php echo $sBasePath ?>themes/theme2010/images/btn_blue_add.png" style="cursor:pointer;" onclick="location.href='<?php echo $sBasePath ?>instant/mentor/browse';"/> 
																							<?php if($count == 0){ ?>
																							<div class="add_hover">
																								
																							</div>
																							<?php } ?>
																						</div>
																						<div style="float:left;width:20%;">
																							<img src="<?php echo $sBasePath ?>themes/theme2010/images/btn_blue_small_delete.png" style="cursor:pointer;" onclick="removeHopefulDashboard();"/>
																						</div>
																						<div style="float:left;width:60%;">	
																							Click if you wish to add or delete a Student
																						</div>
																					</div>
																					<div style="clear:both;">&nbsp;</div>
																				</div>
																			</div>
																			<div class="jboxfoot"><p></p></div>
																		</div>
																		<div class="<?php echo (_tplvar('iMentoringHopefuls') > 0) ? 'gi_green':'gi_pink' ?>" align="center">
																			<div><p><?php echo _tplvar('iMentoringHopefuls'); ?></p><span style="font-size:11px;">Students you are vMentoring</span></div>
																		</div>
																		
																		<div class="<?php echo (_tplvar('iMentoringTotalComments') > 0) ? 'gi_green':'gi_pink' ?>" align="center">
																			<div><p><?php echo _tplvar('iMentoringTotalComments'); ?></p><span style="font-size:11px;">Total eMentoring Comments</span></div>
																		</div>
																		
																		<div class="<?php echo (_tplvar('iCommentsApproved') > 0) ? 'gi_green':'gi_pink' ?>" align="center">
																			<div><p><?php echo _tplvar('iCommentsApproved'); ?></p><span style="font-size:11px;">Comments edited or disapproved</span></div>
																		</div>
																		
																		<div class="<?php echo (_tplvar('iCommentsWaiting') > 0) ? 'gi_green':'gi_pink' ?>" align="center">
																			<div><p><?php echo _tplvar('iCommentsWaiting'); ?></p><span style="font-size:11px;">Students waiting for comments</span></div>
																		</div>
																		<div style="margin-top:46px;" class="jbox">
																			<div class="jboxhead"><h2></h2></div>
																				<div class="jboxbody">
																					<div class="jboxcontent">
																						<a href="/community/members?css=kickapps_theme2010" target="_blank">Click to view vMentoring Community</a>
																						<!--The Community of all Mentor Volunteers is deprecated and has been disabled.-->
																					</div>
																				</div>
																			<div class="jboxfoot"><p></p></div>
																		</div>
																																				
																	</div>
																</div>
																<div class="jboxfoot"><p></p></div>
															</div>
														</td>
													</tr>
												</table>
											</div>		
										</div>	
									  </td>
								  </tr>
								</table>
							</div>
						</div>					
					</div>
				</div>
				<div class="divider"></div>
				
				<?php echo instant_about_box(); ?>
			
