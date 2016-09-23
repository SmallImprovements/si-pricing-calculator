<?php

/**
    Element Name: SI Extended Accordion Item
    Description: Individual Items for the SI Extended Accordion
    Author: lucastobrazil
    Author URI: http://lucastobrazil.github.io/
    Version: 0.1.0
*/
class SI_Pricing_Feature_List_Item {

	public function ui() {
        return array(
            'name' => 'si-pricing-feature-list-item',
            'title'       => __( 'SI Pricing Feature List Item', 'si-pricing-feature-list-item' ),
            // 'section'     => 'content',
            'supports'    => array( 'id', 'class', 'style' ),
        );
	}

    public function flags() {
		return array(
			'child' => true
		);
	}

	public function update_build_shortcode_atts( $atts ) {
		return $atts;
	}
}