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
        <div class="nav container">
        	<span class="prev"><?php //previous_post_link_plus('%link', 'Previous', TRUE) ?></span> | <span class="next"><?php //next_post_link_plus('%link', 'Next', TRUE) ?></span>
            <?php //posts_nav_link(' - ','page suivante','page pr&eacute;c&eacute;dente'); ?>
        </div>
        <div class="description">
        	<div class="container">
                <!--<h2>Mission</h2>
                <ul>
                    <li>Scenography</li>
                    <li>Interior Architecture</li>
                    <li> Furniture Design</li>
                    <li>Product Design</li>
                    <li>Coopertae Identity</li>
                    <li>Packaging Design</li>
                    <li>Outside Design</li>
                </ul>-->
            </div>
        </div>
        <div id="post-<?php the_ID(); ?>" class="texte">
            <div class="container column">
    

                <!--<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>-->
                <?php //the_excerpt(); ?>
    			
                <!--<p><?php //the_field('title_color'); ?></p>
                <p><?php //the_field('thumbnail_size'); ?></p>-->
            
            	<h2><?php the_title(); ?></h2>
                <?php the_content(); ?>

            
        	</div>
        </div>
    </div>
    
	<?php endwhile; ?>
	<?php endif; ?>
    
    <div class="reset"></div>
</div>


<?php get_footer(); ?>