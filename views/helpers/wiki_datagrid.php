<?php

class WikiDatagridHelper extends AppHelper{

	var $helpers = array('Html');

	function render($columns, $items){
		echo "<table class='list'>";
		echo "<thead>";
		foreach($columns as $col){
			echo $this->Html->tag('th', $col['text'], @$col['th']);
		}
		echo "</thead>";
		echo "<tbody>";
		foreach($items as $item){
			echo "<tr>";
			foreach($columns as $col){
				if(isset($col['value'])){
					$value = & $col['value'];
				}elseif(isset($col['name'])){
					// dot_get defined in bootstrap, retrieve a key from an array much faster than set::extract
					$value = & dot_get($item, $col['name']);
				}
				if(empty($value) && !empty($col['default'])){
					$value = & $col['default'];
				}
				echo $this->Html->tag('td', $value, @$col['td']);
			}
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
	}

}