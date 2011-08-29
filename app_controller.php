<?php

class AppController extends Controller{

	var $components = array('Session');

	function constructClasses(){
		if(Configure::read('debug') > 0 && is_file(APP . 'plugins' . DS . 'debug_kit' . DS . 'debug_kit_app_controller.php')){
			$this->components[] = 'DebugKit.Toolbar';
		}

		app::import('vendor', 'fset');

		parent::constructClasses();
	}

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
