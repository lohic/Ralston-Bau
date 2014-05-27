<?php


/**
 * On ajoute des options au thème
 */

$themename = 'transplant';
$shortname = 'transplant';

$options = array (

//titre de la page
array(  'name' => 'Options de thèmes',
        'type' => 'title'),

//ouverture du formulaire
array(    'type' => 'open'),

//un texte
array(  'name' => 'Téléphone',
        'desc' => 'Renseignez ici le téléphone',
        'id' => $shortname.'_telephone',
        'type' => 'text',
        'std'=>'0123456789'),

//un textarea
array(  'name' => 'Mon textarea',
        'desc' => 'Renseignez ici l\'adresse',
        'id' => $shortname.'_adresse',
        'type' => 'textarea',
        'std'=>''),

//une checkbox
array(  'name' => 'Afficher l\'adresse',
        'desc' => 'Cochez cette case pour afficher l\'adresse sur la page d\'accueil',
        'id' => $shortname.'_afficher_adresse',
        'type' => 'checkbox'),

//un select
array(  'name' => 'Nombres de news',
        'desc' => 'Choississez le nombre de news à afficher en page d\'accueil',
        'id' => $shortname.'_nb_news',
        'type' => 'select',
        'options'=>array('5 news','10 news','15 news'),
        'std'=>'10 news'),

//fermeture du formulaire
array(    'type' => 'close')

);


add_action( 'admin_init', 'transplant_theme_options_init' );

function transplant_theme_options_init() {

	global $themename, $shortname, $options;
	
	if ( $_GET['page'] == basename(__FILE__) ) {
	
		//sauvegarde des champs
		if ( 'save' == $_REQUEST['action'] ) {
		
			foreach ($options as $value) {
				update_option( $value['id'], stripslashes($_REQUEST[ $value['id'] ]) ); }
			
			foreach ($options as $value) {
				if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], stripslashes($_REQUEST[ $value['id'] ]) ); } else { delete_option( $value['id'] ); } }
					header("Location: themes.php?page=functions.php&saved=true");
				die;
			
		}
	}
	
	//ajouter une entrÃ©e de menu "ParamÃ¨tres" dans le menu "Apparence"
	add_theme_page($themename." Options", "Paramètres", 'edit_themes', basename(__FILE__), 'transplant_admin');
}


function transplant_admin() {
    global $themename, $shortname, $options;
	//message
    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>Les paramÃ¨tres du thÃ¨me '.ucfirst($themename).' ont Ã©tÃ© sauvegardÃ©s.</strong></p></div>';
?>
<div class="wrap">
<h2>Options du thÃ¨me <?php echo ucfirst($themename); ?></h2>

<?php //Pour chaque champ de notre tableau de champ, crÃ©ation de l'Ã©lÃ©ment de formulaire appropriÃ©
?>
<form method="post">

<?php foreach ($options as $value) {
switch ( $value['type'] ) {

case "open":
?>
<table width="100%" border="0" style="background-color:#f5f5f5; padding:10px;">

<?php break;

case "close":
?>

</table><br />

<?php break;

case "title":
?>
<table width="100%" border="0" style="background-color:#eeeeee; padding:5px 10px;"><tr>
    <td colspan="2"><h3 style="font-family:Georgia,'Times New Roman',Times,serif;"><?php echo $value['name']; ?></h3></td>
</tr>

<?php break;

case 'text':
?>

<tr>
    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
    <td width="80%"><input style="width:400px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo (get_option( $value['id']) ); } else { echo $value['std']; } ?>" /></td>
</tr>

<tr>
    <td><small><?php echo $value['desc']; ?></small></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php
break;

case 'textarea':
?>

<tr>
    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
    <td width="80%"><textarea name="<?php echo $value['id']; ?>" style="width:400px; height:200px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_option( $value['id'] ) != "") { echo (get_option($value['id'] )); } else { echo $value['std']; } ?></textarea></td>

</tr>

<tr>
    <td><small><?php echo $value['desc']; ?></small></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php
break;

case 'select':
?>
<tr>
    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
    <td width="80%"><select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select></td>
</tr>

<tr>
    <td><small><?php echo $value['desc']; ?></small></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php
break;

case "checkbox":
?>
    <tr>
    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
        <td width="80%"><? if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                </td>
    </tr>

    <tr>
        <td><small><?php echo $value['desc']; ?></small></td>
   </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php         break;

}
}
?>

<p class="submit">
<input name="save" type="submit" value="Sauvegarder" />
<input type="hidden" name="action" value="save" />
</p>
</form>
<!--<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Restaurer les paramÃ¨tres" />
<input type="hidden" name="action" value="reset" />
</p>
</form>-->

<?php
}