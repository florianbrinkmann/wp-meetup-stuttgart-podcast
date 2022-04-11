<?php
/**
 * Handling the REST endpoint for outputting the podcast posts.
 */

namespace WMSP\Endpoint;

use WP_REST_Server;
use WP_REST_Response;

/**
 * Hooks the REST Endpoint registration to the right action and adding a filter function to the posts list.
 *
 * @return void
 */
function init() {
	add_action( 'rest_api_init', __NAMESPACE__ . '\\register_rest_endpoint' );
	add_filter( 'wmsp_posts_data', __NAMESPACE__ . '\\extend_posts_data' );
}

/**
 * Registers the rest endpoint.
 *
 * @return void
 */
function register_rest_endpoint() {
	register_rest_route(
		'wp-meetup-stuttgart-podcast/v1',
		'/podcasts',
		[
			'methods' => WP_REST_Server::READABLE,
			'callback' => __NAMESPACE__ . '\\list_podcasts',
			'permission_callback' => '__return_true',
		]
	);
}

/**
 * Generates the REST response.
 *
 * @return WP_REST_Response
 */
function list_podcasts() {
	$posts = get_posts( [
		'post_type' => 'podcast',
		'post_status' => 'publish',
		'numberposts' => 10,
		'order' => 'ASC'
	] );

	/**
	 * Allows to filter the posts returned by the REST endpoint.
	 *
	 * @param array $posts
	 */
	$posts = (array) apply_filters( 'wmsp_posts_data', $posts );

	return new WP_REST_Response( $posts, 200 );
}

/**
 * Modifies the posts returned by the REST endpoint.
 *
 * @param array $posts The unmodified array of posts.
 *
 * @return array
 */
function extend_posts_data( $posts ) {
	$filtered_posts = [];
	foreach ( $posts as $post ) {
		$post->enclosure = get_post_meta( $post->ID, 'wmsp_enclosure', true );
		$filtered_posts[] = $post;
	}

	return $filtered_posts;
}