<?php
extract($page['Page'], EXTR_REFS);
?>

<div class="wiki-page-buttons wiki-fold-menu">
	<?php
	if(!$locked){
		echo $this->Html->link($this->Html->tag('span', __('Edit this page', true)), '/wiki_pages/edit/' . $alias, array(
			'class' => 'wiki-fold-button wiki-fold-edit',
			'escape' => false,
		));
		echo $this->Html->link($this->Html->tag('span', __('Lock page', true)), '/wiki_pages/lock/' . $alias, array(
			'class' => 'wiki-fold-button wiki-fold-lock',
			'escape' => false,
		));
		echo $this->Html->link($this->Html->tag('span', __('Delete this page', true)), '/wiki_pages/delete/' . $alias, array(
			'class' => 'wiki-fold-button wiki-fold-delete',
			'escape' => false,
		));
	}else{
		echo $this->Html->link($this->Html->tag('span', __('Unlock page', true)), '/wiki_pages/unlock/' . $alias, array(
			'class' => 'wiki-fold-button wiki-fold-unlock',
			'escape' => false,
		));
	}
	echo $this->Html->link($this->Html->tag('span', __('Add menú', true)), '/wiki_menu/add', array(
		'class' => 'wiki-fold-button wiki-fold-add',
		'escape' => false,
	));
	echo $this->Html->link($this->Html->tag('span', __('Manage menú', true)), '/wiki_menu/index', array(
		'class' => 'wiki-fold-button wiki-fold-manage',
		'escape' => false,
	));
	echo $this->Html->link($this->Html->tag('span', __('Manage pages', true)), '/wiki_pages/index', array(
		'class' => 'wiki-fold-button wiki-fold-pages',
		'escape' => false,
	));
	?>
	<br clear="all"/>
</div>

<div class="content-body">
	<div class='content-header'>
		<h1 class='caption'><?php echo $title ?></h1>
	</div>
	<?php
	$this->Wiki->render_content($content);
	?>
</div>

<hr/>
<div class='content-footer'>
	<?php
	$bytes = format_bytes($content_length, 'array');
	$bytes = $bytes['rounded'] . "<b>" . $bytes['unit'] . "</b>";
	printf(__('Word count: %s.', true), $content_numwords);
	printf(__('Size: %s. Last modified %s', true), $bytes, strftime("%c", strtotime($modified)));
	?>
</div>