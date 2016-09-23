<?php

/**
 * Element Controls
 */

return array(
	'elements' => array(
		'type'    => 'sortable',
        'context' => 'content',
        'ui' => array(
			'title'   => __( 'Add Items', 'si-pricing-elements' ),
			'tooltip' =>__( 'Add a new item to your accordion..', 'si-pricing-elements' ),
		),
        'options' => array(
            'element' => 'si-pricing-feature-list-item',
            'newTitle' => __( 'Item %s', 'si-pricing-elements' ),
            'floor'    => 1
        ),
        'suggest' => array(
            array( 
                'title' => __( 'Item 1', 'si-pricing-elements' ),
                'link' => __( 'Link', 'si-pricing-elements' )
            ),
        )
	),

);