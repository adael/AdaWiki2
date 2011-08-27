<?php

class WikiController extends AppController{

	var $uses = array('Page', 'Menu');
	var $helpers = array('Form');
	var $layout = "wiki";

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

	function beforeRender(){
		$menus = $this->Menu->find('all', array(
			'fields' => array('pages_id', 'title', 'class'),
			'conditions' => array('visible' => 1),
			'order' => 'order',
				));
		$this->set('mainmenu', $menus);
	}

	function index(){
		$this->Page->id = $this->id;
		$this->Page->read();
		if(empty($this->Page->data[$this->Page->alias]['content'])){
			$this->redirect(array('action' => 'edit', 'id' => $this->id));
		}

		if(!empty($this->params['named']['print'])){
			$this->layout = 'print';
			$this->set(array(
				'content' => $this->Page->data[$this->Page->alias]['content'],
				'title' => $this->Page->data[$this->Page->alias]['title'],
			));
		}else{
			$this->set('page', $this->Page->data[$this->Page->alias]);
		}
	}

	function preview(){
		$this->layout = 'print';
		$this->set('content', $this->data);
		$this->render('index');
	}

	function edit(){
		if(!empty($this->data)){
			$this->Page->id = $this->id;
			$this->Page->read();
			$this->Page->set('id', $this->id);
			$this->Page->set($this->data);
			$success = $this->Page->save();
			if($success){
				$this->Session->setFlash("Saved");
				$this->redirect(array('action' => 'index', 'id' => $this->id));
			}
		}
		$this->data = $this->Page->findById($this->id);
		$this->set('title', $this->data[$this->Page->alias]['title']);
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
