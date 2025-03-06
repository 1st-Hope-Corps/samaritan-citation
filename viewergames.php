<?php
header('Content-Type: image/jpeg');

require_once "./includes/bootstrap.inc";
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

$oResult = db_query("SELECT sFileType,sEmbedCode FROM mystudyrecord_file WHERE id = '" . $_GET["pg"] . "'");
$oRow = db_fetch_object($oResult);
$pg = $oRow->sEmbedCode;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
html, body {
	background-color:#000;
	overflow:none;
}
</style>
</head>

<body>
<div width="800" height="600" align="center">
<?php
$aNewstring = preg_replace('/\width=".*?"/', 'width="1200"', $pg);
$sFinalString = preg_replace('/\ height=".*?"/', ' height="800"', $aNewstring);
echo $sFinalString;
?>
</div>
</body>
</html>