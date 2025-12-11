<?php
/**
 * Extras Repository
 *
 * @package Aanbod_Websites
 */

namespace Aanbod_Websites\Repositories;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Extras Repository class
 *
 * Handles data access for global and website-specific extras.
 */
class Extras_Repository {

	/**
	 * Option name for global extras
	 *
	 * @var string
	 */
	private const GLOBAL_OPTION_NAME = 'website_global_extras';

	/**
	 * Meta key for website extras
	 *
	 * @var string
	 */
	private const WEBSITE_META_KEY = '_website_extras';

	/**
	 * Get global extras
	 *
	 * @return array
	 */
	public function get_global_extras(): array {
		$extras = get_option( self::GLOBAL_OPTION_NAME, array() );
		return is_array( $extras ) ? $extras : array();
	}

	/**
	 * Save global extras
	 *
	 * @param array $extras Array of extras.
	 * @return bool
	 */
	public function save_global_extras( array $extras ): bool {
		return update_option( self::GLOBAL_OPTION_NAME, $extras );
	}

	/**
	 * Get website-specific extras
	 *
	 * @param int $website_id Website post ID.
	 * @return array
	 */
	public function get_website_extras( int $website_id ): array {
		$extras = get_post_meta( $website_id, self::WEBSITE_META_KEY, true );
		return is_array( $extras ) ? $extras : array();
	}

	/**
	 * Save website-specific extras
	 *
	 * @param int   $website_id Website post ID.
	 * @param array $extras Array of extras.
	 * @return bool|int
	 */
	public function save_website_extras( int $website_id, array $extras ) {
		if ( empty( $extras ) ) {
			return delete_post_meta( $website_id, self::WEBSITE_META_KEY );
		}
		return update_post_meta( $website_id, self::WEBSITE_META_KEY, $extras );
	}
}
