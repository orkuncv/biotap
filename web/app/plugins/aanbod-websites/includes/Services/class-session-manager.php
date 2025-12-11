<?php
/**
 * Session Manager
 *
 * @package Aanbod_Websites
 */

namespace Aanbod_Websites\Services;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Session Manager class
 *
 * Handles PHP session management for the checkout flow.
 */
class Session_Manager {

	/**
	 * Session key for selected website ID
	 *
	 * @var string
	 */
	private const KEY_WEBSITE_ID = 'selected_website_id';

	/**
	 * Session key for selected package index
	 *
	 * @var string
	 */
	private const KEY_PACKAGE_INDEX = 'selected_package_index';

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->start_session();
	}

	/**
	 * Start PHP session if not already started
	 *
	 * @return void
	 */
	private function start_session(): void {
		if ( ! session_id() && ! headers_sent() ) {
			session_start();
		}
	}

	/**
	 * Get selected website ID
	 *
	 * @return int
	 */
	public function get_selected_website_id(): int {
		return isset( $_SESSION[ self::KEY_WEBSITE_ID ] ) ? (int) $_SESSION[ self::KEY_WEBSITE_ID ] : 0;
	}

	/**
	 * Set selected website ID
	 *
	 * @param int $website_id Website post ID.
	 * @return void
	 */
	public function set_selected_website_id( int $website_id ): void {
		$_SESSION[ self::KEY_WEBSITE_ID ] = $website_id;
	}

	/**
	 * Get selected package index
	 *
	 * @return int
	 */
	public function get_selected_package_index(): int {
		return isset( $_SESSION[ self::KEY_PACKAGE_INDEX ] ) ? (int) $_SESSION[ self::KEY_PACKAGE_INDEX ] : -1;
	}

	/**
	 * Set selected package index
	 *
	 * @param int $package_index Package index.
	 * @return void
	 */
	public function set_selected_package_index( int $package_index ): void {
		$_SESSION[ self::KEY_PACKAGE_INDEX ] = $package_index;
	}

	/**
	 * Clear all session data
	 *
	 * @return void
	 */
	public function clear(): void {
		unset( $_SESSION[ self::KEY_WEBSITE_ID ] );
		unset( $_SESSION[ self::KEY_PACKAGE_INDEX ] );
	}
}
