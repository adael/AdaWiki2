<?php

/*
 *   [Menu] => Array
  (
  [id] => 2
  [title] => Prueba 2
  [link] => Prueba_2
  [link_type] => page
  [order] => 0
  [visible] => 1
  [class] => blue
  [created] => 2011-08-28 12:09:13
  [modified] => 2011-08-28 12:16:35
  )

 */
echo $html->tag('h1', __('Manage menus', true));

$buttons = array(
	$this->Html->link(__('Edit', true), '/wiki/edit/alias:{Page.alias}', array(
		'class' => 'wbtn edit',
	))
);

$columns = array(
	array(
		'name' => 'Page.title',
		'text' => __('Title', true),
	),
	array(
		'name' => 'Page.link',
		'text' => __('Link', true),
	),
	array(
		'name' => 'Page.link_type',
		'text' => __('Link type', true),
	),
	array(
		'name' => 'Page.order',
		'text' => __('Order', true),
	),
	array(
		'name' => 'Page.class',
		'text' => __('Class', true),
	),
	array(
		'text' => __('Actions', true),
		'value' => join($buttons),
		'replaceValueWith' => array('Page.alias'),
	),
);

$this->WikiDatagrid->render($columns, $items);

echo $this->Html->tag('div', $this->Paginator->numbers(), array('class' => 'pagination'));
