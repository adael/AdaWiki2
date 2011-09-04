<?php

class ButtonRenderer extends WikiDatagridCellRenderer{

	function prepare($col, $row){
		$out = $this->Html->link('', '/wiki_menu/edit/' . $row['Menu']['id'], array(
			'class' => 'icon-16 Write',
			'title' => __('Edit menu', true),
				));
		$out .= $this->Html->link('', '/wiki_menu/delete/' . $row['Menu']['id'], array(
			'class' => 'icon-16 Trash',
			'title' => __('Delete menu', true),
				));
		if($row['Menu']['link_type'] == 'page'){
			$out .= $this->Html->link('', '/wiki_pages/edit/' . $row['Menu']['link'], array(
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
?>
<hr/>
<div class='pagination'>
	<?php
	if($this->Paginator->hasPrev()){
		echo $this->Paginator->prev($this->Html->image('icons/axialis/web20/rounded/Grey/16x16/Arrow2 Left.png'), array('escape' => false));
	}
	echo $this->Paginator->numbers();
	if($this->Paginator->hasNext()){
		echo $this->Paginator->next($this->Html->image('icons/axialis/web20/rounded/Grey/16x16/Arrow2 Right.png'), array('escape' => false));
	}
	?>
</div>