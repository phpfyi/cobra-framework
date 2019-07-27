<?php

namespace Cobra\Interfaces\Server;

/**
 * Server Interface
 *
 * @category  Server
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
interface ServerInterface
{
    /**
     * Sets a PHP ini configuration value
     *
     * @param string $name
     * @param string|int|float $value
     * @return ServerInterface
     */
    public function ini(string $name, $value): ServerInterface;
}
