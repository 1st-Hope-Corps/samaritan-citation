<?php

set_time_limit(0);

require_once "./includes/bootstrap.inc";
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

require_once 'hud_files/Youtube_Video_Api.php';
			
$oYTVA = new Youtube_Video_Api();

$aDeletedVideos = array();

$sQuery = "SELECT sUrl,iGroupLevel FROM mystudyrecord_youtube_delete";
$result = db_query($sQuery);
while($row = db_fetch_object($result)) {
	$aDeletedVideos[] = $row->iGroupLevel . "|" . $row->sUrl;
}

$sQuery = "SELECT sEmbedCode,iGroupLevel FROM mystudyrecord_file";
$result = db_query($sQuery);
while($row = db_fetch_object($result)) {
	$aDeletedVideos[] = $row->iGroupLevel . "|" . $row->sEmbedCode;
}

$sQuery = "SELECT sEmbedCode,iGroupLevel FROM mystudyrecord_suggested_file";
$result = db_query($sQuery);
while($row = db_fetch_object($result)) {
	$aDeletedVideos[] = $row->iGroupLevel . "|" . $row->sUrl;
}

$aIllegalChars = array("and","amp;","&","(",")",","," etc","'","\"","-");
$aReplace = array("","","","","","","","","");
$iCtr = 0;
$sQuery = "SELECT 
	g.id,
	g.title, 
	(IFNULL(sf.iCount,0) + IFNULL(f.iCount,0)) as iTotalCount
FROM mystudyrecord g
LEFT JOIN (
	SELECT COUNT(id) as iCount, iGroupLevel
	FROM mystudyrecord_file
	WHERE sFileType IN ('video', 'video_ext', 'video_embed', 'video_youtube')
	GROUP BY iGroupLevel
) f ON g.id = f.iGroupLevel 
LEFT JOIN (
	SELECT COUNT(id) as iCount, iGroupLevel
	FROM mystudyrecord_suggested_file
	WHERE sFileType IN ('video', 'video_ext', 'video_embed', 'video_youtube')
	GROUP BY iGroupLevel
) sf ON g.id = sf.iGroupLevel 
WHERE g.leaf = 1
HAVING iTotalCount < 8";

$result = db_query($sQuery);
while(($row = db_fetch_object($result))) {
	$iVideosCount = $row->iTotalCount;
	$sKeys = GetKeywords($row->id);
	$sKeyword = (strlen($sKeys) < 3) ? $row->title : $sKeys;
	$sKeyword = urlencode(strtolower(str_replace($aIllegalChars,'',urldecode($sKeyword))));
	$sKeyword = str_replace("++","+",$sKeyword);
	
	$aItems = array();
	$sKeys = $sKeyword;
	while(count($aItems) < 8 && !empty($sKeys)) {
		$aItems = $oYTVA->search($sKeys, '', 50);
		$aTmp = explode("+",$sKeys);
		unset($aTmp[count($aTmp) - 1]);
		$sKeys = implode("+",$aTmp);
	}
	echo "<br />" . $iCtr . ".) " . $row->id . " - " . $sKeys . " - " . $sKeyword;
	
	if(is_array($aItems))
	{
		foreach($aItems as $item)
		{			
			if ($iVideosCount == 8) {
				break;
			}
			if (in_array($row->id . "|" . $item['link'], $aDeletedVideos)) {
				continue;
			}
			$aDeletedVideos[] = $row->id . "|" . $item['link'];
			$iVideosCount ++;
			$iCtr ++;
			

			db_query("INSERT INTO mystudyrecord_suggested_file SET
						iUserId = '1049',
						sFileType = 'video_youtube',
						sFileId = NULL,
						sEmbedCode = '" . $item['link'] . "',
						iGroupLevel = '" . $row->id . "',
						iRefId = NULL,
						sTitle = '" . htmlspecialchars($item['name'],ENT_QUOTES) . "',
						sDesc = '" . htmlspecialchars($item['description'],ENT_QUOTES) . "',
						sTags = '',
						iEditorId = NULL,
						iAdminId = NULL,
						sFileGroup = '',
						sAgeGroup = '-1'"
			);

			echo "<br /> - " . $item["name"] . ""; 				
		}
	}
}

function GetKeywords($iGroupLevel){
	$sqlQuery = "SELECT id, group_level, title
				FROM mystudyrecord
				WHERE id = %d";
	
	$oQueryResult = db_query($sqlQuery, $iGroupLevel);
	$oQuery = db_fetch_object($oQueryResult);
	
	$stop = false;
	if (strtolower($oQuery->title) != "other" && strtolower($oQuery->title) != "others") 
		$stop = true;
	do {
		$iGroupLevel = $oQuery->group_level;
		$sKeywords .= " ".$oQuery->title;
		
		if ($stop)
			break;
		$oQueryResult = db_query($sqlQuery, $iGroupLevel);
		$oQuery = db_fetch_object($oQueryResult);
	} while ($iGroupLevel > 0);
	
	return urlencode(trim(str_replace(array("&", "and"), array("", ""), $sKeywords)) . " kids");
}

echo "DONE";