<?php
/*
Plugin Name: Secure CAPTCHA
Plugin URI: http://www.securecaptcha.net/wordpress.html
Description: Protection you site from spam with secure, handwritten text based CAPTCHA. 1) <a href="http://www.securecaptcha.net/register">Sign-up for a key</a> 2) <a href="options-general.php?page=secure_captcha_options">Configure</a>
Version: 1.2
Author: Stanisław Skonieczny
Author URI: http://www.securecaptcha.net/
License: GPL2
*/
?>
<?php
/*  Copyright 2011 Stanisław Skonieczny (email : admin@securecaptcha.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>
<?php
//define('WP_DEBUG', true);

// Make sure we don't expose any info if called directly
if (!function_exists('add_action')) {
	echo "Important function is missing. ";
	exit;
}

add_action('init', 'secure_captcha_init');

function secure_captcha_init() {
	load_plugin_textdomain('secure_captcha', false, dirname(plugin_basename(__FILE__)) . '/languages');
}

if (is_admin()) {
	require_once dirname(__FILE__) . '/admin.php';
}

require_once dirname(__FILE__) . '/handwrittenCaptcha.php';

function secure_captcha_create_service() {
	$siteID = get_option('secure_captcha_siteID');
	$key = get_option('secure_captcha_key');
	$hideLink = get_option('secure_captcha_hideLink');

	$ret = new CaptchaService($siteID, $key);
	//echo 'x'.$hideLink;
        if ($hideLink == 'yes') $ret->tid = 'wp';
	return $ret;
}

// prints captcha html fragment
function secure_captcha_print_fragment() {
	if (current_user_can('administrator')) {
		return;
	}
	if (!secure_captcha_is_configured()) {
		echo '<div class=\"error\">' . __('CAPTCHA is not configured.', 'secure_captcha') . '</div>';
		return;
	}
	$service = secure_captcha_create_service();
	if (!$service->getCaptcha($out)) {
		echo '<div class=\"error\">' . __('CAPTCHA request error. Details: ', 'secure_captcha') . $out . '</div>';
		return;
	}
	$hash = $out['hash'];
	$mac = $out['mac'];
	$timestamp = $out['timestamp'];
	$fragment = $out['fragment'];
	echo $fragment;
	echo '<label>' . __('Rewrite letters from the image above (lower Latin letters only): ', 'secure_captcha') . '<br />';
	echo '<input name="secure_captcha_answer" type="text" class="input" tabindex="89"></label>';
	echo '<input name="secure_captcha_hash" type="hidden" value="' . htmlspecialchars($hash) . '">';
	echo '<input name="secure_captcha_timestamp" type="hidden" value="' . htmlspecialchars($timestamp) . '">';
}

// @returns true when code is correct
function secure_captcha_validate_code() {
	if (current_user_can('administrator')) {
		return true;
	}
	if (!secure_captcha_is_configured()) {
		return true;
	}
	$service = secure_captcha_create_service();
	$answer = $_REQUEST['secure_captcha_answer'];
	$hash = $_REQUEST['secure_captcha_hash'];
	$timestamp = $_REQUEST['secure_captcha_timestamp'];
	 
	$ok = $service->validateOnline($hash, $timestamp, $answer, $error);
	if ($ok) {
	    return true;
	}
	return false;
}

//adds captcha answer errors
function secure_captcha_filter_errors($errors) {
	if (!secure_captcha_validate_code()) {
		if (!is_wp_error($errors)) {
			$errors = new WP_Error();
		}
		$errors->add('secure_captcha_error', '<strong>' . __('ERROR', 'secure_captcha') . '</strong>: ' .  __('Rewrite letters from the CAPTCHA image correctly. ', 'secure-captcha'));
	}
	return $errors;
}

//this filter dies if captcha not valid
function secure_captcha_filter_die($ret) {
	if (!secure_captcha_validate_code()) {
		die(__('ERROR', 'secure_captcha').': ' . __('Press the "Back" button, reload the page and rewrite letters from the CAPTCHA image correctly. '));
	}
	return $ret;
}

//this action dies if captcha not valid
function secure_captcha_action_validate_die() {
	if (!secure_captcha_validate_code()) {
		die(__('ERROR', 'secure_captcha').': ' . __('Press the "Back" button, reload the page and rewrite letters from the CAPTCHA image correctly. '));
	}
	return;
}

function secure_captcha_is_configured() {
	if (!get_option('secure_captcha_siteID')) {
		return false;
	}
	if (!get_option('secure_captcha_key')) {
		return false;
	}
	return true;
}

$forms_string = get_option('secure_captcha_forms');
$forms = explode(",", $forms_string);

//register form
if (in_array('register', $forms)) {
	add_action('register_form', 'secure_captcha_print_fragment');
	add_filter('registration_errors', 'secure_captcha_filter_errors');
}

//comment form
if (in_array('comment', $forms)) {
	add_action('comment_form_after_fields', 'secure_captcha_print_fragment');
	add_action('comment_form_logged_in_after', 'secure_captcha_print_fragment');
	add_filter('preprocess_comment', 'secure_captcha_filter_die');
}

//lost password form
if (in_array('lost_password', $forms)) {
	add_action('lostpassword_form', 'secure_captcha_print_fragment');
	add_action('lostpassword_post', 'secure_captcha_action_validate_die');
}

//login form
if (in_array('login', $forms)) {
	add_action('login_form', 'secure_captcha_print_fragment');
	add_filter('authenticate', 'secure_captcha_filter_errors', 100);
}

?>
