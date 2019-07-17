<?php

namespace Cobra\Security\Service;

use Cobra\Core\Service\Service;

/**
 * Security Service
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
class SecurityService extends Service
{
    /**
     * Bind namespace references to classes in the container.
     *
     * @return void
     */
    public function namespaces(): void
    {
        contain_namespace(
            \Cobra\Interfaces\Security\Token\SecurityTokenInterface::class,
            \Cobra\Security\Token\SecurityToken::class
        );
    }

    /**
     * Set up any service class instances required by the application.
     *
     * @return void
     */
    public function instances(): void
    {
        contain_object(
            \Cobra\Interfaces\Security\Token\CsrfTokenInterface::class,
            \Cobra\Security\Token\CsrfToken::instance()
        );
        contain_object(
            \Cobra\Interfaces\Security\Token\NonceTokenInterface::class,
            \Cobra\Security\Token\NonceToken::instance()
        );
    }
}
