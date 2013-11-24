<?php
/*
Template Name: Full Width
*/
?>
<?php get_header(); ?>

<div id="core">
    
        <div class="fullsingle">
    
            <div <?php post_class(); ?> style="padding-bottom:10px; margin-bottom:3px;">
                
                <div class="fullentry">
                <h2 class="post"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    
                        <?php the_content(); ?>
                                
                        <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
                                
                    <?php endwhile; endif; ?>
                    
                </div>
                    
        </div>
            
        <div style="clear: both;"></div>

</div>

<?php get_footer(); ?>