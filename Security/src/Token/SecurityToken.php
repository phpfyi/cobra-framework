<?php

namespace Cobra\Security\Token;

use Cobra\Interfaces\Security\Token\SecurityTokenInterface;

/**
 * Security Token
 *
 * Token generation class
 *
 * @category  Security
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class SecurityToken implements SecurityTokenInterface
{
    /**
     * Returns a hashed value.
     *
     * @param  string $algorithm
     * @return string
     */
    public static function hash($algorithm = 'sha256'): string
    {
        return hash($algorithm, microtime(true));
    }

    /**
     * Returns a hashed value that can be used in CSRF tokens.
     *
     * @param  integer $length
     * @return string
     */
    public static function bin2hex($length = 32): string
    {
        return bin2hex(random_bytes($length));
    }

    /**
     * Returns a hashed value that can be used in nonce tokens.
     *
     * @param  integer $length
     * @return string
     */
    public static function base64($length = 20): string
    {
        return base64_encode(random_bytes($length));
    }
}
