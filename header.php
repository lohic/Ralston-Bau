<!DOCTYPE HTML>
<html>
<head>
    <title><?php bloginfo('name') ?><?php if ( is_404() ) : ?> | <?php _e('Not Found') ?><?php elseif ( is_home() ) : ?> | <?php bloginfo('description') ?><?php else : ?><?php wp_title() ?><?php endif ?></title>
    
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
    
    <meta name="viewport" content="width=device-width, maximum-scale=1.0">
    <link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.ico" />
    <link rel="stylesheet"    href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="stylesheet"    href="<?php bloginfo('stylesheet_directory'); ?>/style-print.css" type="text/css" media="print" />
    <link rel="stylesheet"    href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.jscrollpane.css" type="text/css" media="screen" />
    
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
    <link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /><?php wp_head(); ?>

	<?php wp_get_archives('type=monthly&format=link'); ?>

    <script type="text/javascript" src="//use.typekit.net/tpv1jpp.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>


<?php wp_head(); ?>
</head>


<body>
<script>
	site_url = "<?php bloginfo('url'); ?>";
</script>

<div id="loading"></div>

<div id="page">
	<div id="wrapper">
        <div id="menu">
            <div class="menu-container">
                <h1  onClick="$.address.value('');deselectMenu();" style="cursor: pointer; " ><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
                <?php wp_nav_menu( array('theme_location' => 'main_menu' )); ?>
            </div>
        </div>
        
        <div id="ajax">