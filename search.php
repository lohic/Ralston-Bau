<?php get_header(); ?>
    
<?php //if(have_posts()) : ?>
<?php //while(have_posts()) : the_post(); ?>	
    
    <?php //$current_cat_id = intval($wp_the_query->queried_object_id); ?>
    
    <div id="player">
    	<div id="mosaic-wrapper" class="scroll-pane">
        
        
        <!-- GALERIE -->
        <ul class="mosaic">
        
        <?php
		global $query_string;
		
		$query_args = explode("&", $query_string);
		$search_query = array();
		
		foreach($query_args as $key => $string) {
			$query_split = explode("=", $string);
			$search_query[$query_split[0]] = urldecode($query_split[1]);
		} // foreach
		
		$search_query['posts_per_page'] = '-1';
		$search_query['post_type'] = array('project');
		
		$search = new WP_Query($search_query);
		
		?>
        
        <?php if($search->have_posts()) : ?>
		<?php while($search->have_posts()) : $search->the_post(); ?>	

        
        <?php //if(get_field('linked_projects','project_category_'.$current_cat_id)): ?>
                
			<?php //while(the_repeater_field('linked_projects','project_category_'.$current_cat_id)): ?>
            <li class="mosaic-item">
            
                <?php $post_object = get_sub_field('linked_project'); ?>
				<?php $thumbsize = 'thumbnail';?>
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
                
                <div class="box1x1 box" style="<?php echo $thebackdrop; ?>" >
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
        <div id="search" class="texte scroll-pane">
            <div class="container column">
				<?php if($search->have_posts()) : ?>
                    Search Result for : <?php echo $_GET['s']; ?>.
                <?php else : ?>
                    No Result.
                <?php endif; ?> 
        	</div>
        </div>
    </div>

<?php //endwhile; ?>
<?php //endif; ?>

<?php get_footer(); ?>