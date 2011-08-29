<?php

class ButtonRenderer extends WikiDatagridCellRenderer{

	private $Html;

	function __construct($html){
		$this->Html = $html;
	}

	function render($col, $item){
		$out = $this->Html->link('', '/wiki_menu/edit/' . $item['Menu']['id'], array(
			'class' => 'icon-16 Write',
			'title' => __('Edit menu', true),
				));
		$out .= $this->Html->link('', '/wiki_menu/delete/' . $item['Menu']['id'], array(
			'class' => 'icon-16 Trash',
			'title' => __('Delete menu', true),
				));
		if($item['Menu']['link_type'] == 'page'){
			$out .= $this->Html->link('', '/wiki_pages/edit/' . $item['Menu']['link'], array(
				'class' => 'icon-16 Write2',
				'title' => __('Edit page', true),
					));
		}
		return $out;
	}

}

$columns = array(
	array(
		'name' => 'Menu.title',
		'text' => __('Title', true),
	),
	array(
		'name' => 'Menu.link',
		'text' => __('Link', true),
	),
	array(
		'name' => 'Menu.link_type',
		'text' => __('Link type', true),
	),
	array(
		'name' => 'Menu.order',
		'text' => __('Order', true),
	),
	array(
		'name' => 'Menu.class',
		'text' => __('Class', true),
	),
	array(
		'text' => __('Actions', true),
		'td' => array('align' => 'left', 'width' => '56'),
		'renderer' => new ButtonRenderer($this->Html),
	),
);

echo $html->tag('h1', __('Manage menus', true));
$this->WikiDatagrid->render($columns, $items);
echo $this->Html->tag('div', $this->Paginator->numbers(), array('class' => 'pagination'));
