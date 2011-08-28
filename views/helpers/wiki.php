<?php

class WikiHelper extends AppHelper{

	var $helpers = array('Html');

	/**
	 * @var HtmlHelper
	 */
	var $Html;

	/**
	 * Process wiki page content for formating with markdown and create links
	 * @param string $content
	 * @param array $options
	 * 		links: true for replacing links
	 * 		parser: to choose the parser
	 */
	function render_content(&$content, array $options = array()){

		$options = array_merge(array('links' => true, 'parser' => 'markdown'), $options);

		if($options['links']){
			$pat = '/\[([' . WIKI_PAGE_ALIAS_ALLOWED_CHARS . ']+)\]/iU';
			$content = preg_replace_callback($pat, array($this, '__link_callback'), $content);
		}

		switch($options['parser']){
			case 'markdown':
				app::import('vendor', 'markdown/markdown');
				echo Markdown($content);
				break;
			default:
				echo $content;
				break;
		}
	}

	/**
	 * callback for preg_replace_callback
	 * @param array $matches
	 * @return string to replace with matches
	 */
	function __link_callback($matches){
		return $this->Html->link($matches[1], "/wiki/index/alias:" . wiki_encode_alias($matches[1]));
	}

}