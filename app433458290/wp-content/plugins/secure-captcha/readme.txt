=== Secure CAPTCHA ===
Contributors: uosiu
Donate link: http://www.securecaptcha.net/donate.html
Tags: captcha, security, spam
Requires at least: 3.1
Tested up to: 3.1
Stable tag: 1.2

Protect your forms from spam with hard to break and easy to read Secure CAPTCHA images from SecureCAPTCHA.net.

== Description ==

Protect your forms from spam with hard to break and easy to read Secure CAPTCHA images from <a href="http://www.securecaptcha.net/">SecureCAPTCHA.net</a>.

Secure CAPTCHA allows to distinguish between form submition made by human and script (robot, bot, program etc.).
It gives you ability to reject all form submitions made in automatic way.
Secure CAPTCHA was designed to be both hard to break with a script and easy to solve by the humans.

Most of available simple CAPTCHA libraries are easy to break.
They use one font and scale or rotate each letter individually.
There are scripts on the web that are capable to break them.
Some CAPTCHAs add random lines and patterns, but it make the text harder to read by a human.

Secure CAPTCHA is made with handwriting.
Letters are connected together and it is difficult for a script to split text into individual letters.
Moreover, each letter looks somewhat differently depending on it's two neighbour letters.
And finally, the whole text is transformed with some randomly chosen nonlinear transformation.

Many CAPTCHA implementations on the web are really hard to read.
Sometimes it is even impossible.
Secure CAPTCHA is easy to solve for a human: our images have big letters and high contrast between the text and the background.

== Installation ==

1. Download <a href="http://downloads.wordpress.org/plugin/secure-captcha.1.1.zip">the latest version of the plugin</a> and unzip it.
1. Move the entire `secure-captcha` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Create account on the [securecaptcha.net](http://www.securecaptcha.net/). Create a site entry and obtain SiteID and PrivateKey.
1. Configure the plugin: paste your SiteID and PrivateKey. Choose which forms to protect.

== Screenshots ==

1. screenshot-1.png

== Changelog ==

= 1.2 =
* Logout echo bug removed

= 1.1 =
* Host name changed

= 1.0 =
* First version.


