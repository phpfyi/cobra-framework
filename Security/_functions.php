<?php

use Cobra\Interfaces\Security\Token\CsrfTokenInterface;
use Cobra\Interfaces\Security\Token\NonceTokenInterface;

/**
 * Security function sets
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

if (! function_exists('nonce')) {
    /**
     * Returns the nonce token
     *
     * @return string
     */
    function nonce(): string
    {
        return container_object(NonceTokenInterface::class)::get();
    }
}

if (! function_exists('csrf')) {
    /**
     * Returns the csrf token
     *
     * @return string
     */
    function csrf(): string
    {
        return container_object(CsrfTokenInterface::class)::get();
    }
}
