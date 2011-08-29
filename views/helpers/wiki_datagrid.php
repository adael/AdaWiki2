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
				if(!empty($col['renderer'])){

					$value = $col['renderer']->render($col, $item);
				}else{

					if(isset($col['value'])){
						$value = & $col['value'];
					}elseif(isset($col['name'])){
						$value = & fset::get($item, $col['name']);
					}

					if(empty($value) && !empty($col['default'])){
						$value = & $col['default'];
					}
				}

				echo $this->Html->tag('td', $value, @$col['td']);
			}
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
	}

	private function __actions_renderer($col, $item){
		if(!empty($col['rules'])){
			foreach($col['rules'] as $index => $rule){
				if($rule[0] == 'hideIf'){
					$s = fset::replace_vars($rule[1], $item, '{', '}');
					prd($s);
				}
			}
		}
		return join($col['actions']);
	}

}

abstract class WikiDatagridCellRenderer{

	/**
	 * @param array $col
	 * @param array $data
	 */
	abstract function render($col, $data);
}