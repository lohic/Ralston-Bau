<?php get_header(); ?>
    

<?php get_header(); ?>
<!-- DEBUT search.php -->


    <div id="contenu">
        <div id="category-info" class="scroll">
            <div class="container">
                <h3><?php get_homepage_text();?></h3>
            </div>
        </div>
    </div>


    <?php if(have_posts()) : ?>
    <?php while(have_posts()) : the_post(); ?>

    <div id="post_container">
        <div id="post">
            <div class="content">
                <div class="container">
                    <div class="close"><a href="<?php bloginfo('url'); ?>">Close</a></div>

                    <h2>Search Result for : <?php echo $_GET['s']; ?>.</h2>   
                

                  <?php
                global $query_string;
                
                $query_args = explode("&", $query_string);
                $search_query = array();
                
                foreach($query_args as $key => $string) {
                    $query_split = explode("=", $string);
                    $search_query[$query_split[0]] = urldecode($query_split[1]);
                } // foreach
                
                $search_query['posts_per_page'] = '-1';
                $search_query['post_type'] = array('project');
                
                $search = new WP_Query($search_query);
                
                ?>
                
                <?php if($search->have_posts()) : ?>
                <?php while($search->have_posts()) : $search->the_post(); ?>


                        <h3>
                            <a href="<?php echo get_permalink($post_object->ID); ?>" title="<?php echo get_the_title($post_object->ID); ?>"><?php echo get_the_title($post_object->ID);?></a>
                        </h3>               
                    <?php endwhile; ?>
                
                <?php endif; ?>
                

                </div>
            </div>
        </div>
    </div>

    <?php endwhile; ?>
    <?php endif; ?>
    


    <div id="galerie">
        <?php

        $idObj = get_term_by('slug', 'home', 'project_category');
        $current_cat_id = $idObj->term_id;

        ?>
        <?php get_template_part('inc/wall'); ?>
    </div>

<!-- FIN search.php -->
 <?php get_footer(); ?>