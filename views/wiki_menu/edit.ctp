<?php
echo $this->Form->create(null, array(
	'url' => "/" . $this->params['url']['url'],
	'class' => 'big-form',
));
echo $this->Form->hidden('id');
echo $this->Form->input('title', array(
	'label' => __('Title', true),
	'size' => 50,
));
echo $this->Form->input('link', array(
	'type' => 'text',
	'label' => __('Alias or link', true),
));
echo $this->Form->input('link_type', array(
	'label' => __('Link type', true),
	'after' => $this->Html->tag('p', __('Page: Alias for wiki page (invalid chars will be removed). Internal: for controllers or plugins. External: for links to other sites.', true)),
));
echo $this->Form->input('class', array(
	'label' => __('Style', true),
));
echo "<div style='text-align: right;'>";
echo $this->Html->link($this->Html->tag('span', __('Cancel', true), array('class' => 'cancel')), '/wiki_menu/index', array(
	'class' => 'sexybutton sexysimple sexylarge',
	'escape' => false,
));
echo " ";
echo '<button type="submit" class="sexybutton sexysimple sexylarge"><span class="save">' . __('Save', true) . '</span></button>';
echo "</div>";
echo $this->Form->end();