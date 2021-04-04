<?php
/**
 * The Elementor core.
 *
 * Test if the WordPress, PHP, and any other plugin that need already meet the requirements.
 * referance: https://developers.elementor.com/creating-an-extension-for-elementor/
 *
 * @link       https://madebyaris.com/
 * @since      1.0.0
 *
 * @package    Mba_Woo_Se
 * @subpackage Mba_Woo_Se/includes/elementor
 */

/**
 * The core of Elementor Extension.
 *
 * Add elementor extension here.
 *
 * @since      1.0.0
 * @package    Mba_Woo_Se
 * @subpackage Mba_Woo_Se/includes/elementor
 * @author     M Aris Setiawan <arissetia.m@gmail.com>
 */
final class Mba_Woo_Se_Elementor_Core {
    const VERSION = '1.0.0';
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
    const MINIMUM_PHP_VERSION = '7.3.0';
    const MINIMUM_WOOCOMMERCE_VERSION = '3.5.0';

    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
    }

    public function on_plugin_loaded() {
        if ( $this->is_compatible() ) {
            add_action( 'elementor/init', [$this, 'init' ] );
        }
    }

    public function init() {
        // A place where you add the extension
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets'] );
        add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls'] );
    }

    public function init_widgets() {
		foreach ( glob( MBA_WOO_SE_DIR . 'includes/elementor/widgets/class-*.php' ) as $filename ) {
			require_once $filename;
		}
        // Register Widget.
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Mba_Woo_Se_El_Woo_Search() );
    }
    public function init_controls() {

    }

    public function is_compatible() {

        // Check if Elementor already installed and activated
        if ( ! did_action( 'elementor/loaded') ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin'] );
            return false;
        }

        //Check if Elementor required version
        if( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return false;
        }

        // Check if WooCommerce already installed and activated
        if ( ! did_action( 'woocommerce_loaded') ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_woocommerce_plugin'] );
            return false;
        }

        //Check if Elementor required version
        if( ! version_compare( WC_VERSION, self::MINIMUM_WOOCOMMERCE_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_woocommerce_version' ] );
			return false;
        }

        //Check for required PHP version
        if( ! version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '>' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return false;
        }

        return true;
    }

    public function admin_notice_missing_main_plugin() {
        if ( isset( $_GET['activate'] ) )
            unset( $_GET['activate'] );

        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'mba_woo_se' ),
            '<strong>' . esc_html__( 'Woocommerce Search Elementor', 'mba_woo_Se' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'mba_woo_se' ) 
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    public function admin_notice_minimum_elementor_version() {
        if ( isset( $_GET['activate'] ) )
        unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'mba_woo_Se' ),
			'<strong>' . esc_html__( 'Woocommerce Search Elementor', 'mba_woo_Se' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'mba_woo_Se' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    public function admin_notice_missing_woocommerce_plugin() {
        if ( isset( $_GET['activate'] ) )
            unset( $_GET['activate'] );

        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'mba_woo_se' ),
            '<strong>' . esc_html__( 'Woocommerce Search Elementor', 'mba_woo_Se' ) . '</strong>',
            '<strong>' . esc_html__( 'WooCommerce', 'mba_woo_se' ) 
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    public function admin_notice_minimum_woocommerce_version() {
        if ( isset( $_GET['activate'] ) )
        unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'mba_woo_Se' ),
			'<strong>' . esc_html__( 'Woocommerce Search Elementor', 'mba_woo_Se' ) . '</strong>',
			'<strong>' . esc_html__( 'WooCommerce', 'mba_woo_Se' ) . '</strong>',
			 self::MINIMUM_WOOCOMMERCE_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    public function admin_notice_minimum_php_version() {
        if ( isset( $_GET['activate'] ) )
        unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'mba_woo_Se' ),
			'<strong>' . esc_html__( 'Woocommerce Search Elementor', 'mba_woo_Se' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'mba_woo_Se' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }
}