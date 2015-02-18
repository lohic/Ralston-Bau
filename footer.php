<!-- DEBUT footer.php -->
    		
	
    <div id="footer">
        <div class="left">
            <?php wp_nav_menu( array('theme_location' => 'foot_menu','items_wrap' => '<ul class="bottom-menu">%3$s</ul>'  )); ?>
        </div>
        <div id="footer-menu-right" class="right">
            <ul class="bottom-menu">
                <?php if(get_twitter() != '' && get_facebook() != '') : ?>
                <li>
                    <?php if(get_twitter() != '') : ?>
                        <a href="<?php echo get_twitter(); ?>" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/twitter.png" width="20" height="20" alt="twitter" class="icon" /></a>
                    <?php endif; ?>
                    <?php if(get_facebook() != '') : ?>
                        <a href="<?php echo get_facebook(); ?>" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/facebook.png" width="20" height="20" alt="facebook" class="icon"  /></a>
                    <?php endif; ?>
                </li>
                <?php endif; ?>
                
                <li class="search"><?php get_search_form(); ?></li>
                <li class="contact-field">
                    <!--<script type="text/javascript" src="<?php bloginfo('url'); ?>/wp-includes/js/jquery/jquery.js?ver=2.6.8"></script>-->
                    <script type="text/javascript" src="<?php bloginfo('url'); ?>/wp-content/plugins/wysija-newsletters/js/validate/languages/jquery.validationEngine-en.js?ver=2.6.8"></script>
                    <script type="text/javascript" src="<?php bloginfo('url'); ?>/wp-content/plugins/wysija-newsletters/js/validate/jquery.validationEngine.js?ver=2.6.8"></script>
                    <script type="text/javascript" src="<?php bloginfo('url'); ?>/wp-content/plugins/wysija-newsletters/js/front-subscribers.js?ver=2.6.8"></script>
                    <script type="text/javascript">
                    /* <![CDATA[ */
                    var wysijaAJAX = {"action":"wysija_ajax","controller":"subscribers","ajaxurl":"http://www.ralstonbau.com/wp-admin/admin-ajax.php","loadingTrans":"Loading..."};
                    /* ]]> */
                    </script>
                    <script type="text/javascript" src="<?php bloginfo('url'); ?>/wp-content/plugins/wysija-newsletters/js/front-subscribers.js?ver=2.6.8"></script>
                    <!--END Scripts-->

                    <div class="widget_wysija_cont html_wysija">
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
                    </div>
                </li>
            </ul>
        </div>
    </div>

	
    </div>
    <!--<div id="alert">
        <p>Your browser window seems to be to small.<br/>Click to hide this alert.</p>
    </div>-->

    
    <script src="http://a.vimeocdn.com/js/froogaloop2.min.js?97273-1352487961"></script>
<?php wp_footer(); ?> 
<!--<?php echo get_num_queries().' requêtes in '; timer_stop(1); echo' secondes.' ; ?>-->
</body>
</html>