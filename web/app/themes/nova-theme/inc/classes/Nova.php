<?php
/**
 * Nova Theme Container Class
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

declare( strict_types=1 );

if ( ! class_exists( 'Nova' ) ) :

	class Nova {

		/**
		 * The container instance.
		 *
		 * @var Nova_Container
		 * @since 1.0.0
		 */
		protected Nova_Container $container;

		/**
		 * Constructor to initialize the container and bind classes.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			if ( ! defined( 'NOVA_INIT' ) ) {
				define( 'NOVA_INIT', true );
			}

			$this->container = new Nova_Container();

			// Theme-related classes
			$this->container->bind( 'theme.setup', Nova_Theme_Setup::class );

			// Support classes
			$this->container->bind( 'support.gutenberg.blocks', Nova_Support_Gutenberg_Blocks::class );

		// User classes
		$this->container->bind( 'user.role', Nova_User_Role::class );

			// Admin classes
			$this->container->bind( 'admin.theme.settings', Nova_Admin_Theme_Settings::class );
			$this->container->bind( 'admin.theme.create.child', Nova_Admin_Theme_Create_Child::class );
		}

		/**
		 * Boot all the theme components.
		 *
		 * @since 1.0.0
		 */
		public function boot(): void {
			$this->container->make( 'theme.setup' );
			$this->container->make( 'support.gutenberg.blocks' );
		$this->container->make( 'user.role' );

			// Boot admin classes only in admin context
			if ( is_admin() ) {
				$this->container->make( 'admin.theme.settings' );
				$this->container->make( 'admin.theme.create.child' );
			}
		}

		/**
		 * Bind a class to the container.
		 *
		 * @param string $abstract
		 * @param string $concrete
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function bind( string $abstract, string $concrete ): void {
			$this->container->bind( $abstract, $concrete );
		}

		/**
		 * Get an instance from the container.
		 *
		 * @param string $abstract
		 * @param array $parameters
		 *
		 * @return mixed
		 * @since 1.0.0
		 */
		public function resolve( string $abstract, array $parameters = [] ): mixed {
			return $this->container->make( $abstract, $parameters );
		}

		/**
		 * Retrieve an instance from the Nova container.
		 *
		 * @return mixed The instance of the requested class.
		 * @since 1.0.0
		 */
		public function get( string $abstract ): mixed {
			return $this->container->make( $abstract );
		}
	}

endif;
