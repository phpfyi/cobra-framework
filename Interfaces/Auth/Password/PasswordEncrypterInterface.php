<?php

namespace Cobra\Interfaces\Auth\Password;

/**
 * Password Encrypter Interface
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
interface PasswordEncrypterInterface
{
    /**
     * Returns an encrypted password string
     *
     * @param  string $string
     * @param  string $algorithm
     * @param  array  $options
     * @return string
     */
    public static function encrypt(string $string, string $algorithm = PASSWORD_DEFAULT, $options = []): string;

    /**
     * Checks a plaintext password matches an encrypted string
     *
     * @param  string $string
     * @param  string $hash
     * @return boolean
     */
    public static function verify(string $string, string $hash): bool;

    /**
     * Checks if the hashed string is outdated needs to be rehashed
     *
     * @param  string $hash
     * @param  string $algorithm
     * @param  array  $options
     * @return boolean
     */
    public static function rehash(string $hash, string $algorithm = PASSWORD_DEFAULT, $options = []): bool;
}
