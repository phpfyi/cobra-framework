<?php

namespace Cobra\Security\Traits;

use Cobra\Interfaces\Security\Token\SingletonTokenInterface;

/**
 * Singleton Token Methods Trait
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
trait SingletonTokenMethods
{
    /**
     * Token string value
     *
     * @var string
     */
    private static $token;

    /**
     * Sets the instance and token.
     *
     * @return SingletonTokenInterface
     */
    public static function instance(): SingletonTokenInterface
    {
        static $instance = null;
        if ($instance === null) {
            $instance = new static();
            $instance::regenerate();
        }
        return $instance;
    }

    /**
     * Returns the current token or creates a new one and returns it.
     *
     * @return string
     */
    public static function get(): string
    {
        if (!self::$token) {
            self::regenerate();
        }
        return self::$token;
    }
}
