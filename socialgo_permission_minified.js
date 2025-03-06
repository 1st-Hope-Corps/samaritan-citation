/*
 * @author Maris Reyes <kakaiba at gmail dot com>
 * @version 0.8
 * @package SocialGO Profile Permission
 * Description: A minified JavaScript implementation based on Drupal's permissions
 */

/*
 * BEGIN Reusable functions
 */
function GetQS(sKeyVar,sDefaultVal){if(sDefaultVal==null)sDefaultVal="";sKeyVar=sKeyVar.replace(/[[]/,"[").replace(/[]]/,"]");var regex=new RegExp("[?&]"+sKeyVar+"=([^&#]*)");var oQS=regex.exec(window.location.href);return(oQS==null)?sDefaultVal:oQS[1]}function GetElementByClass(sClassName,sTagName){if(sTagName!=""||sTagName==null)sTagName="*";var aElements=new Array;var sTags=document.getElementsByTagName(sTagName);var sPattern=new RegExp("(^|s)"+sClassName+"(s|$)");for(i=0,j=0;i<sTags.length;i++){if(sPattern.test(sTags[i].className))aElements[j++]=sTags[i]}return aElements}function HideThis(aInputId){for(i=0;i<aInputId.length;i++){var oHide=document.getElementById(aInputId[i]);if(oHide)oHide.style.display="none"}}function FixLinks(sKey,sVal){for(i=0;i<document.links.length;i++){oThis=document.links[i];var oRegEx1=new RegExp("[?]");var oSeparator=oRegEx1.exec(oThis.href);var sSeparator=(oSeparator==null)?"?":"&";if(oThis.href.indexOf(sKey+"=")<=0&&oThis.href.indexOf(";")<=0)oThis.href+=sSeparator+sKey+"="+sVal}}function IsChild(){var oAge=GetElementByClass("bday dob","div");if(oAge[0]){var sRawAge=oAge[0].innerHTML;var iAge=parseInt(sRawAge.substring(0,sRawAge.indexOf("year")));return(iAge<15)?true:false}return false}
/*
 * END Reusable functions
 */

/*
 * BEGIN Logic flow
 */
var iRoleId=GetQS("i",0);iRoleId=parseInt(iRoleId);var sURL=top.location.href;var aURL=sURL.split("/");var aInitHide=Array("sb-manage-account","sb-admin-panel","sb-invite-contacts","sb-current-status","sb-inbox","sb-moderate","sb-add-new","sb-friends-online","sb-upcoming-events");if(aURL[4]!="advanced-search"||aURL[4].substring(0,15)!="advanced-search"){if(iRoleId==0){location="http://www.hopecybrary.org/gateway.php?q="+top.location.href}else{FixLinks("i",iRoleId);if(iRoleId==0||iRoleId==1||iRoleId==10)HideThis(aInitHide);switch(aURL[3]){case"members":if(aURL[4]=="profile"){switch(iRoleId){case 0:case 1:case 10:var aHideThese=Array("profile-interact","profile-stories","profile-friends-list","profile-wall","profile-groups-list","profile-events-list","profile-tags","profile-mp3");break;case 2:var oSendMsg=GetElementByClass("buttons interact-send_message","li");var oAddFriend=GetElementByClass("buttons interact-add_to_friends","li");if(oSendMsg[0])oSendMsg[0].style.display="none";if(oAddFriend[0])oAddFriend[0].style.display="none";var aHideThese=Array("profile-stories","profile-friends-list","profile-groups-list","profile-events-list","profile-tags","profile-mp3");break;case 4:case 6:case 7:break;case 8:break;case 9:break}if(IsChild())HideThis(aHideThese)}break}}}else{if(iRoleId==0||iRoleId==1||iRoleId==10)HideThis(aInitHide)}
/*
 * END Logic flow
 */