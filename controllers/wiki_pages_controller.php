<?php

class WikiPagesController extends AppController{

	var $uses = array('Page', 'Menu');
	var $helpers = array('Form');
	var $layout = "wiki";

	/**
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
			'fields' => array('title', 'link', 'link_type', 'class'),
			'order' => 'order'));
		$this->set('mainmenu', $menus);
	}

	function index(){
		
	}

	function view(){
		$alias = $this->_getNamed('alias');
		$page = $this->Page->findByAlias($alias);
		if(!$page || empty($page['Page']['content'])){
			$this->redirect(array('action' => 'edit', 'alias' => $alias));
		}
		$this->helpers[] = 'Wiki';
		$this->set('page', $page);
	}

	function preview(){
		$this->helpers[] = 'Wiki';
		$this->layout = 'print';
		$this->set('content', $this->data);
	}

	function printView(){
		$alias = $this->_getNamed('alias');
		$page = $this->Page->findByAlias($alias);
		if(!$page){
			$this->redirect('/');
		}
		$this->set(array(
			'content' => $page['Page']['content'],
			'title' => $page['Page']['title'],
		));
		$this->layout = 'print';
	}

	function edit(){
		$alias = $this->_getNamed('alias');
		$page = $this->Page->findByAlias($alias);

		// Check content to prevent looping with index
		if(!empty($page['Page']['locked']) && !empty($page['Page']['content'])){
			$this->Session->setFlash(__('This page is locked', true));
			$this->redirect("/wiki/index/alias:$alias");
		}

		if(!empty($this->data)){
			$this->Page->create($page); // actually is not creating (cakephp bad syntax here)
			// For security only sends the fields needed
			$this->Page->set(array(
				'alias' => $alias,
				'title' => $this->data['Page']['title'],
				'content' => &$this->data['Page']['content'],
			));
			$success = $this->Page->save();
			if($success){
				if(!empty($this->data['Menu']['pin'])){
					$this->Menu->create();
					$this->Menu->set(array(
						'id' => $this->data['Menu']['id'],
						'title' => $success['Page']['title'],
						'link' => $success['Page']['alias'],
						'class' => $this->data['Menu']['class'],
					));
					$this->Menu->save();
				}elseif(!empty($this->data['Menu']['id'])){
					$this->Menu->delete($this->data['Menu']['id']);
				}
				$this->Session->setFlash("The page has been saved");
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

	function lock(){
		$alias = $this->_getNamed('alias');
		$this->Page->setPageLock($alias, 1);
		$this->Session->setFlash(__('The page has been locked', true));
		$this->redirect("/wiki/index/alias:" . $alias);
	}

	function unlock(){
		$alias = $this->_getNamed('alias');
		$this->Page->setPageLock($alias, 0);
		$this->Session->setFlash(__('The page has been unlocked', true));
		$this->redirect("/wiki/index/alias:" . $alias);
	}

	function delete(){
		$alias = $this->_getNamed('alias');
		$page = $this->Page->findByAlias($alias);
		if(!$page){
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
