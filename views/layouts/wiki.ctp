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
		echo $this->Html->css('sprites/icons-16');
		echo $this->Html->script('jquery.min.js');
		echo $scripts_for_layout;
		echo $this->Html->script('wiki.js');
		?>
	</head>
	<body>
		<?php
		echo $this->Session->flash();
		/*
		 * IE Advise
		 */
		if(isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)){
			echo "<div style='position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: YELLOW; COLOR: RED; padding: 10px; z-index:99999; text-align: center;'><h2>";
			echo __("Internet Explorer does not support CSS3 and some styles of CSS2's why I decided not to support my system to that browser. Please use another browser.", true);
			echo "</h2></div>";
		}
		?>
		<div class="page-wrapper">
			<?php
			echo $this->Html->link($this->Html->image('AdaWiki2.png', array('alt' => 'AdaWiki2 - The Wiki')), '/', array(
				'escape' => false,
				'class' => 'page-logo',
			));
			?>
			<div class="page-menu">
				<div class="main-menu">
					<?php
					if(!empty($mainmenu)){
						foreach($mainmenu as $_menuitem){
							$_active = '';
							$_target = '_self';
							switch($_menuitem['Menu']['link_type']){
								case 'page':
									$_link = "/wiki_pages/view/{$_menuitem['Menu']['link']}";
									if(isset($alias) && $_menuitem['Menu']['link'] == $alias){
										$_active = ' active';
									}
									break;
								case 'internal':
									$_link = $html->url($_menuitem['Menu']['link']);
									break;
								case 'external':
									$_link = $_menuitem['Menu']['link'];
									$_target = '_blank';
									break;
							}

							echo $this->Html->link($_menuitem['Menu']['title'], $_link, array(
								'class' => $_menuitem['Menu']['class'] . $_active,
								'target' => $_target,
							));
						}
					}
					?>
				</div>

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
					if(isset($alias) && $this->params['controller'] == 'wiki_pages' && $this->params['action'] == 'index'){
						echo $this->Html->link(__('Print this page', true), '/wiki_pages/printView/' . $alias, array(
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