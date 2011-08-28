<?php

/**
 * This file is loaded automatically by the app/webroot/index.php file after the core bootstrap.php
 *
 * This is an application wide file to load any function that is not used within a class
 * define. You can also use this to include or require any files in your application.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * The settings below can be used to set additional paths to models, views and controllers.
 * This is related to Ticket #470 (https://trac.cakephp.org/ticket/470)
 *
 * App::build(array(
 *     'plugins' => array('/full/path/to/plugins/', '/next/full/path/to/plugins/'),
 *     'models' =>  array('/full/path/to/models/', '/next/full/path/to/models/'),
 *     'views' => array('/full/path/to/views/', '/next/full/path/to/views/'),
 *     'controllers' => array('/full/path/to/controllers/', '/next/full/path/to/controllers/'),
 *     'datasources' => array('/full/path/to/datasources/', '/next/full/path/to/datasources/'),
 *     'behaviors' => array('/full/path/to/behaviors/', '/next/full/path/to/behaviors/'),
 *     'components' => array('/full/path/to/components/', '/next/full/path/to/components/'),
 *     'helpers' => array('/full/path/to/helpers/', '/next/full/path/to/helpers/'),
 *     'vendors' => array('/full/path/to/vendors/', '/next/full/path/to/vendors/'),
 *     'shells' => array('/full/path/to/shells/', '/next/full/path/to/shells/'),
 *     'locales' => array('/full/path/to/locale/', '/next/full/path/to/locale/')
 * ));
 *
 */

/**
 * As of 1.3, additional rules for the inflector are added below
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */
/*
 * DEBUG FUNCTIONS
 */

function gentime(){
	static $a;
	if($a == 0)
		$a = microtime(true);
	else
		return (string) (microtime(true) - $a);
}

gentime();

/**
 * Print last DB query
 */
function pq(){
	$cm = ConnectionManager::getInstance();
	$dbo = reset($cm->_dataSources);
	$log = $dbo->_queriesLog;
	$query = end($log);
	//$query['query'] = self::format_query($query['query']);
	echo "<pre>";
	print_r($query);
	echo "</pre>";
}

/**
 * For profiling
 */
function profile(){
	echo "<pre>";
	print_r(array(
		sprintf("PEAK: %s", format_bytes(memory_get_peak_usage())),
		sprintf("PEAK: %s", format_bytes(memory_get_usage())),
		sprintf("TIME: %.2fms", gentime()),
	));
	echo "</pre>";
	die();
}

/**
 * debug function
 */
function prd(){
	header('content-type: text/html; charset=utf8');
	echo "<pre style='border: 1px solid black; padding: 3px; font-size: 11px; font-family: courier new; background: #EEE; color: #000;'>";
	print_r(func_get_args());
	echo "</pre>";
	die();
}

/*
 * APP WIDE FUNCTIONS
 */

/**
 * Allowed chars can be changed, but not recommended
 * For french or cyrilic characters, simply add
 */
define('WIKI_PAGE_ALIAS_ALLOWED_CHARS', 'A-Za-z0-9' . preg_quote('_-ÁÉÍÓÚÜáéíóúüñÑ€$%. '));

/**
 * Prepare the alias for wiki pages
 * @param string $alias
 * @return string
 */
function wiki_encode_alias($alias){
	$alias = str_replace(' ', '_', $alias);
	$alias = preg_replace('/[^' . WIKI_PAGE_ALIAS_ALLOWED_CHARS . ']/', '', $alias);
	return substr($alias, 0, 250);
}

function format_bytes($bytes, $output = 'text'){
	$s = array('b', 'Kb', 'MB', 'GB', 'TB', 'PB');

	if($bytes != 0){
		$e = floor(log($bytes) / log(1024));
	}else{
		$e = 0;
	}

	$unit = $s[$e];

	if($e == 0){
		$rounded = $bytes;
	}else{
		$rounded = sprintf("%.2f", ($bytes / pow(1024, floor($e))));
	}

	if($output == 'array'){
		return array(
			'bytes' => $bytes,
			'unit' => $s[$e],
			'rounded' => $rounded,
		);
	}else{
		return "{$rounded}{$unit}";
	}
}

define("WORD_COUNT_MASK", "/(\p{L}[\p{L}\p{Mn}\p{Pd}'\x{2019}]*){4,}/u");

function str_word_count_utf8($string, $format = 0){
	switch($format){
		case 1:
			preg_match_all(WORD_COUNT_MASK, $string, $matches);
			return $matches[0];
		case 2:
			preg_match_all(WORD_COUNT_MASK, $string, $matches, PREG_OFFSET_CAPTURE);
			$result = array();
			foreach($matches[0] as $match){
				$result[$match[1]] = $match[0];
			}
			return $result;
	}
	return preg_match_all(WORD_COUNT_MASK, $string, $matches);
}

/**
 * Retrieve an element of the array
 * @param array $data the array to extract the item
 * @param string $path the path to the item
 * @return array
 */
function dot_get(array &$data, $path){
	$keys = explode('.', $path);
	foreach($keys as $k){
		if(isset($data[$k])){
			$data = & $data[$k];
		}else{
			return null;
		}
	}
	return $data;
}