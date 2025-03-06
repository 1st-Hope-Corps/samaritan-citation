<?php
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
				xml_get_current_line_number($this->_oParser))
			);
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