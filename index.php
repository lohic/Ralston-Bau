<?php get_header(); ?>
<!-- DEBUT index.php -->

	
    

    <div id="contenu">
        <div id="category-info" class="scroll">
            <div class="container">
                <h3><?php get_homepage_text();?></h3>
            </div>
        </div>
    </div>


    <?php if(have_posts()) : ?>
	<?php while(have_posts()) : the_post(); ?>

    <!--<div id="post_container">
        <div id="post">
        	<div class="content">
        		<div class="container">
    				<div class="close"><a href="<?php bloginfo('url'); ?>">Close</a></div>

    		        <h2><?php the_title(); ?></h2>    
    		    
    		        <?php the_content(); ?>
    	        </div>
    	    </div>
        </div>
    </div>-->

   	<?php endwhile; ?>
	<?php endif; ?>
    


    <div id="galerie">
        <?php

        $idObj = get_term_by('slug', 'home', 'project_category');
        $current_cat_id = $idObj->term_id;

        ?>
        <?php get_template_part('inc/wall'); ?>
    </div>

	
 

<!-- FIN index.php -->
 <?php get_footer(); ?>