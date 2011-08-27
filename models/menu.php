<?php

class Menu extends AppModel{

	private $__classes;
	private $__linkTypes;

	function beforeValidate($options = array()){

		// Default link type
		if(!isset($this->data[$this->alias]['link_type'])){
			$this->set('link_type', 'page');
		}

		// Ensure wiki page alias format
		if($this->data[$this->alias]['link_type'] == 'page'){
			$this->set('link', wiki_encode_title($this->data[$this->alias]['link']));
		}

		return parent::beforeValidate($options);
	}

	function getClasses(){
		if(!$this->__classes){
			$this->__classes = array(
				'none' => __('None', true),
				'silver' => __('Silver', true),
				'blue' => __('Blue', true),
				'gold' => __('Gold', true),
				'green' => __('Green', true),
				'red' => __('Red', true),
				'pink' => __('Pink', true),
			);
		}
		return $this->__classes;
	}

	function getLinkTypes(){
		if(!$this->__linkTypes){
			$this->__linkTypes = array(
				'page' => __('Page', true),
				'internal' => __('Internal', true),
				'external' => __('External', true),
			);
		}
		return $this->__linkTypes;
	}

}