<?php


// A callback function to add a custom field to our "presenters" taxonomy
function project_category_taxonomy_custom_fields($tag) {
   // Check for existing taxonomy meta for the term you're editing
    $t_id = $tag->term_id; // Get the ID of the term you're editing
    $term_meta = get_option( "taxonomy_term_$t_id" ); // Do the check
?>
 
<tr class="form-field">
    <th scope="row" valign="top">
        <label for="project_category_image_url"><?php _e('Project Category Tags Title'); ?></label>
    </th>
    <td>
        <!--<input type="text" name="term_meta[project_category_tags]" id="term_meta[project_category_tags]" size="25" style="width:60%;" value="<?php echo $term_meta['project_category_tags_title'] ? $term_meta['project_category_tags_title'] : ''; ?>"><br />-->
        
        <input  name="term_meta[project_category_tags_title]" id="project_category_tags_title" class="project_category_tags_title" size="25" style="width:97%;" value="<?php echo $term_meta['project_category_tags_title'] ? $term_meta['project_category_tags_title'] : ''; ?>" type="text" />
        <p class="description"><?php _e('Project Category Tags Title'); ?></p>
    </td>
</tr>
<tr class="form-field">
    <th scope="row" valign="top">
        <label for="project_category_tags"><?php _e('Project Category Tags'); ?></label>
    </th>
    <td>
        <!--<input type="text" name="term_meta[project_category_tags]" id="term_meta[project_category_tags]" size="25" style="width:60%;" value="<?php echo $term_meta['project_category_tags'] ? $term_meta['project_category_tags'] : ''; ?>"><br />-->
        
        <textarea  name="term_meta[project_category_tags]" id="project_category_tags" class="project_category_tags" size="25" style="width:97%;"><?php echo $term_meta['project_category_tags'] ? $term_meta['project_category_tags'] : ''; ?></textarea>
        <p class="description"><?php _e('Project Category tags, separate with comma'); ?></p>
    </td>
</tr>

 
<?php
}

// A callback function to add a custom field to our "presenters" taxonomy
function project_category_add_taxonomy_custom_fields($tag) {
   // Check for existing taxonomy meta for the term you're editing
    $t_id = $tag->term_id; // Get the ID of the term you're editing
    $term_meta = get_option( "taxonomy_term_$t_id" ); // Do the check
?>
 

<div class="form-field">
        <label for="project_category_image_url"><?php _e('Project Category Tags Title'); ?></label>
        <input type="text" name="term_meta[project_category_tags_title]" id="project_category_tags_title" size="25" style="width:60%;" value="<?php echo $term_meta['project_category_tags_title'] ? $term_meta['project_category_tags_title'] : ''; ?>"><br />
        <p class="description"><?php _e('Project Category tags title'); ?></p>
</div>

<div class="form-field">
        <label for="project_category_tags"><?php _e('Project Category Tags'); ?></label>
        <input type="text" name="term_meta[project_category_tags]" id="term_meta[project_category_tags]" size="25" style="width:60%;" value="<?php echo $term_meta['project_category_tags'] ? $term_meta['project_category_tags'] : ''; ?>"><br />
        <p class="description"><?php _e('Project Category tags'); ?></p>
</div>
 
<?php
}

// A callback function to save our extra taxonomy field(s)
function save_taxonomy_custom_fields( $term_id ) {
    if ( isset( $_POST['term_meta'] ) ) {
        $t_id = $term_id;
        $term_meta = get_option( "taxonomy_term_$t_id" );
        $cat_keys = array_keys( $_POST['term_meta'] );
            foreach ( $cat_keys as $key ){
            if ( isset( $_POST['term_meta'][$key] ) ){
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        //save the option array
        update_option( "taxonomy_term_$t_id", $term_meta );
    }
}

