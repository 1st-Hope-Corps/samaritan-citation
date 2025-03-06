var askeet_iEnrollStatus = 0;
var askeet_bPostSuccess = false;
var askeet_iCatId = 0;
var askeet_sCatTitle = "";
var askeet_sBasePath = "/";
$(document).ready(
	function(){
		$.post(
			askeet_sBasePath+"askeet/enroll/check",
			{ func: "CheckEnrollee" },
			function(sReply){
				if (sReply.STATUS == 1){
					askeet_iEnrollStatus = 1;
					$("#AskeetOptInText").text("Ask a new");
					$("#askeet_enrol_notice").hide();
				}
			},
			"json"
		);
		
		$("#AskeetOptIn").click(
			function(){
				if (askeet_iEnrollStatus == 0){
					$.post(
						askeet_sBasePath+"askeet/enroll",
						{ func: "EnrollUser" },
						function(sReply){
							if (sReply.STATUS == "Success"){
								askeet_iEnrollStatus = 1;
								$("#AskeetOptInText").text("Ask a new");
							}else{
								alert(sReply.ERRMSG);
							}
						},
						"json"
					);
				}else{
					askeet_ShowForm();
					$("#askeet_form").load(
						askeet_sBasePath+"askeet/enroll/form",
						{id:123},
						function(sResponseText, sTextStatus, XMLHttpRequest){
							askeet_PopulateCat("askeet_cat_1", 0);
							
							$("#askeet_cat_1").change(
								function(){
									askeet_iCatId = 0;
									askeet_PopulateCat("askeet_cat_2", $(this).val(), "askeet_cat_3");
								}
							);
							
							$("#askeet_cat_2").change(
								function(){
									askeet_iCatId = 0;
									var sSelectedCat = this.options[this.selectedIndex].text;
									var bHasSub = (sSelectedCat.substring(sSelectedCat.length-1) == ">") ? true:false;
									
									askeet_PopulateCat("askeet_cat_3", $(this).val());
									
									if (!bHasSub){
										askeet_iCatId = $(this).val();
										askeet_sCatTitle = $("#askeet_cat_1 option:selected").text() + " " + sSelectedCat;
									}
								}
							);
							
							$("#askeet_cat_3").change(
								function(){
									if (this.selectedIndex != -1){
										askeet_iCatId = $(this).val();
										askeet_sCatTitle = $("#askeet_cat_1 option:selected").text() + " " + $("#askeet_cat_2 option:selected").text() + " " + this.options[this.selectedIndex].text;
									}
								}
							);
						}
					);
				}
			}
		);

		if(true || jQuery.cookie && jQuery.cookie('glang') == null){
		
			if ($("#askeet_VolunteerCatList").length == 1){
				$("#askeet_VolunteerCatList").treeview(
					//{url: askeet_sBasePath+"askeet/question/cats/instanttutor", unique: true}
					{url: Drupal.settings.basePath+"askeet/question/cats/instanttutor", unique: true}
				);
			}
		}
		
		$("#askeet_questions").load(askeet_sBasePath+"askeet/featured");
		
		$("#askeet_feature").click(
			function(){
				askeet_ShowPage();
				$("#askeet_questions").load(askeet_sBasePath+"askeet/featured").show("slow");
			}
		);
		
		$("#askeet_popular").click(
			function(){
				askeet_ShowPage();
				$("#askeet_questions").load(askeet_sBasePath+"askeet/popular").show("slow");
			}
		);
		
		$("#askeet_latest").click(
			function(){
				askeet_ShowPage();
				$("#askeet_questions").load(askeet_sBasePath+"askeet/latest").show("slow");
			}
		);
		
		$("#askeet_latest_answers").click(
			function(){
				askeet_ShowPage();
				$("#askeet_questions").load(askeet_sBasePath+"askeet/latest/answers").show("slow");
			}
		);
		
		$("#askeet_open_question").click(
			function(){
				$("#askeet_questions").load(askeet_sBasePath+"askeet/open").show("slow");
			}
		);
		
		$("#askeet_close_question")
			.hover(
				function(){
					$(this).css("cursor", "pointer");
				},
				function(){
					$(this).css("cursor", "default");
				}
			)
			.click(
				function(){
					var bConfirm = confirm("Are you sure you want to close this question?");
					
					if (bConfirm){
						$.post(
							askeet_sBasePath+"askeet/question/close",
							{
								id: $("#askeet_question_id").val(),
							},
							function(sReply){
								if (sReply.STATUS == "Success"){
									$("#askeet_PostAnswer").hide();
									$("#askeet_close_question").text("[you have closed this question]").css("width", "170px");
								}else{
									alert(sReply.ERRMSG+": "+sReply.SQL);
								}
							},
							"json"
						);
					}
				}
			);
		
		var sThumbsUp = "askeet_answer_rating_up_";
		
		$("div[id^='"+sThumbsUp+"']").each(
			function(){
				var iDivId = parseInt(this.id.replace(sThumbsUp, ""));
				
				$("#" + sThumbsUp + iDivId)
					.hover(
						function(){
							$(this).css("cursor", "pointer");
						},
						function(){
							$(this).css("cursor", "default");
						}
					)
					.click(
						function(){
							//alert(iDivId);
							askeet_Rating("up", iDivId);
						}
					);
			}
		);
		
		var sThumbsDown = "askeet_answer_rating_down_";
		
		$("div[id^='"+sThumbsDown+"']").each(
			function(){
				var iDivId = parseInt(this.id.replace(sThumbsDown, ""));
				
				$("#" + sThumbsDown + iDivId)
					.hover(
						function(){
							$(this).css("cursor", "pointer");
						},
						function(){
							$(this).css("cursor", "default");
						}
					)
					.click(
						function(){
							//alert(iDivId);
							askeet_Rating("down", iDivId);
						}
					);
			}
		);
		
		$("#instant_btnVolunteerDeactivate")
			.hover(
				function(){
					$(this).css({"cursor":"pointer"});
				},
				function(){
					$(this).css({"cursor":"default"});
				}
			)
			.click(
				function(){
					$("#instant_VolunteerDeactivateDialog").dialog("open");
				}
			);
		
		$("#instant_VolunteerDeactivateDialog").dialog(
			{
				modal: true,
				autoOpen: false,
				resizable: false,
				width: 400,
				buttons: {
					"Deactivate Account": function(){
						location = Drupal.settings.basePath+"askeet/deactivate";
						//console.log(Drupal.settings.basePath+"askeet/tutor/deactivate");
					},
					"Cancel": function(){
						$(this).dialog("close");
					}
				}
			}
		);
		/* added by jed diaz */
		
		$("#askvolunteer_cat_1").change(
			function(){
				askeet_PopulateCat("askvolunteer_cat_2", $(this).val(), "askvolunteer_cat_3");
			}
		);
		
		$("#askvolunteer_cat_2")
			.change(
				function(){
					askeet_PopulateCat("askvolunteer_cat_3", $(this).val());
				}
			);
		
		
		$("#instant_addCategory")
			.hover(
				function(){
					$(this).css({"cursor":"pointer"});
				},
				function(){
					$(this).css({"cursor":"default"});
				}
			)
			.click(
				function(){
					$("#instant_addCategoryDialog").dialog("open");
				}
			);
		
		$("#instant_addCategoryDialog").dialog(
			{
				modal: true,
				autoOpen: false,
				resizable: false,
				width: 700,
				buttons: {
					"Add Category": function(){
						if ($("#askvolunteer_cat_3 option:selected").val() != undefined){
							var sSelectedView = $("#askvolunteer_cat_1 option:selected").text() + " " + $("#askvolunteer_cat_2 option:selected").text() + " " + $("#askvolunteer_cat_3 option:selected").text();
							
							if (jQuery.inArray($("#askvolunteer_cat_3 option:selected").val(), askeet_aSelectedCat) >= 0){
								alert("You already selected "+sSelectedView+".");
							} else{
							var sVartags = $("#askvolunteer_cat_3 option:selected").text().replace(/[^a-zA-Z 0-9]+/g,'') + ',,,' + $("#askvolunteer_cat_3 option:selected").val();
							askeet_load_cat_db($("#askvolunteer_cat_3 option:selected").val());
							var sSelectedCat = '<div id="' + $("#askvolunteer_cat_3 option:selected").val() + '"><a href="javascript:void(0);" onclick="askeet_SelectedSubjectQuestion('+ "'" + sVartags + "'" +')">' + $("#askvolunteer_cat_3 option:selected").text() + '</a> (<span id="count' + $("#askvolunteer_cat_3 option:selected").val() + '"></span>)' + '&nbsp;&nbsp;&nbsp;<a style="text-decoration:none;" href="javascript:void(0);" onclick="askeet_removecategoryitem_click('+ $("#askvolunteer_cat_3 option:selected").val() +')"><span style="color:red;font-size:10px;">remove</span></a>' + '</div>';
							askeet_CheckSelectedArray($("#askvolunteer_cat_3 option:selected").val(), askeet_aSelectedCat, sSelectedCat);
							$(this).dialog("close");
							}
						} else{
							if ($("#askvolunteer_cat_2 option:selected").val() != undefined && $("#askvolunteer_cat_3 option").val() == undefined){
							var sSelectedView = $("#askvolunteer_cat_1 option:selected").text() + " " + $("#askvolunteer_cat_2 option:selected").text();
								if (jQuery.inArray($("#askvolunteer_cat_3 option:selected").val(), askeet_aSelectedCat) >= 0){
									alert("You already selected "+sSelectedView+".");
								} else{
								var sVartags = $("#askvolunteer_cat_2 option:selected").text().replace(/[^a-zA-Z 0-9]+/g,'') + ',,,' + $("#askvolunteer_cat_2 option:selected").val();
								var iCountCat = askeet_load_cat_db($("#askvolunteer_cat_2 option:selected").val());
								askeet_load_cat_db($("#askvolunteer_cat_3 option:selected").val());
								var sSelectedCat = '<div id="' + $("#askvolunteer_cat_2 option:selected").val() + '"><a href="javascript:void(0);" onclick="askeet_SelectedSubjectQuestion('+ "'" + sVartags + "'" +')">' + $("#askvolunteer_cat_2 option:selected").text() + '</a> (<span id="count' + $("#askvolunteer_cat_3 option:selected").val() + '"></span>)' + '&nbsp;&nbsp;&nbsp;<a style="text-decoration:none;" href="javascript:void(0);" onclick="askeet_removecategoryitem_click('+ $("#askvolunteer_cat_2 option:selected").val() +')"><span style="color:red;font-size:10px;">remove</span></a>' + '</div>';
								askeet_CheckSelectedArray($("#askvolunteer_cat_2 option:selected").val(), askeet_aSelectedCat, sSelectedCat);
								$(this).dialog("close");
								}
							} else{
							alert('Please select a category first');
							}
						}
					},
					"Cancel": function(){
						$(this).dialog("close");
					}
				}
			}
		);
		
		$("#instant_RemoveCatDialog").dialog(
			{
				modal: true,
				autoOpen: false,
				resizable: false,
				width: 400,
				buttons: {
					"Remove": function(){
						askeet_removecategoryitem(SelectCategoryId);
						$(this).dialog("close");
					},
					"Cancel": function(){
						$(this).dialog("close");
					}
				}
			}
		);
		/* eof added by jed diaz */
	}
);
function askeet_CheckSelectedArray(sNeedle, aHaystack, sSelectedCat){
		aHaystack[aHaystack.length] = sNeedle; //add category to array

		askeet_db_tutor_select('update');
		// display 
		if ($("#askvolunteer_selected_cats").html() != ""){
			$("#askvolunteer_selected_cats").append(sSelectedCat);
		}else{
			$("#askvolunteer_selected_cats").html(sSelectedCat);
		}
}
function askeet_load_cat_db(catid){
	var iCatCount;
	askeet_sBasePath = '/';
		$.post(
		askeet_sBasePath+"askeet/tutor/optin",
		{
			id: 'null',
			cat: catid,
			nc: 'null',
			na: 'null',
			st: 'specific'
		},
		function(sReply){
			console.log(sReply.value);
			if(sReply.value > 0){
			$("#count"+(catid)).html(sReply.value);
			} else{
			$("#count"+(catid)).html(0);
			}
		},
		"json"
		);
		//console.log(iCatCount);
}

function askeet_db_tutor_select(process){
// update categories
		askeet_sBasePath = '/';
		$.post(
		askeet_sBasePath+"askeet/tutor/optin",
		{
			id: $("#askeet_bOptInstantAnswer").val(),
			cat: askeet_Implode(",", askeet_aSelectedCat),
			nc: 'null',
			na: 'null',
			st: process
		},
		function(sReply){
			if (sReply.STATUS == "Success"){
			}else{
			alert(sReply.ERRMSG+"\nSQL:\n"+sReply.SQL);
			}
		},
		"json"
		);
// eof update categories
	return true;
}
	
function askeet_Implode(sGlue, aPieces){
	return ((aPieces instanceof Array) ? aPieces.join(sGlue):aPieces);
}

function askeet_removecategoryitem_click(id){
	SelectCategoryId = id;
	$("#instant_RemoveCatDialog").dialog("open");
}

function askeet_removecategoryitem(id){
	
	$("#count"+(id)).html("");
	
	for(var i=0; i<askeet_aSelectedCat.length;i++ ){ 
	 if(askeet_aSelectedCat[i]==id)
	 askeet_aSelectedCat.splice(i,1); 
	}
	
	$("#"+(id)).html("");
	
	askeet_db_tutor_select('update');
}

function askeet_PostAnswer(){
	$.post(
		askeet_sBasePath+"askeet/answer/process",
		{
			id: $("#askeet_question_id").val(),
			ans: $("#askeet_post_answer").val()
		},
		function(sReply){
			if (sReply.STATUS == "Success"){
				$("#askeet_post_answer").val("");
				location.reload();
			}else{
				alert(sReply.ERRMSG);
			}
		},
		"json"
	);
	
	return false;
}

function askeet_QuestionTag(sTag){
	askeet_ShowPage();
	$("#askeet_questions").load(askeet_sBasePath+"askeet/tag/"+sTag).show("slow");
}

function askeet_ShowPage(){
	if (askeet_bPostSuccess) $("#askeet_post_question_post_status").hide();
	
	//$("#askeet_questions").load(askeet_sBasePath+"askeet/featured");
	
	$("#askeet_page").show("slow");
	$("#askeet_form").hide("slow");
}

function askeet_ShowForm(){
	$("#askeet_page").hide("slow");
	$("#askeet_form").show("slow");
}

function askeet_PreviewThis(){
	if ($("#askeet_post_question").val() == ""){
		alert("You have to specify a question first before you can preview it.");
	}else if (askeet_iCatId == 0){
		alert("Please select a category. A category with sub-categories is not a valid selection.");
	}else{
		$("#askeet_enroll_postform").hide("slow");
		$("#askeet_post_question_preview").show("slow");
		
		$("#askeet_post_question_preview_cat").text(askeet_sCatTitle);
		$("#askeet_post_question_preview_question").text($("#askeet_post_question").val());
		$("#askeet_post_question_preview_question_body").text($("#askeet_post_question_desc").val());
	}
}

function askeet_CancelPreview(){
	$("#askeet_post_question_preview").hide("slow");
	$("#askeet_enroll_postform").show("slow");
}

function askeet_PostQuestion(){
	var iPostAlert = ($("#askeet_post_question_alert").is(":checked")) ? 1:0;
		
	$.post(
		askeet_sBasePath+"askeet/enroll/form/process",
		{
			q: $("#askeet_post_question").val(),
			b: $("#askeet_post_question_desc").val(),
			t: $("#askeet_post_question_tags").val(),
			i: askeet_iCatId,
			f: iPostAlert
		},
		function(sReply){
			if (sReply.STATUS == "Success"){
				askeet_bPostSuccess = true;
				$("#askeet_post_question_preview").hide("slow");
				$("#askeet_post_question_post_status").show("slow");
			}else{
				alert(sReply.STATUS);
			}
		},
		"json"
	);
}

function askeet_PopulateCat(sContainerId, iIdVal, sContainerToNull){
	if (sContainerToNull != null) $("#"+sContainerToNull).html('<optgroup label="No sub-category selected"></optgroup>');
	var volunteer_sBasePath = '/';
	$.post(
		askeet_sBasePath+"askeet/question/cat",
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

function askeet_SubjectQuestion(sSubject){
	$("#askeet_questions").load(askeet_sBasePath+"askeet/open/"+escape(sSubject)).show("slow");
}

function askeet_SelectedSubjectQuestion(sSubject){
	$("#askeet_questions").load(askeet_sBasePath+"askeet/selectedsubject/"+escape(sSubject)).show("slow");
}

function askeet_GetAnsweredQuestionByTutor(sTutorChildName, iTutorChildId, sType){
	sType = (sType != null) ? sType:"answers"
	$("#askeet_questions").load(askeet_sBasePath+"askeet/tutor/"+sTutorChildName+"/"+iTutorChildId+"/"+sType).show("slow");
}

function askeet_Rating(sType, iAnswerId){
	var sThisThumb = (sType == "up") ? "askeet_answer_rating_up_":"askeet_answer_rating_down_";
	
	$.post(
		askeet_sBasePath+"askeet/answer/rating",
		{
			id: iAnswerId,
			type: sType
		},
		function(sReply){
			if (sReply.STATUS == "Success"){
				$("#askeet_answer_rating_up_"+iAnswerId).unbind();
				$("#askeet_answer_rating_down_"+iAnswerId).unbind();
				
				$("#askeet_rating_up_"+iAnswerId).attr("src", askeet_sBasePath+"misc/thumbs_up_voted.gif");
				$("#askeet_rating_down_"+iAnswerId).attr("src", askeet_sBasePath+"misc/thumbs_down_voted.gif");
				
				$("#askeet_answer_rating_up_value_"+iAnswerId).text(sReply.RETURN[0].UP);
				$("#askeet_answer_rating_down_value_"+iAnswerId).text(sReply.RETURN[0].DOWN);
			}else{
				alert(sReply.ERRMSG + "\nSQL:\n" + sReply.SQL);
			}
		},
		"json"
	);
}

function askeet_DeleteQuestion(){
	var iCheckedCount = $("input:checked").length;
	
	if (iCheckedCount > 0){
		var bConfirm = confirm("Are you sure that you want to delete the selected question(s) and it's answers?\nThis will be permanent.");
		return bConfirm;
	}else{
		alert("Please select, at least, one (1) question to delete.");
	}
	
	return false;
}