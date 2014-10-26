<?php get_header(); ?>
<!-- DEBUT page-contact.php -->
    
	<?php if(have_posts()) : ?>
	<?php while(have_posts()) : the_post(); ?>
    
    <div id="player">
    	<div id="mosaic-wrapper" class="scroll-pane">
        <!-- GALERIE -->
       	<?php attachment_toolbox(); ?>
        </div>
    </div>
    <script type="text/javascript">
	$('img').load(function(){
		//alert('images ok');
		updateBlocSize();
		loadingReady();
	});
    </script>
    <div id="content">
        <div class="nav container">
        	<?php $nav = transplant_nav();?>
        	<span class="prev"><?php echo $nav->prev; ?></span> <span class="next"><?php echo $nav->next;  ?></span>
        </div>
        <div id="page-<?php the_ID(); ?>" class="texte contact">
            <div class="column container">
    
			    <div class="half left">                 
                	<?php the_content(); ?>
				</div>
                
                <div class="half right">                 
                <?php the_field('address'); ?>
				</div>
                
            	<div class="reset"></div>
        	</div>
        </div>
    </div>
    
	<?php endwhile; ?>
	<?php endif; ?>
    

<!-- FIN page-contact.php -->
<?php get_footer(); ?>