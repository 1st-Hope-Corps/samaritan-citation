<?php
require_once "./includes/bootstrap.inc";
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

// Checks if the current user is logged in.
if ($user->uid == 0) header("Location: user?destination=hopenet.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cybrary HopeNet</title>
<script type="text/javascript" src="misc/jquery.js?q"></script>
<script type="text/javascript">
$(document).ready(
	function(){
		$("#SkipButton").click(
			function(){
				location = 'hud.php';
			}
		);
		
		ApplyOffset();
	}
);

function GetWindowWidth(){
	if (parseInt(navigator.appVersion) > 3) {
		if (navigator.appName == "Netscape") {
			iWinW = window.innerWidth;
			//iWinH = window.innerHeight;
		}
		
		if (navigator.appName.indexOf("Microsoft") != -1) {
			iWinW = document.body.offsetWidth;
			//iWinH = document.body.offsetHeight;
		}
	}
	
	return iWinW;
}

function ApplyOffset(){
	iOffset = (GetWindowWidth()/2)+130;
	
	$("#Skip").css("left", iOffset+"px");
}

window.onresize = function(){
	ApplyOffset();
}
</script>
</head>

<body style="background-color:#003300;" bgcolor="#003300">

<div id="HopeNet" style="width:963px; margin-left:auto; margin-right:auto; position:relative;">
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="960" height="600" id="intro" align="middle">
		<param name="allowScriptAccess" value="sameDomain" />
		<param name="allowFullScreen" value="false" />
		<param name="movie" value="hopenet_files/hopenet.swf" />
		<param name="quality" value="high" />
		<param name="wmode" value="transparent" />
		<param name="bgcolor" value="#333333" />
		<embed src="hopenet_files/hopenet.swf" quality="high" wmode="transparent" bgcolor="#333333" width="960" height="600" name="intro" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
</div>

<div id="Skip" style="width:120px; margin-left:auto; margin-right:auto; text-align:center; padding-left:13px; position:absolute; top:432px; cursor:pointer;">
	<button id="SkipButton" type="button" style="font-size:12px; color:yellow; background-color:#006600; border:2px solid yellow;">Skip Video</button>
</div>

</body>
</html>
