<?php 


$themename = "transplant";
$shortname = "tp";

add_action( 'after_setup_theme', 'transplant_setup' );

/**
 * 
 */
if ( ! function_exists( 'transplant_setup' ) ){

	function transplant_setup() {
		
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(350, 220, true);
		
		//add_image_size('1x1', 220, 220, true);	// >> small
		//add_image_size('1x2', 220, 445, true);
		
		add_image_size('1x2', 350, 445, true);
		//add_image_size('3x1', 670, 220, true);	// >> medium
		//**add_image_size('3x2', 670, 445, true);
		//add_image_size('3x3', 670, 670, true);	// >> large
		add_image_size('Hgallery', 9999, 670, false); // >> Hgallery
		
		// Load up our theme options page and related code.;
		require( get_template_directory() . '/functions-options.php' );
		add_action('admin_menu' , 'mytheme_add_admin'); 
				
		if ( function_exists( 'register_nav_menus' ) ) {
			register_nav_menus(
				array(
				  'main_menu' => 'Main Transplant menu',
				  'foot_menu' => 'Footer menu'
				)
			);
		}
		
		if ( function_exists('register_sidebar') ) {
			register_sidebar();
		}
		
		if ( function_exists('my_register_post_types') )	add_action( 'init', 'my_register_post_types' );
				
		// Add the fields to the "presenters" taxonomy, using our callback function
		//require( get_template_directory() . '/functions-project-category-meta.php' );
		
		if ( function_exists('my_register_taxonomies') )	add_action( 'init', 'my_register_taxonomies' );
		//if ( function_exists('project_category_add_taxonomy_custom_fields') )	add_action( 'project_category_add_form_fields', 'project_category_add_taxonomy_custom_fields', 10, 2 );
		//if ( function_exists('project_category_taxonomy_custom_fields') )		add_action( 'project_category_edit_form_fields', 'project_category_taxonomy_custom_fields', 10, 2 );
				 
		// Save the changes made on the "presenters" taxonomy, using our callback function
		//add_action( 'edited_project_category', 'save_taxonomy_custom_fields', 10, 2 );
		
		if ( function_exists('my_scripts_method') )			add_action( 'wp_enqueue_scripts', 'my_scripts_method' ); 
	}
}


/**
 * wp_enqueue_scripts action hook to link only on the front-end
 * @return [type] [description]
 */
function my_scripts_method() {
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'jquery-ui-core' );
    wp_enqueue_script( 'modernizr',		get_template_directory_uri() . '/js/modernizr.js',
		array(), '2.8.3', false);
	/*wp_enqueue_script( 'jquery-ui',     get_template_directory_uri() . '/js/jquery-ui-1.8.20.custom.min.js',
		array('jquery'), '1.8.20', true );*/
	wp_enqueue_script( 'migrate',		get_template_directory_uri() . '/js/jquery-migrate-1.2.1.min.js',
		array('jquery'), '1.2.1', true);
	/*wp_enqueue_script( 'getdompath',		get_template_directory_uri() . '/js/jquery.dom.path.js',
		array('jquery'), '1.0', true);*/
	/*wp_enqueue_script( 'address',     	get_template_directory_uri() . '/js/jquery.address-1.4.min.js',
		array('jquery','migrate'), '1.4', true );*/
	wp_enqueue_script( 'resizend',     	get_template_directory_uri() . '/js/jquery.resizend.js',
		array('jquery'), '1', true );
	wp_enqueue_script( 'freewall',     	get_template_directory_uri() . '/js/freewall.js',
		array('jquery'), '1.0.4', true );
	wp_enqueue_script( 'fitvids',     	get_template_directory_uri() . '/js/jquery.fitvids.js',
		array('jquery'), '1.1', true );
	wp_enqueue_script( 'history',		get_template_directory_uri() . '/js/jquery.history.js',
		array('jquery'), '1', true );
	wp_enqueue_script( 'mousewheel',    get_template_directory_uri() . '/js/jquery.mousewheel.js',
		array('jquery'), '3.1.9', true );
	wp_enqueue_script( 'mwheelIntent',    get_template_directory_uri() . '/js/mwheelIntent.js',
		array('mousewheel'), '1.2', true );
	wp_enqueue_script( 'jscrollpane',   get_template_directory_uri() . '/js/jquery.jscrollpane.min.js',
		array('jquery','mousewheel','mwheelIntent'), '2.0.19', true );
	wp_enqueue_script( 'imagesloaded',   get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js',
		array('jquery'), '3.1.8', true );
	/*wp_enqueue_script( 'slides',     	get_template_directory_uri() . '/js/slides.min.jquery.js',
		array('jquery'), '1.1.9', true );*/
	wp_enqueue_script( 'bxslider',     	get_template_directory_uri() . '/js/bxslider/jquery.bxslider.min.js',
		array('jquery'), '4.1.2', true );
	/*wp_enqueue_script( 'scrollsync',    get_template_directory_uri() . '/js/scrollsync.js',
		array('jquery'), '1.0', true );*/
	/*wp_enqueue_script( 'dragscrollable',get_template_directory_uri() . '/js/dragscrollable.js',
		array('jquery'), '1.0', true );*/
	wp_enqueue_script( 'ralstonbau',    get_template_directory_uri() . '/js/script.js',
		array('jquery', 'modernizr', 'migrate', 'jquery-ui-core','resizend','freewall','history','jscrollpane','bxslider', 'imagesloaded'),'1.1.4', true );
}



/**
 * CREATE A GALLERY
 */
if ( ! function_exists( 'attachment_toolbox' ) ){
	function attachment_toolbox($size = Hgallery) {
	
		if($images = get_children(array(
			'post_parent'    => get_the_ID(),
			'post_type'      => 'attachment',
			'numberposts'    => -1, // show all
			'post_status'    => null,
			'post_mime_type' => 'image',
			'orderby'		 => 'menu_order',
			'order'			 => 'ASC',
		))) {
	
			//echo '<ul class="mosaic overview">'."\n";
			$postcounter = 0;
	
	
			foreach($images as $image) {
				/*$default_attr = array(
					'src'	=> $src,
					'class'	=> "youpi attachment-$size",
					'alt'   => '',//trim(strip_tags( get_post_meta($attachment_id, '_wp_attachment_image_alt', true) )),
					'title' => ''//trim(strip_tags( $attachment->post_title )),
				);*/
				
				$dim = wp_get_attachment_image_src($image->ID,$size);
				
				$default_attr = array(
					//'src'	=> $src,
					'class'	=> "attachment-$size",
					'alt'   => trim(strip_tags( get_post_meta($attachment_id, '_wp_attachment_image_alt', true) )),
					'title' => '',
					'ratio' => $dim[1]/$dim[2],
				);
				
				
				$alt = get_post_meta($image->ID, '_wp_attachment_image_alt', true);
				
				
				$attimg   = wp_get_attachment_image($image->ID,$size,0,$default_attr);
				$atturl   = wp_get_attachment_url($image->ID);
				$attlink  = get_attachment_link($image->ID);
				$postlink = get_permalink($image->post_parent);
				$atttitle = apply_filters('the_title',$image->post_title);
				$vimeo_id = get_post_meta($image->ID, 'tqmcf_vimeo_id', true);
				$vimeo_id = !empty($vimeo_id)?'vimeo="'.$vimeo_id.'"':'';
				$video_id = get_post_meta($image->ID, 'tqmcf_video_id', true);
				$video_id = !empty($video_id)?'video="'.$video_id.'"':'';
				$video_platform = get_post_meta($image->ID, 'tqmcf_video_platform', true);
				$video_platform = !empty($video_platform)?'platform="'.$video_platform.'"':'';
				
				
				$attcontent = ($image->post_content);
	
				if($alt != 'hide' && $alt != 'webcam'){

					echo "<div class='image'>
						$attimg
					</div>";

					//echo '<li class="mosaic-item gallery-img">'."\n".'<div class="mosaic-img" '.$video_id.' '.$video_platform.'>'."\n".$attimg."\n".'</div>'."\n";
					//echo '<p class="mosaic-title">'.$atttitle.'</p>'."\n";
					//echo '<p class="mosaic-content">'.$attcontent.'</p></li>'."\n";
					
				}else if($alt=='webcam'){

					echo "<div class='image'>
						$attimg
					</div>";
			
					//echo '<li class="mosaic-item gallery-img">'."\n".'<div class="mosaic-img webcam">'.$attimg."\n".'<div>'."\n";
					//echo '<p class="mosaic-title">'.$atttitle.'</p>'."\n";
					//echo '<p class="mosaic-content">'.$attcontent.'</p></li>'."\n";
					
				}
				$postcounter++;
			}
	
			//echo '</ul>'."\n";
		}
	}
}

/**
 * 
 */
if( ! function_exists (my_register_post_types)) {
	function my_register_post_types() {
		register_post_type(
			'project',
			array(
				'label' => __('Projects'),
				'singular_label' => __('Project'),
				'public' => true,
				'show_ui' => true,
				//'show_in_menu' => false,
				'menu_icon'=> get_bloginfo('template_directory') .'/images/favicon.png',
				'show_in_nav_menus'=> false,
				'capability_type' => 'page',
				'rewrite' => array("slug" => "project"),
				'hierarchical' => false,
				'query_var' => false,
				'supports' => array('title','editor','custom-fields','page-attributes','thumbnail'),
				//'taxonomies' => 
			)
		);		
	}
}

/**
 * 
 */
if( ! function_exists (my_register_taxonomies)) {
	function my_register_taxonomies() {
	
		$labels = array(
			'name' => _x( 'Projects categories', 'taxonomy general name' ),
			'singular_name' => _x( 'Projects categorie', 'taxonomy singular name' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			//'show_ui' => false,
			'menu_name' => __( 'Projects categories' ),
		); 
	
		register_taxonomy('project_category','project',array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'show_in_nav_menus' => true,
			'rewrite' => array( 'slug' => 'project_category' ),
		));
	}
}


// Create theme options

/**
 * 
 */
if( !function_exists('get_homepage_text')){
	function get_homepage_text(){
		global $themename, $shortname, $options;
		
		if(get_option($shortname."_homepage_text"))
			echo stripslashes(get_option($shortname."_homepage_text"));
	};
};

/**
 * 
 */
if( !function_exists('get_twitter')){
	function get_twitter(){
		global $themename, $shortname, $options;
		
		if(get_option($shortname."_twitter_URL"))
			return get_option($shortname."_twitter_URL");
	};
};

/**
 * 
 */
if( !function_exists('get_facebook')){
	function get_facebook(){
		global $themename, $shortname, $options;
		
		if(get_option($shortname."_facebook_URL"))
			return get_option($shortname."_facebook_URL");
	};
};



$options = array (

		array(	"desc"	=> __("<h3>Custom options</h3>"),
				"type"	=> "nothing"),

		array(	"name" 	=> __('Homepage text'),
				"desc"	=> __('The text that wil be shown on the home page'),
				"id"	=> $shortname."_homepage_text",
				"std"	=> "Transplant delivers effective design solutions and profiling for public interior spaces; from productive workspaces to hospitality and retail industries. The studio is dedicated to give each design a sense of meaning and personality. Integrating innovative materials into it's designs, Transplant is aiming for a sustainable design.",
				"type"	=> "textarea",
				"options" => array(	"rows" => "5",
									"cols" => "94") ),
									
		array(	"name"	=> __('Twitter address'),
				"desc"	=> __('Tranplant twitter account URL'),
				"id"	=> $shortname."_twitter_URL",
				"std"	=> '',
				"type"	=> "text"),
				
		array(	"name"	=> __('Facebook address'),
				"desc"	=> __('Tranplant facebook account URL'),
				"id"	=> $shortname."_facebook_URL",
				"std"	=> '',
				"type"	=> "text")									
);


		

/**
 * [transplant_nav description]
 * @return [type] [description]
 */
function transplant_nav(){
	$postID = get_the_ID();
	
	$terms = get_the_terms( $postID, 'project_category' );

	$liste = array();
	if($terms){
		foreach ( $terms as $term ) {
			$project_category_id = $term->term_id;

			if( have_rows('projects_movie','project_category_'.$project_category_id) ):
	
				while ( have_rows('projects_movie','project_category_'.$project_category_id) ) : the_row(); 

					if( get_row_layout() == 'project' ):  $post_object = get_sub_field('the_project');

						$liste[] = $post_object->ID;
					
					elseif( get_row_layout() == 'movie' ):  
							// rien
					endif; 
				endwhile; 
			endif;
	
			//$listeB = get_objects_in_term_new( $project_category_id, 'project_category');
			//$liste  = array_merge($liste, $listeB);
		}
	}
	
	$nbr	= count($liste);
	$idnext = -1;
	$idprev = -1;
	
	for($i=0;$i<$nbr;$i++){
		//echo '  -  '.intval($liste[$i]).'?'.intval($postID).' : ';
		
		if( intval($postID) == intval($liste[$i])){
			//echo 'OK ';
			$idprev = isset($liste[$i-1])?$liste[$i-1]:-1;
			$idnext = isset($liste[$i+1])?$liste[$i+1]:-1;
			//break;
		}
	}
	
	$retour = new stdClass();
	
	if($idnext  != -1){
		$link = get_permalink($idnext);
	
		$retour->next =  "<a href='$link'>&rarr;</a>";
	}else{
		$retour->next = false;
	}

	if($idprev  != -1){
		$link = get_permalink($idprev);
	
		$retour->prev = "<a href='$link'>&larr;</a>";
	}else{
		$retour->prev = false;
	}
	
	return $retour;
}


/**
 * [get_objects_in_term_new description]
 * @param  [type] $term_ids   [description]
 * @param  [type] $taxonomies [description]
 * @param  array  $args       [description]
 * @return [type]             [description]
 */
function get_objects_in_term_new( $term_ids, $taxonomies, $args = array() ) {
		global $wpdb;

		if ( ! is_array( $term_ids ) )
				$term_ids = array( $term_ids );

		if ( ! is_array( $taxonomies ) )
				$taxonomies = array( $taxonomies );

		foreach ( (array) $taxonomies as $taxonomy ) {
				if ( ! taxonomy_exists( $taxonomy ) )
						return new WP_Error( 'invalid_taxonomy', __( 'Invalid Taxonomy' ) );
		}

		$defaults = array( 'order' => 'ASC' );
		$args = wp_parse_args( $args, $defaults );
		extract( $args, EXTR_SKIP );

		$order = ( 'desc' == strtolower( $order ) ) ? 'DESC' : 'ASC';

		$term_ids = array_map('intval', $term_ids );

		$taxonomies = "'" . implode( "', '", $taxonomies ) . "'";
		$term_ids = "'" . implode( "', '", $term_ids ) . "'";

		//$object_ids = $wpdb->get_col("SELECT tr.object_id FROM $wpdb->term_relationships AS tr INNER JOIN $wpdb->term_taxonomy AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id WHERE tt.taxonomy IN ($taxonomies) AND tt.term_id IN ($term_ids) ORDER BY tr.object_id $order");
		
		$object_ids = $wpdb->get_col("SELECT tr.object_id
										FROM $wpdb->term_relationships AS tr
										INNER JOIN $wpdb->term_taxonomy AS tt
											ON tr.term_taxonomy_id = tt.term_taxonomy_id
										INNER JOIN $wpdb->posts AS p
											ON tr.object_id = p.ID
										WHERE tt.taxonomy IN ($taxonomies)
											AND tt.term_id IN ($term_ids)
										ORDER BY p.menu_order $order, tr.object_id $order");

		if ( ! $object_ids )
				return array();

		return $object_ids;
}

