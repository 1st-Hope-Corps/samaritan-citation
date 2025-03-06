<?php
/**
 * UNDER CONST
 * fetches data from DB to be written to xml file to be used by carousel
 * the xml file is generated separately , i.e. carousel_category.xml (filename not yet final)
 * @author marvin lorica
 */
 
require_once "./includes/bootstrap.inc";
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);



$sWhereClause .= "sFileType IN ('%s', '%s', '%s') AND sTags LIKE '%s'";

$sWhereClause .= "sFileType IN ('%s', '%s', '%s') AND iGroupLevel = %d";

$sqlFile = "SELECT id, sFileType, sFileId, iGroupLevel, sEmbedCode, 
		IF(sTitle != '', sTitle, 'No Title Specified') AS title, sDesc AS description
		FROM mystudyrecord_file $sWhereClause " .
		" ";
		
$aItems = db_result(db_query($sqlFile));




exit;

require 'ArrayToXml.php';
$oXml = new ArrayToXml('items');
$oXml->createNode($aItems);
$sXml = $oXml; // called implicitly __toString();


header("Content-Type: text/xml");			
echo $sXml;
exit;


