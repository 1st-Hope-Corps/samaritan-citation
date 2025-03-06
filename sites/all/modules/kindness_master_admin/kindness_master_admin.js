$(document).ready(
	function(){
		$("#kindness_master_admin_bCheckAll").click(
			function(){
				var bChecked = this.checked;
				
				$("input[id=kindness_master_admin_bCheckThis]").each(
					function(){
						this.checked = bChecked;
					}
				);
			}
		);
		
		$("input[id=kindness_master_admin_bCheckThis]").each(
			function(){
				$(this).click(
					function(){
						var iCheckLength = $("input[id=kindness_master_admin_bCheckThis]:checked").length;
						var iCheckCount = $("input[id=kindness_master_admin_bCheckThis]").length;
						
						$("#kindness_master_admin_bCheckAll").attr("checked", ((iCheckLength != iCheckCount) ? false:true));
					}
				);
			}
		);
		
		$("sup[id=kindness_master_admin_iUserId]").each(
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
		
		$("#kindness_master_admin_aAvailableHopeful").change(
			function(){
				var iSelectedCount = $("#kindness_master_admin_aAvailableHopeful option:selected").length;
				var iNeededHopeful = $("input[name=mystudies_master_admin_iNeededHopeful]").val();
				
				if (iSelectedCount > iNeededHopeful){
					$("#kindness_master_admin_bAddHopeful").attr('disabled', 'disabled');
					$("#kindness_master_admin_aAvailableHopeful option:selected").removeAttr("selected");
					
					alert('You can only select '+iNeededHopeful+' hopeful(s) to assign.');
				}else{
					$("#kindness_master_admin_bAddHopeful").removeAttr('disabled');
				}
			}
		);
	}
);