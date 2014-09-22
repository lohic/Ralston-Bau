    		<div class="reset"></div>
		</div>
	</div>
</div>

    
<div id="footer">
    <div id="footer-bar">
        <div id="footer-menu">
            <?php wp_nav_menu( array('theme_location' => 'foot_menu','items_wrap' => '<ul class="bottom-menu">%3$s</ul>'  )); ?>
        </div>
        <div id="footer-menu-right">
          <ul class="bottom-menu">
            <?php if(get_twitter() != ''){?><li>
            	<a href="<?php echo get_twitter(); ?>" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/twitter.png" width="20" height="20" alt="twitter" class="icon" /></a>
            </li><?php } ?>
            <?php if(get_facebook() != ''){?><li>
            	<a href="<?php echo get_facebook(); ?>" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/facebook.png" width="20" height="20" alt="facebook" class="icon"  /></a>
            </li><?php } ?>
          	<li><?php get_search_form(); ?></li>
            <!--<li class="copyright">© 2012 - design by <a href="http://www.transplant.nu">Transplant</a> &amp; <a href="http://www.syclo.fr">Sÿclo</a></li>-->
            <li>
                <script type="text/javascript" src="http://www.ralstonbau.com/wp-includes/js/jquery/jquery.js?ver=2.6.8"></script>
                <script type="text/javascript" src="http://www.ralstonbau.com/wp-content/plugins/wysija-newsletters/js/validate/languages/jquery.validationEngine-en.js?ver=2.6.8"></script>
                <script type="text/javascript" src="http://www.ralstonbau.com/wp-content/plugins/wysija-newsletters/js/validate/jquery.validationEngine.js?ver=2.6.8"></script>
                <script type="text/javascript" src="http://www.ralstonbau.com/wp-content/plugins/wysija-newsletters/js/front-subscribers.js?ver=2.6.8"></script>
                <script type="text/javascript">
                    /* <![CDATA[ */
                    var wysijaAJAX = {"action":"wysija_ajax","controller":"subscribers","ajaxurl":"http://www.ralstonbau.com/wp-admin/admin-ajax.php","loadingTrans":"Loading..."};
                    /* ]]> */
                </script>
                <script type="text/javascript" src="http://www.ralstonbau.com/wp-content/plugins/wysija-newsletters/js/front-subscribers.js?ver=2.6.8"></script>
                <!--END Scripts-->

                <span class="widget_wysija_cont html_wysija">
                <span id="msg-form-wysija-html53bae0267be39-1" class="wysija-msg ajax"></span>
                <form id="form-wysija-html53bae0267be39-1" method="post" action="#wysija" class="widget_wysija html_wysija">
                    <span class="wysija-paragraph">
                    
                        <input type="text" name="wysija[user][email]" class="wysija-input validate[required,custom[email]]" title="Newsletter Email" placeholder="Newsletter Email" value="" />
                                            
                        <span class="abs-req">
                            <input type="text" name="wysija[user][abs][email]" class="wysija-input validated[abs][email]" value="" />
                        </span>
                        
                    </span>
                    
                    <input class="wysija-submit wysija-submit-field" type="submit" value="Subscribe" />

                    <input type="hidden" name="form_id" value="1" />
                    <input type="hidden" name="action" value="save" />
                    <input type="hidden" name="controller" value="subscribers" />
                    <input type="hidden" name="wysija-page" value="1"  />
                    <input type="hidden" name="wysija[user_list][list_ids]" value="4" />
                    
                 </form>
            </li>
			<li><?php //get_sidebar(); ?></li>
          </ul>
        </div>
    </div>
</div>
<?php wp_footer(); ?> 
<!--<?php echo get_num_queries().' requêtes in '; timer_stop(1); echo' secondes.' ; ?>-->
</body>
</html>