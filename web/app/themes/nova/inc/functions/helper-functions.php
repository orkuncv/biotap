<?php
/**
 * Nova Theme Helper Functions
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

declare( strict_types=1 );

if ( ! function_exists( 'nova' ) ) {
	/**
	 * Retrieve the main Nova theme container instance or a specific service from it.
	 *
	 * @param string|null $abstract Optional. The abstract identifier of the service to retrieve.
	 *                              If null, returns the main Nova container instance itself.
	 *
	 * @return mixed The main Nova container instance if $abstract is null,
	 *               or the requested service/instance resolved by the container.
	 * @since 1.0.0
	 */
	function nova( string|null $abstract = null ): mixed {
		global $nova;

		if ( ! isset( $nova ) || ! ( $nova instanceof Nova ) ) {
			$nova = new Nova();
		}

		if ( $abstract !== null ) {
			return $nova->get( $abstract );
		}

		return $nova;
	}
}

if ( ! function_exists( 'nova_get_post_by_title' ) ) {
	/**
	 * Gets a post by its title.
	 *
	 * @param string $title The title of the post to find.
	 * @param string $post_type The post type to search in.
	 *
	 * @return WP_Post|null The found post or null if not found.
	 * @since 1.0.0
	 */
	function nova_get_post_by_title( string $title, string $post_type = 'page' ): ?WP_Post {
		$query = new WP_Query( [
			'post_type'      => $post_type,
			'title'          => $title,
			'post_status'    => 'any',
			'posts_per_page' => 1,
			'no_found_rows'  => true
		] );

		return $query->have_posts() ? $query->posts[0] : null;
	}
}

if ( ! function_exists( 'nova_get_admin_template' ) ) {
	/**
	 * Get admin template.
	 *
	 * @param string $template_name The template name (without .php extension).
	 * @param array $variables Variables to extract into template scope.
	 *
	 * @return string The rendered template content.
	 * @since 1.0.0
	 */
	function nova_get_admin_template( string $template_name, array $variables = [] ): string {
		$template_path = get_template_directory() . '/assets/views/admin/' . $template_name . '.php';

		if ( ! file_exists( $template_path ) ) {
			return '';
		}

		extract( $variables );

		ob_start();
		include $template_path;
		return ob_get_clean();
	}
}

if ( ! function_exists( 'nova_is_child_theme_active' ) ) {
	/**
	 * Check if Nova child theme is active.
	 *
	 * @return bool True if child theme is active, false otherwise.
	 * @since 1.0.0
	 */
	function nova_is_child_theme_active(): bool {
		return get_template() !== get_stylesheet();
	}
}

if ( ! function_exists( 'nova_has_child_theme_installed' ) ) {
	/**
	 * Check if Nova child theme is installed.
	 *
	 * @return bool True if child theme is installed, false otherwise.
	 * @since 1.0.0
	 */
	function nova_has_child_theme_installed(): bool {
		$child_theme_slug = defined( 'NOVA_CHILD_THEME_SLUG' ) ? NOVA_CHILD_THEME_SLUG : 'nova-child';
		$child_theme_path = get_theme_root() . '/' . $child_theme_slug;

		return file_exists( $child_theme_path ) && is_dir( $child_theme_path );
	}
}

if ( ! function_exists( 'get_svg' ) ) {
	/**
	 * Get SVG icon content.
	 *
	 * @param string $icon_name The icon name (without .svg extension).
	 *
	 * @return string The SVG content.
	 * @since 1.0.0
	 */
	function get_svg( string $icon_name ): string {
		$svg_path = get_template_directory() . '/assets/svg/' . $icon_name . '.svg';

		if ( ! file_exists( $svg_path ) ) {
			return '';
		}

		return file_get_contents( $svg_path );
	}
}
