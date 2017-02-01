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
		<input type="checkbox" id="non-profit"><label for="non-profit">Apply 50% nonprofit discount (<a href="https://www.small-improvements.com/nonprofit">learn more</a>)</label>
	</div>

	<div class="actions">
		<div>
			<!-- if logged in [freePlanButton] -->
			<a data-pricing-button="freePlanButton" class="free-plan">Congrats, you get SI for free!</a>
			
			<!-- if not logged in [trialButton] -->
			<a data-pricing-button="trialButton" class="half-width" href="https://www.small-improvements.com/register">
				<span class="trial">Start free trial</span>
				<span class="signup">Free for up to 10 users.</span>
			</a>

			<!-- if (company != null && currentUser != null) {Buy Button -->
			<a data-pricing-button="buyButton" href="#request-invoice">Request invoice</a>
			<a class="contact-form-trigger half-width" href="#request-invoice">Request invoice</a>
		</div>	
	</div>
</div>