$(document).ready(
	function(){
		$("#mystudies_master_admin_bCheckAll").click(
			function(){
				var bChecked = this.checked;
				
				$("input[id=mystudies_master_admin_bCheckThis]").each(
					function(){
						this.checked = bChecked;
					}
				);
			}
		);
		
		$("input[id=mystudies_master_admin_bCheckThis]").each(
			function(){
				$(this).click(
					function(){
						var iCheckLength = $("input[id=mystudies_master_admin_bCheckThis]:checked").length;
						var iCheckCount = $("input[id=mystudies_master_admin_bCheckThis]").length;
						
						$("#mystudies_master_admin_bCheckAll").attr("checked", ((iCheckLength != iCheckCount) ? false:true));
					}
				);
			}
		);
		
		$("sup[id=mystudies_master_admin_iUserId]").each(
			function(){
				var aUserData = $(this).attr("value").split("_");
				
				$(this).click(
					function(){
						location = Drupal.settings.basePath+'admin/user/master/list/assign/'+aUserData[0]+'/'+aUserData[1];
					}
				);
			}
		);
		
		var sGetAssignedVolPreText = "mystudies_master_admin_GetAssignedVol_";
		
		$("span[id^="+sGetAssignedVolPreText+"]").each(
			function(){
				var sThisId = this.id.replace(sGetAssignedVolPreText, "");
				
				$(this).hover(
					function(){
						$("#mystudies_assigned_vol_block_"+sThisId).css("top", ($(this).offset().top - 430)+"px").show();
					},
					function(){
						$("#mystudies_assigned_vol_block_"+sThisId).css("top", "0px").hide();
					}
				);
			}
		);
	}
);