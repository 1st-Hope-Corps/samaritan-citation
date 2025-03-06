<script type="text/javascript">
function validate_team(){
	if ($("#tm_name").val() == "") {
		alert( "Please enter your preferred team name." );
		$("#tm_name").focus();
		return false ;
	} else if( $("#tm_category").val() == "") {
		alert( "Please select a category." );
		$("#tm_name").focus();
		return false ;
	} else if ($("#tm_location").val() == "") {
		alert( "Please enter your preferred team location." );
		$("#tm_name").focus();
		return false ;
	} else if ($("#tm_url").val() == "") {
		alert( "Please enter your Landing team page url." );
		$("#tm_url").focus();
		return false ; 
	} else {
		$("#tm-form").submit();
	}
}
$(document).ready(
	function(){		
	
	$("#searchteam").click(
				function(){
					var str = $('#searchvalue').val();
					location.href = "<?php echo base_path()?>" + 'mystudies/getinvolved/adopt/school/invest-teams?search='+str.replace(' ', '-');
				}
	);
	
	$("#tm_name").keyup(
			function(){
				var str = $("#tm_name").val();
				var str2 = str.replace(' ', '-');
				var str3 = str2.replace(' ', '-');
				$("#tm_url").val(str3);
			}
	);
	
	$("#start_team").click(
				function(){
					$("#loading-invest").show();
					$.post(
						"/sponsor/checkaccount",
						{ type : "start" },
						function(sReply){
							var oReturn = sReply.RETURN;
							//if(oReturn == 'sponsor'){
								
								$("#startteam_Dialog").dialog({
										modal: true,
										autoOpen: true,
										resizable: false,
										width: 890,
										buttons: {
											"Save Team": function(){
											validate_team();
											}
										}
								});
							/*	
							} else{
								
								$("#startteam_failed_Dialog").dialog({
										modal: true,
										autoOpen: true,
										resizable: false,
										width: 410,
										height: 150,
										buttons: {
											"Close": function(){
												$(this).dialog("close");
											}
										}
								});
							}*/
							$("#loading-invest").hide();
						},
						"json"
					);
				}
			); 
			
	<?php
$query_teams = db_query("select * from invest_team where joinstatus = 1 order by team_id ASC");
$countteamdialog = 1;
	while($set_team = db_fetch_object($query_teams)){
	
		echo '$("#page_btnTeam'.$countteamdialog.'").click(
			function(){
				$("#team'.$countteamdialog.'_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 490,
						buttons: {
							"Learn More": function(){
							location = "/adopt-team/'.$set_team->url.'";
							},
							"Close": function(){
							$(this).dialog("close");
							}
						}
				});
			}
			); ';
			
		$countteamdialog++;
	}
?>		
               
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
										<img src="<?php echo base_path()?>themes/theme2010/images/team_hope_adoption.png" />
									</td>
									<?php
									$nodeids = '1769';
									$nodearray = instant_getContent($nodeids);		
									?>
									<td valign="top" style="padding-left:12px;">
										<h4 style="color:#20f42d;font-size:24px;"><?=$nodearray['1769']['title']?> <label style="font-size:11px;color:#195ca1;display:none;" id="loading-invest">loading</label></h4><h4 style="color:#ff0000;font-size:20px;">Under Construction</h4>
										<?=$nodearray['1769']['body']?>
										<div style="clear:both;padding-top:12px;">
											<div style="float:left;width:20%;">
													<div style="background:url(/themes/theme2010/images/team-sponsor-button.png);width:132px;height:32px;cursor:pointer;" onclick="location = '/adopt-team/viewteam';">
													 <div style="padding-top:8px;"><span style="color:black;cursor:pointer;"><center><b>View My Team</b></center></span></div>
													</div>
											</div> 
											<div style="float:left;width:2%;">&nbsp;</div>
											<div style="float:left;width:20%;">
													<div style="background:url(/themes/theme2010/images/team-sponsor-button.png);width:132px;height:32px;cursor:pointer;"  onclick="location ='/adopt-team/jointeam';">
													 <div style="padding-top:8px;"><span style="color:black;cursor:pointer;"><center><b>Join A Team</b></center></span></div>
													</div>
											</div> 
											<div style="float:left;width:2%;">&nbsp;</div>
											<div style="float:left;width:20%;">
													<div style="background:url(/themes/theme2010/images/team-sponsor-button.png);width:132px;height:32px;cursor:pointer;" id="start_team">
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
											<!--<img src="/themes/theme2010/images/search-team-sponsor.png" />-->
											<div style="background-color:#639d39;padding:10px;width:690px;clear:both;">
												<div style="clear:both;">&nbsp;</div>
												<div style="float:left;"><input type="text" id="searchvalue" name="searchvalue" style="background-image:url('/themes/theme2010/images/magnifier.png');background-repeat:no-repeat;height:20px;width:500px;-moz-border-radius: 10px;padding:5px 5px 5px 25px;" value="<?=str_replace('-', ' ', $_GET['search'])?>" /></div>
												<div style="float:left;padding-left:12px;"><img src="<?php echo base_path()?>themes/theme2010/images/searchteams.png" border="0" id="searchteam" name="searchteam" style="cursor:pointer;"/></div>
												<div style="clear:both;">&nbsp;</div>
											</div>
											<div style="clear:both;">&nbsp;</div>
											<div style="padding-top:12px;padding-bottom-12px;color:black;">
												<div><b style="padding-left:50px;color:#609d35;font-size:15px;">Team Listing</b> &nbsp;&nbsp;&nbsp; 
												<b><?php
												
												
												if($_GET['search'] != ''){
												//echo '<b>0</b> Investment <b>1</b> Team Members';
												} else{
												$investmeantteams = db_result(db_query("select count(team_id) from invest_team where joinstatus = 1"));
												$investmeantmembers = db_result(db_query("select count(distinct a.uid) from hope_teamusers a inner join invest_team b on b.kickappsteam_id = a.team_id"));
												
												echo '<b>'.$investmeantteams.'</b> Investment teams in all categories &nbsp;&nbsp; <b>'.$investmeantmembers.'</b> Team Members';
												}
												
												?>
												</div>
												<div style="padding-left:150px;padding-top:12px;">
												<select id="category-search" onchange="location.href="<?php echo base_path()?>mystudies/getinvolved/adopt/school/invest-teams?sort="+this.value">
												<option>- All Categories -</option>
												<option value="family">Family</option>
												<option value="friends">Friends</option>
												<option value="business">Business</option>
												<option value="education">Education</option>
												<option value="relgious">Religious</option>
												<option value="alumni group">Alumni Group</option>
												<option value="other">Other</option>
												</select> 
												
												
												&nbsp;&nbsp;&nbsp; Sort by: <select><option>Total Invested</option></select></div>
											
											</div>
											<div>&nbsp;</div>
											<ul id="mycarousel" class="jcarousel-skin-sponsors-teams"> 
											
											<?php
											if($_GET['search'] != ''){
											$query_teams = db_query("select * from invest_team where team_name like '%".str_replace('-', ' ', $_GET['search'])."%' order by team_id ASC");
											} else if($_GET['sort'] != ''){
											$query_teams = db_query("select * from invest_team where category like '%".str_replace('-', ' ', $_GET['sort'])."%' order by team_id ASC");
											} else{
											$query_teams = db_query("select * from invest_team where joinstatus = 1 order by team_id ASC");
											}
											
											$countteam = 1;
											while($set_team = db_fetch_object($query_teams)){
											echo '<li>
													<div style="border: #6cfc67 5px solid;-moz-border-radius: 10px;">
														<h4>'.$set_team->team_name.'</h4>
														<div style="height:107px;cursor:pointer" id="page_btnTeam'.$countteam.'">
															<a href="javascript:void(0);"><img src="http://www.hopecybrary.org/imgdisplay.php?id='.$set_team->team_id.'" width="76" height="78" /></a>
														</div>
														<div>&nbsp;</div>';
											$invest = db_result(db_query("select SUM(amount) from invest_donations where adopt_team = '".$set_team->team_id."'"));
											
											if($invest == ''){
											$invest = 0;
											} else{
											$invest = $invest;
											}
											
											echo '<center style="color:black;">$'.$invest.' Invested</center>
														<div>&nbsp;</div>
													</div>
													<div>&nbsp;</div>
												</li>';
											$countteam++;
											}
											
											?>
											</ul>	
											
											<div align="center" style="clear:both;width:900px;padding-top:20px;padding-left:70px;color:black;">
												<div style="float:left;width:40%;padding-right:35px;">
													<div style="border: #a2a2a2 2px solid;-moz-border-radius: 10px;clear:both;">
														<div style="padding-top:15px;"><center><h1>Top Investment Teams</h1></center></div>
														<div style="padding-top:5px;">
														<div style="display:block;">
														<script>
														$(function() {
															$( "#tabstopinvestments" ).tabs();
															$(".ui-widget-content").attr("style",'border:0;');
															$(".ui-widget-header").attr("style",'border-bottom:1px #def0d6 thin;background:;color:#4b711c;');
															$(".ui-widget-header").removeClass('ui-widget-header');
															$("#topinvestul").attr("style","border-bottom:thin solid #639d39;");
															$(".ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active").attr("style","border:1px solid #6cfc67;");
															$(".ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default").attr("style","border:1px solid #639d39;");
														});
														</script>
														<div class="demo">

<div id="tabstopinvestments">
	<ul id="topinvestul">
		<li><a href="#tabs-1">This Month</a></li>

		<li><a href="#tabs-2">Last Month</a></li>
		<li><a href="#tabs-3">All Time</a></li>
	</ul>
	<div id="tabs-1">
	<?php
	$currentmonth = date("F",time());
	echo sponsor_get_top_sponsors($currentmonth);
	?>
	<div style="clear:both;">&nbsp;</div>																
	</div>
	<div id="tabs-2">
	<?php
	$previousmonth = date("F",strtotime("-1 Months"));
	echo sponsor_get_top_sponsors($previousmonth);
	?>
	<div style="clear:both;">&nbsp;</div>	
	</div>
	<div id="tabs-3">
		<?php
		$query_teams = db_query("select distinct B.team_id, B.team_name, B.photo, A.adopt_team from invest_donations A left join invest_team B on B.team_id = A.adopt_team limit 5");
		
		$team_top = array();		
		while($set_teams = db_fetch_object($query_teams)){
			$sumdonation = db_result(db_query("select SUM(amount) from invest_donations where adopt_team = '".$set_teams->adopt_team."'"));
			$team_top[$set_teams->adopt_team] = $sumdonation;
		}
		arsort($team_top);
		$pxline = 200;
		foreach($team_top as $teamid => $donationval) {
			$team_name = db_result(db_query("select team_name from invest_team where team_id = '".$teamid."'"));
			echo '<div style="clear:both;padding:10px;">';
			echo '<div style="float:left;padding-right:8px;height:58px;width:56px;">';
			echo '<img src="http://www.hopecybrary.org/imgdisplay.php?id='.$teamid.'" width="56" height="58" />';
			echo '</div>';
			echo '<div style="float:left;padding-top:5px;" align="left">';
			echo '<p style="color:#2d8eb1;">'.ucwords($team_name).'</p>';
			echo '<p style="padding:3px;background-color:#aac87e;width:'.$pxline.'px;">$'.$donationval.'</p>';
			echo '</div>';
			echo '</div><div style="clear:both;padding:10px;"><hr style="border:thin dotted #e7e7e7;"></div>';
			$pxline = $pxline - 30;
		}
		?>
	 <div style="clear:both;">&nbsp;</div> 
	</div>
</div>

</div>
														</div>
														<div style="clear:both;">&nbsp;</div>
														</div>
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
				
				<?php
				
				$query_teams = db_query("select * from invest_team where joinstatus = 1 order by team_id ASC");
											
											$countteammore = 1;
											while($set_team = db_fetch_object($query_teams)){
											echo '<div id="team'.$countteammore.'_Dialog" title="'.$set_team->team_name.'" style="display:none;" align="center">
													<table width="470" border="0" cellspacing="0" cellpadding="2" style="border: #6cfc67 2px solid;">
																  <tr>
																	<td width="200" align="center" valign="top">
																		<br/><img src="http://www.hopecybrary.org/imgdisplay.php?id='.$set_team->team_id.'" width="76" height="78" /><br/> Team Tagline:'.$set_team->tagline.'
																	</td>';
																	
											$invest = db_result(db_query("select SUM(amount) from invest_donations where adopt_team = '".$set_team->team_id."'"));
											$teamcount = db_result(db_query("select count(uid) from hope_teamusers where team_id = '".$set_team->kickappsteam_id."'"));
											
											$invest = $invest = 0 ? 0 : $invest;	
											$teamcount = $teamcount = 0 ? 0 : $teamcount;	
											
													echo '<td valign="top">
																		<div style="padding-left:5px;">'.$teamcount.' members <br/><br/> Based in '.$set_team->location.' <br/><br/> Formed in '.date('Y', $set_team->datecreated).' <br/><br/> <b>$'.$invest.'</b> </div>
																	</td>
																  </tr>
													</table>
												</div>';
											$countteammore++;
											}
				
				?>          
                                
<div id="startteam_Dialog" title="Start a New Investment Team" style="display:none;" align="center">
					<div style="clear:both;">
					<form action="/create-team" method="post" enctype="multipart/form-data" id="tm-form" name="tm-form">
						<div style="float:left;width:30%;" align="right">Team Name :*</div>
						<div style="float:left;width:3%;">&nbsp;</div>
						<div style="float:left;width:50%;" align="left"><input type="textbox" value="" id="tm_name" name="tm_name" /></div>
						<div style="margin:15px;">&nbsp;</div>

						<div style="float:left;width:30%;" align="right">Category :*</div>
						<div style="float:left;width:3%;">&nbsp;</div>
						<div style="float:left;width:50%;" align="left">
							<select id="tm_category" name="tm_category">
								<option value="family">Family</option>
								<option value="friends">Friends</option>
								<option value="business">Business</option>
								<option value="education">Education</option>
								<option value="religious">Religious</option>
								<option value="other">Other</option>
							</select>
						</div>
						<div style="margin:15px;">&nbsp;</div>
						
						<div style="float:left;width:30%;" align="right">Upload Photo :</div>
						<div style="float:left;width:3%;">&nbsp;</div>
						<div style="float:left;width:50%;height:70px;" align="left"><input type="file" value="" id="tm_photo" name="tm_photo" /><br/>Photos should be .gif, .jpg or jpeg and less than 1MB in size.</div>
						<div style="margin:15px;">&nbsp;</div>
						
						<div style="float:left;width:30%;" align="right">Location :*</div>
						<div style="float:left;width:3%;">&nbsp;</div>
						<div style="float:left;width:50%;" align="left"><input type="textbox" value="" id="tm_location" name="tm_location" /></div>
						<div style="margin:10px;clear:both;">&nbsp;</div>
						
						<div style="float:left;width:30%;" align="right">Team Tagline :</div>
						<div style="float:left;width:3%;">&nbsp;</div>
						<div style="float:left;width:50%;height:10px;" align="left"><input type="textbox" value="" id="tm_tag" name="tm_tag" /></div>
						<div style="margin:15px;">&nbsp;</div>
						
						<div style="float:left;width:30%;" align="right">Describe your Team :</div>
						<div style="float:left;width:3%;">&nbsp;</div>
						<div style="float:left;width:50%;height:50px;" align="left"><textarea id="tm_desc" name="tm_desc"></textarea></div>
						<div style="margin:7px;clear:both;">&nbsp;</div>
						
						<div style="float:left;width:30%;" align="right">Lending Team Website :</div>
						<div style="float:left;width:3%;">&nbsp;</div>
						<div style="float:left;width:50%;" align="left"><input type="textbox" value="" id="tm_website" name="tm_website" /></div>
						<div style="margin:15px;clear:both;">&nbsp;</div>
						
						<div style="float:left;width:30%;" align="right">Lending Team Page URL :*</div>
						<div style="float:left;width:3%;">&nbsp;</div>
						<div style="float:left;width:50%;" align="left">http://www.hopecybrary.org/adopt-team/ <input type="textbox" value="" id="tm_url" name="tm_url" readonly="readonly" /></div>
						<div style="margin:15px;clear:both;">&nbsp;</div>
						
						<div style="float:left;width:30%;" align="right">Who can join this team?</div>
						<div style="float:left;width:3%;">&nbsp;</div>
						<div style="float:left;width:50%;height:50px;" align="left"><input type="radio" value="1" id="tm_join" name="tm_join" checked="checked" /> This team is open - anyone can join and invite others to join<br/><br/>
						                                                <input type="radio" value="0" id="tm_join" name="tm_join" /> This team is closed - administrative approval is needed for others to join
																		<input type="hidden" id="prevurl" name="prevurl" value="<?=$_GET['q']?>" /><br/></div>
						<div style="margin:15px;clear:both;">&nbsp;</div>
					</form>
					</div>
</div>
<div id="startteam_failed_Dialog" title="Permission Required" style="display:none;">
You are currently not a sponsor. You do not have a permission to start a team.
</div>