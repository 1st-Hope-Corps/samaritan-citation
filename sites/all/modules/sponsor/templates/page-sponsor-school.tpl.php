<script type="text/javascript">
$(document).ready(
	function(){		
	var sPrePic = 'picture_';
	var sTeamPrePic = 'teampicture_';
	$("img[id^="+sPrePic+"]").each(
			function(){
				alert("This feature is deprecated and has been disabled.");
				
				/*var iUserId = this.id.replace(sPrePic, "");
				var sUser = $("#name_"+iUserId).text();
				
				$(this).click(
					function(){
						$("#profile_Dialog_loader").html('<img src="/misc/button-loader-big.gif" /><span>');
						$("#hc_HopefulProfile1").attr("src", "");
						$.post(
							"/teamchildren/profile",
							{
								uid: iUserId,
								user: sUser
							},
							function(oReply){
								if (oReply.STATUS == 1){
									$("#profile_Dialog").dialog({
													modal: true,
													autoOpen: true,
													resizable: false,
													width: 960,
													height: 650,
													buttons: {
														"Close": function(){
														$(this).dialog("close");
														}
													}
									});	
									var strurl = window.location.href;
									var cssLink = '&css=kickapps_theme2010';
									var varLocation = '&location=community';
									//if(strurl.search("kickapps_theme2010") == -1){
									//cssLink = '';
									//varLocation = '&location=hud';
									//}
									$("#hc_HopefulProfile1").attr("src", "http://affiliate.kickapps.com/service/displayKickPlace.kickAction?as=158175&u="+oReply.RETURN+varLocation+"&view=onlyprofile&"+cssLink);
									$("#profile_Dialog_loader").html('');
								}
							},
							"json"
						);
					}
				)*/
			}
		);
	  $("div[id^="+sTeamPrePic+"]").each(
			function(){
				var iteamId = this.id.replace(sTeamPrePic, "");
				
				$(this).click(
					function(){
						$("#profile_Dialog_loader").html('<img src="/misc/button-loader-big.gif" /><span>');
						$("#hc_HopefulProfile2").attr("src", "");
						$.post(
							"/sponsor/getteamurl",
							{
								teamid : iteamId
							},
							function(oReply){
								if (oReply.STATUS == 1){
									$("#teamprofile_Dialog").dialog({
													modal: true,
													autoOpen: true,
													resizable: false,
													width: 960,
													height: 650,
													buttons: {
														"Close": function(){
														$(this).dialog("close");
														}
													}
									});	
									$("#hc_HopefulProfile2").attr("src", "http://www.hopecybrary.org/adopt-team/"+oReply.RETURN+"?view=profile");
									$("#profile_Dialog_loader").html('');
								}
							},
							"json"
						);
					}
				)
			}
		);
	}
);
</script>
<style>
#bar{
background-color:#11f700;
width:0px;
height:16px;
}
#barbox{
height:16px;
background-color:#c0c0c0;
width:235px;
border:solid 2px #c0c0c0;
margin-right:3px;
-webkit-border-radius:5px;-moz-border-radius:5px;
}
</style>
<div id="cbrect">
					<div class="cbb">
						<div class="left-border">
							<div class="right-border">
								<table width="970" border="0" cellspacing="0" cellpadding="2">
								  <tr>
									<td width="200" align="center" valign="top">
										<img src="/themes/theme2010/images/hope_cybrary_logo.jpg" />
									</td>
									<td valign="top" style="padding-left:12px;">
										<h4 style="color:#20f42d;font-size:24px;">Invest in a Hope Cybrary School</h4><h4 style="color:#ff0000;font-size:20px;">Under Construction</h4>
										<h1>As a sponsor you can adopt an entire Hope Cybrary or invest in a single HopeNet program</h1>
									</td>
								  </tr>
								</table>
							</div>
						</div>
					</div>
				</div>
				
				<div class="divider"></div>
				<div id="select_dash">
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
												<div style="background:url(/themes/theme2010/images/bg-sponsors.png);height:410px;width:975px;">
													<div style="padding-left:40px;padding-top:20px;">
														<div style="float:left;"><span style="color:black;font-size:14px;"><b>Maximo Estrella Elementary School</b></span><br/><img src="/themes/theme2010/images/fred-cybrary.jpg" /></div>
														<div style="float:left;padding-left:">
															<div style="padding-left:12px;padding-top:10px;color:black;">
																<div style="padding-left:100px;">
																<b style="color:#0000ff;">Funding Details</b><br/>
																  <div id="funding_details">46 Sponsors - $20,000 Raised & Pledged <a href="javascript:void(0);" id="funding_details_more">More</a></div>
																  <div id="funding_details_expand" style="display:none;">	
																	<div style="border-bottom:black 1px solid;width:230px;">
																	46 Sponsors - $20,000 Raised<br/>
																	28 Sponsors - $8,000 Pledged<br/>
																	</div>
																	46 Sponsors - $20,000 Raised & Pledged <a href="javascript:void(0);" id="funding_details_less">Less</a>
																  </div>
																<div>&nbsp;</div>
																
																<h2>40% Funded - $18,000 to go</h2>
																<div id="barbox" align="left"><div id="bar" align="left" style="width:110px;"></div></div>
																</div>
																<div style="border-bottom:#857efc 1px solid">&nbsp;</div>
																<div>&nbsp;</div>
																<div style="width:400px;">
																	<div style="float:left;width:68%;">
																	Select Amount<br/>
																	<select id="amount_select">
																	<option value="25">$25</option>
																	<option value="50">$50</option>
																	<option value="100">$100</option>
																	<option value="150">$150</option>
																	<option value="200">$200</option>
																	<option value="250">$250</option>
																	<option value="300">$300</option>
																	<option value="350">$350</option>
																	<option value="400">$400</option>
																	<option value="450">$450</option>
																	<option value="500">$500</option>
																	<option value="550">$550</option>
																	<option value="600">$600</option>
																	<option value="650">$650</option>
																	<option value="700">$700</option>
																	<option value="750">$750</option>
																	<option value="800">$800</option>
																	<option value="850">$850</option>
																	<option value="900">$900</option>
																	<option value="950">$950</option>
																	<option value="1000">$1000</option>
																	</select>
																	<input type="hidden" name="amount_selected" id="amount_selected" value="25"/>
																	<div>&nbsp;</div>
																		<div>
																			<div style="width:55%;float:left;">
																			<a href="javascript:void(0);" style="color:blue;" id="fund_status">Fund and Pledge Status:</a><br/>
																			<a href="javascript:void(0);" style="color:blue;" id="listed_funding">Listed for Funding:</a>
																			</div>
																			<div style="width:40%;float:right;">
																			Partially Funded<br/>
																			5 Nov 2011
																			</div>
																		</div>
																	</div>
																	<div style="float:left;width:30%;">
																		<div style="background:url(/themes/theme2010/images/button-fund.png);width:119px;height:46px;cursor:pointer;" id="fund_select">
																			<span style="padding:12px;color:white;cursor:pointer;"><center><b>Fund <label id="fund_label" style="cursor:pointer;">$25</label></b></center></span>
																		</div>
																	<br/>If you don't have funds available now then you may make a pledge.<br/><br/>
																		<div style="background:url(/themes/theme2010/images/button-pledge.png);width:119px;height:46px;cursor:pointer;" id="pledge_select">
																			<span style="padding:12px;color:white;cursor:pointer;"><center><b>Pledge <label id="pledge_label" style="cursor:pointer;">$25</label></b></center></span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												
												<div align="center" style="clear:both;width:900px;padding-top:20px;padding-left:40px;">
												<div style="float:left;width:60%;">
													<div style="border: #a2a2a2 2px solid;-moz-border-radius: 10px;height:250px;"><center><h1 style="color:black;">About Maximo Estrella</h1></center>
													<br/>
													<?php
													$nodeids = '1773';
													$nodearray = instant_getContent($nodeids);		
													echo $nodearray['1773']['body'];
													?>
													</div>
												</div>
												<div style="float:left;width:5%;">
												&nbsp;
												</div>
												<div style="float:left;width:35%;">
													<div style="border: #a2a2a2 2px solid;-moz-border-radius: 10px;height:250px;"><center><h1 style="color:black;">Where is Maximo Estrella</h1></center>
														<!--<img src="/themes/theme2010/images/map-philippines.jpg" />-->
														<iframe width="243" scrolling="no" height="209" frameborder="0" src="http://maps.google.com/maps/ms?ie=UTF8&hl=en&msa=0&msid=109207342181459026806.00046f1d93c75f8ce2eea&ll=14.57755075222635,121.0177731513977&spn=0.005514,0.010568&z=5&output=embed" marginwidth="0" marginheight="0"></iframe>
													</div>
												</div>
												</div>
												<div style="clear:both;">&nbsp;</div>
												<div align="center" style="display:block;clear:both;width:900px;padding-top:20px;padding-left:40px;">
													<div id="profile_Dialog_loader"></div>
													<div style="float:left;width:60%;">
														<div>
															<div><center><h1 style="color:black;">
														<?php
														$countsponsor = db_result(db_query("select count(distinct uid) from invest_donations where school = 'Maximo Estrella Elementary School'"));
														
														if($countsponsor < 2){
														echo $countsponsor.' Sponsor';
														} else{
														echo $countsponsor.' Sponsors';
														}
														?> for this school</h1></center></div>	
															<?php
																$query_sponsors = db_query("select distinct B.uid, B.name, B.picture from invest_donations A left join users B on A.uid = B.uid where A.school = 'Maximo Estrella Elementary School'");
																
																echo '<div style="padding-top:20px;"><table style="padding-top:20px;"><tr>';	
																
																	$countsponsor = 0;
																	while($set_sponsors = db_fetch_object($query_sponsors)){
																		
																		$countsponsor++;
																		$profValue = db_result(db_query("SELECT value FROM profile_values WHERE uid = '".$set_sponsors->uid."' AND fid = '3'"));
																		
																		if($countsponsor <= 3){
																		echo '<td style="padding:5px;"><center><img style="cursor:pointer;" id="picture_'.$set_sponsors->uid.'" src="/'.$set_sponsors->picture.' "/><br/><b style="color:#25779f;">'.ucfirst($set_sponsors->name).'</b><br/><span style="color:#898788;">'.ucfirst($profValue).'</span></center></td>';
																		} else {
																		echo '</tr><tr>';
																	    echo '<td style="padding:5px;"><center><img style="cursor:pointer;" id="picture_'.$set_sponsors->uid.'" src="/'.$set_sponsors->picture.' "/><br/><b style="color:#25779f;">'.ucfirst($set_sponsors->name).'</b><br/><span style="color:#898788;">'.ucfirst($profValue).'</span></center></td>';
																	    $countsponsor = 0;
																		}
																		
																	}
																echo '</tr></table></div>';
															?>
														</div>
													</div>
													<div style="float:left;width:5%;">
													&nbsp;
													</div>
													<div style="float:left;width:35%;">
														<div>
															<div>
															<center><h1 style="color:black;"><?php
															$countteamsponsor = db_result(db_query("select count(distinct adopt_team) from invest_donations where school = 'Maximo Estrella Elementary School' and adopt_team != ''"));
															
															if($countteamsponsor < 2){
															echo $countteamsponsor.' Team Sponsor';
															} else{
															echo $countteamsponsor.' Team Sponsors';
															}
															?> for this school</h1></center>
															</div>	
																<div style="padding-top:20px;"><table><tr>
																<?php
																	$query_teams = db_query("select distinct B.team_id, B.team_name, B.photo, B.category, B.kickappsteam_id, B.url from invest_donations A left join invest_team B on B.team_id = A.adopt_team where A.school = 'Maximo Estrella Elementary School'");
																	
																	$countteams = 0;
																	while($set_teams = db_fetch_object($query_teams)){
																	
																		$countteams++;
																		
																		$investorscounttext = db_result(db_query("select count(donation_id) from invest_donations where adopt_team = '".$set_teams->team_id."'"));
																	
																		$membercount = db_result(db_query("select count(uid) from hope_teamusers where team_id = '".$set_teams->kickappsteam_id."'"));
																		
																		if($membercount > 0){
																			//$membercounttext = $membercount > 1 ? $membercount.' Members' : $membercount.' Member';
																			$membercounttext = $investorscounttext > 1 ? $investorscounttext.' Members' : $investorscounttext.' Member';
																			
																			if($countteams <= 3){
																			echo '<td style="padding:5px;"><div style="width:76px;height:78px;cursor:pointer;" id="teampicture_'.$set_teams->kickappsteam_id.'"><center><img border="0" src="http://www.hopecybrary.org/imgdisplay.php?id='.$set_teams->team_id.'" width="76" height="78" /></div><br/><b style="color:#25779f;text-decoration:none;">'.ucfirst($set_teams->team_name).'</b><br/><span style="color:#898788;">'.ucwords($set_teams->category).'</span><br/><span style="color:#898788;">'.$investorscounttext.' of '.$membercounttext.'</span></center></td>';
																			} else {
																			echo '</tr><tr>';
																			echo '<td style="padding:5px;"><div style="width:76px;height:78px;cursor:pointer;" id="teampicture_'.$set_teams->kickappsteam_id.'"><center><img border="0" src="http://www.hopecybrary.org/imgdisplay.php?id='.$set_teams->team_id.'" width="76" height="78" /></div><br/><b style="color:#25779f;text-decoration:none;">'.ucfirst($set_teams->team_name).'</b><br/><span style="color:#898788;">'.ucwords($set_teams->category).'</span><br/><span style="color:#898788;">'.$investorscounttext.' of '.$membercounttext.'</span></center></td>';
																			$countteams = 0;
																			}
																		}
																	}
																	?>
																	</tr></table></div>
														</div>
													</div>
												</div>
											    <div style="clear:both;">&nbsp;</div>
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
		<div id="status_Dialog" title="Fund and Pledge Status" style="display:none;" align="center">
					<table>
						<tr>
							<td style="padding:2px;">&nbsp;</td>
							<td style="padding:5px;"><b>Amount Raised</b></td>
							<td style="padding:5px;"><b>Amount Pledged</b></td>
							<td style="padding:5px;"><b>Deficit</b></td>
						</tr>
						<tr>
							<td style="padding:2px;">
							<b>Cybrary Setup - One Time Costs</b><br/>
							Orientations - School staff<br/>
							Volunteer Recruiting, training, t-shirts<br/>
							Survey and Upgrade of school computer lab<br/>
							Cybrary Artwork
							</td>
							<td style="padding:5px;color:#589931;"><b>$5000</b></td>
							<td style="padding:5px;">$NA</td>
							<td style="padding:5px;">$00</td>
						</tr>
						<tr>
							<td style="padding:2px;">
							<b>Cybrary Startup</b><br/>
							Orientations - Contracting<br/>
							Cybrary Operations Support<br/>
							Hopeful Recruiting and Registration<br/>
							Hope and Dreams Survey<br/>
							Hopeful Basic Training
							</td>
							<td style="padding:5px;color:#589931;"><b>$3880</b></td>
							<td style="padding:5px;">$NA</td>
							<td style="padding:5px;">$00</td>
						</tr>
						<tr>
							<td style="padding:2px;">
							<b>Hope Cybrary Operations</b><br/>
							Admin Tasks<br/>
							Kindness Works Tasks<br/>
							Cybrary and HopeNet Operational Tasks<br/>
							Maintenance and Support Tasks
							</td>
							<td style="padding:5px;color:#589931;"><b>$7000 = 4 Months</b></td>
							<td style="padding:5px;">$1975 = 1 Months</td>
							<td style="padding:5px;color:#e40a0c;"><b>$13,825 = 7 Months</b></td>
						</tr>
					</table>
		</div>
		<div id="listed_Dialog" title="Listed for Funding" style="display:none;" align="center">
					test
		</div>
		
		<div id="checkout_dash" style="display:none;">
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
												<div style="background:url(/themes/theme2010/images/bg-sponsors-checkout.png);height:410px;width:975px;">
													<div style="padding-left:40px;padding-top:20px;">
														<div style="float:left;"><span style="color:#31ea03;font-size:26px;"><b>Checkout</b></span><br/><br/><span style="color:black;font-size:14px;"><b>Adopt: <span id="schoolname">Maximo Estrella Elementary School</span></b></span><br/><img src="/themes/theme2010/images/fred-cybrary.jpg" width="360" height="243"/></div>
														<div style="float:left;padding-left:">
															<div align="right"><img src="<?php echo base_path()?>themes/theme2010/images/setup-progress.png"/></div>
															<div style="padding-left:12px;padding-top:30px;color:black;">
																<div style="width:480px;">
																	<div style="float:left;width:50%;">
																	<div>&nbsp;</div>
																		<div>
																			<div style="padding-top:60px;padding-right:4px;" align="right">
																			<a href="javascript:void(0);" style="color:blue;" id="choose_adoption_option">Choose Adoption Option</a><br/>
																			</div>
																			<div style="padding-top:17px;padding-right:4px;" align="right">
																			<a href="javascript:void(0);" style="color:blue;" id="optional_program">Optional Hope Street Program Fund</a>
																			</div>
																			<div style="padding-top:56px;padding-right:4px;" align="right">
																			<a href="javascript:void(0);" style="color:blue;" id="credit_donation">Credit donation amount to my adoption team</a>
																			</div>
																		</div>
																	</div>
																	<div style="float:left;width:50%;">
																		Adoption Amount<br/>
																		<select id="adoption_amount">
																		<option value="25">$25</option>
																		<option value="50">$50</option>
																		<option value="100">$100</option>
																		<option value="150">$150</option>
																		<option value="200">$200</option>
																		<option value="250">$250</option>
																		<option value="300">$300</option>
																		<option value="350">$350</option>
																		<option value="400">$400</option>
																		<option value="450">$450</option>
																		<option value="500">$500</option>
																		<option value="550">$550</option>
																		<option value="600">$600</option>
																		<option value="650">$650</option>
																		<option value="700">$700</option>
																		<option value="750">$750</option>
																		<option value="800">$800</option>
																		<option value="850">$850</option>
																		<option value="900">$900</option>
																		<option value="950">$950</option>
																		<option value="1000">$1000</option>
																		</select><br/><br/>
																		My Adoption Option<br/>
																		<div style="padding:5px;background-color:white;border:black 1px solid;"><span id="adoption_option">Hope Cybrary Operations - General Fund</span></div>
																		<br/>
																		<div id="percentdiv">$<label id="percentage">2.5</label> <a href="javascript:void(0);" style="color:blue;" id="edit_percentage">edit</a></div>
																		<div style="display:none;" id="percentage_div">
																			<select id="percentage_amount">
																			<option value="0">$0</option>
																			<option value="2.5">$2.5</option>
																			<option value="5">$5</option>
																			<option value="10">$10</option>
																			<option value="15">$15</option>
																			<option value="20">$20</option>
																			<option value="25">$25</option>
																			<option value="30">$30</option>
																			<option value="35">$35</option>
																			<option value="40">$40</option>
																			<option value="45">$45</option>
																			<option value="50">$50</option>
																			<option value="55">$55</option>
																			<option value="60">$60</option>
																			<option value="65">$65</option>
																			<option value="70">$70</option>
																			<option value="75">$75</option>
																			<option value="80">$80</option>
																			<option value="85">$85</option>
																			<option value="90">$90</option>
																			<option value="95">$95</option>
																			<option value="100">$100</option>
																			</select>
																		</div>
																		<br/>
																		<br/>Total Donation <b>$<label id="total_donation"></label></b><br/><br/>
																		<select id="adopt_team">
																			<option value="0">None</option>
																		<?php
																			global $user;
																			
																			$query_teams = db_query("select * from hope_teamusers a left join invest_team b on b.kickappsteam_id = a.team_id where a.uid = '".$user->uid."' order by a.team_id ASC");
																			
																			$countteam = 1;
																			while($set_team = db_fetch_object($query_teams)){
																				if($countteam == 1){
																				echo '<option value="'.$set_team->team_id.'" selected>'.$set_team->team_name.'</option>';
																				} else{
																				echo '<option value="'.$set_team->team_id.'">'.$set_team->team_name.'</option>';
																				}
																			}
																			
																			?>
																		</select>
																		<br/><br/>
																		<div style="clear:both;">
																			<div style="background:url(/themes/theme2010/images/button-confirm.png);width:119px;height:46px;cursor:pointer;float:left;" id="confirm_select">
																				<span style="padding:12px;color:black;"><center><b>Confirm</label></b></center></span>
																			</div>
																			<div style="background:url(/themes/theme2010/images/button-confirm.png);width:119px;height:46px;cursor:pointer;float:right;" id="cancel_select">
																				<span style="padding:12px;color:black;"><center><b>Cancel</label></b></center></span>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div style="clear:both;">&nbsp;</div>
												<div align="center" style="clear:both;width:900px;padding-top:20px;padding-left:110px;">
												<div style="float:left;width:35%;padding-right:15px;">
													<img src="<?php echo base_path()?>themes/theme2010/images/hope_street_adopt_team.jpg"/>
												</div>
												<div style="float:left;width:45%;">
													<b style="color:black;">If you are not yet a member of a Hope Street Adoption Team please consider joining today.</b> <a href="/mystudies/getinvolved/adopt/school/invest-teams">Learn more</a>
												</div>
											</div>
											<div style="clear:both;">&nbsp;</div>
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
				
				<div id="confirm_dash" style="display:none;">
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
												<div style="background:url(/themes/theme2010/images/bg-sponsors-checkout.png);height:410px;width:975px;">
													<div style="padding-left:40px;padding-top:20px;">
														<div style="float:left;"><span style="color:#31ea03;font-size:26px;"><!--<b>Checkout</b>--></span><br/><br/><span style="color:black;font-size:14px;"><b>Adopt: Maximo Estrella Elementary School</b></span><br/><img src="/themes/theme2010/images/fred-cybrary.jpg" width="360" height="243"/></div>
														<div style="float:left;padding-left:">
															<div align="right"><img src="/themes/theme2010/images/setup-progress-confirm.png"/></div>
															<div style="padding-left:12px;padding-top:2px;color:black;">
																<div style="width:480px;">
																	<div style="float:left;width:40%;">
																	<div>&nbsp;</div>
																		<div>
																			<div style="padding-top:236px;padding-right:4px;" align="right">
																			<img src="/themes/theme2010/images/adopt_back.png" id="back_checkout" style="cursor:pointer;"/>
																			</div>
																		</div>
																	</div>
																	<div style="float:left;width:10%;">
																	&nbsp;
																	</div>
																	<div style="float:left;width:50%;">
																		<b>Adoption Amount</b><br/>
																		$<label id="confirm_adoption_amount"></label><br/><br/>
																		<b>My Adoption Option</b><br/>
																		<label id="confirm_adoption_option"></label>
																		<br/><br/>
																		<b>Hope Street General Fund Donation Amount:</b><br/>
																		$<label id="confirm_percentage"></label><br/><br/>
																		<b>Credit Donation Amount to my:</b><br/>
																		<label id="confirm_adopt_team"></label><br/><br/>
																		<b>Total Donation Amount:</b> <br/><b>$<label id="confirm_total_donation"></label></b>
																		<div id="paypal_select" align="right" style="padding-top:2px;">
																			<img src="/themes/theme2010/images/adopt_paypal.png" style="cursor:pointer;"/>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											<div style="clear:both;">&nbsp;</div>
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
				<div id="choose_adoption_Dialog" title="Choose Adoption Option" style="display:none;" align="center">
					<h2>Please click any green tic-box below to choose your adoption option</h2>
					<table>
						<tr>
							<td style="padding:2px;"><b>Tasks</b></td>
							<td style="padding:5px;"><b>Amount Raised</b></td>
							<td style="padding:5px;"><b>Amount Needed</b></td>
						</tr>
						<tr>
							<td style="padding:2px;">
							&nbsp;
							</td>
							<td style="padding:5px;">&nbsp;</td>
							<td style="padding:5px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="padding:2px;">
							<input type="checkbox" id="adopt_opt" name="adopt_opt" disabled="disabled" /> <span style="color:#96a154;">Survey and upgrade of school computer lab</span>
							</td>
							<td style="padding:5px;"><b>$815</b></td>
							<td style="padding:5px;color:#f53637;">$00</td>
						</tr>
						<tr>
							<td style="padding:2px;">
							<input type="checkbox" id="adopt_opt" name="adopt_opt" disabled="disabled" /> <span style="color:#96a154;">Cybrary Artwork</span>
							</td>
							<td style="padding:5px;"><b>$700</b></td>
							<td style="padding:5px;color:#f53637;">$00</td>
						</tr>
						<tr>
							<td style="padding:2px;">
							&nbsp;
							</td>
							<td style="padding:5px;">&nbsp;</td>
							<td style="padding:5px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="padding:2px;">
							<input type="checkbox" id="adopt_opt" name="adopt_opt" disabled="disabled" /> <span style="color:#898989;"><b>Cybrary Startup - General Fund</b></span>
							</td>
							<td style="padding:5px;"><b>$3,880</b></td>
							<td style="padding:5px;color:#f53637;">$00</td>
						</tr>
						<tr>
							<td style="padding:2px;">
							&nbsp;&nbsp;<input type="checkbox" id="adopt_opt" name="adopt_opt" disabled="disabled" /> <span style="color:#898989;">Orientations - Contracting</span>
							</td>
							<td style="padding:5px;">&nbsp;</td>
							<td style="padding:5px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="padding:2px;">
							&nbsp;&nbsp;<input type="checkbox" id="adopt_opt" name="adopt_opt" disabled="disabled" /> <span style="color:#898989;">Cybrary Operations Support</span>
							</td>
							<td style="padding:5px;">&nbsp;</td>
							<td style="padding:5px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="padding:2px;">
							&nbsp;&nbsp;<input type="checkbox" id="adopt_opt" name="adopt_opt" disabled="disabled" /> <span style="color:#898989;">Hopefuls Recruiting and Registration</span>
							</td>
							<td style="padding:5px;">&nbsp;</td>
							<td style="padding:5px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="padding:2px;">
							&nbsp;&nbsp;<input type="checkbox" id="adopt_opt" name="adopt_opt" disabled="disabled" /> <span style="color:#898989;">Hopes and Dreams Survey</span>
							</td>
							<td style="padding:5px;">&nbsp;</td>
							<td style="padding:5px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="padding:2px;">
							&nbsp;
							</td>
							<td style="padding:5px;">&nbsp;</td>
							<td style="padding:5px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="padding:2px;">
							<input type="checkbox" id="general_fund" name="general_fund" checked="checked" /> <span style="color:#3efd38;">Hope Cybrary Operations - General Fund</span>
							</td>
							<td style="padding:5px;"><b>$7,900</b></td>
							<td style="padding:5px;color:#f53637;">$15,800</td>
						</tr>
						<tr>
							<td style="padding:2px;">
							&nbsp;&nbsp;<input type="checkbox" id="admin_tasks" name="admin_tasks" checked="checked" disabled="disabled" /> <span style="color:#3efd38;">Admin Tasks</span>
							</td>
							<td style="padding:5px;"><b>$1,400</b></td>
							<td style="padding:5px;color:#f53637;">$2,800</td>
						</tr>
						<tr>
							<td style="padding:2px;">
							&nbsp;&nbsp;<input type="checkbox" id="adopt_opt" name="adopt_opt" disabled="disabled" /> <span style="color:#898989;">Kindness Workz Tasks</span>
							</td>
							<td style="padding:5px;"><b>$ NA</b></td>
							<td style="padding:5px;color:#f53637;">$ NA</td>
						</tr>
						<tr>
							<td style="padding:2px;">
							&nbsp;&nbsp;<input type="checkbox" id="cybrary_hopenet" name="cybrary_hopenet" checked="checked" disabled="disabled" /> <span style="color:#3efd38;">Cybrary and H0peNet Operational Tasks</span>
							</td>
							<td style="padding:5px;"><b>$4,200</b></td>
							<td style="padding:5px;color:#f53637;">$8,400</td>
						</tr>
						<tr>
							<td style="padding:2px;">
							&nbsp;&nbsp;<input type="checkbox" id="maintenance_tasks" name="maintenance_tasks" checked="checked" disabled="disabled" /> <span style="color:#3efd38;">Maintenance and Supporting Tasks</span>
							</td>
							<td style="padding:5px;"><b>$940</b></td>
							<td style="padding:5px;color:#f53637;">$1,880</td>
						</tr>
						<tr>
							<td style="padding:2px;">
							<span style="color:#3efd38;">Green tasks are in need of funding</span><br/>
							<span style="color:#898989;">Greyed out tasks are fully funded</span>
							</td>
							<td style="padding:5px;">&nbsp;</td>
							<td style="padding:5px;">&nbsp;</td>
						</tr>
					</table>
		</div>
		
		<div id="optional_program_Dialog" title="Optional Hope Street Program Fund" style="display:none;" align="center">
		</div>
				
		<div id="credit_donation_Dialog" title="Credit donation amount to my adoption team" style="display:none;" align="center">
		</div>
				
		<div id="hope_street_adoption_team_Dialog" title="Hope Street Adoption Team" style="display:none;" align="center">
		</div>
				
		<div id="paypal_select_Dialog" title="Secure Donation" style="display:none;" align="center">
			<img src="/themes/theme2010/images/test_paypal.jpg" />
		</div>
	<div id="profile_Dialog" title="Sponsor Profile" style="display:none;"><iframe id="hc_HopefulProfile1" style="position: abosolute;top: 0; left: 0;width:100%;height:95%;"></iframe></div>
	<div id="teamprofile_Dialog" title="Team Profile" style="display:none;"><iframe id="hc_HopefulProfile2" style="position: abosolute;top: 0; left: 0;width:100%;height:95%;"></iframe></div>