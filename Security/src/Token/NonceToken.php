<?php

namespace Cobra\Security\Token;

use Cobra\Interfaces\Object\SingletonInterface;
use Cobra\Interfaces\Security\Token\NonceTokenInterface;
use Cobra\Interfaces\Security\Token\SecurityTokenInterface;
use Cobra\Interfaces\Security\Token\SingletonTokenInterface;
use Cobra\Object\Traits\SingletonMethods;
use Cobra\Security\Traits\SingletonTokenMethods;

/**
 * Nonce Token
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
class NonceToken implements NonceTokenInterface, SingletonInterface, SingletonTokenInterface
{
    use SingletonMethods, SingletonTokenMethods;

    /**
     * Sets a new token.
     *
     * @return void
     */
    public static function regenerate(): void
    {
        self::$token = container_resolve(SecurityTokenInterface::class)::base64();
    }
}
