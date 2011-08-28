<?php
/**
 * fset class
 * A standalone lightweight class for manage arrays with dot notation.
 *
 * @author Carlos Gant <carlos@aicor.com>
 */
class fset {

	/**
	 * Retrieve an element of the array
	 * @param array $data the array to extract the item
	 * @param string $path the path to the item
	 * @return array
	 */
	static function get(array &$data, $path){
		$keys = explode('.', $path);
		foreach($keys as $k){
			if(isset($data[$k])){
				$data =& $data[$k];
			}else{
				return null;
			}
		}
		return $data;
	}

	/**
	 * Insert an element into the array
	 * @param array $data the array to insert the item
	 * @param string $path the path where to insert the item into the array
	 * @param mixed $value the value
	 */
	static function set(array &$data, $path, $value){
		$keys = explode('.', $path);
		$last = array_pop($keys);
		foreach($keys as $k){
			if(isset($data[$k]) && is_array($data[$k])){
				$data =& $data[$k];
			}else{
				$data[$k] = array();
				$data =& $data[$k];
			}
		}
		$data[$last] = $value;
	}

	/**
	 * Count the elements of an array item.
	 * @example
	 *		$a = array('The' => array('Items' => array('one', 'two', 'tree')));
	 *		echo fset::count($a, 'The.Items'); // => gives 3
	 * @param array $data
	 * @param string $path
	 * @return int number of items or null if the key not exists.
	 */
	static function count(array &$data, $path){
		$keys = explode('.', $path);
		$last = array_pop($keys);
		foreach($keys as $k){
			if(isset($data[$k]) && is_array($data[$k])){
				$data =& $data[$k];
			}else{
				return null;
			}
		}
		return isset($data[$last]) && is_array($data[$last]) ? sizeOf($data[$last]) : null;
	}

	/**
	 * Deletes a key of the array
	 * @param array $data array to use
	 * @param string $path path to the key
	 * @return void
	 */
	static function del(array &$data, $path){
		$keys = explode('.', $path);
		$last = array_pop($keys);
		foreach($keys as $k){
			if(isset($data[$k]) && is_array($data[$k])){
				$data =& $data[$k];
			}else{
				return;
			}
		}
		unset($data[$last]);
	}

	/**
	 * Check if a key is set in the array
	 * @param array $data
	 * @param string $path
	 * @return boolean true if the key isset, false if not, null if the key not exists
	 */
	static function is_set(array &$data, $path){
		$keys = explode('.', $path);
		$last = array_pop($keys);
		foreach($keys as $k){
			if(isset($data[$k]) && is_array($data[$k])){
				$data =& $data[$k];
			}else{
				return null;
			}
		}
		return isset($data[$last]);
	}

	/**
	 * Check if a key is empty in the array	 *
	 * @param array $data
	 * @param string $path
	 * @return boolean true if the key is empty or not exists, false if exists and is not empty.
	 */
	static function is_empty(array &$data, $path){
		$keys = explode('.', $path);
		$last = array_pop($keys);
		foreach($keys as $k){
			if(isset($data[$k]) && is_array($data[$k])){
				$data =& $data[$k];
			}else{
				return true;
			}
		}
		return empty($data[$last]);
	}

}