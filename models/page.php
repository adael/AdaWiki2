<?php

class Page extends AppModel{

	var $validates = array(
		'alias' => array(
			'rule' => WIKI_PAGE_ID_PATTERN,
			'message' => 'Page title must be alphanumeric'
		),
	);

	function beforeValidate($options = array()){
		if(!empty($this->data[$this->alias]['alias'])){
			$this->set('alias', wiki_encode_title($this->data[$this->alias]['alias']));
		}
		return parent::beforeValidate($options);
	}

	function beforeSave($options = array()){
		if(isset($this->data[$this->alias]['content'])){
			$this->set('content_length', strlen($this->data[$this->alias]['content']));
			$this->set('content_numwords', str_word_count_utf8($this->data[$this->alias]['content']));
		}
		return parent::beforeSave($options);
	}

	function beforeDelete($cascade = true){
		if($this->field('internal')){
			return false;
		}
		parent::beforeDelete($cascade);
	}

}

