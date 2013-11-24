		<div class="postauthor">
        	<h3 class="additional"><?php _e('About the Author','vergo');?>: <?php the_author_posts_link(); ?></h3>
			<?php  echo get_avatar( get_the_author_meta('ID'), '75' );   ?>
 			<div class="authordesc"><?php the_author_meta('description'); ?></div>
		</div>