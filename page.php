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
    <div id="content">
        <div class="nav container">
        	<?php $nav = transplant_nav();?>
        	<span class="prev"><?php echo $nav->prev; ?></span> <span class="next"><?php echo $nav->next;  ?></span>
        </div>
        <div id="page-<?php the_ID(); ?>" class="texte">
            <div class="column container">
    

                <!--<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>-->
                     
                <?php the_content(); ?>

            
        	</div>
        </div>
        <div class="description">
            <div class="container">
            	<?php if(get_field('facts')!=''){ ?>
                <h2><?php the_field('facts_title');?></h2>
                <ul>
                <?php
                    $tags = explode("\n",strip_tags(get_field('facts')));
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