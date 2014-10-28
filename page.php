<?php get_header(); ?>
<!-- DEBUT page.php -->    

	<?php if(have_posts()) : ?>
	<?php while(have_posts()) : the_post(); ?>
    

    <div id="contenu">
        <div id="project-info" class="scroll post-<?php the_ID(); ?>">
            <div class="container">
                <h1 class="project-title"><span><?php the_title(); ?></span></h1>
                <?php the_content(); ?>
            </div>
        </div>
    
        <!--<div id="project-nav" class="nav">
            <div class="container">
                <?php $nav = transplant_nav();?>
                <button id="prev"><?php echo $nav->prev; ?></button>
                <button id="next"><?php echo $nav->next; ?></button>

                <?php if(get_field('facts')!='') : ?>
                <h2><?php the_field('facts_title');?></h2>
                <ul>
                    <?php
                        $tags = explode("\n",strip_tags(get_field('facts')));
                        foreach($tags as $tag){
                            echo "<li>$tag</li>";
                        }
                    ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>-->
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
    

<!-- FIN page.php -->
<?php get_footer(); ?>