$(function() {
		$( "#Volunteerstabs" ).tabs();
		$( "#Schoolstabs" ).tabs();
		$( "#OfflineVolunteerstabs" ).tabs();
});
				
var global_coordinators_check = false;
var global_coordinators_val = "";
$(document).ready(
	function(){
		
		$("#members_sponsors").click(
			function(){
				$("#commentTable").html('<img src="/misc/button-loader-big.gif" /><span>');
					$.post(
						"/admin/sponsors/getmembers",
						{
						teamid : fieldtype
						},
						function(oReply){
							$("#teammembers_content").html(oReply.CONTENT);
							$("#members_Dialog").dialog({
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
						},
						"json"
				); 	
			}
		); 
		
		var sMemberName = "members_sponsors_";
		$("a[id^="+sMemberName+"]").each(
			function(){
				var iThisId = this.id.replace(sMemberName, "");
				
				$("#members_sponsors_"+iThisId).click(
					function(){
					$("#teammembers_content").html('<img src="/misc/button-loader-big.gif" /><span>');
						$.post(
							"/admin/sponsors/getmembers",
							{
							teamid : iThisId
							},
							function(oReply){
								$("#teammembers_content").html(oReply.CONTENT);
								$("#members_Dialog").dialog({
										modal: true,
										autoOpen: true,
										resizable: false,
										width: 390,
										buttons: {
											"Close": function(){
											$(this).dialog("close");
											}
										}
								});
							},
							"json"
						); 	
					}
			   );
			}
		);
		
		var sInvestedTeam = "teams_invested_";
		$("span[id^="+sInvestedTeam+"]").each(
			function(){
				var iThisId = this.id.replace(sInvestedTeam, "");
				$("#teams_invested_"+iThisId).click(
					function(){
					$("#invested_Dialog_"+iThisId).dialog({
										modal: true,
										autoOpen: true,
										resizable: false,
										width: 850,
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
		
		var updateTeam = function() {
		
		$teamid	= $('#teamid').val();
		$teamname = $('#teamname').val();
		$description = $('#description').val(); 
		$teamlocation = $('#teamlocation').val();
		$teamtagline = $('#teamtagline').val();
		$website = $('#website').val();
		$category = $('#category').val();
		$url = $('#url').val();
		$joinstatus	= $('#joinstatus').val();
		
						$("#teamname_content").html('<img src="/misc/button-loader-big.gif" /><span>');
						$.post(
							"/admin/sponsors/updateteam",
							{
							teamid : $teamid,
							teamname : $teamname,
							description : $description,
							teamlocation : $teamlocation,
							teamtagline : $teamtagline,
							website : $website,
							category : $category,
							url : $url,
							joinstatus : $joinstatus,
							},
							function(oReply){
								if(oReply.STATUS == 'success'){
									$("#teamname_content").html(oReply.CONTENT);
									$("#team_name_"+$teamid).html('<a id="team_name_'+$teamid+'" href="javascript:void(0);" style="color:white;text-decoration:none;"><span style="color:white;text-decoration:underline;">'+$teamname+'</span></a>');
									alert('The team details was successfully updated');
								} else{
									alert('The team details was not successfully updated, there was a problem with the database');
								}
							},
							"json"
						); 
		}
		
		var sTeamName = "team_name_";
		$("a[id^="+sTeamName+"]").each(
			function(){
				var iThisId = this.id.replace(sTeamName, "");
				
				$("#team_name_"+iThisId).click(
					function(){
					$("#teamname_content").html('<img src="/misc/button-loader-big.gif" /><span>');
						$.post(
							"/admin/sponsors/organizeteam",
							{
							teamid : iThisId
							},
							function(oReply){
								$("#teamname_content").html(oReply.FORM);
								$("#teamname_Dialog").dialog({
										modal: true,
										autoOpen: true,
										resizable: false,
										width: 590,
										buttons: {
											"Update": function(){
											updateTeam();
											},
											"Close": function(){
											$(this).dialog("close");
											}
										}
								});
							},
							"json"
						); 	
					}
			   );
			}
		);
		
		$("#sponsors_team_master_admin_bCheckAll").click(
			function(){
				var bChecked = this.checked;
				$("input[id=sponsors_team_master_admin_bCheckThis]").each(
					function(){
						this.checked = bChecked;
					}
				);
			}
		);
		
		$("input[id=sponsors_team_master_admin_bCheckThis]").each(
			function(){
				$(this).click(
					function(){
						var iCheckLength = $("input[id=sponsors_team_master_admin_bCheckThis]:checked").length;
						var iCheckCount = $("input[id=sponsors_team_master_admin_bCheckThis]").length;
						
						$("#sponsors_team_master_admin_bCheckAll").attr("checked", ((iCheckLength != iCheckCount) ? false:true));
					}
				);
			}
		);
		
		$("#in-refresh").click(
			function(){
					$("#instantTable").html('<img src="/misc/button-loader-big.gif" /><span>');
					$.post(
						"/admin/sponsors/refreshtable",
						{
						type : "instant"
						},
						function(oReply){
							$("#instantTable").html(oReply.TABLE);
						},
						"json"
					); 
			}
		);
		
		$("#off-refresh").click(
			function(){
					$("#commentTable").html('<img src="/misc/button-loader-big.gif" /><span>');
					$.post(
						"/admin/sponsors/refreshtable",
						{
						type : "comment"
						},
						function(oReply){
							$("#commentTable").html(oReply.TABLE);
						},
						"json"
					); 
			}
		);
		
		$("#in-toggle").click(
			function(){
				if($("#sponsors_master_admin_bCheckAll").is(':checked') == true){
					var bChecked = false;
				} else{
				var bChecked = true;
				}
				
				$("input[id=sponsors_master_admin_bCheckThis]").each(
					function(){
						this.checked = bChecked;
					}
				);
				
				$("#sponsors_master_admin_bCheckAll").attr("checked", bChecked);
			}
		);
		
		$("#sponsors_master_admin_bCheckAll").click(
			function(){
				var bChecked = this.checked;
				$("input[id=sponsors_master_admin_bCheckThis]").each(
					function(){
						this.checked = bChecked;
					}
				);
			}
		);
		
		$("input[id=sponsors_master_admin_bCheckThis]").each(
			function(){
				$(this).click(
					function(){
						var iCheckLength = $("input[id=sponsors_master_admin_bCheckThis]:checked").length;
						var iCheckCount = $("input[id=sponsors_master_admin_bCheckThis]").length;
						
						$("#sponsors_master_admin_bCheckAll").attr("checked", ((iCheckLength != iCheckCount) ? false:true));
					}
				);
			}
		);
		
		$("#off-selectall").click(
			function(){
				if($("#sponsors_team_master_admin_bCheckAll").is(':checked') == true){
					var bChecked = false;
				} else{
				var bChecked = true;
				}
				
				$("input[id=sponsors_team_master_admin_bCheckThis]").each(
					function(){
						this.checked = bChecked;
					}
				);
				
				$("#sponsors_team_master_admin_bCheckAll").attr("checked", bChecked);
			}
		);
		
		$("#in-search").click(
			function(){
				var searchbox = $("#in-search-input").val();
				var fieldtype = $("#in-field-search").val();
				if(searchbox == ""){
					alert("Please fill up the search box.");
				} else if(fieldtype == ""){
					alert("Please select a field.");
				} else{
					$("#instantTable").html('<img src="/misc/button-loader-big.gif" /><span>');
					$.post(
						"/admin/sponsors/searchementor",
						{
						type : fieldtype,
						value : searchbox
						},
						function(oReply){
							$("#instantTable").html(oReply.CONTENT);
						},
						"json"
					); 	
				}
			}
		);
		
		$("#off-search").click(
			function(){
				var searchbox = $("#off-search-input").val();
				var fieldtype = $("#off-field-search").val();
				if(searchbox == ""){
					alert("Please fill up the search box.");
				} else if(fieldtype == ""){
					alert("Please select a field.");
				} else{
					$("#commentTable").html('<img src="/misc/button-loader-big.gif" /><span>');
					$.post(
						"/admin/sponsors/searchcomment",
						{
						type : fieldtype,
						value : searchbox
						},
						function(oReply){
							$("#commentTable").html(oReply.CONTENT);
						},
						"json"
					); 	
				}
			}
		);
		
		$("sup[id=volunteer_master_admin_iUserId]").each(
			function(){
				var aUserData = $(this).attr("value").split("_");
				
				$(this).click(
					function(){
						location = Drupal.settings.basePath+'admin/user/master_reviewer/list/assign/'+aUserData[0]+'/'+aUserData[1];
					}
				);
			}
		); 
		
		var sPreName = "kindness_volunteer_name_";
		$("span[id^="+sPreName+"]").each(
			function(){
				var iThisId = this.id.replace(sPreName, "");
				
				$(this).hover(
					function(){
						$("#kindness_assigned_hopeful_block_"+iThisId).show();
					},
					function(){
						$("#kindness_assigned_hopeful_block_"+iThisId).hide();
					}
				);
			}
		);
		
		var sPreName = "sponsors_adopted_schools_";
		$("span[id^="+sPreName+"]").each(
			function(){
				var iThisId = this.id.replace(sPreName, "");
				
				$(this).hover(
					function(){
						$("#sponsors_adopted_schools_block_"+iThisId).show();
					},
					function(){
						$("#sponsors_adopted_schools_block_"+iThisId).hide();
					}
				);
			}
		);
		
		var sPreName = "sponsors_invested_";
		$("span[id^="+sPreName+"]").each(
			function(){
				var iThisId = this.id.replace(sPreName, "");
				
				$(this).hover(
					function(){
						$("#sponsors_invested_block_"+iThisId).show();
					},
					function(){
						$("#sponsors_invested_block_"+iThisId).hide();
					}
				);
			}
		);
		/*
		var sPreName = "teams_invested_";
		$("span[id^="+sPreName+"]").each(
			function(){
				var iThisId = this.id.replace(sPreName, "");
				
				$(this).hover(
					function(){
						$("#teams_invested_block_"+iThisId).show();
					},
					function(){
						$("#teams_invested_block_"+iThisId).hide();
					}
				);
			}
		);*/
		
		var sPendingName = "kindness_hover_volunteer_pending_";
		$("span[id^="+sPendingName+"]").each(
			function(){
				var iThisId = this.id.replace(sPendingName, "");
				
				$(this).hover(
					function(){
						$("#kindness_volunteer_pending_block_"+iThisId).show();
					},
					function(){
						$("#kindness_volunteer_pending_block_"+iThisId).hide();
					}
				);
			}
		);
		
		$("#volunteer_master_admin_aAvailableHopeful").change(
			function(){
				var iSelectedCount = $("#volunteer_master_admin_aAvailableHopeful option:selected").length;
				var iNeededHopeful = $("input[name=mystudies_master_admin_iNeededHopeful]").val();
				
				if (iSelectedCount > iNeededHopeful){
					$("#volunteer_master_admin_bAddHopeful").attr('disabled', 'disabled');
					$("#volunteer_master_admin_aAvailableHopeful option:selected").removeAttr("selected");
					
					alert('You can only select '+iNeededHopeful+' hopeful(s) to assign.');
				}else{
					$("#volunteer_master_admin_bAddHopeful").removeAttr('disabled');
				}
			}
		);
		
		$("#in-unblock").click(
			function(){
						block_unblock_delete_coordinators('activate', 'volunteer_master_admin_bCheckThis');
			}
		);
		
		$("#in-block").click(
			function(){
						block_unblock_delete_coordinators('deactivate', 'volunteer_master_admin_bCheckThis');
			}
		);
		
		$("#in-delete").click(
			function(){
						block_unblock_delete_coordinators('delete', 'sponsors_master_admin_bCheckThis');
			}
		);
		
		$("#in-comment").click(
			function(){
				global_offline_check = false;
						global_offline_val = "";	
						$("input[id=volunteer_master_admin_bCheckThis]").each(
							function(){
								if($(this).is(':checked') == true){
									global_offline_check = true;
									global_offline_val = $(this).val();							
								}
							}
				);
				
				$("#show_pending_Dialog").dialog({
							modal: true,
							autoOpen: true,
							resizable: false,
							width: 700,
							buttons: {
								"Ok": function(){
								$(this).dialog("close");
								}
							}
				});
				
				$("#pendingComments_div").html('<img src="/misc/button-loader-big.gif" /><span>');
				$.post(
									"/admin/sponsors/showpendingcomments/"+global_offline_val,
									{func : ""},
									function(oReply){
										//if(oReply.STATUS == "Success"){
											$("#pendingComments_div").html(oReply.CONTENT);
										//}
									},
									"json"
				);
			}
		);
		
		$("#in-selectall").click(
			function(){
				var bChecked = this.checked;
				$("input[id=volunteer_master_admin_bCheckThis]").each(
					function(){
						this.checked = bChecked;
					}
				);
			}
		); 

	}
);

function sponsors_delete_member(uid, teamid){
				$.post(
						"/admin/sponsors/removemembers",
						{
						teamid : teamid,
						uid : uid
						},
						function(oReply){
							if(oReply.STATUS == 'success'){
								$("#member_list_"+uid).hide();
								if(parseInt($("#members_sponsors_"+teamid).text()) > 0){
									var amount = parseInt($("#members_sponsors_"+teamid).text()) - 1;
									$("#members_sponsors_"+teamid).html('<a id="members_sponsors_'+teamid+'" href="javascript:void(0);" style="color:white;text-decoration:none;"><span style="color:white;text-decoration:underline;">'+amount+'</span></a>');
									if(parseInt($("#members_sponsors_"+teamid).text()) == 0){
										$('#members_content').html('There are now no members in this team.');
									}
								}
							} else{
								alert('There was a problem removing the member from the database.');
							}
						},
						"json"
				);
}

function block_unblock_delete_coordinators(statustype, divid){
	global_offline_check = false;
						global_offline_val = "";	
						$("input[id=" + divid + "]").each(
							function(){
								if($(this).is(':checked') == true){
									global_offline_check = true;
									global_offline_val += $(this).val()+'-';							
								}
							}
						);
						
						global_offline_val = global_offline_val.replace(/(\s+)?.$/, "");
						if(global_offline_check == false){
							alert("Please select an item.");
						} else{
							var answer = confirm("Are you sure you want to " + statustype +" the selected item(s)?")
							if (answer){
									$.post(
									"/admin/sponsors/unblockitems/"+global_offline_val,
									{status : statustype},
									function(oReply){
										if(oReply.STATUS == "Success"){
											alert("The user(s) was successfully processed.");
											switch(divid){
											case 'sponsors_master_admin_bCheckThis':
											$("#instantTable").html(oReply.CONTENT);
											break;
											}
											tooltipInstantLoader();
										}
									},
									"json"
									);
							}
						}
}

function remove_comment(){			
						global_offline_check = false;
						global_offline_val = "";	
						$("input[id=sponsors_team_master_admin_bCheckThis]").each(
							function(){
								if($(this).is(':checked') == true){
									global_offline_check = true;
									global_offline_val += $(this).val()+'-';							
								}
							}
						);
						global_offline_val = global_offline_val.replace(/(\s+)?.$/, "");
						if(global_offline_check == false){
							alert("Please select a team.");
						} else{
							var answer = confirm("Are you sure you want to remove this team?")
							if (answer){
									$.post(
									"/admin/sponsors/removecomment",
									{id : global_offline_val},
									function(oReply){
										if(oReply.STATUS == "Success"){
										alert("The team was successfully removed.");
										$("#commentTable").html(oReply.CONTENT);
										}
									},
									"json"
									);
							}
						}
}

function tooltipCoordinatorVolunteerPendingLoader(){
		var sPendingName = "kindness_hover_volunteer_pending_";
		$("span[id^="+sPendingName+"]").each(
			function(){
				var iThisId = this.id.replace(sPendingName, "");
				
				$(this).hover(
					function(){
						$("#kindness_volunteer_pending_block_"+iThisId).show();
					},
					function(){
						$("#kindness_volunteer_pending_block_"+iThisId).hide();
					}
				);
			}
		);
}

function instantPendingComments(id){
				$("#show_pending_Dialog").dialog({
							modal: true,
							autoOpen: true,
							resizable: false,
							width: 700,
							buttons: {
								"Ok": function(){
								$(this).dialog("close");
								}
							}
				});
				
				$("#pendingComments_div").html('<img src="/misc/button-loader-big.gif" /><span>');
				$.post(
									"/admin/sponsors/showpendingcomments/"+id,
									{func : ""},
									function(oReply){
										//if(oReply.STATUS == "Success"){
											$("#pendingComments_div").html(oReply.CONTENT);
										//}
									},
									"json"
				);
}

function ApproveDisapproveComments(id, label){
				$("#pendingForm_div").html('<img src="/misc/button-loader-big.gif" /><span>');
				$("#add_label").text(label);
				$("#approve_disapprove_Dialog").dialog({
							modal: true,
							autoOpen: true,
							resizable: false,
							width: 400,
							buttons: {
								"Edit": function(){
								editApproveDisapproveComments();
								},
								"Close": function(){
								$(this).dialog("close");
								}
							}
				});
				$("#pendingForm_div").html('<img src="/misc/button-loader-big.gif" /><span>');
				$.post(
					"/admin/sponsors/commentform",
					{id : id},
					function(oReply){
						$("#pendingForm_div").html(oReply.CONTENT);
						$("#add_label").text(label);
					},
					"json"
				);
}

function editApproveDisapproveComments(){
		$("#pendingComments_div").html('<img src="/misc/button-loader-big.gif" /><span>');
		
		var status = $('input[name=commentstatus]:checked', '#commentform').val();
		$.post(
			"/admin/sponsors/saveapprovecomment",
			{
			id : $("#com_id").val(),
			comment : $("#commenttext").val(),
			status : status,
			fromid : $("#com_fromid").val(),
			},
			function(oReply){
				alert('The comment was successfully edited.');
				$("#approve_disapprove_Dialog").dialog("close");
				$("#pendingComments_div").html(oReply.CONTENT); 
				$("#commentTable").html(oReply.CONTENT2); 
				$("#instantTable").html(oReply.CONTENT3); 
				
				tooltipInstantLoader();
			},
			"json"
		);
		
}

function tooltipInstantLoader(){
	var sPreName = "kindness_volunteer_name_";
		
		$("span[id^="+sPreName+"]").each(
			function(){
				var iThisId = this.id.replace(sPreName, "");
				
				$(this).hover(
					function(){
						$("#kindness_assigned_hopeful_block_"+iThisId).show();
					},
					function(){
						$("#kindness_assigned_hopeful_block_"+iThisId).hide();
					}
				);
			}
		);
}

function open_for_comment_dialog(type, iUserId, sUser){
	alert("This feature is deprecated and has been disabled.");
	
	/*switch(type){
	case 'profile':
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
														//"Full Screen": function(){
														//$(this).dialog("close");
														//},
														"Close": function(){
														$(this).dialog("close");
														}
													}
									});	
									var strurl = window.location.href;
									var cssLink = '&css=kickapps_theme2010';
									var varLocation = '&location=community';
									if(strurl.search("kickapps_theme2010") == -1){
									cssLink = '&css=kickapps_theme2010';
									varLocation = '&location=hud';
									}
									$("#hc_HopefulProfile1").attr("src", "http://affiliate.kickapps.com/service/displayKickPlace.kickAction?as=158175&u="+oReply.RETURN+varLocation+"&view=onlyprofile&"+cssLink);
								}
							},
							"json"
						);
	break;
	}*/
}

function open_blog_photo_video_for_comment_dialog(link1, link2, link3, commentto){

	$("#profile_Dialog").dialog({
													modal: true,
													autoOpen: true,
													resizable: false,
													width: 960,
													height: 650,
													buttons: {
														/*"Full Screen": function(){
														$(this).dialog("close");
														},*/
														"Close": function(){
														$(this).dialog("close");
														}
													}
									});	
									
	$("#hc_HopefulProfile1").attr("src", "http://affiliate.kickapps.com/" + link1 + "/" + link2 + "/" + link3 + "/158175.html?css=kickapps_theme2010&user="+commentto);		
}