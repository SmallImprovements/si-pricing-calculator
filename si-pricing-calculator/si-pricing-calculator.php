<?php

/*
Plugin Name: SI Pricing Calculator
Plugin URI:
Description: Private Element 
Author: Small Improvements Software GmbH
Author URI: 
Version: 0.1.0
*/
 
define( 'EXT_PATH', plugin_dir_path( __FILE__ ) );
define( 'EXT_URL', plugin_dir_url( __FILE__ ) );
define( 'ELEM_URL', EXT_URL . '/' );

add_action( 'cornerstone_register_elements', 'si_pricing_calculator_register_elements' );
add_filter( 'cornerstone_icon_map', 'si_pricing_calculator_icon_map' );
add_action( 'wp_enqueue_scripts', 'si_pricing_calculator_enqueue' );
	
function si_pricing_calculator_enqueue() {
	wp_enqueue_style( 'si-pricing-calculator-style', EXT_URL . 'styles/element.css', array(), '0.1.1' );
	wp_enqueue_script( 'si-pricing-calculator-script', ELEM_URL . 'scripts/element.js', array(), '0.1.1' );
}
/* Register Elements */
function si_pricing_calculator_register_elements() {
	cornerstone_register_element( 'SI_Pricing_Calculator', 'si-pricing-calculator', EXT_PATH);
}

/* Mapping of SVG icon so when you're searching in CS Elements, it has a nice graphic. */
function si_pricing_calculator_icon_map( $icon_map ) {
	$icon_map['si_pricing_calculator'] = EXT_URL . '/assets/svg/icons.svg';
	return $icon_map;
}
