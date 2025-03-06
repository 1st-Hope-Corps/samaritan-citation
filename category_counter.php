<?php

set_time_limit(0);

require_once "./includes/bootstrap.inc";
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);


$result = db_query("SELECT id,group_level,leaf FROM mystudyrecord");
while($row = db_fetch_object($result)) {
	$aCategs[$row->id] = array(
							'group' => $row->group_level,
							'children' => array(),
							'leaf' => $row->leaf,
							'site' => 0,
							'animation' => 0,
							'doc' => 0,
							'image' => 0,
							'video' => 0,
							'color' => 0,
						);
}
mysql_free_result($result);

foreach ($aCategs as $id => $aCateg) {
	if ($aCateg["leaf"] == "1")
		traverseParents($aCateg["group"],$id);
}


function traverseParents($iParent,$iLeaf) {
	global $aCategs;
	
	if (isset($aCategs[$iParent])) {
		$aCategs[$iParent]["children"][] = $iLeaf;
		if ($aCategs[$iParent]["group"] != "0")
			traverseParents($aCategs[$iParent]["group"],$iLeaf);
	}
}


$result = db_query("SELECT sSiteType AS type,group_level FROM mystudyrecord_site UNION
					SELECT sFileType AS type,iGroupLevel AS group_level FROM mystudyrecord_file UNION
					SELECT sSiteType AS type,group_level FROM mystudyrecord_suggested_site WHERE IFNULL(iAdminId,0) <> 0 UNION
					SELECT sFileType AS type,iGroupLevel AS group_level FROM mystudyrecord_suggested_file WHERE IFNULL(iAdminId,0) <> 0");
while($row = db_fetch_object($result)) {
	$type = $row->type;
	if (in_array($row->type,array("doc_embed","doc_ext")))
		$type = "doc";
	else if (in_array($row->type,array("image_embed","image_ext")))
		$type = "image";
	else if (in_array($row->type,array("video_embed","video_ext","video_youtube")))
		$type = "video";
	
	populateCateg($type,$row->group_level);
}

function populateCateg($sType,$iCategId) {
	global $aCategs;
	
	if (!isset($aCategs[$iCategId]))
		return;

	$aCategs[$iCategId][$sType] ++;
	if ($aCategs[$iCategId]["leaf"] == "1") {
		if ($aCategs[$iCategId]["site"] == 0 ||
			$aCategs[$iCategId]["animation"] == 0 ||
			$aCategs[$iCategId]["doc"] == 0 ||
			$aCategs[$iCategId]["image"] == 0 ||
			$aCategs[$iCategId]["video"] == 0) {
				$aCategs[$iCategId]["color"] = 0;
		} else if (($aCategs[$iCategId]["site"] > 0 && $aCategs[$iCategId]["site"] < 5) ||
			($aCategs[$iCategId]["animation"] > 0 && $aCategs[$iCategId]["animation"] < 5) ||
			($aCategs[$iCategId]["doc"] > 0 && $aCategs[$iCategId]["doc"] < 5) ||
			($aCategs[$iCategId]["image"] > 0 && $aCategs[$iCategId]["image"] < 5) ||
			($aCategs[$iCategId]["video"] > 0 && $aCategs[$iCategId]["video"] < 5)) {
				$aCategs[$iCategId]["color"] = 1;
		} else {
				$aCategs[$iCategId]["color"] = 2;
		}
	} else {
		$iDefaultColor = 2; 
		if ($aCategs[$iCategId]["color"] < $iDefaultColor) {
			if (is_array($aCategs[$iCategId]["children"])) {
				foreach ($aCategs[$iCategId]["children"] as $iChild) {
					if ($iDefaultColor > $aCategs[$iChild]["color"])
						$iDefaultColor = $aCategs[$iChild]["color"];
					if ($iDefaultColor == 0)
						break;
				}
			}
		}
	}
	
	if ($aCategs[$iCategId]["group"] != "0")
		populateCateg($sType,$aCategs[$iCategId]["group"]);
}

echo "<pre>";
print_r($aCategs); 
echo "</pre>";
die;