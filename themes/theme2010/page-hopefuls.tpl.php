				<script type="text/javascript" src="<?php echo base_path()?>sites/all/modules/incybrary/incybrary_meet_our_children.js"></script>
				<div id="hc_HopefulProfileContainer" style="display:none;">
					<div id="hc_HopefulProfileContainerClose" style="text-align:right; cursor:pointer; font-family:verdana; padding:5px 5px 5px 0; color:maroon; font-weight:bold; background-color:#F8F8F8;">[close this]</div>
					<iframe id="hc_HopefulProfile" src="" width="838" height="471" border="0"></iframe>
				</div>
				
				<div id="meet_cbtop">
					<div class="cb">
						<div class="bt">
							<div></div>
						</div>
						<div class="i1">
							<div class="i2">
								<div class="i3">
									<div class="left-border">
										<div class="right-border">
											<table width="980" border="0" cellpadding="0" cellspacing="0">
												<tr>
													<td height="35" width="630" class="bgfix">&nbsp;</td>
													<td rowspan="2" width="1" class="dividerv"></td>
													<td rowspan="2" width="329" style="padding-left:5px">
														<div class="jboxh">
															<div class="jboxhead"><h2>Live Video Chat</h2></div>
															<div class="jboxbody">
																<div class="jboxcontent">
																	<center><img src="<?php echo $theme_imgpath; ?>gi_meethopefuls_livevideo.jpg" border="0" /><br /></center><br />
																	<hr style="width:100%" class="divider" />
																	<div style="color:black;">
																	<b>HopeNet Global Communications Network</b><br/>
																	Our global communications network harnesses the power of social-media
																	to facilitate global cultural exchange, interaction and understanding. HopeNet provides
																	real time, one-to-one contact between the Hopefuls, and their tutors mentors and sponsors
																	</div>
																	<img align="left" class="inline_img" src="<?php echo $theme_imgpath; ?>meet_livevideochat2.jpg" border="0" />
																	 <div style="height:100px;color:black;">
																	using email, chat messaging, 3-D virtual world's, and video and voice conferencing.
																	</div>
																	 <!--<hr style="clear:both;width:100%" class="divider" />
																	<p align="right"><a href="#"><img src="<?php echo $theme_imgpath; ?>meet_btn_learnmore.png" border="0" /></a></p>-->
																</div>
															</div>
															<div class="jboxfoot"><p></p></div>
														</div>
													</td>
												</tr>
												<tr>
													<td style="padding-right:5px;">
																	<div style="height:90px;">
																		<div style="float:left;width:35%;">
																		<br/><br/><img src="<?php echo $theme_imgpath; ?>gi_balloon_message.png" border="0" />
																		</div>
																		<div style="float:left;width:60%;color:black;">
																		The Hopefuls are organized by their elementary schools. To view the Hopefuls that belong to a particular school 
																		just click the city and school in the dropdown box below. You may then click on the 
																		"In the Cybrary Now" button to see the Hopefuls that are presently in their schools Hope Cybrary
																		</div>
																	</div>
														<div class="jboxh">
															<div class="jboxhead"><h2 id="incybrary_block_title"><!--In the Cybrary Now--></h2></div>
															<div class="jboxbody">
																<div class="jboxcontent">
																	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="meet_info">
																		<tr>
																			<td width="90" valign="top">
																				<img id="incybrary_avatar" src="<?php echo base_path()?>sites/default/files/pictures/none.png" border="0" style="cursor:pointer" /><br />
																			</td>
																			<td>
																				<div id="incybrary_hopeful_details" style="float:left;width:230px;"></div>
																				<div style="float:left;width:200px;height:90px;padding-left:15px;">
																					<div style="background-color:#c6e1f2;border:1px solid #b3b3b3;width:255px;height:65px;padding:8px;">
																					To locate a Hopeful in a specific school click the city and school in the dropdown box.<br/><br/>
																					<select id="schoolSelectWebcam" name="schoolSelectWebcam" onchange="tempchangeschoolMeetHopefuls(this.value);">
																						<option value="" selected>Click City</option>
																						<option value="">->Makati City</option>
																						<option value="Jose Magsaysay Elementary School">-->Jose Magsaysay Elementary School</option>
																						<option value="Francisco Benitez Elementary School">-->Francisco Benitez Elementary School</option>
																						<option value="Maximo Estrella Elementary School" selected>-->Maximo Estrella Elementary School</option>
																					</select>
																					<input type="hidden" id="globalCurrentSchool" name="globalCurrentSchool" value="Maximo Estrella Elementary School" />
																					</div>
																				</div>
																			</td>
																		</tr>
																		<tr>
																			<td colspan="2"><hr style="padding-top:20px; width:100%" class="divider" /></td>
																		</tr>
																		<tr>
																			<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="2" class="meet_users">
																				  <tr>
																					<td style="width:160px;">
																						<a id="button_children_online" href="javascript:void(0);"><img src="<?php echo $theme_imgpath; ?>meet_inthecybrarynow.gif" border="0" /></a><br />
																						<a id="button_children_24" href="javascript:void(0);"><img src="<?php echo $theme_imgpath; ?>meet_inthelast24.gif" border="0" /></a><br />
																						<a id="button_children_all" href="javascript:void(0);"><img src="<?php echo $theme_imgpath; ?>meet_allhopefuls.gif" border="0" /></a><br />
																					</td>
																					<td align="center">
																						<center><h3 id="incybrary_status_title" style="color:#0f0df4;">All Hopefuls</h3></center>
																						<div id="incybrary_hopeful_list"></div>
																					</td>
																				  </tr>
																				</table>
																			</td>
																		</tr>
																		<tr>
																			<td colspan="2">
																			<div style="float:left;width:30%;color:#0f0df4;">
																			Click the buttons to view Hopefuls who are in the Cybrary now or in the last 24 hours.
																			</div>
																			<div style="float:left;width:70%;">
																			<hr style="width:100%;" class="divider" />
																			</div>
																			</td>
																		</tr>
																		<tr>
																			<td colspan="2" align="right" class="pager">
																				<!--Pages : <a href="#">1</a> | <a href="#">2</a> | <a href="#">3</a> | -->
																				<div style="float:left;width:30%;">
																				&nbsp;
																				</div>
																				<div style="float:left;width:70%;">
																				<div id="incybrary_hopeful_nav"></div>
																				</div>
																			</td>
																		</tr>
																	</table>  
																</div>
															</div>
															<div class="jboxfoot"><p></p></div>
														</div>
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
				
				<div id="meet_cbbottom">
				    
					<div class="cb">
						<div class="bt">
							<div></div>
						</div>
						<div class="i1">
							<div class="i2">
								<div class="i3">
									<div class="left-border">
										<div class="right-border">
											<table width="980" border="0" cellpadding="0" cellspacing="0" class="hopefuls">
												<tr>
													<td rowspan="2" width="270" style="padding-right:5px;" valign="top">
														<div class="jboxh">
															<div class="jboxhead"><h2>Community Building</h2></div>
															<div class="jboxbody">
																<div class="jboxcontent">
																	<div style="height:90px;color:black;">
																	The purpose of the Community Building Program is to provide the Hopefuls with team, leadership and life skills that can be used as a basis for their livelihood and to rebuild their communities at the barangay level.
																	</div>
																	<p align="right"><img src="<?php echo $theme_imgpath; ?>meet_btn_learnmore.png" border="0" onclick="openMeetHopefulDialog('communitybldg_Dialog');" style="cursor:pointer;"/></p>
																	<hr class="divider" />
																	<img class="border_img" src="<?php echo $theme_imgpath; ?>meet_peacebuilding.jpg" border="0" />
																</div>
																<div id="communitybldg_Dialog" title="Community Building" style="display:none;">
																Additionally the program will demonstrate and reinforce to the Hopefuls that their dreams and life goals are important and how they are relevant to their school subjects.
																<br/>
																The students are formed into Hope Teams consisting of 12 children. Each child on the team is assigned a Community Building field/specialty that corresponds with their personal goals/dreams. The Community Building fields/specialties include the Environment, Engineering, Technical, The Arts, Security, Health, and Management & Administration. It is then explained and reinforced with the children how their school curriculum, HopeNet and their dreams and community building skills are relevant and reinforce one another.
																</div>
															</div>
															<div class="jboxfoot"><p></p></div>
														</div>
													</td>
													<td rowspan="2" width="1" class="dividerv" valign="top"><p class="filler" /></td>
													<td height="60" align="center" class="bgfix">
													</td>
													<td rowspan="2" width="1" class="dividerv" valign="top"><p class="filler" /></td>
													<td width="270" rowspan="2" style="padding-left:5px" valign="top">
														<div class="jboxh">
															<div class="jboxhead"><h2>Peace Building</h2></div>
															<div class="jboxbody">
																<div class="jboxcontent">
																	<div style="height:50px;color:black;">
																	The HopeNet Peace Building program encompasses several programs including our Values & Virtues, Spirituality, and our Kindness Workz program. 
																	</div>
																	<br /> 
																	<p align="right"><img src="<?php echo $theme_imgpath; ?>meet_btn_learnmore.png" border="0" onclick="openMeetHopefulDialog('peacebldg_Dialog');" style="cursor:pointer;"/></p>
																	<hr class="divider" />
																	<img class="border_img" src="<?php echo $theme_imgpath; ?>meet_virtues.jpg" border="0" />
																</div>
															</div>
															<div id="peacebldg_Dialog" title="Peace Building" style="display:none;">
															Our flagship Peace Building program is our <u>Kindness program</u>, where the Hopefuls provide community services such as garbage clean up, tree planting, repair and other good deeds. As a form of encouragement and recognition to the Hopefuls for participating in the Kindness program the Hopefuls receive Hope-Bucks for their Kindness Workz. <u>The Values & Virtues</u> program provides a forum for the Hopefuls to exercise and recognize the value of virtues such as empathy, courage, persistence, wisdom and tolerance. Our <u>Spirituality</u> program encourages the Hopeful to tolerate all faiths and to exercise and study the faith of their choosing.
															<br/>
															Peace Building is the crucial program that tempers all of the other HopeNet programs and which will power the Hopefuls into their mission of bringing HOPE to our planet. 	
															</div>
															<div class="jboxfoot"><p></p></div>
														</div>
													</td>
												</tr>
												<tr>
													<td align="left" style="padding:0px 5px 0px 5px">
														<div class="jboxh">
															<div class="jboxhead"><h2>About the Hopefuls</h2></div>
															<div class="jboxbody">
																<div class="jboxcontent" style="color:black;">
																	<center><img src="<?php echo $theme_imgpath; ?>gi_meethopefuls_spirit.jpg" border="0" /></center><br/>
																	<center><b>To obtain what we have never had, we must do what we have not yet done...</b></center><br/>
																	Soon an awakening will sweep across the planet, where an emerging class of global youth value green above gold, virtue above vice, and freedom above security. A people who inspire us with their deeds and whose kindness has become their currency. We see them coming together in their pursuit of peace and wisdom, in the service of mankind. We call these Global youth “The Hopefuls;” they are the single element of our society that has not yet succumbed to prejudice or been corrupted by vices. They possess the gift of belief and are the carriers of hope.
																	<br /> 
																	<p align="right"><img src="<?php echo $theme_imgpath; ?>meet_btn_learnmore.png" border="0" onclick="openMeetHopefulDialog('spirituality_Dialog');" style="cursor:pointer;"/></p>
																	<!--<hr class="divider" />
																	<img class="border_img" src="<?php echo $theme_imgpath; ?>meet_spirituality.jpg" width="330" height="120" border="0" />-->
																</div>
																<div id="spirituality_Dialog" title="About the Hopefuls" style="display:none;">
																Imagine... if we could somehow locate and network together 10's of thousands of Hopefuls (children) whose goal in life was the pursuit of peace, wisdom, virtues and spirituality. Visualize the Hopefuls living globally in far-flung cities such as Manila, Bogota, Moscow, Baghdad, Rome, Beirut, Gaza, Mumbai, Shanghai and the Bronx; but on a daily basis they speak with and see one another in real-time as well as virtually learning, studying, playing and even working together. What if the Hopefuls administered their own system of government, justice and international relations? ...And imagine the possibilities if the Hopefuls participated daily in life skills programs where they learned to resolve conflict, build community and support themselves through our global-digital economy.
																<br/><br/>
																What if adult volunteers from all over the world stepped up to tutor, mentor, sponsor and protect these special children?... and what if this program was available to the Hopefuls from all walks of life and the only cost was that the Hopefuls pay for the program through Kindness Workz (good deeds) in their local communities... Imagine... the long term effects if the Hopefuls virtually grew up together in this program over the course of an entire generation?
																<br/><br/>
																What effect would such a program have on society and our planet? We believe that the 1st Earth Alliance has the potential to serve as a mechanism for the social evolution of mankind. In short it will provide a means for the Hopefuls to learn, grow and develop themselves into role models of hope for the potential of all mankind.
																</div>
															</div>
															<div class="jboxfoot"><p></p></div>
														</div>
														<!--<div class="jbox" style="padding-top:10px">
															<div class="jboxhead"><h2></h2></div>
															<div class="jboxbody">
																<div class="jboxcontent" align="center">
																	<table width="95%" border="0" cellspacing="0" cellpadding="2">
																	  <tr>
																		<td valign="middle" align="left" width="50"><br /><br /><a href="#"><img src="<?php echo $theme_imgpath; ?>meet_arrow_left.gif" border="0" /></a></td>
																		<td align="center"><a href="#"><img src="<?php echo $theme_imgpath; ?>meet_youtube.jpg" border="0" /></a></td>
																		<td align="right" width="50"><br /><br /><a href="#"><img src="<?php echo $theme_imgpath; ?>meet_arrow_right.gif" border="0" /></a></td>
																	  </tr>
																	</table>
																</div>
															</div>
															<div class="jboxfoot"><p></p></div>
														</div>-->	
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
				
				<div id="meet_cbfoot">
					<div class="cb">
						<div class="bt">
							<div></div>
						</div>
						<div class="i1">
							<div class="i2">
								<div class="i3">
									<div class="left-border">
										<div class="right-border">
											<table width="980" border="0" cellpadding="0" cellspacing="0">
												<tr>
													<td width="470" rowspan="2"  style="padding-right:5px" valign="top">
														<div class="jboxh">
															<div class="jboxhead"><h2>Kindness Workz Map</h2></div>
															<div class="jboxbody">
																<div class="jboxcontent">
																	<span style="color:black;">Below is a map of the Kindness Workz done by the Hopefuls. Just zoom in and click any of the green arrows to see an explanation of how the hopefuls are helping their communities and neighbors.</span>
																	<br /><br />
																	<hr class="divider" />
																	<center>
																		<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps/ms?ie=UTF8&amp;hl=en&amp;msa=0&amp;msid=109207342181459026806.00046f1d93c75f8ce2eea&amp;ll=14.57755075222635,121.0177731513977&amp;spn=0.007269,0.00912&amp;z=16&amp;output=embed"></iframe>
																	</center>
																</div>
															</div>
															<div class="jboxfoot"><p></p></div>
														</div></td>
													<td width="1" rowspan="2" class="dividerv">&nbsp;</td>
													<td valign="top" height="35" class="bgfix">&nbsp;</td>
												</tr>
												<tr>
													<td valign="top" style="padding-left:5px">
														<div class="jboxh">
															<div class="jboxhead"><h2>HopeNet</h2></div>
															<div class="jboxbody">
																<div class="jboxcontent">
																	<center>
																	<div class="quote1">"Teach a man to fish and feed him for a lifetime"</div>
																	<div class="quote2">"Teach a child to fish and feed the world"</div>
																	<img src="<?php echo $theme_imgpath; ?>meet_teachaman.jpg" border="0" />
																	</center>
																	<div style="height:30px;color:black;padding-top:12px;">
																	HopeNet is the world's first collaborative, immersive, muti purpose
																	web-based, knowledge platform for children, delivered in 42 languages.
																	</div>
																	<p align="right"><a href="<?php echo base_path()?>programs/knowledge-portal"><img src="<?php echo $theme_imgpath; ?>meet_btn_learnmore.png" border="0" /></a></p>													</div>
															</div>
															<div class="jboxfoot"><p></p></div>
														</div>										
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