<div class="content-body">
	<?php
	if(!isset($title) && isset($page['title'])){
		$title = $page['title'];
	}

	if(!isset($content) && isset($page['content'])){
		$content = & $page['content'];
	}

	if(!empty($title)){
		echo "<div class='content-header'>";
		echo "<h1 class='caption'>{$title}</h1>";
		echo $this->Html->link($this->Html->tag('span', __('Edit this page', true)), '/wiki/edit/alias:' . $this->params['named']['alias'], array(
			'class' => 'wiki-edit-button',
			'escape' => false,
		));
		echo "</div>";
	}

	if(!empty($content)){
		// Internal links
		$pat = '/\[([' . WIKI_PAGE_ALIAS_ALLOWED_CHARS . ']+)\]/iU';
		$content = preg_replace_callback($pat, function($matches) use (&$html){
					return $html->link($matches[1], "/wiki/index/alias:" . wiki_encode_alias($matches[1]));
				}, $content);
		app::import('vendor', 'markdown/markdown');
		echo Markdown($content);
	}
	?>
</div>

<?php
if(!empty($page)){
	echo "<hr/>";
	echo "<div class='content-footer'>";
	$modified = strtotime($page['modified']);
	$bytes = format_bytes($page['content_length'], 'array');
	$bytes = $bytes['rounded'] . "<b>" . $bytes['unit'] . "</b>";
	printf(__('Word count: %s.', true), $page['content_numwords']);
	printf(__('Size: %s. Last modified %s', true), $bytes, strftime("%c", $modified));
	echo "</div>";
}