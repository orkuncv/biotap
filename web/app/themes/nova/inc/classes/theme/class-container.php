<?php
/**
 * Simple Dependency Injection Container
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

declare( strict_types=1 );

if ( ! class_exists( 'Nova_Container' ) ) :

	class Nova_Container {

		/**
		 * The container's bindings.
		 *
		 * @var array
		 * @since 1.0.0
		 */
		protected array $bindings = [];

		/**
		 * The container's instances.
		 *
		 * @var array
		 * @since 1.0.0
		 */
		protected array $instances = [];

		/**
		 * Bind a class or interface to the container.
		 *
		 * @param string $abstract
		 * @param mixed|null $concrete
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function bind( string $abstract, mixed $concrete = null ): void {
			$this->bindings[ $abstract ] = $concrete ?: $abstract;
		}

		/**
		 * Resolve an instance from the container.
		 *
		 * @param string $abstract
		 * @param array $parameters
		 *
		 * @return mixed
		 * @since 1.0.0
		 */
		public function make( string $abstract, array $parameters = [] ): mixed {
			if ( isset( $this->instances[ $abstract ] ) ) {
				return $this->instances[ $abstract ];
			}

			if ( isset( $this->bindings[ $abstract ] ) ) {
				$concrete = $this->bindings[ $abstract ];

				if ( is_callable( $concrete ) ) {
					$instance = $concrete( $this );
				} else {
					$instance = new $concrete( ...$parameters );
				}

				$this->instances[ $abstract ] = $instance;

				return $instance;
			}

			return null;
		}

		/**
		 * Check if the container has a binding for the given abstract.
		 *
		 * @param string $abstract
		 *
		 * @return bool
		 * @since 1.0.0
		 */
		public function has( string $abstract ): bool {
			return isset( $this->bindings[ $abstract ] );
		}
	}

endif;
