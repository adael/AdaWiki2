<?php

class WikiMenuController extends AppController{

	var $uses = array('Menu');
	var $layout = 'wiki';

	function beforeRender(){
		$menus = $this->Menu->find('all', array(
			'fields' => array('title', 'link', 'link_type', 'class'),
			'order' => 'order',
				));
		$this->set('mainmenu', $menus);
	}

	function index(){
		$this->helpers[] = 'WikiDatagrid';
		$this->set('items', $this->paginate('Menu'));
	}

	function add(){
		$this->edit();
		$this->render('edit');
	}

	function edit($id = null){
		if(!empty($this->data)){
			$this->Menu->create();
			$this->Menu->set($this->data);
			$success = $this->Menu->save();
			if($success){
				$this->Session->setFlash(__('The menu has been saved', true));
				if($success['Menu']['link_type'] == 'page'){
					$this->redirect('/wiki_pages/view/' . $success['Menu']['link']);
				}else{
					$this->redirect(array('action' => 'index'));
				}
			}
		}
		$this->Menu->id = $id;
		$this->data = $this->Menu->read();
		$this->set('classes', $this->Menu->getClasses());
		$this->set('linkTypes', $this->Menu->getLinkTypes());
	}

	function delete($id = null){
		if(!empty($this->data)){
			$this->Menu->create($this->data);
			$this->Menu->delete();
			$this->Session->setFlash(__('The menu has been deleted', true));
			$this->redirect('/wiki_menu/index');
		}else{
			$this->Menu->id = $id;
			if(!$this->Menu->exists()){
				$this->Session->setFlash(__('Menu not found', true));
				$this->redirect('/wiki_menu/index');
			}
			$this->data = $this->Menu->read();
		}
	}

	function populate(){
		for($i = 0; $i < 100; $i++){
			$this->Menu->create(array(
				'id' => $i + 100,
				'title' => "Menu " . $i,
				'link' => "menu_$i",
			));
			$this->Menu->save();
		}
		die("End");
	}

}