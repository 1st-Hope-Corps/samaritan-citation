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
		/* var sPreButtons = "kindness_button_";
		
		$("button[id^="+sPreButtons+"]").each(
			function(){
				var sButtonType = this.id.replace(sPreButtons, "");
				
				$("button#"+this.id).click(
					function(){
						$("#kindness_comment").hide();
						
						var sCommentText = (sButtonType == "approve") ? "approving":"denying";
				
						$("#bApprove").val(((sButtonType == "approve") ? '1':'0'));
						$("#kindness_comment_type").text(sCommentText);
						$("#kindness_comment").center().show("slow");
					}
				);
				
				
			}
		);
		
		$("button#btnCancel").click(
			function(){
				$("#kindness_comment").hide("slow");
			}
		); */
		
		$("#kindness_btnVolunteerDeactivate")
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
					$("#kindness_VolunteerDeactivateDialog").dialog("open");
				}
			);
			
		$("#kindness_VolunteerDeactivateDialog").dialog(
			{
				modal: true,
				autoOpen: false,
				resizable: false,
				width: 400,
				buttons: {
					"Deactivate Account": function(){
						location = Drupal.settings.basePath+"coordinator/administer/deactivate";
					},
					"Cancel": function(){
						$(this).dialog("close");
					}
				}
			}
		);
		
		$("#kindness_hopefuls_block_show").click(
			function(){
				$("#kindness_hopeful_block").toggle();
			}
		);
		
		var sPreButtons = "kindness_btn_";
		
		$("button[name^="+sPreButtons+"]").each(
			function(){
				$("button#"+this.id).click(
					function(){
						var sButtonType = $(this).val();
						
						//if ($("#id_uid:checked").length > 0){
						if ($("input[name='id_uid']:checked").length > 0){
							$("#kindness_mentor_comment").hide();
							$("#iItemId").val("");
							$("#iChildId").val("");
							$("#iDuration").val("");
							
							$("#id_uid:checked").each(
								function(){
									var iIdUid = $(this).val();
									var aId = iIdUid.split("_");
									var iItemId = aId[0];
									var iUid = aId[1];
									var iDuration = $("#"+iIdUid+"_duration").val();
									
									var sItemId = $("#iItemId").val();
									sItemId += (sItemId == "") ? "":",";
									$("#iItemId").val(sItemId+iItemId);
									
									var sChildId = $("#iChildId").val();
									sChildId += (sChildId == "") ? "":",";
									$("#iChildId").val(sChildId+iUid);
									
									var sDuration = $("#iDuration").val();
									sDuration += (sDuration == "") ? "":",";
									$("#iDuration").val(sDuration+iDuration);
								}
							);
							
							
							var sCommentText = (sButtonType == "approve") ? "approving":"disapproving";
							
							$("#bApprove").val(((sButtonType == "approve") ? '1':'2'));
							$("#kindness_mentor_comment_type").text(sCommentText);
							$("#kindness_mentor_comment").center().show("slow");
						}else{
							alert(' Please select, at least, 1 Kindness Work to '+sButtonType+'.');
						}
					}
				);
				
				
			}
		);
		
		$("#kindness_button_Cancel").click(
			function(){
				$("#kindness_mentor_comment").hide("slow");
			}
		);
		
		
		var sPreComment = 'kindness_workz_comments_';
		
		$("img[id^="+sPreComment+"]").each(
			function(){
				var sThisId = this.id;
				var iWorkzId = sThisId.replace(sPreComment, "");
				
				$("img#"+sThisId).click(
					function(){
						$("#kindness_workz_comments_container_"+iWorkzId).dialog("open");
						$("#kindness_workz_comments_data_"+iWorkzId).html("Loading...");
						
						$.post(
							Drupal.settings.basePath+"coordinator/callback/comments",
							{
								iKindnessId: iWorkzId
							},
							function(sReturn){
								$("#kindness_workz_comments_data_"+iWorkzId).html(sReturn);
							}
						);
					}
				);
			}
		);
		
		var sPreContainer = 'kindness_workz_comments_container_';
		
		$("div[id^="+sPreContainer+"]").each(
			function(){
				$(this).dialog(
					{
						modal: true,
						autoOpen: false,
						resizable: false,
						width: 450,
						buttons: {
							"Close": function(){
								$(this).dialog("close");
							}
						}
					}
				);
			}
		);
	}
);