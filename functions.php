<?php 


$themename = "transplant";
$shortname = "tp";

add_action( 'after_setup_theme', 'transplant_setup' );


if ( ! function_exists( 'transplant_setup' ) ){

	function transplant_setup() {
		
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(300, 300, true);
		//add_image_size('small', 260, 145, true);
		add_image_size('midsize', 400, 400, true);
		/*add_image_size('movie', 530, 290, true);
		add_image_size('home', 865, 435, true);*/
		
		// Load up our theme options page and related code.
		//require( get_template_directory() . '/inc/theme_options.php' );
		require( get_template_directory() . '/functions-options.php' );
		add_action('admin_menu' , 'mytheme_add_admin'); 
		
		/*add_action("template_redirect", 'my_template_redirect');
		add_filter( 'post_class', 'mysite_post_class', 10, 3 );
		add_filter( 'gallery_style', 'remove_css_gal', 1);*/
		
		add_filter( 'gallery_style', 'remove_css_gal', 1);
				
		/*if ( function_exists('my_register_post_types') ){
			add_action( 'init', 'my_register_post_types' );
		}
		
		if ( function_exists('my_register_taxonomies') ){
			add_action( 'init', 'my_register_taxonomies' );
		}
		
		if ( function_exists('add_custom_background') ){
			add_custom_background();
		}
		
		if ( function_exists('add_streched_background') ){
			add_streched_background();
		}*/
		
		if ( function_exists('register_sidebar') ){
			register_sidebar( array('name'=>'bottom'));
			register_sidebar( array('name'=>'menu'));
		}
		
		/*
		if ( function_exists('my_connection_types') ){
			add_action('init', 'my_connection_types', 100);
		}*/

	}
}


if ( ! function_exists( 'attachment_toolbox' ) ){
	function attachment_toolbox($size = thumbnail) {
	
		if($images = get_children(array(
			'post_parent'    => get_the_ID(),
			'post_type'      => 'attachment',
			'numberposts'    => -1, // show all
			'post_status'    => null,
			'post_mime_type' => 'image',
		))) {
	
			echo '<ul class="mosaic">';
			$postcounter = 0;
	
			foreach($images as $image) {
				$attimg   = wp_get_attachment_image($image->ID,$size);
				$atturl   = wp_get_attachment_url($image->ID);
				$attlink  = get_attachment_link($image->ID);
				$postlink = get_permalink($image->post_parent);
				$atttitle = apply_filters('the_title',$image->post_title);
				$attcontent = ($image->post_content);
	
				echo '<li class="mosaic-item"><div class="mosaic-img">'.$attimg.'</div>';
				echo '<p class="mosaic-title">'.$atttitle.'</p>';
				echo '<p class="mosaic-content">'.$attcontent.'</p></li>';
				$postcounter++;
				/*if ($postcounter % 5 == 0) {;
					echo '<br class="clearboth" />';
					};*/
			}
	
			echo '</ul>';
		}
	}
}

if ( ! function_exists( 'remove_css_gal' ) ){
	function remove_css_gal(){
		return "\n" . '<div class="gallery">';
	}
}

if( !function_exists('get_homepage_text')){
	function get_homepage_text(){
		global $themename, $shortname, $options;
		
		if(get_option($shortname."_homepage_text"))
			echo get_option($shortname."_homepage_text");
	};
};




// Create theme options

$options = array (

		array(	"desc" => __("<h3>Custom options</h3>"),
				"type" => "nothing"),

		array(	"name" => __('Homepage text'),
				"desc" => __('The text that wil be shown on the home page'),
				"id" => $shortname."_homepage_text",
				"std" => "Transplant delivers effective design solutions and profiling for public interior spaces; from productive workspaces to hospitality and retail industries. The studio is dedicated to give each design a sense of meaning and personality. Integrating innovative materials into it's designs, Transplant is aiming for a sustainable design.",
				"type" => "textarea",
				"options" => array(	"rows" => "5",
									"cols" => "94") )
		/*		
		array(	"name" => __('Feedburner URL'),
				"desc" => __("Copy and paste your Feedburner URL, ie --> http://feeds2.feedburner.com/nometech"),
				"id" => $shortname."_feedburner",
				"std" => __(""),
				"typBibliotecae" => "textarea",
				"options" => array(	"rows" => "5",
									"cols" => "94") ),								
				
		array(	"name" => __(''),
				"desc" => __("<h3>With the options below, you can choose a layout for your blog. Select one only.</h3>"),
				"id" => $shortname."_layout",
				"std" => __("Below you've got the option to choose a layout. Check one box only."),
				"type" => "nothing"),						
				
		array(	"name" => __('Two column layout'),
				"desc" => __("A simple two column layout"),
				"id" => $shortname."_two_column",
				"std" => "true",
				"type" => "checkbox"),
				
		array(	"name" => __('Two column wide layout'),
				"desc" => __("Two columns, with a wider content area and smaller sidebar (590px expanded to 640px)"),
				"id" => $shortname."_two_column_wide",
				"std" => "false",
				"type" => "checkbox"),						
			
		array(	"name" => __('Two column really wide layout'),
				"desc" => __("Two columns with a massive content area and a sidebar only 135px wide."),
				"id" => $shortname."_two_column_really_wide",
				"std" => "false",
				"type" => "checkbox"),
				
		array(	"desc" => __("<h3>Choose elements on the homepage to display/hide</h3>"),
				"type" => "nothing"),	
				
		array(	"name" => __('Featured content'),
				"desc" => __("Hide the featured content?"),
				"id" => $shortname."_featured_content",
				"std" => "false",
				"type" => "checkbox"),
				
		array(	"name" => __('Two featured posts'),
				"desc" => __("Hide the two featured posts below the featured content?"),
				"id" => $shortname."_two_featured_posts",
				"std" => "false",
				"type" => "checkbox"),
				
		array(	"name" => __('Three featured posts'),
				"desc" => __("Hide three posts beneath the two featured posts?"),
				"id" => $shortname."_three_featured_posts",
				"std" => "false",
				"type" => "checkbox"),							
				
		array(	"desc" => __("<h3>Choose sidebar elements to display/not display</h3>"),
				"type" => "nothing"),	

		array(	"name" => __('Tabbed area'),
				"desc" => __("Hide the tabbed area?"),
				"id" => $shortname."_tabs",
				"std" => "false",
				"type" => "checkbox"),		

		array(	"name" => __('Recent comments'),
				"desc" => __("Hide recent comments?"),
				"id" => $shortname."_recent_comments",
				"std" => "false",
				"type" => "checkbox"),
				
		array(	"name" => __('Ad code at 300x250 size'),
				"desc" => __("Copy and paste into the box below your advert code 300x250 size, for displaying on the two column layout"),
				"id" => $shortname."_300_250_ad",
				"std" => __(""),
				"type" => "textarea",
				"options" => array(	"rows" => "5",
									"cols" => "94") ),		

		array(	"name" => __('Ad code at 250x200 size'),
				"desc" => __("Copy and paste into the box below your advert code 250x200 size, for displaying on the two column wide layout"),
				"id" => $shortname."_250_200_ad",
				"std" => __(""),
				"type" => "textarea",
				"options" => array(	"rows" => "5",
									"cols" => "94") ),	

		array(	"name" => __('Ad code at 125x125 size'),
				"desc" => __("Copy and paste into the box below your advert code 125x125 size, for displaying on the two column really wide layout."),
				"id" => $shortname."_125_125_ad",
				"std" => __(""),
				"type" => "textarea",
				"options" => array(	"rows" => "5",
									"cols" => "94") ),

		array(	"desc" => __("<h3>Customise the footer</h3>"),
				"type" => "nothing"),

		array(	"name" => __('Three column footer'),
				"desc" => __("Hide the three column footer?"),
				"id" => $shortname."_three_column_footer",
				"std" => "false",
				"type" => "checkbox"),							
				
		array(	"name" => __('Text in Footer'),
				"desc" => __("Fill out the box with the text you want to be displayed at the very bottom of the theme."),
				"id" => $shortname."_footer_text",
				"std" => __("&#169; 2009 Your Site Name &bull; Powered by WordPress"),
				"type" => "textarea",
				"options" => array(	"rows" => "5",
									"cols" => "94") ),
									
		array(	"name" => __('Analytics code'),
				"desc" => __("Paste your Google Analytics (or other tracking) code in the box below"),
				"id" => $shortname."_analytics",
				"std" => __(""),
				"type" => "textarea",
				"options" => array(	"rows" => "5",
									"cols" => "94") )*/
									
);