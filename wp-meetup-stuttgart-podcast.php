<?php
/**
 * WP Meetup Stuttgart Podcast.
 *
 * @package   WMSP
 * @license   GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Podcasts
 * Plugin URI:
 * Description: Managing your podcast episodes.
 * Version:     1.0.0-beta
 * Author:      Florian Brinkmann, Matthias Pfefferle & Angelo Cali
 * Author URI:  https://pluginkollektiv.org/
 * License:     GPL v2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain: wp-meetup-stuttgart-podcast
 */

namespace WMSP;

/**
 * Requires the needed files and runs the init methods
 *
 * @return void
 */
function init() {
	require_once dirname( __FILE__ ) . '/inc/cpt.php';
	CPT\init();

	require_once dirname( __FILE__ ) . '/inc/frontend.php';
	Frontend\init();

	require_once dirname( __FILE__ ) . '/inc/endpoint.php';
	Endpoint\init();

	require_once dirname( __FILE__ ) . '/inc/admin.php';
	Admin\init();
}
add_action( 'plugins_loaded', __NAMESPACE__ . '\\init' );
