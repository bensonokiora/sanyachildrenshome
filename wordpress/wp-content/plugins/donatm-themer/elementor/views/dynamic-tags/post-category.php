<?php
	if (!defined('ABSPATH')) {
		exit; 
	}
	global $donatm_post;
	if (!$donatm_post){
		return;
	}
	?>
	
	<div class="post-category">
		<?php 
			if($settings['show_icon']){ 
				echo '<i class="far fa-folder-open"></i>';
			}
			echo get_the_category_list( ", ", '', $donatm_post->ID ) . '</span>';
		?>
	</div>      

