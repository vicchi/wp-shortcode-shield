<?php
/*
Plugin Name: WP ShortCode Shield
Plugin URI: http://www.vicchi.org/codeage/wp-shortcode-shield/
Description: Allows posts and pages to easily document WordPress short-codes without the short-code being expanded.
Version: 1.1.0
Author: Gary Gale
Author URI: http://www.garygale.com/
License: GPL2
*/

define ('WPSHORTCODESHIELD_PATH', plugin_dir_path (__FILE__));

require_once (WPSHORTCODESHIELD_PATH . '/includes/wp-plugin-base/wp-plugin-base.php');

if (!class_exists ('WP_ShortCodeShield')) {
	class WP_ShortCodeShield extends WP_PluginBase_v1_1 {
		private static $instance;
	
		const LSQB = '&#91;';
		const RSQB = '&#93;';
	
		/**
		 * Class constructor
		 */
		
		private function __construct () {
			$this->hook ('plugins_loaded');
		}
	
		/**
		 * Class singleton factory helper
		 */
		
		public static function get_instance () {
			if (!isset (self::$instance)) {
				$c = __CLASS__;
				self::$instance = new $c ();
			}
			
			return self::$instance;
			
		}

		/**
		 * "plugins_loaded" action hook; called after all active plugins and pluggable
		 * functions are loaded.
		 *
		 * Add the shortcode support actions for the short form shortcode [wp_scs] and the
		 * long form shortcode [wp_shortcode_shield].
		 */
		
		public function plugins_loaded () {
			add_shortcode ('wp_scs', array ($this, 'shortcode'));
			add_shortcode ('wp_shortcode_shield', array ($this, 'shortcode'));
		}
	
		/**
		 * Shortcode handler for the [wp_scs] and [wp_shortcode_shield] shortcodes; expands
		 * the shortcode to wrap the enclosed shortcode.
		 */
		
		public function shortcode ($atts, $content=null) {
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
	
		/**
		 * Helper function; encloses a section of content in square brackets [ ... ]
		 */
		
		private function enclose ($content) {
			return self::LSQB . $content . self::RSQB;
		}
		
	}	// end-class WP_ShortCodeShield
}	// if (!class_exists ('WP_ShortCodeShield'))

WP_ShortCodeShield::get_instance ();

?>