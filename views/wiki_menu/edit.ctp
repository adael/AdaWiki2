<?php
/* @var $form FormHelper */
echo $form->create(null, array(
	'url' => "/" . $this->params['url']['url'],
	'class' => 'big-form',
));

echo $form->hidden('id');

echo $form->input('title', array(
	'label' => __('Title', true),
	'size' => 50,
));

echo $form->input('link', array(
	'type' => 'text',
	'label' => __('Alias or link', true),
));

echo $form->input('link_type', array(
	'label' => __('Link type', true),
	'after' => $this->Html->tag('p', __('Page: Alias for wiki page (invalid chars will be removed). Internal: for controllers or plugins. External: for links to other sites.', true)),
));

echo $form->input('class', array(
	'label' => __('Style', true),
));

echo '<button type="submit" class="sexybutton sexysimple sexylarge"><span class="save">' . __('Save', true) . '</span></button>';

echo $form->end();
