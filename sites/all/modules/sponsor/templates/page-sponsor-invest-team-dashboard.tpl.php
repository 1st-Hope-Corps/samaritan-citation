<style type="text/css">
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
		
		var pathstr = window.location.pathname;
		if(pathstr.substring(1, 11) == 'adopt-team'){
		RequestImage_volunteer("online");
		}
		
		$("#tm_name").keyup(
			function(){
				var str = $("#tm_name").val();
				$("#tm_url").val(str.replace(' ', '-'));
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
							if(oReturn == 'sponsor'){
								
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
							}
							$("#loading-invest").hide();
						},
						"json"
					);
				}
			);  
			
		$("#investmentdetails").click(
				function(){
								$("#investmentdetails_Dialog").dialog({
										modal: true,
										autoOpen: true,
										resizable: false,
										width: 790,
										buttons: {
											"Close": function(){
												$(this).dialog("close");
											}
										}
								});
				}
			);

		$("[id^=join_team_login]").each(
						function(){
							$("#"+this.id).click(
								function(){
										$("#join_login_Dialog").dialog({
												modal: true,
												autoOpen: true,
												resizable: false,
												width: 510,
												height: 250,
												buttons: {
													"Close": function(){
														$(this).dialog("close");
													}
												}
										});
								}
							)
						}
		);
		
		$("[id^=join_team_confirm]").each(
						function(){
							$("#"+this.id).click(
								function(){
									$("#loading-invest").show();
									$.post(
										"/sponsor/checkaccount",
										{ type : "join", 
										  teamid : $("#teamid").val() },
										function(sReply){
											var oReturn = sReply.RETURN;
											/*if(oReturn == 'sponsor'){*/
												
												$("#team_name_text").text($("#team_name").text());
												$("#join_team_confirm").attr("style","");
												$("#join_team_confirm").html("<p><b style='color:black'>My Team</b></p><div>&nbsp;</div>");
												$("#join_team_confirm1").hide();
												
												$("#success_location").html($("#str_location").html());
												$("#success_year").html($("#str_year").html());
												var newmembercount = parseInt($("#str_memcount").html()) + 1;
												$("#success_members").html(newmembercount);
												$("#str_memcount").html(newmembercount);
												$("#success_image").html($("#team_image").html());
												$("#success_teamname").html($("#team_name").html());
												$("#success_invested").html($("#investedtotal").html());
												$("#success_tagline").html($("#tagline").html());
												
												$("#join_confirm_Dialog").dialog({
														modal: true,
														autoOpen: true,
														resizable: false,
														width: 510,
														height: 250,
														buttons: {
															"Close": function(){
																$(this).dialog("close");
															}
														}
												});
												
											/*} else{
												$("#join_failed_Dialog").dialog({
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
						}
		);

		$("a#button_children_online_volunteer").click(

			function(){
				$("#incybrary_block_title").text("- On Duty");
				RequestImage_volunteer("online");
			}
		);
		
		$("a#button_children_24_volunteer").click(
			function(){
				$("#incybrary_block_title").text("- In the last 24 hours");
				RequestImage_volunteer(24);
			}
		);
		
		$("a#button_children_all_volunteer").click(
			function(){
				$("#incybrary_block_title").text("- All Members");
				RequestImage_volunteer("all");
			}
		);
		if(window.location.pathname == '/community/volunteerteamdashboard'){
		RequestImage_volunteer("online");
		}
	}
);

function RequestImage_volunteer(sRequestType){
			//$("#incybrary_avatar").attr("src", "/sites/default/files/pictures/default_image.jpg");
			$("#incybrary_avatar").hide();
			$("#incybrary_hopeful_details").html("The selected member's description will go here.");
			
			$("#incybrary_hopeful_nav").html("&nbsp;");
			$("div#incybrary_hopeful_list").text("Fetching data...");

			$.post(
				"/teaminvestors/"+sRequestType+'/'+$("#teamid").val(),
				{ func: "GetChildren" },
				function(sReply){
					var sOutput = '';
					aChildren = sReply.RETURN;
					aDetails = sReply.DETAILS;
					aTotal = sReply.TOTAL;
				
					$("#memberscounttext").text(aTotal[0].totalteamcount);
					$("#locationtext").text(aTotal[0].locationbase);
					$("#kindnesstotaltext").text(aTotal[0].totalkindness);
					$("#formedyeartext").text(aTotal[0].formedyear);
					$("#investedtotal").text(aTotal[0].totalinvested);
					
					if (aChildren.length > 0){
						PageThis_volunteer();
					}else{
						$("div#incybrary_hopeful_list").html("No Members to list, yet.");
					}
				if(sRequestType == 'online'){
				$("#inthecybrarynow").html("<span style='color:red'>On Duty</span>");
				}
				},
				"json"
			);
}

function PageThis_volunteer(iThisOffSet, iThisInSet){
	var iResultsPerPage = 5;
	
	iThisOffSet = (iThisOffSet == null) ? 0:iThisOffSet;
	iThisInSet = (iThisInSet == null) ? iResultsPerPage:iThisInSet;
	
	var iRecordCount = aChildren.length;
	var iRawTotalPages = iRecordCount/iResultsPerPage;
	var iTotalPages = Math.floor(iRawTotalPages);
	var iCurrPage = iThisInSet/iResultsPerPage;
	var sOutput = "";
	
	if (iTotalPages == 0) iTotalPages = 1;
	if (iRawTotalPages > iTotalPages) iTotalPages++;
	
	for (i=iThisOffSet; i<iThisInSet && i<iRecordCount; i++){
		sImageURL = "/" + aChildren[i].picture;
		iUserId = aChildren[i].uid;
		sChildName = aChildren[i].name;
		sChildEmail = aChildren[i].mail;
		
		sOutput += '<div style="float:left;padding: 5px;text-align: center;"><img class="incybrary_thumbnail" id="' + iUserId + '" user="' + sChildName + '" src="' + sImageURL + "?" + Math.floor(Math.random()*1000) + '" alt="' + sChildName + '" title="' + aChildren[i].name + '" /><br />' + sChildName + '</div>';
		
		if (i == 0){
			$("#incybrary_hopeful_details").html("The selected child's description will go here.");
			$("#incybrary_avatar").attr("src", sImageURL);
			
			var iUID = iUserId;
			var sName = sChildName;
			var sEmail = sChildEmail;
			
			sDescription = '<table width="100%" border="0" cellspacing="0" cellpadding="2">' +
								'<tr><td colspan="2" class="header">' + sChildName + ' <div id="inthecybrarynow"></div></td></tr>';

			for (x=0; x<aDetails.length; x++){
				if (aDetails[x].uid == iUserId){
					sDescription += '<tr><td width="120" style="font-size:12px;"><b>What I\'m doing now:</b></td><td class="info" style="font-size:12px;" width="120">' + ((isset(aDetails[x].doingnow)) ? aDetails[x].doingnow:'Not specified') + '</td></tr>';
					//sDescription += '<tr><td style="font-size:12px;"><b>Volunteer Roles:</b></td><td class="info" style="font-size:12px;" width="120">' + ((isset(aDetails[x].volunteerroles)) ? aDetails[x].volunteerroles:'Not specified') + '</td></tr>';
					//sDescription += '<tr><td style="font-size:12px;"><b>Kindness Hours:</b></td><td class="info" style="font-size:12px;" width="120">' + ((isset(aDetails[x].kindnesshours)) ? aDetails[x].kindnesshours:'Not specified') + '</td></tr>';
					break;
				}
			}
			
			//$("#incybrary_hopeful_details").html(sDescription+'</table>');
		}
	}
	
	$.post(
					"/teamroles/getroles",
						{
						uid: iUserId
						},
						function(sReply){
							if (sReply.STATUS == 1){

							sDescription += '<tr><td style="font-size:12px;">Volunteer Roles:</td><td class="info" width="120">'+sReply.volunteerroles+'</td></tr>';
							sDescription += '<tr><td style="font-size:12px;">Kindness Hours:</td><td class="info">0</td></tr>';
							
							$("#incybrary_hopeful_details").html(sDescription+'</table>');
							}
						},
						"json"
	);
	
	
	if (iUID && sName){
		$("#incybrary_avatar")
			.unbind()
			.click(
				function(){
					alert("This feature is deprecated and has been disabled.");
					
					/*$.post(
						"/teaminvestors/profile",
						{
							uid: iUID,
							user: sName
						},
						function(sReply){
							//if (sReply.STATUS == 1){
							//	$("#hc_HopefulProfileContainer")
							//		.css('z-index', '90000000')
							//		.show();
							//	$("#hc_HopefulProfile").attr("src", "http://affiliate.kickapps.com/service/displayKickPlace.kickAction?css=kickapps_theme2010&as=158175&u="+sReply.RETURN+"&location=community&view=onlyprofile");
							//}
							
							if (sReply.STATUS == 1){
							
								$("#view_kickapps_volunteer_Dialog").dialog({
													modal: true,
													autoOpen: true,
													resizable: false,
													width: 868,
													height: 571,
													buttons: {
														"Close": function(){
														$(this).dialog("close");
														}
													}
								});	
								$("#hc_HopefulProfile23").attr("src", "http://affiliate.kickapps.com/service/displayKickPlace.kickAction?css=kickapps_theme2010&as=158175&u="+sReply.RETURN+"&location=community&view=onlyprofile");
							}
						},
						"json"
					);*/
				}
				);
	}
		
	iThisOffSet += iResultsPerPage;
	iThisInSet += iResultsPerPage;
	
	sPageNext = (iThisOffSet < iRecordCount) ? "<a class=\"link\" href=\"javascript:PageThis_volunteer("+iThisOffSet+", "+iThisInSet+");\">Next &gt;</a>":"";
	
	iThisOffSet -= (iThisOffSet < 0) ? 0:(iResultsPerPage * 2);
	iThisInSet -= (iThisInSet == 0) ? iResultsPerPage:(iResultsPerPage * 2);
	sPagePrev = (iThisOffSet < 0 && iThisInSet == 0) ? "":"<a class=\"link\" href=\"javascript:PageThis_volunteer("+iThisOffSet+", "+iThisInSet+");\">&lt; Previous</a>";
	
	sPageNav = '<table border="0" style="width:100%; font-size:0.9em;"><tr><td style="width:25%;">'+sPagePrev+'</td><td style="text-align:center; width:50%;">Page '+iCurrPage+' of '+iTotalPages+'</td><td style="text-align:right; width:25%;">'+sPageNext+'</td></tr></table>';
	
	$("#incybrary_hopeful_nav").html(sPageNav);
	$("div#incybrary_hopeful_list").html(sOutput);
	
	ApplyStyles_volunteer();
	$("#incybrary_avatar").show();
}

function isset(){
	var aArgs = arguments, iArgsLen = aArgs.length, i = 0;

	if (iArgsLen === 0) throw new Error('Empty isset'); 

	while (i !== iArgsLen){
		if (typeof(aArgs[i]) == "undefined" || aArgs[i] === null){
			return false; 
		}else{
			i++; 
		}
	}
	
	return true;
}

function ApplyStyles_volunteer(){
	$("img[class=incybrary_thumbnail]").each(
		function(){
			$(this).hover(
				function(){
					$(this).css("cursor", "pointer");
				},
				function(){
					$(this).css("cursor", "default");
				}
			)
			.click(
				function(){
					var iUserId = $(this).attr("id");
					var sUserName = $(this).attr("user");
					var sUserEmail = $(this).attr("email");
					
					var sDescription = '<table width="100%" border="0" cellspacing="0" cellpadding="2">' +
											'<tr><td colspan="2" class="header">' + $(this).attr("alt") + ' <div id="inthecybrarynow"></div></td></tr>';
					
					
					for (i=0; i<aDetails.length; i++){
						if (aDetails[i].uid == iUserId){
							$("#incybrary_avatar")
								.unbind()
								.attr("src", $(this).attr("src"))
								.click(
									function(){	
										alert("This feature is deprecated and has been disabled.");
										
										/*$.post(
											"/teaminvestors/profile",
											{
												uid: iUserId,
												user: sUserName
											},
											function(sReply){
												if (sReply.STATUS == 1){
													//$("#hc_HopefulProfileContainer")
													//	.center()
													//	.css('zIndex', '9000')
													//	.show();
													//$("#hc_HopefulProfile").attr("src", "http://affiliate.kickapps.com/service/displayKickPlace.kickAction?css=kickapps_theme2010&as=158175&view=onlyprofile&u="+sReply.RETURN);
													
													$("#view_kickapps_volunteer_Dialog").dialog({
													modal: true,
													autoOpen: true,
													resizable: false,
													width: 868,
													height: 571,
													buttons: {
														"Close": function(){
														$(this).dialog("close");
														}
													}
													});	
													$("#hc_HopefulProfile23").attr("src", "http://affiliate.kickapps.com/service/displayKickPlace.kickAction?css=kickapps_theme2010&as=158175&u="+sReply.RETURN+"&location=community&view=onlyprofile");
												
												}
											},
											"json"
										);*/
									}
								);
							
							sDescription += '<tr><td width="120" style="font-size:12px;">What I\'m doing now:</td><td class="info" width="120">' + ((isset(aDetails[i].doingnow)) ? aDetails[i].doingnow:'Not specified') + '</td></tr>';
						//	sDescription += '<tr><td style="font-size:12px;">Volunteer Roles:</td><td class="info" width="120"><div id="inc_roles"></div></td></tr>';
							//sDescription += '<tr><td style="font-size:12px;">Kindness Hours:</td><td class="info">' + ((isset(aDetails[i].kindnesshours)) ? aDetails[i].kindnesshours:'Not specified') + '</td></tr>';
							
							break;
						}
					}
					
					$.post(
					"/teamroles/getroles",
						{
						uid: iUserId
						},
						function(sReply){
							if (sReply.STATUS == 1){

							sDescription += '<tr><td style="font-size:12px;">Volunteer Roles:</td><td class="info" width="120">'+sReply.volunteerroles+'</td></tr>';
							sDescription += '<tr><td style="font-size:12px;">Kindness Hours:</td><td class="info">0</td></tr>';
							
							$("#incybrary_hopeful_details").html(sDescription+'</table>');
							}
						},
						"json"
					);
				}
			);
		}
	);
}

function validateLoginTeam(myform) {
	err = "";
	document.getElementById("divLoginErrorSponsor").innerHTML = "";
	if (myform.name.value == "")
		err += "Please input your username.<br />";
	if (myform.pass.value == "")
		err += "Please input your password.<br />";	
	
	if (err != "") {
	document.getElementById("divLoginErrorSponsor").innerHTML = err;
	return false;
	} else{		
		$.post(
			Drupal.settings.basePath+"user/ext/account/check/" + myform.name.value,
			{ func: "" },
			function(sReply){
				var oReturn = sReply.RETURN;
				if(oReturn == 'hopeful'){
				$("#loginFormSponsor").html("You logged in as a Hopeful. It is restricted to login here as a hopeful.<br/> Please click here to go to the <a href='/home.php'>hopeful login area</a>");
				return false;
				} else{

				$("input[name=name]").val(myform.name.value);
				$("input[name=pass]").val(myform.pass.value);
				$("input[name=form_id]").val(myform.form_id.value);
				$('#loginForm3Sponsor').submit();
							
				//return true;
				}
			},
			"json"
		);
	return false;
	}
  }
</script>
<link class="ka_style" rel="stylesheet" type="text/css" href="http://www.hopecybrary.org/sites/all/modules/mystudies/jquery.tooltip.css" />
<link class="ka_style" rel="stylesheet" type="text/css" href="http://www.hopecybrary.org/sites/all/modules/mystudies/redmond/jquery-ui-custom.css" />
<script type="text/javascript" src="http://www.hopecybrary.org/sites/all/modules/mystudies/jquery.tooltip.js"></script>
<script type="text/javascript" src="http://www.hopecybrary.org/sites/all/modules/mystudies/jquery-ui.js"></script>
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
										<h4 style="color:#20f42d;font-size:24px;">Invest Teams <label style="font-size:11px;color:#195ca1;display:none;" id="loading-invest">loading</label></h4> <h4 style="color:#ff0000;font-size:20px;">Under Construction</h4>
										<h1>Invest Teams are groups of people who have banded together to invest funds in HopeNet</h1><br/>
										<h1>You can join an existing team or start your own team and invite your friends.</h1><br/>
										<div style="clear:both;padding-top:12px;">
											<div style="float:left;width:20%;">
													<div style="background:url(/themes/theme2010/images/team-sponsor-button.png);width:132px;height:32px;cursor:pointer;" onclick="location = '/adopt-team/viewteam';">
													 <div style="padding-top:8px;"><span style="color:black;cursor:pointer;"><center><b>View My Team</b></center></span></div>
													</div>
											</div>
											<div style="float:left;width:2%;">&nbsp;</div>
											<div style="float:left;width:20%;">
													<div style="background:url(/themes/theme2010/images/team-sponsor-button.png);width:132px;height:32px;cursor:pointer;"  onclick="location = '/adopt-team/jointeam';">
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





<div id="startteam_Dialog" title="Start a New Investment Team" style="display:none;" align="center">
					<div style="clear:both;">
					<form action="/create-team" method="post" enctype="multipart/form-data" id="tm-form" name="tm-form">
						<div style="float:left;width:30%;" align="right">Team Name :*</div>
						<div style="float:left;width:3%;">&nbsp;</div>
						<div style="float:left;width:50%;" align="left"><input type="textbox" value="" id="tm_name" name="tm_name" /></div>
						<div style="margin:15px;">&nbsp;</div>

						<div style="float:left;width:30%;" align="right">Category :*</div>
						<div style="float:left;width:3%;">&nbsp;</div>
						<div style="float:left;width:50%;" align="left"><select id="tm_category" name="tm_category">
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

<div id="join_login_Dialog" title="Please Login" style="display:none;">
<div align="right" style="margin-bottom:12px;"><b>New to Hope Street?</b> <a href="http://www.hopecybrary.org/register/user" target="_blank">click here</a></div>
<?php
$sCurrPage = str_replace("index.php","",$_SERVER['PHP_SELF']);
?>
                                <div id="loginFormSponsor" style="color:#000000">
                                	<div class="notice" id="divLoginErrorSponsor"></div>
                                	<form action="<?php echo $sCurrPage; ?>user" method="post" onSubmit="return validateLoginTeam(this);">
                                        <table cellpadding="2" cellspacing="2" border="0" width="100%">
                                            <tr><td style="padding:2px;" width="50">Username:</td><td style="padding:2px;">
												<input type="text" id="name_sponsor" name="name" value="" /></td></tr>
                                            <tr><td style="padding:2px;">Password:</td><td style="padding:2px;">
												<input type="password" id="pass_sponsor" name="pass" value=""/></td></tr>
                                            <tr><td style="padding:2px;"></td><td style="padding:2px;">
                                                <input type="hidden" name="form_id" id="edit-user-login" value="user_login" />
                                                <input type="submit" name="op" value="Log in" /><br/>
												<a href="/user/password" target="_blank">Forgot your password?</a>
                                            </td></tr>
                                        </table>
									</form>
									<form id="loginForm3Sponsor" action="<?php echo $sCurrPage; ?>user" method="post">
									<input type="hidden" name="name" />
									<input type="hidden" name="pass" />
									<input type="hidden" name="form_id" id="edit-user-login" value="user_login" />
                                     <input type="hidden" name="op" value="Log in" class="btnuser" /> 
									</form>
								</div>
</div>

<div id="join_failed_Dialog" title="Permission Required" style="display:none;">
You are not logged in as a Sponsor. You do not have permission to join this team.
</div>

<div id="join_confirm_Dialog" title="Congratulations" style="display:none;">
<div align="right" style="margin-bottom:12px;"><b>You are now a member of: <label id="success_teamname"></label> </div>
<div style="clear:both;">
	<div style="float:left;width:40%"><span id="success_image"></span></div>
	<div style="float:left;3%">&nbsp;</div>
	<div style="float:left;width:40%"><label id="success_members"></label> members<br/>Based in <label id="success_location"></label><br/>Formed in <label id="success_year"></label><br/><label id="success_invested"></label> invested</div>
</div>
<div style="clear:both;">Team <label id="success_tagline"></label></div>
</div>
<div id="startteam_failed_Dialog" title="Permission Required" style="display:none;">
You are currently not a sponsor. You do not have a permission to start a team.
</div>