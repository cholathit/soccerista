<?php get_header(); ?>

<div id="core">

	<div id="content">

          <ul class="medpost">
          
                	<?php
						if ( get_query_var('paged') ) {
							$paged = get_query_var('paged');
						} else if ( get_query_var('page') ) {
							$paged = get_query_var('page');
						} else {
							$paged = 1;
						}
						query_posts( array( 'post_type' => 'post', 'paged' => $paged ) );
					?>
					<?php if (have_posts()) : ?>
                                        
                    <?php while (have_posts()) : the_post(); ?>
            
						<?php if(has_post_format('gallery'))  {
                            echo get_template_part( '/includes/post-types/medpost' );
                        }elseif(has_post_format('video')){
                            echo get_template_part( '/includes/post-types/medpost' );
                        }elseif(has_post_format('audio')){
                            echo get_template_part( '/includes/post-types/medpost' );
                        }elseif(has_post_format('image')){
                            echo get_template_part( '/includes/post-types/image' );
                        }elseif(has_post_format('link')){
                            echo get_template_part( '/includes/post-types/link' );
                        }elseif(has_post_format('quote')){
                            echo get_template_part( '/includes/post-types/quote' );
                            } else {
                            echo get_template_part( '/includes/post-types/medpost' );
                        }?>
                            
					<?php endwhile; ?><!-- end post -->
                    
           	</ul><!-- end latest posts section-->
            
            <div style="clear: both;"></div>

					<div class="pagination"><?php pagination('&laquo;', '&raquo;'); ?></div>

					<?php else : ?>
			

                        <h1>Sorry, no posts matched your criteria.</h1>
                        <?php get_search_form(); ?><br/>
					<?php endif; ?>

        </div><!-- end #core .eightcol-->

    
    
        <div id="sidebar">
        
        		<?php get_sidebar(); ?>
        
        </div>
        
    <div id="core_bg"></div>

</div><!-- #core -->

<?php get_footer(); ?>