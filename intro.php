<?php
require_once "./includes/bootstrap.inc";
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cybrary Intro</title>
<script type="text/javascript" src="misc/jquery.js?q"></script>
<script type="text/javascript">
$(document).ready(
	function(){
		
	}
);
</script>
</head>

<body style="background-color:#003300;">

<div id="Intro" style="width:947px; margin-left:auto; margin-right:auto; position:relative;">
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="947" height="601" id="intro" align="middle">
		<param name="allowScriptAccess" value="sameDomain" />
		<param name="allowFullScreen" value="false" />
		<param name="movie" value="home_files/intro.swf" />
		<param name="quality" value="high" />
		<param name="wmode" value="transparent" />
		<param name="bgcolor" value="#333333" />
		<embed src="home_files/intro.swf" quality="high" wmode="transparent" bgcolor="#333333" width="947" height="601" name="intro" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
</div>

</body>

</html>
