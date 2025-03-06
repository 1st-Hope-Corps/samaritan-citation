<?php
require_once "./includes/bootstrap.inc";
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);


$iGroupLevel = (isset($_REQUEST["i"]) && $_REQUEST["i"] != "") ? $_REQUEST["i"]:0;
$sType = (isset($_REQUEST["q"]) && $_REQUEST["q"] != "") ? $_REQUEST["q"]:"";
$sTypeSub = (isset($_REQUEST["qq"]) && $_REQUEST["qq"] != "") ? $_REQUEST["qq"]:"";
$sTypeSubSub = (isset($_REQUEST["qqq"]) && $_REQUEST["qqq"] != "") ? $_REQUEST["qqq"]:"";

$iCatCount = 0;
$sOutput = "";
$sBasePath = base_path();
$sImageDomain = 'http://www.shrinktheweb.com/xino.php?embed=1&stwaccesskeyid=5918cb01a07b335';
$sImageURL = $sImageDomain.'&xmax=512&ymax=384&inside=1&stwUrl=';

if ($sType == "links"){
	if ($sTypeSubSub == "fave"){
		$sqlLinks = "(SELECT A.iVisitCount AS iVisitCount, B.id, B.group_level, B.title, B.url, B.description
						FROM mystudyrecord_favorite A
						INNER JOIN mystudyrecord_site B ON B.id = A.iRefId
						WHERE B.group_level = %d
							AND B.sSiteType = '%s')
						UNION
						(SELECT C.iVisitCount AS iVisitCount, D.id, D.group_level, D.title, D.url, D.description
						FROM mystudyrecord_favorite C
						INNER JOIN mystudyrecord_suggested_site D ON D.id = C.iRefId
						WHERE D.promoted = 1
							AND D.group_level = %d
							AND D.sSiteType = '%s')
						ORDER BY iVisitCount DESC
						LIMIT 3";
		
		$aOptions = array($iGroupLevel, $sTypeSub, $iGroupLevel, $sTypeSub);
	}elseif ($sTypeSubSub == "other"){
		$sqlLinks = "SELECT id, title, url, description 
					FROM {mystudyrecord_suggested_site}
					WHERE group_level = %d
						AND promoted = 1
						AND sSiteType = '%s'
					ORDER BY id ASC";
		$aOptions = array($iGroupLevel, $sTypeSub);
	}else{
		$sqlLinks = "SELECT * 
					FROM {mystudyrecord_site} 
					WHERE group_level = %d 
						AND sSiteType = '%s' 
					ORDER BY id ASC";
		$aOptions = array($iGroupLevel, $sTypeSub);
	}
	
	$oLinksResult = db_query($sqlLinks, $aOptions);
	
	while ($oLinks = db_fetch_object($oLinksResult)){
		$sTitle = $oLinks->title;
		$sDesc = mb_convert_encoding($oLinks->description, "UTF-8", "UTF-8");
		
		$sOutput .= '<item>
						<uid>'.$oLinks->id.'</uid>
						<file>link</file>
						<name><![CDATA['.$sTitle.']]></name>
						<thumb><![CDATA['.$sImageURL.$oLinks->url.']]></thumb>
						<description><![CDATA[<font size="15"><b>'.$sTitle.'</b></font><br/><br/>'.$sDesc.']]></description>
						<group_id>'.$iGroupLevel.'</group_id>
						<link>'.$oLinks->url.'</link>
						<target>_blank</target>
					</item>';
	}
	mysqli_close();
	mysqli_free_result($oLinksResult);
}elseif ($sType == "files"){
	if ($sTypeSub == "video"){
		$oXML = new XML2Array();
		$sKeywords = GetKeywords($iGroupLevel);
		$aOutputXML = $oXML->ParseXML(GetXML($sKeywords, 8));
		
		$aXML = $aOutputXML[0]["children"];
		$aResult = array();

		for ($i=0; $i<count($aXML); $i++){
			$aEntry = $aXML[$i];
			
			if ($aEntry["name"] == "ENTRY") $aResult[] = $aEntry["children"];
		}
		
		for ($x=0; $x<count($aResult); $x++){
			$aVideos = $aResult[$x];
			
			for ($y=0; $y<count($aVideos); $y++){
				$aVideoDetail = $aVideos[$y];
				
				if ($aVideoDetail["name"] == "MEDIA:GROUP"){
					$aVideoEntry = $aVideoDetail["children"];
					$iMediaCount = 0;
					$iThumbCount = 0;
					
					for ($z=0; $z<count($aVideoEntry); $z++){
						$aVideo = $aVideoEntry[$z];
						
						if ($aVideo["name"] == "MEDIA:CONTENT"){
							$iMediaCount++;
							if ($iMediaCount == 1) $sVideoLink = $aVideo["attrs"]["URL"];
						}
						if ($aVideo["name"] == "MEDIA:DESCRIPTION") $sVideoDesc = $aVideo["tagData"];
						if ($aVideo["name"] == "MEDIA:THUMBNAIL"){
							$iThumbCount++;
							if ($iThumbCount == 5) $sVideoThumbnail = $aVideo["attrs"]["URL"];
						}
						if ($aVideo["name"] == "MEDIA:TITLE") $sVideoTitle = $aVideo["tagData"];
						if ($aVideo["name"] == "YT:VIDEOID") $sVideoId = $aVideo["tagData"];
					}
				}
			}
			
			$sOutput .= '<item>
							<uid>'.$sVideoId.'</uid>
							<file>video</file>
							<name><![CDATA['.$sVideoTitle.']]></name>
							<thumb>'.$sVideoThumbnail.'</thumb>
							<description><![CDATA[<font size="15"><b>'.$sVideoTitle.'</b></font><br/><br/>'.$sVideoDesc.']]></description>
							<group_id>'.$iGroupLevel.'</group_id>
							<link>'.$sVideoLink.'</link>
							<target>_blank</target>
						</item>';
		}
		mysqli_close();
	}else{
		$sqlFiles = "SELECT id, sFileType, sFileId, sEmbedCode, iGroupLevel, 
						IF(sTitle != '', sTitle, 'No Title Specified') AS sTitle, sDesc
					FROM mystudyrecord_file
					WHERE sFileType IN ('%s', '%s')
						AND iGroupLevel = %d";
		
		//$oFilesResult = db_query($sqlFiles, array($sTypeSub, $sTypeSub."_embed", $sTypeSub."_ext", $iGroupLevel));
		$oFilesResult = db_query($sqlFiles, array($sTypeSub, $sTypeSub."_ext", $iGroupLevel));
		
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
						$sFileFull = $sBasePath."mystudies/file/image/".$iGroupLevel."/view/".$sId;
					}elseif ($sFileType == "image_embed"){
						$sFileURL = $oFiles->sEmbedCode;
						$sFileFull = "";
					}else{
						$sFileURL = $sImageURL.$oFiles->sEmbedCode;
						$sFileFull = $oFiles->sEmbedCode;
					}
					
					break;
				
				case "doc":
					if ($sFileType == $sTypeSub){
						$sFileURL = $sBasePath.'misc/file_doc.png';
						$sFileFull = $sBasePath."mystudies/file/doc/".$iGroupLevel."/view/".$sId;
					}elseif ($sFileType == "doc_embed"){
						$sFileURL = $sBasePath.'misc/file_doc.png';
						$sFileFull = "";
					}else{
						$sFileURL = $sImageURL.$oFiles->sEmbedCode;
						$sFileFull = $oFiles->sEmbedCode;
					}
					
					break;
				
				case "video":
					
					break;	
			}
			
			$sOutput .= '<item>
							<uid>'.$sId.'</uid>
							<file>'.$sTypeSub.'</file>
							<name><![CDATA['.$sFileTitle.']]></name>
							<thumb>'.$sFileURL.'</thumb>
							<description><![CDATA[<font size="15"><b>'.$sFileTitle.'</b></font><br/><br/>'.$sFileDesc.']]></description>
							<group_id>'.$iGroupLevel.'</group_id>
							<link>'.$sFileFull.'</link>
							<target>_blank</target>
						</item>';
		}
		mysqli_free_result($oFilesResult);
	    mysqli_close();
	}
}elseif ($sType == "leaf"){
	$sImageDir = $sTypeSub."_files/images/";
	
	$sSiteIcon = ($sTypeSub == "hud") ? $sImageDir."featured.png":$sImageDir."nav_panel_2_icon_1.jpg";
	$sPhotoIcon = ($sTypeSub == "hud") ? $sImageDir."featured_f2.png":$sImageDir."nav_panel_2_icon_2.jpg";
	$sBookIcon = ($sTypeSub == "hud") ? $sImageDir."featured_f3.png":$sImageDir."nav_panel_2_icon_4.jpg";
	$sVideoIcon = ($sTypeSub == "hud") ? $sImageDir."featured_f4.png":$sImageDir."nav_panel_2_icon_3.jpg";
	$sAnimeIcon = ($sTypeSub == "hud") ? $sImageDir."featured_f5.png":$sImageDir."nav_panel_2_icon_5.jpg";
	$sNewsIcon = ($sTypeSub == "hud") ? $sImageDir."featured_f6.png":"";
	
	$sOutput .= '<item>
					<uid>1</uid>
					<name><![CDATA[Web Sites]]></name>
					<thumb>'.$sSiteIcon.'</thumb>
					<description><![CDATA[Web Sites Description]]></description>
					<group_id>'.$iGroupLevel.'</group_id>
					<link>empty.html</link>
				</item>
				<item>
					<uid>2</uid>
					<name><![CDATA[Photos]]></name>
					<thumb>'.$sPhotoIcon.'</thumb>
					<description><![CDATA[Photos Description]]></description>
					<group_id>'.$iGroupLevel.'</group_id>
					<link>empty.html</link>
				</item>
				<item>
					<uid>3</uid>
					<name><![CDATA[Books and Reports]]></name>
					<thumb>'.$sBookIcon.'</thumb>
					<description><![CDATA[Books and Reports Description]]></description>
					<group_id>'.$iGroupLevel.'</group_id>
					<link>empty.html</link>
				</item>
				<item>
					<uid>4</uid>
					<name><![CDATA[Videos]]></name>
					<thumb>'.$sVideoIcon.'</thumb>
					<description><![CDATA[Videos Description]]></description>
					<group_id>'.$iGroupLevel.'</group_id>
					<link>empty.html</link>
				</item>
				<item>
					<uid>5</uid>
					<name><![CDATA[Animations]]></name>
					<thumb>'.$sAnimeIcon.'</thumb>
					<description><![CDATA[Animations Description]]></description>
					<group_id>'.$iGroupLevel.'</group_id>
					<link>empty.html</link>
				</item>';
	
	if ($sTypeSub == "hud"){
		$sOutput .= '<item>
						<uid>6</uid>
						<name><![CDATA[News]]></name>
						<thumb>'.$sNewsIcon.'</thumb>
						<description><![CDATA[News Description]]></description>
						<group_id>'.$iGroupLevel.'</group_id>
						<link>empty.html</link>
					</item>';
	}
	mysqli_close();
}elseif ($sType == ""){
	$sqlCat = "SELECT A.id, A.group_level, A.title, A.leaf, A.icon, 
					IF(A.desc IS NULL, 'No description available.', A.desc) AS sDescription 
				FROM {mystudyrecord} A
				WHERE A.group_level = %d 
				ORDER BY A.id";

	$oCatResult = db_query($sqlCat, $iGroupLevel);

	while ($oCat = db_fetch_object($oCatResult)){
		$iCatCount++;
		$sTitle = $oCat->title;
		$sDesc = mb_convert_encoding($oCat->sDescription, "UTF-8", "UTF-8");
		
		$sOutput .= '<item>
						<uid>'.$oCat->id.'</uid>
						<name><![CDATA['.$sTitle.']]></name>
						<path>'.$sBasePath.'mystudies/image/main/'.$oCat->id.'</path>
						<description><![CDATA[<font size="15"><b>'.$sTitle.'</b></font><br/><br/><font size="12">'.$oCat->sDescription.'</font>]]></description>
						<leaf>'.$oCat->leaf.'</leaf>
						<link></link>
						<target></target>
					</item>';
	}
	mysqli_free_result($oCatResult);
	mysqli_close();
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
	mysqli_free_result($oQueryResult);
	return trim($sKeywords);
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