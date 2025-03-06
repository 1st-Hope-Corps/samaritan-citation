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
							zIndex:		"100"
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
			$("#division_CatList").treeview(
			{}
			);
		
			$( "#userKickappstabs" ).tabs();
	}
);

function addFolderDialog(){
	$("#addfolder_Dialog").dialog(
	{
											modal: true,
											autoOpen: true,
											resizable: false,
											width: 450,
											width: 350,
											buttons: {
												"Ok": function(){
													$(this).dialog("close");
												}
											}
	});
}

function addNewFolderDiv(){
	if($("#aFolderName").val() == ''){
		alert("Please input a name");
	} else if($("#aFolderPass").val() == ''){
		alert("Please select a password");
	} else{
		$.post(
			"/admin/askeet/treasure/managefolder/"+$("#aFolderName").val() + '/' + $("#aFolderPass").val(),
			{func: ""},
			function(sReply){
				if (sReply.STATUS == "Success"){ 
					//$("#statusMsg").html('The folder was successfully created.');
					alert('The folder was successfully created');
					location = 'http://www.firsthopecorps.org/admin/askeet/treasurehunt';
				}
			},
			"json"
		);
	}
}

function editFolderDivProcess(id){
	
	if($("#vFolderName").val() == ''){
		alert("Please input a name");
	} else if($("#vFolderPass").val() == ''){
		alert("Please select a password");
	} else{
		$.post(
			"/admin/askeet/treasure/updatefolder/"+id+"/"+$("#vFolderName").val() + '/' + $("#vFolderPass").val(),
			{func: ""},
			function(sReply){
				if (sReply.STATUS == "Success"){ 
					//$("#statusMsg").html('The folder was successfully created.');
					alert('The folder was successfully updated');
					location = 'http://www.firsthopecorps.org/admin/askeet/treasurehunt';
				}
			},
			"json"
		);
	}
}

function deleteFolderContents(id){
	var conf = confirm("Do you really want to delete this folder?")
	if (conf){
		$.post(
		"/admin/askeet/treasure/deletefolder/"+id,
		{func: ""},
		function(sReply){
			if (sReply.STATUS == "Success"){ 
				//$("#statusMsg").html('The folder was successfully created.');
				alert('The folder was successfully deleted');
				location = 'http://www.firsthopecorps.org/admin/askeet/treasurehunt';
			}
		},
		"json"
		);
	}
}

function editFolderContents(id){
    $("#manageFolderContent").html('<center><img src="http://www.firsthopecorps.org/misc/loading.gif" /></center>');
	$.post(
		"/admin/askeet/treasure/editfolder/" + id,
		{func: ""},
		function(sReply){
			if (sReply.STATUS == "Success"){ 
			 $("#manageFolderContent").html(sReply.OUTPUT);
			}
		},
		"json"
	);
						
	$("#manageFolder_Dialog").dialog(
			{
											modal: true,
											autoOpen: true,
											resizable: false,
											width: 650,
											width: 550,
											buttons: {
												"Ok": function(){
													$(this).dialog("close");
												}
											}
			}
	);
}

// Files

function addFileDialog(){
	$("#addfile_Dialog").dialog(
	{
											modal: true,
											autoOpen: true,
											resizable: false,
											width: 600,
											buttons: {
												"Ok": function(){
													$(this).dialog("close");
												}
											}
	});
}

function addNewFileDiv(){

	if($("#aFileName").val() == ''){
		alert("Please input a name");
	} else if($("#aflderid").val() == ''){
		alert("Please select a folder");
	} else if($("#aFileContent").val() == ''){
		alert("Please input a content");
	} else{
		$.post("/admin/askeet/treasure/managefile/"+$("#aFileName").val() + '/' + $("#aflderid").val(),
			{content: encodeURI($("#aFileContent").val())},
			function(sReply){
				if (sReply.STATUS == "Success"){ 
					alert('The file was successfully created');
					location = 'http://www.firsthopecorps.org/admin/askeet/treasurehunt?file=1';
				}
			},
			"json"
		);
	}
}

function editFileDivProcess(id){

	if($("#vFileName").val() == ''){
		alert("Please input a name");
	} else if($("#vflderid").val() == ''){
		alert("Please select a folder");
	} else if($("#vFileContent").val() == ''){
		alert("Please input a content");
	} else{
		$.post(
			"/admin/askeet/treasure/updatefile/"+id+"/"+$("#vFileName").val() + '/' + $("#vflderid").val(),
			{content: encodeURI($("#vFileContent").val())},
			function(sReply){
				if (sReply.STATUS == "Success"){ 
					//$("#statusMsg").html('The folder was successfully created.');
					alert('The folder was successfully updated');
					location = 'http://www.firsthopecorps.org/admin/askeet/treasurehunt?file=1';
				}
			},
			"json"
		);
	}
}

function deleteFileContents(id){
	var conf = confirm("Do you really want to delete this file?")
	if (conf){
		$.post(
		"/admin/askeet/treasure/deletefile/"+id,
		{func: ""},
		function(sReply){
			if (sReply.STATUS == "Success"){ 
				//$("#statusMsg").html('The folder was successfully created.');
				alert('The file was successfully deleted');
				location = 'http://www.firsthopecorps.org/admin/askeet/treasurehunt?file=1';
			}
		},
		"json"
		);
	}
}

function editFileContents(id){
    $("#manageFileContent").html('<center><img src="http://www.firsthopecorps.org/misc/loading.gif" /></center>');
	$.post(
		"/admin/askeet/treasure/editfile/" + id,
		{func: ""},
		function(sReply){
			if (sReply.STATUS == "Success"){ 
			 $("#manageFileContent").html(sReply.OUTPUT);
			}
		},
		"json"
	);
						
	$("#manageFile_Dialog").dialog(
			{
											modal: true,
											autoOpen: true,
											resizable: false,
											width: 600,
											buttons: {
												"Ok": function(){
													$(this).dialog("close");
												}
											}
			}
	);
}

// eof Files

function team_announcement_remove(teamannounceid, teamid){
   $("#loadingpost").show();
   $.post(
		"/admin/kickapps/removeannounce/" + teamannounceid + '/' + teamid,
		{func: ""},
		function(sReply){
			$("#announce_messages").html(sReply.OUTPUT);
			$("#loadingpost").hide();
		},
		"json"
	);
}

function team_announcement_submit(teamid){
	if($("#team_announcement_textarea").val() !== ''){
	$("#loadingpost").show();
	$.post(
		"/admin/kickapps/postannounce/" + teamid +"/" + $("#team_announcement_textarea").val(),
		{func: ""},
		function(sReply){
			$("#announce_messages").html(sReply.OUTPUT);
			$("#loadingpost").hide();
		},
		"json"
	);
   } else{
   alert('please fill up the announcement textarea.');
   }
}

function addNewChild(type){
	if(type == 'team'){
	   $("#TeamDiv").toggle();
	} else{
	   $("#ChildDiv").toggle();
	}
}

function manageContents(type, id){
    $("#manageContent").html('<center><img src="http://www.firsthopecorps.org/misc/loading.gif" /></center>');
	$.post(
		"/admin/kickapps/content/"+type + '/' + id,
		{func: ""},
		function(sReply){
			if (sReply.STATUS == "Success"){ 
			 $("#manageContent").html(sReply.OUTPUT);
			}
		},
		"json"
	);
						
	$("#manage_Dialog").dialog(
			{
											modal: true,
											autoOpen: true,
											resizable: false,
											width: 650,
											width: 550,
											buttons: {
												"Ok": function(){
													$(this).dialog("close");
													//location = 'http://www.firsthopecorps.org/admin/kickapps/manage';
												}
											}
			});

}
function manageTeamContents(id){
    $("#manageTeamContent").html('<center><img src="http://www.firsthopecorps.org/misc/loading.gif" /></center>');
	$.post(
		"/admin/kickapps/teamcontent/" + id,
		{func: ""},
		function(sReply){
			if (sReply.STATUS == "Success"){ 
			 $("#manageTeamContent").html(sReply.OUTPUT);
			}
		},
		"json"
	);
						
	$("#manageTeam_Dialog").dialog(
			{
											modal: true,
											autoOpen: true,
											resizable: false,
											width: 650,
											width: 550,
											buttons: {
												"Ok": function(){
													$(this).dialog("close");
													//location = 'http://www.firsthopecorps.org/admin/kickapps/manage';
												}
											}
			});

}
function UpdateTeam(id){
	if($("#teamKID").val()){
	$("#childRes").html('<center><img src="http://www.firsthopecorps.org/misc/loading.gif" /></center>');
	$.post(
		"/admin/kickapps/editteam/"+id + '/' + $("#teamtitleName").val()+ '/' + $("#teamKID").val() + '/' + $("#teamColor").val(),
		{func: ""},
		function(sReply){
			if (sReply.STATUS == "Success"){  
				$("div#statusMsg").html('The team was successfully updated.');
			}
		},
		"json"
	);
	} else{
	alert("Please fill up the kickapps team id.");
	}
}

function UpdateTitleEach(child_id, type, parentid){
   var editid = $("#edittitleID_"+child_id).val();
	var editname = $("#edittitleName_"+child_id).val();
    $("#childRes").html('<center><img src="http://www.firsthopecorps.org/misc/loading.gif" /></center>');
	$.post(
		"/admin/kickapps/updatetitle/"+type + '/' + editid + '/' +  editname + '/' + parentid,
		{func: ""},
		function(sReply){
			if (sReply.STATUS == "Success"){ 
			 $("#statusMsg").html('The title was successsfully updated.');
			 $("#childRes").html(sReply.RES);
			}
		},
		"json"
	);
}
 
function UpdateTitle(id, type, parentid){

	$.post(
		"/admin/kickapps/updatetitle/"+type + '/' + id + '/' + $("#titleName").val(),
		{func: ""},
		function(sReply){
			if (sReply.STATUS == "Success"){ 
			 $("#statusMsg").html('The title was successsfully updated.');
			}
		},
		"json"
	); 
	
}

function openDivisionDialog(){
	$("#division_Dialog").dialog(
	{
											modal: true,
											autoOpen: true,
											resizable: false,
											width: 450,
											width: 350,
											buttons: {
												"Ok": function(){
													$(this).dialog("close");
													//location = 'http://www.firsthopecorps.org/admin/kickapps/manage';
												}
											}
	});
}

function addNewCategoryDiv(type){
    $.post(
		"/admin/kickapps/addcategory/"+type + '/' + $("#atitleName").val() + '/' + '0',
		{func: ""},
		function(sReply){
			if (sReply.STATUS == "Success"){ 
				$("#statusMsg").html('The category was successfully added.');
			}
		},
		"json"
	);
}

function addNewCategory(type, parentid){

    $("#childRes").html('<center><img src="http://www.firsthopecorps.org/misc/loading.gif" /></center>');
	if(type == 'team'){
	//console.log('teamtitleName:'+$("#teamtitleName").val()+ '/teamKID:' + $("#teamKID").val() + '/teamColor:' + $("#teamColor").val() + '/parentid:' + parentid);
	var teamtitleName = $("#teamtitleName").val();
	var teamKID = $("#teamKID").val();
	var teamColor = $("#teamColor").val();
	
	if(teamColor == ''){
	teamColor = 0;
	}
	
	if(teamKID == ''){
	teamKID = 0;
	}
	
	if(teamtitleName == ''){
	teamKID = 0;
	}
	
	$.post(
		"/admin/kickapps/addcategoryteams/"+type + '/' + teamtitleName + '/' + teamKID + '/' + teamColor + '/' + parentid,
		{func: ""},
		function(sReply){
			if (sReply.STATUS == "Success"){  
				$("#statusMsg").html('The category was successfully added.');
				$("#childRes").html(sReply.RES);
			}
		},
		"json"
	);
	} else{
    $.post(
		"/admin/kickapps/addcategory/"+type + '/' + $("#ctitleName").val()+ '/' + parentid,
		{func: ""},
		function(sReply){
			if (sReply.STATUS == "Success"){  
				$("#statusMsg").html('The category was successfully added.');
				$("#childRes").html(sReply.RES);
			}
		},
		"json"
	);
	}
}

function editChild(){

	chosen = ""
	len = document.childForm.inputChild.length

	for (i = 0; i <len; i++) {
		if (document.childForm.inputChild[i].checked) {
		chosen = document.childForm.inputChild[i].value
		}
	}

	if (chosen == "") {
	alert("Please select a an item.");
	}
	else {
	var brokenstring=chosen.split("_"); 
	var id = brokenstring[0];
	var name = brokenstring[1];
	$("#edittitleID_"+id).val(id);
	$("#edittitleName_"+id).val(name);
	$("#input_"+id).toggle();
	$("#text_"+id).toggle();
	}
}

function deleteTeam(id){
	var answer = confirm ("Are you sure you want to remove this team?")
		if (answer){
			$.post(
			"/admin/kickapps/deletecategory/" + 'team' + '/' + id,
			{func: ""},
			function(sReply){
				if (sReply.STATUS == "Success"){  
					location = 'http://www.firsthopecorps.org/admin/kickapps/manage';
				}
			},
			"json"
			);
		} else{
		}
}

function deleteCategory(type, id){
	var answer = confirm ("Are you sure you want to remove this category and its sub categories?")
	if (answer){
			$.post(
			"/admin/kickapps/deletecategory/" + type + '/' + id,
			{func: ""},
			function(sReply){
				if (sReply.STATUS == "Success"){  
					location = 'http://www.firsthopecorps.org/admin/kickapps/manage';
				}
			},
			"json"
			);
	} else{
	}
}

function deleteChild(type){

	chosen = ""
	len = document.childForm.inputChild.length

	for (i = 0; i <len; i++) {
		if (document.childForm.inputChild[i].checked) {
		chosen = document.childForm.inputChild[i].value
		}
	}

	if (chosen == "") {
	alert("Please select an item.");
	}
	else {
	var brokenstring=chosen.split("_"); 
	var id = brokenstring[0];
	var name = brokenstring[1];

		var answer = confirm ("Are you sure you want to remove this category and all its sub categories?")
		if (answer){
			$.post(
			"/admin/kickapps/deletecategory/" + type + '/' + id,
			{func: ""},
			function(sReply){
				if (sReply.STATUS == "Success"){  
					location = 'http://www.firsthopecorps.org/admin/kickapps/manage';
				}
			},
			"json"
			);
		} else{
		}
	}
}

function showSelectionMemberList(){
	$("#memberSelectList").show();
}

function btnaddhopeful(teamdid){
	var strmemberselect = '';
	$.each($("#teams_available_hopeful").val(), function(index, value) { 
		strmemberselect += '_' + value;
	});
	var strmemberselect = strmemberselect.substring(1, strmemberselect.length);

	$.post(
		"/admin/kickapps/addmultiplemember/" + strmemberselect + "/" + teamdid,
		{func: ""},
		function(sReply){
		if (sReply.STATUS == "Success"){  
			$("#statusMsg").html("The user(s) has been added to this team.");
			$("#memberRes").html(sReply.RES);
			$("#teams_available_hopeful_div").html(sReply.OPTION);
			$("#memberSelectList").hide();
		}
		},
		"json"
	);
}

function removeMember(){
     
	chosen = ""
	len = document.childForm.inputChild.length

	for (i = 0; i <len; i++) {
		if (document.childForm.inputChild[i].checked) {
		chosen = document.childForm.inputChild[i].value
		}
	}

	if (chosen == "") {
	alert("Please select a member.");
	}
	else {
	var brokenstring=chosen.split("_"); 
	var id = brokenstring[0];
	var kickappsteamid = brokenstring[1];

		var answer = confirm ("Are you sure you want to remove this member from this team?")
		if (answer){
			$("#memberRes").html('<center><img src="http://www.firsthopecorps.org/misc/loading.gif" /></center>');
			$.post(
			"/admin/kickapps/disableMember/" + id + '/' + kickappsteamid,
			{func: ""},
			function(sReply){
				if (sReply.STATUS == "Success"){  
					//location = 'http://www.firsthopecorps.org/admin/kickapps/manage';
					$("#statusMsg").html("The user has been removed from this team.");
					$("#memberRes").html(sReply.RES);
					$("#teams_available_hopeful_div").html(sReply.OPTION);
				}
			},
			"json"
			);
		} else{
		}
	}
}