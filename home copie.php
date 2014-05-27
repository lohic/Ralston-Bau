<?php get_header(); ?>


 
 
	<?php //wp_reset_query();
	//global $query_string;
	//query_posts($query_string.'posts_per_page=1'); ?>
    
	
    

    <div id="player">
    	<div id="mosaic-wrapper" class="scroll-pane">
        <ul class="mosaic">
        
        <li class="mosaic-item">
            	<div class="box1x1 news" id="slides" >
        			<h2 style="TL" class="news-title">News</h2>
                    <div class="slides_container">
                    <?php 
					
					global $wp_query;
					$args = array_merge( $wp_query->query, array( 'post_type' => 'post', 'posts_per_page' => '6'  ) );
					query_posts( $args );
					
					if(have_posts()) : ?>
					<?php while(have_posts()) : the_post(); ?>
                        <div class="slide">
                        	<p class="date"><?php the_time('j F Y') ?></p>
                            <h1><?php the_title(); ?></h1>
                            <?php the_content(); ?>
                        </div>
					<?php endwhile; ?>
                    <?php endif; ?>
                    </div>
            	</div>
        	</li>
        <?php 
		
		global $wp_query;
		$args = array_merge( $wp_query->query, array( 'post_type' => 'project', 'posts_per_page' => '-1', 'project_category' => 'home'  ) );
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
					case '3x1' :
						$thumbsize = 'medium';
					break;
					case '3x2' :
						$thumbsize = '3x2';
					break;
					case '3x3' :
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
            	<div class="box<?php the_field('thumbnail_size'); ?> box" style="<?php echo $thebackdrop; ?>" >
        			<h2 style="<?php echo $theposition; ?>"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" style="color:<?php the_field('title_color'); ?>!important;"><?php the_title();?></a></h2>
            	</div>
        	</li>
        <?php endwhile; ?>
		<?php endif; ?>
        </ul>
        </div>
    </div>
    <div id="content">
        <div id="homepage" class="texte">
            <div class="column container">
    

                <?php get_homepage_text();?>

            
        	</div>
        </div>
    </div>
    

    <div class="reset"></div>
</div>


<?php get_footer(); ?>