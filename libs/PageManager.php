<?php

class PageManager{

	private $folder;
	private $ext = '.txt';

	function __construct(){
		$this->folder = ROOT . 'pages' . DS;
	}

	function getContent($name){
		$path = $this->getPath($name);
		if(is_file($path)){
			return file_get_contents($path);
		}else{
			return null;
		}
	}

	function setContent($name, $content){
		if(!is_dir($this->folder)){
			mkdir($this->folder, 0770, true);
		}
		return file_put_content($this->getPath($name), $content);
	}

	function getAll(){
		if(is_dir(PAGES)){
			$pages = glob($this->folder . "*" . $this->ext);
			foreach($pages as $k => $v){
				$pages[$k] = $this->getName($v);
			}
			natcasesort($pages);
			return $pages;
		}else{
			return array();
		}
	}

	function rename($page, $newname){
		if(empty($page) || empty($newname)){
			throw new exception("Falta un parametro");
		}
		return rename($this->getPath($page), $this->getPath($newname));
	}

	function delete($page){
		$path = $this->getPath($page);
		if($path && is_file($path)){
			return unlink($path);
		}else{
			return false;
		}
	}

	function getPath($name){
		return $this->folder . DS . base64_encode(substr($name, 0, 150)) . $this->ext;
	}

	function getName($path){
		$info = pathinfo($path);
		return base64_decode($info['filename']);
	}

	function getSize($name){
		return hfilesize($this->getPath($pagename));
	}

}