<?php
/*
Plugin Name: WP ShortCode Shield
Plugin URI: http://www.vicchi.org/codeage/wp-shortcode-shield/
Description: Allows posts and pages to easily document WordPress short-codes without the short-code being expanded.
Version: 1.0
Author: Gary Gale
Author URI: http://www.garygale.com/
License: GPL2
*/

define ('WPSHORTCODESHIELD_PATH', plugin_dir_path (__FILE__));

require_once (WPSHORTCODESHIELD_PATH . '/wp-plugin-base/wp-plugin-base.php');

class WP_ShortCodeShield extends WP_PluginBase {
	static $instance;
	
	const LANGB = '&#91;';
	const RANGB = '&#93;';
	
	function __construct () {
		self::$instance = $this;
		
		$this->hook ('plugins_loaded');
	}
	
	function plugins_loaded () {
		add_shortcode ('wp_scs', array ($this, 'shortcode'));
		add_shortcode ('wp_shortcode_shield', array ($this, 'shortcode'));
	}
	
	function shortcode ($atts, $content=null) {
		extract (shortcode_atts (array ('code' => ''), $atts));
		
		// Self-closing shortcode form ...
		if (empty ($content) && !empty ($code)) {
			return $this->enclose ($code);
		}
		
		// Enclosing shortcode form ...
		else {
			if (strpos ($content, '[') === false) {
				return $this->enclose ($content);
			}
			
			else {
				return $content;
			}
		}
	}
	
	function enclose ($content) {
		return self::LANGB . $content . self::RANGB;
	}
}	// end-class WP_ShortCodeShield

$__wp_shortcode_shield_instance = new WP_ShortCodeShield;

?>