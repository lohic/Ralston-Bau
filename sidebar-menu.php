<!--<h3>Menu</h3>
<ul>
    <li>temp</li>
</ul>-->

<h1  onclick="location.href='<?php bloginfo('url'); ?>';" style="cursor: pointer; " ><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>

<?php
//http://codex.wordpress.org/Function_Reference/wp_nav_menu

wp_nav_menu();

?>

<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('menu') ) : else : ?>
<?php endif; ?>