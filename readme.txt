=== WP Shortcode Shield ===
Contributors: vicchi
Donate link: http://www.vicchi.org/codeage/donate/
Tags: page, post, shortcode, documentation
Requires at least: 3.4
Tested up to: 3.4.2
Stable tag: 1.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Allows posts and pages to easily document WordPress shortcodes without the shortcode being expanded.

== Description ==

This plugin allows you to refer to a WordPress shortcode within the content of posts and pages without that shortcode being automagically expanded by WordPress. The plugin takes advantage of the fact that the [WordPress ShortCode API](http://codex.wordpress.org/Shortcode_API) does not support nested shortcodes to allow this plugin's shortcode to wrap the shortcode being documented.

> The shortcode parser uses a single pass on the post content. This means that if 
> the $content parameter of a shortcode handler contains another shortcode, it won't
> be parsed

The plugin supports both the self closing `[shortcode]` and enclosing `[shortcode]content[/shortcode]` forms and supports a short form name of the shortcode, `[wp_scs]` as well as the more verbose `[wp_shortcode_shield]` form. For the sake of brevity, the remainder of this documentation will use the `[wp_scs]` short form name.

If using the self-closing form of the shortcode, you need to supply the name of the shortcode you are documenting using the `code` attribute but without using the enclosing `[` and `]` characters. This is because when parsing shortcodes, WordPress looks for the first occurrence of the ']' character to terminate the shortcode. As a result of this, usage such as

`[wp_scs code="[another-shortcode-name]"]`

... WordPress will use the ']' character inside the `code` attribute to try and terminate the shortcode name, which is not what is desired. Instead, the plugin automagically adds the terminating '[' and ']' characters to the plugin's output, so that usage such as

`[wp_scs code="another-shortcode-name"]`

... will display *[another-shortcode-name]* in your post's of page's content.

If you are using the enclosing form of the shortcode, you can either supply the shortcode to be documented with or without enclosing '[' and ']' characters; if they are omitted, the plugin will add them for you, so that usage such as

`[wp_scs][another-shortcode-name][/wp_scs]`

... and

`[wp_scs]another-shortcode-name[/wp_scs]`

... will display the same results, namely *[another-shortcode-name]*.

Finally a note of caution, you cannot mix the enclosing and self closing form of the plugin's shortcode within the same post or page; this is not a limitation of the plugin, but the way in which WordPress implements the [ShortCode API](http://codex.wordpress.org/Shortcode_API) ...

> The parser does not handle mixing of enclosing and non-enclosing forms of the same
> shortcode as you would want it to. For example, if you have:
>
> `[myshortcode example='non-enclosing' /] non-enclosed content [myshortcode] enclosed content
> [/myshortcode]`
>
> Instead of being treated as two shortcodes separated by the text " non-enclosed content ",
> the parser treats this as a single shortcode enclosing " non-enclosed content [myshortcode]
> enclosed content".

== Installation ==

1. You can install WP Shortcode Shield automatically from the WordPress admin panel. From the Dashboard, navigate to the *Plugins / Add New* page and search for *"WP Shortcode Shield"* and click on the *"Install Now"* link.
1. Or you can install WP Shortcode Shield manually. Download the plugin Zip archive and uncompress it. Copy or upload the `wp-shortcode-shield` folder to the `wp-content/plugins` folder on your web server.
1. Activate the plugin. From the Dashboard, navigate to Plugins and click on the *"Activate"* link under the entry for WP Shortcode Shield.
1. That's it. There's no admin settings to configure. Go and start documenting.

== Frequently Asked Questions ==

= How do I get help or support for this plugin? =

In short, very easily. But before you read any further, take a look at [Asking For WordPress Plugin Help And Support Without Tears](http://www.vicchi.org/2012/03/31/asking-for-wordpress-plugin-help-and-support-without-tears/) before firing off a question. In order of preference, you can ask a question on the [WordPress support forum](http://wordpress.org/support/plugin/wp-shortcode-shield); this is by far the best way so that other users can follow the conversation. You can ask me a question on Twitter; I'm [@vicchi](http://twitter.com/vicchi). Or you can drop me an email instead. I can't promise to answer your question but I do promise to answer and do my best to help.

= Is there a web site for this plugin? =

Absolutely. Go to the [WP Shortcode Shield home page](http://www.vicchi.org/codeage/wp-shortcode-shield/) for the latest information. There's also the official [WordPress plugin repository page](http://wordpress.org/extend/plugins/wp-shortcode-shield/) and the [source for the plugin is on GitHub](http://vicchi.github.com/wp-shortcode-shield/) as well.

= I want to amend/hack/augment this plugin; can I do this? =

Totally; this plugin is licensed under the GNU General Public License v2 (GPLV2). See http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt for the full license terms.

== Screenshots ==
1. Raw Source Code Sample
1. Resultant Content Display

== Changelog ==

The current version is 1.1.0 (2012.11.12)

= 1.1.0 =
* Released 2012.11.12
* Other: Upgraded plugin to new version of WP_PluginBase to prevent class name clashes during future upgrades.
* Other: Ensure WP_ShortCodeShield is not already defined and instantiate as a singleton.
* Other: Rename misleading plugin constants (they're square brackets not angle brackets)

= 1.0.1 =
* Released 2012.08.29
* Fixed: Ensure WP_PluginBase is properly included and defined.

= 1.0 =
* Released 2012.07.17
* This is the first version of WP Shortcode Shield.

== Upgrade Notice ==

= 1.1.0 =
Maintenance version; upgraded plugin to new version of WP_PluginBase to prevent class name clashes during future upgrades.

= 1.0.1 =
Fixed a bug where WP_PluginBase is properly included and defined. This is the 2nd. version of WP Shortcode Shield.

= 1.0 =
* This is the first version of WP Shortcode Shield.
