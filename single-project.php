<?php get_header(); ?>
<!-- DEBUT single-project.php -->
    
	<?php if(have_posts()) : ?>
	<?php while(have_posts()) : the_post(); ?>

    <div id="contenu">
        <div id="project-info" class="scroll post-<?php the_ID(); ?>">
            <div class="container">
                <h1 class="project-title"><span><?php the_title(); ?></span></h1>
                <?php the_content(); ?>
            </div>
        </div>

        <?php $nav = transplant_nav();?>
        <?php if( $nav->prev !== false || $nav->next !== false || get_field('mission')!='' || get_field('client_name')!='' ) : ?>
        <div id="project-nav" class="nav">
            <div class="container">
        		
                <?php if($nav->prev !== false || $nav->next !== false) : ?>
                <div id="navbuttons" class="clearfix">
                    <?php if($nav->prev !== false){ ?>
                    <span id="prev" class="button"><?php echo $nav->prev; ?></span>
                    <?php } ?>
                    <?php if($nav->next !== false){ ?>
                    <span id="next" class="button"><?php echo $nav->next; ?></span>
                    <?php } ?>
                </div>
                <?php endif; ?>

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
        <?php endif; ?>
    </div>
 
    <div id="post_container"></div>

	<div id="galerie">
		<div id="horizontal">
			<?php attachment_toolbox(); ?>
		</div>
	</div>

   
    <script type="text/javascript">
    /*$('img').load(function(){
        //alert('images ok');
        updateBlocSize();
        loadingReady();
    });*/
    </script>


    
	<?php endwhile; ?>
	<?php endif; ?>
    
<!-- FIN single-project.php -->
<?php get_footer(); ?>