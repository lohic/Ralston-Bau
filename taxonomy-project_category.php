<?php get_header(); ?>
<!-- DEBUT taxonomy-project_category.php -->
    
<?php if(have_posts()) : ?>
<?php while(have_posts()) : the_post(); ?>	
    
    <?php $current_cat_id = intval($wp_the_query->queried_object_id); ?>
    

    <div id="contenu">
		<div id="category-info" class="scroll">
			<div class="container">
				<h3><?php if (  get_field('presentation','project_category_'.$current_cat_id) )
				the_field('presentation','project_category_'.$current_cat_id); ?></h3>
			</div>
		</div>
	</div>

    <div id="post_container"></div>

	<div id="galerie">
        <?php get_template_part('inc/wall'); ?>
    </div>



    

<?php endwhile; ?>
<?php endif; ?>

<!-- FIN taxonomy-project_category.php -->
<?php get_footer(); ?>