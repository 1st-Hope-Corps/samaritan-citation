<?php
require_once './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
?>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<?php
echo '<div id="folderhunt"><h3>Treasure Hunt Folders</h3>';

$sqlFldr = "SELECT tfolder_id, tfolder_name, tfolder_password
						FROM treasurehunt_folders
						ORDER BY tfolder_id";
			
$oFldr = db_query($sqlFldr);
						
while ($oThisF = db_fetch_object($oFldr)){

	echo '<div style="float:left;margin:10px;cursor:pointer;" onclick="openDocument(\''.$oThisF->tfolder_id.'\',\''.$oThisF->tfolder_name.'\',\''.$oThisF->tfolder_password.'\');">
			<img src="/themes/theme2010/images/gi_folder.png" width="100" height="100">
			<center>'.$oThisF->tfolder_name.'</center>
	      </div>';
}

echo '</div>';


echo '<div id="filehunt" style="display:none;">';

$sqlFile = "SELECT tfiles_id, tfiles_name, tfiles_content, tfolder_id
			FROM treasurehunt_files
			ORDER BY tfolder_id";
			
$oFile = db_query($sqlFile);
		echo '<br/><a href="/folder.php" style="color:black;text-decoration:none;" /><b>Back to Folders</b></a>';
		while ($oThisFile = db_fetch_object($oFile)){
			echo '<div style="display:none;margin:10px;" id="'.$oThisFile->tfolder_id.'">
					<div><h2>'.$oThisFile->tfiles_name.'</h2></div>
					<div><textarea rows="30" cols="60" style="font-size:16px;width: 615px; height: 362px;">'.stripslashes($oThisFile->tfiles_content).'</textarea></div>
				  </div>';
			echo '<div>&nbsp;</div>';
		}

echo '</div>';
?>
<input type="hidden" id="temppass" name="temppass" value=""/>
<input type="hidden" id="folderid" name="folderid" value=""/>
<div id="password_Dialog" title="HopeNet Security" style="display:none;">
	<br/>
	Enter Password from <span id="foldername">&nbsp;</span>
	<br/><br/>
	<center>
		<input type="input" id="passwrd" name="passwrd" value="" /> <input type="button" id="submitPass" name="submitPass" onclick="submitPass();" value="Submit"/>
	</center>
</div>
<script type="text/javascript">

function openDocument(id, name, password){
	
	$("#temppass").val(password); 
	$("#folderid").val(id);
	$("#foldername").text(name); 
	if(password){
		$("#password_Dialog").dialog({
											modal: true,
											autoOpen: true,
											resizable: false,
											width: 350,
											height: 250,
											buttons: {
												"Ok": function(){
													$(this).dialog("close");
												}
											}
		});
	
	}
}

function submitPass(){
	if($("#passwrd").val() == $("#temppass").val()){
		$( "#password_Dialog" ).dialog("close");
		$("#folderhunt").hide();
		$("#filehunt").show();
		$("#"+$("#folderid").val()).show();
	} else{
		alert("incorrect password");
	}
}
</script>