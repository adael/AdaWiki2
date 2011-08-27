<?

if(!isset($title) && isset($page['title'])){
	$title = $page['title'];
}

if(!isset($content) && isset($page['content'])){
	$content = & $page['content'];
}

if(!empty($title)){
	echo "<div class='content-header'>";
	echo "<h1>{$page['title']}</h1>";
	echo "</div>";
}

if(!empty($content)){

	$markdown = app::import('vendor', 'markdown/markdown');

	$patterns = array();

	// Enlace externo con alias
	$patterns['/\[(.+)\|(http\:\/\/[^\]]+)\]/iU'] = "<a href=\"\\2\" target='_blank'>\\1</a>";

	// Proceso los enlaces externos [http:://enlace]
	$patterns['/\[(http\:\/\/[^\]]+)\]/iU'] = "<a href=\"\\1\" target='_blank'>\\1</a>";

	// Enlace interno normal
	foreach($patterns as $pat => $rep){
		$content = preg_replace($pat, $rep, $content);
	}

	// Los enlaces internos
	$pat = '/\[(?!http\:\/\/)([^\]]+)\]/iU';
	$content = preg_replace_callback($pat, function($matches) use (&$html){
				/* @var $html HtmlHelper */
				return $html->link($matches[1], "/wiki/index/id:" . wiki_encode_title($matches[1]));
			}, $content);

	echo "<div class='content-body'>";
	echo Markdown($content);
	echo "</div>";
}

if(!empty($page)){
	echo "<div class='content-footer'>";
	$modified = strtotime($page['modified']);
	$bytes = format_bytes($page['content_length'], 'array');
	$bytes = $bytes['rounded'] . "<b>" . $bytes['unit'] . "</b>";
	printf(__('Word count: %s.', true), $page['content_numwords']);
	printf(__('Size: %s. Last modified %s', true), $bytes, strftime("%c", $modified));
	echo "</div>";
}