<?php

namespace Cobra\Interfaces\Security\Token;

/**
 * CSRF Token Interface
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
interface CsrfTokenInterface
{
    /**
     * Returns the current token or creates a new one and returns it.
     *
     * @return string
     */
    public static function get(): string;
}
