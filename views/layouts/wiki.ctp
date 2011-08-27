<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>AdaWiki2</title>
		<?php echo $this->Html->css('site'); ?>
		<?php echo $this->Html->css('SexyButtons/sexybuttons') ?>
		<?php echo $this->Html->script('jquery.min.js'); ?>
		<?php echo $scripts_for_layout; ?>
		<?php echo $this->Html->script('wiki.js'); ?>
	</head>
	<body>
		<?php echo $this->Session->flash(); ?>
		<div class="page-wrapper">
			<img class="page-logo" src="<?= $this->webroot ?>img/AdaWiki2.png" alt="AdaWiki2 - The Wiki"/>
			<div class="page-menu">
				<div class="main-menu">
					<?php
					foreach($mainmenu as $_menuitem){
						echo $this->Html->link($_menuitem['Menu']['title'], "/wiki/index/id:{$_menuitem['Menu']['pages_id']}", array(
							'class' => $_menuitem['Menu']['class'] . ($_menuitem['Menu']['pages_id'] == $this->params['named']['id'] ? ' active' : ''),
						));
					}
					?>
				</div>

				<div class="page-menu-credits">
					<?php

					echo $this->Html->image('cake.icon.png', array(
						'alt' => __('Powered by CakePHP', true),
					));
					echo $this->Html->image('cake.power.gif', array(
						'alt' => __('Powered by CakePHP', true),
					));
					?>
					<br/>
					<a href="http://www.axialis.com/free/icons">Icons</a> by <a href="http://www.axialis.com">Axialis Team</a>
					<br/>
				</div>
			</div>
			<div class='page-content'>
				<?php echo $content_for_layout ?>
			</div>
			<div class='page-footer'>
				<div class="page-footer-options">
					<?php
					if($this->params['action'] == 'index'){
						echo $this->Html->link(__('Print', true), '/wiki/index/print:1/id:' . $this->params['named']['id']);
					}
					echo " - ";
					echo __('Font:', true);
					?>
					<a href="#" class="font-bigger">A</a> /
					<a href="#" class="font-smaller">a</a> /
					<a href="#" class="font-reset"><?= __('Normal', true) ?></a>
				</div>
				<div class="page-footer-credits">
					<?php echo __("AdaWiki2 by ", true)?> <a href="mailto:adaelxp@gmail.com">Carlos Gant</a>
				</div>
			</div>
		</div>
	</body>
</html>