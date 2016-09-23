<?php

/**
 * Shortcode handler
 */

$classes = 'si-pricing-calculator ' . $class;
$result_target        = ( $result_target        != ''     ) ? esc_attr( $result_target ) : '';

$containerAtts = cs_atts( array(
	'id' => $id . 'priceCalculatorForm',
	'class' => $classes,
	'style' => $style,
	'data-component' => 'PricingCalculator',
	'data-result-target' => $result_target
) );

?>

<div <?php echo $containerAtts; ?>>
	<div class="inputContainer">
		<input type="text" id="priceCalculatorInput" placeholder="Simply enter your number of users here!" />
		<a class="clear hidden"></a>
	</div>
	<div class="pricing-info styled-checkboxes">
		<input type="checkbox" id="non-profit"><label for="non-profit">Apply 50% nonprofit discount (<a href="/nonprofit">learn more</a>)</label>
	</div>

	<div class="actions">
		<div>
			<a class="free-plan">Congrats, you get SI for free!</a>
			<a  href="/register"><span class="trial">Start free trial</span><span class="signup">Free for up to 10 users.</span></a>
			<a  class="pricing-form-trigger" data-trigger="request-invoice" href="#">Buy now</a>
			<a class="contact-form-trigger" href="/contact">Contact us for renewal</a>
		</div>	
	</div>
	<div class="pricingPlan">
		<div class="price-box" data-plan="gold">
			<div class="price-box-plan price-monthly" data-interval="monthly">
				<div class="price">$6</div>
				<div class="price-description">per user</div>
				<div class="price-description">per month </div>
			</div>
			<div class="price-box-plan price-yearly" data-interval="yearly">
				<div class="price">$60</div>
				<div class="price-description">per user</div>
				<div class="price-description">per year upfront</div>
			</div>
			<p class="info">Pricing in US Dollars<span class="staff-size"></span> <span data-tooltip="Volume discount applied."><i class="icon-info-sign"></i></span><br>
				<span class="biyearly-info">Special offer: Pay <span class="biyearly-price"></span> for two years upfront.</span>
			</p>
		</div>
	</div>
</div>