<?php

class WikiPagesController extends AppController{

	var $uses = array('Page', 'Menu');
	var $helpers = array('Form');
	var $layout = "wiki";

	/**
	 * @var Page
	 */
	var $Page;

	function beforeRender(){
		$this->set('mainmenu', $this->Menu->find('all', array(
					'fields' => array('title', 'link', 'link_type', 'class'),
					'order' => 'order')));
	}

	function index(){
		$this->helpers[] = 'WikiDatagrid';
		$this->set('items', $this->paginate('Page'));
	}

	function view($alias = null){
		$page = $this->Page->findByAlias($alias);
		if(!$page || empty($page['Page']['content'])){
			$this->redirect(array('action' => 'edit', $alias));
		}

		// Support for including other page contents with {#page_alias#}
		$this->Page->embedPages($page);

		$this->helpers[] = 'Wiki';
		$this->helpers[] = 'Js';
		$this->set(compact('alias', 'page'));
	}

	function preview(){
		$this->helpers[] = 'Wiki';
		$this->layout = 'print';
		$this->set('content', $this->data);
	}

	function printView($alias){
		$page = $this->Page->findByAlias($alias);
		if(!$page){
			$this->redirect('/');
		}
		$this->set(array(
			'alias' => $alias,
			'content' => $page['Page']['content'],
			'title' => $page['Page']['title'],
		));
		$this->layout = 'print';
	}

	function edit($alias = null){
		$page = $this->Page->findByAlias($alias);

		// Check content to prevent looping with index
		if(!empty($page['Page']['locked']) && !empty($page['Page']['content'])){
			$this->Session->setFlash(__('This page is locked', true));
			$this->redirect("/wiki_pages/view/$alias");
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
				$this->redirect(array('action' => 'view', $alias));
			}
		}
		$this->data = $page;
		$menuAssociated = $this->Menu->find('first', array('conditions' => array('link' => $alias, 'link_type' => 'page')));
		if(!empty($menuAssociated)){
			$this->data['Menu'] = $menuAssociated['Menu'];
			$this->data['Menu']['pin'] = true;
		}

		$this->set('alias', $alias);
		$this->set('classes', $this->Menu->getClasses());
	}

	function lock($alias = null){
		$this->Page->setPageLock($alias, 1);
		$this->Session->setFlash(__('The page has been locked', true));
		$this->redirect($this->referer());
	}

	function unlock($alias = null){
		$this->Page->setPageLock($alias, 0);
		$this->Session->setFlash(__('The page has been unlocked', true));
		$this->redirect($this->referer());
	}

	function delete($alias = null){
		if(!empty($this->data)){
			$this->Page->create($this->data);
			if($this->Page->delete()){
				$this->Session->setFlash(__('The page has been deleted', true));
			}else{
				$this->Session->setFlash(join($this->Page->validationErrors));
			}
			$this->redirect('/wiki_pages/index');
		}else{
			$page = $this->Page->findByAlias($alias);
			if(!$page){
				$this->Session->setFlash(__('Page not found', true));
				$this->redirect('/wiki_pages/index');
			}
			$this->data = $page;
		}
	}

}
