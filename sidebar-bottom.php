<!-- DEBUT sidebar-bottom.php -->
<ul>
	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('bottom') ) : else : ?>
	<?php endif; ?>
    <li>Copyright &#169; <?php print(date(Y)); ?> <?php bloginfo('name'); ?></li>
</ul>
<!-- FIN sidebar-bottom.php -->