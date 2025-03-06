$(function() {
		$( "#Volunteerstabs" ).tabs();
		$( "#Schoolstabs" ).tabs();
		$( "#OfflineVolunteerstabs" ).tabs();
});
				
var global_coordinators_check = false;
var global_coordinators_val = "";
$(document).ready(
	function(){
		$("#volunteer_master_admin_bCheckAll").click(
			function(){
				var bChecked = this.checked;
				$("input[id=volunteer_master_admin_bCheckThis]").each(
					function(){
						this.checked = bChecked;
					}
				);
			}
		);
		
		$("input[id=volunteer_master_admin_bCheckThis]").each(
			function(){
				$(this).click(
					function(){
						var iCheckLength = $("input[id=volunteer_master_admin_bCheckThis]:checked").length;
						var iCheckCount = $("input[id=volunteer_master_admin_bCheckThis]").length;
						
						$("#volunteer_master_admin_bCheckAll").attr("checked", ((iCheckLength != iCheckCount) ? false:true));
					}
				);
			}
		);
		
		$("#co-refresh").click(
			function(){
					$("#coordinatorsTable").html('<img src="/misc/button-loader-big.gif" /><span>');
					$.post(
						"/admin/user/refreshtable",
						{
						type : "eAdministrator"
						},
						function(oReply){
							$("#coordinatorsTable").html(oReply.TABLE);
						},
						"json"
					); 
			}
		);
		$("#school-refresh").click(
			function(){
					$("#schools-table").html('<img src="/misc/button-loader-big.gif" /><span>');
					$.post(
						"/admin/user/refreshtable",
						{
						type : "school"
						},
						function(oReply){
							$("#schools-table").html(oReply.TABLE);
						},
						"json"
					); 
			}
		);
		
		$("#off-refresh").click(
			function(){
					$("#offlineTable").html('<img src="/misc/button-loader-big.gif" /><span>');
					$.post(
						"/admin/user/refreshtable",
						{
						type : "offlinevolunteer"
						},
						function(oReply){
							$("#offlineTable").html(oReply.TABLE);
						},
						"json"
					); 
			}
		);
		
		$("#off-schedule").click(
			function(){
					global_offline_check = false;
					global_offline_val = "";	
					$("input[id=offline_volunteer_master_admin_bCheckThis]").each(
							function(){
								if($(this).is(':checked') == true){
									global_offline_check = true;
									global_offline_val += $(this).val()+'-';							
								}
							}
					);
						
					global_offline_val = global_offline_val.replace(/(\s+)?.$/, "");
					if(global_offline_check == false){
						alert("Please select an offline volunteer.");
					} else{
								$("#offlineschedule_Dialog").dialog({
									modal: true,
									autoOpen: true,
									resizable: false,
									width: 1210,
									buttons: {
										"Ok": function(){
										$(this).dialog("close");
										}
									}
								});
								var url = "http://www.hopecybrary.org/schedule.php?uid="+global_offline_val;
								$('iframe#schedule_url').attr('src', url);
					}
			}
		);
		
		$("#co-toggle").click(
			function(){
				if($("#volunteer_master_admin_bCheckAll").is(':checked') == true){
					var bChecked = false;
				} else{
				var bChecked = true;
				}
				
				$("input[id=volunteer_master_admin_bCheckThis]").each(
					function(){
						this.checked = bChecked;
					}
				);
				
				$("#volunteer_master_admin_bCheckAll").attr("checked", bChecked);
			}
		);
		
		$("#offline_volunteer_master_admin_bCheckAll").click(
			function(){
				var bChecked = this.checked;
				$("input[id=offline_volunteer_master_admin_bCheckThis]").each(
					function(){
						this.checked = bChecked;
					}
				);
			}
		);
		
		$("input[id=offline_volunteer_master_admin_bCheckThis]").each(
			function(){
				$(this).click(
					function(){
						var iCheckLength = $("input[id=offline_volunteer_master_admin_bCheckThis]:checked").length;
						var iCheckCount = $("input[id=offline_volunteer_master_admin_bCheckThis]").length;
						
						$("#offline_volunteer_master_admin_bCheckAll").attr("checked", ((iCheckLength != iCheckCount) ? false:true));
					}
				);
			}
		);
		
		$("#off-selectall").click(
			function(){
				if($("#offline_volunteer_master_admin_bCheckAll").is(':checked') == true){
					var bChecked = false;
				} else{
				var bChecked = true;
				}
				
				$("input[id=offline_volunteer_master_admin_bCheckThis]").each(
					function(){
						this.checked = bChecked;
					}
				);
				
				$("#offline_volunteer_master_admin_bCheckAll").attr("checked", bChecked);
			}
		);
		
		$("#volunteer_master_admin_school_bCheckAll").click(
			function(){
				var bChecked = this.checked;
				$("input[id=volunteer_master_admin_school_bCheckThis]").each(
					function(){
						this.checked = bChecked;
					}
				);
			}
		);
		
		$("input[id=volunteer_master_admin_school_bCheckThis]").each(
			function(){
				$(this).click(
					function(){
						var iCheckLength = $("input[id=volunteer_master_admin_school_bCheckThis]:checked").length;
						var iCheckCount = $("input[id=volunteer_master_admin_school_bCheckThis]").length;
						
						$("#volunteer_master_admin_school_bCheckAll").attr("checked", ((iCheckLength != iCheckCount) ? false:true));
					}
				);
			}
		);
		
		$("#positions_master_admin_bCheckAll").click(
			function(){
				var bChecked = this.checked;
				$("input[id=positions_master_admin_bCheckThis]").each(
					function(){
						this.checked = bChecked;
					}
				);
			}
		);
		
		$("input[id=positions_master_admin_bCheckThis]").each(
			function(){
				$(this).click(
					function(){
						var iCheckLength = $("input[id=positions_master_admin_bCheckThis]:checked").length;
						var iCheckCount = $("input[id=positions_master_admin_bCheckThis]").length;
						
						$("#positions_master_admin_bCheckAll").attr("checked", ((iCheckLength != iCheckCount) ? false:true));
					}
				);
			}
		);
		
		$("#school-selectall").click(
			function(){
				if($("#volunteer_master_admin_school_bCheckAll").is(':checked') == true){
					var bChecked = false;
				} else{
				var bChecked = true;
				}
				
				$("input[id=volunteer_master_admin_school_bCheckThis]").each(
					function(){
						this.checked = bChecked;
					}
				);
				
				$("#volunteer_master_admin_school_bCheckAll").attr("checked", bChecked);
			}
		);
		
		$("#co-search").click(
			function(){
				var searchbox = $("#co-search-input").val();
				var fieldtype = $("#co-field-search").val();
				if(searchbox == ""){
					alert("Please fill up the search box.");
				} else if(fieldtype == ""){
					alert("Please select a field.");
				} else{
					$("#coordinatorsTable").html('<img src="/misc/button-loader-big.gif" /><span>');
					$.post(
						"/admin/user/searchcoordinator",
						{
						type : fieldtype,
						value : searchbox
						},
						function(oReply){
							$("#coordinatorsTable").html(oReply.CONTENT);
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
					$("#offlineTable").html('<img src="/misc/button-loader-big.gif" /><span>');
					$.post(
						"/admin/user/searchofflinevolunteers",
						{
						type : fieldtype,
						value : searchbox
						},
						function(oReply){
							$("#offlineTable").html(oReply.CONTENT);
						},
						"json"
					); 	
				}
			}
		);
		
		$("#school-search").click(
			function(){
				var searchbox = $("#school-search-input").val();
				var fieldtype = $("#school-field-search").val();
				if(searchbox == ""){
					alert("Please fill up the search box.");
				} else if(fieldtype == ""){
					alert("Please select a field.");
				} else{
					$("#schools-table").html('<img src="/misc/button-loader-big.gif" /><span>');
					$.post(
						"/admin/user/searchschool",
						{
						type : fieldtype,
						value : searchbox
						},
						function(oReply){
							$("#schools-table").html(oReply.CONTENT);
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
		
		$("#co-unblock").click(
			function(){
						block_unblock_delete_coordinators('activate', 'volunteer_master_admin_bCheckThis');
			}
		);
		
		$("#co-block").click(
			function(){
						block_unblock_delete_coordinators('deactivate', 'volunteer_master_admin_bCheckThis');
			}
		);
		
		$("#co-delete").click(
			function(){
						block_unblock_delete_coordinators('delete', 'volunteer_master_admin_bCheckThis');
			}
		);
		
		
		$("#off-activate-user").click(
			function(){
						block_unblock_delete_coordinators('off-activate', 'offline_volunteer_master_admin_bCheckThis');
			}
		);
		
		$("#off-deactivate-user").click(
			function(){
						block_unblock_delete_coordinators('off-deactivate', 'offline_volunteer_master_admin_bCheckThis');
			}
		);
		
		$("#co-filter").click(
			function(){
				$("#coordinatorfilter_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 530,
						buttons: {
							"Ok": function(){
							$(this).dialog("close");
							}
						}
				});
			}
		);
		
		$("#co-selectall").click(
			function(){
				var bChecked = this.checked;
				$("input[id=volunteer_master_admin_bCheckThis]").each(
					function(){
						this.checked = bChecked;
					}
				);
			}
		);
		
		$("#school-add").click(
			function(){
					$("#school_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 530,
						buttons: {
							"Add School": function(){
								var schoolselect = $("#schoolselect").val();
								if(schoolselect == ""){
								alert("Please select a school.");
								} else{
									$.post(
									"/admin/user/addschool/"+schoolselect,
									{func : ""},
									function(oReply){
										alert("The School was successfully added.");
										$("#school_Dialog").dialog("close");
										$("#schools-table").html(oReply.TABLE);
									},
									"json"
									); 
								}
							},
							"Cancel": function(){
							$(this).dialog("close");
							}
						}
					});
					
					$("#schoolListOption").html('<img src="/misc/button-loader-big.gif" /><span>');
					$.post(
					"/admin/user/getSchoolOptions",
					{func : ""},
					function(oReply){
						$("#schoolListOption").html(oReply.CONTENT);
					},
					"json"
					);
				} 
		); 
		
		$("#school-delete").click(
			function(){
				global_school_check = false;
				global_school_val = "";	
				$("input[id=volunteer_master_admin_school_bCheckThis]").each(
					function(){
						if($(this).is(':checked') == true){
							global_school_check = true;
							global_school_val = $(this).val();							
						}
					}
				);
			    
				if(global_school_check == false){
				alert("Please select a school.");
				} else{
					var answer = confirm("Are you sure you want to remove this school? All positions under this school will also be deleted.")
					if (answer){
					$("#schools-table").html('<img src="/misc/button-loader-big.gif" /><span>');
					$.post(
					"/admin/user/deleteschool/"+global_school_val,
					{func : ""},
					function(oReply){
						$("#schools-table").html(oReply.TABLE);
					},
					"json"
					); 
					}
				} 
			}
		);
		
		$("#schools-tab").click(
			function(){
				global_school_check = false;
				global_school_val = "";	
				$("input[id=volunteer_master_admin_school_bCheckThis]").each(
					function(){
						if($(this).is(':checked') == true){
							global_school_check = true;
							global_school_val = $(this).val();							
						}
					}
				);
			    
				if(global_school_check == false){
				$("#Schoolstabs").tabs("select", "1");
				alert("Please select a school.");
				} else{
					$("#positions_volunteer_content").html('<img src="/misc/button-loader-big.gif" /><span>');
					$.post(
					"/admin/user/getpositions/"+global_school_val,
					{func : ""},
					function(oReply){
						$("#positions_volunteer_content").html(oReply.CONTENT);
					},
					"json"
					); 
				}
			}
		);
		
		$("#off-kindness").click(
			function(){
						global_offline_check = false;
						global_offline_val = "";	
						$("input[id=offline_volunteer_master_admin_bCheckThis]").each(
							function(){
								if($(this).is(':checked') == true){
									global_offline_check = true;
									global_offline_val += $(this).val()+'-';							
								}
							}
						);
						
						global_offline_val = global_offline_val.replace(/(\s+)?.$/, "");
						if(global_offline_check == false){
							alert("Please select an offline volunteer.");
						} else{
									$("#offlinekindnessstatus_Dialog").dialog({
												modal: true,
												autoOpen: true,
												resizable: false,
												width: 530,
												buttons: {
													"Ok": function(){
													$("#offlinekindnessstatus_Dialog").dialog("close");
													}
												}
									});	
									
									$("#kindnessStatus_div").html('<img src="/misc/button-loader-big.gif" /><span>');		
									$.post(
									"/admin/user/offlinekindnessstatus/"+global_offline_val,
									{func : ""},
									function(oReply){
										if(oReply.STATUS == "Success"){
										$("#kindnessStatus_div").html(oReply.OUTPUT);
										}
									},
									"json"
									);
						}
			}
		);
	}
);

function admin_viewLinkKindness(act_id, istatus){
				$("#admin_kindnessreport_Dialog_edit").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 530,
						buttons: {
							"Ok": function(){
							$(this).dialog("close");
							}
						}
				});
				
				$.post(
				"/volunteer/CybGetContent",
				{type: "getEditValues",
				 id: act_id,
				 status: istatus
				 },
				function(oReply){
						var start = oReply.START;
						var end = oReply.END;
						var elapse = oReply.ELAPSE;
						var position = oReply.POSITION;
						var activityid = oReply.ID;
						var location = oReply.LOCATION;
						var desc = oReply.DESC;
						var comment = oReply.COMMENT;
						
						$("#icomment").html("");
						$("#fstart_edit").text(start);
						$("#fstop_edit").text(end);
						$("#felapse_edit").text(elapse);
						$("#kindnesstitle_edit").text("");
						$("#kindnesslocation_edit").text("");
						$("#kindnessdescription_edit").text("");
						$("#kindnesstitle_edit").text(position);
						$("#kindnesslocation_edit").text(location);
						$("#kindnessdescription_edit").text(desc);
						$("#icomment").html(comment);
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
							alert("Please select an offline volunteer.");
						} else{
							var answer = confirm("Are you sure you want to " + statustype +" the selected user(s)?")
							if (answer){
									$.post(
									"/admin/user/unblockcoordinators/"+global_offline_val,
									{status : statustype},
									function(oReply){
										if(oReply.STATUS == "Success"){
											alert("The user(s) was successfully processed.");
											switch(divid){
											case 'volunteer_master_admin_bCheckThis':
											$("#coordinatorsTable").html(oReply.CONTENT);
											break;
											case 'offline_volunteer_master_admin_bCheckThis':
											$("#offlineTable").html(oReply.CONTENT);
											break;
											}
											tooltipCoordinatorLoader();
										}
									},
									"json"
									);
							}
						}
}

function remove_offline_user(){			
						global_offline_check = false;
						global_offline_val = "";	
						$("input[id=offline_volunteer_master_admin_bCheckThis]").each(
							function(){
								if($(this).is(':checked') == true){
									global_offline_check = true;
									global_offline_val += $(this).val()+'-';							
								}
							}
						);
						global_offline_val = global_offline_val.replace(/(\s+)?.$/, "");
						if(global_offline_check == false){
							alert("Please select an offline volunteer.");
						} else{
							var answer = confirm("Are you sure you want to remove this user?")
							if (answer){
									$.post(
									"/admin/user/removeofflinevolunteer/"+global_offline_val,
									{func : ""},
									function(oReply){
										if(oReply.STATUS == "Success"){
										alert("The Cybrarian Volunteer was successfully removed.");
										$("#offlineTable").html(oReply.CONTENT);
										}
									},
									"json"
									);
							}
						}
}

function add_offline_user(userid){
		$("#addofflinevolunteer_Dialog").dialog({
						modal: true,
		    			autoOpen: true,
					    resizable: false,
						width: 530,
						buttons: {
							"Ok": function(){
								$(this).dialog("close");
							}
						}
		});

		$("#addoffline_content").html('<img src="/misc/button-loader-big.gif" /><span>');						
		$.post(
		"/admin/user/addofflinevolunteer/"+userid,
		{func : ""},
		function(oReply){
			$("#addoffline_content").html(oReply.CONTENT);
		},
		"json"
		);
}

function add_user_to_coordinator(){
		var offlinevolunteerid = $("#offlinevolunteerid").val();
		var coordinatorid = $("#coordinatorid").val();
		
		if(offlinevolunteerid == ""){
			alert("Please select an offline volunteer.");
		} else{
			$.post(
			"/admin/user/insertaddofflinevolunteer",
			{
			offlinevolunteerid : offlinevolunteerid,
			coordinatorid : coordinatorid
			},
			function(oReply){
				$("#addoffline_content").html('<img src="/misc/button-loader-big.gif" /><span>');						
				$.post(
				"/admin/user/addofflinevolunteer/"+coordinatorid,
				{func : ""},
				function(oReply){
					$("#addoffline_content").html(oReply.CONTENT);
				},
				"json"
				);
			},
			"json"
			);
		}
}

function assign_offline_user(){			
						global_offline_check = false;
						global_offline_val = "";	
						$("input[id=offline_volunteer_master_admin_bCheckThis]").each(
							function(){
								if($(this).is(':checked') == true){
									global_offline_check = true;
									global_offline_val = $(this).val();							
								}
							}
						);

						if(global_offline_check == false){
							alert("Please select an offline volunteer.");
						} else{
							$("#assignofflinevolunteer_Dialog").dialog({
												modal: true,
												autoOpen: true,
												resizable: false,
												width: 530,
												buttons: {
													"Update": function(){
													update_work_hours();
													},
													"Cancel": function(){
													$(this).dialog("close");
													}
												}
							});					
							jQuery("#assignoffline_content").html('<img src="/misc/button-loader-big.gif" /><span>');		
							$.post(
							"/admin/user/assignofflinevolunteer/"+global_offline_val,
							{func : ""},
							function(oReply){
								document.getElementById("assignoffline_content").innerHTML = oReply.CONTENT;
							},
							"json"
							); 
						}
	
}

function removeOfflinetoCoordinator(iUserid, coordinatorid){
	var answer = confirm("Are you sure you want to unassign this user?")
			if (answer){
									$.post(
									"/admin/user/removeofflinevolunteertocoordinator/"+iUserid,
									{coordinatorid : coordinatorid},
									function(oReply){
										if(oReply.STATUS == "Success"){
											alert("The Cybrarian Volunteer was successfully removed.");
											$("#addoffline_content").html('<img src="/misc/button-loader-big.gif" /><span>');						
											$.post(
											"/admin/user/addofflinevolunteer/"+oReply.COID,
											{func : ""},
											function(oReply){
												$("#addoffline_content").html(oReply.CONTENT);
											},
											"json"
											);
										}
									},
									"json"
			);
	}

}

function update_work_hours(){
	var hours_assigned = $("#hours_assigned").val();
	var idassign =  $("#id_assign").val();
	if(hours_assigned == ''){
					alert('Please select hours.');
	} else{
		$.post(
			"/admin/user/saveassignofflinevolunteer",
			{
			idassign : idassign,
			hoursassigned : hours_assigned
			},
			function(oReply){
				if(oReply.STATUS == 'Success'){
					alert("Hours per week assigned updated.");
					$("#assignofflinevolunteer_Dialog").dialog("close");
					$("#offlineTable").html(oReply.CONTENT);
				}
			},
			"json"
		); 
	}
}

function add_position(){
		$("#addposition_Dialog").dialog({
						modal: true,
		    			autoOpen: true,
					    resizable: false,
						width: 530,
						buttons: {
							"Add Position": function(){
								add_position_save();
							},
							"Cancel": function(){
								$(this).dialog("close");
							}
						}
		});
}

function add_position_save(){
		var posname = $("#posname").val();
		var posmax = $("#posmax").val();
		var posduties = $("#posduties").val();
		var posschoolid = $("#posschoolid").val();
		
		if(posname == ""){
			alert("Please fill up a position name.");
		} else{
			$.post(
			"/admin/user/addpositionsave",
			{
			posname : posname,
			posmax : posmax,
			posduties : posduties,
			posschoolid : posschoolid
			},
			function(oReply){
				$("#addposition_Dialog").dialog("close");
				loadPositionsTable();
			},
			"json"
			);
		}
}

function edit_position(){
						global_offline_check = false;
						global_pos_val = "";	
						$("input[id=positions_master_admin_bCheckThis]").each(
							function(){
								if($(this).is(':checked') == true){
									global_offline_check = true;
									global_pos_val = $(this).val();							
								}
							}
						);

						if(global_offline_check == false){
							alert("Please select a position.");
						} else{
							$("#editposition_Dialog").dialog({
												modal: true,
												autoOpen: true,
												resizable: false,
												width: 530,
												buttons: {
													"Update": function(){
													edit_position_save();
													},
													"Cancel": function(){
													$(this).dialog("close");
													}
												}
							});					
							$("#assignoffline_content").html('<img src="/misc/button-loader-big.gif" /><span>');		
							$.post(
							"/admin/user/editpositionform/"+global_pos_val,
							{func : ""},
							function(oReply){
								document.getElementById("editposition_content").innerHTML = oReply.CONTENT;
							},
							"json"
							); 
						}
}

function edit_position_save(){
	var id = $("#editcybpos_id").val();
	var name = $("#editcybpos_name").val();
	var max =  $("#editmax_available").val();
	var duties =  $("#editduties").val();
	if(name == ''){
		alert('Please fill up a position name.');
	} else if(duties == ''){
		alert('Please fill up duties.');
	} else{
		$.post(
			"/admin/user/editpositionsave",
			{
			id : id,
			name : name,
			max : max,
			duties : duties
			},
			function(oReply){
				if(oReply.STATUS == 'Success'){
					alert("Position was succesffully updated.");
					$("#editposition_Dialog").dialog("close");
					loadPositionsTable();
				}
			},
			"json"
		); 
	}
}

function remove_position(){
						global_offline_check = false;
						global_offline_val = "";	
						$("input[id=positions_master_admin_bCheckThis]").each(
							function(){
								if($(this).is(':checked') == true){
									global_offline_check = true;
									global_offline_val += $(this).val()+'-';							
								}
							}
						);
						global_offline_val = global_offline_val.replace(/(\s+)?.$/, "");
						if(global_offline_check == false){
							alert("Please select a position.");
						} else{
							var answer = confirm("Are you sure you want to remove this positon from a school?")
							if (answer){
									$.post(
									"/admin/user/removeposition/"+global_offline_val,
									{func : ""},
									function(oReply){
										if(oReply.STATUS == "Success"){
										alert("The Position was successfully removed.");
										loadPositionsTable();
										}
									},
									"json"
									);
							}
						}
}

function loadPositionsTable(){
	var coordinatorid = '';
	$("input[id=volunteer_master_admin_school_bCheckThis]").each(
		function(){
			if($(this).is(':checked') == true){
				coordinatorid = $(this).val();							
			}
		}
	);

	$.post(
		"/admin/user/getpositions/"+coordinatorid+"_role",
	{func : ""},
		function(oReply){
			document.getElementById("positions_volunteer_content").innerHTML = oReply.CONTENT;
		},
	"json"
	); 
}

function tooltipCoordinatorLoader(){
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

function totalKindnessWorkz_Dialog(adminid){
	$("#totalKindnessWorkz_Dialog").dialog({
				modal: true,
				autoOpen: true,
				resizable: false,
				width: 530,
				buttons: {
					"Ok": function(){
					$(this).dialog("close");
					}
				}
	});	
	$("#totalKindnessWorkz_div").html('<img src="/misc/button-loader-big.gif" /><span>');		
	$.post(
	"/admin/user/totalKindnessWorkz/"+adminid,
	{func : ""},
	function(oReply){
		if(oReply.STATUS == "Success"){
		$("#totalKindnessWorkz_div").html(oReply.OUTPUT);
		}
	},
	"json"
	);
}

function volPendingKindnessWorkz_Dialog(adminid){
	$("#volPendingKindnessWorkz_Dialog").dialog({
				modal: true,
				autoOpen: true,
				resizable: false,
				width: 530,
				buttons: {
					"Ok": function(){
					$(this).dialog("close");
					}
				}
	});
	
	$("#volPendingKindnessWorkz_div").html('<img src="/misc/button-loader-big.gif" /><span>');		
	$.post(
	"/admin/user/volPendingKindnessWorkz/"+adminid,
	{func : ""},
	function(oReply){
		if(oReply.STATUS == "Success"){
		$("#volPendingKindnessWorkz_div").html(oReply.OUTPUT);
		}
	},
	"json"
	);
}