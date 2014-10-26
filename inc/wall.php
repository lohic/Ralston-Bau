<!-- debut WALL.PHP -->

<?php global $current_cat_id; ?>

<div id="wall">

	<?php if ( is_home() || is_singular('post') ) : ?>
		<div class="item box1x1 news TL" id="slides" >
			<h2 class="news-title">News</h2>
			<div class="slides_container">
				<div class="bxslider">
				<?php 

				global $wp_query;
				$args = array_merge( $wp_query->query, array( 'post_type' => 'post', 'posts_per_page' => '10'  ) );
				query_posts( $args );

				if(have_posts()) : ?>
				<?php while(have_posts()) : the_post(); ?>
					<div class="slide scroll-pane">
						<p class="date"><?php the_time('j F Y') ?></p>
						<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
						<?php the_excerpt(); ?>
					</div>
				    
				    
				<?php endwhile; ?>
				<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>


	<?php if( have_rows('projects_movie','project_category_'.$current_cat_id) ): ?> 
		<?php while ( have_rows('projects_movie','project_category_'.$current_cat_id) ) : the_row(); ?>

			<?php  if( get_row_layout() == 'project' ): ?>

				<?php $post_object = get_sub_field('the_project'); ?>
				<?php switch(get_sub_field('grid_size')){
			            case '1x1' :
			                $thumbsize = 'thumbnail';
			            break;
			            case '1x2' :
			                $thumbsize = '1x2';
			            break;
			            case '2x2' :
			                $thumbsize = 'medium';
			            break;
			            case '2x3' :
			                $thumbsize = 'large';
			            break;
			            default :
			                $thumbsize = 'small';
			            break;
			    }?>
			    <?php 
			    
			    if(get_sub_field('title_position')=='BR'){
			        $theposition = 'position:absolute;bottom:0;right:0;';	
			    }else{
			        $theposition = '';	
			    }
			    
			    
			    $image_id	= get_post_thumbnail_id($post_object->ID);
			    
			    if($image_id){
			        $thumb_url	= wp_get_attachment_image_src($image_id,$thumbsize, true);
			        $thumb		= $thumb_url[0];			
			                    
			        $thebackground = "background-image:url($thumb);";
			    }else{
			        $thebackground = '';
			    }
			    ?>

			    <div class="item box<?php the_sub_field('grid_size'); ?> h2-black <?php the_field('title_position',$post_object->ID)?>">
					<a href="<?php echo get_permalink($post_object->ID); ?>" title="<?php echo get_the_title($post_object->ID); ?>">
						<div class="vignette" style="<?php echo $thebackground; ?>"></div>
						<div class="black"></div>
						<h2 style="color:<?php the_field('title_color',$post_object->ID); ?>!important;"><?php echo get_the_title($post_object->ID); ?></h2>
					</a>
				</div>

			<?php  elseif( get_row_layout() == 'movie' ):  ?>

				<div class="item box<?php the_sub_field('grid_size'); ?> video">
					<?php //the_sub_field('vimeo'); ?>

					<?php

						// get iframe HTML
						$iframe = get_sub_field('vimeo');


						// use preg_match to find iframe src
						preg_match('/src="(.+?)"/', $iframe, $matches);
						$src = $matches[1];


						// add extra params to iframe src
						$params = array(
						    'controls' => 0,
						    'hd'       => 1,
						    'autohide' => 1,
						    'autoplay' => get_sub_field('autoplay'),
						    'api'	   => 1
						);

						$new_src = add_query_arg($params, $src);

						$iframe = str_replace($src, $new_src, $iframe);


						// add extra attributes to iframe html
						$attributes = 'frameborder="0"';

						$iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);


						// echo $iframe
						echo $iframe;

					?>
				</div>

			<?php endif; ?>

	    <?php endwhile; ?>
	<?php endif; ?>
</div>

<!-- fin WALL.PHP -->