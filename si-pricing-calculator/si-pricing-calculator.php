<?php

/*
Plugin Name: SI Pricing Calculator
Plugin URI:
Description: Private Element 
Author: Small Improvements Software GmbH
Author URI: 
Version: 0.1.0
*/
 function loadSiPricingCalculator() {
	define( 'EXT_PATH', plugin_dir_path( __FILE__ ) );
	define( 'EXT_URL', plugin_dir_url( __FILE__ ) );
	define( 'ELEM_URL', EXT_URL . '/includes/' );

	/* List Elements Here */
	$elements = array(
		'SI_Pricing_Calculator'	=> array(
			'name'		=> 'si-pricing-calculator',
			'directory'		=> 'si-pricing-calculator',
		),
	);
	
	/* Register Elements */
	add_action( 'cornerstone_register_elements', function() use ( $elements ) {
		foreach ($elements as $key => $value) {
			$className = $key;
			$name = $value['name'];
			$directory = $value['directory'];

			/* see cornerstone/includes/utility/api.php */
			cornerstone_register_element( $className, $name, EXT_PATH . 'includes/' . $directory );
		}
	});
	
	/* Enqueue JS and CSS for Elements */
	add_action( 'wp_enqueue_scripts', function() use ( $elements ) {
		foreach ($elements as $key => $value) {
			$title = $key;
			$namespace = $value['namespace'];
			$directory = $value['directory'];

			$cssFilePath = EXT_PATH . 'includes/' . $directory . '/styles/element.css';
			$cssFileUrl = EXT_URL . 'includes/' . $directory . '/styles/element.css';
			$jsFilePath = EXT_PATH . 'includes/' . $directory . '/scripts/element.js';
			$jsFileUrl = EXT_URL . 'includes/' . $directory . '/scripts/element.js';
			
			if(file_exists($cssFilePath)) {
				wp_enqueue_style( $namespace . '-style', $cssFileUrl, array(), '0.1.0' );	
			}
			if(file_exists($jsFilePath)) {
				wp_enqueue_script( $namespace . '-script', $jsFileUrl, array(), '0.1.0' );
			}
		}
	});

	add_filter( 'cornerstone_icon_map', 'si_pricing_calculator_icon_map');

	/* Mapping of SVG icon so when you're searching in CS Elements, it has a nice graphic. */
	function si_pricing_calculator_icon_map( $icon_map ) {
		$icon_map['si_pricing_calculator'] = EXT_URL . '/assets/svg/icons.svg';
		return $icon_map;
	}
 }
 loadSiPricingCalculator();
