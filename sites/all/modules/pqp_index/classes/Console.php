<?php

/* - - - - - - - - - - - - - - - - - - - - -

 Title : PHP Quick Profiler Console Class
 Author : Created by Ryan Campbell
 URL : http://particletree.com/features/php-quick-profiler/

 Last Updated : April 22, 2009

 Description : This class serves as a wrapper around a global
 php variable, debugger_logs, that we have created.

- - - - - - - - - - - - - - - - - - - - - */

	function pqp_index_console_log($data) {
		$logItem = array(
			"data" => $data,
			"type" => 'log'
		);
		$GLOBALS['debugger_logs']['console'][] = $logItem;
		$GLOBALS['debugger_logs']['logCount'] += 1;
	}
	
	/*---------------------------------------------------
	     LOG MEMORY USAGE OF VARIABLE OR ENTIRE SCRIPT
	-----------------------------------------------------*/
	
	function pqp_index_console_logMemory($object = false, $name = 'PHP') {
		$memory = memory_get_usage();
		if($object) $memory = strlen(serialize($object));
		$logItem = array(
			"data" => $memory,
			"type" => 'memory',
			"name" => $name,
			"dataType" => gettype($object)
		);
		$GLOBALS['debugger_logs']['console'][] = $logItem;
		$GLOBALS['debugger_logs']['memoryCount'] += 1;
	}
	
	/*-----------------------------------
	     LOG A PHP EXCEPTION OBJECT
	------------------------------------*/
	
	function pqp_index_console_logError($exception, $message) {
		$logItem = array(
			"data" => $message,
			"type" => 'error',
			"file" => $exception->getFile(),
			"line" => $exception->getLine()
		);
		$GLOBALS['debugger_logs']['console'][] = $logItem;
		$GLOBALS['debugger_logs']['errorCount'] += 1;
	}
	
	/*------------------------------------
	     POINT IN TIME SPEED SNAPSHOT
	-------------------------------------*/
	
	function pqp_index_console_logSpeed($name = 'Point in Time') {
		$logItem = array(
			"data" => PhpQuickProfiler::getMicroTime(),
			"type" => 'speed',
			"name" => $name
		);
		$GLOBALS['debugger_logs']['console'][] = $logItem;
		$GLOBALS['debugger_logs']['speedCount'] += 1;
	}
	
	/*-----------------------------------
	     SET DEFAULTS & RETURN LOGS
	------------------------------------*/
	
	function pqp_index_console_getLogs() {
		if(!$GLOBALS['debugger_logs']['memoryCount']) $GLOBALS['debugger_logs']['memoryCount'] = 0;
		if(!$GLOBALS['debugger_logs']['logCount']) $GLOBALS['debugger_logs']['logCount'] = 0;
		if(!$GLOBALS['debugger_logs']['speedCount']) $GLOBALS['debugger_logs']['speedCount'] = 0;
		if(!$GLOBALS['debugger_logs']['errorCount']) $GLOBALS['debugger_logs']['errorCount'] = 0;
		return $GLOBALS['debugger_logs'];
	}

?>