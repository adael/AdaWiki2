<?php

class WikiController extends AppController{

	var $uses = array('Page');
	var $helpers = array('Form');
	var $layout = 'wiki';

	/**
	 *
	 * @var Page
	 */
	var $Page;
	private $id = null;

	function beforeFilter(){
		parent::beforeFilter();
		if(isset($this->params['named']['id'])){
			$this->id = $this->params['named']['id'];
		}else{
			$this->id = Configure::read('Wiki.front');
			$this->params['named']['id'] = $this->id;
		}
	}

	function index(){
		$this->Page->id = $this->id;
		$this->Page->read();
		if(empty($this->Page->data[$this->Page->alias]['content'])){
			$this->redirect(array('action' => 'edit', 'id' => $this->id));
		}
		$this->set('page', $this->Page->data[$this->Page->alias]);
	}

	function edit(){
		if(!empty($this->data)){
			$this->Page->id = $this->id;
			$this->Page->read();
			$this->Page->set('id', $this->id);
			$this->Page->set($this->data);
			$success = $this->Page->save();
			if($success){
				$this->redirect(array('action' => 'index', $title));
			}
		}
		$this->data = $this->Page->findById($this->id);
	}

	function admin(){
		$this->paginate = array(
			'limit' => 20,
		);
		$this->data = $this->paginate();
	}

	function delete(){
		$this->Page->delete($this->id);
		$this->redirect('/');
	}

}
