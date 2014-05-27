<?php get_header(); ?>
    
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
    <div id="content" class="project">
        <div class="nav container">
        	<?php $nav = transplant_nav();?>
        	<span class="prev"><?php echo $nav->prev; ?></span> <span class="next"><?php echo $nav->next;  ?></span>
        </div>
        <div id="post-<?php the_ID(); ?>" class="texte scroll-pane">
            <div class="container column">
       
            
            	<h2 class="project-title"><?php the_title(); ?></h2>
                <?php the_content(); ?>

            
        	</div>
        </div>
        <div class="description">
        	<div class="container">
            	<?php if(get_field('mission')!=''){ ?>
                <h2><?php the_field('client_name');?></h2>
                <ul>
                <?php
                    $tags = explode("\n",strip_tags(get_field('mission')));
                    foreach($tags as $tag){
                        echo "<li>$tag</li>";
                    }
                ?>
                </ul>
                <?php } ?>
            </div>
        </div>
    </div>
    
	<?php endwhile; ?>
	<?php endif; ?>
    
<?php get_footer(); ?>