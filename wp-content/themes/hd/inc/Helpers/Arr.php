<?php

namespace Webhd\Helpers;

use Webhd\Helpers\Cast;

class Arr {
	/**
	 * @param array $arr1
	 * @param array $arr2
	 *
	 * @return bool
	 */
	public static function compare( array $arr1, array $arr2 ): bool {
		sort( $arr1 );
		sort( $arr2 );

		return $arr1 == $arr2;
	}

	/**
	 * @param mixed $value
	 * @param mixed $callback
	 *
	 * @return array
	 */
	public static function convertFromString( $value, $callback = null ): array {
		if ( is_scalar( $value ) ) {
			$value = array_map( 'trim', explode( ',', Cast::toString( $value ) ) );
		}

		return static::reindex( array_filter( (array) $value, $callback ) );
	}

	/**
	 * @param mixed $array
	 *
	 * @return array
	 */
	public static function reindex( $array ): array {
		return static::isIndexedAndFlat( $array ) ? array_values( $array ) : $array;
	}

	/**
	 * @param mixed $array
	 *
	 * @return bool
	 */
	public static function isIndexedAndFlat( $array ): bool {
		if ( ! is_array( $array ) || array_filter( $array, 'is_array' ) ) {
			return false;
		}

		return wp_is_numeric_array( $array );
	}

	/**
	 * @param string|int $key
	 * @param array $array
	 * @param array $insert
	 *
	 * @return array
	 */
	public static function insertAfter( $key, array $array, array $insert ): array {
		return static::insert( $array, $insert, $key, 'after' );
	}

	/**
	 * @param string|int $key
	 * @param array $array
	 * @param array $insert
	 *
	 * @return array
	 */
	public static function insertBefore( $key, array $array, array $insert ): array {
		return static::insert( $array, $insert, $key, 'before' );
	}

	/**
	 * @param array $array
	 * @param array $insert
	 * @param string|int $key
	 * @param string $position
	 *
	 * @return array
	 */
	public static function insert( array $array, array $insert, $key, $position = 'before' ): array {
		$keyPosition = array_search( $key, array_keys( $array ) );
		if ( false !== $keyPosition ) {
			$keyPosition = Cast::toInt( $keyPosition );
			if ( 'after' == $position ) {
				++ $keyPosition;
			}
			$result = array_slice( $array, 0, $keyPosition );
			$result = array_merge( $result, $insert );

			return array_merge( $result, array_slice( $array, $keyPosition ) );
		}

		return array_merge( $array, $insert );
	}

	/**
	 * @param array $values
	 * @param string $prefix
	 * @param boolean $prefixed
	 *
	 * @return array
	 */
	public static function prefixKeys( array $values, string $prefix = '_', $prefixed = true ): array {
		$trim     = ( true === $prefixed ) ? $prefix : '';
		$prefixed = [];
		foreach ( $values as $key => $value ) {
			$key = trim( $key );
			if ( 0 === strpos( $key, $prefix ) ) {
				$key = substr( $key, strlen( $prefix ) );
			}
			$prefixed[ $trim . $key ] = $value;
		}

		return $prefixed;
	}

	/**
	 * @param array $values
	 * @param string $prefix
	 *
	 * @return array
	 */
	public static function unprefixKeys( array $values, string $prefix = '_' ): array {
		return static::prefixKeys( $values, $prefix, false );
	}

	/**
	 * @param array $array
	 * @param mixed $value
	 * @param mixed $key
	 *
	 * @return array
	 */
	public static function prepend( &$array, $value, $key = null ): array {
		if ( ! is_null( $key ) ) {
			return $array = [ $key => $value ] + $array;
		}
		array_unshift( $array, $value );

		return $array;
	}

	/**
	 * Search a multidimensional array by key value
	 *
	 * @param mixed $needle
	 * @param array $haystack
	 * @param int|string $key
	 *
	 * @return array|false
	 */
	public static function searchByKey( $needle, $haystack, $key ) {
		if ( ! is_array( $haystack ) || array_diff_key( $haystack, array_filter( $haystack, 'is_array' ) ) ) {
			return false;
		}
		$index = array_search( $needle, wp_list_pluck( $haystack, $key ) );
		if ( false !== $index ) {
			return $haystack[ $index ];
		}

		return false;
	}

	/**
	 * Set a value to an array of values using a dot-notation path as reference.
	 *
	 * @param mixed $data
	 * @param string $path
	 * @param mixed $value
	 *
	 * @return array
	 */
	public static function set( $data, $path, $value ) {
		$token = strtok( $path, '.' );
		$ref   = &$data;
		while ( false !== $token ) {
			if ( is_object( $ref ) ) {
				$ref = &$ref->$token;
			} else {
				$ref = &$ref[ $token ];
			}
			$token = strtok( '.' );
		}
		$ref = $value;

		return $data;
	}
}