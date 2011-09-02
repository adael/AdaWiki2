<?php

class WikiDatagridHelper extends AppHelper{

	var $helpers = array('Html');
	private $__renderer;

	function render($columns, $rows){
		$this->__renderer = new WikiDatagridCellRenderer($this->Html);
		echo "<table class='list'>";
		echo "<thead>";
		foreach($columns as $col){
			echo $this->Html->tag('th', $col['text'], @$col['th']);
		}
		echo "</thead>";
		echo "<tbody>";
		foreach($rows as $row){
			echo "<tr>";
			foreach($columns as $col){
				if(!empty($col['renderer'])){
					$value = $col['renderer']->render($col, $row);
				}else{
					$value = $this->__renderer->render($col, $row);
				}
			}
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
	}

}

class WikiDatagridCellRenderer{

	protected $Html;

	function __construct($html){
		$this->Html = $html;
	}

	function prepareValue($col, $row){
		if(isset($col['value'])){
			$value = & $col['value'];
		}elseif(isset($col['name'])){
			$value = & fset::get($row, $col['name']);
		}else{
			$value = null;
		}

		if(empty($value) && !empty($col['default'])){
			$value = & $col['default'];
		}

		if($value === null && isset($col['onNull'])){
			$value = & $col['onNull'];
		}

		return $value;
	}

	/**
	 * @param array $col
	 * @param array $data
	 */
	function render($col, $row){
		$value = $this->prepareValue($col, $row);
		echo $this->Html->tag('td', $value, isset($col['td']) ? $col['td'] : null);
	}

}