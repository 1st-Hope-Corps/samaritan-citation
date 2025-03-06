var volunteer_aSelectedCat = new Array();

$(document).ready(
	function(){
	/*
		$("#volunteer_bOptTutor").click(
			function(){
				volunteer_CheckThis(this.id);
			}
		);
	*/	
		$("#volunteer_bOptInstantAnswer").click(
			function(){
				volunteer_PopulateCat("volunteer_cat_1", 0);
				volunteer_Toggle("volunteer_type_instant_answer");
			}
		);
		
		$("#volunteer_type_instant_answer_cancel").click(
			function(){
				volunteer_Toggle("volunteer_type_instant_answer");
				//$("#volunteer_bOptInstantAnswer").attr("checked", false);
			}
		);
		
		$("#volunteer_type_instant_answer_proceed").click(
			function(){
				var volunteer_sAlertMsg = "Please comply with the following:\n\n";
				var volunteer_iMsgLen = volunteer_sAlertMsg.length;
				
				if (volunteer_aSelectedCat.length < 1) volunteer_sAlertMsg += " - select, at least, 1 category\n";
				if (!$("#volunteer_bNotifyInMyCat").is(":checked") && !$("#volunteer_bNotifyAll").is(":checked")) volunteer_sAlertMsg += " - you should opt-in to, at least, one of the notification options";
				
				if (volunteer_sAlertMsg.length == volunteer_iMsgLen){
					var bNotifyInMyCat = ($("#volunteer_bNotifyInMyCat").is(":checked")) ? $("#volunteer_bNotifyInMyCat").val():0;
					var bNotifyAll = ($("#volunteer_bNotifyAll").is(":checked")) ? $("#volunteer_bNotifyAll").val():0;
					var volunteer_sBasePath = '/';
					
					$.post(
						volunteer_sBasePath+"askeet/tutor/optin",
						{
							id: $("#volunteer_bOptInstantAnswer").val(),
							cat: volunteer_Implode(",", volunteer_aSelectedCat),
							nc: bNotifyInMyCat,
							na: bNotifyAll,
							st: 'add'
						},
						function(sReply){
							if (sReply.STATUS == "Success"){
								top.location = volunteer_sBasePath+"mystudies/getinvolved/instanttutor/dashboard";
							}else{
								alert(sReply.ERRMSG+"\nSQL:\n"+sReply.SQL);
							}
						},
						"json"
					);
				}else{
					alert(volunteer_sAlertMsg);
				}
			}
		);
		
		$("#forgotstart").click(
			function(){
				$("#forgot_start_Dialog").dialog({
								modal: true,
								autoOpen: true,
								resizable: false,
								width: 630,
								buttons: {
									"Submit Kindnez workz": function(){
									submit_forgot_kindness_workz();
									},
									"Cancel": function(){
									$(this).dialog("close");
									}
								}
				});	
				
				$("#forgot_start_Dialog_content").html('<img src="/misc/button-loader-big.gif" /><span>');
				$.post(
				Drupal.settings.basePath + "volunteer/CybGetContent",
				{
				type: "forgot-form"
				},
				function(oReply){
					$("#forgot_start_Dialog_content").html(oReply.OUTPUT);
				},
				"json"
				);
			}
		);
	
		$("#volunteer_proceed_instant_tutor").click(
			function(){
				top.location = volunteer_sBasePath+"askeet/tutor";
			}
		);
		
		$("#volunteer_cat_1").change(
			function(){
				volunteer_PopulateCat("volunteer_cat_2", $(this).val(), "volunteer_cat_3");
			}
		);
		
		$("#volunteer_cat_2")
			.change(
				function(){
					volunteer_PopulateCat("volunteer_cat_3", $(this).val());
				}
			)
			.dblclick(
				function(){
					if (this.selectedIndex != -1){
						var sSelectedCat = this.options[this.selectedIndex].text;
						var bHasSub = (sSelectedCat.substring(sSelectedCat.length-1) == ">") ? true:false;
						
						if (!bHasSub){
							var sSelectedCat = $("#volunteer_cat_1 option:selected").text() + " " + sSelectedCat;
							
							volunteer_CheckSelectedArray($(this).val(), volunteer_aSelectedCat, sSelectedCat);
						}
					}
				}
			);
		
		$("#volunteer_cat_3").dblclick(
			function(){
				if (this.selectedIndex != -1){
					var sSelectedCat = $("#volunteer_cat_1 option:selected").text() + " " + $("#volunteer_cat_2 option:selected").text() + " " + this.options[this.selectedIndex].text;
					
					volunteer_CheckSelectedArray($(this).val(), volunteer_aSelectedCat, sSelectedCat);
				}
			}
		);
		
		$("#volunteer_add_category").click(
			function(){
				if ($("#volunteer_cat_3 option:selected").val() != undefined){
					var sSelectedCat = '<p id="' + $("#volunteer_cat_3 option:selected").val() + '">' + $("#volunteer_cat_1 option:selected").text() + " " + $("#volunteer_cat_2 option:selected").text() + " " + $("#volunteer_cat_3 option:selected").text() + ' ' + '<a href="javascript:void(0);" onclick="removecategoryitem('+ $("#volunteer_cat_3 option:selected").val() +')">remove</a>' + '</p>';
					var sSelectedView = $("#volunteer_cat_1 option:selected").text() + " " + $("#volunteer_cat_2 option:selected").text() + " " + $("#volunteer_cat_3 option:selected").text();
					volunteer_CheckSelectedArray($("#volunteer_cat_3 option:selected").val(), volunteer_aSelectedCat, sSelectedCat, sSelectedView);
				} else{
					if ($("#volunteer_cat_2 option:selected").val() != undefined && $("#volunteer_cat_3 option").val() == undefined){
					var sSelectedCat = '<p id="' + $("#volunteer_cat_2 option:selected").val() + '">' + $("#volunteer_cat_1 option:selected").text() + " " + $("#volunteer_cat_2 option:selected").text() + " " + '<a href="javascript:void(0);" onclick="removecategoryitem('+ $("#volunteer_cat_2 option:selected").val() +')">remove</a>' + '</p>';
					var sSelectedView = $("#volunteer_cat_1 option:selected").text() + " " + $("#volunteer_cat_2 option:selected").text();
					volunteer_CheckSelectedArray($("#volunteer_cat_2 option:selected").val(), volunteer_aSelectedCat, sSelectedCat, sSelectedView);
					} else{
					alert('Please select a category first');
					}
				}
			}
		);

		$("a#button_children_online_volunteer").click(

			function(){
				$("#incybrary_block_title").text("On Duty");
				RequestImage_volunteer("online");
			}
		);
		
		$("a#button_children_24_volunteer").click(
			function(){
				$("#incybrary_block_title").text("In the last 24 hours");
				RequestImage_volunteer(24);
			}
		);
		
		$("a#button_children_all_volunteer").click(
			function(){
				$("#incybrary_block_title").text("All Volunteers");
				RequestImage_volunteer("all");
			}
		);
		if(window.location.pathname == '/community/volunteerteamdashboard'){
		RequestImage_volunteer("online");
		}
		
		$("#cybrarian_start").click(
			function(){
				$("#start_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 530,
						buttons: {
							"Ok": function(){
							$(this).dialog("close");
							$("#startStatus").hide();
							}
						}
				});
				$("#start_Dialog_content").show();
				$("#start_Dialog_content").html('<img src="/misc/button-loader-big.gif" /><span>');
				$.post(
				Drupal.settings.basePath + "volunteer/CybGetContent",
				{type: "start"},
				function(oReply){
					if(oReply.OUTPUT == 'SHOW'){
					$("#start_Dialog_content").hide();
					$("#start_Dialog_content_box").show();
					} else{
					$("#start_Dialog_content").html(oReply.OUTPUT);
					$("#start_Dialog_content_box").hide();
					}
				},
				"json"
				);
			}
		);
		
		$("#change_position_ajax").click(
			function(){
				$("#change_position_ajax").hide();
				$("#change_position_ajax_loader").show();
				if($("#cybrariantitle").val() !== ''){
					$.post(
					Drupal.settings.basePath + "volunteer/changepositionajax/"+$("#cybrariantitle").val(),
					{func: ""},
					function(oReply){
						if(oReply.STATUS == 'Error'){
							alert('There was an error starting the time to the database.');
						} else{
								$.post(
								Drupal.settings.basePath + "volunteer/starttime/"+$("#cybrariantitle").val(),
								{func: ""},
								function(oReply){
									if(oReply.STATUS == 'Error'){
										$("#startStatus").html('There was an error starting the time to the database.');
									} else if(oReply.STATUS == 'No Activity'){
									    $("#startStatus").html('<span style="color:red;">You are already logged-in. Your time is already running.</span>');
									} else{
										$("#startStatus").html('<span style="color:green;">You have successfully logged-in. Your time is now running.</span>');
									}
									$("#startStatus").show();
								},
								"json"
								);
								$("#change_position_ajax_loader").hide();
								$("#change_position_ajax").show();
						}
					},
					"json"
					);
				}
			}
		);
		
		$("#cybrarian_stop").click(
			function(){
				$("#stop_Dialog").dialog({
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
					$("#stopTime_dialog").hide();
					$("#stop_Dialog_content_indicator").hide();
					$("#stop_Dialog_content_indicator").show();
					$("#stop_Dialog_content_indicator").html('<img src="/misc/button-loader-big.gif" /><span>');
					$.post(
					Drupal.settings.basePath + "volunteer/CybGetContent",
					{type: "stop"},
					function(oReply){
						if(oReply.OUTPUT == 'Activated'){
							$("#stopTime_notactivated").hide();
							$("#stopTime_confirmation").show();
						} else{
							$("#stopTime_confirmation").hide();
							$("#stopTime_notactivated").show();
						}
						$("#stop_Dialog_content_indicator").hide();
					},
					"json"
					);
			}
		);
		
		$("#stopTimeAgree").click(
			function(){
				$.post(
				Drupal.settings.basePath + "volunteer/stoptime",
				{func: ""},
				function(oReply){
					if(oReply.STATUS == 'Error'){
						alert('There was an error stoping the time to the database.');
					} else if(oReply.STATUS == 'NOAVAILABLE'){
						alert('You haven\'t started the time yet.');
					} else{
						var start = oReply.START;
						var end = oReply.END;
						var elapse = oReply.ELAPSE;
						var position = oReply.POSITION;
						var activityid = oReply.ID;
						
						$("#final_starttime").text(start);
						$("#final_endtime").text(end);
						$("#final_elapsetime").text(elapse);
						$("#final_position").text(position);
						
						$("#fstart").text(start);
						$("#fstop").text(end);
						$("#felapse").text(elapse);
						$("#kindnesstitle").val(position);
						
						$("#activityid").val(activityid);
						$("#stopTime_confirmation").hide();
						$("#stopTime_dialog").show();
					}
				},
				"json"
				);
			}
		);
		
		$("#stopTimeDisagree").click(
			function(){
				$("#stop_Dialog").dialog("close");
			}
		);
		
		$("#cybrarian_current").click(
			function(){
				$("#current_Dialog_content").html('<img src="/misc/button-loader-big.gif" /><span>');
				$.post(
				Drupal.settings.basePath + "volunteer/CybGetContent",
				{type: "current"},
				function(oReply){
					$("#current_Dialog_content").html(oReply.OUTPUT);
				},
				"json"
				);
				
				$("#current_Dialog").dialog({
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
		
		$("#cybrarian_status").click(
			function(){
				$("#status_Dialog_content").html('<img src="/misc/button-loader-big.gif" /><span>');
				$.post(
				Drupal.settings.basePath + "volunteer/CybGetContent",
				{type: "status"},
				function(oReply){
					$("#status_Dialog_content").html(oReply.OUTPUT);
				},
				"json"
				);
				
				$("#status_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 640,
						buttons: {
							"Ok": function(){
							$(this).dialog("close");
							}
						}
				});
			}
		);
		
		$("#cybrarian_convert").click(
			function(){
				$("#convert_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 530,
						buttons: {
						    "Convert": function (){
							_Bank_SetButtonConvert("iTimeToConvert");
							},
							"Cancel": function(){
							$(this).dialog("close");
							}
						}
				});
				
				$.post(
				Drupal.settings.basePath + "secure/kindness/callback/details",
				{func: "kindness_details"},
				function(sReply){
					iKindnessBalance = sReply.RETURN.HOURS;
					iHopeBucksBalance = sReply.RETURN.BALANCE;
					$("#iKindnessBalance").val(iKindnessBalance);
					var sKindnessNotice = sReply.RETURN.NOTICE;
						$("#bank_deposit_notice").text(sKindnessNotice);
						$("#bank_bucks_notice").html("<div align='right'><b>Balances: " + iHopeBucksBalance + " Hope Bucks</b></div>");
					},
					"json"
				);
			}
		);
		
		$("#cybrarian_schedule").click(
			function(){
				$("#schedule_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 730,
						buttons: {
							"Ok": function(){
							$(this).dialog("close");
							}
						}
				});
				
				$("#schedule_Dialog_content").html('<img src="/misc/button-loader-big.gif" /><span>');
				$.post(
				Drupal.settings.basePath + "volunteer/CybGetContent",
				{type: "schedule"},
				function(oReply){
					$("#schedule_Dialog_content").html(oReply.OUTPUT);
				},
				"json"
				);
			}
		);
		
		$("#cybrarian_duties").click(
			function(){
				$("#duties_Dialog").dialog({
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
		
		$("#positionDetails").click(
			function(){
				$("#positionDetails_Dialog").dialog({
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
		
		$("#assignedCoordinator").click(
			function(){
				$("#assignedCoordinator_Dialog").dialog({
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
		
		$("#cybrary_btnVolunteerDeactivate").click(
			function(){
				$("#deactivate_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 430,
						buttons: {
							"Deactivate": function(){
							location = Drupal.settings.basePath+"volunteer/administer/deactivate";
							},
							"Cancel": function(){
							$(this).dialog("close");
							}
						}
				});
			}
		); 
		
		$("#cybrarian_kindness_report").click(
			function(){
				
				$("#stop_Dialog").dialog("close");
				
				$("#kindnessreport_Dialog").dialog({
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
		
		$("#kindnesssubmit").click(
			function(){
			
			    var kindnesstitle = $("#kindnesstitle").val();
				var kindnessdescription = $("#kindnessdescription").val();  
				var kindnesslocation = $("#kindnesslocation").val(); 
				var kindnesspromised = $("#kindnesspromised").is(':checked');
				var activityid = $("#activityid").val();
				
				if(kindnesstitle == ''){
					alert('Please fill up the kindness title.');
				} else if (kindnessdescription == ''){
					alert('Please fill up the kindness description.');
				} else if (kindnesslocation == ''){
					alert('Please fill up the kindness location.');
				} else if (kindnesspromised == false){
					alert('Please check the kindness promised.');
				} else{
					$.post(
					Drupal.settings.basePath + "volunteer/kindnessSave",
					{
					vkindnesstitle : kindnesstitle,
					vkindnessdescription : kindnessdescription,
					vkindnesslocation : kindnesslocation,
					vkindnesspromised : kindnesspromised,
					vactivityid : activityid
					},
					function(oReply){
						if(oReply.STATUS == 'Success'){
							alert("Your kindness workz has been submitted.");
							$("#kindnessreport_Dialog").dialog("close");
						}
					},
					"json"
					);
				}
			}
		);
		
		$("#kindnesssubmit_edit").click(
			function(){
			
			    var kindnesstitle = $("#kindnesstitle_edit").val();
				var kindnessdescription = $("#kindnessdescription_edit").val();  
				var kindnesslocation = $("#kindnesslocation_edit").val(); 
				var kindnesspromised = $("#kindnesspromised_edit").is(':checked');
				var activityid = $("#activityid_edit").val();
				
				if(kindnesstitle == ''){
					alert('Please fill up the kindness title.');
				} else if (kindnessdescription == ''){
					alert('Please fill up the kindness description.');
				} else if (kindnesslocation == ''){
					alert('Please fill up the kindness location.');
				} else if (kindnesspromised == false){
					alert('Please check the kindness promised.');
				} else{
					$.post(
					Drupal.settings.basePath + "volunteer/kindnessSave",
					{
					vkindnesstitle: kindnesstitle,
					vkindnessdescription: kindnessdescription,
					vkindnesslocation: kindnesslocation,
					vkindnesspromised: kindnesspromised,
					vactivityid: activityid
					},
					function(oReply){
						if(oReply.STATUS == 'Success'){
							alert("Your kindness workz has been successfully edited.");
							$("#kindnessreport_Dialog_edit").dialog("close");

							$("#status_Dialog_content").html('<img src="/misc/button-loader-big.gif" /><span>');
							$.post(
							Drupal.settings.basePath + "volunteer/CybGetContent",
							{type: "status"},
							function(oReply){
								$("#status_Dialog_content").html(oReply.OUTPUT);
							},
							"json"
							);
						}
					},
					"json"
					);
				}
			}
		);
		
		/*$("#btnBankDeposit")
		.unbind("click")
		.click(
			function (){
				_Bank_SetButtonConvert("iTimeToConvert");
			}
		);*/
	}
);

function editLinkKindness(act_id, istatus){
				$("#kindnessreport_Dialog_edit").dialog({
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
				Drupal.settings.basePath + "volunteer/CybGetContent",
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
						$("#iComment").hide();
						$("#promise_edit").show();
						$("#kindnessdescription_edit_span").hide();
						$("#kindnesssubmit_edit").show();
						$("#kindnessdescription_edit").show();
						$("#fstart_edit").text(start);
						$("#fstop_edit").text(end);
						$("#felapse_edit").text(elapse);
						$("#kindnesstitle_edit").val("");
						$("#kindnesstitle_edit_label").text("");
						$("#kindnesslocation_edit_label").text("");
						$("#kindnesslocation_edit").val("");
						$("#kindnessdescription_edit").val("");
						$("#kindnesstitle_edit").val(position);
						$("#kindnesslocation_edit").val(location);
						$("#kindnesstitle_edit_label").text(position);
						$("#kindnesslocation_edit_label").text(location);
						$("#kindnessdescription_edit").val(desc);
						if(istatus == "approved"){
						$("#kindnessdescription_edit").hide();
						$("#kindnessdescription_edit_span").text(desc);
						$("#kindnessdescription_edit_span").show();
						$("#kindnesssubmit_edit").hide();
						$("#promise_edit").hide();
						}
						if(istatus == "approved" || istatus == "disapproved"|| istatus == "pending"){
							if(oReply.COMMENT !== ""){
							$("#iComment").show();
							$("#iComment").html(oReply.COMMENT);
							}
						}
						$("#activityid_edit").val("");
						$("#activityid_edit").val(activityid);
						$("#stopTime_confirmation").hide();
						$("#stopTime_dialog").show();
				},
				"json"
				); 
}

function change_troopteams_volunteer(id, type, coltroop){
		$.post(
		Drupal.settings.basePath + "volunteer/loadtroopteams/" + id + "/" + type + "/" + coltroop,
		{func: ""},
		function(oReply){
			$("#teams_div").html(oReply.OUTPUT);
			$("#teams_lines").html(oReply.LINES);
		},
		"json"
		);
		
}

function change_troopteams_volunteer2(id, type, coltroop){
		$.post(
		Drupal.settings.basePath + "community/loadtroopteams/" + id + "/" + type + "/" + coltroop + "/" + "volunteer",
		{func: ""},
		function(oReply){
			$("#teams_div").html(oReply.OUTPUT);
			$("#teams_lines").html(oReply.LINES);
		},
		"json"
		);
		
}

function teamsselectbyschools_volunteer(val){
   if(val !== ''){
	if(val == 'Maximo Estrella Elementary School'){
	$("#group_name_teams").html('<b>'+val+'</b><br/>Volunteer Organization');
	$("#coming_soonmsg").hide(); 
	$("#heirarchy_menu").show();
	} else{ 
	$("#group_name_teams").html('<b>'+val+'</b><br/>Volunteer Organization');
	$("#coming_soonmsg").show();
	$("#heirarchy_menu").hide();
	}
 }
}

function open_troopteams(id){

		$.post(
		Drupal.settings.basePath + "volunteer/viewteam/" + id,
		{func: ""},
		function(oReply){
			$("#team_Dialog_output").html(oReply.OUTPUT);
			RequestImage_volunteer("online");
		},
		"json"
		);
		
		$("#team_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 730,
						position: 'top',
						buttons: {
							"Ok": function(){
							$(this).dialog("close");
							}
						}
		});
		
}

function chooseaTeam(){
	$.post(
		Drupal.settings.basePath + "volunteer/chooseteam",
		{func: ""},
		function(oReply){
			$("#teamchoose_Dialog_output").html(oReply.OUTPUT);
		},
		"json"
	);

	$("#teamchoose_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 430,
						position: 'top',
						buttons: {
							"Ok": function(){
							$(this).dialog("close");
							}
						}
		});
}

function changeTeambySchool(val){
	if(val !== ''){
		if(val == '19' || val == '18'){
			$("#team_choose").html("");
			$("#statusMessageteam").html("<b style='color:#000000;'>No Teams Yet.</b>");
			$("#chooseteamjoinnow").hide();	
		} else{
			$.post(
				Drupal.settings.basePath + "volunteer/changeteambyschool/" + val,
				{func: ""},
				function(oReply){
					$("#team_choose").html(oReply.OUTPUT);
					$("#chooseteamjoinnow").show();
				},
				"json"
			);
			$("#statusMessageteam").html("");		
		}
	}
}

function chooseteamjoinnow(){
	if($("#team_choose").val() !== ''){
		$.post(
				Drupal.settings.basePath + "volunteer/saveteamschool/" + $("#team_choose").val(),
				{func: ""},
				function(oReply){
					if(oReply.STATUS == 1){
					$("#chooseteamjoinnow").hide();
					$("#statusMessageteam").html("<b style='color:#000000;'>You are already a member of a team.</b> <a href='" + Drupal.settings.basePath + "mystudies/getinvolved/cybrarian'>click here to go to your dashboard</a>");		
					} else{
					$("#statusMessageteam").html("<b style='color:#000000;'>You have selected the "+oReply.TEAM+" from "+oReply.SCHOOL+".</b> <a href='" + Drupal.settings.basePath + "mystudies/getinvolved/cybrarian'>click here to go to your dashboard</a>");		
					$("#chooseteamjoinnow").hide();
					}
				},
				"json"
			);
	} else{
		alert("Please select a school and team.");
	}
}

function chooserandomteam(){
			$.post(
				Drupal.settings.basePath + "volunteer/chooserandomteam",
				{func: ""},
				function(oReply){
					if(oReply.STATUS == 1){
					window.location = Drupal.settings.basePath + 'mystudies/getinvolved/cybrarian';
					}
				},
				"json"
			);
}

function volunteer_CheckSelectedArray(sNeedle, aHaystack, sSelectedCat, sSelectedView){
	if (jQuery.inArray(sNeedle, aHaystack) >= 0){
		alert("You already selected "+sSelectedView+".");
	}else{
		aHaystack[aHaystack.length] = sNeedle;
		
		if ($("#volunteer_selected_cats").html() != ""){
			$("#volunteer_selected_cats").append(sSelectedCat);
		}else{
			$("#volunteer_selected_cats").html(sSelectedCat);
		}
	}
}

function removecategoryitem(id){
	for(var i=0; i<volunteer_aSelectedCat.length;i++ ){ 
	 if(volunteer_aSelectedCat[i]==id)
	 volunteer_aSelectedCat.splice(i,1); 
	}

	$("#"+(id)).html("");
}

function volunteer_becomeInstantTutor(id){
	volunteer_CheckThis(id);
}

function volunteer_CheckThis(sOptIn){
		var sPostURL = "volunteer/optin";
		var sType = "tutor";
		var sRedirectTo = "mystudies/getinvolved/instanttutor";
		var volunteer_sBasePath = Drupal.settings.basePath;
		$.post(
			volunteer_sBasePath + sPostURL,
			{
				id: sOptIn,
				type: sType
			},
			function(sReply){
				if (sReply.STATUS == "Success"){
					top.location = volunteer_sBasePath + sRedirectTo;
				}else{
					alert(sReply.ERRMSG+"\nSQL:\n"+sReply.SQL);
				}
			},
			"json"
		);
}

function volunteer_PopulateCat(sContainerId, iIdVal, sContainerToNull){
	if (sContainerToNull != null) 
	$("#"+sContainerToNull).html('<optgroup label="No sub-category selected"></optgroup>');
	
	var volunteer_sBasePath = Drupal.settings.basePath;
	
	$.post(
		volunteer_sBasePath + "askeet/question/cat",
		{
			id: iIdVal
		},
		function(sReply){
			var sOptions = "";
			
			if (sReply.length > 0){
				for (i=0; i<sReply.length; i++){
					sTitle = sReply[i].TITLE;
					sTitle += (sReply[i].LEAF == 0) ? " >":"";
					
					sOptions += '<option value="'+sReply[i].ID+'" title="'+sTitle+'">'+sTitle+'</option>';
				}
			}else{
				sOptions += '<optgroup label="No sub-categories"></optgroup>';
			}
			
			$("#"+sContainerId).html(sOptions);
		},
		"json"
	);
}

function volunteer_FormCheck(aFieldId){
	
}

function volunteer_Implode(sGlue, aPieces){
	return ((aPieces instanceof Array) ? aPieces.join(sGlue):aPieces);
}

function volunteer_Toggle(sDivId){
	$("#"+sDivId).toggle("slow");
}

function RequestImage_volunteer(sRequestType){
			//$("#incybrary_avatar").attr("src", "/sites/default/files/pictures/default_image.jpg");
			$("#incybrary_avatar").hide();
			$("#incybrary_hopeful_details").html("The selected volunteer's description will go here.");
			
			$("#incybrary_hopeful_nav").html("&nbsp;");
			$("div#incybrary_hopeful_list").text("Fetching data...");

			$.post(
				Drupal.settings.basePath + "teamvolunteers/"+sRequestType+'/'+$("#teamid").val(),
				{ func: "GetChildren" },
				function(sReply){
					var sOutput = '';
					aChildren = sReply.RETURN;
					aDetails = sReply.DETAILS;
					aTotal = sReply.TOTAL;
				
					$("#kindnesstotaltext").text(aTotal[0].totalkindness);
					$("#teammemberstotaltext").text(aTotal[0].totalteamcount);
					if (aChildren.length > 0){
						PageThis_volunteer();
					}else{
						$("div#incybrary_hopeful_list").html("No volunteer to list, yet.");
					}
				if(sRequestType == 'online'){
				$("#inthecybrarynow").html("<span style='color:red'>On Duty</span>");
				}
				},
				"json"
			);
}

// paging teams 
function button_children_online(){
	$("#incybrary_block_title").text("In the Cybrary Now");
	RequestImage_volunteer("online");
}
		
function button_children_24(){
	$("#incybrary_block_title").text("In the last 24 hours");
	RequestImage_volunteer(24);
}
		
function button_children_all(){
	$("#incybrary_block_title").text("All Hopefuls");
	RequestImage_volunteer("all");
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
					Drupal.settings.basePath + "teamroles/getroles",
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
						Drupal.settings.basePath + "teamvolunteers/profile",
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
							} 
							
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
											Drupal.settings.basePath + "teamvolunteers/profile",
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
					Drupal.settings.basePath + "teamroles/getroles",
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

function _Bank_SetButtonConvert(sThisField){
	var iTimeToConvert = $("#"+sThisField).val();
	var iKindnessBalance = $("#iKindnessBalance").val();
	if (is_numeric(iTimeToConvert) && iTimeToConvert <= iKindnessBalance){
		$("#btnBankDeposit").val("Wait...").attr("disabled", "true");
		
		$.post(
			Drupal.settings.basePath + "secure/kindness/callback/convert",
			{iTime: iTimeToConvert},
			function(sReply){
				if (sReply.STATUS == "Success"){
					alert("Convertion Successful!");
					$("#btnKindnessConvert").val("Convert to Hope Bucks");	
					$("#btnKindnessConvert").removeAttr('disabled');
				}
				
				$("#btnBankDeposit").val("Convert To Valiants").attr("disabled", "");
				//$("#bank_deposit_status").text(sReply.RETURN);
				alert(sReply.RETURN);
				$("#convert_Dialog").dialog("close");
			},
			"json"
		);
	}else{
		if (!is_numeric(iTimeToConvert)) alert("You have specified an invalid number. Example correct entries: 1, 1.5, 0.25, etc.");
		if (iTimeToConvert > iKindnessBalance) alert("The time you can convert cannot excees your accumulated time ("+iKindnessBalance+").")
	}
}

function is_numeric(mixed_var){ 
	if (mixed_var === '') return false;

	return !isNaN(mixed_var * 1);
}
// eof paging teams

function respond_schedule(id){
	$("#schedule_respond_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 630,
						height: 440,
						buttons: {
							"Yes, I will volunteer": function(){
							respond_schedule_save(id, '1');
							},
							"No, I will not volunteer": function(){
							respond_schedule_save(id, '2');
							},
							"Cancel": function(){
							$(this).dialog("close");
							}
						}
	});	
	
	$("#schedule_respond_Dialog_content").html('<img src="/misc/button-loader-big.gif" /><span>');
	$.post(
	Drupal.settings.basePath + "volunteer/CybGetContent",
	{
	type: "schedule-respond",
	id: id
	},
	function(oReply){
		$("#schedule_respond_Dialog_content").html(oReply.OUTPUT);
	},
	"json"
	);
}

function respond_schedule_save(id, status){

	var comment = $("#ischedcomment").val();
	
	$("#schedule_respond_Dialog_content").html('<img src="/misc/button-loader-big.gif" /><span>');
	$.post(
	Drupal.settings.basePath + "volunteer/CybGetContent",
	{
	type: "schedule-respond-save",
	id: id,
	status: status,
	comment: comment
	},
	function(oReply){
		$("#schedule_respond_Dialog").dialog("close");
		$("#schedule_Dialog_content").html('<img src="/misc/button-loader-big.gif" /><span>');
		$.post(
		Drupal.settings.basePath + "volunteer/CybGetContent",
		{type: "schedule"},
		function(oReply){
			$("#schedule_Dialog_content").html(oReply.OUTPUT);
		},
		"json"
		);
	},
	"json"
	);
}

function submit_forgot_kindness_workz(){
				var forgottitle = $("#forgottitle").val();
				var forgotdescription = $("#forgotdescription").val();  
				var forgotlocation = $("#forgotlocation").val();
				var forgotMonth = $("#forgotMonth").val(); 
				var forgotDay = $("#forgotDay").val(); 
				var forgotYear = $("#forgotYear").val(); 
				var forgotStarttime = $("#forgotStarttime").val();
				var forgotEndtime = $("#forgotEndtime").val();
				var forgotpromised = $("#forgotpromised").is(':checked');
				
				if(forgottitle == ''){
					alert('Please select a kindness title.');
				} else if (forgotdescription == ''){
					alert('Please fill up the kindness description.');
				} else if (forgotlocation == ''){
					alert('Please fill up the kindness location.');
				} else if (forgotpromised == false){
					alert('Please check the kindness promised.');
				} else if (forgotStarttime == ''){
					alert('Please select a start time.');
				} else if (forgotEndtime == ''){
					alert('Please select a end time.');
				} else{
					$.post(
					Drupal.settings.basePath + "volunteer/CybGetContent",
					{
					type: "forgot-form-submit",
					title : forgottitle,
					desc : forgotdescription,
					location : forgotlocation,
					promised : 1,
					date : forgotYear + "-" + forgotMonth + "-" +  forgotDay,
					starttime : forgotStarttime,
					endtime : forgotEndtime
					},
					function(oReply){
						if(oReply.OUTPUT == 'Success'){
							alert("Your kindness workz has been submitted.");
							$("#forgot_start_Dialog").dialog("close");
						}
					},
					"json"
					);
				}
}

function calendar_dialog(uid){
				$("#calendar_Dialog").dialog({
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
				var url = Drupal.settings.basePath + "calendar.php?uid=" + uid;
				$('iframe#calendar_url').attr('src', url);
}


