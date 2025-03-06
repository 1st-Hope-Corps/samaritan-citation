<?php
require_once "./includes/bootstrap.inc";
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

$oResult = db_query("SELECT sFileType,sEmbedCode FROM mystudyrecord_file WHERE id = '" . $_GET["pg"] . "'");
$oRow = db_fetch_object($oResult);
$_GET["pg"] = $oRow->sEmbedCode;

if (strpos($oRow->sEmbedCode, "google.com/") !== false && strpos($oRow->sEmbedCode, "src=") !== false && ($oRow->sFileType == "doc_embed" || $oRow->sFileType == "image_embed")) {
	if (preg_match("/src=\"?([^\>|\"|\s]+)/s",$oRow->sEmbedCode,$match))
		$_GET["pg"] = $match[1];
}

$_GET["pg"] = str_replace(array("a=v&","pid=explorer&","chrome=false&","chrome=true&","api=true&","embedded=true&","hl=en_US&"),"",$_GET["pg"]);
$_GET["pg"] = str_replace("?id=","?srcid=",$_GET["pg"]);
$aFindThese = array("https://", "http://", "leaf", "fileview", "&id=", "?");
$aReplaceWithThese = array("", "", "gview", "gview", "&srcid=", "?a=v&pid=explorer&chrome=false&api=true&embedded=true&hl=en_US&");
$pg = "http://" . str_replace($aFindThese, $aReplaceWithThese, $_GET["pg"]);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
html, body {
	overflow:none;
}
</style>
</head>

<body>
<div style="position:absolute;top:0px;left:0px;overflow:hidden;width:100%;height:100%">
<iframe style="position:relative;top:-70px;left:-10px;overflow:hidden" width="105%" scrolling="no" height="120%" src="<?php echo $pg; ?>" >
</iframe>
</div>
</body>
</html>