<script>
$(document).ready(
	function(){		
	$("#page_btnTeam1").click(
			function(){
				$("#team1_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 490,
						buttons: {
							"Learn More": function(){
							$(this).dialog("close");
							},
							"Close": function(){
							$(this).dialog("close");
							}
						}
				});
			}
		); 
	$("#page_btnTeam2").click(
			function(){
				$("#team2_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 490,
						buttons: {
							"Learn More": function(){
							$(this).dialog("close");
							},
							"Close": function(){
							$(this).dialog("close");
							}
						}
				});
			}
		); 
	$("#page_btnTeam3").click(
			function(){
				$("#team3_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 490,
						buttons: {
							"Learn More": function(){
							$(this).dialog("close");
							},
							"Close": function(){
							$(this).dialog("close");
							}
						}
				});
			}
		); 
	$("#page_btnTeam4").click(
			function(){
				$("#team4_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 490,
						buttons: {
							"Learn More": function(){
							$(this).dialog("close");
							},
							"Close": function(){
							$(this).dialog("close");
							}
						}
				});
			}
		); 
	}
);
</script>
				<div id="cbrect">
					<div class="cbb">
						<div class="left-border">
							<div class="right-border">
								<table width="970" border="0" cellspacing="0" cellpadding="2">
								  <tr>
									<td width="200" align="center" valign="top">
										<img src="/themes/theme2010/images/team_hope_adoption.png" />
									</td>
									<td valign="top" style="padding-left:12px;">
										<h4 style="color:#20f42d;font-size:24px;">Invest Teams</h4> <h4 style="color:#ff0000;font-size:20px;">Under Construction</h4>
										<h1>Invest Teams are groups of people who have banded together to invest funds in HopeNet</h1><br/>
										<h1>You can join an existing team or start your own team and invite your friends.</h1><br/>
										<div style="clear:both;padding-top:12px;">
											<div style="float:left;width:20%;">
													<div style="background:url(/themes/theme2010/images/team-sponsor-button.png);width:132px;height:32px;cursor:pointer;" id="pledge_select">
													 <div style="padding-top:8px;"><span style="color:black;cursor:pointer;"><center><b>View My Team</b></center></span></div>
													</div>
											</div> 
											<div style="float:left;width:2%;">&nbsp;</div>
											<div style="float:left;width:20%;">
													<div style="background:url(/themes/theme2010/images/team-sponsor-button.png);width:132px;height:32px;cursor:pointer;" id="pledge_select">
													 <div style="padding-top:8px;"><span style="color:black;cursor:pointer;"><center><b>Join A Team</b></center></span></div>
													</div>
											</div> 
											<div style="float:left;width:2%;">&nbsp;</div>
											<div style="float:left;width:20%;">
													<div style="background:url(/themes/theme2010/images/team-sponsor-button.png);width:132px;height:32px;cursor:pointer;" id="pledge_select">
													 <div style="padding-top:8px;"><span style="color:black;cursor:pointer;"><center><b>Start A Team</b></center></span></div>
													</div>
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
											<img src="/themes/theme2010/images/search-team-sponsor.png" />
											<div style="padding-top:12px;padding-bottom-12px;color:black;">
												<div><b style="padding-left:50px;color:#609d35;font-size:15px;">Team Listing</b> &nbsp;&nbsp;&nbsp; <b>12</b> Investment &nbsp;&nbsp;&nbsp; <b>300</b> Team Members</div>
												<div style="padding-left:150px;padding-top:12px;"><select><option>- All Categories -</option></select> &nbsp;&nbsp;&nbsp; Sort by: <select><option>Total Invested</option></select></div>
											</div>
											<div>&nbsp;</div>
											<ul id="mycarousel" class="jcarousel-skin-sponsors-teams"> 
												<li>
													<div style="border: #6cfc67 5px solid;-moz-border-radius: 10px;">
														<h4>Invest Team 1</h4>
														<div style="height:107px;cursor:pointer" id="page_btnTeam1">
															<a href="javascript:void(0);"><img src="/themes/theme2010/images/flag-team-1.png" /></a>
														</div>
														<div>&nbsp;</div>
														<center style="color:black;">$4000 Invested</center>
														<div>&nbsp;</div>
													</div>
													<div>&nbsp;</div>
												</li>
												<li>
													<div style="border: #6cfc67 5px solid;-moz-border-radius: 10px;">
														<h4>Invest Team 2</h4>
														<div style="height:107px;cursor:pointer" id="page_btnTeam2">
															&nbsp;
														</div>
														<div>&nbsp;</div>
														<center style="color:black;">$3000 Invested</center>
														<div>&nbsp;</div>
													</div>
													<div>&nbsp;</div>
												</li>
												<li>
													<div style="border: #6cfc67 5px solid;-moz-border-radius: 10px;">
														<h4>Invest Team 3</h4>
														<div style="height:107px;cursor:pointer" id="page_btnTeam3">
														<a href="javascript:void(0);"><img src="/themes/theme2010/images/flag-team-2.png" /></a>
														</div>
														<div>&nbsp;</div>
														<center style="color:black;">$500 Invested</center>
														<div>&nbsp;</div>
													</div>
													<div>&nbsp;</div>
												</li>
												<li>
													<div style="border: #6cfc67 5px solid;-moz-border-radius: 10px;">
														<h4>Invest Team 4</h4>
														<div style="height:107px;cursor:pointer" id="page_btnTeam4">
														<a href="javascript:void(0);"><img src="/themes/theme2010/images/flag-team-3.png" /></a>
														</div>
														<div>&nbsp;</div>
														<center style="color:black;">$1000 Invested</center>
														<div>&nbsp;</div>
													</div>
													<div>&nbsp;</div>
												</li>
											</ul>	
											
											<div align="center" style="clear:both;width:900px;padding-top:20px;padding-left:70px;">
												<div style="float:left;width:40%;padding-right:35px;">
													<div style="border: #a2a2a2 2px solid;-moz-border-radius: 10px;height:480px;clear:both;">
														<div style="padding-top:15px;"><center><h1>Top Investment Teams</h1></center></div>
														<div style="padding-top:5px;"><img src="/themes/theme2010/images/team_hope_teams.png" /></div>
													</div>
												</div>
												<div style="float:left;width:45%;">
													&nbsp;
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
				
				<div id="team1_Dialog" title="Invest Team 1" style="display:none;" align="center">
					<table width="470" border="0" cellspacing="0" cellpadding="2" style="border: #6cfc67 2px solid;">
								  <tr>
									<td width="200" align="center" valign="top">
										<br/><img src="/themes/theme2010/images/flag-team-1.png" border="0" /><br/> Team Tagline:
									</td>
									<td valign="top">
										<div style="padding-left:5px;">8 members <br/><br/> Based in Europe <br/><br/> Formed in 2011 <br/><br/> <b>$4000</b> </div>
									</td>
								  </tr>
					</table>
				</div>
				<div id="team2_Dialog" title="Invest Team 2" style="display:none;" align="center">
					<table width="470" border="0" cellspacing="0" cellpadding="2" style="border: #fdff41 2px solid;">
								  <tr>
									<td width="200" align="center" valign="top">
										&nbsp;<br/> Team Tagline:
									</td>
									<td valign="top">
										<div style="padding-left:5px;">3 members <br/><br/> Based in Singapore <br/><br/> Formed in 2011 <br/><br/> <b>$3000</b> </div>
									</td>
								  </tr>
					</table>
				</div>
				<div id="team3_Dialog" title="Invest Team 3" style="display:none;" align="center">
					<table width="470" border="0" cellspacing="0" cellpadding="2" style="border: #fdff41 2px solid;">
								  <tr>
									<td width="200" align="center" valign="top">
										<br/><img src="/themes/theme2010/images/flag-team-2.png" border="0" /><br/> Team Tagline:
									</td>
									<td valign="top">
										<div style="padding-left:5px;">6 members <br/><br/> Based in Canada <br/><br/> Formed in 2011 <br/><br/> <b>$500</b> </div>
									</td>
								  </tr>
					</table>
				</div>
				<div id="team4_Dialog" title="Invest Team 4" style="display:none;" align="center">
					<table width="470" border="0" cellspacing="0" cellpadding="2" style="border: #fdff41 2px solid;">
								  <tr>
									<td width="200" align="center" valign="top">
										<br/><img src="/themes/theme2010/images/flag-team-3.png" border="0" /><br/> Team Tagline:
									</td>
									<td valign="top">
										<div style="padding-left:5px;">5 members <br/><br/> Based in Turkey <br/><br/> Formed in 2011 <br/><br/> <b>$1000</b> </div>
									</td>
								  </tr>
					</table>
				</div>