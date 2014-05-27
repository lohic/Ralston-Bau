
    
<div id="footer">
    <div id="footer-bar">
        <div id="footer-menu">
            <?php wp_nav_menu( array('menu' => 'Footer menu','items_wrap' => '<ul class="bottom-menu">%3$s</ul>'  )); ?>
        </div>
        <div id="footer-menu-right">
          <ul class="bottom-menu">
            <?php if(get_twitter() != ''){?><li>
            	<a href="<?php echo get_twitter(); ?>" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/twitter.png" width="20" height="20" alt="twitter" class="icon" /></a>
            </li><?php } ?>
            <?php if(get_facebook() != ''){?><li>
            	<a href="<?php echo get_facebook(); ?>" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/facebook.png" width="20" height="20" alt="facebook" class="icon"  /></a>
            </li><?php } ?>
          </ul>
        </div>
    </div>
</div>

<!--<?php echo get_num_queries().' requêtes in '; timer_stop(1); echo' secondes.' ; ?>-->
</body>
</html>
