<?php

class Menu extends AppModel{

	/**
	 * @var array holds class list
	 */
	private $__classes;

	/**
	 * @var array holds link types
	 */
	private $__linkTypes;

	function beforeValidate($options = array()){
		$this->validate = array(
			'id' => array(
				'allowEmpty' => true,
				'rule' => 'numeric',
				'message' => __('Invalid id', true),
			),
			'title' => array(
				'required' => true,
				'allowEmpty' => false,
				'rule' => 'notEmpty',
				'message' => __('Title is required', true),
			),
			'link' => array(
				'required' => true,
				'allowEmpty' => false,
				'rule' => 'notEmpty',
				'message' => __('Link is required', true),
			),
			'link_type' => array(
				'required' => true,
				'allowEmpty' => false,
				'rule' => array('inList', array_keys($this->getLinkTypes())),
				'message' => __('Invalid link type', true),
			),
			'order' => array(
				'rule' => 'numeric',
				'message' => __('Invalid order', true),
			),
			'class' => array(
				'rule' => array('inList', array_keys($this->getClasses())),
				'message' => __('Invalid class type', true),
			),
		);

		// Default link type
		if(!isset($this->data[$this->alias]['link_type'])){
			$this->set('link_type', 'page');
		}

		// Remove invalid chars from link if link_type is page
		if($this->data[$this->alias]['link_type'] == 'page'){
			$this->set('link', wiki_encode_alias($this->data[$this->alias]['link']));
		}

		return parent::beforeValidate($options);
	}

	/**
	 * Return available classes
	 * @return array
	 */
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

	/**
	 * Return available link types.
	 * @return array
	 */
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