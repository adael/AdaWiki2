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

	function beforeFilter(){
		parent::beforeFilter();
		if(!$this->_checkNamed('alias')){
			$this->_setNamed('alias', Configure::read('Wiki.front'));
		}
	}

	function beforeRender(){
		$menus = $this->Menu->find('all', array(
			'fields' => array('title', 'link', 'class'),
			'conditions' => array('visible' => 1),
			'order' => 'order',
				));
		$this->set('mainmenu', $menus);
	}

	function index(){
		$alias = $this->_getNamed('alias');
		$page = $this->Page->find('first', array('conditions' => array('alias' => $this->_getNamed('alias'))));
		if(!empty($page)){
			$page = $page[$this->Page->alias];
		}

		if(empty($page['content'])){
			$this->redirect(array('action' => 'edit', 'alias' => $alias));
		}

		if($this->_checkNamed('print')){
			$this->layout = 'print';
			$this->set(array(
				'content' => $page['content'],
				'title' => $page['title'],
			));
		}else{
			$this->set('page', $page);
		}
	}

	function preview(){
		$this->layout = 'print';
		$this->set('content', $this->data);
		$this->render('index');
	}

	function edit(){
		$this->Session->setFlash("Saved");
		$alias = $this->_getNamed('alias');
		$page = $this->Page->find('first', array('conditions' => array('alias' => $this->_getNamed('alias'))));
		if(!empty($this->data)){
			$this->Page->create($page); // actually is not creating (cakephp bad syntax here)
			$this->Page->set('alias', $alias); // if page not found, set current $alias
			$this->Page->set($this->data);
			$success = $this->Page->save();
			if($success){
				$this->data = $success;
				if(!empty($this->data['Menu']['pin'])){
					$this->Menu->create($this->data['Menu']);
					$this->Menu->set(array(
						'title' => $this->data['Page']['title'],
						'link' => $this->data['Page']['alias'],
					));
					$this->Menu->save();
				}elseif(!empty($this->data['Menu']['id'])){
					$this->Menu->delete($this->data['Menu']['id']);
				}
				$this->Session->setFlash("Saved");
				$this->redirect(array('action' => 'index', 'alias' => $alias));
			}
		}
		$this->data = $page;

		$menuAssociated = $this->Menu->find('first', array('conditions' => array('link' => $alias, 'link_type' => 'page')));
		if(!empty($menuAssociated)){
			$this->data['Menu'] = $menuAssociated['Menu'];
			$this->data['Menu']['pin'] = true;
		}

		$this->set('classes', $this->Menu->getClasses());
	}

	function admin(){
		$this->paginate = array(
			'limit' => 20,
		);
		$this->data = $this->paginate();
	}

	function delete(){
		$alias = $this->_getNamed('alias');
		$page = $this->Page->find('first', array('conditions' => array('alias' => $this->_getNamed('alias'))));
		if(empty($page)){
			$this->Session->setFlash(__('Page not found', true));
			$this->redirect('/');
		}
		$page = $page[$this->Page->alias];
		if(!empty($this->data)){
			$this->Page->delete($page['id']);
			$this->redirect('/');
		}
		$this->set('page', $page);
	}

}
