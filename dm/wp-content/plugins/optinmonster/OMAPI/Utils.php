<?php
/**
 * Utils class.
 *
 * @since 1.3.6
 *
 * @package OMAPI
 * @author  Justin Sternberg
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Utils class.
 *
 * @since 1.3.6
 */
class OMAPI_Utils {

	/**
	 * Determines if given type is an inline type.
	 *
	 * @since  1.3.6
	 *
	 * @param  string $type Type to check
	 *
	 * @return boolean
	 */
	public static function is_inline_type( $type ) {
		return 'post' === $type || 'inline' === $type;
	}

	public static function item_in_field( $item, $fields, $field ) {
		return $item
			&& is_array( $fields )
			&& ! empty( $fields[ $field ] )
			&& in_array( $item, (array) $fields[ $field ] );
	}

	public static function field_not_empty_array( $fields, $field ) {
		if ( empty( $fields[ $field ] ) ) {
			return false;
		}

		$values = array_values( (array) $fields[ $field ] );
		$values = array_filter( $values );

		return ! empty( $values ) ? $values : false;
	}

	/**
	 * WordPress utility functions.
	 */

	public static function is_front_or_search() {
		return is_front_page() || is_home() || is_search();
	}

	public static function is_term_archive( $term_id, $taxonomy ) {
		if ( ! $term_id ) {
			return false;
		}
		return 'post_tag' === $taxonomy && is_tag( $term_id ) || is_tax( $taxonomy, $term_id );
	}

	/**
	 * Determines if AMP is enabled on the current request.
	 *
	 * @since 1.9.8
	 *
	 * @return bool True if AMP is enabled, false otherwise.
	 */
	public static function is_amp_enabled() {
		return ( function_exists( 'amp_is_request' ) && amp_is_request() )
			|| ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() );
	}

	/**
	 * Ensures a unique array.
	 *
	 * @since  1.9.10
	 *
	 * @param  array $val Array to clean.
	 *
	 * @return array       Cleaned array.
	 */
	public static function unique_array( $val ) {
		if ( empty( $val ) ) {
			return array();
		}

		$val = array_filter( $val );

		return array_unique( $val );
	}

}