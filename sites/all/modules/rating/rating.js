$(document).ready(
	function(){
		$("div[id^=rating_ShowRating_]").each(
			function(){
				$(this).click(
					function(){
						var iContentId = this.id.replace("rating_ShowRating_", "");
						var sNotice = "Click here to hide rating.";
						
						if ($(this).text() == sNotice) sNotice = "Click here to rate this.";
						
						$(this).text(sNotice);
						$("#rating_RatingContainer_"+iContentId).toggle("slow");
					}
				);
			}
		);
		
		$("#rating_WriteReview").click(
			function(){
				if ($("#rating_WriteReview").attr("src") == sBasePath + 'hud_files/images/leaving_review_btn.png') {
					$("#rating_WriteReview").attr("src",sBasePath + 'hud_files/images/leaving_cancelreview_btn.png');
					sNotice = "Cancel Review";
				} else {
					$("#rating_WriteReview").attr("src",sBasePath + 'hud_files/images/leaving_review_btn.png');
					sNotice = "Write a Review";
				}
				
				var oCSS1 = {
					"position": "absolute",
					"top": "100px",
					"left": "252px",
					"backgroundColor": "#0d3802",
					"border": "3px solid yellow"
				}
				
				var oCSS2 = {
					"fontSize": "0.8em",
					"backgroundColor": "#0d3802",
					"color": "yellow",
					"padding": "2px"
				}
				
				$("div#rating_RatingFormContainer").css(oCSS1);
				$("div#rating_RatingFormContainer table").css(oCSS2);
				
				$("div#rating_WriteReview").text(sNotice);
				$("#rating_RatingFormContainer").toggle("slow");
			}
		);
		
		if (typeof(iContentId) == "undefined"){
			var iCount = 1
		}else{
			var iCount = $("div[id=rating_static_star_"+iContentId+"]").length;
		}
		
		if (iCount == 1){
			$("button[id=rating_btnSubmit]").each(
				function(){
					$(this).click(
						function(){
							var iContentId = this.value;
							var sType = $("#rating_type_"+ iContentId).val();
							var sSubType = $("#rating_sub_type_"+ iContentId).val();
							var sTitle = $("#rating_sTitle_"+iContentId).val();
							var sLikes = $("#rating_sLikes_"+iContentId).val();
							var sDislikes = $("#rating_sDislikes_"+iContentId).val();
							var sError = "";
                            
                            var sPlace = "";
                            var path = window.location.pathname;
						    if(path.search(/getinvolved/i) == -1){
                            sPlace = 'hud'
                            }
                            if(path.search(/url/i) == -1){
                            sPlace = 'volunteer'
                            }             
                            if (sTitle == "" || sTitle.split(" ").length > 15){
								sError += " - specify a Title that will not exceed 15 words\n";
							}
							
							if (sLikes == "" || sLikes.split(" ").length > 20){
								sError += " - specify your Likes but it should not exceed 20 words\n";
							}
							
							if (sDislikes == ""){
								sError += " - specify your Dislikes. if you have none, write \"none\".\n";
							}
							
							if (sError == ""){
								$.post(
									Drupal.settings.basePath+"rating/cast/vote",
									{
										sType: sType,
										sSubType: sSubType,
										iContentId: iContentId,
										iHelp: $("input#"+sType+"_help_"+iContentId).val(),
										iEasy: $("input#"+sType+"_easy_"+iContentId).val(),
										iFun: $("input#"+sType+"_fun_"+iContentId).val(),
										iArt: $("input#"+sType+"_art_"+iContentId).val(),
										iAll: $("input#"+sType+"_all_"+iContentId).val(),
										sTitle: sTitle,
										sLikes: sLikes,
										sDislikes: sDislikes,
                                        sComment: $("#rating_sComment_"+iContentId).val(),
                                        sPlace: sPlace
									},
									function (sReply){
										if (sReply.SUCCESS){
											$("div#rating_static_star_"+iContentId).load(Drupal.settings.basePath+"rating/star/refresh/all/"+sType+"/"+sSubType+"/"+iContentId);
											$("#rating_RatingContainer_"+iContentId).hide("slow");
											$("#rating_ShowRating_"+iContentId)
												.text("Your rating has been posted.")
												.unbind("click");
										}
									},
									"json"
								);
							}else{
								alert("Please complete the following:\n\n"+sError);
							}
						}
					);
				}
			);
		}else{
			$("button[id=rating_btnSubmit]").each(
				function(){
					$(this).click(
						function(){
							var iContentId = this.value;
							var sType = $("#rating_type_"+ iContentId).val();
							var sSubType = $("#rating_sub_type_"+ iContentId).val();
							var sTitle = $("#rating_sTitle_"+iContentId).val();
							var sLikes = $("#rating_sLikes_"+iContentId).val();
							var sDislikes = $("#rating_sDislikes_"+iContentId).val();
							var sError = "";
							
                            var sPlace = "";
                            var path = window.location.pathname;
                            if(path.search(/getinvolved/i) == -1){
                            sPlace = 'hud'
                            }
                            if(path.search(/url/i) == -1){
                            sPlace = 'volunteer'
                            }
                            if (sTitle == "" || sTitle.split(" ").length > 15){
								sError += " - specify a Title that will not exceed 15 words\n";
							}
							
							if (sLikes == "" || sLikes.split(" ").length > 20){
								sError += " - specify your Likes but it should not exceed 20 words\n";
							}
							
							if (sDislikes == ""){
								sError += " - specify your Dislikes. if you have none, write \"none\".\n";
							}
							
							if (sError == ""){
								$.post(
									sBasePath+"rating/cast/vote",
									{
										sType: sType,
										sSubType: sSubType,
										iContentId: iContentId,
										iHelp: $("input#"+sType+"_help_"+iContentId).val(),
										iEasy: $("input#"+sType+"_easy_"+iContentId).val(),
										iFun: $("input#"+sType+"_fun_"+iContentId).val(),
										iArt: $("input#"+sType+"_art_"+iContentId).val(),
										iAll: $("input#"+sType+"_all_"+iContentId).val(),
										sTitle: sTitle,
										sLikes: sLikes,
										sDislikes: sDislikes,
										sComment: $("#rating_sComment_"+iContentId).val(),
                                        sPlace: sPlace
									},
									function (sReply){
										if (sReply.SUCCESS){
											iPos = 0;
											
											$("div[id=rating_static_star_"+iContentId+"]").each(
												function(){
													iPos++;
													
													if (iPos == 2){
														$("#rating_RatingFormContainer").hide("slow");
														$("#rating_WriteReview").hide();
														$(this).load(sBasePath+"rating/star/refresh/all/"+sType+"/"+sSubType+"/"+iContentId);
													}
												}
											);
										}
									},
									"json"
								);
							}else{
								alert("Please complete the following:\n\n"+sError);
							}
						}
					);
				}
			);
		}
	}
);


function rating_CastVote(sTitle, sType, iContentId, iValue){
	switch (iValue){
		case 1: sRating = "onestar"; break;
		case 2: sRating = "twostar"; break;
		case 3: sRating = "threestar"; break;
		case 4: sRating = "fourstar"; break;
		case 5: sRating = "fivestar"; break;
		case 0:
		default:
			sRating = "nostar";
			break;
	}
	
	$("input#"+sType+"_"+sTitle+"_"+iContentId).val(iValue);
	$("ul[id="+sType+"_"+sTitle+"_"+iContentId+"]").attr("class", "rating "+sRating);
}

function rating_ShowRating(){
	var sNotice = ($("div#rating_ShowRating_0").text() == "Click here to hide rating.") ? "Click here to rate this.":"Click here to hide rating.";
	$("div#rating_ShowRating_0").text(sNotice);
	$("#rating_RatingContainer_0").toggle("slow");
}

function rating_PostReview(){
	var iContentId = 0;
	var sType = $("input#rating_type_"+ iContentId).val();
	var sSubType = $("input#rating_sub_type_"+ iContentId).val();
	var sTitle = $("input#rating_sTitle_"+iContentId).val();
	var sLikes = $("textarea#rating_sLikes_"+iContentId).val();
	var sDislikes = $("textarea#rating_sDislikes_"+iContentId).val();
	var sError = "";
	
    var sPlace = "";
    var path = window.location.pathname;
    if(path.search(/url/i) == -1){
        sPlace = 'volunteer'
    }
    if(path.search(/getinvolved/i) == -1){
        sPlace = 'hud'
    }
                            
	if (sTitle == "" || sTitle.split(" ").length > 15){
		sError += " - specify a Title that will not exceed 15 words\n";
	}
	
	if (sLikes == "" || sLikes.split(" ").length > 20){
		sError += " - specify your Likes but it should not exceed 20 words\n";
	}
	
	if (sDislikes == ""){
		sError += " - specify your Dislikes. if you have none, write \"none\".\n";
	}
	if (sError == ""){
		$.post(
			Drupal.settings.basePath+"rating/cast/vote",
			{
				sType: sType,
				sSubType: sSubType,
				iContentId: iContentId,
				iHelp: $("input#"+sType+"_help_"+iContentId).val(),
				iEasy: $("input#"+sType+"_easy_"+iContentId).val(),
				iFun: $("input#"+sType+"_fun_"+iContentId).val(),
				iArt: $("input#"+sType+"_art_"+iContentId).val(),
				iAll: $("input#"+sType+"_all_"+iContentId).val(),
				sTitle: sTitle,
				sLikes: sLikes,
				sDislikes: sDislikes,
				sComment: $("textarea#rating_sComment_"+iContentId).val(),
                sPlace: sPlace
			},
			function (sReply){
				if (sReply.SUCCESS){
					$("div#rating_RatingContainer_"+iContentId).hide("slow");
					$("div#rating_ShowRating_"+iContentId)
						.text("Your rating has been posted.")
						.unbind("click");
					$("input[name=rating_iRatingId]").each(
						function(){
							$(this).val(sReply.RETURN);
						}
					)
				}
			},
			"json"
		);
	}else{
		alert("Please complete the following:\n\n"+sError);
	}
}

function rating_ShowList(sType, sSubType, iContentId, sFilter){
	if (typeof(sBasePath) == "undefined") sBasePath = Drupal.settings.basePath;
	
	$("div#rating_RatingContainer")
		.css("height", "3px")
		.css("height", "auto")
		.load(
			sBasePath+"rating/load/list/"+sType+"/"+sSubType+"/"+iContentId+"/"+sFilter,
			function(sResponse, sStatus, xhr){
				if (sStatus == "success"){
					window.setTimeout(_rating_DelayCheckHeight, 1100);
				}
			}
		)
		.show("slow");
}

function _rating_DelayCheckHeight(){
	var iCurrHeight = $("div#rating_RatingContainer").innerHeight();
	
	if (iCurrHeight > 470) $("div#rating_RatingContainer").css("height", "470px");
}

function rating_ShowListAdmin(sType, sSubType, iContentId, sTitle){
	rating_ShowList(sType, sSubType, iContentId, "all");
	
	window.setTimeout('_rating_DelayTitle("'+sTitle+'")', 1500);
}

function _rating_DelayTitle(sTitle){
	$("div#rating_RatingContainer")
		.prepend("<h2>"+sTitle+"</h2>")
		.center();
}