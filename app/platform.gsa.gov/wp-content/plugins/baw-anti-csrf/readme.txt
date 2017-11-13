=== Anti CSRF ===
Contributors: juliobox
Tags: security, csrf, xsrf, vulnerability
Requires at least: 3.1
Tested up to: 3.6
Stable tag: trunk
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=RB7646G6NVPWU
License: GPLv2

Add a security layer on your site: avoid bad crafted plugin harm your site now because fo CSRF flaw!

== Description ==
The [CSRF](http://en.wikipedia.org/wiki/Cross-site_request_forgery) vulnerability is the most famous web vulnerability, since ... i do not remember, too long !

Many WordPress plugin (about 70%) from this repository or elsewhere, even Premim plugins are vunerable to this flaw.

To avoid get hacked because os this, just install this plugin, no settings, no tech. Just use your blog as usual.

! ONLY FOR BACK-END USAGE !

== Installation ==

1. Extract the plugin folder from the downloaded ZIP file.
2. Upload BAW Anti CSRF folder to your /wp-content/plugins/ directory.
3. Activate the plugin from the "Plugins" page in your Dashboard.
4. That's all

== Frequently Asked Questions ==

= Why do i have to link on your link when i'm on an update page ?
* Because i'm using a buffer to modify each form and action link, but WordPress clear this buffer before me on this page :( The link is just a Dashboard link.

== Screenshots ==
1. On update page, clic MY link or die. ;)
2. Example of my own die with support proposal ;)

== Upgrade Notice ==
Nothing.

== Changelog ==

= 1.5.2 =
* 12 sep 2012
* Little fix bug fro my code Improvment *sight*

= 1.5.1 =
* 12 sep 2012
* Little code Improvment

= 1.5 =
* 04 sep 2012
* Fix bug : wp_create_nonce undefined (hooked too soon)

= 1.4 =
* 04 sep 2012
* Add filter on admin_url() and network_admin_url() to add my nonce.

= 1.3 =
* 03 sep 2012
* 1.1 rollback, i have to keep the real nonces functions.

= 1.2 =
* 11 sep 2012
* Add more security using a message between a link without token, more annoying i admit, but more secure.

= 1.1.5 =
* 16 aug 2012
* Bug fix for Redirection (bad JS on my side x2)

= 1.1.4 =
* 13 aug 2012
* Bug fix for Jetpack (bad JS on my side)

= 1.1.3 =
* 13 aug 2012
* Bug fix for some link without my nonce

= 1.1.2 =
* 13 aug 2012
* Bug fix for l10n load

= 1.1.1 =
* 13 aug 2012
* Not a big deal, just forgot to add the plugin version in die support.

= 1.1 =
* 12 aug 2012
* Bug fix on redirection with wp_redirect()
* Better own wp_die to explain and give support
* Use my own nonces functions (clone from WP core) to avoid malicious plugins that can bypass mine

= 1.0.1 =
* 12 aug 2012
* Bug fix for default code ajax actions

= 1.0 =
* 12 aug 2012
* First Release

= 0.1b, 0.2b, 0.3b =
* 3 betas versions tested by @rochdaniel, @screenfeedfr, @gcroupie, @tmaquet, @geekpressfr, thanks dudes!
