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
echo "<table class='list'>";

echo "<thead>";
echo $this->Html->tableHeaders(array(
	__('Title', true),
	__('Link', true),
	__('Link type', true),
	__('Order', true),
	__('Class', true),
	__('Actions', true),
));
echo "</thead>";

echo "<tbody>";
foreach($items as $item){
	$item = & $item['Menu'];

	echo "<tr>";

	echo "<td>{$item['title']}</td>";
	echo "<td>{$item['link']}</td>";
	echo "<td>{$item['link_type']}</td>";
	echo "<td>{$item['order']}</td>";
	echo "<td>{$item['class']}</td>";
	echo "<td><button>Action</button></td>";

	echo "</tr>";
}
echo "</tbody>";

echo "</table>";

echo $this->Paginator->numbers();