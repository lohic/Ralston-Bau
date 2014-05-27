<?php get_header(); ?>

    <div id="player">
    	<div id="mosaic-wrapper" class="scroll-pane">
        <ul class="mosaic">
        
     
            <li class="mosaic-item">
                <div class="box1x1 news" id="slides" >
                    <h2 style="TL" class="news-title">News</h2>
                    <div class="slides_container">
                    <?php 
                    
                    global $wp_query;
                    $args = array_merge( $wp_query->query, array( 'post_type' => 'post', 'posts_per_page' => '3','cat'=>'-23'  ) );
                    query_posts( $args );
                    
                    if(have_posts()) : ?>
                    <?php while(have_posts()) : the_post(); ?>
                        <div class="slide scroll-pane">
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
			$idObj = get_term_by('slug', 'home', 'project_category');
			$current_cat_id = $idObj->term_id;
		?>
        
        <?php if(get_field('linked_projects','project_category_'.$current_cat_id)): ?>
                
			<?php while(the_repeater_field('linked_projects','project_category_'.$current_cat_id)): ?>
            <li class="mosaic-item">
            
                <?php $post_object = get_sub_field('linked_project'); ?>
				<?php switch(get_sub_field('thumbnail_size')){
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
                
                if(get_field('title_position',$post_object->ID)=='BR'){
                    $theposition = 'position:absolute;bottom:0;right:0;';	
                }else{
                    $theposition = '';	
                }
                
                
                $image_id	= get_post_thumbnail_id($post_object->ID);
                
                if($image_id){
                    $thumb_url	= wp_get_attachment_image_src($image_id,$thumbsize, true);
                    $thumb		= $thumb_url[0];			
                                
                    $thebackdrop = "background:url($thumb);";
                }else{
                    $thebackdrop = '';
                }
                ?>
                
                <div class="box<?php the_sub_field('thumbnail_size'); ?> box" style="<?php echo $thebackdrop; ?>" >
					<div class="black"></div>
        			<h2 style="<?php echo $theposition; ?>"><a href="<?php echo get_permalink($post_object->ID); ?>" title="<?php echo get_the_title($post_object->ID); ?>" style="color:<?php the_field('title_color',$post_object->ID); ?>!important;"><?php echo get_the_title($post_object->ID);?></a></h2>
            	</div>

                
            </li>				
            <?php endwhile; ?>
        
        <?php endif; ?>
        </ul>
        </div>
    </div>
    <div id="content">
        <div class="nav container">
                <span class="prev">&nbsp;</span> <span class="next"></span>
        </div>
        <div id="homepage" class="texte">
            <div class="column container">
    
                <?php get_homepage_text();?>
            
        	</div>
        </div>
    </div>
    

    <div class="reset"></div>
</div>


<?php get_footer(); ?>