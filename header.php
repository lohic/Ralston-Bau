<!DOCTYPE HTML>
<html>
<head>
    <title><?php bloginfo('name') ?><?php if ( is_404() ) : ?> | <?php _e('Not Found') ?><?php elseif ( is_home() ) : ?> | <?php bloginfo('description') ?><?php else : ?><?php wp_title() ?><?php endif ?></title>
    
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
    <meta name="viewport" content="width=device-width, maximum-scale=1.0" />
    <meta name="identifier-url" content="<?php bloginfo('url'); ?>" />

    <link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.ico" />
    <link rel="stylesheet"    href="<?php bloginfo('stylesheet_url'); ?>?v=12" type="text/css" />
    
    <link rel="alternate" href="<?php bloginfo('rss2_url'); ?>" type="application/rss+xml" title="RSS 2.0"  />
    <link rel="alternate" href="<?php bloginfo('rss_url'); ?>"  type="text/xml" title="RSS .92"  />
    <link rel="alternate" href="<?php bloginfo('atom_url'); ?>" type="application/atom+xml" title="Atom 0.3"  />
    <link rel="pingback"  href="<?php bloginfo('pingback_url'); ?>" /><?php wp_head(); ?>

    <script type="text/javascript" src="//use.typekit.net/tpv1jpp.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>

<?php wp_head(); ?>
</head>


<body class="">

    <div id="loading"></div>

    <div id="page">
    	
        <div id="menu">
            <h1  data-title="<?php bloginfo('name') ?><?php if ( is_404() ) : ?> | <?php _e('Not Found') ?><?php elseif ( is_home() ) : ?> | <?php bloginfo('description') ?><?php else : ?><?php wp_title() ?><?php endif ?>"><a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>"></a></h1>
            <button id="mobile-menu">Mobile menu</button>
            <?php wp_nav_menu( array('theme_location' => 'main_menu', 'container'=>'' )); ?>
        </div>

<!-- FIN header.php -->