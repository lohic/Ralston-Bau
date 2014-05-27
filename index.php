<?php get_header(); ?>

	<?php //wp_reset_query();
	//global $query_string;
	//query_posts($query_string.'posts_per_page=1'); ?>
    
   <?php if(have_posts()) : ?>
	<?php while(have_posts()) : the_post(); ?>
    
	<div id="content">
    	<div id="player">
            <!-- GALERIE -->
            <?php attachment_toolbox(); ?>
        </div>
    </div>
    
	
	<div id="post-<?php the_ID(); ?>" class="text-container">
    
    	
    	<div class="navigation">
		<?php //posts_nav_link(' - ','page suivante','page pr&eacute;c&eacute;dente'); ?>
        <div class="prev"><?php previous_post_link('%link', 'Previous', TRUE) ?></div><div class="next"><?php next_post_link('%link', 'Next', TRUE) ?></div>
        </div>
        
        <div class="reset"></div>
    	
        <div class="texte">
    	<div>
        	<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
		</div>
        <div class= "post_content">
        	<div class="extrait"><?php the_excerpt(); ?></div>

        
        	<?php the_content(); ?>
            
            
            
        </div>
    	
        <div class="postmetadata"> 
		<?php the_time('j F Y') ?> par <?php the_author() ?> | 
		Cat&eacute;gorie: <?php the_category(', ') ?> | 
		<?php comments_popup_link('Pas de commentaires', '1 Commentaire', '% Commentaires'); ?> <?php edit_post_link('Editer', ' &#124; ', ''); ?>
		</div>
        </div>
    </div>
    
	<?php endwhile; ?>
	<?php endif; ?>

	 


<?php get_footer(); ?>