$(document).ready(
	function(){
		$('#admsearch').submit(function() {
		  if($("#admsearchinput").val() == ''){
		  window.location.href = "/admin/user/user";
		  return false;
		  } else{
		  window.location.href = "/admin/user/user?keyword=" + $("#admsearchinput").val();
		  return false;
		  }
		});

		$("#iHopefulId").change(
			function(){
				loadHeirarchyList($("#iHopefulId").val());	
			}
		);
		
		$("#iRoleId").change(
			function() {
				loadParents();
			}
		);
		
		$("#btnSubmit").click(
			function() {
				addHeirarchy();	
			}
		);
		
		$("#edit-user-hierarchy-mentor").change(
			function(){
				var iMentorId = $("option:selected", this).val();
				
				$.post(
					user_hierarchy_sBasePath+"admin/user/hierarchy/modcheck",
					{
						id: iMentorId
					},
					function(sReply){
						if (sReply != ""){
							$("#edit-user-hierarchy-mod").val(sReply);
							
							$("#edit-user-hierarchy-mod").focus(
								function(){
									this.blur();
								}
							);
						}
					},
					"text"
				);
			}
		);
		
		var sMentorPre = "mentor_";
		
		$("div[id^="+sMentorPre+"]").each(
			function(){
				var aSplicedId = this.id.replace(sMentorPre, "").split("_");
				var iMentorId = aSplicedId[0];
				var iChildId = aSplicedId[1];
				
				$("#"+this.id)
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
							var bDelete = confirm("Do you want to remove "+$(this).text()+" as a mentor of "+$("#child_"+iChildId).text()+"?");
							
							if (bDelete){
								$.post(
									user_hierarchy_sBasePath+"admin/user/hierarchy/mentordel",
									{
										mentorid: iMentorId,
										childid: iChildId
									},
									function(sReply){
										if (sReply.STATUS == "Success") location.reload();
									},
									"json"
								);
							}
						}
					);
			}
		);
	}
);


function loadParents() {
	$("#divParent").html('<img src="'+user_hierarchy_sBasePath+'themes/theme2010/images/loading.gif" border=0 />');
	if ($("#iHopefulId").val() != "") {
		$.ajax({
		  url: user_hierarchy_sBasePath+'admin/user/hierarchy/assign/volunteer/' + $("#iHopefulId").val() + '/' +$("#iRoleId").val(),
		  dataType: 'text',
		  success: function(data) {
			$("#divParent").html(data);
		  },
		  error: function(d,s,o) {
				$("#divParent").html("There was a problem with your request<br />");  
		  }
		});
	} else {
		$("#divParent").html('<select id="iVolunteerId" name="iVolunteerId"><option value="">Select Parent</option></select>');	
	}
}

function loadHeirarchyList(id) {
	if (id != "") {
		$("#sList").html('<img src="'+user_hierarchy_sBasePath+'themes/theme2010/images/loading.gif" border=0 />');
		$.ajax({
		  url: user_hierarchy_sBasePath+'admin/user/hierarchy/assign/hopeful/' + id,
		  dataType: 'html',
		  success: function(data) {
			$("#sList").html(data);
		  },
		  error: function(d,s,o) {
				$("#sList").html("There was a problem with your request<br />");  
		  }
		});
	} else {
		$("#sList").html("");
	}
}

function addHeirarchy() {
	err = "";
	
	if ($("#iHopefulId").val() == "") 
		err += "Please select Hopeful.\n";
	if ($("#iRoleId").val() == "") 
		err += "Please select Parent Role.\n";
	if ($("#iVolunteerId").val() == "") 
		err += "Please select Parent.\n";
	if (err != "") {
		alert(err);	
		return false;
	}
	
	$('#btnSubmit').attr('disabled','disabled');
	$("#sList").html('<img src="'+user_hierarchy_sBasePath+'themes/theme2010/images/loading.gif" border=0 />');
	$.post(
		user_hierarchy_sBasePath+"admin/user/hierarchy/assign/process",
		{
			iVolunteerId : $("#iVolunteerId").val(),
			iRoleId : $("#iRoleId").val(),
			iHopefulId : $("#iHopefulId").val(),
			sAction : "add"
		},
		function(sReply){
			loadHeirarchyList($("#iHopefulId").val());
		},
		"text"
	);
	loadParents();
	$('#btnSubmit').removeAttr('disabled');
}

function delHeirarchy(id, hopefulid, volunteerid, roleid){
	$.post(
		user_hierarchy_sBasePath+"admin/user/hierarchy/assign/process",
		{
			iId : id,
			sAction : "delete",
			iHopefulId : hopefulid,
			iVolunteerId : volunteerid,
			iRoleId : roleid
		},
		function(sReply){
			loadHeirarchyList($("#iHopefulId").val());
		},
		"text"
	);
	loadParents();
}