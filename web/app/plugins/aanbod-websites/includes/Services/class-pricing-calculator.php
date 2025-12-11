<?php
/**
 * Pricing Calculator
 *
 * @package Aanbod_Websites
 */

namespace Aanbod_Websites\Services;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Pricing Calculator class
 *
 * Handles price calculations and formatting.
 */
class Pricing_Calculator {

	/**
	 * Calculate total price
	 *
	 * @param float $package_price Package price.
	 * @param array $extras Array of selected extras.
	 * @return float
	 */
	public function calculate_total( float $package_price, array $extras ): float {
		$total = $package_price;

		foreach ( $extras as $extra ) {
			if ( isset( $extra['price'] ) ) {
				$total += (float) $extra['price'];
			}
		}

		return $total;
	}

	/**
	 * Format price in Dutch format
	 *
	 * @param float $price Price to format.
	 * @return string
	 */
	public function format_price( float $price ): string {
		return '€' . number_format( $price, 2, ',', '.' );
	}

	/**
	 * Calculate extras total
	 *
	 * @param array $extras Array of selected extras.
	 * @return float
	 */
	public function calculate_extras_total( array $extras ): float {
		$total = 0;

		foreach ( $extras as $extra ) {
			if ( isset( $extra['price'] ) ) {
				$total += (float) $extra['price'];
			}
		}

		return $total;
	}
}
