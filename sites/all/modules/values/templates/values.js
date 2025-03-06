(function($){
	$.fn.center = function (bAbsolute){
		return this.each(
			function (){
				var oMainFunc = jQuery(this);

				oMainFunc
					.css(
						{
							position:	(bAbsolute) ? "absolute" : "fixed", 
							left:		"50%",
							top:		"50%",
							zIndex:		"9000"
						}
					)
					.css(
						{
							marginLeft:	"-" + (oMainFunc.outerWidth() / 2) + "px", 
							marginTop:	"-" + (oMainFunc.outerHeight() / 2) + "px"
						}
					);

				if (bAbsolute){
					oMainFunc.css(
						{
							marginTop:	parseInt(oMainFunc.css("marginTop"), 10) + jQuery(window).scrollTop(), 
							marginLeft:	parseInt(oMainFunc.css("marginLeft"), 10) + jQuery(window).scrollLeft()
						}
					);
				}
			}
		);
	}
})(jQuery);

$(document).ready(
	function(){
		$(".book_pg_descp .book_pg_img img").hover(
			function(){
				var sTitleURL = $(this).parent().parent().parent().find("h5 a").html();
				var sImageURL = $(this).attr("src")
				
				$(".popup img").attr("src", sImageURL);
				$(".popup .link h3").html(sTitleURL);
				
				$(".popup").css("width", "60%").show().center().css("left", "65%");
			},
			function(){
				$(".popup").hide();
			}
		);
		
		var aThumbView = Array('entertainment_site_thumb_', 'entertainment_image_thumb_');
		
		for (x=0; x<aThumbView.length; x++){
			$("img[id^="+aThumbView[x]+"]").each(
				function(){
					var iContentId = this.id.replace(aThumbView[x], "");
					
					$(this).hover(
						function(){
							var sTitleURL = $("#editors_sTitle_"+iContentId).val();
							
							var sImageURL = $(this).attr("src");
							
							$(".popup img").attr("src", sImageURL);
							$(".popup .link h3").html(sTitleURL);
							
							$(".popup").css("width", "55%").show().center().css("left", "65%");
						},
						function(){
							$(".popup").css("width", "0%").css("left", "0%").hide();
						}
					);
				}
			);
		}
		
		
		$("#entertainment_edit_mode").click(
			function(){
				$("#entertainment_edit_mode_notice").center().toggle("slow");
			}
		);
		
		$("#entertainment_edit_mode_notice_cancel").click(
			function(){
				$("#entertainment_edit_mode_notice").toggle("slow");
			}
		);
		
		$("#entertainment_edit_mode_url_notice_cancel").click(
			function(){
				$("#entertainment_edit_mode_url_notice").toggle("slow");
			}
		);
		
		$("#entertainment_edit_mode_notice_amend").click(
			function(){
				$("#entertainment_edit_mode_notice").toggle("slow");
				location = entertainment_sBasePath+"entertainment/edit/"+entertainment_iGroupLevel;
			}
		);
		
		$("#entertainment_edit_mode_notice_add").click(
			function(){
				$("#entertainment_edit_mode_notice").toggle("slow");
				location = entertainment_sBasePath+"entertainment/edit/"+entertainment_iGroupLevel+"/add";
			}
		);
		
		$("#entertainment_edit_mode_url").click(
			function(){
				$("#entertainment_edit_mode_url_notice").center().toggle("slow");
			}
		);
		
		$("#entertainment_edit_mode_url_notice_amend").click(
			function(){
				$("#entertainment_edit_mode_url_notice").toggle("slow");
				location = entertainment_sBasePath+"entertainment/url/edit/"+entertainment_iGroupLevel;
			}
		);
		
		$("#entertainment_edit_mode_url_notice_add").click(
			function(){
				$("#entertainment_edit_mode_url_notice").toggle("slow");
				location = entertainment_sBasePath+"entertainment/url/edit/"+entertainment_iGroupLevel+"/add";
			}
		);
		
		$("#entertainment_edit_mode_url_animation").click(
			function(){
				$("#entertainment_edit_mode_url_animation_notice").center().toggle("slow");
			}
		);
		
		$("#entertainment_edit_mode_url_animation_notice_amend").click(
			function(){
				$("#entertainment_edit_mode_url_animation_notice").toggle("slow");
				location = entertainment_sBasePath+"entertainment/url/animation/edit/"+entertainment_iGroupLevel;
			}
		);
		
		$("#entertainmententertainment_edit_mode_url_animation_notice_add").click(
			function(){
				$("#entertainment_edit_mode_url_animation_notice").toggle("slow");
				location = entertainment_sBasePath+"entertainment/url/animation/edit/"+entertainment_iGroupLevel+"/add";
			}
		);
		
		$("#entertainment_edit_mode_url_animation_notice_cancel").click(
			function(){
				$("#entertainment_edit_mode_url_animation_notice").toggle("slow");
			}
		);
		
		$(".ch_subj img").tooltip(
			{
				bodyHandler: function(){
					return $("#"+this.id+"_desc").html();
				},
				showURL: false
			}
		);
		
		$(".book_img img").tooltip(
			{
				bodyHandler: function(){
					return $("#"+this.id+"_desc").html();
				},
				showURL: false
			}
		);
		
		$("a[id^=entertainment_file_tooltip_]").tooltip();
		
		
		var sLinkRecPre = "entertainment_site_rec_link_";
		var sLinkOtherPre = "entertainment_site_other_link_";
		
		$("a[id^="+sLinkRecPre+"]").each(
			function(){
				$("a#"+this.id).click(
					function(){
						var iSiteId = this.id.replace(sLinkRecPre, "");
						
						$.post(
							entertainment_sBasePath+"entertainment/url/click",
							{
								sType: "site_rec",
								iRefId: iSiteId
							},
							function(sReply){
								if (sReply.STATUS != "Success") alert(sReply.ERRMSG);
							},
							"json"
						);
					}
				);
			}
		);
		
		$("a[id^="+sLinkOtherPre+"]").each(
			function(){
				$("a#"+this.id).click(
					function(){
						var iSiteId = this.id.replace(sLinkOtherPre, "");
						
						$.post(
							entertainment_sBasePath+"entertainment/url/click",
							{
								sType: "site_other",
								iRefId: iSiteId
							},
							function(sReply){
								if (sReply.STATUS != "Success") alert(sReply.ERRMSG);
							},
							"json"
						);
					}
				);
			}
		);
		
		var sButtonRecPre = "btnDelRecSite_";
		var sButtonOtherPre = "btnDelOtherSite_";
		var sButtonFilePre = "btnDelFile_";
		var sButtonCancel = "btnSuggestCancel";
		
		$("button[id^="+sButtonRecPre+"]").each(
			function(){
				var iRecId = this.value;
				
				$("button#" + sButtonRecPre + iRecId).click(
					function(){
						$("#sDeleteTitle").text($("#sRecTitle_"+iRecId).val());
						$("#sType").val("site_rec");
						$("#iRecId").val(iRecId);
						$("#entertainment_DeleteComment").center().show("slow");
					}
				);
			}
		);
		
		$("button[id^="+sButtonFilePre+"]").each(
			function(){
				var iRecId = this.value;
				
				$("button#" + sButtonFilePre + iRecId).click(
					function(){
						var sTitle = $("#sFileTitle_"+iRecId).val();
						
						if (sTitle == "") sTitle = "No Title Specified";
					
						$("#sDeleteTitle").text(sTitle);
						$("#sType").val("file");
						$("#iRecId").val(iRecId);
						$("#entertainment_DeleteComment").center().show("slow");
					}
				);
			}
		);
		
		$("button[id^="+sButtonOtherPre+"]").each(
			function(){
				var iRecId = this.value;
				
				$("button#" + sButtonOtherPre + iRecId).click(
					function(){
						$("#sDeleteTitle").text($("#sOtherTitle_"+iRecId).val());
						$("#sType").val("site_other");
						$("#iRecId").val(iRecId);
						$("#entertainment_DeleteComment").center().show("slow");
					}
				);
			}
		);
		
		$("#btnDeleteCancel").click(
			function(){
				$("#entertainment_DeleteComment").hide("slow");
			}
		);
		
		$("button[id^="+sButtonCancel+"]").each(
			function(){
				$("button#"+this.id).click(
					function(){
						history.back(1);
					}
				);
			}
		);
		
		$("#entertainment_back_button").click(
			function(){
				history.back(1);
			}
		);
		
		$("#entertainment_edit_mode_file_notice_amend").click(
			function(){
				$("#entertainment_edit_mode_notice").toggle("slow");
				location = entertainment_sBasePath+"entertainment/file/"+entertainment_sFileType+"/"+entertainment_iGroupLevel+"/edit";
			}
		);
		
		$("#entertainment_edit_mode_file_notice_add").click(
			function(){
				$("#entertainment_edit_mode_notice").toggle("slow");
				location = entertainment_sBasePath+"entertainment/file/"+entertainment_sFileType+"/"+entertainment_iGroupLevel+"/edit/add";
			}
		);
		
		$("div[id^=changelog_partial_]").each(
			function(){
				var sLogTypeId = this.id.replace("changelog_partial_", "");
				var aLogTypeId = sLogTypeId.split("_");
				
				$(this)
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
							var sTitleVal = ($("#editors_sTitle_"+aLogTypeId[1]).length == 1) ? $("#editors_sTitle_"+aLogTypeId[1]).val():$("#entertainment_sTitle").val();
							
							$("#changelog_title_"+aLogTypeId[1]).html("<b>"+sTitleVal+"</b>");
							$("#changelog_full_"+sLogTypeId).toggle().center();
						}
					);
				
				$("#changelog_full_"+sLogTypeId)
					.click(
						function(){
							$(this).toggle();
						}
					)
					.hover(
						function(){
							$(this).css("cursor", "pointer");
						},
						function(){
							$(this).css("cursor", "default");
						}
					);
			}
		);
		
		$("div[id^=changelog_partial_]").tooltip();
		
		// --BEGIN Get involved - Guides
		var iGuidesCatId = 0;
		var sGuidesCatTitle = "";
		var iVolunteerCatId = 0;
		var bVolunteerCatHasChildren = true;
		if(true || jQuery.cookie && jQuery.cookie('glang') == null){
			if ($("#entertainment_VolunteerCatList").length == 1){
				$("#entertainment_VolunteerCatList").treeview(
					{url: Drupal.settings.basePath+"askeet/question/cats/entertain", unique: true}
				);
			}
			
			if ($("#entertainment_VolunteerCatList2").length == 1){
				$("#entertainment_VolunteerCatList2").treeview(
					{url: Drupal.settings.basePath+"askeet/question/cats/entertain", unique: true}
				);
			}
			
			if ($("#entertainmentadmin_VolunteerCatList").length == 1){
				$("#entertainmentadmin_VolunteerCatList").treeview(
					{url: Drupal.settings.basePath+"askeet/question/cats/entertainadmin", unique: true}
				);
			}
		}
		
		$("#entertainmentGuides")
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
					if ($("span#guide_editor_value").text() != "none"){
						$("#guides_Dashboard").hide();
						$("#guides_Categories").show();
					}else{
						$('#entertainment_NoFeatureDialog').dialog('open');
					}
				}
			);
		
		if ($('#entertainment_NoFeatureDialog').length == 1){
			$('#entertainment_NoFeatureDialog').dialog(
				{
					autoOpen: false,
					resizable: false,
					modal: true,
					width: 500,
					buttons: {
						"Ok": function() { 
							$(this).dialog("close"); 
						}
					}
				}
			);
		}
		
		$("#guides_btnGo").click(
			function(){
				iVolunteerCatId = $("input#volunteer_iGroupId").val();
				bVolunteerCatHasChildren = ($("li#" + iVolunteerCatId + " div.hitarea").length > 0 || iVolunteerCatId == 0) ? true:false;
				
				if (bVolunteerCatHasChildren){
					alert("Please select a valid subject/category. A subject/category with or will hold sub-categories is not a valid selection.");
				}else{
					// moved to jquery.treeview.async.js on line 29
					/* $("input[id^=volunteer_iGroupId]").each(
						function(){
							//$(this).val(iGuidesCatId);
							$(this).val(iVolunteerCatId);
						}
					); */
					
					$("#guides_Categories").hide();
					
					var sContentType = $("#guides_sContentType").val();
					var bBindEvent = false;
					
					switch (sContentType){
						case "site":
						case "animation":
							$("#guides_sSiteType").val(sContentType);
							$("#guides_WebsiteForm").show();
							
							$("div#rating_TempContainer1").load(Drupal.settings.basePath+"rating/load/form/"+sContentType+"/other/0");
							$("div#rating_TempContainer2").html("");
							
							break;
						
						case "video":
                            if(sContentType == 'video'){
                            $("span#gi_title").html("You may upload a Video, add a Video URL, or Embed Code. Please also add the Title, Tags, Description and the Rating");
						    }
                        case "image":
						    if(sContentType == 'image'){
                            $("span#gi_title").html("You may upload a Photo, add a Photo, or Embed Code. Please also add the Title, Tags, Description and the Rating");
                            }
                        case "doc":
                            if(sContentType == 'doc'){
                            $("span#gi_title").html("You may upload a Book/Report, add a Book/Report, or Embed Code. Please also add the Title, Tags, Description and the Rating");
                            }
                            
							$("#guides_FileForm").show();
							
							$("div#rating_TempContainer1").html("");
							$("div#rating_TempContainer2").load(Drupal.settings.basePath+"rating/load/form/file/"+sContentType+"/0");
							
							if (sContentType == "video") sPageTitle = "Video";
							if (sContentType == "image") sPageTitle = "Photo";
							if (sContentType == "doc") sPageTitle = "Book";
							
							$("#guides_FileFormEmbed").text("Paste a "+sPageTitle+" embed code or URL here");
							$("#guides_FileFormUpload").text("Upload a "+sPageTitle);
							$("#sFileTypeEmbed").val(sContentType+"_embed");
							$("#sFileType").val(sContentType);
							
							break;
						case "content":
                            if(sContentType == 'content'){
                            $("span#gi_title").html("You may upload a Content, add a Content, or Embed Code. Please also add the Title, Tags, Description and the Rating");
                            }
                            
							$("#guides_ContentForm").show();
							
							$("div#rating_TempContainer1").html("");
							$("div#rating_TempContainer2").load(Drupal.settings.basePath+"rating/load/form/file/"+sContentType+"/0");
							
							sPageTitle = "Content";
							
							$("#guides_FileFormEmbed").text("Paste a "+sPageTitle+" embed code or URL here");
							$("#guides_FileFormUpload").text("Upload a "+sPageTitle);
							$("#sFileTypeEmbed").val(sContentType+"_embed");
							$("#sFileType").val(sContentType);
							
							break;
					}
				}
			}
		);
		
		$("#guides_btnCancel").click(
			function(){
				$("#guides_Dashboard").show();
				$("#guides_Categories").hide();
			}
		);
		
		$("button[id^=guides_btnSuggestCancel]").each(
			function(){
				$(this).click(
					function(){
						$("#guides_Categories").show();
						$("#guides_WebsiteForm").hide();
						$("#guides_FileForm").hide();
						$("#guides_ContentForm").hide();
					}
				);
			}
		);
		
		$("img[id^=guides_btnSuggestCancel]").each(
			function(){
				$(this).click(
					function(){
						$("#guides_Categories").show();
						$("#guides_WebsiteForm").hide();
						$("#guides_FileForm").hide();
						$("#guides_ContentForm").hide();
					}
				);
			}
		);
		
		$("#guides_ReturnToDash").click(
			function(){
				$("#guides_Notice").hide();
				$("#guides_Dashboard").show();
			}
		);
		// --END Get involved - Guides
		
		// --BEGIN Get involved - Editors
		if ($("#guides_cat_1").length == 1) Guides_PopulateCat($("#guides_cat_1"), 0);
		
		$("#entertainment_editors_full_cat")
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
					$("#entertainment_editors_cats").show();
				}
			);
		
		$("#entertainment_editors_cat_cancel").click(
			function(){
				$("#entertainment_editors_cats").hide();
			}
		);
		
		$("#entertainment_editors_cat_set").click(
			function(){
				$("#entertainment_editors_cats").hide();
			}
		);
		
		$("#entertainment_guides_block_show").click(
			function(){
				$("#entertainment_guides_block").css("top", ($(this).offset().top-430)+"px").toggle();
			}
		);
		
		$("#editors_btnGo").click(
			function(){
				iVolunteerCatId = $("input#volunteer_iGroupId").val();
				bVolunteerCatHasChildren = ($("li#" + iVolunteerCatId + " div.hitarea").length > 0 || iVolunteerCatId == 0) ? true:false;
				
				sSelectedType = $("input[name=editors_cat_option]:checked").val();
				
				if (sSelectedType == "add"){
					$("#editors_add_form").show();
					$("#editors_edit_form").hide();
				}else{
					document.editors_query_form.submit();
				}
			}
		);
		
		$("button[id^=btnCatDelete]").each(
			function(){
				$(this).click(
					function(){
						var iContentId = this.value;
						
						$("#sDeleteTitle").text($("#editors_sTitle_"+iContentId).val());
						$("#iRecId").val(iContentId);
						$("#entertainment_ExistingCatDeleteComment").center().show("slow");
					}
				);
			}
		);
		
		$("#btnExistingCatDeleteCancel").click(
			function(){
				$("#entertainment_ExistingCatDeleteComment").hide("slow");
			}
		);
		
		$("#editors_btnExistingItemsGo").click(
			function(){
				iVolunteerCatId = $("input#volunteer_iGroupId").val();
				bVolunteerCatHasChildren = ($("li#" + iVolunteerCatId + " div.hitarea").length > 0 || iVolunteerCatId == 0) ? true:false;
				
				if (bVolunteerCatHasChildren){
					alert("Please select a valid subject/category. A subject/category with or will hold sub-categories is not a valid selection.");
				}else{
					document.edit_existing_items.submit();
				}
			}
		);
		
		$("button[id^=btnItemDelete]").each(
			function(){
				var iContentId = this.value;
				
				$(this).click(
					function(){
						var sContentType = $("#editors_sContentType_"+iContentId).val();
						
						if (sContentType == "site" || sContentType == "animation"){
							sTable = $("#editors_sTable_"+iContentId).val();
							sSubType = (sTable == "mystudyrecord_site") ? "rec":"other";
						}else{
							sSubType = "file";
						}
						
						$("#sDeleteTitle").text($("#editors_sTitle_"+iContentId).val());
						$("#sType").val(sSubType);
						$("#iRecId").val(iContentId);
						$("#entertainment_ExistingItemDeleteComment").center().show("slow");
					}
				);
			}
		);
		
		$("#btnExistingItemDeleteCancel").click(
			function(){
				$("#entertainment_ExistingItemDeleteComment").hide("slow");
			}
		);
		
		var iPageX = 0;
		var iPageY = 0;
		
		$(document).mousemove(
			function(e){
				iPageX = e.pageX;
				iPageY = e.pageY;
			}
		);
		
		$("span[id^=editors_change_cat_]").each(
			function(){
				var iContentId = this.id.replace("editors_change_cat_", "");
				
				$(this)
					.click(
						function(){
							$("#volunteer_iContentId").val(iContentId);
							$("#entertainment_editors_cats").css("top", iPageY - 420).show();
						}
					)
					.hover(
						function(){
							$(this).css("cursor", "pointer");
						},
						function(){
							$(this).css("cursor", "default");
						}
					);
			}
		);
		
		$("#entertainment_editors_cat_change").click(
			function (){
				var iContentId = $("#volunteer_iContentId").val();
				var iGroupId = $("#volunteer_iGroupId_edit").val();
				
				$("#editors_iGroupId_"+iContentId).val(iGroupId);
				$("#editors_change_cat_"+iContentId).load(Drupal.settings.basePath+"entertainment/getinvolved/full/cat/"+iGroupId);
				
				$("#entertainment_editors_cats").hide();
			}
		);
		
		$("#entertainment_btnVolunteerDeactivate")
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
					$("#entertainment_VolunteerDeactivateDialog").dialog("open");
				}
			);
			
		$("#entertainment_VolunteerDeactivateDialog").dialog(
			{
				modal: true,
				autoOpen: false,
				resizable: false,
				width: 400,
				buttons: {
					"Deactivate Account": function(){
						location = Drupal.settings.basePath+"entertainment/getinvolved/volunteer/"+$("#entertainment_sVolunteerType").val()+"/deactivate";
					},
					"Cancel": function(){
						$(this).dialog("close");
					}
				}
			}
		);
		// --END Get involved - Editors
		
		$(".search_close").click(
			function() {
				$("#search_results").slideUp();
			}
		);
		
		$("#searchsubmit").click(
			function() {
				if ($("#searchtxt").val() == "")
					alert("Please enter the url or embed code of the item to be searched");
				else
					searchContent(1);
			}
		);
	}
);

function searchContent(page){
	$("#search_contents").html('<div style="text-align:center;height:100px;"><br /><br /><img src="'+Drupal.settings.basePath+'themes/theme2010/images/ajax-loader.gif" /><br />Searching</div>');
	$("#search_results").slideDown();
	$.ajax({
		type:	'POST',
		data: 'sTxt='+$("#searchtxt").val(),
		url: Drupal.settings.basePath+"entertainment/getinvolved/search/contents/"+page,
		dataType:	'html',
		timeout:	100000000,
		cache: false,
		success: function(d,s){
					$("#search_contents").html(d);
		},
		error: function(o,s,e){
					$("#search_contents").html('Search Failed. Please retry.');
		}
	});
}

function ValidateForm(){
	var sAlert = "Please complete the following:\n";
	var iAlertLen = sAlert.length;
	
	if ($("#sSubjTitle").val() == "") sAlert += " - Subject Title\n";
	if ($("#sSubjIcon").val() == "") sAlert += " - Subject Icon\n";
	if ($("#sSubjDesc").val() == "") sAlert += " - Subject Description\n";
	
	if (iAlertLen < sAlert.length){
		alert(sAlert);
		return false;
	}
	
	return true;
}

function ValidateSiteForm(){
	var sAlert = "Please complete the following:\n";
	var iAlertLen = sAlert.length;
	
	if ($("#sSiteURL").val() == "" || $("#sSiteURL").val() == "http://") sAlert += " - Site URL\n";
	if ($("#sSiteTitle").val() == "") sAlert += " - Site Title\n";
	if ($("#sSiteDesc").val() == "") sAlert += " - Site Description\n";
	if ($("#sTags").val() == "") sAlert += " - Site Tags\n";
	if ($("#rating_iRatingId").val() == "" || $("#rating_iRatingId").val() == "0") sAlert += " - Rating\n";
	
	if (iAlertLen < sAlert.length){
		alert(sAlert);
		return false;
	}
	
	return true;
}

function ValidateSiteDelForm(){
	if ($("#sDeleteComment").val() != ""){
		return true;
	}else{
		alert("Please specify your reason for sugggesting this item for deletion.");
		return false;
	}
}

function ValidateEmbed(){
	var sAlert = "Please complete the following:\n";
	var iAlertLen = sAlert.length;
	
	if ($("#sFileEmbedTitle").val() == "") sAlert += " - File Title\n";
	if ($("#sFileEmbedCode").val() == "" && $("#sFileEmbedURL").val() == "") sAlert += " - File Embed Code OR External URL\n";
	if ($("#sFileEmbedCodeDesc").val() == "") sAlert += " - File Description\n";
	if ($("#sFileEmbedTags").val() == "") sAlert += " - Tags\n";
	if ($("#rating_iRatingId").val() == "" || $("#rating_iRatingId").val() == "0") sAlert += " - Rating\n";
	
	if (iAlertLen < sAlert.length){
		alert(sAlert);
		return false;
	}
	
	return true;
}

function ValidateUpload(){
	var sAlert = "Please complete the following:\n";
	var iAlertLen = sAlert.length;
	
	if ($("#sFileTitle").val() == "") sAlert += " - File Title\n";
	if ($("#file1").val() == "") sAlert += " - File to Upload\n";
	if ($("#file1_description").val() == "") sAlert += " - File Description\n";
	if ($("#sFileTags").val() == "") sAlert += " - Tags\n";
	if ($("#rating_iRatingId").val() == "" || $("#rating_iRatingId").val() == "0") sAlert += " - Rating\n";
	
	if (iAlertLen < sAlert.length){
		alert(sAlert);
		return false;
	}
	if ($("#sFileType").val() == "video")
		document.getElementById("entertainment_file_add").action = document.getElementById("response_url").value;
	
	return true;
}

function ValidateSubjDel(){
	var iDelSubjCount = 0;
	
	$("input[id^=entertainment_del_subj_]").each(
		function(){
			if (this.checked) iDelSubjCount++;
		}
	);
	
	if (iDelSubjCount == 1){
		var bConfirm = confirm("Are you sure you want to delete this subject?\nBe careful. This action cannot be undone.");
		
		return bConfirm;
	}
	
	alert("Please select a subject first.");
	
	return false;
}

function ResizeImage(){
	$("#entertainment_file_content img.thumbnail").each(
		function(){
			var iMaxWidth = 100;
			var iMaxHeight = 100;
			var iWidth = $(this).width();
			var iHeight = $(this).height();
			
			if ($(this).attr("src") != entertainment_sBasePath+"misc/file_doc.png"){
				if (iWidth > iMaxWidth) $(this).width(iMaxWidth);
				if (iHeight > iMaxHeight) $(this).height(iMaxHeight);
				if (iHeight < iMaxHeight) $(this).css("marginTop", ((iMaxHeight-$(this).height())/2));
			}
		}
	);
	
	$("#entertainment_view_file img").each(
		function(){
			var iMaxWidth = 860;
			var iWidth = $(this).width();
			
			if (iWidth > iMaxWidth) $(this).width(iMaxWidth);
		}
	);
}

var iCatCheckIntervalId = 0;

function Editor_CatCheck(iWhichElement, iSelectedSubjId){
	if ($("#editors_cat_"+iWhichElement).length > 0){
		sText = (iWhichElement == 1) ? "Main Subject":"Level "+iWhichElement;
		
		$("#editors_cat_"+iWhichElement).prepend('<option value="'+iSelectedSubjId+'" style="font-weight:bold;">'+sText+'</option>');
		clearInterval(iCatCheckIntervalId);
		iCatCheckIntervalId = 0;
	}
}

window.onload = function(){
	ResizeImage();
}

this.disapproved = '';
function disapprovedButton(){
	this.disapproved = 'Yes';
	$("#pendingForm").submit();
}

function checkEditorRating(jform,usertype) {
	var err = false;
	if(this.disapproved !== 'Yes'){
		$(".notice").removeClass('notice');
		if (usertype != "editors")
			return true;
		
		for(i=0; i<jform.elements.length; i++) {
			chkbox = jform.elements[i];
			if(chkbox.type == "checkbox") {
				if (chkbox.checked) {
					if ($("div#rating_ShowRating_"+chkbox.value).text() != "Your rating has been posted." 
						&& $("div#rating_ShowRating_"+chkbox.value).text() != "You already rated this content.") {
							$("div#rating_ShowRating_"+chkbox.value).addClass('notice');
							err = true;
					}
				}
			}
		}
		if (err) {
			alert("Please rate selected items first.");
			return false;	
		}
	}
	return true;
}

function setContentCounts(sCounts) {
	var aCounts = sCounts.split(",");
	var oDd, oDdOpt;

	/*if (document.getElementById("guides_sContentType")) {
		oDdOpt = $("#guides_sContentType >option");
		oDd = $("#guides_sContentType");
	} else if (document.getElementById("editors_sContentType")) {
		oDdOpt = $("#editors_sContentType >option");
		oDd = $("#editors_sContentType");
	}
	
	
	if (oDd) {
		oDdOpt.remove();
		oDd.append($('<option></option>').val("site").html('(' + aCounts[0] + ') Website').attr("class",getClass(aCounts[0])));
		oDd.append($('<option></option>').val("image").html('(' + aCounts[3] + ') Photo').attr("class",getClass(aCounts[3])));
		oDd.append($('<option></option>').val("video").html('(' + aCounts[4] + ') Video').attr("class",getClass(aCounts[4])));
		oDd.append($('<option></option>').val("animation").html('(' + aCounts[1] + ') Animation').attr("class",getClass(aCounts[1])));
		oDd.append($('<option></option>').val("doc").html('(' + aCounts[2] + ') Book Report').attr("class",getClass(aCounts[2])));
		oDd.append($('<option></option>').val("content").html('(' + aCounts[5] + ') Contents').attr("class",getClass(aCounts[5])));
	}*/
	
	$("#guides_sContentTypeLabel").html("<label style='padding:4px;color:black;background-color:" + getClass(aCounts[5]) + ";'>(" + aCounts[5] + ")  Content(s)</label>")
}

function getClass(iCnt) {
	if (iCnt == 0)
		return "#f9b8da";
	else if (iCnt > 0 && iCnt < 5)
		return "#fbfcb0";
	else
		return "#b3fbb1";
}

function Volunteer_CheckIfToFollowlink(sEnabled, sURL){
	if (sEnabled == "true"){
		location = sURL;
	}else{
		$('#entertainment_NoFeatureDialog').dialog('open');
	}
}

function Entertainment_getCatID(idCat, idLevel, eTitle){
  if(idCat !== ''){
	$("#volunteer_iGroupId").val(idCat);
	$("#editors_cat_form_sGroupLevel").val(idLevel); 
	//$("#"+idCat+" span").css('background-color', '#62bce6');
	$("#EselectedCategory").html(eTitle); 
  }
}