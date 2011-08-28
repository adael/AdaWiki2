<?php

class WikiMenuController extends AppController{

	var $uses = array('Menu');
	var $layout = 'wiki';

	function beforeRender(){
		$menus = $this->Menu->find('all', array(
			'fields' => array('link', 'title', 'class'),
			'conditions' => array('visible' => 1),
			'order' => 'order',
				));
		$this->set('mainmenu', $menus);
	}

	function index(){
		$this->set('items', $this->paginate('Menu'));
	}

	function add(){
		$this->edit();
		$this->render('edit');
	}

	function edit(){
		if(!empty($this->data)){
			$this->Menu->create();
			$success = $this->Menu->save($this->data);
			if($success){
				$this->Session->setFlash(__('The menu has been saved', true));
				if($success['Menu']['link_type'] == 'page'){
					$this->redirect('/wiki/index/alias:' . $success['Menu']['link']);
				}else{
					$this->redirect(array('action' => 'index'));
				}
			}
		}
		$this->set('classes', $this->Menu->getClasses());
		$this->set('linkTypes', $this->Menu->getLinkTypes());
	}

	function delete(){

	}

}