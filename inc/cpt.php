<?php
/**
 * Registering the custom post type.
 */

namespace WMSP\CPT;

/**
 * Hooks the CPT registration to the action.
 *
 * @return void
 */
function init() {
	add_action( 'init', __NAMESPACE__ . '\\register_podcast_cpt' );
}

/**
 * Custom post type registration.
 *
 * @return void
 */
function register_podcast_cpt() {
	register_post_type( 'podcast', [
		'label' => __( 'Podcasts', 'wp-meetup-stuttgart-podcast' ),
		'labels' => [],
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-media-audio',
		'public' => true,
		'supports' => [ 'title', 'editor', 'custom-fields', ],
		'template' => [
			[ 'core/paragraph', [ 'placeholder' => 'TEXT' ] ],
		],
	] );
}