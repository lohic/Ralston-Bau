<!--<h3>Menu</h3>
<ul>
    <li>temp</li>
</ul>-->


<?php
//http://codex.wordpress.org/Function_Reference/wp_nav_menu

wp_nav_menu();

?>

<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('menu') ) : else : ?>
<?php endif; ?>