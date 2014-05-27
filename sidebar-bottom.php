<ul>
	<!--<li>ok</li>
	<li id="search"><?php include(TEMPLATEPATH . '/searchform.php'); ?></li>
    <li id="calendar"><h2>Calendrier</h2>
 
	<?php get_calendar(); ?>
 
	</li>
    <li><h2>Categories</h2>
 
		<ul>
		<?php wp_list_cats('sort_column=name&optioncount=1&hierarchical=0'); ?>
		</ul>
 
	</li>
    <?php wp_list_pages('title_li=<h2>Pages</h2>'); ?>-->

	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('bottom') ) : else : ?>
	<?php endif; ?>
    <li>Copyright &#169; <?php print(date(Y)); ?> <?php bloginfo('name'); ?></li>
</ul>