<?

/* @var $html HtmlHelper */
$html->css('/js/markitup/markitup/skins/simple/style', 'stylesheet', array('inline' => false));
$html->css('/js/markitup/markitup/sets/markdown/style', 'stylesheet', array('inline' => false));
$html->script('markitup/markitup/jquery.markitup', array('inline' => false));
$html->script('markitup/markitup/sets/markdown/set', array('inline' => false));

$html->scriptBlock("	$(document).ready(function(){
		$('#txtContentEdit').markItUp(mySettings);
	});", array('inline' => false));

/* @var $form FormHelper */
echo $form->create(null, array(
	'url' => "/" . $this->params['url']['url'],
	'id' => 'PageEditForm',
));

echo $form->input('title', array(
	'label' => __('Title', true),
	'size' => 50,
));

echo $form->input('content', array(
	'label' => __('Content', true),
	'id' => 'txtContentEdit',
	'rows' => '25',
	'cols' => '80',
));

echo '<button type="submit" class="sexybutton sexysimple sexylarge"><span class="save">' . __('Save', true) . '</span></button>';

echo $form->end();
