<?php

class ButtonRenderer extends WikiDatagridCellRenderer{

	private $Html;

	function __construct($html){
		$this->Html = $html;
	}

	function render($col, $item){
		$out = $this->Html->link('', '/wiki_pages/view/' . $item['Page']['alias'], array(
			'class' => 'icon-16 Arrow2UpRight',
			'title' => __('View page', true),
				));
		$out .= $this->Html->link('', '/wiki_pages/edit/' . $item['Page']['alias'], array(
			'class' => 'icon-16 Write2',
			'title' => __('Edit page', true),
				));

		if($item['Page']['locked']){
			$out .= $this->Html->link('', '/wiki_pages/unlock/' . $item['Page']['alias'], array(
				'class' => 'icon-16 green LockOpen',
				'title' => __('Unlock page', true),
					));
		}else{
			$out .= $this->Html->link('', '/wiki_pages/lock/' . $item['Page']['alias'], array(
				'class' => 'icon-16 grey Lock',
				'title' => __('Lock page', true),
					));
		}

		$out .= $this->Html->link('', '/wiki_pages/delete/' . $item['Page']['alias'], array(
			'class' => 'icon-16 red Trash',
			'title' => __('Delete paage', true),
				));
		return $out;
	}

}

$columns = array(
	array(
		'name' => 'Page.title',
		'text' => __('Title', true),
	),
	array(
		'name' => 'Page.content_numwords',
		'text' => __('Num. Words', true),
		'td' => array('align' => 'center'),
	),
	array(
		'name' => 'Page.content_length',
		'text' => __('Content length', true),
		'td' => array('align' => 'center'),
	),
	array(
		'name' => 'Page.locked',
		'text' => __('Locked', true),
		'td' => array('align' => 'center'),
	),
	array(
		'name' => 'Page.created',
		'text' => __('Created', true),
		'td' => array('align' => 'center'),
	),
	array(
		'text' => __('Actions', true),
		'td' => array('align' => 'left', 'width' => '56'),
		'renderer' => new ButtonRenderer($this->Html),
	),
);

echo $html->tag('h1', __('Manage pages', true));
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
