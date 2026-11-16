<?php
/**
 * ACF Local JSON, only for the field groups kept in git.
 *
 * Groups written by hand in acf-json/ have readable keys
 * (group_section_foo, group_module_foo, group_page_foo) and are saved back
 * there when edited in the admin. The groups that were made in the admin
 * before Local JSON came in have ACF's generated keys (group_6970c577243cf)
 * and stay in the database only: a local database that lags behind
 * production would otherwise save a stale copy to JSON, and that copy would
 * replace the live group on deploy.
 *
 * @package grand-hotel-europe
 * @subpackage Functionality
 * @since 1.1.0
 */

if ( ! function_exists( 'ghe_acf_json_save_paths' ) ) :
	/**
	 * Saves to acf-json/ only the ACF items whose key is readable, not one
	 * of ACF's generated keys ("group_" + 13 hex characters).
	 *
	 * @since 1.1.0
	 *
	 * @param array $paths The paths ACF would save the JSON file to.
	 * @param array $post  The ACF field group, post type, taxonomy or options page.
	 * @return array The paths, or none for an item that stays in the database.
	 */
	function ghe_acf_json_save_paths( $paths, $post ) {
		$key = ( is_array( $post ) && ! empty( $post['key'] ) ) ? (string) $post['key'] : '';

		if ( '' === $key || preg_match( '/^[a-z_]+_[0-9a-f]{13}$/', $key ) ) {
			return array();
		}

		return $paths;
	}
endif;
add_filter( 'acf/json/save_paths', 'ghe_acf_json_save_paths', 10, 2 );
