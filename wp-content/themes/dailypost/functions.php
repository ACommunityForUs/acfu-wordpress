<?php
/**
 * WPLOOK functions and definitions
 *
 * @package wplook
 * @subpackage DailyPost
 * @since DailyPost 1.0
 */
//error_reporting(E_ALL & ~E_NOTICE);

// VARIABLES
$themename = "DailyPost";									//Theme Name
$themever = "1.0.5";											//Theme version
$fwver = "1.1";												//Framework version
$shortname = "wpl";											//Shortname 


// Set path to WPLOOK Framework and theme specific functions

$be_path = TEMPLATEPATH . '/functions/be/';									//BackEnd Path
$fe_path = TEMPLATEPATH . '/functions/fe/';									//FrontEnd Path
$be_pathimages = get_template_directory_uri() . '/functions/be/images';		//BackEnd Path
$fe_pathimages = get_template_directory_uri() . '';							//FrontEnd Path

//Include Framework [BE]
require_once ($be_path . 'fw-setup.php');					// Init
require_once ($be_path . 'fw-options.php');					// Framework Init

// Include Theme specific functionality [FE] 
require_once ($fe_path . 'setup.php');						// Base Init
require_once ($fe_path . 'widgets-init.php');				// Init widget FE
require_once ($fe_path . 'headerdata.php');					// Include css and js
require_once ($fe_path . 'comment.php');						// Comments


// translation-ready
	load_theme_textdomain( 'wplook', TEMPLATEPATH . '/languages' );
	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );	

//Robert's additions
add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );
 
function extra_user_profile_fields( $user ) { ?>
<h3><?php _e("Extra profile information", "blank"); ?></h3>
 
<table class="form-table">
<tr>
<th><label for="address"><?php _e("Address"); ?></label></th>
<td>
<input type="text" name="address" id="address" value="<?php echo esc_attr( get_the_author_meta( 'address', $user->ID ) ); ?>" class="regular-text" /><br />
<span class="description"><?php _e("Please enter your address."); ?></span>
</td>
</tr>
<tr>
<th><label for="city"><?php _e("City"); ?></label></th>
<td>
<input type="text" name="city" id="city" value="<?php echo esc_attr( get_the_author_meta( 'city', $user->ID ) ); ?>" class="regular-text" /><br />
<span class="description"><?php _e("Please enter your city."); ?></span>
</td>
</tr>
<tr>
<th><label for="province"><?php _e("Province"); ?></label></th>
<td>
<input type="text" name="province" id="province" value="<?php echo esc_attr( get_the_author_meta( 'province', $user->ID ) ); ?>" class="regular-text" /><br />
<span class="description"><?php _e("Please enter your province."); ?></span>
</td>
</tr>
<tr>
<th><label for="postalcode"><?php _e("Postal Code"); ?></label></th>
<td>
<input type="text" name="postalcode" id="postalcode" value="<?php echo esc_attr( get_the_author_meta( 'postalcode', $user->ID ) ); ?>" class="regular-text" /><br />
<span class="description"><?php _e("Please enter your postal code."); ?></span>
</td>
</tr>
<tr>
<th><label for="phone"><?php _e("Phone #"); ?></label></th>
<td>
<input type="text" name="phone" id="phone" value="<?php echo esc_attr( get_the_author_meta( 'phone', $user->ID ) ); ?>" class="regular-text" /><br />
<span class="description"><?php _e("Please enter your phone nubmer."); ?></span>
</td>
</tr>
</table>
<?php }
 
add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );
 
function save_extra_user_profile_fields( $user_id ) {
 
if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }
 
update_user_meta( $user_id, 'address', $_POST['address'] );
update_user_meta( $user_id, 'city', $_POST['city'] );
update_user_meta( $user_id, 'province', $_POST['province'] );
update_user_meta( $user_id, 'postalcode', $_POST['postalcode'] );
update_user_meta( $user_id, 'phone', $_POST['phone'] );
}
?>
