<?php
/**
 * Package Repository
 *
 * @package Aanbod_Websites
 */

namespace Aanbod_Websites\Repositories;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Package Repository class
 *
 * Handles data access for website packages.
 */
class Package_Repository {

	/**
	 * Option name for packages
	 *
	 * @var string
	 */
	private const OPTION_NAME = 'website_packages';

	/**
	 * Get all packages
	 *
	 * @return array
	 */
	public function get_packages(): array {
		$packages = get_option( self::OPTION_NAME, array() );
		return is_array( $packages ) ? $packages : array();
	}

	/**
	 * Get a package by index
	 *
	 * @param int $index Package index.
	 * @return array|null
	 */
	public function get_package_by_index( int $index ): ?array {
		$packages = $this->get_packages();
		return isset( $packages[ $index ] ) ? $packages[ $index ] : null;
	}

	/**
	 * Save packages
	 *
	 * @param array $packages Array of packages.
	 * @return bool
	 */
	public function save_packages( array $packages ): bool {
		return update_option( self::OPTION_NAME, $packages );
	}

	/**
	 * Validate a package
	 *
	 * @param array $package Package data.
	 * @return bool
	 */
	public function validate_package( array $package ): bool {
		return ! empty( $package['name'] );
	}
}
