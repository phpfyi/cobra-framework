<?php

namespace Cobra\Auth\Password;

use Cobra\Interfaces\Auth\Password\PasswordEncrypterInterface;

/**
 * Password Generator
 *
 * @category  Auth
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class PasswordEncrypter implements PasswordEncrypterInterface
{
    /**
     * Returns an excrypted password string
     *
     * @param  string $string
     * @return string
     */
    public static function encrypt(string $string, string $algorithm = PASSWORD_DEFAULT, $options = []): string
    {
        return password_hash($string, $algorithm, $options);
    }

    /**
     * Verifies a plaintext password matches an encrypted string
     *
     * @param  string $string
     * @param  string $hash
     * @return boolean
     */
    public static function verify(string $string, string $hash): bool
    {
        return password_verify($string, $hash);
    }

    /**
     * Returns if the hashed string is outdated needs to be rehashed
     *
     * @param  string $hash
     * @param  string $algorithm
     * @param  array  $options
     * @return boolean
     */
    public static function rehash(string $hash, string $algorithm = PASSWORD_DEFAULT, $options = []): bool
    {
        return password_needs_rehash($hash, $algorithm, $options);
    }
}
