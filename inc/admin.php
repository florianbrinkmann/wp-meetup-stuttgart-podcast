<?php
/**
 * Handles the settings in backend.
 */

namespace WMSP\Admin;

/**
 * Calls the actions to register the settings.
 *
 * @return void
 */
function init() {
	add_action( 'admin_init', __NAMESPACE__ . '\\register_settings' );
}

/**
 * Add the section, register the settings and add the settings field.
 *
 * @return void
 */
function register_settings() {
	add_settings_section(
		'wmsp-settings-section',
		__( 'Podcast options', 'wp-meetup-stuttgart-podcast' ),
		function() {},
		'media'
	);

	register_setting(
		'media',
		'wmsp_player_position',
		[
			'type' => 'string',
			'description' => __( 'Set the position where the player has to be shown.', 'wp-meetup-stuttgart-podcast' ),
			'sanitize_callback' => __NAMESPACE__ . '\\sanitize',
			'default' => 'before'
		]
	);

	add_settings_field(
		'wmsp_player_position',
		__( 'Player position', 'wp-meetup-stuttgart-podcast' ),
		__NAMESPACE__ . '\\field',
		'media',
		'wmsp-settings-section'
	);
}

/**
 * Render the settings field.
 *
 * @return void
 */
function field() {
	$positions = [
		'before' => __( 'Before', 'wp-meetup-stuttgart-podcast' ),
		'after' => __( 'After', 'wp-meetup-stuttgart-podcast' ),
	];

	$current_value = get_option( 'wmsp_player_position', 'before' );
	$options_markup = '';
	foreach ( $positions as $value => $label ) {
		$options_markup .= sprintf(
			'<option value="%s" %s>%s</option>',
			$value,
			$current_value === $value ? ' selected="selected"' : '',
			$label
		);
	}

	printf(
		'<label for="wmsp_player_position">%s</label>
<select id="wmsp_player_position" name="wmsp_player_position">%s</select>',
		__( 'Position where the player should be injected in the content', 'wp-meetup-stuttgart-podcast' ),
		$options_markup
	);
}

/**
 * Sanitize the value that shall be saved.
 *
 * @param $option The position of the player. Should be before or after.
 * @return mixed|string
 */
function sanitize( $option ) {
	if ( in_array( $option, ['before', 'after'] ) ) {
		return $option;
	}

	return 'before';
}