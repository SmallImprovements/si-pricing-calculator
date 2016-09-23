<?php

/**
	Element Name: SI Pricing Calculator
	Author: Small Improvements GmbH
	Version: 0.1.0
 */

class SI_Pricing_Calculator {
	public function ui() {
		return array(
			'title' => __('SI Pricing Calculator', 'si-pricing-calculator') ,
			'autofocus' => array(
				'heading' => 'h4.si-pricing-calculator-heading',
				'text' => '.si-pricing-calculator'
			)
		);
	}

	public function update_build_shortcode_atts($atts) {
		/* 
			This allows us to manipulate attributes that will be assigned to the shortcode
			Here we will inject a background-color into the style attribute which is
			already present for inline user styles
		*/

		if (!isset($atts['style'])) {
			$atts['style'] = '';
		}

		if (isset($atts['background_color'])) {
			$atts['style'].= ' background-color: ' . $atts['background_color'] . ';';
			unset($atts['background_color']);
		}

		return $atts;
	}
}
