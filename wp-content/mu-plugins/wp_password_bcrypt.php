<?php

/**
 * Plugin Name: WP Password bcrypt
 * Version: 1.0
 * Description: Replaces wp_hash_password and wp_check_password with PHP 5.5's password_hash and password_verify.
 */

const WP_OLD_HASH_PREFIX = '$P$';
const W_HASH_PREFIX = '$W$';

/**
 * Check if user has entered correct password, supports bcrypt and pHash.
 *
 * @param string $password Plaintext password
 * @param string $hash Hash of password
 * @param int|string $userId ID of user to whom password belongs
 *
 * @return mixed|void
 *
 * @SuppressWarnings(PHPMD.CamelCaseVariableName) $wp_hasher is a global variable, we cannot change its name
 */
function wp_check_password($password, $hash, $userId = '')
{
	if (strpos($hash, WP_OLD_HASH_PREFIX) === 0) {
		global $wp_hasher;

		if (empty($wp_hasher)) {
			require_once(ABSPATH . WPINC . '/class-phpass.php');
			$wp_hasher = new PasswordHash(8, true);
		}

		$check = $wp_hasher->CheckPassword($password, $hash);
		if ($check && $userId) {
			$hash = wp_set_password($password, $userId);
		}
	}

	$check = password_verify($password, substr($hash, strlen(W_HASH_PREFIX)));
	return apply_filters('check_password', $check, $password, $hash, $userId);
}

/**
 * PASSWORD_DEFAULT
 * Use the bcrypt algorithm (default as of PHP 5.5.0).
 * Note that this constant is designed to change over time as new and stronger algorithms are added to PHP.
 * For that reason, the length of the result from using this identifier can change over time.
 *
 * PASSWORD_BCRYPT
 * The salt option has been deprecated as of PHP 7.0.0.
 *
 * PASSWORD_ARGON2I | PASSWORD_ARGON2ID
 * Argon2 passwords using PASSWORD_ARGON2I was added in PHP 7.2.0
 * Argon2 passwords using PASSWORD_ARGON2ID was added in PHP 7.3.0
 *
 * @param string $password Plaintext password
 * @return bool|string
 */
function wp_hash_password($password)
{
	// PHP 5.5.0
	$algo = PASSWORD_DEFAULT;
	$options = [];

	/*if ( is_php( '7.2' ) && defined( 'PASSWORD_ARGON2I' ) ) {
		$algo = PASSWORD_ARGON2I;
		$options = [
			'memory_cost' => PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
			'time_cost'   => PASSWORD_ARGON2_DEFAULT_TIME_COST,
			'threads'     => PASSWORD_ARGON2_DEFAULT_THREADS,
		];
	}

	if ( is_php( '7.3' ) && defined( 'PASSWORD_ARGON2ID' ) ) {
		$algo = PASSWORD_ARGON2ID;
	}*/

	$algo    = apply_filters('wp_hash_password_algorithm', $algo);
	$options = apply_filters('wp_hash_password_options', $options);

	return W_HASH_PREFIX . password_hash($password, $algo, $options);
}

/**
 * @param string $password Plaintext password
 * @param int $userId ID of user to whom password belongs
 *
 * @return bool|string
 */
function wp_set_password($password, $userId)
{
	/** @var \wpdb $wpdb */
	global $wpdb;

	$hash = wp_hash_password($password);

	$wpdb->update($wpdb->users, ['user_pass' => $hash, 'user_activation_key' => ''], ['ID' => $userId]);
	wp_cache_delete($userId, 'users');

	return $hash;
}
