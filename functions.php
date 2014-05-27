<?php 


$themename = "transplant";
$shortname = "tp";

add_action( 'after_setup_theme', 'transplant_setup' );


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
		require( get_template_directory() . '/functions-project-category-meta.php' );
		add_action('admin_menu' , 'mytheme_add_admin'); 
				
		if ( function_exists( 'register_nav_menus' ) ) {
			register_nav_menus(
				array(
				  'main_menu' => 'Main Transplant menu',
				  'foot_menu' => 'Footer menu'
				)
			);
		}
		
		if ( function_exists('my_register_post_types') ){
			add_action( 'init', 'my_register_post_types' );
		}
		
		if ( function_exists('my_register_taxonomies') ){
			add_action( 'init', 'my_register_taxonomies' );
		}
		
		// Add the fields to the "presenters" taxonomy, using our callback function
		add_action( 'project_category_add_form_fields', 'project_category_add_taxonomy_custom_fields', 10, 2 );
		add_action( 'project_category_edit_form_fields', 'project_category_taxonomy_custom_fields', 10, 2 );
		 
		// Save the changes made on the "presenters" taxonomy, using our callback function
		add_action( 'edited_project_category', 'save_taxonomy_custom_fields', 10, 2 );
		
	}
}



// create a gallery
if ( ! function_exists( 'attachment_toolbox' ) ){
	function attachment_toolbox($size = Hgallery) {
	
		if($images = get_children(array(
			'post_parent'    => get_the_ID(),
			'post_type'      => 'attachment',
			'numberposts'    => -1, // show all
			'post_status'    => null,
			'post_mime_type' => 'image',
		))) {
	
			echo '<ul class="mosaic">'."\n";
			$postcounter = 0;
	
			foreach($images as $image) {
				$attimg   = wp_get_attachment_image($image->ID,$size);
				$atturl   = wp_get_attachment_url($image->ID);
				$attlink  = get_attachment_link($image->ID);
				$postlink = get_permalink($image->post_parent);
				$atttitle = apply_filters('the_title',$image->post_title);
				$attcontent = ($image->post_content);
	
				echo '<li class="mosaic-item">'."\n".'<div class="mosaic-img">'."\n".$attimg."\n".'</div>'."\n";
				echo '<p class="mosaic-title">'.$atttitle.'</p>'."\n";
				echo '<p class="mosaic-content">'.$attcontent.'</p></li>'."\n";
				$postcounter++;
			}
	
			echo '</ul>'."\n";
		}
	}
}


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
				//'menu_icon'=> URL
				'show_in_nav_menus'=> false,
				'capability_type' => 'post',
				'rewrite' => array("slug" => "project"),
				'hierarchical' => false,
				'query_var' => false,
				'supports' => array('title','editor','custom-fields','page-attributes','thumbnail'),
				//'taxonomies' => 
			)
		);
		
	}
}

if( ! function_exists (my_register_taxonomies)) {
	function my_register_taxonomies() {
	
		$labels = array(
			'name' => _x( 'Projects categories', 'taxonomy general name' ),
			'singular_name' => _x( 'Projects categorie', 'taxonomy singular name' ),
			'parent_item' => null,
			'parent_item_colon' => null,
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

if( !function_exists('get_homepage_text')){
	function get_homepage_text(){
		global $themename, $shortname, $options;
		
		if(get_option($shortname."_homepage_text"))
			echo stripslashes(get_option($shortname."_homepage_text"));
	};
};

if( !function_exists('get_twitter')){
	function get_twitter(){
		global $themename, $shortname, $options;
		
		if(get_option($shortname."_twitter_URL"))
			return get_option($shortname."_twitter_URL");
	};
};


if( !function_exists('get_facebook')){
	function get_facebook(){
		global $themename, $shortname, $options;
		
		if(get_option($shortname."_facebook_URL"))
			return get_option($shortname."_facebook_URL");
	};
};



$options = array (

		array(	"desc" => __("<h3>Custom options</h3>"),
				"type" => "nothing"),

		array(	"name" => __('Homepage text'),
				"desc" => __('The text that wil be shown on the home page'),
				"id" => $shortname."_homepage_text",
				"std" => "Transplant delivers effective design solutions and profiling for public interior spaces; from productive workspaces to hospitality and retail industries. The studio is dedicated to give each design a sense of meaning and personality. Integrating innovative materials into it's designs, Transplant is aiming for a sustainable design.",
				"type" => "textarea",
				"options" => array(	"rows" => "5",
									"cols" => "94") ),
									
		array(	"name" => __('Twitter address'),
				"desc" => __('Tranplant twitter account URL'),
				"id" => $shortname."_twitter_URL",
				"std" => '',
				"type" => "text"),
				
		array(	"name" => __('Facebook address'),
				"desc" => __('Tranplant facebook account URL'),
				"id" => $shortname."_facebook_URL",
				"std" => '',
				"type" => "text")									
);