<?php
/**
 * Handling the injection of the player in the frontend.
 */

namespace WMSP\Frontend;

/**
 * Call the filters and actions to handle content rendering and css injection.
 *
 * @return void
 */
function init() {
	add_filter( 'the_content', __NAMESPACE__ . '\\add_player' );
	add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_style' );
}

/**
 * Enqueue the css if the post type is podcast.
 *
 * @return void
 */
function enqueue_style() {
	if ( 'podcast' !== get_post_type() ) {
		return;
	}

	wp_enqueue_style( 'wmsp_player', plugins_url( '../assets/css/wmsp.css', __FILE__ ), [], filemtime( plugin_dir_path( __DIR__ . '/../assets/css/wmsp.css' ) ) );
}

/**
 * Add the podcast file as an audio player to the content of the podcast post.
 *
 * @param string $content Post content before modification.
 *
 * @return string Modified post content.
 */
function add_player( $content ) {
	if ( 'podcast' !== get_post_type() ) {
		return $content;
	}

	$post = get_post();
	$enclosure = get_post_meta( $post->ID, 'wmsp_enclosure', true );

	if ( ! $enclosure ) {
		return $content;
	}

	$position = get_option( 'wmsp_player_position', 'before' );

	if ( 'before' === $position ) {
		return "<p><audio controls src='$enclosure'></audio></p>" . $content;
	}

	return $content . "<p><audio controls src='$enclosure'></audio></p>";
}