<?php
require_once './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);


ksort($user->roles);

foreach ($user->roles as $iRoleId => $sRoleName){
	$iThisRoleId = $iRoleId;
}

/* echo "<pre>";
print_r($user);
echo "</pre>";
exit; */

$iNow = time();
$aChildren = array();
$aOnlineChildren = array();
$iOnlineChildren = 0;
$iInterval = $iNow - variable_get('user_block_seconds_online', 900);

$oUsers = db_query("SELECT A.uid, B.value FROM {users} A INNER JOIN {profile_values} B ON B.uid = A.uid WHERE A.uid > 1 AND A. status = 1 AND B.fid = 5");
$oOnlineUsers = db_query('SELECT DISTINCT u.uid, u.name, u.mail, u.picture, s.timestamp FROM {users} u INNER JOIN {sessions} s ON u.uid = s.uid WHERE s.timestamp >= %d AND s.uid > 0 ORDER BY s.timestamp DESC', $iInterval);

while ($oUser = db_fetch_object($oUsers)){
	$aDOB = unserialize($oUser->value);
	$iDOB = mktime(0, 0, 0, $aDOB["month"], $aDOB["day"], $aDOB["year"]);
	$iYear = floor(($iNow  - $iDOB) / (60*60*24*365));
	
	if ($iYear <= 12) $aChildren[] = $oUser->uid;
}

while ($oOnlineUser = db_fetch_object($oOnlineUsers)){
	if (in_array($oOnlineUser->uid, $aChildren)){
		$aOnlineChildren[] = $oOnlineUser;
		$iOnlineChildren++;
	}
}


if ($iOnlineChildren == 0) exit('<div align="center" style="font-family:verdana; font-size:0.9em;">No online children.</div>');


$sScript = "var aChildren = new Array();\n";

for ($i=0; $i<count($aOnlineChildren); $i++){
	$oSocialGO = _socialgo_post("user/get", "id=".urlencode($aOnlineChildren[$i]->mail)."&fields=All");
	
	$sScript .= "aChildren[".$i."] = Array(".$aOnlineChildren[$i]->uid.", '".$aOnlineChildren[$i]->name."', '".$aOnlineChildren[$i]->picture."', '".$oSocialGO->result->id."?i=".$iThisRoleId."');\n";
}

$sOutput = '<script type="text/javascript">
			'.$sScript.'
			var iCurrIndex = 0;
			var iOnlineChildren = '.$iOnlineChildren.';
			
			function incybrary_ListChildren(){
				var oDivList = document.getElementById("incybrary_children");
				var sChildren = "";
				var iCurrLoop = 1;
				
				for (i=iCurrIndex; i<aChildren.length && iCurrLoop <=4; i++){
					sChildren += "<div style=\"margin-bottom:5px; font-size:0.8em;\" onmouseover=\"this.style.cursor=\'pointer\'; this.style.textDecoration=\'underline\';\" onmouseout=\"this.style.textDecoration=\'none\';\" onclick=\"incybrary_ShowPhoto(\'"+aChildren[i][2]+"\', \'"+aChildren[i][3]+"\');\">"+aChildren[i][1]+"</div>";
					iCurrLoop++;
				}
				
				oDivList.innerHTML = sChildren;
			}
			
			function incybrary_ShowPhoto(sInputURL, sInputId){
				if (sInputURL != ""){
					var oPhoto = document.getElementById("incybrary_photo");
					oPhoto.src = "http://drupal.firsthopecorps.org/"+sInputURL;
					
					var oLink = document.getElementById("incybrary_link");
					oLink.href = "http://mygizmoz.socialgo.com/members/profile/"+sInputId;
				}
			}
			
			function incybrary_NavNext(){
				iCurrIndex += 4;
				
				incybrary_ListChildren();
				incybrary_ShowPhoto(aChildren[iCurrIndex][2], aChildren[iCurrIndex][3]);
				incybrary_ShowNav();
			}
			
			function incybrary_NavPrev(){
				iCurrIndex -= 4;
				
				incybrary_ListChildren();
				incybrary_ShowPhoto(aChildren[iCurrIndex][2], aChildren[iCurrIndex][3]);
				incybrary_ShowNav();
			}
			
			function incybrary_ShowNav(){
				if ((iOnlineChildren/4) > 1){
					var sNext = ((iCurrIndex+4) < iOnlineChildren) ? " <a href=\"javascript:incybrary_NavNext();\">Next</a>":"";
					var sPrev = ((iCurrIndex-4) > 0) ? "<a href=\"javascript:incybrary_NavPrev();\">Prev</a> ":"";
					
					var iStartRec = iCurrIndex + 1;
					var iEndRec = ((iStartRec + 3) > iOnlineChildren) ? iOnlineChildren:iStartRec + 3;
					
					var oNav = document.getElementById("incybrary_nav");
					oNav.innerHTML = sPrev+iStartRec+" - "+iEndRec+" of "+iOnlineChildren+sNext;
				}else{
					Toggle("incybrary_nav", false);
				}
			}
			
			function Toggle(sDivID, bBool){
				var oDiv = document.getElementById(sDivID);
				oDiv.style.display = (bBool) ? "block":"none";
			}
			
			window.onload = function (){
				incybrary_ListChildren();
				incybrary_ShowPhoto(aChildren[iCurrIndex][2], aChildren[iCurrIndex][3]);
				incybrary_ShowNav();
			}
			</script>
			
			<table celpadding="0" cellspacing="0" style="width:100%; border:0; background-color:transparent; font-family:arial; font-size:0.9em;">
				<tr>
					<td id="incybrary_children" style="border:0; vertical-align:top;"></td>
					<td style="border:0;"><a id="incybrary_link" href=""><img id="incybrary_photo" src="" target="_new" align="right" style="width:75px; border:0;" /></a></td>
				</tr>
				<tr>
					<td id="incybrary_nav" colspan="2" style="border:0; text-align:center; font-size:0.8em;"></td>
				</tr>
			</table>';

echo $sOutput;