<?php

class AppController extends Controller{

	function _checkNamed($k){
		return!empty($this->params['named'][$k]);
	}

	function _setNamed($k, $v){
		$this->params['named'][$k] = $v;
	}

	function _getNamed($k){
		return isset($this->params['named'][$k]) ? $this->params['named'][$k] : null;
	}

}
