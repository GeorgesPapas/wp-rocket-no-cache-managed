<?php
/**
 * Plugin Name: WP Rocket | Disable Page Caching for Managed
 * Description: Disables WP Rocket’s page cache while preserving other optimization features.
 * Plugin URI:  https://github.com/wp-media/wp-rocket-helpers/tree/master/cache/wp-rocket-no-cache/
 * Author:      WP Rocket Support Team
 * Author URI:  http://wp-rocket.me/
 * License:     GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Copyright SAS WP MEDIA 2018
 */

namespace WP_Rocket\Helpers\cache\no_cache_managed;

// Standard plugin security, keep this line in place.
defined( 'ABSPATH' ) or die();

/**
 * Disable page caching in WP Rocket.
 *
 * @link http://docs.wp-rocket.me/article/61-disable-page-caching
 */
add_filter( 'do_rocket_generate_caching_files', '__return_false' );

/**
 * Cleans entire cache folder on activation.
 *
 * @author Arun Basil Lal
 *
 *
 */
function clean_wp_rocket_cache() {

	if ( ! function_exists( 'rocket_clean_domain' ) ) {
		return false;
	}

	// Purge entire WP Rocket cache.
	rocket_clean_domain();
}

//Clear existing WP Rocket cache on activation
register_activation_hook( __FILE__, __NAMESPACE__ . '\clean_wp_rocket_cache' );



function clean_wp_rocket_managed_cache() {

	if (! function_exists( 'managed_clear_cache' ) ) {
		return false;
	}

	// Purge managed cache
	managed_clear_cache();
}

//Hook to clean managed cache if WP Rocket Cache is cleared.
add_action('before_rocket_clean_domain', __NAMESPACE__ . '\clean_wp_rocket_managed_cache' );