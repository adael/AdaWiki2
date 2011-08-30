<?php

echo $this->Html->tag('h1', __('Are you sure you wan to delete this menu?', true));
echo $this->Form->create(array('class' => 'big-form'));
echo $this->Form->hidden('id');
echo $this->Form->input('title', array(
	'label' => __('Title', true),
	'size' => 50,
));
echo "<div style='text-align: right;'>";
echo $this->Html->link($this->Html->tag('span', __('Cancel', true), array('class' => 'cancel')), '/wiki_menu/index', array(
	'class' => 'sexybutton sexysimple sexylarge',
	'escape' => false,
));
echo ' <button type="submit" class="sexybutton sexysimple sexylarge"><span class="delete">' . __('Delete', true) . '</span></button>';
echo "</div>";
echo $this->Form->end();