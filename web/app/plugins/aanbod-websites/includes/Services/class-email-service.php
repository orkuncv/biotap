<?php
/**
 * Email Service
 *
 * @package Aanbod_Websites
 */

namespace Aanbod_Websites\Services;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Email Service class
 *
 * Handles sending order notification emails.
 */
class Email_Service {

	/**
	 * Pricing Calculator instance
	 *
	 * @var Pricing_Calculator
	 */
	private Pricing_Calculator $pricing_calculator;

	/**
	 * Constructor
	 *
	 * @param Pricing_Calculator $pricing_calculator Pricing calculator instance.
	 */
	public function __construct( Pricing_Calculator $pricing_calculator ) {
		$this->pricing_calculator = $pricing_calculator;
	}

	/**
	 * Send order notification emails
	 *
	 * @param int    $order_id Order post ID.
	 * @param object $website Website post object.
	 * @param array  $package Selected package data.
	 * @param array  $form_data Form submission data.
	 * @param array  $selected_extras Selected extras.
	 * @param float  $total_price Total order price.
	 * @return void
	 */
	public function send_order_notification(
		int $order_id,
		object $website,
		array $package,
		array $form_data,
		array $selected_extras,
		float $total_price
	): void {
		$this->send_admin_notification( $order_id, $website, $package, $form_data, $selected_extras, $total_price );
		$this->send_customer_confirmation( $website, $form_data, $total_price );
	}

	/**
	 * Send admin notification email
	 *
	 * @param int    $order_id Order post ID.
	 * @param object $website Website post object.
	 * @param array  $package Selected package data.
	 * @param array  $form_data Form submission data.
	 * @param array  $selected_extras Selected extras.
	 * @param float  $total_price Total order price.
	 * @return void
	 */
	private function send_admin_notification(
		int $order_id,
		object $website,
		array $package,
		array $form_data,
		array $selected_extras,
		float $total_price
	): void {
		$admin_email = get_option( 'admin_email' );
		/* translators: %s: Website title */
		$subject = sprintf( __( 'Nieuwe Website Bestelling - %s', 'aanbod-websites' ), $website->post_title );

		/* translators: %s: Website title */
		$message  = sprintf( __( 'Er is een nieuwe bestelling geplaatst voor: %s', 'aanbod-websites' ), $website->post_title ) . "\n\n";
		$message .= "======================\n";
		$message .= __( 'Gekozen Pakket', 'aanbod-websites' ) . "\n";
		$message .= "======================\n\n";
		$message .= $package['name'] . ': ' . $this->pricing_calculator->format_price( (float) $package['price'] ) . "\n\n";

		$message .= "======================\n";
		$message .= __( 'Klantgegevens', 'aanbod-websites' ) . "\n";
		$message .= "======================\n\n";

		foreach ( $form_data as $key => $value ) {
			$message .= ucfirst( str_replace( '_', ' ', $key ) ) . ': ' . $value . "\n";
		}

		if ( ! empty( $selected_extras ) ) {
			$message .= "\n======================\n";
			$message .= __( 'Geselecteerde Extra Opties', 'aanbod-websites' ) . "\n";
			$message .= "======================\n\n";

			foreach ( $selected_extras as $extra ) {
				$message .= $extra['name'] . ': ' . $this->pricing_calculator->format_price( (float) $extra['price'] ) . "\n";
			}
		}

		$message .= "\n======================\n";
		$message .= __( 'Totaalprijs', 'aanbod-websites' ) . ': ' . $this->pricing_calculator->format_price( $total_price ) . "\n";
		$message .= "======================\n\n";

		/* translators: %s: WordPress admin edit post URL */
		$message .= sprintf( __( 'Bekijk de bestelling in WordPress: %s', 'aanbod-websites' ), admin_url( 'post.php?post=' . $order_id . '&action=edit' ) );

		wp_mail( $admin_email, $subject, $message );
	}

	/**
	 * Send customer confirmation email
	 *
	 * @param object $website Website post object.
	 * @param array  $form_data Form submission data.
	 * @param float  $total_price Total order price.
	 * @return void
	 */
	private function send_customer_confirmation( object $website, array $form_data, float $total_price ): void {
		$customer_email = $form_data['email'] ?? $form_data['e_mail'] ?? '';

		if ( ! is_email( $customer_email ) ) {
			return;
		}

		$subject  = __( 'Bedankt voor uw bestelling', 'aanbod-websites' );
		$message  = __( 'Bedankt voor uw interesse in onze website. We hebben uw bestelling ontvangen en nemen zo snel mogelijk contact met u op.', 'aanbod-websites' ) . "\n\n";
		/* translators: %s: Website title */
		$message .= sprintf( __( 'Website: %s', 'aanbod-websites' ), $website->post_title ) . "\n";
		/* translators: %s: Formatted price */
		$message .= sprintf( __( 'Totaalprijs: %s', 'aanbod-websites' ), $this->pricing_calculator->format_price( $total_price ) );

		wp_mail( $customer_email, $subject, $message );
	}
}
