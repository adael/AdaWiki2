<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>AdaWiki2</title>
		<?php
		echo "<link rel='stylesheet/less' type='text/css' href='{$this->webroot}/css/site.less'/>";
		echo $this->Html->script('less-1.1.3.min');
		#echo $this->Html->css('site');
		echo $this->Html->css('SexyButtons/sexybuttons');
		echo $this->Html->script('jquery.min.js');
		echo $scripts_for_layout;
		echo $this->Html->script('wiki.js');
		?>
	</head>
	<body>
		<?php echo $this->Session->flash(); ?>
		<div class="page-wrapper">
			<img class="page-logo" src="<?php echo $this->webroot ?>img/AdaWiki2.png" alt="AdaWiki2 - The Wiki"/>
			<div class="page-menu">
				<div class="main-menu">
					<?php
					if(!empty($mainmenu)){
						$_current_page_id = isset($this->params['named']['id']) ? $this->params['named']['id'] : null;
						foreach($mainmenu as $_menuitem){
							echo $this->Html->link($_menuitem['Menu']['title'], "/wiki/index/alias:{$_menuitem['Menu']['link']}", array(
								'class' => $_menuitem['Menu']['class'] . ($_menuitem['Menu']['link'] == $_current_page_id ? ' active' : ''),
							));
						}
					}
					?>
				</div>
				<?php
				echo $this->Html->link($this->Html->tag('span', __('Add menú', true)), '/wiki_menu/add', array(
					'class' => 'wiki-add-menu',
					'escape' => false,
				));
				?>
				<div class="page-menu-credits">
					<p>
						<a href="http://www.cakephp.org" target="_blank">
							<?php
							echo $this->Html->image('cake.icon.png', array(
								'alt' => __('Powered by CakePHP', true),
								'target' => '_blank',
							));
							echo $this->Html->image('cake.power.gif', array(
								'alt' => __('Powered by CakePHP', true),
								'target' => '_blank',
							));
							?>
						</a>
					</p>
					<p>
						<a href="http://www.axialis.com/free/icons" target="_blank">Icons</a> by <a href="http://www.axialis.com" target="_blank">Axialis Team</a>
					</p>
					<p>
						<a href="http://code.google.com/p/sexybuttons/" target="_blank">Buttons by Richard Davies</a>
					</p>
					<p>
						<?php
						$_s = $this->Html->image('lesscss.png', array(
							'alt' => __('Powered by Lesscss', true),
								));
						echo $this->Html->link($_s, "http://lesscss.org/", array(
							'target' => '_blank',
							'escape' => false,
						));
						?>
					</p>
				</div>
			</div>
			<div class='page-content'>
				<?php echo $content_for_layout ?>
			</div>
			<div class='page-footer'>
				<div class="page-footer-options">
					<?php
					if($this->params['action'] == 'index'){
						echo $this->Html->link(__('Print this page', true), '/wiki/index/print:1/alias:' . $this->params['named']['alias'], array(
							'class' => 'wiki-print-page',
						));
						echo " - ";
						echo __('Font:', true);
						echo '<a href="#" id="font-bigger">A</a> / <a href="#" id="font-smaller">a</a> / <a href="#" id="font-normal">' . __('Normal', true) . '</a>';
					}
					?>
				</div>
				<div class="page-footer-credits">
					<?php echo __("AdaWiki2 by ", true) ?> <a href="mailto:adaelxp@gmail.com">Carlos Gant</a>
				</div>
			</div>
		</div>
	</body>
</html>