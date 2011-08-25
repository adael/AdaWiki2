<?php
$tabitems = array(
	array(
		'text' => __('Front', true),
		'link' => '/',
		'visible' => 1,
	),
	array(
		'text' => __('View', true),
		'link' => '/wiki/index/id:' . $this->params['named']['id'],
		'visible' => $this->params['named']['id'] != Configure::read('Wiki.front') && $this->params['named']['id'] != 'Help',
	),
	array(
		'text' => __('Edit', true),
		'link' => '/wiki/edit/id:' . $this->params['named']['id'],
		'visible' => true,
	),
	array(
		'text' => __('Help', true),
		'link' => '/wiki/index/id:Help',
		'visible' => true,
	)
);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>AdaWiki v2</title>
		<?php echo $this->Html->css('site'); ?>
		<?php echo $this->Html->css('SexyButtons/sexybuttons')?>
		<?php echo $this->Html->script('jquery.min.js'); ?>
		<?php echo $scripts_for_layout;?>
		<?php echo $this->Html->script('wiki.js'); ?>
	</head>
	<body>
		<div class="page-wrapper">
			<div class='page-header'>
				<div class="page-tabs">
					<?php
					foreach($tabitems as $item){
						if($item['visible']){
							$active = $item['link'] == ("/" . (preg_replace('/^\//', '', $this->params['url']['url'])));
							echo $this->Html->link($item['text'], $item['link'], array(
								'class' => 'tab' . ($active ? ' current' : ''),
							));
						}
					}
					?>
				</div>
				<div class="page-title">
					<?= $this->data['Page']['title'] ?> (<?= $this->params['action'] ?>)
				</div>
				<br class="clear"/>
			</div>
			<div class="page-shadow">
				<div class='page-content'>
					<?php echo $content_for_layout ?>
				</div>
				<div class='page-footer'>
					<div style="float: left;">
						<?php
						if($this->params['action'] == 'index'){
							echo $this->Html->link(__('Print', true), '/wiki/print/id:' . $this->params['named']['id']);
						}
						echo __('Font:', true);
						?>
						<a href="#" class="font-bigger">A</a> /
						<a href="#" class="font-smaller">a</a> /
						<a href="#" class="font-reset"><?= __('Normal', true) ?></a>
					</div>
					<div style="float:right;">
						Adawiki v1.0 Por <a href="mailto:adaelxp@gmail.com">Carlos Gant</a>
					</div>
					<br class="clear"/>
				</div>
			</div>
		</div>
	</body>
</html>