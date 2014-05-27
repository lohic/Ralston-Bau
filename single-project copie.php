<?php get_header(); ?>
    
	<?php if(have_posts()) : ?>
	<?php while(have_posts()) : the_post(); ?>
    
    <div id="player">
    	<div id="mosaic-wrapper" class="scroll-pane">
        <!-- GALERIE -->
        <?php attachment_toolbox(); ?>
        </div>
    </div>
    <div id="content" class="project">
        <div class="nav container">
        	<span class="prev"><?php
            previous_post_link_plus(array(
				'link'			=> 'previous',
				'format'		=> '%link',
				'before'		=> '',
				'in_same_tax'	=> true,
				'ex_cats'		=> '13', 
			)) ?></span> <span class="next"><?php next_post_link_plus(array(
				'link'			=> 'next',
				'format'		=> '| %link',
				'before'		=> '',
				'in_same_tax'	=> true,
				'ex_cats'		=> '13', 
			)) ?></span>
        </div>
        <!--<div class="description">
        	<div class="container">
            	<?php if(get_field('mission')!=''){ ?>
                <h2>Mission</h2>
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
        </div>-->
        <div id="post-<?php the_ID(); ?>" class="texte scroll-pane">
            <div class="container column">
       
            
            	<h2><?php the_title(); ?></h2>
                <?php the_content(); ?>

            
        	</div>
        </div>
    </div>
    
	<?php endwhile; ?>
	<?php endif; ?>
    
<?php get_footer(); ?>