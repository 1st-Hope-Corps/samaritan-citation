<?php
require_once "./includes/bootstrap.inc";
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

 
$iGroupLevel = (isset($_REQUEST["i"]) && $_REQUEST["i"] != "") ? $_REQUEST["i"]:0;
$sType = (isset($_REQUEST["q"]) && $_REQUEST["q"] != "") ? $_REQUEST["q"]:"";
$sTypeSub = (isset($_REQUEST["qq"]) && $_REQUEST["qq"] != "") ? $_REQUEST["qq"]:"";
$sTypeSubSub = (isset($_REQUEST["qqq"]) && $_REQUEST["qqq"] != "") ? $_REQUEST["qqq"]:"";
$sTag = (isset($_REQUEST["qqqq"]) && $_REQUEST["qqqq"] != "") ? "%".$_REQUEST["qqqq"]."%":"%";
$sItemType = (isset($_REQUEST["t"]) && $_REQUEST["t"] != "") ? $_REQUEST["t"]:"";

$iCatCount = 0;
$sOutput = "";
$sBasePath = base_path();
$sImageDomain = 'http://images.shrinktheweb.com/xino.php?stwembed=1&stwaccesskeyid=5918cb01a07b335';
$sImageURL = $sImageDomain.'&stwxmax=512&stwymax=384&stwinside=1&stwurl=';
$sWhereClause = "";


$sUserAgeSettings = mystudies_agemanagement(0,$user->uid,'');

if ($sUserAgeSettings == ""){
	$sAgeWhereClause = "";
	//$sAgeWhereClause = " AND sAgeGroup IN ('".$sUserAgeSettings."', '-1') ";
}else{
	$sAgeWhereClause = " AND (sAgeGroup = '" . $sUserAgeSettings . "' OR IFNULL(sAgeGroup,'') = '') ";
}

switch($sType){
case "links":

	if ($sTypeSubSub == "fave"){
		if ($sTag != "%"){
			$sWhereClause1 .= "B.sSiteType = '".$sTypeSub."' AND B.sTags LIKE '%s'";
			$sWhereClause2 .= "D.sSiteType = '".$sTypeSub."' AND D.sTags LIKE '%s'";
		}else{
			$sWhereClause1 = "B.group_level = ".$iGroupLevel." AND B.sSiteType = '".$sTypeSub."'";
			$sWhereClause2 = "D.group_level = ".$iGroupLevel." AND D.sSiteType = '".$sTypeSub."'";
		}
		
		$sqlLinks = "(SELECT A.iVisitCount AS iVisitCount, B.id, B.group_level, B.title, B.url, B.description, B.sAgeGroup, 'site_rec' AS sSiteType
					FROM mystudyrecord_favorite A
					INNER JOIN mystudyrecord_site B ON B.id = A.iRefId
					WHERE ".$sWhereClause1.str_replace("sAgeGroup","B.sAgeGroup",$sAgeWhereClause).")
					UNION
					(SELECT C.iVisitCount AS iVisitCount, D.id, D.group_level, D.title, D.url, D.description, D.sAgeGroup, 'site_other' AS sSiteType
					FROM mystudyrecord_favorite C
					INNER JOIN mystudyrecord_suggested_site D ON D.id = C.iRefId
					WHERE D.promoted = 1
						AND ".$sWhereClause2.str_replace("sAgeGroup","D.sAgeGroup",$sAgeWhereClause).")
					ORDER BY iVisitCount DESC";
	}elseif ($sTypeSubSub == "other"){
		$sSiteType = "site_other";
		
		if ($sTag != "%"){
			$sWhereClause .= "sSiteType = '".$sTypeSub."' AND sTags LIKE '%s'";
		}else{
			$sWhereClause .= "group_level = ".$iGroupLevel." AND sSiteType = '".$sTypeSub."'";
		}
		
		$sqlLinks = "SELECT id, title, url, description, sAgeGroup 
					FROM {mystudyrecord_suggested_site}
					WHERE promoted = 1
						AND ".$sWhereClause. $sAgeWhereClause . "
					ORDER BY id ASC";
	}else{
		$sSiteType = "site_rec";
		
		if ($sTag != "%"){
			$sWhereClause .= "sSiteType = '".$sTypeSub."' AND sTags LIKE '%s'";
		}else{
			$sWhereClause .= "group_level = ".$iGroupLevel." AND sSiteType = '".$sTypeSub."'";
		}
		
		$sqlLinks = "SELECT id, sSiteType, group_level, title, url, description, sTags, sAgeGroup
					FROM mystudyrecord_site 
					WHERE ".$sWhereClause. $sAgeWhereClause . "
					ORDER BY id ASC";
	}
	
	$aOptions = ($sTag != "%") ? array($sTag):array();
	$oLinksResult = db_query($sqlLinks, $aOptions);
	$iSpacerCount = 22222;
	
	while ($oLinks = db_fetch_object($oLinksResult)){
		$sTitle = $oLinks->title;
		$sDesc = mb_convert_encoding($oLinks->description, "UTF-8", "UTF-8");
		$iGroupLevel = ($sTag != "%") ? $oLinks->group_level:$iGroupLevel;
		
		if (!isset($sSiteType)) $sSiteType = $oLinks->sSiteType;
		
		$sOutput .= '<item>
						<uid>'.$oLinks->id.'</uid>
						<file>link</file>
						<name><![CDATA['.$sTitle.']]></name>
						<thumb><![CDATA['.$sImageURL.$oLinks->url.']]></thumb>
						<description><![CDATA[<font size="15"><b>'.$sTitle.'</b></font><br/><br/>'.$sDesc.']]></description>
						<group_id>'.$iGroupLevel.'</group_id>
						<link>http://'.$_SERVER["HTTP_HOST"].base_path().'values/content/url/wrapper/'.$oLinks->id.'/'.$sSiteType.'/'.base64_encode($oLinks->url).'</link>
						<target>_blank</target>
					</item>';
	}
	
	if ($sOutput == ""){
		$sOutput = '<item>
						<uid>1</uid>
						<file>link</file>
						<name><![CDATA[No Content]]></name>
						<thumb><![CDATA['.$sBasePath.'hud_files/images/carousel_no_data.png]]></thumb>
						<description><![CDATA[No content to display, yet.]]></description>
						<group_id>0</group_id>
						<link>http://www.hopecybrary.org/hud.php</link>
						<target>_blank</target>
					</item>';
	}
	
break;
case "tags":
/*
	$sqlSites = "SELECT DISTINCT group_level FROM mystudyrecord_site
				UNION
				SELECT DISTINCT group_level FROM mystudyrecord_suggested_site
				ORDER BY group_level";
	$oSitesResult = db_query($sqlSites);
	$aSitesGroup = array();
	$aTags = array();
	
	while ($oSite = db_fetch_object($oSitesResult)){
		$aSitesGroup[] = $oSite->group_level;
	}
	
	for ($i=1; $i<count($aSitesGroup); $i++){
		$iOrigGroup = $aSitesGroup[$i];
		$iSiteGroup = $iOrigGroup;
		
		if ($sTypeSub == 1 && $iOrigGroup != $iGroupLevel) continue;
		
		if ($sTypeSub == 1 && $iOrigGroup == $iGroupLevel){
			// Already on the last level
			$iRawGroupLevel = $iGroupLevel;
		}else{
			// All levels except the last
			do {
				$sqlSubj = "SELECT group_level FROM mystudyrecord WHERE id = %d";
				$iRawGroupLevel = db_result(db_query($sqlSubj, $iSiteGroup));
				$iSiteGroup = $iRawGroupLevel;
				
				if ($iRawGroupLevel == 0) break;
			}while ($iRawGroupLevel != $iGroupLevel);
		}
		
		if ($iRawGroupLevel == $iGroupLevel || $sTypeSub == 1){
			$sqlTags = "SELECT id, title, sTags
						FROM mystudyrecord_site
						WHERE group_level = %d
							AND sTags IS NOT NULL 
							AND sTags != ''
						UNION
						SELECT id, title, sTags
						FROM mystudyrecord_suggested_site
						WHERE group_level = %d
							AND sTags IS NOT NULL 
							AND sTags != ''";
			
			$oTagsResult = db_query($sqlTags, array($iOrigGroup, $iOrigGroup));
			
			while ($oTags = db_fetch_object($oTagsResult)){
				$aRawTags = explode(",", $oTags->sTags);
				
				for ($x=0; $x<count($aRawTags); $x++){
					$aTags[] = $aRawTags[$x];
				}
			}
			
			$sqlTags = "SELECT id, sTags
						FROM mystudyrecord_file
						WHERE iGroupLevel = %d
							AND sTags IS NOT NULL 
							AND sTags != ''";
			
			$oTagsResult = db_query($sqlTags, $iOrigGroup);
			
			while ($oTags = db_fetch_object($oTagsResult)){
				$aRawTags = explode(",", $oTags->sTags);
				
				for ($x=0; $x<count($aRawTags); $x++){
					$aTags[] = $aRawTags[$x];
				}
			}
		}
	}
	
	$sReturnTags = "";
	$aTags = array_count_values($aTags);
	ksort($aTags);
	
	foreach ($aTags as $sKey => $sVal){
		$sReturnTags .= ($sReturnTags != "") ? ",":"";
		$sReturnTags .= $sKey."::".$sVal;
	}
	
	exit("tags=".$sReturnTags);
	*/
break;
case 'files':

	if ($sTag != "%"){
		$sWhereClause .= "sFileType IN ('%s', '%s', '%s', '%s') AND sTags LIKE '%s'";
	}else{
		$sWhereClause .= "sFileType IN ('%s', '%s', '%s', '%s') AND iGroupLevel = %d";
	}
	
	if ($sTypeSub == "image" || $sTypeSub == "doc" || $sTypeSub == "video"){
		if ($sTypeSubSub == "other" || $sTypeSubSub == "rec"){
			$sWhereClause .= " AND sFileGroup = '".$sTypeSubSub."'";
		}else{
			$sqlFiles = "SELECT A.iVisitCount AS iVisitCount, B.id, B.group_level, B.title, B.url, B.description
						FROM mystudyrecord_favorite A
						INNER JOIN mystudyrecord_file B ON B.id = A.iRefId
						WHERE ".$sWhereClause. str_replace("sAgeGroup","B.sAgeGroup",$sAgeWhereClause) . "
						ORDER BY iVisitCount DESC
						LIMIT 3";
		}
	}
	
	$sOption = ($sTag != "%") ? $sTag:$iGroupLevel;
	$sqlFiles = "SELECT id, sFileType, sFileId, sEmbedCode, iGroupLevel, 
					IF(sTitle != '', sTitle, 'No Title Specified') AS sTitle, sDesc, sAgeGroup
				FROM mystudyrecord_file
				WHERE ".$sWhereClause. $sAgeWhereClause;
	
	$oFilesResult = db_query($sqlFiles, array($sTypeSub, $sTypeSub."_ext", $sTypeSub."_embed", $sTypeSub."_youtube", $sOption));
	$iVideoCount = 0;
	
	while ($oFiles = db_fetch_object($oFilesResult)){
		$sId = $oFiles->id;
		$sFileType = $oFiles->sFileType;
		$sFileId = $oFiles->sFileId;
		$sFileTitle = $oFiles->sTitle;
		$sFileDesc = mb_convert_encoding($oFiles->sDesc, "UTF-8", "UTF-8");
		
		switch ($sTypeSub){
			case "image":
				if ($sFileType == $sTypeSub){
					$sFileURL = "http://www.divshare.com/img/".$sFileId;
					//$sFileFull = $sBasePath."values/file/image/".$iGroupLevel."/view/".$sId;
                    $sFileFulldiv = $sBasePath."values/file/image/".$iGroupLevel."/view/".$sId;
                    $sFileFull = 'http://'.$_SERVER["HTTP_HOST"].base_path().'values/content/url/wrapper/'.$sId.'/'.$sFileType.'/'.base64_encode($sFileFulldiv);
				}elseif ($sFileType == "image_embed"){
					$sRawURL = GetAttribute("src", $oFiles->sEmbedCode);
					$sFileURL = $sRawURL;
					//$sFileFull = 'http://'.$_SERVER["HTTP_HOST"].base_path().'values/content/url/wrapper/'.$sId.'/'.$sFileType.'/'.base64_encode($sRawURL);
					$sFileFulldiv = $sBasePath."values/file/image/".$iGroupLevel."/view/".$sId;
                    $sFileFull = 'http://'.$_SERVER["HTTP_HOST"].base_path().'values/content/url/wrapper/'.$sId.'/'.$sFileType.'/'.base64_encode($sFileFulldiv);
                }else{
					$sFileURL = $sImageURL.$oFiles->sEmbedCode;
					$sFileFull = 'http://'.$_SERVER["HTTP_HOST"].base_path().'values/content/url/wrapper/'.$sId.'/'.$sFileType.'/'.base64_encode($oFiles->sEmbedCode);
					//$sFileFull = $oFiles->sEmbedCode;
				}
				
				break;
			
			case "doc":
				if ($sFileType == $sTypeSub){
					$sFileURL = $sBasePath.'misc/file_doc.png';
					$sFileFull = $sBasePath."values/file/doc/".$iGroupLevel."/view/".$sId;
				}elseif ($sFileType == "doc_embed"){
					$sFileURL = $sBasePath.'misc/file_doc.png';					
					$sFileFull = $sBasePath."values/file/doc/".$iGroupLevel."/view/".$sId;
				}else{
					$sFileURL = $sImageURL.$oFiles->sEmbedCode;
					$sFileFull = 'http://'.$_SERVER["HTTP_HOST"].base_path().'values/content/url/wrapper/'.$sId.'/'.$sFileType.'/'.base64_encode($oFiles->sEmbedCode);
					//$sFileFull = $oFiles->sEmbedCode;
				}
				
				break;
			
			case "video":
				// firsthopecorps.org/carousel_xml_hud.php?i=18&q=files&qq=video&qqq=rec
			
				$iVideoCount++;
				$sVideoType = 'youtube';
				$sFileURL = 'hud_files/images/default_video_thumb.jpg';
				
				if ($sFileType == $sTypeSub) {	
					$sFileFull = 'http://www.divshare.com/flash/video?myId='.$sFileId;
					$sVideoType = 'divshare';
				} 
                
                if ($sFileType == "video_embed") {
					//extract the src from embed code
					/* $oDomDoc = new DOMDocument();
					@$oDomDoc->loadHTML($oFiles->sEmbedCode);
                                                                 					
					if(strpos($oFiles->sEmbedCode, 'object')){                        
                        $oEmbed = $oDomDoc->getElementsByTagName("embed");
                        $oEmbedMovie = $oEmbed->item(0);
                        $sFileFull = $oEmbedMovie->getAttribute("src");
                        if (strpos($sFileFull, "youtube.com") !== false){
                            $sFileURL = $sImageURL.str_replace("/v/", "/watch?v=", $sFileFull);
                        }
                    } */  
                    
                    //if(strpos($oFiles->sEmbedCode, 'iframe')){
                        //$iframepos = $oFiles->sEmbedCode;
                       /* $oEmbed = $oDomDoc->getElementsByTagName("iframe");
                        $oEmbedMovie = $oEmbed->item(0);
                        $sFileFull = $oEmbedMovie->getAttribute("src");
                        if (strpos($sFileFull, "youtube.com") !== false){
                            $sFileURL = $sImageURL.str_replace("/embed/", "/watch?v=", $sFileFull);
                        }*/
                    //}
                    
				} else {
					//video_ext
					// the embed code is already available
					$sFileFull = $oFiles->sEmbedCode;
					$sFileURL = $sImageURL.$sFileFull;
				}
			                                     
				if ($sFileType == "video_youtube") {
					$sTmp = end(explode("/",$oFiles->sEmbedCode));
					$aTmp = explode("&",$sTmp);
					$sFileURL = "http://i.ytimg.com/vi/" . $aTmp[0] . "/hqdefault.jpg";	
					$sFileType = "video_embed";
				} else if (strpos($oFiles->sEmbedCode,"youtube.com/") !== false) {
					preg_match("/youtube\.com\/v\/([0-9a-zA-Z_-]+)/s",$oFiles->sEmbedCode,$aTmp);
					if (empty($aTmp[1]))
						preg_match("/youtube\.com\/watch\?v\=([0-9a-zA-Z_-]+)/s",$oFiles->sEmbedCode,$aTmp);
					if (empty($aTmp[1])) {
						
                       if(strpos($oFiles->sEmbedCode, 'iframe')){     
                        preg_match("/youtube\.com\/embed\/([0-9a-zA-Z_-]+)/s",$oFiles->sEmbedCode,$aiframe);
                                   
                        $sFileURL = "http://i.ytimg.com/vi/".$aiframe[1]."/hqdefault.jpg";                                          
                        $sFileFull = 'http://www.youtube.com/v/'.$aiframe[1].'&hl=en&fs=1&rel=0&color1=0x234900&color2=0x4e9e00&border=1';
                        $sFileType = "video_embed";    
                       } else{
                        $sFileURL = 'hud_files/images/default_video_thumb.jpg';    
                       }
                                                   
					} else {
						$sFileURL = "http://i.ytimg.com/vi/" . $aTmp[1] . "/hqdefault.jpg";	
						$sFileFull = 'http://www.youtube.com/v/'. $aTmp[1] . '&hl=en&fs=1&rel=0&color1=0x234900&color2=0x4e9e00&border=1';
						$sFileType = "video_embed";
					}
				}
				break;	
		}
		
		if (!$sFileId) $sFileId = $sId;
		
		if (!empty($oFiles->sEmbedCode) && strpos($oFiles->sEmbedCode, "google.com/a/hopecybrary.org/") !== false && ($oFiles->sFileType == "doc_ext" || $oFiles->sFileType == "image_ext")){
			if (!empty($oFiles->sFileId))
				$sFileURL = $oFiles->sFileId;
			else
				$sFileURL = str_replace("&stwurl=","&stwdelay=5&stwurl=",$sImageURL) .'http://hopegames.org/viewer.php?pg=' . $oFiles->id; 	
		} else if (strpos($oFiles->sEmbedCode, "google.com/") !== false && strpos($oFiles->sEmbedCode, "src=") !== false && ($oFiles->sFileType == "doc_embed" || $oFiles->sFileType == "image_embed")) {
			if (preg_match("/src=\"?([^\>|\"|\s]+)/s",$oFiles->sEmbedCode,$match)) {
				$sFileURL = str_replace("&stwurl=","&stwdelay=5&stwurl=",$sImageURL) .'http://hopegames.org/viewer.php?pg=' . $oFiles->id; 
				$sFileType = "doc_ext";
				$sFileFull = 'http://'.$_SERVER["HTTP_HOST"].base_path().'values/content/url/wrapper/'.$sId.'/'.$sFileType.'/'.base64_encode($match[1]);		
			}
		}
		
        if($sFileType == "image_embed"){
           $sFileType = 'link';
        }
		$sOutput .= '<item>
						<uid>'.$sFileId.'</uid>
						<file>'.$sFileType.'</file>
						<name><![CDATA['.$sFileTitle.']]></name>
						<thumb><![CDATA['.$sFileURL.']]></thumb>
						<description><![CDATA[<font size="15"><b>123'.$sFileTitle.'</b></font><br/><br/>'.$sFileDesc.']]></description>
						<group_id><![CDATA['.$iGroupLevel.']]></group_id>
						<link><![CDATA['.$sFileFull.']]></link>
						<target>_blank</target>
						<video_type>'.$sVideoType.'</video_type>
					</item>';	
	}
	
	if ($sOutput == ""){
		$sOutput = '<item>
						<uid>1</uid>
						<file>link</file>
						<name><![CDATA[No Content]]></name>
						<thumb><![CDATA['.$sBasePath.'hud_files/images/carousel_no_data.png]]></thumb>
						<description><![CDATA[No content to display, yet.]]></description>
						<group_id>0</group_id>
						<link>http://www.hopecybrary.org/hud.php</link>
						<target>_blank</target>
					</item>';
	}
	
	/*
	// if db result is less than 8, we need to get the videos from YouTube
	if ($sTypeSub && $iVideoCount < 8) 
	{
		if ($sTypeSub == 'video' && $iVideoCount < 8)
		{
			require_once 'hud_files/Youtube_Video_Api.php';
			
			$oYTVA = new Youtube_Video_Api();
			
			$iRemaining = 8 - $iVideoCount;
			$sKeywords = (strlen(GetKeywords($iGroupLevel)) < 3) ? $sTag:GetKeywords($iGroupLevel);
			$aItems = $oYTVA->search($sKeywords, '', $iRemaining);
			
			if(is_array($aItems))
			{
				foreach($aItems as $item)
				{										
					$sItem .= '<item>
								<uid>'.$item['uid'].'</uid>
								<file>video</file>
								<name><![CDATA['.$item['name'].']]></name>
								<thumb><![CDATA['.$item['thumb'].']]></thumb>
								<description><![CDATA[<font size="15"><b>'.$item['name'].'</b></font><br/><br/>'.$item['description'].']]></description>
								<group_id><![CDATA['.$item['group_id'].']]></group_id>
								<link><![CDATA['.$item['link'].']]></link>
								<target>_blank</target>
								<video_type>youtube</video_type>		
							</item>';
				}
			}
			
			$sOutput .= $sItem;
		}
	}
	*/

break;
case "tagall":

	$sWhereClause1 = "sSiteType = '%s' AND sTags LIKE '%s'";
	$sWhereClause3 .= "sFileType IN ('%s', '%s', '%s') AND sTags LIKE '%s'";
	
	$aOption1 = array("mystudyrecord_site", "site", $sTag);
	$aOption2 = array("mystudyrecord_suggested_site", "site", $sTag);
	$aOption4 = array("image", "image_ext", "image_embed", $sTag);
	$aOption5 = array("doc", "doc_ext", $sTag);
	$aOption6 = array("mystudyrecord_site", "animation", $sTag);
	
	$sqlSite = "SELECT id, group_level, title, url, description, sAgeGroup
				FROM %s
				WHERE ".$sWhereClause1. $sAgeWhereClause;

	$sqlFile = "SELECT id, sFileType, sFileId, iGroupLevel, sEmbedCode, 
					IF(sTitle != '', sTitle, 'No Title Specified') AS title, sDesc AS description, sAgeGroup
				FROM mystudyrecord_file
				WHERE ".$sWhereClause3. $sAgeWhereClause;
	
	$oSiteRecResult = db_query($sqlSite, $aOption1);
	$oSiteOtherResult = db_query($sqlSite, $aOption2);
	$oPhotoResult = db_query($sqlFile, $aOption4);
	$oDocResult = db_query($sqlFile, $aOption5);
	$oAnimeResult = db_query($sqlSite, $aOption6);
	
	$sXML = '<item>
				<uid>%id%</uid>
				<type>%type%</type>
				<name><![CDATA[%title%]]></name>
				<thumb><![CDATA[%image_url%]]></thumb>
				<description><![CDATA[<font size="15"><b>%title%</b></font><br/><br/>%description%]]></description>
				<group_id>%group_id%</group_id>
				<link><![CDATA[%url%]]></link>
				<target>%target%</target>
			</item>';
	$aFindThese = array("%id%", "%type%", "%title%", "%image_url%", "%description%", "%group_id%", "%url%", "%target%");
	
	// Recommended Sites
	while ($oSiteRec = db_fetch_object($oSiteRecResult)){
		$aReplace = array($oSiteRec->id, "link", $oSiteRec->title, $sImageURL.$oSiteRec->url, $oSiteRec->description, $oSiteRec->group_level, $oSiteRec->url, "_blank");
		$sOutput .= str_replace($aFindThese, $aReplace, $sXML);
	}
	
	// Other Great Sites
	while ($oSiteOther = db_fetch_object($oSiteOtherResult)){
		$aReplace = array($oSiteOther->id, "link", $oSiteOther->title, $sImageURL.$oSiteOther->url, $oSiteOther->description, $oSiteOther->group_level, $oSiteOther->url, "_blank");
		$sOutput .= str_replace($aFindThese, $aReplace, $sXML);
	}
	
	// Photos
	while ($oPhoto = db_fetch_object($oPhotoResult)){
		$sFileURL = "http://www.divshare.com/img/".$oPhoto->sFileId;
		$sFileFull = $sBasePath."values/file/image/".$oPhoto->iGroupLevel."/view/".$oPhoto->id;
		
		$aReplace = array($oPhoto->id, "image", $oPhoto->title, $sFileURL, $oPhoto->description, $oPhoto->group_level, $sFileFull, "_blank");
		$sOutput .= str_replace($aFindThese, $aReplace, $sXML);
	}
	
	// Docs
	while ($oDoc = db_fetch_object($oDocResult)){
		$sFileType = $oDoc->sFileType;
		
		if ($sFileType == "doc"){
			$sFileURL = $sBasePath.'misc/file_doc.png';
			$sFileFull = $sBasePath."values/file/doc/".$iGroupLevel."/view/".$oDoc->id;
		}elseif ($sFileType == "doc_ext"){
			$sFileURL = $sImageURL.$oDoc->sEmbedCode;
			$sFileFull = $oDoc->sEmbedCode;
		}
		
		$aReplace = array($oDoc->id, "doc", $oDoc->title, $sFileURL, $oDoc->description, $oDoc->group_level, $sFileFull, "_blank");
		$sOutput .= str_replace($aFindThese, $aReplace, $sXML);
	}
	
	// Animation
	while ($oAnime = db_fetch_object($oAnimeResult)){
		$aReplace = array($oAnime->id, "link", $oAnime->title, $sImageURL.$oAnime->url, $oAnime->description, $oAnime->group_level, $oAnime->url, "_blank");
		$sOutput .= str_replace($aFindThese, $aReplace, $sXML);
	}
	
break;
case "leaf":

	$sImageDir = $sBasePath.$sTypeSub."_files/images/";
	
	if ($iGroupLevel == 0) $iGroupLevel = "%";
	
	// --BEGIN Data Count
	if ($sTag != "%"){
		$sWhereClause1 = "sSiteType = '%s' AND sTags LIKE '%s' %s";
		$sWhereClause2 = "B.sSiteType = '%s' AND B.sTags LIKE '%s'";
		$sWhereClause3 .= "sFileType IN ('%s', '%s', '%s') AND sTags LIKE '%s'";
		
		$aOption1 = array("mystudyrecord_site", "site", $sTag);
		$aOption2 = array("mystudyrecord_suggested_site", "site", $sTag, "AND promoted = 1");
		$aOption3 = array("site", $sTag);
		$aOption4 = array("image", "image_ext", "image_embed", $sTag);
		$aOption5 = array("doc", "doc_ext", $sTag);
		$aOption6 = array("mystudyrecord_site", "animation", $sTag);
	}else{
		$sWhereClause1 = "group_level = '%s' AND sSiteType = '%s' %s";
		$sWhereClause2 = "B.group_level = %d AND B.sSiteType = '%s'";
		$sWhereClause3 .= "sFileType IN ('%s', '%s', '%s') AND iGroupLevel = %d";
		
		$aOption1 = array("mystudyrecord_site", $iGroupLevel, "site", "");
		$aOption2 = array("mystudyrecord_suggested_site", $iGroupLevel, "site", "AND promoted = 1");
		$aOption3 = array($iGroupLevel, "site");
		$aOption4 = array("image", "image_ext", "image_embed", $iGroupLevel);
		$aOption5 = array("doc", "doc_ext", "doc_embed", $iGroupLevel);
		$aOption6 = array("mystudyrecord_site", $iGroupLevel, "animation");
	}
	
	$sqlSite = "SELECT COUNT(id) AS iSiteCount
				FROM %s
				WHERE ".$sWhereClause1. $sAgeWhereClause;
	$sqlFave = "SELECT COUNT(A.id) AS iFaveSiteCount
				FROM mystudyrecord_favorite A
				LEFT JOIN mystudyrecord_site B ON B.id = A.iRefId
				LEFT JOIN mystudyrecord_suggested_site C ON C.id = A.iRefId
				WHERE ".$sWhereClause2. str_replace("sAgeGroup","B.sAgeGroup",$sAgeWhereClause);
	$sqlFile = "SELECT COUNT(id) AS iFileCount
				FROM mystudyrecord_file
				WHERE ".$sWhereClause3. $sAgeWhereClause;
	
	$iSiteRecCount = db_result(db_query($sqlSite, $aOption1));
	$iSiteOtherCount = db_result(db_query($sqlSite, $aOption2));
	$iSiteFaveCount = db_result(db_query($sqlFave, $aOption3));
	$iPhotoCount = db_result(db_query($sqlFile, $aOption4));
	$iDocCount = db_result(db_query($sqlFile, $aOption5));
	$iAnimeCount = db_result(db_query($sqlSite, $aOption6));
	
	$iWebSiteCount = $iSiteRecCount + $iSiteOtherCount;
	// --END Data Count
	
	$sSiteIcon = $sImageDir."featured.png";
	$sPhotoIcon = $sImageDir."featured_f2.png";
	$sBookIcon = $sImageDir."featured_f3.png";
	$sVideoIcon = $sImageDir."featured_f4.png";
	$sAnimeIcon = $sImageDir."featured_f5.png";
	$sNewsIcon = $sImageDir."featured_f6.png";
	$sGamesIcon = $sImageDir."featured_f7.png";

	$sWebSite = '<item>
					<uid>1</uid>
					<name><![CDATA[<font color="#000000">Web Sites ('.$iWebSiteCount.')</font>]]></name>
					<thumb>'.$sSiteIcon.'</thumb>
					<description><![CDATA[Web Sites Description]]></description>
					<group_id>'.$iGroupLevel.'</group_id>
					<link>empty.html</link>
				</item>';
	
	$sPhotos = '<item>
					<uid>2</uid>
					<name><![CDATA[Photos ('.$iPhotoCount.')]]></name>
					<thumb>'.$sPhotoIcon.'</thumb>
					<description><![CDATA[Photos Description]]></description>
					<group_id>'.$iGroupLevel.'</group_id>
					<link>empty.html</link>
				</item>';
				
	$sDocs = '<item>
					<uid>3</uid>
					<name><![CDATA[Books and Reports ('.$iDocCount.')]]></name>
					<thumb>'.$sBookIcon.'</thumb>
					<description><![CDATA[Books and Reports Description]]></description>
					<group_id>'.$iGroupLevel.'</group_id>
					<link>empty.html</link>
				</item>';
	
	$sAnime = '<item>
					<uid>5</uid>
					<name><![CDATA[Animations ('.$iAnimeCount.')]]></name>
					<thumb>'.$sAnimeIcon.'</thumb>
					<description><![CDATA[Animations Description]]></description>
					<group_id>'.$iGroupLevel.'</group_id>
					<link>empty.html</link>
				</item>';
	
	$sVideos .= '<item>
					<uid>4</uid>
					<name><![CDATA[Videos]]></name>
					<thumb>'.$sVideoIcon.'</thumb>
					<description><![CDATA[Videos Description]]></description>
					<group_id>'.$iGroupLevel.'</group_id>
					<link>empty.html</link>
				</item>';
	
	$sNews = '<item>
					<uid>6</uid>
					<name><![CDATA[News]]></name>
					<thumb>'.$sNewsIcon.'</thumb>
					<description><![CDATA[News Description]]></description>
					<group_id>'.$iGroupLevel.'</group_id>
					<link>empty.html</link>
				</item>';
	
	if ($sTag != "%"){
		$sOutput .= ($iWebSiteCount > 0) ? $sWebSite:"";
		$sOutput .= ($iPhotoCount > 0) ? $sPhotos:"";
		$sOutput .= ($iDocCount > 0) ? $sDocs:"";
		$sOutput .= $sVideos;
		$sOutput .= ($iAnimeCount > 0) ? $sAnime:"";
		$sOutput .= $sNews;
		$sOutput .= $sGames;
	}else{
		$sOutput .= $sWebSite.$sPhotos.$sDocs.$sVideos.$sAnime.$sNews.$sGames;
	} 
	
break;
default:

	$sqlCat = "SELECT A.id, A.group_level, A.title, A.leaf, A.icon, 
					IF(A.desc IS NULL, 'No description available.', A.desc) AS sDescription 
				FROM {mystudyrecord} A
				WHERE A.group_level = %d 
					AND A.id != 6
				ORDER BY A.id";

	$oCatResult = db_query($sqlCat, $iGroupLevel);

	while ($oCat = db_fetch_object($oCatResult)){
		$iCatCount++;
		$sTitle = $oCat->title;
		$sDesc = mb_convert_encoding($oCat->sDescription, "UTF-8", "UTF-8");
		
		$sOutput .= '<item>
						<uid>'.$oCat->id.'</uid>
						<name><![CDATA['.$sTitle.']]></name>
						<path>'.$sBasePath.'values/image/main/'.$oCat->id.'</path>
						<description><![CDATA[<font size="15"><b>'.$sTitle.'</b></font><br/><br/><font size="12">'.$oCat->sDescription.'</font>]]></description>
						<leaf>'.$oCat->leaf.'</leaf>
						<link></link>
						<target></target>
					</item>';
	}
}

header("Content-Type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?><items>".$sOutput."</items>";


# --BEGIN Private Functions and Classes
function GetKeywords($iGroupLevel){
	$sKeywords = "";
	$sqlQuery = "SELECT id, group_level, title
				FROM mystudyrecord
				WHERE id = %d";
	
	$oQueryResult = db_query($sqlQuery, $iGroupLevel);
	$oQuery = db_fetch_object($oQueryResult);
	
	do {
		$iGroupLevel = $oQuery->group_level;
		$sKeywords .= " ".$oQuery->title;
		
		$oQueryResult = db_query($sqlQuery, $iGroupLevel);
		$oQuery = db_fetch_object($oQueryResult);
	} while ($iGroupLevel > 0);
	
	return urlencode(trim(str_replace(array("&", "and"), array("", ""), $sKeywords)));
}

function GetAttribute($sAttr, $sTag){
	//get attribute from html tag
	$sRegEx = '/'.preg_quote($sAttr).'=([\'"])?((?(1).+?|[^\s>]+))(?(1)\1)/is';
	
	if (preg_match($sRegEx, $sTag, $aMatch)) return urldecode($aMatch[2]);
	
	return false;
}

function ReplaceAttr($sAttr, $sReplacement, $sSource){
	$sRegEx = '/'.preg_quote($sAttr).'=([\'"])?((?(1).+?|[^\s>]+))(?(1)\1)/is';
	$sSourceOrig = $sSource;
	$sSource = preg_replace($sRegEx, $sReplacement, $sSource);
	
	if ($sSourceOrig == $sSource && $sAttr == "width") $sSource = str_replace("<img ", '<img width="250"', $sSource);
	
	return $sSource;
}

function GetXML($sQuery, $iMaxResult){
	$sXML = "http://gdata.youtube.com/feeds/api/videos?q=".urlencode($sQuery)."&start-index=1&max-results=".$iMaxResult."&v=2";
	
	# Initialize cURL
	$oCURL = curl_init();
	curl_setopt($oCURL, CURLOPT_URL, $sXML);
	
	# Setting CURLOPT_RETURNTRANSFER variable to 1 will force cURL not to print out the results of 
	# its query. Instead, it will return the results as a string return value from curl_exec() 
	# instead of the usual true/false.
	curl_setopt($oCURL, CURLOPT_RETURNTRANSFER, 1);
	
	return curl_exec($oCURL);
}

class XML2Array{
	var $_aOutput = array();
	var $_oParser;
	var $_sXMLData;
	
	function ParseXML($sInputXML) {
		$this->_oParser = xml_parser_create();
		
		xml_set_object($this->_oParser, $this);
		xml_set_element_handler($this->_oParser, "tagOpen", "tagClosed");
		
		xml_set_character_data_handler($this->_oParser, "tagData");
		
		$this->_sXMLData = xml_parse($this->_oParser, $sInputXML);
		
		if (!$this->_sXMLData) {
			die(sprintf("XML error: %s at line %d",
			xml_error_string(xml_get_error_code($this->_oParser)),
			xml_get_current_line_number($this->_oParser)));
		}
		  
		xml_parser_free($this->_oParser);
		
		return $this->_aOutput;
	}
   
	function tagOpen($parser, $name, $attrs) {
		$tag = array("name"=>$name, "attrs"=>$attrs);
		array_push($this->_aOutput, $tag);
	}
  
	function tagData($parser, $tagData) {
		if (trim($tagData)) {
			if (isset($this->_aOutput[count($this->_aOutput)-1]['tagData'])) {
				$this->_aOutput[count($this->_aOutput)-1]['tagData'] .= $tagData;
			}else{
				$this->_aOutput[count($this->_aOutput)-1]['tagData'] = $tagData;
			}
		}
	}
  
	function tagClosed($parser, $name) {
		$this->_aOutput[count($this->_aOutput)-2]['children'][] = $this->_aOutput[count($this->_aOutput)-1];
		array_pop($this->_aOutput);
	}
}
# --END Private Functions and Classes