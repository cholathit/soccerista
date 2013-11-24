<div class="tickerwrap <?php if (get_option('vergo_ticker_res_mode') == 'false' ); else echo 'resmode-No'; ?>">

	<span><?php _e('Trending','vergo');?></span>
    
    <ul class="ticker">
    
		<?php $ticker_cat = get_cat_ID(get_option('vergo_ticker_category'));
        $my_query = new WP_Query( 'showposts=10&cat='. $ticker_cat .'');	 
        while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID; ?>
        
        <li><span><?php the_time('M j') ?> &rsaquo;</span><a href="<?php the_permalink(); ?>"> <?php the_title(); ?> &raquo;</a></li>
            
        <?php endwhile; ?><?php wp_reset_query(); ?>
        
    </ul>
    
    <?php get_template_part('/includes/uni-social'); ?>
    
</div>