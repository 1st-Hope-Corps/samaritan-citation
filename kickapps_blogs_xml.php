<?php
require_once './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
header("Content-Type: application/rss+xml; charset=ISO-8859-1");
$user = $_GET['username'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://serve.a-feed.com/service/displayFullRss.kickAction?username='.$user.'&quantity=25&type=US&mediaType=BLOG&as=158175');
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$xml = curl_exec($ch);
curl_close($ch);

$str =  str_replace('html','html?css=kickapps_theme2010',$xml);

$pos = strpos($str, '<item>');
if($pos == null){
$rss = '<?xml version="1.0" encoding="UTF-8"?>
<rss xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:geo="http://www.w3.org/2003/01/geo/wgs84_pos#" xmlns:georss="http://www.georss.org/georss/" xmlns:ka="http://kickapps.com/karss" xmlns:opensearch="http://a9.com/-/spec/opensearch/1.1/" xmlns:media="http://search.yahoo.com/mrss/" xmlns:g-core="http://base.google.com/ns/1.0" xmlns:cc="http://web.resource.org/cc/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:cf="http://www.microsoft.com/schemas/rss/core/2005" xmlns:taxo="http://purl.org/rss/1.0/modules/taxonomy/" xmlns:creativeCommons="http://backend.userland.com/creativeCommonsRssModule" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:g-custom="http://base.google.com/cns/1.0" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:apple-wallpapers="http://www.apple.com/ilife/wallpapers" xmlns:gm="http://www.google.com/schemas/gm/1.1" xmlns:slash="http://purl.org/rss/1.0/modules/slash/" version="2.0">
  <channel>
    <title>New blogs from '.$user.' on 1sthopecorps</title>
    <link></link>
    <description>New blogs from '.$user.' on 1sthopecorps</description>
    <pubDate></pubDate>
    <lastBuildDate></lastBuildDate>
    <managingEditor>f.lewis@hopecybrary.org (fred_hope)</managingEditor>
    <webMaster>f.lewis@hopecybrary.org (fred_hope)</webMaster>
    <generator>KickApps Feed Builder</generator>
    <dc:date></dc:date>
    <ka:totalItems>2</ka:totalItems>
    <ka:moreResults></ka:moreResults>
    <ka:feedId>0</ka:feedId>
    <item>
      <title>No blogs created.</title>
      <link><![CDATA[&nbsp;]]></link>
      <description><![CDATA[&nbsp;]]></description>
    </item>
  </channel>
</rss>';
echo $rss;
} else{
echo $str;
}

?>