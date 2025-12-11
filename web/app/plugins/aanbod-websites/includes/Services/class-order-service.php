<?php
/**
 * Order Service
 *
 * @package Aanbod_Websites
 */

namespace Aanbod_Websites\Services;

use Aanbod_Websites\Repositories\Package_Repository;
use Aanbod_Websites\Repositories\Extras_Repository;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Order Service class
 *
 * Handles order creation and processing.
 */
class Order_Service {

	/**
	 * Package Repository instance
	 *
	 * @var Package_Repository
	 */
	private Package_Repository $package_repository;

	/**
	 * Extras Repository instance
	 *
	 * @var Extras_Repository
	 */
	private Extras_Repository $extras_repository;

	/**
	 * Pricing Calculator instance
	 *
	 * @var Pricing_Calculator
	 */
	private Pricing_Calculator $pricing_calculator;

	/**
	 * Email Service instance
	 *
	 * @var Email_Service
	 */
	private Email_Service $email_service;

	/**
	 * Constructor
	 *
	 * @param Package_Repository $package_repository Package repository instance.
	 * @param Extras_Repository  $extras_repository Extras repository instance.
	 * @param Pricing_Calculator $pricing_calculator Pricing calculator instance.
	 * @param Email_Service      $email_service Email service instance.
	 */
	public function __construct(
		Package_Repository $package_repository,
		Extras_Repository $extras_repository,
		Pricing_Calculator $pricing_calculator,
		Email_Service $email_service
	) {
		$this->package_repository = $package_repository;
		$this->extras_repository  = $extras_repository;
		$this->pricing_calculator = $pricing_calculator;
		$this->email_service      = $email_service;
	}

	/**
	 * Create an order
	 *
	 * @param int   $website_id Website post ID.
	 * @param int   $package_index Selected package index.
	 * @param array $form_fields Form submission data.
	 * @param array $selected_extras_indexes Selected extras indexes.
	 * @return array Success/error response.
	 */
	public function create_order(
		int $website_id,
		int $package_index,
		array $form_fields,
		array $selected_extras_indexes
	): array {
		// Validate website.
		if ( ! $website_id || 'website' !== get_post_type( $website_id ) ) {
			return array(
				'success' => false,
				'message' => __( 'Ongeldige website.', 'aanbod-websites' ),
			);
		}

		// Get and validate package.
		$selected_package = $this->package_repository->get_package_by_index( $package_index );
		if ( ! $selected_package ) {
			return array(
				'success' => false,
				'message' => __( 'Selecteer een pakket om door te gaan.', 'aanbod-websites' ),
			);
		}

		// Get website data.
		$website = get_post( $website_id );

		// Process extras.
		$selected_extras = $this->process_extras( $website_id, $selected_extras_indexes );

		// Calculate total price.
		$total_price = $this->pricing_calculator->calculate_total(
			(float) $selected_package['price'],
			$selected_extras
		);

		// Sanitize form data.
		$sanitized_form_data = $this->sanitize_form_data( $form_fields );

		// Create order post.
		$order_id = $this->create_order_post( $website, $selected_package, $sanitized_form_data, $selected_extras, $total_price );

		if ( ! $order_id ) {
			return array(
				'success' => false,
				'message' => __( 'Er is een fout opgetreden bij het plaatsen van de bestelling.', 'aanbod-websites' ),
			);
		}

		// Send email notifications.
		$this->email_service->send_order_notification(
			$order_id,
			$website,
			$selected_package,
			$sanitized_form_data,
			$selected_extras,
			$total_price
		);

		return array(
			'success' => true,
			'message' => __( 'Bestelling succesvol geplaatst! We nemen zo snel mogelijk contact met u op.', 'aanbod-websites' ),
		);
	}

	/**
	 * Process extras from indexes
	 *
	 * @param int   $website_id Website post ID.
	 * @param array $selected_extras_indexes Selected extras indexes.
	 * @return array
	 */
	private function process_extras( int $website_id, array $selected_extras_indexes ): array {
		$global_extras = $this->extras_repository->get_global_extras();
		$custom_extras = $this->extras_repository->get_website_extras( $website_id );
		$selected_extras = array();

		if ( empty( $selected_extras_indexes ) || ! is_array( $selected_extras_indexes ) ) {
			return $selected_extras;
		}

		foreach ( $selected_extras_indexes as $extra_key ) {
			if ( 0 === strpos( $extra_key, 'global_' ) ) {
				$index = (int) str_replace( 'global_', '', $extra_key );
				if ( isset( $global_extras[ $index ] ) ) {
					$selected_extras[] = $global_extras[ $index ];
				}
			} elseif ( 0 === strpos( $extra_key, 'custom_' ) ) {
				$index = (int) str_replace( 'custom_', '', $extra_key );
				if ( is_array( $custom_extras ) && isset( $custom_extras[ $index ] ) ) {
					$selected_extras[] = $custom_extras[ $index ];
				}
			}
		}

		return $selected_extras;
	}

	/**
	 * Sanitize form data
	 *
	 * @param array $form_fields Raw form data.
	 * @return array
	 */
	private function sanitize_form_data( array $form_fields ): array {
		$sanitized = array();

		foreach ( $form_fields as $key => $value ) {
			$sanitized[ sanitize_key( $key ) ] = sanitize_text_field( $value );
		}

		return $sanitized;
	}

	/**
	 * Create order post
	 *
	 * @param object $website Website post object.
	 * @param array  $package Selected package.
	 * @param array  $form_data Sanitized form data.
	 * @param array  $selected_extras Selected extras.
	 * @param float  $total_price Total price.
	 * @return int|false
	 */
	private function create_order_post(
		object $website,
		array $package,
		array $form_data,
		array $selected_extras,
		float $total_price
	) {
		/* translators: 1: Website title, 2: Date and time */
		$order_title = sprintf(
			__( 'Bestelling - %1$s - %2$s', 'aanbod-websites' ),
			$website->post_title,
			gmdate( 'd-m-Y H:i' )
		);

		$order_id = wp_insert_post(
			array(
				'post_title'  => $order_title,
				'post_type'   => 'website_order',
				'post_status' => 'publish',
			)
		);

		if ( $order_id ) {
			update_post_meta( $order_id, '_order_website_id', $website->ID );
			update_post_meta( $order_id, '_order_package', $package );
			update_post_meta( $order_id, '_order_form_data', $form_data );
			update_post_meta( $order_id, '_order_selected_extras', $selected_extras );
			update_post_meta( $order_id, '_order_total_price', $total_price );
		}

		return $order_id;
	}
}
