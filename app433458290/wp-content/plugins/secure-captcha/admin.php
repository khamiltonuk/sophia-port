<?php

if (!function_exists('add_action')) {
    echo "Important function is missing. ";
    exit;
}

secure_captcha_admin_warnings();

add_action('admin_menu', 'secure_captcha_menu');

function secure_captcha_menu() {
   	add_options_page('Secure CAPTCHA Options', 'Secure CAPTCHA', 'manage_options', 'secure_captcha_options', 'secure_captcha_options');
}

function secure_captcha_options() {
	if (!current_user_can('manage_options'))  {
		wp_die(__('You do not have sufficient permissions to access this page.'));
	}

	$siteID = get_option('secure_captcha_siteID');
	$key = get_option('secure_captcha_key');
	$hideLink = get_option('secure_captcha_hideLink');
	$forms_string = get_option('secure_captcha_forms');
        if ($forms_string == null) $forms_string = 'register,lost_password,comment';
        $forms = explode(",", $forms_string);

	if (isset($_POST['secure_captcha_admin_from_submited']) && $_POST['secure_captcha_admin_from_submited'] == 'Y') {
		$siteID = $_POST['secure_captcha_siteID'];
		$key = $_POST['secure_captcha_key'];
		$forms = $_POST['secure_captcha_forms'];
		$hideLink = $_POST['secure_captcha_hideLink'];
		if ($hideLink == null) $hideLink = 'yes';

                $forms_string = implode(",", $forms);
		update_option('secure_captcha_siteID', $siteID);
		update_option('secure_captcha_key', $key);
		update_option('secure_captcha_forms', $forms_string);
		update_option('secure_captcha_hideLink', $hideLink);

?>
<div class="updated"><p><strong><?php _e('Settings saved. ', 'secure_captcha'); ?></strong></p></div>
<?php

	}

?>

<div class="wrap">
<h2><?php echo __('Secure Captcha Plugin Settings', 'secure_captcha') ?></h2>

<form name="form1" method="post" action="">
<input type="hidden" name="secure_captcha_admin_from_submited" value="Y">

<?php _e('To get your Site ID and Private Key log in to the <a href="http://www.secureCAPTCHA.net">secureCAPTCHA.net</a>. ', 'secure_captcha') ?>

<table class="form-table">
<tr>
<th><?php _e("Site ID", 'secure_captcha'); ?></th>
<td><input type="text" name="secure_captcha_siteID" value="<?php echo $siteID; ?>"></td>
</tr>

<tr>
<th><?php _e("Private key", 'secure_captcha'); ?></th>
<td><input type="text" name="secure_captcha_key" value="<?php echo $key; ?>"></td>
</tr>

<tr>
<th><?php _e("Forms", 'secure_captcha'); ?></th>
<td>
	<input type="checkbox" name="secure_captcha_forms[]" value="register" <?php if (in_array('register', $forms)) echo 'checked="true"'; ?>> <?php _e("Register form", 'secure_captcha'); ?> <br />
	<input type="checkbox" name="secure_captcha_forms[]" value="lost_password" <?php if (in_array('lost_password', $forms)) echo 'checked="true"'; ?>> <?php _e("Lost password form", 'secure_captcha'); ?> <br />
	<input type="checkbox" name="secure_captcha_forms[]" value="comment" <?php if (in_array('comment', $forms)) echo 'checked="true"'; ?>> <?php _e("Comment form", 'secure_captcha'); ?> <br /> <br />
	<input type="checkbox" name="secure_captcha_forms[]" value="login" <?php if (in_array('login', $forms)) echo 'checked="true"'; ?>> <?php _e("Login form", 'secure_captcha'); ?> <?php _e("(Enable this option only when you are sure that plugin is configured correctly and it works on your site. Otherwise, you may be not able to log in as an admin. )", 'secure_captcha'); ?> <br />
</td>
</tr>

<tr>
<th><?php _e("Show link to the SecureCAPTCHA.net under the CAPTCHA image. ", 'secure_captcha'); ?></th>
<td><input type="checkbox" name="secure_captcha_hideLink" value="no" <?php if ($hideLink != 'yes') echo 'checked="true"'; ?>></td>
</tr>

</table>

<p class="submit">
<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
</p>

</form>
</div>

<?php
}

function secure_captcha_warning() {
	echo "<div id='secure-captcha-warning' class='updated fade'><p><strong>" . __('Secure CAPTCHA is almost ready.', 'secure_captcha') . "</strong> " . sprintf(__('You have to <a href="%1$s">configure it</a>.', 'secure_captcha'), "options-general.php?page=secure_captcha_options") . "</p></div>";
}

function secure_captcha_admin_warnings() {
	if (secure_captcha_is_configured() || isset($_POST['secure_captcha_admin_from_submited'])) return;
	add_action('admin_notices', 'secure_captcha_warning');
}

?>
