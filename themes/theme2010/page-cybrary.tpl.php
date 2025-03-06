		<?php
				//$cybrary_ip = "127.0.0.1";
				$cybrary_ip = "112.198.135.154";
				
				require_once "sites/all/modules/kickapps/class.xml2array.php";
				
				//$oPhotoXML = fopen("http://serve.a-feed.com/service/getFeed.kickAction?feedId=810582&as=158175", "r");
				//$oVideoXML = fopen("http://serve.a-feed.com/service/getFeed.kickAction?feedId=810583&as=158175", "r");
				
				$sPhotoXML = "";
				$sVideoXML = "";
				
				/*while (!feof($oPhotoXML)){
					//$sPhotoXML .= fread($oPhotoXML, 4096);
					$sPhotoXML .= fread($oPhotoXML, 8080);
				}
				
				while (!feof($oVideoXML)){
					//$sVideoXML .= fread($oVideoXML, 4096);
					$sVideoXML .= fread($oVideoXML, 8080);
				}*/
				
				$oPXML = new XML2Array();
				$aPhotosRaw = $oPXML->ParseXML($sPhotoXML);
				$aPhotos = $aPhotosRaw[0]["children"][0]["children"];
				
				$oVXML = new XML2Array();
				$aVideosRaw = $oVXML->ParseXML($sVideoXML);
				$aVideos = $aVideosRaw[0]["children"][0]["children"];
				
				//dump_this($aPhotos);
				?>
				
				<script type="text/javascript" src="<?php echo base_path()?>/sites/all/modules/livecam/livecam_multi.js"></script>
				<script type="text/javascript">
					$(document).ready(function() {
						$("a[id^=future_nav]").click( 
							function() {
								$(".cnavactive").removeClass("cnavactive");
								$(this).addClass("cnavactive");
								$("div[id^=content_future_nav]").hide();					
								$("#content_" + $(this).attr("id")).show();
							}
						);
						
						$("a[id^=why]").click( 
							function() {
								$("#default_why").hide();
								$("#content_" + $(this).attr("id")).show();
							}
						);
						
						$("div[id^=content_why]").click( 
							function() {
								$(this).hide();
								$("#default_why").show();
							}
						);
					});
				</script>
                
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td width="670">
							<div id="cybrary1_cbtop">
								<div class="cbb">
									<div class="jboxh">
                                        <div class="jboxhead"><h2>Welcome to Hope Cybrary</h2></div>
                                        <div class="jboxbody">
                                            <div class="jboxcontent" style="padding:5px 10px 5px 5px">
                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td colspan="2">
                                                        	Please feel free to look around and visit our Elementary School Cybraries and see our Hopefuls in action.
															We've posted photos and videos, and we even have live webcam feeds available, so you can see what's
															happening with our Hopefuls in the cybraries right now.
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                        	<hr class="divider" style="margin:10px 0 10px 0" />
															<div style="padding-left:100px;padding-bottom:10px;" id="webcamStatus"><h3 style="color:green;">- Webcams currently online -</h3></div>
															<!--<div style="padding-left:100px;padding-bottom:10px;"><h3 style="color:green;">- Webcams currently online -</h3></div>-->
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="440">
																	<!--<div id="largeWebcam"><img src="<?php echo $theme_imgpath; ?>cybrary_livewebcam.jpg" border="0" /></div>-->
																	<div id="largeWebcam"><img src="<?php echo $theme_imgpath; ?>gi_webcam_large.jpg" border="0" id="Cybrary_CamContainer" onload="cybrary_RefreshCam();" onerror="cybrary_OnError();" alt="Live Stream" width="428" height="321" /></div>
																	<div id="largeWebcam_hide" style="display:none;"><center><b>Coming Soon</b></center></div>
																</td>
                                                        <td>
                                                        	<h4 style="color:#0201fa;">Live Cybrary Webcams</h4>
                                                            We have placed webcams throughout the cybraries located in the elementary schools. 
															You may choose your cybrary view by clicking the webcam preview below. We strongly 
															believe in being open and accountable and it is in this spirit that we have positioned 
															webcams throughout our cybraries.
														</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                        	<hr class="divider" style="margin:10px 0 10px 0" />
                                                        </td> 
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
															<div style="float:left;width:300px;" id="webcamSmall1">
																<div class="cybrary_cam_thumbs" id="cam1">Cam 1<br /><img src="http://meeshc.dyndns.tv:8080/cam_1.jpg" id="StaticCam1" width="132" height="99" onclick="cybrary_RefreshCam(1);" onerror="cybrary_OnError_static(this.id);" onmouseover="this.style.cursor='pointer';" title="Click to view Cam 1" alt="Static Cam 1" /></div>
																<div class="cybrary_cam_thumbs" id="cam2">Cam 2<br /><img src="http://meeshc.dyndns.tv:8080/cam_2.jpg" id="StaticCam2" width="132" height="99" onclick="cybrary_RefreshCam(2);" onerror="cybrary_OnError_static(this.id);" onmouseover="this.style.cursor='pointer';" title="Click to view Cam 2" alt="Static Cam 2" /></div>
															</div>
															<div style="display:none;float:left;width:300px;" id="webcamSmall1_hide">
																<div class="cybrary_cam_thumbs">Cam 1<br /><center><b>Coming Soon</b></center></div>
																<div class="cybrary_cam_thumbs">Cam 2<br /><center><b>Coming Soon</b></center></div>
															</div>
															<div style="float:left;width:300px;height:130px;padding-left:15px;">
																<div style="background-color:#c6e1f2;border:1px solid #b3b3b3;width:280px;height:90px;padding:8px;">
																Click the city and school in the dropdown box to see the
																live webcam preview feeds of the cybrary of your choice<br/><br/>
																<select id="schoolSelectWebcam" name="schoolSelectWebcam" onchange="schoolWebcam(this.value);">
																	<option>Click School</option>
																	<option>-> Makati City</option>
																	<option value="1">--> Jose Magsaysay Elementary School</option>
																	<option value="2">--> Francisco Benitez Elementary School</option>
																	<option value="3" selected>--> Maximo Estrella Elementary School</option>
																</select>
																</div>
															</div>
															<div id="webcamSmall2">
																<div class="cybrary_cam_thumbs">Cam 3<br /><img src="http://meeshc.dyndns.tv:8080/cam_3.jpg" id="StaticCam3" width="132" height="99" onclick="cybrary_RefreshCam(3);" onerror="cybrary_OnError_static(this.id);" onmouseover="this.style.cursor='pointer';" title="Click to view Cam 3" alt="Static Cam 3" /></div>
																<div class="cybrary_cam_thumbs">Cam 4<br /><img src="http://meeshc.dyndns.tv:8080/cam_4.jpg" id="StaticCam4" width="132" height="99" onclick="cybrary_RefreshCam(4);" onerror="cybrary_OnError_static(this.id);" onmouseover="this.style.cursor='pointer';" title="Click to view Cam 4" alt="Static Cam 4" /></div>
																<div class="cybrary_cam_thumbs">Cam 5<br /><img src="<?php echo $theme_imgpath; ?>cybrary_livewebcam_thumb0.jpg" id="StaticCam5" width="132" height="99" onclick="" onerror="" onmouseover="" title="Cam 5 unavailable" alt="Static Cam 5" /></div>
																<div class="cybrary_cam_thumbs">Cam 6<br /><img src="<?php echo $theme_imgpath; ?>cybrary_livewebcam_thumb0.jpg" id="StaticCam6" width="132" height="99" onclick="" onerror="" onmouseover="" title="Cam 6 unavailable" alt="Static Cam 6" /></div>
															</div>
															<div style="display:none;" id="webcamSmall2_hide">
																<div class="cybrary_cam_thumbs">Cam 3<br /><center><b>Coming Soon</b></center></div>
																<div class="cybrary_cam_thumbs">Cam 4<br /><center><b>Coming Soon</b></center></div>
																<div class="cybrary_cam_thumbs">Cam 5<br /><center><b>Coming Soon</b></center></div>
																<div class="cybrary_cam_thumbs">Cam 6<br /><center><b>Coming Soon</b></center></div>
															</div>
													   </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="jboxfoot"><p></p></div>
                                    </div>
								</div>
							</div>
                            <div class="divider" style="width:100%"></div>
                            <div id="cybrary2_cbtop">
								<div class="cbb">
									<div id="cybrary_why" class="jboxh">
                                        <div class="jboxhead">
                                        	<div class="first"></div>
                                            <div style="position:relative;left:-20px;width:135px"><a id="future_nav1" class="cnavactive">Goals</a></div>
                                            <div><a id="future_nav2">Why</a></div>
                                            <div><a id="future_nav3">HopeNet</a></div>
                                            <div><a id="future_nav4">Enrollment</a></div>
                                        </div>
                                        <div class="jboxbody">
                                            <div class="jboxcontent" style="padding:5px 10px 5px 5px">
                                                <div id="content_future_nav1">
                                            		<div align="center"><a href="#"><img src="<?php echo $theme_imgpath; ?>cybrary_goals.jpg" border="0" /></a></div>
													<br />
                                                    <hr class="divider" />
                                                    The Hope Cybraries (cyber – libraries)  are the link to a past we can no longer see and the bridge to a limitless future, as yet undefined. This Cybraries represent the most democratic of institutions, established to enlighten deserving  children with access to the information they need to create the future of their choice.  The cybraries provide both real and virtual world facilities, and they are primarily designed for the use of our children, know as the Hopefuls, but the results are intended to benefit all of mankind. The cybraries merge the virtual world with the real world to provide the Hopeful's with the optimum learning, growing and life skills experience. 
                                                    <br /><p align="right"><img src="<?php echo $theme_imgpath; ?>btn_blue_learnmore.png" border="0" style="cursor:pointer;" onclick="openVisitCybraryDialog('goal_Dialog');"/></p>    	
                                                </div>
												<div>
												<div id="goal_Dialog" title="Goals" style="display:none;">
												Our real world facilities are elementary school computer labs that we have converted into  Hope Cybraries, and our virtual world facilities are powered by our HopeNet software. All of our cybrary programs are free of charge and designed to be used by elementary school children in the "Developing World", although we believe that our HopeNet software will also be highly useful to children in the "Developed World". The Hope Cybraries serve as study, research, life skills and livelihood centers for the Hopefuls. Our HopeNet software is the worlds first: collaborative, immersive, multi purpose, web-based, knowledge platform, for children delivered in 42 languages.
												<br/><br/>
												For 2011 we are trialing our HopeNet software platform through the establishment of Hope Cybraries in selected elementary schools located in Makati Philippines. However, in 2012 we shall begin offering our services to elementary schools throughout Manila and the rest of the Philippines, and thereafter we shall expand our reach to schools globally, including libraries and qualified Internet cafe's.
												<br/><br/>
												The Cybraries are equipped with modern Pentium class computers with high-speed internet access. The Hopefuls, under the supervision of a cybrarian (librarian), can work individually or with assistance of an online tutor to research and prepare their homework, assignments, and special projects. The cybraries provide both online and offline access to the best educational websites and software. 
												</div>

                                                <div id="content_future_nav2" style="display:none">
                                            		<div id="default_why">
                                                        <!--<div class="cybrary_why_thumb"><a id="why1"><img src="<?php echo $theme_imgpath; ?>cybrary_why_close1.jpg" border="0" /></a></div>
                                                        <div class="cybrary_why_plus"><img src="<?php echo $theme_imgpath; ?>cybrary_why_plus.gif" border="0" /></div>
                                                        <div class="cybrary_why_thumb"><a id="why2"><img src="<?php echo $theme_imgpath; ?>cybrary_why_close2.jpg" border="0" /></a></div>
                                                        <div class="cybrary_why_plus"><img src="<?php echo $theme_imgpath; ?>cybrary_why_plus.gif" border="0" /></div>
                                                        <div class="cybrary_why_thumb"><a id="why3"><img src="<?php echo $theme_imgpath; ?>cybrary_why_close3.jpg" border="0" /></a></div>
                                                        <br /><br />
                                                        
														<div class="cybrary_why_thumb2" align="center">
                                                            <img align="absmiddle" class="cybrary_why_equals" src="<?php echo $theme_imgpath; ?>cybrary_why_equals.gif" border="0" />
                                                            <a id="why4"><img src="<?php echo $theme_imgpath; ?>cybrary_why.jpg" border="0" /></a>
                                                        </div>-->
														<div align="center">
															<img src="<?php echo $theme_imgpath; ?>gi_why_visit.jpg" border="0" />
														</div>
														<br />
														<hr class="divider" />
                                                        <div>
															Why Cybraries<br/><br/>
                                                        	The right of private judgment presupposes a judgment to judge with. This presupposes knowledge, and knowledge is the result of education. Triumph of Democracy - 1888
															<br/><br/>
															The primary mission of the Hope Cybraries is to provide the Hopefuls with access to the planet's best knowledge. Knowledge is defined as: ”the sum of what is known.“ Knowledge is the most valuable commodity on earth (save wisdom) and is the key factor in determining success.
															<br/><br/>				
															Success is achieved through the acquisition and application of skills, and skills are obtained in part through literacy and education. However, in the developing world there exists a substantial gap between literacy, education and the skills necessary to obtain success, and that gap can only be filled by access to knowledge. 
															<br /><p align="right"><img src="<?php echo $theme_imgpath; ?>btn_blue_learnmore.png" border="0" style="cursor:pointer;" onclick="openVisitCybraryDialog('why_Dialog');"/></p>    
													   </div>
													   <div id="why_Dialog" title="Why" style="display:none;">
													   The Hope Cybrary and its services such at the Knowledge Portal are designed to bridge the gap between education and the skills necessary to sustain a successful livelihood. From a learning standpoint the road to a successful livelihood for the Hopefuls begins with education, but education doesn't provide a direct route to success. To achieve success the Hopefuls must first cultivate their education into knowledge and then their knowledge into skills. Knowledge is the key component and it is this component that is most often the issue, especially in the developing world. The Hopefuls skills are harvested from their knowledge and the quality of the Hopefuls knowledge is dependent upon their studies, internalization of knowledge and a crucial and often missing component which is ready-access to high quality knowledge-warehouses (libraries).
														<br/><br/>
													 Teachers understand the process required to turn information into knowledge, and that is why they assign homework to their students. Homework gives the students the opportunity to process the educational information and internalize it so that it becomes useful knowledge. However the process of study and internalization must be accompanied by access to knowledge tools, and class notes and textbooks alone are not sufficient knowledge tools. The Hopefuls also need access to knowledge-warehouses and that is the purpose of libraries. However as stated in this document public libraries are few and far between in the developing world, and we believe that there is a direct correlation between prosperity and access to knowledge warehouses.
													   </div>
                                                    </div>
                                                    <div id="content_why1" align="center" style="display:none;cursor:pointer">
                                                    	<img src="<?php echo $theme_imgpath; ?>cybrary_why_large1.jpg" border="0" />
                                                    </div>
                                                    <div id="content_why2" align="center" style="display:none;cursor:pointer">
                                                    	<img src="<?php echo $theme_imgpath; ?>cybrary_why_large2.jpg" border="0" />
                                                    </div>
                                                    <div id="content_why3" align="center" style="display:none;cursor:pointer">
                                                    	<img src="<?php echo $theme_imgpath; ?>cybrary_why_large3.jpg" border="0" />
                                                    </div>
                                                    <div id="content_why4" align="center" style="display:none;cursor:pointer">
                                                    	<img src="<?php echo $theme_imgpath; ?>cybrary_why_large4.jpg" border="0" />
                                                    </div>
                                                </div>
                                                <div id="content_future_nav3" style="display:none">
                                            		<!--<div align="center"><a href="#"><img src="<?php echo $theme_imgpath; ?>cybrary_programs.jpg" border="0" /></a></div>
													-->
													<div align="center">
															<img src="<?php echo $theme_imgpath; ?>gi_hopenet_visit.jpg" border="0" />
													</div>
													<br />
													<hr class="divider" />
													HopeNet is the world's first collaborative, immersive, multi purpose web-based, knowledge platform for children, delivered in 42 languages. HopeNet provides among it's numerous features -
													<br/><br/>
													<div style="clear:both;">
														<div style="float:left;">
															 <ul type="circle" style="list-style-type: circle;">
															  <li>Knowledge Portal</li>
															  <li>eTutoring</li>
															  <li>eMentoring</li>
															  <li>Community Building</li>
															  </ul>
														</div>
														<div style="float:left;width:50px;">
														&nbsp;
														</div>
														<div style="float:left;">
															<ul type="circle" style="list-style-type: circle;">
															   <li>MyBank Account</li>
															  <li>eLivelihood</li>
															  <li>Entertainment Portal</li>
															  <li>Peace Building (kindness, virtues, spirituality)</li>
															</ul>
														</div>
														<div>&nbsp;</div>
													</div>
                                                    <!--The Cybrary is equipped with Pentium class computers with high-speed internet acceess. The children, under the supervision of a Librarian, can work individually or with assistance of a tutor to research and prepare their homework, assignments, and special projects. We provide both online and offline access to the best educational websites and software. Throught he use of Infofrmation Technology, we hope to inspire the children to create a future of their choice.
                                                    -->
													<br /><p align="right"><img src="<?php echo $theme_imgpath; ?>btn_blue_learnmore.png" border="0" style="cursor:pointer;" onclick="openVisitCybraryDialog('hopenet_Dialog');"/></p>    	
                                                </div>
												<div id="hopenet_Dialog" title="HopeNet" style="display:none;">										
												HopeNet will be the first program to provide real-time, one-to-one contact between the Hopefuls and their eTutors, eMentors and sponsors using email, chat-messaging, 3-D virtual world's, and video and voice conferencing. However, HopeNet is much more than a two-way window to social communications, we believe that it will serve as a mechanism for the social evolution of mankind. In short the HopeNet technology will provide a means for the Hopefuls to learn, grow and develop themselves into role models of hope for the potential of all of us.
												<br/><br/>
												The HopeNet software will enable any facility with computer/Internet access to become a virtual Cybrary. HopeNet is a one-of-a-kind endeavor – it's part “social network,” and part “social cause,” and by putting the “cause” and “network” together we believe we are laying the groundwork for a “social evolution.”
												</div>
                                                <div id="content_future_nav4" style="display:none">
                                            		<div align="center">
															<img src="<?php echo $theme_imgpath; ?>gi_enrollment_visit.jpg" border="0" />
													</div>
													<br />
													<hr class="divider" />
													Prior to using Cybrary facilities, each child must become a Hopeful (member of HopeNet) and complete a Screening, In-processing and Familiarization program. Our goal is to foster an environment where the hopefuls are rewarded for ethical behavior, and community service. Upon completing the Screening process, filling out an application and completing 3 good deeds of community service, the child will be initially issued a temporary Cybrary card. Although a child may be barred from the program for disciplinary or other violations, they will be given opportunities to reapply for membership upon successfully overcoming the obstacle or atoning for their indiscretion.
                                                    <br /><p align="right"><img src="<?php echo $theme_imgpath; ?>btn_blue_learnmore.png" border="0" style="cursor:pointer;" onclick="openVisitCybraryDialog('enrollment_Dialog');"/></p>    	
                                                </div>
												<div id="enrollment_Dialog" title="Enrollment" style="display:none;">		
												The Screening program evaluates the children based upon the following:
												<br/><br/>	
												<u><b>Age:</b></u> Our Cybrary is primarily designed for elementary school children ages 7-12
												<br/><br/>
												<u><b>Health:</b></u> Before entering the Cybrary, each child is required to have clean clothes and have acceptable hygiene.
												<br/><br/>
												<u><b>Geographic location:</b></u> The Hope Cybraries are community-based facilities,located in public elementary schools, and are intended to be supported by the local Barangay(s). Admittance will be restricted to Hopefuls that attend the elementary school.
												<br/><br/>
												<u><b>Economic Status:</b></u> “The last shall be first and the first shall be last.” Cybrary availability will establish priority to Hopefuls of the lowest economic status, but also allowing Hopefuls of higher economic status to use the facility, based upon their demonstrated community service virtues.
												<br/><br/>
												<u><b>Virtues:</b></u> Virtues are the key admittance factor to the Cybrary. Those Hopefuls who are the best behaved and have a history of community service will be given first priority. Hopefuls who demonstrate behavioral problems or who break the Cybrary rules will not be admitted, until they resolve their issues and atone through community service. 
												</div>
                                            </div>
                                        </div>
                                        <div class="jboxfoot"><p></p></div>
                                    </div>
								</div>
							</div>
                        </td>
						<td class="dividervg" style="width:5px">
						</td>
						<td style="padding:3px 2px 3px 5px;">
                        	<div id="cybrary_right">
                            	<div class="jboxh">
                                    <div class="jboxhead"><h2>Location Map</h2></div>
                                    <div class="jboxbody">
                                        <div class="jboxcontent" style="text-align:center">
                                             <!--<iframe width="243" height="209" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps/ms?ie=UTF8&amp;hl=en&amp;msa=0&amp;msid=109207342181459026806.00046f1d93c75f8ce2eea&amp;ll=14.570293,121.018932&spn=0.005514,0.010568&amp;z=15&amp;output=embed"></iframe>
                                            <br /><p align="right"><a style="text-decoration:none;margin-top:10px" href="http://maps.google.com/maps/ms?ie=UTF8&amp;hl=en&amp;msa=0&amp;msid=109207342181459026806.00046f1d93c75f8ce2eea&amp;ll=14.568195,121.017687&amp;spn=0.007269,0.00912&amp;z=16&amp;output=embed" target="_blank">View Larger Map</a></p>	-->				
											<iframe width="243" height="209" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps/ms?ie=UTF8&amp;hl=en&amp;msa=0&amp;msid=109207342181459026806.00046f1d93c75f8ce2eea&amp;ll=14.57755075222635,121.0177731513977&spn=0.005514,0.010568&amp;z=15&amp;output=embed"></iframe>
                                            <br /><p align="right"><a style="text-decoration:none;margin-top:10px" href="http://maps.google.com/maps/ms?ie=UTF8&amp;hl=en&amp;msa=0&amp;msid=109207342181459026806.00046f1d93c75f8ce2eea&amp;ll=14.57755075222635,121.0177731513977&amp;spn=0.007269,0.00912&amp;z=16&amp;output=embed" target="_blank">View Larger Map</a></p>
										</div>
                                    </div>
                                    <div class="jboxfoot"><p></p></div>
                                </div>
                            	<hr class="divider" />
                                <div class="jboxh">
                                    <div class="jboxhead"><h2>Videos</h2></div>
                                    <div class="jboxbody">
                                        <div class="jboxcontent" style="text-align:center">
                                            <table class="cybrary_thumbs">
                                            	<tr>
                                                	<td>
															<?php
															for ($v=12; $v<count($aVideos); $v++){
																if ($v < 24){
																	$aVideo = $aVideos[$v]["children"];
																	$sTitle = $aVideo[0]["tagData"];
																	$sDesc = (isset($aVideo[2]["tagData"])) ? $aVideo[2]["tagData"]:"";
																	$sVideoPath = $aVideo[4]["attrs"]["URL"];
																	
																	for ($vv=9; $vv<=10; $vv++){
																		if ($aVideo[$vv]["name"] == "MEDIA:CONTENT"){
																			for ($vvv=0; $vvv<count($aVideo[$vv]["children"]); $vvv++){
																				if ($aVideo[$vv]["children"][$vvv]["name"] == "MEDIA:THUMBNAIL" && $aVideo[$vv]["children"][$vvv]["attrs"]["WIDTH"] == 48){
																					$sVideoThumb = $aVideo[$vv]["children"][$vvv]["attrs"]["URL"];
																					$bResize = (substr($sVideoThumb, -9) == "48X48.jpg") ? false:true;
																					
																					break;
																				}
																			}
																			
																			break;
																		}
																	}
																	
																	echo '<a href="'.$sVideoPath.'" rel="lightvideo[ka_videos]" title="'.htmlentities($sTitle.''.(($sDesc != "") ? "<br/><span style='font-weight:normal;'>".$sDesc."</span>":""), ENT_QUOTES).'"><div style="width:48px; height:48px; text-align:center; border:3px double #ACACAC;"><img style="border:0; vertical-align:middle; '.(($bResize) ? "width:48px; height:48px;":"").'" src="'.$sVideoThumb.'" border="0" title="'.$sTitle.''.(($sDesc != "") ? " - ".$sDesc:"").'" /></div></a>';
																}else{
																	break;
																}
															}
															?>
                                            		</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="jboxfoot"><p></p></div>
                                </div>
                            	<hr class="divider" />
                                <div class="jboxh">
                                    <div class="jboxhead"><h2>Photos</h2></div>
                                    <div class="jboxbody">
                                        <div class="jboxcontent">
													<table class="cybrary_thumbs">
														<tr>
															<td>
															<?php
															for ($p=12; $p<count($aPhotos); $p++){
																if ($p < 24){
																	$aPhoto = $aPhotos[$p]["children"];
																	$sTitle = $aPhoto[0]["tagData"];
																	$sDesc = (isset($aPhoto[2]["tagData"])) ? $aPhoto[2]["tagData"]:"";
																	$sPhotoPath = $aPhoto[4]["attrs"]["URL"];
																	$sPhotoThumb = $aPhoto[9]["children"][9]["attrs"]["URL"];
																	
																	for ($pp=9; $pp<=10; $pp++){
																		if ($aPhoto[$pp]["name"] == "MEDIA:CONTENT"){
																			for ($ppp=0; $ppp<count($aPhoto[$pp]["children"]); $ppp++){
																				if ($aPhoto[$pp]["children"][$ppp]["name"] == "MEDIA:THUMBNAIL" && $aPhoto[$pp]["children"][$ppp]["attrs"]["WIDTH"] == 48){
																					$sPhotoThumb = $aPhoto[$pp]["children"][$ppp]["attrs"]["URL"];
																					$bResize = (substr($sPhotoThumb, -9) == "48X48.jpg") ? false:true;
																					
																					break;
																				}
																			}
																			
																			break;
																		}
																	}
																	
																	echo '<a href="'.$sPhotoPath.'" rel="lightbox[ka_photos]['.htmlentities($sTitle.''.(($sDesc != "") ? "<br/><span style='font-weight:normal;'>".$sDesc."</span>":""), ENT_QUOTES).']"><div style="width:48px; height:48px; text-align:center; border:3px double #ACACAC;"><img style="border:0; vertical-align:middle; '.(($bResize) ? "width:48px; height:48px;":"").'" src="'.$sPhotoThumb.'" border="0" title="'.$sTitle.''.(($sDesc != "") ? " - ".$sDesc:"").'" /></div></a>';
																}else{
																	break;
																}
															}
															?>
															</td>
														</tr>
													</table>
                                        </div>
                                    </div>
										<div class="jboxfoot"><p></p></div>
                                </div>
								
                            	<!--<hr class="divider" />
									<div class="jboxh">
										<div class="jboxhead"><h2>Who's Online</h2></div>
										<div class="jboxbody">
											<div class="jboxcontent">-->
												<?php
												// Count users active within the defined period.
												//$interval = time() - variable_get('user_block_seconds_online', 900);

												// Perform database queries to gather online user lists.  We use s.timestamp
												// rather than u.access because it is much faster.
												//$anonymous_count = sess_count($interval);
												//$authenticated_users = db_query('SELECT DISTINCT u.uid, u.name, s.timestamp FROM {users} u INNER JOIN {sessions} s ON u.uid = s.uid WHERE s.timestamp >= %d AND s.uid > 0 GROUP BY u.uid ORDER BY s.timestamp DESC', $interval);
												//$authenticated_count = 0;
												//$max_users = variable_get('user_block_max_list_count', 10);
												//$items = array();
												
											//	while ($account = db_fetch_object($authenticated_users)) {
													//if ($max_users > 0) {
													//	$items[] = $account;
													//	$max_users--;
													//}
													
												//	$authenticated_count++;
											//}

												// Format the output with proper grammar.
												//if ($anonymous_count == 1 && $authenticated_count == 1) {
													//$sOutput = t('There is currently %members and %visitors online.', array('%members' => format_plural($authenticated_count, '1 user', '@count members'), '%visitors' => format_plural($anonymous_count, '1 guest', '@count guests')));
												//}else{
													//$sOutput = t('There are currently %members and %visitors online.', array('%members' => format_plural($authenticated_count, '1 user', '@count members'), '%visitors' => format_plural($anonymous_count, '1 guest', '@count guests')));
												//}

												// Display a list of currently online users.
												//$max_users = variable_get('user_block_max_list_count', 10);
												
												//if ($authenticated_count && $max_users) {
												//	$sOutput .= '<br />'.theme('user_list', $items, t('Online members'));
												//}
												
											//	echo $sOutput;
												?>
											<!--There are currently <span class="bluebold">2</span> users and <span class="bluebold">6</span> guests online
											<br />
											<h2>Online Users</h2>
											Test 1<br />
											hope_test<br />-->

							<!--				</div>
										</div>
										<div class="jboxfoot"><p></p></div>
									</div> -->
                            	<hr class="divider" />
                                <div class="jboxh">
										<div class="jboxhead"><h2>In the Cybrary Now</h2></div>
										<div class="jboxbody">
											<div class="jboxcontent">
												<?php
												/*
												$iInterval = time() - variable_get('user_block_seconds_online', 900);
												$iNow = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
												$aChildren = array();
												$aChildrenFilter = array();
												$aChildrenOnline = array();
												$aChildrenDetails = array();
												
												$oAuthUsers = db_query("SELECT DISTINCT u.uid, u.name, u.mail, u.picture, s.timestamp FROM {users} u INNER JOIN {sessions} s ON u.uid = s.uid WHERE s.timestamp >= %d AND s.uid > 0 AND s.hostname = '" . $cybrary_ip . "' ORDER BY s.timestamp DESC", $iInterval);
												$oChildren = db_query("SELECT A.uid, A.mail, B.value FROM {users} A INNER JOIN {profile_values} B ON B.uid = A.uid WHERE A.uid > 1 	AND A. status = 1 AND B.fid = 5");
													
												while ($oTotalChildren = db_fetch_object($oChildren)){
													$aDOB = unserialize($oTotalChildren->value);
													$iDOB = mktime(0, 0, 0, $aDOB["month"], $aDOB["day"], $aDOB["year"]);
													$iYear = floor(($iNow  - $iDOB) / (60*60*24*365));
													
													if ($iYear <= 12){
														$iChildId = $oTotalChildren->uid;
														$aChildrenFilter[] = $iChildId;
														
														$sqlChild = "SELECT uid, name, mail, picture FROM {users} WHERE uid = %d ORDER BY uid";
														$oChild = db_query($sqlChild, $iChildId);
														$aChildren[] = db_fetch_object($oChild);
														
														$sqlDetails = "SELECT fid, value
																		FROM profile_values
																		WHERE fid IN (15, 45, 46, 47, 48)
																			AND uid = %d";
														
														$oDetails = db_query($sqlDetails, $iChildId);
														
														$aTemp = array();
														$aTemp["uid"] = $iChildId;
														
														while ($oDetail = db_fetch_object($oDetails)){
															if ($oDetail->fid == 15) $aTemp["income"] = number_format($oDetail->value, 2);
															if ($oDetail->fid == 45) $aTemp["language"] = $oDetail->value;
															if ($oDetail->fid == 46) $aTemp["talent"] = $oDetail->value;
															if ($oDetail->fid == 47) $aTemp["favorite"] = $oDetail->value;
															if ($oDetail->fid == 48) $aTemp["lives_with"] = $oDetail->value;
														}
														
														$aChildrenDetails[] = $aTemp;
													}
												}
												
												$iCount = 0;
												
												while ($oAccount = db_fetch_object($oAuthUsers)){
													if (in_array($oAccount->uid, $aChildrenFilter)){
														$iCount++;
														echo $oAccount->name."<br/>";
														
													}
												}
												
												if ($iCount == 0) echo 'There are no children online in the Cybrary, yet.';*/
												?>
												
												<?php
												$interval = time() - variable_get('user_block_seconds_online', 900);
												$anonymous_count = sess_count($interval);
												?>
												<div id="cybraryOnlineNow">
													<span style="color:black;">There are now <label id="hopefulstotal"></label> Hopeful(s), <label id="volunteerstotal"></label> Volunteer(s) online and <?=format_plural($anonymous_count, '1 guest', '@count guests')?> in <label id="cybrariestotal"></label> <label id="cybrariesTerm"></label></span>
													<br/><br/>
													<select id="schoolSelectOnline" name="schoolSelectOnline" onchange="tempchangeschool(this.value);">
														<option>Click School</option>
														<option value="" selected>-> Makati City</option>
														<option value="Jose Magsaysay Elementary School">--> Jose Magsaysay Elementary School</option>
														<option value="Francisco Benitez Elementary School">--> Francisco Benitez Elementary School</option>
														<option value="Maximo Estrella Elementary School">--> Maximo Estrella Elementary School</option>
													</select>
													<br/>
													<div id="childList"></div>
													<div id="inCybrary_hopeful_nav" style="padding-top:10px;"></div>
													<div id="volunteerList"></div>
													<div id="inCybrary_volunteer_nav" style="padding-top:10px;"></div>
													<div id="tempList" style="display:none;"><br/>There are no children online in the Cybrary for this school, yet.</div>
												</div>
											</div>
										</div>
										<div class="jboxfoot"><p></p></div>
                                </div>
                            	<hr class="divider" />
                                <div class="jbox">
                                    <div class="jboxhead"><h2></h2></div>
                                    <div class="jboxbody">
                                        <div class="jboxcontent">
                                            <table>
                                            	<tr>
                                                	<td width="102"><img src="<?php echo $theme_imgpath; ?>cybrary_globe.jpg" border="0" /></td>
                                                    <td align="right" class="bluebold">
                                                    	<div style="font-size:18px">HopeNet</div>
                                                        <div style="background-color:#69f;height:2px;width:100%"></div>
                                                        <div style="font-size:14px">The Power of Hope</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                	<td colspan="2">
														<div style="height:40px;padding-top:5px;color:black;">
                                                    	HopeNet is the world's first collaborative, immersive, multi purpose web-based, knowledge platform
														for children, delivered in 42 languages.
														</div>	
														<br /><p align="right"><img src="<?php echo $theme_imgpath; ?>btn_blue_learnmore.png" border="0" /></p>
													</td>
                                                </tr>
                                           </table>        
                                        </div>
                                    </div>
                                    <div class="jboxfoot"><p></p></div>
                                </div>
                            </div>
                        </td>
					</tr>
				</table>
			
