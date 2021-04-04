<?php
/**
 * Widget search product WooCommerce.
 *
 * Search widget WooCommerce, easy to styling, and have any possebilites.
 * referance: https://developers.elementor.com/creating-a-new-widget/
 * referance: https://developers.elementor.com/elementor-controls/
 *
 * @link       https://madebyaris.com/
 * @since      1.0.0
 *
 * @package    Mba_Woo_Se
 * @subpackage Mba_Woo_Se/includes/elementor/widgets
 */

/**
 * Widget Search Product WooCommerce.
 *
 * Setup and logic for the SPW.
 *
 * @since      1.0.0
 * @package    Mba_Woo_Se
 * @subpackage Mba_Woo_Se/includes/elementor/widgets
 * @author     M Aris Setiawan <arissetia.m@gmail.com>
 */
class Mba_Woo_Se_El_Woo_Search extends \Elementor\Widget_Base {
    
    /**
	 * Set the name of widget.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
    public function get_name() {
        return 'ars-elementor-woocommerce-search';
    }

    /**
	 * Set the title of widget.
     * It will appear on Elementor.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
    public function get_title() {
        return __( 'WooCommerce Search Style', 'mba_woo_Se' );
    }

    /**
     * Set the icon of widget.
     * 
     * @since   1.0.0
     * @access  public
     */
    public function get_icon() {
        return 'fa fa-code';
    }

    /**
     * Set the category of widget.
     * 
     * @since   1.0.0
     * @access  public
     */
    public function get_categories() {
        return ['woocommerce-elements'];
    }

    /**
     * set the field setting for the widget.
     * 
     * @since   1.0.0
     * @access  protected
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'mba_woo_se' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'placeholder',
            [
                'label'         => __( 'Placeholder for input', 'mba_woo_se' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'input_type'    => 'url',
                'placeholder'   => __( 'search the product', 'mba_woo_se' ),
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Show the render result of the widget.
     * 
     * @since   1.0.0
     * @access  protected
     */
    protected function render() {
        // Get the setting from controller.
        $settings = $this->get_settings_for_display();

        // All the logic will belong here.
        $site_url = get_site_url();

        // The HTML will render from here.
        echo "<form role='search' method='get' class='' action='{$site_url}'>";
            echo '<label class="screen-reader-text" for="ars-elementor-woocommerce-search">Search for:</label>';
            echo "<input type='search' id='ars-elementor-woocommerce-search' name='s' class='search-field' placeholder='{$settings['placeholder']}'>";
            echo '<input type="hidden" name="post_type" value="product">';
        echo '</form>';
    }

    protected function _content_template() {}
}