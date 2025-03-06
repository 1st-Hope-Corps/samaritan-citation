<?php
// DivShare API Client Library - PHP 4

class divshare_api {

	var $api_key;
	var $api_secret;
	var $api_session_key;
	var $api_address = 'http://www.divshare.com/api/';
	
	// Initialize with an API key
	function divshare_api($key=NULL, $secret=NULL, $session_key=NULL) {
		$this->api_key = $key;
		$this->api_secret = $secret;
		$this->api_session_key = $session_key;
	}
	
	function login($user_email, $user_password) {
		// Logs in, and sets the api_session_key for internal use.
	
		$result = $this->post_request('login', array('user_email'=>$user_email, 'user_password'=>$user_password));
		
		if ($result['response']['api_session_key']) {
			$this->api_session_key = $result['response']['api_session_key'];
			return $this->api_session_key;
		} else {
			$this->api_session_key = NULL;
			return false; // Login failed
			// For error description, echo $result['response']['error'];
		}
	}
	
	function get_user_info() {
		// Gets user e-mail and first name. May add more info to this response in the future.
	
		$result = $this->post_request('get_user_info');
		return $result;
	}
	
	function get_user_files($limit=NULL, $offset=NULL) {
		// Gets all the files assigned to the logged in user
		
		// $limit sets the max number of files returned
		// Use $offset for pagination -- for example, page 2 has an offset of 10 and a limit of 10
	
		$result = $this->post_request('get_user_files',array('limit'=>$limit,'offset'=>$offset));
		return $result;
	}
	
	function get_folder_files($folder_id, $limit=NULL, $offset=NULL) {
		// Gets all the files in a folder owned by the logged in user
		
		$result = $this->post_request('get_folder_files',array('folder_id'=>$folder_id,'limit'=>$limit,'offset'=>$offset));
		return $result;
	}
	
	function get_files($file_id_array) {
		// Gets a specific file or files. They do not have to be owned by the user, but they must be viewable by the user.
		// $file_id_array should be an array of one or more IDs, which look like "12345-abc"
		
		$file_string = implode(',', $file_id_array); // Change array to a comma-separated string
		$result = $this->post_request('get_files',array('files'=>$file_string));
		return $result;
	}
	
	function get_upload_ticket() {
		// Returns an upload ticket, which must then be inserted into the upload form.
	
		$result = $this->post_request('get_upload_ticket');
		return $result["response"]["upload_ticket"];
	}
	
	function logout() {
		// Returns logged_out = 1 on successs, and deletes the current session key
		$this->api_session_key = NULL;
		
		$result = $this->post_request('logout');
		return $result;
	}
	
	#
	#
	#
	
	function create_signature($params=NULL) {
		$sig_string = $this->api_secret . $this->api_session_key;
		
		if (is_array($params)) {
			ksort($params); // Alphabetize
			foreach ($params as $key=>$value) {
				$sig_string .= $key . $value;
			}
		}
		
		return md5($sig_string);
	}
	
	function post_request($method, $params=NULL) {
	
		$post_string = 'method=' . $method . '&api_key=' . $this->api_key;
		if ($this->api_session_key) {
			$post_string .= '&api_session_key=' . $this->api_session_key;
			$post_string .= '&api_sig=' . $this->create_signature($params);
		}
	
		// Params should be sent as an array
		if (is_array($params)) {
			foreach ($params as $key=>$value) {
				$post_string .= '&' . urlencode($key) . '=' . urlencode($value);
			}
		}
		
		//echo $post_string . '<p>';
		
		if (function_exists('curl_init')) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->api_address);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_USERAGENT, 'DivShare API Client ' . phpversion());
			$result = curl_exec($ch);
			curl_close($ch);
		} else {
			echo 'CURL is not installed.';
		}
		
		$xml_result = $this->xml2array($result);
		return $xml_result;
		
	}
	
	function xml2array($contents, $get_attributes=0) { // http://www.bin-co.com/php/scripts/xml2array/
		if(!$contents) return array();
	
		if(!function_exists('xml_parser_create')) {
			echo "'xml_parser_create()' function not found!";
			// return array();
		}
		
		//Get the XML parser of PHP - PHP must have this module for the parser to work
		$parser = xml_parser_create();
		xml_parser_set_option( $parser, XML_OPTION_CASE_FOLDING, 0 );
		xml_parser_set_option( $parser, XML_OPTION_SKIP_WHITE, 1 );
		xml_parse_into_struct( $parser, $contents, $xml_values );
		xml_parser_free( $parser );
	
		if(!$xml_values) return;
	
		//Initializations
		$xml_array = array();
		$parents = array();
		$opened_tags = array();
		$arr = array();
	
		$current = &$xml_array;
	
		//Go through the tags.
		foreach($xml_values as $data) {
			unset($attributes,$value);//Remove existing values, or there will be trouble
			extract($data);//We could use the array by itself, but this cooler.
	
			$result = '';
			if($get_attributes) {//The second argument of the function decides this.
				$result = array();
				if(isset($value)) $result['value'] = $value;
	
				//Set the attributes too.
				if(isset($attributes)) {
					foreach($attributes as $attr => $val) {
						if($get_attributes == 1) $result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr'
						/**  :TODO: should we change the key name to '_attr'? Someone may use the tagname 'attr'. Same goes for 'value' too */
					}
				}
			} elseif(isset($value)) {
				$result = $value;
			}
	
			//See tag status and do the needed.
			if($type == "open") {//The starting of the tag '<tag>'
				$parent[$level-1] = &$current;
	
				if(!is_array($current) or (!in_array($tag, array_keys($current)))) { //Insert New tag
					$current[$tag] = $result;
					$current = &$current[$tag];
	
				} else { //There was another element with the same tag name
					if(isset($current[$tag][0])) {
						array_push($current[$tag], $result);
					} else {
						$current[$tag] = array($current[$tag],$result);
					}
					$last = count($current[$tag]) - 1;
					$current = &$current[$tag][$last];
				}
	
			} elseif($type == "complete") { //Tags that ends in 1 line '<tag />'
				//See if the key is already taken.
				if(!isset($current[$tag])) { //New Key
					$current[$tag] = $result;
	
				} else { //If taken, put all things inside a list(array)
					if((is_array($current[$tag]) and $get_attributes == 0)//If it is already an array...
							or (isset($current[$tag][0]) and is_array($current[$tag][0]) and $get_attributes == 1)) {
						array_push($current[$tag],$result); // ...push the new element into that array.
					} else { //If it is not an array...
						$current[$tag] = array($current[$tag],$result); //...Make it an array using using the existing value and the new value
					}
				}
	
			} elseif($type == 'close') { //End of tag '</tag>'
				$current = &$parent[$level-1];
			}
		}
	
		return($xml_array);
	} 

} // class

?>