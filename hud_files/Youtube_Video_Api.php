<?php
/**
 * wrapper class for Youtube GData API
 * @author Marvin Lorica
 * @version 0.1.0
 */
 error_reporting(E_ALL);
  session_start();

 $path = 'sites/all/modules/mystudies';
 set_include_path(get_include_path() . PATH_SEPARATOR . $path);
 require_once 'Zend/Loader.php';
 //require_once 'Zend/Uri/Http.php';
 Zend_Loader::loadClass('Zend_Gdata_YouTube');
 Zend_Loader::loadClass('Zend_Uri_Http');

 //?color1=0x2b405b&color2=0x6b8ab6&border=1&fs=1
 define('PLAYER_COLOR1', '0x234900');
 define('PLAYER_COLOR2', '0x4e9e00');
 define('PLAYER_BORDER', '1');
 
 class Youtube_Video_Api
 {
 	private $_api_key = 'AI39si4iE1Ej5YQHZF2V5cbDov8bMXnOQZP0HuYn6m-8l0lOixFWMwgFd_mS75WhL7dLZSQr9QhMttNytu9rJY1OmMoym8RUwQ';
 	private $_app_id = '';
 	private $_client_id = '';
 	
 	private $_yt;
 	private $_proto_ver = 2; // protocol version
 	private $_api_feed = 'http://gdata.youtube.com/feeds/api/';
 	
 	private $_oVideoEntry;
 	
 	
 	function __construct($api_key = null, $app_id = null, $client_id = null)
 	{
 		$this->_api_key = $api_key; 
 		$this->_app_id = $app_id;
 		$this->_client_id = $client_id;
 		
 		//$httpClient = $this->getAuthSubHttpClient();
 		
 		$this->_yt = new Zend_Gdata_YouTube();//$httpClient, $this->_app_id, $this->_client_id, $this->_api_key);	
 		$this->_yt->setMajorProtocolVersion($this->_proto_ver); 			
 	}
 	
 	/**
 	 * search video by specific string/term using category and keywords
 	 *
 	 * @param string $sCategory
 	 * @param mixed $mKeywords, can be array or string(with "," (comma))
 	 * @param int $iMaxResult
 	 * @param string $sSafeSearch
 	 * @return array
 	 */
 	public function search($sCategory, $mKeywords = '', $iMaxResult = 8, $sSafeSearch = 'strict')
 	{
 		try {
 			$oQuery = $this->_yt->newVideoQuery();
		  	$oQuery->setOrderBy('relevance');
		  	$oQuery->setSafeSearch($sSafeSearch);		  
			$oQuery->setMaxResults($iMaxResult);
			$oQuery->setStartIndex(1);
			
			//REGIONS-LAND+GEOGRAPHY+Social+Studies
			$sSearchTerm = urldecode($sCategory);	
				
			$aTemp = explode(" ", $sSearchTerm);
			$oQuery->setQuery($sSearchTerm);
			$sSearchTerm = ucfirst($aTemp[0]); // category needs to be Capital first letter			
			for($i=0; $i < sizeof($aTemp); $i++)
			{		
				$sSearchTerm .= '';				
				if($i > 0)
				{
					$sSearchTerm .= strtolower($aTemp[$i]);
				}	
				$sSearchTerm .= '/';				
			}							
				
			error_log('built search term : ' . $sSearchTerm);						
						
			//$sSearchTerm = 'Food/health'; // test
			//$oQuery->setCategory($sSearchTerm);
						
	  		$oVideoFeed = $this->_yt->getVideoFeed($oQuery);	 	
	 		$aVideoFeed = $this->getVideoFeed($oVideoFeed, false);
	 		
	  		return $aVideoFeed;
	 		
 		} catch (Exception $e)
 		{
 			echo $e->getMessage();
 		}
		
 	} 	
 	
 	/**
 	 * converts string to array
 	 */
 	private function _toArray($string, $sSeparator = ",")
 	{
 		if(!strstr($string, $sSeparator))
 		{
 			// we assume that the separator is space " " 			
 			$string = explode(" ", $string);
 			return $string;
 		}
 		else
 		{
 			$string = explode(",", $string);
 			return $string;
 		} 		
 	} 	
 	
 	function getVideoFeed($oVideoFeed, $bEscaped = false)
 	{ 		
 		$aVE = array();
	  	foreach ($oVideoFeed as $oVideoEntry)
	  	{
		    $oVE = $this->getVideoEntry($oVideoEntry, $bEscaped);		 
		   	$aVE[] = $oVE;		  
	  	}
	  	
	  	return $aVE;
 	}
 	
 	/**
 	 * gets video entry as array
 	 * @param object $oVideoEntry
 	 * @param bool $bEscaped (using CDATA)
 	 */
 	function getVideoEntry($oVideoEntry, $bEscaped = true)
 	{
 		
	  	$aVE = array();	  		
		$sYTUrl = 'http://www.youtube.com/v/';		 
		$sPlayerAttr = '&hl=en_US&fs=1&rel=0&color1='.PLAYER_COLOR1.'&color2='.PLAYER_COLOR2.'&border='.PLAYER_BORDER;
		$videoThumbnails 	= $oVideoEntry->getVideoThumbnails();
		$sThumb = $videoThumbnails[4]['url']; // we only get 1
		$aRating = $oVideoEntry->getVideoRatingInfo(); // array('average', 'numRaters');
	  	if(!$bEscaped)
	  	{
	  		$aVE['uid']			= $oVideoEntry->getVideoId();
	  		$aVE['file']	    = 'video';
  			$aVE['name'] 		= $oVideoEntry->getVideoTitle();
		  	$aVE['description'] = $oVideoEntry->getVideoDescription();
		  	$aVE['link'] 		= $sYTUrl . $oVideoEntry->getVideoId() . $sPlayerAttr;		  	
		  	$aVE['thumb'] 		= $sThumb;
		  	$aVE['rating']	  	= $aRating['average'];
		  	$ave['target']	    = '_blank';
	  	}
	  	else
	  	{	  	
	  		$aVE['uid']			= $oVideoEntry->getVideoId();
	  		$aVE['file']	    = '<![CDATA[video]]>';
  			$aVE['name'] 		= '<![CDATA['.$oVideoEntry->getVideoTitle().']]>';
		  	$aVE['description'] = '<![CDATA['.$oVideoEntry->getVideoDescription().']]>';
		  	$aVE['link'] 		= '<![CDATA['.$sYTUrl . $oVideoEntry->getVideoId() . $sPlayerAttr.']]>';		  	
		  	$aVE['thumb'] 		= '<![CDATA['.$sThumb.']]>';		  	
		  	$aVE['rating']	  	= '<![CDATA['.$aRating['average'].']]>';	
		  	$aVE['target']	    = '<![CDATA[_blank]]>';
	  	}
	  	//echo '<pre>';
 		//print_r($aVE);
 		//error_log('Link from YT API ' . $aVE['link']);
	  	return $aVE;
 	}
 	
 	
 } // end class
 