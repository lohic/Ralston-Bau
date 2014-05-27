<!DOCTYPE HTML>
<html>
<head>
 
	<title><?php bloginfo('name') ?><?php if ( is_404() ) : ?> &raquo; <?php _e('Not Found') ?><?php elseif ( is_home() ) : ?> &raquo; <?php bloginfo('description') ?><?php else : ?><?php wp_title() ?><?php endif ?></title>
 
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
	<!-- leave this for stats -->
    <meta name="viewport" content="width=device-width, maximum-scale=1.0">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
    
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /><?php wp_head(); ?>
 
	<?php wp_get_archives('type=monthly&format=link'); ?>
	<?php //comments_popup_script(); // off by default ?>
	<?php wp_head(); ?>
 
</head>
<body>



<div id="main">

    <div id="page">
        
         <div id="menu">
            <div id="header">
                <h1  onclick="location.href='<?php bloginfo('url'); ?>';" style="cursor: pointer; " ><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
              
            </div>
            <!-- SIDEBAR -->
             <?php get_homepage_text();?>
             <?php get_sidebar("menu");?>
        </div>