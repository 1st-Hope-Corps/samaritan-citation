<style>
#bar{
background-color:#11f700;
width:0px;
height:16px;
}
#barbox{
height:16px;
background-color:#c0c0c0;
width:195px;
border:solid 2px #c0c0c0;
margin-right:3px;
-webkit-border-radius:5px;-moz-border-radius:5px;
}
</style>
<script>
$(document).ready(
	function(){		
	$("#page_btnPopMaximo").click(
			function(){
				$("#maximo_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 490,
						buttons: {
							"Read More": function(){
							location = "<?php echo base_path()?>mystudies/getinvolved/adopt/school/maximo-estrella-elementary-school";
							},
							"Close": function(){
							$(this).dialog("close");
							}
						}
				});
			}
		); 
	$("#page_btnPopMagsaysay").click(
			function(){
				$("#magsaysay_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 490,
						buttons: {
							/*"Read More": function(){
							location = "";
							},*/
							"Close": function(){
							$(this).dialog("close");
							}
						}
				});
			}
		); 
	$("#page_btnPopBenitez").click(
			function(){
				$("#benitez_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 490,
						buttons: {
							/*"Read More": function(){
							location = "";
							},*/
							"Close": function(){
							$(this).dialog("close");
							}
						}
				});
			}
		); 
		
	$("#return_investment").click(
			function(){
				$("#return_investment_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 490,
						buttons: {
							"Close": function(){
							$(this).dialog("close");
							}
						}
				});
			}
		); 

	$("#start_new").click(
			function(){
				$("#start_new_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 490,
						buttons: {
							"Close": function(){
							$(this).dialog("close");
							}
						}
				});
			}
		); 

	$("#how_it_works").click(
			function(){
				$("#how_it_works_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 490,
						buttons: {
							"Close": function(){
							$(this).dialog("close");
							}
						}
				});
			}
		); 
	
	$("#invest_kindness").click(
			function(){
				$("#invest_kindness_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 490,
						buttons: {
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
<?php
$nodeids = '1773,1774,1775,1760,1761,1762,1763,1764,1765,1766,1767,1768';
$nodearray = instant_getContent($nodeids);		
?>
				<div id="cbrect">
					<div class="cbb">
						<div class="left-border">
							<div class="right-border">
								<table width="970" border="0" cellspacing="0" cellpadding="2">
								  <tr>
									<td width="200" align="center" valign="top">
										<img src="<?php echo base_path()?>themes/theme2010/images/hope_cybrary_logo.jpg" />
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
											<ul id="mycarousel" class="jcarousel-skin-sponsors"> 
												<li>
													<div style="border: #6cfc67 5px solid;-moz-border-radius: 10px;">
														<h4><?=$nodearray['1773']['title']?></h4>
														<a href="javascript:void(0);" id="page_btnPopMaximo"><img src="<?php echo base_path()?>/themes/theme2010/images/programs_nav_hopecybrary.png" /></a>
														<div>&nbsp;</div>
														<center style="color:black;">40% Funded - $18,000 to go</center>
														<div>&nbsp;</div>
														<div align="center"><div id="barbox" align="left"><div id="bar" align="left" style="width:90px;"></div></div></div>
														<div>&nbsp;</div>
													</div>	
													<div>&nbsp;</div>
													<div style="border: #6cfc67 5px solid;-moz-border-radius: 4px;height:30px;"><center>Green Schools are now available for adoption</center></div>
												</li>
												<li>
													<div style="border: #fdff41 5px solid;-moz-border-radius: 10px;">
														<h4><?=$nodearray['1774']['title']?></h4>
														<div style="height:107px;cursor:pointer" id="page_btnPopMagsaysay">
															<a href="<?php echo base_path()?>programs/peace-building"><img src="<?php echo base_path()?>/themes/theme2010/images/programs_nav_peacebuilding.png" /></a>
														</div>
														<div>&nbsp;</div>
														<center style="color:black;">20% Funded - $24,000 to go</center>
														<div>&nbsp;</div>
														<div align="center"><center><div id="barbox" align="left"><div id="bar" align="left" style="width:60px;"></div></div></center></div>
														<div>&nbsp;</div>
													</div>
													<div>&nbsp;</div>
													<div style="border: #fdff41 5px solid;-moz-border-radius: 4px;height:30px;"><center>Yellow Schools will be available for adoption once the green schools are adopted</center></div>
												</li>
												<li>
													<div style="border: #fdff41 5px solid;-moz-border-radius: 10px;">
														<h4><?=$nodearray['1775']['title']?></h4>
														<div style="height:107px;cursor:pointer" id="page_btnPopBenitez">
														<a href="<?php echo base_path()?>programs/e-tutoring"><img src="<?php echo base_path()?>/themes/theme2010/images/programs_nav_etutoring.png" /></a>
														</div>
														<div>&nbsp;</div>
														<center style="color:black;">20% Funded - $24,000 to go</center>
														<div>&nbsp;</div>
														<div align="center"><center><div id="barbox" align="left"><div id="bar" align="left" style="width:60px;"></div></div></center></div>
														<div>&nbsp;</div>
													</div>
													<div>&nbsp;</div>
													<div style="border: #fdff41 5px solid;-moz-border-radius: 4px;height:30px;"><center>Yellow Schools will be available for adoption once the green schools are adopted</center></div>
												</li>
											</ul>	
											
											<div align="center" style="clear:both;width:900px;padding-top:20px;padding-left:110px;">
												<div style="float:left;width:35%;padding-right:35px;">
													<div style="border: #a2a2a2 2px solid;-moz-border-radius: 10px;height:80px;">
														<div style="padding-top:15px;"><center><h1>35 Sponsors<br/>$24,000 invested in 3 schools</h1></center></div>
													</div>
													<div style="height:37px;">&nbsp;</div>
													<div style="border: #a2a2a2 2px solid;-moz-border-radius: 10px;height:80px;">
														<div style="padding-top:15px;"><center><h1>12 Sponsors<br/>$6,000 Pledged</h1></center></div>
													</div>
												</div>
												<div style="float:left;width:45%;">
													<div style="border: #a2a2a2 2px solid;-moz-border-radius: 10px;height:200px;"><center><h1 style="color:#569339;">Whats my Return on Investment?</h1></center>
														<div align="right" style="padding-right:5px;padding-top:150px;">
															<a href="javascript:void(0);" style="color:black;" id="return_investment"><b>LEARN MORE</b></a>
														</div>
													</div>
												</div>
											</div>
											<div style="clear:both;">&nbsp;</div>
											<div style="clear:both;width:980px;padding-top:20px;">
												<div style="float:left;width:100%;">
													<div style="border: #a2a2a2 2px solid;-moz-border-radius: 10px;height:200px;padding-bottom:15px;">
														<div style="float:left;width:35%;padding-top:5px;padding-left:22px;">
														<h1 style="color:#4c7d55;">How it works?</h1></span><br/>
														<span style="color:#4c7d55;font-size:16px;"><b>1. Choose School</span><br/><br/>
														<span style="color:#4c7d55;font-size:16px;"><b>2. Select a Cybrary Program</b></span><br/><br/>
														<span style="color:#4c7d55;font-size:16px;"><b>3. Invest as a group or individual</b></span><br/><br/>
														<span style="color:#4c7d55;font-size:16px;"><b>4. Watch your investment grow</b></span><br/><br/>
														<a href="javascript:void(0);" style="color:#4c7d55;" id="how_it_works"><b>LEARN MORE</b></a>
														</div> 
														<div style="float:left;width:60%;padding-top:5px;">
															<div style="float:left;width:32%;border: #499a6d 2px solid;-moz-border-radius: 10px;height:185px;">
																<div style="padding-top:5px;"><center style="font-size:16px;color:black;"><b>Start up a new<br/> cybrary</b></center><br/><br/><br/>
																<center>Graphic</center><br/><br/><br/>
																	<div align="right" style="padding-right:5px;">
																	<a href="javascript:void(0);" style="color:black;" id="start_new"><b>LEARN MORE</b></a>
																	</div>
																</div>
															</div>
															<div style="float:left;">
															&nbsp;
															</div>
															<div style="float:left;width:32%;border: #499a6d 2px solid;-moz-border-radius: 10px;height:185px;">
																<div style="padding-top:5px;"><center style="font-size:16px;color:black;"><b>Invest in Kindness WorkZ</b></center><br/><br/><br/>
																<center>Graphic</center><br/><br/><br/>
																	<div align="right" style="padding-right:5px;">
																	<a href="javascript:void(0);" style="color:black;" id="invest_kindness"><b>LEARN MORE</b></a>
																	</div>
																</div>
															</div>
															<div style="float:left;">
															&nbsp;
															</div>
															<div style="float:left;width:32%;border: #499a6d 2px solid;-moz-border-radius: 10px;height:185px;">
																<div style="padding-top:5px;"><center style="font-size:16px;color:black;">Group and Individual Investing</b></center><br/><br/><br/>
																<center><a href="<?php echo base_path()?>mystudies/getinvolved/adopt/school/invest-teams">Graphic</a></center><br/><br/><br/>
																	<div align="right" style="padding-right:5px;">
																	<a href="<?php echo base_path()?>mystudies/getinvolved/adopt/school/invest-teams" style="color:black;"><b>LEARN MORE</b></a>
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
				
				<div id="maximo_Dialog" title="<?=$nodearray['1773']['body']?>" style="display:none;" align="center">
					<table width="470" border="0" cellspacing="0" cellpadding="2" style="border: #6cfc67 2px solid;">
								  <tr>
									<td width="200" align="center" valign="top">
										<img src="<?php echo base_path()?>themes/theme2010/images/about_overview.jpg" border="0" />
									</td>
									<td valign="top">
										<div style="padding-left:5px;"><?=$nodearray['1773']['body']?></div>
									</td>
								  </tr>
					</table>
				</div>
				<div id="magsaysay_Dialog" title="<?=$nodearray['1774']['body']?>" style="display:none;" align="center">
					<table width="470" border="0" cellspacing="0" cellpadding="2" style="border: #fdff41 2px solid;">
								  <tr>
									<td width="200" align="center" valign="top">
										<img src="<?php echo base_path()?>themes/theme2010/images/magsaysay_overview.png" border="0" />
									</td>
									<td valign="top">
										<div style="padding-left:5px;"><?=$nodearray['1774']['body']?></div>
									</td>
								  </tr>
					</table>
				</div>
				<div id="benitez_Dialog" title="<?=$nodearray['1775']['title']?>" style="display:none;" align="center">
					<table width="470" border="0" cellspacing="0" cellpadding="2" style="border: #fdff41 2px solid;">
								  <tr>
									<td width="200" align="center" valign="top">
										<img src="<?php echo base_path()?>themes/theme2010/images/about_overview.jpg" border="0" />
									</td>
									<td valign="top">
										<div style="padding-left:5px;"><?=$nodearray['1775']['body']?></div>
									</td>
								  </tr>
					</table>
				</div>

				<div id="return_investment_Dialog" title="<?=$nodearray['1768']['title']?>" style="display:none;" align="center">
				<?=$nodearray['1768']['body']?>
				</div>
				
				<div id="how_it_works_Dialog" title="<?=$nodearray['1765']['title']?>"" style="display:none;" align="center">
				<?=$nodearray['1765']['body']?>
				</div>
				
				<div id="start_new_Dialog" title="<?=$nodearray['1764']['title']?>"" style="display:none;" align="center">
				<?=$nodearray['1764']['body']?>
				</div>
				
				<div id="invest_kindness_Dialog" title="<?=$nodearray['1766']['title']?>"" style="display:none;" align="center">
				<?=$nodearray['1766']['body']?>
				</div>
				
				<div id="group_individual_Dialog" title="<?=$nodearray['1767']['body']?>"" style="display:none;" align="center">
				<?=$nodearray['1767']['body']?>
				</div>