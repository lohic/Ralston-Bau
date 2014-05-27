<?php


			

function mytheme_add_admin() {

	global $themename, $shortname, $options;
	
	if ( $_GET['page'] == basename(__FILE__) ) {
	
		if ( 'save' == $_REQUEST['action'] ) {
		
			foreach ($options as $value) {
				update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
		
			foreach ($options as $value) {
				if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
		
				header("Location: themes.php?page=functions-options.php&saved=true");
				die;
		
		} else if( 'reset' == $_REQUEST['action'] ) {
		
			foreach ($options as $value) {
				delete_option( $value['id'] ); }
		
				header("Location: themes.php?page=functions-options.php&reset=true");
				die;
		
		} else if ( 'reset_widgets' == $_REQUEST['action'] ) {
			$null = null;
			update_option('sidebars_widgets',$null);
			header("Location: themes.php?page=functions-options.php&reset=true");
			die;
		}
	}
	
	add_theme_page("", 						"Transplant Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');
	
	//add_theme_page($themename." Options", "Transplant options", 'edit_themes', basename(__FILE__), 'mytheme_admin');
	

}

function mytheme_admin() {

    global $themename, $shortname, $options;

    if ( $_REQUEST['saved'] )			echo '<div id="message" class="updated fade"><p><strong>'.$themename.' '.__('settings saved.','thematic').'</strong></p></div>';
    if ( $_REQUEST['reset'] )			echo '<div id="message" class="updated fade"><p><strong>'.$themename.' '.__('settings reset.','thematic').'</strong></p></div>';
    if ( $_REQUEST['reset_widgets'] )	echo '<div id="message" class="updated fade"><p><strong>'.$themename.' '.__('widgets reset.','thematic').'</strong></p></div>';
    
?>
<div class="wrap">
<?php if ( function_exists('screen_icon') ) screen_icon(); ?>
<h2>Transplant theme options</h2>

<form method="post" action="">

	<table class="form-table">

<?php foreach ($options as $value) { 
	
	switch ( $value['type'] ) {
		case 'text':
		?>
		<tr valign="top"> 
			<th scope="row"><label for="<?php echo $value['id']; ?>"><?php echo __($value['name'],'thematic'); ?></label></th>
			<td>
				<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
				<small><?php echo __($value['desc'],'thematic'); ?></small>

			</td>
		</tr>
		<?php
		break;
		
		case 'select':
		?>
		<tr valign="top">
			<th scope="row"><label for="<?php echo $value['id']; ?>"><?php echo __($value['name'],'thematic'); ?></label></th>
				<td>
					<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
					<?php foreach ($value['options'] as $option) { ?>
					<option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<?php
		break;
		
		case 'textarea':
		$ta_options = $value['options'];
		?>
		<tr valign="top"> 
			<th scope="row"><label for="<?php echo $value['id']; ?>"><?php echo __($value['name'],'thematic'); ?></label></th>
			<td><textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="<?php echo $ta_options['cols']; ?>" rows="<?php echo $ta_options['rows']; ?>"><?php 
				if( get_option($value['id']) != "") {
						echo __(stripslashes(get_option($value['id'])),'thematic');
					}else{
						echo __($value['std'],'thematic');
				}?></textarea><br /><small><?php echo __($value['desc'],'thematic'); ?></small></td>
		</tr>
		<?php
		break;
		
		case 'nothing':
		$ta_options = $value['options'];
		?>
	</table>
			<small><?php echo __($value['desc'],'thematic'); ?></small>
		<table class="form-table">
		<?php
		break;

		case 'radio':
		?>
		<tr valign="top"> 
			<th scope="row"><?php echo __($value['name'],'thematic'); ?></th>
			<td>
				<?php foreach ($value['options'] as $key=>$option) { 
				$radio_setting = get_option($value['id']);
				if($radio_setting != ''){
					if ($key == get_option($value['id']) ) {
						$checked = "checked=\"checked\"";
						} else {
							$checked = "";
						}
				}else{
					if($key == $value['std']){
						$checked = "checked=\"checked\"";
					}else{
						$checked = "";
					}
				}?>
				<input type="radio" name="<?php echo $value['id']; ?>" id="<?php echo $value['id'] . $key; ?>" value="<?php echo $key; ?>" <?php echo $checked; ?> /><label for="<?php echo $value['id'] . $key; ?>"><?php echo $option; ?></label><br />
				<?php } ?>
			</td>
		</tr>
		<?php
		break;
		
		case 'checkbox':
		?>
		<tr valign="top"> 
			<th scope="row"><?php echo __($value['name'],'thematic'); ?></th>
			<td>
				<?php
					if(get_option($value['id'])){
						$checked = "checked=\"checked\"";
					}else{
						$checked = "";
					}
				?>
				<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
				<label for="<?php echo $value['id']; ?>"><small><?php echo __($value['desc'],'thematic'); ?></small></label>
			</td>
		</tr>
		<?php
		break;

		default:

		break;
	}
}
?>

	</table>

	<p class="submit">
		<input name="save" type="submit" value="<?php _e('Save changes','thematic'); ?>" />    
		<input type="hidden" name="action" value="save" />
	</p>
</form>
<form method="post" action="">
	<p class="submit">
		<input name="reset" type="submit" value="<?php _e('Reset','thematic'); ?>" />
		<input type="hidden" name="action" value="reset" />
	</p>
</form>

<p>Transplant theme.</p>
</div>
<?php
}
?>