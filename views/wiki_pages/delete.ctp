<?php
echo $this->Html->tag('h1', __('Are you sure you wan to delete this page?', true));
echo $this->Form->create(array('class' => 'big-form'));
echo $this->Form->hidden('id');
echo $this->Form->input('title', array(
	'label' => __('Title', true),
	'size' => 50,
));
?>
<div style="text-align: right;">
	<a href="<?php echo $this->Html->url('/wiki_pages/index') ?>" class="sexybutton sexysimple sexylarge">
		<span class="cancel"><?php echo __('Cancel', true); ?></span>
	</a>
	<button type="submit" class="sexybutton sexysimple sexylarge">
		<span class="delete"><?php echo __('Delete', true); ?></span>
	</button>
</div>
<?php
echo $this->Form->end();