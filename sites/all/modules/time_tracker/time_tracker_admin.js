$(document).ready(
	function(){
		$("#time_tracker_iPackageId_CheckAll").click(
			function(){
				var bChecked = this.checked;
				
				$("input[@id=time_tracker_aPackageId]").each(
					function(){
						this.checked = bChecked;
					}
				);
			}
		);
		
		$("input[@id=time_tracker_aPackageId]").each(
			function(){
				$(this).click(
					function(){
						time_tracker_checked_package();
					}
				);
			}
		);
	}
);

function time_tracker_checked_package(){
	var iCount = 0;
	var oCheckPackage = $("input[@id=time_tracker_aPackageId]");
	var iPackageCount = oCheckPackage.length;
	
	oCheckPackage.each(
		function(){
			if (this.checked) iCount++;
		}
	);
	
	var bChecked = (iCount == iPackageCount) ? true:false;
	
	$("#time_tracker_iPackageId_CheckAll").attr("checked", bChecked);
}