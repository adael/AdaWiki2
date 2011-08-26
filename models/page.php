<?php

class Page extends AppModel{

	private $__ignored_words = array();

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