<?php

namespace WPMedia\Options;

/**
 * Manages multisite options using the WordPress options API.
 *
 * @author Remy Perona
 */
class SiteOptions extends AbstractOptions {

	/**
	 * Constructor
	 *
	 * @author Remy Perona
	 *
	 * @param string $prefix options prefix.
	 */
	public function __construct( $prefix = '' ) {
		$this->prefix = $prefix;
	}

	/**
	 * Gets the option for the given name. Returns the default value if the value does not exist.
	 *
	 * @author Remy Perona
	 *
	 * @param string $name   Name of the option to get.
	 * @param mixed  $default Default value to return if the value does not exist.
	 *
	 * @return mixed
	 */
	public function get( $name, $default = null ) {
		$option = get_site_option( $this->getOptionName( $name ), $default );

		if ( is_array( $default ) && ! is_array( $option ) ) {
			$option = (array) $option;
		}

		return $option;
	}

	/**
	 * Sets the value of an option. Update the value if the option for the given name already exists.
	 *
	 * @author Remy Perona
	 * @param string $name Name of the option to set.
	 * @param mixed  $value Value to set for the option.
	 *
	 * @return void
	 */
	public function set( $name, $value ) {
		update_site_option( $this->getOptionName( $name ), $value );
	}

	/**
	 * Deletes the option with the given name.
	 *
	 * @author Remy Perona
	 *
	 * @param string $name Name of the option to delete.
	 *
	 * @return void
	 */
	public function delete( $name ) {
		delete_site_option( $this->getOptionName( $name ) );
	}
}
