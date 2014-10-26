<?php get_header(); ?>
<!-- DEBUT single-project-category.php -->
    
	<?php if(have_posts()) : ?>
	<?php while(have_posts()) : the_post(); ?>
    
    <div id="player">
    	<div id="mosaic-wrapper" class="scroll-pane">
        <!-- GALERIE -->
        <?php //attachment_toolbox(); ?><h1> HELLO HELLO HELLO </h1>
        </div>
    </div>
    <div id="content" class="project">
        <div class="nav container">
        	
        </div>
        
        <div id="post-<?php the_ID(); ?>" class="texte">
            <div class="container column">
       
            
            	<h2><?php the_title(); ?></h2>
                <?php the_content(); ?>

            
        	</div>
        </div>
    </div>
    
	<?php endwhile; ?>
	<?php endif; ?>


<!-- FIN single-project-category.php -->
<?php get_footer(); ?>