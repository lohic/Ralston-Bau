<?php get_header(); ?>


 <?php //get_homepage_text();?>
 
	<?php //wp_reset_query();
	//global $query_string;
	//query_posts($query_string.'posts_per_page=1'); ?>
    
	<?php //if(have_posts()) : ?>
	<?php //while(have_posts()) : the_post(); ?>
    
	
    <div id="player" class="scroll-pane">
        <!-- GALERIE -->
        <ul class="mosaic">
        <?php 
		
		global $wp_query;
		$args = array_merge( $wp_query->query, array( 'post_type' => 'project', 'posts_per_page' => '-1'  ) );
		query_posts( $args );
		
		if(have_posts()) : ?>
		<?php while(have_posts()) : the_post(); ?>
        
        	<?php
            
			if(get_field('title_position')=='BR'){
				$theposition = 'position:absolute;bottom:0;right:0;';	
			}else{
				$theposition = '';	
			}
			
			switch(get_field('thumbnail_size')){
					case '1x1' :
						$thumbsize = 'thumbnail';
					break;
					case '1x2' :
						$thumbsize = '1x2';
					break;
					case '2x2' :
						$thumbsize = 'medium';
					break;
					/*case '3x2' :
						$thumbsize = '3x2';
					break;*/
					case '2x3' :
						$thumbsize = 'large';
					break;
					default :
						$thumbsize = 'small';
					break;
			}
			
			$image_id	= get_post_thumbnail_id();
			
			if($image_id){
				$thumb_url	= wp_get_attachment_image_src($image_id,$thumbsize, true);
				$thumb		= $thumb_url[0];			
							
				$thebackdrop = "background:url($thumb);";
			}else{
				$thebackdrop = '';
			}
			?>
        
       		<li class="mosaic-item">
            	<div class="box<?php the_field('thumbnail_size'); ?>" style="<?php echo $thebackdrop; ?>" >
        			<h2 style="<?php echo $theposition; ?>"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" style="color:<?php the_field('title_color'); ?>!important;"><?php the_title();?></a></h2>
            	</div>
        	</li>
        <?php endwhile; ?>
		<?php endif; ?>
        
         </ul>
    </div>
    <div id="content">
        <div class="nav">
        	<div class="prev"><?php previous_post_link('%link', 'Previous', TRUE) ?></div><div class="next"><?php next_post_link('%link', 'Next', TRUE) ?></div>
            <?php //posts_nav_link(' - ','page suivante','page pr&eacute;c&eacute;dente'); ?>
        </div>
        <div class="description">
            <div class="container">
                <h2><?php single_cat_title(); ?></h2>
                
                <ul>
                <?php	
                    // AFFICHER LES TAGS			
                    $current_cat_id = $wp_the_query->queried_object_id;
                    // Get the custom fields based on the $presenter term ID
                    $project_category_tags_custom_fields = get_option( "taxonomy_term_$current_cat_id" );
                    // Return the value for the "presenter_id" custom field
                    $project_category_tags_data = $project_category_tags_custom_fields[project_category_tags]; // Get their data
                    $tags = explode(',',$project_category_tags_data);
                    foreach($tags as $tag){
                        echo "<li>$tag</li>";
                    }
                ?>
                </ul>
            </div>
        </div>
        <div id="post-<?php the_ID(); ?>" class="texte">
            <div class="container nocolumn">
    			<?php
						$category_description = category_description();
						if ( ! empty( $category_description ) )
							echo $category_description;
					?>

            
        	</div>
        </div>
    </div>
    
	<?php //endwhile; ?>
	<?php //endif; ?>
    
    <div class="reset"></div>
</div>


<?php get_footer(); ?>