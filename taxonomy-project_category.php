<?php get_header(); ?>
    
<?php if(have_posts()) : ?>
<?php while(have_posts()) : the_post(); ?>	
    
    <?php $current_cat_id = intval($wp_the_query->queried_object_id); ?>
    
    <div id="player">
    	<div id="mosaic-wrapper" class="scroll-pane">
        
        
        <!-- GALERIE -->
        <ul class="mosaic">
        
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
    
    <div id="content" class="category">
        <div class="nav container">
                <span class="prev">&nbsp;</span> <span class="next"></span>
        </div>
        <div id="cat-<?php the_ID(); ?>" class="texte scroll-pane">
            <div class="container column">
    			<?php if (  get_field('presentation','project_category_'.$current_cat_id) )
						the_field('presentation','project_category_'.$current_cat_id); ?>
        	</div>
        </div>
    </div>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>