<?php
/**
 * Checkout Fields Repository
 *
 * @package Aanbod_Websites
 */

namespace Aanbod_Websites\Repositories;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Checkout Fields Repository class
 *
 * Handles data access for checkout form fields configuration.
 */
class Checkout_Fields_Repository {

	/**
	 * Option name for checkout fields
	 *
	 * @var string
	 */
	private const OPTION_NAME = 'website_checkout_fields';

	/**
	 * Get checkout fields
	 *
	 * @return array
	 */
	public function get_fields(): array {
		$fields = get_option( self::OPTION_NAME, array() );
		return is_array( $fields ) ? $fields : array();
	}

	/**
	 * Save checkout fields
	 *
	 * @param array $fields Array of fields.
	 * @return bool
	 */
	public function save_fields( array $fields ): bool {
		return update_option( self::OPTION_NAME, $fields );
	}

	/**
	 * Validate a field
	 *
	 * @param array $field Field data.
	 * @return bool
	 */
	public function validate_field( array $field ): bool {
		return ! empty( $field['label'] );
	}
}
