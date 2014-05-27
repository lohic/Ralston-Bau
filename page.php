<?php get_header(); ?>


 <?php //get_homepage_text();?>
 
	<?php //wp_reset_query();
	//global $query_string;
	//query_posts($query_string.'posts_per_page=1'); ?>
    
	<?php if(have_posts()) : ?>
	<?php while(have_posts()) : the_post(); ?>
    

    <div id="player" class="scroll-pane">
        <!-- GALERIE -->
        <?php attachment_toolbox(); ?>
    </div>
    <div id="content">
        <div class="nav">
        	<div class="prev"><?php previous_post_link('%link', 'Previous', TRUE) ?></div><div class="next"><?php next_post_link('%link', 'Next', TRUE) ?></div>
            <?php //posts_nav_link(' - ','page suivante','page pr&eacute;c&eacute;dente'); ?>
        </div>
        <div class="description">
            
		</div>
        <div id="page-<?php the_ID(); ?>" class="texte">
            <div class="column container">
    

                <!--<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>-->
                     
                <?php the_content(); ?>

            
        	</div>
        </div>
    </div>
    
	<?php endwhile; ?>
	<?php endif; ?>
    
    <div class="reset"></div>
</div>


<?php get_footer(); ?>