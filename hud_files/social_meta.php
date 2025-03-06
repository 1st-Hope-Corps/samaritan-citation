<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
if((isset($_COOKIE['workz_share_id']) || isset($_GET['workz_share_id'])) && from_social()) {

	$workz_share_id = $_GET['workz_share_id'];

	if (isset($_COOKIE['workz_share_id'])) {
		$workz_share_id = $_COOKIE['workz_share_id'];
	}
	$sqlDetails = "SELECT *
					FROM kindness_submit A
					WHERE A.id = %d";
	$oDetails = db_fetch_object(db_query($sqlDetails, $workz_share_id));
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Samaritan Citation</title>

		<meta property="og:title" content="<?= $oDetails->sTitle ?>">
		<meta property="og:type" content="article" />
		<meta property="og:description" content="<?= $oDetails->sDesc ?>">
		<meta property="og:image" content="<?= url('', array( 'absolute' => true ))."hud_files/uploads/workz/".$oDetails->workz_image ?>">
		<meta property="og:url" content="<?= url('', array( 'absolute' => true )).'?workz_share_id='.$oDetails->id.'&social_share=1' ?>">
		<meta name="twitter:card" content="summary_large_image">
		<meta property="twitter:image" content="<?= url('', array( 'absolute' => true ))."hud_files/uploads/workz/".$oDetails->workz_image ?>">
		<meta property="twitter:title" content="<?= $oDetails->sTitle ?>">
		<meta name="twitter:site" content="hopecorps">
		<meta name="twitter:creator" content="hopecorps">
	</head>
	<body>
	
	</body>
	</html>
	<?php
	exit;
}

function saveLog($data)
{
    $file = fopen('./logs.txt', 'a');
    fwrite($file, $data);
    fwrite($file, PHP_EOL);
    fclose($file);
}

function from_social()
{
	saveLog($_SERVER['HTTP_USER_AGENT']);
	if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'twitter') !== false || strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'facebook') !== false){
		return true;
	}

	return false;
}

?>