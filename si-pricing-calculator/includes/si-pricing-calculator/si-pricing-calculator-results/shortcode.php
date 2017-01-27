<?php

/**
 * Shortcode handler
 */

$classes = 'si-pricing-calculator-results ' . $class;
$result_target        = ( $result_target        != ''     ) ? esc_attr( $result_target ) : '';

$containerAtts = cs_atts( array(
	'id' => $id,
	'class' => $classes,
	'style' => $style
) );

?>

<div <?php echo $containerAtts; ?>>
	<div class="pricing-calculator-pricingPlan active">
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