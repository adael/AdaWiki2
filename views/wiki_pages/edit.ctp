<?php
/* @var $html HtmlHelper */
$html->css('/js/markitup/markitup/skins/simple/style', 'stylesheet', array('inline' => false));
$html->css('/js/markitup/markitup/sets/markdown/style', 'stylesheet', array('inline' => false));
$html->script('markitup/markitup/jquery.markitup', array('inline' => false));
$html->script('markitup/markitup/sets/markdown/set', array('inline' => false));

$html->scriptBlock("	$(document).ready(function(){
		mySettings.previewParserPath = '{$this->webroot}/wiki_pages/preview';
		$('#txtContentEdit').markItUp(mySettings).focus();
	});", array('inline' => false));

/* @var $form FormHelper */
echo $form->create(null, array(
	'url' => "/" . $this->params['url']['url'],
	'class' => 'big-form',
));

echo $form->error('id');
echo $form->error('alias');

echo $form->input('title', array(
	'label' => __('Title', true),
	'class' => 'caption',
	'size' => 50,
	'default' => ucfirst(str_replace('_', ' ', $alias)),
));

echo $form->input('content', array(
	'label' => __('Content', true),
	'class' => 'caption',
	'id' => 'txtContentEdit',
	'rows' => '15',
	'cols' => '80',
));

echo $form->hidden('Menu.id');

echo $form->input('Menu.pin', array(
	'label' => __('Pin in site menu', true),
	'type' => 'checkbox',
	'onclick' => '$("#menuStyleDiv").toggle(this.checked)',
));
echo $form->input('Menu.class', array(
	'label' => __('Menu style', true),
	'options' => $classes,
	'div' => array(
		'id' => 'menuStyleDiv',
		'style' => !empty($this->data['Menu']['pin']) ? '' : 'display: none;',
	),
));
?>
<div style="text-align: right;">
	<button type="submit" class="sexybutton sexysimple sexylarge"><span class="save"><?php echo __('Save', true); ?></span></button>
</div>
<?php
echo $form->end();