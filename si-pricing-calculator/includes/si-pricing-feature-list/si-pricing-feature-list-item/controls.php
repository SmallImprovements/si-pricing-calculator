<?php

/**
 * Element Controls
 */

return array(
	'title' => array(
		'type'    => 'text',
        'context' => 'title',
        'ui' => array(
			'title'   => __( 'Item Title', 'si-custom-elements' ),
			'tooltip' =>__( 'Include your desired title for your Accordion Item here.', 'si-custom-elements' ),
		),
	),
    'link' => array(
		'type'    => 'text',
        'context' => 'link',
        'ui' => array(
			'title'   => __( 'Link', 'si-custom-elements' ),
			'tooltip' =>__( 'Optional', 'si-custom-elements' ),
		),
	),
);