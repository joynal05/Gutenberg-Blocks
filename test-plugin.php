<?php
/**
 * Plugin Name:       Test Plugin

 * Version:           1.0.0

 * License:           GPL v2 or later
 * Text Domain:       test-plugin
 * Domain Path:       /languages/
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Test_Plugin' ) ) {

    final class Test_Plugin{

        private function __construct() {
            $this->define_constants();

            register_activation_hook( __FILE__, array( $this, 'activate' ) );                       
            add_action( 'plugins_loaded', array( $this, 'init_plugin' ) );
            add_action( 'plugins_loaded', array( $this, 'plugins_loaded_text_domain' ) );
            add_action( 'register_plugin_activation', array( $this, 'activate' ) );

        }

        /**
         * Initializes a single instance
         */
        public static function init() {
            static $instance = false;

            if ( ! $instance ) {
                $instance = new self();
            }

            return $instance;
        }


        /**
         * Define plugin path and url constants
         */
        public function define_constants() {
            define( 'TP_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
            define( 'TP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
            define( 'TP_ADMIN_ASSETS_UR', plugin_dir_url( __FILE__ ) . 'assets/admin/' );
            define( 'TP_WIDGET_ASSETS_PATH', plugin_dir_path( __FILE__ ) . 'includes/elementor-widgets/' );
            define( 'TP_KITS_BASE_API_URL', 'https://api.easyelementspro.com/wp-json/custom-api/v1/' );
            define( 'TP_VERSION', time() );
        }

        /**
         *  Init plugin
         */
        public function init_plugin() {
            // require_once TP_PLUGIN_PATH . 'autoloader.php';
            require_once TP_PLUGIN_PATH . 'includes/functions.php';
            // \EasyElements\Init::easy_elements_setup();
        }

        /**
         * Plugin text domain loaded
         */
        public function plugins_loaded_text_domain() {
            load_plugin_textdomain( 'test-plugin', false, TP_PLUGIN_PATH . 'languages/' );
        }

        /***
         * Do Stuff Plugin activation
         */
        public function activate() {

        }


    }

}


/**
 * Initializes the main plugin
 *
 * @return \Easy_Elements
 */
function test_plugin() {
    return Test_Plugin::init();
}

/**
 * Rick off the plugin
 */
test_plugin();