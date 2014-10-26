<?php get_header(); ?>
<!-- DEBUT home.php -->

        <div id="contenu">
            <div id="category-info" class="scroll">
                <div class="container">
                    <h3><?php get_homepage_text();?></h3>
                </div>
            </div>
        </div>

        <div id="post_container"></div>

        <div id="galerie">
            <?php

			$idObj = get_term_by('slug', 'home', 'project_category');
			$current_cat_id = $idObj->term_id;

			?>
			<?php get_template_part('inc/wall'); ?>
        </div>



<!-- FIN home.php -->
<?php get_footer(); ?>