<?php

/**
	Element Name: SI Pricing Calculator
	Author: Small Improvements GmbH
	Version: 0.1.0
 */

class SI_Pricing_Feature_List {
	public function ui() {
		return array(
			'title' => __('SI Pricing Feature List', 'si-pricing-feature-list') ,
			'autofocus' => array(
				'heading' => 'h4.si-pricing-feature-list-heading',
				'text' => '.si-si-pricing-feature-list'
			) ,
			'renderChild' => true,
			'icon_group' => 'si_pricing_feature_list'
		);
	}

	public function flags() {
		return array(
			'dynamic_child' => true
		);
	}
}
